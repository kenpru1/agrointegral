{{ html()->form('POST', route('frontend.user.profile.plan.update'))->class('form-horizontal')->open() }}

   
  <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <input type="hidden" name="empresa_id" value="{{isset($empresaUser)?$empresaUser->id:''}}">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Costo + IVA</th>
                            <th>Contratar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($planes as $key => $plan)
                            <tr>
                                <td>{{ ucwords($plan->nombre) }}</td>
                                <td>{{ number_format($plan->costo, 2) }}</td>
                                <td><input type="radio" name="plan_id" value="{{$plan->id}}" {{isset($empresaUser)&&$empresaUser->plan_id==$plan->id?'checked':''}}></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->

         <div class="hr-line-dashed"></div>
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
    </div><!--row-->--}}
{{ html()->form()->close() }}
