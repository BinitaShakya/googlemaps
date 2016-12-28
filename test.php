<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDSdyqX-YfJ9mMcGqXSdGPOURjWGKSGJqM&sensor=false"></script>   
</head>
<body>
	<style type="text/css">
	#map_canvas {
		margin:0 auto;
	  height: 300px;
	  width: 600px;
	}

	</style>

	<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.exp&sensor=false"></script> -->
	<div id="map_canvas" ></div>
	<?php
	$address = array("France","Germany", "Switzerland");
	?>
	<script type="text/javascript">
		var geocoder;
		var map;
		// var address = ["San Diego","Norway","switzerland","france","manilla","sydney", "tokyo","turkey","hongkong","dubai","florida","canada"];

		var address = <?php echo json_encode($address); ?>;
		var nextAddress = 0;
		var delay = 100;
		var infowindow;

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
	          setTimeout('codeAddress("' + address[nextAddress] + '", ' + nextAddress + ", " + theNext +')', delay);
	          nextAddress++;
	        } else {
	          // We're done. Show map bounds	         
	          // map.fitBounds(bounds);
	        }
	      }


		function codeAddress(location,index,next) {
			var address = location;
			geocoder.geocode({
			  'address': location
			}, function(results, status) { 
			  if (status == google.maps.GeocoderStatus.OK) {
			    if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
			      // map.setCenter(results[0].geometry.location);
				    var p = results[0].geometry.location;
					var lat=p.lat();
					var lng=p.lng();
				    createMarker(address, index, lat, lng);

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

        function createMarker(address, index, lat, lng){

			var marker = new google.maps.Marker({
			position: new google.maps.LatLng(lat,lng),
			map: map,
			title: address,
			html: address
			});
			google.maps.event.addListener(marker, 'click', function() {
				if(infowindow) {infowindow.close();}
				infowindow = new google.maps.InfoWindow({
				content: '<p>'+ index+'</p><b>' + address + '</b>',
				size: new google.maps.Size(150, 50)
				});
				// infowindow.close();
				// infowindow.setContent('test');
				infowindow.open(map, this);
				// var idNo = $('p').text();
				// alert(text);
				var className = '#info' + index;
				// alert(className);
				$(className)
				.addClass('active')
				.siblings().removeClass('active');

				$(className)
				.removeClass('inactive')
				.siblings().addClass('inactive');


				$('.inactive').fadeOut(1500);
				$('.active').fadeIn(1500);

			});

			google.maps.event.addListener(map, "click", function(event) {
			    infowindow.close();
			    $('.saleManager')
				.removeClass('inactive')
				.addClass('active');

				$('.inactive').fadeOut(1500);
				$('.active').fadeIn(1500);
			});
        }



       
		google.maps.event.addDomListener(window, 'load', initialize);


	</script>


	<!-- <script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDSdyqX-YfJ9mMcGqXSdGPOURjWGKSGJqM&sensor=false"></script> -->

	<div class="main-container">

		<?php
			$count=0;
			foreach ($address as $add) {
				$class = "info".$count;
				?>
				<div id="<?php echo $class; ?>" class="saleManager"><?php echo "Information: ".$add; ?></div>

				<?php
				$count++;
			}
		?>


	</div>


</body>
</html>