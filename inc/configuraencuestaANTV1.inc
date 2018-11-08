<?php 
session_start();
require_once('../clases/usuario.class.php');
require_once('../clases/encuesta.class.php'); 

/*

echo 'El usuario es';
echo $usuario['no_cuenta'];

echo 'los valores en session..';
print_r ($_SESSION);


$usu=new usuario();
$combo=new encuesta();


print_r($_POST);*/

?>
 <div class="panel panel-default">
                        <!-- Default panel contents -->
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <p> </p>
                            </div>

                            <!-- Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>   </th>
                                        <th>   </th>
                                        <th>   </th>
                                    </tr>
                                </thead>
                                <tbody>  
    
<tr>
       <td><div style="text-align:center;"> <?php  echo "<h2>" . $usu->getNombre($_SESSION['no_cuenta']) . "</h2>"; ?></div>  </td>
</tr>

   <tr>
     <td>No Cuenta</td>
     <td><input type="text" name="no_cuenta" id="no_cuenta"size="10" value="<?php  echo $_SESSION['no_cuenta'];?>" disabled="disabled"></td>
     
   </tr>
   
                            </tbody>
                            </table>
     </div>
 <?php  
 
 //$querypract="SELECT * FROM practica_asig WHERE id_asig=".$_SESSION['id_asig'] ."AND nopractica=1";
// echo 'query'. $querypract;
 //$registro = pg_query($con,$querypract);

 //$reg= pg_fetch_array($registro);

 //$_SESSION['id_practica_asig']=$reg[0];
 
$queryinsc="SELECT * FROM inscribe i
JOIN alumno a
ON a.no_cuenta=i.no_cuenta
JOIN asignatura asig
ON asig.id_asig=i.id_asig
JOIN asig_grupo ag
ON i.id_asig=ag.id_asig
AND i.no_grupo=ag.no_grupo
WHERE a.no_cuenta=".$_SESSION['no_cuenta'];

//. "
//AND id_practica_asig=". $_SESSION['id_practica_asig'];

 $inscribe = pg_query($con,$queryinsc);           
   
    while ($inscripcion = pg_fetch_array($inscribe, NULL,PGSQL_ASSOC)) 
		{ 
 ?>
 
   <table  class="table"> 
   <tr>
       <td>Asignatura</td>
       <td><input type="text" name="no_grupo" id="no_grupo"size="40" value="<?php echo $inscripcion['nombre_asig'];?>" disabled="disabled"></td>
       <td>Grupo</td>
       <td><input type="text" name="no_grupo" id="no_grupo"size="5" value="<?php echo $inscripcion['no_grupo'];?>" disabled="disabled" >   </td>
   </tr>
   
   <form action="../inc/contestaEncuesta.inc.php?mod=alu" method="post" name="form_edita" class="formulario" onsubmit="return validaNum(this);" >
    <tr> 
        <td>Práctica</td>
        <td><?php  echo $combo->combopract($inscripcion['id_asig']);?> </td>
        <td>Tipo</td>
        <!--<td align="right" >Tipo</td>-->
        <td><?php  echo $combo->combotipopract($inscripcion['id_tipo']);?> </td>
    
   </tr>  
 
    </table>

<?php 
}
	 
?>
<table class="table">
<tr>
    <td>
        <div style="text-align:center;"><input type="submit" name="accione" value="Contestar" /><div>
    </td>  
  </tr>  
 </form>
  </table>

<input name="id_formato" type="hidden" value="<?php echo $_POST['id_formato']; ?>" />
                 
     

      
                       