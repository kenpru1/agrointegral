@extends('backend.layouts.app')

@section('title', app_name() . ' | Tipo de Actividades')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       
                       <strong>Administración de Tipo de Actividades</strong>
                       
                        
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
                       @php  $key=count($tipoActividades)@endphp
                        @foreach($tipoActividades as $tipoActividad)

                            <tr>
                                <td>{{ $key-- }}</td>
                                {{--@if($logged_in_user->hasRole('administrator'))--}}
                                    <td onclick="window.location='{{route('admin.tipo_actividades.show', $tipoActividad->id)}}';">
                                        @if($tipoActividad->empresa_id==null)
                                            Sistema
                                        @else
                                            {{ucwords($tipoActividad->empresa->nombre)}}
                                        @endif
                                    </td>

                                {{--@endif--}}
                                <td onclick="window.location='{{route('admin.tipo_actividades.show', $tipoActividad->id)}}';">{{ ucwords($tipoActividad->nombre) }}</td>
                                      

                                </td>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $tipoActividad->action_buttons !!}</td>
                            @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.tipo_actividades.includes.header-buttons')
                    @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    
   

@endsection
