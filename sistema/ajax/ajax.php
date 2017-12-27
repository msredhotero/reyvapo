<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();


$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;

case 'insertarGarantia':
insertarGarantia($serviciosReferencias);
break;
case 'modificarGarantia':
modificarGarantia($serviciosReferencias);
break;
case 'eliminarGarantia':
eliminarGarantia($serviciosReferencias);
break;
case 'insertarProductos':
insertarProductos($serviciosReferencias);
break;
case 'modificarProductos':
modificarProductos($serviciosReferencias);
break;
case 'eliminarProductos':
eliminarProductos($serviciosReferencias);
break;


case 'insertarLocales':
insertarLocales($serviciosReferencias);
break;
case 'modificarLocales':
modificarLocales($serviciosReferencias);
break;
case 'eliminarLocales':
eliminarLocales($serviciosReferencias);
break;



}





/* Fin */
/*

/********* cotizador *******************/

function insertarGarantia($serviciosReferencias) {
	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$reflocales = $_POST['reflocales'];
	$refproductos = $_POST['refproductos'];
	$email = $_POST['email'];
	$fecharegistro = $_POST['fecharegistro'];
	$fechacompra = $_POST['fechacompra'];
	$observaciones = $_POST['observaciones'];
	$telefono = $_POST['telefono'];
	
	$res = $serviciosReferencias->insertarGarantia($codigo,$nombre,$reflocales,$refproductos,$email,$fecharegistro,$fechacompra,$observaciones,$telefono);
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}


function modificarGarantia($serviciosReferencias) {
	$id = $_POST['id'];
	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$reflocales = $_POST['reflocales'];
	$refproductos = $_POST['refproductos'];
	$email = $_POST['email'];
	$fecharegistro = $_POST['fecharegistro'];
	$fechacompra = $_POST['fechacompra'];
	$observaciones = $_POST['observaciones'];
	$telefono = $_POST['telefono'];
	
	$res = $serviciosReferencias->modificarGarantia($id,$codigo,$nombre,$reflocales,$refproductos,$email,$fecharegistro,$fechacompra,$observaciones,$telefono);
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}


function eliminarGarantia($serviciosReferencias) {
	$id = $_POST['id'];
	
	$res = $serviciosReferencias->eliminarGarantia($id);
	echo $res;
}


function insertarProductos($serviciosReferencias) {
	$nombre = $_POST['nombre'];
	$codigo = $_POST['codigo'];
	$marca = $_POST['marca'];
	$modelo = $_POST['modelo'];
	
	$res = $serviciosReferencias->insertarProductos($nombre,$codigo,$marca,$modelo);
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}

function modificarProductos($serviciosReferencias) {
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$codigo = $_POST['codigo'];
	$marca = $_POST['marca'];
	$modelo = $_POST['modelo'];
	
	$res = $serviciosReferencias->modificarProductos($id,$nombre,$codigo,$marca,$modelo);
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}


function eliminarProductos($serviciosReferencias) {
	$id = $_POST['id'];
	$res = $serviciosReferencias->eliminarProductos($id);
	echo $res;
}


function insertarLocales($serviciosReferencias) {
	$nombre = $_POST['nombre'];
	$codigo = $_POST['codigo'];
	$domicilio = $_POST['domicilio'];
	$localidad = $_POST['localidad'];
	$contacto = $_POST['contacto'];
	$observaciones = $_POST['observaciones'];
	
	$res = $serviciosReferencias->insertarLocales($nombre,$codigo,$domicilio,$localidad,$contacto,$observaciones);
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}


function modificarLocales($serviciosReferencias) {
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$codigo = $_POST['codigo'];
	$domicilio = $_POST['domicilio'];
	$localidad = $_POST['localidad'];
	$contacto = $_POST['contacto'];
	$observaciones = $_POST['observaciones'];
	
	$res = $serviciosReferencias->modificarLocales($id,$nombre,$codigo,$domicilio,$localidad,$contacto,$observaciones);
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}

function eliminarLocales($serviciosReferencias) {
	$id = $_POST['id'];
	$res = $serviciosReferencias->eliminarLocales($id);
	echo $res;
}


/* Fin */

////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function registrar($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function insertarUsuario($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	echo $serviciosUsuarios->modificarUsuario($id,$usuario,$password,$refroll,$email,$nombre);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	//$idempresa  =	$_POST['idempresa'];
	
	echo $serviciosUsuarios->login($email,$pass);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>