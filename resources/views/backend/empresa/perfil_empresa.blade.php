@extends('backend.layouts.app')

@section('title', 'Empresas')

@section('content')
{{ html()->form('POST', route('admin.perfil_empresa.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
 <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Empresas </h5>

                        </div>
                        <div class="ibox-content">
        <form class="form-horizontal">
           <input type="hidden" name="empresa_id" value="{{isset($empresaUser->id)?$empresaUser->id:0}}" >
        <div class="row">
            <div class="form-group col-md-5">
                {{ html()->label('Nombre')->for('nombre') }}
                {{ html()->text('nombre')
                    ->class('form-control')
                    ->placeholder('Nombre')
                    ->value(isset($empresaUser)?$empresaUser->nombre:null)
                    ->autofocus()
                    ->required() }}
            </div><!--form-group-->


            <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Rut / Dni')->for('rut_dni') }}
                <input type="text" class="form-control" id="rut_dni_empresa" name="rut_dni" required oninput="checkRut(this)" placeholder="Ingrese RUT" value="{{ isset($empresaUser)?$empresaUser->rut_dni:null }}">

            </div><!--form-group-->
         </div>

        <div class="row">
            <div class="form-group col-md-5">
                {{ html()->label('Dirección')->for('direccion') }}

                {{ html()->text('direccion')
                    ->class('form-control')
                    ->placeholder('Dirección')
                    ->attribute('maxlength', 191)
                    ->value(isset($empresaUser)?$empresaUser->direccion:null)
                    ->id('direccion_empresa')
                    ->required() }}
            </div><!--form-group-->
       
            <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Comuna')->for('comuna') }}

                {{ html()->text('comuna')
                    ->class('form-control')
                    ->placeholder('Comuna')
                    ->value(isset($empresaUser)?$empresaUser->comuna:null)
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        </div>

            <div class="row">
            <div class="form-group col-md-5">
                {{ html()->label('Ciudad')->for('ciudad') }}

                {{ html()->text('ciudad')
                    ->class('form-control')
                    ->placeholder('Ciudad')
                    ->value(isset($empresaUser)?$empresaUser->ciudad:null)
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->


            <div class="form-group col-md-5 col-md-push-1">
                @if(isset($empresaUser)&&$empresaUser->pais_id!=0)

                     <?php $selected = $empresaUser->pais_id;?>

                @endif

                {{ html()->label('Paises')->for('pais_id') }}
                {{ html()->select('pais_id', $paises,$selected)->placeholder('Seleccione País', false)
                ->class('form-control chosen-select')
                ->id('pais_empresa') }}

            </div><!--form-group-->
        </div>


           <div class="row">
           <div class="form-group col-md-5">
                {{ html()->label('Código Postal')->for('codigo_postal') }}

                {{ html()->text('codigo_postal')
                    ->class('form-control')
                    ->placeholder('Código Postal')
                    ->value(isset($empresaUser)?$empresaUser->codigo_postal:null)
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->

            <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Email')->for('email') }}

                {{ html()->text('email')
                    ->class('form-control ')
                    ->placeholder('Email')
                    ->value(isset($empresaUser)?$empresaUser->email:null)
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
                                
                          

            </div>

            <div class="row">
           <div class="form-group col-md-5">
                {{ html()->label('Requiere Factura')->for('facturacion') }}
                {{ html()->select('facturacion', $facturacion,isset($empresaUser->facturacion)?$empresaUser->facturacion:null)->placeholder('Seleccione', false)
                ->class('form-control chosen-select')
                ->required() 
                ->id('facturacion') }}

            </div><!--form-group-->

            <div class="form-group col-md-5 col-md-push-1">
                <div id="div_giro">
                    {{ html()->label('Giro')->for('giro') }}
                    <input type="text" class="form-control" name="giro" id="giro" maxlength="200" value="{{ isset($empresaUser->giro)?$empresaUser->giro:'' }}">
                </div>
                
            </div><!--form-group-->
                                
                          

            </div>


            <div class="row">
            <div class="form-group col-md-5">
                {{ html()->label('Logo')->for('logo') }}
                                  
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput">
                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                    </div>
                <span class="input-group-addon btn btn-default btn-file">
                    <span class="fileinput-new">Seleccione Archivo</span>
                    <span class="fileinput-exists">Cambiar</span>
                        <input type="file" name="logo"/>
                   </span>
                   <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
                </div> 

                
                  


            </div>
            <div class="form-group col-md-4 col-md-push-2">

                @if($empresaUser!=null && $empresaUser->logo!="")
                    <img alt="Logo de la Empresa"  src="{{ asset($empresaUser->logo) }}" height="50%" width="50%" />
                @else
                    <img alt="Empresa Sin Logo"  src="{{ asset('app/public/logos_empresas/nologo.png') }}" height="50%" width="50%" />
                @endif


            </div>
            </div><!--form-group-->


        <div class="form-group">
            <div class="col-sm-10 col-sm-push-4">
                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                    <button class="btn btn-primary" type="submit">Guardar</button>
                @endif
            </div>
        </div>



                       </div>
                    </div>
                </div>

{{ html()->form()->close() }}

@endsection
@section('scripts')
<script>
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



    /*Estatdo  carga inicial del formulario*/
    var facturacion=$('#facturacion').val();
        //Si
        if(facturacion=='Si'){
         
            $('#div_giro').show();
            $('#giro').prop("required", true);
            

        }
        //No
        if(facturacion=="No"){

            $('#div_giro').hide();
            $('#giro').removeAttr("required");
    
        }

        if(facturacion!="No" && facturacion!="Si" ){

            $('#div_giro').hide();
            $('#giro').removeAttr("required");
    
        }


    
    /*Estatdo  carga inicial del formulario*/

    //cambios al seleccionar facturación Si o No
    $('#facturacion').change(function(){
        var facturacion=$('#facturacion').val();
        //Individual
        if(facturacion=='Si'){
         
            $('#div_giro').show();
            $('#giro').prop("required", true);
            

        }
        //Rodeo
        if(facturacion=="No"){

            $('#div_giro').hide();
            $('#giro').removeAttr("required");
            $('#giro').val("");
                       
        }
        if(facturacion!="No" && facturacion!="Si" ){

            $('#div_giro').hide();
            $('#giro').removeAttr("required");
    
        }
        //cambios al seleccionar si es animal o rodeo

    });


</script>
@endsection
