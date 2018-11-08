<?php
    session_start();
    require_once('../conexion.php');
    require_once('../clases/configura.class.php');
	require_once('../clases/laboratorio.class.php');
	$labs = new laboratorio();
	$checkconf = new configura();
	echo 'valores de sesion';
	print_r($_SESSION);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<!--<table class="tabla"><tr><th>Laboratorio</th><th>Seleccionar</th></tr>
<tr><td>lab1</td><td><input type="checkbox" name="nombrechk1" value="1"  /></td></tr>
<tr><td>lab2</td><td><input type="checkbox" name="nombrechk2" value="2"  /></td></tr>						
</table> <input name="j" type="hidden" value="1" />-->

   <?php 
       $labs->tblLab(1);
    ?>

</body>
</html>
