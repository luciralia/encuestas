
<?php
session_start();
require_once('../inc/encabezado.inc.php');
require_once('../clases/usuario.class.php');
require_once('../clases/encuesta.class.php');
//echo 'valores en contestaEncuesta';
//print_r($_SESSION);
?>
   

<?php
//Revisasr si ha contestado encuesta 
$queryvalida="select * from encuesta_realiza er
join encuesta e
on er.id_encuesta=e.id_encuesta
join inscribe i
on i.folio_insc=er.folio_insc
where er.folio_insc=".$_SESSION['folio_insc'].
" and i.id_Asig=".$_SESSION['id_asig'].
" and i.no_grupo=".$_SESSION['no_grupo'].
" and id_practica_asig=".$_SESSION['id_practica_asig'];


$datosvalida = pg_query($con,$queryvalida);
$contesta= pg_num_rows($datosvalida); 
							   

 if ($contesta!=0){ ?>
        <div id="bgalerta"></div><div id="advertencia" style="box-shadow: 10px 10px 30px #000000;"><p>Ha contestado la encuesta</p><div id="boton1"><a href="../index.php?usr=<?php echo $rusuario; ?>">Cerrar</a></div></div>
      
    
        
<?php }
print_r($_SESSION);

$combo  = new encuesta();
$radial = new encuesta();

$usu = new usuario();

$fecha_actual = date("Y-m-d", time());
$hora_actual  = date("H:i");
echo 'fecha: ' .$fecha_actual .' ';

//echo 'hora_actual'.$hora_actual;

$dia_semana=date("w");
echo 'dia_semana: ' .$dia_semana .' ';


// Restringue al tipo de encuesta
$numtopico = 0;
if ($_REQUEST['id_tipo'] != 2)
    $querytopico = "SELECT * FROM  cat_topico
                 ORDER BY id_cat_topico";
else
    $querytopico = "SELECT * FROM   cat_topico
                 WHERE id_cat_topico!=3 AND id_cat_topico!=7
                 ORDER BY id_cat_topico";

$topico = pg_query($con, $querytopico);

//echo $querytopico;
?>

        <!-- Contenido
        ============================================= -->
        <section id="content">

       <div class="container">
            <div class="content-wrap">

                    <div class="clear"></div>


                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                       <?php
echo "<h2>" . $usu->getNombre($_SESSION['no_cuenta']) . "</h2>";
?> 



<table  class="table">
    <thead>
   <tr>
     <th width="30%">No Cuenta</th>
     <th ><input type="text" name="no_cuenta" id="no_cuenta"size="10" value=" <?php echo $_SESSION['no_cuenta'];?>" disabled="disabled"></th>
     <th width="30%">Nombre</th>
     <th ><input type="text" name="nombre_alumno" id="nombre_alumno"size="40" value="<?php echo $usu->getNombre($_SESSION['no_cuenta']);?> " disabled="disabled"></th>
  
    </tr>
    <tr>
      <th width="30%"   >Asignatura</th>
      <th ><input type="text" name="id_asig" id="id_asig"size="30" value=" <?php echo $usu->getnomAsig($_SESSION['id_asig']); ?>  " disabled="disabled"></th>
      <th width="30%">Grupo</th>
      <th ><input type="text" name="no_grupo" id="no_grupo"size="5" value=" <?php echo $_SESSION['no_grupo'];?> " disabled="disabled"></th>
    </tr>
  
    <tr> 
      <th width="30%" >Práctica</th>
      <th > <input type="text" name="id_practica_asig" id="id_practica_asig"size="30" value=" <?php
echo $combo->nomPrac($_REQUEST['id_practica_asig']);
?> " disabled="disabled" ></th>
      <th width="30%" >Fecha</th>
      <th > <input type="text" name="id_fecharealiza" id="id_fecharealiza"size="10" value=" <?php
