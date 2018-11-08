<?php 
session_start(); 
require_once('../conexion.php'); 
require_once('../clases/reporte.class.php'); 
$obj_rep=new Reporte(); 
//preguntar por el numero de preguntas por formato de encuesta
//for ($i=1;$i<5;$i++){
	
             $renglon_rep=$obj_rep->rengReporte($_SESSION['id_lab'],$_REQUEST['id_asig'],$_REQUEST['id_tipo'],$_REQUEST['id_semestre']);
            // echo "</br>los datos del renglon $i: </br>";
			// if (isset($_POST['$renglon_rep'])){
			 foreach ($renglon_rep as $reng) {
			      					
					foreach ($reng as $campo => $valor) {
						//echo "</br> Campo: ".$campo." valor: ".$valor."</br>";
						$registro[$campo]=$valor;
				
					}
				
				}
		
     
			    // echo 'renglon';
			   //echo $r;
			   
//}// fin del for de numero de tuplas
//echo  "<br>el número de renglones será" .  count($renglon_rep) . " ++++++++++++++++++++++++++++++++++++++" ;
//	print_r($renglon_rep);	



      $query="SELECT nombre_asig FROM asignatura
              WHERE id_asig=" . $_REQUEST['id_asig'] ;
      $registro = pg_query($con,$query);
      $nombasig= pg_fetch_array($registro);

      $query="SELECT nombre_sem FROM semestre
              WHERE id_semestre=" . $_REQUEST['id_semestre'] ;
      $regsem = pg_query($con,$query);
      $nombsem= pg_fetch_array($regsem);


      date_default_timezone_set('America/Mexico_City');
      header('Content-type: application/x-msexcel'); 
      header("Content-Type: application/vnd.ms-excel" );
      header("Expires: 0" );
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
      if ($_REQUEST['id_tipo']==2)
             $texto='Content-Disposition: attachment;filename="encuestaFinal' . "_" . $nombasig[0] . "_". $nombsem['nombre_sem'].'.xls"';
      else 
             $texto='Content-Disposition: attachment;filename="encuestaSemanal' . "_" . $nombasig[0] . "_". date("Ymd-His") .'.xls"';
      header($texto);
     ?>

      <?php
          echo '<?xml version="1.0"?><?mso-application progid="Excel.Sheet"?>'; 
      ?>

<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>Luci</Author>
  <LastAuthor>Luci</LastAuthor>
  <Created>2018-08-31T16:55:06Z</Created>
  <LastSaved>2018-08-31T17:31:02Z</LastSaved>
  <Version>15.00</Version>
 </DocumentProperties>
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>9735</WindowHeight>
  <WindowWidth>24000</WindowWidth>
  <WindowTopX>0</WindowTopX>
  <WindowTopY>0</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s16" ss:Name="Énfasis2">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#FFFFFF"/>
   <Interior ss:Color="#ED7D31" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="m2352482058864">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000" ss:Bold="1"/>
   <Interior ss:Color="#808080" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="m2352482058884">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="@"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m2352482058904" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="m2352482058924" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="m2352482058944">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000" ss:Bold="1"/>
   <Interior ss:Color="#808080" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="m2352482058964">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000" ss:Bold="1"/>
   <Interior ss:Color="#808080" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="m2352482058984">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000" ss:Bold="1"/>
   <Interior ss:Color="#808080" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="m2352482059004">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000" ss:Bold="1"/>
   <Interior ss:Color="#808080" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="m2352482059024">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000" ss:Bold="1"/>
   <Interior ss:Color="#808080" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s17">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="@"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s18">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s19">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s20">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s21">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s22">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s23">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s24">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s25">
   <Borders/>
  </Style>
  <Style ss:ID="s26">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s28">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s29">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s30">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s43">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s44">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s45">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s46">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s51">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000" ss:Bold="1"/>
   <Interior ss:Color="#808080" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s114">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s115">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s116">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s117">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s118">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s119">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s122">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s124">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s125" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s126" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="0"/>
  </Style>
  <Style ss:ID="s127" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="0"/>
  </Style>
  <Style ss:ID="s128" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s129" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s130" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s131" ss:Parent="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
  </Style>
 </Styles>
 <?php
 
 
 $numtopico = 0;
  if ($_REQUEST['id_tipo'] != 2){
          $queryp="SELECT * FROM formato f
                  JOIN cat_preg cp
                  ON f.id_preg=cp.id_preg
                  JOIN cat_topico ct
                  ON ct.id_cat_topico=cp.id_cat_topico
                  WHERE id_lab=".$_SESSION['id_lab'];
				  //echo 'entra a cons1 id_tipo!=2';
  }
