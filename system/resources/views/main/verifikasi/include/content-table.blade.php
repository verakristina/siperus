@section('table_action')	
<td style="width:1%;white-space:nowrap;">
	<div onclick="getDataDetailVerif('{{ @$val->verifikasi_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
	@if(session('statActHide') != 1)
	<div onclick="actionEdit({{$val->verifikasi_id}},'{{$val->verifikasi_staf_admin}}',{{'{'.(@$obj?:'').'}'}})" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
	<a href="{{asset('input/hapus/verifikasi/'.$val->verifikasi_id)}}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
	<div onclick="printUser('{{ @$val->verifikasi_id }}')" class="hide btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
	<div onclick="getExcel('{{ @$val->verifikasi_id }}')" class="hide btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Excel"><i class="fa fa-file"></i></div>
	@endif
</td>
@overwrite
@section('table_data')
<style type="text/css">
	.fa.fa-check {
		color: green !important;
	}	
	.fa.fa-times {
		color: red !important;
	}
</style>
		<td>{{ $val->verifikasi_nama?:'-' }}</td>
		<td>
			@if($val->verifikasi_status_kantor == '1')
				Milik Sendiri
			@elseif($val->verifikasi_status_kantor == NULL)
				-
			@elseif($val->verifikasi_status_kantor == '2')
				Kontrak / Pinjam Pakai
			@endif
		</td>
		<td>{{ $val->verifikasi_alamat_kantor?:'-' }}</td>
		<td>@if($val->verifikasi_ibukota == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>@if($val->verifikasi_keaktifan_pengurus == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>@if($val->verifikasi_perempuan == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>{{ $val->verifikasi_jumlah_kta?:'0' }}</td>
		<td>@if($val->verifikasi_ruang_kerja_k == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>@if($val->verifikasi_ruang_kerja_s == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>@if($val->verifikasi_ruang_kerja_b == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>@if($val->verifikasi_staf_admin == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>@if($val->verifikasi_papan_nama == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>@if($val->verifikasi_preswapres == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>@if($val->verifikasi_garuda == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>@if($val->verifikasi_ketum_sekjen == 1) <i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i> @endif</td>
		<td>{{ $val->verifikasi_nomer_rekening?:'-' }}</td>
@overwrite