<?php


Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});


/*********************Empresas******************************/
Breadcrumbs::for('admin.perfil_empresa', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Empresa', route('admin.perfil_empresa'));
});

Breadcrumbs::for('admin.empresas.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Empresas', route('admin.empresas.index'));
});


/*********************Empresas******************************/



/*******************Climas**********************/
Breadcrumbs::for('admin.climas.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Climas', route('admin.climas.index'));
});


/*******************Climas**********************/

/*******************Planes**********************/
Breadcrumbs::for('admin.perfil_planes', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Planes', route('admin.perfil_planes'));
});
Breadcrumbs::for('admin.planes.pagos', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Planes', route('admin.planes.pagos'));
});

Breadcrumbs::for('admin.planes.buscar', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Planes', route('admin.planes.buscar'));
});

Breadcrumbs::for('admin.planes.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Planes', route('admin.planes.index'));
});

Breadcrumbs::for('admin.planes.create', function ($trail) {
    $trail->parent('admin.planes.index');
    $trail->push('Crear', route('admin.planes.create'));
});

Breadcrumbs::for('admin.planes.edit', function ($trail, $id) {
    $trail->parent('admin.planes.index');
    $trail->push('Editar', route('admin.planes.edit', $id));
});
Breadcrumbs::for('admin.planes.show', function ($trail, $id) {
    $trail->parent('admin.planes.index');
    $trail->push('Ver', route('admin.planes.show', $id));
});

Breadcrumbs::for('admin.planes.asignar', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Planes', route('admin.planes.asignar'));
});
/*******************Tipo Planes**********************/



/*******************Raciones**********************/
Breadcrumbs::for('admin.raciones.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Raciones', route('admin.raciones.index'));
});

Breadcrumbs::for('admin.raciones.create', function ($trail) {
    $trail->parent('admin.raciones.index');
    $trail->push('Crear', route('admin.raciones.create'));
});

Breadcrumbs::for('admin.raciones.edit', function ($trail, $id) {
    $trail->parent('admin.raciones.index');
    $trail->push('Editar', route('admin.raciones.edit', $id));
});
Breadcrumbs::for('admin.raciones.show', function ($trail, $id) {
    $trail->parent('admin.raciones.index');
    $trail->push('Ver', route('admin.raciones.show', $id));
});
/*******************Tipo Raciones**********************/



/*******************Tipo Raciones**********************/
Breadcrumbs::for('admin.tipo_raciones.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Tipo Raciones', route('admin.tipo_raciones.index'));
});

Breadcrumbs::for('admin.tipo_raciones.create', function ($trail) {
    $trail->parent('admin.tipo_raciones.index');
    $trail->push('Crear', route('admin.tipo_raciones.create'));
});

Breadcrumbs::for('admin.tipo_raciones.edit', function ($trail, $id) {
    $trail->parent('admin.tipo_raciones.index');
    $trail->push('Editar', route('admin.tipo_raciones.edit', $id));
});
Breadcrumbs::for('admin.tipo_raciones.show', function ($trail, $id) {
    $trail->parent('admin.tipo_raciones.index');
    $trail->push('Ver', route('admin.tipo_raciones.show', $id));
});
/*******************Tipo Raciones**********************/


/*******************Tipo Muestras**********************/
Breadcrumbs::for('admin.tipo_muestras.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Tipo Muestras', route('admin.tipo_muestras.index'));
});

Breadcrumbs::for('admin.tipo_muestras.create', function ($trail) {
    $trail->parent('admin.tipo_muestras.index');
    $trail->push('Crear', route('admin.tipo_muestras.create'));
});

Breadcrumbs::for('admin.tipo_muestras.edit', function ($trail, $id) {
    $trail->parent('admin.tipo_muestras.index');
    $trail->push('Editar', route('admin.tipo_muestras.edit', $id));
});
Breadcrumbs::for('admin.tipo_muestras.show', function ($trail, $id) {
    $trail->parent('admin.tipo_muestras.index');
    $trail->push('Ver', route('admin.tipo_muestras.show', $id));
});
/*******************Tipo Muestras**********************/


/*******************Analisis**********************/
Breadcrumbs::for('admin.analisis.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Análisis', route('admin.analisis.index'));
});

Breadcrumbs::for('admin.analisis.create', function ($trail) {
    $trail->parent('admin.analisis.index');
    $trail->push('Crear', route('admin.analisis.create'));
});

Breadcrumbs::for('admin.analisis.edit', function ($trail, $id) {
    $trail->parent('admin.analisis.index');
    $trail->push('Editar', route('admin.analisis.edit', $id));
});
Breadcrumbs::for('admin.analisis.show', function ($trail, $id) {
    $trail->parent('admin.analisis.index');
    $trail->push('Ver', route('admin.analisis.show', $id));
});
/*******************Analisis**********************/

/*******************Grupos**********************/
Breadcrumbs::for('admin.grupos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Grupos de CLientes', route('admin.grupos.index'));
});

Breadcrumbs::for('admin.grupos.create', function ($trail) {
    $trail->parent('admin.grupos.index');
    $trail->push('Crear', route('admin.grupos.create'));
});

