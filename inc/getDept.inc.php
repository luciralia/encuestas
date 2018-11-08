<script type="text/javascript">
	//alert("Ingreso a getDept "+id_div);
	 //console.log(data);
</script>

<?php
require ('../conexion.php');

	
	 $iddiv = $_POST['id_div'];
	
	 $query="select * from departamento d
                      join division div
                      on d.id_div=div.id_div
                      where div.id_div=".$iddiv;
	// echo $query;
	

	  $result=  @pg_query($query) or die('Hubo un error con la base de datos en departamento');
	  

	
	 while ($datosc = pg_fetch_array($result))

		$html.= "<option value='".$datosc['id_dep']."'>".$datosc['nombre_dep']."</option>";
	
	
	echo $html;
?>