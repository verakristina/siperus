@extends('main.layout.layout')

@section('title-page','Dashboard')

@section('main-sidebar')
@endsection

@section('content')

<div class="modal primary fade" id="modal-grafik" role="dialog" aria-labelledby="barangbuktiModalLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="" id="form-input-struk" name="barangbuktiform" enctype="multipart/form-data" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="my-modal-label">DATA GRAFIK</h4>
				</div>
				<div class="modal-body" id="tabel-grafik">
				</div>
			</div>
		</form>
	</div>
</div>

<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
	  <h1>
		Dashboard
			<small>{{ $dashboardName  }}</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	  </ol>
	</section>

	<section class="content">
	  <div class="row" style="margin-bottom: 15px;">
        <div class="col-md-3 col-sm-6 col-xs-12">
			<select class="form-control custom-field-litle {{ (session('idProvinsi2'))?'hide':'' }}" id="prov" name="prov" onchange="getGrafik(this.value,'#container')"  >
				<option value="0">--- Provinsi ---</option>
				@foreach($dataProv as $tmps)
					<option value="{{ $tmps->geo_prov_id }}" {{ ($tmps->geo_prov_id == @$prov)?'selected':'non-selected' }} > {{ $tmps->geo_prov_nama }} </option>
				@endforeach
			</select>
		</div>

	  </div>
	  <div class="row">					
		<div class="col-md-6 @yield('canvas-provinsi','initial')" style="margin-bottom: 15px; display: table;">
		  <div id="canvasProvinsi" style="text-align: center; min-width: 310px; height: 200px; margin: 0 auto;background:#ffffff; display: table-cell; vertical-align: middle;"></div>
		</div>			
		<div class="col-md-6 @yield('canvas-kabupaten','initial')" style="margin-bottom: 15px; display: table;">
		  <div id="canvasKabupaten" style="text-align: center; min-width: 310px; height: 200px; margin: 0 auto;background:#ffffff; display: table-cell; vertical-align: middle;"></div>
		</div>
		<div class="col-md-6 @yield('canvas-kecamatan','initial')" style="margin-bottom: 15px; display: table;">
		  <div id="canvasKecamatan" style="text-align: center; min-width: 310px; height: 200px; margin: 0 auto;background:#ffffff; display: table-cell; vertical-align: middle;"></div>
		</div>
		<div class="col-md-6 @yield('canvas-kelurahan','initial')" style="margin-bottom: 15px; display: table;">
		  <div id="canvasKelurahan" style="text-align: center; min-width: 310px; height: 200px; margin: 0 auto;background:#ffffff; display: table-cell; vertical-align: middle;"></div>
		</div>
		<div class="col-md-6 @yield('canvas-rw','initial')" style="margin-bottom: 15px; display: table;">
		  <div id="canvasRW" style="text-align: center; min-width: 310px; height: 200px; margin: 0 auto;background:#ffffff; display: table-cell; vertical-align: middle;"></div>
		</div>
		<div class="col-md-6 @yield('canvas-rt','initial')" style="margin-bottom: 15px; display: table;">
		  <div id="canvasRT" style="text-align: center; min-width: 310px; height: 200px; margin: 0 auto;background:#ffffff; display: table-cell; vertical-align: middle;"></div>
		</div>
		<div class="col-md-6 @yield('canvas-dprri','initial')" style="margin-bottom: 15px; display: table;">
		  <div id="canvasDprri" style="text-align: center; min-width: 310px; height: 200px; margin: 0 auto;background:#ffffff; display: table-cell; vertical-align: middle;"></div>
		</div>
		<div class="col-md-6 @yield('canvas-dprdi','initial')" style="margin-bottom: 15px; display: table;">
		  <div id="canvasDprdi" style="text-align: center; min-width: 310px; height: 200px; margin: 0 auto;background:#ffffff; display: table-cell; vertical-align: middle;"></div>
		</div>
		<div class="col-md-6 @yield('canvas-dprdii','initial')" style="margin-bottom: 15px; display: table;">
		  <div id="canvasDprdii" style="text-align: center; min-width: 310px; height: 200px; margin: 0 auto;background:#ffffff; display: table-cell; vertical-align: middle;"></div>
		</div>
	  </div>
	  <div class="row">
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="canvasResponseProvinsi">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-map-marker"></i></span>
            <div class="info-box-content">
				  <span class="info-box-text">PIMDA / Provinsi</span>
				  <span class="info-box-number responseProvinsi" style="font-size: 15px">
					{{ number_format($dataProvAda,0, "." , ".") }} / {{ number_format($dataProvAll,0, "." , ".") }}
			  <h2 class="no-margin">
						{{ $dataProvPer }}%
			  </h2>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
			</div>  
        <!-- /.col -->
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="canvasResponseKabupaten">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-map-marker"></i></span>
            <div class="info-box-content">
				  <span class="info-box-text">PIMCAB / Kota</span>
				  <span class="info-box-number responseKabupaten" style="font-size: 15px">
				  {{ number_format($dataKabAda,0, "." , ".") }} / {{ number_format($dataKabAll,0, "." , ".") }}
              <br>
			  <h2 class="no-margin">
						{{ $dataKabPer }}%
			  </h2>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
    
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="canvasResponseKecamatan">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-map-marker"></i></span>
            <div class="info-box-content">
				  <span class="info-box-text">PIMCAM / Kecamatan</span>
				  <span class="info-box-number responseKecamatan" style="font-size: 15px">
					  {{ number_format($dataKecAda,0, "." , ".") }} / {{ number_format($dataKecAll,0, "." , ".") }}
              <br>
				<h2 class="no-margin">
						{{ @$dataKecPer }}%
				</h2>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="canvasResponseKelurahan">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-map-marker"></i></span>
            <div class="info-box-content">
				  <span class="info-box-text">PIMRAN / Kelurahan</span>
				  <span class="info-box-number responseKelurahan" style="font-size: 15px">
					  {{ number_format($dataKelAda,0, "." , ".") }} / {{ number_format($dataKelAll,0, "." , ".") }}
              <br>
			  <h2 class="no-margin">
						{{ @$dataKelPer }}%
			  </h2>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
			<!-- /.col --> 

			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="canvasResponseRW">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-map-marker"></i></span>
            <div class="info-box-content">
				  <span class="info-box-text">PAR / RW</span>
				  <span class="info-box-number responseRW" style="font-size: 15px">
					  {{ number_format($dataRWAda,0, "." , ".") }} / {{ number_format($dataRWAll,0, "." , ".") }}
              <br>
			  <h2 class="no-margin">
					  {{ @$dataRWPer }}%
			  </h2>
				  </span>								
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col --> 
			
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="canvasResponseRT">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-map-marker"></i></span>
            <div class="info-box-content">
				  <span class="info-box-text">KPA / RT</span>
				  <span class="info-box-number responseRT" style="font-size: 15px">
					  {{ number_format($dataRTAda,0, "." , ".") }} / {{ number_format($dataRTAll,0, "." , ".") }}
              <br>
			  <h2 class="no-margin">
					  {{ $dataRTPer }}%
			  </h2>
				  </span>								
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col --> 
		
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Penduduk</span>
				  <span class="info-box-number responsePenduduk" style="font-size: 15px">{{ number_format($jumlahPenduduk,0, "." , ".") }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>        


        <!-- /.col --> 
      </div>
      <!-- /.row -->
	</section>
</div>
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>
	var provId, kabId, kecId, kelId, rwId, rtId;
	var response, url;
	var link = '';
	var reloadIcon = '<i class="fa fa-refresh fa-spin" style="color: #dd4b39;"></i>';
	var reloadIcon5x = '<i class="fa fa-refresh fa-spin fa-5x" style="color: #dd4b39;"></i>';
	
	provId = $('#prov').val();
	kabId = $('#kab').val();
	kecId = $('#kec').val();
	kelId = $('#kel').val();
	rwId = $('#rw').val();
	rtId = $('#rt').val();

	$(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getPosts(page);
            }
        }
    });

	$('document').ready(function(){
		$(document).on('click', '.pager a', function (e) {
            getPosts($(this).attr('href'));
            e.preventDefault();
        });



		if({{ session('idRole') }} == 3) {
			$($('#canvasProvinsi').parent('div')).hide();
			$($('#canvasDprri').parent('div')).hide();
			$($('#canvasDprdi').parent('div')).hide();
			$($('#canvasDprdii').parent('div')).hide();
			$('#canvasResponseProvinsi').hide();
		} else if({{ session('idRole') }} == 4) {
			$($('#canvasProvinsi').parent('div')).hide();
			$($('#canvasKabupaten').parent('div')).hide();
			$($('#canvasDprri').parent('div')).hide();
			$($('#canvasDprdi').parent('div')).hide();
			$($('#canvasDprdii').parent('div')).hide();
			$('#canvasResponseProvinsi').hide();
			$('#canvasResponseKabupaten').hide();
		} else if({{ session('idRole') }} == 5) {
			$($('#canvasProvinsi').parent('div')).hide();
			$($('#canvasKabupaten').parent('div')).hide();
			$($('#canvasKecamatan').parent('div')).hide();
			$($('#canvasDprri').parent('div')).hide();
			$($('#canvasDprdi').parent('div')).hide();
			$($('#canvasDprdii').parent('div')).hide();
			$('#canvasResponseProvinsi').hide();
			$('#canvasResponseKabupaten').hide();
			$('#canvasResponseKecamatan').hide();
		} else if({{ session('idRole') }} == 6) {
			$($('#canvasProvinsi').parent('div')).hide();
			$($('#canvasKabupaten').parent('div')).hide();
			$($('#canvasKecamatan').parent('div')).hide();
			$($('#canvasKelurahan').parent('div')).hide();
			$($('#canvasDprri').parent('div')).hide();
			$($('#canvasDprdi').parent('div')).hide();
			$($('#canvasDprdii').parent('div')).hide();
			$('#canvasResponseProvinsi').hide();
			$('#canvasResponseKabupaten').hide();
			$('#canvasResponseKecamatan').hide();
			$('#canvasResponseKelurahan').hide();
		} else {
			$($('#canvasProvinsi').parent('div')).show();
			$($('#canvasKabupaten').parent('div')).show();
			$($('#canvasKecamatan').parent('div')).show();
			$($('#canvasKelurahan').parent('div')).show();
			$($('#canvasDprri').parent('div')).show();
			$($('#canvasDprdi').parent('div')).show();
			$($('#canvasDprdii').parent('div')).show();
			$('#canvasResponseProvinsi').show();
			$('#canvasResponseKabupaten').show();
			$('#canvasResponseKecamatan').show();
			$('#canvasResponseKelurahan').show();
		}
		
		link = '/';
		getGrafiks('provinsi','#canvasProvinsi','dpd',link+provId);
		getGrafiks('kabupaten','#canvasKabupaten','dpd',link+provId);
		getGrafiks('kecamatan','#canvasKecamatan','dpd',link+provId);
		getGrafiks('kelurahan','#canvasKelurahan','dpd',link+provId);
		getGrafiks('rw','#canvasRW','dpd',link+provId);		
		getGrafiks('rt','#canvasRT','dpd',link+provId);		
		getGrafiks('dprri','#canvasDprri','dpd',link+provId);		
		getGrafiks('dprdi','#canvasDprdi','dpd',link+provId);	
		getGrafiks('dprdii','#canvasDprdii','dpd',link+provId);		

		
		$('#container').html('<div style="background: url({{ asset("asset/img/spin.gif") }}) center no-repeat #fff; height: 100%;"></div>');	
		var prov = $('#prov').val();
		if(prov != ''){
			var url = '{{ asset("dashboard/get/data/grafik") }}/'+prov;
		} else {
			var url = '{{ asset("dashboard/get/data/grafik") }}';
		}			

		$.ajax({
			url     : url,
			type    : 'get',
			data    : {prov: prov},
			dataType: 'html',
			success : function(data) {
				$('#container').html(data)
			}
		});
	});
	function getGrafik(prov,response){	
			link = '/';
		if(prov != '') {
			$($('#canvasProvinsi').parent('div')).hide();
			$('#canvasResponseProvinsi').hide();
		} else {
			$($('#canvasProvinsi').parent('div')).show();
			$('#canvasResponseProvinsi').show();
		}
		
		var urlData = '{{ asset("dashboard/get/data") }}'+link+prov;
		getGrafiks('provinsi','#canvasProvinsi','dpd',link+prov);
		getGrafiks('kabupaten','#canvasKabupaten','dpd',link+prov);
		getGrafiks('kecamatan','#canvasKecamatan','dpd',link+prov);
		getGrafiks('kelurahan','#canvasKelurahan','dpd',link+prov);
		getGrafiks('rw','#canvasRW','dpd',link+prov);
		getGrafiks('rt','#canvasRT','dpd',link+prov);	
		getGrafiks('dprri','#canvasDprri','dpd',link+prov);		
		getGrafiks('dprdi','#canvasDprdi','dpd',link+prov);	
		getGrafiks('dprdii','#canvasDprdii','dpd',link+prov);		
	
		$('.responseProvinsi').html(reloadIcon);
		$('.responseKabupaten').html(reloadIcon);
		$('.responseKecamatan').html(reloadIcon);
		$('.responseKelurahan').html(reloadIcon);
		$('.responseRW').html(reloadIcon);
		$('.responseRT').html(reloadIcon);
		$('.responsePenduduk').html(reloadIcon);
	
		$.ajax({
			url     : urlData,
			type    : 'get',
			data    : {prov: prov},
			dataType: 'html',
			success : function(res) {
				var data = JSON.parse(res);
				$('.responseProvinsi').html(data['prov']);
				$('.responseKabupaten').html(data['kabv']+"/"+data['kab']+"<br><div style='font-size: 20px'>"+data['Hkabv']+"%</div>");
				$('.responseKecamatan').html(data['kecv']+"/"+data['kec']+"<br><div style='font-size: 20px'>"+data['Hkecv']+"%</div>");
				$('.responseKelurahan').html(data['kelv']+"/"+data['kel']+"<br><div style='font-size: 20px'>"+data['Hkelv']+"%</div>");
				$('.responseRW').html(data['rwv']+"/"+data['rw']+"<br><div style='font-size: 20px'>"+data['Hrwv']+"%</div>");
				$('.responseRT').html(data['rtv']+"/"+data['rt']+"<br><div style='font-size: 20px'>"+data['Hrtv']+"%</div>");
				$('.responsePenduduk').html(data['penduduk']);
			}
		});
	}

	function getPercent(val1,val2) {
          
		var per = val1/val2*100;
		if (isNaN(per)) {
			return 0;
		}
    
		return per.toFixed(2);
	}  
	
	function getGrafiks(jenis,response,type,addLink='',types){
		if(jenis == 'pie'){
			getGrafikPie(response,addLink,type);
		} else if(jenis == 'ketua'){
			getGrafikKetua(response,addLink,type);
		} else if(jenis == 'provinsi'){
			getGrafikProvinsi(response,addLink,type);
		} else if(jenis == 'kabupaten'){
			getGrafikKabupaten(response,addLink,type);
		} else if(jenis == 'kecamatan'){
			getGrafikKecamatan(response,addLink,type);
		} else if(jenis == 'kelurahan'){
			getGrafikKelurahan(response,addLink,type);
		} else if(jenis == 'rw'){
			getGrafikRW(response,addLink);
		} else if(jenis == 'rt'){
			getGrafikRT(response,addLink);
		} else if(jenis == 'dprri'){
			getGrafikDprri(response,addLink,type);
		} else if(jenis == 'dprdi'){
			getGrafikDprdi(response,addLink,type);
		} else if(jenis == 'dprdii'){
			getGrafikDprdii(response,addLink,type);
		}
		$(response).html(reloadIcon5x);
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
	function getGrafikProvinsi(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/provinsi'+addLink,
			type	: 'get',
			data	: {jenis:'provinsi'},
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
			data	: {jenis:'rt'},
			dataType: 'html',
			success:function(data){					
				$(response).html(data);
			}
		});
	}
	function getGrafikDprri(response,addLink='',types){
		$.ajax({
			url		: '{{ url() }}/grafik/'+types+'/dprri'+addLink,
			type	: 'get',
			data	: {jenis:'dprri'},
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

</script>

@endsection