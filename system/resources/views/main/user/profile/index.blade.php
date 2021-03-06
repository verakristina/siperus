@extends('main.layout.layout')

@section('title-page','Profile')

@section('main-sidebar')
@endsection

@section('content')
@include('main.user.modal-map')
<?php $dataUsers = HelperData::getDataUser('idLogin'); 
foreach($dataUsers as $tmps){} ?>

<div class="modal modal-default" id="modal-privasi">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header clr-warning modal-title">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Akun</h4>
			</div>
			<div class="modal-body">
				<form action="{{ asset('view/profile') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data" novalidate>
					<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
					<div class="row">
						<div class="col-md-12">
							<label class="col-md-4">Nama</label>
							<div class="col-md-8">
								<input type="text" name="nameUser" id="nameUser" class="form-control" placeholder="Nama Pengguna Baru" value="{{ $tmps->name }}">
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label class="col-md-4">Username</label>
							<div class="col-md-8">
								<input type="hidden" name="idUser" id="idUser" class="form-control" placeholder="Username" readonly="" value="{{ $tmps->id }}">
								<input type="text" name="username" id="username" class="form-control" placeholder="Nama Pengguna Baru" value="{{ $tmps->username }}">
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label class="col-md-4">Kata Sandi Baru</label>
							<div class="col-md-8">
								<input type="password" name="passwordBaru" id="passwordBaru" class="form-control" placeholder="Kata Sandi Baru" value="{{ $tmps->password }}">
							</div>
						</div>
					</div>
					<button type="submit" id="saveForm" class="hide btn btn-danger">Simpan</button>
				</form>
			</div>
			<div class="modal-footer">
				<input type="hidden" id="next-modal" data-toggle="modal" data-target="#modal-konfirmasi">
				<div type="submit" class="btn btn-danger" onclick="savePassword()">Simpan</div>
			</div>
		</div>
	</div>
