
<?php
require_once('../conexion.php');

class encuesta{

function combopract($idasig){
	//echo'asig'.$idasig;
	$query="Select * from  practica_asig
	where id_asig=" .$idasig. "order by  nopractica asc";

	$result=  @pg_query($query) or die('Hubo un error con la base de datos en practica_asig');
	
	$salida='<select name="id_practica_asig"  id="id_practica_asig"   > '; 
	 while ($datosc = pg_fetch_array($result))
					{
					   if($datosc['id_asig']==$idasig)
					
						$salida.= "<option value='" . $datosc['id_practica_asig'] . "' selected='selected'>".  $datosc['nopractica'] . '. '. $datosc['nomb_practica']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_practica_asig'] . "'>" . $datosc['nopractica']. '.  '. $datosc['nomb_practica']. "</option>";
					
					}//Fin del while
	
	$salida.="</select>";
					
	echo $salida;
	
}

function nomPrac($idpracasig){
	
	//echo $idpracasig;
	if ($idpracasig==NULL || $idpracasig==0){
			$salida=""; 
			
			} else {
		
	$query="select * from practica_asig pa
            JOIN asignatura a
            on a.id_asig=pa.id_asig
	        WHERE id_practica_asig=" .$idpracasig;

	
				$result = pg_query($query) or die('Hubo un error con la base de datos en practicaasig');
			
				while ($datosc = pg_fetch_array($result))
					{
						
					       $salida = $datosc['nomb_practica'];
						   
					}
				}
			
			return $salida;
	}



function combotipopract($tipopract){
					
				    $query="Select * from  encuesta_tipo order by id_tipo";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en encuesta_tipo');
					$cambio='myFunctionPractica()" ';
					$salida='<select name="id_tipo"  id="id_tipo"  onChange="'. $cambio . '>';
					            
					while ($datosc = pg_fetch_array($result)){
						
					if($datosc['id_tipo']==$tipopract)
					
						$salida.= "<option value='" . $datosc['id_tipo'] . "' selected='selected'>" . $datosc['tipo']. "</option>";
					 
					 else
						$salida.= "<option value='" . $datosc['id_tipo'] . "'>" . $datosc['tipo']. "</option>";
			
					} // fin del while 
					echo $salida;
}//fin del combotipopract


function semestre($idsem){
					
				    $query="Select * from  semestre order by id_semestre";
				    
					$result = @pg_query($query) or die('Hubo un error con la base de datos en semestre');
				
					$salida='<select name="id_semestre"  id="id_semestre" >';
					            
					while ($datosc = pg_fetch_array($result)){
						
					if($datosc['id_semestre']==$idsem)
					
						$salida.= "<option value='" . $datosc['id_semestre'] . "' selected='selected'>" . $datosc['nombre_sem']. "</option>";
					 
					 else
						$salida.= "<option value='" . $datosc['id_semestre'] . "'>" . $datosc['nombre_sem']. "</option>";
			
					} // fin del while 
					echo $salida;
}//fin del combotipopract



function combopreg($calif,$nopreg)
					{
					
				    $query="Select * from  cat_calif_resp order by id_cat_calif asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_calif_resp');
					//$salida='<select name="id_cat_resp"  id="id_cat_resp">
					          //   <option value="0" > </option>'; 
					if($nopreg==1){
					    $salida='<select name="id_cat_calif1"  id="id_cat_calif1">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
					
					
					}//Fin del while
					
					}
					if($nopreg==2){
					    $salida='<select name="id_cat_calif2"  id="id_cat_calif2">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
						
					
					}//Fin del while
					}
					if($nopreg==3){
					    $salida='<select name="id_cat_calif3"  id="id_cat_calif3">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
						
					
					}//Fin del while
					
					}
					
					if($nopreg==4){
					    $salida='<select name="id_cat_calif4"  id="id_cat_calif4">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
						
					
					}//Fin del while
					
					}
					if($nopreg==5){
					    $salida='<select name="id_cat_calif5"  id="id_cat_calif5">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
						
					
					}//Fin del while
					
					}
					if($nopreg==6){
					    $salida='<select name="id_cat_calif6"  id="id_cat_calif6">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
						
					
					}//Fin del while
					
					}
					
					if($nopreg==7){
					    $salida='<select name="id_cat_calif7"  id="id_cat_calif7">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
					
					}//Fin del while
					
					}
					if($nopreg==8){
					    $salida='<select name="id_cat_calif8"  id="id_cat_calif8">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
						
					
					}//Fin del while
					
					}
					if($nopreg==9){
					    $salida='<select name="id_cat_calif9"  id="id_cat_calif9">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
						
					
					}//Fin del while
					
					}
					if($nopreg==10){
					    $salida='<select name="id_cat_calif10"  id="id_cat_calif10">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
						
					
					}//Fin del while
					
					}
					if($nopreg==11){
					    $salida='<select name="id_cat_calif11"  id="id_cat_calif11">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 else 
					 
					    $salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
					
					
					}//Fin del while
					
					}
					if($nopreg==12){
					    $salida='<select name="id_cat_calif12"  id="id_cat_calif12">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
						
					
					}//Fin del while
					
					}
					if($nopreg==13){
					    $salida='<select name="id_cat_calif13"  id="id_cat_calif13">
					             <option value="0" > </option>'; 
								 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['calif']==$calif)
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "' selected='selected'>" . $datosc['descrip_calif']. "</option>";
					 
					 else 
					
						$salida.= "<option value='" . $datosc['id_cat_calif'] . "'>" . $datosc['descrip_calif']. "</option>";
											  
						
					
					}//Fin del while
					
					}
					$salida.="required </select>";
					
					echo $salida;
}// fin del combo preg
					

					
 

