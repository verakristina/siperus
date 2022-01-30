    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
    </style>
      <div id="floating-panel">
    <input id="pac-input" class="controls" type="text" placeholder="Search Box" style="color:black;"> 
    <input id="kelurahan" type="hidden"><!-- 
    <input type="hidden" name='lat' id='lat' class='input-xlarge' >
    <input type="hidden" name='lng' id='lng' class='input-xlarge'> -->
    </div>
    <div id="map"></div>
<script>
  var myLatLng;
  var map;
  var marker1;
  var input;
  var searchBox;
  var pos2;
  var pos;
  var geocoder;
  function initAutocomplete() {   
    map = new google.maps.Map(document.getElementById('map'), {
      	zoom: 5,
      	center: {lat: -1.6024216765509336, lng: 119.794921875},
      	mapTypeId: google.maps.MapTypeId.TERRAIN
    });
	if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            map.setCenter(pos);
            marker1.setPosition(pos);
            updateMarkerPosition(pos);
          });
    }  	marker1 = new google.maps.Marker({
      	position: pos,
      	map: map,
      	title: 'Hello World!',
      	draggable : true
    });
    google.maps.event.addListener(marker1, 'drag', function() {
      	updateMarkerPosition(marker1.getPosition());
    });
    map.addListener('click', function(event) {
      	addMarker(event.latLng);
      	updateMarkerPosition(event.latLng);
    });
    placeSearchBox(map);
}
function placeSearchBox(map) {
	input = document.getElementById('pac-input');
    searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      	searchBox.setBounds(map.getBounds());
    });
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
      	var places = searchBox.getPlaces();

      	if (places.length == 0) {
        	return;
      	}
      	// Clear out the old markers.
    
      	// For each place, get the icon, name and location.
      	var bounds = new google.maps.LatLngBounds();
      	places.forEach(function(place) {
        	if (!place.geometry) {
          		console.log("Returned place contains no geometry");
          		return;
        	}
		    var icon = {
		      	url: place.icon,
		      	size: new google.maps.Size(171, 171),
		      	origin: new google.maps.Point(100, 100),
		      	anchor: new google.maps.Point(117, 134),
		      	scaledSize: new google.maps.Size(125, 125)
		    };


        	if (place.geometry.viewport) {
          		// Only geocodes have viewport.
          		bounds.union(place.geometry.viewport);
        	} else {
          		bounds.extend(place.geometry.location);
        	}
      	});
      	map.fitBounds(bounds);
    });
}
function geocoding(address){
  	geocoder.geocode({'address': address}, function(results, status) {
    if (status === 'OK') {
	    map.setCenter(results[0].geometry.location);
	    google.maps.event.addListener(marker1, 'drag', function() {
	    	updateMarkerPosition(marker1.getPosition());
      	});
    }
  });
}
function addMarker(location) {
	marker1.setPosition(location);
}
var add, type, countArray, dataResponse, otomatis;
function updateMarkerPosition(latLng) {
var geocoder  = new google.maps.Geocoder();
	geocoder.geocode({'latLng': latLng}, function (results, status) {
		if(status == google.maps.GeocoderStatus.OK) {
			add = results[0].formatted_address; 
			type = results[0].types;      

			if(type == "street_address"){
				/* countArray = 9;  */
				countArray = 4;
				otomatis = 'kel';
			} else if(type == "route"){
				/* countArray = 8;  */
				countArray = 4;
				otomatis = 'kel';
			} else if(type == "postal_code"){
				/* countArray = 7;  */
				countArray = 4;
				otomatis = 'kel';
			} else if(type == "administrative_area_level_4"){
				/* countArray = 6;  */
				countArray = 4;
				otomatis = 'kel';
			} else if(type == "administrative_area_level_3"){
				/* countArray = 5;  */
				countArray = 5; 
				otomatis = 'kec';
			} else if(type == "administrative_area_level_2"){
				/* countArray = 4;  */
				countArray = 6;
				otomatis = 'kab'; 
			} else if(type == "administrative_area_level_1"){
				/* countArray = 1;  */
				countArray = 7;
				otomatis = 'prov'; 
			} else if(type == "country"){
				countArray = 0; 
			} else {
				
			}
			
			dataResponse = results[0].address_components[countArray].long_name;
			
			var lct_name = add.split(",");
			var fst = lct_name.splice(0,1).join("");
			var kelurahan = lct_name.splice(0,1).join("");
			document.getElementById('pac-input').value = add;
			document.getElementById('kelurahan').value = kelurahan;
		}
	});
}

$('.simpan_alamat_maps').click(function(){
	$('#alamat').val(add);
	$('#telp').val(dataResponse);
	$('#hp').val(type);
	$('#facebook').val(countArray);
	optionOtomatis(otomatis,dataResponse);
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCS6a6xaKsl3lnKhR_0tB351qZinkfjyes&libraries=places&callback=initAutocomplete" async defer></script>