<?php

require_once('../conexion.php');
 


 class asignatura{
	function getAsignatura($idlab){

			if ($idlab==NULL||$idlab==0){
			
			$salida="Ninguno"; 
			
			} else {
			
		
			$query="select * from asignatura a
                    join lab_asig la
                    on a.id_asig=la.id_asig
                    where id_lab=" . $idlab;
			
				$result_cot = pg_query($query) or die('Hubo un error con la base de datos con asignatura');
				
				// echo "solicitud a laboratorios.class: "; print_r($_GET);
				 
				while ($datosc = pg_fetch_array($result_cot))
					{
					$salida = $datosc['nombre_asig'];
					//$_SESSION['tipo_lab']=$datosc['tipo_lab'];
					}
				}
			
			return $salida;
	} 
	
	function comboasignatura($idlab){
	//echo'lab'.$idlab;
	$query="select * from asignatura a
            join lab_asig la
            on a.id_asig=la.id_asig
            where id_lab=" .$idlab;

	$result=  @pg_query($query) or die('Hubo un error con la base de datos en asignatura');
	
	$salida='<select name="id_asig"  id="id_asig"> '; 
	 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_lab']==$idlab)
					
						$salida.= "<option value='" . $datosc['id_asig'] . "' selected='selected'>" . $datosc['nombre_asig']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_asig'] . "'>" . $datosc['nombre_asig']. "</option>";
					
					}//Fin del while
	
	$salida.="</select>";
					
	echo $salida;
	
}
	function comboasigrupo($idasig){
	//echo'asig'.$idasig;
	$query="select * from asignatura a
            join asig_grupo ag
            on ag.id_asig=a.id_asig
            where ag.id_asig=" .$idasig;

	$result=  @pg_query($query) or die('Hubo un error con la base de datos en asignatura');
	
		 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_asig']==$idasig)
					
						$salida.= "<option value='" . $datosc['no_grupo'] . "' selected='selected'>" . $datosc['no_grupo']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['no_grupo'] . "'>" . $datosc['no_grupo']. "</option>";
					
					}//Fin del while
	
	$salida.="</select>";
					
	echo $salida;
	
}	
function insertaAlumno($nocuenta){

              // Busca en alumno
			 
		                               $querydatos="SELECT * FROM alumno WHERE 
		                                no_cuenta=".$nocuenta;
					  
		                               $datosalu=  @pg_query($querydatos) or die('Hubo un error con la base de datos en alumno');
           
		                                if (pg_num_rows($datosalu )>0) {
			  
		                                          $updatequery= "UPDATE alumno SET no_cuenta=%d
			                                                   WHERE no_cuenta=".$nocuenta;
							  
			                                      $queryu=sprintf($updatequery, $nocuenta ); 
			   
                                                  $result=@pg_query($queryu) or die('Hubo un error con la base de datos en alumno');
										}else{   
										          $query="SELECT * FROM listado WHERE no_cuenta=".$nocuenta; 
												  
		
		                                          $datos = @pg_query($query) or die('Hubo un error con la base de datos en listado');
												   
                                                  $datosa= pg_fetch_array($datos);
              
	                                              $queryalu="INSERT INTO  alumno(no_cuenta,nombre_alumno,ap_pat_alumno,ap_mat_alumno)
			                                                   VALUES (%d,'%s','%s','%s')";
						   
			                                      $queryalumno=sprintf($queryalu,$nocuenta,$datosa[1],$datosa[2],$datosa[3] );			 
			                                      $registroalumno= @pg_query($queryalumno) or die('Hubo un error con la base de datos en listado');
										}
       
			
	} 
	
function insertaProfesor($nocuenta){

              // Busca en alumno
			                           $query="SELECT * FROM listado WHERE no_cuenta=".$nocuenta; 
										
		                               $datos = @pg_query($query) or die('Hubo un error con la base de datos en listado');
												   
                                       $datosa= pg_fetch_array($datos);
												  
		                               //echo $datosa[4];
									   //echo $datosa[5];
									   //echo $datosa[6];
									   
									   $querydatos="SELECT * FROM profesor WHERE 
		                                nombre_prof="."'".$datosa[4] . 
										"' AND ap_pat_prof="."'".$datosa[5] .
										"' AND ap_mat_prof=" ."'".$datosa[6] ."'";
					  
		                               $datosprof=  @pg_query($querydatos) or die('Hubo un error con la base de datos en profesor1');
           
		                                if (pg_num_rows($datosprof )>0) {
			  
		                                          $updatequery= "UPDATE profesor SET nombre_prof='%s'
			                                                     WHERE  nombre_prof="."'".$datosa[4]."'";
							  
			                                      $queryu=sprintf($updatequery, $datosa[4]); 
			   
                                                  $result=@pg_query($queryu) or die('Hubo un error al actualizar en profesor2');
										}else{   
										          //generar id_prof
												  $queryprof="SELECT max(id_profesor) FROM profesor";
                                                  $registropf= @pg_query($queryprof) or die('Hubo un error con la base de datos en profesor3');
                                                  $ultimo= pg_fetch_array($registropf);
	
		                                          if ($ultimo[0]==0)
				                                          $ultimo=1;
			                                      else 
			                                              $ultimo=$ultimo[0]+1;	  
														 
              
	                                              $queryprof="INSERT INTO  profesor(id_profesor,nombre_prof,ap_pat_prof,ap_mat_prof)
			                                                   VALUES (%d,'%s','%s','%s')";
						   
			                                      $queryprofe=sprintf($queryprof,$ultimo,$datosa[4],$datosa[5],$datosa[6] );			 
			                                      $registroprofe= @pg_query($queryprofe) or die('Hubo un error con la base de datos en listado');
										}
										
	}

	
