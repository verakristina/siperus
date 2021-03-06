@extends('main.layout.layout')

@section('title-page','Setting')

@section('main-sidebar')
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	  <h1>
        Setting
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Setting</li>
      </ol>
    </section>
	    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
	  <div class="row">
		<div class="col-md-12">
		  <div class="nav-tabs-custom tab-info">
			<ul class="nav nav-tabs">
			  <li class="active hakAkses"><a id='linkhakakses' href="#hakAkses" data-toggle="tab">Hak Akses</a></li>
			  <li class="agama"><a id='linkagama' href="#agama" data-toggle="tab">Agama</a></li>
			  <li class="identitas"><a id='linkidentitas' href="#identitas" data-toggle="tab">Identitas</a></li>
			  <li class="jk"><a id='linkjk' href="#jk" data-toggle="tab">Jenis Kelamin</a></li>
			  <li class="pekerjaan"><a id='linkpekerjaan' href="#pekerjaan" data-toggle="tab">Perkerjaan</a></li>
			  <li class="statusKawin"><a id='linkstatuskawin' href="#statusKawin" data-toggle="tab">Status Kawin</a></li>
			</ul>
			<div class="tab-content">
			  <div class="active tab-pane" id="hakAkses">
				<div class="col-md-6 no-padding">
					<div class="btn-danger btn" data-toggle="modal" data-target="#modalTambahHakAkses">Tambah</div>
				</div>
				<table class="table table-striped data-table" style="font-size:15px;">
					<thead>
						<tr>
							<th>No</th>
							<th>Data</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						@foreach($dataAkses as $tmp)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->value }}</td>
								<td><div class="btn-warning btn" onclick="editSeting('akses','{{ $tmp->akses_id }}')"><span class="glyphicon glyphicon-pencil"></span></div>
								<a href="{{ asset('proses/hapusset/akses/'.$tmp->akses_id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><div class="btn btn-danger hapus-petugas"><span class="glyphicon glyphicon-trash"></span></div></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			  </div>
			  <!-- /.tab-pane -->
			  <div class="tab-pane" id="agama">
				<div class="col-md-6 no-padding">
					<div class="btn-danger btn" data-toggle="modal" data-target="#modalTambahHakAkses">Tambah</div>
				</div>
				<table class="table table-striped data-table" style="font-size:15px;">
					<thead>
						<tr>
							<th>No</th>
							<th>Data</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						@foreach($dataAgama as $tmp)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->value }}</td>
								<td><div class="btn-warning btn" onclick="editSeting('akses','{{ $tmp->id }}')"><span class="glyphicon glyphicon-pencil"></span></div>
								<a href="{{ asset('proses/hapusset/akses/'.$tmp->id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><div class="btn btn-danger hapus-petugas"><span class="glyphicon glyphicon-trash"></span></div></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			  </div>
			  <!-- /.tab-pane -->
			  <div class="tab-pane" id="identitas">
				<div class="col-md-6 no-padding">
					<div class="btn-danger btn" data-toggle="modal" data-target="#modalTambahHakAkses">Tambah</div>
				</div>
				<table class="table table-striped data-table" style="font-size:15px;">
					<thead>
						<tr>
							<th>No</th>
							<th>Data</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						@foreach($dataIdentitas as $tmp)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->value }}</td>
								<td><div class="btn-warning btn" onclick="editSeting('akses','{{ $tmp->id }}')"><span class="glyphicon glyphicon-pencil"></span></div>
								<a href="{{ asset('proses/hapusset/akses/'.$tmp->id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><div class="btn btn-danger hapus-petugas"><span class="glyphicon glyphicon-trash"></span></div></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			  </div>
			  <!-- /.tab-pane -->
			  <div class="tab-pane" id="jk">
				<div class="col-md-6 no-padding">
					<div class="btn-danger btn" data-toggle="modal" data-target="#modalTambahHakAkses">Tambah</div>
				</div>
				<table class="table table-striped data-table" style="font-size:15px;">
					<thead>
						<tr>
							<th>No</th>
							<th>Data</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						@foreach($dataJk as $tmp)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->value }}</td>
								<td><div class="btn-warning btn" onclick="editSeting('akses','{{ $tmp->id }}')"><span class="glyphicon glyphicon-pencil"></span></div>
								<a href="{{ asset('proses/hapusset/akses/'.$tmp->id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><div class="btn btn-danger hapus-petugas"><span class="glyphicon glyphicon-trash"></span></div></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			  </div>
			  <!-- /.tab-pane -->
			  <div class="tab-pane" id="pekerjaan">
				<div class="col-md-6 no-padding">
					<div class="btn-danger btn" data-toggle="modal" data-target="#modalTambahHakAkses">Tambah</div>
				</div>
				<table class="table table-striped data-table" style="font-size:15px;">
					<thead>
						<tr>
							<th>No</th>
							<th>Data</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						@foreach($dataPekerjaan as $tmp)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->value }}</td>
								<td><div class="btn-warning btn" onclick="editSeting('akses','{{ $tmp->id }}')"><span class="glyphicon glyphicon-pencil"></span></div>
								<a href="{{ asset('proses/hapusset/akses/'.$tmp->id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><div class="btn btn-danger hapus-petugas"><span class="glyphicon glyphicon-trash"></span></div></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			  </div>
			  <!-- /.tab-pane -->
			  <div class="tab-pane" id="statusKawin">
				<div class="col-md-6 no-padding">
					<div class="btn-danger btn" data-toggle="modal" data-target="#modalTambahHakAkses">Tambah</div>
				</div>
				<table class="table table-striped data-table" style="font-size:15px;">
					<thead>
						<tr>
							<th>No</th>
							<th>Data</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						@foreach($dataStatus as $tmp)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $tmp->value }}</td>
								<td><div class="btn-warning btn" onclick="editSeting('akses','{{ $tmp->id }}')"><span class="glyphicon glyphicon-pencil"></span></div>
								<a href="{{ asset('proses/hapusset/akses/'.$tmp->id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><div class="btn btn-danger hapus-petugas"><span class="glyphicon glyphicon-trash"></span></div></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			  </div>
			  <!-- /.tab-pane -->
			</div>
			<!-- /.tab-content -->
		  </div>
		  <!-- /.nav-tabs-custom -->
		</div>
	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<div id="modelButtonEdit" class="hidden btn-warning btn" data-toggle="modal" data-target="#modelEdit">Edit</div>
<div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">  
	<div class="modal-content">
	  <div class="modal-header modal-header-default modal-danger">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div class="modal-title" id="myModalLabel">Edit Data</div>
	  </div>
	  <div class="modal-body" id="modelEditPlace">	
	  
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn-danger btn" data-dismiss="modal">Close</button>
		<button type="button" class="btn-danger btn" onclick="$('#btn-save').click()">Save changes</button>
	  </div>
	</div>
  </div>
</div>

<script src="{{ asset('asset/dist/js/jquery-3.0.0.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){ 
		$('#link<?php echo session('tabActive'); ?>').click();
	});
	function editSeting(jenis,id){
		$.ajax({
			type : "get",
			url  : "<?php echo url(); ?>/setting/edit/"+jenis+"/"+id,
			success:function(data){
				$('#modelEditPlace').html(data);
				$('#modelEditPlace').modal('show');
			}
		}).done(function(){			
			$('#modelButtonEdit').click();
		});
	}
</script>
@endsection