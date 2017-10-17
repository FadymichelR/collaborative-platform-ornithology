function geocoding() {
  geocoder = new google.maps.Geocoder();
  var latlngStr = document.getElementById("observation_longitude").value;
  var latlngStr1 = document.getElementById("observation_lattitude").value;
  var latlng ={lat: parseFloat(latlngStr), lng: parseFloat(latlngStr1)};
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === 'OK') {
      if (results[1]) {
        for(var i=0;i<results.length;++i) {
          if(results[i].types[0]=="country"){
            console.log(results[i].formatted_address);
            document.getElementById("observation_country").value = results[i].formatted_address;
          }
        }
      }
    }
  });
}
