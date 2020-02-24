var map;
var america_lat = -12.173782;
var america_lng = -76.9600107;
var directionsDisplay = new google.maps.DirectionsRenderer({polylineOptions:{strokeColor:'#2E9AFE'}});
var directionsService = new google.maps.DirectionsService();



function start_map_cli(){
	mapcli = new google.maps.Map(document.getElementById('map_cli'), {
  	center: {lat: america_lat, lng: america_lng},
  	zoom: 11
	});
}
function VerrepartidorMaps(id_repmap) {
  __ajax('../controllers/mapsController.php?op=10','POST','JSON',{'id_repmap':id_repmap}).done(function(data) {
    if (data.STATUS == 'OK') {
      var pos = {
        lat: parseFloat(data.DATA[0].lat_repmap),
        lng: parseFloat(data.DATA[0].long_repmap)
      };
      var infowindow = new google.maps.InfoWindow();
      marker = new google.maps.Marker({
        map: mapcli,
        draggable: false,
        icon: '../dist/img/cochesolgas.png',
        position: pos
      });
      google.maps.event.addListener(marker, 'click', function() {
      	infowindow.setContent(`
      		<div id="content">
                <h5 id="firstHeading" class="firstHeading">${data.DATA[0].nombres_per}</h5>
            </div>
      	`);
        infowindow.open(mapcli, marker);
      })
      setTimeout(function(){marker.setMap(null);},5000);
      setTimeout(function(){VerrepartidorMaps(id_repmap); }, 5000);
    }
  })
}
function draw_rute_rutmap(latori, lngori, latdes, lngdes){
  var start = new google.maps.LatLng(latori, lngori);
  var end = new google.maps.LatLng(latdes, lngdes);
  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function (response, status) {
    if(status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        directionsDisplay.setMap(mapcli);
        directionsDisplay.setOptions({suppressMarkers: false});
    }
  });
}
