<?php
session_start();
    require_once('../conexion.php');
   
	require_once('../clases/configura.class.php');


print_r($_SESSION);
echo 'los valores son ';


$checkconf = new configura();

// Restringue al tipo de encuesta
$numtopico=0;
if ($_REQUEST['id_tipo']!=2)
   $querytopico="SELECT * FROM  cat_topico
                 ORDER BY id_cat_topico";
else 
   $querytopico="SELECT * FROM  cat_topico
                 WHERE id_cat_topico!=3 AND id_cat_topico!=7";
				 
$topico=pg_query($con,$querytopico);

?>
  <div class="panel panel-default">
                        <!-- Default panel contents -->
                            <div class="panel-heading">Edita Pregunta</div>
                            <div class="panel-body">
                                <p> Preguntas</p>
                            </div>

                            <!-- Table -->
                            

<table class="table">
                                <thead>
                                    <tr >
                                        
                                    </tr>
                                </thead>
                                <tbody>  

  <form action="../inc/eligio.inc.php" method="post" name="formularioTopico" class="formulario"  >
 
   <?php
  $numpreg=0;
   while ($nomTopico = pg_fetch_array($topico, NULL,PGSQL_ASSOC)) 
		{ ?>
		
   <?php
       $numtopico=$numtopico+1;
       if($_REQUEST['id_tipo']==2){
		  if($nomTopico['id_cat_topico']==3 || $nomTopico['id_cat_topico']==7)
		      $nomTopico['id_cat_topico']=0;
	    }
		if($numtopico==1) {$letra='A';}
		if($numtopico==2) {$letra='B';}
		if($numtopico==3) {$letra='C';}
		if($numtopico==4) {$letra='D';}
		if($numtopico==5) {$letra='E';}
		if($numtopico==6) {$letra='F';}
		if($numtopico==7) {$letra='G';}
		
		$querynum="SELECT * FROM cat_topico ct
                   JOIN  cat_preg cp
                   ON cp.id_cat_topico=ct.id_cat_topico
				   JOIN formato f
                   ON f.id_preg=cp.id_preg
                   WHERE  ct.id_cat_topico=". $nomTopico['id_cat_topico'] .
				  "AND id_lab=" .$_SESSION['id_lab'].
				  "AND f.vigencia_actual=1
				   ORDER BY cp.id_preg" ;
	   
		$datosnum = pg_query($con,$querynum);
        $pregnum= pg_num_rows($datosnum); 
		
		if ($pregnum!=0 ){
		
		?>
        
      
          <!--  <tr ><h3><?php // echo $letra.".  ". $nomTopico['nomb_topico'];?></h3></tr>-->
                          <tr bgcolor="#ccc">
                                        <td align="center"><h4><?php echo  $letra;?></h4></td>
                                        <td align="center"><h4><?php echo $nomTopico['nomb_topico'];?></h4></td>
                                        
                         </tr>
        
	   <?php
	   
		}
	   $querypreg="SELECT * FROM cat_topico ct
                   JOIN  cat_preg cp
                   ON cp.id_cat_topico=ct.id_cat_topico
				   JOIN formato f
                   ON f.id_preg=cp.id_preg
                   WHERE  ct.id_cat_topico=". $nomTopico['id_cat_topico'] .
				  "AND id_lab=" .$_SESSION['id_lab'].
				  "AND f.vigencia_actual=1
				   ORDER BY cp.id_preg" ;
	   
	    $preg = pg_query($con,$querypreg);           
   
        while ($pregunta= pg_fetch_array($preg, NULL,PGSQL_ASSOC)) 
		{ 
					  $numpreg=$numpreg+1;
		 ?>
         
         
              <tr> 
              
                <td align="left"><?php echo  $numpreg;?></td>
                <td align="left"><?php echo  $pregunta['pregunta_texto'];?></td>
                <td align="left "><?php echo $checkconf->radialPregunta($pregunta['id_preg']);?></td>
               <!-- <td > <?php // echo $numpreg.".  ".$pregunta['pregunta_texto'].  $checkconf->radialPregunta($pregunta['id_preg']) ;?> </td>-->
              </tr>
				<?php	 
		 }//preguntas
		}//topicos?>
		
		 </tbody>
       </table>
		        
				
        <input type="submit" name="accionep" value="Agregar" />
        <input type="submit" name="accionep" value="Desactivar" />
       
       
       </form>
  </div>