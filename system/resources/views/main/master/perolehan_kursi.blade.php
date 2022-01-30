@extends('main.layout.layout')

@section('title-page','List Statistik')

@section('main-sidebar')
@endsection

@section('content')
<div class="modal primary moda-fade" id="tambahProvinsi" role="dialog" aria-labelledby="tambahProvinsiLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/perolehankursi') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Tambah Statistik</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Provinsi</label>
							<div class="col-md-8">
								@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
									@foreach($dataProvinsi as $tmp)
										{{ ($tmp->geo_prov_id == session('idProvinsi')?$tmp->geo_prov_nama:'') }}
									@endforeach
									{{--*/ $statusProvinsi = 'hide' /*--}}
								@else
									{{--*/ $statusProvinsi = 'show' /*--}}
								@endif
								<select name="provinsi" id="provinsis" class="{{ $statusProvinsi }} form-control custom-field-litle"  >
									<option selected disabled class="text-hide">--- Pilih Provinsi ---</option>
									@foreach($dataProvinsi as $tmp)
										<option value="{{$tmp->geo_prov_id}}" {{ ($tmp->geo_prov_id == session('idProvinsi') && session('idRole') == 3)?'selected':'' }}>{{$tmp->geo_prov_nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Dapil DRP RI</label>
							<div class="col-md-8">
								<input type="text" name="dapil_t1" id="dapil_t1" class="form-control" placeholder="Pengurus DPC">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Dapil DRPD I</label>
							<div class="col-md-8">
								<input type="text" name="dapil_t2" id="dapil_t2" class="form-control" placeholder="Pengurus PAC">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Dapil DRPD II</label>
							<div class="col-md-8">
								<input type="text" name="dapil_t3" id="dapil_t3" class="form-control" placeholder="Pengurus KPA">
							</div>
						</div>
						
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Kursi DRP RI (jumlah/ada)</label>
							<div class="col-md-4">
								<input type="text" name="kursi_t1" id="kursi_t1" class="form-control" placeholder="Pengurus DPC">
							</div>
							<div class="col-md-4">
								<input type="text" name="kursi_t1_ada" id="kursi_t1_ada" class="form-control" placeholder="Pengurus DPC">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Kursi DRPD I (jumlah/ada)</label>
							<div class="col-md-4">
								<input type="text" name="kursi_t2" id="kursi_t2" class="form-control" placeholder="Pengurus PAC">
							</div>
							<div class="col-md-4">
								<input type="text" name="kursi_t2_ada" id="kursi_t2_ada" class="form-control" placeholder="Pengurus PAC">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Kursi DRPD II (jumlah/ada)</label>
							<div class="col-md-4">
								<input type="text" name="kursi_t3" id="kursi_t3" class="form-control" placeholder="Pengurus KPA">
							</div>
							<div class="col-md-4">
								<input type="text" name="kursi_t3_ada" id="kursi_t3_ada" class="form-control" placeholder="Pengurus KPA Ada">
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
		<form action="{{ asset('proses/perolehankursi') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Edit Provinsi</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Provinsi</label>
							<div class="col-md-8">
								@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL  && session('idRole') == 3)
									@foreach($dataProvinsi as $tmp)
										{{ ($tmp->geo_prov_id == session('idProvinsi'))?$tmp->geo_prov_nama:'' }}
									@endforeach
								@endif
								<select name="edit_statistik" id="edit_statistik" class="{{ $statusProvinsi }} form-control custom-field-litle"  >
									<option selected disabled class="text-hide">--- Pilih Provinsi ---</option>
									@foreach($dataProvinsi as $tmp)
										<option value="{{$tmp->geo_prov_id}}">{{$tmp->geo_prov_nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Dapil DRP RI</label>
							<div class="col-md-8">
								<input type="text" name="edit_dapil_t1" id="edit_dapil_t1" class="form-control" placeholder="Pengurus DPC">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Dapil DRPD I</label>
							<div class="col-md-8">
								<input type="text" name="edit_dapil_t2" id="edit_dapil_t2" class="form-control" placeholder="Pengurus PAC">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Dapil DRPD II</label>
							<div class="col-md-8">
								<input type="text" name="edit_dapil_t3" id="edit_dapil_t3" class="form-control" placeholder="Pengurus KPA">
							</div>
						</div>
						
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Kursi DRP RI (jumlah/ada)</label>
							<div class="col-md-4">
								<input type="text" name="edit_kursi_t1" id="edit_kursi_t1" class="form-control" placeholder="Pengurus DPC">
							</div>
							<div class="col-md-4">
								<input type="text" name="edit_kursi_t1_ada" id="edit_kursi_t1_ada" class="form-control" placeholder="Pengurus DPC">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Kursi DRPD I (jumlah/ada)</label>
							<div class="col-md-4">
								<input type="text" name="edit_kursi_t2" id="edit_kursi_t2" class="form-control" placeholder="Pengurus PAC">
							</div>
							<div class="col-md-4">
								<input type="text" name="edit_kursi_t2_ada" id="edit_kursi_t2_ada" class="form-control" placeholder="Pengurus PAC">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Kursi DRPD II (jumlah/ada)</label>
							<div class="col-md-4">
								<input type="text" name="edit_kursi_t3" id="edit_kursi_t3" class="form-control" placeholder="Pengurus KPA">
							</div>
							<div class="col-md-4">
								<input type="text" name="edit_kursi_t3_ada" id="edit_kursi_t3_ada" class="form-control" placeholder="Pengurus KPA Ada">
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
		<small>Statistik</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Master Data</li>
		<li class="active">Statistik</li>
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
								  <div class="btn-warning btn-block btn" data-toggle="modal" data-target="#tambahProvinsi"><i class="fa fa-plus"></i> Tambah</div>
								</div>
							  </div>
						  </div>
						  <div class="panel-body">
							<table class="table table-striped table-hover">
							  <thead>
								<tr>
								  <th rowspan="2">No</th>
								  <th rowspan="2">Nama Provinsi</th>
								  <th colspan="2">DPR RI</th>
								  <th colspan="2">DPRD I</th>
								  <th colspan="2">DPRD II</th>
								  <th rowspan="2" width="150">Aksi</th>
								</tr>
								<tr>
									<th>Dapil</th>
									<th>Kursi</th>
									<th>Dapil</th>
									<th>Kursi</th>
									<th>Dapil</th>
									<th>Kursi</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $no =1; ?>
							  @foreach($data as $tmp)
							  <?php
								$dataEdit = "'".$tmp->statistik_kursi_id."','".$tmp->geo_prov_id."','".$tmp->statistik_dapil_t1."','".$tmp->statistik_dapil_t2."','".$tmp->statistik_dapil_t3."','".$tmp->statistik_kursi_t1."','".$tmp->statistik_kursi_t2."','".$tmp->statistik_kursi_t3."','".$tmp->statistik_kursi_t1_ada."','".$tmp->statistik_kursi_t2_ada."','".$tmp->statistik_kursi_t3_ada."'";
							  ?>
							  <tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->geo_prov_nama }}</td>
								<td>{{ $tmp->statistik_dapil_t1 }}</td>
								<td>{{ $tmp->statistik_kursi_t1_ada }} / {{ $tmp->statistik_kursi_t1 }}</td>
								<td>{{ $tmp->statistik_dapil_t2 }}</td>
								<td>{{ $tmp->statistik_kursi_t2_ada }} / {{ $tmp->statistik_kursi_t2 }}</td>
								<td>{{ $tmp->statistik_dapil_t3 }}</td>
								<td>{{ $tmp->statistik_kursi_t3_ada }} / {{ $tmp->statistik_kursi_t3 }}</td>
								<td>								
								  <div onclick="detailStatistik('{{ $tmp->geo_prov_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								  <div class="{{ (session('idProvinsi') != $tmp->geo_prov_id && session('idRole') == 3)?$statusProvinsi:'' }}  btn btn-warning" onclick='editStatistik({{ $dataEdit }})'><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"></span></div></a>
								  <a href="{{ asset('proses/perolehankursi/'.$tmp->statistik_kursi_id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><div class=" {{ (session('idProvinsi') != $tmp->geo_prov_id && session('idRole') == 3)?$statusProvinsi:'' }}  btn-danger btn"><span class="glyphicon glyphicon-trash"></span></div></a>
								  <div onclick="printStatistik('{{ $tmp->geo_prov_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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
function editStatistik(statistik,prov,dapil1,dapil2,dapil3,kursi1,kursi2,kursi3,kursi1_ada,kursi2_ada,kursi3_ada){
	$('#edit_statistik').val(statistik);
	$('#edit_provinsi').val(prov);
	$('#edit_dapil_t1').val(dapil1);
	$('#edit_dapil_t2').val(dapil2);
	$('#edit_dapil_t3').val(dapil3);
	$('#edit_kursi_t1').val(kursi1);
	$('#edit_kursi_t2').val(kursi2);
	$('#edit_kursi_t3').val(kursi2);
	$('#edit_kursi_t1_ada').val(kursi1_ada);
	$('#edit_kursi_t2_ada').val(kursi2_ada);
	$('#edit_kursi_t3_ada').val(kursi2_ada);
	$('#btnEditProvinsi').click();
}
</script>
@endsection