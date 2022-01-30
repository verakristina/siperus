<div class="content-wrapper min-height" style="min-height:1px;">

	<section class="content-header">
	  <h1>
		@yield('struk_tipe_menu')
		<small>@yield('struk_tipe_sub_menu')</small>
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
		  <!-- <div class="box box-success">
			<div class="box-header with-border">
					<h3 class="box-title">Tambah User</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						</button>
					  </div>

				  </div>
		  </div> -->   
		  <div class="col-md-6">
		  </div>
		  <div class="panel">
			  <div class="box-header with-border">
				  <div class="row">
					<div class="col-md-2 col-sm-3 col-xs-6">
						@yield('struk_tipe_box_header')
					</div>
					<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
						<div class="@yield('add-button','show') btn-block  btn-danger btn" data-toggle="modal" data-target="#modal-input-struk" onclick="actionTambah()"><i class="fa fa-plus"></i> @yield('name-button','Tambah')</div>
					</div>
					<div class="col-md-1 col-sm-3 col-xs-6 pull-right">
						<div class="btn-danger btn" onclick="printPdf('@yield('a_type')', '@yield('a_prov')', '@yield('a_kab')', '@yield('a_kec')', '@yield('a_deskel')', '@yield('a_rw')')" data-toggle="tooltip" data-placement="bottom" title="Print PDF" style="margin-top: 3px;"><i class="fa fa-file-pdf-o"></i> </div>
					</div>
					<div class="col-md-1 col-sm-3 col-xs-6 pull-right">
						<div class="btn-danger btn" onclick="printExcel('@yield('a_type')', '@yield('a_prov')', '@yield('a_kab')', '@yield('a_kec')', '@yield('a_deskel')', '@yield('a_rw')')" data-toggle="tooltip" data-placement="bottom" title="Print Excel" style="margin-top: 3px;"><i class="fa fa-file-excel-o"></i></div>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
						@if($sk_baru != "-")
			  			<div class="pull-right">
			  				<div class="checkbox">
			  					<label>
			  						<input type="checkbox" name="cb_sk" {{ ($sk_baru == "YA")?"checked='true'":"" }} 	> BUTUH SK BARU
			  					</label>
			  				</div>
			  			</div>
			  			@else
			  			@endif
					</div>
				  </div>
			  </div>
			 
				   <div class="response-cari">
					  <!-- /.box-tools -->
					  {{--*/$no=1/*--}}
					  <div class="panel-body">					
						<div class="row" id="canvasFilter">
							@yield('content_filter_combo')
							
						</div>
						<div class="" style="padding:5px !important;display:@yield('usecanvas','none')!important;margin-bottom:15px;border:1px solid rgba(0,0,0,0.1);border-radius:5px;height:400px;" >
								<div class="dropdown pull-right" style="position:absolute !important;right:40px;z-index:12" id="chart-config" >

									<span class="fa fa-wrench btn btn-warning" data-toggle="dropdown">
										<i class="caret"></i></span>
										<ul class="dropdown-menu">
											<li class="dropdown-header">Pengaturan Chart</li>
											<li><a href="#" id="chart-mode-stack"  data-group='1'><span class="glyphicon glyphicon-check"></span>Mode Stack</a></li>
											<li><a href="#" id="chart-mode-group"  data-group='1'><span class="glyphicon glyphicon-unchecked"></span>Mode Group</a></li>

											<li class="divider"></li>
											<li class="dropdown-header">Data Lainya</li>
											<!--li><a href="#" data-index="4a">Jumlah DPP by SK</a></li-->
											<li><a href="#" data-index="4b">Jumlah DPD by SK</a></li>
											<li><a href="#" data-index="4c">Jumlah DPC by SK</a></li>
											<li class="divider"></li>
											<!--li><a href="#" data-index="5">Jumlah DPP</a></li-->
											<li><a href="#" data-index="6">Jumlah DPD by Provinsi</a></li>
											<li><a href="#" data-index="7">Jumlah DPC by Provinsi</a></li>
											<li><a href="#" data-index="8">Jumlah PAC by Provinsi</a></li>
											<li><a href="#" data-index="9">Jumlah PAR by Provinsi</a></li>
											<li><a href="#" data-index="10">Jumlah KPA by Provinsi</a></li>
											<li class="divider"></li>
											<li><a href="#" data-index="1">Jumlah Laki-Laki</a></li>
											<li><a href="#" data-index="2">Jumlah Perempuan</a></li>
											<li><a href="#" data-index="3">Jumlah Gender Blum Diketahui</a></li>
											<li class="divider"></li>
											<li class="dropdown-header">Filter</li>
											<li class="dropdown-submenu">
												<a tabindex="-1" href="#"  data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-left"></span>Provinsi Ditampilkan</a>
												<ul class="dropdown-menu  pull-left">
													@foreach($provinsi as $tmp)
													<li><a href="#">{{$tmp->geo_prov_nama}}</a></li>
													@endforeach
												</ul>
											</li>
										</ul>
									</div>
							<div class="slim-scroll" style="height:370px !important;width:100% !important">	
								<div class="ahm-chart-container" id="ahm-chart-container">
				  					<canvas id="myChart"   width="100" height="30" ></canvas>
								</div>
			  					
		  					</div>
			  			</div>
			  			<div class="box-body table-responsive no-padding">
						<table class="table table-hover " id="ahm-table">
						  <thead>
							
							  @yield('content_table_header')
						
						  </thead>
						  <tbody>
						 	@yield('content_table_body')
						  </tbody>
						</table>
						<?php echo str_replace("/?", "?", $data->render()); ?>
						</div>
				   </div>
				  </div>
			</div>
		  </div>
		</div>
	</section>
</div>

<script src="{{asset('asset/plugins/mcustomscroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('asset/css/mcustomscroll/jquery.mCustomScrollbar.min.css')}}">
<script src="{{asset('asset/plugins/scrollbar/jquery.scrollbar.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('asset/css/scrollbar/jquery.scrollbar.css')}}">
<style type="text/css">
#myChart{
		width:100;
		height:30;
}
@media screen and(max-width:800px){
	#myChart{
		width:10;
		height:60;
	}

	
}
.ahm-chart-container{
		width:1400px;
		height:320px;
}

</style>
<script type="text/javascript">
var ind=(function (){
	var glob={
		prov:{{ $selected[0]?:'-1' }},kab:{{ $selected[1]?:'-1' }},kec:{{ $selected[2]?:'-1' }},kel:{{ $selected[3]?:'-1' }},rw:{{ $selected[4]?:'-1' }}
	}
	glob.set= function(obj){
		glob=obj
	}
	glob.getUrl= function(){
		return glob.prov+"/"+glob.kab+"/"+glob.kec+"/"+glob.kel+"/"+glob.rw;
	}
	return glob;
})()
function actionEdit(targetId,bioNama,bioId,jabNm,jabId,obj) {
	//$('#btnEditData').click();
	//<div id="btnEditData" data-target="#modal-input-struk" data-toggle="modal" class="btn-block fa fa-edit hide"></i>
	$('#modal-input-struk').modal('show');
	jQuery('#form-input-struk').attr('action',"{{url("input")}}/@yield('content_action_edit')"+targetId);
	searchBio.init(bioNama,bioId);
	searchStruk.init(jabNm,jabId);
	console.log(bioId)
	jQuery('#submiter').text('Edit');
	jQuery('#my-modal-label').text('Edit @yield('modal_struk_tipe')');
	@yield('content_action_edit_func')
}
function actionTambah(){
	jQuery('#form-input-struk').attr('action',"{{url("input")}}/@yield('content_action_tambah')");
	jQuery('#submiter').text('@yield('name-button','Tambah')');
	jQuery('#my-modal-label').text(' @yield('name-button','Tambah') @yield('modal_struk_tipe')');
}
/*requirejs.config({
    paths: {
        scrollbar: '{{asset('asset')}}/plugins/scrollbar/jquery.scrollbar.min',

     },
    baseUrl: "{{asset('asset')}}",
 });
/require(['scrollbar'], function (scrollbar) {
  //$('.slim-scroll').scrollbar();
}); */
 (function($){
        $(window).on("load",function(){
			$(".slim-scroll").mCustomScrollbar({
					axis:"x",
					scrollButtons:{enable:true},
					theme:"dark-3",
					scrollbarPosition:"outside",

				});
            
        });
            
  }
 )(jQuery);
$(function(){	
	$('body').on("click", ".dropdown-menu", function (e) {
	    $(this).parent().is(".open") && e.stopPropagation();
	});

	$('#prov').change(function(){
		var provId = $(this).val();
		@yield('goto_prov')
		if('{{ $type }}' == 'dprri' || '{{ $type }}' == 'dprdi' || '{{ $type }}' == 'dprdii'){
			changeKabupatenOptionKPU(null,'#kab',provId);
		} else {			
			changeKabupatenOptionKPU(null,'#kab',provId);
		}
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
		changeRTOptionKPU('#rw',provId,kabId,kecId,kelId,rwId);
	});

	$('#prov2').change(function(){
		var provId = $(this).val();	
		changeKabupatenOptionKPU(null,'#kab2',provId);
		changeDapilOptionKPU(provId,'#dapil','2',provId,'');
		ind.set({prov:provId,kab:null,kec:null,kel:null,rw:null});
		searchStruk.setAjax("{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl());
		searchStruk.init('',null);
	});

	$('#kab2').change(function(){
		var provId = $('#prov2').val();
		var kabId = $(this).val();
		changeKecamatanOptionKPU(null,'#kec2',provId,kabId);
		changeDapilOptionKPU(provId,'#dapil','3',provId,kabId);
		ind.set({prov:provId,kab:kabId,kec:null,kel:null,rw:null});
		searchStruk.setAjax("{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl());
		searchStruk.init('',null);
	});
	$('#kec2').change(function(){
		var provId = $('#prov2').val();
		var kabId = $('#kab2').val();
		var kecId = $(this).val();
		changeKelurahanOptionKPU(null,'#kel2',provId,kabId,kecId);
		ind.set({prov:provId,kab:kabId,kec:kecId,kel:null,rw:null});
		searchStruk.setAjax("{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl());
		searchStruk.init('',null);
	});
	$('#kel2').change(function(){
		var provId = $('#prov2').val();
		var kabId = $('#kab2').val();
		var kecId = $('#kec2').val();
		var kelId = $(this).val();
		changeRWOptionKPU(null,'#rw2',provId,kabId,kecId,kelId);
		ind.set({prov:provId,kab:kabId,kec:kecId,kel:kelId,rw:null});
		searchStruk.setAjax("{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl());
		searchStruk.init('',null);
	});
	$('#rw2').change(function(){
		var provId = $('#prov2').val();
		var kabId = $('#kab2').val();
		var kecId = $('#kec2').val();
		var kelId = $('#kel2').val();
		var rwId = $('#rw2').val();
		ind.set({prov:provId,kab:kabId,kec:kecId,kel:kelId,rw:rwId});	
		searchStruk.setAjax("{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl());
		searchStruk.init('',null);
		changeRTOptionKPU('#rw',provId,kabId,kecId,kelId,rwId);
	});
});
function detailUser(idUser){
	window.location.href='{{ url().'/user_management/list/detail' }}/'+idUser;
}
function printExcel(type, prov, kab, kec, deskel, rw){
	window.open('{{ asset("pusdatin_v3/print/excel") }}'+'/'+type+'/'+prov+'/'+kab+'/'+kec+'/'+deskel+'/'+rw+'?type='+type+'&prov='+prov+'&kab='+kab+'&kec='+kec+'&deskel='+deskel+'&rw='+rw, '_blank');
}
function printPdf(type, prov, kab, kec, deskel, rw){
	window.open('{{ asset("pusdatin_v3/print/pdf") }}'+'/'+type+'/'+prov+'/'+kab+'/'+kec+'/'+deskel+'/'+rw+'?type='+type+'&prov='+prov+'&kab='+kab+'&kec='+kec+'&deskel='+deskel+'&rw='+rw, '_blank');
}
</script>