@extends('main.layout.layout')

@section('title-page','List TPS')

@section('main-sidebar')
@endsection

@section('content')
<?php $dataUsers = HelperData::getDataUser('idLogin'); ?>
<div class="modal primary" id="tambahTPS" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/tambah/wilayah/tps') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" style="color:#fff;font-size: 14px;" id="myModalLabel">Tambah TPS</h4>
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
								<select name="id_kelurahan" id="id_kelurahan" class="form-control">
									<option value="">--- Kelurahan ---</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama TPS</label>
							<div class="col-md-8">
								<input type="text" name="nama_tps" id="nama_tps" class="form-control" placeholder="Nama TPS">
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
<div class="modal primary" id="editTPS" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/edit/wilayah/tps') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" style="	color:#fff;font-size: 14px;" id="myModalLabel">Edit Kecamatan</h4>
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
							<label for="nama" class="col-md-4">Nama TPS</label>
							<div class="col-md-8">
								<input type="text" name="edit_id_tps" id="edit_id_tps" class="form-control hide" placeholder="Nama TPS">
								<input type="text" name="edit_nama_tps" id="edit_nama_tps" class="form-control" placeholder="Nama TPS">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger"  id="barangbuktibtn">Edit</button>
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
		<li class="active">TPS</li>
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
									List TPS
								</div>
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
									<div onclick="addTps({{session('idProvinsi')}})" class="btn-block btn-danger btn" data-toggle="modal" data-target="#tambahTPS"><i class="fa fa-plus"></i> Tambah</div>
									<div id="btnEditTPS" class="btn-block btn-primary btn hide" data-toggle="modal" data-target="#editTPS"><i class="fa fa-plus"></i> Tambah</div>
								</div>
							  </div>
						  </div>
						  <div class="panel-body">
							<div class="row" id="canvasFilter">
									@foreach($dataUsers as $users)
									@if($users->geo_prov_id == "")
								<div class="col-md-2">
								@else	
								<div class="col-md-2 hide">
								@endif
										@endforeach
									<select class="form-control custom-field-litle" id="prov" name="prov" required>
										<option>--- Provinsi ---</option>
										@foreach($dataProv as $tmp)									
											<option value="{{ $tmp->geo_prov_id }}"> {{ $tmp->geo_prov_nama }} </option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control custom-field-litle" id="kab" name="kab" required>
										<option>--- Kabupaten ---</option>
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control custom-field-litle" id="kec" name="kec" required>
										<option>--- Kecamatan ---</option>
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control custom-field-litle" id="kel" name="kel" required>
										<option>--- Kelurahan ---</option>
									</select>
								</div>
							</div>
							<table class="table table-striped table-hover">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Nama TPS</th>
								  <th width="150">Aksi</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $no =1; ?>
							  @foreach($data as $tmp)
							  <tr>
								<td>{{ $no++ }}</td> 
								<td>{{ $tmp->geo_tps_nama }}</td>
								<td>
								  <div onclick="getDataDetailWilayah('tps','{{ $tmp->geo_prov_id }}','{{ $tmp->geo_kab_id }}','{{ $tmp->geo_kec_id }}','{{ $tmp->geo_deskel_id }}','','{{ $tmp->geo_tps_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								  <div onclick='editTPS("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","{{ $tmp->geo_kec_id }}","{{ $tmp->geo_deskel_id }}","{{ $tmp->geo_tps_id }}","{{ $tmp->geo_tps_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
								  <a href="{{ asset('proses/delete/wilayah/tps/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id.'/'.$tmp->geo_kec_id.'/'.$tmp->geo_deskel_id.'/0/'.$tmp->geo_tps_id) }}" onclick="return confirm('Apakah anda yakin ingin mengapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
								  <div onclick="printUser('{{ $tmp->geo_tps_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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
	changeKelurahanOptionKPU('#kec','#kel',prov,kab,kec);
});
$('#id_kecamatan').change(function(){
	var prov = $('#id_provinsi').val();
	var kab = $('#id_kabupaten').val();
	var kec = $(this).val();
	changeKelurahanOptionKPU('#id_kecamatan','#id_kelurahan',prov,kab,kec);
});
$('#kel').change(function(){
	var prov = $('#prov').val();
	var kab = $('#kab').val();
	var kec = $('#kec').val();
	var kel = $(this).val();
	location.href="<?php echo url(); ?>/master/wilayah/tps/"+prov+"/"+kab+"/"+kec+"/"+kel;
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
		$('#prov').val('{{ $prov }}');
		$('#kab').val('{{ $kab }}');
		$('#kec').val('{{ $kec }}');
		$('#kel').val('{{ $kel }}');
	<?php } ?>
});
function editTPS(prov_id,kab_id,kec_id,kel_id,tps_id,tps_nama){
	$('#edit_id_prov').val(prov_id);
	$('#edit_id_kab').val(kab_id);
	$('#edit_id_kec').val(kec_id);
	$('#edit_id_kel').val(kel_id);
	$('#edit_id_tps').val(tps_id);
	$('#edit_nama_tps').val(tps_nama);
	$('#btnEditTPS').click();
}
function addTps(prov_id){
	changeKabupatenOptionKPU(prov_id,'#id_kabupaten',prov_id);
}
</script>
@endsection