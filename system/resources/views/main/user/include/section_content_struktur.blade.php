
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
		  <div class="col-md-6">
		  </div>
		  <div class="panel">
			  <div class="box-header with-border">
				  <div class="row">
					<div class="col-md-2 col-sm-3 col-xs-6">
						@yield('struk_tipe_box_header')
					</div>
					<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
						<div class="btn-block  btn-danger btn" data-toggle="modal" data-target="#modal-input-struk" onclick="actionTambah()"><i class="fa fa-plus"></i> Tambah</div>
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

			  			<div class="box-body table-responsive no-padding">
						<table class="table table-hover " id="ahm-table">
						  <thead>
							
							  @yield('content_table_header')
						
						  </thead>
						  <tbody>
						 	@yield('content_table_body')
						  </tbody>
						</table>
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
		prov:{{$selected[0] or -1}},kab:{{$selected[1] or -1}},kec:{{$selected[2] or -1}},kel:{{$selected[3] or -1}},rw:{{$selected[4] or -1}}
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
	jQuery('#form-input-struk').attr('action',"{{url("user_management/user")}}/"+targetId);
	searchBio.init(bioNama,bioId);
	searchStruk.init(jabNm,jabId);
	console.log(bioId)
	jQuery('#submiter').text('Edit');
	jQuery('#my-modal-label').text('Edit @yield('modal_struk_tipe')');
	@yield('content_action_edit_func')
}
function actionTambah(){
	jQuery('#form-input-struk').attr('action',"{{url("user_management/user")}}");
	jQuery('#submiter').text('Tambah');
	jQuery('#my-modal-label').text('Tambah @yield('modal_struk_tipe')');
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
		changeKabupatenOption(null,'#kab',provId);

	});

	$('#kab').change(function(){
		var provId = $('#prov').val();
		var kabId = $(this).val();
		@yield('goto_kab')
		changeKecamatanOption(null,'#kec',provId,kabId);

	});
	$('#kec').change(function(){
		var provId = $('#prov').val();
		var kabId = $('#kab').val();
		var kecId = $(this).val();
		@yield('goto_kec')
		changeKelurahanOption(null,'#kel',provId,kabId,kecId);

	});
	$('#kel').change(function(){
		var provId = $('#prov').val();
		var kabId = $('#kab').val();
		var kecId = $('#kec').val();
		var kelId = $(this).val();
		@yield('goto_kel')
		changeRWOption(null,'#rw',provId,kabId,kecId,kelId);

	});
	$('#rw').change(function(){
		var provId = $('#prov').val();
		var kabId = $('#kab').val();
		var kecId = $('#kec').val();
		var kelId = $('#kel').val();
		var rwId = $('#rw').val();
		@yield('goto_rw')

		//changeRWOption('#rw',provId,kabId,kecId,kelId,rwId);
	});

	$('#prov2').change(function(){
		var provId = $(this).val();	
		changeKabupatenOption(null,'#kab2',provId);
		ind.set({prov:provId,kab:null,kec:null,kel:null,rw:null});
		searchStruk.setAjax("{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl());
		searchStruk.init('',null);
	});

	$('#kab2').change(function(){
		var provId = $('#prov2').val();
		var kabId = $(this).val();
		changeKecamatanOption(null,'#kec2',provId,kabId);
		ind.set({prov:provId,kab:kabId,kec:null,kel:null,rw:null});
		searchStruk.setAjax("{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl());
		searchStruk.init('',null);
	});
	$('#kec2').change(function(){
		var provId = $('#prov2').val();
		var kabId = $('#kab2').val();
		var kecId = $(this).val();
		changeKelurahanOption(null,'#kel2',provId,kabId,kecId);
		ind.set({prov:provId,kab:kabId,kec:kecId,kel:null,rw:null});
		searchStruk.setAjax("{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl());
		searchStruk.init('',null);
	});
	$('#kel2').change(function(){
		var provId = $('#prov2').val();
		var kabId = $('#kab2').val();
		var kecId = $('#kec2').val();
		var kelId = $(this).val();
		changeRWOption(null,'#rw2',provId,kabId,kecId,kelId);
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
		//changeRWOption('#rw',provId,kabId,kecId,kelId,rwId);
	});
});
function detailUser(idUser){
	window.location.href='{{ url().'/user_management/list/detail' }}/'+idUser;
}
</script>