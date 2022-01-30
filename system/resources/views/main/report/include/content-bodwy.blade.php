<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
		<h1>
			@yield('menu')
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			@foreach($breadcrumb as $val)
				<li>{{$val}}</li>
			@endforeach
		</ol>
	</section>
	<section class="content">
		<div class="page-ajax">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="box-header with-border">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-6">
									@yield('box-header')
								</div>
								<div class="@yield('download-button','hide') col-md-2 col-sm-3 col-xs-6 pull-right">
									<div class="btn-warning btn-block btn" onclick="actionDownload('report','all')"><i class="fa fa-print"></i> Download</div>
								</div>
							</div>
						</div>				
			  			<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									@yield('content-filter')
								</div>
							</div>
							<div class="row" id="canvasReport">
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-12" id="canvasPie">
											
										</div>
									</div>
									<div class="row">
										<div class="col-md-12" id="canvasKetua">
											<div class="row form-group">
												<div class="col-md-3">
													<div class="canvas-picture-xs">
														<img src="{{ asset('asset/img/blank_profil.png') }}" alt="" height="100%" width="100%"/>
													</div>
												</div>
												<div class="col-md-9">
													<h4 class="no-margin"><b>{{ $namaKetuaDPD }}</b></h4>
													<small>Ketua PIMDA {{ @$namaDaerah }}</small> <br>
													<small>{{ $SkepKet }}</small>
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-3">
													<div class="canvas-picture-xs">
														<img src="{{ asset('asset/img/blank_profil.png') }}" alt="" height="100%" width="100%"/>
													</div>
												</div>
												<div class="col-md-9">
													<h4 class="no-margin"><b>{{ $namaSekDPD }}</b></h4>
													<small>Sekertaris PIMDA {{ @$namaDaerah }}</small><br>
													<small>{{ @$SkepSek }}</small>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-6 @yield('canvas-kabupaten','initial')" id="canvasKabupaten"></div>
										<div class="col-md-6 @yield('canvas-kecamatan','initial')" id="canvasKecamatan"></div>
										<div class="col-md-6 @yield('canvas-kelurahan','initial')" id="canvasKelurahan"></div>
										<div class="col-md-6 @yield('canvas-rw','initial')" id="canvasRW"></div>
										<div class="col-md-6 @yield('canvas-rt','initial')" id="canvasRT"></div>
										<div class="col-md-6 @yield('canvas-dprdi','initial')" id="canvasDprdi"></div>
										<div class="col-md-6 @yield('canvas-dprdii','initial')" id="canvasDprdii"></div>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-4">
									<div class="panel panel-default">
										<div class="panel-heading">
											<label>PIMCAB Belum Terbentuk</label>
										</div>
										<div class="panel-body" id="area-nf-pimcab" style="padding: 0; height: 500px; overflow-x: hidden;">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>
														<th class="text-center">Kota / Kabupaten</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if($prov != null){
													$a = 1;
														?>
													@foreach($pimcab_null as $get)
													<tr>
														<td>{{ $get->geo_kab_nama }}</td>
													</tr>
													@endforeach
														<?php
													}
													?>
												</tbody>
											</table>
										<?php
										/*echo str_replace("/?", "?", $pimcam_null->render());*/
										?>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="panel panel-default">
										<div class="panel-heading">
											<label>PIMCAM Belum Terbentuk</label>
										</div>
										<div class="panel-body" id="area-nf-pimcam" style="padding: 0; height: 500px; overflow-x: hidden;">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>
														<th class="text-center">Kota / Kabupaten</th>
														<th class="text-center">Kecamatan</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if($prov != null){
													$a = 1;
														?>
													@foreach($pimcam_null as $get)
													<tr>
														<td>{{ $get->geo_kab_nama }}</td>
														<td>{{ $get->geo_kec_nama }}</td>
													</tr>
													@endforeach
														<?php
													}
													?>
												</tbody>
											</table>
										<?php
										/*echo str_replace("/?", "?", $pimcam_null->render());*/
										?>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="panel panel-default">
										<div class="panel-heading">
											<label>PIMRAN Belum Terbentuk</label>
										</div>
										<div class="panel-body" id="area-nf-pr" style="padding: 0; height: 500px; overflow-x: hidden;">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>
														<th class="text-center">Kecamatan</th>
														<th class="text-center">Kelurahan</th>
													</tr>
												</thead>
												<tbody>
													@if($prov)
														@foreach($pimran_null as $get)
														<tr>
															<td>{{ $get->geo_kec_nama }}</td>
															<td>{{ $get->geo_deskel_nama }}</td>
														</tr>
														@endforeach
													@endif
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="{{asset('asset/plugins/mcustomscroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('asset/css/mcustomscroll/jquery.mCustomScrollbar.min.css')}}">
	<script src="{{asset('asset/plugins/scrollbar/jquery.scrollbar.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('asset/css/scrollbar/jquery.scrollbar.css')}}">
	<script type="text/javascript">
	var provId, kabId, kecId, kelId, rwId;
	var response, url;
	
	provId = $('#prov').val();
	kabId = $('#kab').val();
	kecId = $('#kec').val();
	kelId = $('#kel').val();
	rwId = $('#rw').val();
	rtId = $('#rt').val();
	DprdiId = $('#dprdi').val();
	DprdiiId = $('#dprdii').val();
	
	$('document').ready(function(){
		if(provId != ''){
			if('{{ $type }}' == 'pimda'){			
				getGrafik('pie','#canvasPie','pimda','/'+provId);
				/* getGrafik('ketua','#canvasKetua','/'+provId); */
				getGrafik('kabupaten','#canvasKabupaten','pimda','/'+provId);
				getGrafik('kecamatan','#canvasKecamatan','pimda','/'+provId);
				getGrafik('kelurahan','#canvasKelurahan','pimda','/'+provId);
				getGrafik('rw','#canvasRW','pimda','/'+provId);
				getGrafik('rt','#canvasRT','pimda','/'+provId);
			} else if('{{ $type }}' == 'pimcab'){	
				hideElement('#canvasKabupaten');
				getGrafik('pie','#canvasPie','pimcab','/'+provId);
				/* getGrafik('ketua','#canvasKetua','/'+provId); */
				getGrafik('kecamatan','#canvasKecamatan','pimcab','/'+provId);
				getGrafik('kelurahan','#canvasKelurahan','pimcab','/'+provId);
				getGrafik('rw','#canvasRW','pimcab','/'+provId);
				getGrafik('rt','#canvasRT','pimcab','/'+provId);
				getGrafik('dprdi','#canvasDprdi','pimcab','/'+provId);
				getGrafik('dprdii','#canvasDprdii','pimcab','/'+provId);
			} else if('{{ $type }}' == 'pimcam'){
				hideElement('#canvasKabupaten');	
				hideElement('#canvasKecamatan');
				getGrafik('pie','#canvasPie','pimcam','/'+provId);
				/* getGrafik('ketua','#canvasKetua','/'+provId); */
				getGrafik('kelurahan','#canvasKelurahan','pimcam','/'+provId);
				getGrafik('rw','#canvasRW','pimcam','/'+provId);
				getGrafik('rt','#canvasRT','pimcam','/'+provId);
			} else if('{{ $type }}' == 'pimran'){	
				hideElement('#canvasKabupaten');	
				hideElement('#canvasKecamatan');
				hideElement('#canvasKelurahan');
				getGrafik('pie','#canvasPie','pimran','/'+provId);
				/* getGrafik('ketua','#canvasKetua','/'+provId); */
				getGrafik('rw','#canvasRW','pimran','/'+provId);
				getGrafik('rt','#canvasRT','pimran','/'+provId);
			} else if('{{ $type }}' == 'par'){	
				hideElement('#canvasKabupaten');	
				hideElement('#canvasKecamatan');
				hideElement('#canvasKelurahan');
				hideElement('#canvasRW');
				getGrafik('rt','#canvasRT','par','/'+provId);
				getGrafik('pie','#canvasPie','par','/'+provId);		
				/* getGrafik('ketua','#canvasKetua','/'+provId); */		
			} else if('{{ $type }}' == 'kpa'){	
				hideElement('#canvasKabupaten');	
				hideElement('#canvasKecamatan');
				hideElement('#canvasKelurahan');
				hideElement('#canvasRW');
				getGrafik('pie','#canvasPie','kpa','/'+provId);		
				/* getGrafik('ketua','#canvasKetua','/'+provId); */		
			}
		} else {
			$('#canvasReport').hide();
		}
	});
	
	function getGrafik(jenis,response,type,addLink='',types){
		if(jenis == 'pie'){
			getGrafikPie(response,addLink,type);
		} else if(jenis == 'ketua'){
			getGrafikKetua(response,addLink,type);
		} else if(jenis == 'kabupaten'){
			getGrafikKabupaten(response,addLink,type);
		} else if(jenis == 'kecamatan'){
			getGrafikKecamatan(response,addLink,type);
		} else if(jenis == 'kelurahan'){
			getGrafikKelurahan(response,addLink,type);
		} else if(jenis == 'rw'){
			getGrafikRW(response,addLink,type);
		} else if(jenis == 'rt'){
			getGrafikRT(response,addLink,type);
		} else if(jenis == 'dprdi'){
			getGrafikDprdi(response,addLink,type);
		} else if(jenis == 'dprdii'){
			getGrafikDprdii(response,addLink,type);
		}
	}
	
	function getGrafikPie(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/pie'+addLink,
			type	: 'get',
			data	: {jenis:'pie'},
			dataType: 'html',
			success:function(data){					
				$(response).html(data);
			}
		});	
	}
	function getGrafikKetua(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/ketua'+addLink,
			type	: 'get',
			data	: {jenis:'ketua'},
			dataType: 'html',
			success:function(data){					
				$(response).html(data);
			}
		});
	}
	function getGrafikKabupaten(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/kabupaten'+addLink,
			type	: 'get',
			data	: {jenis:'kabupaten'},
			dataType: 'html',
			success:function(data){					
				$(response).html(data);
			}
		});
	}
	function getGrafikKecamatan(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/kecamatan'+addLink,
			type	: 'get',
			data	: {jenis:'kecamatan'},
			dataType: 'html',
			success:function(data){					
				$(response).html(data);
			}
		});
	}
	function getGrafikKelurahan(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/kelurahan'+addLink,
			type	: 'get',
			data	: {jenis:'kelurahan'},
			dataType: 'html',
			success:function(data){					
				$(response).html(data);
			}
		});
	}
	function getGrafikRW(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/rw'+addLink,
			type	: 'get',
			data	: {jenis:'rw'},
			dataType: 'html',
			success:function(data){					
				$(response).html(data);
			}
		});
	}
	function getGrafikRT(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/rt'+addLink,
			type	: 'get',
			data	: {jenis:'rw'},
			dataType: 'html',
			success:function(data){					
				$(response).html(data);
			}
		});
	}
	function getGrafikDprdi(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/dprdi'+addLink,
			type	: 'get',
			data	: {jenis:'dprdi'},
			dataType: 'html',
			success:function(data){					
				$(response).html(data);
			}
		});
	}
	function getGrafikDprdii(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/dprdii'+addLink,
			type	: 'get',
			data	: {jenis:'dprdii'},
			dataType: 'html',
			success:function(data){					
				$(response).html(data);
			}
		});
	}
	
	$(function(){		
		$('#prov').change(function(){
			var provId = $(this).val();
			@yield('goto_prov')
			changeKabupatenOptionKPU(null,'#kab',provId);

		});

		$('#kab').change(function(){
			var provId = $('#prov').val();
			var kabId = $(this).val();
			@yield('goto_kab')
			changeKecamatanOptionKPU(null,'#kec',provId,kabId);

		});
		$('#kec').change(function(){
			var provId = $('#prov').val();
			var kabId = $('#kab').val();
			var kecId = $(this).val();
			@yield('goto_kec')
			changeKelurahanOptionKPU(null,'#kel',provId,kabId,kecId);

		});
		$('#kel').change(function(){
			var provId = $('#prov').val();
			var kabId = $('#kab').val();
			var kecId = $('#kec').val();
			var kelId = $(this).val();
			@yield('goto_kel')
			changeRWOptionKPU(null,'#rw',provId,kabId,kecId,kelId);

		});
		$('#rw').change(function(){
			var provId = $('#prov').val();
			var kabId = $('#kab').val();
			var kecId = $('#kec').val();
			var kelId = $('#kel').val();
			var rwId = $('#rw').val();
			@yield('goto_rw')

			//changeRWOptionKPU('#rw',provId,kabId,kecId,kelId,rwId);
		});
		$('#rt').change(function(){
			var provId = $('#prov').val();
			var kabId = $('#kab').val();
			var kecId = $('#kec').val();
			var kelId = $('#kel').val();
			var rwId = $('#rw').val();
			var rtId = $('#rt').val();
			@yield('goto_rt')

			//changeRWOptionKPU('#rw',provId,kabId,kecId,kelId,rwId);
		});
	});
	</script>