Breadcrumbs::for('admin.grupos.edit', function ($trail, $id) {
    $trail->parent('admin.grupos.index');
    $trail->push('Editar', route('admin.grupos.edit', $id));
});
Breadcrumbs::for('admin.grupos.show', function ($trail, $id) {
    $trail->parent('admin.grupos.index');
    $trail->push('Ver', route('admin.grupos.show', $id));
});
/*******************Grupos**********************/


/*******************Laboratorio**********************/
Breadcrumbs::for('admin.laboratorio.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Laboratorio', route('admin.laboratorio.index'));
});

Breadcrumbs::for('admin.laboratorio.create', function ($trail) {
    $trail->parent('admin.laboratorio.index');
    $trail->push('Crear', route('admin.laboratorio.create'));
});

Breadcrumbs::for('admin.laboratorio.edit', function ($trail, $id) {
    $trail->parent('admin.laboratorio.index');
    $trail->push('Editar', route('admin.laboratorio.edit', $id));
});
Breadcrumbs::for('admin.laboratorio.show', function ($trail, $id) {
    $trail->parent('admin.laboratorio.index');
    $trail->push('Ver', route('admin.laboratorio.show', $id));
});
/*******************Laboratorio**********************/

/*******************EspecieFuente**********************/
Breadcrumbs::for('admin.especieFuente.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Especies / Fuentes', route('admin.especieFuente.index'));
});

Breadcrumbs::for('admin.especieFuente.create', function ($trail) {
    $trail->parent('admin.especieFuente.index');
    $trail->push('Crear', route('admin.especieFuente.create'));
});

Breadcrumbs::for('admin.especieFuente.edit', function ($trail, $id) {
    $trail->parent('admin.especieFuente.index');
    $trail->push('Editar', route('admin.especieFuente.edit', $id));
});
Breadcrumbs::for('admin.especieFuente.show', function ($trail, $id) {
    $trail->parent('admin.especieFuente.index');
    $trail->push('Ver', route('admin.especieFuente.show', $id));
});
/*******************Tipo Muestras**********************/

/*******************Celos**********************/
Breadcrumbs::for('admin.celos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Celos', route('admin.celos.index'));
});

Breadcrumbs::for('admin.celos.find', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Celos', route('admin.celos.find'));
});

Breadcrumbs::for('admin.celos.create', function ($trail) {
    $trail->parent('admin.celos.index');
    $trail->push('Crear', route('admin.celos.create'));
});

Breadcrumbs::for('admin.celos.new', function ($trail,$id) {
    $trail->parent('admin.celos.index');
    $trail->push('Crear', route('admin.celos.new',$id));
});

Breadcrumbs::for('admin.celos.edit', function ($trail, $id) {
    $trail->parent('admin.celos.index');
    $trail->push('Editar', route('admin.celos.edit', $id));
});
Breadcrumbs::for('admin.celos.show', function ($trail, $id) {
    $trail->parent('admin.celos.index');
    $trail->push('Ver', route('admin.celos.show', $id));
});
/*******************Celos**********************/

/*******************Sanitarios**********************/
Breadcrumbs::for('admin.sanitarios.index', function ($trail,$sanitario) {
   $trail->parent('admin.dashboard');
    $trail->push('Sanitario', route('admin.sanitarios.index',$sanitario));
});

Breadcrumbs::for('admin.sanitarios.create', function ($trail,$sanitario) {
    $trail->parent('admin.sanitarios.index',$sanitario);
    $trail->push('Crear', route('admin.sanitarios.create',$sanitario));
});

Breadcrumbs::for('admin.sanitarios.new', function ($trail) {
    //$trail->parent('admin.mantenciones.index');
    $trail->push('Nueva Sanitario', route('admin.sanitarios.new'));
});

Breadcrumbs::for('admin.sanitarios.edit', function ($trail, $id) {
    //$trail->parent('admin.mantenciones.index');
    $trail->push('Editar', route('admin.sanitarios.edit', $id));
});

Breadcrumbs::for('admin.sanitarios.show', function ($trail, $id) {
    //$trail->parent('admin.tipo_maquinarias.index');
    $trail->push('Ver', route('admin.sanitarios.show', $id));
});

Breadcrumbs::for('admin.sanitarios.resumen', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Sanitario', route('admin.sanitarios.resumen'));
});

Breadcrumbs::for('admin.sanitarios.buscar', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Sanitario', route('admin.sanitarios.buscar'));
});

/*******************Mantenciones**********************/

/*******************Animales**********************/
Breadcrumbs::for('admin.animales.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Animales', route('admin.animales.index'));
});

Breadcrumbs::for('admin.animales.create', function ($trail) {
    $trail->parent('admin.animales.index');
    $trail->push('Crear', route('admin.animales.create'));
});

Breadcrumbs::for('admin.animales.edit', function ($trail, $id) {
    $trail->parent('admin.animales.index');
    $trail->push('Editar', route('admin.animales.edit', $id));
});
Breadcrumbs::for('admin.animales.show', function ($trail, $id) {
    $trail->parent('admin.animales.index');
    $trail->push('Ver', route('admin.animales.show', $id));
});
/*******************Animales**********************/

/*******************Especies**********************/
Breadcrumbs::for('admin.especies.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Especies', route('admin.especies.index'));
});

