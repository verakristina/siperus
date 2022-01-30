@extends('main.layout.layout')

@section('title-page','List User')

@section('main-sidebar')
@endsection

@section('content')
@include('main.user.modal-map')
<link rel="stylesheet" href="{{ asset('asset/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('asset/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('asset/plugins/datepicker/datepicker3.css') }}">
<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
	  <h1>
		User Management
		<small>List User</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>User Management</li>
		<li class="active">List User</li>
	  </ol>
	</section>
	
	<section class="content">
	  <div class="page-ajax"> 
	  <div class="row">
		<div class="col-md-12">
		  <div class="panel">
			<div class="box-header with-border">
			  List User
			</div>
				   <div class="response-cari">
					  <!-- /.box-tools -->
					  <?php $no=1; ?>
					  <div class="box-body"> 
						<table class="table table-striped table-hover" id="tablePendaftar">
						  <thead>
							<tr>
							  <th>No</th>
							  <th>Nama</th>
							  <th>Jenis Kelamin</th>
							  <th>TTL</th>
							  <th>No Telp</th>
							  <th>Email</th>
							  <th>Alamat</th>
							  <th>Status Daftar</th>
							  <th style="min-width: 180px;">Aksi</th>
							</tr>
						  </thead>
						  <tbody>
						  @foreach($dataBio as $tmp)
							<?php
								$namaLengkap = array();
								array_push($namaLengkap,ucwords(strtolower($tmp->bio_nama_depan)),ucwords(strtolower($tmp->bio_nama_tengah)),ucwords(strtolower($tmp->bio_nama_belakang)));
							?>
							  <tr>
								<td>{{ $no++ }}</td>
								<td>{{ join(' ',$namaLengkap) }}</td>
								<td>{{ ($tmp->jk_value != '')?$tmp->jk_value:'-' }}</td>
								<td>{{ ($tmp->bio_tanggal_lahir != '')?date('d-m-Y',strtotime($tmp->bio_tanggal_lahir)):'-' }}</td>
								<td>{{ ($tmp->bio_telephone != '')?$tmp->bio_telephone:'-' }}</td>
								<td>{{ ($tmp->bio_email != '')?$tmp->bio_email:'-' }}</td>
								<td>{{ ($tmp->bio_alamat != '')?$tmp->bio_alamat:'-' }}</td>
								<td>{{ ($tmp->bio_status != '')?$tmp->bio_status:'-' }}</td>
								<td>
								  <div onclick="actionUser('{{ $tmp->bio_id }}','1','#tablePendaftar')" id="terima" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" data-original-title="Terima"><i class="fa fa-check"></i></div>								
								  <div onclick="actionUser('{{ $tmp->bio_id }}','2','#tablePendaftar')" id="tolak" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Tolak"><i class="fa fa-times"></i></div>
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
	  </div>
	</section>
</div>
@endsection