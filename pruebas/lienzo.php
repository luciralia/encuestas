<!---
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<!doctype html>
<html>
<head>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>


<form  method="POST">
Escribe:
<input type="text" name="busqueda" id="busqueda" value="" placeholder="" maxlength="30" autocomplete="off" onKeyUp="buscar();" />
</form>
<div id="resultadoBusqueda">

<script type="text/javascript">
$(document).ready(function() {
    $("#resultadoBusqueda").html('Jscript Vacio');
});

function buscar() {
    var textoBusqueda = $("input#busqueda").val();
      
     if (textoBusqueda != "") {
		//alert("capturo ");
        $.post("../pruebas/lienzo.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
         }); 
     } else {
		//alert("No ha captado ");
        $("#resultadoBusqueda").html('<p>Vaciooo </p>');
        };
};
</script>

</div> 


</body>
</html>

<?php
//Archivo de conexión a la base de datos
 require_once('../conexion.php');

//Variable de búsqueda
$consultaBusqueda = $_POST['busqueda'];
print_r($_POST);
//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";


//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {

	//Selecciona todo de la tabla mmv001 
	//donde el nombre sea igual a $consultaBusqueda, 
	//o el apellido sea igual a $consultaBusqueda, 
	//o $consultaBusqueda sea igual a nombre + (espacio) + apellido
	
	
	
	$queryt="SELECT * FROM  cat_topico
              WHERE nomb_topico LIKE '%$consultaBusqueda%'";
			echo $queryt;	 
				 
				 
    $registrop = pg_query($con,$queryt);

	//Obtiene la cantidad de filas que hay en la consulta

    $filas= pg_num_rows($registrop); 
	//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
	if ($filas == 0) {
		$mensaje = "<p>No hay ningún dato</p>";
	} else {
		//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
		echo 'Resultados para <strong>'.$consultaBusqueda.'</strong>';
        
		 
		
		
		//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
		 while ($datos = pg_fetch_array($registrop, NULL,PGSQL_ASSOC)) {
			$id = $datos['id_cat_topico'];
			$nombre = $datos['nomb_topico'];
			

			//Output
			$mensaje .= '
			<p>
			<strong>id:</strong> ' . $id . '<br>
			<strong>Nombre:</strong> ' . $nombre . '<br>
			</p>';

		};//Fin while $resultados

	}; //Fin else $filas

};//Fin isset $consultaBusqueda

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;
?>