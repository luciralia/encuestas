
<?php
session_start(); 
require_once('../conexion.php'); 
date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
//header("Content-type: text/html");



$query="SELECT nombre_asig FROM asignatura
           WHERE id_asig=" . $_REQUEST['id_asig'] ;
$registro = pg_query($con,$query);
$nombasig= pg_fetch_array($registro);


$texto='Content-Disposition: attachment;filename="encuesta' . "_" . $nombasig[0] . "_". date("Ymd-His") .'.xls"';
header($texto);



print_r($_REQUEST);


?>

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

$datos = pg_query($con,$query);
$resultados= pg_num_rows($datos); 





echo '<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>'
; 
?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>CPD</Author>
  <LastAuthor>CPD</LastAuthor>
  <LastPrinted>2015-09-08T18:00:57Z</LastPrinted>
  <Created>2015-10-01T03:48:17Z</Created>
  <LastSaved>2015-09-28T21:45:24Z</LastSaved>
  <Version>14.00</Version>
 </DocumentProperties>
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>7875</WindowHeight>
  <WindowWidth>15360</WindowWidth>
  <WindowTopX>0</WindowTopX>
  <WindowTopY>2460</WindowTopY>
  <TabRatio>601</TabRatio>
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
  <Style ss:ID="s42" ss:Name="Énfasis2">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#FFFFFF"/>
   <Interior ss:Color="#C0504D" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="m133908224">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908244">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908264">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908284">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908304">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133908324">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133908000">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908020">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908040">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908060">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133908080">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133908100">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908120">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908140">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908160">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133908180">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907776">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907796">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907816">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907836">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907856">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907876">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907552">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907572">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907592">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907612">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907632">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>

  </Style>
  <Style ss:ID="m133907652">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133906880">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906900">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906920">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906940">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133906960">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133906980">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"

    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907000">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907020">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907040">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133907060">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906432">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906452">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906472">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906492">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906512">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906532">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906144">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906164">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906184">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906204">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906224">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133906244">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133905920">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905940">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905960">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905980">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133906000">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133906020">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906040">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906060">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906080">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133906100">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905696">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905716">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905736">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905756">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905776">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905796">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905472">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905492">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905512">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905532">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905552">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133905572">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133905248">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905268">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905288">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905308">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133905328">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133905348">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905368">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905388">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905408">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905428">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905024">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905044">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905064">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905084">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905104">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133905124">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904800">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904820">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904840">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904860">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904880">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133904900">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133904576">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904596">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904616">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904636">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133904656">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133904676">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904696">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904716">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904736">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904756">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904352">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904372">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904392">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904412">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904432">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904452">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904128">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904148">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904168">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904188">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904208">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133904228">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133903904">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000" ss:Bold="1"/>
  </Style>
  <Style ss:ID="m133903924" ss:Parent="s42">
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
  <Style ss:ID="m133903944" ss:Parent="s42">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="0"/>
  </Style>
  <Style ss:ID="m133903964" ss:Parent="s42">
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
  <Style ss:ID="m133903984" ss:Parent="s42">
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
  <Style ss:ID="m133904004">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904024">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904044">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904064">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133904084">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m133903456">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133903476">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="27"
    ss:Color="#000000" ss:Bold="1"/>
  </Style>
  <Style ss:ID="m133903496">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133903516">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="25"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m133903536">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="25"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s103">
   <Borders>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="11"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s104">
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="11"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s105">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s107">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s108">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="25"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s109">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="26"
    ss:Color="#FF0000"/>
  </Style>
  <Style ss:ID="s110">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="11"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s111">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s120" ss:Parent="s42">
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
  <Style ss:ID="s128" ss:Parent="s42">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s137" ss:Parent="s42">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="0"/>
  </Style>
  <Style ss:ID="s138" ss:Parent="s42">
   <Alignment ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s143" ss:Parent="s42">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="17" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s144">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="@"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s145">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s195">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="@"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s196">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s197">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="@"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s198">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="16"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s222">
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="11"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s224">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s226">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s227">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s228">
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
  </Style>
 </Styles>
 <Names>
  <NamedRange ss:Name="LOCAL_DATE_SEPARATOR"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),17)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_DAY_FORMAT" ss:RefersTo="=INDEX(GET.WORKSPACE(37),21)"
   ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_HOUR_FORMAT"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),22)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_MINUTE_FORMAT"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),23)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_MONTH_FORMAT"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),20)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_MYSQL_DATE_FORMAT"
   ss:RefersTo="=REPT(LOCAL_YEAR_FORMAT,4)&amp;LOCAL_DATE_SEPARATOR&amp;REPT(LOCAL_MONTH_FORMAT,2)&amp;LOCAL_DATE_SEPARATOR&amp;REPT(LOCAL_DAY_FORMAT,2)&amp;&quot; &quot;&amp;REPT(LOCAL_HOUR_FORMAT,2)&amp;LOCAL_TIME_SEPARATOR&amp;REPT(LOCAL_MINUTE_FORMAT,2)&amp;LOCAL_TIME_SEPARATOR&amp;REPT(LOCAL_SECOND_FORMAT,2)"
   ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_SECOND_FORMAT"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),24)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_TIME_SEPARATOR"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),18)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_YEAR_FORMAT"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),19)" ss:Hidden="1"/>
 </Names>
 <Worksheet ss:Name="Hoja1">
  <Names>
   <NamedRange ss:Name="Print_Area" ss:RefersTo="=Hoja1!R1C1:R62C21"/>
  </Names>
  <Table ss:ExpandedColumnCount="21" ss:ExpandedRowCount="62" x:FullColumns="1"
   x:FullRows="1" ss:DefaultColumnWidth="60" ss:DefaultRowHeight="15">
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="350"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="50"/>
   <Column ss:AutoFitWidth="0" ss:Width="350"/>
   <Row ss:AutoFitHeight="0" ss:Height="31.5">
    <Cell ss:MergeAcross="4" ss:MergeDown="4" ss:StyleID="m133903456"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="8" ss:MergeDown="4" ss:StyleID="m133903476"><Data
      ss:Type="String">Resultado se las encuestas</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="31.5" ss:Span="3"/>
   <Row ss:Index="6" ss:AutoFitHeight="0" ss:Height="33.75">
    <Cell ss:MergeAcross="13" ss:StyleID="m133903496"><Data ss:Type="String">Vigente a partir del: 28 de septiembre de 2015</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="32.25">
    <Cell ss:MergeAcross="8" ss:StyleID="m133903516"><Data ss:Type="String"><?php echo $_REQUEST['division']?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="4" ss:StyleID="m133903536"><Data ss:Type="String"><?php echo $_REQUEST['laboratorio']?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:StyleID="s103"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s103"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="42">
    <Cell ss:Index="2" ss:StyleID="s105"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s105"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="3" ss:MergeDown="1" ss:StyleID="s107"><Data
      ss:Type="String">Nota: Se refiere a todo el mantenimiento que no se realiza de manera externa (programado en SIELDI).</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s108"><Data ss:Type="String">Semestre:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s109"><Data ss:Type="String"><?php echo $_REQUEST['semestre']?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="29.25">
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="8" ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s110"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="27.75">
    <Cell ss:MergeAcross="1" ss:StyleID="m133903904"><Data ss:Type="String">DATOS</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="3" ss:StyleID="m133903904"><Data ss:Type="String">TOP A</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133903904"><Data ss:Type="String">TOP B</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="m133903904"><Data ss:Type="String">TOP C</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="m133903904"><Data ss:Type="String">TOP D</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:StyleID="m133903904"><Data ss:Type="String">TOP E</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:StyleID="m133903904"><Data ss:Type="String">TOP F</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
 <Cell ss:MergeAcross="1" ss:StyleID="m133903904"><Data ss:Type="String">TOP G</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell  ss:StyleID="m133903904"><Data ss:Type="String">Comentarios</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    
   </Row>
   
   
   <?php 
   
         $querycab="select *
         from formato f
         join cat_preg p
         on p.id_preg=f.id_preg
         join cat_preg cp
         on cp.id_preg=p.id_preg
         join cat_topico ct
         on ct.id_cat_topico=cp.id_cat_topico
         where id_lab=". $_SESSION['id_lab'];

         $datoscab = pg_query($con,$querycab);
       
        
         while ($cabecera= pg_fetch_array($datoscab, NULL,PGSQL_ASSOC)) {?>
   
            <Row ss:AutoFitHeight="0" ss:Height="98.25">
                <Cell  ss:StyleID="m133903924"><Data ss:Type="String">GRUPO</Data><NamedCell
                 ss:Name="Print_Area"/></Cell>
                <Cell ss:StyleID="s120"><Data ss:Type="String">ALUMNOS</Data><NamedCell
                ss:Name="Print_Area"/></Cell>
         <?php     
              $querypreg="select *
                          from formato f
                          join cat_preg p
                          on p.id_preg=f.id_preg
                          join cat_preg cp
                          on cp.id_preg=p.id_preg
                          join cat_topico ct
                          on ct.id_cat_topico=cp.id_cat_topico
                          where id_lab=". $_SESSION['id_lab'].
		                  "and f.id_preg=".$cabecera['id_preg'];
		 

               $cabpreg = pg_query($con,$querypreg);
       
        
               while ($preg= pg_fetch_array($cabpreg, NULL,PGSQL_ASSOC)) { ?>
             
                        <Cell ss:StyleID="s128"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                         ss:Name="Print_Area"/></Cell>
                        <Cell  ss:StyleID="m133903944"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                         ss:Name="Print_Area"/></Cell>
                        <Cell ss:StyleID="s137"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?>/Data><NamedCell
                         ss:Name="Print_Area"/></Cell>
                        <Cell ss:StyleID="s138"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                         ss:Name="Print_Area"/></Cell>
                        <Cell ss:StyleID="m133903964"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                         ss:Name="Print_Area"/></Cell>
                        <Cell ss:StyleID="s120"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>
                        <Cell ss:StyleID="s143"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>
                        <Cell  ss:StyleID="m133903984"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>
                        <Cell ss:StyleID="m133903984"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell> 
                        <Cell  ss:StyleID="m133903984"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>
                        <Cell  ss:StyleID="m133903984"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>   
                        <Cell  ss:StyleID="m133903984"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>  
                        <Cell  ss:StyleID="m133903984"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>    
      
                        <Cell  ss:StyleID="m133903984"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>    
                        <Cell  ss:StyleID="m133903984"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>    
                        <Cell  ss:StyleID="m133903984"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>   
                        <Cell  ss:StyleID="m133903984"><Data ss:Type="String"><?php echo $preg['nombre_preg'];  ?></Data><NamedCell
                        ss:Name="Print_Area"/></Cell>     
                        <Cell  ss:StyleID="m133903984"><Data ss:Type="String">Comentarios Generales</Data><NamedCell
                        ss:Name="Print_Area"/></Cell>           
  
<?php } 
		 }?>
          </Row>
 <!--empieza Renglón de registro    --> 
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><Data ss:Type="String"><?php echo 'GRUPO1';  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    
    <Cell ss:StyleID="m133904004"><Data ss:Type="String"><?php echo 'Alumno1';  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    
    <Cell ss:StyleID="m133904024"><Data ss:Type="String"><?php echo 'califA1p1';  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904044"><Data
      ss:Type="String"><?php echo 'califA1p2';   ?></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904064"><Data ss:Type="String"><?php echo 'califA1p3'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904084"><Data ss:Type="String"><?php echo 'califA1p4'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell  ss:StyleID="m133904128"><Data
      ss:Type="String"><?php echo 'califA1p5'; ?></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904148"><Data ss:Type="String"><?php echo 'califA1p6'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904168"><Data ss:Type="String"><?php echo 'califA1p7'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA1p8'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA1p9'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA1p10'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA1p11'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA1p12'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA1p13'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA1p14'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA1p15'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA1p16'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA1p17'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
        <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'ComentariosA1'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/><Data ss:Type="String"><?php echo'GRUPO1'; ?></Data></Cell>
   
      
      <Cell ss:StyleID="m133904004"><Data ss:Type="String"><?php echo 'Alumno2';  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    
    <Cell ss:StyleID="m133904024"><Data ss:Type="String"><?php echo 'califA2p1';  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904044"><Data
      ss:Type="String"><?php echo 'califA2p2';   ?></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904064"><Data ss:Type="String"><?php echo 'califA2p3'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904084"><Data ss:Type="String"><?php echo 'califA2p4'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell  ss:StyleID="m133904128"><Data
      ss:Type="String"><?php echo 'califA2p5'; ?></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904148"><Data ss:Type="String"><?php echo 'califA2p6'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904168"><Data ss:Type="String"><?php echo 'califA2p7'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA2p8'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA2p9'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA2p10'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA2p11'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA2p12'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA2p13'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA2p14'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA2p15'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA2p16'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA2p17'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
        <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'ComentariosA2'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/><Data ss:Type="String"><?php echo'GRUPO1';  ?></Data></Cell>
     <Cell ss:StyleID="m133904004"><Data ss:Type="String"><?php echo 'Alumno3';  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904024"><Data ss:Type="String"><?php echo 'califA3p1';  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell  ss:StyleID="m133904044"><Data
      ss:Type="String"><?php echo 'califA3p2';   ?></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904064"><Data ss:Type="String"><?php echo 'califA3p3'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904084"><Data ss:Type="String"><?php echo 'califA3p4'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904128"><Data
      ss:Type="String"><?php echo 'califA3p5'; ?></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904148"><Data ss:Type="String"><?php echo 'califA3p6'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904168"><Data ss:Type="String"><?php echo 'califA3p7'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA3p8'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA3p9'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA3p10'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA3p11'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA3p12'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA3p13'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA3p14'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA3p15'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA3p16'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA3p17'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
        <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'ComentariosA3'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/><Data ss:Type="String"><?php echo'GRUPO1'; ?></Data></Cell>
    
    <Cell ss:StyleID="m133904004"><Data ss:Type="String"><?php echo 'Alumno4';  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    
    <Cell ss:StyleID="m133904024"><Data ss:Type="String"><?php echo 'califA4p1';  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell  ss:StyleID="m133904044"><Data
      ss:Type="String"><?php echo 'califA4p2';   ?></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904064"><Data ss:Type="String"><?php echo 'califA4p3'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904084"><Data ss:Type="String"><?php echo 'califA4p4'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell  ss:StyleID="m133904128"><Data
      ss:Type="String"><?php echo 'califA4p5'; ?></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904148"><Data ss:Type="String"><?php echo 'califA4p6'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904168"><Data ss:Type="String"><?php echo 'califA4p7'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA4p8'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA4p9'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA4p10'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA4p11'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA4p12'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA4p13'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA4p14'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA4p15'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA4p16'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
      <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'califA4p17'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
        <Cell ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo 'ComentariosA4'; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>

 <!--Termina Renglón de registro    --> 

   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia2</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904352"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904372"><Data ss:Type="String"></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133904392"><Data
      ss:Type="String"></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904412"><Data ss:Type="String"></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904432"><Data ss:Type="String"></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133904452"><Data
      ss:Type="String"></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904576"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904596"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133904616"><Data
      ss:Type="String"></Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><Data ss:Type="String"></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación2</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><Data ss:Type="String"></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso2</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto2</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133904636"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133904656"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904676"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904696"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133904716"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904736"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904756"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133904800"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904820"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904840"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133904860"><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133904880"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133904900"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905024"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905044"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133905064"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905084"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905104"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133905124"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905248"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905268"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133905288"><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133905308"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133905328"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905348"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905368"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133905388"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905408"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905428"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133905472"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905492"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905512"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133905532"><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133905552"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133905572"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905696"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905716"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133905736"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905756"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905776"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133905796"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905920"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133905940"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133905960"><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133905980"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133906000"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><NamedCell ss:Name="Print_Area"/></Cell>

    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906020"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906040"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133906060"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906080"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906100"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133906144"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906164"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906184"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133906204"><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133906224"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133906244"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906432"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906452"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133906472"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906492"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906512"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133906532"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906880"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906900"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133906920"><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133906940"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133906960"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133906980"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133907000"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133907020"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133907040"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133907060"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133907552"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133907572"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133907592"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133907612"><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133907632"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133907652"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133907776"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133907796"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133907816"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133907836"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133907856"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133907876"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133908000"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133908020"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133908040"><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133908060"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133908080"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133908100"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133908120"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133908140"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133908160"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133908180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133908224"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133908244"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133908264"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133908284"><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133908304"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133908324"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="163.5">
    <Cell ss:StyleID="s222"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s222"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s222"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="3" ss:StyleID="s224"><Data ss:Type="String">*Cómo se detectó la falla:&#10;1) Por una queja en el buzón&#10;2) Por un comentario en la encuesta de satisfacción del servicio&#10;3) Al momento del préstamo del equipo&#10;4) Actividades cotidianas del personal del laboratorio</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s222"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s222"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s222"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s222"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s222"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s222"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s222"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="26.25">
    <Cell ss:MergeAcross="13" ss:StyleID="s226"><Data ss:Type="String">Revisó:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="63.75">
    <Cell ss:StyleID="s227"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s227"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s227"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s227"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s227"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s227"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s227"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s227"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s227"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s228"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s228"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s228"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s228"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s228"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="26.25">
    <Cell ss:MergeAcross="13" ss:StyleID="s226"><Data ss:Type="String"><?php echo $_REQUEST['rl_nombre'] ." ". $_REQUEST['rl_apaterno'] ." ". $_REQUEST['rl_amaterno'];?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="26.25">
    <Cell ss:MergeAcross="13" ss:StyleID="s226"><Data ss:Type="String">Responsable del laboratorio</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="26.25">
    <Cell ss:MergeAcross="13" ss:StyleID="s226"><Data ss:Type="String">Nombre y Firma</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape" x:CenterHorizontal="1" x:CenterVertical="1"/>
    <Header x:Margin="0"/>
    <Footer x:Margin="0"/>
    <PageMargins x:Bottom="0.98425196850393704" x:Left="0.74803149606299213"
     x:Right="0.74803149606299213" x:Top="0.98425196850393704"/>
   </PageSetup>
   <Unsynced/>
   <FitToPage/>
   <Print>
    <ValidPrinterInfo/>
    <Scale>29</Scale>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
   </Print>
   <ShowPageBreakZoom/>
   <Zoom>50</Zoom>
   <PageBreakZoom>40</PageBreakZoom>
   <Selected/>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>24</ActiveRow>
     <ActiveCol>2</ActiveCol>
     <RangeSelection>R25C3:R28C3</RangeSelection>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>


