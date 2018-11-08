

<?php
require_once('../conexion.php');
require_once('../clases/asignatura.class.php');
$alumno = new asignatura();
$profesor = new asignatura();
$asigna= new asignatura();
$inscribe= new asignatura();

function utf8_string_array_encode(&$array){
    $func = function(&$value,&$key){
        if(is_string($value))
            $value = utf8_encode($value);
         
        if(is_string($key))
            $key = utf8_encode($key);
        
        if(is_array($value))
            utf8_string_array_encode($value);
        
    };
    array_walk($array,$func);
    return $array;
}
?>


<div class="container">  
    <br/>
    <br/>
        <div class="col_full panel panel-default">
               <div class="panel-heading">
					      <div style="text-align:center;"><h1 class="panel-title"> IMPORTAR LISTAS</h1></div>
                </div>
                    <div class="panel-body">
                          <p>
                             <table  class="table">
                                     
                         

                      <form  method="POST" enctype="multipart/form-data">
                         <tr>
                            <td width="20%" align="center" >Subir archivo :</td>
                            <td align="left" ><input type="file" name="archivo_csv" id='archivo'></td>
                         </tr>
                        
                          
                           <tr>
                               <td colspan="2" align="center">
                                 <input  type="submit" value="Importar">
                                 <input type="reset" value="Cancelar">
                               </td>
                          </tr>
                      </form>
                    </table>
                   </p>

                  </div>
             </div>
 </div>
<?php 

$file_upload = $_FILES["archivo_csv"]["name"];
$tmp_name = $_FILES["archivo_csv"]["tmp_name"];
$size = $_FILES["archivo_csv"]["size"];
$tipo = $_FILES["archivo_csv"]["type"];

