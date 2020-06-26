{{ html()->modelForm($logged_in_user, 'POST', route('frontend.user.profile.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
   @method('PATCH')


<div class="row">
             <div class="form-group col-md-5">
                {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

                {{ html()->text('first_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.first_name'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--form-group-->
        

    
            <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

                {{ html()->text('last_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.last_name'))
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        

   {{-- @if ($logged_in_user->canChangeEmail())--}}
        
                

                <div class="form-group col-md-5">
                   {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                    {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.email'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                    {{--<div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.change_email_notice')
                    </div>--}}
                </div><!--form-group-->
            
   {{-- @endif--}}

   
            <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Teléfono')->for('telefono') }}

                {{ html()->text('telefono')
                    ->class('form-control')
                    ->placeholder('Teléfono')
                    ->attribute('maxlength', 30)
                    ->required() }}
            </div><!--form-group-->
        
    
            <div class="form-group col-md-5">
                {{ html()->label('Rut / DNI')->for('rut_dni') }}
         
                {{ html()->text('rut_dni')
                    ->class('form-control')
                    ->placeholder('Rut Dni')
                    ->attribute('maxlength', 20)
                    ->required() }}
            </div><!--form-group-->
      

    
            <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label('Dirección')->for('direccion') }}

                {{ html()->text('direccion')
                    ->class('form-control')
                    ->placeholder('Dirección')
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
       

    
            <div class="form-group col-md-5">
                {{ html()->label('Comunas')->for('comuna_id') }}

                {{ html()->select('comuna_id', $comunas)->placeholder('Seleccione Comuna', false)->class('form-control')->required() }}
            </div><!--form-group-->
       

            <div class="form-group col-md-5 col-md-push-1">
                @if(Auth::user()->pais_id!=0)

                     <?php $selected=Auth::user()->pais_id; ?>

                @endif

                {{ html()->label('Paises')->for('pais_id') }}
                {{ html()->select('pais_id', $paises,$selected)->placeholder('Seleccione País', false)->class('form-control') }}
            
            </div><!--form-group-->

            
       
             <div class="form-group col-md-5">
                {{ html()->label(__('validation.attributes.frontend.avatar'))->for('avatar') }}

                <div>
                   

                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Seleccione Archivo</span>
                        <span class="fileinput-exists">Cambiar</span>
                            <input type="file" name="avatar_location"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
                    </div> 
                    


                    <input type="hidden" name="avatar_type" value="storage" /> 

                  
                </div>
            </div><!--form-group-->
       


       
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
                
                <button class="btn btn-primary" type="submit">@lang('labels.general.buttons.update')</button>
            </div>
        </div>

    
        {{--<div class="row">
        <div class="col-md-6">
            <div class="form-group mb-0 clearfix">
                {{ form_submit(__('labels.general.buttons.update')) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
    --}}




</div>
{{ html()->closeModelForm() }}

@push('after-scripts')
    <script>
       /* $(function() {
            var avatar_location = $("#avatar_location");

            if ($('input[name=avatar_type]:checked').val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function() {
                if ($(this).val() === 'storage') {
                    avatar_location.show();
                } else {
                    avatar_location.hide();
                }
            });
        });*/
    </script>
@endpush
