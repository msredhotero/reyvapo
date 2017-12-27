<?php


include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');

$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();


$resTraerProductos = $serviciosReferencias->traerProductos();	

header("content-type: Access-Control-Allow-Origin: *");

$ar = array();

	while ($row = mysql_fetch_array($resTraerProductos)) {

		array_push($ar,array('producto'=>$row['marca'].' - '.$row['modelo'], 'id'=> $row[0]));
	}

//echo "[".substr($cad,0,-1)."]";
echo json_encode($ar);

?>