Breadcrumbs::for('admin.especies.create', function ($trail) {
    $trail->parent('admin.especies.index');
    $trail->push('Crear', route('admin.especies.create'));
});

Breadcrumbs::for('admin.especies.edit', function ($trail, $id) {
    $trail->parent('admin.especies.index');
    $trail->push('Editar', route('admin.especies.edit', $id));
});
Breadcrumbs::for('admin.especies.show', function ($trail, $id) {
    $trail->parent('admin.especies.index');
    $trail->push('Ver', route('admin.especies.show', $id));
});
/*******************Especies**********************/


/*******************Rodeos**********************/
Breadcrumbs::for('admin.rodeos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Rodeos', route('admin.rodeos.index'));
});

Breadcrumbs::for('admin.rodeos.create', function ($trail) {
    $trail->parent('admin.rodeos.index');
    $trail->push('Crear', route('admin.rodeos.create'));
});

Breadcrumbs::for('admin.rodeos.edit', function ($trail, $id) {
    $trail->parent('admin.rodeos.index');
    $trail->push('Editar', route('admin.rodeos.edit', $id));
});
Breadcrumbs::for('admin.rodeos.show', function ($trail, $id) {
    $trail->parent('admin.rodeos.index');
    $trail->push('Ver', route('admin.rodeos.show', $id));
});
/*******************Rodeos**********************/

/*******************Anuncios**********************/
Breadcrumbs::for('admin.anuncios.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Anuncios', route('admin.anuncios.index'));
});

Breadcrumbs::for('admin.anuncios.buscar', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Anuncios', route('admin.anuncios.buscar'));
});

/*******************Anuncios**********************/

/*******************Publicaciones**********************/
Breadcrumbs::for('admin.publicaciones.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Publicaciones', route('admin.publicaciones.index'));
});

Breadcrumbs::for('admin.publicaciones.create', function ($trail) {
    $trail->parent('admin.publicaciones.index');
    $trail->push('Crear', route('admin.publicaciones.create'));
});

Breadcrumbs::for('admin.publicaciones.edit', function ($trail, $id) {
    $trail->parent('admin.publicaciones.index');
    $trail->push('Editar', route('admin.publicaciones.edit', $id));
});
Breadcrumbs::for('admin.publicaciones.show', function ($trail, $id) {
    $trail->parent('admin.publicaciones.index');
    $trail->push('Ver', route('admin.publicaciones.show', $id));
});
/*******************Publicaciones**********************/

/*******************Correlativos**********************/
Breadcrumbs::for('admin.correlativos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Correlativos', route('admin.correlativos.index'));
});


Breadcrumbs::for('admin.correlativos.edit', function ($trail, $id) {
    $trail->parent('admin.correlativos.index');
    $trail->push('Editar', route('admin.correlativos.edit', $id));
});
Breadcrumbs::for('admin.correlativos.show', function ($trail, $id) {
    $trail->parent('admin.correlativos.index');
    $trail->push('Ver', route('admin.correlativos.show', $id));
});



/*******************Correlativos**********************/
/*******************Ordenes Compra**********************/
Breadcrumbs::for('admin.orden_compras.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Ordenes', route('admin.orden_compras.index'));
});

Breadcrumbs::for('admin.orden_compras.create', function ($trail) {
    $trail->parent('admin.orden_compras.index');
    $trail->push('Crear', route('admin.orden_compras.create'));
});

Breadcrumbs::for('admin.orden_compras.edit', function ($trail, $id) {
    $trail->parent('admin.orden_compras.index');
    $trail->push('Editar', route('admin.orden_compras.edit', $id));
});


Breadcrumbs::for('admin.orden_compras.show', function ($trail, $id) {
    $trail->parent('admin.orden_compras.index');
    $trail->push('Ver', route('admin.orden_compras.show', $id));
});
/*******************Ordenes Compra**********************/

/*******************Guias Despacho**********************/
Breadcrumbs::for('admin.guia_despachos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Guías', route('admin.guia_despachos.index'));
});

Breadcrumbs::for('admin.guia_despachos.create', function ($trail) {
    $trail->parent('admin.guia_despachos.index');
    $trail->push('Crear', route('admin.guia_despachos.create'));
});

Breadcrumbs::for('admin.guia_despachos.edit', function ($trail, $id) {
    $trail->parent('admin.guia_despachos.index');
    $trail->push('Editar', route('admin.guia_despachos.edit', $id));
});


Breadcrumbs::for('admin.guia_despachos.show', function ($trail, $id) {
    $trail->parent('admin.guia_despachos.index');
    $trail->push('Ver', route('admin.guia_despachos.show', $id));
});
/*******************Guias Despacho**********************/

/*******************Facturas**********************/
Breadcrumbs::for('admin.facturas.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Facturas', route('admin.facturas.index'));
});

Breadcrumbs::for('admin.facturas.create', function ($trail) {
    $trail->parent('admin.facturas.index');
    $trail->push('Crear', route('admin.facturas.create'));
});

Breadcrumbs::for('admin.facturas.edit', function ($trail, $id) {
    $trail->parent('admin.facturas.index');
    $trail->push('Editar', route('admin.facturas.edit', $id));
});

