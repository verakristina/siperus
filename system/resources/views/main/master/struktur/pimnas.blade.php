@extends('main.layout.layout')

@section('struktur','PIMNAS')
@section('title-page','Struktur PIMNAS')

@section('content')
	@section('menu','Master Data')
	@section('sub_menu','Struktur PIMNAS')
	@section('box-header','List Struktur PIMNAS')
	  
	@section('action-tambah','proses/tambah/struktur/pimnas')
	@section('action-edit','proses/edit/struktur/pimnas')

	@section('goto_kab')
		location.href="{{url()}}/master/struktur/pimnas/"+provId+"/"+kabId;
	@stop

	@section('table_head')
		<tr>
			<th>No</th>
			<th>Struktur PIMNAS</th>
			<th width="150">Aksi</th>
		</tr>
	@stop	

	@section('table_body')
		{{--*/$no =1/*--}}
		@foreach($data as $tmp)
			<tr>
				<td>{{ $no++ }}</td> 
				<td>{{ $tmp->struk_pimnas_nama }}</td>
				<td>
					<div onclick="detailStruktur('pimnas','{{ $tmp->struk_pimnas_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
					@if(session('statActHide') != 1)
						<div onclick='actionEdit("","","","","","","{{ $tmp->struk_pimnas_id }}","{{ $tmp->struk_pimnas_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
						<a href="{{ asset('proses/delete/struktur/pimnas/'.$tmp->struk_pimnas_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
						<div onclick="printUser('{{ $tmp->struk_pimnas_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
					@endif
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