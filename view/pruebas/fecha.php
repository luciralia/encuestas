<?php
session_start();
require_once('../conexion.php');

//require_once('../clases/log.class.php');

//$logger=new Log();


$login=$_POST['login'];
$password=$_POST['pwd'];

$fecha_actual=date("Y-m-d",time());


//consulta Datos del usuario

/*$query = "SELECT * FROM alumno a
         
          WHERE usuario='" . $login . "' AND  pass='" . $password."'";*/
	  		  
$query = "SELECT * FROM alumno a
          JOIN inscribe i
		  ON a.no_cuenta=i.no_cuenta
		  JOIN semestre s
		  ON i.id_semestre=s.id_semestre
		  JOIN asig_grupo ag
		  ON ag.id_asig=i.id_asig
		  AND ag.no_grupo=i.no_grupo
          WHERE usuario='" .$login . 
		  "' AND  pass='" . $password ."'";
		  "  AND DATE('" . $fecha_actual. "') BETWEEN fecha_inicio and fecha_fin";

		  		  
$datos=pg_query($con, $query);

echo $query;

//si encuentra coincidencia
$nreng = pg_num_rows($datos);

/*
if ($nreng>=1){
	
	
$datos=pg_query($con, $query);		  
$usuario = pg_fetch_array($datos, NULL, PGSQL_ASSOC);
foreach ($usuario as $campo => $valor) {
       
	$_SESSION[$campo]=$valor;
		}

pg_close($con);
$textoheader="location:../view/inicio.html.php?mod=enc&log=si&id_usuario=". $usuario['no_cuenta'];
echo $textoheader;
header($textoheader);

}
else{
   	     
   	     session_destroy();
   	     pg_close($con);
		 $direccion='location:../?log=no&usr='.$login;
	     header($direccion);
   	     
   	     }

echo 'los valores en session';
print_r ($_SESSION);
*/

?>