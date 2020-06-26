@extends('backend.layouts.app')

@section('title', app_name() . ' | Correlativos')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       
                       <strong>Administración de Correlativos</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            @if($logged_in_user->hasRole('administrator'))
                                <th>Empresa</th>
                            @endif
                            <th>Presupuesto</th>
                            <th>Factura</th>
                            <th>Guía Despacho</th>
                            
                            
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                        @foreach($correlativos as $correlativo)

                            <tr>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td >{{ $correlativo->empresa->nombre }}</td>

                                @endif
                                <td >{{ $correlativo->presupuesto }}</td>
                                <td >{{ $correlativo->factura }}</td>
                                <td >{{ $correlativo->guia_despacho }}</td>
                                
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $correlativo->action_buttons !!}</td>
                            @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                   
                </div>
            </div><!--col-->
        </div><!--row-->


@endsection
