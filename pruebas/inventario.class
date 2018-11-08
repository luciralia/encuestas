<?php
require_once('../conexion.php');
session_start(); 
class Inventario{

function getModo($idmod){

				if ($idmod==NULL||$idmod==0){
				
				$salidam="Ninguno"; 
				
				} else {
				
				$query="Select * from cat_modo_adq where id_mod=" . $idmod;
					
					$result_mod = pg_query($query) or die('Hubo un error con la base de datos');
				
					while ($datosm = pg_fetch_array($result_mod))
						{
						$salidam = $datosm['modo'];
						}
					}
				return $salidam;
			}


function cmbEquipo($idlab,$bnid)
	{
				//	$idlab=$_POST['_id_lab'];
				//        $tipo_req='eq';
				
				//        $id_cot=$necArray[$_POST['_id_nec']]['id_equipo'];
				if ($_SESSION['tipo_lab']!='e')	
				   {$tabla="equipoc";}
				else 
				   {$tabla="equipo";}
				$query="select e.*, l.id_lab, l.nombre, id_dep,bi.*
				from ".$tabla." e, laboratorios l, bienes_inventario bi
				where e.id_lab=l.id_lab
				AND e.bn_id=bi.bn_id
				AND e.id_lab=" . $idlab . " order by bn_desc asc";
				
						//echo $query ."</br>". $id_cot . "</br>" . $lab;
					
				//	echo $query;
					$result = pg_query($query) or die('Hubo un error con la base de datos');
					
					$salida='<select name="bn_id" id="bn_id">'; 
					
					while ($datosc = pg_fetch_array($result))
						{
				
					$sele=($datosc['bn_id']==$bnid)?" selected='selected'":"";
					$salida.= "<option value='" . $datosc['bn_id'] . "'" .$sele. ">" . $datosc['bn_desc'] . " - " . $datosc['bn_clave'] . "</option>";
			
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
	}
	
	
function selectEquipo($desc, $serie, $inv, $marca, $inv_ant){
 		//$where=" WHERE bn_in != NULL";
		
 		if($desc != ''){
 			$array['bn_desc']="bn_desc like '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie like '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave like '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca like '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior like '%".$inv_ant."%'";
 		}
		
		$query = "SELECT * FROM bienes_inventario bi WHERE ".implode(" AND ",$array); //." ORDER BY bn_clave";
		//echo 'Consulta inventario';
		//echo $query;
		
		return $query;
		
 	}
	
function selectEquipoInv($desc, $serie, $inv, $marca, $inv_ant){
 		//$where=" WHERE bn_in != NULL";
		
 		if($desc != ''){
 			$array['bn_desc']="bn_desc like '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie like '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave like '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca like '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior like '%".$inv_ant."%'";
 		}
		
		$query = "SELECT * FROM  
                bienes_inventario bi
                JOIN equipoc ec
                ON bi.bn_id=ec.bn_id
                WHERE " .implode(" AND ",$array);
		//echo 'Consulta inventario';
		//echo $query;
		
		return $query;
		
 	}	
function selectEquipoGen($desc, $serie, $inv, $marca, $inv_ant){
 		//$where=" WHERE bn_in != NULL";
		
 		if($desc != ''){
 			$array['bn_desc']="bn_desc like '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie like '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave like '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca like '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior like '%".$inv_ant."%'";
 		}
		
		$query ="SELECT bi.bn_id,bn_desc,bn_serie,bn_clave,bn_marca,bn_anterior,bn_notas FROM  
                bienes_inventario bi
                LEFT JOIN equipoc ec
                ON bi.bn_id=ec.bn_id
                WHERE " .implode(" AND ",$array) .
				" UNION SELECT bi.bn_id,bn_desc,bn_serie,bn_clave,bn_marca,bn_anterior,bn_notas FROM  
                bienes_inventario bi
                LEFT JOIN equipo e
                ON bi.bn_id=e.bn_id
                WHERE " .implode(" AND ",$array);  
		//echo 'Consulta inventario';
		//echo $query;
		
		return $query;
		
 	}		
	
function getAsig($bnid){
   // echo 'valor de bn_id';
	//echo $bnid;
	// cambiar de acuerdo a la sesion para saber si se va a equipoc o tabla equipo QuITAR FALTA VER LO DEL MENU
	/*      if ($_SESSION['tipo_lab']!='e')	
		     {$tabla="equipoc";}
		  else 
		     {$tabla="equipo";}*/
			 
	  if ($_SESSION['tipo_lab']!='e' && ($_GET['mod']=='invc' || $_GET['mod']=='invg' )  )	
       {$tabla="equipoc";}
       elseif ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='invc' || $_GET['mod']=='invg' ))
             {$tabla="equipoc";}
         else 
             {$tabla="equipo";}
	
	
		$query="select e.*, l.id_lab, l.nombre, id_dep,bi.*
		from " . $tabla . " e, laboratorios l, bienes_inventario bi
		where e.id_lab=l.id_lab
		AND e.bn_id=bi.bn_id
		AND e.bn_id=" . $bnid;
		
