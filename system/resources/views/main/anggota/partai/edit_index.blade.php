@extends('main.layout.layout')

@section('title-page','Edit User')

@section('main-sidebar')
@endsection

@section('content')
@include('main.user.modal-map')
<link rel="stylesheet" href="{{ asset('asset/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('asset/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('asset/plugins/datepicker/datepicker3.css') }}">
<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
	  <h1>
		User Management
		<small>List User</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>User Management</li>
		<li class="active">List User</li>
	  </ol>
	</section>
	
	<section class="content">
	@foreach($dataBio as $tmp)
	@endforeach
	  <div class="formAdd"> 
		  <div class="row">
			<div class="col-md-12">
			  <div class="panel">
				<div class="box-header with-border">
					Add User
					<button id="closeFromAdd" type="button" class="btn btn-box-tool" data-widget="remove" style="float:right; color:white;"><i class="fa fa-remove"></i></button>
				</div>
				<div class="box-body formInput">
					<form action="" id="form-edit-user" name="form-edit-user" enctype="multipart/form-data" method="post">
						<input type="hidden" name="bio_id" value="{{ $tmp->id_bio }}"/>
						<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
						<div class="nav-tabs-custom tab-custom" style="box-shadow: 0 0 0 rgba(0,0,0,0);">
							<ul class="nav nav-tabs" style="border:0px; margin-bottom: 20px;">
								<li class="col-md-4 col-sm-4 col-xs-12 active" align="center"><a id="clickBiodata" href="#biodata" data-toggle="tab">Biodata Diri</a></li>
								<li class="col-md-4 col-sm-4 col-xs-12" align="center"><a href="#riwayat" data-toggle="tab">Riwayat</a></li>
								<li class="col-md-3 col-sm-3 col-xs-12" align="center"><a href="#dokumen" data-toggle="tab">Dokumen Pendukung</a></li>
							</ul>
							<div class="tab-content">
								<div class="active tab-pane" id="biodata">
									@include('main.user.edit_tabs-biodata')
								</div>
								<div class="tab-pane" id="riwayat">
									@include('main.user.edit_tabs-riwayat')
								</div>
								<div class="tab-pane" id="dokumen">
									@include('main.user.edit_tabs-dokumen')
								</div>
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
<script src="{{ asset('asset/js/jquery-3.0.0.min.js') }}"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('asset/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('asset/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('asset/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('asset/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
$('#loading').hide();
$(document).ready(function(){ 

	setOption('#tlProv','{{ $tmp->prov_lahir }}');
	setOption('#tlKab','{{ $tmp->bio_tempat_lahir }}');
	
	setOption('#abProv','{{ $tmp->bio_provinsi }}');
	setOption('#abKab','{{ $tmp->bio_kabupaten }}');
	setOption('#abKec','{{ $tmp->bio_kecamatan }}');
	setOption('#abKel','{{ $tmp->bio_kelurahan }}');
	
	if('{{ $tmp->status_value }}' === 'Menikah'){
		$("#pasangan").removeAttr('disabled');
		$("#anak").removeAttr('disabled');
	}else{
		$("#pasangan").attr('disabled','disabled');
		$("#anak").attr('disabled','disabled');
	}
	
	if('{{ $tmp->bio_jenis_identitas }}' != ''){ 
		$('#noIdentitas').removeAttr('disabled');
		$('#noIdentitas').attr('required', true);
	}else{ 
		$('#noIdentitas').attr('disabled', true);
		$('#noIdentitas').removeAttr('required');
	}
	
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

</script>
<script>
  $(function () {
    $('#datepicker').datepicker({dateFormat: "dd-mm-yy"});
  });
</script>
@endsection