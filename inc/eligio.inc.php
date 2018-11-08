 <?php
   require_once('../conexion.php');
   require_once('../clases/configura.class.php');
   require_once('../inc/encabezado.inc.php'); 
   
   echo'valores anteriores en eligio.inc';
   print_r($_POST);
   echo 'valor del lab ';
   echo $_POST['lab1'];
   echo 'valor de j';
   echo $_POST['j'];
   echo 'valor de preg1 ';
   echo $_POST['id_preg1'];
    echo 'valor de preg2 ';
   echo $_POST['id_preg2'];
   $combo = new configura();
   $querytopico="select * from  cat_topico ct
                 order by id_cat_topico asc";

   $result=  @pg_query($querytopico) or die('Hubo un error con la base de datos en cat_topico');
   
       
   ?>
   
    <!-- Contenido
        ============================================= -->
        <section id="content">
        
 <script language="javascript">
			$(document).ready(function(){
				$("#id_cat_topico").change(function () {
 
					$("#id_cat_topico option:selected").each(function () {
						id_cat_topico = $(this).val();
						$.post("../inc/getPregunta.inc.php", { id_cat_topico: id_cat_topico }, function(data){
							$("#id_preg").html(data);
					
						});            
					});
				})
			});
		
/*
$(document).ready(function(){
				$("#id_asig").change(function () {
 
					$("#id_asig option:selected").each(function () {
						id_asig = $(this).val();
						$.post("../inc/resultados.inc.php", { id_asig: id_asig }, function(data){
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
}   */    
   </script>     
