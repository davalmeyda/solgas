<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>GMaps.js &mdash; Basic</title>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="../javascript/gmaps.js"></script>
  <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="../css/gmaps.css" />
  <script type="text/javascript">
    var map;
    $(document).ready(function(){
      map = new GMaps({
        el: '#map',
        lat: -12.175728,
        lng: -76.966643
      });
      map.addMarker({
        lat: -12.175728,
        lng: -76.966643,
        title: 'Lima',
        details: {
          database_id: 42,
          author: 'HPNeo'
        },
        click: function(e){
          if(console.log)
            console.log(e);
          alert('You clicked in this marker');
        },
        mouseover: function(e) {
          if(console.log)
            console.log(e);
        }
      });
      map.addMarker({
        lat: -12.178518,
        lng: -76.966010,
        title: 'Marker with InfoWindow',
        infoWindow: {
          content: `
          <div>
            <span>Trabajador: <strong>Jesus Johan Rufino Saire</strong><span><br>
            <span>Estado: <strong class="text-success">Libre</strong><span><br>
            <span>Balones: <strong>8 und</strong><span>
          </div>
          `
        }
      });
    });
  </script>
</head>
<body>
  <h1>GMaps.js &mdash; Basic</h1>
  <div class="row">
    <div class="span11">
      <div id="map"></div>
    </div>
    <div class="span6">
      <p>Using GMaps.js is as easy as:</p>
      <pre>new GMaps({
  el: '#map',
  lat: -12.043333,
  lng: -77.028333
});</pre>
      <p>You must define <strong>container ID</strong>, <strong>latitude</strong> and <strong>longitude</strong> of the map's center.</p>
      <p><span class="label notice">Note: </span>You also can define <strong>zoom</strong>, <strong>width</strong> and <strong>height</strong>. By default, zoom is 15. Width and height in a CSS class will replace these values.</p>
    </div>
  </div>
</body>
</html>
