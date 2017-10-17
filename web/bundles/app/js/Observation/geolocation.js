function initMap() {

  $("#map").animate({"height" : "0px"});

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
    var pos = {
    lat: position.coords.latitude,
    lng: position.coords.longitude
  };

  document.getElementById("observation_longitude").value = position.coords.latitude,
  document.getElementById("observation_lattitude").value = position.coords.longitude,
  geocoding();

  }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    handleLocationError(false, infoWindow, map.getCenter());
    }
  }

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
  }
