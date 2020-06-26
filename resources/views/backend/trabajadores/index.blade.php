@extends('backend.layouts.app')

@section('title', app_name() . ' | Trabajadores')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                      <strong> Administración de Trabajadores</strong>
                       
                        
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
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Calificación</th>
                            
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($trabajadores)@endphp 
                        @foreach($trabajadores as $trabajador)

                            <tr>
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td onclick="window.location='{{route('admin.trabajadores.show', $trabajador->id)}}';">{{$trabajador->empresa->nombre}}</td>
                                @endif
                                <td onclick="window.location='{{route('admin.trabajadores.show', $trabajador->id)}}';">{{$trabajador->rut}}</td>
                                <td onclick="window.location='{{route('admin.trabajadores.show', $trabajador->id)}}';">{{ ucwords($trabajador->nombre) }}</td>
                                <td onclick="window.location='{{route('admin.trabajadores.show', $trabajador->id)}}';">{{$trabajador->tipo_trabajador->nombre}}</td>
                                <td onclick="window.location='{{route('admin.trabajadores.show', $trabajador->id)}}';">{{$trabajador->nivel_calificacion->nombre}}</td>
                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                 <td>{!! $trabajador->action_buttons !!}</td>
                                @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        @include('backend.trabajadores.includes.header-buttons')
                    @endif
                </div>
            </div><!--col-->
        </div><!--row-->
   
   

@endsection
