<?php
    session_start();
    require_once('../conexion.php');
    require_once('../clases/configura.class.php');
	require_once('../clases/laboratorio.class.php');
	$labs = new laboratorio();
	$checkconf = new configura();
	echo 'valores de sesion';
	print_r($_SESSION);
	if ($_SESSION ['tipo_usuario']==10) {
?>


<script language="javascript">
			$(document).ready(function(){
				$("#id_div").change(function () {
 
					$("#id_div option:selected").each(function () {
						id_div = $(this).val();
						    $.post("../inc/getDept.inc.php", { id_div: id_div }, function(data){
							$("#id_dep").html(data);
					
						});            
					});
				})
			});
		
/*
$(document).ready(function(){
				$("#id_dep").change(function () {
 
					$("#id_dep option:selected").each(function () {
						id_dep = $(this).val();
						    $.post("../inc/getLab.inc.php", { id_dep: id_dep }, function(data){
							$("#id_lab").html(data);
					
						});            
					});
				})
			});*/
function muestraLab(str) {
  if (str=="") {
    document.getElementById("id_dep").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("id_dep").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","../inc/editaPregunta.inc.php?dep="+str,true);
  xmlhttp.send();
}
</script>

<?php }

?>
    <div class="container">
    <div class="col_two_third panel panel-default">
              <div class="panel-heading"><h4>Preguntas</h4></div>
              <div class="panel-body">

               <form action="../inc/guardar.inc.php" method="post" name="formularioTopico" class="form"  >

               <table  class="table">

                <?php
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
                                        <td ><h4><?php echo  $letra;?></h4></td>
                                        <td ><h4><?php echo $nomtopico['nomb_topico'];?></h4></td>
                                        <td width="20%" >   </td>                      
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
                                              <td width="20%" align="center" ><?php echo $checkconf->checkpregunta($pregunta['id_preg']);?></td>
                                       </tr>
				                <?php	
				                     $p++;   
		                         }//preguntas
		               }//topicos?>
	                   <br/>
 <br/>             
                      <tr>  
                          
                            <td colspan="3" align="right">
                            <div style="text-align:center;">  
                                 <input type="submit" name="accionp" value="Guardar" />
                                 <input type="reset" name="accionp"  value="Limpiar" />
	                             <input type="submit" name="accionp" value="Cancelar" />
                            </div> 
                            </td>
                           
                      </tr>
	
                    </table>

               </div>
         </div>

         <div class="col_one_third panel panel-default col_last">
                <div class="panel-heading">
                <?php if ($_SESSION['tipo_usuario']==10  ) {$seccion='Departamentos'; ?>
					              <h4 class="panel-title"> <?php echo $seccion;?></h4>
                                  </div>
                                   <div class="panel-body">
                                     <p>
                                     <?php
                                      
                                          $query="select * from division";

$result=  @pg_query($query) or die('Hubo un error con la base de datos en division');
?>                                        División    
                                          <select name="id_div" id="id_div" >
                                           <option value="0">Seleccionar División</option>
                                                 <?php while ($datosc = pg_fetch_array($result)){?>
               	                                          <option value="<?php echo $datosc['id_div']; ?>"><?php echo $datosc['nombre_div']; ?></option>
			                                      <?php } ?>
		                                  </select>
                                                 Depto: <select name="id_dep" id="id_dep" onchange="muestraLab(this.value)" >
                                                            <option value="0">Seleccionar Depto</option>
                                                        </select>
                                                        
                                                    <?php if (isset($_GET['dep'])){
														$labs->tblLab($_GET['dep']);
													}?>
                                                   <?php  //echo $_GET['dep'];?>
                                                  </div>
                                                  <div class="panel-body">
                                                  <p>
                                                  
		                             </p>
                                 <input name="p" type="hidden" value="<?php echo $p; ?>" />
                   </form>
                 </div>
               
                       <?php }else { $seccion='Laboratorios' ?>
                                  <h4 class="panel-title"> <?php echo $seccion;   ?></h4>
                                  </div>
                                   <div class="panel-body">
                                     <p>
	                                         <?php  $labs->tblLab($_SESSION['id_lab']);?>
		                             </p>
                                 <input name="p" type="hidden" value="<?php echo $p; ?>" />
                   </form>
                 </div>
                       <?php } ?>
                 
       </div>


</div>
