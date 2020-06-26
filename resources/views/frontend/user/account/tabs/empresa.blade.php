{{ html()->form('POST', route('frontend.user.profile.empresa.update'))->class('form-horizontal')->open() }}
    
           <input type="hidden" value="{{isset($empresaUser->id)?$empresaUser->id:0}}" name="empresa_id">
            
            <div class="form-group col-md-5">
                {{ html()->label('Nombre')->for('nombre') }}
                {{ html()->text('nombre')
                    ->class('form-control')
                    ->placeholder('Nombre')
                    ->value(isset($empresaUser)?$empresaUser->nombre:null)
                    ->autofocus()
                    ->required() }}
            </div><!--form-group-->
        
    
            <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Rut / Dni')->for('rut_dni') }}

                {{ html()->text('rut_dni')
                    ->class('form-control')
                    ->placeholder('Rut/ Dni')
                    ->value(isset($empresaUser)?$empresaUser->rut_dni:null)
                    ->id('rut_dni_empresa')
                    ->required() }}
            </div><!--form-group-->
        

    
            <div class="form-group col-md-5">
                {{ html()->label('Dirección')->for('direccion') }}

                {{ html()->text('direccion')
                    ->class('form-control')
                    ->placeholder('Dirección')
                    ->attribute('maxlength', 191)
                    ->value(isset($empresaUser)?$empresaUser->direccion:null)
                    ->id('direccion_empresa')
                    ->required() }}
            </div><!--form-group-->
        

    
            <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Comuna')->for('comuna') }}

                {{ html()->text('comuna')
                    ->class('form-control')
                    ->placeholder('Comuna')
                    ->value(isset($empresaUser)?$empresaUser->comuna:null)
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        
    
            <div class="form-group col-md-5">
                {{ html()->label('Ciudad')->for('ciudad') }}

                {{ html()->text('ciudad')
                    ->class('form-control')
                    ->placeholder('Ciudad')
                    ->value(isset($empresaUser)?$empresaUser->ciudad:null)
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        
   
            <div class="form-group col-md-5 col-md-push-1">
                @if(isset($empresaUser)&&$empresaUser->pais_id!=0)

                     <?php $selected=$empresaUser->pais_id; ?>

                @endif

                {{ html()->label('Paises')->for('pais_id') }}
                {{ html()->select('pais_id', $paises,$selected)->placeholder('Seleccione País', false)
                ->class('form-control')
                ->id('pais_empresa') }}
            
            </div><!--form-group-->
     

    
           <div class="form-group col-md-5">
                {{ html()->label('Código Postal')->for('codigo_postal') }}

                {{ html()->text('codigo_postal')
                    ->class('form-control')
                    ->placeholder('Código Postal')
                    ->value(isset($empresaUser)?$empresaUser->codigo_postal:null)
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        

    
            <div class="form-group col-md-5 col-md-push-1">
                
                <div>
                   <input type="checkbox" name="email_facturacion" value="1" {{isset($empresaUser)&&$empresaUser->email_facturacion==1?'checked':''}} /> Email Facturación

                    
                </div>
            </div><!--form-group-->

            
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
                
                <button class="btn btn-primary" type="submit">@lang('labels.general.buttons.update')</button>
            </div>
        </div>


       
{{ html()->form()->close() }}
