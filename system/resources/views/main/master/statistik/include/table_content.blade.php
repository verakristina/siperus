@section('table_action')	
	<td style="width:1%;white-spimcame:nowrap;">
		<div onclick="detailStatistik('{{ $tmp->pengurus_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
		<div class="{{ (session('idProvinsi2') != $tmp->geo_prov_id && session('idRole') == 3)?'hide':'' }}  btn btn-warning" onclick="editStatistik({{ $dataEdit }})"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"></span></div></a>
		<a href="{{ asset('proses/statistik/'.$tmp->pengurus_id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><div class=" {{ (session('idProvinsi2') != $tmp->geo_prov_id && session('idRole') == 3)?'hide':'' }}  btn-danger btn"><span class="glyphicon glyphicon-trash"></span></div></a>
		<div onclick="printStatistik('{{ $tmp->geo_prov_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
	</td>
@overwrite
@section('table_head')
	<th>Nama</th>
	<th>Jenis Kelamin</th>
	<th>Nomer SK</th>
	<th>Nomer KTA</th>
	<th>Telephone</th>
	<th>Email</th>
	<th width="150">Aksi</th>
@overwrite

@section('table_data')
	<td>{{ $tmp->geo_prov_nama }}</td>
	<td>{{ number_format($tmp->pengurus_pimcab_ada,0,',','.') }} / {{ number_format($tmp->pengurus_pimcab,0,',','.') }}</td>
	<td>{{ number_format($tmp->pengurus_pimcam_ada,0,',','.') }} / {{ number_format($tmp->pengurus_pimcam,0,',','.') }}</td>
	<td>{{ number_format($tmp->pengurus_ranting_ada,0,',','.') }} / {{ number_format($tmp->pengurus_ranting,0,',','.') }}</td>
	<td>{{ number_format($tmp->pengurus_anak_ranting_ada,0,',','.') }} / {{ number_format($tmp->pengurus_anak_ranting,0,',','.') }}</td>
	<td>{{ number_format($tmp->pengurus_kpa_ada,0,',','.') }} / {{ number_format($tmp->pengurus_kpa,0,',','.') }}</td>
@overwrite