</div>
<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
	  <h1>
		Profile
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Profile</li>
	  </ol>
	</section>
	
	<section class="content">
		<div class="panel">
			<div class="box-header with-border">
			  <div class="row">
				<div class="col-md-2 col-sm-3 col-xs-6">
					Profile
				</div>
			  </div>
			</div>
            <div class="box-body">
			<!-- <form action="{{ asset('view/profile') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data" novalidate>
			<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
              <div class="row">
                <div class="col-md-3 col-sm-4">
                  <div class="form-group">
					<div class="canvas-picture">
						<div class="picture">
							@if(isset($tmps->pic))
								{{--*/ $gambarUser = 'dokumen/'.session('idLogin').'/foto/'.$tmps->pic /*--}}
							@else
								{{--*/ $gambarUser = 'blank_profil.png' /*--}}
							@endif
								<img name="newProfileImage" id="newProfileImage" src="{{ asset('asset/img/'.$gambarUser) }}" alt="{{ $gambarUser }}" width="100%" height="100%" />
						</div>
					</div>
                  </div>
                  <div class="form-group">
                    <input type="file" name="image" class="form-control drop" data-height="168px" data-default-file="">
                  </div>
                </div>
                <div class="col-md-8 col-sm-8 col-md-offset-1">
                  <div class="row"> 
					  <div class="form-group col-md-4 col-sm-6 ">
						<label>Nama</label>
                      </div>
					  <div class="col-md-7 col-sm-6">
						<input type="text" name="nameUser" id="nameUser" class="form-control" placeholder="Name" value="{{ $tmps->name }}">
                      </div> 
                  </div>
                  <div class="row"> 
					  <div class="form-group col-md-4 col-sm-6 ">
						<label>Username</label>
                      </div>
					  <div class="col-md-7 col-sm-6">
						<input type="hidden" name="idUser" id="idUser" class="form-control" placeholder="Username" readonly="" value="{{ $tmps->id }}">
						<input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ $tmps->username }}">
                      </div> 
                  </div>
                  <div class="row"> 
					  <div class="form-group col-md-4 col-sm-6 ">
                        <label>Password</label>
                      </div>
					  <div class="col-md-7 col-sm-6">
                        <input type="password" name="passwordBaru" id="passwordBaru" class="form-control" placeholder="Password Baru" value="{{ $tmps->password }}">
                      </div> 
                  </div>
                <!--  <div class="row"> 
					  <div class="form-group col-md-4 col-sm-6 ">
                        <label>Ulangi Password Baru</label>
                      </div>
					  <div class="col-md-7 col-sm-6">
                        <input onkeyup="checkPassword(this.value,'new')" type="password" name="cekPasswordBaru" id="cekPasswordBaru" class="form-control" placeholder="Ulangi Password Baru" >
                      </div> 
                  </div>
                  <div class="row">
					  <div class="col-md-7 col-sm-6 col-md-offset-4">
                        <span id="responseCek" class="none"></span>
                      </div>  
                  </div>
                  <div class="row"> 
					  <div class="form-group col-md-4 col-sm-6 ">
                        <label>Password Lama</label>
                      </div>
					  <div class="col-md-7 col-sm-6">
                        <input onkeyup="checkPassword(this.value,'old')" type="password" name="passwordLama" id="passwordLama" class="form-control" placeholder="Password Lama" >
                      </div> 
                  </div>
                  <div class="row">
					  <div class="col-md-7 col-sm-6 col-md-offset-4">
                        <span id="responsePass" class="none"></span>
                      </div>  
                  </div> --
                  <div class="row">
                    <div class="col-md-11">
                      <div class="pull-right">
                        <div type="submit" class="btn btn-warning" onclick="savePassword()">Simpan</div>
                        <button type="submit" id="saveForm" class="hide btn btn-warning">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </form>-->
							<div class="row">
								<div class="col-md-12">
					        		<div class="nav-tabs-custom">
							            <ul class="nav nav-tabs">
							            	<li class="active"><a href="#profile" data-toggle="tab" id="linkProfile"> Profile</a></li>
							              	<li><a href="#biodata" data-toggle="tab" id="linkBiodata">Biodata</a></li>
							            </ul>
							            <div class="tab-content">
							            	<div class="active tab-pane" id="profile">
							            		<div class="row">
							            			<div class="box-body box-profile">
														@if(isset($tmps->pic))
															{{--*/ $gambarUser = 'dokumen/'.session('idLogin').'/foto/'.$tmps->pic /*--}}
														@else
															{{--*/ $gambarUser = 'blank_profil.png' /*--}}
														@endif															
															<img class="profile-user-img img-responsive img-circle" src="{{ asset('asset/img/'.$gambarUser) }}" alt="{{ asset('asset/img/'.$gambarUser) }}">													
										          		<h3 class="profile-username text-center">{{ $tmps->name }}</h3>
											          	<ul class="list-group list-group-unbordered" style="width: 350px; margin: 20px auto;">
											            	<li class="list-group-item">
											              		<b>Nama</b> <a class="pull-right">{{ $tmps->name }}</a>
											            	</li>
											            	<li class="list-group-item">
											              		<b>Username</b> <a class="pull-right">{{ $tmps->username }}</a>
											            	</li>
											           	 	<li class="list-group-item">
											              		<b>Kata Sandi</b> <a class="pull-right">@for($i=1;$i<=strlen($tmps->password); $i++) * @endfor</a>
											            	</li>
											          	</ul>
											          	<div class="box-profil-footer" style="width: 350px; margin: 10px auto;">
											          		<div class="row">
												          		<div class="col-md-6 col-sm-6 col-xs-6">
												          			<div class="btn btn-warning btn-block" data-toggle="modal" data-target="#modal-privasi"><b>Ubah Akun</b></div>	
												          		</div>
												          		<div class="col-md-6 col-sm-6 col-xs-6">
												          			<form action="{{ asset('save/image/'.$tmps->id) }}" method="post" enctype="multipart/form-data">
												          				<input type="file" name="foto" id="change-image" onchange="$('#kirim-foto').click()" class="hidden">
												          				<input type="submit" name="kirim" id="kirim-foto" class="hidden">
												          				<input type="hidden" name="_token" value="{{ csrf_token() }}">
												          				<div class="btn btn-warning btn-block" id="ganti-profil" onclick="$('#change-image').click()"><b>Ganti Profil</b></div>
												          			</form>
												          		</div>
												          	</div>
											          	</div>	
										            </div>
							            		</div>	
							            	</div>
<?php foreach($dataBio as $tmp){} ?>
											<div class="tab-pane" id="biodata">
												<form action="{{ asset('edit/profile') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data" novalidate>
													<input type="hidden" name="bio_id" value="{{ $tmps->bio_id }}"/>
													<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
													@if(count($dataBio) != 0)														
														@include('main.user.edit_tabs-biodata')
													@else
														@include('main.user.tabs-biodata')
													@endif
													<button type="submit" class="btn-warning btn"">Save changes</button>
												</form>
											</div>
							            </div>
							        </div>
					        	</div>		
					        	<div class="col-md-4">
					        		
					        	</div>
							</div>	
          </div>
	</section>
</div>
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){ 

	setOption('#tlProv','{{ @$tmp->prov_lahir }}');
	setOption('#tlKab','{{ @$tmp->bio_tempat_lahir }}');
	
	setOption('#abProv','{{ @$tmp->bio_provinsi }}');
	setOption('#abKab','{{ @$tmp->bio_kabupaten }}');
	setOption('#abKec','{{ @$tmp->bio_kecamatan }}');
	setOption('#abKel','{{ @$tmp->bio_kelurahan }}');
	
	if('{{ @$tmp->status_value }}' === 'Menikah'){
		$("#pasangan").removeAttr('disabled');
		$("#anak").removeAttr('disabled');
	}else{
		$("#pasangan").attr('disabled','disabled');
		$("#anak").attr('disabled','disabled');
	}
	
	if('{{ @$tmp->bio_jenis_identitas }}' != ''){ 
		$('#noIdentitas').removeAttr('disabled');
		$('#noIdentitas').attr('required', true);
	}else{ 
		$('#noIdentitas').attr('disabled', true);
		$('#noIdentitas').removeAttr('required');
	}
	
	$('#identitas').change(function(){
		var status = $(this).val();
		if(status != ''){
			$('#noIdentitas').removeAttr('disabled');
			$('#noIdentitas').attr('required', true);
		}else{
			$('#noIdentitas').attr('disabled', true);
			$('#noIdentitas').removeAttr('required');
		}
	});
	$('#statusPernikahan').change(function(){
		var status = $(this).val();
		if(status == '1'){
			$('#namaPasangan').removeAttr('disabled');
			$('#jumlahAnak').removeAttr('disabled');
			$('#namaPasangan').attr('required', true);
			$('#jumlahAnak').attr('required', true);
		}else{
			$('#namaPasangan').attr('disabled', true);
			$('#jumlahAnak').attr('disabled', true);
			$('#namaPasangan').removeAttr('required');
			$('#jumlahAnak').removeAttr('required');
		}
	});
});

$('#tlProv').change(function(){
		var prov = $(this).val();
		changeKabupatenOptionKPU('#tlProv','#tlKab',prov);
	});
	$('#abProv').change(function(){
		var prov = $(this).val();
		changeKabupatenOptionKPU('#abProv','#abKab',prov);
	});
	$('#abKab').change(function(){
		var prov = $('#abProv').val();
		var kab = $(this).val();
		changeKecamatanOptionKPU('#abKab','#abKec',prov,kab);
	});
	$('#abKec').change(function(){
		var prov = $('#abProv').val();
		var kab = $('#abKab').val();
		var kec = $(this).val();
		changeKelurahanOptionKPU('#abKec','#abKel',prov,kab,kec);
	});
	$('#statusPernikahan').change(function(){
		var status = $(this).val();
		if(status == '1'){
			$('#namaPasangan').removeAttr('disabled');
			$('#jumlahAnak').removeAttr('disabled');
			$('#namaPasangan').attr('required', true);
			$('#jumlahAnak').attr('required', true);
		}else{
			$('#namaPasangan').attr('disabled', true);
			$('#jumlahAnak').attr('disabled', true);
			$('#namaPasangan').removeAttr('required');
			$('#jumlahAnak').removeAttr('required');
		}
	});
	var statusPass = false;
	function checkPassword(passNewCheck,jenis)
	{
		if(jenis == 'new') {			
			if(passNewCheck != '') {		
				$('#cekPasswordBaru').removeClass('required success');
				$('#responseCek').removeClass('color-red color-green none');
				/* var passNewCheck = $('#cekPasswordBaru').val(); */
				var passNew = $('#passwordBaru').val();
				if(passNewCheck != passNew) {
					$('#cekPasswordBaru').removeClass('success').addClass('required');
					$('#responseCek').addClass('color-red none');
					$('#responseCek').html('Password Tidak Cocok');
					statusPass = false;
				} else {		
					$('#cekPasswordBaru').removeClass('required').addClass('success');
					$('#responseCek').addClass('color-green none');
					$('#responseCek').html('Password Anda Cocok');
					statusPass = true;
				}
			}
		} else if(jenis == 'old') {
			if(passNewCheck == '{{ @$tmp->password }}'){	
				$('#passwordLama').removeClass('required').addClass('success');
				$('#responsePass').removeClass('color-red').addClass('color-green');
				$('#responsePass').html('Password Anda Benar');		
			} else {	
				$('#passwordLama').removeClass('success').addClass('required');
				$('#responsePass').removeClass('color-green').addClass('color-red');
				$('#responsePass').html('Password Anda Salah');		
			}
		}
	}
	
	function savePassword(){	
		$('.se-pre-con').show();
		$('#saveForm').click();
		/* if(statusPass == true && $('#passwordLama').val() == '{{ @$tmp->password }}'){			
			$('.se-pre-con').show();
			$('#saveForm').click();
		} else {
			if(statusPass != true){
				$('#cekPasswordBaru').addClass('required');
				$('#responseCek').addClass('color-red none');
				$('#responseCek').html('Password Tidak Cocok');
			} 
			
			if($('#passwordLama').val() != '{{ @$tmp->password }}') {		
				$('#passwordLama').addClass('required');
				$('#responsePass').addClass('color-red');
				$('#responsePass').html('Password Anda Salah');		
			}
		} */
	}
</script>
@endsection