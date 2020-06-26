@extends('backend.layouts.clean')
@section('content')
<div class="middle-box text-center animated fadeInDown">
        <h1>500</h1>
        <h3 class="font-bold">Error Inesperado</h3>

        <div class="error-desc">
            Ha ocurrido un error inesperado, si el mismo persiste por favor contacte a su equipo de soporte técnico.
        </div>
        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <a class="btn btn-primary" href="{{route('admin.dashboard')}}" >Volver</a>
            </div>
        </div>
</div>

@endsection
