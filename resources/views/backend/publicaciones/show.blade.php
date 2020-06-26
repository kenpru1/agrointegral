@extends('backend.layouts.app')

@section('title', 'Ver Publicación' )

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">

                    <div class="ibox product-detail">
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-md-5">

                                    @if(isset($publicacion->publicacion_imagen->first()->file_name) == null)

                                        <div>
                                            <img src="{{ asset('app/public/publicaciones/nofoto2.png') }}" alt="no hay imagen" class="img-responsive" style="height:430.66px; width:323px;">
                                        </div>

                                    @else

                                        <div class="product-images">

                                            @foreach($publicacion->publicacion_imagen as $imagen)
                                                <div>
                                                    <!--<img src="{{ asset('app/public/publicaciones/'.$imagen->file_name) }}" class="img-responsive" style="height:430.66px; width:430.66px;">-->

                                                    <img src="{{ asset('app/public/publicaciones/'.$imagen->file_name) }}" class="img-responsive" style="height:100%; width:100%;">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                                <div class="col-md-7">

                                    <h2 class="font-bold m-b-xs">
                                        {{ $publicacion->titulo }}
                                    </h2>
                                    <small><b>Cantidad:</b> {{ isset($publicacion->cantidad) ? $publicacion->cantidad : 0 }}</small>
                                    <div class="m-t-md">
                                        <h2 class="product-main-price">${{ number_format($publicacion->precio, 0, '', '.') }} 
                                    </div>
                                    <hr>

                                    <h4>Descripción</h4>

                                    <div class="small text-muted">
                                        {!!$publicacion->descripcion!!}
                                    </div>
                                    <dl class="medium m-t-md">
                                        <dt>Detalles</dt>
                                        <dd>Año de Fabricación: {{ isset($publicacion->anno_fabricacion) ? $publicacion->anno_fabricacion : 'desconocido' }}</dd>
                                        <dd>Modelo: {{ $publicacion->modelo }}</dd>
                                        <dd>Provincia: {{ isset($publicacion->provincia->nombre) ? $publicacion->provincia->nombre : null }}</dd>
                                        <dd>Comuna: {{ isset($publicacion->comuna->nombre) ? $publicacion->comuna->nombre : null }}</dd>
                                        <dd>Envío:{{ isset($publicacion->tipo_envio->descripcion) ? $publicacion->tipo_envio->descripcion : null }}</dd>
                                        <dd>Orden mínima: {{ $publicacion->orden_minima }}</dd>
                                        <dd>Contacto: {{ $publicacion->contacto }}</dd>
                                        <dd>Email:{{ $publicacion->email }}</dd>
                                        <dd>Teléfono: {{ $publicacion->telefono }}</dd>
                                    </dl>
                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="operacion!=0" class="mail-body text-right tooltip-demo">
                        <a class="btn btn-white btn-sm" href="{{route('admin.anuncios.index')}}" >Volver</a>
                        <a href="mailto:{{ $publicacion->email }}"  class="btn btn-white btn-sm"><i class="fa fa-envelope"></i> Contactar</a>
                    </div>

                </div>
            </div>
        </div>

@endsection

@section('scripts')

<script src="{!! asset('inspina/js/inspinia.js') !!}"></script>
<script src="{!! asset('inspina/js/plugins/slick/slick.min.js') !!}"></script>
<script>
    $(document).ready(function(){


        $('.product-images').slick({
            dots: true
        });

    });
</script>
@endsection