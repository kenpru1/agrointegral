<style>
    #modalTamanio{
      width: 80% !important;
      height: : 40% !important;

    }
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 65%;
        width: :90%;
      }
    
</style>
<!--- modal  -->
<div class="modal fade" id="mapa" role="dialog">
    <div class="modal-dialog " id="modalTamanio">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                Mapa
            </div>
            <input class="controls" id="pac-input" placeholder="Search Box" type="text">
                <div id="map">
                </div>
                <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDECSQy7k1jz50mFVnf0xz90fZq966sEAA&callback=initMap&libraries=drawing,geometry,places">
                </script>
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
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.SATELLITE,
          disableDefaultUI: false,
          //zoomControl: true
        });

       


<?php 
   $con=0;
   foreach ($campo->cuarteles as $cuartel) {
       $con++;
   ?>
       /*Mapa Generado a Partir de Coordenadas Guardadas*/
        // Define the LatLng coordinates for the polygon.
        var areaCoords{{  $con }} = [
          {{ $cuartel->coordenadas }}
        ];

        // Construct the polygon.
        var areaShape{{  $con }} = new google.maps.Polygon({
          paths: areaCoords{{  $con }},
          strokeColor: 'red',
          strokeOpacity: 0.8,
          strokeWeight: 3,
          fillColor: 'red',
          fillOpacity: 0.35
        });
        areaShape{{  $con }}.setMap(map);
        /*Mapa Generado a Partir de Coordenadas Guardadas*/

<?php } ?>

 
             



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
                <div class="modal-body">
                    <div id="map-canvas-modal">
                    </div>
                </div>
            </input>
        </div>
    </div>
</div>
