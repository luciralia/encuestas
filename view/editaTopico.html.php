<?php 
require_once('../inc/encabezado.inc.php'); 
session_start();

//require_once('../inc/sesion.inc.php');
echo 'session';
print_r($_SESSION);
 ?>
 

        <!-- Contenido
        ============================================= 
        <section id="content">-->


  <tr>
    <td align="center"><h2>Elige</h2></td>
  </tr>
  <tr>
    <td align="center"><?php //echo $lab->getLaboratorio($_GET['lab']);?></td>
  </tr>



<?php //if (!isset($_GET['lab']) || $_GET['lab']==""){} else {
	// $_SESSION['qn']='adm';
	require('../inc/editaTopico.inc.php');
	//}

?>






<?php require_once('../inc/pie.inc.php'); ?>