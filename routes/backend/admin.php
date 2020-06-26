<?php

use App\Http\Controllers\Backend\ActividadesClientesController;
use App\Http\Controllers\Backend\ActividadesController;
use App\Http\Controllers\Backend\AnalisisController;
use App\Http\Controllers\Backend\AnalisisSueloController;
use App\Http\Controllers\Backend\AnimalesController;
use App\Http\Controllers\Backend\AnunciosController;
use App\Http\Controllers\Backend\BodegasController;
use App\Http\Controllers\Backend\CamposController;
use App\Http\Controllers\Backend\CelosController;
use App\Http\Controllers\Backend\ClienteProveedorController;
use App\Http\Controllers\Backend\ClimasController;
use App\Http\Controllers\Backend\ComprobantesPagoController;
use App\Http\Controllers\Backend\CorrelativosController;
use App\Http\Controllers\Backend\CuartelesController;
use App\Http\Controllers\Backend\EmpresaContactosController;
use App\Http\Controllers\Backend\EmpresaController;
use App\Http\Controllers\Backend\EspecieFuenteController;
use App\Http\Controllers\Backend\EspeciesController;
use App\Http\Controllers\Backend\FacturasController;
use App\Http\Controllers\Backend\FacturasRecibidasController;
use App\Http\Controllers\Backend\FlowController;
use App\Http\Controllers\Backend\GruposController;
use App\Http\Controllers\Backend\GuiaDespachoController;
use App\Http\Controllers\Backend\LaboratorioController;
use App\Http\Controllers\Backend\MantencionesController;
use App\Http\Controllers\Backend\MaquinariasController;
use App\Http\Controllers\Backend\MovimientosController;
use App\Http\Controllers\Backend\NotasCreditoController;
use App\Http\Controllers\Backend\OportunidadesController;
use App\Http\Controllers\Backend\OrdenCompraController;
use App\Http\Controllers\Backend\OrdenLaboratoriosController;
use App\Http\Controllers\Backend\OrdenTrabajosController;
use App\Http\Controllers\Backend\PlanesController;
use App\Http\Controllers\Backend\PresupuestosController;
use App\Http\Controllers\Backend\ProductosController;
use App\Http\Controllers\Backend\PublicacionesController;
use App\Http\Controllers\Backend\RacionesController;
use App\Http\Controllers\Backend\RendimientoCuartelesController;
use App\Http\Controllers\Backend\RequerimientosController;
use App\Http\Controllers\Backend\RodeosController;
use App\Http\Controllers\Backend\SanitariosController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\TipoActividadesController;
use App\Http\Controllers\Backend\TipoCultivosController;
use App\Http\Controllers\Backend\TipoMaquinariasController;
use App\Http\Controllers\Backend\TipoMuestrasController;
use App\Http\Controllers\Backend\TipoProductosController;
use App\Http\Controllers\Backend\TipoRacionesController;
use App\Http\Controllers\Backend\TrabajadoresController;

/*
 * All route names are prefixed with 'admin.'.
 */

/****** Empresas*****/
Route::get('perfil_empresa', [EmpresaController::class, 'perfil_empresa'])->name('perfil_empresa');
Route::post('perfil_empresa/update', [EmpresaController::class, 'updateEmpresa'])->name('perfil_empresa.update');
Route::group(['namespace' => 'Empresas'], function () {
	Route::get('empresa', [EmpresaController::class, 'index'])->name('empresas.index');

});

/******  Empresas******/

Route::get('perfil_planes', [PlanesController::class, 'perfil_planes'])->name('perfil_planes');
Route::post('perfil_planes/update', [PlanesController::class, 'updatePlanes'])->name('perfil_planes.update');

/****** Planes*****/
Route::group(['namespace' => 'Planes'], function () {
	Route::get('planes/asignar', [PlanesController::class, 'asignar'])->name('planes.asignar');
	Route::post('planes/saveAsig', [PlanesController::class, 'saveAsig'])->name('planes.saveAsig');
	Route::get('getEmpresa', [PlanesController::class, 'getEmpresa'])->name('getEmpresa');
	Route::get('getPlan', [PlanesController::class, 'getPlan'])->name('getPlan');
	Route::get('planes/actEmp', [PlanesController::class, 'activacionEmpresas'])->name('planes.actEmp');
	Route::get('planes/desactEmp', [PlanesController::class, 'desactivacionEmpresas'])->name('planes.desactEmp');

	Route::get('planes/pagos', [PlanesController::class, 'pagos'])->name('planes.pagos');
	Route::post('planes/buscar', [PlanesController::class, 'buscar'])->name('planes.buscar');

	Route::get('planes', [PlanesController::class, 'index'])->name('planes.index');
	Route::get('planes/create', [PlanesController::class, 'create'])->name('planes.create');
	Route::post('planes', [PlanesController::class, 'store'])->name('planes.store');
	Route::group(['prefix' => 'planes/{plan}'], function () {
		Route::get('edit', [PlanesController::class, 'edit'])->name('planes.edit');
		Route::get('show', [PlanesController::class, 'show'])->name('planes.show');
		Route::patch('/', [PlanesController::class, 'update'])->name('planes.update');
		Route::delete('/', [PlanesController::class, 'destroy'])->name('planes.destroy');
		Route::get('print', [PlanesController::class, 'print'])->name('planes.print');
	});

	/*Impresión comprobante de Pago*/
	Route::group(['prefix' => 'pago/{pago}'], function () {
		Route::get('print', [PlanesController::class, 'print'])->name('pago.print');
	});
});
/******Planes******/

/****************FLOW****************************/

Route::group(['namespace' => 'Payment', 'middleware' => ['checkEmpresa']], function () {
	Route::get('payment', [FlowController::class, 'index'])->name('payment.index');
	Route::post('payment/orden', [FlowController::class, 'orden'])->name('payment.orden');
	Route::post('payment/create', [FlowController::class, 'crear'])->name('payment.create');
	Route::post('payment/confirm', [FlowController::class, 'confirm'])->name('payment.confirm');
	Route::post('payment/getStatus', [FlowController::class, 'getStatus'])->name('payment.getStatus');
	Route::post('payment/result', [FlowController::class, 'result'])->name('payment.result');

});

/****************FLOW****************************/

