<?php
    session_start();
    require_once('../conexion.php');
    require_once('../clases/configura.class.php');
	require_once('../clases/laboratorio.class.php');
	$labs = new laboratorio();
	$checkconf = new configura();
	//echo 'valores de edita Pregunta';
	//print_r($_SESSION);
	//if ($_SESSION ['tipo_usuario']==10||$_SESSION ['tipo_usuario']==9) {

?>
<script type="text/javascript">


			$(document).ready(function(){
				$("#id_div").click(function () {
 
					$("#id_div option:selected").each(function () {
						id_div = $(this).val();
					        $.post("../inc/getDept.inc.php", { id_div: id_div }, function(data){
							$("#id_dep").html(data);
					
						});            
					});
				})
			});
			
		    $(document).ready(function(){
				$("#id_dep").click(function () {
 
					$("#id_dep option:selected").each(function () {
						id_depto = $(this).val();
						      $.post("../inc/muestraLab.inc.php", { id_dep: id_depto }, function(data){
							  $("#muestraLabs").html(data);
					
						});   
						     
					});
				})
			});
	

</script>


      <div class="container"> 
              
                <?php 
				if ($_SESSION['tipo_usuario']==10 ||$_SESSION ['tipo_usuario']==9 ) {$seccion='Departamentos'; ?>
               
                <div class="col_full panel panel-default">
                                  <div class="panel-heading">
					                     <h4 class="panel-title"> <?php echo $seccion;?></h4>
                                  </div> <!--fin div  class="panel-heading">-->
                                   <div class="panel-body">
                                     
                                       <form>
                                       
                                        <table  class="table">
                                        
                                           <tr><td>
                                           
                                        <?php
                                      
                                          $query="SELECT * FROM division
										           WHERE id_div=" .$_SESSION['id_div'];

                                          $result=  @pg_query($query) or die('Hubo un error con la base de datos en division');
?>                                        División:    
                                          <select name="id_div" id="id_div" >
                                          <?php if ($_SESSION['tipo_usuario']==10){ ?>
                                                         <option value="0">Seleccionar División</option>
                                           <?php } ?>
                                                 <?php while ($datosc = pg_fetch_array($result)){?>
               	                                          <option value="<?php echo $datosc['id_div']; ?>"><?php echo $datosc['nombre_div']; ?></option>
			                                      <?php } ?>
		                                  </select>
                                         
                                                 </td>
                                                 
                                                 <td>
                                                 Depto: <select name="id_dep" id="id_dep" >                                                           <option value="0">Seleccionar Depto</option>
                                                
                                                        </select>
                                                 </td>
                                                 
                                                </tr>
                                           </table> 
                                    
                                 <input name="p" type="hidden" value="<?php echo $p; ?>" />
                       </form>
                       
                    </div><!--fin div  class="panel-body">-->
                </div>    <!-- fin de col_full que abarca la cabecera para elegir div/deptos-->
                       
                 
                 
                   <?php } // solo muestra si es jefe de div o departamento ?>
			
             <div class="col_two_third panel panel-default">
             
                    <div class="panel-heading"><h4>Seleccione las preguntas para el laboratorio(s)</h4></div>
              
              
                        <div class="panel-body">
              
                            <form action="../inc/guardar.inc.php" method="post" name="formularioTopico" class="form"  >
                                <table class="table">
                                <thead>
                                    <tr>
                                        
                                    </tr>
                                </thead>
                                <tbody> <!--modifcaciones-->
                           
                                  <div id="muestraPreguntas">
                <?php
				echo '$valorlab en edita preg';
		        echo $_POST['id_lab'];
                 $p=1;
                 $numtopico=0;
                 if ($_REQUEST['id_tipo']!=2)
                 $querytopico="SELECT * FROM  cat_topico
                               ORDER BY id_cat_topico";
                  else 
                 $querytopico="SELECT * FROM  cat_topico
                               WHERE id_cat_topico!=3 AND id_cat_topico!=7";
				 
                  $topico=pg_query($con,$querytopico);
                  $numpreg=0;
                
                  while ($nomtopico = pg_fetch_array($topico, NULL,PGSQL_ASSOC)) 
		          { 
                            $numtopico=$numtopico+1;
                              if($_REQUEST['id_tipo']==2){
		                          if($nomtopico['id_cat_topico']==3 || $nomtopico['id_cat_topico']==7)
		                                 $nomtopico['id_cat_topico']=0;
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
				                          WHERE  ct.id_cat_topico=". $nomtopico['id_cat_topico'] .
				                         " ORDER BY cp.id_preg" ;
				   
	   
		                       $datosnum = pg_query($con,$querynum);
                               $pregnum= pg_num_rows($datosnum); 
		
		                        if ($pregnum!=0 ){?>
        
                           
                                  <tr bgcolor="#ccc">
                                        <td ><h4><?php echo $letra;?></h4></td>
                                        <td ><h4><?php echo $nomtopico['nomb_topico'];?></h4></td>
                                        <td width="15%" align="center" ><h4><?php echo  'Activa';?></h4></td>                      
                                 </tr>
                             
                               <?php
	                            } 
								
	                            $querypreg="SELECT * FROM cat_topico ct
                                            JOIN  cat_preg cp
                                            ON cp.id_cat_topico=ct.id_cat_topico
				                            WHERE  ct.id_cat_topico=". $nomtopico['id_cat_topico'] .
				                            " ORDER BY cp.id_preg" ;
	   
	                              $preg = pg_query($con,$querypreg);           
                                  
                                 while ($pregunta= pg_fetch_array($preg, NULL,PGSQL_ASSOC)) 
		                         { 
					                        $numpreg=$numpreg+1;?>
                                         
        					           <tr> 
              				                  <td ><?php echo  $numpreg;?></td>
                                              <td><?php echo  $pregunta['pregunta_texto'];?></td>
                                              <td width="15%" align="center" ><?php echo $checkconf->checkpregunta($pregunta['id_preg']);?></td>
                                       </tr>
                                     
				                <?php	
				                     $p++;   
		                         }//preguntas
		               }//topicos
				
				     ?>
                 
              
            
       
               
                        <?php 
				
				            if( ($_SESSION['tipo_usuario']==10 || $_SESSION ['tipo_usuario']==9 )){
					 
				                  $seccion='Laboratorios '; ?>
                                  <div class="col_one_third panel panel-default col_last">
                                      <div class="panel-heading">
					                      <h4 class="panel-title"> <?php echo $seccion;?></h4>
                                      </div> <!--<div class="panel-heading">-->
                                      <div class="panel-body">
                                      
                                           <div id="muestraLabs">
                                        
                                   
                                            </div> <!--fin de <div id="muestraLabs">-->
                                        
                                        </div> <!-- panel body--> 
                                         </div> <!-- <div class="col_one_third panel panel-default col_last">-->
                                        <?php } else { $seccion='Laboratorio' ?>
                                        <div class="col_one_third panel panel-default col_last">
                                         <div class="panel-heading">
                                         <h4 class="panel-title"> <?php echo $seccion;?></h4>
                                         </div><!--<div class="panel-heading">-->
                                         <div class="panel-body">
                                         
                                                     <?php  $labs->tblLab($_SESSION['id_lab']);?>
		                                           
                                         </div> <!-- panel body--> 
                                              
                              <?php    }  ?>
                           
                       <tr>  
                           <td colspan="3" align="right">
                             <div style="text-align:center;">  
                                 <input type="submit" name="accionp" value="Guardar" />
                                 <input type="reset" name="accionp"  value="Limpiar" />
	                             <input type="submit" name="accionp" value="Cancelar" />
                             </div> 
                         </td>
                           
                      </tr>
	                      
                          <input name="p" type="hidden" value="<?php echo $p; ?>" />                     </tbody>
                           </table>    
                          
                          </div> <!--modigficamuestra preguntas-->
                          </form>
                       </div> <!-- <div class="col_one_third panel panel-default col_last">-->               
                      
              </div> <!--<div class="col_two_third panel panel-default">-->

   </div>  
 