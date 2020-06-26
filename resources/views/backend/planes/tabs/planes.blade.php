  <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <input type="hidden" name="empresa_id" value="{{isset($empresaUser)?$empresaUser->id:''}}">

                    <div class="payment-card" id="div_plan">
                            <h2 id="nombre_plan"><strong>Plan: {{ $planes->nombre }}</strong></h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <medium id="plan_cantidad_uf">
                                    <strong>Cantidad (UF): {{ $planes->cantidad_uf }}</strong>
                                </medium>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <medium id="plan_valor_uf">
                                    <strong>Valor (UF): {{ $planes->valor_uf }}</strong>
                                </medium>
                            </div>
                            <div class="col-sm-3 text-right">
                                <medium id="plan_costo">
                                    <strong>Costo: {{ $planes->costo }}</strong>
                                </medium>
                            </div>
                        </div>
                        <br>
                         <div class="row">
                            <div class="col-sm-3">
                                <medium id="plan_valor_uf">
                                    <strong>Creacion de la cuenta: {{ $empresaUser->created_at->format('d-m-Y') }}</strong>
                                </medium>
                            </div>
                            <div class="col-sm-3 text-right">
                                <medium id="plan_costo">
                                    <strong>Fin periodo prueba: {{ $empresaUser->created_at->addDay(config('app.periodo_prueba'))->format('d-m-Y') }}</strong>
                                </medium>
                            </div>
                        </div>
                       
                   
                    </div>
                 
                 
                </div>
            </div><!--col-->
        </div><!--row-->