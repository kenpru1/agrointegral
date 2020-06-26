@extends('backend.layouts.app')

@section('title', app_name() . ' | Celos')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Administración de Celos
        </strong>
    </div>
    <div class="ibox-content">
    {{ html()->form('POST', route('admin.celos.find'))->class('form-horizontal')->open() }}
        <form class="form-horizontal">
            @if($logged_in_user->hasRole('administrator'))
                 <div class="row">
                    <div class="form-group col-md-5 ">
                        {{ html()->label('Empresa')->for('empresa_id') }}
                        {{ html()->select('empresa_id', $empresas,null)
                            ->placeholder('Seleccione Empresa', false)
                            ->class('form-control chosen-select')
                            ->id('empresa_id') }}
                    </div><!--form-group-->
                </div>
            @endif
                <div class="row">
                    <div class="form-group col-md-4 ">
                        {{ html()->label('Animales')->for('animal_id') }}
                        {{ html()->select('animal_id', $animales,null)
                            ->placeholder('Seleccione Animal', false)
                            ->class('form-control chosen-select')
                            ->id('animal_id') }}
                    </div><!--form-group-->
                    <div class="form-group col-md-8">
                        <div class="col-md-4">
                            {{ html()->label('Fecha Detección')->for('fecha_deteccion') }}
                            <div class="input-group"><input type="date" class="form-control" name="fecha_deteccion"><span class="input-group-btn"> <button class="btn btn-primary" type="submit">Consultar</button></span></div>

                        </div>
                                                        
                    </div>

            </div>
        {{ html()->form()->close() }}
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" data-page-length="8">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        @if($logged_in_user->hasRole('administrator'))
                        <th>Empresa</th>
                        @endif
                        <th>Animal</th>
                        <th>Fecha Detección</th>
                       
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <th>
                            @lang('labels.general.actions')
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php  $key=count($celos)@endphp 
                    @foreach($celos as $celo)
                    <tr>
                        <td>{{ $key-- }}</td>
                        @if($logged_in_user->hasRole('administrator'))
                        <td onclick="window.location='{{route('admin.celos.show', $celo->id)}}';">
                            {{$celo->animal->nombre}}
                        </td>
                        @endif
                        <td onclick="window.location='{{route('admin.celos.show', $celo->id)}}';">
                            {{$celo->animal->nombre}}
                        </td>
                        <td onclick="window.location='{{route('admin.celos.show', $celo->id)}}';">
                            {{ ucwords($celo->fecha_deteccion->format('d-m-Y')) }}
                        </td>
                        
                      
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <td>
                            {!! $celo->action_buttons !!}
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.celos.includes.header-buttons')
            @endif
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
