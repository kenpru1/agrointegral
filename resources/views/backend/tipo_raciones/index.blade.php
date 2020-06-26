@extends('backend.layouts.app')

@section('title', app_name() . ' | Tipo Raciones')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       
                       <strong>Administración de Tipo Raciones</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            {{--@if($logged_in_user->hasRole('administrator'))--}}
                                <th>Empresa</th>
                            {{--@endif--}}
                            <th>Nombre</th>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            
                           @endif
                            
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($tipoRaciones)@endphp
                        @foreach($tipoRaciones as $tipoRacion)

                            <tr>
                                <td>{{ $key-- }}</td>

                                    <td onclick="window.location='{{route('admin.tipo_raciones.show', $tipoRacion->id)}}';">{{ ucwords($tipoRacion->descripcion) }}</td>
                                
                                    <td onclick="window.location='{{route('admin.tipo_raciones.show', $tipoRacion->id)}}';">
                                        @if($tipoRacion->empresa_id==null)
                                            Sistema
                                        @else
                                            {{ucwords($tipoRacion->empresa->nombre)}}
                                        @endif
                                    </td>

                                
                               
                                      

                                </td>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $tipoRacion->action_buttons !!}</td>
                            @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.tipo_raciones.includes.header-buttons')
                    @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    
   

@endsection
