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
						<table class="table table-striped table-hover">
						  <thead>
							<tr>
							  <th>No</th>
							  <th>Nama</th>
							  <th>JK</th>
							  <th>TTL</th>
							  <th>No Telp</th>
							  <th>Email</th>
							  <th>Alamat</th>
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
								<td>{{ ($tmp->jk_alias != '')?$tmp->jk_alias:'-' }}</td>
								<td>{{ ($tmp->bio_tanggal_lahir != '')?date('d-m-Y',strtotime($tmp->bio_tanggal_lahir)):'-' }}</td>
								<td>{{ ($tmp->bio_telephone != '')?$tmp->bio_telephone:'-' }}</td>
								<td>{{ ($tmp->bio_email != '')?$tmp->bio_email:'-' }}</td>
								<td>{{ ($tmp->bio_alamat != '')?$tmp->bio_alamat:'-' }}</td>
								<td>
								  <div onclick="detailUser('{{ $tmp->bio_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>								
								  <div onclick="editUser('{{ $tmp->bio_id }}')" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
								  <a href="{{asset('input/hapus/user_management/'.$tmp->bio_id)}}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
								  <div onclick="printUser('{{ $tmp->bio_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
								</td>
							  </tr>
						  @endforeach
						  </tbody>
						</table>
						<?php
						echo str_replace('/?', '?', $dataBio->render());
						?>
					  </div>
				   </div>
				  </div>
			</div>
		  </div>
		</div>
	  </div>
	</section>
</div>

<script>
function editUser(idUser){
	window.location.href='{{ asset("user_management/list") }}/'+idUser;
}
function detailUser(idUser){
	window.location.href='{{ asset("user_management/list/detail") }}/'+idUser;
}

</script>
@endsection