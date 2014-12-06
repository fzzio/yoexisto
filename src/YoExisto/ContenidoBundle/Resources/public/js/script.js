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

      $("#form_latitud").val(position.coords.latitude);
      $("#form_logitud").val(position.coords.longitude);

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

function setMap(lat, lng) {
    map_location = new google.maps.LatLng(lat, lng);
    marker.setPosition(map_location);
    map.setCenter(map_location);
}


function initializeDir(address) {
  // I create a new google maps object to handle the request and we pass the address to it
  var geoCoder = new google.maps.Geocoder(address)
  // a new object for the request I called "request" , you can put there other parameters to specify a better search (check google api doc for details) , 
  // on this example im going to add just the address  
  var request = {address:address};
       
  // I make the request 
  geoCoder.geocode(request, function(result, status){
    // as a result i get two parameters , result and status.
    // results is an  array tha contenis objects with the results founds for the search made it.
    // to simplify the example i take only the first result "result[0]" but you can use more that one if you want

    // So , using the first result I need to create a  latlng object to be pass later to the map
    var latlng = new google.maps.LatLng(result[0].geometry.location.lat(), result[0].geometry.location.lng());  


        $("#form_latitud").val(result[0].geometry.location.lat());
        $("#form_logitud").val(result[0].geometry.location.lng());
 
    // some initial values to the map   
    var myOptions = {
      zoom: 15,
      center: latlng,
      scrollwheel: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

         // the map is created with all the information 
           var map = new google.maps.Map(document.getElementById("geomapa"),myOptions);

         // an extra step is need it to add the mark pointing to the place selected.
        var marker = new google.maps.Marker({position:latlng,map:map,title:'title'});
 
  })
}


function initializeZ(zoomRecibido, lugarBuscado) {
  var mapOptions = {
    zoom: zoomRecibido,
    zoomControl: true,
    scaleControl: false,
    scrollwheel: false,
  };
  map = new google.maps.Map(document.getElementById('geomapa'),
      mapOptions);

  if(!lugarBuscado){
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

        $("#form_latitud").val(position.coords.latitude);
        $("#form_logitud").val(position.coords.longitude);


      }, function() {
        handleNoGeolocation(true);
      });
    } else {
      // Browser doesn't support Geolocation
      handleNoGeolocation(false);
    }
  }else{
    //buscar

    //alert("buscando en el mundo");
    initializeDir(lugarBuscado);


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
		initializeZ(15,  $("#form_descripcion").val()   );
	});

	mostrarPanel();

	$('.row-reporte-reciente').click(function() {
		//ocultarPanel();
	});
	

	

	

});