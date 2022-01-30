@extends('main.layout.layout')

@section('title-page','List DPD ')

@section('main-sidebar')
@endsection

@section('content')
<?php $dataUsers = HelperData::getDataUser('idLogin'); ?>
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
					   <div class="response-cari" style="overflow-x:auto;">
						  <!-- /.box-tools -->
						  <?php $no=1; ?>
						  <div class="panel-body">
							<div class="col-md-2">
								<div class="btn-block btn-primary btn" data-toggle="modal" data-target="#tambahDPD" style="margin-bottom:-20px;"> Tambah</div>
							</div>
							<div class="col-md-2">
								<select class="form-control custom-field-litle" id="provinsi" name="provinsi" required>
									<option>--- Provinsi ---</option>
									@foreach($dataProv as $tmp)									
										<option value="{{ $tmp->geo_prov_id }}"> {{ $tmp->geo_prov_nama }} </option>
									@endforeach
								</select>
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
								<td>{{ $tmp->geo_rw_nama }}</td>
								<td>
								  <a href=""><div class="btn-primary btn btn-xs"><span class="glyphicon glyphicon-edit"></span></div></a>
								  <a href="{{ asset('proses/delete/wilayah/rw/'.$tmp->geo_rw_id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><div class="btn-danger btn btn-xs"><span class="glyphicon glyphicon-trash"></span></div></a>
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
@endsection