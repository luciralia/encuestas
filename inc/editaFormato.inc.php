<?php
    require_once('../conexion.php');
    require_once('../clases/encuesta.class.php');
	require_once('../clases/configura.class.php');

   $checkconf = new configura();
   
   $combo = new configura();
   
  ?> 
  <form action="../inc/eligio.inc.php" method="post" name="formularioTopico" class="formulario"  >
   
   
       <td>Laboratorio </td>
       <td><?php $combo->comboLab($_SESSION['lab'])?></td>
  <?php
   
   $querytopico="SELECT * FROM  cat_topico
                 ORDER BY id_cat_topico";
				 
   $topico=pg_query($con,$querytopico);
   
   
   
   while ($nomTopico = pg_fetch_array($topico, NULL,PGSQL_ASSOC)) 
		{ 
	
           $numtopico=$numtopico+1;
      
		   if($numtopico==1) {$letra='A';}
		   if($numtopico==2) {$letra='B';}
		   if($numtopico==3) {$letra='C';}
		   if($numtopico==4) {$letra='D';}
		   if($numtopico==5) {$letra='E';}
		   if($numtopico==6) {$letra='F';}
		   if($numtopico==7) {$letra='G';}
	?>
         
         <h3>formatos</h3>
         
                   <h3><?php // echo  $letra. " .  ". $nomTopico['nomb_topico'] . $checkconf->radialtopico($nomTopico['id_cat_topico']) ;?></h3>
           
      <?php          
         
         }// fin de despliega tópico
  
      ?>

      <input type="submit" name="accionef" value="Guardar" />
      <input type="submit" name="accionef" value="Desactivar" />
   
      </form>
  
  