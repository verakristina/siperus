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
            categories: [<?php echo $dates; ?>],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Kursi'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			headerFormat: '<span style="font-size:20px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y:f}</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			series: {
				pointPadding: 0.3,
				borderWidth: 0,
				dataLabels: {
					enabled: true,
				}
			}
		}<?php echo $data_series; ?>
	});
</script>