@extends('backend.layouts.app')

@section('title', app_name() . ' | Especies')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       
                       <strong>Administración de Especies</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            {{--@if($logged_in_user->hasRole('administrator'))--}}
                                <th>Empresa</th>
                            {{--@endif--}}
                            <th>Nombre</th>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            
                           @endif
                            
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($especies)@endphp
                        @foreach($especies as $especie)

                            <tr>
                                <td>{{ $key-- }}</td>
                                {{--@if($logged_in_user->hasRole('administrator'))--}}
                                    <td onclick="window.location='{{route('admin.especies.show', $especie->id)}}';">
                                        @if($especie->empresa_id==null)
                                            Sistema
                                        @else
                                            {{ucwords($especie->empresa->nombre)}}
                                        @endif
                                    </td>

                                {{--@endif--}}
                                <td onclick="window.location='{{route('admin.especies.show', $especie->id)}}';">{{ ucwords($especie->nombre) }}</td>
                                      

                                </td>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $especie->action_buttons !!}</td>
                            @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.especies.includes.header-buttons')
                    @endif
                </div>
            </div><!--col-->
        </div><!--row-->


@endsection
