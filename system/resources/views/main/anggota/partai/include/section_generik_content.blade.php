@section('table_action')	
<td style="width:1%;white-space:nowrap;"">
	<div onclick="detailUser('{{ @$val->user_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
	<div onclick="actionEdit({{$val->user_id}},'{{$val->nama_lengkap or ''}}',{{$val->user_id or 'null'}},'{{@$val->nama_jabatan?:'-'}}',{{$val->jabatan_id or 'null'}},{{'{'.(@$obj?:'').'}'}})" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
	<a href="{{asset('input/hapus/'.$type.'/'.$val->user_id)}}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
	<div onclick="printUser('{{ @$val->user_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
	<div onclick="getExcel('{{ @$val->user_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Excel"><i class="fa fa-file"></i></div>
</td>
@overwrite
@section('table_data')
		<td>{{ $val->geo_prov_nama?:'-' }}</td>
		<td>{{ $val->username?:'-' }}</td>
		<td>{{ $val->password?:'-' }}</td>
		<td>{{ $val->akses_nama?:'-' }}</td>
		<td>{{ $val->nama_lengkap?:'-' }}</td>
@overwrite