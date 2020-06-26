@extends('backend.layouts.app')

@section('title', app_name() . ' | Tipo de Maquinarias')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       <strong>Administración de Tipo de Maquinarias</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Nombre</th>
                            <th>Empresa</th>
                            
                            
                           @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))                            
                               <th>@lang('labels.general.actions')</th>
                           @endif
                        </tr>
                        </thead>
                        <tbody>
                        @php  $key=count($tipoMaquinarias)@endphp
                        @foreach($tipoMaquinarias as $tipoMaquinaria)

                            <tr>
                                <td>{{ $key-- }}</td>
                                <td onclick="window.location='{{route('admin.tipo_maquinarias.show', $tipoMaquinaria->id)}}';">{{ ucwords($tipoMaquinaria->nombre) }}</td>
                                <td onclick="window.location='{{route('admin.tipo_maquinarias.show', $tipoMaquinaria->id)}}';">
                                    @if($tipoMaquinaria->empresa_id==null)
                                       Sistema
                                    @else
                                    {{$tipoMaquinaria->empresa->nombre}}
                                    @endif

                                </td>
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))     
                                    <td>{!! $tipoMaquinaria->action_buttons !!}</td>
                                @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                       @include('backend.tipo_maquinarias.includes.header-buttons')
                    @endif
                </div>
            </div><!--col-->
        </div><!--row-->
   
   

@endsection
