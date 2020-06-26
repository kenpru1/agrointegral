@extends('backend.layouts.app')

@section('title', app_name() . ' | Tipo de Productos')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                                             

                       <strong>Administración de Tipo de Productos</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nombre</th>
                            
                            @if($logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       
                        @foreach($tipoProductos as $key=>$tipoProducto)

                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ ucwords($tipoProducto->nombre) }}</td>
                                @if( $logged_in_user->hasRole('administrator'))
                                    <td>{!! $tipoProducto->action_buttons !!}</td>
                                @endif
                            
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if( $logged_in_user->hasRole('administrator'))
                        @include('backend.tipo_productos.includes.header-buttons')
                    @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    </div>
   

@endsection
