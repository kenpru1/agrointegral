@extends('backend.layouts.app')

@section('title',  'Cuarteles| Editar' )

@section('content')
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 65%;
        width: :90%;

      }
      /* Optional: Makes the sample page fill the window. */
     
    </style>
{{ html()->modelForm($cuartel, 'PATCH', route('admin.cuarteles.update',$cuartel))->class('form-horizontal')->open() }}
<div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administrador de Cuarteles
                <small class="text-muted">
                    Editar Cuarteles
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">

<div class="row">

  <div class="row col-md-5">
      <div class="form-group col-md-12">
        {{ html()->label(__('validation.attributes.backend.access.permissions.name'))->for('name') }}
        {{ html()->text('nombre')->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.permissions.name'))
            ->attribute('maxlength', 191)
            ->required()
            ->readonly()
            ->autofocus() }}
      </div>
      <div class="form-group col-md-12">
          {{ html()->label('Campos')->for('campo_id') }}
          {{ html()->select('campo_id', $campos,null)
            ->placeholder('Seleccione Campo', false)
            ->class('form-control')
            ->required()
            ->attribute('disabled')
            ->id('campo_id') }}
      </div>
      <div class="form-group col-md-12 ">
          {{ html()->label('Provincias')->for('provincia_id') }}
          {{ html()->select('provincia_id', $provincias,null)
            ->placeholder('Seleccione Provincia', false)
            ->class('form-control')
            ->required()
            ->attribute('disabled')
            ->id('provincia_id') }}
      </div>
      <div class="form-group col-md-12">
         {{ html()->label('Comunas')->for('comuna_id') }}
         {{ html()->select('comuna_id', $comuna)
            ->placeholder('Seleccione Comuna', false)
            ->class('form-control')
            ->required()
            ->attribute('disabled')
            ->id('comuna_id') }}
      </div>
      <div class="form-group col-md-12">
        {{ html()->label('Tamaño (Hectareas)')->for('name') }}
        <input class="form-control" id="tamanno" min="0" name="tamanno" required="" step="any" type="number" value="{{ $cuartel->tamanno }}" readonly> 
                            
      </div>
     
      <div class="form-group col-md-12">
        {{ html()->label('Tipo Cultivo')->for('campo_id') }}
        {{ html()->select('tipo_cultivo_id', $tipoCultivos,null)
            ->placeholder('Seleccione Tipo de Cultivo', false)
            ->class('form-control')
            ->required()
            ->attribute('disabled')
            ->id('tipo_cultivo_id') }}
      </div>
        <div class="form-group col-md-12">
            {{ html()->label('Seleccione Propiedad')->for('propio') }}
            {{ html()->select('propio', $propio,$cuartel->propio)
                ->placeholder('Seleccione Propiedad', false)
                ->class('form-control chosen-select')
                ->required()
                ->attribute('disabled')
                ->id('propio') }}
        </div>
        <div class="form-group col-md-12">
          {{ html()->label('Productivo')->for('productivo') }}
          {{ html()->select('productivo', $productivo,$cuartel->productivo)
              ->placeholder('Seleccione Producción', false)
              ->class('form-control chosen-select')
              ->required()
              ->attribute('disabled')
              ->id('productivo') }}
        </div>
      
  </div>
  <br>
  <div class="row col-md-5 col-md-push-1">
      <div class="form-group col-md-12">
          <input class="controls" id="pac-input" placeholder="Search Box" type="text">
          <div id="map">mapa</div>
      </div>

    
  </div>
  
</div>

                <div class="row">
                    <div class="form-group col-md-12">
                        {{ html()->label('Descripción')
                                            ->for('name') }}
                        <textarea class="summernote" id="descripcion" name="descripcion" title="Descripcion">
                            {{$cuartel->descripcion}}
                        </textarea>
                    </div>
                </div>
                <div class="mail-body text-right tooltip-demo">
                    <a class="btn btn-white btn-sm" href="{{route('admin.cuarteles.index')}}">
                        @lang('buttons.general.cancel')
                    </a>
                   
                </div>
            </form>
        </div>
    </div>
