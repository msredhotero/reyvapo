<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function convertidorMilimetros($medida, $valor) {
	switch ($medida) {
		case 'm':
			$valor = $valor * 1000;
			break;
		case 'dm':
			$valor = $valor * 100;
			break;
		case 'cm':
			$valor = $valor * 10;
			break;	
	}
	return $valor;
}

/* PARA Garantia */

function generarCodigoGarantia() {
	$sql = "select max(idgarantia) as id from dbgarantia";	
	$res = $this->query($sql,0);
	
	if (mysql_num_rows($res)>0) {
		$nro = 'GAR'.str_pad(mysql_result($res,0,0)+1, 7, "0", STR_PAD_LEFT);
	} else {
		$nro = 'GAR0000001';
	}
	
	return $nro;
}


function insertarGarantia($codigo,$nombre,$reflocales,$refproductos,$email,$fecharegistro,$fechacompra,$observaciones,$telefono) {

	$error = '';
	if ($nombre == '') {
		$error .= '* Es obligatorio ingresar el Nombre. <br>';
	}

	if ($email == '') {
		$error .= '* Es obligatorio ingresar el E-Mail. <br>';
	}

	if (($reflocales == '') || ($reflocales == '0')) {
		$error .= '* Es obligatorio ingresar el lugar de compra. <br>';
	}

	if (($refproductos == '') || ($refproductos == '0')) {
		$error .= '* Es obligatorio ingresar un modelo. <br>';
	}


	$sql = "insert into dbgarantia(idgarantia,codigo,nombre,reflocales,refproductos,email,fecharegistro,fechacompra,observaciones,telefono)
values ('','".utf8_decode($codigo)."','".utf8_decode($nombre)."',".$reflocales.",".$refproductos.",'".utf8_decode($email)."','".utf8_decode($fecharegistro)."','".utf8_decode($fechacompra)."','".utf8_decode($observaciones)."','".utf8_decode($telefono)."')";
	
	if ($error == '') {
		$res = $this->query($sql,1);
		$res = '';
	} else {
		$res = $error;
	}
	return $res;
}


function modificarGarantia($id,$codigo,$nombre,$reflocales,$refproductos,$email,$fecharegistro,$fechacompra,$observaciones,$telefono) {
$sql = "update dbgarantia
set
codigo = '".utf8_decode($codigo)."',nombre = '".utf8_decode($nombre)."',reflocales = ".$reflocales.",refproductos = ".$refproductos.",email = '".utf8_decode($email)."',fecharegistro = '".utf8_decode($fecharegistro)."',fechacompra = '".utf8_decode($fechacompra)."',observaciones = '".utf8_decode($observaciones)."',telefono = '".utf8_decode($telefono)."'
where idgarantia =".$id;
$res = $this->query($sql,0);
return $res;
} 


