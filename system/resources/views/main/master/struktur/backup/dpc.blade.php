@extends('main.layout.layout')

@section('title-page','Struktur DPC')

@section('main-sidebar')
@endsection

@section('content')
<div class="modal primary" id="tambahKabupaten" role="dialog" aria-labelledby="tambahKabupatenLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/tambah/struktur/dpc') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Tambah Struktur DPC</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') >= 3)
								{{--*/ $statusProvinsi = 'hide' /*--}}
							@else
								{{--*/ $statusProvinsi = 'show' /*--}}
						@endif	
						<div class="form-group col-md-12 ">
							<label for="nama" class="col-md-4">Nama Provinsi</label>
							<div class="col-md-8">
								<select name="id_prov" id="id_provinsi" class="form-control">
									
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
								<select name="id_kab" id="id_kabupaten" class="form-control">
									<option value="">--- Kabupaten ---</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Struktur DPC</label>
							<div class="col-md-8">
								<input type="text" name="nama_dpc" id="nama_kabupaten" class="form-control" placeholder="Nama Struktur DPC">
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
<div class="modal primary" id="editKabupaten" role="dialog" aria-labelledby="tambahKabupatenLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/edit/struktur/dpc') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Edit Struktur DPC</h4>
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
							<label for="nama" class="col-md-4">Nama Struktur DPC</label>
							<div class="col-md-8">
								<input type="hidden" name="edit_id_dpc" id="edit_id_dpc" class="form-control" placeholder="Nama Struktur DPC">
								<input type="text" name="edit_nama_dpc" id="edit_nama_dpc" class="form-control" placeholder="Nama Struktur DPC">
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
		<small>Struktur</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Master Data</li>
		<li>Struktur</li>
		<li class="active">PIMCAB</li>
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
									List Struktur DPC
								</div>
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
									<div onclick="addDpc({{session('idProvinsi')}})" class="btn-block btn-warning btn" data-toggle="modal" data-target="#tambahKabupaten"><i class="fa fa-plus"></i> Tambah</div>
									<div id="btnEditKabupaten" class="btn-block btn-primary btn hide" data-toggle="modal" data-target="#editKabupaten"><i class="fa fa-plus"></i> Tambah</div>
								</div>
							  </div>
						  </div>
						  <div class="panel-body">
							<div class="row" id="canvasFilter">
								<div class="col-md-2 {{ (session('idRole') >= 3)?$statusProvinsi:'' }}" >
									<select class="form-control custom-field-litle" id="prov" name="prov" required>
										<option>--- Provinsi ---</option>
										@foreach($dataProv as $tmp)									
											<option value="{{ $tmp->geo_prov_id }}"> {{ $tmp->geo_prov_nama }} </option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2 {{ (session('idRole') >= 3)?$statusProvinsi:'' }}">
									<select class="form-control custom-field-litle" id="kab" name="kab" required>
										<option>--- Kabupaten ---</option>
									</select>
								</div>
							</div>
							<table class="table table-striped table-hover">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Nama Kabupaten</th>
								  <th width="150">Aksi</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $no =1; ?>
							  @foreach($data as $tmp)
							  <tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->struk_pimcab_nama }}</td>
								<td>
								  <div onclick="detailUser('{{ $tmp->struk_pimcab_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								  <div onclick='editDPC("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","{{ $tmp->struk_pimcab_id }}","{{ $tmp->struk_pimcab_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
								  <a href="{{ asset('proses/delete/struktur/dpc/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id.'/'.$tmp->struk_pimcab_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
								  <div onclick="printUser('{{ $tmp->struk_pimcab_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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
	location.href="<?php echo url(); ?>/master/struktur/dpc/"+prov+"/"+kab;
});
$(document).ready(function(){
	<?php if($prov != 0) { ?>
		changeKabupatenOptionKPU('#prov','#kab','{{ $prov }}');
	<?php } ?>
	<?php if($kab != 0) { ?>
		$('#prov').val('{{ $prov }}');
		$('#kab').val('{{ $kab }}');
	<?php } ?>
});

function editDPC(prov_id,kab_id,struk_id,struk_nama){
	$('#edit_id_prov').val(prov_id);
	changeKabupatenOptionKPU('#edit_id_prov','#edit_id_kabupaten',prov_id);
	$('#edit_id_kab').val(kab_id);
	$('#edit_id_dpc').val(struk_id);
	$('#edit_nama_dpc').val(struk_nama);
	$('#btnEditKabupaten').click();
}
function addDpc(prov_id){
	changeKabupatenOptionKPU(prov_id,'#id_kabupaten',prov_id);
}
</script>
@endsection