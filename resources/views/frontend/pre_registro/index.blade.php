@extends('frontend.layouts.app')

@section('title', app_name() . ' | Pre-registro')

@section('content')
<style type="text/css">
.form-control{
  margin-top: 15px;
}
</style>
<div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold col-md-pull-2"><div align="center">PRE-LANZAMIENTO!</div></h2>
                <p></p>
                <div align="center"><img src="{{asset('img/frontend/proterra.png')}}"></div>
                <p></p>
                <p align="justify">
                    Estamos ansiosos esperando el lanzamiento oficial de Proterra. Mientras tanto, puedes completar este registro para ser unos de los primeros en contar con una versión de prueba extendida.


                </p>

                <p align="justify">
                    Proterra es una plataforma integral en modalidad servicio, que te permitirá administrar y monitorear la producción del campo en un solo lugar. 
                </p>
              
                <p align="justify">
                    <small>Gestión de campos y cuarteles, bitácora de actividades, análisis de suelo, registro de rendimiento, facturación, administración de insumos, bodegas, maquinaria, monitoreo de humedad de suelo, humedad follaje, golpe de calor, control de heladas, agricultura de precisión y mucho más.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                
                 @include('includes.partials.messages')
                    {{ html()->form('POST', route('frontend.auth.preregistro.store'))->class('form-horizontal')->open() }}
                        <div class="form-group">
                            <input  type="text" name="nombre" maxlength="100" class="form-control" placeholder="Nombre y Apellido" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" maxlength="50" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="celular" maxlength="20" class="form-control" placeholder="Celular">
                        </div>
                        <div class="form-group">
                                {{ html()->select('provincia_id', $provincias,null)
                                        ->placeholder('Seleccione Provincia', false)
                                        ->class('form-control chosen-select')
                                        ->id('provincia_id') }}
                        </div>
                        <div class="form-group">
                            {{ html()->select('comuna_id', null,null)
                                          ->placeholder('Seleccione Comuna', false)
                                          ->class('form-control chosen-select')
                                          ->id('comuna_id') }}
                        </div>
                        <div class="form-group">
                            {{ html()->select('rubro', $rubros,null)
                                          ->placeholder('Seleccione Rubro', false)
                                          ->class('form-control chosen-select')
                                          ->id('rubro') }}
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                {!! Captcha::display() !!}
                                {{ html()->hidden('captcha_status', 'true') }}
                            </div><!--col-->
                        </div><!--row-->
                        <p></p>
                        <button type="submit" class="btn btn-primary block full-width m-b">Registrar</button>

                      {{ html()->form()->close() }}  
                        {{--<a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>--}}
                    </form>
                    <p class="m-t">
                        <small>Proterra es un Software desarollado por Concentra Ltda. © 2019</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright INAPI Proterra SaaS
            </div>
            <div class="col-md-6 text-right">
               <small>© 2018-2019</small>
            </div>
        </div>
    </div>




@endsection

    
        @push('after-scripts')
 
        {!! Captcha::script() !!}
 
@endpush

@section('scripts')
<script>
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

