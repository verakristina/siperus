<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>@yield('title')</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="{{asset('asset/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('asset/font-awesome/css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
		<link rel="stylesheet" href="{{asset('asset/css/AdminLTE.min.css')}}">
		<link rel="stylesheet" href="{{asset('asset/css/skins/_all-skins.min.css ')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('asset/css/style.css')}}">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="{{asset('asset/plugins/datatables/dataTables.bootstrap.css')}}">
		<link rel="stylesheet" href="{{asset('asset/css/accordionmenu.css')}}">
		<style>
			html, body {
				height: 100%;
				margin: 0;
				padding: 0;
				font-family: Roboto,Arial,sans-serif;
				background-color: #ecf0f5;
				overflow:hidden;
			}
			#map {
				height: 100%;
				position: fixed;
				bottom: 0;
				background:#eee;
			}
			.controls {
				margin-top: 10px;
				border: 1px solid transparent;
				border-radius: 2px 0 0 2px;
				box-sizing: border-box;
				-moz-box-sizing: border-box;
				height: 32px;
				outline: none;
				box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
			}
			#fillter {
				background-color: #fff;
				font-family: Roboto;
				font-size: 15px;
				font-weight: 300;
				margin-left: 12px;
				padding: 0 11px 0 13px;
				text-overflow: ellipsis;
				width: 300px;		  
			}
			#pac-input {
				background-color: #fff;
				font-family: Roboto;
				font-size: 15px;
				font-weight: 300;
				margin-left: 12px;
				padding: 0 11px 0 13px;
				text-overflow: ellipsis;
				width: 25%;
			}
			#pac-input:focus {
				border-color: #4d90fe;
			}
			.heading {	
				height: 80px;
				background: white;
			}
			.on-map-menu{		
				position: absolute;
				z-index: 40;
				width: 265px;
				background: transparent;
				right: 60px;
				top: 60px;
			}
			.app-menu {
				background: white;
				-moz-box-shadow: 0 0 8px #999;
				-webkit-box-shadow: 0 0 8px #999;
				box-shadow: 0 0 8px #999;
			}
			.menu-title {
				font-family: 'Abel', sans-serif;
				font-size: 20px;
				color: #757575;
			}
			@media (max-width: 768px){
				.on-map-menu{
					top: 10px;
					left: 0px;
					position: relative;
					width: 100%;
				}
				#pac-input {
					width: 50%;
				}
			}
			.panel-default>.panel-heading {
				color: white;
				background-color: #f39c12;
				border-color: #ddd;
				font-weight: 600;
			}
			#legend {
				margin: 5px;
			}
			#legend h3 {
				margin-top: 0;
			}
			#legend img {
				vertical-align: middle;
			}
			
			.hover-bottom {
				border: 0;
				position: relative;
			}

			.hover-bottom::before, .hover-bottom::after {
				box-sizing: inherit;
				content: '';
				position: absolute;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				height: 100%;
				width: 100%;
				-webkit-transform-origin: center;
						transform-origin: center;
			}
			.hover-bottom::before {
				border-bottom: 2px solid #fff;
				-webkit-transform: scale3d(0, 1, 1);
						transform: scale3d(0, 1, 1);
			}
			.hover-bottom:hover::before, .hover-bottom:hover::after {
				-webkit-transform: scale3d(1, 1, 1);
						transform: scale3d(1, 1, 1);
				-webkit-transition: -webkit-transform 0.5s;
				transition: -webkit-transform 0.5s;
				transition: transform 0.5s;
				transition: transform 0.5s, -webkit-transform 0.5s;
			}
			.activeKursiLi {
				color: #fff !important;
				font-weight: bold !important;
				background: #dd4b39 !important;
			}

		</style>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="row" style="background-color:#dd4b39;color:#fff;font-family: 'Open Sans'; font-size:2em; padding:10px; font-weight:600; min-height:45px;top:0;"> 
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-8 col-sm-8 col-xs-3 hidden-xs" style="font-size:20px; !important;">
						GEO MAP PKN
					</div>
					<div class="col-md-8 col-sm-8 col-xs-3 hidden-lg hidden-md hidden-sm visible-xs">
						GEO
					</div> 
					<div class="col-md-3 col-sm-3 col-xs-8" style="float: right; font-size:20px; !important; text-align: center; cursor: pointer;">
						<div class="row">
							<!--<div class="hover-bottom col-md-4 col-md-offset-4" onclick="goCekSK()">
								CEK SK
							</div>-->
							<div class="hover-bottom col-md-4 col-md-offset-8" onclick="goLogin()">
								LOGIN
							</div>
						</div>
					</div> 
				</div>
			</div>
		</div>	
		@yield('content')
		<script src="{{asset('asset/js/jquery-3.0.0.min.js')}}"></script>
		<script src="{{asset('asset/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
		<script src="{{asset('asset/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
		<script src="{{asset('asset/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('asset/js/app.min.js')}}"></script>
		<script src="{{asset('asset/js/ajaxLokasi.js')}}"></script>
		<script src="{{asset('asset/js/ajaxSaveData.js')}}"></script>
		<script src="{{asset('asset/js/autoComplete.js')}}"></script>
		<script src="{{asset('asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('asset/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('div#DataTables_Table_0_filter input').attr('placeholder','Cari ...');
				$('table input').addClass('class search');
				showAwal();
			});
			
			function goCekSK(){
				location.href="{{ asset('cek/ck') }}";
			}
			function goLogin(){
				location.href="{{ asset('login') }}";
			}
			function setSuara(value){
				location.href="?suara_tahun="+value+"#two";
			}

			function setKontakDPD(){
				location.href="?kontak_dpd=dpd#one";
			}

			function setKontakDPC(){
				location.href="?kontak_dpc=dpc#one";
			}

			function setAgenda(value){
				location.href="?agenda_tahun="+value+"#four";
			}
		</script>
	</body>
</html>