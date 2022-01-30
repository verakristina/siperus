$('.autocomplete').keyup(function() {
	$('.show-result').fadeIn(100);
	var strParam = $(this).attr('id');
	var cari = $(this).val();
	$.ajax({
		url 	: '../proses/cari/balon/'+strParam,
		type 	: 'get',
		data 	: {cari:cari},
		dataType: 'html',
		success : function(data)
		{
			$('.show-result').html(data);
		}
	});
});
$('#nama').focusin(function() {
	$('.show-result').show();
	$(this).attr('autocomplete','off');
});
$('#nama').focusout(function() {
	$('.show-result').fadeOut();
	$(this).attr('autocomplete','off');
});
$('#cariBalon').keyup(function() {
	var cari = $(this).val();
	$.ajax({
		url 	: 'cari/balon',
		type 	: 'get',
		data 	: {cari:cari},
		dataType: 'html',
		success : function(data) {
			$('.response-cari').html(data);
		}
	});
});
$('#cariDPD').keyup(function() {
	var cari = $(this).val();
	$.ajax({
		url 	: 'cari/DPD',
		type 	: 'get',
		data 	: {cari:cari},
		dataType: 'html',
		success : function(data) {
			$('.response-cari').html(data);
		}
	});
});
$('#filter').change(function() {
	var filter = $(this).val();
	if(filter != "")
	{
		window.location.href="dashboard?filter="+filter;
	} else {
		window.location.href="dashboard";
	}
});
$('#nama').keyup(function() {
	var cari = $(this).val();
	var kontak = $('#id_pilihan').val();
	var provinsi = $('#provinsi').val();
	var kabupaten = $('#kabupaten').val();
	$.ajax({
		url 	: '/calon/complaine/cari/dpc',
		type 	: 'get',
		data 	: {cari:cari,kontak:kontak,provinsi:provinsi,kabupaten:kabupaten},
		dataType: 'html',
		success : function(data){
			$('.show-result').html(data);
		}
	});
});
$('#caleg-filter').change(function() {
	var caleg = $(this).val();
	$.ajax({
		url 	: 'filter-caleg',
		data 	: {caleg:caleg},
		success : function(data)
		{
			$('.response-maps').html(data);
		}
	});
});