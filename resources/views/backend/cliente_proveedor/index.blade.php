@extends('backend.layouts.app')

@if( request()->route()->getName() == 'admin.clientes.index')
    @section('title', app_name() . ' | Clientes')
@else
    @section('title', app_name() . ' | Proveedores')
@endif

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            @if( request()->route()->getName() == 'admin.clientes.index')            
                Administración de Clientes
            @else
                Administración de Proveedores
            @endif            
        </strong>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" data-page-length="8">
                <thead>
                    <tr>
                        <th>Razón</th>
                        <th>Rut</th>
                        <th>Email</th>
                        <th>Telef.</th>
                        <th>Grupo</th>
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <th>
                            @lang('labels.general.actions')
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
 @foreach($cliProves as $key => $cliProve)
            <tr>

                    <td onclick="window.location='{{route('admin.cliente.show', $cliProve->id)}}';">
                            {{ $cliProve->nombre_razon }}
                    </td>


                <td onclick="window.location='{{route('admin.cliente.show', $cliProve->id)}}';">{{ $cliProve->rut }}</td>
                
                <td onclick="window.location='{{route('admin.cliente.show', $cliProve->id)}}';">{{ $cliProve->email }}</td>
               
                <td onclick="window.location='{{route('admin.cliente.show', $cliProve->id)}}';">{{ $cliProve->telefono }}</td>
                <td onclick="window.location='{{route('admin.cliente.show', $cliProve->id)}}';">{{ $cliProve->grupos->nombre }}</td>
                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                    <td>{!! $cliProve->action_buttons !!}</td>
                @endif
            </tr>
            @endforeach
                </tbody>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.cliente_proveedor.includes.header-buttons')
            @endif
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
