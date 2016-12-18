<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
	#map_canvas {
		margin:0 auto;
	  height: 600px;
	  width: 600px;
	}

	</style>

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.exp&sensor=false"></script>
	<div id="map_canvas" ></div>
	<script type="text/javascript">
		var geocoder;
		var map;
		var address = ["San Diego","Norway","switzerland","france","manilla","sydney", "tokyo","turkey","hongkong","dubai","florida","canada"];
		// var address = ["Thailand","Nepal"];
		var nextAddress = 0;
		var delay = 100;

		function initialize() {
			geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(46.75871154014102, 8.24450683593751);
			var myOptions = {
			zoom: 5,
			center: latlng,
			mapTypeControl: true,
			mapTypeControlOptions: {
			  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
			},
			navigationControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

			theNext();
		}

		function theNext() {
	        if (nextAddress < address.length) {
	          setTimeout('codeAddress("' + address[nextAddress] + '", ' + theNext +')', delay);
	          nextAddress++;
	        } else {
	          // We're done. Show map bounds	         
	          // map.fitBounds(bounds);
	        }
	      }


		function codeAddress(location, next) {
			var address = location;
			geocoder.geocode({
			  'address': location
			}, function(results, status) { 
			  if (status == google.maps.GeocoderStatus.OK) {
			    if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
			      // map.setCenter(results[0].geometry.location);
			      var infowindow = new google.maps.InfoWindow({
			        content: '<b>' + address + '</b>',
			        size: new google.maps.Size(150, 50)
			      });

			      var marker = new google.maps.Marker({
			        position: results[0].geometry.location,
			        map: map,
			        title: address,
			        html: address
			      });

			      google.maps.event.addListener(marker, 'click', function() {
			      	infowindow.close();
			      	infowindow.setContent('test');
			        infowindow.open(map, this);
			      });

			      google.maps.event.addListener(map, "click", function(event) {
					    infowindow.close();
					});

			    } else {
			      alert("No results found");
			    }
			  } else {

			      if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
			        nextAddress--;
			        delay++;
			      } else {
			        alert("Geocode was not successful for the following reason: " + status);
			      }

			  }
			  next();
			});
        }



       
		google.maps.event.addDomListener(window, 'load', initialize);


	</script>


	<script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDSdyqX-YfJ9mMcGqXSdGPOURjWGKSGJqM&sensor=false"></script>


</body>
</html>