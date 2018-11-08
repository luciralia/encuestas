<?php

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
	//$ipCliente='127.0.0.1';
    //echo 'la ip ctees'.$ipCliente;
	
   // if(substr($ipCliente, 0, -5 ) == "132.245.")
   if(substr($ipCliente, 0, -3 ) == "127.0.")
       return true;
   
    else
    {
       
		 header('location: http://direccion_envio_salida');
         exit;
    }
}

 $valida=restringirRango();

if($valida)
   echo 'Ingresa';
else 
   echo 'lo siento...';   


   

  ?>
  