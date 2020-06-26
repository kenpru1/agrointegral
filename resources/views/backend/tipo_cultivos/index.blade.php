@extends('backend.layouts.app')

@section('title', app_name() . ' | Tipo de Cultivos')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       
                       <strong>Administración de Tipo de Cultivos</strong>
                       
                        
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
                            <th>Estado</th>
                           @endif
                            
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php  $key=count($tipoCultivos)@endphp 
                        @foreach($tipoCultivos as $tipoCultivo)

                            <tr>
                                <td>{{ $key-- }}</td>
                                {{--@if($logged_in_user->hasRole('administrator'))--}}
                                    <td onclick="window.location='{{route('admin.tipo_cultivos.show', $tipoCultivo->id)}}';">
                                        @if($tipoCultivo->empresa_id==null)
                                            Sistema
                                        @else
                                            {{ucwords($tipoCultivo->empresa->nombre)}}
                                        @endif
                                    </td>

                                {{--@endif--}}
                                <td onclick="window.location='{{route('admin.tipo_cultivos.show', $tipoCultivo->id)}}';">{{ ucwords($tipoCultivo->nombre) }}</td>
                                <td onclick="window.location='{{route('admin.tipo_cultivos.show', $tipoCultivo->id)}}';">
                                    @if($tipoCultivo->estado==1)
                                        Activo
                                    @else
                                        Inactivo
                                    @endif

                                </td>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $tipoCultivo->action_buttons !!}</td>
                            @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.tipo_cultivos.includes.header-buttons')
                    @endif
                </div>
            </div><!--col-->
        </div><!--row-->
  
   

@endsection