Breadcrumbs::for('admin.facturas.facturar', function ($trail, $id) {
    $trail->parent('admin.facturas.index');
    $trail->push('Crear', route('admin.facturas.facturar', $id));
});

Breadcrumbs::for('admin.facturas.show', function ($trail, $id) {
    $trail->parent('admin.facturas.index');
    $trail->push('Ver', route('admin.facturas.show', $id));
});

Breadcrumbs::for('admin.facturas.payment', function ($trail, $id) {
    $trail->parent('admin.facturas.index');
    $trail->push('Ver', route('admin.facturas.payment', $id));
});

Breadcrumbs::for('admin.facturas.notaCredito', function ($trail, $id) {
    $trail->parent('admin.facturas.index');
    $trail->push('Ver', route('admin.facturas.notaCredito', $id));
});

Breadcrumbs::for('admin.facturas.find', function ($trail) {
    $trail->parent('admin.facturas.index');
    $trail->push('Búsqueda', route('admin.facturas.find'));
});
/*******************Facturas**********************/


/*******************Facturas Recibidas**********************/
/*Breadcrumbs::for('admin.facturas_recibidas.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Facturas Recibidas', route('admin.facturas_recibidas.index'));
}); */

Breadcrumbs::for('admin.facturas_recibidas.create', function ($trail) {
    $trail->parent('admin.facturas.index');
    $trail->push('Crear', route('admin.facturas_recibidas.create'));
});

Breadcrumbs::for('admin.facturas_recibidas.edit', function ($trail, $id) {
    $trail->parent('admin.facturas.index');
    $trail->push('Editar', route('admin.facturas_recibidas.edit', $id));
});

Breadcrumbs::for('admin.facturas_recibidas.show', function ($trail, $id) {
    $trail->parent('admin.facturas.index');
    $trail->push('Ver', route('admin.facturas_recibidas.show', $id));
});
/*******************Facturas Recibidas**********************/


/*******************Presupuestos**********************/
Breadcrumbs::for('admin.presupuestos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Cotización', route('admin.presupuestos.index'));
});

Breadcrumbs::for('admin.presupuestos.create', function ($trail) {
    $trail->parent('admin.presupuestos.index');
    $trail->push('Crear', route('admin.presupuestos.create'));
});

Breadcrumbs::for('admin.presupuestos.edit', function ($trail, $id) {
    $trail->parent('admin.presupuestos.index');
    $trail->push('Editar', route('admin.presupuestos.edit', $id));
});
Breadcrumbs::for('admin.presupuestos.show', function ($trail, $id) {
    $trail->parent('admin.presupuestos.index');
    $trail->push('Ver', route('admin.presupuestos.show', $id));
});

/*******************Presupuestos**********************/

/*******************OrdenLaboratorio**********************/
Breadcrumbs::for('admin.ordenLaboratorios.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Ordenes de Laboratorio', route('admin.ordenLaboratorios.index'));
});

Breadcrumbs::for('admin.ordenLaboratorios.create', function ($trail) {
    $trail->parent('admin.ordenLaboratorios.index');
    $trail->push('Crear', route('admin.ordenLaboratorios.create'));
});

Breadcrumbs::for('admin.ordenLaboratorios.edit', function ($trail, $id) {
    $trail->parent('admin.ordenLaboratorios.index');
    $trail->push('Editar', route('admin.ordenLaboratorios.edit', $id));
});
Breadcrumbs::for('admin.ordenLaboratorios.show', function ($trail, $id) {
    $trail->parent('admin.ordenLaboratorios.index');
    $trail->push('Ver', route('admin.ordenLaboratorios.show', $id));
});

Breadcrumbs::for('admin.ordenLaboratorios.cargar', function ($trail, $id) {
    $trail->parent('admin.ordenLaboratorios.index');
    $trail->push('Crear', route('admin.ordenLaboratorios.cargar', $id));
});
/*******************OrdenLaboratorio**********************/


/*******************OrdenTrabajo**********************/
Breadcrumbs::for('admin.ordenTrabajos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Ordenes de Trabajos', route('admin.ordenTrabajos.index'));
});

Breadcrumbs::for('admin.ordenTrabajos.create', function ($trail) {
    $trail->parent('admin.ordenTrabajos.index');
    $trail->push('Crear', route('admin.ordenTrabajos.create'));
});

Breadcrumbs::for('admin.ordenTrabajos.edit', function ($trail, $id) {
    $trail->parent('admin.ordenTrabajos.index');
    $trail->push('Editar', route('admin.ordenTrabajos.edit', $id));
});
Breadcrumbs::for('admin.ordenTrabajos.show', function ($trail, $id) {
    $trail->parent('admin.ordenTrabajos.index');
    $trail->push('Ver', route('admin.ordenTrabajos.show', $id));
});
Breadcrumbs::for('admin.ordenTrabajos.cargar', function ($trail, $id) {
    $trail->parent('admin.ordenTrabajos.index');
    $trail->push('Cargar', route('admin.ordenTrabajos.cargar', $id));
});
/*******************OrdenTrabajo**********************/


/*******************Actividades Clientes**********************/
Breadcrumbs::for('admin.actividades_clientes.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Actividades', route('admin.actividades_clientes.index'));
});

