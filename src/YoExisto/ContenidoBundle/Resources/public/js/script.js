// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see a blank space instead of the map, this
// is probably because you have denied permission for location sharing.

var map;

function initialize() {
  var mapOptions = {
    zoom: 5,
    zoomControl: true,
    scaleControl: false,
    scrollwheel: false,
  };
  map = new google.maps.Map(document.getElementById('geomapa'),
      mapOptions);

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: pos,
        content: 'Encontrado.'
      });

      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }
}

function initializeZ(zoomRecibido) {
  var mapOptions = {
    zoom: zoomRecibido,
    zoomControl: true,
    scaleControl: false,
    scrollwheel: false,
  };
  map = new google.maps.Map(document.getElementById('geomapa'),
      mapOptions);

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: pos,
        content: 'Encontrado.'
      });

      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }
}


function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
  };

  var infowindow = new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}



function mostrarPanel(){
	$("#mis-reportes").removeClass('col-md-9');
	$("#mis-reportes").addClass('col-md-6');

	$("#reporte-detalle").show('slow');


	$("#reportes-recientes").removeClass('col-md-3');
	$("#reportes-recientes").addClass('col-md-3');
}

function ocultarPanel(){
	$("#mis-reportes").removeClass('col-md-6');
	$("#mis-reportes").addClass('col-md-9');

	$("#reporte-detalle").hide('slow');


	$("#reportes-recientes").removeClass('col-md-3');
	$("#reportes-recientes").addClass('col-md-3');
}


$(document).ready(function(){
	google.maps.event.addDomListener(window, 'load', initialize);
	
	$('.btn-geo').click(function() {
		initializeZ(15);
	});

	mostrarPanel();
	
	$('.row-reporte-reciente').click(function() {
		ocultarPanel();
	});
	

	

	

});