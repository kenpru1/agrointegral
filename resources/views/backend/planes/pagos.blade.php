@extends('backend.layouts.app')

@section('title', app_name() .' | Pagos ')

@section('content')
{{ html()->form('POST', route('admin.planes.buscar'))->class('form-horizontal')->open() }}

    <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Resumen de Pagos
                               
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                                <div class="row">
                              
                               
                                <div class="form-group col-md-4 ">
                                    {{ html()->label('Empresa')->for('empresa_id') }}
                                    {{ html()->select('empresa_id', $empresas,null)
                                        ->placeholder('Seleccione Empresa', false)
                                        ->class('form-control chosen-select')
                                        ->id('empresa_id') }}
                                </div><!--form-group-->



                                <div class="form-group col-md-8">
                                    <div class="col-md-4">
                                    {{ html()->label('Fecha Inicio')->for('fecha_inicio') }}
                                    <input type="date" class="form-control" name="fecha_inicio">
                                    </div>
                                    <div class="col-md-4">
                                    {{ html()->label('Fecha Fin')->for('fecha_fin') }}
                                    <div class="input-group"><input type="date" class="form-control" name="fecha_fin"><span class="input-group-btn"> <button class="btn btn-primary" type="submit">Consultar</button></span></div>


                                    </div>
                                                        
                                </div>

                                </div>
                                <div class="row">
                                       <div class="form-group col-md-4 ">
                                    {{ html()->label('Estado')->for('estado') }}
                                    {{ html()->select('estado', $estados,null)
                                        ->placeholder('Seleccione estado', false)
                                        ->class('form-control chosen-select')
                                        ->id('empresa_id') }}
                                </div><!--form-group-->
                                    
                                </div>
                            
                                <div class="ibox-content">
                <div class="table-responsive">
                       <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>No. Orden</th>
                            <th>Empresa</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Email</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Monto</th>
                        </tr>
                        </thead>
                       
                        <tbody>
                            @foreach($pagos as $pago)
                            
                            <tr>
                                <td>{{ $pago->id}}</td>
                                <td>{{$pago->empresa->nombre}}</td>
                                <td>{{ $pago->descripcion}}</td>
                                <td>{{ $pago->estado}}</td>
                                <td>{{ $pago->email_pagador}}</td>
                                <td>{{ isset($pago->inicio_periodo)?$pago->inicio_periodo->format('d-m-Y'):'-'}}</td>
                                <td>{{ isset($pago->fin_periodo)?$pago->fin_periodo->format('d-m-Y'):'-'}}</td>
                                <td class="text-right" >$<strong>{{number_format($pago->monto, 0,'','.')}}</strong></td>
                                 
                                
                                
                            </tr>
                            
                            @endforeach
                           </tbody>
                          {{-- <tfoot>
                                    
                                    <tr>   
                                        <td class="text-right" colspan="{{$logged_in_user->hasRole('administrator')?'6':'5'}}">Total:</td>
                                        <td class="text-right" colspan="{{$logged_in_user->hasRole('administrator')?'6':'5'}}"><strong>${{$mantenciones!=null?number_format($sumTotalIva, 0,'','.'):number_format(0, 0,'','.')}}</strong></td>
                                    </tr>    
                            </tfoot>
                   --}}
                    </table>
                </div>
            </div><!--col-->

                                
                            </form>

                        </div>
                    </div>
                </div>


{{ html()->form()->close() }}
@endsection


