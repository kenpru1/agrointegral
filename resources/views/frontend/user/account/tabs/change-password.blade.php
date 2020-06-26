{{ html()->form('PATCH', route('frontend.auth.password.update'))->class('form-horizontal')->open() }}
            <div class="form-group col-md-5">
                {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}

                {{ html()->password('old_password')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.old_password'))
                    ->autofocus()
                    ->required() }}
            </div><!--form-group-->
       

    
            <div class="form-group col-md-5 col-md-push-1">
                {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                {{ html()->password('password')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.password'))
                    ->required() }}
            </div><!--form-group-->
        
  
            <div class="form-group col-md-5">
                {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                {{ html()->password('password_confirmation')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                    ->required() }}
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
{{ html()->form()->close() }}
