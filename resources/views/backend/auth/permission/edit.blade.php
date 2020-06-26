@extends('backend.layouts.app')

@section('title', __('labels.backend.access.permissions.management') . ' | ' . __('labels.backend.access.permissions.edit'))

@section('content')
{{ html()->modelForm($permission, 'PATCH', route('admin.auth.permission.update',$permission))->class('form-horizontal')->open() }}
      <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>@lang('labels.backend.access.permissions.management')
                                <small class="text-muted">@lang('labels.backend.access.permissions.create')</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               
                                <div class="form-group col-md-6"><label class="col-lg-2 control-label">{{ html()->label(__('validation.attributes.backend.access.permissions.name'))
                                ->for('name') }}</label>

                                    <div class="col-lg-10">
                                        {{ html()->text('name')
                                            ->class('form-control')
                                            ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                            ->attribute('maxlength', 191)
                                            ->required()
                                            ->autofocus() }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6"><label class="col-lg-2 control-label">
                                    {{ html()->label(__('validation.attributes.backend.access.permissions.guard_name'))
                                         ->class('form-control-label')
                                         ->for('guard_name') }}</label>

                                    <div class="col-lg-10">
                                        <select id="guard_name" name="guard_name" class="form-control required">
                                             <option value="Web">Web</option>
                                        </select>
                                    </div>
                                </div>

                               

                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.auth.permission.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Editar Permiso</button>
                                
                            </div>



                                
                            </form>
                        </div>
                    </div>
                </div>

{{ html()->form()->close() }}
@endsection
