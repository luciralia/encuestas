<script type="text/javascript">
	 //alert("Ingreso a getGrupo "+id_asig);
	 //console.log(data);
</script>

<?php
require ('../conexion.php');

	
	$idasig = $_POST['id_asig'];
	
	
	 $query="select * from asignatura a
                      join asig_grupo ag
                      on ag.id_asig=a.id_asig
                      where ag.id_asig=".$idasig;
	

	  $result=  @pg_query($query) or die('Hubo un error con la base de datos en asignatura_grupo');
	  

	
	 while ($datosc = pg_fetch_array($result))
	{
		$html.= "<option value='".$datosc['no_grupo']."'>".$datosc['no_grupo']."</option>";
	}
	
	echo $html;
?>