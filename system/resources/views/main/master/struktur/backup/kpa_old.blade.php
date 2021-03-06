@extends('main.layout.layout')

@section('title-page','Struktur KPA')

@section('main-sidebar')
@endsection

@section('content')
<div class="modal primary" id="tambahKPA" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/tambah/struktur/kpa') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Tambah Struktur KPA</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') >= 3)
								{{--*/ $statusProvinsi = 'hide' /*--}}
							@else
								{{--*/ $statusProvinsi = 'show' /*--}}
						@endif	
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Provinsi</label>
							<div class="col-md-8">
								<select name="id_prov" id="id_prov" class="form-control">
									@foreach($dataProv as $tmp)
										<option value="{{$tmp->geo_prov_id}}">{{$tmp->geo_prov_nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kabupaten</label>
							<div class="col-md-8">
								<select name="id_kab" id="id_kab" class="form-control">
									@foreach($dataKab as $tmp)		
										<option value="{{ $tmp->geo_kab_id }}">{{ $tmp->geo_kab_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kecamatan</label>
							<div class="col-md-8">
								<select name="id_kec" id="id_kec" class="form-control">
									@foreach($dataKec as $tmp)		
										<option value="{{ $tmp->geo_kec_id }}">{{ $tmp->geo_kec_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kelurahan</label>
							<div class="col-md-8">
								<select name="id_kel" id="id_kel" class="form-control">
									<option value="">--- Kelurahan ---</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama RW</label>
							<div class="col-md-8">
								<select name="id_rw" id="id_rw" class="form-control">
									<option value="">--- RW ---</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama RT</label>
							<div class="col-md-8">
								<select name="id_rt" id="id_rt" class="form-control">
									<option value="">--- RT ---</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Struktur KPA</label>
							<div class="col-md-8">
								<input type="text" name="nama_kpa" id="nama_kpa" class="form-control" placeholder="Nama Struktur KPA">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning"  id="barangbuktibtn">Simpan</button>
				</div>
			</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
	</div>
</div>
<div class="modal primary" id="editKPA" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/edit/struktur/kpa') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Edit Struktur KPA</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12 {{ (session('idRole') >= 3)?$statusProvinsi:'' }}">
							<label for="nama" class="col-md-4">Nama Provinsi</label>
							<div class="col-md-8">
								<select name="edit_id_prov" id="edit_id_prov" class="form-control">
									<option value="">--- Provinsi ---</option>
									@foreach($dataProv as $tmp)
										<option value="{{$tmp->geo_prov_id}}">{{$tmp->geo_prov_nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12 {{ (session('idRole') >= 3)?$statusProvinsi:'' }}">
							<label for="nama" class="col-md-4">Nama Kabupaten</label>
							<div class="col-md-8">
								<select name="edit_id_kab" id="edit_id_kab" class="form-control">
									<option value="">--- Kabupaten ---</option>
									@foreach($dataKab as $tmp)		
										<option value="{{ $tmp->geo_kab_id }}">{{ $tmp->geo_kab_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kecamatan</label>
							<div class="col-md-8">
								<select name="edit_id_kec" id="edit_id_kec" class="form-control">
									<option value="">--- Kecamatan ---</option>
									@foreach($dataKec as $tmp)		
										<option value="{{ $tmp->geo_kec_id }}">{{ $tmp->geo_kec_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kelurahan</label>
							<div class="col-md-8">
								<select name="edit_id_kel" id="edit_id_kel" class="form-control">
									<option value="">--- Kelurahan ---</option>
									@foreach($dataKel as $tmp)		
										<option value="{{ $tmp->geo_deskel_id }}">{{ $tmp->geo_deskel_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama RW</label>
							<div class="col-md-8">
								<select name="edit_id_rw" id="edit_id_rw" class="form-control">
									<option value="">--- RW ---</option>
									@foreach($dataRW as $tmp)		
										<option value="{{ $tmp->geo_rw_id }}">{{ $tmp->geo_rw_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama RT</label>
							<div class="col-md-8">
								<select name="edit_id_rw" id="edit_id_rw" class="form-control">
									<option value="">--- RT ---</option>
									@foreach($dataRT as $tmp)		
										<option value="{{ $tmp->geo_rt_id }}">{{ $tmp->geo_rt_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Struktur KPA</label>
							<div class="col-md-8">
								<input type="text" name="edit_id_kpa" id="edit_id_kpa" class="form-control hide" placeholder="Nama Struktur KPA">
								<input type="text" name="edit_nama_kpa" id="edit_nama_kpa" class="form-control" placeholder="Nama Struktur KPA">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning"  id="barangbuktibtn">Simpan</button>
				</div>
			</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
	</div>
</div>

<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
	  <h1>
		Master Data
		<small>Struktur</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Master Data</li>
		<li>Struktur</li>
		<li class="active">KPA</li>
	  </ol>
	</section>

	<section class="content">
		<div class="page-ajax">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
					   <div class="response-cari">
						  <!-- /.box-tools -->
						  <?php $no=1; ?>
						  <div class="box-header with-border">
							  <div class="row">
								<div class="col-md-2 col-sm-3 col-xs-6">
									List Struktur KPA
								</div>
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
									<div onclick="addKpa({{session('idProvinsi')}})" class="btn-block btn-warning btn" data-toggle="modal" data-target="#tambahKPA"><i class="fa fa-plus"></i> Tambah</div>
									<div id="btnEditKPA" class="btn-block btn-primary btn hide" data-toggle="modal" data-target="#editKPA"><i class="fa fa-plus"></i> Tambah</div>
								</div>
							  </div>
						  </div>
						  <div class="panel-body">
							<div class="row" id="canvasFilter">
								<div class="col-md-2 {{ (session('idRole') >= 3)?$statusProvinsi:'' }}" >
									<select class="form-control custom-field-litle" id="prov" name="prov">
										<option>--- Provinsi ---</option>
										@foreach($dataProv as $tmp)									
											<option value="{{ $tmp->geo_prov_id }}"> {{ $tmp->geo_prov_nama }} </option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2 {{ (session('idRole') >= 3)?$statusProvinsi:'' }}">
									<select class="form-control custom-field-litle" id="kab" name="kab">
										<option>--- Kabupaten ---</option>
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control custom-field-litle" id="kec" name="kec">
										<option>--- Kecamatan ---</option>
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control custom-field-litle" id="kel" name="kel" >
										<option>--- Kelurahan ---</option>
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control custom-field-litle" id="rw" name="rw">
										<option>--- RW ---</option>
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control custom-field-litle" id="rt" name="rt">
										<option>--- RT ---</option>
									</select>
								</div>
							</div>
							<table class="table table-striped table-hover">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Nama Struktur KPA</th>
								  <th width="150">Aksi</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $no =1; ?>
							  @foreach($data as $tmp)
							  <tr>
								<td>{{ $no++ }}</td> 
								<td>{{ $tmp->struk_kpa_nama }}</td>
								<td>
								  <div onclick="detailUser('{{ $tmp->struk_kpa_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								  <div onclick='editKPA("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","{{ $tmp->geo_kec_id }}","{{ $tmp->geo_deskel_id }}","{{ $tmp->geo_rw_id }}","{{ $tmp->struk_kpa_id }}","{{ $tmp->struk_kpa_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
								  <a href="{{ asset('proses/delete/struktur/kpa/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id.'/'.$tmp->geo_kec_id.'/'.$tmp->geo_deskel_id.'/'.$tmp->geo_rw_id.'/'.$tmp->struk_kpa_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
								  <div onclick="printUser('{{ $tmp->struk_kpa_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
								</td>
							  </tr>
							  @endforeach
							  </tbody>
							</table>
						  </div>
					   </div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>
$('#prov').change(function(){
	var provId = $(this).val();
	changeKabupatenOptionKPU(this,'#kab',provId);
});
$('#id_prov').change(function(){
	var provId = $(this).val();
	changeKabupatenOptionKPU(this,'#id_kab',provId);
});
$('#kab').change(function(){
	var provId = $('#prov').val();
	var kabId = $(this).val();
	changeKecamatanOptionKPU(this,'#kec',provId,kabId);
});
$('#id_kab').change(function(){
	var provId = $('#prov').val();
	var kabId = $(this).val();
	changeKecamatanOptionKPU(this,'#id_kec',provId,kabId);
});
$('#kec').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $(this).val();
	changeKelurahanOptionKPU(this,'#kel',provId,kabId,kecId);
});
$('#id_kec').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $(this).val();
	changeKelurahanOptionKPU(this,'#id_kel',provId,kabId,kecId);
});
$('#kel').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $('#kec').val();
	var kelId = $(this).val();
	changeRWOptionKPU(this,'#rw',provId,kabId,kecId,kelId);
});
$('#id_kel').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $('#kec').val();
	var kelId = $(this).val();
	changeRWOptionKPU(this,'#id_rw',provId,kabId,kecId,kelId);
});
$('#rw').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $('#kec').val();
	var kelId = $('#kel').val();
	var rwId = $('#rw').val();
	changeRTOptionKPU(this,'#id_rw',provId,kabId,kecId,kelId,rwId);
});
$('#rt').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $('#kec').val();
	var kelId = $('#kel').val();
	var rwId = $('#rw').val();
	var rtId = $(this).val();
	location.href="<?php echo url(); ?>/master/struktur/kpa/"+provId+"/"+kabId+"/"+kecId+"/"+kelId+"/"+rwId+"/"+rtId;
});
$(document).ready(function(){
	<?php if($prov != 0) { ?>
		changeKabupatenOptionKPU('#prov','#kab','{{ $prov }}');
	<?php } ?>
	<?php if($kab != 0) { ?>
		changeKecamatanOptionKPU('#kab','#kec','{{ $prov }}','{{ $kab }}');
	<?php } ?>
	<?php if($kec != 0) { ?>
		changeKelurahanOptionKPU('#kec','#kel','{{ $prov }}','{{ $kab }}','{{ $kec }}');
	<?php } ?>
	<?php if($kel != 0) { ?>
		changeRWOptionKPU('#kel','#rw','{{ $prov }}','{{ $kab }}','{{ $kec }}','{{ $kel }}');
		$('#prov').val('{{ $prov }}');
		$('#kab').val('{{ $kab }}');
		$('#kec').val('{{ $kec }}');
		$('#kel').val('{{ $kel }}');
		$('#rw').val('{{ $rw }}');
	<?php } ?>
});
function editKPA(prov_id,kab_id,kec_id,kel_id,rw_id,struk_id,struk_nama){
	$('#edit_id_prov').val(prov_id);
	$('#edit_id_kab').val(kab_id);
	$('#edit_id_kec').val(kec_id);
	$('#edit_id_kel').val(kel_id);
	$('#edit_id_rw').val(rw_id);
	$('#edit_id_kpa').val(struk_id);
	$('#edit_nama_kpa').val(struk_nama);
	$('#btnEditKPA').click();
}
function addKpa(prov_id){
	changeKabupatenOptionKPU(prov_id,'#id_kab',prov_id);
}
</script>
@endsection