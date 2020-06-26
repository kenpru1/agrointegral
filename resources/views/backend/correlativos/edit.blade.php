@extends('backend.layouts.app')

@section('title', 'Correlativos | Editar' )

@section('content')
{{ html()->modelForm($correlativo, 'PATCH', route('admin.correlativos.update',$correlativo))->class('form-horizontal')->open() }}
      <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><h5>Administración de Correlativos
                                <small class="text-muted">Editar</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                    <div class="form-group col-md-5">
                                    {{ html()->label('Presupuesto')->for('name') }}
                                    <input type="number" class="form-control" name="presupuesto" value="{{ $correlativo->presupuesto }}" required>

                                                             
                                    </div>

                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Factura')->for('name') }}
                                        <input type="number" class="form-control" name="factura" value="{{ $correlativo->factura }}" required>
                                    </div><!--form-group-->
                               
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-5">
                                    {{ html()->label('Guía Despacho')->for('name') }}
                                    <input type="number" class="form-control" name="guia_despacho" value="{{ $correlativo->guia_despacho }}" required>

                                                             
                                    </div>

                                    <div class="form-group col-md-5 col-md-push-1">
                                        
                                    </div><!--form-group-->
                               
                                </div>


                              

                                
                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.correlativos.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                
                            </div>



                                
                            </form>
                        </div>
                    </div>
                </div>

{{ html()->form()->close() }}
@endsection
