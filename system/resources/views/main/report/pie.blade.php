
<div id="canvasGrafik" style="padding:10px;">
	<center><h3 class="no-margin">{{ strtoupper($jenis) }} {{ $namaDaerah }}</h3></center>
	<div id="containerPie" style="min-width: 100%; height: 180px; margin: 0 auto"></div>
</div>


<script type="text/javascript">
	Highcharts.chart('containerPie', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			backgroundColor: 'rgba(255, 255, 255,0)'
		},
		credits: {
			enabled : false
		},
		title: {
			text: false
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.y}</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: false,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.y}',
					style: {
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
					}
				}
			}
		}<?php echo $dataSeries; ?>
	});
</script>