<script type="text/javascript">
	//alert("Ingreso a getLab "+id_dep);
	 //console.log(data);
</script>

<?php
require ('../conexion.php');


	
	 $iddep = $_POST['id_dep'];
	 //echo $_POST['id_dep'];
	 $query="SELECT *
                FROM division d
                JOIN departamento dp
                ON d.id_div=dp.id_div
                JOIN laboratorio l
                ON l.id_dep=dp.id_dep
				WHERE l.id_dep=".$iddep;

	  $result=  @pg_query($query) or die('Hubo un error con la base de datos en laboratorio');
	  
	     $html='  Laboratorios: <select name="id_lab" id="id_lab" > 
	                    <option value="0">Seleccionar Laboratorio</option>';
           

	
	     while ($datosc = pg_fetch_array($result))
	 
		          $html.= "<option value='".$datosc['id_lab']."'>".$datosc['nombre_lab']."</option>";
	
	     $html.=   ' </select>';
	echo $html;
	
?>