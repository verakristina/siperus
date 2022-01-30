<style>
	.center{
		text-align: center;
	}
</style>
<table>
	<tr>
		<td colspan="6">
			<h3>Data Pengurus {{ strtoupper($type) }} Partai HANURA</h3>
		</td>
	</tr>
	@if($g_prov != "")
	<tr>
		<td>
			<h4>{{ "Provinsi" }}</h4>
		</td>
		<td>{{ $g_prov }}</td>
	</tr>
	@endif
	@if($g_kab != "")
	<tr>
		<td>
			<h4>{{ "Kota/Kabupaten" }}</h4>
		</td>
		<td>{{ $g_kab }}</td>
	</tr>
	@endif
	@if($g_kec != "")
	<tr>
		<td>
			<h4>{{ "Kecamatan" }}</h4>
		</td>
		<td>{{ $g_kec }}</td>
	</tr>
	@endif
	@if($g_deskel != "")
	<tr>
		<td>
			<h4>{{ "Kelurahan" }}</h4>
		</td>
		<td>{{ $g_deskel }}</td>
	</tr>
	@endif
</table>
<table class="table table-bordered">
	<tr>
		<th class="center">Nama</th>
		<th class="center">Jabatan</th>
		<!-- <th class="center">Daerah</th> -->
		<th class="center">No. SK</th>
		<th class="center">No. KTA</th>
		<th class="center">No. KTP</th>
	</tr>
	<?php $no = 1 ?>
	@foreach($dataReport as $val)
	<tr>
		<td>{{ $val->nama?:'-' }}</td>
		<td>{{ ucwords(strtolower(isset($val->nama_jabatan)?$val->nama_jabatan:'-'))?:'-' }}</td>
		<!-- <td>{{ ($val->gender==1?'L':($val->gender==2?'P':'-')) }}</td> -->
		<td class="center">{{ $val->no_sk2?:'-' }}</td>
		<td class="center">{{ $val->no_kta2?"'".str_replace('.', '', $val->no_kta2):'-' }}</td>
		<td class="center">{{ $val->bio_nomer_identitas?"'".$val->bio_nomer_identitas:'-' }}</td>
	</tr>
	@endforeach
</table>