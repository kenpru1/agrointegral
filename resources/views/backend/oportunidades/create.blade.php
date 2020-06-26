@extends('backend.layouts.app')

@section('title', 'Oportunidades' . ' | ' . 'Crear')

@section('content')
    {{ html()->form('POST', route('admin.oportunidades.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Administración de Oportunidades
                        <small class="text-muted">Crear</small>
                    </h5>                               
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Empresa')->for('cliente_proveedor_id') }}

                                {{ html()->select('cliente_proveedor_id', $cliProvs,null)
                                        ->placeholder('Seleccione Empresa', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('cliente_proveedor_id') }}            
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Contacto')
                                    ->for('empresa_contacto_id') }}

                                {{ html()->select('empresa_contacto_id', null,null)
                                          ->placeholder('Seleccione Contacto', false)
                                          ->class('form-control chosen-select')
                                          ->required()
                                          ->id('empresa_contacto_id') }}      
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Título del trato')
                                    ->for('titulo') }}
                                      
                                {{ html()->text('titulo')
                                    ->class('form-control')
                                    ->placeholder('nombre del trato')
                                    ->attribute('maxlength', 100)
                                    ->required()
                                    ->autofocus() }}            
                            </div>

                        
                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Valor del trato')
                                    ->for('monto') }}
                                      
                                <input type="number" class="form-control" name="monto" value="1" min="1" required>            
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Fecha de cierre')
                                    ->for('fecha_cierre') }}
                                      
                                <input type="date" class="form-control" name="fecha_cierre" value={{ date('Y-m-d') }} required>            
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Estado de la Oportunidad')->for('estado_oportunidad_id') }}

                                {{ html()->select('estado_oportunidad_id', $estados, null)
                                    ->placeholder('Seleccione Estado de la Oportunidad', false)
                                    ->class('form-control  chosen-select')
                                    ->required()
                                    ->id('estado_oportunidad_id') }}            
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ html()->label('Etapa de la Oportunidad:')->for('etapa_oportunidad_id') }}
                                <small>Registrada</small>
                                <div class="progress progress-bar-default">
                                    <div style="width: 10%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" role="progressbar" class="progress-bar">
                                        <span class="sr-only">10% Complete (success)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mail-body text-right tooltip-demo">
                            <a class="btn btn-white btn-sm" href="{{route('admin.oportunidades.index')}}" >@lang('buttons.general.cancel')</a>
                            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        </div>  
                    </form>
                </div>
            </div>

    {{ html()->form()->close() }}
@endsection

@section('scripts')
    <script>
        $("#cliente_proveedor_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getContactos')  }}",
            type: 'get',
            dataType: 'json',
            data: {"cliente_proveedor_id": $("#cliente_proveedor_id").val()},

            success: function (rta) {
                $('#empresa_contacto_id').empty();
                $('#empresa_contacto_id').append("<option value='' disabled selected style='display:none;'>Seleccione Contacto</option>");
                $.each(rta, function (index, value) {
                    $('#empresa_contacto_id').append("<option value='" + value.id + "'>" + value.nombres + ' ' + value.apellidos + "</option>");
                });
                $('#empresa_contacto_id').trigger("chosen:updated");
            }
        });
    });
    </script>
@endsection