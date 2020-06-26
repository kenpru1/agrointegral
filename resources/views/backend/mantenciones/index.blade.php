@extends('backend.layouts.app')

@section('title', app_name() . ' | Mantenciones')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                           
                       
                        <strong>Administrador de Mantenciones
                            <small class="text-muted">{{$maquinaria->nombre}}</small>
                        </strong>
                            
                       
                        
                    </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Costo</th>
                            <th>IVA</th>
                            <th>Total</th>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       
                        @foreach($mantenciones as $mantencion)

                            <tr>
                                <td onclick="window.location='{{route('admin.mantenciones.show', $mantencion->id)}}';">{{strip_tags($mantencion->descripcion)}}</td>
                                <td onclick="window.location='{{route('admin.mantenciones.show', $mantencion->id)}}';">{{$mantencion->fecha->format('d-m-Y')}}</td>
                                <td onclick="window.location='{{route('admin.mantenciones.show', $mantencion->id)}}';" class="text-right"><strong>${{number_format($mantencion->costo, 0,'','.')}}</strong></td>
                                <td onclick="window.location='{{route('admin.mantenciones.show', $mantencion->id)}}';" class="text-right"><strong>${{number_format($mantencion->iva, 0,'','.')}}</strong></td>
                                <td onclick="window.location='{{route('admin.mantenciones.show', $mantencion->id)}}';" class="text-right"><strong>${{number_format($mantencion->total_iva, 0,'','.')}}</strong></td>
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                    <td>{!! $mantencion->action_buttons !!}</td>
                                @endif
                                
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @include('backend.mantenciones.includes.header-buttons')
                </div>
            </div><!--col-->
        </div><!--row-->
    
   

@endsection
