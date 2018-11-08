<?php 
session_start();

require_once('../inc/encabezado.inc.php'); 
//require_once('../inc/sesion.inc.php');
echo 'session';
print_r($_SESSION);
 ?>
 
  <!-- Contenido
        ============================================= -->
   <section id="content">
   
  <tr>
    <td align="center"><h2>Configurando formato</h2></td>
  </tr>
  <tr>
    <td align="center"><?php //echo $lab->getLaboratorio($_GET['lab']);?></td>
  </tr>

<?php 

	require('../inc/editaFormato.inc.php');


?>


<?php require_once('../inc/pie.inc.php'); ?>