@extends('backend.layouts.app_no_chosen')

@section('title', 'Crear Movimiento')

@section('content')
{{ html()->form('POST', route('admin.movimientos.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div id="movimientos">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Movimientos
                                <small class="text-muted">Crear</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                <div class="form-group col-md-5 col-md-push-3">
                                    {{ html()->label('Tipo Operacion')->for('tipo_operacion_id') }}
                                    <chosen-select v-model="operacion" name="tipo_operacion_id"  required>
                                        <option value="0" >Seleccione Operación</option>
                                        @foreach($tipoOpera as $key=>$value)
                                           <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </chosen-select>


                                </div><!--form-group-->

                                </div>
                            <div v-if="operacion!=0">
                                <div class="row">
                                  <div v-if="operacion==1"  class="form-group col-md-5">
                                    {{ html()->label('Tipo de Entrada')->for('tipo_entrada') }}
                                    <chosen-select v-model="tipo_entrada" name="tipo_entrada" required>
                                        <option value="">Seleccione Tipo Entrada</option>
                                        <option value="Ajuste Inventario">Ajuste Inventario</option>
                                        <option value="Compra">Compra</option>
                                    </chosen-select>
                                    
                                </div>
                                <div v-if="(operacion==1 && tipo_entrada=='Compra')"  class="form-group col-md-5 col-md-push-1">
                                  {{ html()->label('Factura Recibidas')->for('nro_factura') }}
                                    <chosen-select  name="factura_recibida_id" required>
                                        <option value="">Seleccione Factura</option>
                                        @foreach($factRec as $key=>$value)
                                           <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </chosen-select>
                                    
                                    
                                </div>

                                <div v-if="operacion==2"  class="form-group col-md-5">
                                    {{ html()->label('Factura')->for('nro_factura') }}
                                    <chosen-select  name="factura_id" required>
                                        <option value="">Seleccione Factura</option>
                                        @foreach($facturas as $key=>$value)
                                           <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </chosen-select>
                                </div>
                               
                         
                                </div>
                            
                                <div class="row">
                                  <div class="form-group col-md-5">
                                    {{ html()->label('Fecha')->for('fecha') }}
                                    <input type="date" class="form-control" name="fecha" value="{{date("Y-m-d")}}">
                                  </div>
                                  <div v-if="operacion!=4"  class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Bodegas')->for('bodega_id') }}
                                    <chosen-select name="bodega_id" required>
                                        <option value="">Seleccione Bodega</option>
                                        @foreach($bodegas as $key=>$value)
                                           <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </chosen-select>
                                  </div>  

                                  <div v-if="operacion==4"  class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Guía Despacho')->for('nro_guia') }}
                                    <chosen-select name="guia_despacho_id" required>
                                        <option value="">Seleccione Guía de Despacho</option>
                                        @foreach($guias as $key=>$value)
                                           <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </chosen-select>
                                  </div>
                                
                                </div>

                                <div v-if="operacion==4"  class="row">
                                  <div class="form-group col-md-5">
                                    {{ html()->label('Bodega Origen')->for('bodega_origen') }}
                                     <chosen-select name="bodega_origen" required>
                                        <option value="">Seleccione Bodega</option>
                                        @foreach($bodegas as $key=>$value)
                                           <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </chosen-select>
                                  </div>
                                  <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Bodega Destino')->for('bodega_destino') }}
                                     <chosen-select name="bodega_destino" required>
                                        <option value="">Seleccione Bodega</option>
                                        @foreach($bodegas as $key=>$value)
                                           <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </chosen-select>
                                  </div>  
                                </div>


                                <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Producto')->for('producto') }}
                                    <chosen-select name="producto_id" required>
                                        <option value="">Seleccione Producto</option>
                                        @foreach($productos as $key=>$value)
                                           <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </chosen-select>
                          
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Cantidad')->for('cantidad') }}
                                        <input type="number" class="form-control" min="1" step="any" name="cantidad" required>
                                     
                                </div><!--form-group-->
                         
                                </div>

                                <div v-if="operacion==5" class="row">
                                  <div class="form-group col-md-5">
                                    {{ html()->label('Actividades')->for('actividad_id') }}
                                    <chosen-select name="actividad_id">
                                        <option value="" >Seleccione Actividad (opcional)</option>
                                          @foreach($actividades as $key => $value)
                                             <option value="{{ $key }}">{!! $value !!}</option>
                                          @endforeach
                                    </chosen-select>
                                  </div>
                                </div>


                                <div class="row">
                                  <div v-if="operacion==2" class="form-group col-md-5">
                                    {{ html()->label('Cliente')->for('cliente_id') }}
                                     <chosen-select name="cliente_id" required>
                                        <option value="">Seleccione Cliente</option>
                                        @foreach($clientes as $key=>$value)
                                           <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </chosen-select>
                                  </div>
                                  <div v-if="operacion==1" class="form-group col-md-5">
                                    {{ html()->label('Proveedores')->for('proveedor_id') }}
                                      <chosen-select name="proveedor_id" required>
                                        <option value="">Seleccione Proveedor</option>
                                        @foreach($proveedores as $key=>$value)
                                           <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </chosen-select>
                                  </div>  
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                    {{ html()->label('Comentarios')->for('comentarios') }}
                                     {{-- <textarea class="summernote" id="comentarios" name="comentarios" title="Descripcion"></textarea> --}}

                                     <input type="text" class="form-control" name="comentarios" maxlength="800">
                                    </div>
                                 </div>
                               </div>
                                                         

                           
                            <div v-if="operacion!=0" class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.movimientos.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                
                            </div>
                            



                                
                            </form>
                        </div>
                    </div>
                
</div>

{{ html()->form()->close() }}
@endsection

@section('scripts')

<script>
    $('#comentarios').summernote({
        height: 150,
    });

Vue.component("chosen-select",{
  template:'<select class="form-control"><slot></slot></select>',
  mounted(){
    $(this.$el)
      
      .on("change", () => this.$emit('input', $(this.$el).val()))
     //.chosen()
  }
});


    var movimiento=new Vue({
        el:"#movimientos",
        data: {
            operacion: "0",
            tipo_entrada:"",
        }
    });


Vue.config.devtools = true;





</script>

@endsection


