
<?php
session_start();
require_once('../conexion.php');
//require_once('../clases/log.class.php');

//$logger=new Log();

function obtenerDireccionIP()
{
    if (!empty($_SERVER ['HTTP_CLIENT_IP'] ))
      $ip=$_SERVER ['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER ['HTTP_X_FORWARDED_FOR'] ))
      $ip=$_SERVER ['HTTP_X_FORWARDED_FOR'];
    else
      $ip=$_SERVER ['REMOTE_ADDR'];
   
    return $ip;
	
}


function restringirRango()
{
    $ipCliente = obtenerDireccionIP();
	
	//$ipCliente='132.245.52.41';
	//$ip='127.0.0.1';
   //echo 'la ip ctees'.$ipCliente;
	
   /* if(substr($ipCliente, 0, -3 ) == "127.0.")
   
       return true;
   
    else
    {
       
		 header('location: http://direccion_envio_salida');
         exit;
    }*/
	if(substr($ipCliente, 0, -3 ) != "127.3.")
    
    {
       //session_destroy();
   	   //pg_close($con);
		//$direccion='location:../registro.php';
	   $direccion='location:../?log=rest';
	   header($direccion);
		// header('location: http://direccion_envio_salida');
         exit;
     }
}

$valida=restringirRango();

print_r($_REQUEST);


$login=$_POST['username'];
$password=$_POST['password'];

$fecha_actual=date("Y-m-d",time());
$hora_actual = date("H:i");
echo 'hora_actual'.$hora_actual;

$dia_semana=date("w");
echo 'dia_semana: ' .$dia_semana .' ';


if(is_numeric($login)) 
       $que="alu";
    else {
       $que="adm";
    }

//validad si es numerico el login es alumno caso contrario es administrador



//$valida=restringirRango();
//if($valida){
//consulta Datos del usuario
//Validando si esta inscrito y la hora de clase.
  		  
/*$query = "SELECT * FROM alumno a
          JOIN inscribe i
		  ON a.no_cuenta=i.no_cuenta
		  JOIN semestre s
		  ON i.id_semestre=s.id_semestre
		  JOIN asig_grupo ag
		  ON ag.id_asig=i.id_asig
		  AND ag.no_grupo=i.no_grupo
          WHERE usuario='" .$login . 
		  "' AND  pass='" . $password ."'".
		  "  AND DATE('" . $fecha_actual. "') BETWEEN fecha_inicio AND fecha_fin
		   AND '".$hora_actual ."' BETWEEN horaini AND horafinal ";
		   validar por numero de dia*/
		   
if ($que=="alu"){		 
$query = 
/*"SELECT * FROM alumno a
          JOIN inscribe i
		  ON a.no_cuenta=i.no_cuenta
		  JOIN semestre s
		  ON i.id_semestre=s.id_semestre
		  JOIN asig_grupo ag
		  ON ag.id_asig=i.id_asig
		  AND ag.no_grupo=i.no_grupo
		  JOIN lab_asig la
		  ON la.id_asig=i.id_asig
		  JOIN formato f
		  ON la.id_lab=f.id_lab
		  LEFT JOIN practica_asig pa
          ON pa.id_asig=i.id_asig
          WHERE a.no_cuenta='" .$login . 
		  "' AND dia=" . $dia_semana .
		  "  AND  pass='" . $password ."'".
		  "  AND DATE('" . $fecha_actual. "') BETWEEN fecha_inicio AND fecha_fin
		  AND '".$hora_actual ."' BETWEEN horaini AND horafinal "
		  */
"SELECT * FROM alumno a
          JOIN inscribe i
		  ON a.no_cuenta=i.no_cuenta
		  JOIN semestre s
		  ON i.id_semestre=s.id_semestre
		  JOIN asig_grupo ag
		  ON ag.id_asig=i.id_asig
		  AND ag.no_grupo=i.no_grupo
		  join lab_asig la
		  ON la.id_asig=i.id_asig
		  join formato f
		  on la.id_lab=f.id_lab
		  left join practica_asig pa
          on pa.id_Asig=i.id_asig
          WHERE a.no_cuenta='" .$login . 
		  "' AND  pass='" . $password ."'"
		  
		  ;
}else{
$query = "SELECT d.id_div,d.id_dep,* FROM usuarios u
          LEFT JOIN laboratorio l
		  ON l.id_usuario=u.id_usuario
          LEFT JOIN departamento D
          ON d.id_dep=u.id_dep
		  LEFT JOIN division div
          ON div.id_div=d.id_div
		  WHERE usuario='" .$login."'";
}
$datos=pg_query($con, $query);

//si encuentra coincidencia
$nreng = pg_num_rows($datos);

echo $query;

//validar que el alumno No haya contestado encuesta para ese día 

if ($nreng>=1){

       $datos=pg_query($con, $query);		  
       $usuario = pg_fetch_array($datos, NULL, PGSQL_ASSOC);
            foreach ($usuario as $campo => $valor) {
                $_SESSION[$campo]=$valor;
	         }

       pg_close($con);
             
       $textoheader="location:../view/inicio.html.php?log=si&folio=".$login."&qn=".$que;
       echo $textoheader;
       header($textoheader);
       }
else  {
   	     
   	   session_destroy();
   	   pg_close($con);
		//$direccion='location:../registro.php';
	   $direccion='location:../?log=no&usr='.$login;
	   header($direccion);
   	     
   	 }
	 
	 

?>