Breadcrumbs::for('admin.actividades_clientes.create', function ($trail) {
    $trail->parent('admin.actividades_clientes.index');
    $trail->push('Crear', route('admin.actividades_clientes.create'));
});

Breadcrumbs::for('admin.actividades_clientes.edit', function ($trail, $id) {
    $trail->parent('admin.actividades_clientes.index');
    $trail->push('Editar', route('admin.actividades_clientes.edit', $id));
});
Breadcrumbs::for('admin.actividades_clientes.show', function ($trail, $id) {
    $trail->parent('admin.actividades_clientes.index');
    $trail->push('Ver', route('admin.actividades_clientes.show', $id));
});
/*******************Actividades**********************/




/*******************Actividades Campos**********************/
    //Gastos
Breadcrumbs::for('admin.actividades_campos.nuevo_gasto', function ($trail, $id) {
    $trail->parent('admin.actividades_campos.index');
    $trail->push('Gasto', route('admin.actividades_campos.nuevo_gasto', $id));
});

Breadcrumbs::for('admin.actividades_campos.edit_gasto', function ($trail, $id) {
    $trail->parent('admin.actividades_campos.index');
    $trail->push('Editar', route('admin.actividades_campos.edit_gasto', $id));
});

Breadcrumbs::for('admin.actividades_campos.show_gasto', function ($trail, $id) {
    $trail->parent('admin.actividades_campos.index');
    $trail->push('Mostrar', route('admin.actividades_campos.show_gasto', $id));
});

//Gastos





Breadcrumbs::for('admin.actividades_campos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Actividades', route('admin.actividades_campos.index'));
});

Breadcrumbs::for('admin.actividades_campos.create', function ($trail) {
    $trail->parent('admin.actividades_campos.index');
    $trail->push('Crear', route('admin.actividades_campos.create'));
});

Breadcrumbs::for('admin.actividades_campos.edit', function ($trail, $id) {
    $trail->parent('admin.actividades_campos.index');
    $trail->push('Editar', route('admin.actividades_campos.edit', $id));
});
Breadcrumbs::for('admin.actividades_campos.show', function ($trail, $id) {
    $trail->parent('admin.actividades_campos.index');
    $trail->push('Ver', route('admin.actividades_campos.show', $id));
});
/*******************Actividades Campos**********************/




/*******************Tipo Actividades**********************/
Breadcrumbs::for('admin.tipo_actividades.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Tipos', route('admin.tipo_actividades.index'));
});

Breadcrumbs::for('admin.tipo_actividades.create', function ($trail) {
    $trail->parent('admin.tipo_actividades.index');
    $trail->push('Crear', route('admin.tipo_actividades.create'));
});

Breadcrumbs::for('admin.tipo_actividades.edit', function ($trail, $id) {
    $trail->parent('admin.tipo_actividades.index');
    $trail->push('Editar', route('admin.tipo_cultivos.edit', $id));
});
Breadcrumbs::for('admin.tipo_actividades.show', function ($trail, $id) {
    $trail->parent('admin.tipo_actividades.index');
    $trail->push('Ver', route('admin.tipo_actividades.show', $id));
});
/*******************Tipos Actividades**********************/

/*******************Movimientos**********************/
Breadcrumbs::for('admin.movimientos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Movimientos', route('admin.movimientos.index'));
});

Breadcrumbs::for('admin.movimientos.create', function ($trail) {
    $trail->parent('admin.movimientos.index');
    $trail->push('Crear', route('admin.movimientos.create'));
});

Breadcrumbs::for('admin.movimientos.show', function ($trail, $id) {
    $trail->parent('admin.movimientos.index');
    $trail->push('Ver', route('admin.movimientos.show', $id));
});
/*******************Analisis Suelo**********************/




/*******************Analisis Suelo**********************/
Breadcrumbs::for('admin.analisis_suelo.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Análisis', route('admin.analisis_suelo.index'));
});

Breadcrumbs::for('admin.analisis_suelo.create', function ($trail) {
    $trail->parent('admin.analisis_suelo.index');
    $trail->push('Crear', route('admin.analisis_suelo.create'));
});

Breadcrumbs::for('admin.analisis_suelo.edit', function ($trail, $id) {
    $trail->parent('admin.analisis_suelo.index');
    $trail->push('Editar', route('admin.analisis_suelo.edit', $id));
});

Breadcrumbs::for('admin.analisis_suelo.show', function ($trail, $id) {
    $trail->parent('admin.analisis_suelo.index');
    $trail->push('Ver', route('admin.analisis_suelo.show', $id));
});
/*******************Analisis Suelo**********************/



/*******************Trabajadores**********************/
Breadcrumbs::for('admin.trabajadores.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Trabajadores', route('admin.trabajadores.index'));
});

Breadcrumbs::for('admin.trabajadores.create', function ($trail) {
    $trail->parent('admin.trabajadores.index');
    $trail->push('Crear', route('admin.trabajadores.create'));
});

Breadcrumbs::for('admin.trabajadores.edit', function ($trail, $id) {
    $trail->parent('admin.trabajadores.index');
    $trail->push('Editar', route('admin.trabajadores.edit', $id));
});
Breadcrumbs::for('admin.trabajadores.show', function ($trail, $id) {
    $trail->parent('admin.trabajadores.index');
    $trail->push('Ver', route('admin.trabajadores.show', $id));
});
/*******************Trabajadores**********************/


