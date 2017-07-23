<?php 
$mapa = htmlentities($_GET['mapa']);
$lat = strstr($mapa, ',',true);
$lng = strstr($mapa, ',');
$lng = substr($lng, 1);
?>

<!DOCTYPE html>
<html>
  <head>
    <style media="screen">
    	html, body {
    		height:100%;
    		margin:0;
    		padding: 0;
       	}
       	#map {
       		height: 100%;
       	}
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      function initMap() {
        var myLatLng = {lat: <?php echo $lat ?>, lng: <?php echo $lng ?>};

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          scrollwheel: true,
          zoom: 16
        });

        // Create a marker and set its position.
        var marker = new google.maps.Marker({
          map: map,
          position: myLatLng,
          title: 'Hello World!'
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDedg4oMB8FcIy9eJwee0m_kunYIV0lIGg&callback=initMap"
        async defer></script>
  </body>
</html>