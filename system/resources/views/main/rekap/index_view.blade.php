@extends('main.layout.layout')
@section('content')
	@section('title-page','Rekap Scan '.strtoupper($tingkat))
	@section('modal_struk_tipe',strtoupper($tingkat))
	@section('struk_tipe_menu', '&nbsp;')
	@section('struk_tipe_sub_menu', 'Rekapitulasi Scan '.strtoupper($tingkat))
	@section('struk_tipe_box_header','Hasil Rekapitulasi Tingkat '.strtoupper($tingkat))

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
		<div class="content">
			<div class="panel">
				<div class="box-header with-border">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-6">
							@yield('struk_tipe_box_header')
						</div>
						<div class="col-md-6"></div>
						<div class="col-md-2">
							<button class="btn btn-warning btn-block" type="button" data-toggle="modal" data-target="#modal-rekap"><i class="fa fa-plus"></i> Tambah</button>
						</div>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<form action="#" method="get">
							<div class="col-md-2 col-sm-4 col-xs-6 {{ (session('idRole') == 3)?$statusProvinsi:'' }}" style="display:{{ $selected[1] }}">
									<select class="form-control custom-field-litle" id="prov2" name="prov" >
										<option value="" selected >--- Provinsi ---</option>
											@foreach($provinsi as $tmp)
												<option value="{{$tmp->geo_prov_id}}" @if($tmp->geo_prov_id==$selected[0]) selected @endif>{{$tmp->geo_prov_nama}}</option>
											@endforeach
									</select>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-6" style="display:{{ $selected[2] }}">
								<select class="form-control custom-field-litle ar-kab" id="kab2" name="kab" >
									<option value=""  selected >--- Kabupaten ---</option>
								</select>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-6">
								<button class="btn btn-primary"> Filter</button>
							</div>
						</form>
						<div class="col-md-12">
							<table class="table table-bordered table-striped table-hover no-dt" style="margin-top:10px">
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">DPD</th>
										<th class="text-center" style="display:{{ $selected[1] }}">DPC</th>
										<th class="text-center" style="display:{{ $selected[2] }}">PAC</th>
										<th class="text-center">DSKK</th>
										<th class="text-center">DDIK</th>
										<th class="text-center">DCVP</th>
										<th class="text-center">DSKS</th>
										<th class="text-center">DDKS</th>
										<th class="text-center">Tanggal Input</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									@foreach($dataRekap->get() as $get)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $get->geo_prov_nama }}</td>
										<td style="display:{{ $selected[1] }}">{{ $get->geo_kab_nama }}</td>
										<td style="display:{{ $selected[2] }}">{{ $get->geo_kec_nama }}</td>
										<td class="text-center">
											@if($get->sk == 1)
											<center>
												<i class="fa fa-check f-check" style="color: #1EA528"></i>
											</center>
											@endif
										</td>
										<td class="text-center">
											<?php
											$other = 0;
											$getDDIK = DB::table('tb_ddik')
														->where('id_rekap', $get->IDR)
														->where('jabatan', '!=', 'other')
														->get();
											foreach($getDDIK as $gDDIK){
												if($gDDIK->jabatan == "ketua" && $gDDIK->ktp == 1 && $gDDIK->kta == 1){
													$other++;
												}elseif($gDDIK->jabatan == "sekretaris" && $gDDIK->ktp == 1 && $gDDIK->kta == 1){
													$other++;
												}elseif($gDDIK->jabatan == "bendahara" && $gDDIK->ktp == 1 && $gDDIK->kta == 1){
													$other++;
												}else{

												}
												//echo $other.",";
											}
											$id_rek = $get->IDR;
											$getDDIKOther = DB::table('tb_ddik')
														->where('id_rekap', $id_rek)
														->where('jabatan', 'other')
														->get();
											foreach($getDDIKOther as $ot){
												//echo " KTP : ".$ot->ktp.",";
												$other = $other+$ot->ktp;
											}
											echo $other;
											?>
										</td>
										<td class="text-center">
											<?php
											$other = 0;
											$getDCVP = DB::table('tb_dcvp')
														->where('id_rekap', $get->IDR)
														->where('jenis', '!=', 'other')
														->get();
											foreach($getDCVP as $gDCVP){
												if($gDCVP->jenis == "ketua"){
													$other++;
												}elseif($gDCVP->jenis == "sekretaris"){
													$other++;
												}elseif($gDCVP->jenis == "bendahara"){
													$other++;
												}else{

												}
											}
											$id_rek = $get->IDR;
											$getDCVPOther = DB::table('tb_dcvp')
														->where('id_rekap', $id_rek)
														->where('jenis', 'other')
														->get();
											foreach($getDCVPOther as $ot){
												$other = $other+$ot->drh;
											}
											echo $other;
											?>
										</td>
										<td class="text-center">
											<?php
											$c_dsks = 0;
											if($get->f_presiden == 1){
												$c_dsks++;
											}
											if($get->f_garuda == 1){
												$c_dsks++;
											}
											if($get->f_bendera == 1){
												$c_dsks++;
											}
											if($get->f_ketum == 1){
												$c_dsks++;
											}
											if($get->f_papan == 1){
												$c_dsks++;
											}
											if($get->f_kantor == 1){
												$c_dsks++;
											}
											if($get->f_sewa == 1){
												$c_dsks++;
											}
											if($get->f_bank == 1){
												$c_dsks++;
											}
											if($get->f_kesbangpol == 1){
												$c_dsks++;
											}
											if($get->f_keterangan == 1){
												$c_dsks++;
											}
											echo $c_dsks." / 10";
											?>
										</td>
										<td>
											@if($get->domisili != 0)
											<center>
												<i class="fa fa-check f-check" style="color: #1EA528"></i>
											</center>
											@endif
										</td>
										<td>
											<?php
											$cdate = date_create($get->created_date);
											$cform = date_format($cdate, 'd M Y H:i');
											echo $cform;
											?>
										</td>
										<td class="text-right">
											<button class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Detail" onclick="viewDetail({{ $get->IDR }})">
												<i class="fa fa-search"></i>
											</button>

											<button class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Edit" onclick="editDataRekap({{ $get->IDR }})">
												<i class="fa fa-edit"></i>
											</button>

											<a href="{{ asset('rekap/scan/').'/'.$tingkat.'/delete/'.$get->IDR }}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete">
												<i class="fa fa-trash"></i>
											</a>

											<a href="http://partaihanura.net/downloads/VERIFIKASI/{{$get->link_folder_verifikasi}}" target="_Blank" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Open Folder">
												<i class="fa fa-arrow-right"></i>
											</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-rekap">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button class="close" data-dismiss="modal">&times;</button>
					<label class="modal-title">Input Rekapitulasi Hasil Scan</label>
				</div>
				<div class="modal-body">
					<form action="{{ asset('rekap/scan/').'/'.$tingkat.'/action'}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<label>{{ "Nama ".strtoupper($tingkat) }}</label>
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-6 {{ (session('idRole') == 3)?$statusProvinsi:'' }}" style="display:initial;">
								<select class="form-control custom-field-litle" id="prov3" name="prov" required="">
									<option value="" selected >--- Provinsi ---</option>

										@foreach($provinsi as $tmp)
											<option value="{{$tmp->geo_prov_id}}" @if($tmp->geo_prov_id==$selected[0]) selected @endif>{{$tmp->geo_prov_nama}}</option>
										@endforeach

								</select>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-6" style="display:{{ $selected[1] }}">
							<select class="form-control custom-field-litle ar-kab" id="kab3" name="kab">
								<option value=""  selected >--- Kabupaten ---</option>
							</select>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-6" style="display:{{ $selected[2] }}">
							<select class="form-control custom-field-litle" id="kec3" name="kec" >
								<option value="" selected >--- Kecamatan ---</option>
							</select>
						</div>
						<div class="col-md-3 col-sm-4 col-xs-6" style="display:{{ $selected[3] }}">
							<select class="form-control custom-field-litle" id="kel3" name="kel" >
								<option value="" selected >--- Desa / Kelurahan ---</option>
							</select>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
							    <label>Link Folder Hasil Scan</label>
							    <div class="input-group">
							      <div class="input-group-addon">http://partaihanura.net/downloads/VERIFIKASI/</div>
							      <input type="text" class="form-control" name="link" placeholder="Link ke folder">
							    </div>
							  </div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12" style="border-right: 1px solid #EFEFEF">
							<label>1. DSKK (Dokumen SK Kepengurusan)</label>
							<table class="table table-bordered">
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dskk_sk" value="1"> SK
											</label>
										</div>
									</td>
								</tr>
							</table>
							<hr>
							<label>2. DDIK (Dokumen Inventaris Kepengurusan)</label>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="text-center">*</th>
										<th class="text-center">KTP</th>
										<th class="text-center">KTA</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="ddik_jabatan[]" value="ketua"> Ketua
												</label>
											</div>
										</td>
										<td class="text-center">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="ddik_ktp_ketua" value="1">
												</label>
											</div>
										</td>
										<td class="text-center">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="ddik_kta_ketua" value="1">
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="ddik_jabatan[]" value="sekretaris"> sekretaris
												</label>
											</div>
										</td>
										<td class="text-center">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="ddik_ktp_sekretaris" value="1">
												</label>
											</div>
										</td>
										<td class="text-center">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="ddik_kta_sekretaris" value="1">
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="ddik_jabatan[]" value="bendahara"> Bendahara
												</label>
											</div>
										</td>
										<td class="text-center">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="ddik_ktp_bendahara" value="1">
												</label>
											</div>
										</td>
										<td class="text-center">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="ddik_kta_bendahara" value="1">
												</label>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table table-bordered">
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ddik_o_ktp_n" value="1"> Jumlah KTP Lainnya
											</label>
										</div>
									</td>
									<td>
										<input type="number" min="0" step="1" class="form-control" name="ddik_o_ktp">
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ddik_o_kta_n" value="1"> Jumlah KTA Lainnya
											</label>
										</div>
									</td>
									<td>
										<input type="number" min="0" step="1" class="form-control" name="ddik_o_kta">
									</td>
								</tr>
							</table>
							<hr>
							<label>3. DCVP</label>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td colspan="2">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="dcvp_jabatan[]" value="ketua"> DRH Ketua
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="dcvp_jabatan[]" value="sekretaris"> DRH Sekretaris
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="dcvp_jabatan[]" value="bendahara"> DRH Bendahara
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="dcvp_o_jabatan" value="other"> Jumlah DRH lainnya
												</label>
											</div>
										</td>
										<td>
											<input type="number" class="form-control" min="0" step="1" name="dcvp_o_drh">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12">
							<label>4. DSKS (Status Kantor)</label>
							<table class="table table-bordered">
								<tr>
									<td>
										<label>BERKAS FOTO</label>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dsks_presiden" value="1"> Foto Presiden & Wakil Presiden
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dsks_garuda" value="1"> Foto Garuda Pancasila
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dsks_bendera" value="1"> Foto Bendera & Pataka
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dsks_ketum" value="1"> Foto Ketum & Sekjen
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dsks_papan_nama" value="1"> Foto Papan Nama
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dsks_kantor" value="1"> Layout Kantor
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label>BERKAS DOKUMEN</label>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dsks_sewa" value="1"> Surat Perjanjian Sewa Menyewa
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dsks_bank" value="1"> Bank
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dsks_kesbangpol" value="1"> Kesbangpol
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="dsks_keterangan" value="1"> Surat keterangan dan surat pernyataan
											</label>
										</div>
									</td>
								</tr>
							</table>
							<hr>
							<label>5. DDKS (Domisili)</label>
							<table class="table table-bordered">
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ddks_domisili" value="1"> Domisili
											</label>
										</div>
									</td>
								</tr>
							</table>
							<hr>
							<label>Keterangan / Catatan</label>
							<textarea name="catatan" class="form-control" style="min-width: 100%; max-width: 100%; min-height:120px; max-height: 120px;"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="pull-right">
								<br>
								<button class="btn btn-primary">SUBMIT</button>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-edit">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<label class="modal-header">Edit Data Rekap</label>
				</div>
				<div class="modal-body" id="area-result-edit">

				</div>
			</div>
		</div>
	</div>
