@extends('backend.layouts.app')

@section('title', app_name() . ' | Ordenes de Trabajos')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                      <strong>Ordenes de Trabajo</strong>

                            
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                   <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                   
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            @if($logged_in_user->hasRole('administrator'))
                                <th>Empresa</th>
                            @endif
                            <th>Nro.</th>
                            <th>Fecha Muestreo</th>
                             <th>Cliente</th>
                             <th>Tipo Muestra</th>
                             <th>Análisis</th>
                             <th>Número de Muestras</th>
                             <th>Laboratorio</th>                             
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($ordenTrabajos)@endphp 
                        @foreach($ordenTrabajos as $ordenTrabajo)
                            <tr>
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td>empresa</td>
                                @endif
                                <td onclick="window.location='{{route('admin.ordenTrabajos.show', $ordenTrabajo->id)}}';">{{ $ordenTrabajo->numero }}</td>                               

                                <td onclick="window.location='{{route('admin.ordenTrabajos.show', $ordenTrabajo->id)}}';">{{ $ordenTrabajo->fecha->format('d-m-Y') }}</td>
                                
                                <td onclick="window.location='{{route('admin.ordenTrabajos.show', $ordenTrabajo->id)}}';">{{$ordenTrabajo->cliente->nombre_razon}}</td>


                                <td onclick="window.location='{{route('admin.ordenTrabajos.show', $ordenTrabajo->id)}}';">{{isset($ordenTrabajo->detalleOrdenTrabajo[0]['tipoMuestra']['nombre'])?$ordenTrabajo->detalleOrdenTrabajo[0]['tipoMuestra']['nombre']:'' }}</td>

                                <td onclick="window.location='{{route('admin.ordenTrabajos.show', $ordenTrabajo->id)}}';">{{isset($ordenTrabajo->detalleOrdenTrabajo[0]['analisis']['nombre'])?$ordenTrabajo->detalleOrdenTrabajo[0]['analisis']['nombre']:''}}</td>                                

                                @if (isset($ordenTrabajo->requerimientos->numero_muestra))
                                    <td onclick="window.location='{{route('admin.ordenTrabajos.show', $ordenTrabajo->id)}}';">{{$ordenTrabajo->requerimientos->numero_muestra}}</td>
                                @else
                                    <td onclick="window.location='{{route('admin.ordenTrabajos.show', $ordenTrabajo->id)}}';">0</td>            
                                @endif

                                <td onclick="window.location='{{route('admin.ordenTrabajos.show', $ordenTrabajo->id)}}';">{{isset($ordenTrabajo->detalleOrdenTrabajo[0]['laboratorio']['nombre'])?$ordenTrabajo->detalleOrdenTrabajo[0]['laboratorio']['nombre']:'' }}</td>
                                                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $ordenTrabajo->action_buttons !!}</td>
                                @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.orden_trabajos.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->
   
   

@endsection
