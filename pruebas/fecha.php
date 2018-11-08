<?php
session_start();
require_once('../conexion.php');

//require_once('../view/clases/log.class.php');

//$logger=new Log();


$login=$_POST['login'];

$fechaActual = date ('Y-m-d');
 echo 'fecha_actual'.$fechaActual;
 
 $horaactual = date("H:i");
 echo 'hora_actual'.$horaactual;
// Para sumar dos meses
$nuevaFecha = strtotime ( '-15 minutes' , strtotime ( $fechaActual ) ) ;
$dosMesesMas = date ( 'H:i' , $nuevaFecha );

 echo 'Resto 15 minutos'.$dosMesesMas;
  
// Para restar un mes

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
          WHERE usuario='Usuario3'
		  AND  pass='12345'
		  AND DATE('" .$fechaActual. "') BETWEEN fecha_inicio and fecha_fin
		  AND '".$horaactual ."' BETWEEN horaini and horafinal ";

		  		  
$datos=pg_query($con, $query);

echo $query;

//si encuentra coincidencia
$nreng = pg_num_rows($datos);



?>