@stop
@section('function')
<script>
	$("#prov2").on('change', function(){
		var val = $("#prov2").val();
		changeKabupatenOptionKPU("#prov2", "#kab2", val)
	})
	$("#kab2").on('change', function(){
		var val = $("#kab2").val();
		changeKecamatanOptionKPU("#kab2", "#kec2", $("#prov2").val(), val)
	})

	$("#prov3").on('change', function(){
		var val = $("#prov3").val();
		changeKabupatenOptionKPU("#prov3", "#kab3", val)
	})
	$("#kab3").on('change', function(){
		var val = $("#kab3").val();
		changeKecamatanOptionKPU("#kab3", "#kec3", $("#prov3").val(), val)
	})

	function editDataRekap(id_rekap){
		$.ajax({
			type : "GET",
			url : "{{ asset('rekap/scan/').'/'.$tingkat.'/edit/' }}"+id_rekap,
			success:function(resp){
				$("#modal-edit").modal('show');
				$("#area-result-edit").html(resp);
				$('input').attr('disabled', false);
				$('textarea').attr('disabled', false);
			},
			error:function(e){
				alert("Something wrong, please check server log!");
				console.log(e);
			}
		})
	}
	function viewDetail(id_rekap){
		$.ajax({
			type : "GET",
			url : "{{ asset('rekap/scan/').'/'.$tingkat.'/edit/' }}"+id_rekap,
			success:function(resp){
				$("#modal-edit").modal('show');
				$("#area-result-edit").html(resp);
				$('input').attr('disabled', true);
				$('textarea').attr('disabled', true);
				$('#btn-submit').hide();
			},
			error:function(e){
				alert("Something wrong, please check server log!");
				console.log(e);
			}
		})
	}
	$("#modal-edit").on('hidden.bs.modal', function(){
		$('input').attr('disabled', false);
		$('textarea').attr('disabled', false);
	});
</script>
@stop
