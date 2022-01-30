@extends('main.layout.layout')

@section('title-page','Struktur DPP')

@section('main-sidebar')
@endsection

@section('content')
<div class="modal primary" id="tambahProvinsi" role="dialog" aria-labelledby="tambahProvinsiLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/tambah/struktur/dpp') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Tambah Struktur DPP</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Struktur DPP</label>
							<div class="col-md-8">
								<input type="text" name="nama_dpp" id="nama_dpp" class="form-control" placeholder="Nama Struktur DPP">
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
		<form action="{{ asset('proses/edit/struktur/dpp') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Edit Struktur DPP</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Struktur DPP</label>
							<div class="col-md-8">
								<input type="text" name="edit_id_dpp" id="edit_id_dpp" class="form-control hide" placeholder="Nama Struktur DPP">
								<input type="text" name="edit_nama_dpp" id="edit_nama_dpp" class="form-control" placeholder="Nama Struktur DPP">
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
		<li class="active">DPP</li>
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
									List Struktur DPP
								</div>
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
									<div class="btn-block btn-danger btn" data-toggle="modal" data-target="#tambahProvinsi"><i class="fa fa-plus"></i> Tambah</div>
									<div id="btnEditProvinsi" class="btn-primary btn hide" data-toggle="modal" data-target="#editProvinsi"><i class="fa fa-plus"></i> Tambah</div>
								</div>
							  </div>
						  </div>
						  <div class="panel-body">
							<table class="table table-striped table-hover">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Nama Struktur DPP</th>
								  <th width="150">Aksi</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php $no =1; ?>
							  @foreach($data as $tmp)
							  <tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->struk_dpp_nama }}</td>
								<td>
								  <div onclick="detailUser('{{ $tmp->struk_dpp_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								  <div onclick='editProvinsi("{{ $tmp->struk_dpp_id }}","{{ $tmp->struk_dpp_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
								  <a href="{{ asset('proses/delete/struktur/dpp/'.$tmp->struk_dpp_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
								  <div onclick="printUser('{{ $tmp->struk_dpp_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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
function editProvinsi(prov_id,prov_nama){
	$('#edit_id_dpp').val(prov_id);
	$('#edit_nama_dpp').val(prov_nama);
	$('#btnEditProvinsi').click();
}
</script>
@endsection