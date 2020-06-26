@extends('backend.layouts.app')

@section('title', app_name() . ' | Facturas')

@section('content')
    <div class="ibox float-e-margins">


        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            
                            
                            
                                <ul class="nav nav-tabs">
                                    <li class="{{$pestaña == 0 ? 'active' : '' }}"><a data-toggle="tab" href="#tab-1"> Emitidas</a></li>
                                    <li class="{{$pestaña == 1 ? 'active' : '' }}"><a data-toggle="tab" href="#tab-2"> Recibidas</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane {{$pestaña == 0 ? 'active' : '' }}">
                                        <div>
                                            <hr>
                                            {{ html()->form('POST', route('admin.facturas.find'))->class('form-horizontal')->open() }}
                                                <form class="form-horizontal">
                                                    <input type="hidden" name="tipo_factura" value="0">
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            {{ html()->label('Fecha Desde')->for('fecha_desde') }} 
                                                            <input type="date" class="form-control" name="fecha_desde">
                                                        </div>

                                                        <div class="form-group col-md-3 col-md-push-1">
                                                            {{ html()->label('Fecha Hasta')->for('fecha_hasta') }} 
                                                            <input type="date" class="form-control" name="fecha_hasta">
                                                        </div>
                                                        
                                                        <div class="form-group col-md-4 col-md-push-2">
                                                            {{ html()->label('Cliente')->for('cliente') }} 
                                                            {{ html()->select('cliente_id', $clientes, null)
                                                                ->placeholder('Seleccione Cliente', false)
                                                                ->class('form-control chosen-select')
                                                                ->id('cliente_proveedor_id') }}
                                                        </div>                                  
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            {{ html()->label('Folio')->for('folio') }}
                                                            <input type="text" name="folio" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-3 col-md-push-1">
                                                            {{ html()->label('Fecha Vencimiento')->for('fecha_vence') }} 
                                                            <input type="date" class="form-control" name="fecha_vence">
                                                        </div>

                                                        <div class="form-group col-md-4 col-md-push-2">
                                                            {{ html()->label('Tipo Pago')->for('tipo_pago') }} 
                                                            {{ html()->select('tipo_pago', $tipoPago, null)
                                                                ->placeholder('Seleccione Tipo Pago', false)
                                                                ->class('form-control chosen-select')
                                                                ->id('tipo_pago_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            {{ html()->label('Total menor a')->for('total_menor') }} 
                                                            <input type="text" class="form-control" name="total_menor">
                                                        </div>
                                                        <div class="form-group col-md-4 col-md-push-1">
                                                            {{ html()->label('Total mayor a')->for('total_mayor') }} 
                                                            <div class="input-group"><input type="text" class="form-control" name="total_mayor"><span class="input-group-btn"> <button class="btn btn-primary" type="submit">Consultar</button></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 col-md-push-10">    
                                                            <a class="btn btn-white btn-sm" href="{{route('admin.facturas.index')}}" >Ver Todos</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            {{ html()->form()->close() }}
                                        </div>
                                        <div class="full-height-scroll">
                                            @include('backend.facturas.includes.tabs.table-facturas-emitidas')
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane {{$pestaña == 1 ? 'active' : ''}}">
                                        <div>
                                            <hr>
                                            {{ html()->form('POST', route('admin.facturas.find'))->class('form-horizontal')->open() }}
                                                <form class="form-horizontal">
                                                    <input type="hidden" name="tipo_factura" value="1">
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            {{ html()->label('Fecha Desde')->for('fecha_desde') }} 
                                                            <input type="date" class="form-control" name="fecha_desde">
                                                        </div>

                                                        <div class="form-group col-md-3 col-md-push-1">
                                                            {{ html()->label('Fecha Hasta')->for('fecha_hasta') }} 
                                                            <input type="date" class="form-control" name="fecha_hasta">
                                                        </div>
                                                        
                                                        <div class="form-group col-md-4 col-md-push-2">
                                                            {{ html()->label('Tercero')->for('tercero') }} 
                                                            {{ html()->select('tercero_id', $terceros, null)
                                                                ->placeholder('Seleccione Tercero', false)
                                                                ->class('form-control chosen-select')
                                                                ->id('tercero_id') }}
                                                        </div>                                  
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            {{ html()->label('Ref.')->for('ref') }}
                                                            <input type="text" name="ref" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-3 col-md-push-1">
                                                            {{ html()->label('Fecha Vencimiento')->for('fecha_vence') }} 
                                                            <input type="date" class="form-control" name="fecha_vence">
                                                        </div>

                                                        <div class="form-group col-md-4 col-md-push-2">
                                                            {{ html()->label('Tipo Pago')->for('tipo_pago') }} 
                                                            {{ html()->select('tipo_pago', $tipoPago, null)
                                                                ->placeholder('Seleccione Tipo Pago', false)
                                                                ->class('form-control chosen-select')
                                                                ->id('tipo_pago_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            {{ html()->label('Total menor a')->for('total_menor') }} 
                                                            <input type="text" class="form-control" name="total_menor">
                                                        </div>
                                                        <div class="form-group col-md-4 col-md-push-1">
                                                            {{ html()->label('Total mayor a')->for('total_mayor') }} 
                                                            <div class="input-group"><input type="text" class="form-control" name="total_mayor"><span class="input-group-btn"> <button class="btn btn-primary" type="submit">Consultar</button></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 col-md-push-10">    
                                                            <a class="btn btn-white btn-sm" href="{{route('admin.facturas.index')}}" >Ver Todos</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            {{ html()->form()->close() }}
                                        </div>
                                        <div class="full-height-scroll">
                                            @include('backend.facturas.includes.tabs.table-facturas-recibidas')
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