/*******************Productos**********************/
Breadcrumbs::for('admin.productos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Productos', route('admin.productos.index'));
});

Breadcrumbs::for('admin.productos.create', function ($trail) {
    $trail->parent('admin.productos.index');
    $trail->push('Crear', route('admin.productos.create'));
});

Breadcrumbs::for('admin.productos.edit', function ($trail, $id) {
    $trail->parent('admin.productos.index');
    $trail->push('Editar', route('admin.productos.edit', $id));
});
Breadcrumbs::for('admin.productos.show', function ($trail, $id) {
    $trail->parent('admin.productos.index');
    $trail->push('Ver', route('admin.productos.show', $id));
});
/*******************Productos**********************/


/*******************Cliente Proveedor**********************/
Breadcrumbs::for('admin.clientes.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Clientes', route('admin.clientes.index'));
});
Breadcrumbs::for('admin.proveedor.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Proveedor', route('admin.proveedor.index'));
});

Breadcrumbs::for('admin.cliente.create', function ($trail) {
    $trail->parent('admin.clientes.index');
    $trail->push('Crear', route('admin.cliente.create'));
});
Breadcrumbs::for('admin.proveedor.create', function ($trail) {
    $trail->parent('admin.proveedor.index');
    $trail->push('Crear', route('admin.proveedor.create'));
});

Breadcrumbs::for('admin.cliente.edit', function ($trail, $id) {
    $trail->parent('admin.clientes.index');
    $trail->push('Editar', route('admin.cliente.edit', $id));
});
Breadcrumbs::for('admin.proveedor.edit', function ($trail, $id) {
    $trail->parent('admin.proveedor.index');
    $trail->push('Editar', route('admin.proveedor.edit', $id));
});

Breadcrumbs::for('admin.cliente.show', function ($trail, $id) {
    $trail->parent('admin.clientes.index');
    $trail->push('Ver', route('admin.cliente.show', $id));
});

Breadcrumbs::for('admin.buscarEmpresaContacto', function ($trail) {
    $trail->parent('admin.clientes.index');
    $trail->push('Búsqueda', route('admin.buscarEmpresaContacto'));
});
/*******************Cliente Proveedor**********************/




/*******************Tipos Productos**********************/
Breadcrumbs::for('admin.tipo_productos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Tipos', route('admin.tipo_productos.index'));
});

Breadcrumbs::for('admin.tipo_productos.create', function ($trail) {
    $trail->parent('admin.tipo_productos.index');
    $trail->push('Crear', route('admin.tipo_productos.create'));
});

Breadcrumbs::for('admin.tipo_productos.edit', function ($trail, $id) {
    $trail->parent('admin.tipo_productos.index');
    $trail->push('Editar', route('admin.tipo_productos.edit', $id));
});
/*******************Tipos Productos**********************/



/*******************Mantenciones**********************/
Breadcrumbs::for('admin.mantenciones.index', function ($trail,$maquinaria) {
   $trail->parent('admin.dashboard');
    $trail->push('Mantención', route('admin.mantenciones.index',$maquinaria));
});

Breadcrumbs::for('admin.mantenciones.create', function ($trail,$maquinaria) {
    $trail->parent('admin.mantenciones.index',$maquinaria);
    $trail->push('Crear', route('admin.mantenciones.create',$maquinaria));
});

Breadcrumbs::for('admin.mantenciones.new', function ($trail) {
    //$trail->parent('admin.mantenciones.index');
    $trail->push('Nueva Mantención', route('admin.mantenciones.new'));
});

Breadcrumbs::for('admin.mantenciones.edit', function ($trail, $id) {
    //$trail->parent('admin.mantenciones.index');
    $trail->push('Editar', route('admin.mantenciones.edit', $id));
});

Breadcrumbs::for('admin.mantenciones.show', function ($trail, $id) {
    //$trail->parent('admin.tipo_maquinarias.index');
    $trail->push('Ver', route('admin.mantenciones.show', $id));
});

Breadcrumbs::for('admin.mantenciones.resumen', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Mantención', route('admin.mantenciones.resumen'));
});

Breadcrumbs::for('admin.mantenciones.buscar', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Mantención', route('admin.mantenciones.buscar'));
});

/*******************Mantenciones**********************/



/*******************Tipos Maquinarias**********************/
Breadcrumbs::for('admin.tipo_maquinarias.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Tipos', route('admin.tipo_maquinarias.index'));
});

Breadcrumbs::for('admin.tipo_maquinarias.create', function ($trail) {
    $trail->parent('admin.tipo_maquinarias.index');
    $trail->push('Crear', route('admin.tipo_maquinarias.create'));
});

Breadcrumbs::for('admin.tipo_maquinarias.edit', function ($trail, $id) {
    $trail->parent('admin.tipo_maquinarias.index');
    $trail->push('Editar', route('admin.tipo_maquinarias.edit', $id));
});

Breadcrumbs::for('admin.tipo_maquinarias.show', function ($trail, $id) {
    $trail->parent('admin.tipo_maquinarias.index');
    $trail->push('Ver', route('admin.tipo_maquinarias.show', $id));
});
/*******************Tipos Maquinarias**********************/





