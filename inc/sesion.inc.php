<?php 
session_start(); 
//echo "la sesion es: " . $_SESSION['id_usuario'];
if(!isset($_SESSION['no_cuenta'])){
header("Location:../");
}else{
echo'getmod';
echo $_GET['mod'];	
$mod=$_GET['mod'];

$txtheader="Location:../view/inicio.html.php?mod=".$mod;

}

?>