@extends('main.layout.layout')

@section('title-page','List Kabupaten')

@section('main-sidebar')
@endsection

@section('content')
<?php $dataUsers = HelperData::getDataUser('idLogin'); ?>
<div class="modal primary" id="tambahKabupaten" role="dialog" aria-labelledby="tambahKabupatenLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/tambah/wilayah/kabupaten') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Tambah Kabupaten</h4>
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
								<input type="text" name="nama_kabupaten" id="nama_kabupaten" class="form-control" placeholder="Nama Kabupaten">
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
		<form action="{{ asset('proses/edit/wilayah/kabupaten') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Tambah Kabupaten</h4>
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
								<input type="text" name="edit_id_kabupaten" id="edit_id_kabupaten" class="form-control hide" placeholder="Nama Kabupaten">
								<input type="text" name="edit_nama_kabupaten" id="edit_nama_kabupaten" class="form-control" placeholder="Nama Kabupaten">
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
		<li class="active">Kabupaten</li>
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
									List Kabupaten
								</div>
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
									<div class="btn-block btn-danger btn" data-toggle="modal" data-target="#tambahKabupaten"><i class="fa fa-plus"></i> Tambah</div>
									<div id="btnEditKabupaten" class="btn-block btn-primary btn hide" data-toggle="modal" data-target="#editKabupaten"> Tambah</div>
								</div>
							  </div>
						  </div>
						  <div class="panel-body">
							<div class="row" id="canvasFilter">
								<div class="col-md-2 col-sm-6 col-xs-12">
									@foreach($dataUsers as $users)
									@if($users->geo_prov_id == "")
									<select class="form-control custom-field-litle" id="prov" name="prov" required>
										<option>--- Provinsi ---</option>
										@foreach($dataProv as $tmps)									
											<option value="{{ $tmps->geo_prov_id }}"> {{ $tmps->geo_prov_nama }} </option>
										@endforeach
									</select>
									@else
									<select class="form-control custom-field-litle hide" id="prov" name="prov" required">
										<option>--- Provinsi ---</option>
										@foreach($dataProv as $tmps)									
											<option value="{{ $tmps->geo_prov_id }}"> {{ $tmps->geo_prov_nama }} </option>
										@endforeach
									</select>
									@endif
									@endforeach
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
								<td>{{ $tmp->geo_kab_nama }}</td>
								<td>
								  <div onclick="getDataDetailWilayah('kab','','{{ $tmp->geo_kab_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								  <div onclick='editKabupaten("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","{{ $tmp->geo_kab_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
								  <a href="{{ asset('proses/delete/wilayah/kabupaten/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
								  <div onclick="printKabupaten('{{ $tmp->geo_kab_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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
	location.href="<?php echo url(); ?>/master/wilayah/kabupaten/"+prov;
});

$(document).ready(function(){
	<?php if($prov != 0) { ?>
		$('#prov').val('{{ $prov }}');
	<?php } ?>
});
function editKabupaten(prov_id,kab_id,kab_nama){
	$('#edit_id_provinsi').val(prov_id);
	$('#edit_id_kabupaten').val(kab_id);
	$('#edit_nama_kabupaten').val(kab_nama);
	$('#btnEditKabupaten').click();
}
</script>
@endsection