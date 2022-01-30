@extends('main.layout.layout')

@section('struktur','DPP')
@section('title-page','Struktur DPP')

@section('content')
	@section('menu','Master Data')
	@section('sub_menu','Struktur DPP')
	@section('box-header','List Struktur DPP')
	  
	@section('action-tambah','proses/tambah/struktur/dpp')
	@section('action-edit','proses/edit/struktur/dpp')

	@section('goto_kab')
		location.href="{{url()}}/master/struktur/dpp/"+provId+"/"+kabId;
	@stop

	@section('table_head')
		<tr>
			<th>No</th>
			<th>Struktur DPP</th>
			<th width="150">Aksi</th>
		</tr>
	@stop	

	@section('table_body')
		{{--*/$no =1/*--}}
		@foreach($data as $tmp)
			<tr>
				<td>{{ $no++ }}</td> 
				<td>{{ $tmp->struk_dpp_nama }}</td>
				<td>
					<div onclick="detailStruktur('dpp','{{ $tmp->struk_dpp_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
					<div onclick='actionEdit("","","","","","","{{ $tmp->struk_dpp_id }}","{{ $tmp->struk_dpp_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
					<a href="{{ asset('proses/delete/struktur/dpp/'.$tmp->struk_dpp_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
					<div onclick="printUser('{{ $tmp->struk_dpp_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
				</td>
			</tr>
		@endforeach
	@stop
	
	@section('edit-function')
		$('#edit_id_struk').val(struk_id);
		$('#edit_nama_struk').val(struk_nama);
		$('#modalStrukturEdit').modal('show');
	@stop
	
	@include('main.master.struktur.include.content')
@endsection