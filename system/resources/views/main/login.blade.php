<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('asset/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('asset/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('asset/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('asset/plugins/iCheck/square/blue.css')}}">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
	.login-page {
		background-image: url({{ asset('asset/img/bg.png') }}) !important;
	}
	.required{
		border: 1px solid red;
	}
	.border-radius {
		border-radius: 3px !important;
	}
	.se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 99;
		background: url('{{asset('asset/img/spin.gif')}}')  center no-repeat #fff;
	}
  </style>
</head>
<body class="hold-transition login-page">
<div class="se-pre-con"></div>
<div class="login-box">
  <div class="login-logo">
    <b>PUSDATIN</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="box-shadow: 3px 3px 10px 2px grey;">
    <p class="login-box-msg">Masukan Username & Password</p>
    <div id="response-ajax"></div>

    <form method="post" id="form-login">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group has-feedback">
        <label for="user">Username</label>
		<div class="input-group col-md-12">
			<input type="text" id="user" name="user" class="form-control border-radius" placeholder="Username" onkeyup="cekForm('#user','#responseUser')">
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
		</div>
		<div class="col-md-12" id="responseUser"></div>
      </div>
      <div class="form-group has-feedback">
        <label for="pass">Password</label>
		<div class="input-group col-md-12">
			<input type="password" id="pass" name="pass" class="form-control border-radius" placeholder="Password" onkeyup="cekForm('#pass','#responsePass')">
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div>
		<div class="col-md-12" id="responsePass"></div>
      </div>
	  <div class="row">
		<div class="col-md-12" id="responseLogin"></div>
	  </div>
      <div class="row" style="margin-top:5px;">
        <div class="form-group col-md-12">
          <div class="btn btn-danger btn-block btn-flat btn-auth border-radius" onclick="cekLogin()"><i class="fa fa-sign-in" aria-hidden="true"></i> Masuk</div>
        </div> 
      </div>
    </form>
    <!-- /.social-auth-links -->  

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3.0.0 -->
<script src="{{asset('asset/js/jquery-3.0.0.min.js')}}"></script>
<!-- Custom Function -->
<script src="{{asset('asset/js/function.js')}}"></script>
<!-- jQuery Auth Login -->
<script src="{{asset('asset/js/authLogin.js')}}"></script>
<script src="{{asset('asset/js/ajaxLokasi.js')}}"></script>
<!-- jQuery 2.2.3 -->
<script src="{{asset('asset/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('asset/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('asset/plugins/iCheck/icheck.min.js')}}"></script>
<script>
$(window).load(function() {
	$(".se-pre-con").fadeOut("slow");
});
$(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
});
$(document).keypress(function(e) {
    if(e.which == 13) {
        cekLogin();
    }
});

function cekForm(field,response){
	$(field).removeClass('required');
	$(response).html('');
}

function cekLogin(){
	$('#responseLogin').fadeOut(200);
	var user = $('#user').val();
	var pass = $('#pass').val();
	if(user == "" || pass == ""){
		if(user == ""){ $('#user').addClass('required'); $('#responseUser').html('<span style="color: red;">Masukan Username Anda</span>'); }
		if(pass == ""){ $('#pass').addClass('required'); $('#responsePass').html('<span style="color: red;">Masukan Password Anda</span>'); }
		
		/* $('#responseLogin').html('<div class="alert alert-danger" style="padding-top:15px;"><i class="fa fa-warning"></i> NO FIELD EMPTY!</div>')
		$('#responseLogin').fadeIn(200).delay(2500).fadeOut(200); */
	}else{
		$.ajax({
			type : "GET",
			url  : "{{ asset('proses/login') }}",
			data : {
				'user' 	: user,
				'pass'  : pass
			},
			success:function(response){
				if(response == "Success") {
					window.location=('./dashboard');
					$(".se-pre-con").fadeIn("fast");
				} else {
					$('#responseLogin').html('<div class="alert alert-danger" style="padding: 0px; text-align: center; margin-bottom: 10px;"><h6 style="font-size:12px;"><i class="fa fa-warning"></i> '+response+'</h6></div>')
					$('#responseLogin').fadeIn(200);
				}
			}
		});
	}
}
</script>
</body>
</html>
