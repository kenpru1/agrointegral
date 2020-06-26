@extends('backend.layouts.app')

@section('title', app_name() . ' | Ordenes de Laboratorio')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                      <strong>Ordenes de Laboratorio</strong>

                            
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
                            <th>Nro. Orden</th>
                            <th>Fecha Muestreo</th>
                             <th>Cliente</th>
                             <th>Tipo Muestra</th>
                             <th>Análisis</th>
                             <th>Número de Muestras</th> 
                             <th>Plazo Entrega</th>                                                                                      
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($ordenLaboratorios)@endphp 
                        @foreach($ordenLaboratorios as $ordenLaboratorio)

                            <tr>
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td>empresa</td>
                                @endif
                                <td onclick="window.location='{{route('admin.ordenLaboratorios.show', $ordenLaboratorio->id)}}';">{{ $ordenLaboratorio->numero }}</td>                               

                                <td onclick="window.location='{{route('admin.ordenLaboratorios.show', $ordenLaboratorio->id)}}';">{{ $ordenLaboratorio->fecha->format('d-m-Y') }}</td>

                                <td onclick="window.location='{{route('admin.ordenLaboratorios.show', $ordenLaboratorio->id)}}';">{{$ordenLaboratorio->cliente->nombre_razon}}</td>

                                <td onclick="window.location='{{route('admin.ordenLaboratorios.show', $ordenLaboratorio->id)}}';">{{isset($ordenLaboratorio->detalleOrdenLaboratorio[0]['tipoMuestra']['nombre'])?$ordenLaboratorio->detalleOrdenLaboratorio[0]['tipoMuestra']['nombre']:'' }}</td>

                                <td onclick="window.location='{{route('admin.ordenLaboratorios.show', $ordenLaboratorio->id)}}';">{{isset($ordenLaboratorio->detalleOrdenLaboratorio[0]['analisis']['nombre'])?$ordenLaboratorio->detalleOrdenLaboratorio[0]['analisis']['nombre']:''}}</td>

                                @if (isset($ordenLaboratorio->requerimientos->numero_muestra))
                                    <td onclick="window.location='{{route('admin.ordenLaboratorios.show', $ordenLaboratorio->id)}}';">{{$ordenLaboratorio->requerimientos->numero_muestra}}</td>
                                @else
                                    <td onclick="window.location='{{route('admin.ordenLaboratorios.show', $ordenLaboratorio->id)}}';">0</td>            
                                @endif

                                @if (isset($ordenLaboratorio->requerimientos->orden_trabajo_id))
                                    <td onclick="window.location='{{route('admin.ordenLaboratorios.show', $ordenLaboratorio->id)}}';">{{isset($ordenLaboratorio->requerimientos->ordenTrabajos->detalleOrdenTrabajo[0]['plazo_entrega'])?$ordenLaboratorio->requerimientos->ordenTrabajos->detalleOrdenTrabajo[0]['plazo_entrega']:'' }}</td>
                                @else
                                    <td onclick="window.location='{{route('admin.ordenLaboratorios.show', $ordenLaboratorio->id)}}';">0</td>            
                                @endif                                

                                                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $ordenLaboratorio->action_buttons !!}</td>
                                @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.orden_laboratorios.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->
   
   

@endsection
