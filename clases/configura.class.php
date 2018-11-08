
<?php
session_start(); 
require_once('../conexion.php');

class configura{

function radialtopico($idTopico){
	
         $salida='<label><input type="radio"  name="topico" value="'.$idTopico.'" '. $auxcheck . "> </label>";  

echo $salida; 
}

function radialPregunta($idPregunta){
  
		  $salida='<label><input type="radio"  name="pregunta" value="'.$idPregunta.'" '. $auxcheck . "> </label>";  

echo $salida; 
}

function comboTopico($idTopico)
{
       $query="SELECT * FROM cat_topico ORDER BY id_cat_topico ASC";
       $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_topico');
			$salida='<select name="id_cat_topico" id="id_cat_topico">';
					        // <option value="0" > </option>'; 
					
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_cat_topico']==$idTopico){
					
						$salida.= "<option value='" . $datosc['id_cat_topico'] . "' selected='selected'>" . $datosc['id_cat_topico'].$datosc['nomb_topico']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_cat_topico'] . "'>" .$datosc['id_cat_topico']. $datosc['nomb_topico']. "</option>";
											  
						}
						
					}//Fin del while
						
				
					$salida.="</select>";
					
					echo $salida;
}
function comboPregunta($idpreg)
{
       $query="SELECT * FROM cat_preg ORDER BY id_preg ASC";
       $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_preg');
			$salida='<select name="id_preg" id="id_preg">';
					        // <option value="0" > </option>'; 
					
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_preg']==$idpreg){
					
						$salida.= "<option value='" . $datosc['id_preg'] . "' selected='selected'>" . $datosc['id_preg'].$datosc['pregunta_texto']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_preg'] . "'>" .$datosc['id_preg']. $datosc['pregunta_texto']. "</option>";
											  
						}
						
					}//Fin del while
						
				
					$salida.="</select>";
					
					echo $salida;
}

function checktopico($idTopico)
{        
        echo 'topi';
		echo $idTopico;
		
         
		 $query="Select * from  cat_topico where id_cat_topico=".$idTopico;
		 $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_preg');
     	 $datosc= pg_fetch_array($result);
	     
         $salida='<label><input type="checkbox"  name="'.$idTopico.'"'; 
         
		 $salida.='value="'.$idTopico.'"></label>'; 
		 
	
		
		 echo  $salida;
		
}

function comboLab($idlab)
{
       $query="SELECT * FROM laboratorio ORDER BY id_lab ASC";
       $result = @pg_query($query) or die('Hubo un error con la base de datos en laboratorio');
			$salida='<select name="id_lab" id="id_lab">';
					        // <option value="0" > </option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_lab']==$idlab){
					
						$salida.= "<option value='" . $datosc['id_lab'] . "' selected='selected'>" . $datosc['nombre_lab']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_lab'] . "'>" . $datosc['nombre_lab']. "</option>";
											  
						}
						
					}//Fin del while
						
				
					$salida.="</select>";
					
					echo $salida;
					
}


function checkpregunta($idpreg)

{       $name='id_preg';
        $query="Select * from  cat_preg where id_preg=".$idpreg;
		 $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_preg');
     	 $datosc= pg_fetch_array($result);
		 
		    $salida='<input type="checkbox" name="'.$name.$idpreg.'" value="'.$datosc['id_preg'].'"/>';  
		 
			echo $salida;  

}

}