echo date('Y-m-d');
?> " disabled="disabled"></th>
  
   </tr> 
   </thead> 
   <tbody>
   
  </tbody>
  </table>
   </div> <!--Termina encabezado-->

                            <div class="panel-body">
                            <div style="text-align:center;">
                                <p><h3> Conteste correctamente </h3></p>
                            </div>    
                            </div>
  
  
  <form action="../inc/procesaEncuesta.inc.php" method="post" name="contestaformulario" class="formulario" onsubmit="return validaNum(this);" autocomplete="off" >
  
         
          <tr>        
               <th  width="30%" scope="col">Equipo utilizado</th>
               <th width="30%"> <input type="text" name="equipo" id="equipo"size="5" ></th>
    
         </tr>
 <div class="line"></div>
   <?php
$numpreg = 0;
while ($nomTopico = pg_fetch_array($topico, NULL, PGSQL_ASSOC)) {
    $numtopico = $numtopico + 1;
    if ($_REQUEST['id_tipo'] == 2) {
        if ($nomTopico['id_cat_topico'] == 3 || $nomTopico['id_cat_topico'] == 7)
            $nomTopico['id_cat_topico'] = 0;
    }
    if ($numtopico == 1) { $letra = 'A'; }
    if ($numtopico == 2) { $letra = 'B'; }
    if ($numtopico == 3) { $letra = 'C'; }
    if ($numtopico == 4) { $letra = 'D'; }
    if ($numtopico == 5) { $letra = 'E'; }
    if ($numtopico == 6) { $letra = 'F'; }
    if ($numtopico == 7) { $letra = 'G'; }
?>
       
         <table  class="table">
         
         <tr  ><div style="text-align:center"; ><h3><?php echo $letra . ".   " . $nomTopico['nomb_topico'];?></h3></div></tr>
         
         
   
       <?php
    $querypreg = "SELECT * FROM cat_topico ct
                   JOIN  cat_preg cp
                   ON cp.id_cat_topico=ct.id_cat_topico
                   JOIN formato f
                   on f.id_preg=cp.id_preg    
                   JOIN laboratorio l
                   on l.id_lab= f.id_lab 
                   JOIN lab_asig la
                   ON la.id_lab=l.id_lab
                   WHERE la.id_lab_asig=" . $_SESSION['id_lab_asig'] . " AND ct.id_cat_topico=" . $nomTopico['id_cat_topico'] . " AND f.vigencia_actual=1 ORDER BY cp.id_preg";
    
    
    
    
    $preg = pg_query($con, $querypreg);
    
    
    while ($pregunta = pg_fetch_array($preg, NULL, PGSQL_ASSOC)) {
       
        $numpreg = $numpreg + 1;
?>
               
 
       
          <tr> 
              <td  width="33%" > <?php echo $numpreg . ".  " . $pregunta['pregunta_texto']; ?> </td>
                
                   <?php
        if ($pregunta['id_preg'] != 14 && $pregunta['id_preg'] != 15 && $pregunta['id_preg'] != 16 && $pregunta['id_preg'] != 17) { ?>
                         <td  width="30" ><?php $combo->combopreg($respuesta['calif'], $pregunta['id_preg']);?></td>
    
                   <?php
        } elseif ($pregunta['id_preg'] == 14 || $pregunta['id_preg'] == 15 || $pregunta['id_preg'] == 16 || $pregunta['id_preg'] == 17) {?>
                    
                      <td width="33%"  ><?php  $radial->radialpreg($respuesta['resp_bool'], $pregunta['id_preg']);?></td>
                <?php
        }
        
        
      
        
        if ($pregunta['id_preg'] == 1) { ?>
           <td  width="10%" > Comentarios  </td>
           <td ><input type="text" name="resp_abierta1" id="resp_abierta1" size="50"   ></td>
     
         <?php } 
		 
        if ($pregunta['id_preg'] == 2) { ?>
          <td width="10%"  > Comentarios  </td>
          <td ><input type="text" name="resp_abierta2" id="resp_abierta2" size="50"   ></td>
     
         <?php
          }
          if ($pregunta['id_preg'] == 3) { ?>
            <td width="10%" > Comentarios  </td>
            <td ><input type="text" name="resp_abierta3" id="resp_abierta3" size="50"  ></td>
     
        <?php
        }

        if ($pregunta['id_preg'] == 4) { ?>
           <td width="10%"> Comentarios  </td>
           <td  ><input type="text" name="resp_abierta4" id="resp_abierta4" size="50"  ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 5) { ?>
           <td width="10%"  > Comentarios  </td>
           <td  ><input type="text" name="resp_abierta5" id="resp_abierta5" size="50"  ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 6) { ?>
           <td width="10%" > Comentarios  </td>
           <td   ><input type="text" name="resp_abierta6" id="resp_abierta6" size="50"  ></td>
     
       <?php
        }
        if ($pregunta['id_preg'] == 7) { ?>
            <td width="10%"> Comentarios  </td>
            <td ><input type="text" name="resp_abierta7" id="resp_abierta7" size="50"  ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 8) { ?>
            <td width="10%"> Comentarios  </td>
            <td ><input type="text" name="resp_abierta8" id="resp_abierta8" size="50"></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 9) { ?>
      <td width="10%"> Comentarios  </td>
       <td ><input type="text" name="resp_abierta9" id="resp_abierta9" size="50" ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 10) { ?>
           <td width="10%" > Comentarios  </td>
           <td  ><input type="text" name="resp_abierta10" id="resp_abierta10" size="50" ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 11) { ?>
           <td width="10%" > Comentarios  </td>
           <td><input type="text" name="resp_abierta11" id="resp_abierta11" size="50"  ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 12) { ?>
            <td width="10%" > Comentarios  </td>
            <td ><input type="text" name="resp_abierta12" id="resp_abierta12" size="50"  ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 13) { ?>
            <td width="10%"> Comentarios  </td>
            <td ><input type="text" name="resp_abierta13" id="resp_abierta13" size="50"  ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 14) { ?>
            <td width="10%"> Comentarios  </td>
            <td ><input type="text" name="resp_abierta14" id="resp_abierta14" size="50"  ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 15) { ?>
            <td width="10%"> Comentarios  </td>
            <td ><input type="text" name="resp_abierta15" id="resp_abierta15" size="50"  ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 16) { ?>
      <td width="10%"> Comentarios  </td>
       <td ><input type="text" name="resp_abierta16" id="resp_abierta16" size="50"  ></td>
     
       <?php
        }

        if ($pregunta['id_preg'] == 17) { ?>
      <td width="10%"> Comentarios  </td>
       <td ><input type="text" name="resp_abierta17" id="resp_abierta17" size="50"  ></td>
     
       <?php
        }
        

        
    } // fin de while pregunta 
    
?>
     
        </tr> 
      
<?php
    
}
?>
    
    
     <tr> 
         <td width="50%" >Comentarios y/o sugerencias</td>
         <td width="50%"> <textarea name="comentarios" id="comentarios" placeholder="Escribe tus comentarios y/o sugerencias" ></textarea>
         </td>
     </tr>
     <?php