if ($size > 0){
 
      $fp = fopen($tmp_name, "r");
   
       // Procesamos linea a linea el archivo CSV y 
       // lo insertamos en la base de datos
	  $cuenta=1;
       while($datos = fgetcsv ($fp, 1000, "\t")){ 
		 
		      $datosdec=utf8_string_array_encode($datos); // decodifica a UTF8
							  
			  $querytemp="SELECT * FROM listado WHERE 
		                   no_cuenta=".$datosdec[0].
						 " AND id_asig=".$datosdec[7].
						 " AND no_grupo=".$datosdec[8].
						 " AND semestre="."'".$datosdec[9]."'";
					  
			  //echo $querytemp;		  
		      $datostemp = pg_query($con,$querytemp);
		   
		       if (pg_num_rows($datostemp)>0) {
			 
		               $updatequery= "UPDATE listado SET no_cuenta=%d
			                           WHERE no_cuenta=".$datosdec[0].
									 " AND id_asig=".$datosdec[7].
									 " AND no_grupo=".$datosdec[8].
									 " AND semestre="."'".$datosdec[9]."'";
							  
			           $queryu=sprintf($updatequery, $datosdec[0] ); 
			           $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR en listado'); 
			          // echo 'actualizo';
			                 
		      } else { ?>
              <table>
              
			   <?php 
	                 if(is_null($datosdec[0])) { //nocuenta?> 
	                    <tr><td> <?php echo 'La columna A,  <strong> no_cuenta </strong> del renglón  '.$cuenta .' debe ser obligatoria'; ?></td></tr>
					 <?php 	}elseif (!preg_match("/[\d.]+/",$datosdec[0])){  ?>
					
					        <tr><td> <?php echo 'La columna A,  <strong> no_cuenta </strong> del renglón  '.$cuenta .' debe ser entero'; ?></td></tr>
					  <?php } ?>
                      
	                 <?php  if(is_null($datosdec[1])) { //nombre_alu?> 
                     <?php echo 'Valor,  del renglón  '.$cuenta .' debe ser obligatorio'; ?>
	                    <tr><td> <?php echo 'La columna B,  <strong> nombre_alu </strong> del renglón  '.$cuenta .' debe ser obligatoria'; ?></td></tr>
					 <?php 	} elseif (!is_string($datosdec[1])){ ?>
						 
						     <tr><td> <?php  echo 'La columna B, <strong> nombre_alu </strong> del renglón  '.$cuenta .' debe ser cadena de caracteres';?></td></tr>	
               
						    <?php  } ?>
                            
				     <?php if(is_null($datosdec[2])) { //nom_pat_alu?>
                     <tr><td> <?php  echo 'La columna C, <strong> nombre_pat_alu </strong> del renglón  '.$cuenta .' debe ser obligatoria';?></td></tr>	
	                  <?php   }elseif (!is_string($datosdec[2])) { ?>
                            <tr><td> <?php  echo 'La columna C, <strong> nombre_pat_alu </strong> del renglón  '.$cuenta .' debe ser cadena de caracteres ';?></td></tr> 
						 <?php }  ?>
                         
	                 <?php if(is_null($datosdec[3])) {//nom_mat_alu ?>
                     <tr><td> <?php  echo 'La columna D, <strong> nombre_mat_alu </strong> del renglón  '.$cuenta .' debe ser obligatoria';?></td></tr>	
                     
	                  <?php }elseif (!is_string($datosdec[3])) { ?>
						<tr><td> <?php  echo 'La columna D, <strong> nombre_mat_alu </strong> del renglón  '.$cuenta .' debe ser cadena de caracteres';?></td></tr> 
                        
					  <?php }  ?>          
					 <?php if(is_null($datosdec[4])) {//nomprof ?>
	                 <tr><td>  <?php  echo 'La columna E, <strong> nombre_prof </strong> del renglón  '.$cuenta  .' debe ser obligatoria';?></td></tr> 
                      <?php }elseif (!is_string($datosdec[4])){ ?>
                       <tr><td>  <?php  echo 'La columna E, <strong> nombre_prof </strong> del renglón  '.$cuenta  .' debe ser cadena de caracteres';?></td></tr> 
                      
					 <?php }  ?>
                     
	                 <?php if(is_null($datosdec[5])){//nom_pat_prof ?>
	                   <tr><td>  <?php  echo 'La columna F, <strong> nombre_pat_prof </strong> del renglón  '.$cuenta  .' debe ser obligatoria';?></td></tr> 
                      <?php }elseif (!is_string($datosdec[5])){ ?>
                       <tr><td>  <?php  echo 'La columna F, <strong> nombre_pat_prof </strong> del renglón  '.$cuenta  .' debe ser cadena de caracteres';?></td></tr> 
                      
					 <?php }  ?>
                     
				     <?php if(is_null($datosdec[6])) {//nom_mat_prof ?>
                      <tr><td>  <?php  echo 'La columna G, <strong> nombre_mat_prof </strong> del renglón  '.$cuenta  .' debe ser obligatoria';?></td></tr> 
                         <?php }elseif (!is_string($datosdec[6])){ ?>
                       <tr><td>  <?php  echo 'La columna G, <strong> nombre_mat_prof </strong> del renglón  '.$cuenta  .' debe ser cadena de caracteres';?></td></tr> 
	                   <?php }  ?>
	                <?php  if(is_null($datosdec[7])) { //id_asig ?>
					 <tr><td>  <?php  echo 'La columna H, <strong> id_asig </strong> del renglón  '.$cuenta  .' debe ser obligatoria';?></td></tr>  
                    <?php 	}elseif (!preg_match("/[\d.]+/",$datosdec[7])){  ?>
					
					        <tr><td> <?php echo 'La columna H,  <strong> id_asig </strong> del renglón  '.$cuenta .' debe ser entero'; ?></td></tr>
					  <?php } ?>
                      
	                 <?php if(is_null($datosdec[8])) { //no_grupo ?>
                     <tr><td>  <?php  echo 'La columna I, <strong> no_grupo </strong> del renglón  '.$cuenta  .' debe ser obligatoria';?></td></tr>  
                    <?php 	}elseif (!preg_match("/[\d.]+/",$datosdec[8])){  ?>
					
					        <tr><td> <?php echo 'La columna I,  <strong> no_grupo </strong> del renglón  '.$cuenta .' debe ser entero'; ?></td></tr>
					  <?php } ?>
					  
	                 <?php if(is_null($datosdec[9])) { //semestre ?>
                      <tr><td>  <?php  echo 'La columna J, <strong> semestre </strong> del renglón  '.$cuenta  .' debe ser obligatoria';?></td></tr> 
                      <?php }elseif (!is_string($datosdec[9])){ ?>
                       <tr><td>  <?php  echo 'La columna J, <strong> semestre </strong> del renglón  '.$cuenta  .' debe ser cadena de caracteres';?></td></tr> 
                     <?php }  ?>
	                   
				     
                      <?php if(is_null($datosdec[10])) { //salon ?>
                      <tr><td>  <?php  echo 'La columna K, <strong> salon</strong> del renglón  '.$cuenta  .' debe ser obligatoria';?></td></tr> 
                      <?php }elseif (!is_string($datosdec[10])){ ?>
                       <tr><td>  <?php  echo 'La columna K, <strong> salon </strong> del renglón  '.$cuenta  .' debe ser cadena de caracteres';?></td></tr> 
                     <?php }  ?>
                     
	                 
	                 <?php if(is_null($datosdec[11])){ //horaini ?>
                     <tr><td>  <?php  echo 'La columna L, <strong> hora_ini</strong> del renglón  '.$cuenta  .' debe ser obligatoria';?></td></tr> 
                      <?php }elseif (!is_string($datosdec[11])){ ?>
                       <tr><td>  <?php  echo 'La columna L, <strong> hora_ini </strong> del renglón  '.$cuenta  .' debe ser cadena de caracteres';?></td></tr> 
                     <?php }  ?>
	                
					 <?php if(is_null($datosdec[12])) { //horafin ?>
	                     <tr><td>  <?php  echo 'La columna M, <strong> hora_fin</strong> del renglón  '.$cuenta  .' debe ser obligatoria';?></td></tr> 
                      <?php }elseif (!is_string($datosdec[12])){ ?>
                       <tr><td>  <?php  echo 'La columna M, <strong> hora_fin </strong> del renglón  '.$cuenta  .' debe ser cadena de caracteres';?></td></tr> 
                     <?php }  ?>
	                 <?php if(is_null($datosdec[13])) { //dia ?>
	                    <tr><td>  <?php  echo 'La columna N, <strong> dia </strong> del renglón  '.$cuenta  .' debe ser obligatoria';?></td></tr> 
                      <?php }elseif (!preg_match("/[\d.]+/",$datosdec[13])){ ?>
                       <tr><td>  <?php  echo 'La columna N, <strong> dia </strong> del renglón  '.$cuenta  .' debe ser entero';?></td></tr> 
                     <?php }  ?>
				   </table> 
	                <?php
		            //Traer el último valor en errorinserta
					
					/*
			        $queryd="SELECT max(id_error) FROM errorinserta";
                    $registrod= pg_query($con,$queryd);
                    $ultimo= pg_fetch_array($registrod);
	
		            if ($ultimo[0]==0)
				        $ultimo=1;//inicializando la tabla dispositivouno
			        else 
			            $ultimo=$ultimo[0]+1;
	   
	  
	                $query= "INSERT INTO errorinserta(id_error,tupla,columna1,columna2,columna3,columna4,columna5,
	                                     columna6,columna7,columna8,columna9,columna10,
	                                     columna11,columna12,columna13,columna14) VALUES 
										 ($ultimo,$cuenta,$columna1,$columna2,$columna3,$columna4,$columna5,
										 $columna6,$columna7,$columna8,$columna9,$columna10,
	                                     $columna11,$columna12,$columna13,$columna14)";
	                //echo $query;
	   	 
	                $result=pg_query($con, $query) or die('ERROR AL INSERTAR en errorinserta'); 				
						*/
                    $query = "INSERT INTO listado  (no_cuenta,nom_alu,nom_pat_alu,nom_mat_alu,
	                                                nom_prof,nom_pat_prof, nom_mat_prof,
                                                    id_asig,no_grupo,semestre,
									                salon,hora_ini,hora_fin,dia ) VALUES 
					                               ($datosdec[0], '$datosdec[1]', '$datosdec[2]', '$datosdec[3]',
                                                   '$datosdec[4]', '$datosdec[5]',  '$datosdec[6]', --nom_prof
										            $datosdec[7], $datosdec[8], '$datosdec[9]',--id_asig
									               '$datosdec[10]','$datosdec[11]', '$datosdec[12]', $datosdec[13])"; 
												   
                    // echo $query;
					 
                      $result= @pg_query($con, $query);
					  
		        } //aqui termina  valida errores para null
				 $cuenta=$cuenta+1;
	       } //while para insertar en dispositivo temporal
}// finn del if($size > 0) 
				 
	 
// Comienza a llevar datos a otra tablas
				 
				  $query="SELECT * FROM listado"; 
		
		                 $datos = pg_query($con,$query);
						 
		                     while ($listado = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		                     { 
							       // Poblando tabla alumno 
								      $alumno->insertaAlumno($listado['no_cuenta']);
								    //Poblando tabla profesor 
								      $profesor->insertaProfesor($listado['no_cuenta']);
									//Poblando tabla asignatura_ grupo
								      $asigna->insertaAsignatura($listado['no_cuenta']);
								    //Revisasr de donde se obtendra el depto
									  $inscribe->insertaInscribe($listado['no_cuenta']);	
									  
								
		                      } // fin de while que llena otras tablas
							  
						/* $queryins="SELECT * FROM errorinserta"; 
		
		                 $datos = pg_query($con,$queryins);	  
						 
						 	//Interpetando errores
		                 while ($disperror = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		                 {     
							   if ($disperror['columna1']==0) { ?>
                                    <tr><td> <?php echo 'La columna A,  <strong> no_cuenta </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria'; ?></td></tr>
                         <?php }if ($disperror['columna1']==3) { ?>
						              <tr><td> <?php echo 'La columna A,  <strong> no_cuenta </strong> del renglón  '.$disperror['tupla'] .' debe ser entero'; ?></td></tr>
						
                        
						<?php }if ($disperror['columna2']==0) {?>
		       <tr><td> <?php  echo 'La columna B, <strong> nombre_alu </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr>	        
                        <?php }if ($disperror['columna2']==2) {?>
                        
		       <tr><td> <?php  echo 'La columna B, <strong> nombre_alu </strong> del renglón  '.$disperror['tupla'] .' debe ser cadena de caracteres';?></td></tr>	
               
                         
                        <?php }if ($disperror['columna3']==0) {?>
		       <tr><td> <?php  echo 'La columna C, <strong> nombre_pat_alu </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr>	
                        <?php }if ($disperror['columna3']==2) {?>
		       <tr><td> <?php  echo 'La columna C, <strong> nombre_pat_alu </strong> del renglón  '.$disperror['tupla'] .' debe ser cadena de caracteres ';?></td></tr> 
               
               
                        <?php }if ($disperror['columna4']==0) {?>
		       <tr><td> <?php  echo 'La columna D, <strong> nombre_mat_alu </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr>    
                        <?php }if ($disperror['columna4']==2) {?>
		       <tr><td> <?php  echo 'La columna D, <strong> nombre_mat_alu </strong> del renglón  '.$disperror['tupla'] .' debe ser cadena de caracteres';?></td></tr> 
               
                         <?php }if ($disperror['columna5']==0) {?>
		       <tr><td>  <?php  echo 'La columna E, <strong> nombre_prof </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr>  
                         <?php }if ($disperror['columna5']==2) {?>
		       <tr><td>  <?php  echo 'La columna E, <strong> nombre_prof </strong> del renglón  '.$disperror['tupla'] .' debe ser cadena de caracteres';?></td></tr> 
                 
                        <?php }if ($disperror['columna6']==0) {?>
		       <tr><td> <?php  echo 'La columna F, <strong> nombre_pat_prof </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr> 
                         <?php }if ($disperror['columna6']==2) {?>
		       <tr><td> <?php  echo 'La columna F, <strong> nombre_pat_prof </strong> del renglón  '.$disperror['tupla'] .' debe ser cadena de caracteres';?></td></tr> 
               
                         <?php }if ($disperror['columna7']==0) {?>
		       <tr><td> <?php  echo 'La columna G, <strong> nombre_mat_prof </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr>
                         <?php }if ($disperror['columna7']==2) {?>
		       <tr><td> <?php  echo 'La columna G, <strong> nombre_mat_prof </strong> del renglón  '.$disperror['tupla'] .' debe ser cadena de caracteres';?></td></tr>  
                   
                         <?php }if ($disperror['columna8']==0) {?>
		       <tr><td>  <?php  echo 'La columna H, <strong> id_asig </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr>   
                         <?php }if ($disperror['columna8']==3) { ?>
						              <tr><td> <?php echo 'La columna H,  <strong> id_asig </strong> del renglón  '.$disperror['tupla'] .' debe ser entero'; ?></td></tr>
                                      
                        <?php }if ($disperror['columna9']==0) {?>
		       <tr><td> <?php  echo 'La columna I, <strong> no_grupo </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr>
                        <?php }if ($disperror['columna9']==3) { ?>
						              <tr><td> <?php echo 'La columna I,  <strong> no_grupo </strong> del renglón  '.$disperror['tupla'] .' debe ser entero'; ?></td></tr>
                                      
                         <?php }if ($disperror['columna10']==0) {?>
		       <tr><td> <?php  echo 'La columna J, <strong> semestre </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr>             
			            <?php }if ($disperror['columna10']==2) {?>
		       <tr><td> <?php  echo 'La columna J, <strong> semestre </strong> del renglón  '.$disperror['tupla'] .' debe ser cadena de caracteres';?></td></tr> 
               
                         <?php }if ($disperror['columna11']==0) {?>
		       <tr><td> <?php  echo 'La columna K, <strong> salon </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr>
                         <?php }if ($disperror['columna11']==2) {?>
		       <tr><td>  <?php  echo 'La columna K, <strong> salon </strong> del renglón  '.$disperror['tupla'] .'debe ser cadena de caracteres';?></td></tr>
               
                         <?php }if ($disperror['columna12']==0) {?>
		       <tr><td>  <?php  echo 'La columna L, <strong> hora_ini </strong> del renglón  '.$disperror['tupla'] .' debe obligatoria';?></td></tr>
                         <?php }if ($disperror['columna12']==2) {?>
		       <tr><td> <?php  echo 'La columna L, <strong> hora_ini </strong> del renglón  '.$disperror['tupla'] .' debe ser tipo hora';?></td></tr>
               
                         <?php }if ($disperror['columna13']==0) {?>
		       <tr><td> <?php  echo 'La columna M, <strong> hora_fin </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr>
                         <?php }if ($disperror['columna13']==2) {?>
		       <tr><td> <?php  echo 'La columna M, <strong> hora_fin </strong> del renglón  '.$disperror['tupla'] .' debe ser tipo hora';?></td></tr>
                          <?php }if ($disperror['columna14']==0) {?>
		       <tr><td> <?php  echo 'La columna N, <strong> dia </strong> del renglón  '.$disperror['tupla'] .' debe ser obligatoria';?></td></tr> 
                         <?php }if ($disperror['columna14']==3) { ?>
						              <tr><td> <?php echo 'La columna N,  <strong> dia </strong> del renglón  '.$disperror['tupla'] .' debe ser entero'; ?></td></tr>
		<?php				 }
							  
						 }*/ 
?>

