<?php 
session_start();
require_once('../conexion.php');
require_once('../clases/encuesta.class.php'); ?>

<script language="javascript">
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
							       $("#id_asig").html(data);
					
						});   
						     
					});
				})
			});	
			
				
function muestraReporteA(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
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
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","../view/resultados.html.php?asig="+str,true);
  xmlhttp.send();
}


/*function muestraReporteG(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
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
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","../inc/resultados.inc.php?gpo="+str,true);
  xmlhttp.send();
}*/
</script>


<?php 
$combo=new encuesta();
//echo 'valores en configura resultados';
//print_r($_SESSION);

$query="select * from asignatura a
            join lab_asig la
            on a.id_asig=la.id_asig
            where id_lab=" .$_SESSION['id_lab'];


$result=  @pg_query($query) or die('Hubo un error con la base de datos en asignatura');
	

?>


 <div class="panel panel-default">
                        <!-- Default panel contents -->
                            <div class="panel-heading">
                                 <div style="text-align:center;"> <?php  //echo "<h2>" . $usu->getNombre($_SESSION['no_cuenta']) . "</h2>"; ?></div>
                           
       </div>           
  
   
   <form action="../inc/formatoConsulta.inc.php"  method="post" name="form_edita" class="formulario" >
   
   <!-- AGREGAR DIVISION Y DEPARTAMENTOS PARA ELEGIR ASIGNATURA-->
   
   
    <table  class="table"> 
        <tr>
           <td>Asignatura: </td>
           <!-- <select name="id_asig" id="id_asig" onchange="muestraReporteA(this.value)">-->
           <td>
           <select name="id_asig" id="id_asig" >
           <option value="0">Seleccionar Asignatura</option>
           <?php while ($datosc = pg_fetch_array($result)){?>
               	<option value="<?php echo $datosc['id_asig']; ?>"><?php echo $datosc['nombre_asig']; ?></option>
			<?php } ?>
		  </select>
          </td>
          <td>Tipo:</td>
          <td>
             <?php  echo $combo->combotipopract($inscripcion['id_tipo']);?>
          </td>
          <td>Semestre:</td>
          <td>
             <?php  echo $combo->semestre($inscripcion['id_semestre']);?>
          </td> 
         </tr>  
            
           <!-- <div>
           
                   Grupo: <select name="no_grupo" id="no_grupo" onchange="muestraReporteG(this.value)"></select>
             
            </div>  -->
            
        <tr>  
		   <td>	
		      <div style="text-align:center;"><input type="submit" name="accione" value="Enviar" /></div>
           </td>
        </tr>
         </table>
     </form>
   
    
</div>
</div>
 <?php 
//}
?>	 
 