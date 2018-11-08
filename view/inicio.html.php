<?php 
session_start();

require_once('../inc/encabezado.inc.php'); 
require_once('../clases/laboratorio.class.php');
require_once('../clases/usuario.class.php');
$lab=new laboratorio();
$usuario=new usuario();
echo 'en inicio.html';
print_r($_SESSION);
?>

        <!-- Titulo
        ============================================= -->
        <section id="page-title">

           <!--<div class="container clearfix">-->
           <div class="container">
                <?php  if ($_GET['qn']=='alu'){?>
                  <div class="titulo-interfaz">
                    <h2>Sistema de Encuestas</h2>
                  </div>
                   <?php  }else{ ?> 
                <div class="titulo-interfaz">
                   <h2>Configurando Encuestas</h2>
                   
                            <?php  echo "<h1>" . $usuario->getDepto($_SESSION['id_usuario']) . "</h1>"; ?> 
                  </div>
         
               <?php  }?>   
          </div>
        </section><!-- Titulo end -->

        <!-- Contenido
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                  
                    <div class="clear"></div>

                     
                         
                        
                 
           </div>
 <?php 

	
		if ($_GET['qn']=='alu')
		include_once("../view/configuraencuesta.html.php");
		else if ($_GET['mod']=='cfp' && (!isset($_SESSION['id_div']) || !isset( $_SESSION['id_dep']) || !isset($_SESSION['id_lab']))){
		include_once("../view/editaPregunta.html.php");
		}else if ($_GET['mod']=='cfp' && (!isset($_SESSION['id_div']) || !isset( $_SESSION['id_dep']) || isset($_SESSION['id_lab']))){
		include_once("../view/editaPregunta.html.php");
		}else if ($_GET['mod']=='mtra'){
		include_once("../view/muestraFormato.html.php");
		}else if (($_GET['mod']=='exp') ){
		include_once("../view/resultados.html.php");
		}else if (($_GET['mod']=='imp') ){
		include_once("../view/importarListas.html.php");
		}
		else 
           include_once("../view/inicio.html.php");
		  //header("Location: inicio.html.php");

	?>           
            
  

<?php require_once('../inc/pie.inc.php'); ?>