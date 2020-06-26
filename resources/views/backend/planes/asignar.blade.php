@extends('backend.layouts.app')

@section('title', 'Planes')

@section('content')
{{ html()->form('POST', route('admin.planes.saveAsig'))->class('form-horizontal')->open() }}
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administrador de Planes
                <small class="text-muted">
                    
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">
                <div class="row">
                    <div class="form-group col-md-5">

                        {{ html()->label('Empresas')->for('empresa_id') }}
                        {{ html()->select('empresa_id', $empresas,null)
                            ->placeholder('Seleccione Empresa', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('empresa_id') }}
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                       {{ html()->label('Planes')->for('planes_id') }}
                        {{ html()->select('planes_id', $planes,null)
                            ->placeholder('Seleccione Plan', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('planes_id') }} 
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-5">
                        <div class="payment-card" id="div_empresa">
                            <h2 id="nombre_empresa"></h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <small id="direccion"></small>
                            </div>
                            <div class="col-sm-6 text-right">
                                <small id="comuna"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <small id="plan"></small>
                            </div>
                            <div class="col-sm-6 text-right">
                                <small id="cantidad_uf"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <small id="costo"></small>
                            </div>
                            <div class="col-sm-6 text-right">
                                <small id="bloquear"></small>
                                
                            </div>
                            <div id="div_empresa_id" class="col-sm-6 text-right">
                                
                                
                            </div>
                        </div>
                   
                         </div>
                       
                        

                        
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">

                        <div class="payment-card" id="div_plan">
                            <h2 id="nombre_plan"></h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <small id="plan_cantidad_uf"></small>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <small id="plan_valor_uf"></small>
                            </div>
                            <div class="col-sm-6 text-right">
                                <small id="plan_costo"></small>
                            </div>
                        </div>
                       
                   
                         </div>
                     
                    </div>
                </div>
                

               
            </form>
        </div>
        <div class="mail-body text-right tooltip-demo">
            <a class="btn btn-white btn-sm" href="{{route('admin.planes.index')}}">
                @lang('buttons.general.cancel')
            </a>
            <button class="btn btn-sm btn-primary" type="submit">
                Guardar
            </button>
        </div>
    </div>
</div>
{{ html()->form()->close() }}
@endsection
@section('scripts')
<script>
    $("#div_empresa").hide();
    $("#div_plan").hide();



    $("#empresa_id").change(function () {
        if($(this).val()==""){
            $("#div_empresa").hide();
        }else{
            $("#div_empresa").show();    
        }

        $.ajax({
            url: "{{ url('admin/getEmpresa') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
            success: function (rta) {
                console.log(rta);
                $('#nombre_empresa').html('<p><strong>'+ rta.nombre +'</strong></p>');
                $('#direccion').html('<p> <strong>Dirección: </strong>'+ rta.direccion +'</p>');
                $('#comuna').html('<p> <strong>Comuna: </strong>'+ rta.comuna +'</p>');
                $('#plan').html('<p> <strong>Plan Actual: </strong>'+ rta.plan.nombre +'</p>');
                $('#cantidad_uf').html('<p> <strong>Cantidad(UF): </strong>'+ rta.plan.cantidad_uf +'</p>');
                $('#costo').html('<p><strong> Costo: </strong> '+ rta.plan.costo +'</p>');
                
                //inactiva
                if(rta.activa!=1){
                    $('#bloquear').html('<button class="btn btn-sm btn-primary" type="button" onclick="activacion()" >Activar</button>');
                    
               }
               
               //activa
               if(rta.activa==1){
                $('#bloquear').html('<button class="btn btn-sm btn-danger" type="button" onclick="desactivacion()" >Desactivar</button>');
                    
               }
                
            }
        });
    });
   

    function activacion(){
        $.ajax({
            url: "{{ url('admin/planes/actEmp') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
            success: function (rta) {
               $('#bloquear').html('');
               $('#bloquear').html('<button class="btn btn-sm btn-danger" type="button" onclick="desactivacion()" >Desactivar</button>');
              }
            
        });
    }

    function desactivacion(){
        $.ajax({
            url: "{{ url('admin/planes/desactEmp') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
            success: function (rta) {
                $('#bloquear').html('');
                $('#bloquear').html('<button class="btn btn-sm btn-primary" type="button" onclick="activacion()" >Activar</button>');
                 }
            
        });
    }


    $("#planes_id").change(function () {
        
        if($(this).val()==""){
            $("#div_plan").hide();
        }else{
            $("#div_plan").show();    
        }

        


        $.ajax({
            url: "{{ url('admin/getPlan') }}",
            type: 'get',
            dataType: 'json',
            data: {"plan_id": $("#planes_id").val()},
            success: function (rta) {
                console.log(rta);
                $('#nombre_plan').html('<p><strong>'+ rta.nombre +'</strong></p>');
                $('#plan_cantidad_uf').html('<p> <strong>Cantidad (UF): </strong>'+ rta.cantidad_uf +'</p>');
                $('#plan_valor_uf').html('<p> <strong>UF: </strong>'+ rta.valor_uf +'</p>');
                $('#plan_costo').html('<p> <strong>Costo: </strong>'+ rta.costo +'</p>');
               
                
            }
        });
    });


</script>
@endsection
