<?php
    session_start();
    require_once('../conexion.php');
    require_once('../clases/configura.class.php');
	require_once('../clases/laboratorio.class.php');
	$labs = new laboratorio();
	$checkconf = new configura();
?>
<!--<script language="javascript" src="../js/jquery-1.2.6.min.js"></script>-->
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
						
								$.post("../inc/getLab.inc.php", { id_dep: id_depto }, function(data){
							       $("#id_lab").html(data);
					
						});   
						     
					});
				})
			});
			
		    $(document).ready(function(){
				$("#id_lab").change(function () {
                     $("#id_lab option:selected").each(function () {
						id_labo = $(this).val();
						//alert("Ingreso a getLab "+id_labo);
						       $.post("../inc/cargaPreg.inc.php", { id_lab: id_labo }, function(data){
							       $("#muestraPreguntas").html(data);
					
						});   
						     
					});
				})
			});


              $(document).ready(function(){
				$("#id_lab1").click(function () {
                     $("#id_lab1 option:selected").each(function () {
						id_labo1 = $(this).val();
						// alert("Ingreso a getLab1 "+id_labo1);
						       $.post("../inc/cargaPreg.inc.php", { id_lab: id_labo1 }, function(data){
							       $("#muestraPreguntas").html(data);
					
						});   
						     
					});
				})
			});
</script>

<?php
		  

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
                                                    Depto: <select name="id_dep" id="id_dep" >                                                                <option value="0">Seleccionar Depto</option>
                                                            </select>
                                                      
                                                     </td>
                                             </tr>
                                           </table> 
                                      
                                 <input name="p" type="hidden" value="<?php echo $p; ?>" />
                       </form>
                    </div><!--fin div  class="panel-body">-->
                 </div>    <!-- fin de col_full que abarca la cabecera para elegir div/deptos-->
                 <?php }// solo muestra si es jefe de div o departamento ?>

              <div class="col_two_third panel panel-default">

                        <!-- Default panel contents -->
                            <div class="panel-heading"> <h3>Preguntas para el laboratorio</h3></div>
                            <div class="panel-body">
                               
                       
                              <table class="table">
                                <thead>
                                    <tr>
                                        
                                    </tr>
                                </thead>
                                <tbody>  
                                     <div id="muestraPreguntas">
  
                                    
   <?php
   // if (isset($_SESSION['id_lab'])){
		//echo '$valorlab';
		//echo $_POST['id_lab'];
		if (isset($_POST['id_lab'])){
        $numpreg=0;
        while ($nomTopico = pg_fetch_array($topico, NULL,PGSQL_ASSOC)) { ?>
		
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
		?>
        
                          <tr bgcolor="#ccc">
                                        <td ><h4><?php echo  $letra;?></h4></td>
                                        <td ><h4><?php echo $nomTopico['nomb_topico'];?></h4></td>
                                        
                         </tr>
        
	   <?php
	  
	   $querypreg="SELECT * FROM cat_topico ct
                   JOIN  cat_preg cp
                   ON cp.id_cat_topico=ct.id_cat_topico
				   JOIN formato f
                   ON f.id_preg=cp.id_preg
                   WHERE  ct.id_cat_topico=". $nomTopico['id_cat_topico'] .
				  "AND id_lab=" .$_POST['id_lab'].
				  " AND f.vigencia_actual=1
				   ORDER BY cp.id_preg" ;
	   
	    $preg = pg_query($con,$querypreg);           
	  
         while ($pregunta= pg_fetch_array($preg, NULL,PGSQL_ASSOC)) 
		 { 
					  $numpreg=$numpreg+1;
		 ?>
         
         
              <tr> 
                <td align="left"><?php echo  $numpreg;?></td>
                <td align="left"><?php echo  $pregunta['pregunta_texto'];?></td>
              </tr>
				<?php	 
		  }//preguntas
		}//topicos ?>
	   <?php  } // fin del if isset?> 
		 </tbody>
       </table>
       
		</div> <!--muestrapreg-->
       
       </div>  <!--<div class="panel-body">-->      
    
		 <div class="col_one_third panel panel-default col_last">
                <div class="panel-heading">
                          <?php 
				
				            if( ($_SESSION['tipo_usuario']==10 || $_SESSION ['tipo_usuario']==9 )){
					 
				                  $seccion='Laboratorios '; ?>
                
					              <h4 class="panel-title"> <?php echo $seccion;?></h4>
                                  </div> <!--<div class="panel-heading">-->
                                   <div class="panel-body">
                                      
                                          <div id="id_lab">
                                           Laboratorios: <select name="id_lab" id="id_lab" > 
	                                                          <option value="0">Seleccionar Laboratorio</option>;
                                                         </select>
                                          
                                     
                                           <?php } else { $seccion='Laboratorio' ?>
                                             <h4 class="panel-title"> <?php echo $seccion;   ?></h4>
                                             </div><!--<div class="panel-heading">-->
                                                <div class="panel-body">
                                                   <div id="id_lab1">
                                                      <p>
	                                                      <?php  $labs->tblLabSel($_SESSION['id_dep']);?>
		                                              </p>
                                              
                                                </div> <!--id_lab/id-lab-->
                                  </div>  <!--panel body-->
                              <?php    }  ?>
                           
    
                        
                          <!-- </table> -->
                           
                        
                           
                            </div> <!--fin de <div id="muestraLabsCheck">-->
                         </div> <!--div panel body ers del otra seccion-->
                 </div> <!-- <div class="col_one_third panel panel-default col_last">-->                                    
        </div> <!--<div class="col_two_third panel panel-default">-->
