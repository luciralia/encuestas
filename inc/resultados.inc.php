 <?php
 session_start();
 require_once('../conexion.php');
 require_once('../clases/laboratorio.class.php'); 
 $comboasigna=new laboratorio();
 echo 'valores $_REQUEST';
 print_r($_REQUEST);
?>
                                        

    <div class="panel panel-default">
                        <!-- Default panel contents -->
                            <div class="panel-heading">
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                <thead>
                                   <!-- <tr>
                                       
                                        <!--<th>Asignatura</th>
                                        <th>No. Grupo</th>
                                        <th>No. Práctica</th>
                                     </tr>-->
                                </thead>
                                <tbody> 
                                        <tr> 
										      <td><?php  //echo $comboasigna->comboasignatura($_SESSION['id_lab']); ?></td>
                                        </tr>
                                
                                </tbody>
                                </table>
                            </div>

                            <!-- Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                       
                                        <th>Asignatura</th>
                                        <th>No. Grupo</th>
                                        <th>No. cuenta</th>
                                        <th>Nombre</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>No. Práctica</th>
                                        <th>Práctica</th>
                                        <th>No. Pregunta</th>
                                        <th>Pregunta</th>
                                        <th>Calif</th>
                                        <th>Respuesta abierta</th>
                                        <th>Respuesta booleana</th>
                                    </tr>
                                </thead>
                                <tbody>   

        
                       <?php 

	
	 $query="select er.folio_encuesta,e.id_encuesta,no_ejemplar, nombre_asig,i.no_grupo,al.no_cuenta,al.nombre_alumno,al.ap_pat_alumno,al.ap_mat_alumno,nopractica,nomb_practica,cp.id_preg,pregunta_texto,calif,resp_abierta,resp_bool from encuesta_realiza er
join encuesta e
on e.id_encuesta=er.id_encuesta
join practica_asig pa
on pa.id_practica_asig=e.id_practica_asig
join inscribe i
on er.folio_insc=i.folio_insc
join alumno al
on al.no_cuenta=i.no_cuenta
join asignatura a
on a.id_asig=pa.id_asig
join topicopreg tp
on tp.folio_encuesta=er.folio_encuesta
join cat_preg cp
on cp.id_preg=tp.id_preg
join respuesta r
on r.id_respuesta=tp.id_respuesta
left join cat_calif_resp ccr
on ccr.id_cat_calif=r.id_cat_calif
where e.id_lab=". $_SESSION['id_lab'].
"and i.id_asig=".$_REQUEST['id_asig'];

/*and i.no_grupo=" .$_REQUEST['gpo'].
"
group by er.folio_encuesta,e.id_encuesta,no_ejemplar,nombre_asig,i.no_grupo,nopractica,nomb_practica,cp.id_preg,pregunta_texto,calif,resp_abierta,resp_bool 
order by e.id_encuesta asc";*/
		 
$muestra=pg_query($con,$query);		
						
        while ($muestraresult= pg_fetch_array($muestra, NULL,PGSQL_ASSOC)) 
		{ ?>          
                                    <tr>
                                      
                                        <td><?php echo $muestraresult['nombre_asig'];?></td>
                                        <td><?php echo $muestraresult['no_grupo'];?></td>
                                        <td><?php echo $muestraresult['no_cuenta'];?></td>
                                        <td><?php echo $muestraresult['nombre_alumno'];?></td>
                                        <td><?php echo $muestraresult['ap_pat_alumno'];?></td>
                                        <td><?php echo $muestraresult['ap_mat_alumno'];?></td>
                                        <td><?php echo $muestraresult['nopractica'];?></td>
                                        <td><?php echo $muestraresult['nomb_practica'];?></td>
                                        <td><?php echo $muestraresult['id_preg'];?></td>
                                        <td><?php echo $muestraresult['pregunta_texto'];?></td>
                                        <td><?php if  ($muestraresult['calif']==NULL) echo '  ';
										          else echo $muestraresult['calif'] ;?></td>
                                        <td><?php echo $muestraresult['resp_abierta'];?></td>
                                        <td><?php if($muestraresult['resp_bool']==1) {echo 'Si';
										          }else if($muestraresult['resp_bool']==0){ 
												      echo 'No';}?></td>
                                    </tr>

       <?php } ?>
	   
                            </tbody>
                            </table>
                            
                            
</div>
</div>