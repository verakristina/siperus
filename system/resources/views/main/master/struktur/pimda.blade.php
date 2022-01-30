@extends('main.layout.layout')

@section('struktur','PIMDA')
@section('title-page','Struktur PIMDA')

@section('content')
	@section('menu','Master Data')
	@section('sub_menu','Struktur PIMDA')
	@section('box-header','List Struktur PIMDA')
	
	@section('filter')
		@section('filter_prov','initial') 
		@include('main.master.struktur.include.filter')
	@stop
	
	@section('modal_prov','initial') 
	
	@section('action-tambah','proses/tambah/struktur/pimda')
	@section('action-edit','proses/edit/struktur/pimda')

	@section('goto_prov')
		location.href="{{url()}}/master/struktur/pimda/"+provId;
	@stop

	@section('table_head')
		<tr>
			<th>No</th>
			<th>Struktur PIMDA</th>
			<th width="150">Aksi</th>
		</tr>
	@stop	

	@section('table_body')
		{{--*/$no =1/*--}}
		@foreach($data as $tmp)
			<tr>
				<td>{{ $no++ }}</td> 
				<td>{{ $tmp->struk_pimda_nama }}</td>
				<td>
					<div onclick="detailStruktur('pimda','{{ $tmp->struk_pimda_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
					@if(session('statActHide') != 1)
						<div onclick='actionEdit("{{ $tmp->geo_prov_id }}","","","","","","{{ $tmp->struk_pimda_id }}","{{ $tmp->struk_pimda_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
						<a href="{{ asset('proses/delete/struktur/pimda/'.$tmp->geo_prov_id.'/'.$tmp->struk_pimda_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
						<div onclick="printUser('{{ $tmp->struk_pimda_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
					@endif
				</td>
			</tr>
		@endforeach
	@stop
	
	@section('edit-function')
		$('#edit_id_prov').val(prov_id); 
		$('#edit_id_struk').val(struk_id);
		$('#edit_nama_struk').val(struk_nama);
		$('#modalStrukturEdit').modal('show');
	@stop
	
	@include('main.master.struktur.include.content')
@endsection