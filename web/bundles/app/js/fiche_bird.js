function initMap() {
	var map;
	map = new google.maps.Map(document.getElementById('maps'), {
      center: {lat: 46.227638, lng: 2.213749000000007},
	  zoom: 6,
	  mapTypeId: google.maps.MapTypeId.TERRAIN
	});
	{% if observations is not empty %}
	var zoneMarqueurs = new google.maps.LatLngBounds()
	var tableauMarqueurs = [

	{% for l_l in gps %}
   		{{ l_l }}
	{% endfor %}

	];
	for( var i = 0, I = tableauMarqueurs.length; i < I; i++ ) {

		var latlng = tableauMarqueurs[i],							//	var latlng = tableauMarqueurs[i],
			latitude = latlng["lat"],								//		latitude = latlng[0],
			longitude = latlng["lng"];								//		longitude = latlng[1];
	
		var optionsMarqueur = {
			map: map,
			position: new google.maps.LatLng( latitude, longitude ),
			animation: google.maps.Animation.DROP
		};
		var marqueur = new google.maps.Marker( optionsMarqueur );
		zoneMarqueurs.extend( marqueur.getPosition() );

  		var infowindow = new google.maps.InfoWindow()
		google.maps.event.addListener(marqueur,'click', (function(marqueur,content,infowindow){ 
		        return function() {
		           infowindow.setContent(content);
		           infowindow.open(map,marqueur);
		        };
		    })(marqueur,content,infowindow));

	}
	map.fitBounds( zoneMarqueurs );
	{% endif %}
}
$('#precedent').click(function(e){
    e.preventDefault();
    $('#container_fiche').empty();
    $('#container_find,.nao_title').show('slow');
    return false;
});
if (typeof google === 'object' && typeof google.maps === 'object') {
 	initMap()
}
else {
	jQuery.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyBYM7ehj93A-AEdTDupTMEL7wAgOHWCTxA&callback=initMap")
}


$(function () {
    $(".observation").slice(0, 1).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".observation:hidden").slice(0, 1).slideDown();
        if ($(".observation:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});