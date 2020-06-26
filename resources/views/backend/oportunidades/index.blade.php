@extends('backend.layouts.app')

@section('title', app_name() . ' | Oportunidades')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Administración de Oportunidades
        </strong>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" data-page-length="8">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        @if($logged_in_user->hasRole('administrator'))
                            <th>Empresa</th>
                        @endif
                        <th>Cliente / Empresa</th>
                        <th>Contacto</th>
                        <th>Trato</th>
                        <th>Valor del trato</th>
                        <th>Fecha de cierre</th>
                        <th>Estado</th>
                        <th>Etapa</th>
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php  $key=count($oportunidades)@endphp 
                    @foreach($oportunidades as $oportunidad)
                    <tr>
                        <td>{{ $key-- }}</td>
                        @if($logged_in_user->hasRole('administrator'))
                            <td onclick="window.location='{{ route('admin.oportunidades.show', $oportunidad->id) }}';">
                                {{ $oportunidad->empresa->nombre }}
                            </td>
                        @endif
                        <td onclick="window.location='{{ route('admin.oportunidades.show', $oportunidad->id) }}';">
                            {{ $oportunidad->clienteProveedor->nombre_razon }}
                        </td>
                        <td onclick="window.location='{{ route('admin.oportunidades.show', $oportunidad->id) }}';">
                            {{ $oportunidad->empresaContacto->nombres }} {{ $oportunidad->empresaContacto->apellidos }}
                        </td>
                        <td onclick="window.location='{{ route('admin.oportunidades.show', $oportunidad->id) }}';">
                            {{ $oportunidad->titulo }}
                        </td>
                        <td class="text-right"  onclick="window.location='{{ route('admin.oportunidades.show', $oportunidad->id) }}';">
                            ${{ $oportunidad->monto }}
                        </td>
                        <td class="text-right"  onclick="window.location='{{ route('admin.oportunidades.show', $oportunidad->id) }}';">
                            {{ $oportunidad->fecha_cierre->format('d-m-Y') }}
                        </td>
                        <td class="text-right"  onclick="window.location='{{ route('admin.oportunidades.show', $oportunidad->id) }}';">
                            <span class="{{$oportunidad->estadoOportunidad->class}}">{{ $oportunidad->estadoOportunidad->nombre }}</span>
                        </td>
                        <td class="text-right"  onclick="window.location='{{ route('admin.oportunidades.show', $oportunidad->id) }}';">
                            {{ $oportunidad->etapaOportunidad->nombre }}
                        </td>
                        
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <td>
                            {!! $oportunidad->action_buttons !!}
                        </td>
                        @endif
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.oportunidades.includes.header-buttons')
            @endif
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