//Grupo de Direcciones afectadas por pagos
Route::group(['middleware' => ['checkEmpresa']], function () {

	Route::group(['namespace' => 'Dashboard'], function () {
		Route::redirect('/', '/admin/dashboard', 301);
		Route::get('dashboard', [RequerimientosController::class, 'listarDashboard'])->name('dashboard');
		Route::get('cargarData', [RequerimientosController::class, 'cargarData'])->name('cargarData');
		Route::post('guardarData', [RequerimientosController::class, 'guardarData'])->name('guardarData');
	});
/****** Climas*****/
	Route::group(['namespace' => 'Climas'], function () {
		Route::get('climas/sincroniza', [ClimasController::class, 'sincroniza'])->name('climas.sincroniza');
		Route::get('climas', [ClimasController::class, 'index'])->name('climas.index');

	});

/****** Climas*****/

/****** Raciones*****/
	Route::group(['namespace' => 'Raciones'], function () {
		Route::get('raciones', [RacionesController::class, 'index'])->name('raciones.index');
		Route::get('raciones/create', [RacionesController::class, 'create'])->name('raciones.create');
		Route::post('raciones', [RacionesController::class, 'store'])->name('raciones.store');
		Route::group(['prefix' => 'raciones/{racion}'], function () {
			Route::get('edit', [RacionesController::class, 'edit'])->name('raciones.edit');
			Route::get('show', [RacionesController::class, 'show'])->name('raciones.show');
			Route::patch('/', [RacionesController::class, 'update'])->name('raciones.update');
			Route::delete('/', [RacionesController::class, 'destroy'])->name('raciones.destroy');
		});
	});
/******  Raciones******/

/****** Tipo Raciones*****/
	Route::group(['namespace' => 'TipoRaciones'], function () {
		Route::get('tipo_raciones', [TipoRacionesController::class, 'index'])->name('tipo_raciones.index');
		Route::get('tipo_raciones/create', [TipoRacionesController::class, 'create'])->name('tipo_raciones.create');
		Route::post('tipo_raciones', [TipoRacionesController::class, 'store'])->name('tipo_raciones.store');
		Route::group(['prefix' => 'tipo_raciones/{tipo_racion}'], function () {
			Route::get('edit', [TipoRacionesController::class, 'edit'])->name('tipo_raciones.edit');
			Route::get('show', [TipoRacionesController::class, 'show'])->name('tipo_raciones.show');
			Route::patch('/', [TipoRacionesController::class, 'update'])->name('tipo_raciones.update');
			Route::delete('/', [TipoRacionesController::class, 'destroy'])->name('tipo_raciones.destroy');
		});
	});
/****** Tipo Raciones******/

/****** Celos*****/
	Route::group(['namespace' => 'Celos'], function () {
		Route::get('celos', [CelosController::class, 'index'])->name('celos.index');
		Route::post('celos/find', [CelosController::class, 'index'])->name('celos.find');
		Route::get('celos/create', [CelosController::class, 'create'])->name('celos.create');
		Route::post('celos', [CelosController::class, 'store'])->name('celos.store');
		Route::group(['prefix' => 'celos/{celo}'], function () {
			Route::get('edit', [CelosController::class, 'edit'])->name('celos.edit');
			Route::get('show', [CelosController::class, 'show'])->name('celos.show');
			Route::patch('/', [CelosController::class, 'update'])->name('celos.update');
			Route::delete('/', [CelosController::class, 'destroy'])->name('celos.destroy');
		});

		Route::group(['prefix' => '{animal}'], function () {
			Route::get('celos/new', [CelosController::class, 'new'])->name('celos.new');

		});
	});
/****** Celos******/

/*********Sanitarios********/
	Route::group(['namespace' => 'Sanitarios'], function () {
		Route::post('sanitarios', [SanitariosController::class, 'store'])->name('sanitarios.store');
		Route::post('sanitarios', [SanitariosController::class, 'guardar'])->name('sanitarios.guardar');
		Route::get('sanitarios/resumen', [SanitariosController::class, 'resumen'])->name('sanitarios.resumen');
		Route::post('sanitarios/buscar', [SanitariosController::class, 'buscar'])->name('sanitarios.buscar');
		Route::get('sanitarios/new', [SanitariosController::class, 'new'])->name('sanitarios.new');
		Route::get('getAnimales', [SanitariosController::class, 'getAnimales'])->name('getAnimales');
		//Route::get('sanitarios/getFacturaDetalles', [SanitariosController::class, 'getFacturaDetalles'])->name('sanitarios.getFacturaDetalles');

		Route::group(['prefix' => 'sanitarios/{animal}'], function () {
			Route::get('index', [SanitariosController::class, 'index'])->name('sanitarios.index');
			Route::get('create', [SanitariosController::class, 'create'])->name('sanitarios.create');

		});
		Route::group(['prefix' => 'sanitarios/{sanitario}'], function () {
			Route::get('show', [SanitariosController::class, 'show'])->name('sanitarios.show');
			Route::get('edit', [SanitariosController::class, 'edit'])->name('sanitarios.edit');
			Route::patch('/', [SanitariosController::class, 'update'])->name('sanitarios.update');

			Route::delete('/', [SanitariosController::class, 'destroy'])->name('sanitarios.destroy');
		});
	});

/*********Sanitarios********/

/****** Animales*****/
	Route::group(['namespace' => 'Animales'], function () {
		Route::get('animales', [AnimalesController::class, 'index'])->name('animales.index');
		Route::get('animales/create', [AnimalesController::class, 'create'])->name('animales.create');
		Route::post('animales', [AnimalesController::class, 'store'])->name('animales.store');
		Route::group(['prefix' => 'animales/{animal}'], function () {
			Route::get('edit', [AnimalesController::class, 'edit'])->name('animales.edit');
			Route::get('show', [AnimalesController::class, 'show'])->name('animales.show');
			Route::patch('/', [AnimalesController::class, 'update'])->name('animales.update');
			Route::delete('/', [AnimalesController::class, 'destroy'])->name('animales.destroy');
		});
	});
/****** Animales******/

/****** Especies*****/
	Route::group(['namespace' => 'Especies'], function () {
		Route::get('especies', [EspeciesController::class, 'index'])->name('especies.index');
		Route::get('especies/create', [EspeciesController::class, 'create'])->name('especies.create');
		Route::post('especies', [EspeciesController::class, 'store'])->name('especies.store');
		Route::group(['prefix' => 'especies/{especie}'], function () {
			Route::get('edit', [EspeciesController::class, 'edit'])->name('especies.edit');
			Route::get('show', [EspeciesController::class, 'show'])->name('especies.show');
			Route::patch('/', [EspeciesController::class, 'update'])->name('especies.update');
			Route::delete('/', [EspeciesController::class, 'destroy'])->name('especies.destroy');
		});
	});
/****** Especies******/

/****** Rodeos*****/
	Route::group(['namespace' => 'Rodeos'], function () {
		Route::get('rodeos', [RodeosController::class, 'index'])->name('rodeos.index');
		Route::get('rodeos/create', [RodeosController::class, 'create'])->name('rodeos.create');
		Route::post('rodeos', [RodeosController::class, 'store'])->name('rodeos.store');
		Route::group(['prefix' => 'rodeos/{rodeo}'], function () {
			Route::get('edit', [RodeosController::class, 'edit'])->name('rodeos.edit');
			Route::get('show', [RodeosController::class, 'show'])->name('rodeos.show');
			Route::patch('/', [RodeosController::class, 'update'])->name('rodeos.update');
			Route::delete('/', [RodeosController::class, 'destroy'])->name('rodeos.destroy');
		});
	});
/****** Rodeos******/

/****** Anuncios*****/
	Route::group(['namespace' => 'Anuncios'], function () {
		Route::get('anuncios', [AnunciosController::class, 'index'])->name('anuncios.index');
		Route::post('anuncios', [AnunciosController::class, 'buscar'])->name('anuncios.index');

	});
/****** Anuncios******/

/****** Publicaciones*****/
	Route::group(['namespace' => 'Publicaciones'], function () {
		Route::get('publicaciones', [PublicacionesController::class, 'index'])->name('publicaciones.index');
		Route::get('publicaciones/create', [PublicacionesController::class, 'create'])->name('publicaciones.create');
		Route::post('publicaciones', [PublicacionesController::class, 'store'])->name('publicaciones.store');
		Route::post('publicaciones/upload', [PublicacionesController::class, 'upload'])->name('publicaciones.upload');
		Route::post('publicaciones/remove', [PublicacionesController::class, 'remove'])->name('publicaciones.remove');
		Route::get('publicaciones/getImages', [PublicacionesController::class, 'getImages'])->name('publicaciones.getImages');

		Route::group(['prefix' => 'publicaciones/{publicacion}'], function () {

			Route::get('edit', [PublicacionesController::class, 'edit'])->name('publicaciones.edit');
			Route::get('show', [PublicacionesController::class, 'show'])->name('publicaciones.show');
			Route::patch('/', [PublicacionesController::class, 'update'])->name('publicaciones.update');
			Route::delete('/', [PublicacionesController::class, 'destroy'])->name('publicaciones.destroy');
		});
	});
/****** Publicaciones******/

/****** Correlativos*****/
	Route::group(['namespace' => 'Correlativos'], function () {
		Route::get('correlativos', [CorrelativosController::class, 'index'])->name('correlativos.index');

		Route::group(['prefix' => 'correlativos/{correlativo}'], function () {
			Route::get('edit', [CorrelativosController::class, 'edit'])->name('correlativos.edit');
			Route::get('show', [CorrelativosController::class, 'show'])->name('correlativos.show');
			Route::patch('/', [CorrelativosController::class, 'update'])->name('correlativos.update');

		});
	});
/****** Correlativos******/

/****** Ordenes Compra*****/
	Route::group(['namespace' => 'OrdenCompras'], function () {
		Route::get('orden_compras', [OrdenCompraController::class, 'index'])->name('orden_compras.index');
		Route::get('orden_compras/create', [OrdenCompraController::class, 'create'])->name('orden_compras.create');
		Route::post('orden_compras', [OrdenCompraController::class, 'store'])->name('orden_compras.store');
		Route::post('orden_compras/storeGuia', [FacturasController::class, 'storeGuia'])->name('orden_compras.storeFactura');
		Route::get('orden_compras/getProductos', [OrdenCompraController::class, 'getProductos'])->name('orden_compras.getProductos');
		Route::group(['prefix' => 'orden_compras/{orden}'], function () {
			Route::get('edit', [OrdenCompraController::class, 'edit'])->name('orden_compras.edit');
			Route::get('show', [OrdenCompraController::class, 'show'])->name('orden_compras.show');
			Route::get('print', [OrdenCompraController::class, 'print'])->name('orden_compras.print');
			Route::patch('/', [OrdenCompraController::class, 'update'])->name('orden_compras.update');
			Route::delete('/', [OrdenCompraController::class, 'destroy'])->name('orden_compras.destroy');
		});

	});
/****** Ordenes Compra******/

/****** Guías Despacho*****/
	Route::group(['namespace' => 'GuiaDespachos'], function () {
		Route::get('guia_despachos', [GuiaDespachoController::class, 'index'])->name('guia_despachos.index');
		Route::get('guia_despachos/create', [GuiaDespachoController::class, 'create'])->name('guia_despachos.create');
		Route::post('guia_despachos', [GuiaDespachoController::class, 'store'])->name('guia_despachos.store');
		Route::post('guia_despachos/storeGuia', [FacturasController::class, 'storeGuia'])->name('guia_despachos.storeFactura');
		Route::get('guias_despachos/getProductos', [GuiaDespachoController::class, 'getProductos'])->name('guia_despachos.getProductos');
		Route::group(['prefix' => 'guia_despachos/{guia}'], function () {
			Route::get('edit', [GuiaDespachoController::class, 'edit'])->name('guia_despachos.edit');
			Route::get('show', [GuiaDespachoController::class, 'show'])->name('guia_despachos.show');
			Route::get('print', [GuiaDespachoController::class, 'print'])->name('guia_despachos.print');
			Route::patch('/', [GuiaDespachoController::class, 'update'])->name('guia_despachos.update');
			Route::delete('/', [GuiaDespachoController::class, 'destroy'])->name('guia_despachos.destroy');
		});

		Route::group(['prefix' => 'facturas/{presupuesto}'], function () {

			Route::get('facturar', [FacturasController::class, 'facturar'])->name('facturas.facturar');

		});
	});
/****** Guías Despacho******/

/****** Facturas*****/
	Route::group(['namespace' => 'Facturas'], function () {
		Route::get('facturas', [FacturasController::class, 'index'])->name('facturas.index');
		Route::post('facturas/find', [FacturasController::class, 'index'])->name('facturas.find');
		Route::get('facturas/create', [FacturasController::class, 'create'])->name('facturas.create');
		Route::post('facturas', [FacturasController::class, 'store'])->name('facturas.store');
		Route::post('facturas/storeFactura', [FacturasController::class, 'storeFactura'])->name('facturas.storeFactura');
		Route::get('facturas/getProductos', [FacturasController::class, 'getProductos'])->name('facturas.getProductos');
		Route::post('facturas/paystore', [FacturasController::class, 'paystore'])->name('facturas.paystore');
		Route::group(['prefix' => 'facturas/{factura}'], function () {
			//Route::get('edit', [FacturasController::class, 'edit'])->name('facturas.edit');
			Route::get('show', [FacturasController::class, 'show'])->name('facturas.show');
			Route::get('print', [FacturasController::class, 'print'])->name('facturas.print');
			Route::patch('/', [FacturasController::class, 'update'])->name('facturas.update');
			Route::delete('/', [FacturasController::class, 'destroy'])->name('facturas.destroy');
			Route::get('payment', [FacturasController::class, 'payment'])->name('facturas.payment');
			Route::get('notaCredito', [FacturasController::class, 'notaCredito'])->name('facturas.notaCredito');
			Route::patch('storeNotaCredito', [FacturasController::class, 'storeNotaCredito'])->name('facturas.storeNotaCredito');
		});

		Route::group(['prefix' => 'facturas/{presupuesto}'], function () {

			Route::get('facturar', [FacturasController::class, 'facturar'])->name('facturas.facturar');

		});

	});
/****** Facturas******/

/****** Facturas Recibidas ******/

	Route::group(['namespace' => 'FacturasRecibidas'], function () {
		/*Route::get('facturas_recibidas', [FacturasRecibidasController::class, 'index'])->name('facturas_recibidas.index'); */
		Route::get('facturas_recibidas/create', [FacturasRecibidasController::class, 'create'])->name('facturas_recibidas.create');
		Route::post('facturas_recibidas', [FacturasRecibidasController::class, 'store'])->name('facturas_recibidas.store');
		Route::group(['prefix' => 'facturas_recibidas/{factura_recibida}'], function () {
			Route::get('edit', [FacturasRecibidasController::class, 'edit'])->name('facturas_recibidas.edit');
			Route::get('show', [FacturasRecibidasController::class, 'show'])->name('facturas_recibidas.show');
			Route::patch('/', [FacturasRecibidasController::class, 'update'])->name('facturas_recibidas.update');
			Route::delete('/', [FacturasRecibidasController::class, 'destroy'])->name('facturas_recibidas.destroy');
		});
	});

/****** Facturas Recibidas ******/

/****** Presupuestos*****/
	Route::group(['namespace' => 'Presupuestos'], function () {
		Route::get('presupuestos', [PresupuestosController::class, 'index'])->name('presupuestos.index');
		Route::get('presupuestos/create', [PresupuestosController::class, 'create'])->name('presupuestos.create');
		Route::post('presupuestos', [PresupuestosController::class, 'store'])->name('presupuestos.store');
		Route::get('getContactos', [PresupuestosController::class, 'getContactos'])->name('getContactos');

		Route::group(['prefix' => 'presupuestos/{presupuesto}'], function () {
			Route::get('edit', [PresupuestosController::class, 'edit'])->name('presupuestos.edit');
			Route::get('cambiar_estado/{estado}', [PresupuestosController::class, 'cambiar_estado'])->name('presupuestos.cambiar_status');
			Route::get('show', [PresupuestosController::class, 'show'])->name('presupuestos.show');
			Route::get('print', [PresupuestosController::class, 'print'])->name('presupuestos.print');
			Route::patch('/', [PresupuestosController::class, 'update'])->name('presupuestos.update');
			Route::delete('/', [PresupuestosController::class, 'destroy'])->name('presupuestos.destroy');
		});
	});
/****** Presupuestos******/

/****** OrdenLaboratorios*****/
	Route::group(['namespace' => 'OrdenLaboratorios'], function () {
		Route::get('ordenLaboratorios', [OrdenLaboratoriosController::class, 'index'])->name('ordenLaboratorios.index');
		Route::get('ordenLaboratorios/create', [OrdenLaboratoriosController::class, 'create'])->name('ordenLaboratorios.create');
		Route::post('ordenLaboratorios', [OrdenLaboratoriosController::class, 'store'])->name('ordenLaboratorios.store');
		Route::get('getContactos', [OrdenLaboratoriosController::class, 'getContactos'])->name('getContactos');
		Route::get('getCuarteles', [OrdenLaboratoriosController::class, 'getCuarteles'])->name('getCuarteles');
		Route::group(['prefix' => 'ordenLaboratorios/{ordenLaboratorio}'], function () {
			Route::get('edit', [OrdenLaboratoriosController::class, 'edit'])->name('ordenLaboratorios.edit');
			Route::get('show', [OrdenLaboratoriosController::class, 'show'])->name('ordenLaboratorios.show');
			Route::get('print', [OrdenLaboratoriosController::class, 'print'])->name('ordenLaboratorios.print');
			Route::patch('/', [OrdenLaboratoriosController::class, 'update'])->name('ordenLaboratorios.update');
			Route::delete('/', [OrdenLaboratoriosController::class, 'destroy'])->name('ordenLaboratorios.destroy');
		});
		Route::group(['prefix' => 'ordenLaboratorios/{ordenTrabajo}'], function () {
			Route::get('cargar', [OrdenLaboratoriosController::class, 'cargar'])->name('ordenLaboratorios.cargar');
		});
	});
/****** OrdenLaboratorios*****/

/****** OrdenTrabajos*****/
	Route::group(['namespace' => 'OrdenTrabajos'], function () {
		Route::get('ordenTrabajos', [OrdenTrabajosController::class, 'index'])->name('ordenTrabajos.index');
		Route::get('ordenTrabajos/create', [OrdenTrabajosController::class, 'create'])->name('ordenTrabajos.create');
		Route::post('ordenTrabajos', [OrdenTrabajosController::class, 'store'])->name('ordenTrabajos.store');
		Route::get('getContactos', [OrdenTrabajosController::class, 'getContactos'])->name('getContactos');
		Route::get('getCuarteles', [OrdenTrabajosController::class, 'getCuarteles'])->name('getCuarteles');
		Route::group(['prefix' => 'ordenTrabajos/{ordenTrabajo}'], function () {
			Route::get('edit', [OrdenTrabajosController::class, 'edit'])->name('ordenTrabajos.edit');
			Route::get('show', [OrdenTrabajosController::class, 'show'])->name('ordenTrabajos.show');
			Route::get('print', [OrdenTrabajosController::class, 'print'])->name('ordenTrabajos.print');
			Route::patch('/', [OrdenTrabajosController::class, 'update'])->name('ordenTrabajos.update');
			Route::delete('/', [OrdenTrabajosController::class, 'destroy'])->name('ordenTrabajos.destroy');
		});
		Route::group(['prefix' => 'ordenTrabajos/{presupuesto}'], function () {
			Route::get('cargar', [OrdenTrabajosController::class, 'cargar'])->name('ordenTrabajos.cargar');
		});
	});
/****** OrdenTrabajos*****/

/****** Actividades Clientes*****/
	Route::group(['namespace' => 'ActividadesClientes'], function () {
		Route::get('actividades_clientes', [ActividadesClientesController::class, 'index'])->name('actividades_clientes.index');
		Route::get('actividades_clientes/create', [ActividadesClientesController::class, 'create'])->name('actividades_clientes.create');
		Route::post('actividades_clientes', [ActividadesClientesController::class, 'store'])->name('actividades_clientes.store');
		Route::get('actividades_clientes/getClientes', [ActividadesClientesController::class, 'getClientes'])->name('getClientes');
		Route::get('actividades_clientes/getTrabajadores', [ActividadesClientesController::class, 'getTrabajadores'])->name('getTrabajadores');
		Route::get('actividades_clientes/getTipoActividades', [ActividadesClientesController::class, 'getTipoActividades'])->name('getTipoActividades');
		Route::get('actividades_clientes/getMaquinarias', [ActividadesClientesController::class, 'getMaquinarias'])->name('getMaquinarias');
		Route::group(['prefix' => 'actividades_clientes/{actividad}'], function () {
			Route::get('edit', [ActividadesClientesController::class, 'edit'])->name('actividades_clientes.edit');
			Route::get('show', [ActividadesClientesController::class, 'show'])->name('actividades_clientes.show');
			Route::patch('/', [ActividadesClientesController::class, 'update'])->name('actividades_clientes.update');
			Route::delete('/', [ActividadesClientesController::class, 'destroy'])->name('actividades_clientes.destroy');
		});
	});
/****** Actividades******/

/****** Actividades campos*****/
	Route::group(['namespace' => 'Actividades'], function () {
		Route::get('actividades_campos/getRut', [ActividadesController::class, 'getRut'])->name('actividades_campos.getRut');

		Route::get('actividades_campos', [ActividadesController::class, 'index'])->name('actividades_campos.index');
		Route::get('actividades_campos/create', [ActividadesController::class, 'create'])->name('actividades_campos.create');
		Route::post('actividades_campos', [ActividadesController::class, 'store'])->name('actividades_campos.store');
		Route::get('actividades_campos/getCuarteles', [ActividadesController::class, 'getCuarteles'])->name('getCuarteles');
		Route::get('actividades_campos/getCampos', [ActividadesController::class, 'getCampos'])->name('getCampos');

		Route::group(['prefix' => 'actividades_campos/{actividad}'], function () {
			Route::get('nuevo_gasto', [ActividadesController::class, 'nuevo_gasto'])->name('actividades_campos.nuevo_gasto');
			Route::post('guardar_gasto', [ActividadesController::class, 'guardar_gasto'])->name('actividades_campos.guardar_gasto');

			Route::get('edit', [ActividadesController::class, 'edit'])->name('actividades_campos.edit');
			Route::get('show', [ActividadesController::class, 'show'])->name('actividades_campos.show');
			Route::patch('/', [ActividadesController::class, 'update'])->name('actividades_campos.update');
			Route::delete('/', [ActividadesController::class, 'destroy'])->name('actividades_campos.destroy');

		});

		Route::group(['prefix' => 'actividades_campos/{gasto}'], function () {

			Route::get('edit_gasto', [ActividadesController::class, 'edit_gasto'])->name('actividades_campos.edit_gasto');
			Route::get('show_gasto', [ActividadesController::class, 'show_gasto'])->name('actividades_campos.show_gasto');
			Route::patch('update_gasto', [ActividadesController::class, 'update_gasto'])->name('actividades_campos.update_gasto');
			Route::delete('destroy_gasto', [ActividadesController::class, 'destroy_gasto'])->name('actividades_campos.destroy_gasto');
		});

	});
/****** Actividades campos******/

/****** Tipo Actividades*****/
	Route::group(['namespace' => 'TipoActividades'], function () {
		Route::get('tipo_actividades', [TipoActividadesController::class, 'index'])->name('tipo_actividades.index');
		Route::get('tipo_actividades/create', [TipoActividadesController::class, 'create'])->name('tipo_actividades.create');
		Route::post('tipo_actividades', [TipoActividadesController::class, 'store'])->name('tipo_actividades.store');
		Route::group(['prefix' => 'tipo_actividades/{tipo_actividad}'], function () {
			Route::get('edit', [TipoActividadesController::class, 'edit'])->name('tipo_actividades.edit');
			Route::get('show', [TipoActividadesController::class, 'show'])->name('tipo_actividades.show');
			Route::patch('/', [TipoActividadesController::class, 'update'])->name('tipo_actividades.update');
			Route::delete('/', [TipoActividadesController::class, 'destroy'])->name('tipo_actividades.destroy');
		});
	});
/****** Tipo Actividades******/

/****** Movimientos*****/
	Route::group(['namespace' => 'Movimientos'], function () {
		Route::get('movimientos', [MovimientosController::class, 'index'])->name('movimientos.index');
		Route::get('movimientos/create', [MovimientosController::class, 'create'])->name('movimientos.create');
		Route::post('movimientos', [MovimientosController::class, 'store'])->name('movimientos.store');

		Route::group(['prefix' => 'movimientos/{movimiento}'], function () {
			Route::get('edit', [MovimientosController::class, 'edit'])->name('movimientos.edit');
			Route::get('show', [MovimientosController::class, 'show'])->name('movimientos.show');
			Route::patch('/', [MovimientosController::class, 'update'])->name('movimientos.update');
			Route::delete('/', [MovimientosController::class, 'destroy'])->name('movimientos.destroy');
		});
	});
/****** Movimientos******/

/****** Analisis Suelo*****/
	Route::group(['namespace' => 'AnalisisSuelo'], function () {
		Route::get('analisis_suelo', [AnalisisSueloController::class, 'index'])->name('analisis_suelo.index');
		Route::get('analisis_suelo/create', [AnalisisSueloController::class, 'create'])->name('analisis_suelo.create');
		Route::post('analisis_suelo', [AnalisisSueloController::class, 'store'])->name('analisis_suelo.store');
		Route::get('analisis_suelo/getCuarteles', [AnalisisSueloController::class, 'getCuarteles'])->name('getCuarteles');
		Route::get('analisis_suelo/getCampos', [AnalisisSueloController::class, 'getCampos'])->name('getCampos');

		Route::group(['prefix' => 'analisis_suelo/{analisis}'], function () {
			Route::get('edit', [AnalisisSueloController::class, 'edit'])->name('analisis_suelo.edit');
			Route::get('show', [AnalisisSueloController::class, 'show'])->name('analisis_suelo.show');
			Route::patch('/', [AnalisisSueloController::class, 'update'])->name('analisis_suelo.update');
			Route::delete('/', [AnalisisSueloController::class, 'destroy'])->name('analisis_suelo.destroy');
		});
	});
/****** Analisis Suelo******/

/****** Trabajadores*****/
	Route::group(['namespace' => 'Trabajdores'], function () {
		Route::get('trabajadores', [TrabajadoresController::class, 'index'])->name('trabajadores.index');
		Route::get('trabajadores/create', [TrabajadoresController::class, 'create'])->name('trabajadores.create');
		Route::post('trabajadores', [TrabajadoresController::class, 'store'])->name('trabajadores.store');

		Route::group(['prefix' => 'trabajadores/{trabajador}'], function () {
			Route::get('edit', [TrabajadoresController::class, 'edit'])->name('trabajadores.edit');
			Route::get('show', [TrabajadoresController::class, 'show'])->name('trabajadores.show');
			Route::patch('/', [TrabajadoresController::class, 'update'])->name('trabajadores.update');
			Route::delete('/', [TrabajadoresController::class, 'destroy'])->name('trabajadores.destroy');
		});
	});
/****** Trabajadores******/

/****** Productos*****/
	Route::group(['namespace' => 'Productos'], function () {
		Route::get('productos', [ProductosController::class, 'index'])->name('productos.index');
		Route::get('productos/create', [ProductosController::class, 'create'])->name('productos.create');
		Route::post('productos', [ProductosController::class, 'store'])->name('productos.store');

		Route::group(['prefix' => 'productos/{producto}'], function () {
			Route::get('edit', [ProductosController::class, 'edit'])->name('productos.edit');
			Route::get('show', [ProductosController::class, 'show'])->name('productos.show');
			Route::patch('/', [ProductosController::class, 'update'])->name('productos.update');
			Route::delete('/', [ProductosController::class, 'destroy'])->name('productos.destroy');
		});
	});
/****** Productos******/

/****** Cliente Proveedor*****/
	Route::group(['namespace' => 'ClienteProveedor'], function () {
		Route::get('clientes', [ClienteProveedorController::class, 'index_cliente'])->name('clientes.index');
		Route::get('proveedor', [ClienteProveedorController::class, 'index_proveedor'])->name('proveedor.index');
		Route::get('cliente/create', [ClienteProveedorController::class, 'create'])->name('cliente.create');
		Route::get('proveedor/create', [ClienteProveedorController::class, 'create'])->name('proveedor.create');
		Route::post('cliente', [ClienteProveedorController::class, 'store'])->name('cliente.store');
		Route::post('proveedor', [ClienteProveedorController::class, 'store'])->name('proveedor.store');
		Route::post('importarEmpresas', [ClienteProveedorController::class, 'importar'])->name('importarEmpresas');
		Route::post('buscarEmpresaContacto', [ClienteProveedorController::class, 'buscarEmpresaContacto'])->name('buscarEmpresaContacto');

		Route::group(['prefix' => 'cliente_proveedor/{cliente_proveedor}'], function () {
			Route::get('edit_cliente', [ClienteProveedorController::class, 'edit'])->name('cliente.edit');
			Route::get('edit_proveedor', [ClienteProveedorController::class, 'edit'])->name('proveedor.edit');
			Route::get('show', [ClienteProveedorController::class, 'show'])->name('cliente.show');
			Route::patch('cliente/', [ClienteProveedorController::class, 'update'])->name('cliente.update');
			Route::patch('proveedor/', [ClienteProveedorController::class, 'update'])->name('proveedor.update');
			Route::delete('cliente/', [ClienteProveedorController::class, 'destroy'])->name('cliente.destroy');
			Route::delete('proveedor/', [ClienteProveedorController::class, 'destroy'])->name('proveedor.destroy');
		});
	});
/****** Cliente Proveedor******/

/****** Tipo Productos*****/
	Route::group(['namespace' => 'TipoProductos'], function () {
		Route::get('tipo_productos', [TipoProductosController::class, 'index'])->name('tipo_productos.index');
		Route::get('tipo_productos/create', [TipoProductosController::class, 'create'])->name('tipo_productos.create');
		Route::post('tipo_productos', [TipoProductosController::class, 'store'])->name('tipo_productos.store');

		Route::group(['prefix' => 'tipo_productos/{tipo_producto}'], function () {
			Route::get('edit', [TipoProductosController::class, 'edit'])->name('tipo_productos.edit');
			Route::get('show', [ProductosController::class, 'show'])->name('tipo_productos.show');
			Route::patch('/', [TipoProductosController::class, 'update'])->name('tipo_productos.update');
			Route::delete('/', [TipoProductosController::class, 'destroy'])->name('tipo_productos.destroy');
		});
	});
/****** Tipo Productos******/

/*********Mantenciones********/
	Route::group(['namespace' => 'Mantenciones'], function () {
		//Route::get('mantenciones/create', [MantencionesController::class, 'create'])->name('mantenciones.create');
		Route::post('mantenciones', [MantencionesController::class, 'store'])->name('mantenciones.store');
		Route::get('mantenciones/resumen', [MantencionesController::class, 'resumen'])->name('mantenciones.resumen');
		Route::post('mantenciones/buscar', [MantencionesController::class, 'buscar'])->name('mantenciones.buscar');
		Route::get('mantenciones/new', [MantencionesController::class, 'new'])->name('mantenciones.new');
		Route::get('getMaquinarias', [MantencionesController::class, 'getMaquinarias'])->name('getMaquinarias');
		Route::get('mantenciones/getFacturaDetalles', [MantencionesController::class, 'getFacturaDetalles'])->name('mantenciones.getFacturaDetalles');

		Route::group(['prefix' => 'mantenciones/{maquinaria}'], function () {
			Route::get('index', [MantencionesController::class, 'index'])->name('mantenciones.index');
			Route::get('create', [MantencionesController::class, 'create'])->name('mantenciones.create');

		});
		Route::group(['prefix' => 'mantenciones/{mantencion}'], function () {
			Route::get('show', [MantencionesController::class, 'show'])->name('mantenciones.show');
			Route::get('edit', [MantencionesController::class, 'edit'])->name('mantenciones.edit');
			Route::patch('/', [MantencionesController::class, 'update'])->name('mantenciones.update');

			Route::delete('/', [MantencionesController::class, 'destroy'])->name('mantenciones.destroy');
		});
	});

/*********Mantenciones********/

/****** Tipo Maquinarias*****/
	Route::group(['namespace' => 'TipoMaquinarias'], function () {
		Route::get('tipo_maquinarias', [TipoMaquinariasController::class, 'index'])->name('tipo_maquinarias.index');
		Route::get('tipo_maquinarias/create', [TipoMaquinariasController::class, 'create'])->name('tipo_maquinarias.create');
		Route::post('tipo_maquinarias', [TipoMaquinariasController::class, 'store'])->name('tipo_maquinarias.store');

		Route::group(['prefix' => 'tipo_maquinarias/{tipo_maquinaria}'], function () {
			Route::get('edit', [TipoMaquinariasController::class, 'edit'])->name('tipo_maquinarias.edit');
			Route::get('show', [TipoMaquinariasController::class, 'show'])->name('tipo_maquinarias.show');
			Route::patch('/', [TipoMaquinariasController::class, 'update'])->name('tipo_maquinarias.update');
			Route::delete('/', [TipoMaquinariasController::class, 'destroy'])->name('tipo_maquinarias.destroy');
		});
	});
/****** Tipo Maquinarias******/

/****** Maquinarias*****/
	Route::group(['namespace' => 'Maquinarias'], function () {
		Route::get('maquinarias', [MaquinariasController::class, 'index'])->name('maquinarias.index');
		Route::get('maquinarias/create', [MaquinariasController::class, 'create'])->name('maquinarias.create');
		Route::post('maquinarias', [MaquinariasController::class, 'store'])->name('maquinarias.store');

		Route::group(['prefix' => 'maquinarias/{maquinaria}'], function () {
			Route::get('edit', [MaquinariasController::class, 'edit'])->name('maquinarias.edit');
			Route::get('show', [MaquinariasController::class, 'show'])->name('maquinarias.show');
			Route::patch('/', [MaquinariasController::class, 'update'])->name('maquinarias.update');
			Route::delete('/', [MaquinariasController::class, 'destroy'])->name('maquinarias.destroy');
		});
	});
/****** Maquinarias******/

/****** Stocks*****/
	Route::group(['namespace' => 'Stock'], function () {
		Route::get('stock', [StockController::class, 'index'])->name('stock.index');
		/*Route::get('tipo_cultivos/create', [TipoCultivosController::class, 'create'])->name('tipo_cultivos.create');
			    Route::post('tipo_cultivos', [TipoCultivosController::class, 'store'])->name('tipo_cultivos.store');

			    Route::group(['prefix' => 'tipo_cultivos/{tipo_cultivo}'], function () {
			    Route::get('edit', [TipoCultivosController::class, 'edit'])->name('tipo_cultivos.edit');
			    Route::patch('/', [TipoCultivosController::class, 'update'])->name('tipo_cultivos.update');
			    Route::delete('/', [TipoCultivosController::class, 'destroy'])->name('tipo_cultivos.destroy');
		*/
	});
/****** Stocks*****/

/****** Tipo Cultivos*****/
	Route::group(['namespace' => 'TiposCultivos'], function () {
		Route::get('tipo_cultivos', [TipoCultivosController::class, 'index'])->name('tipo_cultivos.index');
		Route::get('tipo_cultivos/create', [TipoCultivosController::class, 'create'])->name('tipo_cultivos.create');
		Route::post('tipo_cultivos', [TipoCultivosController::class, 'store'])->name('tipo_cultivos.store');
		Route::group(['prefix' => 'tipo_cultivos/{tipo_cultivo}'], function () {
			Route::get('edit', [TipoCultivosController::class, 'edit'])->name('tipo_cultivos.edit');
			Route::get('show', [TipoCultivosController::class, 'show'])->name('tipo_cultivos.show');
			Route::patch('/', [TipoCultivosController::class, 'update'])->name('tipo_cultivos.update');
			Route::delete('/', [TipoCultivosController::class, 'destroy'])->name('tipo_cultivos.destroy');
		});
	});
/****** Tipo Cultivos******/

/****** Bodegas*****/
	Route::group(['namespace' => 'Bodegas'], function () {
		Route::get('bodegas', [BodegasController::class, 'index'])->name('bodegas.index');
		Route::get('bodegas/create', [BodegasController::class, 'create'])->name('bodegas.create');
		Route::post('bodegas', [BodegasController::class, 'store'])->name('bodegas.store');

		Route::group(['prefix' => 'bodegas/{bodega}'], function () {
			Route::get('edit', [BodegasController::class, 'edit'])->name('bodegas.edit');
			Route::get('show', [BodegasController::class, 'show'])->name('bodegas.show');
			Route::patch('/', [BodegasController::class, 'update'])->name('bodegas.update');
			Route::delete('/', [BodegasController::class, 'destroy'])->name('bodegas.destroy');
		});
	});
/****** Bodegas******/

/****** Campos******/
	Route::group(['namespace' => 'Campos'], function () {
		Route::get('campos', [CamposController::class, 'index'])->name('campos.index');
		Route::get('campos/create', [CamposController::class, 'create'])->name('campos.create');
		Route::post('campos', [CamposController::class, 'store'])->name('campos.store');
		Route::get('getComunas', [CamposController::class, 'getComunas'])->name('getComunas');

		Route::group(['prefix' => 'campos/{campo}'], function () {
			Route::get('edit', [CamposController::class, 'edit'])->name('campos.edit');
			Route::get('show', [CamposController::class, 'show'])->name('campos.show');
			Route::patch('/', [CamposController::class, 'update'])->name('campos.update');
			Route::delete('/', [CamposController::class, 'destroy'])->name('campos.destroy');
		});
	});
/****** Campos******/

/****** Cuarteles*****/
	Route::group(['namespace' => 'Cuarteles'], function () {
		Route::get('cuarteles', [CuartelesController::class, 'index'])->name('cuarteles.index');
		Route::get('cuarteles/create', [CuartelesController::class, 'create'])->name('cuarteles.create');
		Route::post('cuarteles', [CuartelesController::class, 'store'])->name('cuarteles.store');

		Route::group(['prefix' => 'cuarteles/{cuartel}'], function () {
			Route::get('edit', [CuartelesController::class, 'edit'])->name('cuarteles.edit');
			Route::get('show', [CuartelesController::class, 'show'])->name('cuarteles.show');
			Route::patch('/', [CuartelesController::class, 'update'])->name('cuarteles.update');
			Route::delete('/', [CuartelesController::class, 'destroy'])->name('cuarteles.destroy');
		});
	});
/******Cuarteles******/

/****** TipoMuestras*****/
	Route::group(['namespace' => 'TipoMuestras'], function () {
		Route::get('tipoMuestras', [TipoMuestrasController::class, 'index'])->name('tipo_muestras.index');
		Route::get('tipoMuestras/create', [TipoMuestrasController::class, 'create'])->name('tipo_muestras.create');
		Route::post('tipoMuestras', [TipoMuestrasController::class, 'store'])->name('tipo_muestras.store');

		Route::group(['prefix' => 'tipoMuestras/{tipoMuestra}'], function () {
			Route::get('edit', [TipoMuestrasController::class, 'edit'])->name('tipo_muestras.edit');
			Route::get('show', [TipoMuestrasController::class, 'show'])->name('tipo_muestras.show');
			Route::patch('/', [TipoMuestrasController::class, 'update'])->name('tipo_muestras.update');
			Route::delete('/', [TipoMuestrasController::class, 'destroy'])->name('tipo_muestras.destroy');
		});
	});
/******TipoMuestras******/

/****** Analisis*****/
	Route::group(['namespace' => 'Analisis'], function () {
		Route::get('analisis', [AnalisisController::class, 'index'])->name('analisis.index');
		Route::get('analisis/create', [AnalisisController::class, 'create'])->name('analisis.create');
		Route::post('analisis', [AnalisisController::class, 'store'])->name('analisis.store');

		Route::group(['prefix' => 'analisis/{analisis}'], function () {
			Route::get('edit', [AnalisisController::class, 'edit'])->name('analisis.edit');
			Route::get('show', [AnalisisController::class, 'show'])->name('analisis.show');
			Route::patch('/', [AnalisisController::class, 'update'])->name('analisis.update');
			Route::delete('/', [AnalisisController::class, 'destroy'])->name('analisis.destroy');
		});
	});
/******Analisis******/

/****** Grupos*****/
	Route::group(['namespace' => 'Grupos'], function () {
		Route::get('grupos', [GruposController::class, 'index'])->name('grupos.index');
		Route::get('grupos/create', [GruposController::class, 'create'])->name('grupos.create');
		Route::post('grupos', [GruposController::class, 'store'])->name('grupos.store');

		Route::group(['prefix' => 'grupos/{grupos}'], function () {
			Route::get('edit', [GruposController::class, 'edit'])->name('grupos.edit');
			Route::get('show', [GruposController::class, 'show'])->name('grupos.show');
			Route::patch('/', [GruposController::class, 'update'])->name('grupos.update');
			Route::delete('/', [GruposController::class, 'destroy'])->name('grupos.destroy');
		});
	});
/******Analisis******/

/****** EspecieFuente*****/
	Route::group(['namespace' => 'EspecieFuente'], function () {
		Route::get('especieFuente', [EspecieFuenteController::class, 'index'])->name('especieFuente.index');
		Route::get('especieFuente/create', [EspecieFuenteController::class, 'create'])->name('especieFuente.create');
		Route::post('especieFuente', [EspecieFuenteController::class, 'store'])->name('especieFuente.store');

		Route::group(['prefix' => 'especieFuente/{especieFuente}'], function () {
			Route::get('edit', [EspecieFuenteController::class, 'edit'])->name('especieFuente.edit');
			Route::get('show', [EspecieFuenteController::class, 'show'])->name('especieFuente.show');
			Route::patch('/', [EspecieFuenteController::class, 'update'])->name('especieFuente.update');
			Route::delete('/', [EspecieFuenteController::class, 'destroy'])->name('especieFuente.destroy');
		});
	});
/******EspecieFuente******/

/****** Laboratorio*****/
	Route::group(['namespace' => 'Laboratorio'], function () {
		Route::get('laboratorio', [LaboratorioController::class, 'index'])->name('laboratorio.index');
		Route::get('laboratorio/create', [LaboratorioController::class, 'create'])->name('laboratorio.create');
		Route::post('laboratorio', [LaboratorioController::class, 'store'])->name('laboratorio.store');

		Route::group(['prefix' => 'laboratorio/{laboratorio}'], function () {
			Route::get('edit', [LaboratorioController::class, 'edit'])->name('laboratorio.edit');
			Route::get('show', [LaboratorioController::class, 'show'])->name('laboratorio.show');
			Route::patch('/', [LaboratorioController::class, 'update'])->name('laboratorio.update');
			Route::delete('/', [LaboratorioController::class, 'destroy'])->name('laboratorio.destroy');
		});
	});
/******Laboratorio******/

/****** Rendimiento Cuarteles*****/
	Route::group(['namespace' => 'Rendimientos'], function () {
		Route::get('rendimientos', [RendimientoCuartelesController::class, 'index'])->name('rendimientos.index');
		Route::get('rendimientos/create', [RendimientoCuartelesController::class, 'create'])->name('rendimientos.create');
		Route::post('rendimientos', [RendimientoCuartelesController::class, 'store'])->name('rendimientos.store');

		Route::group(['prefix' => 'rendimientos/{rendimiento}'], function () {
			Route::get('edit', [RendimientoCuartelesController::class, 'edit'])->name('rendimientos.edit');
			Route::get('show', [RendimientoCuartelesController::class, 'show'])->name('rendimientos.show');
			Route::patch('/', [RendimientoCuartelesController::class, 'update'])->name('rendimientos.update');
			Route::delete('/', [RendimientoCuartelesController::class, 'destroy'])->name('rendimientos.destroy');
		});
	});
/****** Rendimiento Cuarteles******/

/******Empresa Contactos******/
	Route::group(['namespace' => 'Contactos'], function () {
		Route::get('contactos', [EmpresaContactosController::class, 'index'])->name('contactos.index');
		Route::get('contactos/create', [EmpresaContactosController::class, 'create'])->name('contactos.create');
		Route::post('contactos', [EmpresaContactosController::class, 'store'])->name('contactos.store');
		Route::post('importarContactos', [EmpresaContactosController::class, 'importar'])->name('importarContactos');

		Route::group(['prefix' => 'contactos/{contacto}'], function () {
			Route::get('edit', [EmpresaContactosController::class, 'edit'])->name('contactos.edit');
			Route::get('show', [EmpresaContactosController::class, 'show'])->name('contactos.show');
			Route::patch('/', [EmpresaContactosController::class, 'update'])->name('contactos.update');
			Route::delete('/', [EmpresaContactosController::class, 'destroy'])->name('contactos.destroy');
		});
	});
/******Empresa Contactos******/

/******Oportunidades******/
	Route::group(['namespace' => 'Oportunidades'], function () {
		Route::get('oportunidades', [OportunidadesController::class, 'index'])->name('oportunidades.index');
		Route::get('oportunidades/create', [OportunidadesController::class, 'create'])->name('oportunidades.create');
		Route::post('oportunidades', [OportunidadesController::class, 'store'])->name('oportunidades.store');
		Route::get('getContactos', [OportunidadesController::class, 'getContactos'])->name('getContactos');
		Route::get('oportunidades/tablero', [OportunidadesController::class, 'tablero'])->name('oportunidades.tablero');
		Route::post('changeToTablero', [OportunidadesController::class, 'changeToTablero'])->name('changeToTablero');

		Route::group(['prefix' => 'oportunidades/{oportunidad}'], function () {
			Route::get('edit', [OportunidadesController::class, 'edit'])->name('oportunidades.edit');
			Route::get('show', [OportunidadesController::class, 'show'])->name('oportunidades.show');
			Route::patch('/', [OportunidadesController::class, 'update'])->name('oportunidades.update');
			Route::patch('perdida', [OportunidadesController::class, 'perdida'])->name('oportunidades.perdida');
			//Route::patch('changeToContacto', [OportunidadesController::class, 'changeToContacto'])->name('changeToContacto');
			Route::delete('/', [OportunidadesController::class, 'destroy'])->name('oportunidades.destroy');
		});
	});
/******Oportunidades******/

/******Requerimientos******/
	Route::group(['namespace' => 'Requerimientos'], function () {
		Route::get('requerimientos', [RequerimientosController::class, 'index'])->name('requerimientos.index');
		Route::get('requerimientos/create', [RequerimientosController::class, 'create'])->name('requerimientos.create');
		Route::post('requerimientos', [RequerimientosController::class, 'store'])->name('requerimientos.store');
		Route::get('getContactos', [RequerimientosController::class, 'getContactos'])->name('getContactos');
		Route::get('requerimientos/tablero', [RequerimientosController::class, 'tablero'])->name('requerimientos.tablero');
		Route::post('changeToTablero', [RequerimientosController::class, 'changeToTablero'])->name('changeToTablero');

		Route::get('asociarCotizacion', [RequerimientosController::class, 'putCotizada'])->name('requerimientos.asociarCotizacion');

		Route::get('asociarOrdenTrabajo', [RequerimientosController::class, 'putOrdenTrabajo'])->name('requerimientos.asociarOrdenTrabajo');

		Route::get('asociarOrdenLaboratorio', [RequerimientosController::class, 'putOrdenLaboratorio'])->name('requerimientos.asociarOrdenLaboratorio');

		Route::group(['prefix' => 'requerimientos/{requerimiento}'], function () {
			Route::get('edit', [RequerimientosController::class, 'edit'])->name('requerimientos.edit');
			Route::get('show', [RequerimientosController::class, 'show'])->name('requerimientos.show');
			Route::patch('/', [RequerimientosController::class, 'update'])->name('requerimientos.update');
			Route::patch('perdida', [RequerimientosController::class, 'perdida'])->name('requerimientos.perdida');

			//Route::patch('changeToContacto', [OportunidadesController::class, 'changeToContacto'])->name('changeToContacto');
			Route::delete('/', [RequerimientosController::class, 'destroy'])->name('requerimientos.destroy');

			Route::get('changeCotizada', [RequerimientosController::class, 'changeCotizada'])->name('requerimientos.changeCotizada');

			Route::get('changeOrdenTrabajo', [RequerimientosController::class, 'changeOrdenTrabajo'])->name('requerimientos.changeOrdenTrabajo');
			Route::get('changeOrdenLaboratorio', [RequerimientosController::class, 'changeOrdenLaboratorio'])->name('requerimientos.changeOrdenLaboratorio');

		});
	});
/******Requerimientos******/

/******Comprobante Pago******/
	Route::group(['namespace' => 'Comprobante'], function () {
		Route::get('comprobantes', [ComprobantesPagoController::class, 'index'])->name('comprobantes.index');
		Route::get('comprobantes/create', [ComprobantesPagoController::class, 'create'])->name('comprobantes.create');
		Route::post('comprobantes', [ComprobantesPagoController::class, 'store'])->name('comprobantes.store');

		Route::group(['prefix' => 'comprobantes/{comprobante}'], function () {
			Route::get('edit', [ComprobantesPagoController::class, 'edit'])->name('comprobantes.edit');
			Route::get('show', [ComprobantesPagoController::class, 'show'])->name('comprobantes.show');
			Route::get('print', [ComprobantesPagoController::class, 'print'])->name('comprobantes.print');
			Route::patch('/', [ComprobantesPagoController::class, 'update'])->name('comprobantes.update');
			Route::delete('/', [ComprobantesPagoController::class, 'destroy'])->name('comprobantes.destroy');
		});
	});
/******Comprobante Pago******/

/******Notas de Crédito******/
	Route::group(['namespace' => 'NotaCredito'], function () {
		Route::get('notascredito', [NotasCreditoController::class, 'index'])->name('notascredito.index');

		Route::group(['prefix' => 'notascredito/{nota}'], function () {
			Route::get('show', [NotasCreditoController::class, 'show'])->name('notascredito.show');
			Route::get('print', [NotasCreditoController::class, 'print'])->name('notascredito.print');
		});
	});
/******Notas de Crédito******/
});
