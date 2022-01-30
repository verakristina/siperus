@section('table_action')	
<td style="width:1%;white-space:nowrap;">
	<div onclick="detailUser('{{ @$val->bio_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
	<div onclick="actionEdit({{$val->r_bio_id}},'{{$val->nama or ''}}',{{$val->bio_id or 'null'}},'{{@$val->nama_jabatan?:'-'}}',{{$val->jabatan_id or 'null'}},{{'{'.(@$obj?:'').'}'}})" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
	<?php
	if($type == "par"){
		$tp = "pr";
	}else{
		$tp = $type;
	}
	?>
	<a href="{{asset('input/hapus/').'/'.$tp.'/'.$val->r_bio_id}}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
	<div onclick="printUser('{{ @$val->bio_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
	<div onclick="getExcel('{{ @$val->bio_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Excel"><i class="fa fa-file"></i></div>
</td>
@overwrite
@section('table_struk_header')
	<tr>
		<th>No</th>
		<th>Jabatan</th>
		<th>Nama</th>
		<th>L/P</th>
		<th>No.SK</th>
		<th>No.KTA</th>
		<th>No.Telp</th>
		<th>Email</th>
		<th>Aksi</th>
	</tr>
@stop
@section('table_data')
		<td>{{ ucwords(strtolower(isset($val->nama_jabatan)?$val->nama_jabatan:'-'))?:'-' }}</td>
		<td>
			@if($val->nama_anggota == null || $val->id_anggota != 0)
			{{ $val->nama?:'-' }}
			@else
			{{ $val->nama_anggota }}
			@endif
		</td>
		<!-- <td>{{ ($val->gender==1?'L':($val->gender==2?'P':'-')) }}</td> -->
		<td>{{ $val->no_sk2?:'-' }}</td>
		<td>{{ $val->no_kta2?str_replace('.', '', $val->no_kta2):'-' }}</td>
		<td>{{ $val->bio_nomer_identitas?:'-' }}</td>
		<td>{{ $val->no_hp?:'-' }}</td>
		<!-- <td>{ { $val->email?:'-' } }</td> -->
@overwrite
@section('table_data2')
<div id="btnEditData" data-target="#modal-input-struk" data-toggle="modal" class="btn-block fa fa-edit hide"></i>		
		
@overwrite
@section('doremi')
	hello world!!
@stop
@yield('teses')
