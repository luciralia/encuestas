<?php

require_once('../conexion.php');

 

class usuario {


function getNombre($idusuario){
	      

			if ($idusuario==NULL || $idusuario==0){
			
			$salida=""; 
			
			} else {
			
			$query="Select * from alumno where no_cuenta=" .$idusuario;
			
				$result_usu = pg_query($query) or die('Hubo un error con la base de datos en usuario');
			
				while ($datosc = pg_fetch_array($result_usu))
					
					       $salida = $datosc['nombre_alumno'] . " " . $datosc['ap_pat_alumno'] . " " . $datosc['ap_mat_alumno'];
			}
			return $salida;
	}



function getDepto($idusuario){


if ($idusuario==NULL || $idusuario==0){
			
			$salida=""; 
			
			} else {

           $query="SELECT * FROM departamento d
                   JOIN usuarios u
                   ON d.id_dep=u.id_dep
                   WHERE id_usuario=" .$idusuario;
			
		   $result_usu = pg_query($query) or die('Hubo un error con la base de datos en departamento');
			
				  while ($datosc = pg_fetch_array($result_usu))
				
					       $salida = $datosc['nombre_dep'];
					
			}
			return $salida;

	
}
	
function getnomAsig($idasig){
	      

			if ($idasig==NULL || $idasig==0){
			
			$salida=""; 
			
			} else {
			
			$query="Select * from asignatura where id_asig=" .$idasig;
			
				$result_asig = pg_query($query) or die('Hubo un error con la base de datos en usuario');
			
				while ($datosc = pg_fetch_array($result_asig))
					{
						
					       $salida = $datosc['nombre_asig'];
					}
				}
			return $salida;
	}	
	
function comboAsig($idusuario){
	        echo 'el usu es combo...';
	        echo $idusuario;

			if ($idusuario==NULL||$idusuario==0){
			
			$salida=""; 
			
			} else {
			
			$query="select * from inscribe i
                    join alumno a
                    on i.no_cuenta=a.no_cuenta
                    join asignatura asig
                    on asig.id_asig=i.id_asig
                    where i.no_cuenta=" .$idusuario;
					
			$result= pg_query($query) or die('Hubo un error con la base de datos en inscribe');		
			
			$salida='<select name="id_asig"  id="id_asig">';
					            // <option value="0" > </option>'; 
			 while ($datosc = pg_fetch_array($result))
					{
				
			
			if($datosc['no_cuenta']==$idusuario)
					
						$salida.= "<option value='" . $datosc['id_asig'] . "' selected='selected'>" . $datosc['nombre_asig']. "</option>";
					 
					  else 
					
						$salida.= "<option value='" . $datosc['id_asig'] . "'>" . $datosc['nombre_asig']. "</option>";
											  
						
						
					}//Fin del while
					
					
			
			
			
			
				}
			$salida.="</select>";
					
			echo $salida;
			
	}//fin de la función getNombre
	
 }// fin de la clase usuario
?>