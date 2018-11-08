
<?php

    //Obtiene la IP del cliente
   
	    echo 'la ip del servidor' .$_SERVER["REMOTE_ADDR"];
       
   
	   echo 'la ip del cte'.$_SERVER['HTTP_CLIENT_IP'];
	
	  echo 'por un proxi'.$_SERVER['HTTP_X_FORWARDED_FOR'];
	
	
	
	if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        echo'1', $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        echo'2', $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        echo'3', $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        echo'4',  $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        echo'5',  $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        echo'6',  $_SERVER["REMOTE_ADDR"];
    }
	
	
  



?>
