@extends('backend.layouts.app')

@section('title', app_name() . ' | Rodeos')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       
                       <strong>Administración de Rodeos</strong>
                       
                        
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
                       @php  $key=count($rodeos)@endphp
                        @foreach($rodeos as $rodeo)

                            <tr>
                                <td>{{ $key-- }}</td>
                                {{--@if($logged_in_user->hasRole('administrator'))--}}
                                    <td onclick="window.location='{{route('admin.rodeos.show', $rodeo->id)}}';">
                                        @if($rodeo->empresa_id==null)
                                            Sistema
                                        @else
                                            {{ucwords($rodeo->empresa->nombre)}}
                                        @endif
                                    </td>

                                {{--@endif--}}
                                <td onclick="window.location='{{route('admin.rodeos.show', $rodeo->id)}}';">{{ ucwords($rodeo->nombre) }}</td>
                                      

                                </td>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $rodeo->action_buttons !!}</td>
                            @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.rodeos.includes.header-buttons')
                    @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    
   

@endsection
