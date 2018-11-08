
<?php 

 session_start();
require_once('../inc/encabezado.inc.php'); 
//require_once('../inc/sesion.inc.php');
//echo 'valores';
//print_r($_REQUEST['asig']);
 ?>
 
  <!-- Contenido
        =============================================  -->
   <section id="content">
   <div class="container">
   
 
    <p>
     <div style="text-align:center;"><h2>Reportes</h2></div>
    </p>

 
        <!-- Contenido
        =============================================
      <section id="content clearfix"> -->

       <?php  //require_once('../inc/importarListas.inc.php'); ?>

<?php 


  if (!isset($_REQUEST['id_asig']) )
	        require_once('../inc/configuraResultados.inc.php' );
  else if (isset($_REQUEST['id_asig']))
            require_once('../inc/resultados.inc.php' );			

?>
   <!-- </section> -->

<?php require_once('../inc/pie.inc.php'); ?>