if ($_REQUEST['id_tipo'] == 2) { ?>
        <tr> 
          <td width="50%" >Si deseas que se te informe del seguimiento que se ha dado a tu sugerencia, favor de proporcionar tu correo electrónico</td>
           <td width="50%"> <input type="text" name="correo_elec" id="correo_elec"size="50" ></td>
        </tr>  
      <?php
}
?>


</table>
 
  <tr>
 
 <div class="line"></div>
    <td alingn="center" colspan="3">
    <br/>
 <br/>
    <div style="text-align:center;">
        <!--<input type="submit" name="accione" value="Guardar" onclick="javascript:guardar(this);"/>-->
         <input type=button onclick="pregunta()" value="Enviar">
         <input type="reset" name="accione"  value="Limpiar" />
         <input type="submit" name="accione" value="Cancelar" />
    </div>
    </td>
    </tr>    
  


 <div class="line"></div>
 
<input name="no_cuenta" type="hidden" value="<?php echo $_GET['no_cuenta']; ?>" />
<input name="id_tipo" type="hidden" value="<?php echo $_POST['id_tipo']; ?>" />
<input name="id_practica_asig" type="hidden" value="<?php echo $_POST['id_practica_asig']; ?>" />

</form>

             
      </div>       
   </div>
</div>

        </section><!-- #contenido end -->

<?php
require_once('../inc/pie.inc.php');
?>