function radialpreg($resp,$nopreg)
{  
	     
       if ($nopreg==14){
		  if ($resp == 'Si') 
              $auxcheck= ' checked="checked"';	
		  elseif ($resp == 'No')
		  	 $auxcheck2=' checked="checked"';
		  else {
			 
		  }
		  
		  $salida='<label><input type="radio"  required name="resp_bool14" value="1" '. $auxcheck .  ">Si  </label>";  
		  $salida.='<label><input type="radio" required name="resp_bool14" value="0" '. $auxcheck2 . ">No  </label>";  
	   } //fin de preg 14
if ($nopreg==15){
		  if ($resp == 'Si') 
              $auxcheck= ' checked="checked"';	
		  elseif ($resp == 'No')
		  	 $auxcheck2=' checked="checked"';
		  else {
			 
		  }
		  
		  $salida='<label><input type="radio" required name="resp_bool15" value="1" '. $auxcheck . ">Si  </label>";  
		  $salida.='<label><input type="radio" required name="resp_bool15" value="0" '. $auxcheck2 . ">No  </label>";  
	   } //fin de preg 15
			
     if ($nopreg==16){
		  if ($resp == 'Si') 
              $auxcheck= ' checked="checked"';	
		  elseif ($resp == 'No')
		  	 $auxcheck2=' checked="checked"';
		  else {
			 
		  }
		  
		  $salida='<label><input type="radio" required name="resp_bool16" value="1" '. $auxcheck . ">Si  </label>";  
		  $salida.='<label><input type="radio" required name="resp_bool16" value="0" '. $auxcheck2 . ">No  </label>";  
	   } //fin de preg 15
			    
     if ($nopreg==17){
		  if ($resp == 'Si') 
              $auxcheck= ' checked="checked"';	
		  elseif ($resp == 'No')
		  	 $auxcheck2=' checked="checked"';
		  else {
			 
		  }
		  
		  $salida='<label><input type="radio" required name="resp_bool17" value="1" '. $auxcheck . ">Si </label>";  
		  $salida.='<label><input type="radio" required name="resp_bool17" value="0" 
		  '. $auxcheck2 . ">No  </label>";  
	   } //fin de preg 15
			echo $salida;    

} //fin radial preg



function checkpregunta($idpreg)

{       $name='id_preg';
        $query="Select * from  cat_preg where id_preg=".$idpreg;
		 $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_preg');
     	 $datosc= pg_fetch_array($result);
		    $salida='<input type="checkbox" name="'.$idpreg.'" value="'.$datosc['id_lab'].'"/>';  
		 
			echo $salida;  

}

}
?>

