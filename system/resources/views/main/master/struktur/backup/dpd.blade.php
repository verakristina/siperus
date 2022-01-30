@extends('main.layout.layout')

@section('title-page','Struktur DPD')

@section('main-sidebar')
@endsection

@section('content')
<div class="modal primary" id="tambahProvinsi" role="dialog" aria-labelledby="tambahProvinsiLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/tambah/struktur/dpd') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Tambah Struktur DPD</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
								{{--*/ $statusProvinsi = 'hide' /*--}}
							@else
								{{--*/ $statusProvinsi = 'show' /*--}}
						@endif	
						<div class="form-group col-md-12 {{ (session('idRole') == 3)?$statusProvinsi:'' }} ">
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
							<label for="nama" class="col-md-4">Nama Struktur DPD</label>
							<div class="col-md-8">
								<input type="text" name="nama_dpd" id="nama_dpd" class="form-control" placeholder="Nama Struktur DPD">
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
		<form action="{{ asset('proses/edit/struktur/dpd') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Edit Struktur DPD</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
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
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Struktur DPD</label>
							<div class="col-md-8">
								<input type="hidden" name="edit_id_dpd" id="edit_id_dpd" class="form-control" placeholder="Nama Struktur DPD">
								<input type="text" name="edit_nama_dpd" id="edit_nama_dpd" class="form-control" placeholder="Nama Struktur DPD">
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
		<li class="active">DPD</li>
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
									List Struktur DPD
								</div>
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
									<div class="btn-block btn-warning btn" data-toggle="modal" data-target="#tambahProvinsi"><i class="fa fa-plus"></i> Tambah</div>
									<div id="btnEditProvinsi" class="btn-primary btn hide" data-toggle="modal" data-target="#editProvinsi"><i class="fa fa-plus"></i> Tambah</div>
								</div>
							  </div>
						  </div>
						  <div class="panel-body">
							<div class="row" id="canvasFilter">
								@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
										{{--*/ $statusProvinsi = 'hide' /*--}}
									@else
										{{--*/ $statusProvinsi = 'show' /*--}}
								@endif	
								<div class="col-md-2 {{ (session('idRole') == 3)?$statusProvinsi:'' }}" >
									<select class="form-control custom-field-litle" id="prov" name="prov" required>
										<option>--- Provinsi ---</option>
										@foreach($dataProv as $tmps)									
											<option value="{{ $tmps->geo_prov_id }}"> {{ $tmps->geo_prov_nama }} </option>
										@endforeach
									</select>
								</div>
							</div>
							<table class="table table-striped table-hover">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Nama Struktur DPD</th>
								  <th width="150">Aksi</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $no =1; ?>
							  @foreach($data as $tmp)
							  <tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->struk_pimda_nama }}</td>
								<td>
								  <div onclick="detailUser('{{ $tmp->struk_pimda_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								  <div onclick='editDPD("{{ $tmp->geo_prov_id }}","{{ $tmp->struk_pimda_id }}","{{ $tmp->struk_pimda_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
								  <a href="{{ asset('proses/delete/struktur/dpd/'.$tmp->geo_prov_id.'/'.$tmp->struk_pimda_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
								  <div onclick="printUser('{{ $tmp->struk_pimda_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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
	location.href="<?php echo url(); ?>/master/struktur/dpd/"+prov;
});

$(document).ready(function(){
	<?php if($prov != 0) { ?>
		$('#prov').val('{{ $prov }}');
	<?php } ?>
});
function editDPD(prov_id,struk_id,struk_nama){
	$('#edit_id_prov').val(prov_id);
	$('#edit_id_dpd').val(struk_id);
	$('#edit_nama_dpd').val(struk_nama);
	$('#btnEditProvinsi').click();
}
</script>
@endsection