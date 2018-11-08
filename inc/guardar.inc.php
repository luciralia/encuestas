<?php
session_start();
require_once('../conexion.php');
 echo 'valor preguntas'.$p;		
 
 print_r($_POST);					 
if ($_POST[accionp] == 'Guardar' ){
	
	for ($i=1;$i<$_POST['j'];$i++){//cada lab
	    $labbox='lab'.$i;
	    for ($np=1;$np<$_POST['p'];$np++){//cada pregunta
	      
	            $pregbox='id_preg'.$np;
	
	            if (!isset($_POST[$labbox])||!isset($_POST[$pregbox])){
				} else{
					     //primero busca pregunta-laboratorio si existe desactiva, en caso contrario la inserta 
						 // registrar en tabla validez formato.
						   $existe="SELECT * FROM formato
						            WHERE id_lab=" . $_POST[$labbox] .
									" AND id_preg=" . $_POST[$pregbox];
			 
							   
                         $registro= pg_query($con,$existe);
                         $existeform= pg_num_rows($registro);
						 $idformato= pg_fetch_array($registro);
	                     if ($existeform==0){
						 
	                          $query="SELECT max(id_formato) FROM formato";
			
                              $registro= pg_query($con,$query);
                              $ultimoform= pg_fetch_array($registro);
	 
                              if ($ultimoform[0]==NULL)
                                  $ultimoform[0]=1;
                              else 
                                  $ultimoform[0]=$ultimoform[0]+1;	
		  
	                          echo 'ultimo formato'.$ultimoform[0];	
	 
                              $vigencia=1;
		                
						 
                              $query="INSERT INTO formato (id_formato,id_preg,id_lab,vigencia_actual) VALUES (%d,%d,%d,'%s')";
                              $query=sprintf($query,$ultimoform[0],$_POST[$pregbox],$_POST[$labbox],$vigencia);

                              $result=pg_query($con,$query) or die('ERROR AL INSERTAR DATOS en formato' . pg_last_error());	
				  	     //	echo "<br />" . " preg " .$np. " " .  $_POST[$pregbox]. "<br />";
					     //						echo "<br />" . $query . "<br />";
				  
				  
	                     //---------------------------
	                           $query="SELECT max(id_validez_form) FROM validez_formato";
			
                               $registro= pg_query($con,$query);
                               $ultimoval= pg_fetch_array($registro);
	 
                               if ($ultimoval[0]==NULL)
                                    $ultimoval[0]=1;
                              else 
                                    $ultimoval[0]=$ultimoval[0]+1;	
		  
	                     
	                           if ($existeform==0){
	                                   $query="INSERT INTO validez_formato(id_validez_form,id_formato,fecha_inicio) VALUES(%d,%d,'%s')";
	                                   $query=sprintf($query,$ultimoval[0],$ultimoform[0],date('Y-m-d'));
     
                                      $result=pg_query($con,$query) or die('ERROR AL INSERTAR DATOS en validezformato' . pg_last_error());
							   }
						 } //fin de existe validez
						 else {
							//actualizar  
							// poner vigencia formato =0 y fecha 
							
							  $vigencia=0;
							  $strqueryd="UPDATE formato SET vigencia_actual = %d
                              WHERE id_formato=" . $idformato[0] ;
							 
                              $queryud=sprintf($strqueryd,$vigencia);
					  
                              $result=pg_query($con,$queryud) or die('ERROR AL ACTUALIZAR DATOS EN TABLA formato: ' . pg_last_error());

							  
							 
							  $queryup="UPDATE validez_formato SET fecha_final = '%s'
                              WHERE id_formato=" . $idformato[0];
							  
                              $queryud=sprintf($queryup,date('Y-m-d'));
					          $result=pg_query($con,$queryud) or die('ERROR AL ACTUALIZAR DATOS EN TABLA validez_formato: ' . pg_last_error());
		                      
							   $query="SELECT max(id_validez_form) FROM validez_formato";
			
                               $registro= pg_query($con,$query);
                               $ultimoval= pg_fetch_array($registro);
	 
                               if ($ultimoval[0]==NULL)
                                    $ultimoval[0]=1;
                               else 
                                    $ultimoval[0]=$ultimoval[0]+1;	
		  
	                           $date = date("Y-m-d");
                               //Incrementando 1 dia
                               $mod_date = strtotime($date."+ 1 days");
                               echo date("Y-m-d",$mod_date) . "\n";
	 
	                           $query="INSERT INTO validez_formato(id_validez_form,id_formato,fecha_inicio) VALUES(%d,%d,'%s')";
	                           $query=sprintf($query,$ultimoval[0],$idformato[0],date("Y-m-d"),$mod_date);
     
                               $result=pg_query($con,$query) or die('ERROR AL INSERTAR DATOS en validezformato' . pg_last_error());
							  
		                  
                     
		

						 }
	             } //fin del if
	       } // for preg
	  } //for de lab
	 $direccion='location: ../view/inicio.html.php?mod=cfp';
     echo $direccion . "</br>";
     header($direccion); 
	 
}
/*
if ($_REQUEST[accionmt] == 'Guardar' ){
	
      $strqueryd="UPDATE cat_topico SET nomb_topico='%s'
                  WHERE id_cat_topico=". $_REQUEST['topico'];
	
      $queryud=sprintf($strqueryd,$_REQUEST['nombreTopico']);
					  
      $result=pg_query($con,$queryud) or die('ERROR AL ACTUALIZAR DATOS EN TABLA cat_topico: ' . pg_last_error());

}

if ($_REQUEST[accionmp] == 'Guardar' ){
	echo 'entro a actualizar pregunta';
      $strqueryd="UPDATE cat_preg SET pregunta_texto='%s'
                  WHERE id_preg=". $_REQUEST['pregunta'].
				  "AND id_cat_topico=".$_REQUEST['topico'];
				  
	
      $queryud=sprintf($strqueryd,$_REQUEST['pregunta_texto']);
					  
      $result=pg_query($con,$queryud) or die('ERROR AL ACTUALIZAR DATOS EN TABLA cat_pregunta: ' . pg_last_error());

}
/*
if ($_REQUEST[accionat] == 'Guardar' ){
	
	 $query="SELECT max(id_cat_topico) FROM cat_topico";
			
     $registro= pg_query($con,$query);
     $ultimotop= pg_fetch_array($registro);
	 
     if ($ultimotop[0]==NULL)
          $ultimotop[0]=1;
     else 
          $ultimotop[0]=$ultimotop[0]+1;	
		  
	 echo 'ultimo de ejemplar del topico'.$ultimotop[0];	
     $vigencia=1;
		
     $query="INSERT INTO cat_topico (id_cat_topico,nomb_topico,vigencia_actual) VALUES (%d,'%s',%d)";
     $query=sprintf($query,$ultimotop[0],$_REQUEST['nombreTopico'],$vigencia);

     $result=pg_query($con,$query) or die('ERROR AL INSERTAR DATOS en cat_topico' . pg_last_error());	
	 
	 $query="SELECT max(id_validez_top) FROM validez_topico";
			
     $registro= pg_query($con,$query);
     $ultimoval= pg_fetch_array($registro);
	 
     if ($ultimoval[0]==NULL)
          $ultimoval[0]=1;
     else 
          $ultimoval[0]=$ultimoval[0]+1;	
		  
	 echo 'ultimo de ejemplar del topico'.$ultimoval[0];	
	 
	 $query="INSERT INTO validez_topico(id_validez_top,id_cat_topico,fecha_inicio) VALUES(%d,%d,'%s')";
	 $query=sprintf($query,$ultimoval[0],$ultimotop[0],date('Y-m-d'));
     
     $result=pg_query($con,$query) or die('ERROR AL INSERTAR DATOS en cat_topico' . pg_last_error());	
	 
}

$direccion='location: ../view/inicio.html.php?qn=' . $_REQUEST['qn'];
echo $direccion . "</br>";
header($direccion);*/
?>
