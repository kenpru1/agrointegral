@extends('backend.layouts.app')

@section('title', app_name() . ' | Rendimientos')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
                       
            <strong>Administración de Rendimientos de Cuarteles</strong>                
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
                            <th>Cuartel</th>
                            <th>Fecha de Cosecha</th>
                            <th>Toneladas Brutas</th>
                            <th>Producción</th>
                            <th>Descarte Bruto</th>
                            <th>Total de Producción</th>
                            <th>Exportación</th>
                            <th>Descarte de Producción</th>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php  $key=count($rendimientos)@endphp 
                        @foreach($rendimientos as $rendimiento)

                            <tr>
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td onclick="window.location='{{route('admin.rendimientos.show', $rendimiento->id)}}';">{{ $rendimiento->empresa->nombre }}</td>
                                @endif
                                <td onclick="window.location='{{route('admin.rendimientos.show', $rendimiento->id)}}';">{{ $rendimiento->cuartel->nombre }}</td>
                                <td onclick="window.location='{{route('admin.rendimientos.show', $rendimiento->id)}}';">{{ $rendimiento->fecha_año }}</td>
                                <td onclick="window.location='{{route('admin.rendimientos.show', $rendimiento->id)}}';">{{ $rendimiento->toneladas_brutas }} <strong>ton</strong></td>
                                <td onclick="window.location='{{route('admin.rendimientos.show', $rendimiento->id)}}';">{{ $rendimiento->produccion }} <strong>ton</strong>|</td>
                                <td onclick="window.location='{{route('admin.rendimientos.show', $rendimiento->id)}}';">
                                    {{ $rendimiento->descarte_bruto }} <strong>ton</strong></td>
                                <td onclick="window.location='{{route('admin.rendimientos.show', $rendimiento->id)}}';">{{ $rendimiento->total_produccion }} <strong>ton</strong></td>
                                <td onclick="window.location='{{route('admin.rendimientos.show', $rendimiento->id)}}';">{{ $rendimiento->exportacion }} <strong>ton</strong></td>
                                <td onclick="window.location='{{route('admin.rendimientos.show', $rendimiento->id)}}';">{{ $rendimiento->descarte_produccion }} <strong>ton</strong></td>
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $rendimiento->action_buttons !!}</td>
                                @endif
                            
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.rendimientos_cuarteles.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->

   

@endsection
