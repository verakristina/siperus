@extends('main.layout.layout')

@section('title-page','List Kelurahan')

@section('main-sidebar')
@endsection

@section('content')
<?php $dataUsers = HelperData::getDataUser('idLogin'); ?>
<div class="modal primary" id="tambahKelurahan" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/tambah/wilayah/kelurahan') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Tambah Kelurahan</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
								{{--*/ $statusProvinsi = 'hide' /*--}}
							@else
								{{--*/ $statusProvinsi = 'show' /*--}}
						@endif	
						<div class="form-group col-md-12 {{ (session('idRole') == 3)?$statusProvinsi:'' }}">
							<label for="nama" class="col-md-4">Nama Provinsi</label>
							<div class="col-md-8">
								<select name="id_provinsi" id="id_provinsi" class="form-control">
									<option class="{{ (session('idRole') == 3)?$statusProvinsi:'' }}" value="">--- Provinsi ---</option>
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
								<select name="id_kabupaten" id="id_kabupaten" class="form-control">
									<option value="">--- Kabupaten ---</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kecamatan</label>
							<div class="col-md-8">
								<select name="id_kecamatan" id="id_kecamatan" class="form-control">
									<option value="">--- Kecamatan ---</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kelurahan</label>
							<div class="col-md-8">
								<input type="text" name="nama_kelurahan" id="nama_kelurahan" class="form-control" placeholder="Nama Kabupaten">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger"  id="barangbuktibtn">Simpan</button>
				</div>
			</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
	</div>
</div>
<div class="modal primary" id="editKelurahan" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/edit/wilayah/kelurahan') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Edit Kelurahan</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Provinsi</label>
							<div class="col-md-8">
								<select name="edit_id_provinsi" id="edit_id_provinsi" class="form-control">
									<option value="">--- Provinsi ---</option>
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
								<select name="edit_id_kabupaten" id="edit_id_kabupaten" class="form-control">
									<option value="">--- Kabupaten ---</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kecamatan</label>
							<div class="col-md-8">
								<select name="edit_id_kecamatan" id="edit_id_kecamatan" class="form-control">
									<option value="">--- Kecamatan ---</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kelurahan</label>
							<div class="col-md-8">
								<input type="text" name="edit_id_kelurahan" id="edit_id_kelurahan" class="form-control hide" placeholder="Nama Kabupaten">
								<input type="text" name="edit_nama_kelurahan" id="edit_nama_kelurahan" class="form-control" placeholder="Nama Kabupaten">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger"  id="barangbuktibtn">Simpan</button>
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
		<small>Wilayah</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Master Data</li>
		<li>Wilayah</li>
		<li class="active">Kelurahan</li>
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
									List Kelurahan
								</div>
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
									<div onclick="addKel({{session('idProvinsi')}})" class="btn-block btn-danger btn" data-toggle="modal" data-target="#tambahKelurahan"><i class="fa fa-plus"></i> Tambah</div>
									<div id="btnEditKelurahan" class="btn-block btn-primary btn hide" data-toggle="modal" data-target="#editKelurahan"><i class="fa fa-plus"></i> Tambah</div>
								</div>
							  </div>
						  </div>
						  <div class="panel-body">
							<div class="row" id="canvasFilter">
									@foreach($dataUsers as $users)
									@if($users->geo_prov_id == "")
								<div class="col-md-2 col-sm-6 col-xs-12">
									@else
								<div class="col-md-2 col-sm-6 col-xs-12 hide">
								@endif	
								@endforeach
									<select class="form-control custom-field-litle" id="prov" name="prov" required>
										<option>--- Provinsi ---</option>
										@foreach($dataProv as $tmp)									
											<option value="{{ $tmp->geo_prov_id }}"> {{ $tmp->geo_prov_nama }} </option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2 col-sm-6 col-xs-12">
									<select class="form-control custom-field-litle" id="kab" name="kab" required>
										<option>--- Kabupaten ---</option>
									</select>
								</div>
								<div class="col-md-2 col-sm-6 col-xs-12">
									<select class="form-control custom-field-litle" id="kec" name="kec" required>
										<option>--- Kecamatan ---</option>
									</select>
								</div>
							</div>
							<table class="table table-striped table-hover">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Nama Kelurahan</th>
								  <th width="150">Aksi</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $no =1; ?>
							  @foreach($data as $tmp)
							  <tr>
								<td>{{ $no++ }}</td> 
								<td>{{ $tmp->geo_deskel_nama }}</td>
								<td>
								  <div onclick="getDataDetailWilayah('kel','{{ $tmp->geo_prov_id }}','{{ $tmp->geo_kab_id }}','{{ $tmp->geo_kec_id }}','{{ $tmp->geo_deskel_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								  <div onclick='editKelurahan("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","{{ $tmp->geo_kec_id }}","{{ $tmp->geo_deskel_id }}","{{ $tmp->geo_deskel_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
								  <a href="{{ asset('proses/delete/wilayah/kelurahan/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id.'/'.$tmp->geo_kec_id.'/'.$tmp->geo_deskel_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
								  <div onclick="printUser('{{ $tmp->geo_deskel_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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
@include('main.master.wilayah.include.modal-detail')
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>
$('#prov').change(function(){
	var prov = $(this).val();
	changeKabupatenOptionKPU('#prov','#kab',prov);
});
$('#id_provinsi').change(function(){
	var prov = $(this).val();
	changeKabupatenOptionKPU('#id_provinsi','#id_kabupaten',prov);
});
$('#kab').change(function(){
	var prov = $('#prov').val();
	var kab = $(this).val();
	changeKecamatanOptionKPU('#kab','#kec',prov,kab);
});
$('#id_kabupaten').change(function(){
	var prov = $('#id_provinsi').val();
	var kab = $(this).val();
	changeKecamatanOptionKPU('#id_kabupaten','#id_kecamatan',prov,kab);
});
$('#kec').change(function(){
	var prov = $('#prov').val();
	var kab = $('#kab').val();
	var kec = $(this).val();
	location.href="<?php echo url(); ?>/master/wilayah/kelurahan/"+prov+"/"+kab+"/"+kec;
});
$(document).ready(function(){
	<?php if($prov != 0) { ?>
		changeKabupatenOptionKPU('#prov','#kab','{{ $prov }}');
	<?php } ?>
	<?php if($kab != 0) { ?>
		changeKecamatanOptionKPU('#kab','#kec','{{ $prov }}','{{ $kab }}');
	<?php } ?>
	<?php if($kec != 0) { ?>
		$('#prov').val('{{ $prov }}');
		$('#kab').val('{{ $kab }}');
		$('#kec').val('{{ $kec }}');
	<?php } ?>
});
function editKelurahan(prov_id,kab_id,kec_id,kel_id,kel_nama){
	$('#edit_id_provinsi').val(prov_id);
	changeKabupatenOptionKPU('#edit_id_provinsi','#edit_id_kabupaten',prov_id);
	$('#edit_id_kabupaten').val(kab_id);
	changeKecamatanOptionKPU('#edit_id_kabupaten','#edit_id_kecamatan',prov_id,kab_id);
	$('#edit_id_kecamatan').val(kec_id);
	$('#edit_id_kelurahan').val(kel_id);
	$('#edit_nama_kelurahan').val(kel_nama);
	$('#btnEditKelurahan').click();
}
function addKel(prov_id){
	changeKabupatenOptionKPU(prov_id,'#id_kabupaten',prov_id);
}
</script>
@endsection