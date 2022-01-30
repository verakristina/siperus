@foreach($dataRekap->get() as $get)
<form action="{{ asset('rekap/scan/').'/'.$tingkat.'/action/edit/'.$id_rekap}}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<label>{{ "Nama ".strtoupper($tingkat) }}</label>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 {{ (session('idRole') == 3)?$statusProvinsi:'' }}" style="display:initial;">
			{{ $get->geo_prov_nama }}<span style="display:{{ $selected[1] }}"> / {{ $get->geo_kab_nama }}</span><span style="display:{{ $selected[2] }}"> / {{ $get->geo_kec_nama }}</span>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
		    <label>Link Folder Hasil Scan</label>
		    <div class="input-group">
		      <div class="input-group-addon">http://partaihanura.net/downloads/VERIFIKASI/</div>
		      <input type="text" class="form-control" name="link" placeholder="Link ke folder" value="{{ $get->link_folder_verifikasi }}">
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
							<input type="checkbox" name="dskk_sk" value="1" {{ ($get->sk == 1)?'checked':''}}> SK
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
			<?php
				$cek_ddik_ketua = false;
				$cek_ddik_sekretaris = false;
				$cek_ddik_bendahara = false;
				$cek_ddik_ketua_ktp = false;
				$cek_ddik_sekretaris_ktp = false;
				$cek_ddik_bendahara_ktp = false;
				$cek_ddik_ketua_kta = false;
				$cek_ddik_sekretaris_kta = false;
				$cek_ddik_bendahara_kta = false;
				$cek_ddik_other = false;
				$count_ddik_other_ktp = 0;
				$count_ddik_other_kta = 0;
				$result = DB::table("tb_ddik")
							 ->where("id_rekap","=",$id_rekap)
							 ->get();
				 foreach($result as $tmp){
					 if($tmp->jabatan == "bendahara"){
						 $cek_ddik_bendahara = true;
						 if($tmp->kta == "1"){
							 $cek_ddik_bendahara_kta = true;
						 }
						 if($tmp->ktp == "1"){
							 $cek_ddik_bendahara_ktp = true;
						 }
					 }
					 if($tmp->jabatan == "ketua"){
						 $cek_ddik_ketua = true;
						 if($tmp->kta == "1"){
							 $cek_ddik_ketua_kta = true;
						 }
						 if($tmp->ktp == "1"){
							 $cek_ddik_ketua_ktp = true;
						 }
					 }
					 if($tmp->jabatan == "sekretaris"){
						 $cek_ddik_sekretaris = true;
						 if($tmp->kta == "1"){
							 $cek_ddik_sekretaris_kta = true;
						 }
						 if($tmp->ktp == "1"){
							 $cek_ddik_sekretaris_ktp = true;
						 }
					 }
					 if($tmp->jabatan == "other"){
						 $cek_ddik_other = true;
						 $count_ddik_other_ktp = $tmp->ktp;
						 $count_ddik_other_kta = $tmp->kta;
					 }
				 }
			?>
			<tbody>
				<tr>
					<td>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="ddik_jabatan[]" value="ketua" {{ ($cek_ddik_ketua)?'checked':'' }}> Ketua
							</label>
						</div>
					</td>
					<td class="text-center">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="ddik_ktp_ketua" value="1" {{ ($cek_ddik_ketua_ktp)?'checked':'' }}>
							</label>
						</div>
					</td>
					<td class="text-center">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="ddik_kta_ketua" value="1" {{ ($cek_ddik_ketua_kta)?'checked':'' }}>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="ddik_jabatan[]" value="sekretaris"{{ ($cek_ddik_sekretaris)?'checked':''}}> Sekretaris
							</label>
						</div>
					</td>
					<td class="text-center">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="ddik_ktp_sekretaris" value="1" {{ ($cek_ddik_sekretaris_ktp)?'checked':'' }}>
							</label>
						</div>
					</td>
					<td class="text-center">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="ddik_kta_sekretaris" value="1" {{ ($cek_ddik_sekretaris_kta)?'checked':'' }}>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="ddik_jabatan[]" value="bendahara" {{ ($cek_ddik_bendahara)?'checked':'' }}> Bendahara
							</label>
						</div>
					</td>
					<td class="text-center">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="ddik_ktp_bendahara" value="1" {{ ($cek_ddik_bendahara_ktp)?'checked':'' }}>
							</label>
						</div>
					</td>
					<td class="text-center">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="ddik_kta_bendahara" value="1"{{ ($cek_ddik_bendahara_kta)?'checked':'' }}>
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
							<input type="checkbox" name="ddik_o_ktp_n" value="1" {{ ($cek_ddik_other)?'checked':'' }}> Jumlah KTP Lainnya
						</label>
					</div>
				</td>
				<td>
					<input type="number" min="0" step="1" class="form-control" name="ddik_o_ktp" value="{{ $count_ddik_other_ktp }}">
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="ddik_o_kta_n" value="1" {{ ($cek_ddik_other)?'checked':'' }}> Jumlah KTA Lainnya
						</label>
					</div>
				</td>
				<td>
					<input type="number" min="0" step="1" class="form-control" name="ddik_o_kta" value="{{ $count_ddik_other_kta}}">
				</td>
			</tr>
		</table>
		<hr>
		<label>3. DCVP</label>
		<?php
			$cek_dcvp_ketua = false;
			$cek_dcvp_sekretaris = false;
			$cek_dcvp_bendahara = false;
			$cek_dcvp_other = false;
			$count_dcvp_other = 0;
			$result = DB::table("tb_dcvp")
						 ->where("id_rekap","=",$id_rekap)
						 ->get();
			 foreach($result as $tmp){
				 if($tmp->jenis == "bendahara"){
					 $cek_dcvp_bendahara = true;
				 }
				 if($tmp->jenis == "ketua"){
					 $cek_dcvp_ketua = true;
				 }
				 if($tmp->jenis == "sekretaris"){
					 $cek_dcvp_sekretaris = true;
				 }
				 if($tmp->jenis == "other"){
					 $cek_dcvp_other = true;
					 $count_dcvp_other = $tmp->drh;
				 }
			 }
		?>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td colspan="2">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="dcvp_jabatan[]" value="ketua" {{($cek_dcvp_ketua)?"checked":""}}> DRH Ketua
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="dcvp_jabatan[]" value="sekretaris" {{($cek_dcvp_sekretaris)?"checked":""}}> DRH Sekretaris
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="dcvp_jabatan[]" value="bendahara" {{($cek_dcvp_bendahara)?"checked":""}}> DRH Bendahara
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="dcvp_o_jabatan" value="other" {{($cek_dcvp_other)?"checked":""}}> Jumlah DRH lainnya
							</label>
						</div>
					</td>
					<td>
						<input type="number" class="form-control" min="0" step="1" name="dcvp_o_drh" value = "{{$count_dcvp_other}}">
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
							<input type="checkbox" name="dsks_presiden" value="1" {{ ($get->f_presiden == 1)?'checked':'' }}> Foto Presiden & Wakil Presiden
						</label>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="dsks_garuda" value="1" {{ ($get->f_garuda == 1)?'checked':'' }}> Foto Garuda Pancasila
						</label>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="dsks_bendera" value="1" {{ ($get->f_bendera == 1)?'checked':'' }}> Foto Bendera & Pataka
						</label>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="dsks_ketum" value="1" {{ ($get->f_ketum == 1)?'checked':'' }}> Foto Ketum & Sekjen
						</label>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="dsks_papan_nama" value="1" {{ ($get->f_papan == 1)?'checked':'' }}> Foto Papan Nama
						</label>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="dsks_kantor" value="1" {{ ($get->f_kantor == 1)?'checked':'' }}> Layout Kantor
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
							<input type="checkbox" name="dsks_sewa" value="1" {{ ($get->f_sewa == 1)?'checked':'' }}> Surat Perjanjian Sewa Menyewa
						</label>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="dsks_bank" value="1" {{ ($get->f_bank == 1)?'checked':'' }}> Bank
						</label>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="dsks_kesbangpol" value="1" {{ ($get->f_kesbangpol == 1)?'checked':'' }}> Kesbangpol
						</label>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="dsks_keterangan" value="1" {{ ($get->f_keterangan == 1)?'checked':'' }}> Surat keterangan dan surat pernyataan
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
							<input type="checkbox" name="ddks_domisili" value="1" {{ ($get->domisili == 1)?'checked':'' }}> Domisili
						</label>
					</div>
				</td>
			</tr>
		</table>
		<hr>
		<label>Keterangan / Catatan</label>
		<textarea name="catatan" class="form-control" style="min-width: 100%; max-width: 100%; min-height:120px; max-height: 120px;">{{ $get->catatan }}</textarea>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="pull-right">
			<br>
			<button class="btn btn-primary" id="btn-submit">SUBMIT</button>
		</div>
	</div>
</div>
</form>
@endforeach
