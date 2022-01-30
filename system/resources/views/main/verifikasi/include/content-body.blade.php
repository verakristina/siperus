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
	@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
			{{--*/ $statusProvinsi = '2' /*--}}
			{{--*/ $Provinsi = session('idProvinsi2') /*--}}
	@else
			{{--*/ $statusProvinsi = '' /*--}}
			{{--*/ $Provinsi = '1' /*--}}
	@endif	
	<section class="content">
		<div class="page-ajax">
			<div class="row" style="margin-bottom:15px;">
				<div class="col-md-12">
					@yield('content-filter')
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="box-header with-border">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-6">
									<h4>Legend</h4>
								</div>
							</div>
						</div>				
						<div class="box-body">
							<div class="row">
								<div class="col-md-3"><td>1. </td><td>Status Kantor</td></div>
								<div class="col-md-3"><td>2. </td><td>Alamat</td></div>
								<div class="col-md-3"><td>3. </td><td>Ibukota</td></div>
								<div class="col-md-3"><td>4. </td><td>Keaktifan Pengurus</td></div>
								<div class="col-md-3"><td>5. </td><td>30% Perempuan</td></div>
								<div class="col-md-3"><td>6. </td><td>Jumlah KTA</td></div>
								<div class="col-md-3"><td>7. </td><td>Ruang Kerja (K)</td></div>
								<div class="col-md-3"><td>8. </td><td>Ruang Kerja (S)</td></div>
								<div class="col-md-3"><td>9. </td><td>Ruang Kerja (B)</td></div>
								<div class="col-md-3"><td>10. </td><td>Staf Admin</td></div>
								<div class="col-md-3"><td>11. </td><td>Papan Nama</td></div>
								<div class="col-md-3"><td>12. </td><td>Pres & Wapres</td></div>
								<div class="col-md-3"><td>13. </td><td>Garuda</td></div>
								<div class="col-md-3"><td>14. </td><td>Ketum & Sekjen</td></div>
								<div class="col-md-3"><td>15. </td><td>Nomer Rekning</td></div>
							</div>
							<!--<table>
								<tbody>
									<tr><td>1. </td><td>Status Kantor</td></tr>
									<tr><td>2. </td><td>Alamat</td></tr>
									<tr><td>3. </td><td>Ibukota</td></tr>
									<tr><td>4. </td><td>Keaktifan Pengurus</td></tr>
									<tr><td>5. </td><td>30% Perempuan</td></tr>
									<tr><td>6. </td><td>Jumlah KTA</td></tr>
									<tr><td>7. </td><td>Ruang Kerja</td></tr>
									<tr><td>8. </td><td>Staf Admin</td></tr>
									<tr><td>9. </td><td>Papan Nama</td></tr>
									<tr><td>10	. </td><td>Pres & Wapres</td></tr>
									<tr><td>11	. </td><td>Garuda</td></tr>
									<tr><td>12	. </td><td>Ketum & Sekjen</td></tr>
									<tr><td>13	. </td><td>Nomer Rekning</td></tr>
								</tbody>
							</table>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		
		@if(session('idRole') == 1 || session('idRole') == 3 || session('idRole') == 11)
			<div class="row @yield('box-dpd')">
				<div class="col-md-12">
					<div class="panel">
						<div class="box-header with-border">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-6">
									<h4>@yield('box-header-dpd')</h4>
								</div>
								@if(session('statActHide') != 1)
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right hide ">
									<div class="@yield('add-button','hide') btn-block  btn-danger btn" data-toggle="modal" data-target="#modal-input-struk" onclick="actionTambah()"><i class="fa fa-plus"></i> Tambah</div>
								</div>
								<div class="@yield('download-button','show') col-md-2 col-sm-3 col-xs-6 pull-right">
									<div class="btn-danger btn-block btn" onclick="actionDownload('excel','verifikasi','DPD{{ (session('idRole') == 3)?$statusProvinsi:'' }}','{{ (session('idRole') == 3)?$Provinsi:'' }}')"><i class="fa fa-print"></i> Excel</div>
								</div>
								<div class="@yield('download-button','show') col-md-2 col-sm-3 col-xs-6 pull-right">
									<div class="btn-danger btn-block btn" onclick="actionDownload('pdf','verifikasi','DPD{{ (session('idRole') == 3)?$statusProvinsi:'' }}','{{ (session('idRole') == 3)?$Provinsi:'' }}')"><i class="fa fa-print"></i> PDF</div>
								</div>
								@endif
							</div>
						</div>				
						<div class="box-body table-responsive">
							<table class="table table-hover table-striped {{ (session('idRole') == 3)?'no-paging':'' }}" id="table">
								<thead>
									@yield('table-header-dpd')
								</thead>
								<tbody>
									@yield('table-body-dpd')
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		@endif
			<div class="row @yield('box-dpc')">
				<div class="col-md-12">
					<div class="panel">
						<div class="box-header with-border">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-6">
									<h4>@yield('box-header-dpc')</h4>
								</div>
								@if(session('statActHide') != 1)
								<div class="col-md-2 col-sm-3 col-xs-6 pull-right hide">
									<div class="@yield('add-button','hide') btn-block  btn-danger btn" data-toggle="modal" data-target="#modal-input-struk" onclick="actionTambah()"><i class="fa fa-plus"></i> Tambah</div>
								</div>
								<div class="@yield('download-button','show') col-md-2 col-sm-3 col-xs-6 pull-right">
									<div class="btn-danger btn-block btn" onclick="actionDownload('excel','verifikasi','DPC{{ (session('idRole') == 3)?$statusProvinsi:'' }}','{{ (session('idRole') == 3)?$Provinsi:'' }}')"><i class="fa fa-print"></i> Excel</div>
								</div>
								<div class="@yield('download-button','show') col-md-2 col-sm-3 col-xs-6 pull-right">
									<div class="btn-danger btn-block btn" onclick="actionDownload('pdf','verifikasi','DPC{{ (session('idRole') == 3)?$statusProvinsi:'' }}','{{ (session('idRole') == 3)?$Provinsi:'' }}')"><i class="fa fa-print"></i> PDF</div>
								</div>
								@endif
							</div>
						</div>				
						<div class="box-body table-responsive">
							<table class="table table-hover table-striped {{ (session('idRole') == 4)?'no-paging':'' }}" id="table">
								<thead>
									@yield('table-header-dpc')
								</thead>
								<tbody>
									@yield('table-body-dpc')
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
function verifikasiDownload(jenis,prov){
		window.location = '{{ asset("download/verifikasi") }}?jenis='+jenis+'&prov='+prov;
		// window.location = '{{ url() }}/system/resources/views/main/download/verifikasi.php?jenis='+jenis+'&prov='+prov;
	}
function actionEdit(targetId,bioId,obj) {
	$('#modal-input-struk').modal('show');
	jQuery('#form-input-struk').attr('action',"{{url()}}/@yield('action-edit')"+targetId);
	jQuery('#submiter').text('Edit');
	jQuery('#my-modal-label').text('Edit @yield('modal_struk_tipe')');
	@yield('content_action_edit_func')
}
function actionTambah(){
	jQuery('#form-input-struk').attr('action',"{{url()}}/@yield('action-tambah')");
	jQuery('#submiter').text('Tambah');
	jQuery('#my-modal-label').text('Tambah @yield('modal_struk_tipe')');
}
function detailVerif(id){
	window.location.href='{{ url().'/verifikasi/detail' }}/'+id;
}
$(function(){	
	$('#prov').change(function(){
		var provId = $(this).val();
		@yield('goto_prov')
		changeKabupatenOptionKPU(null,'#kab',provId);

	});
});
</script>