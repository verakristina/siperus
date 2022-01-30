
<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
	  <h1>
		@yield('tipe_menu')
		<small>@yield('tipe_sub_menu')</small>
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
						<table class="table table-striped table-hover">
						  <thead id="test-header">
							
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
	</section>
</div>

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
	function actionEdit(obj) {
		
		@yield('content_action_edit_func')
	}
	function actionTambah(obj){
		@yield('content_action_add_func')
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
			changeRTOptionKPU('#rw',provId,kabId,kecId,kelId,rwId);
		});
			
		$('#prov2').change(function(){
			var provId = $(this).val();	
			changeKabupatenOptionKPU(null,'#kab2',provId);
			changeDapilOptionKPU(provId,'#dapil','2',provId,'');
			ind.set({prov:provId,kab:null,kec:null,kel:null,rw:null});
			@yield('goto_prov2')
		});

		$('#kab2').change(function(){
			var provId = $('#prov2').val();
			var kabId = $(this).val();
			changeKecamatanOptionKPU(null,'#kec2',provId,kabId);
			changeDapilOptionKPU(provId,'#dapil','3',provId,kabId);
			ind.set({prov:provId,kab:kabId,kec:null,kel:null,rw:null});
			ind.set({prov:provId,kab:kabId,kec:null,kel:null,rw:null});
			@yield('goto_kab2')
	
		});
		$('#kec2').change(function(){
			var provId = $('#prov2').val();
			var kabId = $('#kab2').val();
			var kecId = $(this).val();
			changeKelurahanOptionKPU(null,'#kel2',provId,kabId,kecId);
			ind.set({prov:provId,kab:kabId,kec:kecId,kel:null,rw:null});
			ind.set({prov:provId,kab:kabId,kec:kecId,kel:null,rw:null});
			@yield('goto_kec2')
		
		});
		$('#kel2').change(function(){
			var provId = $('#prov2').val();
			var kabId = $('#kab2').val();
			var kecId = $('#kec2').val();
			var kelId = $(this).val();
			changeRWOptionKPU(null,'#rw2',provId,kabId,kecId,kelId);
			ind.set({prov:provId,kab:kabId,kec:kecId,kel:kelId,rw:null});
			@yield('goto_kel2')
			
		});
		$('#rw2').change(function(){
			var provId = $('#prov2').val();
			var kabId = $('#kab2').val();
			var kecId = $('#kec2').val();
			var kelId = $('#kel2').val();
			var rwId = $('#rw2').val();
			changeRTOptionKPU('#rw',provId,kabId,kecId,kelId,rwId);
			ind.set({prov:provId,kab:kabId,kec:kecId,kel:kelId,rw:rwId});	
			@yield('goto_rw2')
		});
		
		$("#jumlah-penduduk").on('keyup', function(){
			changeFormatNumber(this);
		});
	});
	function changeFormatNumber(div){
		var n = parseInt($(div).val().replace(/\D/g,''),10);
		$(div).val(n.toLocaleString('id'));
	}
</script>