else 
         { 
		  $queryp="SELECT * FROM formato f
                  JOIN cat_preg cp
                  ON f.id_preg=cp.id_preg
                  JOIN cat_topico ct
                  ON ct.id_cat_topico=cp.id_cat_topico
                  WHERE id_lab=".$_SESSION['id_lab'] .
				  " AND ct.id_cat_topico!=3 AND ct.id_cat_topico!=7";
				  //echo 'entra a cons1 id_tipo==2';
		 }
	//echo 'cons1';
	//echo $queryp;	 
	 
		  $registrop = pg_query($con,$queryp);
       
          $nopreg= pg_num_rows($registrop); 
		  
		 
		
		  while ($topico = pg_fetch_array($registrop, NULL,PGSQL_ASSOC)) 
		  {  
		     
               
				
				if ($_REQUEST['id_tipo'] != 2){
		             $queryt="SELECT * FROM formato f
                              JOIN cat_preg cp
                              ON f.id_preg=cp.id_preg
                              JOIN cat_topico ct
                              ON ct.id_cat_topico=cp.id_cat_topico
                              WHERE id_lab=".$_SESSION['id_lab'].
				              " AND ct.id_cat_topico=".$topico['id_cat_topico'];
							  //echo 'entra a cons2 id_tipo!=2';
				}else{ 
				     $queryt="SELECT * FROM formato f
                              JOIN cat_preg cp
                              ON f.id_preg=cp.id_preg
                              JOIN cat_topico ct
                              ON ct.id_cat_topico=cp.id_cat_topico
                              WHERE id_lab=".$_SESSION['id_lab'].
							  " AND ct.id_cat_topico!=3 AND ct.id_cat_topico!=7
				                AND ct.id_cat_topico=".$topico['id_cat_topico'];
							//	echo 'entra a cons2 id_tipo==2';
				}
					//echo 'cons2';
	                //echo $queryt;
				  
                  $registrot = pg_query($con,$queryt);
       
                  $nopregxtop= pg_num_rows($registrot); 
				  
				  if ($topico['id_cat_topico']==1)
				      $nopxt1= $nopregxtop;
				  if ($topico['id_cat_topico']==2)
				      $nopxt2= $nopregxtop;	  
				  if ($topico['id_cat_topico']==3)
				      $nopxt3= $nopregxtop;		  
				  if ($topico['id_cat_topico']==4)
				      $nopxt4= $nopregxtop;	  
				  if ($topico['id_cat_topico']==5)
				      $nopxt5= $nopregxtop;	  
				  if ($topico['id_cat_topico']==6)
				      $nopxt6= $nopregxtop;	
			      if ($topico['id_cat_topico']==7)
				      $nopxt7= $nopregxtop;		
					  
					  	  
		   }
 
 ?>
 <Worksheet ss:Name="Hoja1">
  <Table ss:ExpandedColumnCount="21" ss:ExpandedRowCount="65" x:FullColumns="1"
   x:FullRows="1" ss:DefaultColumnWidth="60" ss:DefaultRowHeight="15">
   <Column ss:AutoFitWidth="0" ss:Width="72"/>
   <Column ss:AutoFitWidth="0" ss:Width="371.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="82.5" ss:Span="16"/>
   <Column ss:Index="20" ss:AutoFitWidth="0" ss:Width="318.75"/>
   <Row ss:Height="27">
    <Cell ss:MergeDown="1" ss:StyleID="m2352482058924"><Data ss:Type="String">GRUPO</Data></Cell>
    <Cell ss:MergeDown="1" ss:StyleID="m2352482058904"><Data ss:Type="String">ALUMNOS</Data></Cell>
    <Cell ss:MergeAcross="<?php echo $nopxt1-1;?>" ss:StyleID="m2352482058944"><Data ss:Type="String"><?php echo $renglon_rep[0]['nomb_topico']?></Data></Cell>
    <Cell ss:StyleID="s51"><Data ss:Type="String"><?php echo $renglon_rep[$nopxt1]['nomb_topico']?></Data></Cell>
    <?php if ( $_REQUEST['id_tipo']==1){?>
          <Cell ss:MergeAcross="<?php echo $nopxt3-1;?>" ss:StyleID="m2352482058964"><Data ss:Type="String"><?php  echo $renglon_rep[$nopxt1+$nopxt2]['nomb_topico']?></Data></Cell>
    <?php  } else { }?>
    
    <Cell ss:MergeAcross="<?php echo $nopxt4-1;?>" ss:StyleID="m2352482058984"><Data ss:Type="String"><?php echo $renglon_rep[$nopxt1+$nopxt2+$nopxt3]['nomb_topico']?></Data></Cell>
    <Cell ss:MergeAcross="<?php echo $nopxt5-1;?>" ss:StyleID="m2352482059004"><Data ss:Type="String"><?php echo $renglon_rep[$nopxt1+$nopxt2+$nopxt3+$nopxt4]['nomb_topico']?></Data></Cell>
    <Cell ss:MergeAcross="<?php echo $nopxt6-1;?>" ss:StyleID="m2352482059024"><Data ss:Type="String"><?php echo $renglon_rep[$nopxt1+$nopxt2+$nopxt3+$nopxt4+$nopxt5]['nomb_topico']?></Data></Cell>
  <?php if ( $_REQUEST['id_tipo']==1){?>  
   <Cell ss:MergeAcross="<?php echo $nopxt7-1;?>" ss:StyleID="m2352482058864"><Data ss:Type="String"><?php echo $renglon_rep[$nopxt2+$nopxt3+$nopxt4+$nopxt5+$nopxt6+$nopxt7]['nomb_topico']?></Data></Cell>
  <?php  }else{ }?>
  
    <Cell  ss:StyleID="s51"><Data ss:Type="String">Comentarios</Data></Cell>
   </Row>
   
   
   <Row ss:Height="22.5">
    <Cell ss:Index="3" ss:StyleID="s125"><Data ss:Type="String"><?php  echo $renglon_rep[0]['pregunta_texto']?></Data></Cell>
   <?php 
     for ($j=1;$j<$nopreg;$j++){  //numero de preguntas hacerlo dinámico
      //<Cell ss:MergeDown="3" ss:StyleID="m2352482058884"><Data ss:Type="String">1</Data></Cell>
    ?>
   
         <Cell ss:StyleID="s126"><Data ss:Type="String"><?php echo $renglon_rep[$j]['pregunta_texto']?></Data></Cell>
    
    <?php
     } //fin del for número de preguntas

    ?>
    <Cell ss:StyleID="s129"><Data ss:Type="String">Comentarios Generales</Data></Cell>
   </Row>
   

  <?php

  for ($k=0;$k<count($renglon_rep);$k++) { ?>
	
    <?php if (($k%$nopreg)==0){ ?>
     <Row ss:Height="20.25">
    <Cell  ss:StyleID="m2352482058884"><Data ss:Type="String"><?php echo $renglon_rep[$k]['no_grupo']?></Data></Cell>
    <Cell  ss:StyleID="s114"><Data ss:Type="String"><?php echo $renglon_rep[$k]['nombre_alumno'] ." ". $renglon_rep[$k]['ap_mat_alumno'] ;?></Data></Cell>
     <?php 
	
       for ($i=0;$i<$nopreg;$i++){  //número de preguntas hacerlo dinámico
       //<Cell ss:MergeDown="3" ss:StyleID="m2352482058884"><Data ss:Type="String">1</Data></Cell>
       ?>
          <Cell  ss:StyleID="s124"><Data ss:Type="String"><?php 
		   if ($renglon_rep[$k+$i]['calif']==NULL) 
		       echo $renglon_rep[$k+$i]['resp_bool'];
	       else 
		       echo $renglon_rep[$k+$i]['calif'];
		   ?></Data></Cell>
       <?php
       } //fin del for número de preguntas 
	?>
         <Cell   ss:StyleID="s46"><Data ss:Type="String"><?php echo $renglon_rep[$k]['comentarios']?></Data></Cell>
        </Row>
    <?php
	} ?>
		 
         
	
	
 	<?php
	
  }// Tuplas ?>
    

  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Header x:Margin="0.3"/>
    <Footer x:Margin="0.3"/>
    <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
   </PageSetup>
   <Print>
    <ValidPrinterInfo/>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
   </Print>
   <Zoom>70</Zoom>
   <Selected/>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>19</ActiveRow>
     <ActiveCol>8</ActiveCol>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>
<?php
/*}else
             {
				 
			require_once('../inc/encabezado.inc.php'); 	?>
             <section id="page-title">

          
                <div class="container">
			 
                    <div class="titulo-interfaz">
                         <h2>Configurando Encuestas</h2>
                     </div>  
                      <p>
                           <div style="text-align:center;"><h2>Reportes</h2></div>
                        </p>
 
                 </div>
             </section><!-- Titulo end -->    
             
     
                        <section id="content">
                             <div class="container">  
   
                               <?php
			                     require_once('../inc/configuraResultados.inc.php'); ?>
                               
			                     <p>
                                    <div style="text-align:center;"><h3>No hay datos a exportar</h3></div>
                                  </p>
			                 
			  <?php  
			   require_once('../inc/pie.inc.php');   
              } ?>
			  */