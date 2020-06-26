@extends('backend.layouts.app')

@section('title', app_name() . ' | Contactos')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Administración de Contactos
        </strong>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" data-page-length="8">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        <th>Nombre completo</th>
                        <th>Correo electrónico</th>
                        <th>Nro. Teléfono</th>
                        <th>Cliente</th>
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php  $key=count($contactos)@endphp 
                    @foreach($contactos as $contacto)
                    <tr>
                        <td>{{ $key-- }}</td>
                        <td onclick="window.location='{{ route('admin.contactos.show', $contacto->id) }}';">
                            {{ $contacto->nombres }} {{ $contacto->apellidos }}
                        </td>
                        <td onclick="window.location='{{ route('admin.contactos.show', $contacto->id) }}';">
                            {{ $contacto->email }}
                        </td>
                        <td onclick="window.location='{{ route('admin.contactos.show', $contacto->id) }}';">
                            {{ $contacto->celular }}
                        </td>
                        <td class="text-right"  onclick="window.location='{{ route('admin.contactos.show', $contacto->id) }}';">
                            {{ $contacto->clienteProveedor->nombre_razon }}
                        </td>
                        
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <td>
                            {!! $contacto->action_buttons !!}
                        </td>
                        @endif
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.empresa_contactos.includes.header-buttons')
            @endif
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
