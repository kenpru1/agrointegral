@extends('backend.layouts.app')

@section('title', 'Publicaciones')

@section('content')
{{ html()->modelForm($publicacion, 'PATCH', route('admin.publicaciones.update',$publicacion))->class('form-horizontal')->open() }}
<div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administración de Publicaciones
                <small class="text-muted">
                    Editar
                </small>
            </h5>
        </div>
        <div class="ibox-content">
@php $identificador=rand(1, 100000000); @endphp

           <div class="wrapper wrapper-content animated fadeInRight ecommerce">

            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#informacion">Información</a></li>
                                <li class=""><a data-toggle="tab" href="#descripcion"> Descripción</a></li>
                                {{--<li class=""><a data-toggle="tab" href="#fotografias">Fotografías</a></li>--}}
                            </ul>
                            <div class="tab-content">
                                <div id="informacion" class="tab-pane active">
                                    <div class="panel-body">

                                        <fieldset class="form-horizontal">
                                            @include('backend.publicaciones.includes.tabs.informacion')
                                        </fieldset>

                                    </div>
                                </div>
                                <div id="descripcion" class="tab-pane">
                                    <div class="panel-body">
                                        <fieldset class="form-horizontal">
                                           @include('backend.publicaciones.includes.tabs.descripcion')
                                        </fieldset>

                                    </div>
                                </div>

                                {{--<div id="fotografias" class="tab-pane">
                                    <div class="panel-body">
                                        <fieldset class="form-horizontal">
                                           @include('backend.publicaciones.includes.tabs.fotografias')
                                        </fieldset>

                                    </div>
                                </div>--}}
                                
                            </div>
                    </div>
                </div>
            </div>

        </div>

        @if(isset($publicacion->publicacion_imagen->first()->identificador))
              <input type="hidden" id="identificador" name="identificador" value="{{ $publicacion->publicacion_imagen->first()->identificador}}">
           @else
               <input type="hidden" id="identificador" name="identificador" value="{{ $identificador }}">
           @endif
                                <div class="mail-body text-right tooltip-demo">
                                    <a class="btn btn-white btn-sm" href="{{route('admin.publicaciones.index')}}" >@lang('buttons.general.cancel')</a>
                                    <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                </div>


                         </form>
        {{ html()->form()->close() }}
        {{ html()->form('POST', route('admin.publicaciones.upload'))->id('my-awesome-dropzone')->class('form-horizontal dropzone')->attribute('enctype', 'multipart/form-data')->open() }}  
            <div class="fallback">
                <input name="filex" type="file" multiple />         
            </div>
            <input type="hidden" name="publicacion_id" id="publicacion_id" value="{{ $publicacion->id }}">
            
           @if(isset($publicacion->publicacion_imagen->first()->identificador))
              <input type="hidden" name="drop_ident" value="{{ $publicacion->publicacion_imagen->first()->identificador}}">
           @else
               <input type="hidden" name="drop_ident" value="{{ $identificador }}">
           @endif

        {{ html()->form()->close() }} 
                                
                          
            
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>

Dropzone.autoDiscover = false;
$("#my-awesome-dropzone").dropzone({
    paramName: "file", // Las imágenes se van a usar bajo este nombre de parámetro
    maxFilesize: 3, // Tamaño máximo en MB
    maxFiles:3,
    timeout:10000,
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar",
    dictCancelUpload:"Cancelar Carga",
    dictInvalidFileType:"No puede subir archivos de este tipo",
    dictResponseError:"Ha ocurrido un error",
    dictMaxFilesExceeded:"Ha sobrepasado el máximo de imágenes permitidas",
    dictFileTooBig:"Ha sobrepasado el tamaño máximo de una imagén Máximo 3Megas",
    acceptedFiles: ".jpeg,.jpg,.png",
    dictDefaultMessage: "<strong>Haga click o Arrastre sus Imágenes aquí. (Hasta 5 imágenes de 3M de peso cada una) </strong>",
    
    init: function() { 
    myDropzone = this;
    $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")}
        });

    $.ajax({
      url: '{{ route('admin.publicaciones.getImages') }}',
      type: 'GET',
      data: {"publicacion_id": $("#publicacion_id").val()},
      dataType: 'json',
      success: function(response){

           $.each(response.images, function (key, value) {

                var file = {name: value.file_name, size: value.size};
                myDropzone.options.addedfile.call(myDropzone, file);
                myDropzone.createThumbnailFromUrl(file, '../../../app/public/publicaciones/' + value.file_name);
                myDropzone.emit("complete", file);
              
            });

        }
    });
 

  },

   removedfile: function(file) {
    //this.on("removedfile", function(file) {
       $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")}
        });
       console.log(file.name);
        $.ajax({
        type: 'POST',
        url: "{{ route('admin.publicaciones.remove') }}",
      
        data: {"identificador": $("#identificador").val(),"file_name":file.name},
        dataType: 'html'

    });
    var _ref;
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  },

    /*renameFilename: function (filename) {
        return  $("#identificador").val() + '-' + filename;
    },*/
    
});



    $('.productos').hide();
    $('.servicios').hide();
    $('#otro').hide();

    var val=$('#clasificacion').val();
    if (val==0){
        $('.productos').show();
        $('.servicios').hide();
        $('#otro').show();
    }

    if (val==1){
        $('.productos').hide();
        $('.servicios').show();
        $('#otro').show();
    }

    $( '#clasificacion' ).on( 'change', function() {
        var value=$(this).val();
        
        if (value==0){
            $('.productos').show();
            $('.servicios').hide();
        }

        if (value==1){
            $('.productos').hide();
            $('.servicios').show();
        }
        $('#otro').show();
   });



    $('.summernote').summernote({
        height: 150,
    });
    $("#provincia_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getComunas') }}",
            type: 'get',
            dataType: 'json',
            data: {"provincia_id": $("#provincia_id").val()},
            success: function (rta) {
                $('#comuna_id').empty();
                $('#comuna_id').append("<option value='' disabled selected style='display:none;'>Seleccione Comuna</option>");
                $.each(rta, function (index, value) {
                    $('#comuna_id').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
                $('#comuna_id').trigger("chosen:updated");
            }
        });
    });

</script>
@endsection
