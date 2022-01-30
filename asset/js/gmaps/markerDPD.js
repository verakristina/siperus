	// Add Marker DPD
	function addMarkerDPD(address, icon, name, email, telephone, i,type, lats ,lngs){
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
		'<div class="top" style="border-bottom:2px solid #f39c12;">'+address+'</div>'+
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
		
        var marker2 = new google.maps.Marker({
			map: map,
			icon : icon,
			title : name,
			position: {lat:lats, lng:lngs}
		});
		google.maps.event.addListener(marker2, 'click', infoCallback(over, marker2));
		marker_dpd.push(marker2);
	}	
	
	function setDPD(map) {
    	for (var i2 = 0; i2 < marker_dpd.length; i2++) {
          	marker_dpd[i2].setMap(map);
        }	
    }	

    function showDPD() {
    	setCaleg(null);
    	setDPD(map);
    	setDPC(null);
    	setSurvey(null);
		setGub(null);
    	setBup(null);
    	setWal(null);
    	$('#response-filter').fadeOut(100);
    }