@extends('backend.layouts.app_nobread')

@section('content')
 <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Verifique los datos de su Transacción
        <small class="text-muted">Pagos</small>
        </h5>
                            
    </div>
 <div class="ibox-content">                            

    <form class="form-horizontal" method="POST" action="{{ route('admin.payment.create') }}">
     

                          <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="pull-right">
                                            <i class="fa fa-cc-amex text-success"></i>
                                            <i class="fa fa-cc-mastercard text-warning"></i>
                                            <i class="fa fa-cc-discover text-danger"></i>
                                        </div>
                                        <h5 class="panel-title">
                                            <a  data-parent="#accordion" href="#collapseTwo">Pago</a>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse in">
                                        <div class="panel-body">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h2>Detalle</h2>
                                                    <strong>Plan:</strong>: {{ $orden['nombrePlan'] }} <br/>
                                                    <strong>Valor del Plan:</strong>: {{ $orden['monto'] }} + IVA mensual<br/>
                                                    <strong>Requiere Facturación:</strong>: {{ $orden['facturacion'] }}<br/> 
                                                    <strong>Periodo a Pagar:</strong>: {{ $orden['inicio_periodo'] }} - {{ $orden['fin_periodo'] }}<br/> 
                                                    <strong>Valor UF:</strong>:$<span class="text-navy"> {{ $orden['monto'] }}</span><br/>
                                                    <strong>IVA:</strong>: $<span class="text-navy">{{ $orden['monto_iva'] }} </span><br/>
                                                    <strong>Total a Pagar:</strong>: $<span class="text-navy">{{ $orden['total'] }}</span> <br/>

                                                    <p class="m-t" align="justify">
                                                        Para tu seguridad y tranquilidad, en nuestras bases de datos no se almacena ninguna información referente a tus tarjetas de crédito o débito. Todo el proceso de pago de realiza a través de integraciones seguras y directamente con los concentradores de pagos; Flow y Transbank respectivamente.


                                                    </p>
                                                    <p align="justify">
                                                        
                                                       Recuerda que todos tus comprobantes de pago y detalle de facturación, la puedes encontrar en "Plan y Facturación" en el menú de "Configuración".
                                                    </p>
                                                </div>
                                                <div class="col-md-8">

                                                    <form role="form" id="payment-form">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="form-group">
                                                                    <label>NUMERO ORDEN</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" name="orden" id="orden" placeholder="Valid Card Number" required readonly value="{{ $orden['orden_compra'] }}">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-5 col-md-5">
                                                                <div class="form-group">
                                                                    <label>RUT</label>
                                                                    <input type="text" class="form-control" name="rut" value="{{ $orden['rut']}}" placeholder="MM / YY"  required readonly />
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-4 col-md-4 col-md-push-2">
                                                                <div class="form-group">
                                                                    <label>TOTAL A PAGAR</label>
                                                                    <input type="text" class="form-control" name="total" placeholder="Monto"  required readonly value="{{ $orden['total'] }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-11">
                                                                <div class="form-group">
                                                                    <label>DESCRIPCIÓN</label>
                                                                    <input type="text" class="form-control" name="concepto" value="{{ $orden['concepto'] }}" placeholder="DESCRIPCIÓN" readonly>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-11">
                                                                <div class="form-group">
                                                                    <label>EMAIL COMPROBANTE</label>
                                                                    <input type="text" class="form-control" name="pagador" id="pagador" value="{{ $orden['email_pagador'] }}" placeholder="Email" readonly>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-7">
                                                                <div class="form-group">
                                                                    <label>PASARELA DE PAGO</label>
                                                                    {{ html()->select('paymentMethods', $paymentMethods,$orden['paymentMethodsId'])
                                                                     ->placeholder('Seleccione Pasarela dePago', false)
                                                                     ->class('form-control')
                                                                     ->required()
                                                                     ->id('paymentMethods') }}
                                                                
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                              <a class="btn btn-white btn-sm" href="{{route('admin.payment.index')}}">
                                                                @lang('buttons.general.cancel')
                                                              </a>
                                                                <button class="btn btn-primary" type="submit">Pagar</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>

                                            </div>






                                        </div>
                                    </div>
                                </div>

 
























<!--

       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('No. Orden')->for('orden') }}
               {{--<input type="text" class="form-control" name="orden" id="orden" placeholder="1000" required value="{{ $orden['orden_compra']  }}" readonly>--}}

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Rut')->for('rut') }}
                {{-- <input type="text" class="form-control"  name="rut" id="rut" placeholder="9999999-9" value="{{ $orden['rut']  }}" required readonly>--}}
                                                                     
            </div>
       
       </div>

       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Monto')->for('monto') }}
               {{--  <input type="text" class="form-control" name="monto" id="monto" placeholder="20000" required value="{{ $orden['monto'] }}" readonly>--}}

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Concepto')->for('concepto') }}
                {{-- <input type="text" class="form-control" name="concepto" id="concepto" placeholder="Pago de Orden N° 1000" required value="{{ $orden['concepto'] }}" readonly>--}}
                                                                     
            </div>
       
       </div>
       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Email Pagador')->for('email') }}
              {{--  <input type="email" class="form-control" name="pagador" id="pagador" placeholder="usuario@email.com" value="{{ $orden['email_pagador'] }}" readonly   required>--}}

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
            {{ html()->label('Pasarelas')->for('pasarelas') }}
                {{ html()->select('paymentMethods', $paymentMethods,$orden['paymentMethodsId'])
                            ->placeholder('Seleccione Pasarela dePago', false)
                            ->class('form-control')
                            ->required()
                            ->id('paymentMethods') }}
             
                                                                     
            </div>
       
       </div>
       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Plan')->for('plan') }}
               <input type="email" class="form-control" name="plan" id="plan" placeholder="" value="{{ $orden['nombrePlan'] }}" readonly>

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
             {{ html()->label('Requiere Facturacion')->for('pasarelas') }}
             <input type="email" class="form-control" name="facturacion" id="facturacion" placeholder="" value="{{ $orden['facturacion'] }}" readonly>
                                                                                             
            </div>
       
       </div>

       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Porcentaje IVA')->for('porc_iva') }}
               <input type="email" class="form-control" name="porc_iva" id="porc_iva" placeholder="" value="{{ number_format($orden['porc_iva'],2,'.','') }}" readonly>

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
             {{ html()->label('Iva')->for('monto_iva') }}
             <input type="email" class="form-control" name="monto_iva" id="monto_iva" placeholder="" value="{{ number_format($orden['monto_iva'],2,'.','') }}" readonly>
                                                                                             
            </div>
       
       </div>

       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Total')->for('total') }}
               <input type="email" class="form-control" name="total" id="total" placeholder="" value="{{ number_format($orden['total'],2,'.','') }}" readonly>

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
                                                                               
            </div>
       
       </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        
        <div class="mail-body text-right tooltip-demo">
                <a class="btn btn-white btn-sm" href="{{route('admin.payment.index')}}">
                        @lang('buttons.general.cancel')
                    </a>
                <button class="btn btn-sm btn-primary" type="submit">Aceptar</button>
        </div>
    
-->

    </form>
</div>

</div>





   
@endsection