@section('table_action')	
<td style="width:1%;white-space:nowrap;">
	<div onclick="detailUser('{{ @$val->bio_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
	<div onclick="actionEdit({{$val->r_bio_id}},'{{$val->nama or ''}}',{{$val->bio_id or 'null'}},'{{@$val->nama_jabatan?:'-'}}',{{$val->jabatan_id or 'null'}},{{'{'.(@$obj?:'').'}'}})" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
	<a href="{{asset('input/hapus/'.$type.'/'.$val->r_bio_id)}}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
	<div onclick="printUser('{{ @$val->bio_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
	<div onclick="getExcel('{{ @$val->bio_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Excel"><i class="fa fa-file"></i></div>
</td>
@overwrite
@section('table_head')
	<th>Nama</th>
	<th>JK</th>
	<th>No.SK</th>
	<th>No.KTA</th>
	<th>Telp</th>
	<th>Email</th>
	<th width="150">Aksi</th>
@overwrite
@section('table_data')
	<td>{{ $val->nama?:'-' }}</td>
	<td>{{ ($val->gender==1?'L':($val->gender==2?'P':'-')) }}</td>
	<td>{{ $val->no_sk?:'-' }}</td>
	<td>{{ $val->no_kta?:'-' }}</td>
	<td>{{ $val->no_telp?:'-' }}</td>
	<td>{{ $val->email?:'-' }}</td>
@overwrite
@section('table_data2')
<div id="btnEditData" data-target="#modal-input-struk" data-toggle="modal" class="btn-block fa fa-edit hide"></i>		
		
@overwrite
@section('doremi')
	hello world!!
@stop
@yield('teses')
