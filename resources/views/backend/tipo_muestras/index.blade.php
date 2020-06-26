@extends('backend.layouts.app')


@section('title', app_name() . ' | Tipo de Muestras')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
                Administración Tipo de Muestras
        </strong>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" data-page-length="8">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <th>
                            @lang('labels.general.actions')
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipoMuestras as $tipoMuestra)
                        <tr>
                            <td>{{ $tipoMuestra->nombre }}</td>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $tipoMuestra->action_buttons !!}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.tipo_muestras.includes.header-buttons')
            @endif
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