function insertaAsignatura($nocuenta){

              // Inserta asignatura si existe
			                           $query="SELECT * FROM listado WHERE no_cuenta=".$nocuenta; 
										
		                               $datos = @pg_query($query) or die('Hubo un error con la base de datos en listado');
												   
                                       $datosa= pg_fetch_array($datos);
												  
		                              
									   
									   $querydatos="SELECT * FROM asignatura WHERE 
		                                id_asig=".$datosa[7];
					  
		                               $datosprof=  @pg_query($querydatos) or die('Hubo un error con la base de datos en asignatura');
           
		                                if (pg_num_rows($datosprof )>0) {
			  
		                                          $updatequery= "UPDATE asignatura SET id_asig=%d
			                                                     WHERE  id_asig=".$datosa[7];
							  
			                                      $queryu=sprintf($updatequery, $datosa[7]); 
			   
                                                  $result=@pg_query($queryu) or die('Hubo un error al actualizar en asignatura');
										}else{   
										          //generar id_prof
												  $queryasig="SELECT max(id_asig) FROM asignatura";
                                                  $registroas= @pg_query($queryasig) or die('Hubo un error con la base de datos en asignatura');
                                                  $ultimo= pg_fetch_array($registroas);
												  
												    if ($ultimo[0]==0)
				                                          $ultimo=1;
			                                      else 
			                                              $ultimo=$ultimo[0]+1;	  
	                                              
												 // $depto=1; Obteiene el departamento de la asignatura
												  $querydepto="SELECT * FROM asignatura";
                                                  $registrodepto= @pg_query($querydepto) or die('Hubo un error con la base de datos en asignatura');
                                                  $depto= pg_fetch_array($registrodepto);
												  
		                                        
														 
              
	                                              $queryasig="INSERT INTO  asignatura(id_asig,nombre_asig)
			                                                   VALUES (%d,'%s',%d)";
						   
			                                      $queryasigna=sprintf($queryasig,$ultimo,$datosa[7] );			 
			                                      $registroasigna= @pg_query($queryasigna) or die('Hubo un error con la base de datos en asignatura');
										}
										// inserta datos de asignatura-grupo
									  
									   //obtener semestre
									   
									   	  $querysem="SELECT id_semestre FROM semestre
										              WHERE nombre_sem="."'".$datosa[9]."'";
													  
                                          $registrosem= @pg_query($querysem) or die('Hubo un error con la base de datos en semestre en insertaAsignatura');
                                          $semestre= pg_fetch_array($registrosem);
	
									   
									      $querydatos="SELECT * FROM asig_grupo WHERE 
		                                               id_asig=".$datosa[7].
										              " AND no_grupo=".$datosa[8].
					                                  " AND id_semestre=".$semestre[0];
											//echo $querydatos;		  
										
		                                 $datosgrp=  @pg_query($querydatos) or die('Hubo un error con la base de datos en asig_grupo en insertaAsig');
									   
									      if (pg_num_rows($datosgrp )>0) {
			                                     $updatequery= "UPDATE asig_grupo SET id_asig=%d
			                                                     WHERE  id_asig=".$datosa[7];
							  
			                                      $queryu=sprintf($updatequery, $datosa[7]); 
			   
                                                  $result=@pg_query($queryu) or die('Hubo un error al actualizar en asignatura');
										  }else {
											
											     $queryasig_grupo="INSERT INTO  asig_grupo(id_asig,no_grupo,horaini,horafinal,dia,id_semestre)
			                                             VALUES (%d,%d,'%s','%s',%d,%d)";
						   
			                                      $queryasigrpo=sprintf($queryasig_grupo,$datosa[7],$datosa[8],$datosa[11],$datosa[12],$datosa[13], $semestre[0]);			 
			                                      $registroasigrpo= @pg_query($queryasigrpo) or die('Hubo un error con la base de datos en asig_grupo en Insertaasig');
								
											
											
											
											
                                        }//fin de else
									   
									   // obtiene id_lab 
									     $querylab="SELECT id_lab FROM laboratorio
										              WHERE nombre_lab="."'".$datosa[10]."'";
													  
                                          $registrolab= @pg_query($querysem) or die('Hubo un error con la base de datos laboratorio');
                                          $lab= pg_fetch_array($registrolab);
										  
										 //$datosa[7] es asig
										 // exite id_laby id_asig
										 $querydatos="SELECT * FROM lab_asig WHERE 
		                                               id_asig=".$datosa[7].
										              " AND id_lab=".$lab[0];
					                                 
											//echo $querydatos;		  
										
		                                 $datoslabasig=  @pg_query($querydatos) or die('Hubo un error con la base de datos en lab_asig');
									   
									      if (pg_num_rows($datoslabasig )>0) {
			                                     $updatequery= "UPDATE lab_asig SET id_asig=%d,id_lab=%d
			                                                     WHERE  id_asig=".$datosa[7].
																 " AND id_lab=".$lab[0];
							  
			                                      $queryu=sprintf($updatequery, $datosa[7],$lab[0]); 
			   
                                                  $result=@pg_query($queryu) or die('Hubo un error al actualizar en lab_asig');
										  }else {
											
										          $queryasig="SELECT max(id_lab_asig) FROM lab_asig";
                                                  $registroas= @pg_query($queryasig) or die('Hubo un error con la base de datos en lab_asig');
                                                  $ultimo= pg_fetch_array($registroas);
												  
												    if ($ultimo[0]==0)
				                                          $ultimo=1;
			                                        else 
			                                              $ultimo=$ultimo[0]+1;	  
														  
														   $querylab_asig="INSERT INTO  lab_asig(id_lab_asig,id_lab,id_asig)
			                                             VALUES (%d,%d,%d)";
						   
			                                      $queryasigrpo=sprintf($querylab_asig,$ultimo,$lab[0],$datosa[7]);			 
			                                      $registroasigrpo= @pg_query($queryasigrpo) or die('Hubo un error con la base de datos en lab_asig_grupo en Insertaasig_lab');  
														  
	                                              
										  }//fin del else
	   }//fin función insertaAsignatura
	                                 
									  
