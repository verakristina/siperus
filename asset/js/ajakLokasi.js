var optKecamatan = '<option value="">--- Pilih Kecamatan ---</option>';
var optKelurahan = '<option value="">--- Pilih Kelurahan ---</option>';
var optKabKota = '<div class="col-sm-5"><select name="kab_kota" id="kab_kota" class="form-control"><option value="">--- Kabupaten / Kota </option></select></div>';
$("#daerah").change(function(){
	var opt = $(this).val();
	if(opt == 'kabkota')
	{
		$('.show-kabupaten').html(optKabKota);
	} else {
		$('.show-kabupaten').html(' ');
	}
});
$('#provinsi').change(function() {
	var provinsi = $(this).val();
	$.ajax({
		url 	: '/pilkada2017/ajax/lokasi/provinsi',
		type 	: 'get',
		data 	: {provinsi:provinsi},
		dataType: 'html',
		success : function(data){
			$('#kabupaten').html(data);
			$('#kecamatan').html(optKecamatan);
			$('#kelurahan').html(optKelurahan);
		}
	});
});
$('#kecamatan').change(function() {
	var provinsi = $('#provinsi').val();
	var kab_kota = $('#kab_kota').val();
	var kecamatan= $(this).val();
	$.ajax({
		url 	: 'ajax/lokasi/kecamatan',
		type 	: 'get',
		data 	: {provinsi : provinsi, kab_kota : kab_kota, kecamatan : kecamatan},
		dataType: 'html',
		success : function(data) {
			$('#kelurahan').html(data);
		}
	});
});
$('#kelurahan').change(function() {
	var provinsi = $('#provinsi').val();
	var kab_kota = $('#kab_kota').val();
	var kecamatan= $('#kecamatan').val();
	var kelurahan = $(this).val();
	$.ajax({
		url 	: '/pilkada2017/ajax/lokasi/kelurahan',
		type 	: 'get',
		data 	: {provinsi : provinsi, kab_kota : kab_kota, kecamatan : kecamatan, kelurahan : kelurahan},
		dataType: 'html',
		success : function(data) {
			$('.header-content').html(data);
		}
	});
});
$('#caleg').change(function() {
	var caleg = $(this).val();
	$.ajax({
		url 	: '../../case/caleg',
		data 	: {caleg:caleg},
		success : function(data) {
			$('.response-caleg').html(data);
		}
	});
});
$('#indentitas').keyup(function() {
	var ident = $(this).val();
	$.ajax({
		url 	: '../case/indentitas',
		data 	: {ident : ident},
		success : function(data) {
			$('.response-jenis').html(data);
		}
	});
});
$('#case').change(function() {
	var pilihan = $(this).val();
	$.ajax({
		url 	: 'case-menu',
		data 	: {case:pilihan},
		dataType: 'html',
		success : function(data) {
			$('.response-maps').html(data);
		}
	});
});/*
$('#cari').keyup(function() {
	var cari = $(this).val();
	var case = $('#case').val();
	$.ajax({
		url 	: 'cari-data',
		data 	: {cari:cari, case:case},
		dataType: 'html',
		success : function(data) {
			$('.response-maps').html(data);
		}
	});
});*/