</div>
{{ html()->form()->close() }}
@endsection
@section('scripts')
<script>
    var pacContainerInitialized = false; 
   $('#pac-input').keypress(function() { 
        if (!pacContainerInitialized) { 
            $('.pac-container').css('z-index','9999'); 
            pacContainerInitialized = true; 
        } 
    });

    $('#descripcion').summernote({
        height: 150,
    });
 
</script>

@endsection


 
    <script>
  var selectedShape;
  var map;
  

<?php if($cuartel->ubiq_lat!=null && $cuartel->ubiq_lng!=null){ ?>
  var myLat={{ $cuartel->ubiq_lat }};
  var myLong={{ $cuartel->ubiq_lng }};

<?php }else{ ?>
  var myLat=-33.3420015419156;
  var myLong=-70.21774291992189;

<?php }?>



   
  function setSelection(shape) {
    clearSelection();
    // getting shape coordinates
    var v = shape.getPath();
    for (var i=0; i < v.getLength(); i++) {
        var xy = v.getAt(i);
        console.log('Cordinate lat: ' + xy.lat() + ' and lng: ' + xy.lng());
    }


    selectedShape = shape;
    shape.setEditable(true);
  }

  function clearSelection() {
    if (selectedShape) {
      selectedShape.setEditable(false);
      selectedShape = null;
    }
  }

  function deleteSelectedShape() {
    if (selectedShape) {
      selectedShape.setMap(null);
      document.getElementById('area').value=0;
      }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'La ubicación actual no pudo ser determinada' :
                              'No se pudo obtener su ubicación actual.');
        infoWindow.open(map);
      }


      
      function initMap() {

          map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: myLat, lng:myLong },
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.SATELLITE,
          disableDefaultUI: false,
          //zoomControl: true
        });

       /*Mapa Generado a Partir de Coordenadas Guardadas*/
        // Define the LatLng coordinates for the polygon.
        var areaCoords = [
          {{ $cuartel->coordenadas }}
        ];

        // Construct the polygon.
        var areaShape = new google.maps.Polygon({
          paths: areaCoords,
          strokeColor: 'red',
          strokeOpacity: 0.8,
          strokeWeight: 3,
          fillColor: 'red',
          fillOpacity: 0.35
        });
        areaShape.setMap(map);
        /*Mapa Generado a Partir de Coordenadas Guardadas*/


  /******************Listener al completar la seleccion******************/

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
  var places = searchBox.getPlaces();

  if (places.length == 0) {
    return;
  }

  // Clear out the old markers.
  markers.forEach(function(marker) {
    marker.setMap(null);
  });
  markers = [];

  // For each place, get the icon, name and location.
  var bounds = new google.maps.LatLngBounds();
  places.forEach(function(place) {
          
  if (!place.geometry) {
    console.log("Returned place contains no geometry");
    return;
  }
  
  var icon = {
    url: place.icon,
    size: new google.maps.Size(71, 71),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(17, 34),
    scaledSize: new google.maps.Size(25, 25)
  };

  // Create a marker for each place.
  markers.push(new google.maps.Marker({
    map: map,
    icon: icon,
    title: place.name,
    position: place.geometry.location
  }));

  if (place.geometry.viewport) {
  // Only geocodes have viewport.
    bounds.union(place.geometry.viewport);
  } else {
    bounds.extend(place.geometry.location);
  }
  });
  map.fitBounds(bounds);
  });
  
  /*Listener al completar la seleccion*/
  google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
  google.maps.event.addListener(map, 'click', clearSelection);
  google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDECSQy7k1jz50mFVnf0xz90fZq966sEAA&callback=initMap&libraries=drawing,geometry,places"
async defer></script>