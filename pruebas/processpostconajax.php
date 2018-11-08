<?php 

if (isset($_POST))
{
echo "Tu email es: ";
echo $_POST["email"];
echo "<br>";
echo "Tu contraseña es: ";
echo $_POST["password"];
}
?>