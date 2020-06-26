@extends('backend.layouts.app')

@section('title', app_name() . ' | Clima')

@section('content')
{{-- <style>
    .weather
    {
        display: flex;
        flex-flow: column wrap;
        box-shadow: 0px 1px 10px 0px #cfcfcf;
        overflow: hidden;
    }

        .weather .current
        {
            display: flex;
            flex-flow: row wrap;
            /*background-image: url("/Content/images/shared/misc/london-view.png");*/
            background-image: url("{{ asset('/img/backend/clima.jpg') }}");
            background-repeat: repeat-x;

            color: white;
            padding: 20px;
            text-shadow: 1px 1px #F68D2E;
        }

            .weather .current .info
            {
                display: flex;
                flex-flow: column wrap;
                justify-content: space-around;
                flex-grow: 2;
            }

                .weather .current .info .city
                {
                    font-size: 26px;
                }

                .weather .current .info .temp
                {
                    font-size: 56px;
                }

                .weather .current .info .wind
                {
                    font-size: 24px;
                }

            .weather .current .icon
            {
                text-align: center;
                font-size: 64px;
                flex-grow: 1;
            }

        .weather .future
        {
            display: flex;
            flex-flow: row nowrap;
        }

            .weather .future .day
            {
                flex-grow: 1;
                text-align: center;
                cursor: pointer;
            }

                .weather .future .day:hover
                {
                    color: #fff;
                    background-color: #F68D2E;
                }

                .weather .future .day h3
                {
                    text-transform: uppercase;
                }

                .weather .future .day p
                {
                    font-size: 28px;
                }
</style>--}}
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Clima
        </strong>
    </div>
    {{ html()->form('POST', route('admin.anuncios.index'))->open() }}
    
    {{ html()->form()->close() }}
    <div class="ibox-content">

        <div class="wrapper wrapper-content animated fadeInRight">

       @php $cont=0; @endphp
       @foreach($campos as $campo)     
        @if($cont==0)
        <div class="row">
        @endif
        <div class="col-md-6">
            <div class="ibox">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-12">
                            <strong>{{ isset($campo->nombre)?$campo->nombre:'NI' }}</strong>
                        </div>
                        <div class="col-xs-8">
                            <h3><strong>{{isset($campo->clima->condition_temperature)?$campo->clima->condition_temperature:'NI' }}&deg; C</strong></h3>
                        </div>
                        <div class="col-xs-4">
                        <span class="{!!isset($campo->clima->clima_condicion->class_icon)?$campo->clima->clima_condicion->class_icon:'fa fa-ban'!!} fa-3x"></span>

                        </div>
                        <div class="col-xs-12">
                            Fecha: {{isset($campo->clima->pubDate)?$campo->clima->pubDate->format('d-m-Y'):'NI' }} 
                        </div>
                        <div class="col-xs-12">
                            Viento: {{isset($campo->clima->wind_speed)?$campo->clima->wind_speed:0 }} km/h 
                        </div>
                        <div class="col-xs-12">
                            Dirección: </small></small> {{isset($campo->clima->wind_direction)?$campo->clima->wind_direction:0 }}&deg;
                        </div>
                        <div class="col-xs-12">
                            Condición: {{ isset($campo->clima->clima_condicion->descripcion)?$campo->clima->clima_condicion->descripcion:'NI' }}
                        </div>
                        <div class="col-xs-5">
                            Humedad: {{ isset($campo->clima->atmosphere_humidity)?$campo->clima->atmosphere_humidity:'NI' }}%
                        </div>

                    </div>
                    <div class="row">
                        @if(isset($campo->clima->clima_predicciones ))
                        @foreach($campo->clima->clima_predicciones as $prediccion)
                        <div class="col-md-1">
                            <h4>{{ isset($prediccion->day)?$prediccion->day: 'NI' }}</h4>
                            <p><span class="{!! isset($prediccion->clima_condicion->class_icon)?$prediccion->clima_condicion->class_icon:'fa fa-ban' !!} fa-2x" data-toggle="tooltip" data-placement="top" title="Fecha: {{isset($prediccion->date)?$prediccion->date->format('d-m-Y'):'NI'}}, Condición: {{isset($prediccion->clima_condicion->descripcion)?$prediccion->clima_condicion->descripcion:'NI'}}, Minima: {{isset($prediccion->low)?$prediccion->low:'NI'}}&deg;, Máxima: {{ isset($prediccion->high)?$prediccion->high:'NI'}}&deg; "></span></p>
                        </div>
                        @endforeach
                        @endif
                    
                    </div>
                  

                    {{--<h5 class="m-b-md">Server status Q12</h5>
                    <h2 class="text-navy">
                    <i class="fa fa-play fa-rotate-270"></i> Up
                    </h2>
                    <small>Last down 42 days ago</small>--}}
                </div>
            </div>
        </div>
    
       
   
         @php $cont++; @endphp
        @if($cont==5)
        </div>
        @endif
     
        @if($cont==5)
           @php $cont=0; @endphp
        @endif
        @endforeach
        <br>
        <div class="row">
            <div class="col-md-11 col-md-push-10">
          {{-- {{ $publicaciones->links() }}--}}
           </div>
        </div>
@endsection