function eliminarGarantia($id) {
$sql = "delete from dbgarantia where idgarantia =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerGarantia() {
$sql = "select
g.idgarantia,
g.codigo,
g.nombre,
g.reflocales,
g.refproductos,
g.email,
g.fecharegistro,
g.fechacompra,
g.observaciones,
g.telefono
from dbgarantia g
inner join tblocales loc ON loc.idlocal = g.reflocales
inner join dbproductos pro ON pro.idproducto = g.refproductos
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerGarantiaCantidad() {
$sql = "select
coalesce(count(g.idgarantia)) as cantidad
from dbgarantia g
inner join tblocales loc ON loc.idlocal = g.reflocales
inner join dbproductos pro ON pro.idproducto = g.refproductos";
$res = $this->query($sql,0);
return $res;
}

function traerGarantiaTodas() {
$sql = "select
g.idgarantia,
g.codigo,
g.nombre,
loc.nombre as local,
pro.nombre as producto,
g.email,
g.telefono,
g.fecharegistro,
g.fechacompra,
g.observaciones,
g.reflocales,
g.refproductos
from dbgarantia g
inner join tblocales loc ON loc.idlocal = g.reflocales
inner join dbproductos pro ON pro.idproducto = g.refproductos
order by g.fecharegistro desc";
$res = $this->query($sql,0);
return $res;
}


function traerGarantiaPorId($id) {
$sql = "select idgarantia,codigo,nombre,reflocales,refproductos,email,fecharegistro,fechacompra,observaciones,telefono from dbgarantia where idgarantia =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbgarantia*/


/* PARA Productos */



function insertarProductos($nombre,$codigo,$marca,$modelo) {
$sql = "insert into dbproductos(idproducto,nombre,codigo,marca,modelo)
values ('','".utf8_decode($nombre)."','".utf8_decode($codigo)."','".utf8_decode($marca)."','".utf8_decode($modelo)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarProductos($id,$nombre,$codigo,$marca,$modelo) {
$sql = "update dbproductos
set
nombre = '".utf8_decode($nombre)."',codigo = '".utf8_decode($codigo)."',marca = '".utf8_decode($marca)."',modelo = '".utf8_decode($modelo)."'
where idproducto =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarProductos($id) {
$sql = "delete from dbproductos where idproducto =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerProductos() {
$sql = "select
p.idproducto,
p.nombre,
p.codigo,
p.marca,
p.modelo
from dbproductos p
order by 1";
$res = $this->query($sql,0);
return $res;
}

function traerProductosCantidad() {
$sql = "select
coalesce(count(p.idproducto)) as cantidad
from dbproductos p";
$res = $this->query($sql,0);
return $res;
}


function traerProductosPorId($id) {
$sql = "select idproducto,nombre,codigo,marca,modelo from dbproductos where idproducto =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbproductos*/


/* PARA Usuarios */

function insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto) {
$sql = "insert into dbusuarios(idusuario,usuario,password,refroles,email,nombrecompleto)
values ('','".utf8_decode($usuario)."','".utf8_decode($password)."',".$refroles.",'".utf8_decode($email)."','".utf8_decode($nombrecompleto)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto) {
$sql = "update dbusuarios
set
usuario = '".utf8_decode($usuario)."',password = '".utf8_decode($password)."',refroles = ".$refroles.",email = '".utf8_decode($email)."',nombrecompleto = '".utf8_decode($nombrecompleto)."'
where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarUsuarios($id) {
$sql = "delete from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerUsuarios() {
$sql = "select
u.idusuario,
u.usuario,
u.password,
u.refroles,
u.email,
u.nombrecompleto
from dbusuarios u
inner join tbroles rol ON rol.idrol = u.refroles
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerUsuariosPorId($id) {
$sql = "select idusuario,usuario,password,refroles,email,nombrecompleto from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbusuarios*/


/* PARA Predio_menu */

function insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "insert into predio_menu(idmenu,url,icono,nombre,Orden,hover,permiso)
values ('','".utf8_decode($url)."','".utf8_decode($icono)."','".utf8_decode($nombre)."',".$Orden.",'".utf8_decode($hover)."','".utf8_decode($permiso)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "update predio_menu
set
url = '".utf8_decode($url)."',icono = '".utf8_decode($icono)."',nombre = '".utf8_decode($nombre)."',Orden = ".$Orden.",hover = '".utf8_decode($hover)."',permiso = '".utf8_decode($permiso)."'
where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPredio_menu($id) {
$sql = "delete from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menu() {
$sql = "select
p.idmenu,
p.url,
p.icono,
p.nombre,
p.Orden,
p.hover,
p.permiso
from predio_menu p
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menuPorId($id) {
$sql = "select idmenu,url,icono,nombre,Orden,hover,permiso from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: predio_menu*/


/* PARA Locales */

function insertarLocales($nombre,$codigo,$domicilio,$localidad,$contacto,$observaciones) {
$sql = "insert into tblocales(idlocal,nombre,codigo,domicilio,localidad,contacto,observaciones)
values ('','".utf8_decode($nombre)."','".utf8_decode($codigo)."','".utf8_decode($domicilio)."','".utf8_decode($localidad)."','".utf8_decode($contacto)."','".utf8_decode($observaciones)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarLocales($id,$nombre,$codigo,$domicilio,$localidad,$contacto,$observaciones) {
$sql = "update tblocales
set
nombre = '".utf8_decode($nombre)."',codigo = '".utf8_decode($codigo)."',domicilio = '".utf8_decode($domicilio)."',localidad = '".utf8_decode($localidad)."',contacto = '".utf8_decode($contacto)."',observaciones = '".utf8_decode($observaciones)."'
where idlocal =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarLocales($id) {
$sql = "delete from tblocales where idlocal =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerLocales() {
$sql = "select
l.idlocal,
l.nombre,
l.codigo,
l.domicilio,
l.localidad,
l.contacto,
l.observaciones
from tblocales l
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerLocalesCantidad() {
$sql = "select
coalesce(count(p.idlocal)) as cantidad
from tblocales p";
$res = $this->query($sql,0);
return $res;
}



function traerLocalesPorId($id) {
$sql = "select idlocal,nombre,codigo,domicilio,localidad,contacto,observaciones from tblocales where idlocal =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tblocales*/



function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>