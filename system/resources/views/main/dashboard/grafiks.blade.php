<div id="containers" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script>
	Highcharts.chart('containers', {
		chart: {
			style:{
				fontFamily: 'Roboto'
			},
			type: 'column'
		},
		credits: {
			enabled: false
		},
		exporting: { 
			enabled: false 
		},
		title: {
			text: ''
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			categories: [<?php echo $datas; ?>],            
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Master Data'
			}
		},
		legend: {
			enabled: false
		},
		plotOptions: {
			series: {
				pointPadding: 0.3,
				borderWidth: 0,
				dataLabels: {
					enabled: true,
				}
			}
		},

		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span><b>{point.y:.0f}</b><br/>'
		}<?php echo $data_series; ?>
	});
</script>