function initAutocomplete() {

  var myLatLng = new google.maps.LatLng( 48.866667,2.333333);

  var mapOptions = {
    zoom: 2,
    center: myLatLng,
    disableDefaultUI: true,
    mapTypeControl: true,
    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.BOTTOM_LEFT,
    },
     zoomControl: true,
          zoomControlOptions: {
              position: google.maps.ControlPosition.LEFT_CENTER
          },

  };

  map = new google.maps.Map(document.getElementById('map'), mapOptions);
    var marker = new google.maps.Marker({
      draggable: true,
      position: myLatLng,
      map: map,
      title: "Your location"
    });
    // UiSettings = googleMap.getUiSettings();

  google.maps.event.trigger(map, 'resize');
  google.maps.event.addListener(marker, 'dragend', function(event) {
    document.getElementById("observation_longitude").value = event.latLng.lat();
    document.getElementById("observation_lattitude").value = event.latLng.lng();
    geocoding();
  });

  google.maps.event.addListener(map, 'click', function(event) {
    document.getElementById("observation_longitude").value = event.latLng.lat();
    document.getElementById("observation_lattitude").value = event.latLng.lng();
    marker.setPosition(event.latLng);
    geocoding();
  });
} 

