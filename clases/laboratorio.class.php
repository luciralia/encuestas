
<?php
session_start();
require_once('../conexion.php');
 


class laboratorio {


function getResponsable($idresp){

			if ($idresp==NULL||$idresp==0){
			
			$salida=""; 
			
			} else {
			
			$query="Select * from usuarios where id_usuario=" .$idresp;
			
				$result_cot = pg_query($query) or die('Hubo un error con la base de datos en responsable');
			
				while ($datosc = pg_fetch_array($result_cot))
					{
					$salida = $datosc['nombre'] . " " . $datosc['a_paterno'] . " " . $datosc['a_materno'];
					}
				}
			return $salida;
	}
	
	
function getLaboratorio($idlab){

			if ($idlab==NULL||$idlab==0){
			
			$salida="Ninguno"; 
			
			} else {
			
			$query="Select * from laboratorio where id_lab=" . $idlab;
			
				$result_cot = pg_query($query) or die('Hubo un error con la base de datos en lab con id_lab');
				
				// echo "solicitud a laboratorios.class: "; print_r($_GET);
				 
				while ($datosc = pg_fetch_array($result_cot))
					{
					$salida = $datosc['nombre_lab'];
					//$_SESSION['tipo_lab']=$datosc['tipo_lab'];
					}
				}
			
			return $salida;
	}
	
	function comboasignatura($idlab){
	//echo'lab'.$idlab;
	$query="select * from asignatura a
                    join lab_asig la
                    on a.id_asig=la.id_asig
                    where id_lab=" .$idlab. "order by  id_asig asc";

	$result=  @pg_query($query) or die('Hubo un error con la base de datos en asignatura');
	
	$salida='<select name="id_asig"  id="id_asig"> '; 
	 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_lab']==$idlab)
					
						$salida.= "<option value='" . $datosc['id_asig'] . "' selected='selected'>" . $datosc['nombre_asig']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_asig'] . "'>" . $datosc['nombre_asig']. "</option>";
					
					}//Fin del while
	
	$salida.="</select>";
					
	echo $salida;
	
}
	
	
	
						
					
function tblLab($iddep)
	{
		
				$query="SELECT *
                FROM division d
                JOIN departamento dp
                ON d.id_div=dp.id_div
                JOIN laboratorio l
                ON l.id_dep=dp.id_dep
				WHERE l.id_dep=".$iddep;
				
				//echo $query ."</br>". $id_cot . "</br>" . $lab;
					
				//	echo $query;
					$result = pg_query($query) or die('Hubo un error con la base de datos en laboratorio');
					
					      $salida='<form>
						           <table class="table"><tr><th width="20%" >Laboratorio</th><th width="20%" >Seleccionar</th></tr>'; 
						  $j=1;
						  while ($datosc = pg_fetch_array($result, NULL, PGSQL_ASSOC))
						  { 
						       $nombrechk="lab".$j;
					
						       $salida.='<tr><td width="20%" >' . $datosc['nombre_lab'] .'</td><td width="20%" ><input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['id_lab'].'"  /></td></tr>';
							   $j++;  
					    }
				       //	return $salida;
					   $salida.='</table> <input name="j" type="hidden" value="' .$j. '" /></form>';
					   echo $salida;
	}//finmetodo	


						
					
function tblLabSel($iddep)
	{ 
	//  echo 'iddep';
	//	echo $iddep;
				 $query="SELECT *
                          FROM division d
                          JOIN departamento dp
                          ON d.id_div=dp.id_div
                          JOIN laboratorio l
                          ON l.id_dep=dp.id_dep
				          WHERE l.id_dep=".$iddep;
				
				
				            $result = pg_query($query) or die('Hubo un error con la base de datos en laboratorio');
					
					        $salida='<form>
						             <table class="table"><tr><th width="20%" >Seleccionar laboratorio</th></tr><tr><td>'; 
									 
						    $nombreCombo="id_lab1";
							 $salida.='<select   name="'. $nombreCombo .'" id="'. $nombreCombo .'" >
							             <option value="0">Seleccionar Laboratorio</option>'; //value="'. $datosc['id_lab'].'"  />';
						    while ($datosc = pg_fetch_array($result, NULL, PGSQL_ASSOC))
							
						        $salida.= "<option value='".$datosc['id_lab']."'>".$datosc['nombre_lab']."</option>";
						      
						   
				                $salida.="</select>";
					            $salida.='</td></tr></table> <input name="j" type="hidden" value="' .$j. '" />
					    
					          </form>';
					   echo $salida;
	}//finmetodo	

  
 }

?>