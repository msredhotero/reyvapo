<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Dashboard",$_SESSION['refroll_predio'],'');


if ($_SESSION['idroll_predio'] != 1) {
	header('Location: cotizador/index.php');
}



/////////////////////// Opciones para la creacion del formulario  /////////////////////

/////////////////////// Opciones para la creacion del view  patente,refmodelo,reftipovehiculo,anio/////////////////////
$cabeceras 		= "	<th>Codigo</th>
					<th>Nombre</th>
					<th>Local</th>
					<th>Producto</th>
					<th>E-Mail</th>
					<th>Telefono</th>
					<th>Nro Serie</th>
					<th>Fecha Reg.</th>
					<th>Fecha Compra</th>
					<th>Obs.</th>";


//////////////////////////////////////////////  FIN de los opciones //////////////////////////

$lstGarantias 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerGarantiaTodas(),10);


$resClientes	=	$serviciosReferencias->traerProductosCantidad();
$resOrdenes		=	$serviciosReferencias->traerGarantiaCantidad();
$resVentas		=	$serviciosReferencias->traerLocalesCantidad();



if (mysql_num_rows($resClientes)>0) {
	$cantClientes			=	mysql_result($resClientes,0,0);
} else {
	$cantClientes			=	0;
}

if (mysql_num_rows($resOrdenes)>0) {
	$cantPedidos			=	mysql_result($resOrdenes,0,0);
} else {
	$cantPedidos			=	0;
}

if (mysql_num_rows($resVentas)>0) {
	$cantVentas			=	mysql_result($resVentas,0,0);
} else {
	$cantVentas			=	0;
}


?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">



<title>Gesti&oacute;n: Sistema de Garantias</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<!--<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>-->
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/chosen.css">


   
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
    
    <script src="../js/jquery.color.min.js"></script>
	<script src="../js/jquery.animateNumber.min.js"></script>
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">
	
    <div class="row" style="margin-top:15px;">
    	<div class="col-md-1">
        </div>
        <div class="col-md-10">
        	<div class="col-md-12">
            	<div class="col-md-4 col-xs-2">
                    <div align="center">
                        <img src="../imagenes/lblVentas.png" width="50%" title="Clientes"/>
                        <p><span id="lblCliente" style="color: red;">0</span></p>
                    </div>
                </div>
                <div class="col-md-4 col-xs-2">
                    <div align="center">
                        <img src="../imagenes/place_png.png" width="50%" title="Ventas">
                        <p><span id="lblVentas" style="color: red;">0</span></p>
                    </div>
                </div>
                

                <div class="col-md-4 col-xs-2">
                    <div align="center">
                        <img src="../imagenes/garantia.png" width="48%" title="Ordenes">
                        <p><span id="lblPedidos" style="color: red;">0</span></p>
                    </div>
                </div>            
            </div>
        </div>
        
        
        
        <div class="col-md-1">
        </div>
    </div>
    

    
    <div class="row" style="margin-right:15px;">
    <div class="col-md-12">
    <div class="panel" style="border-color:#006666;">
				<div class="panel-heading" style="background-color:#006666; color:#FFF; ">
					<h3 class="panel-title">Garantias Cargadas</h3>
					<span class="pull-right clickable panel-collapsed" style="margin-top:-15px; cursor:pointer;"><i class="glyphicon glyphicon-chevron-down"></i></span>
				</div>
                <div class="panel-body collapse">
            		<?php echo $lstGarantias; ?>
								
				</div>
            </div>
    
    </div>
    </div>
    
    
   
</div>


</div>



<div id="dialog2" title="Eliminar Garantia">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar la Garantia?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina la Garantia se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script src="../bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$(document).on('click', '.panel-heading span.clickable', function(e){
		var $this = $(this);
		if(!$this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.addClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		} else {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.removeClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}
	});

	$('.panel-heading span.clickable').click();
	
	$('#example').dataTable({
		"order": [[ 0, "asc" ]],
		"language": {
			"emptyTable":     "No hay datos cargados",
			"info":           "Mostrar _START_ hasta _END_ del total de _TOTAL_ filas",
			"infoEmpty":      "Mostrar 0 hasta 0 del total de 0 filas",
			"infoFiltered":   "(filtrados del total de _MAX_ filas)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrar _MENU_ filas",
			"loadingRecords": "Cargando...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"zeroRecords":    "No se encontraron resultados",
			"paginate": {
				"first":      "Primero",
				"last":       "Ultimo",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}
		  }
	} );


	$("#example").on("click",'.varmodificar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "garantias/modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar
	
	
	$('.varborrar').click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");

			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar

	

	 $( "#dialog2" ).dialog({
		 	
	    autoOpen: false,
	 	resizable: false,
		width:600,
		height:240,
		modal: true,
		buttons: {
		    "Eliminar": function() {

				$.ajax({
							data:  {id: $('#idEliminar').val(), accion: 'eliminarGarantia'},
							url:   '../ajax/ajax.php',
							type:  'post',
							beforeSend: function () {
									
							},
							success:  function (response) {
									url = "index.php";
									$(location).attr('href',url);
									
							}
					});
				$( this ).dialog( "close" );
				$( this ).dialog( "close" );
					$('html, body').animate({
       					scrollTop: '1000px'
   					},
   					1500);
		    },
		    Cancelar: function() {
				$( this ).dialog( "close" );
		    }
		}
 
 
		}); //fin del dialogo para eliminar
	
	
	


});
</script>

<script>
	  	var percent_number_step = $.animateNumber.numberStepFactories.append('');
		$('#lblCliente').animateNumber(
		  {
			number: <?php echo $cantClientes; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);
		
		
		$('#lblVentas').animateNumber(
		  {
			number: <?php echo $cantVentas; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);
		
		
		
		
		$('#lblPedidos').animateNumber(
		  {
			number: <?php echo $cantPedidos; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);

	</script>
    
    <script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<?php } ?>
</body>
</html>