		/*$query="select e.*, l.id_lab, l.nombre, id_dep,bi.*
		from " . $tabla . " e
		left join laboratorios l
		on e.id_lab=l.id_lab
		left join  bienes_inventario bi
		on e.bn_id=bi.bn_id
		where e.bn_id=" . $bnid;*/
		
		$result = pg_query($query) or die('Hubo un error con la base de datos en equipo');
		$dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
		 
		if ($dato['nombre']!=''){
			$asignado=$dato['nombre'];		
			
			} else {
			$asignado="Ninguno";
			}
		return $asignado;

					}
					
					
function tblEquipo($idlab)
	{
				//	$idlab=$_POST['_id_lab'];
				//        $tipo_req='eq';
				
				//        $id_cot=$necArray[$_POST['_id_nec']]['id_equipo'];
				if ($_SESSION['tipo_lab']!='e')	
				   {$tabla="equipoc";}
				else 
				   {$tabla="equipo";}
				   		
				$query="select e.*, l.id_lab, l.nombre, id_dep,bi.*
				from ".$tabla." e, laboratorios l, bienes_inventario bi
				where e.id_lab=l.id_lab
				AND e.bn_id=bi.bn_id
				AND e.id_lab=" . $idlab . " order by bn_desc asc";
				
				//echo $query ."</br>". $id_cot . "</br>" . $lab;
					
				//	echo $query;
					$result = pg_query($query) or die('Hubo un error con la base de datos en equipo');
					
					$salida='<table class="equipob"><tr><th>No. Inv</th><th>Equipo</th><th>Seleccionar</th></tr>'; 
					
							
						$j=1;
						while ($datosc = pg_fetch_array($result, NULL, PGSQL_ASSOC))
						{ 
						$nombrechk="equipo".$j;
					
						  $salida.='<tr><td>'. $datosc['bn_clave']. '</td><td>' . $datosc['bn_desc'] .'</td><td><input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['bn_id'].'"  /></td></tr>';
							
							$j++;  
					
						}
				//	return $salida;
					$salida.='</table> <input name="j" type="hidden" value="' .$j. '" />';
					echo $salida;
	}//finmetodo	


function comboTipoInterfaz($tipointerfaz)
					{
                 
				        
				    $query="Select * from  cat_tipo_Interfaz order by idTipoInterfaz desc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_tipo_interfaz');
					
					$salida='<select name="idtinterfaz" id="idtinterfaz">
					         <option value="0" >Ninguna</option>'; 
					
				
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['tipointerfaz']==$tipointerfaz){
					
						$salida.= "<option value='" . $datosc['idtipointerfaz'] . "' selected='selected'>" . $datosc['tipointerfaz']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['idtipointerfaz'] . "'>" . $datosc['tipointerfaz']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo comboTipoInterfaz
	
function comboso($so)
					{
                    
				    $query="Select * from  cat_sistema_operativo order by id_so asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datosen cat_sistema_operativo');
					
					$salida='<select name="idsoper" id="idsoper">
					         <option value="0" >Ninguno</option>'; 
					
				
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['sistemaoperativo']==$so){
					
						$salida.= "<option value='" . $datosc['id_so'] . "' selected='selected'>" . $datosc['sistemaoperativo']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_so'] . "'>" . $datosc['sistemaoperativo']. "</option>";
											  
						}
						
					}//Fin del while
						
				
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	sistema operativo
	
