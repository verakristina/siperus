@extends('main.layout.layout')

@section('title-page','List Provinsi')

@section('main-sidebar')
@endsection

@section('content')
<?php $dataUsers = HelperData::getDataUser('idLogin'); ?>
<div class="modal primary" id="tambahProvinsi" role="dialog" aria-labelledby="tambahProvinsiLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/tambah/wilayah/provinsi') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Tambah Provinsi</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Provinsi</label>
							<div class="col-md-8">
								<input type="text" name="nama_provinsi" id="nama_provinsi" class="form-control" placeholder="Nama Provinsi">
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
<div class="modal primary" id="editProvinsi" role="dialog" aria-labelledby="editProvinsiLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/edit/wilayah/provinsi') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Edit Provinsi</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Provinsi</label>
							<div class="col-md-8">
								<input type="text" name="edit_id_provinsi" id="edit_id_provinsi" class="form-control hide" placeholder="Nama Provinsi">
								<input type="text" name="edit_nama_provinsi" id="edit_nama_provinsi" class="form-control" placeholder="Nama Provinsi">
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
		<li class="active">Provinsi</li>
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
									List Provinsi
								</div>
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
								  <div id="btnEditProvinsi" class="btn-primary btn hide" data-toggle="modal" data-target="#editProvinsi"> Tambah</div>
								  <div class="btn-danger btn-block btn" data-toggle="modal" data-target="#tambahProvinsi"><i class="fa fa-plus"></i> Tambah</div>
								</div>
							  </div>
						  </div>
						  <div class="panel-body">
							<table class="table table-striped table-hover">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Nama Provinsi</th>
								  <th width="150">Aksi</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $no =1; ?>
							  @foreach($data as $tmp)
							  <tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->geo_prov_nama }}</td>
								<td>								
								  <div onclick="getDataDetailWilayah('prov','{{ $tmp->geo_prov_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								  <div class="btn btn-warning" onclick='editProvinsi("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_prov_nama }}")'><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"></span></div></a>
								  <a href="{{ asset('proses/delete/wilayah/provinsi/'.$tmp->geo_prov_id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><div class="btn-danger btn"><span class="glyphicon glyphicon-trash"></span></div></a>
								  <div onclick="printProvinsi('{{ $tmp->geo_prov_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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
function editProvinsi(prov_id,prov_nama){
	$('#edit_id_provinsi').val(prov_id);
	$('#edit_nama_provinsi').val(prov_nama);
	$('#btnEditProvinsi').click();
}
</script>
@endsection