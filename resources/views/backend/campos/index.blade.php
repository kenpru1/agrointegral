@extends('backend.layouts.app')

@section('title', app_name() . ' | Campos')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Administración de Campos
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
                        <th>Cliente</th>
                        <th>Propio</th>
                        <th>Provincia</th>
                        <th>Comuna</th>
                        <th>Cuarteles</th>
                        <th>Tamaño (ha)</th>
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <th>
                            @lang('labels.general.actions')
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php  $key=count($campos)@endphp 
                    @foreach($campos as $campo)
                    <tr>
                        <td>{{ $key-- }}</td>
                        @if($logged_in_user->hasRole('administrator'))
                        <td onclick="window.location='{{route('admin.campos.show', $campo->id)}}';">
                            {{$campo->empresa->nombre}}
                        </td>
                        @endif
                        <td onclick="window.location='{{route('admin.campos.show', $campo->id)}}';">
                            {{ ucwords($campo->clientes->nombre_razon) }}
                        </td>
                        
                        <td onclick="window.location='{{route('admin.campos.show', $campo->id)}}';">
                            @if($campo->propio==1)
                                        Propio
                                    @else
                                        Arrendado
                                    @endif
                        </td>
                        <td onclick="window.location='{{route('admin.campos.show', $campo->id)}}';">
                            {{$campo->provincia->nombre}}
                        </td>
                        <td onclick="window.location='{{route('admin.campos.show', $campo->id)}}';">
                            {{$campo->comuna->nombre}}
                        </td>
                        <td onclick="window.location='{{route('admin.campos.show', $campo->id)}}';">
                            {{number_format($campo->cuarteles->count(), 0)}}
                        </td>
                        <td onclick="window.location='{{route('admin.campos.show', $campo->id)}}';">
                            {{number_format($campo->cuarteles->sum('tamanno'), 2)}}
                        </td>
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <td>
                            {!! $campo->action_buttons !!}
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.campos.includes.header-buttons')
            @endif
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
