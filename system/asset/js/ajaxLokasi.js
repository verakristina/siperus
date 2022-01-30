var base_url = '/pusdatin_v3/';

$('#daftarRiwayatHidup').click(function() {
	if ($(this).is(':checked')) { $('#filedaftarRiwayatHidup').removeAttr('disabled'); } else { $('#filedaftarRiwayatHidup').attr('disabled', 'disabled'); }
});
$('#visiMisi').click(function() {
	if ($(this).is(':checked')) { $('#filevisiMisi').removeAttr('disabled'); } else { $('#filevisiMisi').attr('disabled', 'disabled'); }
});
$('#fotoCopyKtp').click(function() {
	if ($(this).is(':checked')) { $('#filefotoCopyKtp').removeAttr('disabled'); } else { $('#filefotoCopyKtp').attr('disabled', 'disabled'); }
});
$('#fotoCopyKk').click(function() {
	if ($(this).is(':checked')) { $('#filefotoCopyKk').removeAttr('disabled'); } else { $('#filefotoCopyKk').attr('disabled', 'disabled'); }
});
$('#fotoCopyNpwp').click(function() {
	if ($(this).is(':checked')) { $('#filefotoCopyNpwp').removeAttr('disabled'); } else { $('#filefotoCopyNpwp').attr('disabled', 'disabled'); }
});
$('#fotoCopyIjazah').click(function() {
	if ($(this).is(':checked')) { $('#filefotoCopyIjazah').removeAttr('disabled'); } else { $('#filefotoCopyIjazah').attr('disabled', 'disabled'); }
});
$('#skcs').click(function() {
	if ($(this).is(':checked')) { $('#fileskcs').removeAttr('disabled'); } else { $('#fileskcs').attr('disabled', 'disabled'); }
});
$('#ktaPartaiHanura').click(function() {
	if ($(this).is(':checked')) { $('#filektaPartaiHanura').removeAttr('disabled');	} else { $('#filektaPartaiHanura').attr('disabled', 'disabled'); }
});
$('#formPendaftaranCalon').click(function() {
	if ($(this).is(':checked')) { $('#fileformPendaftaranCalon').removeAttr('disabled'); } else { $('#fileformPendaftaranCalon').attr('disabled', 'disabled'); }
});
$('#komitmen').click(function() {
	if ($(this).is(':checked')) { $('#filekomitmen').removeAttr('disabled'); } else { $('#filekomitmen').attr('disabled', 'disabled'); }
});
$('#bertaqwa').click(function() {
	if ($(this).is(':checked')) { $('#filebertaqwa').removeAttr('disabled'); } else { $('#filebertaqwa').attr('disabled', 'disabled'); }
});
$('#tinggal').click(function() {
	if ($(this).is(':checked')) { $('#filetinggal').removeAttr('disabled');	} else { $('#filetinggal').attr('disabled', 'disabled'); }
});
$('#kaderYa').click(function() {
	if ($(this).is(':checked')) { $('#kaderTidak').removeAttr('checked'); $('#responseKader').slideDown(200); } else { $('#kaderYa').attr('checked', 'checked'); $('#responseKader').slideUp(200); }
});
$('#kaderTidak').click(function() {
	if ($(this).is(':checked')) { $('#kaderYa').removeAttr('checked'); $('#responseKader').slideUp(200); } else { $('#kaderTidak').attr('checked', 'checked');  $('#responseKader').slideUp(200);}
});

/*Deklasi Variable*/
var x 	= 1;
var y 	= 1;
var z 	= 1;
var a 	= 1;
var b 	= 1;
var c 	= 1;
/*End Deklarasi*/

/*Script Add Riwayat Pendidikan*/
var wrapper_pendidikan = $('#pendidikan');
var btn_pendidikan = $('#add_pendidikan');

$(btn_pendidikan).click(function() {
	x++;
	var append_pendidikan = 
	'<content>'+
		'<div class="form-inline closer_pendidikan'+x+' xs-border-bottom" role="form" style="width: 100%;padding: 5px;" id="form_pendidikan">'+
	        '<div class="row">'+
	        	'<div class="form-group col-md-2 col-sm-4">'+
					'<input type="text" class="form-control" id="pendidikan_tahun'+x+'" name="pendidikan_tahun'+x+'" placeholder="Tahun">'+
		        '</div>'+
				'<div class="form-group col-md-10 col-sm-8">'+
					'<div class="row">'+
						'<div class="col-xs-10">'+
							'<input type="text" class="form-control" id="pendidikan_keterangan'+x+'" name="pendidikan_keterangan'+x+'" placeholder="Keterangan">'+
						'</div>'+
						'<div class="col-xs-2" id='+x+'>'+
							'<button type="button" class="btn btn-danger pull-right" id="remove_pendidikan">x</button>'+
						'</div>'+
					'</div>'+
				'</div>'+
	        '</div>'+
		'</div>'+
	'</content>';
	$(wrapper_pendidikan).append(append_pendidikan);
	$('#jml_pendidikan').val(x);
});
$(wrapper_pendidikan).on("click","#remove_pendidikan", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_pendidikan'+closer).remove();
});
/*End Script*/

