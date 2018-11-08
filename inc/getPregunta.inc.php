<script type="text/javascript">
	 alert("Ingreso a getpregunta "+id_topico);
	 //console.log(data);
</script>

<?php
require ('../conexion.php');

	
	 $idtopico = $_POST['id_cat_topico'];
	
	 $query="select * from cat_preg a
             where id_cat_topico=".$idtopico;
	
	 $result=  @pg_query($query) or die('Hubo un error con la base de datos en cat_preg');
	  

	 while ($datosc = pg_fetch_array($result))
	{
		$html.= "<option value='".$datosc['id_preg']."'>" .$datosc['id_preg']. '. ' .$datosc['pregunta_texto']."</option>";
	}
	
	echo $html;
?>