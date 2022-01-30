
	// Add Marker Caleg
	function addMarker(address, icon, name, email, telephone, i, name_lokation, type,wakil,types, dketua, dwakil, lats ,lngs)
	{
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
      '<div class="top" style="border-bottom:2px solid #f39c12;">'+name_lokation+'</div>'+
      '<table style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
        '<tr>'+
        '<td>Ketua</td>'+
        '<td  style="width:10px; text-align:center;">:</td>'+
        '<td>'+dketua+'</td>'+
        '</tr>'+       
		'<tr>'+
        '<td>Wakil</td>'+
        '<td  style="width:10px; text-align:center;">:</td>'+
        '<td>'+dwakil+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Calon</td>'+
        '<td  style="width:10px; text-align:center;">:</td>'+
        '<td>'+types+'</td>'+
        '</tr>'+
      '</table>'+
      '</div>'+
      '</div>'; 
		  
		infowindowover = new google.maps.InfoWindow();
	  
		var marker = new google.maps.Marker({
			map: map,
			icon : icon,
			position: {lat:lats, lng:lngs}
		});
	  
		google.maps.event.addListener(marker, 'click', infoCallback(over, marker));
		marker_caleg.push(marker);
	}
	
	// Add Marker Gubernur
	function addMarkerGubernur(address, icon, name, email, telephone, i, name_lokation, type,wakil,types, dketua, dwakil, lats ,lngs)
	{
		if(types == 'Gubernur'){
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
		  '<div class="top" style="border-bottom:2px solid #f39c12;">'+name_lokation+'</div>'+
		  '<table style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
			'<tr>'+
			'<td>Ketua</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+dketua+'</td>'+
			'</tr>'+       
			'<tr>'+
			'<td>Wakil</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+dwakil+'</td>'+
			'</tr>'+
			'<tr>'+
			'<td>Calon</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+types+'</td>'+
			'</tr>'+
		  '</table>'+
		  '</div>'+
		  '</div>'; 
			  
			infowindowover = new google.maps.InfoWindow();
		  
			var marker7 = new google.maps.Marker({
				map: map,
				icon : icon,
				position: {lat:lats, lng:lngs}
			});
		  
			google.maps.event.addListener(marker7, 'click', infoCallback(over, marker7));
			marker_gubernur.push(marker7);
		}
	}
	
	// Add Marker Bupati
	function addMarkerBupati(address, icon, name, email, telephone, i, name_lokation, type,wakil,types, dketua, dwakil, lats ,lngs)
	{
		if(types == 'Bupati'){
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
		  '<div class="top" style="border-bottom:2px solid #f39c12;">'+name_lokation+'</div>'+
		  '<table style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
			'<tr>'+
			'<td>Ketua</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+dketua+'</td>'+
			'</tr>'+       
			'<tr>'+
			'<td>Wakil</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+dwakil+'</td>'+
			'</tr>'+
			'<tr>'+
			'<td>Calon</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+types+'</td>'+
			'</tr>'+
		  '</table>'+
		  '</div>'+
		  '</div>'; 
			  
			infowindowover = new google.maps.InfoWindow();
		  
			var marker6 = new google.maps.Marker({
				map: map,
				icon : icon,
				position: {lat:lats, lng:lngs}
			});
		  
			google.maps.event.addListener(marker6, 'click', infoCallback(over, marker6));
			marker_bupati.push(marker6);
		}
	}
	
	// Add Marker Walikota
	function addMarkerWalikota(address, icon, name, email, telephone, i, name_lokation, type,wakil,types, dketua, dwakil, lats ,lngs)
	{
		if(types == 'Walikota'){
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
		  '<div class="top" style="border-bottom:2px solid #f39c12;">'+name_lokation+'</div>'+
		  '<table style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
			'<tr>'+
			'<td>Ketua</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+dketua+'</td>'+
			'</tr>'+       
			'<tr>'+
			'<td>Wakil</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+dwakil+'</td>'+
			'</tr>'+
			'<tr>'+
			'<td>Calon</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+types+'</td>'+
			'</tr>'+
		  '</table>'+
		  '</div>'+
		  '</div>'; 
			  
			infowindowover = new google.maps.InfoWindow();
		  
			var marker5 = new google.maps.Marker({
				map: map,
				icon : icon,
				position: {lat:lats, lng:lngs}
			});
		  
			google.maps.event.addListener(marker5, 'click', infoCallback(over, marker5));
			marker_walikota.push(marker5);
		}	
	}
	
	function setCaleg(map) {
        for (var i1 = 0; i1 < marker_caleg.length; i1++) {
          marker_caleg[i1].setMap(map);
        }
    }
	function setGub(map) {
        for (var i5 = 0; i5 < marker_gubernur.length; i5++) {
          marker_gubernur[i5].setMap(map);
        }
    }
	function setBup(map) {
        for (var i6 = 0; i6 < marker_bupati.length; i6++) {
          marker_bupati[i6].setMap(map);
        }
    }
	function setWal(map) {
        for (var i7 = 0; i7 < marker_walikota.length; i7++) {
          marker_walikota[i7].setMap(map);
        }
    }
	function showCaleg() {
		setCaleg(map);
    	setDPD(null);
    	setDPC(null);
    	setSurvey(null);
		setGub(null);
    	setBup(null);
    	setWal(null);
    	$('#response-filter').fadeIn(100);
    } function showGub() {
		setCaleg(null);
    	setDPD(null);
    	setDPC(null);
    	setSurvey(null);
		setGub(map);
    	setBup(null);
    	setWal(null);
    }
    function showBup() {
		setCaleg(null);
    	setDPD(null);
    	setDPC(null);
    	setSurvey(null);
		setGub(null);
    	setBup(map);
    	setWal(null);
    }
    function showWal() {
		setCaleg(null);
    	setDPD(null);
    	setDPC(null);
    	setSurvey(null);
		setGub(null);
    	setBup(null);
    	setWal(map);
    }