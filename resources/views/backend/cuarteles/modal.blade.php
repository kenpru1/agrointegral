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
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }



      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
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
                <div>
                    <!--<input id="area" name="area" type="text">-->
                    <button class="btn btn-danger" id="delete-button" type="button">
                        Borrar
                    </button>
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Aceptar
                    </button>
                </div>
<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDECSQy7k1jz50mFVnf0xz90fZq966sEAA&callback=initMap&libraries=drawing,geometry,places">
</script>
<script>
  var selectedShape;
  var map;
  var myLat=-33.3420015419156;
  var myLong=-70.21774291992189;




   
  function setSelection(shape) {
    clearSelection();
    var coordenadas;
    var ubiqLat;
    var ubiqLng;

    coordenadas="";

    

// getting shape coordinates
  var v = shape.getPath();
  for (var i=0; i < v.getLength(); i++) {
    var xy = v.getAt(i);
    coordenadas=coordenadas + "{lat:"+ xy.lat()+", lng:"+ xy.lng()+"},";
    ubiqLat=xy.lat();
    ubiqLng=xy.lng();
    console.log('Cordinate lat: ' + xy.lat() + ' and lng: ' + xy.lng());
  }

  document.getElementById('coordenadas').value=coordenadas;
  document.getElementById('ubiq_lat').value=ubiqLat;
  document.getElementById('ubiq_lng').value=ubiqLng;


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
          zoom: 7,
          mapTypeId: google.maps.MapTypeId.SATELLITE,
          disableDefaultUI: false,
          //zoomControl: true
        });

       /*Mapa Generado a Partir de Coordenadas Guardadas*/
        // Define the LatLng coordinates for the polygon.
       /* var areaCoords = [
            {lat: -33.69442331526043, lng: -70.0803279876709},
            {lat: -34.46354183877716, lng: -70.0363826751709},
            {lat: -34.45448326886294, lng: -68.8059139251709},
            {lat: -33.64434904445886, lng: -68.9377498626709}
        ];

        // Construct the polygon.
        var areaShape = new google.maps.Polygon({
          paths: areaCoords,
          strokeColor: 'black',
          strokeOpacity: 0.8,
          strokeWeight: 3,
          fillColor: 'black',
          fillOpacity: 0.35
        });
        areaShape.setMap(map);*/
        /*Mapa Generado a Partir de Coordenadas Guardadas*/





          infoWindow = new google.maps.InfoWindow;
          if(navigator.geolocation){
               // timeout at 60000 milliseconds (60 seconds)
               var options = {timeout:60000};
               navigator.geolocation.getCurrentPosition
               (function(position){
               var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            infoWindow.setPosition(pos);
            infoWindow.setContent('Inicio.');
            infoWindow.open(map);
            map.setCenter(pos);
               }, function() {
            handleLocationError(true, infoWindow, map.getCenter(),options);
          });
            } else{
              // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter(),options);
            }

             
      /************Calculo Area******/
       /*Drawing Manager*/
        var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.POLYGON,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT,
            //drawingModes: [ 'polyline', 'circle','rectangle']
            drawingModes: [ 'polyline']
          },
          markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
          polylineOptions: {
            editable: true,
            strokeColor: 'red',

          },
          polygonOptions: {
            editable: true,
            strokeColor: 'red',
            strokeOpacity: 0.8,
          strokeWeight: 3,
          fillColor: 'red',
          fillOpacity: 0.35

          },
          

        });
        drawingManager.setMap(map);
        /*Drawing Manager*/
        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {

            if (e.type != google.maps.drawing.OverlayType.MARKER) {


            // Switch back to non-drawing mode after drawing a shape.
            drawingManager.setDrawingMode(null);

            // Add an event listener that selects the newly-drawn shape when the user
            // mouses down on it.
            var newShape = e.overlay;
            newShape.type = e.type;

            google.maps.event.addListener(newShape, 'click', function() {
           
              
            }); 


              var area = google.maps.geometry.spherical.computeArea(newShape.getPath());
              setSelection(newShape);

              
              document.getElementById('tamanno').value=(area/10000).toFixed(2);



             
            
          }
        });
  /************Calculo Area******/


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
