<?php


include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');

$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();


$resTraerLocales = $serviciosReferencias->traerLocales();	

header("content-type: Access-Control-Allow-Origin: *");

$ar = array();

	while ($row = mysql_fetch_array($resTraerLocales)) {

		array_push($ar,array('local'=>$row['nombre'], 'id'=> $row[0]));
	}

//echo "[".substr($cad,0,-1)."]";
echo json_encode($ar);

?>