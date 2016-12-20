<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type='text/javascript' src='/jquery.scrollTo-min.js'></script>

</head>
<body>
	<style type="text/css">

#map_canvas {
    float:left;
    height: 650px;
    width: 60%;
}

.saleManagerContainer{
float: left;
width:40%;
height: 600px;
/*max-width: 900px;*/
/* padding: 20px;
margin: 20px auto;*/
overflow: scroll;
}

.saleManagerContainer::-webkit-scrollbar { 
    display: none; 
}

.saleManager{
    padding:5px;
    margin:10px;
    border: 1px solid #ddd;
}

.saleManager img{
    width:150px;
}

.saleManager .name{
    font-size: 16px;
    margin-bottom: 10px;
}

span.infolabel{
    font-weight: 600;
    margin-right: 10px;
}


.contentContainer{
    clear: both;
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
    display: block;
    margin: 0 auto;
    padding: 0 6rem;
}

.contImage{
    float: left;
    width: 30%;
}

.contPara {
    float: left;
    width: 65%;
    margin: 0 0 0 5%;
}

	</style>

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.exp&sensor=false"></script>
	
	<?php
	$address = array("France","Germany", "Switzerland","San Diego","Norway","manilla","sydney", "tokyo","turkey","hongkong","dubai","florida","canada");
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

				var className = '#info' + index;
                $('.saleManagerContainer').scrollTo(className,800);

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


	<script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDSdyqX-YfJ9mMcGqXSdGPOURjWGKSGJqM&sensor=false"></script>

		<div id="map_canvas" ></div>
		<div class="saleManagerContainer"> 


		     
		    <div id="info0" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		        
		              <img alt="" src="/static/media/images/salesmanagers/Picture3.jpg">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b> France</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Rue des Vieux-Grenadiers 7, 1205 Genève</div>
		            <div class="district"><span class="infolabel">District:</span>Genève</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>AD</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>stephanie.gobel@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 307 61 87</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info1" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		        
		              <img alt="" src="/static/media/images/salesmanagers/Picture2.jpg">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b> Germany</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Route de Cojonnex 18, 1000 Lausanne</div>
		            <div class="district"><span class="infolabel">District:</span>Vaud Jura Vallais</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>AD</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>laurence.mordasini@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 307 61 38</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info2" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b>   Switzerland</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Verzuolo 19, 6633 Lavertezzo</div>
		            <div class="district"><span class="infolabel">District:</span>Ticino</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>AD</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span></div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span></div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info3" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		        
		              <img alt="" src="/static/media/images/salesmanagers/Picture1.jpg">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b>Sandiego</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Haus Aristella, 3908 Saas-Balen</div>
		            <div class="district"><span class="infolabel">District:</span>Bern Wallis</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>AD</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>barbara.kramer@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 307 61 88</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info4" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		        
		              <img alt="" src="/static/media/images/salesmanagers/Picture9.jpg">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b> Norway</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Marktpl. 9, 4001 Basel</div>
		            <div class="district"><span class="infolabel">District:</span>Basel</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>AD</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>brigitte.siegrist@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 307 61 61</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info5" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		        
		              <img alt="" src="/static/media/images/salesmanagers/Picture6.jpg">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b> Manilla</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Horwerstrasse 91, 6002 Luzern</div>
		            <div class="district"><span class="infolabel">District:</span>Innerschweiz</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>AD</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>brigitte.perruchoud@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 307 61 06</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info6" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		        
		              <img alt="" src="/static/media/images/salesmanagers/Picture8.jpg">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b> Sydney</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Tellstrasse 25, 5001 Aarau</div>
		            <div class="district"><span class="infolabel">District:</span>Aargau Schaffhausen</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>AD</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>urs.frei@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 307 61 24</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info7" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		        
		              <img alt="" src="/static/media/images/salesmanagers/Picture7.jpg">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b> Tokyo</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Sihlfeldstrasse 45, 8003 Zurich</div>
		            <div class="district"><span class="infolabel">District:</span>Zürich</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>AD</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>matthias.haefelfinger@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 307 61 81</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info8" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		        
		              <img alt="" src="/static/media/images/salesmanagers/Picture5.jpg">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b>Turkey</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Ballonstrasse 28, 8952 Schlieren</div>
		            <div class="district"><span class="infolabel">District:</span>Ostschweiz</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>AD</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>zeljko.stojicic@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 307 61 44</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info9" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b> Hongkong</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Freiburgstrasse 8,, 3010 Bern</div>
		            <div class="district"><span class="infolabel">District:</span>Bern Basel Aargau</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>AD</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>kuno.stampfli@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 664 51 57</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info10" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b> Dubai</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Bahnhofpl. 7, 3920  Zermatt</div>
		            <div class="district"><span class="infolabel">District:</span>Bayer-Haus</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>ID</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>franziska.helbling@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 307 62 93</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		     
		    <div id="info11" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b> Florida</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Bei der Kirche, Haus, 3910 Saas-Grund</div>
		            <div class="district"><span class="infolabel">District:</span></div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>ID</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>moritz.holenstein@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 600 48 69</div>
		          </div>
		        </div>
		        <div class="desc">Bayer-Haus</div>
		      </div>
		    </div>
		    

		     
		    <div id="info12" class="saleManager row">
		      <div class="col-xs-12 col-sm-3 col-md-3">
		                                         

		      </div>
		      <div class="col-xs-12 col-sm-9 col-md-9">                                    
		        <div class="name"><b>Canada</b></div>

		        <div class="row">
		          <div class="col-xs-12 col-sm-6 col-md-6">    
		            <div class="address"><span class="infolabel">Adresse:</span>Bei der Kirche, Haus, 3910 Saas-Grund</div>
		            <div class="district"><span class="infolabel">District:</span>Bayer-Haus</div>
		            <div class="deliveryService"><span class="infolabel">Aussendienst/Innendienst:</span>ID</div>
		          </div>
		          <div class="col-xs-12 col-sm-6 col-md-6">   
		            <div class="email"><span class="infolabel">Email:</span>violetta.schlaepfer@bayer.com</div>
		            <div class="phone"><span class="infolabel">Mobil Gesch.:</span>+41 79 307 61 20</div>
		          </div>
		        </div>
		        <div class="desc"></div>
		      </div>
		    </div>
		    

		</div>



</body>
</html>