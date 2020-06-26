@extends('backend.layouts.app')

@section('title', app_name() . ' | Anuncios')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Anuncios
        </strong>
    </div>
    {{ html()->form('POST', route('admin.anuncios.index'))->open() }}
    <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="product_name">Nombre</label>
                            <input type="text" id="product_name" name="nombre"  placeholder="Producto" class="form-control " value="{{ isset($nombre)? $nombre :'' }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="price">Precio Mínimo</label>
                            <input type="text" id="precio_minimo" name="precio_minimo" value="{{ isset($precioMinimo)? $precioMinimo :'' }}" placeholder="Precio Mínimo" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="price">Precio Máximo</label>
                            <input type="text" id="precio_maximo" name="precio_maximo" value="{{ isset($precioMaximo)? $precioMaximo :'' }}" placeholder="Precio Máximo" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                    <div class="form-group col-md-12 ">
                        {{ html()->label('Comunas')->for('comuna_id') }}
                                     {{ html()->select('comuna_id', $comunas,isset($comunaId)? $comunaId :null)
                                        ->placeholder('Seleccione Comuna', false)
                                        ->class('form-control chosen-select')
                                        ->id('comuna_id') }}
                    </div>
                </div>

                        
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-push-10">
                        <a class="btn btn-white btn-sm" href="{{route('admin.anuncios.index')}}">
                        Ver Todos
                    </a>
                    <button class="btn btn-sm btn-primary text-right" type="submit">
                        Buscar
                    </button>
                    </div>    
                </div>
    </div>
    {{ html()->form()->close() }}
    <div class="ibox-content">

        <div class="wrapper wrapper-content animated fadeInRight">

       @php $cont=0; @endphp
       @foreach($publicaciones as $publicacion)     
        @if($cont==0)
        <div class="row">
        @endif
                <div class="col-md-3">
                    <div class="ibox">
                        <a href="{{route('admin.publicaciones.show', $publicacion->id)}}">
                        <div class="ibox-content product-box">


                            <div>
                                @if(isset($publicacion->publicacion_imagen->first()->file_name))
                                  <img alt="Foto"  src="{{ asset('app/public/publicaciones/'.$publicacion->publicacion_imagen->first()->file_name) }}" style="height:200px; width:100%" />
                                @else
                                    <img alt="Sin Foto"  src="{{ asset('app/public/publicaciones/nofoto2.png') }}" style="height:225px; width:225px" />
                                  
                                @endif
                            </div>
                            <div class="product-desc">
                                <span class="product-price">
                                    ${{ $publicacion->precio }}
                                </span>
                                <small class="text-muted">
                                    @if($publicacion->clasificacion==0)
                                        Producto
                                    @else
                                        Servicio
                                    @endif
                                </small>
                                <a href="#" class="product-name"> {{ $publicacion->titulo }}</a>



                                
                                <div class="m-t text-righ">

                                    <a href="{{route('admin.publicaciones.show', $publicacion->id)}}" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
         @php $cont++; @endphp
        @if($cont==4)
        </div>
        @endif
     
        @if($cont==4)
           @php $cont=0; @endphp
        @endif
        @endforeach
        <br>
        <div class="row">
            <div class="col-md-11 col-md-push-10">
           {{ $publicaciones->links() }}
           </div>
        </div>
@endsection
