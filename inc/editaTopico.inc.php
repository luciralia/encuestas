<?php
    require_once('../conexion.php');
    require_once('../clases/encuesta.class.php');
	require_once('../clases/configura.class.php');
session_start();

   $checkconf = new configura();
 
   $querytopico="SELECT * FROM  cat_topico
                 ORDER BY id_cat_topico";
				 
   $topico=pg_query($con,$querytopico);
   ?>
     <div class="panel panel-default">
                        <!-- Default panel contents -->
                            <div class="panel-heading">Edita Tópico</div>
                            <div class="panel-body">
                                <p> Tópicos</p>
                            </div>

                            <!-- Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><h3>No. Topico</h3></th>
                                        <th><h3>Tópico</h3></th>
                                        <th>      </th>
                                    </tr>
                                </thead>
                                <tbody>  
   
   <?php
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
         <form action="../inc/eligio.inc.php" method="post" name="formularioTopico" class="formulario"  >
         
                   <h3><?php  //echo  $letra. " .  ". $nomTopico['nomb_topico'] . $checkconf->radialtopico($nomTopico['id_cat_topico']) ;?></h3>
                                    <tr >
                                        <td><h4><?php echo  $letra;?></h4></td>
                                        <td><h4><?php echo $nomTopico['nomb_topico'];?></h4></td>
                                        <td><h4><?php $checkconf->radialtopico($nomTopico['id_cat_topico']) ;?></h4></td>
                                    </tr>
           
           
           
      <?php          
         
         }// fin de despliega tópico
  
      ?>

     
                   </tbody>
       </table>
          <div class="line"></div>
       
      <input type="submit" name="accionet" value="Agregar" />
      <input type="submit" name="accionet" value="Desactivar" />
      <input type="submit" name="accionet" value="Modificar" />
      
      </form>
      
      
   
      </div>