function comboproc($procesador)
					{
                 
				        
				    $query="Select * from  cat_procesador order by idcatproc asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datosen cat_procesador');
					
					$salida='<select name="idcatproc" id="idcatproc">
					         <option value="0" >Ninguno</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['descprocesador']==$procesador){
					
						$salida.= "<option value='" . $datosc['idcatproc'] . "' selected='selected'>" . $datosc['descprocesador']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['idcatproc'] . "'>" . $datosc['descprocesador']. "</option>";
											  
						}
						
					}//Fin del while
						
				
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	procesador	
	
	
function combotipoMemoria($tipomemoria)
					{
                  
				    $query="Select * from  cat_tipo_memoria order by id_tipo_memoria asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_tipo_memoria');
					
					$salida='<select name="idtipomemoria" id="idtipomemoria">
					         <option value="0" >Ninguna</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['tipomemoria']==$tipomemoria){
					
						  $salida.= "<option value='" . $datosc['id_tipo_memoria'] . "' selected='selected'>" . $datosc['tipomemoria']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_tipo_memoria'] . "'>" . $datosc['tipomemoria']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	tipo memoria	
	
function combonumdisco($numerodisco)
					{
                 
				        
				    $query="Select * from  cat_num_disco order by id_num_disco asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_num_disco');
					
					$salida='<select name="idnumdisco" id="idnumdisco">
					         <option value="0" >Ninguno</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['numerodisco']==$numerodisco){
					
						  $salida.= "<option value='" . $datosc['id_num_disco'] . "' selected='selected'>" . $datosc['numerodisco']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_num_disco'] . "'>" . $datosc['numerodisco']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	num disco	
	
function radialtorendimiento($altorend)
{  
	      //$query="Select * from  cat_alto_rendimiento order by id_alto_rendimiento asc";
		 // $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_alto_rendimiento');
		 
         // echo gettype($altorend);
			
//		  while ($datosc = pg_fetch_array($result))		  {

		  if ($altorend == 'Si'){ 

			$auxcheck= ' checked="checked"';	
			//echo "auxcheck: " . $auxcheck . "</br>";
				 
		  } elseif ($altorend == 'No'){ 
		  			
		  $auxcheck2=' checked="checked"';
		  //echo "auxcheck2: " . $auxcheck2. "</br>" ;
		  
		  } else {
			 // echo "no entró:</br>" . "auxcheck: " . $auxcheck . "</br>";
		  //echo "auxcheck2: " . $auxcheck2. "</br>" ;
		  }
		  
		  	  
		  $salida='<label><input type="radio" name="equipoaltorend" value="Si" '. $auxcheck . ">Sí</label>";  
		  $salida.='<label><input type="radio" name="equipoaltorend" value="No" '. $auxcheck2 . ">No</label>";  
		  

		  /*if($datosc['altorendimiento']==$altorend){
			       
				   $salida.= " value='" . $datosc['altorendimiento'] . "' checked=''. checked . '>".$datosc['altorendimiento'];
					 } else { 
					
						  $salida.= " value='" . $datosc['altorendimiento'] . " '>" .$datosc['altorendimiento'] ;
						}*/
			
			echo $salida;
          
  //        }// fin del while

} //fin radial alto Rendimiento

function radialarquitectura($arquitectura)
{         
       
          $query="Select * from  cat_arquitectura order by id_arquitectura asc";
		  
		  $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_arquitectura');
		 
		  while ($datosc = pg_fetch_array($result))
		  {
			        $salida='<input type="radio" name="arquitectura" ';  
		  
		        if($datosc['arquitectura']==$arquitectura){
			        
					$salida.= " value='" . $datosc['arquitectura'] . "' checked=''. checked . '>".$datosc['arquitectura'];
		        } else { 
					
					$salida.= "value='" . $datosc['arquitectura'] . " '>" .$datosc['arquitectura'];
				}
				 
			
		echo $salida;
          
		}
			
} //fin radial arquitectura



function radialservidor($servidor)   
{         
          $query="Select * from  cat_servidor order by id_servidor desc";
		  
		  $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_servidor');
		 
		  while ($datosc = pg_fetch_array($result))
		  {
			       
					$salida='<input type="radio" name="servidor" '; 
					
					if ($datosc['id_servidor']==1){
						$etiqueta='No';
						}
					else {
						$etiqueta='Si';
						}	
		       
		        if($datosc['servidor']==$servidor){
					
					$salida.= " value='" . $etiqueta . "' checked=''. checked . '>".$etiqueta ;
					
		        } else { 
					
					$salida.= " value='" . $etiqueta . "'>" .$etiqueta;
					
				}
				 
			
		echo $salida;
		
		}
			
} //fin radial servidor


function verificaTipoEquipo($bien)
		{
			if($bien=='CPU' || $bien=='SERVIDOR' ||$bien =='TABLET' || $bien =='WORKSTATION' || $bien=='LAPTOP'){
					$salida=1 ;}
			else { $salida=0;}		
					return $salida;
		
		}//fin metodo



} // fin de clase

?>


