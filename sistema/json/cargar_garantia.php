<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();


//Recibimos el Array y lo decodificamos desde json, para poder utilizarlo como objeto


//$DATA     = json_decode($_POST['data']);
$json = $_POST['data'];
//'[{"id":"1","sistema":"1","tela":"1","residuo":"1","telaopcional":"0","alto":"2","ancho":"1","totalparcial":"880","usuacrea":"Saupurein Marcos","refusuarios":1}]';

$json = json_decode($json);

$codigo = $serviciosReferencias->generarCodigoGarantia();

$refGarantia = $serviciosReferencias->insertarGarantia($codigo,$json[0]->nombre,$json[0]->reflocales,$json[0]->refproductos,$json[0]->email,date('Y-m-d'),date('Y-m-d'),$json[0]->observaciones,$json[0]->telefono,$json[0]->nroserie);

if ($refGarantia == '') {
	echo 'Se registro el producto correctamente!!.';
} else {
	echo $refGarantia;
}

?>