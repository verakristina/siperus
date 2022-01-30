@extends('main.layout.layout')

@section('title-page','List RT')

@section('main-sidebar')
@endsection

@section('content')
<?php $dataUsers = HelperData::getDataUser('idLogin'); ?>
<div class="modal primary" id="tambahRW" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/tambah/wilayah/rt') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" style="color:#fff;font-size: 14px;" id="myModalLabel">Tambah Rukun Tetangga	</h4>
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
								<input type="text" name="nama_rt" id="nama_rt" class="form-control" placeholder="Nama RW">
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
<div class="modal primary" id="editRW" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/edit/wilayah/rt') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" style="color:#fff;font-size: 14px;" id="myModalLabel">Tambah Rukun Tetangga</h4>
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
								<input type="text" name="edit_id_rt" id="edit_id_rt" class="form-control hide" placeholder="Nama RW">
								<input type="text" name="edit_nama_rt" id="edit_nama_rt" class="form-control" placeholder="Nama RW">
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
		<li class="active">Rukun Warga</li>
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
									List Rukun Tetangga
								</div>
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
									<div onclick="addRw({{session('idProvinsi')}})" class="btn-block btn-danger btn" data-toggle="modal" data-target="#tambahRW"><i class="fa fa-plus"></i> Tambah</div>
									<div id="btnEditRW" class="btn-block btn-primary btn hide" data-toggle="modal" data-target="#editRW"><i class="fa fa-plus"></i> Tambah</div>
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
								<div class="col-md-2">
									<select class="form-control custom-field-litle" id="rw" name="rw" required>
										<option>--- RW ---</option>
									</select>
								</div>
							</div>
							<table class="table table-striped table-hover">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Nama RW</th>
								  <th width="150">Aksi</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $no =1; ?>
							  @foreach($data as $tmp)
							  <tr>
								<td>{{ $no++ }}</td> 
								<td>{{ $tmp->geo_rt_nama }}</td>
								<td>
								  <div onclick="detailUser('{{ $tmp->geo_rt_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								  <div onclick='editRT("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","{{ $tmp->geo_kec_id }}","{{ $tmp->geo_deskel_id }}","{{ $tmp->geo_rw_id }}","{{ $tmp->geo_rt_id }}","{{ $tmp->geo_rt_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
								  <a href="{{ asset('proses/delete/wilayah/rt/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id.'/'.$tmp->geo_kec_id.'/'.$tmp->geo_deskel_id.'/'.$tmp->geo_rw_id.'/'.$tmp->geo_rt_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
								  <div onclick="printUser('{{ $tmp->geo_rt_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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
	changeKabupatenOptionKPU(this,'#kab',prov);
});
$('#id_provinsi').change(function(){
	var prov = $(this).val();
	changeKabupatenOptionKPU(this,'#id_kabupaten',prov);
});
$('#kab').change(function(){
	var prov = $('#prov').val();
	var kab = $(this).val();
	changeKecamatanOptionKPU(this,'#kec',prov,kab);
});
$('#id_kabupaten').change(function(){
	var prov = $('#id_provinsi').val();
	var kab = $(this).val();
	changeKecamatanOptionKPU(this,'#id_kecamatan',prov,kab);
});
$('#kec').change(function(){
	var prov = $('#prov').val();
	var kab = $('#kab').val();
	var kec = $(this).val();
	changeKelurahanOptionKPU(this,'#kel',prov,kab,kec);
});
$('#id_kecamatan').change(function(){
	var prov = $('#id_provinsi').val();
	var kab = $('#id_kabupaten').val();
	var kec = $(this).val();
	changeKelurahanOptionKPU(this,'#id_kelurahan',prov,kab,kec);
});
$('#kel').change(function(){
	var prov = $('#prov').val();
	var kab = $('#kab').val();
	var kec = $('#kec').val();
	var kel = $(this).val();
	changeRWOptionKPU(this,'#rw',prov,kab,kec,kel);
});
$('#id_kelurahan').change(function(){
	var prov = $('#prov').val();
	var kab = $('#kab').val();
	var kec = $('#kec').val();
	var kel = $(this).val();
	changeRWOptionKPU(this,'#id_rw',prov,kab,kec,kel);
});
$('#rw').change(function(){
	var prov = $('#prov').val();
	var kab = $('#kab').val();
	var kec = $('#kec').val();
	var kel = $('#kel').val();
	var rw = $(this).val();
	location.href="<?php echo url(); ?>/master/wilayah/rt/"+prov+"/"+kab+"/"+kec+"/"+kel+"/"+rw;
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
function editRT(prov_id,kab_id,kec_id,kel_id,rw_id,rt_id,rt_nama){
	$('#edit_id_prov').val(prov_id);
	$('#edit_id_kab').val(kab_id);
	$('#edit_id_kec').val(kec_id);
	$('#edit_id_kel').val(kel_id);
	$('#edit_id_rw').val(rw_id);
	$('#edit_id_rt').val(rt_id);
	$('#edit_nama_rt').val(rt_nama);
	$('#btnEditRW').click();
}
function addRw(prov_id){
	changeKabupatenOptionKPU(prov_id,'#id_kabupaten',prov_id);
}
</script>
@endsection