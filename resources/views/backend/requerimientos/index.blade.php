@extends('backend.layouts.app')

@section('title', app_name() . ' | Requerimientos')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Administración de Requerimientos
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
                        <th>Fecha de Muestreo</th>
                        <th>Etapa</th>
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                    @php  $key=count($requerimientos)@endphp 
                    @foreach($requerimientos as $requerimiento)

                    <tr>
                        <td>{{ $key-- }}</td>
                        @if($logged_in_user->hasRole('administrator'))
                            <td onclick="window.location='{{ route('admin.requerimientos.edit', $requerimiento->id) }}';">
                                {{ $requerimiento->empresa->nombre }}
                            </td>
                        @endif
                        <td onclick="window.location='{{ route('admin.requerimientos.edit', $requerimiento->id) }}';">
                            {{ $requerimiento->clienteProveedor->nombre_razon }}
                        </td>
                        <td onclick="window.location='{{ route('admin.requerimientos.edit', $requerimiento->id) }}';">
                            {{ $requerimiento->empresaContacto->nombres }} {{ $requerimiento->empresaContacto->apellidos }}
                        </td>
                        <td onclick="window.location='{{ route('admin.requerimientos.edit', $requerimiento->id) }}';">
                            {{ $requerimiento->titulo }}
                        </td>
                        <td class="text-right"  onclick="window.location='{{ route('admin.requerimientos.edit', $requerimiento->id) }}';">
                            {{ $requerimiento->fecha_cierre->format('d-m-Y') }}
                        </td>
                        <td class="text-right"  onclick="window.location='{{ route('admin.requerimientos.edit', $requerimiento->id) }}';">
                            <span class="{{$requerimiento->etapaRequerimiento->colores}}">{{ isset($requerimiento->etapaRequerimiento->nombre)?$requerimiento->etapaRequerimiento->nombre:'' }}</span>
                        </td>
                        
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <td>
                            {!! $requerimiento->action_buttons !!}
                        </td>
                        @endif
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.requerimientos.includes.header-buttons')
            @endif
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
