<input id="pimcam-input" class="controls" type="text" placeholder="Search Box">
<div id="map" style="background:#eee; height:93%;"></div>
<script type="text/javascript" src="{{asset('asset/js/jquery-3.0.0.min.js')}}"></script>
<script>
	var myLatLng;
	var map;
	var marker_statistik_organisasi = [];
	var marker_statistik_kursi = [];
	var marker_dpd = [];
	var marker_pimcab = [];
	var marker_survey = [];
	var marker_gubernur = [];
	var marker_bupati = [];
	var marker_walikota = [];

	var marker_penduduk_provinsi = [];
	var marker_penduduk_kabupaten = [];

	var marker_kursi_dprri = [];
	var marker_kursi_dprdi = [];
	var marker_kursi_dprdii = [];

	var marker_pilkada = [];
	var marker_pilkada_gubernur = [];
	var marker_pilkada_bupati = [];
	var marker_pilkada_walikota = [];

	var marker_dprri = [];

	var input;
	var searchBox;
	var pos;
	var geocoder;
	var infowindowover;
	var sttout;
	<?php
		$totalKursi1 = 0;
		$totalKursiAda1 = 0;
		$totalKursi2 = 0;
		$totalKursiAda2 = 0;
		$totalKursi3 = 0;
		$totalKursiAda3 = 0;

		echo 'var statistikOrganisasi = [';
			foreach($dataStatistikOrganisasi as $tmp)
			{
				echo '["'.$tmp->prov_nama.'",'.$tmp->lat.','.$tmp->lng.','.$tmp->pimcab.','.$tmp->pimcam.','.$tmp->ranting.','.$tmp->anak_ranting.','.$tmp->kpa.','.$tmp->pimcab_ada.','.$tmp->pimcam_ada.','.$tmp->ranting_ada.','.$tmp->anak_ranting_ada.','.$tmp->kpa_ada.'],';
			}
		echo '];';
		echo 'var statistikKursi = [';
			foreach($dataStatistikKursi as $tmp)
			{
				$totalKursi1 = $totalKursi1+$tmp->kursi_t1;
				$totalKursiAda1 = $totalKursiAda1+$tmp->kursi_t1_ada;
				$totalKursi2 = $totalKursi2+$tmp->kursi_t2;
				$totalKursiAda2 = $totalKursiAda2+$tmp->kursi_t2_ada;
				$totalKursi3 = $totalKursi3+$tmp->kursi_t3;
				$totalKursiAda3 = $totalKursiAda3+$tmp->kursi_t3_ada;
				echo '["'.$tmp->prov_nama.'",'.$tmp->lat.','.$tmp->lng.','.$tmp->dapil_t1.','.$tmp->dapil_t2.','.$tmp->dapil_t3.','.$tmp->kursi_t1.','.$tmp->kursi_t2.','.$tmp->kursi_t3.','.$tmp->kursi_t1_ada.','.$tmp->kursi_t2_ada.','.$tmp->kursi_t3_ada.'],';
			}
		echo '];';
		echo 'var DPD = [';
			foreach($datapimdaAll as $tmp)
			{
				echo '[`'.$tmp->prov_nama.'`,`'.RTRIM($tmp->nama).'`,`'.$tmp->no_telp.'`,`'.$tmp->email.'`,'.$tmp->lat.','.$tmp->lng.','.$tmp->id_bio.',`'.$tmp->sk.'`],';
			}
		echo '];';
		echo 'var pimcab = [';
			foreach($datapimcabAll as $tmp)
			{
			if($tmp->pimcab_kab_id != ''){
				$lokasi = $tmp->kab_nama;
			} else {
				$lokasi = $tmp->prov_nama;
			}
			echo '[`'.$tmp->kab_nama.','.$tmp->prov_nama.'`,`'.$tmp->nama.'`,`'.$tmp->no_telp.'`,`'.$tmp->email.'`,`'.$lokasi.'`,'.$tmp->lat.','.$tmp->lng.','.$tmp->id_bio.', `'.$tmp->sk.'`,`'.$tmp->prov_nama.'`],';
			}
		echo '];';
	?>
	$('.responseKursidprri').html('DPR-RI ({{ $totalKursiAda1 }}/{{ $totalKursi1 }})');
	$('.responseKursidprdi').html('DPRD I ({{ $totalKursiAda2 }}/{{ $totalKursi2 }})');
	$('.responseKursidprdii').html('DPRD II ({{ $totalKursiAda3 }}/{{ $totalKursi3 }})');



	function initAutocomplete() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -1.6024216765509336, lng: 119.794921875},
			zoom: 5,
			styles: [
				{
				  featureType: 'all',
				  stylers: [
					{ saturation: -80 }
				  ]
				},{
				  featureType: 'road.arterial',
				  elementType: 'geometry',
				  stylers: [
					{ hue: '#00ffee' },
					{ saturation: 50 }
				  ]
				},{
				  featureType: 'poi.business',
				  elementType: 'labels',
				  stylers: [
					{ visibility: 'off' }
				  ]
				}
			],
			mapTypeId: google.maps.MapTypeId.TERRAIN
		});

        input = document.getElementById('pimcam-input');
        searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

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
    	//Fatchur

		$(document).ready(function(){
			for(var a=0; a < DPD.length; a++)
			{
				addMarkerDPD(DPD[a][0],"{{ asset('asset/icon/user-black-orange2.png') }}",DPD[a][1],DPD[a][3],DPD[a][2],a,"DPD",DPD[a][4],DPD[a][5],DPD[a][6], DPD[a][7]);
			}
			for(var b=0; b < pimcab.length; b++)
			{
				addMarkerpimcab(pimcab[b][0],"{{ asset('asset/icon/user-red-orange.png') }}",pimcab[b][1],pimcab[b][3],pimcab[b][2],b,pimcab[b][4],"pimcab",pimcab[b][5],pimcab[b][6],pimcab[b][7], pimcab[b][8], pimcab[b][9]);
			}
			for(var b=0; b < statistikOrganisasi.length; b++)
			{
				addMarkerStatistikOrganisasi(statistikOrganisasi[b][0],"{{ asset('asset/icon/user-black-orange.png') }}",statistikOrganisasi[b][1],statistikOrganisasi[b][2],statistikOrganisasi[b][3],statistikOrganisasi[b][4],statistikOrganisasi[b][5],statistikOrganisasi[b][6],statistikOrganisasi[b][7],statistikOrganisasi[b][8],statistikOrganisasi[b][9],statistikOrganisasi[b][10],statistikOrganisasi[b][11],statistikOrganisasi[b][12]);
			}
			for(var b=0; b < statistikKursi.length; b++)
			{
				// prov_nama, icon, lat, lng, dapil_t1, dapil_t2, dapil_t3, kursi_t1, kursi_t2, kursi_t3, kursi_t1_ada, kursi_t2_ada, kursi_t3_ada
				addMarkerStatistikKursi(statistikKursi[b][0],"{{ asset('asset/icon/user-black-orange2.png') }}",statistikKursi[b][1],statistikKursi[b][2],statistikKursi[b][3],statistikKursi[b][4],statistikKursi[b][5],statistikKursi[b][6],statistikKursi[b][7],statistikKursi[b][8],statistikKursi[b][9],statistikKursi[b][10],statistikKursi[b][11]);
			}
		});

		var legend = document.getElementById('legend');
		map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
		google.maps.event.addDomListener(window, "resize", function() {
			var center = map.getCenter();
			google.maps.event.trigger(map, "resize");
			map.setCenter(center);
		});

	}

	// Add Marker Statistik Organisasi
	function addMarkerStatistikOrganisasi(address, icon, lats ,lngs,pimcab,pimcam,ranting,anak_ranting,kpa,pimcab_ada,pimcam_ada,ranting_ada,anak_ranting_ada,kpa_ada){
		var over =
		'<div id="content">'+
		'</div>'+
		'<div id="bodyContent" style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
		'<div class="top" style="border-bottom:2px solid #f39c12;">'+address+'</div>'+
		'<table style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
			'<tr>'+
			'<td>PIMCAB</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+pimcab_ada+'/<b>'+pimcab+'</b>  ('+getPercent(pimcab_ada,pimcab)+' %)</td>'+
			'</tr>'+
			'<tr>'+
			'<td>PIMCAM</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+pimcam_ada+'/<b>'+pimcam+'</b>  ('+getPercent(pimcam_ada,pimcam)+' %)</td>'+
			'</tr>'+
			'<tr>'+
			'<td>Ranting</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+ranting_ada+'/<b>'+ranting+'</b>  ('+getPercent(ranting_ada,ranting)+' %)</td>'+
			'</tr>'+
			'<tr>'+
			'<td>Anak Ranting</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+anak_ranting_ada+'/<b>'+anak_ranting+'</b>  ('+getPercent(anak_ranting_ada,anak_ranting)+' %)</td>'+
			'</tr>'+
			'<tr>'+
			'<td>KPA</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+kpa_ada+'/<b>'+kpa+'</b>  ('+getPercent(kpa_ada,kpa)+' %)</td>'+
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
		marker_statistik_organisasi.push(marker2);
		setStatistikOrganisasi(null);
	}

	// Add Marker Statistik Kursi
	function addMarkerStatistikKursi(address, icon, lats ,lngs,dapil_t1,dapil_t2,dapil_t3,kursi_t1,kursi_t2,kursi_t3,kursi_t1_ada,kursi_t2_ada,kursi_t3_ada){
		var over =
		'<div id="content">'+
		'</div>'+
		'<div id="bodyContent" style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
		'<div class="top" style="border-bottom:2px solid #f39c12;">'+address+'</div>'+
		'<table style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
			'<tr>'+
				'<td>DPR-RI</td>'+
				'<td  style="width:10px; text-align:center;">:</td>'+
				'<td>'+dapil_t1+' Dapil</td>'+
			'</tr>'+
			'<tr>'+
				'<td></td>'+
				'<td></td>'+
				'<td>'+kursi_t1_ada+'/<b>'+kursi_t1+'</b>  ('+getPercent(kursi_t1_ada,kursi_t1)+' %) Kursi</td>'+
			'</tr>'+
			'<tr>'+
				'<td>DPRD I</td>'+
				'<td  style="width:10px; text-align:center;">:</td>'+
				'<td>'+dapil_t2+' Dapil</td>'+
			'</tr>'+
			'<tr>'+
				'<td></td>'+
				'<td></td>'+
				'<td>'+kursi_t2_ada+'/<b>'+kursi_t2+'</b>  ('+getPercent(kursi_t2_ada,kursi_t2)+' %) Kursi</td>'+
			'</tr>'+
			'<tr>'+
				'<td>DPRD II</td>'+
				'<td  style="width:10px; text-align:center;">:</td>'+
				'<td>'+dapil_t3+' Dapil</td>'+
			'</tr>'+
			'<tr>'+
				'<td></td>'+
				'<td></td>'+
				'<td>'+kursi_t3_ada+'/<b>'+kursi_t3+'</b>  ('+getPercent(kursi_t3_ada,kursi_t3)+' %) Kursi</td>'+
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
		marker_statistik_kursi.push(marker2);
		setStatistikKursi(null);
	}


	// Add Marker DPD
	function addMarkerDPD(address, icon, name, email, telephone, i,type, lats ,lngs,bioId, sk){
		var telp = '';
		if( telephone != ''){
			telp = telephone;
		} else {
			telp = "-";
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
			'<td>No. SK</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+sk+'</td>'+
			'</tr>'+
			'<tr>'+
			'<td>No Telp</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+telp+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td colspan="3"><div data-toggle="tooltip" data-placement="top" title="Lihat SK" class="btn btn-danger pull-right" onclick="goToData(`DPD`,`'+address+'`)"><i class="fa fa-info-circle"></i></div></td>'+
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

	// Add Marker pimcab
	function addMarkerpimcab(address, icon, name, email, telephone, i,lokasi, type, lats ,lngs, bioId, sk, provinsi){
		var telp = '';
		  if( telephone != ''){
			telp = telephone;
		  } else {
			telp = "-";
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
			'<td>No. SK</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+sk+'</td>'+
			'</tr>'+
			'<tr>'+
			'<td>No Telp</td>'+
			'<td  style="width:10px; text-align:center;">:</td>'+
			'<td>'+telp+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td colspan="3"><div data-toggle="tooltip" data-placement="top" title="Lihat SK" class="btn btn-danger pull-right" onclick="goToData(`pimcab`,`'+provinsi+'`,`'+lokasi+'`)"><i class="fa fa-info-circle"></i></div></td>'+
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
		marker_pimcab.push(marker3);
	}

	/* Marker Pendudk */
		// Provinsi
		function addMarkerPenduduk(icon, name, lats ,lngs, type, jumlahPenduduk){
			  var over =
			  '<div id="content">'+
			  '</div>'+
			  '<div id="bodyContent" style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
			  '<div class="top" style="border-bottom:2px solid #f39c12;">'+name+'</div>'+
			  '<table style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
				'<tr>'+
				'<td>Penduduk</td>'+
				'<td  style="width:10px; text-align:center;">:</td>'+
				'<td>'+jumlahPenduduk+' Jiwa</td>'+
				'</tr>'+
			  '</table>'+
			  '</div>'+
			  '</div>';

			infowindowover = new google.maps.InfoWindow();

			var marpenprov = new google.maps.Marker({
				map: map,
				icon : icon,
				title : name,
				position: {lat:lats, lng:lngs}
			});
			google.maps.event.addListener(marpenprov, 'click', infoCallback(over, marpenprov));
			marker_penduduk_provinsi.push(marpenprov);
		}

		// Kabupaten
		function addMarkerKabupaten(icon, name, lats ,lngs, type, jumlahPenduduk){
			  var over =
			  '<div id="content">'+
			  '</div>'+
			  '<div id="bodyContent" style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
			  '<div class="top" style="border-bottom:2px solid #f39c12;">'+name+'</div>'+
			  '<table style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
				'<tr>'+
				'<td>Penduduk</td>'+
				'<td  style="width:10px; text-align:center;">:</td>'+
				'<td>'+jumlahPenduduk+' Jiwa</td>'+
				'</tr>'+
			  '</table>'+
			  '</div>'+
			  '</div>';

			infowindowover = new google.maps.InfoWindow();

			var marpenkab = new google.maps.Marker({
				map: map,
				icon : icon,
				title : name,
				position: {lat:lats, lng:lngs}
			});
			google.maps.event.addListener(marpenkab, 'click', infoCallback(over, marpenkab));
			marker_penduduk_kabupaten.push(marpenkab);
		}
	/* /.Marker Penduduk */

	/* Marker Kursi */
		function addMarkerKursi(icon, name, lats , lngs, jenis, dataAnggota){
			var over =
			  '<div id="bodyContent" style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
				'<div class="top" style="border-bottom:2px solid #f39c12;">'+name+' ('+dataAnggota.length+')</div>'+
				'<table style="font-weight: 300; line-height: 20px; font-size: 13px;">';
					for(var a=0; a < dataAnggota.length; a++)
					{
						over += '<tr>'+
							'<td  style="width:10px; text-align:center;">'+(a+1)+'.</td>'+
							'<td>'+dataAnggota[a]['nama']+'</td>'+
						'</tr>';
					}
			over +=	'</table>'+
			  '</div>';

			infowindowover = new google.maps.InfoWindow();

			var markur = new google.maps.Marker({
				map: map,
				icon : icon,
				title : name,
				position: {lat:lats, lng:lngs}
			});
			google.maps.event.addListener(markur, 'click', infoCallback(over, markur));
			if(jenis == 'dprri') {
				marker_kursi_dprri.push(markur);
			} else if(jenis == 'dprdi') {
				marker_kursi_dprdi.push(markur);
			} else if(jenis == 'dprdii') {
				marker_kursi_dprdii.push(markur);
			}
		}
	/* /.Marker Dapil */

	/* Marker Pilkada */
		function addMarkerPilkada(icon, name, lats , lngs, jenis, jenis2, dataAnggota){

			var over =
			  '<div id="bodyContent" style="font-weight: 300; line-height: 20px; font-size: 13px;">'+
				'<div class="top" style="border-bottom:2px solid #f39c12;">'+jenis2+' '+name+' ('+dataAnggota.length+')</div>'+
				'<table style="font-weight: 300; line-height: 20px; font-size: 13px;">';
					for(var a=0; a < dataAnggota.length; a++)
					{
						over += '<tr>'+
							'<td  style="width:10px; text-align:center;">'+(a+1)+'.</td>'+
							'<td>'+dataAnggota[a]['nama']+'</td>'+
						'</tr>';
					}
			over +=	'</table>'+
			  '</div>';

			infowindowover = new google.maps.InfoWindow();

			var markers = new google.maps.Marker({
				map: map,
				icon : icon,
				title : name,
				position: {lat:lats, lng:lngs}
			});
			google.maps.event.addListener(markers, 'click', infoCallback(over, markers));
			if(jenis == 'gubernur') {
				marker_pilkada_gubernur.push(markers);
			} else if(jenis == 'bupati') {
				marker_pilkada_bupati.push(markers);
			} else if(jenis == 'walikota') {
				marker_pilkada_walikota.push(markers);
			} else if(jenis == 'all'){
				marker_pilkada.push(markers);
			}
		}
	/* /.Marker Pilkada */

	function infoCallback(over, marker) {
	  return function() {
		infowindowover.close();
		// update the content of the infowindow before opening it
		infowindowover.setContent(over)
		infowindowover.open(map, marker);

	  };
	}
	function setStatistikOrganisasi(map) {
        for (var i1 = 0; i1 < marker_statistik_organisasi.length; i1++) {
          marker_statistik_organisasi[i1].setMap(map);
        }
    }
	function setStatistikKursi(map) {
        for (var i1 = 0; i1 < marker_statistik_kursi.length; i1++) {
          marker_statistik_kursi[i1].setMap(map);
        }
    }
	function setpimcab(map) {
        for (var i3 = 0; i3 < marker_pimcab.length; i3++) {
          marker_pimcab[i3].setMap(map);
        }
    }
    function setDPD(map) {
    	for (var i2 = 0; i2 < marker_dpd.length; i2++) {
          	marker_dpd[i2].setMap(map);
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

	function setPenProv(map) {
        for (var i8 = 0; i8 < marker_penduduk_provinsi.length; i8++) {
          marker_penduduk_provinsi[i8].setMap(map);
        }
    }
	function setPenKab(map) {
        for (var i9 = 0; i9 < marker_penduduk_kabupaten.length; i9++) {
          marker_penduduk_kabupaten[i9].setMap(map);
        }
    }

	function setKursiDPRRI(map) {
        for (var i10 = 0; i10 < marker_kursi_dprri.length; i10++) {
          marker_kursi_dprri[i10].setMap(map);
        }
    }
	function setKursiDPRDI(map) {
        for (var i11 = 0; i11 < marker_kursi_dprdi.length; i11++) {
          marker_kursi_dprdi[i11].setMap(map);
        }
    }
	function setKursiDPRDII(map) {
        for (var i12 = 0; i12 < marker_kursi_dprdii.length; i12++) {
          marker_kursi_dprdii[i12].setMap(map);
        }
    }
    function setPilkadaGub(map) {
        for (var i13 = 0; i13 < marker_pilkada_gubernur.length; i13++) {
          marker_pilkada_gubernur[i13].setMap(map);
        }
    }
    function setPilkadaBup(map) {
        for (var i14 = 0; i14 < marker_pilkada_bupati.length; i14++) {
          marker_pilkada_bupati[i14].setMap(map);
        }
    }
    function setPilkadaWal(map) {
        for (var i15 = 0; i15 < marker_pilkada_walikota.length; i15++) {
          marker_pilkada_walikota[i15].setMap(map);
        }
    }
    function setPilkada(map) {
        for (var i16 = 0; i16 < marker_pilkada.length; i16++) {
          marker_pilkada[i16].setMap(map);
        }
    }

	function hideAllMarker()
	{
    	setDPD(null);
    	setpimcab(null);
		setGub(null);
    	setBup(null);
    	setWal(null);
		setStatistikOrganisasi(null);
		setStatistikKursi(null);
		setPenProv(null);
		setPenKab(null);
		setKursiDPRRI(null);
		setKursiDPRDI(null);
		setKursiDPRDII(null);
		setPilkadaGub(null);
		setPilkadaBup(null);
		setPilkadaWal(null);
		setPilkada(null);
	}

    function showStatistik(jenis) {
		hideAllMarker();
		if(jenis == 'getData') {
			setStatistikOrganisasi(map);
			setStatistikKursi(null);
		} else if(jenis == 'statistikOrganisasi') {
			setStatistikOrganisasi(map);
			setStatistikKursi(null);
		} else if(jenis == 'statistikKusri') {
			setStatistikOrganisasi(null);
			setStatistikKursi(map);
		}
    	$('#response-filter').fadeOut(100);
		addOptionActive(jenis);
    }

    function showAgenda(jenis) {
		hideAllMarker();
		if(jenis == 'getData') {
			setStatistikOrganisasi(map);
			setStatistikKursi(null);
		} else if(jenis == 'pilkada') {
			setStatistikOrganisasi(map);
			setStatistikKursi(null);
		}
    	$('#response-filter').fadeOut(100);
		addOptionActive(jenis);
    }

    function showPilkadaAll(jenis) {
		hideAllMarker();
		var gubernur, bupati,walikota, statusData;
		if(marker_pilkada.length != 0 ){

			setPilkada(map);
			status = 'ada';
		} else {
			$.ajax({
				url     : '{{asset("get/data/pilkada/gubernur")}}',
				type    : 'get',
				data    : {jenis: jenis},
				dataType: 'html',
				success : function(res) {
					statusData = 'sudahAda';
					gubernur = JSON.parse(res);
					for(var a=0; a < gubernur.length; a++)
					{
						addMarkerPilkada("{{ asset('asset/icon/user-red-orange.png') }}",gubernur[a][0],gubernur[a][1],gubernur[a][2],"gubernur","Pilkada Gubernur",gubernur[a][3]);

					}
				}
			}).done(function(){
			});

			$.ajax({
				url     : '{{asset("get/data/pilkada/bupati")}}',
				type    : 'get',
				data    : {jenis: jenis},
				dataType: 'html',
				success : function(res) {
					statusData = 'sudahAda';
					bupati = JSON.parse(res);
					for(var a=0; a < bupati.length; a++)
					{
						addMarkerPilkada("{{ asset('asset/icon/user-purple-orange.png') }}",bupati[a][0],bupati[a][1],bupati[a][2],"bupati","Pilkada Bupati",bupati[a][3]);
					}
				}
			}).done(function(){
			});

			$.ajax({
				url     : '{{asset("get/data/pilkada/walikota")}}',
				type    : 'get',
				data    : {jenis: jenis},
				dataType: 'html',
				success : function(res) {
					statusData = 'sudahAda';
					walikota = JSON.parse(res);
					for(var a=0; a < walikota.length; a++)
					{
						addMarkerPilkada("{{ asset('asset/icon/user-orange.png') }}",walikota[a][0],walikota[a][1],walikota[a][2],"walikota","Pilkada Walikota",walikota[a][3]);
					}
				}
			}).done(function(){
			});
		}
		addOptionActive(jenis);
    }

	function showStatistikKursi(jenis)
	{
		$('#responseKursi1').removeClass('activeKursiLi');
		$('#responseKursi2').removeClass('activeKursiLi');
		$('#responseKursi3').removeClass('activeKursiLi');
		$('.responseKursi'+jenis).addClass('activeKursiLi');
		hideAllMarker();
		var status = 'tidak_ada';
		var icon = '{{ asset("asset/icon/user-yellow.png") }}';
		if(jenis == 'dprri') {
			if(marker_kursi_dprri.length != 0){
				setKursiDPRRI(map);
				status = 'ada';
			}
			icon = '{{ asset("asset/icon/user-red-orange.png") }}';
		} else if(jenis == 'dprdi') {
			if(marker_kursi_dprdi.length != 0){
				setKursiDPRDI(map);
				status = 'ada';
			}
			icon = '{{ asset("asset/icon/user-purple-orange.png") }}';
		} else if(jenis == 'dprdii') {
			if(marker_kursi_dprdii.length != 0){
				setKursiDPRDII(map);
				status = 'ada';
			}
			icon = '{{ asset("asset/icon/user-orange.png") }}';
		}

		if(status == 'tidak_ada') {
			$.ajax({
				url     : '{{asset("get/data/kursi")}}/'+jenis,
				type    : 'get',
				data    : {jenis: jenis},
				dataType: 'html',
				success : function(res) {
					statusData = 'sudahAda';
					dataKursi = JSON.parse(res);
					for(var a=0; a < dataKursi.length; a++)
					{
						addMarkerKursi(icon,dataKursi[a][0],dataKursi[a][1],dataKursi[a][2],jenis,dataKursi[a][3]);
					}
				}
			}).done(function(){
			});
		}
	}

	function showPilkada(jenis){
		$('#responsePilkada1').removeClass('activeKursiLi');
		$('#responsePilkada2').removeClass('activeKursiLi');
		$('#responsePilkada3').removeClass('activeKursiLi');
		$('.responsePilkada'+jenis).addClass('activeKursiLi');
		hideAllMarker();
		var status = 'tidak_ada';
		var icon = '{{ asset("asset/icon/user-yellow.png") }}';
		var jenis2 = 'Pilkada'
		if(jenis == 'gubernur') {
			if(marker_pilkada_gubernur.length != 0){
				setPilkadaGub(map);
				setPilkadaBup(null);
				setPilkadaWal(null);
				status = 'ada';
			}
			icon = '{{ asset("asset/icon/user-red-orange.png") }}';
			jenis2 = 'Pilkada Gubernur';
		} else if(jenis == 'bupati') {
			if(marker_pilkada_bupati.length != 0){
				setPilkadaGub(null);
				setPilkadaBup(map);
				setPilkadaWal(null);
				status = 'ada';
			}
			icon = '{{ asset("asset/icon/user-purple-orange.png") }}';
			jenis2 = 'Pilkada Bupati';
		} else if(jenis == 'walikota') {
			if(marker_pilkada_walikota.length != 0){
				setPilkadaGub(null);
				setPilkadaBup(null);
				setPilkadaWal(map);
				status = 'ada';
			}
			icon = '{{ asset("asset/icon/user-orange.png") }}';
			jenis2 = 'Pilkada Walikota';
		}

		if(status == 'tidak_ada') {
			$.ajax({
				url     : '{{asset("get/data/pilkada")}}/'+jenis,
				type    : 'get',
				data    : {jenis: jenis},
				dataType: 'html',
				success : function(res) {
					statusData = 'sudahAda';
					dataPilkada = JSON.parse(res);
					for(var a=0; a < dataPilkada.length; a++)
					{
						addMarkerPilkada(icon,dataPilkada[a][0],dataPilkada[a][1],dataPilkada[a][2],jenis,jenis2,dataPilkada[a][3]);
					}
				}
			}).done(function(){
			});

		}
	}

    function showDPD(jenis) {
    	setStatistikOrganisasi(null);
    	setStatistikKursi(null);
    	setDPD(map);
    	setpimcab(null);
		setGub(null);
    	setBup(null);
    	setWal(null);
		setPenProv(null);
		setPenKab(null);
    	$('#response-filter').fadeOut(100);
		addOptionActive(jenis);
    }

	function showpimcab(jenis) {
    	setStatistikOrganisasi(null);
    	setStatistikKursi(null);
    	setDPD(null);
    	setpimcab(map);
		setGub(null);
    	setBup(null);
    	setWal(null);
		setPenProv(null);
		setPenKab(null);
    	$('#response-filter').fadeOut(100);
		addOptionActive(jenis);
	}

	function showPenduduk(jenis) {
		setDPD(null);
		setpimcab(null);
		setGub(null);
		setBup(null);
		setWal(null);
		setStatistikOrganisasi(null);
		setStatistikKursi(null);

		if(jenis == 'getData'){
			var provinsi, kabupaten, statusData;
			if(marker_penduduk_provinsi.length != 0){
				setPenProv(map);
				setPenKab(map);
			} else {
				$.ajax({
					url     : '{{asset("get/data/penduduk/provinsi")}}',
					type    : 'get',
					data    : {jenis: jenis},
					dataType: 'html',
					success : function(res) {
						statusData = 'sudahAda';
						provinsi = JSON.parse(res);
						for(var a=0; a < provinsi.length; a++)
						{
							addMarkerPenduduk("{{ asset('asset/icon/user-orange.png') }}",provinsi[a][0],provinsi[a][1],provinsi[a][2],"Provinsi",provinsi[a][3]);
							console.log("{{ asset('asset/icon/user-orange.png') }}",provinsi[a][0],provinsi[a][1],provinsi[a][2],"Provinsi",provinsi[a][3]);
						}
						/* $('#legend .box-body').html(provinsi); */
					}
				}).done(function(){

				});

				$.ajax({
					url     : '{{asset("get/data/penduduk/kabupaten")}}',
					type    : 'get',
					data    : {jenis: jenis},
					dataType: 'html',
					success : function(res) {
						statusData = 'sudahAda';
						kabupaten = JSON.parse(res);
						for(var a=0; a < kabupaten.length; a++)
						{
							addMarkerKabupaten("{{ asset('asset/icon/user-yellow.png') }}",kabupaten[a][0]+','+kabupaten[a][1],kabupaten[a][2],kabupaten[a][3],"Kabupaten",kabupaten[a][4]);
							console.log("{{ asset('asset/icon/user-yellow.png') }}",kabupaten[a][0]+','+kabupaten[a][1],kabupaten[a][2],kabupaten[a][3],"Kabupaten",kabupaten[a][4]);
						}
						/* $('#legend .box-body').html(provinsi); */
					}
				}).done(function(){

				});
			}
		} else {
			if(jenis == 'pendudukProvinsi'){
				setPenProv(map);
				setPenKab(null);
			} else if(jenis == 'pendudukKabupaten'){

				setPenProv(null);
				setPenKab(map);
			}
			addOptionActive(jenis);
		}
	}

    function showDPDpimcab(jenis) {
    	setStatistikOrganisasi(null);
    	setStatistikKursi(null);
    	setDPD(map);
    	setpimcab(map);
		setGub(null);
    	setBup(null);
    	setWal(null);
		setPenProv(null);
		setPenKab(null);
    	$('#response-filter').fadeOut(100);
		addOptionActive(jenis);
    }

	function showSuara(jenis){
    	setStatistikOrganisasi(null);
    	setStatistikKursi(null);
    	setDPD(null);
    	setpimcab(null);
		setGub(map);
    	setBup(map);
    	setWal(map);
		setPenProv(null);
		setPenKab(null);
    	$('#response-filter').fadeOut(100);
		addOptionActive(jenis);
	}

    function showAwal() {
    	setStatistikOrganisasi(null);
    	setStatistikKursi(null);
    	setDPD(map);
    	setpimcab(map);
		setGub(null);
    	setBup(null);
    	setWal(null);
		setPenProv(null);
		setPenKab(null);
    	$('#response-filter').fadeOut(100);
    }

	function addOptionActive(jenis){
		$('li>a.optionActive').removeClass('optionActive');
		$('#'+jenis).addClass('optionActive');
	}

	function getPercent(val1,val2) {

			var per = val1/val2*100;
			if (isNaN(per)) {
				return 0;
			}

		return per.toFixed(2);
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxeGtu0YWo5Os_0YPSe9oagQoYrjlCnUE&libraries=places&callback=initAutocomplete" async defer></script>
