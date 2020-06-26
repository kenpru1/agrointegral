@extends('backend.layouts.clean')
@section('content')
<div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Error la Dirección que Intenta usar no se ha Encontrado</h3>

        <div class="error-desc">

        </div>
        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <a class="btn btn-primary" href="{{route('admin.dashboard')}}" >Volver</a>
            </div>
        </div>
</div>

@endsection
