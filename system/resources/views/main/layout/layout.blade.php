<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title-page')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('asset/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('asset/font-awesome/css/font-awesome.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/datepicker/datepicker3.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/iCheck/all.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/timepicker/bootstrap-timepicker.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/select2/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('asset/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('asset/css/skins/skin-red.min.css ')}}">
  <!-- Link Style.css Custom -->
  <link rel="stylesheet" type="text/css" href="{{asset('asset/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('asset/plugins/select2/select2.min.css')}}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="{{asset('asset/css/datatables/responsive.bootstrap.min.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  	<style>
	/* Paste this css to your style sheet file or under head tag */
	/* This only works with JavaScript, 
	if it's not present, don't show loader */
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	#alert{
		position: fixed;
		z-index: 9999;
		min-width: 10%;
		margin-top: 0%;
		text-align: center;
		right: 0;
		display:none;
	}
	.above-everything{
		z-index:9999;
	}
	.table-aksi{
		width:1%;
		white-space:nowrap;
	}
	</style>
</head>
<?php $dataUsers = HelperData::getDataUser('idLogin'); ?>
@include('main.anggota.partai.include.modal_detail')
@include('main.master.struktur.include.modal_detail')
<body class="hold-transition skin-red sidebar-mini no-padding" style="padding-right: 0px !important;">
<div class="se-pre-con"></div>
<div class="alert alert-success pull-right" id="alert">
    <strong>Success!</strong> <p></p>
</div>
<div class="alert alert-danger pull-right" id="alert">
    <strong>Failed!</strong> <p></p>
</div>
<div class="wrapper">
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">SIPERUS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIPERUS</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
	  <div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
		  <li class="dropdown user user-menu">
			<a href="{{ asset('/') }}">
			  <i class="fa fa-map-marker" style="font-size:20px;"></i>
			  <span class="hidden-xs">Peta</span>
			</a>
		  </li>
		  <!-- User Account: style can be found in dropdown.less -->
			@foreach($dataUsers as $users)
			{{--*/ $image = 'asset/img/dokumen/'.session('idLogin').'/foto/'.$users->pic; /*--}}
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					@if($users->pic == "")
						<img src="{{asset('asset/img/blank_profil.png')}}" class="user-image" alt="User Image">
					@else
						<img src="{{ asset($image) }}" class="user-image" alt="User Image">
					@endif
					<span class="hidden-xs">{{ ucfirst(strtolower($users->bio_nama_depan?:$users->name)) }}</span>
				</a>
				<ul class="dropdown-menu">
			  <!-- User image -->
					<li class="user-header">
						@if($users->pic == "")
							<img src="{{asset('asset/img/blank_profil.png')}}" class="img-circle" alt="User Image">
						@else
							<img src="{{ asset($image) }}" class="img-circle" alt="User Image">
						@endif
						<p>
							{{ ucfirst(strtolower($users->bio_nama_depan?:$users->name)) }} - {{$users->akses_nama}}
							<small>Terdaftar Pada <?php echo date('M',strtotime($users->created_date)); ?>. <?php echo date('Y', strtotime($users->created_date)); ?></small>
						</p>
					</li>
			  <!-- Menu Footer-->
					<li class="user-footer">
						<div class="pull-left">
							<a href="{{ asset('view/profile') }}" class="btn btn-default btn-flat">Profile</a>
						</div>
				<!-- <div class="" style="float:left; margin-left:5px;">
				  <a href="{{ asset('view/profile') }}" class="btn btn-default btn-flat">Ganti Password</a>
				</div> -->
						<div class="pull-right">
							<a href="{{ asset('logout') }}" class="btn btn-default btn-flat">Logout</a>
						</div>
					</li>
				</ul>
			</li>
		  @endforeach
		  <!-- Control Sidebar Toggle Button -->
		</ul>
		</div>
    </nav>

  </header>
  <!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<section class="sidebar">
		  <!-- Sidebar user panel -->
		   @foreach($dataUsers as $users)
			{{--*/ $image = 'asset/img/dokumen/'.session('idLogin').'/foto/'.$users->pic; /*--}}
			<div class="user-panel">
				@if($users->pic == "")
					<div class="pull-left image">
					  <img src="{{asset('asset/img/blank_profil.png')}}" class="img-circle" alt="User Image">
					</div>
				@else
					<div class="pull-left image">
					  <img src="{{ asset($image) }}" class="img-circle" alt="User Image">
					</div>
				@endif
				<div class="pull-left info">
					<p>Hello, {{ ucfirst(strtolower($users->bio_nama_depan?:$users->name)) }}</p>
					<i class="fa fa-circle text-success"></i> Online
				</div>
			</div>
			@endforeach
		@include('include.sidebar')
		</section>
	</aside>
    @yield('content')
</div>
<!-- ./wrapper -->

<!-- jQuery 3.0.0 -->
<!--script src="{{asset('asset/js/jquery-3.0.0.min.js')}}"></script-->
<!-- jQuery 2.2.3 -->



<script src="{{asset('asset/js/jquery-3.1.1.js')}}"></script>
<script src="{{asset('asset/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{asset('asset/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/jquery.dataTables.js')}}"></script>
<!-- <script src="{{asset('asset/plugins/datatables/dataTables.responsive.min.js')}}"></script> -->
<script src="{{asset('asset/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<!-- <script src="{{asset('asset/plugins/datatables/responsive.bootstrap.min.js')}}"></script> -->
<script src="{{asset('asset/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('asset/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('asset/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('asset/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{ asset('asset/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/wNumb.js ')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('asset/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Jquery Autocomplete Custom -->
<script src="{{asset('asset/js/autoComplete.js')}}"></script>

<script src="{{asset('asset/plugins/select2/select2.full.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('asset/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('asset/js/app.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('asset/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{asset('asset/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{asset('asset/plugins/chartjs/Chart.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--script src="{{asset('asset/js/pages/dashboard2.js')}}"></script-->
<!-- AdminLTE for demo purposes -->
<!--script src="{{asset('asset/js/demo.js')}}"></script-->
<!-- Combo box ajax lokasi -->
<script src="{{asset('asset/js/ajaxLokasi.js')}}"></script>
<!-- Ajax Save Data -->
<script src="{{asset('asset/js/ajaxSaveData.js')}}"></script>
<!-- Select2 -->

<script src="{{ asset('asset/js/highchart/highcharts2.js') }}"></script>
<script src="{{ asset('asset/js/highchart/highcharts-more.js') }}"></script>	
<script>
$(document).ready(function(){
    $('#date').datepicker({
      autoclose : true,
      format : 'dd-mm-yyyy'
    });
    $('#tanggal').datepicker({
        autoclose: true,
        format: 'dd-mm-yy'
    });
  });
</script>
<script type="text/javascript">
	var alertStatus = 0;
	$(document).ready(function(){
		$("#s_nama, #s_tgl, #s_wilayah").hide();
	});
	function showAlert(color,title,content){
		if(alertStatus == 0){			
			alertStatus = 1;
			var data = '<div class="callout callout-'+color+'">'+
							'<h4>'+title+'</h4>'+content+
						'</div>';
						
			$(".content-header").append(data);
			$('.callout').hide();			
		}
		$('.callout').slideDown().delay(1000).slideUp();
		$(".content-header").remove('.callout');
	}

	function detailStruktur(jenis, idtruktur){
		$.ajax({
			type : "GET",
			url : "{{ asset('detail/struktur') }}/"+jenis+"/"+idtruktur,
			dataType: "json",
			success:function(data){
                var resp = eval(data);
				$("#modal-view-struktur").modal('show');
				if(jenis == 'dpp') {
					$($($("#detailNameProv").parent('div')).parent('div')).hide();
					$($($("#detailNameKab").parent('div')).parent('div')).hide();
					$($($("#detailNameKec").parent('div')).parent('div')).hide();
					$($($("#detailNameKel").parent('div')).parent('div')).hide();
					$($($("#detailNameRW").parent('div')).parent('div')).hide();
					$($($("#detailNameRT").parent('div')).parent('div')).hide();
					$("#detailNameStruk").text(resp['struk_dpp_nama']);
					$("#detailNameBio").text(resp['fullName']);
				} else if(jenis == 'dpd') {
					$("#detailNameProv").text(resp['geo_prov_nama']);
					$($($("#detailNameKab").parent('div')).parent('div')).hide();
					$($($("#detailNameKec").parent('div')).parent('div')).hide();
					$($($("#detailNameKel").parent('div')).parent('div')).hide();
					$($($("#detailNameRW").parent('div')).parent('div')).hide();
					$($($("#detailNameRT").parent('div')).parent('div')).hide();
					$("#detailNameStruk").text(resp['struk_pimda_nama']);
					$("#detailNameBio").text(resp['fullName']);
				} else if(jenis == 'dpc') {
					$("#detailNameProv").text(resp['geo_prov_nama']);
					$("#detailNameKab").text(resp['geo_kab_nama']);
					$($($("#detailNameKec").parent('div')).parent('div')).hide();
					$($($("#detailNameKel").parent('div')).parent('div')).hide();
					$($($("#detailNameRW").parent('div')).parent('div')).hide();
					$($($("#detailNameRT").parent('div')).parent('div')).hide();
					$("#detailNameStruk").text(resp['struk_pimcab_nama']);
					$("#detailNameBio").text(resp['fullName']);
				} else if(jenis == 'pac') {
					$("#detailNameProv").text(resp['geo_prov_nama']);
					$("#detailNameKab").text(resp['geo_kab_nama']);
					$("#detailNameKec").text(resp['geo_kec_nama']);
					$($($("#detailNameKel").parent('div')).parent('div')).hide();
					$($($("#detailNameRW").parent('div')).parent('div')).hide();
					$($($("#detailNameRT").parent('div')).parent('div')).hide();
					$("#detailNameStruk").text(resp['struk_pac_nama']);
					$("#detailNameBio").text(resp['fullName']);
				} else if(jenis == 'pr') {
					$("#detailNameProv").text(resp['geo_prov_nama']);
					$("#detailNameKab").text(resp['geo_kab_nama']);
					$("#detailNameKec").text(resp['geo_kec_nama']);
					$("#detailNameKel").text(resp['geo_deskel_nama']);
					$($($("#detailNameRW").parent('div')).parent('div')).hide();
					$($($("#detailNameRT").parent('div')).parent('div')).hide();
					$("#detailNameStruk").text(resp['struk_pr_nama']);
					$("#detailNameBio").text(resp['fullName']);
				} else if(jenis == 'par') {
					$("#detailNameProv").text(resp['geo_prov_nama']);
					$("#detailNameKab").text(resp['geo_kab_nama']);
					$("#detailNameKec").text(resp['geo_kec_nama']);
					$("#detailNameKel").text(resp['geo_deskel_nama']);
					$("#detailNameRW").text(resp['geo_rw_nama']);
					$($($("#detailNameRT").parent('div')).parent('div')).hide();
					$("#detailNameStruk").text(resp['struk_par_nama']);
					$("#detailNameBio").text(resp['fullName']);
				} else if(jenis == 'kpa') {
					$("#detailNameProv").text(resp['geo_prov_nama']);
					$("#detailNameKab").text(resp['geo_kab_nama']);
					$("#detailNameKec").text(resp['geo_kec_nama']);
					$("#detailNameKel").text(resp['geo_deskel_nama']);
					$("#detailNameRW").text(resp['geo_rw_nama']);
					$("#detailNameRT").text(resp['geo_rt_nama']);
					$("#detailNameStruk").text(resp['struk_kpa_nama']);
					$("#detailNameBio").text(resp['fullName']);
				} else {
					
				}								
			}
		});
	}
	function detailUser(idUser){
		$.ajax({
			type : "GET",
			url : "{{ asset('ajax/anggota/partai') }}",
			data : "key="+idUser,
			dataType: "json",
			success:function(data){
				
                var resp = eval(data);
				$("#modal-view-balon").modal('show');
				$("#area-jen-id").text(resp['identitas_value']);
				$("#area-no-id").text(resp['bio_nomer_identitas']);
				$("#area-nama").text(resp['bio_nama_depan']+" "+resp['bio_nama_tengah']+" "+resp['bio_nama_belakang']);
				$("#area-tempat").text(resp['daerahTempatLahir']);
				$("#area-tanggal").text(resp['bio_tanggal_lahir']);
				$("#area-agama").text(resp['agama_value']);
				$("#area-jenkel").text(resp['jk_value']);
				$("#area-alamat").text(resp['bio_alamat']);
				$("#area-provinsi").text(resp['geo_prov_nama']);
				$("#area-kokab").text(resp['geo_kab_nama']);
				$("#area-kecamatan").text(resp['geo_kec_nama']);
				$("#area-kelurahan").text(resp['geo_deskel_nama']);
				
				$("#area-pernikahan").text(resp['status_value']);
				$("#area-nama-pasangan").text(resp['bio_nama_pasangan']);
				$("#area-jum-anak").text(resp['bio_anak']);
				
				$("#area-tlp").text(resp['bio_telephone']);
				$("#area-hp").text(resp['bio_handphone']);
				$("#area-email").text(resp['bio_email']);
				$("#area-twitter").text(resp['bio_twitter']);
				$("#area-fb").text(resp['bio_facebook']);
				
				
			}
		});
	}
	function getDataDetailWilayah(jenis,prov,kab,kec,kel,rw,tps){
		$.ajax({
			type : "GET",
			url : "{{ asset('ajax/wilayah') }}/"+jenis,
			data    : {prov: prov,kab: kab,kec: kec,kel: kel,rw: rw,tps: tps},
			dataType: "json",
			success:function(data){
				if (jenis == 'prov') {
	                var resp = eval(data);
					$("#modal-view-wilayah").modal('show');
					$("#wprovinsi").text(resp['geo_prov_nama']);
					$("#wdkab").hide();
					$("#wdkec").hide();
					$("#wdkel").hide();
					$("#wdrw").hide();
					$("#wdtps").hide();
				} else if (jenis == 'kab') {
	                var resp = eval(data);
					$("#modal-view-wilayah").modal('show');
					$("#wprovinsi").text(resp['geo_prov_nama']);
					$("#wkabupaten").text(resp['geo_kab_nama']);
					$("#wdkec").hide();
					$("#wdkel").hide();
					$("#wdrw").hide();
					$("#wdtps").hide();
				} else if (jenis == 'kec') {
	                var resp = eval(data);
					$("#modal-view-wilayah").modal('show');
					$("#wprovinsi").text(resp['geo_prov_nama']);
					$("#wkabupaten").text(resp['geo_kab_nama']);
					$("#wkecamatan").text(resp['geo_kec_nama']);
					$("#wdkel").hide();
					$("#wdrw").hide();
					$("#wdtps").hide();
				} else if (jenis == 'kel') {
	                var resp = eval(data);
					$("#modal-view-wilayah").modal('show');
					$("#wprovinsi").text(resp['geo_prov_nama']);
					$("#wkabupaten").text(resp['geo_kab_nama']);
					$("#wkecamatan").text(resp['geo_kec_nama']);
					$("#wkelurahan").text(resp['geo_deskel_nama']);
					$("#wdrw").hide();
					$("#wdtps").hide();
				} else if (jenis == 'rw') {
	                var resp = eval(data);
					$("#modal-view-wilayah").modal('show');
					$("#wprovinsi").text(resp['geo_prov_nama']);
					$("#wkabupaten").text(resp['geo_kab_nama']);
					$("#wkecamatan").text(resp['geo_kec_nama']);
					$("#wkelurahan").text(resp['geo_deskel_nama']);
					$("#wrw").text(resp['geo_rw_nama']);
					$("#wdtps").hide();
				} else if (jenis == 'tps') {
	                var resp = eval(data);
					$("#modal-view-wilayah").modal('show');
					$("#wprovinsi").text(resp['geo_prov_nama']);
					$("#wkabupaten").text(resp['geo_kab_nama']);
					$("#wkecamatan").text(resp['geo_kec_nama']);
					$("#wkelurahan").text(resp['geo_deskel_nama']);
					$("#wtps").text(resp['geo_tps_nama']);
					$("#wdrw").hide();
				}

			}
		});
	}
	function detailPenduduk(jenis,prov,kab,id){
		$.ajax({
			type : "GET",
			url : "{{ asset('ajax/penduduk') }}",
			data    : {jenis: jenis,prov: prov,kab: kab,id: id},
			dataType: "json",
			success:function(data){
				if (jenis == 'group') {
	                var resp = eval(data);
					$("#modal-view-penduduk").modal('show');
					$("#provinsi").text(resp['geo_prov_nama']);
					$("#jumkab").text(resp['jumlah_kab']);	
					$("#jumlah").text(parseInt(resp['penduduk_jumlah']).toLocaleString('id'));
					$("#dkab").hide();
				} else {
					var resp = eval(data);
					$("#modal-view-penduduk").modal('show');
					$("#provinsi").text(resp['geo_prov_nama']);
					$("#kabupaten").text(resp['geo_kab_nama']);
					$("#jumlah").text(parseInt(resp['penduduk_jumlah']).toLocaleString('id'));
					$("#jkab").hide();
				}

			}
		});
	}
	function detailStatistik(id){
		$.ajax({
			type : "GET",
			url : "{{ asset('ajax/statistik') }}",
			data    : {id: id},
			dataType: "json",
			success:function(data){
            var resp = eval(data);
			$("#modal-view-statistik").modal('show');
			$("#provins").text(resp['geo_prov_nama']);
			$("#kabupaten").text(changeNumberFormat(resp['pengurus_pimcab_ada'])+"/"+changeNumberFormat(resp['pengurus_pimcab'])+" ("+changePercent(resp['pengurus_pimcab_ada'],resp['pengurus_pimcab'])+" %)");
			$("#kecamatan").text(changeNumberFormat(resp['pengurus_pac_ada'])+"/"+changeNumberFormat(resp['pengurus_pac'])+" ("+changePercent(resp['pengurus_pac_ada'],resp['pengurus_pac'])+" %)");
			$("#ranting").text(changeNumberFormat(resp['pengurus_ranting_ada'])+"/"+changeNumberFormat(resp['pengurus_ranting'])+" ("+changePercent(resp['pengurus_ranting_ada'],resp['pengurus_ranting'])+" %)");
			$("#aranting").text(changeNumberFormat(resp['pengurus_anak_ranting_ada'])+"/"+changeNumberFormat(resp['pengurus_anak_ranting'])+" ("+changePercent(resp['pengurus_anak_ranting_ada'],resp['pengurus_anak_ranting'])+" %)");
			$("#kpa").text(changeNumberFormat(resp['pengurus_kpa_ada'])+"/"+changeNumberFormat(resp['pengurus_kpa'])+" ("+changePercent(resp['pengurus_kpa_ada'],resp['pengurus_kpa'])+" %)");
			}
		});
	}
	
	function changeNumberFormat(data,language = 'id') {
		return parseInt(data).toLocaleString(language);
	}
	function changePercent(val1,val2) {
					
			var per = val1/val2*100;
			if (isNaN(per)) {
				return 0;
			}
		
		return per.toFixed(2);
	}
	
	function getDataDetailVerif(id){
		$.ajax({
			type : "GET",
			url : "{{ asset('ajax/verifikasi/detail') }}",
			data : "key="+id,
			dataType: "json",
			success:function(data){
				
                var resp = eval(data);
				$("#modal-view-verifikasi").modal('show');
				$("#nama").text(resp['verifikasi_nama']);
				$("#alamat").text(resp['verifikasi_alamat_kantor']);
				$("#jumlah-kta").text(resp['verifikasi_jumlah_kta']);
				$("#rekening").text(resp['verifikasi_nomer_rekening']);

				if(resp['verifikasi_status_kantor'] == '1'){
					$("#status-kantor").text("Milik Sendiri");
				} else if(resp['verifikasi_status_kantor'] == '2'){
					$("#status-kantor").text("Kontrak / Pinjam Pakai");
				} else {
					$("#status-kantor").text("-");
				}
				
				if (resp['verifikasi_keaktifan_pengurus'] == '1') {
					$("#keaktifan-pengurus").text("Ya");
				} else if (resp['verifikasi_keaktifan_pengurus'] == '0') {
					$("#keaktifan-pengurus").text("Tidak");
				} else {
					$("#keaktifan-pengurus").text("-");
				}

				if (resp['verifikasi_staf_admin'] == '1') {
					$("#staff-admin").text("Ya");
				} else if (resp['verifikasi_staf_admin'] == '0') {
					$("#staff-admin").text("Tidak");
				} else {
					$("#staff-admin").text("-");
				}

				if (resp['verifikasi_ibukota'] == '1') {
					$("#ibukota").text("Ya");
				} else if (resp['verifikasi_ibukota'] == '0') {
					$("#ibukota").text("Tidak");
				} else {
					$("#ibukota").text("-");
				}

				if (resp['verifikasi_perempuan'] == '1') {
					$("#perempuan").text("Ya");
				} else if (resp['verifikasi_perempuan'] == '0') {
					$("#perempuan").text("Tidak");
				} else {
					$("#perempuan").text("-");
				}

				if (resp['verifikasi_ruang_kerja_k'] == '1') {
					$("#ruang-kerja-k").text("Ya");
				} else if (resp['verifikasi_ruang_kerja_k'] == '0') {
					$("#ruang-kerja-k").text("Tidak");
				} else {
					$("#ruang-kerja-k").text("-");
				}

				if (resp['verifikasi_ruang_kerja_s'] == '1') {
					$("#ruang-kerja-s").text("Ya");
				} else if (resp['verifikasi_ruang_kerja_s'] == '0') {
					$("#ruang-kerja-s").text("Tidak");
				} else {
					$("#ruang-kerja-s").text("-");
				}

				if (resp['verifikasi_ruang_kerja_b'] == '1') {
					$("#ruang-kerja-b").text("Ya");
				} else if (resp['verifikasi_ruang_kerja_b'] == '0') {
					$("#ruang-kerja-b").text("Tidak");
				} else {
					$("#ruang-kerja-b").text("-");
				}

				if (resp['verifikasi_papan_nama'] == '1') {
					$("#papan-nama").text("Ya");
				} else if (resp['verifikasi_papan_nama'] == '0') {
					$("#papan-nama").text("Tidak");
				} else {
					$("#papan-nama").text("-");
				}

				if (resp['verifikasi_preswapres'] == '1') {
					$("#pres").text("Ya");
				} else if (resp['verifikasi_preswapres'] == '0') {
					$("#pres").text("Tidak");
				} else {
					$("#pres").text("-");
				}

				if (resp['verifikasi_garuda'] == '1') {
					$("#garudaa").text("Ya");
				} else if (resp['verifikasi_garuda'] == '0') {
					$("#garudaa").text("Tidak");
				} else {
					$("#garudaa").text("-");
				}

				if (resp['verifikasi_ketum_sekjen'] == '1') {
					$("#ketum-sekjen").text("Ya");
				} else if (resp['verifikasi_ketum_sekjen'] == '0') {
					$("#ketum-sekjen").text("Tidak");
				} else {
					$("#ketum-sekjen").text("-");
				}

				$("#gambar").attr('src', "{{ asset('asset/img/verifikasi/') }}"+"/"+resp['verifikasi_id']+"/gambar/"+resp['verifikasi_pic'])
			}
		});
	}
	function goTo(to){
		window.location = to;
	}
	
	function actionDownload(file,menu,jenis = '',prov = ''){
		if(file == 'excel') {			
			if(menu == 'statistik'){
				statistikDownload(file,jenis);
			}else if(menu == 'verifikasi'){
				verifikasiDownload(file,jenis,prov);
			} else {
				
			}
		} else if(file == 'pdf') {
			if(menu == 'statistik'){
				statistikDownload(file,jenis);
			}else if(menu == 'verifikasi'){
				verifikasiDownload(file,jenis,prov);
			} else {
				
			}			
		}
	}
	function statistikDownload(file,jenis){
		window.open('{{ asset("download/statistik") }}/'+file+'?jenis='+jenis, '_blank');
	}

	function verifikasiDownload(file,jenis,prov){
		window.open('{{ asset("download/verifikasi") }}/'+file+'?jenis='+jenis+'&prov='+prov, '_blank');
	}
	

	
	
	$('.modal-reset').on('hidden.bs.modal', function (e) {
	  $(this)
		.find("input,textarea,select")
		   .val('')
		   .end();
	});
	
	
	
	function setOption(respond,value){
		$(respond).val(value);
	}
	function changeKabupatenOption(fromDiv,respond,prov) {
		$.ajax({
			url     : '{{asset("ajax/option/kab")}}',
			type    : 'get',
			data    : {prov: prov},
			dataType: 'html',
			success : function(data) {
				$(respond).html(data);
			}
		}).done(function(){
			$(fromDiv).val(prov);
			$('#kab').val('{{ @$kab }}');
			$('#edit_id_kabupaten').val('{{ @$kab }}');
		});
	}
	function changeKecamatanOption(fromDiv,respond,prov,kab) {
		$.ajax({
			url     : '{{asset("ajax/option/kec")}}',
			type    : 'get',
			data    : {prov: prov,kab: kab},
			dataType: 'html',
			success : function(data) {
				$(respond).html(data);
			}
		}).done(function(){
			$(fromDiv).val(kab);
			$('#kec').val('{{ @$kec }}');
			$('#edit_id_kecamatan').val('{{ @$kec }}');
		});
	}
	function changeKelurahanOption(fromDiv,respond,prov,kab,kec) {
		$.ajax({
			url     : '{{asset("ajax/option/kel")}}',
			type    : 'get',
			data    : {prov: prov,kab: kab,kec: kec},
			dataType: 'html',
			success : function(data) {
				$(respond).html(data);
			}
		}).done(function(){
			$(fromDiv).val(kec);
			$('#kel').val('{{ @$kel }}');
			$('#edit_id_kelurahan').val('{{ @$kel }}');
		});
	}
	function changeRWOption(fromDiv,respond,prov,kab,kec,kel) {
		$.ajax({
			url     : '{{asset("ajax/option/rw")}}',
			type    : 'get',
			data    : {prov: prov,kab: kab,kec: kec,kel: kel},
			dataType: 'html',
			success : function(data) {
				$(respond).html(data);
			}
		}).done(function(){
			$(fromDiv).val(kel);
			$('#rw').val('{{ @$rw }}');
			$('#edit_id_rw').val('{{ @$rw }}');
		});
	}
	
	function changeKabupatenOptionKPU(fromDiv,respond,prov) {
		$.ajax({
			url     : '{{asset("ajax/optionKPU/kab")}}',
			type    : 'get',
			data    : {prov: prov},
			dataType: 'html',
			success : function(data) {
				$(respond).html(data);
			}
		})/*.done(function(){
			$(fromDiv).val(prov);
			if('{{ @$selected[1] }}' != ''){
				setOption('#kab',{{ @$selected[1] }});
				setOption('#kab2',{{ @$selected[1] }});
				setOption('#id_kab',{{ @$selected[1] }});
			}
		});*/
	}
	function changeKecamatanOptionKPU(fromDiv,respond,prov,kab) {
		$.ajax({
			url     : '{{asset("ajax/optionKPU/kec")}}',
			type    : 'get',
			data    : {prov: prov,kab: kab},
			dataType: 'html',
			success : function(data) {
				$(respond).html(data);
			}
		})/*.done(function(){
			$(fromDiv).val(kab);
			if('{{ @$selected[2] }}' != ''){
				setOption('#kec',{{ @$selected[2] }});
				setOption('#kec2',{{ @$selected[2] }});
				setOption('#id_kec',{{ @$selected[2] }});
			}
		});*/
	}
	function changeKelurahanOptionKPU(fromDiv,respond,prov,kab,kec) {
		$.ajax({
			url     : '{{asset("ajax/optionKPU/kel")}}',
			type    : 'get',
			data    : {prov: prov,kab: kab,kec: kec},
			dataType: 'html',
			success : function(data) {
				$(respond).html(data);
			}
		})/*.done(function(){
			$(fromDiv).val(kec);
			if('{{ @$selected[3] }}' != ''){
				setOption('#kel',{{ @$selected[3] }});
				setOption('#kel2',{{ @$selected[3] }});
				setOption('#id_kel',{{ @$selected[3] }});
			}
		});*/
	}
	function changeRWOptionKPU(fromDiv,respond,prov,kab,kec,kel) {
		$.ajax({
			url     : '{{asset("ajax/optionKPU/rw")}}',
			type    : 'get',
			data    : {prov: prov,kab: kab,kec: kec,kel: kel},
			dataType: 'html',
			success : function(data) {
				$(respond).html(data);
			}
		}).done(function(){
			$(fromDiv).val(kel);
			if('{{ @$selected[4] }}' != ''){
				setOption('#rw',{{ @$selected[4] }});
				setOption('#rw2',{{ @$selected[4] }});
				setOption('#id_rw',{{ @$selected[4] }});
			}
		});
	}
	function changeRTOptionKPU(fromDiv,respond,prov,kab,kec,kel,rw) {
		$.ajax({
			url     : '{{asset("ajax/optionKPU/rt")}}',
			type    : 'get',
			data    : {prov: prov,kab: kab,kec: kec,kel: kel,rw: rw},
			dataType: 'html',
			success : function(data) {
				$(respond).html(data);
			}
		}).done(function(){
			$(fromDiv).val(rw);
			if('{{ @$selected[5] }}' != ''){
				setOption('#rt',{{ @$selected[5] }});
				setOption('#rt2',{{ @$selected[5] }});
				setOption('#id_rt',{{ @$selected[5] }});
			}
		});
	}
	function changeDapilOptionKPU(fromDiv,respond,tingkat,prov,kab) {
		$.ajax({
			url     : '{{asset("ajax/optionDapil")}}',
			type    : 'get',
			data    : {tingkat: tingkat,prov: prov,kab: kab},
			dataType: 'html',
			success : function(data) {
				$(respond).html(data);
			}
		}).done(function(){
			if(kab){
				$(fromDiv).val(kab);
			} else if(prov){
				$(fromDiv).val(prov);
			} else {}
		});
	}

<?php if(@$prov != 0) { ?>
	$('#prov').val('{{ $prov }}');
<?php } ?>
<?php if(@$kab != 0) { ?>
	$('#kab').val('{{ $kab }}');
<?php } ?>
<?php if(@$kec != 0) { ?>
	$('#kec').val('{{ $kec }}');
<?php } ?>

$('.tambah-phone').click(function() {
  var phone = $('#telp_old').val();
  var newTelp = $('#phone-number').val();
  if(phone == "") 
  {
    $('#telp_old').attr('value',newTelp);
  } else {
    $('#telp_old').attr('value',phone+', '+newTelp);
  }
  $('#phone-number').val('');
});
$('.tambah-phone-ketua').click(function() {
  var phone = $('#telp_old_ketua').val();
  var newTelp = $('#phone-number-ketua').val();
  if(phone == "") 
  {
    $('#telp_old_ketua').attr('value',newTelp);
  } else {
    $('#telp_old_ketua').attr('value',phone+', '+newTelp);
  }
  $('#phone-number').val('');
});
/*$(function () {

	 if ( ! $.fn.DataTable.isDataTable( 'table' ) ) {
	 	$('table').DataTable({
		 	"dom": '<"pull-left top"l><"pull-right top form-group"f><"clear">t<"bottom"ip><"clear">',
		 	 responsive: true,
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": false,
			"info": true,
			"autoWidth": true,
			columnDefs:[{
				targets:[-1],
				className:'table-aksi',
			}],
			"pageLength": 10,
	    });
	} 
});*/
  $(function () {
	if ( $.fn.dataTable.isDataTable( "table" ) ) {
		table = $('table').DataTable({searching : false, paging : false});
	} 
	else if(typeof(janganBuatDataTableLagiPlease) == "undefined"){
		/* if($('table').hasClass('no-paging')) {		
			table = $('table').DataTable({
				"dom": '<"pull-left top"l><"pull-right top form-group"f><"clear">t<"bottom"ip><"clear">',
				 responsive: true,
				"paging": false,
				"lengthChange": true,
				"searching": true,
				"ordering": false,
				"info": true,
				"autoWidth": true,
				columnDefs:[{
					targets:[-1],
					className:'table-aksi',
				}],
				"pageLength": 10,
			});
		} else{		 */	
			table = $('table').DataTable({
				"dom": '<"pull-left top"l><"pull-right top form-group"f><"clear">t<"bottom"ip><"clear">',
				 responsive: true,
				"paging": false,
				"lengthChange": true,
				"searching": false,
				"ordering": false,
				"info": true,
				"autoWidth": true,
				columnDefs:[{
					targets:[-1],
					className:'table-aksi',
				}],
				"pageLength": 10,
			});
		/* } */
	}
  });

$(document).ready(function(){
	if({{ session('idRole') }} == 3) {
		$($( "table.no-paging" ).parent()).find( ".bottom" ).css( "display", "none" );
		changeKabupatenOptionKPU(null,'#kab','{{ session('idProvinsi2') }}');				
		changeKabupatenOptionKPU(null,'#kab2','{{ session('idProvinsi2') }}');
	} else if({{ session('idRole') }} == 4) {	
		$($( "table.no-paging" ).parent()).find( ".bottom" ).css( "display", "none" );
		changeKecamatanOptionKPU(null,'#kec','{{ session('idProvinsi2') }}','{{ session('idKabupaten') }}');				
		changeKecamatanOptionKPU(null,'#kec2','{{ session('idProvinsi2') }}','{{ session('idKabupaten') }}');
	}
  	$('div#DataTables_Table_0_filter input').attr('placeholder','Cari ...');
	$('.modal').addClass('fade');
});
$('#id_pilihan').change(function() {
  var change = $(this).val();
  $.ajax({
    url     : '{{asset("response/aktif")}}',
    type    : 'get',
    data    : {change: change},
    dataType: 'html',
    success : function(data) {
      $('.response').html(data);
    }
  });
});

	//paste this code under head tag or in a seperate js file.
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");
		$(".se-pre-con2").hide();
		$('.alert-success').hide();
		$('.alert-danger').hide();
		$('.highcharts-credits').hide();
	});
	
	$(document).bind('ajaxStart', function(){
		$('.se-pre-con2').show();   
	}).bind('ajaxStop', function(){
		$(".se-pre-con2").fadeOut("slow");
	});
	
function RefreshTable(tableId, urlData)
{
  //Retrieve the new data with $.getJSON. You could use it ajax too
  $.getJSON(urlData, null, function( json )
  {
	table = $(tableId).dataTable();
	oSettings = table.fnSettings();

	table.fnClearTable(this);

	for (var i=0; i<json.aaData.length; i++)
	{
	  table.oApi._fnAddData(oSettings, json.aaData[i]);
	}

	oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
	table.fnDraw();
  });
}

$(".modal").on("hidden.bs.modal", function(){
    $(".modal input[type=text]").val("");
});

$('#btn-terima').click(function(){
	alert('test');
});
/* $('#terima').click(function(){
	actionUser(11535,1,'#tablePendaftar');
});
$('#tolak').click(function(){
	actionUser(11535,2,'#tablePendaftar');
}); */

function actionUser(id,flag,div){
	$.ajax({
		url     : '{{asset("user_management/pendaftar/action")}}/'+id+'/'+flag,
		type    : 'get',
		data    : {id: id,flag: flag},
		dataType: 'html',
		success : function(data) {
			if(data == 'success'){		
				RefreshTable(div,'{{ asset("user_management/pendaftar/table") }}')
			}
		}
	});
}

function hideElement(elements){
	$(elements).hide();
}
function showElement(elements){
	$(elements).show();
}
</script>
</script>
@yield('function')
</body>
</html>