/*Script Add Riwayat Organisasi*/
var wrapper_organisasi = $('#organisasi');
var btn_organisasi = $('#add_organisasi');

$(btn_organisasi).click(function(){
	y++;
	var append_organisasi = 
	'<div class="form-inline closer_organisasi'+y+'" role="form" style="width: 100%;padding: 5px;" id="form_organisasi">'+
		'<div class="row">'+
			'<div class="form-group col-md-2 col-sm-4">'+
            	'<input type="text" class="form-control" id="organisasi_tahun'+y+'" name="organisasi_tahun'+y+'" placeholder="Tahun">'+
            '</div>'+
			'<div class="form-group col-md-10 col-sm-8">'+
				'<div class="row">'+
					'<div class="col-xs-10">'+
						'<input type="text" class="form-control" id="organisasi_keterangan'+y+'" name="organisasi_keterangan'+y+'" placeholder="Keterangan">'+
					'</div>'+
					'<div class="col-xs-2" id="'+y+'">'+
						'<button type="button" class="btn btn-danger pull-right" id="remove_organisasi">x</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	$(wrapper_organisasi).append(append_organisasi); 
	$('#jml_organisasi').val(y);
});
$(wrapper_organisasi).on("click","#remove_organisasi", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_organisasi'+closer).remove();
});
/*End Script*/

/*Script Add Riwayat Pekerjaan*/
var wrapper_pekerjaan = $('#pekerjaan');
var btn_pekerjaan = $('#add_pekerjaan');

$(btn_pekerjaan).click(function() {
	z++;
	var append_pekerjaan = 
	'<div class="form-inline closer_pekerjaan'+z+'" role="form" style="width: 100%;padding: 5px;" id="form_pekerjaan">'+
		'<div class="row">'+
			'<div class="form-group col-md-2 col-sm-4">'+
				'<input type="text" class="form-control" id="pekerjaan_tahun'+z+'" name="pekerjaan_tahun'+z+'" placeholder="Tahun">'+
			'</div>'+
			'<div class="form-group col-md-10 col-sm-8">'+
				'<div class="row">'+
					'<div class="col-xs-10">'+
						'<input type="text" class="form-control" id="pekerjaan_keterangan'+z+'" name="pekerjaan_keterangan'+z+'" placeholder="Keterangan">'+
					'</div>'+
					'<div class="col-xs-2" id="'+z+'">'+
						'<button type="button" class="btn btn-danger pull-right" id="remove_pekerjaan">x</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	$(wrapper_pekerjaan).append(append_pekerjaan);
	$('#jml_pekerjaan').val(z);
});
$(wrapper_pekerjaan).on("click","#remove_pekerjaan", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_pekerjaan'+closer).remove();
});
/*End Script*/

/*Script Add Riwayat Diklat*/
var wrapper_diklat = $('#diklat');
var btn_diklat = $('#add_diklat');

$(btn_diklat).click(function() {
	a++;
	var append_diklat = 
	'<div class="form-inline closer_diklat'+a+'" role="form" style="width: 100%;padding: 5px;" id="form_diklat">'+
		'<div class="row">'+
			'<div class="form-group col-md-2 col-sm-4">'+
				'<input type="text" class="form-control" id="diklat_tahun'+a+'" name="diklat_tahun'+a+'" placeholder="Tahun">'+
			'</div>'+
			'<div class="form-group col-md-10 col-sm-8">'+
				'<div class="row">'+
					'<div class="col-xs-10">'+
						'<input type="text" class="form-control" id="diklat_keterangan'+a+'" name="diklat_keterangan'+a+'" placeholder="Keterangan">'+
					'</div>'+
					'<div class="col-xs-2" id="'+a+'">'+
						'<button type="button" class="btn btn-danger pull-right" id="remove_diklat">x</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	$(wrapper_diklat).append(append_diklat);
	$('#jml_diklat').val(a);
});
$(wrapper_diklat).on("click","#remove_diklat", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_diklat'+closer).remove();
});
/*End Script*/

/*Script Add Riwayat Perjuangan*/
var wrapper_perjuangan = $('#perjuangan');
var btn_perjuangan = $('#add_perjuangan');

$(btn_perjuangan).click(function(){
	b++;
	var append_perjuangan = 
	'<div class="form-inline closer_perjuangan'+b+'" role="form" style="width: 100%;padding: 5px;" id="form_pendidikan">'+
		'<div class="row">'+
			'<div class="form-group col-md-2 col-sm-4">'+
				'<input type="text" class="form-control" id="perjuangan_tahun'+b+'" name="perjuangan_tahun'+b+'" placeholder="Tahun">'+
			'</div>'+
			'<div class="form-group col-md-10 col-sm-8">'+
				'<div class="row">'+
					'<div class="col-xs-10">'+
						'<input type="text" class="form-control" id="perjuangan_keterangan'+b+'" name="perjuangan_keterangan'+b+'" placeholder="Keterangan">'+
					'</div>'+
					'<div class="col-xs-2" id="'+b+'">'+
						'<button type="button" class="btn btn-danger pull-right" id="remove_perjuangan">x</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	$(wrapper_perjuangan).append(append_perjuangan);
	$('#jml_perjuangan').val(b);
});
$(wrapper_perjuangan).on("click","#remove_perjuangan", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_perjuangan'+closer).remove();
});
/*End Script*/

