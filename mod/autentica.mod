<?php
session_start();
require_once('../conexion.php');

require_once('../clases/log.class.php');

$logger=new Log();


$login=$_POST['login'];
$password=$_POST['pwd'];


//consulta Datos del usuario
/*
$query = "SELECT * FROM usuarios 
          WHERE usuario = '" . $login . "' AND  password='" . $password."'";*/
		  
$query = "SELECT * FROM alumno a
          WHERE usuario = '" . $login . "' AND  pass='" . $password."'";
		  
		  		  
$datos=pg_query($con, $query);



//si encuentra coincidencia
$nreng = pg_num_rows($datos);


if ($nreng==1){
	  
$datos=pg_query($con, $query);		  
$usuario = pg_fetch_array($datos, NULL, PGSQL_ASSOC);
foreach ($usuario as $campo => $valor) {
       
	$_SESSION[$campo]=$valor;
		}


/*
//consulta permisos
$query2="Select * from permisos where id_usuario=" . $usuario['id_usuario'];
$datosp=pg_query($con,$query2);

$usuariop = pg_fetch_array($datosp, NULL, PGSQL_ASSOC);
foreach ($usuariop as $campo => $valor) {
$_SESSION['permisos'][$campo]=$valor;
//    echo "\$usuariop[$campo] => $valor.\n" . "</br>";
*/
}



// //////////////////////////////////Graba en el log/////////////////////////////

$logger->putLog(1,1);

/*$strquery="INSERT INTO log (ip,id_user,fecha,modulo,funcion) VALUES ('%s',%d,'%s',%d,%d)";
$queryn=sprintf($strquery,$_SERVER['REMOTE_ADDR'],$_SESSION['id_usuario'],date("Y-m-d H:i:s"),1,1);
echo $queryn;
$result=@pg_query($con,$queryn) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());*/

//$log = pg_fetch_array($result, NULL, PGSQL_ASSOC);
//print_r($log);

///////////////////////////////////////////////////////////////////////////////////////////////


pg_close($con);
$textoheader="location:../view/inicio.html.php?mod=def&log=si&id_usuario=". $usuario['id_usuario'];
echo $textoheader;
header($textoheader);

/*

}else{
   	     
   	     session_destroy();
   	     pg_close($con);
		 $direccion='location:../?log=no&usr='.$login;
	     header($direccion);
   	     
   	     }
*/
/*