<?php
 /* 
if ($_REQUEST[accionet] == 'Agregar' ){

	?>
	<form action="../inc/guardar.inc.php" method="post" name="form_modifica" class="formulario"  >


      <table  class="formulario">
   
      <tr>
       
          <td >Tópico: </td>
      
          <td><input type="text" name="nombreTopico" id="nombreTopico" size="60"  ></td>
          
      </tr>
  
    </table>
   
    <input type="submit" name="accionat" value="Guardar" />
    <input type="reset" name="accionat"  value="Limpiar" />
	<input type="submit" name="accionat" value="Cancelar" />
  
<?php	
}
if ($_REQUEST[accionep] == 'Agregar' ){

	?>
	<form action="../inc/guardar.inc.php" method="post" name="form_modifica" class="formulario"  >

      <table  class="formulario">
   
      <tr>
         
          <td >Tópico: </td>
      
          <td><?php $combo->comboTopico($_POST['topico'])?></td>
          <td >Pregunta: </td>
          <td >  <?php $combo->comboPregunta($_POST['id_preg'])?></tr>
          <!-- <td><input type="text" name="pregunta_texto" id="pregunta_texto" size="100"  ></td>-->
      </tr>
  
    </table>
   
    <input type="submit" name="accionap" value="Guardar" />
    <input type="reset" name="accionap"  value="Limpiar" />
	<input type="submit" name="accionap" value="Cancelar" />
  
  
<?php	
}
if ($_REQUEST[accionep] == 'Agregar' ){

	?>
	<form action="../inc/guardar.inc.php" method="post" name="form_modifica" class="formulario"  >

      <table  class="formulario">
          <div>
     
         Tópico: 
         <select name="id_cat_topico" id="id_cat_topico" >
          <?php while ($datosc = pg_fetch_array($result)){
		       $numtopico=$numtopico+1;	  
               if($numtopico==1) {$letra='A';}
		       if($numtopico==2) {$letra='B';}
		       if($numtopico==3) {$letra='C';}
		       if($numtopico==4) {$letra='D';}
		       if($numtopico==5) {$letra='E';}
		       if($numtopico==6) {$letra='F';}
		       if($numtopico==7) {$letra='G';}?>
        
               	<option value="<?php echo $datosc['id_cat_topico']; ?>"><?php echo $letra. '. ' .$datosc['nomb_topico']; ?></option>
			<?php } ?>
		 </select>
           </div> 
            <br />
			
			<div> 
            
                   Pregunta: <select name="id_preg" id="id_preg" ></select>
             
            </div>  
            
   
  
    </table>
   
    <input type="submit" name="accionap" value="Guardar" />
    <input type="submit" name="accionap" value="Cancelar" />
  
  </form>
<?php	
}

if ($_REQUEST[accionet] == 'Desactivar' ){
	
	
	    $elige="SELECT * FROM  cat_topico
                 WHERE id_cat_topico=". $_REQUEST['topico'];
				 
         $eligetop=pg_query($con,$elige);   
		  
		 $eligetupla= pg_fetch_array($eligetop);
	
         $updatequery= "UPDATE cat_topico SET vigencia_actual=0 WHERE id_cat_topico=".$eligetupla[0];

         $result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR TABLA cat_topico');

         $query="UPDATE validez_topico SET fecha_final="."'".date('Y-m-d')."'". " WHERE id_cat_topico=".$_REQUEST['topico']; 
		 
         $result=pg_query($con,$query) or die('ERROR AL ACTUALIZAR TABLA validez_topico');


}

if ($_REQUEST[accionep] == 'Desactivar' ){
	echo 'Para DESACTIVAR pregunta';
	
	     $elige="SELECT * FROM  formato
                 WHERE id_preg=". $_REQUEST['pregunta'] .
				 " AND id_lab=".$_SESSION['id_lab'];
				 
          $eligepreg=pg_query($con,$elige);   
		  
		  $eligetupla= pg_fetch_array($eligepreg);
		  
         $updatequery= "UPDATE formato SET vigencia_actual=0 WHERE id_preg=".$eligetupla[0].
		               "AND id_lab=".$_SESSION['id_lab'];

         $result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR TABLA cat_preg');

         $query="UPDATE validez_formato SET fecha_final="."'".date('Y-m-d')."'". " WHERE id_preg=".$_REQUEST['pregunta']; 
		 
         $result=pg_query($con,$query) or die('ERROR AL ACTUALIZAR TABLA validez_formato');

}

if ($_REQUEST[accionet] == 'Modificar' ){

   
		 $elige="SELECT * FROM  cat_topico
                 WHERE id_cat_topico=". $_REQUEST['topico'];
				 
          $eligetop=pg_query($con,$elige);   
		  
		  $eligetupla= pg_fetch_array($eligetop);
		   
   

    $querytopico="SELECT * FROM  cat_topico WHERE  id_cat_topico=". $eligetupla[0];
				 
    $topico=pg_query($con,$querytopico);
    echo 'nombre';
    echo $eligetupla[1];
	
?>

<form action="../inc/guardar.inc.php" method="post" name="form_modifica" class="formulario"  >


      <table  class="formulario">
   
      <tr>
          <td >Tópico: </td>
      
          <td><input type="text" name="nombreTopico" id="nombreTopico"size="60" value="<?php  echo $eligetupla[1];?>" ></td>
         
      </tr>
  
   
    </table>
  
    <input type="submit" name="accionmt" value="Guardar" />
    <input type="reset" name="accionmt"  value="Limpiar" />
	<input type="submit" name="accionmt" value="Cancelar" />
    <input name="topico" type="hidden" value="<?php echo $eligetupla[0]; ?>" />
    
    
  </form>  
	
<?php	
}


if ($_REQUEST[accionep] == 'Modificar' ){

		 $elige="SELECT * FROM  cat_preg
                 WHERE id_preg=". $_REQUEST['pregunta'];
				 
          $eligepreg=pg_query($con,$elige);   
		  
		  $eligetupla= pg_fetch_array($eligepreg);
	
          $querypreg="SELECT * FROM  cat_preg WHERE  id_preg=". $eligetupla[0];
				 
          $pregunta=pg_query($con,$querypreg);
		  
           echo 'nombre';
           echo $eligetupla[1];
?>

<form action="../inc/guardar.inc.php" method="post" name="form_modifica" class="formulario"  >


      <table  class="formulario">
   
      <tr>
          <td >Pregunta: </td>
      
          <td><input type="text" name="pregunta_texto" id="pregunta_texto" size="100" value="<?php  echo $eligetupla[1];?>" ></td>
         
      </tr>
  
   
    </table>
  
    <input type="submit" name="accionmp" value="Guardar" />
    <input type="reset" name="accionmp"  value="Limpiar" />
	<input type="submit" name="accionmp" value="Cancelar" />
    <input name="pregunta" type="hidden" value="<?php echo $eligetupla[0]; ?>" />
    <input name="topico" type="hidden" value="<?php echo $eligetupla[2]; ?>" />
    
  </form>  
*/	
	
//}
?>



<?php require_once('../inc/pie.inc.php'); ?>