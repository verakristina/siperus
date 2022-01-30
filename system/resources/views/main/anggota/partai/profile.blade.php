@extends('main.layout.layout')

@section('title-page','Profile')

@section('main-sidebar')
@endsection

@section('content')
<?php $dataUsers = HelperData::getDataUser('idLogin'); 
foreach($dataUsers as $users){} ?>
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
              <form id="form-profile" action="{{ asset('save/profile') }}" method="get" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-4 col-sm-4">
                  <div class="form-group">
					<div class="canvas-picture">
						<div class="picture">
							@if(isset($users->pic))
								{{--*/ $gambarUser = $users->pic /*--}}
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
                <div class="col-md-8 col-sm-8">
                  <div class="row"> 
					  <div class="form-group col-md-4 col-sm-6 ">
						<label>Username</label>
                      </div>
					  <div class="col-md-7 col-sm-6">
						<input type="hidden" name="idUser" id="idUser" class="form-control" placeholder="Username" readonly="" value="{{ $users->id }}">
						<input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ $users->username }}">
                      </div> 
                  </div>
                  <div class="row"> 
					  <div class="form-group col-md-4 col-sm-6 ">
                        <label>Password Baru</label>
                      </div>
					  <div class="col-md-7 col-sm-6">
                        <input type="password" name="passwordBaru" id="passwordBaru" class="form-control" placeholder="Password Baru" >
                      </div> 
                  </div>
                  <div class="row"> 
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
                  </div>
                  <div class="row">
                    <div class="col-md-11">
                      <div class="pull-right">
                        <div type="submit" class="btn btn-primary" onclick="savePassword()">Simpan</div>
                        <button type="submit" id="saveForm" class="hide btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </form>
            </div>
          </div>
	</section>
</div>
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script type="text/javascript">
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
			if(passNewCheck == '{{ $users->password }}'){	
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
		if(statusPass == true && $('#passwordLama').val() == '{{ $users->password }}'){			
			$('.se-pre-con').show();
			$('#saveForm').click();
		} else {
			if(statusPass != true){
				$('#cekPasswordBaru').addClass('required');
				$('#responseCek').addClass('color-red none');
				$('#responseCek').html('Password Tidak Cocok');
			} 
			
			if($('#passwordLama').val() != '{{ $users->password }}') {		
				$('#passwordLama').addClass('required');
				$('#responsePass').addClass('color-red');
				$('#responsePass').html('Password Anda Salah');		
			}
		}
	}
</script>
@endsection