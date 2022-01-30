<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
	  <h1>
		@yield('menu')
		<small>@yield('sub_menu')</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		@foreach(@$breadcrumb as $val)
			<li>{{$val}}</li>
		@endforeach
	  </ol>
	</section>

	<section class="content">
		<div class="page-ajax">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
					   <div class="response-cari">
						  <!-- /.box-tools -->
						  <?php $no=1; ?>
						  <div class="box-header with-border">
							  <div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h4>@yield('box-header')</h4>
								</div>
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right">
									<div class="@yield('add-button','show') btn-block  btn-danger btn" data-toggle="modal" data-target="#modalStruktur" onclick="actionTambah()"><i class="fa fa-plus"></i> @yield('name-button','Tambah')</div>
								</div>
							  </div>
						  </div>
						  <div class="panel-body">	
							<div class="row" id="canvasFilter">
								@yield('filter')
							</div>
							<table class="table table-striped table-hover">
							  <thead>
								@yield('table_head')
							  </thead>
							  <tbody>
								@yield('table_body')
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
@include('main.master.struktur.include.modal')
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>
function actionEdit(prov_id,kab_id,kec_id,kel_id,rw_id,rt_id,struk_id,struk_nama) {
	jQuery('#formModalStrukturEdit').attr('action',"{{url()}}/@yield('action-edit')");
	jQuery('#btnSubmit').text('Edit');
	jQuery('#myModalLabel').text('Edit @yield('modal_struk_tipe')');
	@yield('edit-function')
}
function actionTambah(){
	jQuery('#formModalStruktur').attr('action',"{{url()}}/@yield('action-tambah')");
	jQuery('#btnSubmit').text('@yield('name-button','Tambah')');
	jQuery('#myModalLabel').text(' @yield('name-button','Tambah') @yield('modal_struk_tipe')');
}

$('#prov').change(function(){
	var provId = $(this).val();
	@yield('goto_prov')
	changeKabupatenOptionKPU(this,'#kab',provId);
});
$('#id_prov').change(function(){
	var provId = $(this).val();
	changeKabupatenOptionKPU(this,'#id_kab',provId);
});
$('#kab').change(function(){
	var provId = $('#prov').val();
	var kabId = $(this).val();
	@yield('goto_kab')
	changeKecamatanOptionKPU(this,'#kec',provId,kabId);
});
$('#id_kab').change(function(){
	var provId = $('#prov').val();
	var kabId = $(this).val();
	changeKecamatanOptionKPU(this,'#id_kec',provId,kabId);
});
$('#kec').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $(this).val();
	@yield('goto_kec')
	changeKelurahanOptionKPU(this,'#kel',provId,kabId,kecId);
});
$('#id_kec').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $(this).val();
	changeKelurahanOptionKPU(this,'#id_kel',provId,kabId,kecId);
});
$('#kel').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $('#kec').val();
	var kelId = $(this).val();
	@yield('goto_kel')
	changeRWOptionKPU(this,'#rw',provId,kabId,kecId,kelId);
});
$('#id_kel').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $('#kec').val();
	var kelId = $(this).val();
	changeRWOptionKPU(this,'#id_rw',provId,kabId,kecId,kelId);
});
$('#rw').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $('#kec').val();
	var kelId = $('#kel').val();
	var rwId = $('#rw').val();
	@yield('goto_rw')
	changeRTOptionKPU(this,'#rt',provId,kabId,kecId,kelId,rwId);
});
$('#id_rw').change(function(){
	var provId = $('#id_prov').val();
	var kabId = $('#id_kab').val();
	var kecId = $('#id_kec').val();
	var kelId = $('#id_kel').val();
	var rwId = $('#id_rw').val();
	changeRTOptionKPU(this,'#id_rt',provId,kabId,kecId,kelId,rwId);
});
$('#rt').change(function(){
	var provId = $('#prov').val();
	var kabId = $('#kab').val();
	var kecId = $('#kec').val();
	var kelId = $('#kel').val();
	var rwId = $('#rw').val();
	var rtId = $(this).val();
	@yield('goto_rt')
	location.href="<?php echo url(); ?>/master/struktur/kpa/"+provId+"/"+kabId+"/"+kecId+"/"+kelId+"/"+rwId+"/"+rtId;
});
$(document).ready(function(){
	<?php if($prov != 0) { ?>
		changeKabupatenOptionKPU('#prov','#kab','{{ $prov }}');
	<?php } ?>
	<?php if($kab != 0) { ?>
		changeKecamatanOptionKPU('#kab','#kec','{{ $prov }}','{{ $kab }}');
	<?php } ?>
	<?php if($kec != 0) { ?>
		changeKelurahanOptionKPU('#kec','#kel','{{ $prov }}','{{ $kab }}','{{ $kec }}');
	<?php } ?>
	<?php if($kel != 0) { ?>
		changeRWOptionKPU('#kel','#rw','{{ $prov }}','{{ $kab }}','{{ $kec }}','{{ $kel }}');
	<?php } ?>
	<?php if($rw != 0) { ?>
		changeRTOptionKPU('#rw','#rt','{{ $prov }}','{{ $kab }}','{{ $kec }}','{{ $kel }}','{{ $rw }}');
		$('#prov').val('{{ $prov }}');
		$('#kab').val('{{ $kab }}');
		$('#kec').val('{{ $kec }}');
		$('#kel').val('{{ $kel }}');
		$('#rw').val('{{ $rw }}');
		$('#rt').val('{{ $rt }}');
	<?php } ?>
});
/* function editKPA(prov_id,kab_id,kec_id,kel_id,rw_id,rt_id,struk_id,struk_nama){
	$('#edit_id_prov').val(prov_id);
	$('#edit_id_kab').val(kab_id);
	$('#edit_id_kec').val(kec_id);
	$('#edit_id_kel').val(kel_id);
	$('#edit_id_rw').val(rw_id);
	$('#edit_id_rt').val(rt_id);
	$('#edit_id_kpa').val(struk_id);
	$('#edit_nama_kpa').val(struk_nama);
	$('#editKPA').modal('show');
} */
/* function addKpa(prov_id){
	changeKabupatenOptionKPU(prov_id,'#id_kab',prov_id);
} */
</script>
@endsection