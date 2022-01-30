
	// Add Marker Survey
	function addMarkerSurvey(address, icon, name, email, telephone,presentase, i, nama_lokation, lats ,lngs){
		var telp = '';
      if( telephone != ''){
        telp = telephone;
      } else {
        telp = "";
      }
      if(presentase != '') {
        presentase = presentase+' %';
      } else {
        presentase = '0 %';
      }
      
      var over = 
      '<div id="content">'+
      '</div>'+
      '<div id="bodyContent" style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
      '<div class="top" style="border-bottom:2px solid #f39c12;">'+nama_lokation+'</div>'+
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
        '<tr>'+
        '<td>Presentase</td>'+
        '<td  style="width:10px; text-align:center;">:</td>'+
        '<td>'+presentase+'</td>'+
        '</tr>'+
      '</table>'+
      '</div>'+
      '</div>'; 
      
		infowindowover = new google.maps.InfoWindow();
		
        var marker4 = new google.maps.Marker({
			map: map,
			icon : icon,
			title : name,
			position: {lat:lats, lng:lngs}
		});
		google.maps.event.addListener(marker4, 'click', infoCallback(over, marker4));
		marker_survey.push(marker4);
	}
	
	function setSurvey(map) {
    	for (var i4 = 0; i4 < marker_survey.length; i4++) {
          	marker_survey[i4].setMap(map);
        }	
    }
	
	function showSurvey() {
    	setCaleg(null);
		setDPD(null);
    	setDPC(null);
    	setSurvey(map);
		setGub(null);
    	setBup(null);
    	setWal(null);
    	$('#response-filter').fadeOut(100);
    }