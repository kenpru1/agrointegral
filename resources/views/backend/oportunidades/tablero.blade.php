@extends('backend.layouts.app')

@section('title', app_name() . ' | Oportunidades')

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
        	@include('backend.oportunidades.includes.tabs.tab-registrada')
        	@include('backend.oportunidades.includes.tabs.tab-contacto-establecido')
        	@include('backend.oportunidades.includes.tabs.tab-cliente-potencial')
        </div>
        <div class="row">
            @include('backend.oportunidades.includes.tabs.tab-presupuestada')
            @include('backend.oportunidades.includes.tabs.tab-negociacion')
            @include('backend.oportunidades.includes.tabs.tab-aprobada')
        </div>--}}

<div class="container testimonial-group">
  <div class="row">
    <div class="col-xs-4">@include('backend.oportunidades.includes.tabs.tab-registrada')</div><!--
 --><div class="col-xs-4">@include('backend.oportunidades.includes.tabs.tab-contacto-establecido')</div><!--
 --><div class="col-xs-4">@include('backend.oportunidades.includes.tabs.tab-cliente-potencial')</div><!--
 --><div class="col-xs-4">@include('backend.oportunidades.includes.tabs.tab-presupuestada')</div><!--
 --><div class="col-xs-4">@include('backend.oportunidades.includes.tabs.tab-negociacion')</div><!--
 --><div class="col-xs-4">@include('backend.oportunidades.includes.tabs.tab-aprobada')</div><!--
 --><div class="col-xs-4"></div>
  
  </div>


</div>
        <div>
        	@include('backend.oportunidades.includes.modal')
        </div>
    </div>


    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
        <div class="mail-body text-right">
            <a class="btn btn-white btn-sm" href="{{route('admin.oportunidades.index')}}" >@lang('buttons.general.cancel')</a>
            <a href="{{ route('admin.oportunidades.create') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="@lang('labels.general.create_new')">Nueva Oportunidad</a>   
        </div>
    @endif

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

            $("#registrada, #contacto, #cliente, #presupuestada, #negociacion, #aprobada").sortable({
                connectWith: ".connectList",
                receive: function(event, ui) {
                    var oportunidad = ui.item[0].attributes[2].value;
                    var new_tablero = event.target.id;
                    var old_tablero = ui.sender[0].id;
                    //console.log(ui.sender[0].id);
                    $.ajax({
                        type:'post',
                        url: '{{ url('admin/changeToTablero') }}',
                        dataType: 'json',
                        data: {"oportunidad": oportunidad, "old_tablero": old_tablero, "new_tablero": new_tablero},
                        success: function(data)
                        {
                            $("span."+old_tablero).html("<b>$"+data['total_start']+"</b>");
                            $("span."+new_tablero).html("<b>$"+data['total_receive']+"</b>");
                            //alert(data.success);
                        },
                        error : function() 
                        {
                            alert('error...');
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
    </script>
@endsection