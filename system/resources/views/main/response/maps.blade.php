<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<div id="map"></div>
<script> 
  var map;
  <?php  
    echo 'var data = [';
      foreach($dataCalon as $data)
      {
        echo '["'.$data->Nama_kabupaten.','.$data->Nama_provinsi.',Indonesia","'.$data->type.'","'.$data->nama.'","'.$data->telephone.'","'.$data->email.'"],';
      }
    echo '];';
  ?>
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 0.7893, lng: 113.9213},
      zoom: 5
    });
    for(var i=0; i < data.length; i++)
    {
      if(data[i][1] == 'Gubernur' || data[i][1] == 'Wakil Gubernur') 
      {
        setTimeout('geocoding("'+data[i]+'","http://maps.google.com/mapfiles/ms/icons/green-dot.png","'+data[i][1]+'","'+data[i][2]+'","'+data[i][4]+'","'+data[i][3]+'",'+i+')' , 0);
      } else if(data[i][1] == 'Bupati' || data[i][1] == "Wakil Bupati") {
        setTimeout('geocoding("'+data[i]+'","http://maps.google.com/mapfiles/ms/icons/yellow-dot.png","'+data[i][1]+'","'+data[i][2]+'","'+data[i][4]+'","'+data[i][3]+'",'+i+')' , 0);
      } else if(data[i][1] == 'Walikota' || data[i][1] == "Wakil Walikota") {
        setTimeout('geocoding("'+data[i]+'","http://maps.google.com/mapfiles/ms/icons/blue-dot.png","'+data[i][1]+'","'+data[i][2]+'","'+data[i][4]+'","'+data[i][3]+'",'+i+')' , 0);
      }
    }
  }
  function geocoding(address, icon, type, name, email, telephone, i){
    var as;
    if(type == 'Gubernur' || type == 'Wakil Gubernur') 
    {
      as = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
    } else if(type == "Bupati" || type == "Wakil Bupati") {
      as = "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png";
    } else if(type == "Walikota" || type == "Wakil Walikota") {
      as = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
    }
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({'address': address}, function(results, status) {
    if (status ==  'OK') {
      var over = 
        '<div id="content">'+
        '</div>'+
        '<div id="bodyContent" style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
        '<table style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
          '<tr>'+
            '<td>Nama</td>'+
            '<td  style="width:10px; text-align:center;">:</td>'+
            '<td>'+name+'</td>'+
          '</tr>'+
          '<tr>'+
            '<td>Email</td>'+
            '<td  style="width:10px; text-align:center;">:</td>'+
            '<td>'+email+'</td>'+
          '</tr>'+
          '<tr>'+
            '<td>No Telp</td>'+
            '<td  style="width:10px; text-align:center;">:</td>'+
            '<td>'+telephone+'</td>'+
          '</tr>'+
        '</table>'+
        '</div>'+
        '</div>'; 
        
      var infowindowover = new google.maps.InfoWindow({
        content: over,
        maxWidth: 400
      });
          var marker = new google.maps.Marker({
          map: map,
          icon : icon,
          title : name,
          position: results[0].geometry.location
        });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindowover.open(map, marker);
          }
        })(marker, i));
        // google.maps.event.addListener(marker, 'mouseout', (function(marker, i) {
        //   return function() {
        //     infowindowover.close();
        //   }
        // })(marker, i));
      } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
          setTimeout(function() {
              geocoding(address,icon,type,name,email,telephone,i);
          }, 0);
      } else {
        wait = true;
        setTimeout("wait = true", 2000);
      }
  });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCS6a6xaKsl3lnKhR_0tB351qZinkfjyes&callback=initMap" async defer></script>
</body>
</html>