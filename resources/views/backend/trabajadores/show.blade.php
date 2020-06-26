@extends('backend.layouts.app')

@section('title','Trabajador | Mostrar' )

@section('content')
{{ html()->modelForm($trabajador, 'PATCH', route('admin.trabajadores.update',$trabajador))->class('form-horizontal')->open() }}
       <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administración de Trabajadores
                                <small class="text-muted">Ver</small>
                            </h5>

                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Rut')->for('rut') }}
                                    
                                        <input type="text" class="form-control" id="rut" name="rut" required oninput="checkRut(this)" placeholder="Ingrese RUT" value="{{$trabajador->rut}}" readonly>
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label(__('validation.attributes.backend.access.permissions.name'))->for('name') }}
                                    {{ html()->text('nombre')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                        ->attribute('maxlength', 100)
                                        ->required()
                                        ->readonly()
                                        ->autofocus() }}
                                </div><!--form-group-->


                                </div>


                                <div class="row">
                                <div class="form-group col-md-5">
                                        {{ html()->label('Tipo')->for('tipo_trabajador_id') }}
                                        {{ html()->select('tipo_trabajador_id', $tipos,null)
                                            ->placeholder('Seleccione Tipo', false)
                                            ->class('form-control')
                                            ->required()
                                            ->attribute('disabled')
                                            ->id('tipo_trabajador_id') }}

                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Nivel Califación')->for('nivel_calificacion_id') }}
                                            {{ html()->select('nivel_calificacion_id', $niveles,null)
                                                ->placeholder('Seleccione Nivel', false)
                                                ->class('form-control')
                                                ->required()
                                                ->attribute('disabled')
                                                ->id('nivel_calificacion_id') }}
                                </div><!--form-group-->
                                </div>


                                <div class="row">
                                
                                <div class="form-group col-md-5 ">
                                    <input type="checkbox" name="asesor" value="1" {{$trabajador->asesor==1?'checked':''}}/> Asesor
                                </div><!--form-group-->


                                </div>


                                <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Email')->for('email') }}
                                    {{ html()->text('email')
                                        ->class('form-control')
                                        ->placeholder('Email')
                                        ->attribute('maxlength', 50)
                                        ->required()
                                        ->readonly()
                                        ->autofocus() }}
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Teléfono')->for('telefono') }}
                                    {{ html()->text('telefono')
                                        ->class('form-control')
                                        ->placeholder('Teléfono')
                                        ->attribute('maxlength', 50)
                                        ->readonly()
                                        ->autofocus() }}
                                </div><!--form-group-->


                                </div>
                                <div class="row">
                                     <div class="form-group col-md-5">
                                        {{ html()->label('Nacionalidad')->for('nacionalidad') }}
                                        {{ html()->text('nacionalidad')
                                        ->class('form-control')
                                        ->placeholder('Nacionalidad')
                                        ->attribute('maxlength', 50)
                                        ->autofocus()
                                        ->required() }}
                                    </div><!--form-group-->

                                     <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Provincias')->for('provincia_id') }}
                                     {{ html()->select('provincia_id', $provincias,null)
                                        ->placeholder('Seleccione Provincia', false)
                                        ->class('form-control')
                                        ->required()
                                        ->attribute('disabled')
                                        ->id('provincia_id') }}
                                </div><!--form-group-->
                               


                                

                               </div>

                                <div class="row">
                                    <div class="form-group col-md-5 ">
                                     {{ html()->label('Comuna')->for('comuna_id') }}
                                     {{ html()->select('comuna_id', $comuna,$trabajador->comuna_id)
                                          ->placeholder('Seleccione Comuna', false)
                                          ->class('form-control chosen-select')
                                          ->required()
                                          ->attribute('disabled')
                                          ->id('comuna_id') }}
                                </div><!--form-group-->
                                    
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Código Postal')->for('codigo_postal') }}
                                        {{ html()->text('codigo_postal')
                                            ->class('form-control')
                                            ->placeholder('Código Postal')
                                            ->attribute('maxlength', 20)
                                            ->readonly()
                                            ->autofocus() }}
                                    </div><!--form-group-->


                                </div>



                                <div class="row">
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Dirección')->for('direccion') }}
                                        {{ html()->text('direccion')
                                            ->class('form-control')
                                            ->placeholder('Dirección')
                                            ->attribute('maxlength', 100)
                                            ->readonly()
                                            ->autofocus() }}
                                    </div>
                                    <div class="form-group col-md-5 col-md-push-1">
                                        
                                    </div>
                                   


                                </div>


                                <div class="row">
                                    <div class="form-group col-md-12">
                                        {{ html()->label('Comentarios')->for('comentarios') }}
                                        <textarea class="summernote" id="comentarios" name="comentarios" title="Comentarios">
                                            {{ $trabajador->comentarios }}
                                        </textarea>
                                    </div>
                                 

                                </div>






                                @if($logged_in_user->hasRole('administrator'))
                                    <div class="row">
                                        <div class="form-group col-md-5 ">
                                            {{ html()->label('Empresa')->for('empresa_id') }}
                                            {{ html()->select('empresa_id', $empresas,null)
                                                ->placeholder('Seleccione Empresa', false)
                                                ->class('form-control')
                                                ->required()
                                                ->id('empresa_id') }}
                                        </div><!--form-group-->
                                    </div>
                               @endif



                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.trabajadores.index')}}" >@lang('buttons.general.cancel')</a>
                              
                                
                            </div>




                            </form>
                        </div>
                    </div>
                </div>


{{ html()->form()->close() }}
@endsection
@section('scripts')
<script>
    $('#comentarios').summernote({
        height: 150,
    });
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
            }
        });
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


</script>
@endsection

