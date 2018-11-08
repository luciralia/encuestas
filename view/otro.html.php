<?php 

require_once('../clases/usuario.class.php');
require_once('../clases/encuesta.class.php'); 

?>



<!DOCTYPE html>
<html dir="ltr" lang="es">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Facultad de Ingenieria" />

    <!-- Stylesheets
    ============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="../css/style.css" type="text/css" />
    <link rel="stylesheet" href="../css/dark.css" type="text/css" />
    <link rel="stylesheet" href="../css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="../css/animate.css" type="text/css" />
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css" />
    <link rel="stylesheet" href="../css/colors.css" type="text/css" />
    <link rel="stylesheet" href="../css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
   		
        <!--[if lte IE 8]><script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script><![endif]-->

    <!-- External JavaScripts
    ============================================= -->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/plugins.js"></script>

    <!-- Titulo
    ============================================= -->
	<title>Sistema de Encuestas</title>

</head>

<body class="stretched">

    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Header
        ============================================= -->
       <header id="header" class="sticky-style-2">

            <div class="container clearfix">

                <!-- Logo
                ============================================= -->
                <div id="logo" class="divcenter">
                	
                    
                   <img src="../images/banner_principalsin.jpg" width="1024" height="103" >
                     
               </div><!-- #logo end -->

            </div>

            <div id="header-wrap">

                <!-- Menu 
                ============================================= -->
                <nav id="primary-menu" class="style-2 center">

                    <div class="container clearfix">

                        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>


                        </div>

                </nav><!-- #primary-menu end -->
              
            </div>

        </header><!-- #header end -->


        <!-- Titulo
        ============================================= -->
        <section id="page-title">

           <!--<div class="container clearfix">-->
           <div class="container">
           <div class="titulo-interfaz">
                <h1>Sistemas de Encuestas....</h1>
            </div>
          </div>
        </section><!-- Titulo end -->

        <!-- Contenido
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

            

                  
                    <div class="clear"></div>

                     <div class="line"></div>
                     
           <h3> el cuerpo  del programa </h3>
                 <?php 


echo 'El usuario es';
echo $usuario['no_cuenta'];

echo 'los valores en session';
print_r ($_SESSION);


$usu=new usuario();
$combo=new encuesta();


print_r($_REQUEST);
?>
                 

              <?php  echo "<h2>" . $usu->getNombre($_SESSION['no_cuenta']) . "</h2>"; ?>

   

        </div>

        </section><!-- #contenido end -->
        
 <!-- Footer
        ============================================= -->
        <footer id="footer" class="dark" >

            <div class="container">

                <!-- Footer Widgets
                ============================================= -->
                <div class="footer-widgets-wrap clearfix">

                    <div class="col_two_third">

                        <div class="widget clearfix">

                           

                           <div class="col_one_third">
                           		 <img src="../images/logofooter.png" alt="" class="footer-logo">  
                                  <div style="padding-left:40px">
                            <!--     	<button type="submit" id="quick-contact-form-submit" name="quick-contact-form-submit" class="btn-contacto" value="submit">Contacto</button> -->
                                 </div>  
                                 
                                 	
								
                             </div>
                                
                            <div class="col_two_third col_last">
                            		 <address class="nobottommargin">
                                        <abbr title="Headquarters" style="display: inline-block;margin-bottom: 7px;"><strong>Universidad Nacional Autónoma de México</strong></abbr><br>
                                        Facultad de Ingeniería, Av. Universidad 3000, Ciudad Universitaria, Coyoacán, México D. F., CP 04510<br>
                                       </address>
                            
                                    <abbr title="Phone Number"><strong>Teléfono:</strong></abbr> 56 22 08 66<br>
                                    <abbr title="Fax"><strong>Fax:</strong></abbr> 56 16 28 90<br>
                                    <a href="#" class="social-icon si-small si-rounded topmargin-sm si-facebook" data-toggle="tooltip" data-placement="top" title="Facebook">
                                        <i class="icon-facebook"></i>
                                        <i class="icon-facebook"></i>
                            		</a>

                            		<a href="#" class="social-icon si-small si-rounded topmargin-sm si-twitter" data-toggle="tooltip" data-placement="top" title="Twitter">
                                        <i class="icon-twitter"></i>
                                        <i class="icon-twitter"></i>
                            		</a>

                          			<a href="#" class="social-icon si-small si-rounded topmargin-sm si-instagram" data-toggle="tooltip" data-placement="top" title="Instagram">
                                        <i class="icon-instagram"></i>
                                        <i class="icon-instagram"></i>
                        			</a>
                            
                            		<a href="#" class="social-icon si-small si-rounded topmargin-sm si-youtube" data-toggle="tooltip" data-placement="top" title="Youtube">
                                        <i class="icon-youtube"></i>
                                        <i class="icon-youtube"></i>
                        			</a>
                                    
                                    
                                    
                                   
                           </div>
                                

                        </div>

                    </div>

                    <div class="col_one_third col_last">
                    	<div class="widget clearfix">
                            <h4>Sitios de Interés</h4>
								<div class="widget_links">
                                    <ul>
                                        <li><a href="http://www.anfei.mx" target="_blank">ANFEI</a></li>
                                        <li><a href="http://cacei.org.mx" target="_blank">CACEI</a></li>
                                        <li><a href="http://www.alianzafiidem.org" target="_blank">Alianza FIDEM</a></li>
                                        <li><a href="http://ingenet.com.mx" target="_blank">INGENET</a></li>
                                    </ul>
                                </div>
                        </div>
                        

                        

                        

                    </div>

                </div><!-- .footer-widgets-wrap end -->

            </div>

            <!-- Copyrights
            ============================================= -->
            <div id="copyrights2">

                <div class="container clearfix">

                   
                        <div class="copyrights2">
                        	 Copyrights &copy; 2018 /
                            <a href="http://www.ingenieria.unam.mx">Facultad de Ingeniería</a>/<a href="http://www.unam.mx">UNAM</a>/
                        </div>
                       
                   

                    

                </div>

            </div><!-- #copyrights end -->

        </footer><!-- #footer end -->
        
    </div><!-- #wrapper end 'images/footer-bg.jpg'-->

    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>

    <!-- Footer Scripts
    ============================================= -->
    <script type="text/javascript" src="../js/functions.js"></script>

</body>
</html>