/*******************Maquinarias**********************/
Breadcrumbs::for('admin.maquinarias.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Maquinarias', route('admin.maquinarias.index'));
});

Breadcrumbs::for('admin.maquinarias.create', function ($trail) {
    $trail->parent('admin.maquinarias.index');
    $trail->push('Crear', route('admin.maquinarias.create'));
});

Breadcrumbs::for('admin.maquinarias.edit', function ($trail, $id) {
    $trail->parent('admin.maquinarias.index');
    $trail->push('Editar', route('admin.maquinarias.edit', $id));
});
Breadcrumbs::for('admin.maquinarias.show', function ($trail, $id) {
    $trail->parent('admin.maquinarias.index');
    $trail->push('Ver', route('admin.maquinarias.show', $id));
});
/*******************Maquinarias**********************/





/*******************Stocks**********************/
Breadcrumbs::for('admin.stock.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Stock', route('admin.stock.index'));
});

/*Breadcrumbs::for('admin.tipo_cultivos.create', function ($trail) {
    $trail->parent('admin.tipo_cultivos.index');
    $trail->push('Crear', route('admin.tipo_cultivos.create'));
});

Breadcrumbs::for('admin.tipo_cultivos.edit', function ($trail, $id) {
    $trail->parent('admin.tipo_cultivos.index');
    $trail->push('Editar', route('admin.tipo_cultivos.edit', $id));
});*/
/*******************Stocks**********************/

/*******************Tipos Cultivos**********************/
Breadcrumbs::for('admin.tipo_cultivos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Tipos', route('admin.tipo_cultivos.index'));
});

Breadcrumbs::for('admin.tipo_cultivos.create', function ($trail) {
    $trail->parent('admin.tipo_cultivos.index');
    $trail->push('Crear', route('admin.tipo_cultivos.create'));
});

Breadcrumbs::for('admin.tipo_cultivos.edit', function ($trail, $id) {
    $trail->parent('admin.tipo_cultivos.index');
    $trail->push('Editar', route('admin.tipo_cultivos.edit', $id));
});
Breadcrumbs::for('admin.tipo_cultivos.show', function ($trail, $id) {
    $trail->parent('admin.tipo_cultivos.index');
    $trail->push('Ver', route('admin.tipo_cultivos.show', $id));
});
/*******************Tipos Cultivos**********************/

/*******************Bodegas**********************/
Breadcrumbs::for('admin.bodegas.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Bodegas', route('admin.bodegas.index'));
});

Breadcrumbs::for('admin.bodegas.create', function ($trail) {
    $trail->parent('admin.bodegas.index');
    $trail->push('Crear', route('admin.bodegas.create'));
});

Breadcrumbs::for('admin.bodegas.edit', function ($trail, $id) {
    $trail->parent('admin.bodegas.index');
    $trail->push('Editar', route('admin.bodegas.edit', $id));
});
Breadcrumbs::for('admin.bodegas.show', function ($trail, $id) {
    $trail->parent('admin.bodegas.index');
    $trail->push('Ver', route('admin.bodegas.show', $id));
});
/*******************Bodegas**********************/

/*******************Cuarteles**********************/
Breadcrumbs::for('admin.cuarteles.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Cuarteles', route('admin.cuarteles.index'));
});

Breadcrumbs::for('admin.cuarteles.create', function ($trail) {
    $trail->parent('admin.cuarteles.index');
    $trail->push('Crear', route('admin.cuarteles.create'));
});

Breadcrumbs::for('admin.cuarteles.edit', function ($trail, $id) {
    $trail->parent('admin.cuarteles.index');
    $trail->push('Editar', route('admin.cuarteles.edit', $id));
});
Breadcrumbs::for('admin.cuarteles.show', function ($trail, $id) {
    $trail->parent('admin.cuarteles.index');
    $trail->push('Ver', route('admin.cuarteles.show', $id));
});
/*******************Cuarteles**********************/


/*******************Rendimientos**********************/
Breadcrumbs::for('admin.rendimientos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Rendimientos', route('admin.rendimientos.index'));
});

Breadcrumbs::for('admin.rendimientos.create', function ($trail) {
    $trail->parent('admin.rendimientos.index');
    $trail->push('Crear', route('admin.rendimientos.create'));
});

Breadcrumbs::for('admin.rendimientos.edit', function ($trail, $id) {
    $trail->parent('admin.rendimientos.index');
    $trail->push('Editar', route('admin.rendimientos.edit', $id));
});
Breadcrumbs::for('admin.rendimientos.show', function ($trail, $id) {
    $trail->parent('admin.rendimientos.index');
    $trail->push('Ver', route('admin.rendimientos.show', $id));
});
/*******************Rendimientos**********************/


/*******************Campos**********************/
Breadcrumbs::for('admin.campos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Campos', route('admin.campos.index'));
});

Breadcrumbs::for('admin.campos.create', function ($trail) {
    $trail->parent('admin.campos.index');
    $trail->push('Crear', route('admin.campos.create'));
});

Breadcrumbs::for('admin.campos.edit', function ($trail, $id) {
    $trail->parent('admin.campos.index');
    $trail->push('Editar', route('admin.campos.edit', $id));
});

