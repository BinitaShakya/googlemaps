<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDSdyqX-YfJ9mMcGqXSdGPOURjWGKSGJqM&sensor=false"></script>   

	<!-- <script src="geoxml3.js"></script> -->
	<script type="text/javascript" src="https://cdn.rawgit.com/geocodezip/geoxml3/master/polys/geoxml3.js"></script>
	<!-- <script type="text/javascript" src="https://cdn.rawgit.com/geocodezip/geoxml3/master/ProjectedOverlay.js"></script> -->


</head>
<body>
	<style type="text/css">
	#map_canvas {
		margin:0 auto;
	  height: 600px;
	  width: 900px;
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

		var geoXml = null;


		function initialize() {
			geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(46.75871154014102, 8.24450683593751);
			var myOptions = {
			zoom: 4,
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


			// var kmlLayer = new google.maps.KmlLayer();
			// var myParser = new geoXML3.parser({map: map});
			// myParser.parse('CHE.kml');
			// var kmlLayer = new google.maps.KmlLayer(myParser.parse('CHE.kml'), {
			//   suppressInfoWindows: true,
			//   preserveViewport: false,
			//   map: map
			// });


			// For kml
			geoXml = new geoXML3.parser({
                map: map,
                singleInfoWindow: true,
                afterParse: useTheData
            });
            geoXml.parse('CHE.kml');

            


		}

		function useTheData(doc){
		  // Geodata handling goes here, using JSON properties of the doc object
		  // var sidebarHtml = '<table><tr><td><a href="javascript:showAll();">Show All</a></td></tr>';
		  geoXmlDoc = doc[0];
		  for (var i = 0; i < doc[0].gpolygons.length; i++) {
		    // sidebarHtml += '<tr><td><a href="javascript:kmlClick('+i+');">'+doc[0].placemarks[i].name+'</a> - <a href="javascript:kmlShowPoly('+i+');">show</a> - <a href="javascript:kmlHighlightPoly('+i+');">highlight</a></td></tr>';
		    // sidebarHtml += '<tr><td><a href="javascript:kmlClick('+i+');">'+doc[0].placemarks[i].name+'</a> - <a href="javascript:kmlShowPoly('+i+');">show</a> - <a href="javascript:kmlHighlightPoly('+i+');">highlight</a></td></tr>';

		    highlightPoly(doc[0].gpolygons[i]);
		    // doc[0].markers[i].setVisible(false);
		  }
		  // sidebarHtml += "</table>";
		  // document.getElementById("sidebar").innerHTML = sidebarHtml;



		};


		function highlightPoly(poly) {
		    
		    google.maps.event.addListener(poly,"click",function(event) {
		      // console.log('test');
		      // var position = this.getMap().getPosition();
		      // console.log('position:' + position);
		      // this.getMap().setCenter(position);
		      var currentZoom = this.getMap().getZoom();
		      this.getMap().setZoom(currentZoom + 1);
		      this.getMap().setCenter(event.latLng);
		      poly.infoWindow.close();
		      if(infowindow) {infowindow.close();}
		      console.log('poly click event');

		    });
		    google.maps.event.addListener(poly,"mouseover",function() {
		      poly.setOptions({fillColor:"#e65100", fillOpacity: 0.2, strokeColor: "#e65100", zIndex:100, strokeWidth: '30px'});

		    });
		    google.maps.event.addListener(poly,"mouseout",function() {
		      poly.setOptions({strokeColor: "#000", fillOpacity: 0, zIndex:0});
		      // poly.infoWindow.close();
		    });

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
				infowindow.open(map, this);
				//Fade out effect
				var className = '#info' + index;
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
			    if(infowindow) {infowindow.close();}
			    // Fade out effect
			    $('.saleManager')
				.removeClass('inactive')
				.addClass('active');

				$('.inactive').fadeOut(1500);
				$('.active').fadeIn(1500);

				map.setZoom(map.getZoom() + 1);
				map.setCenter(event.latLng);
				console.log('map click event');

			
			});


			// google.maps.event.addListener(map, 'center_changed', function() {
			// // 3 seconds after the center of the map has changed, pan back to the
			// // marker.
			// 	window.setTimeout(function() {
			// 	  map.panTo(marker.getPosition());
			// 	}, 3000);
			// });
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