@extends('backend.layouts.app')

@section('title', app_name() . ' | Maquinarias')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Administración de Maquinarias
        </strong>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                <thead>
                    <tr>
                        <th>Nro.</th>
                        @if($logged_in_user->hasRole('administrator'))
                        <th>
                            Empresa
                        </th>
                        @endif
                        <th>
                            Nombre
                        </th>
                        <th>
                            Patente
                        </th>
                        <th>
                            Propio
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th>
                            Modelo
                        </th>
                        <th>
                            @lang('labels.general.actions')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php  $key=count($maquinarias)@endphp
                    @foreach($maquinarias as $maquinaria)
                    <tr >
                        <td>{{ $key-- }}</td>
                        @if($logged_in_user->hasRole('administrator'))
                        <td onclick="window.location='{{route('admin.maquinarias.show', $maquinaria->id)}}';">
                            {{ ucwords($maquinaria->empresa->nombre) }}
                        </td>
                        @endif
                        <td onclick="window.location='{{route('admin.maquinarias.show', $maquinaria->id)}}';">
                            {{ $maquinaria->nombre }}
                        </td>
                        <td onclick="window.location='{{route('admin.maquinarias.show', $maquinaria->id)}}';">
                            {{ $maquinaria->patente }}
                        </td>
                        <td onclick="window.location='{{route('admin.maquinarias.show', $maquinaria->id)}}';">
                            {{ $maquinaria->propietario }}
                        </td>
                        <td onclick="window.location='{{route('admin.maquinarias.show', $maquinaria->id)}}';">
                            @if(isset($maquinaria->tipo_maquinaria->nombre))
                                {{ $maquinaria->tipo_maquinaria->nombre }}
                            @else
                                NA
                            @endif
                        </td>
                        <td onclick="window.location='{{route('admin.maquinarias.show', $maquinaria->id)}}';">
                            {{ $maquinaria->modelo }}
                        </td>
                        <td>
                            {!! $maquinaria->action_buttons !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.maquinarias.includes.header-buttons')
            @endif
        </div>
        
        
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