Breadcrumbs::for('admin.campos.show', function ($trail, $id) {
    $trail->parent('admin.campos.index');
    $trail->push('Ver', route('admin.campos.show', $id));
});
/*******************Campos**********************/


/*******************Empresa Contactos**********************/
Breadcrumbs::for('admin.contactos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Contactos', route('admin.contactos.index'));
});

Breadcrumbs::for('admin.contactos.create', function ($trail) {
    $trail->parent('admin.contactos.index');
    $trail->push('Crear', route('admin.contactos.create'));
});

Breadcrumbs::for('admin.contactos.edit', function ($trail, $id) {
    $trail->parent('admin.contactos.index');
    $trail->push('Editar', route('admin.contactos.edit', $id));
});

Breadcrumbs::for('admin.contactos.show', function ($trail, $id) {
    $trail->parent('admin.contactos.index');
    $trail->push('Ver', route('admin.contactos.show', $id));
});
/*******************Empresa Contactos**********************/


/*******************Oportunidades**********************/
Breadcrumbs::for('admin.oportunidades.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Oportunidades', route('admin.oportunidades.index'));
});

Breadcrumbs::for('admin.oportunidades.create', function ($trail) {
    $trail->parent('admin.oportunidades.index');
    $trail->push('Crear', route('admin.oportunidades.create'));
});

Breadcrumbs::for('admin.oportunidades.edit', function ($trail, $id) {
    $trail->parent('admin.oportunidades.index');
    $trail->push('Editar', route('admin.oportunidades.edit', $id));
});

Breadcrumbs::for('admin.oportunidades.show', function ($trail, $id) {
    $trail->parent('admin.oportunidades.index');
    $trail->push('Ver', route('admin.oportunidades.show', $id));
});

Breadcrumbs::for('admin.oportunidades.tablero', function ($trail) {
    $trail->parent('admin.oportunidades.index');
    $trail->push('Ver', route('admin.oportunidades.tablero'));
});
/*******************Oportunidades**********************/

/*******************Requerimientos**********************/
Breadcrumbs::for('admin.requerimientos.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Requerimientos', route('admin.requerimientos.index'));
});

Breadcrumbs::for('admin.requerimientos.create', function ($trail) {
    $trail->parent('admin.requerimientos.index');
    $trail->push('Crear', route('admin.requerimientos.create'));
});

Breadcrumbs::for('admin.requerimientos.edit', function ($trail, $id) {
    $trail->parent('admin.requerimientos.index');
    $trail->push('Editar', route('admin.requerimientos.edit', $id));
});

Breadcrumbs::for('admin.requerimientos.show', function ($trail, $id) {
    $trail->parent('admin.requerimientos.index');
    $trail->push('Ver', route('admin.requerimientos.show', $id));
});

Breadcrumbs::for('admin.requerimientos.changeCotizada', function ($trail, $id) {
    $trail->parent('admin.requerimientos.tablero');
    $trail->push('Asociar Cotización', route('admin.requerimientos.changeCotizada', $id));
});

Breadcrumbs::for('admin.requerimientos.changeOrdenTrabajo', function ($trail, $id) {
    $trail->parent('admin.requerimientos.tablero');
    $trail->push('Asociar Orden de Trabajo', route('admin.requerimientos.changeOrdenTrabajo', $id));
});

Breadcrumbs::for('admin.requerimientos.changeOrdenLaboratorio', function ($trail, $id) {
    $trail->parent('admin.requerimientos.tablero');
    $trail->push('Asociar Orden de Laboratorio', route('admin.requerimientos.changeOrdenLaboratorio', $id));
});

Breadcrumbs::for('admin.requerimientos.tablero', function ($trail) {
    $trail->parent('admin.requerimientos.index');
    $trail->push('Tableros', route('admin.requerimientos.tablero'));
});

/*******************Requerimientos**********************/


/*******************Comprobante Pago**********************/
Breadcrumbs::for('admin.comprobantes.index', function ($trail) {
   $trail->parent('admin.dashboard');
    $trail->push('Comprobantes de Pago', route('admin.comprobantes.index'));
});

Breadcrumbs::for('admin.comprobantes.create', function ($trail) {
    $trail->parent('admin.comprobantes.index');
    $trail->push('Crear', route('admin.comprobantes.create'));
});

Breadcrumbs::for('admin.comprobantes.edit', function ($trail, $id) {
    $trail->parent('admin.comprobantes.index');
    $trail->push('Editar', route('admin.comprobantes.edit', $id));
});

Breadcrumbs::for('admin.comprobantes.show', function ($trail, $id) {
    $trail->parent('admin.comprobantes.index');
    $trail->push('Ver', route('admin.comprobantes.show', $id));
});
/*******************Comprobante Pago**********************/

/*******************Notas de Crédito**********************/
Breadcrumbs::for('admin.notascredito.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Notas de Crédito', route('admin.notascredito.index'));
});

Breadcrumbs::for('admin.notascredito.show', function ($trail, $id) {
    $trail->parent('admin.notascredito.index');
    $trail->push('Ver', route('admin.notascredito.show', $id));
});
/*******************Notas de Crédito**********************/


require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';



