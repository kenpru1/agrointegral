@extends('backend.layouts.app')

@section('title', app_name() . ' | Requerimientos')

@section('content')

<style type="text/css">
    /* The heart of the matter */
.testimonial-group > .row {
  overflow-x: auto;
  white-space: nowrap;
  height:700px;

}
.testimonial-group > .row > .col-xs-4 {
  display: inline-block;
  float: none; 
}
.pitchuu {
    position: absolute;
}
.wrapper-content {
    padding: 1px 1px 1px;
}



</style>
	<div class="wrapper wrapper-content  animated fadeInRight">
        {{--<div class="row">
        	@include('backend.requerimientos.includes.tabs.tab-registrada')
        	@include('backend.requerimientos.includes.tabs.tab-coizada')
        </div>
        <div class="row">
            @include('backend.requerimientos.includes.tabs.tab-aprobada')
            @include('backend.requerimientos.includes.tabs.tab-tomaMuestra')
            @include('backend.requerimientos.includes.tabs.tab-enviada')
            @include('backend.requerimientos.includes.tabs.tab-recibida')
                 
        </div>--}}

<div class="container testimonial-group">
    <div class="row" style="height: auto;">
        <div class="col-lg-6">  @include('backend.requerimientos.includes.tabs.tab-registrada')
        </div>
    </div>
    <div class="row" style="height: auto;">  
        <div class="col-lg-6">
            @include('backend.requerimientos.includes.tabs.tab-cotizada')
        </div>
    </div>
    <div class="row" style="height: auto;">
        <div class="col-lg-6">
            @include('backend.requerimientos.includes.tabs.tab-aprobada')
        </div>
    </div>
    <div class="row" style="height: auto;">
        <div class="col-lg-6">
            @include('backend.requerimientos.includes.tabs.tab-tomaMuestra')
        </div>
    </div>
    <div class="row" style="height: auto;">
        <div class="col-lg-6">
            @include('backend.requerimientos.includes.tabs.tab-enviada')
        </div>
    </div>
    <div class="row" style="height: auto;">
        <div class="col-lg-6">
            @include('backend.requerimientos.includes.tabs.tab-recibida')
        </div>
    </div>
 

</div>
        <div>
        	@include('backend.requerimientos.includes.modal')
        </div>
    </div>


@endsection

@section('scripts')
	<script>

        $(document).ready(function(){

            $.ajaxSetup({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#registrada, #cotizada, #aprobada, #muestra, #enviada_laboratorio, #informes_recibidos").sortable({
                connectWith: ".connectList",
                receive: function(event, ui) {
                    var requerimiento = ui.item[0].attributes[2].value;
                    var new_tablero = event.target.id;
                    var old_tablero = ui.sender[0].id;
                    //console.log(ui.sender[0].id);
                    $.ajax({
                        type:'post',
                        url: '{{ url('admin/changeToTablero') }}',
                        dataType: 'json',
                        data: {"requerimiento": requerimiento, "old_tablero": old_tablero, "new_tablero": new_tablero},
                        success: function(data)
                        {
                            console.log('paso');
                            $("span."+old_tablero).html("<b>$"+data['total_start']+"</b>");
                            $("span."+new_tablero).html("<b>$"+data['total_receive']+"</b>");
                            if((data['old_tablero'] == 'aprobada') && (data['requerimiento'] == null) ) {
                                alert('Debe Asociar Orden de Trabajo');
                                setTimeout(location.reload(),3000);

                            }else{
                                location.reload();                                
                            }

                                                    
                        },
                        error : function(datos) 
                        {
                            //$('.alert alert-danger').html('');
                            $.each(datos.responseJSON, function(key,value) {
                                //$('.alert alert-danger').append('<div class="alert alert-danger">'+value+'</div');
                                console.log(key);
                                console.log(value);
                                alert(value);

                            }); 
                            //alert(mensaje);
                            setTimeout(location.reload(),3000);


                        },

                    });

                },

            }).disableSelection();

            /*$("#registrada").sortable({
                connectWith: "#contacto",
            }).disableSelection();*/

            /*$("#registrada, #cliente, #contacto").sortable({
                connectWith: ".connectList",
                update: function( event, ui ) {

                    var registrada = $( "#registrada" ).sortable( "toArray" );
                    var cliente = $( "#cliente" ).sortable( "toArray" );
                    var contacto = $( "#contacto" ).sortable( "toArray" );
                    $('.output').html("Registrada: " + window.JSON.stringify(registrada) + "<br/>" + "Cliente potencial: " + window.JSON.stringify(cliente) + "<br/>" + "Contacto establecido: " + window.JSON.stringify(contacto));
                    console.log(ui);
                }
            }).disableSelection();*/
    

        });
    function cotiza(valor1, valor2) {
        $.ajax({
            url: "{{ url('admin/asociarCotizacion')}}" ,
            type: 'GET',
            dataType: 'json',
            data: {"presupuesto_id": valor1 , "requerimiento_id": valor2},
            success: function (data) {
                
                alert(data['message']);                
                
                setTimeout(location.reload(),3000);
            },
            error : function(error) {

                $.each(data.responseJSON, function(key,value) {
                    //$('.alert alert-danger').append('<div class="alert alert-danger">'+value+'</div');
                    console.log(key);
                    console.log(value);
                    alert(value);

                }); 
                //alert(mensaje);
                setTimeout(location.reload(),3000);
            },
        });
    };     

    function ordenTrabajo(valor1, valor2) {
        $.ajax({
            url: "{{ url('admin/asociarOrdenTrabajo') }}",
            type: 'GET',
            dataType: 'json',
            data: {"orden_trabajo_id": valor1 , "requerimiento_id": valor2},
            success: function (data) {

                alert(data['message']);                
                setTimeout(location.reload(),3000);
    

            },
            error : function(error) {

                $.each(data.responseJSON, function(key,value) {
                    //$('.alert alert-danger').append('<div class="alert alert-danger">'+value+'</div');
                    console.log(key);
                    console.log(value);
                    alert(value);

                }); 
                //alert(mensaje);
                setTimeout(location.reload(),3000);
            },
        });
    };

    function ordenLaboratorio(valor1, valor2) {
        $.ajax({
            url: "{{ url('admin/asociarOrdenLaboratorio') }}",
            type: 'GET',
            dataType: 'json',
            data: {"orden_laboratorio_id": valor1 , "requerimiento_id": valor2},
            success: function (data) {

                alert(data['message']);                
                setTimeout(location.reload(),3000);


            },
            error : function(error) {

                $.each(data.responseJSON, function(key,value) {
                    //$('.alert alert-danger').append('<div class="alert alert-danger">'+value+'</div');
                    console.log(key);
                    console.log(value);
                    alert(value);

                }); 
                //alert(mensaje);
                setTimeout(location.reload(),3000);
            },
        });
    };

    </script>
@endsection