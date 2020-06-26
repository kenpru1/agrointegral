@extends('backend.layouts.app')

@section('title', __('labels.backend.access.roles.management') . ' | ' . __('labels.backend.access.roles.create'))

@section('content')
{{ html()->form('POST', route('admin.auth.role.store'))->class('form-horizontal')->open() }}
    <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5> @lang('labels.backend.access.roles.management')
                                <small class="text-muted">@lang('labels.backend.access.roles.create')</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                              <div class="row">
                                <div class="form-group col-md-5"><label class="control-label">
                                     {{ html()->label(__('validation.attributes.backend.access.roles.name'))
                                         ->class('col-md-2 form-control-label')
                                         ->for('name') }}</label>

                                
                                      {{ html()->text('name')
                                      ->class('form-control')
                                      ->placeholder(__('validation.attributes.backend.access.roles.name'))
                                      ->attribute('maxlength', 191)
                                      ->required()
                                     ->autofocus() }}
                               
                                </div><!--form-group-->
                              </div>

                    <div class="form-group col-md-10">
                        <div class="col-md-10">
                          
                            @if($permissions->count())
                            {{ html()->label(__('validation.attributes.backend.access.roles.associated_permissions'))
                            ->class('col-md-2 form-control-label')
                            ->for('permissions') }}
                                @foreach($permissions as $permission)
                                    <div class="checkbox d-flex align-items-center">
                                        {{ html()->label(
                                                html()->checkbox('permissions[]', old('permissions') && in_array($permission->name, old('permissions')) ? true : false, $permission->name)
                                                      ->class('switch-input')
                                                      ->id('permission-'.$permission->id)
                                                    . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                ->class('switch switch-label switch-pill switch-primary mr-2')
                                            ->for('permission-'.$permission->id) }}
                                        {{ html()->label(ucwords($permission->name))->for('permission-'.$permission->id) }}
                                    </div>
                                @endforeach
                            @endif
                        </div><!--col-->

                    </div><!--form-group-->

                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.auth.role.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Crear Rol</button>
                                
                            </div>


                                


                                
                            </form>
                        </div>
                    </div>
                </div>

{{ html()->form()->close() }}
@endsection
