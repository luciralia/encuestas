
<?php
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<p>procesaInventario</p>
<p>&nbsp;</p>
<?php


echo 'Datos de la encuesta';
print_r($_REQUEST);


if ($_REQUEST['id_tipo'] == 2) {
  
    
    // isertar id_asig_ ad_grupo
    
    if ($ultimoe[0] == NULL)
        $ultimoe[0] = 1;
    else
        $ultimoe[0] = $ultimoe[0] + 1;
    
    $query = "SELECT id_encuesta FROM encuesta
                WHERE id_asig=" . $_SESSION['id_asig'] . "AND no_grupo=" . $_SESSION['no_grupo'] . "AND  TO_DATE(to_char(fecha, 'YYYY/DD/MM'), 'YYYY/DD/MM')=" . "'" . date('Y-m-d') . "'";
    
    $registro = pg_query($con, $query);
    $existee  = pg_num_rows($registro);
    
    echo 'ya existe encuesta para id_asig y no_grupo?' . $existee;
    
    
    
    if ($existee == 0) { //no existe encuesta para id_asig y no_grupo generarla
        
        $query = "SELECT max(id_encuesta) FROM encuesta";
        
        $registro = pg_query($con, $query);
        
        $maxe = pg_fetch_array($registro);
        
        $maxe[0] = $maxe[0] + 1;
        
        $query = "INSERT INTO encuesta (id_encuesta,id_lab,id_tipo,fecha,id_asig,no_grupo) VALUES                       (%d,%d,%d,'%s',%d,%d)";
        $query = sprintf($query, $maxe[0], $_SESSION['id_lab'], $_REQUEST['id_tipo'], date('Y-m-d H:i'), $_SESSION['id_asig'], $_SESSION['no_grupo']);
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en Encuesta Final' . pg_last_error());
        
        $query = "SELECT max(folio_encuesta) FROM encuesta_realiza";
        
        $registro = pg_query($con, $query);
        $ultimoer = pg_fetch_array($registro);
        
        if ($ultimoer[0] == NULL)
            $ultimoer[0] = 1;
        else
            $ultimoer[0] = $ultimoer[0] + 1;
        
        echo 'ultimo de ejemplar de encuesta final' . $ultimoer[0];
        
        $query    = "SELECT max(no_ejemplar) FROM encuesta_realiza
                            WHERE id_encuesta=" . $maxe[0];
        $registro = pg_query($con, $query);
        $ultimoej = pg_fetch_array($registro);
        
        if ($ultimoej[0] == NULL)
            $ultimoej[0] = 1;
        else
            $ultimoej[0] = $ultimoej[0] + 1;
        
        echo 'ultimo de ejemplar de encuesta final' . $ultimoej[0];
        
        
        $query = "INSERT INTO encuesta_realiza (folio_encuesta,id_encuesta,no_ejemplar,folio_insc,fecha,comentarios,correo_elec) VALUES (%d,%d,%d,%d,'%s','%s','%s')";
        $query = sprintf($query, $ultimoer[0], $maxe[0], $ultimoej[0], $_SESSION['folio_insc'], date('Y-m-d H:i'), $_REQUEST['comentarios'], $_REQUEST['correo_elec']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en encuesta_realiza final' . pg_last_error());
        
    } elseif ($existee != 0) { //si ya existe encuesta_final solo inserta ejemplar
        $query = "SELECT id_encuesta FROM encuesta
                                   WHERE id_asig=" . $_SESSION['id_asig'] . "AND no_grupo=" . $_SESSION['no_grupo'] . "AND  TO_DATE(to_char(fecha, 'YYYY/DD/MM'), 'YYYY/DD/MM')=" . "'" . date('Y-m-d') . "'";
        
        $registro = pg_query($con, $query);
        $ultimoe  = pg_fetch_array($registro);
        
        $query    = "SELECT max(folio_encuesta) FROM encuesta_realiza";
        $registro = pg_query($con, $query);
        $ultimoer = pg_fetch_array($registro);
        
        if ($ultimoer[0] == NULL)
            $ultimoer[0] = 1;
        else
            $ultimoer[0] = $ultimoer[0] + 1;
        
        echo 'ultimo de encuesta realiza' . $ultimoer[0];
        
        $query    = "SELECT max(no_ejemplar) FROM encuesta_realiza
                                 WHERE id_encuesta=" . $ultimoe[0];
        $registro = pg_query($con, $query);
        $ultimoej = pg_fetch_array($registro);
        
        if ($ultimoej[0] == NULL)
            $ultimoej[0] = 1;
        else
            $ultimoej[0] = $ultimoej[0] + 1;
        
        echo 'ultimo de ejemplar de encuesta' . $ultimoej[0];
        
        $query = "INSERT INTO encuesta_realiza (folio_encuesta,id_encuesta,no_ejemplar,folio_insc,fecha,comentarios,correo_elec) VALUES (%d,%d,%d,%d,'%s','%s','%s')";
        $query = sprintf($query, $ultimoer[0], $ultimoe[0], $ultimoej[0], $_SESSION['folio_insc'], date('Y-m-d H:i'), $_REQUEST['comentarios'], $_REQUEST['correo_elec']);
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en encuesta_realiza ' . pg_last_error());
        
    } //fin de  si existe encuesta final 
    
} else { // solo si es encuesta final
    
    // Si es el la primer encuesta
    $query    = "SELECT max(id_encuesta) FROM encuesta";
    $registro = pg_query($con, $query);
    $primere  = pg_num_rows($registro);
    echo 'peimer encu', $primere;
    if ($primere == NULL) { //cuando esta vacia la tabla
        $primere[0] = 1;
        $query      = "INSERT INTO encuesta (id_encuesta,id_lab,id_tipo,fecha) VALUES (%d,%d,%d,%d,'%s')";
        $query      = sprintf($query, $primere[0], $_SESSION['id_lab'], $_REQUEST['id_tipo'], date('Y-m-d H:i'));
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en Encuesta ' . pg_last_error());
        echo 'inserta primer eencuesta';
    } else {
        
        $query = "SELECT id_encuesta FROM encuesta
        WHERE  TO_DATE(to_char(fecha, 'YYYY/DD/MM'), 'YYYY/DD/MM')=" . "'" . date('Y-m-d') . "'";
        
        $registro = pg_query($con, $query);
        $existee  = pg_num_rows($registro);
        
        echo 'ya existe encuesta para id_asig?' . $existee;
        
        
        //if no existe encuesta para idpractica asig generarla
        //y crear su ejemplar 
        //en caso contrario 
        //solo insertar ejemplar
        
        if ($existee == 0) { //no existe encuesta para idpractica asig generarla
            
            $query = "SELECT max(id_encuesta) FROM encuesta";
            
            $registro = pg_query($con, $query);
            
            $maxe = pg_fetch_array($registro);
            echo '//no existe encuesta para idpractica asig generarla ';
            if ($maxe == NULL && $primere == NULL)
                $maxe[0] = 1;
            else
                $maxe[0] = $maxe[0] + 1;
            
            echo 'maxe ' . $maxe[0];
            
            $query = "INSERT INTO encuesta (id_encuesta,id_practica_asig,id_lab,id_tipo,fecha) VALUES (%d,%d,%d,%d,'%s')";
            $query = sprintf($query, $maxe[0], $_REQUEST['id_practica_asig'], $_SESSION['id_lab'], $_REQUEST['id_tipo'], date('Y-m-d H:i'));
            $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en Encuesta ' . pg_last_error());
            
            $query    = "SELECT max(folio_encuesta) FROM encuesta_realiza";
            $registro = pg_query($con, $query);
            $ultimoer = pg_fetch_array($registro);
            
            if ($ultimoer[0] == NULL)
                $ultimoer[0] = 1;
            else
                $ultimoer[0] = $ultimoer[0] + 1;
            
            echo 'ultimo de encuesta realiza' . $ultimoer[0];
            
            $query    = "SELECT max(no_ejemplar) FROM encuesta_realiza
         WHERE id_encuesta=" . $maxe[0];
            $registro = pg_query($con, $query);
            $ultimoej = pg_fetch_array($registro);
            
            if ($ultimoej[0] == NULL)
                $ultimoej[0] = 1;
            else
                $ultimoej[0] = $ultimoej[0] + 1;
            echo 'ultimo de ejemplar de encuesta' . $ultimoej[0];
            
            $query = "INSERT INTO encuesta_realiza (folio_encuesta,id_encuesta,no_ejemplar,folio_insc,fecha,comentarios,equipo) VALUES (%d,%d,%d,%d,'%s','%s','%s')";
            $query = sprintf($query, $ultimoer[0], $maxe[0], $ultimoej[0], $_SESSION['folio_insc'], date('Y-m-d H:i'), $_REQUEST['comentarios'], $_REQUEST['equipo']);
            $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en encuesta_realiza ' . pg_last_error());
            
            echo 'inserta su ejemplar';
            
        } else {
            //solo inserta ejemplar de la encuesta para id_practica_asig    
            $query    = "SELECT id_encuesta FROM encuesta
             WHERE id_practica_asig=" . $_REQUEST['id_practica_asig'];
            $registro = pg_query($con, $query);
            echo 'Existe encuesta para idpractica asig generarla';
            $maxe = pg_fetch_array($registro);
            
            echo 'maxe' . $maxe[0];
            
            echo '    //solo inserta ejemplar de la encuesta para id_practica_asig    ';
            
            $query    = "SELECT max(folio_encuesta) FROM encuesta_realiza";
            $registro = pg_query($con, $query);
            $ultimoer = pg_fetch_array($registro);
            
            if ($ultimoer[0] == NULL)
                $ultimoer[0] = 1;
            else
                $ultimoer[0] = $ultimoer[0] + 1;
            
            echo 'ultimo de encuesta realiza' . $ultimoer[0];
            
            $query    = "SELECT max(no_ejemplar) FROM encuesta_realiza
         WHERE id_encuesta=" . $maxe[0];
            $registro = pg_query($con, $query);
            $ultimoej = pg_fetch_array($registro);
            
            if ($ultimoej[0] == NULL)
                $ultimoej[0] = 1;
            else
                $ultimoej[0] = $ultimoej[0] + 1;
            echo 'ultimo de ejemplar de encuesta' . $ultimoej[0];
            
            $query = "INSERT INTO encuesta_realiza (folio_encuesta,id_encuesta,no_ejemplar,folio_insc,fecha,comentarios,equipo) VALUES (%d,%d,%d,%d,'%s','%s','%s')";
            $query = sprintf($query, $ultimoer[0], $maxe[0], $ultimoej[0], $_SESSION['folio_insc'], date('Y-m-d H:i'), $_REQUEST['comentarios'], $_REQUEST['equipo']);
            $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en encuesta_realiza ' . pg_last_error());
            
            
        }
        
    }
}
   
    //Inserta en encuesta
    
    // guardar respuesta1
    if (isset($_REQUEST['id_cat_calif1']) || (isset($_REQUEST['resp_abierta1']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif1'], $_REQUEST['resp_abierta1']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta1' . pg_last_error());
        
        echo 'guardo rsp1';
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 1);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg1 ' . pg_last_error());
    }
    // guardar respuesta2
    if (isset($_REQUEST['id_cat_calif2']) || (isset($_REQUEST['resp_abierta2']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta(id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif2'], $_REQUEST['resp_abierta2']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta2 ' . pg_last_error());
        
        echo 'guardo rsp2';
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 2);
        
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg2' . pg_last_error());
    }
    // guardar respuesta3
    if (isset($_REQUEST['id_cat_calif3']) || (isset($_REQUEST['resp_abierta3']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif3'], $_REQUEST['resp_abierta3']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta3 ' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 3);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg3 ' . pg_last_error());
        
    }
    // guardar respuesta4
    if (isset($_REQUEST['id_cat_calif4']) || (isset($_REQUEST['resp_abierta4']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif4'], $_REQUEST['resp_abierta4']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta4 ' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 4);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg4 ' . pg_last_error());
    }
    // guardar respuesta5
    if (isset($_REQUEST['id_cat_calif5']) || (isset($_REQUEST['resp_abierta5']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif5'], $_REQUEST['resp_abierta5']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta5 ' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 5);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg 5' . pg_last_error());
        
    }
    // guardar respuesta6
    if (isset($_REQUEST['id_cat_calif6']) || (isset($_REQUEST['resp_abierta6']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif6'], $_REQUEST['resp_abierta6']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 6' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 6);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg 6' . pg_last_error());
    }
    // guardar respuesta7
    if (isset($_REQUEST['id_cat_calif7']) || (isset($_REQUEST['resp_abierta7']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif7'], $_REQUEST['resp_abierta7']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 7' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 7);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg7 ' . pg_last_error());
    }
    // guardar respuesta8
    if (isset($_REQUEST['id_cat_calif8']) || (isset($_REQUEST['resp_abierta8']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif8'], $_REQUEST['resp_abierta8']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 8' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 8);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg8 ' . pg_last_error());
    }
    // guardar respuesta9
    if (isset($_REQUEST['id_cat_calif9']) || (isset($_REQUEST['resp_abierta9']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif9'], $_REQUEST['resp_abierta9']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 9' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 9);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg9 ' . pg_last_error());
    }
    // guardar respuesta10
    if (isset($_REQUEST['id_cat_calif10']) || (isset($_REQUEST['resp_abierta10']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif10'], $_REQUEST['resp_abierta10']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 10' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 10);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg10 ' . pg_last_error());
        
    }
    // guardar respuesta11
    if (isset($_REQUEST['id_cat_calif11']) || (isset($_REQUEST['resp_abierta11']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif11'], $_REQUEST['resp_abierta11']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 11' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 11);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg11 ' . pg_last_error());
    }
    // guardar respuesta12
    if (isset($_REQUEST['id_cat_calif12']) || (isset($_REQUEST['resp_abierta12']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif12'], $_REQUEST['resp_abierta12']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 12' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 12);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg12 ' . pg_last_error());
        
    }
    // guardar respuesta13
    if (isset($_REQUEST['id_cat_calif13']) || (isset($_REQUEST['resp_abierta13']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        $query = "INSERT INTO respuesta (id_respuesta,id_cat_calif,resp_abierta) VALUES (%d,%d,'%s')";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['id_cat_calif13'], $_REQUEST['resp_abierta13']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 13' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 13);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg13 ' . pg_last_error());
    }
    // guardar respuesta14
    if (isset($_REQUEST['id_cat_calif14']) || (isset($_REQUEST['resp_bool14']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        echo 'antes de gusrdar rsp14';
        
        $query = "INSERT INTO respuesta (id_respuesta,resp_abierta,resp_bool) VALUES (%d,'%s',%d)";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['resp_abierta14'], $_REQUEST['resp_bool14']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 14' . pg_last_error());
        echo 'despúes de gusrdar rsp14';
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 14);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg14 ' . pg_last_error());
    }
    // guardar respuesta15
    if (isset($_REQUEST['id_cat_calif15']) || (isset($_REQUEST['resp_bool15']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        echo 'antes de gusrdar rsp15';
        
        $query = "INSERT INTO respuesta (id_respuesta,resp_abierta,resp_bool) VALUES (%d,'%s',%d)";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['resp_abierta15'], $_REQUEST['resp_bool15']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 15' . pg_last_error());
        
        echo 'despues de gusrdar rsp15';
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 15);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg15 ' . pg_last_error());
        
    }
    // guardar respuesta16
    if (isset($_REQUEST['id_cat_calif16']) || (isset($_REQUEST['resp_bool16']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        
        
        $query = "INSERT INTO respuesta (id_respuesta,resp_abierta,resp_bool) VALUES (%d,'%s',%d)";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['resp_abierta16'], $_REQUEST['resp_bool16']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 16' . pg_last_error());
        
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 16);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg16 ' . pg_last_error());
        
    }
    // guardar respuesta17
    if (isset($_REQUEST['id_cat_calif17']) || (isset($_REQUEST['resp_bool17']))) {
        $query    = "SELECT max(id_respuesta) FROM respuesta";
        $registro = pg_query($con, $query);
        $ultimor  = pg_fetch_array($registro);
        
        if ($ultimor[0] == NULL)
            $ultimor[0] = 1;
        else
            $ultimor[0] = $ultimor[0] + 1;
        
        
        $query = "INSERT INTO respuesta (id_respuesta,resp_abierta,resp_bool) VALUES (%d,'%s',%d)";
        
        $query = sprintf($query, $ultimor[0], $_REQUEST['resp_abierta17'], $_REQUEST['resp_bool17']);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en respuesta 17' . pg_last_error());
        
        // llenar informacion en topicopreg
        
        $query    = "SELECT max(id_topico_preg) FROM topicopreg";
        $registro = pg_query($con, $query);
        $ultimotp = pg_fetch_array($registro);
        
        if ($ultimotp[0] == NULL)
            $ultimotp[0] = 1;
        else
            $ultimotp[0] = $ultimotp[0] + 1;
        
        
        $query = "INSERT INTO topicopreg (id_topico_preg,folio_encuesta,id_respuesta,id_preg) VALUES (%d,%d,%d,%d)";
        
        $query = sprintf($query, $ultimotp[0], $ultimoer[0], $ultimor[0], 17);
        
        $result = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS en topicopreg17 ' . pg_last_error());
        
    } //firn guerde resp17
    
    $strqueryd = "UPDATE encuesta_realiza SET comentarios='%s', equipo='%s'
WHERE folio_encuesta=" . $ultimoer[0];
    
    $queryud = sprintf($strqueryd, $_REQUEST['comentarios'], $_REQUEST['equipo']);
    
    $result = pg_query($con, $queryud) or die('ERROR AL ACTUALIZAR DATOS EN TABLA encuesta_realiza: ' . pg_last_error());
    
    $direccion = 'location: ../inc/salir.inc.php';
    echo $direccion;
    header($direccion);
    
    if ($_POST['accione'] == 'Cancelar' || $_POST['accionn'] == 'Cancelar') {
        $direccion = 'location: ../view/inicio.html.php';
        
        echo $direccion;
        header($direccion);
        
    }

?>