/*Script Add Riwayat Penghargaan*/
var wrapper_penghargaan = $('#penghargaan');
var btn_penghargaan = $('#add_penghargaan');

$(btn_penghargaan).click(function() {
	c++;
	var append_penghargaan = 
	'<div class="form-inline closer_penghargaan'+c+'" role="form" style="width: 100%;padding: 5px;" id="form_penghargaan">'+
		'<div class="row">'+
			'<div class="form-group col-md-2 col-sm-4">'+
				'<input type="text" class="form-control" id="penghargaan_tahun'+c+'" name="penghargaan_tahun'+c+'" placeholder="Tahun">'+
			'</div>'+
			'<div class="form-group col-md-10 col-sm-8">'+	
				'<div class="row">'+
					'<div class="col-xs-10">'+
						'<input type="text" class="form-control" id="penghargaan_keterangan'+c+'" name="penghargaan_keterangan'+c+'" placeholder="Keterangan">'+
					'</div>'+
					'<div class="col-xs-2" id="'+c+'">'+
						'<button type="button" class="btn btn-danger pull-right" id="remove_penghargaan">x</button'+
					'</div>'
				'</div>'+
			'</div>'+
		'</div>'
	'</div>';
	$(wrapper_penghargaan).append(append_penghargaan);
	$('#jml_penghargaan').val(c);
});
$(wrapper_penghargaan).on("click","#remove_penghargaan", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_penghargaan'+closer).remove();
});
/*End Script*/

/*Add Maps Balon*/
$('#google_maps_balon').click(function() {
  var maps_section = 'maps';
  $.ajax({
    url     : base_url+'add/maps',
    type    : 'get',
    data    : { maps_section:maps_section },
    dataType: 'html',
    success : function(data){
      $('#modal_balon_maps').html(data);
    }
  });
});
/*End Script*/
/*Save Alamata Maps Scritp*/
$('.simpan_alamat_maps').click(function(){
	var alamat =  $('#pac-input').val();
	var kelurahan =  $('#kelurahan').val();
	$('#alamat').val(alamat);
	$.ajax({
		url		: base_url+'set/alamat',
		type	: 'get',
		data	: { kelurahan: kelurahan },
		dataType: 'html',
		success : function(data){
			
		}
	})
});
/*End Script*/

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
		url 	: '/pilkada2017/ajax/lokasi/kecamatan',
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
		url 	: '/pilkada2017/case/caleg',
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
/* $('#case').change(function() {
	var pilihan = $(this).val();
	$('#jenis_sort').val(pilihan);
	$.ajax({
		url 	: 'case-menu',
		data 	: {case:pilihan},
		dataType: 'html',
		success : function(data) {
			if(data == 'kosong') 
			{
				alert('kosong');
			} else {
				alert('clear');
			}
		}
	});
	$.ajax({
		url 	: 'show-filter',
		data 	: {case:pilihan},
		dataType: 'html',
		success : function(data) {
			if(data == 'kosong') 
			{
				window.location.href=".";
			} else {
				$('.response-filter').html(data);
			}
		}
	});
}); */
$('#case-fixed').change(function() {
	var pilihan = $(this).val();
	$('#jenis_sort').val(pilihan);
	$.ajax({
		url 	: 'case-menu',
		data 	: {case:pilihan},
		dataType: 'html',
		success : function(data) {
			if(data == 'kosong') 
			{
				window.location.href=".";
			} else {
				$('.response-maps').html(data);
			}
		}
	});
	$.ajax({
		url 	: 'show-filter',
		data 	: {case:pilihan},
		dataType: 'html',
		success : function(data) {
			if(data == 'kosong') 
			{
				window.location.href=".";
			} else {
				$('.response-filter').html(data);
			}
		}
	});
});
$('#partai').change(function() {
	var partai = $(this).val();
	$.ajax({
		url 	: '/pilkada2017/case-partai',
		data 	: { partai : partai },
		success : function(data) {
			$('.response-partai').html(data);
		}
	});
});
$('#btn-up').click(function(event) {
	event.preventDefault();
	$('html, body').animate({scrollTop: $(window).scrollTop()-300}, 100);
	return false;
});
$('#btn-down').click(function(event) {
	event.preventDefault();
	$('html, body').animate({scrollTop: $(window).scrollTop()+300}, 100);
	return false;
});

/* $('#cari').keyup(function() {
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