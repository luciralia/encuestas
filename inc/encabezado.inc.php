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
     
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>-->
    <script >
 
$(function(){
	$("#id_asig").change(function(){ //se activa cuando se selecciona la asignatura
	id_asig=$(this).val() //Toma el valor seleccionado
   //envio a la pagina donde hará la consulta
    $.get("../inc/configuraResultados.inc.php?idasig="+id_asig,
	          function(data){ 
			       $("#id_grupo").html(data);
			  });
  });	
});</script>

    <!-- Titulo
    ============================================= -->
    
    <title>Sistema de Encuestas </title>
  
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
                               
                                 <?php require_once('../inc/menu.inc.php'); ?>
                     </div>

                </nav><!-- #primary-menu end -->
            
            </div>

        </header><!-- #header end -->
