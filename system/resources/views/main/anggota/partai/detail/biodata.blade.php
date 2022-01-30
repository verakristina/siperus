<?php
$namaLengkap = array();
array_push($namaLengkap,ucwords(strtolower($tmp->bio_nama_depan)),ucwords(strtolower($tmp->bio_nama_tengah)),ucwords(strtolower($tmp->bio_nama_belakang)));
?>
<div class="row">
	<div class="col-md-3 col-sm-12 col-xs-12">
		<div class="form-group">
			<img src="{{ asset('asset/img/dokumen/'.$tmp->bio_id.'/foto/'.$tmp->bio_foto) }}" alt="" width="100%"/>
		</div>
	</div>
	<div class="col-md-9 col-sm-12 col-xs-12">
		<table>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>{{ join(' ',$namaLengkap) }}</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>{{ $tmp->jk_value }}</td>
			</tr>
		</table>
	</div>
</div>