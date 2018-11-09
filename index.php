<!DOCTYPE html>
<html dir="ltr" lang="es">
<head>
<!--cambios de githib-->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Facultad de Ingenieria" />

    <!-- Stylesheets
    ============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/dark.css" type="text/css" />
    <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />
    <link rel="stylesheet" href="css/colors.css" type="text/css" />
    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
   		
        <!--[if lte IE 8]><script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script><![endif]-->

    <!-- External JavaScripts
    ============================================= -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/plugins.js"></script>
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>-->
   <script >
 
/*$(function(){
	$("#id_asig").change(function(){ //se activa cuando se selecciona la asignatura
	id_asig=$(this).val(); //Toma el valor seleccionado
   //envio a la pagina donde hará la consulta
    $.get("../inc/configuraResultados.inc.php?idasig="+id_asig,
	          function(data){ 
			       $("#id_grupo").html(data);
			  });
  });	
});*/
	



</script>
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
                	
                    
                   <img src="images/banner_principalsin.jpg" width="1024" height="103" >
                     
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
                <h1>Sistemas de Encuestas</h1>
            </div>
          </div>
        </section><!-- Titulo end -->

        <!-- Contenido
        ============================================= -->
        <section id="content">

            <!--<div class="content-wrap">-->
 
        <div class="container">
                  
                    <div class="clear"></div>

                     <div class="line"></div>
                     
                         
                        
                           
<table width="1024" border="0" cellpadding="1" class="principal" >
 
  <tr>
    <td align="center"><table width="400" cellspacing="0" cellpadding="0" >
      <tr>
        <td align="center" valign="middle">
       <?php $estado='oculto'; ?>        

       <?php 
       /* if ($_GET['log']=='no'){
   
            $usuario=$_GET['usr'];
            $rusuario=$_GET['usr'];
            $estado='visible';

        }else{
            $usuario='';      
 
         }*/
		  if ($_GET['log']=='no'){
   
            $usuario=$_GET['usr'];
            $rusuario=$_GET['usr'];
            $estado='visible';

           }elseif ($_GET['log']=='rest') {
			   $usuario=$_GET['usr'];
               $rusuario=$_GET['usr'];
               $estado='restringe';
		      }else{
			
                 $usuario='';      
 
         }
       ?>

        <!-- <form action="mod/autentica.mod.php" method="post" name="formlog" onsubmit="return validaNum(this);">-->
        <form action="mod/autentica.mod.php" method="post" name="formlog" >
        <p>&nbsp;</p>
           
           
        <table width="300" border="0" cellspacing="5" cellpadding="5" class="login" >
          <tr>
            <td align="right">Usuario:</td>
            <td><input name="username" type="text" id="username" value="<?php echo $_GET['usr'];  ?>" placeholder="Nombre de usuario"/></td>
          </tr>
          <tr>
            <td align="right">Contraseña:</td>
            <td><input type="password" name="password" id="password" placeholder="Escriba su contraseña"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="entrar" id="entrar" value="Entrar" /></td>
                
          </tr>
        </table>
<?php if ($estado=='visible'){ ?>
        <div id="bgalerta"></div><div id="advertencia" style="box-shadow: 10px 10px 30px #000000;"><p>El nombre de usuario o contraseña son incorrectos</p><div id="boton1"><a href="./?usr=<?php echo $rusuario; ?>">Cerrar</a></div></div>
        <?php }
        if ($estado=='restringe'){ ?>
        <div id="bgalerta"></div><div id="advertencia" style="box-shadow: 10px 10px 30px #000000;"><p>El ingreso está restringido</p><div id="botonblue"><a href="./?usr=<?php echo $rusuario; ?>">Cerrar</a></div></div>
<?php }?>
         </form>
          </td>
      </tr>
    </table>
    </td>
  </tr>
</table>

        <div class="line"></div>

           <!-- </div>-->
</div>
        </section><!-- #contenido end -->
 <!-- Footer
        ============================================= -->
        <footer id="footer" class="dark" >

            <div class="container">

                <!-- Footer Widgets
                ============================================= -->
                <div class="footer-widgets-wrap clearfix">

                    <div class="col_full">

                        <div class="widget clearfix">

                           

                           <div class="col_one_third">
                           		 <img src="images/logofooter.png" alt="" class="footer-logo">  
                                  <div style="padding-left:40px">
                            <!--     	<button type="submit" id="quick-contact-form-submit" name="quick-contact-form-submit" class="btn-contacto" value="submit">Contacto</button> -->
                                 </div>  
                                 
                                 	
								
                             </div>
                                
                            <div class="col_one_third col_last">
                            		 <address class="nobottommargin">
                                        <abbr title="Headquarters" style="display: inline-block;margin-bottom: 7px;"><strong>Universidad Nacional Autónoma de México</strong></abbr><br>
                                        Facultad de Ingeniería, Av. Universidad 3000, Ciudad Universitaria, Coyoacán, México D. F., CP 04510<br>
                                       </address>
                            
                                    <abbr title="Phone Number"><strong>Teléfono:</strong></abbr> 56 22 08 66<br>
                                    <abbr title="Fax"><strong>Fax:</strong></abbr> 56 16 28 90<br>
                                   
                                    
                                    
                                    
                                   
                           </div>
                                

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
    <script type="text/javascript" src="js/functions.js"></script>

</body>
</html>