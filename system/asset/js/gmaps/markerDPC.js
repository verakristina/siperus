	// Add Marker DPC
	function addMarkerDPC(address, icon, name, email, telephone, i,lokasi, type, lats ,lngs){
		var telp = '';
		  if( telephone != ''){
			telp = telephone;
		  } else {
			telp = "";
		  }
		  
		  var over = 
		  '<div id="content">'+
		  '</div>'+
		  '<div id="bodyContent" style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
		  '<div class="top" style="border-bottom:2px solid #f39c12;">'+lokasi+'</div>'+
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
			'<td>'+telp+'</td>'+
			'</tr>'+
		  '</table>'+
		  '</div>'+
		  '</div>'; 
      
		infowindowover = new google.maps.InfoWindow();
		
        var marker3 = new google.maps.Marker({
			map: map,
			icon : icon,
			title : name,
			position: {lat:lats, lng:lngs}
		});
		google.maps.event.addListener(marker3, 'click', infoCallback(over, marker3));
		marker_dpc.push(marker3);
	}	
	function setDPC(map) {
        for (var i3 = 0; i3 < marker_dpc.length; i3++) {
          marker_dpc[i3].setMap(map);
        }
    }    
    
	function showDPC() {
    	setCaleg(null);
    	setDPD(null);
    	setDPC(map);
    	setSurvey(null);
		setGub(null);
    	setBup(null);
    	setWal(null);
    	$('#response-filter').fadeOut(100);
    }