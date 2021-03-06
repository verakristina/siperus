@extends('main.layout.layout')

@section('title-page','Add User')

@section('main-sidebar')
@endsection

@section('content')
<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>

@include('main.user.modal-map')
<link rel="stylesheet" href="{{ asset('asset/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('asset/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('asset/plugins/datepicker/datepicker3.css') }}">
<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
	  <h1>
		Pendaftaran Anggota
		<small>Tambah Data Anggota Partai</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Pendaftaran Anggota</li>
		<li class="active">Tambah Data Anggota Partai</li>
	  </ol>
	</section>
	
	<section class="content">
	  <div class="formAdd"> 
		  <div class="row">
			<div class="col-md-12">
			  <div class="panel">
				<div class="box-header with-border">
					Form Pengurus
				</div>
				<div class="box-body formInput">
					<form action="{{ asset('anggota/partai/add') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data" novalidate>
						<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
						<div class="nav-tabs-custom tab-custom" style="box-shadow: 0 0 0 rgba(0,0,0,0);">
							<ul class="nav nav-tabs" style="border:0px; margin-bottom: 20px;">
								<!-- <li class="col-md-4 col-sm-4 col-xs-12 active" align="center"><a id="clickBiodata" href="#biodata" data-toggle="tab">Biodata Diri</a></li> -->
								<!-- <li class="col-md-4 col-sm-4 col-xs-12" align="center"><a href="#riwayat" data-toggle="tab">Riwayat</a></li>
								<li class="col-md-3 col-sm-3 col-xs-12" align="center"><a href="#dokumen" data-toggle="tab">Dokumen Pendukung</a></li> -->
							</ul>
							<div class="tab-content">
								<div class="active tab-pane" id="biodata">
									@include('main.user.tabs-biodata')
								</div>
								<!-- <div class="tab-pane" id="riwayat">
									@include('main.user.tabs-riwayat')
								</div>
								<div class="tab-pane" id="dokumen">
									@include('main.user.tabs-dokumen')
								</div> -->
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 pull-right">
											<button type="submit" class="btn-primary form-control" id="simpanData">Simpan</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		  </div>
		</div>
	  </div>
	</section>
</div>
<script src="{{asset('asset/js/moment.js')}}"></script>
<script src="{{ asset('asset/js/jquery-3.0.0.min.js') }}"> </script>
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('asset/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('asset/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('asset/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('asset/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
$('#noIdentitas').focusout(function(){
	cekIdentitas();
});

$('#s_prov').change(function(){
	var prov = $(this).val();
	changeKabupatenOptionKPU('#s_prov','#s_kab',prov);
});
$('#s_kab').change(function(){
	var prov = $('#s_prov').val();
	var kab = $(this).val();
	changeKecamatanOptionKPU('#s_kab','#s_kec',prov,kab);
});
$('#s_kec').change(function(){
	var prov = $('#s_prov').val();
	var kab = $('#s_kab').val();
	var kec = $(this).val();
	changeKelurahanOptionKPU('#s_kec','#s_kel',prov,kab,kec);
});

function cekIdentitas(){
	$('#responseCheck').html('<i class="fa fa-refresh fa-spin"></i>')
	var jenis = $('#identitas').val();
	var nomer = $('#noIdentitas').val();
	$.ajax({
		url: '{{ asset("proses/cek/identitas") }}',
		type: 'get',
		data: {jenis:jenis,nomer:nomer},
		dataType: 'html',
		success: function(data){
			if(data != 'success'){
				$('#noIdentitas').addClass('required');
				$('#noIdentitas').removeClass('success');
				$('#responseCheck').html('<span style="color:red;"><i class="fa fa-times" style="color:red;"></i> Nomer Identitas Sudah Tedaftar</span>');
			} else {
				$('#noIdentitas').removeClass('required');
				$('#noIdentitas').addClass('success');
				$('#responseCheck').html('<span style="color:green;"><i class="fa fa-check" style="color:green;"></i> Nomer Identitas Belum Tedaftar</span>');
			}
		}
	});
}

function optionOtomatis(jenis,data){
	$.ajax({
		url: '{{ asset("proses/cek/alamat") }}',
		type: 'get',
		data: {jenis:jenis,data:data},
		dataType: 'html',
		success: function(data){
			
		}
	});
}

$(document).ready(function(){
	$('#identitas').change(function(){
		var status = $(this).val();
		if(status != ''){
			$('#noIdentitas').removeAttr('disabled');
			$('#noIdentitas').attr('required', true);
		}else{
			$('#noIdentitas').attr('disabled', true);
			$('#noIdentitas').removeAttr('required');
		}
	});
	$('#statusPernikahan').change(function(){
		var status = $(this).val();
		if(status == '1'){
			$('#namaPasangan').removeAttr('disabled');
			$('#jumlahAnak').removeAttr('disabled');
			$('#namaPasangan').attr('required', true);
			$('#jumlahAnak').attr('required', true);
		}else{
			$('#namaPasangan').attr('disabled', true);
			$('#jumlahAnak').attr('disabled', true);
			$('#namaPasangan').removeAttr('required');
			$('#jumlahAnak').removeAttr('required');
		}
	});
	
	
	$('#tlProv').change(function(){
		var prov = $(this).val();
		changeKabupatenOptionKPU('#tlProv','#tlKab',prov);
	});
	$('#abProv').change(function(){
		var prov = $(this).val();
		changeKabupatenOptionKPU('#abProv','#abKab',prov);
	});
	$('#abKab').change(function(){
		var prov = $('#abProv').val();
		var kab = $(this).val();
		changeKecamatanOptionKPU('#abKab','#abKec',prov,kab);
	});
	$('#abKec').change(function(){
		var prov = $('#abProv').val();
		var kab = $('#abKab').val();
		var kec = $(this).val();
		changeKelurahanOptionKPU('#abKec','#abKel',prov,kab,kec);
	});
	
	$('.window').click(function() {
		$('.popup').fadeOut(500);
		$('.window').fadeOut(500);
		document.getElementById('alamat').value="";
	});
	$('.g-maps').click(function() {
		$('.popup').fadeOut(500);
		$('.window').fadeOut(500);
	});	
});

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


</script>
<script>
  $(function () {
    $('#datepicker').datepicker({dateFormat: "dd-mm-yy"});
  });
</script>

@endsection