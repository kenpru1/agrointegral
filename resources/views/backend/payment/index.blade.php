@extends('backend.layouts.app_nobread')

@section('content')
 <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Pago
        <small class="text-muted">Pagos</small>
        </h5>
                            
    </div>
 <div class="ibox-content">                            

    <form class="form-horizontal" method="POST" action="{{ route('admin.payment.orden') }}">
      
       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('No. Orden')->for('orden') }}
               <input type="text" class="form-control" name="orden" id="orden" placeholder="1000" required value="{{ $nrOrden }}" readonly>

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Rut')->for('rut') }}
                <input type="text" class="form-control"  name="rut" id="rut" placeholder="9999999-9" value="{{ $rutDni }}" required readonly>
                                                                     
            </div>
       
       </div>

       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Monto')->for('monto') }}
               <input type="text" class="form-control" name="monto" id="monto" placeholder="20000" required value="{{ number_format($pago->monto,2,'.','')}}" readonly>

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Concepto')->for('concepto') }}
                <input type="text" class="form-control" name="concepto" id="concepto" placeholder="Pago de Orden N° 1000" required value="{{ $pago->descripcion }}" readonly>
                                                                     
            </div>
       
       </div>
       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Email Pagador')->for('email') }}
               <input type="email" class="form-control" name="pagador" id="pagador" placeholder="usuario@email.com" value="{{ $email }}"  required readonly>

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
             {{ html()->label('Pasarelas')->for('pasarelas') }}
                        {{ html()->select('paymentMethods', $paymentMethods,null)
                            ->placeholder('Seleccione Pasarela dePago', false)
                            ->class('form-control')
                            ->required()
                            ->id('empresa_id') }}
                                                                     
            </div>
       
       </div>

       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Plan')->for('plan') }}
               <input type="email" class="form-control" name="plan" id="plan" placeholder="" value="{{ $nombrePlan }}" readonly>

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
             {{ html()->label('Requiere Facturacion')->for('pasarelas') }}
             <input type="email" class="form-control" name="facturacion" id="facturacion" placeholder="" value="{{ $facturacion=='Si'?'Si':'No' }}" readonly>
                                                                                             
            </div>
       
       </div>
      <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Inicio Periodo')->for('plan') }}
               <input type="text" class="form-control" name="inicio_periodo" id="inicio_periodo" placeholder="" value="{{  Carbon\Carbon::parse($pago->inicio_periodo)->format('d-m-Y') }}" readonly>

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
             {{ html()->label('Fin Periodo')->for('fin_periodo') }}
             <input type="text" class="form-control" name="fin_periodo" id="fin_periodo" placeholder="" value="{{ Carbon\Carbon::parse($pago->inicio_periodo)->format('d-m-Y') }}" readonly>
                                                                                             
            </div>
       
       </div> 

       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Porcentaje IVA')->for('porc_iva') }}
               <input type="email" class="form-control" name="porc_iva" id="porc_iva" placeholder="" value="{{ number_format($pago->porc_iva,2,'.','') }}" readonly>

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
             {{ html()->label('Iva')->for('monto_iva') }}
             <input type="email" class="form-control" name="monto_iva" id="monto_iva" placeholder="" value="{{ number_format($pago->monto_iva,2,'.','') }}" readonly>
                                                                                             
            </div>
       
       </div>

       <div class="row">
           <div class="form-group col-md-5">
               {{ html()->label('Total')->for('total') }}
               <input type="email" class="form-control" name="total" id="total" placeholder="" value="{{ number_format($pago->total,2,'.','') }}" readonly>

                
           </div>
           <div class="form-group col-md-5 col-md-push-1">
                                                                               
            </div>
       
       </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        
        <div class="mail-body text-right tooltip-demo">
          
                <button class="btn btn-sm btn-primary" type="submit">Aceptar</button>
        </div>
    


    </form>
</div>

</div>
@endsection