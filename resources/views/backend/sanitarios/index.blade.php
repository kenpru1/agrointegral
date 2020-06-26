@extends('backend.layouts.app')

@section('title', app_name() . ' | Sanitarios')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                           
                       
                        <strong>Administrador de Sanitarios
                            <small class="text-muted">{{$animal->nombre}}</small>
                        </strong>
                            
                       
                        
                    </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Termino</th>
                            <th>Responsable</th>
                            
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($sanitarios)@endphp 
                        @foreach($sanitarios as $sanitario)

                            <tr>
                                <td>{{ $key-- }}</td>
                                <td onclick="window.location='{{route('admin.sanitarios.show', $sanitario->id)}}';">{{strip_tags($sanitario->tipo_sanitario->nombre)}}</td>
                                
                                <td onclick="window.location='{{route('admin.sanitarios.show', $sanitario->id)}}';" >{{$sanitario->nombre}}</td>

                                <td onclick="window.location='{{route('admin.sanitarios.show', $sanitario->id)}}';">{{isset($sanitario->fecha_inicio)?$sanitario->fecha_inicio->format('d-m-Y'):'-'}}</td>

                                <td onclick="window.location='{{route('admin.sanitarios.show', $sanitario->id)}}';">{{isset($sanitario->fecha_termino)?$sanitario->fecha_termino->format('d-m-Y'):'-'}}</td>
                                                              

                                <td onclick="window.location='{{route('admin.sanitarios.show', $sanitario->id)}}';" >{{$sanitario->trabajador->nombre}}</td>
                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                    <td> {!! $sanitario->action_buttons !!}</td>
                                @endif
                                
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @include('backend.sanitarios.includes.header-buttons')
                </div>
            </div><!--col-->
        </div><!--row-->
    </div>
   

@endsection
