@extends('backend.layouts.app')


@section('title', app_name() . ' | Laboratorio')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
                Administración Laboratorio
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
                    @foreach($laboratorios as $laboratorio)
                        <tr>
                            <td>{{ $laboratorio->nombre }}</td>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $laboratorio->action_buttons !!}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.laboratorio.includes.header-buttons')
            @endif
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
