<?php
require_once('../conexion.php');

class Reporte{

function rengReporte($idlab,$idasig,$tipo,$idsem){

//echo "datos que llegan:$idlab,$idasig";

if ($tipo==1){

 $query="select er.folio_encuesta,e.id_encuesta,no_ejemplar, nombre_asig,i.no_grupo,al.no_cuenta,al.nombre_alumno,al.ap_pat_alumno,al.ap_mat_alumno,nopractica,nomb_practica,cp.id_preg,pregunta_texto,nomb_topico,calif,resp_abierta,resp_bool,comentarios from encuesta_realiza er
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
join cat_topico ct
on ct.id_cat_topico=cp.id_cat_topico
join respuesta r
on r.id_respuesta=tp.id_respuesta
left join cat_calif_resp ccr
on ccr.id_cat_calif=r.id_cat_calif
where e.id_lab= ". $idlab.
" and i.id_asig= ". $idasig.
" order by er.folio_encuesta";
}
else {
 $query="select er.folio_encuesta,e.id_encuesta,no_ejemplar, et.id_tipo,nombre_asig,i.no_grupo,al.no_cuenta,al.nombre_alumno,al.ap_pat_alumno,al.ap_mat_alumno,cp.id_preg,pregunta_texto,nomb_topico,calif,resp_abierta,resp_bool,comentarios,e.id_tipo from encuesta_realiza er
join encuesta e
on e.id_encuesta=er.id_encuesta
left join encuesta_tipo et
on et.id_tipo=e.id_tipo
join inscribe i
on er.folio_insc=i.folio_insc
join semestre s
on s.id_semestre=i.id_semestre
join alumno al
on al.no_cuenta=i.no_cuenta
join asignatura a
on a.id_asig=i.id_asig
join topicopreg tp
on tp.folio_encuesta=er.folio_encuesta
join cat_preg cp
on cp.id_preg=tp.id_preg
join cat_topico ct
on ct.id_cat_topico=cp.id_cat_topico
join respuesta r
on r.id_respuesta=tp.id_respuesta
left join cat_calif_resp ccr
on ccr.id_cat_calif=r.id_cat_calif
where e.id_lab= ". $idlab .
" and et.id_tipo= ". $tipo .
" and e.id_asig= ". $idasig .
" and i.id_semestre= ". $idsem .
" order by er.folio_encuesta";

}

$result = pg_query($query) or die('Hubo un error con la base de datos');



		while ($datosrep = pg_fetch_array($result, NULL, PGSQL_ASSOC))	{
            // echo "</br>el valor de los datosrep dentro del while" . "    " . print_r($datosrep) . "</br>";
		     $this->datos[]=$datosrep;
			
		}
	
//echo "</br>el valor de los datosrep" . "    " . print_r($datosrep) . "</br></br></br>";
//echo "</br>el valor de los datos" . "    " . print_r($datos). "</br></br></br>";
	return $this->datos;
	unset ($datos);

}//termina metodo rengrep

}