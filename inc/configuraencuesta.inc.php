<script language="javascript">
/*
  function valida(){ 
    if (confirm('Se ha contestado')){ 
       document.confEncuesta.submit(); 
    } 

}*/
</script>

<?php 
session_start();
require_once('../conexion.php');
require_once('../clases/usuario.class.php');
require_once('../clases/encuesta.class.php'); 


$usu=new usuario();
$combo=new encuesta();


?>
<div class="container">
      <div class="panel panel-default">
                        <!-- Default panel contents -->
                <div class="panel-heading">
                         <div style="text-align:center;"> <?php  echo "<h2>" . $usu->getNombre($_SESSION['no_cuenta']) . "</h2>"; ?></div>
               </div>
                            
       </div>


   <!-- Table -->
                            
 <?php  
 
 
$fecha_actual=date("Y-m-d",time());
$hora_actual = date("H:i");

$dia_semana=date("w");
echo 'dia_semana: ' .$dia_semana .' ';
//echo 'hora_actual'.$hora_actual;


$queryinsc="SELECT * FROM inscribe i
JOIN alumno a
ON a.no_cuenta=i.no_cuenta
JOIN asignatura asig
ON asig.id_asig=i.id_asig
JOIN asig_grupo ag
ON i.id_asig=ag.id_asig
AND i.no_grupo=ag.no_grupo
WHERE a.no_cuenta= ".$_SESSION['no_cuenta'] ;

  
/*
$queryinsc="SELECT * FROM alumno a
          JOIN inscribe i
		  ON a.no_cuenta=i.no_cuenta
		  JOIN semestre s
		  ON i.id_semestre=s.id_semestre
		  JOIN asig_grupo ag
		  ON ag.id_asig=i.id_asig
		  AND ag.no_grupo=i.no_grupo
		  JOIN asignatura asig
          ON asig.id_asig=i.id_asig
          WHERE a.no_cuenta=" .$_SESSION['no_cuenta'] .  
		  " AND dia=" . $dia_semana .
		  "  AND DATE('" . $fecha_actual. "') BETWEEN fecha_inicio AND fecha_fin
		   AND '".$hora_actual ."' BETWEEN horaini AND horafinal ";

*/

 $inscribe = pg_query($con,$queryinsc);           
   
    while ($inscripcion = pg_fetch_array($inscribe, NULL,PGSQL_ASSOC)) 
		{ 
 ?>
 
      <table  class="table"> 
      <tr>
         <td>Asignatura</td>
         <td><input type="text" name="id_asig" id="id_asig"size="40" value="<?php echo $inscripcion['nombre_asig'];?>" disabled="disabled"></td>
       <td>Grupo</td>
       <td><input type="text" name="no_grupo" id="no_grupo"size="5" value="<?php echo $inscripcion['no_grupo'];?>" disabled="disabled" >   </td>
   </tr>
    
   <form action="../inc/contestaEncuesta.inc.php?mod=alu" method="post" name="confEncuesta" class="formulario" >
  
   
    <tr> 
        
        <td>Tipo</td>
        <td><?php  echo $combo->combotipopract($inscripcion['id_tipo']);?> </td>
       <script>
    function myFunctionPractica() {
		  var x = document.getElementById("id_tipo").value;
		  //alert("seleccionaste "+x);
		 
          if (document.getElementById("id_tipo").value==1){
		       document.getElementById("id_practica_asig").disabled = false; // habilitar
		 
		  }
		  else{
			  document.getElementById("id_practica_asig").disabled = true; // deshabilitar
		
	      }
	 }
</script> 
        <td>Práctica</td>
        <td><?php  echo $combo->combopract($inscripcion['id_asig']);?> </td>
    </tr>  
 </table>

<?php 

}
?>

<table class="table">
  <tr>
      <td>
      <br/>
       <br/>
         <div style="text-align:center;"><input type="submit" name="accione" value="Contestar" /><div> 
        <!--  <div style="text-align:center;"><input type=button onclick="valida()" name="accione" value="Contestar" /><div>-->
      </td>  
  </tr>  
 </form>
</table>

<input name="id_formato" type="hidden" value="<?php echo $_POST['id_formato']; ?>" />
     
</div>
      
           