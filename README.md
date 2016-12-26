# Google Maps API


Sample code for google maps implementation in your website.
Takes address and marks in the map.
use geocoder.

PLEASE CHECK TEST.PHP, ZOOM.PHP and AUTOSCROLL.PHP.


Handles: 

1. "over query limit", (File: all)
2. uses address instead of longitute and latitute, (file: all)
3. closes infowindow when another infowindow is opened, (file: All)
4. fadein and fadeouts the information on click in marker. (file: zoom.php)
5. Scroll effects when click in the marker. (file: autoscroll.php)
6. Marker animation (bounce) when click on list of items.(file: autoscroll.php)
7. Show border around the country(thick border) and its districts(thin border) using kml file and geoXML3.(file: autoscroll.php, zoom.php)
8. Zooms in effect when click on polygons.(file: autoscroll.php, zoom.php)
9. Show active area(district) of the sale managers when hover on the list.(file: autoscroll.php)

To create kml file:

http://gadm.org/country

1. choose country
2. File format : google earth .kmz
3. when downloaded change .kmz to .zip
4. extract file


Useful links:

http://www.lootogo.com/googlemapsapi3/markerPlugin.html
http://jsfiddle.net/g95q8L76/
https://developers.google.com/maps/documentation/javascript/geocoding
http://stackoverflow.com/questions/19640055/multiple-markers-google-map-api-v3-from-array-of-addresses-and-avoid-over-query
http://stackoverflow.com/questions/15925980/using-address-instead-of-longitude-and-latitude-with-google-maps-api
http://gis.stackexchange.com/questions/15052/how-to-avoid-google-map-geocode-limit?newreg=fa34116a6a0c4b33a18f38ba7762263b
https://developers.google.com/maps/documentation/javascript/adding-a-google-map#key
