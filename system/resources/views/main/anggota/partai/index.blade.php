@extends('main.layout.layout')

@section('title-page','List User')

@section('main-sidebar')
@endsection

@section('content')

@include('main.anggota.partai.include.modal_detail')
@include('main.user.modal-map')
<link rel="stylesheet" href="{{ asset('asset/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('asset/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('asset/plugins/datepicker/datepicker3.css') }}">
<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
	  <h1>
		Pendaftaran Anggota
		<small>Data Anggota Partai</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Pendaftaran Anggota</li>
		<li class="active">Data Anggota Partai</li>
	  </ol>
	</section>
	
	<section class="content">
	  <div class="page-ajax"> 
	  <div class="row">
		<div class="col-md-12">
		  <div class="panel">
			<div class="box-header with-border">
			  	<div class="col-md-2 col-sm-3 col-xs-6">
					List User
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
					<div class="@yield('add-button','show') btn-block  btn-danger btn" onclick="goTo('{{ asset('anggota/partai/add') }}')"><i class="fa fa-plus"></i> Tambah</div>
				</div>
			</div>
			<div class="container-fluid">
				@include('main.layout.filter-anggota')
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
							  <th>No.Telp</th>
							  <th>Email</th>
							  <th>Alamat</th>
							  <th style="min-width: 180px;">Aksi</th>
							</tr>
						  </thead>
						  <tbody id="area-data">
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
								<td>{{ ($tmp->bio_handphone != '')?$tmp->bio_handphone:'-' }}</td>
								<td>{{ ($tmp->bio_email != '')?$tmp->bio_email:'-' }}</td>
								<td>{{ ($tmp->bio_alamat != '')?$tmp->bio_alamat:'-' }}</td>
								<td>
								  <div onclick="detailUser('{{ $tmp->id_bio }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>								
								  <div onclick="editUser('{{ $tmp->id_bio }}')" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
								  <a href="{{asset('input/hapus/user_management/'.$tmp->id_bio)}}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
								  <div onclick="printUser('{{ $tmp->id_bio }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
								</td>
							  </tr>
						  @endforeach
						  </tbody>
						</table>
						<?php echo $dataBio->render() ?>
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
$("table").dataTable().destroy();
function editUser(idUser){
	window.location.href='{{ asset("anggota/partai/list") }}/'+idUser;
}

// function editUser(idUser){
// 	window.location.href='{{ asset("hapus/user_management/") }}/'+idUser;
// }
</script>
@endsection