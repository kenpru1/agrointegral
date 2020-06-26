@extends('backend.layouts.app')

@if( request()->route()->getName() == 'admin.cliente.create')
    @section('title', 'Clientes | ' . __('labels.backend.access.clientes.create'))
@else
    @section('title', 'Proveedores | ' . __('labels.backend.access.proveedor.create'))
@endif

@section('content')

@if( request()->route()->getName() == 'admin.cliente.create')
    {{ html()->form('POST', route('admin.cliente.store'))->class('form-horizontal')->open() }}
@else
    {{ html()->form('POST', route('admin.proveedor.store'))->class('form-horizontal')->open() }}
@endif
    <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            @if( request()->route()->getName() == 'admin.cliente.create')
                                <h5>Administración de Clientes
                                    <small class="text-muted">Crear</small>
                                </h5>
                            @else
                                <h5>Administración de Proveedores
                                    <small class="text-muted">Crear</small>
                                </h5>
                            @endif                                
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Nombre Razón')
                                ->for('name') }}
                             
                                        {{ html()->text('nombre_razon')
                                            ->class('form-control')
                                            ->placeholder('Nombre Razón')
                                            ->attribute('maxlength', 191)
                                            ->required()
                                            ->autofocus() }}
                                    
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Rut')->for('rut') }}
                                         <input type="text" class="form-control" id="rut" name="rut" required oninput="checkRut(this)" placeholder="Ingrese RUT">

                                </div><!--form-group-->
                                </div>

                                <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Teléfono')
                                ->for('name') }}
                             
                                        {{ html()->text('telefono')
                                            ->class('form-control')
                                            ->placeholder('Teléfono')
                                            ->attribute('maxlength', 50)
                                            ->autofocus() }}
                                    
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Dirección')
                                        ->for('rut') }}
                                        {{ html()->text('direccion')
                                            ->class('form-control')
                                            ->placeholder('Dirección')
                                            ->attribute('maxlength', 100)
                                            ->autofocus() }}
                                </div><!--form-group-->
                                </div>

                                <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Código Postal')
                                ->for('name') }}
                             
                                        {{ html()->text('codigo_postal')
                                            ->class('form-control')
                                            ->placeholder('Código Postal')
                                            ->attribute('maxlength', 50)
                                            ->autofocus() }}
                                    
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Web')
                                        ->for('rut') }}
                                        {{ html()->text('web')
                                            ->class('form-control')
                                            ->placeholder('Web')
                                            ->attribute('maxlength', 100)
                                            ->autofocus() }}
                                </div><!--form-group-->
                                </div>

                                <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Email')
                                ->for('name') }}

                                        {{ html()->email('email')
                                            ->class('form-control')
                                            ->placeholder('Email')
                                            ->attribute('maxlength', 50)
                                            ->required()
                                            ->autofocus() }}
                                    
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Paises')->for('pais_id') }}
                                     {{ html()->select('pais_id', $paises,46)
                                        ->placeholder('Seleccione Pais', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('pais_id') }}
                                </div><!--form-group-->
                                </div>
                               <div class="row">
                                <div class="form-group col-md-5 ">
                                     {{ html()->label('Provincias')->for('provincia_id') }}
                                     {{ html()->select('provincia_id', $provincias,null)
                                        ->placeholder('Seleccione Provincia', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('provincia_id') }}
                                </div><!--form-group-->


                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Comunas')->for('comuna_id') }}
                                     {{ html()->select('comuna_id', null,null)
                                          ->placeholder('Seleccione Comuna', false)
                                          ->class('form-control chosen-select')
                                          ->required()
                                          ->id('comuna_id') }}
                                </div><!--form-group-->

                               </div>

                                <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Grupos de Clientes')->for('grupo_id') }}
                                     {{ html()->select('grupo_id', $grupos,null)
                                        ->placeholder('Seleccione', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('grupo_id') }}
                                    
                                </div>


                                </div>                               
                               <div class="row">
                                    @if( request()->route()->getName() == 'admin.cliente.create')
                                        {{ html()->hidden('cliente')->value("1") }}
                                    @else
                                        {{ html()->hidden('proveedor')->value("1") }}
                                    @endif                                    
                               </div>

                              
                                @if($logged_in_user->hasRole('administrator'))
                                    <div class="row">
                                        <div class="form-group col-md-5 ">
                                            {{ html()->label('Empresa')->for('empresa_id') }}
                                            {{ html()->select('empresa_id', $empresas,null)
                                                ->placeholder('Seleccione Empresa', false)
                                                ->class('form-control chosen-select')
                                                ->required()
                                                ->id('empresa_id') }}
                                        </div><!--form-group-->
                                    </div>
                               @endif

                                <div class="row">
                                <div class="form-group col-md-12">
                                    {{ html()->label('Observación')->for('observacion') }}
                                    <textarea class="summernote" id="observacion" name="observacion" title="Observación"></textarea>
                                    
                                </div>

                              
                                </div>
                                                         

                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.clientes.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                
                            </div>



                                
                            </form>
                        </div>
                    </div>
                </div>


{{ html()->form()->close() }}
@endsection

@section('scripts')
<script>
    $('#observacion').summernote({
        height: 150,
    });
    function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');
    
    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();
    
    // Formatear RUN
    rut.value = cuerpo + '-'+ dv
    
    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
    
    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;
    
    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {
    
        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);
        
        // Sumar al Contador General
        suma = suma + index;
        
        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);
    
    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
    
    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}

$("#provincia_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getComunas') }}",
            type: 'get',
            dataType: 'json',
            data: {"provincia_id": $("#provincia_id").val()},
            success: function (rta) {
                $('#comuna_id').empty();
                $('#comuna_id').append("<option value='' disabled selected style='display:none;'>Seleccione Comuna</option>");
                $.each(rta, function (index, value) {
                    $('#comuna_id').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
                $('#comuna_id').trigger("chosen:updated");
            }
        });
    });

</script>
@endsection
