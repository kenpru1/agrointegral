@extends('backend.layouts.app')

@section('title', 'Planes y Facturación')

@section('content')
{{ html()->form('POST', route('admin.perfil_planes.update'))->class('form-horizontal')->open() }}
 <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Planes</h5>
        </div>
    <div class="ibox-content">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1"> Planes</a></li>
            <li> <a data-toggle="tab" href="#tab-2"> Pagos</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-1" class="tab-pane">
                @include('backend.planes.tabs.planes')
            </div>
            <div id="tab-2" class="tab-pane">
                 @include('backend.planes.tabs.pagos')                
            </div>
        </div>




         <div class="hr-line-dashed"></div>
        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-4">

                {{--<button class="btn btn-primary" type="submit">Guardar</button>--}}
            </div>
        </div>
       </div>
       @endif


    </div>
</div>




{{ html()->form()->close() }}

@endsection
