<?php
	if($type == 'provinsi'){
		$jenisGarfik = 'PIMDA';
		$struktur = 'PIMDA ('.$dataProvPer.'%)';
	} else if($type == 'kabupaten'){
		$jenisGarfik = 'PIMCAB';
		$struktur = 'PIMCAB ('.$dataKabPer.'%)';
	} else if($type == 'kecamatan'){
		$jenisGarfik = 'PIMCAM';
		$struktur = 'PIMCAM ('.$dataKecPer.'%)';
	} else if($type == 'kelurahan'){
		$jenisGarfik = 'PIMRAN';
		$struktur = 'PIMRAN ('.$dataKelPer.'%)';
	} else if($type == 'rw'){
		$jenisGarfik = 'PAR';
		$struktur = 'PAR ('.$dataRwPer.'%)';
	} else if($type == 'rt'){
		$jenisGarfik = 'KPA';
		$struktur = 'KPA ('.$dataRtPer.'%)';
	} else if($type == 'dprri'){
		$jenisGarfik = 'DPR-RI';
		$struktur = 'DPR-RI ('.$dataDprriPer.'%)';
	} else if($type == 'dprdi'){
		$jenisGarfik = 'DPRD I';
		$struktur = 'DPRD I ('.$dataDprdiPer.'%)';
	} else if($type == 'dprdii'){
		$jenisGarfik = 'DPRD II';
		$struktur = 'DPRD II ('.$dataDprdiiPer.'%)';
	} else {
		$stuktur = '';		
	}
?>


<div id="containerLine{{ $type }}" style="min-width: 100%; height: 205px; margin: 0 auto"></div>

<script type="text/javascript">
var datas = '';
$(function () {
	
	Highcharts.setOptions({
		lang: {
			decimalPoint: ',',
            thousandsSep: '.'
		}
	});
    $('#containerLine{{ $type }}').highcharts({
		chart: {
			type: 'column',
			backgroundColor: 'rgba(255, 255, 255,0)'
		},
		title: {
			text: 'DATA {{ strtoupper($struktur) }}'
		},
		credits: {
			enabled : false
		}, 
		xAxis: {     
			categories: [
				'DATA {{ strtoupper($struktur) }}'
			],
			crosshair: true
		},
		tooltip: {
			yDecimals: 2 // If you want to add 2 decimals
		},
		yAxis: {
			min: 0,
			title: {
				text: false
			}
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true,
					format: '{point.y:f}'
				},
				cursor: 'pointer',
				events: {
					click: function (event) {
						var seriesName = this.name;
						if(seriesName.toLowerCase() != '{{ strtolower($type) }}') {
							var prov = $('#prov').val();
							window.location.href = '{{ asset("dashboard/table") }}/{{ $type }}/'+prov;
							
						/* 	$.ajax({
								url     : '{{ asset("dashboard/get/grafik-table") }}/'+prov+'/{{ $type }}',
								type    : 'get',
								data    : '',
								dataType: 'html',
								success : function(response) {
									$('#my-modal-label').html('DATA GRAFIK {{ $jenisGarfik }}');
									$('#modal-grafik').modal('show');
									$('#tabel-grafik').html(response);
								}
							}); */
						} else {
							//alert('Bukan yang ini');
						}
					}
				}
			}
		}<?php echo $dataSeries; ?>
	});
	var datas1 = $('#containerLine{{ $type }} .highcharts-series-0 .highcharts-data-label text tspan').html();
	var datas2 = $('#containerLine{{ $type }} .highcharts-series-1 .highcharts-data-label text tspan').html();
	$('#containerLine{{ $type }} .highcharts-series-0 .highcharts-data-label text tspan').html(parseInt(datas1).toLocaleString('id'));
	$('#containerLine{{ $type }} .highcharts-series-1 .highcharts-data-label text tspan').html(parseInt(datas2).toLocaleString('id'));
});

function getPosts(urls,jenis) {
	var prov = $('#prov').val();
	$.ajax({
		url		: urls,
		type    : 'get',
		data    : '',
		dataType: 'html',
		success : function(response) {
			$('#tabel-grafik').html(response);
		}
	});
}
</script>