function insertaInscribe($nocuenta){

                  
			                           $query="SELECT * FROM listado WHERE no_cuenta=".$nocuenta; 
										
		                               $datos = @pg_query($query) or die('Hubo un error con la base de datos en listado');
												   
                                       $datosa= pg_fetch_array($datos);
												  
		                              // echo $datosa[7];//id_asig
									   
									   //obtener semestre
									   
									   	  $querysem="SELECT id_semestre FROM semestre
										             WHERE nombre_sem="."'".$datosa[9]."'";
													  
                                          $registrosem= @pg_query($querysem) or die('Hubo un error con la base de datos en semestre');
                                          $semestre= pg_fetch_array($registrosem);
									   
									      $querydatos="SELECT * FROM inscribe WHERE 
		                                               no_cuenta=".$datosa[0].
										              " AND id_asig=".$datosa[7].
										              " AND no_grupo=".$datosa[8].
					                                  " AND id_semestre=".$semestre[0];
													  
										  //echo $querydatos;			  
										
		                                   $datosinsc=  @pg_query($querydatos) or die('Hubo un error con la base de datos en INSCRIBE');
										
									      if (pg_num_rows($datosinsc )>0) {
			                                     $updatequery= "UPDATE inscribe SET no_cuenta=%d
			                                                     WHERE  no_cuenta=".$datosa[0];
							  
			                                      $queryu=sprintf($updatequery, $datosa[0]); 
			   
                                                  $result=@pg_query($queryu) or die('Hubo un error al actualizar en inscribe');
										  }else {
											      //buscar al profe
												  
												   $queryprof="SELECT id_profesor FROM profesor WHERE 
		                                            nombre_prof="."'".$datosa[4] . 
										            "' AND ap_pat_prof="."'".$datosa[5] .
										            "' AND ap_mat_prof=" ."'".$datosa[6] ."'";
					                                 
													$registropf= @pg_query($queryprof) or die('Hubo un error con la base de datos en profesor3');
                                                    $prof= pg_fetch_array($registropf);
												  
										          // buscar ultimo folio	
												  
												  $queryinsc="SELECT max(folio_insc) FROM inscribe";
                                                  $registroinsc= @pg_query($queryinsc) or die('Hubo un error con la base de datos en inscribe');
                                                  $ultimo= pg_fetch_array($registroinsc);
	                                              
												  
		                                          if ($ultimo[0]==0)
				                                          $ultimo=1;
			                                      else 
			                                              $ultimo=$ultimo[0]+1;	 
												  
												  
											      $queryinscribe="INSERT INTO  inscribe (folio_insc,no_cuenta,id_profesor,id_asig,no_grupo,id_semestre)
			                                             VALUES (%d,%d,%d,%d,%d,%d)";
						   
			                                      $queryinsc=sprintf($queryinscribe,$ultimo,$datosa[0],$prof[0],$datosa[7],$datosa[8],$semestre[0]);			 
			                                      $registroasigrpo= @pg_query($queryinsc) or die('Hubo un error con la base de datos en inscribe en inserta_inscribe');
								
											  
										  }//fin de else
									   	

     } //fin de función insertaInscribe
 }
 ?>