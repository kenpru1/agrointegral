@extends('backend.layouts.app')

@section('title', app_name() . ' | Raciones')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                           
                       
                        <strong>Administrador de Raciones
                          
                        </strong>
                            
                       
                        
                    </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Animal</th>
                            <th>Tipo Rac.</th>
                            <th>Responsable</th>
                            <th>Fecha</th>
                            
                            
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($raciones)@endphp 
                        @foreach($raciones as $racion)

                            <tr>
                                <td>{{ $key-- }}</td>
                                <td onclick="window.location='{{route('admin.raciones.show', $racion->id)}}';">{{strip_tags($racion->animal->nombre)}}</td>
                                
                                <td onclick="window.location='{{route('admin.raciones.show', $racion->id)}}';" >{{$racion->tipo_racion->descripcion}}</td>

                                <td onclick="window.location='{{route('admin.raciones.show', $racion->id)}}';" >{{$racion->trabajador->nombre}}</td>

                                <td onclick="window.location='{{route('admin.raciones.show', $racion->id)}}';">{{isset($racion->fecha)?$racion->fecha->format('d-m-Y'):'-'}}</td>

                               
                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                    <td> {!! $racion->action_buttons !!}</td>
                                @endif
                                
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @include('backend.raciones.includes.header-buttons')
                </div>
            </div><!--col-->
        </div><!--row-->

   

@endsection
