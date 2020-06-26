@extends('backend.layouts.app')

@section('title', 'Planes ')

@section('content')
{{ html()->modelForm($plan, 'PATCH', route('admin.planes.update',$plan))->class('form-horizontal')->open() }}
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administrador de Planes
                <small class="text-muted">
                    
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Nombre Plan')->for('nombre') }}
                        <input type="text" class="form-control" name="nombre" maxlength="191" required value="{{ $plan->nombre }}" >
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                         {{ html()->label('Cantidad UF')->for('cantidad_uf') }}
                        <input type="number" class="form-control" name="cantidad_uf" min="0" step="1" value="{{ $plan->cantidad_uf }}" required >
                    </div>
                </div>
            </form>
        </div>
        <div class="mail-body text-right tooltip-demo">
            <a class="btn btn-white btn-sm" href="{{route('admin.planes.index')}}">
                @lang('buttons.general.cancel')
            </a>
            <button class="btn btn-sm btn-primary" type="submit">
                Guardar
            </button>
        </div>
    </div>
</div>
{{ html()->form()->close() }}
@endsection
