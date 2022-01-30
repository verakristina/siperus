@extends('main.layout.layout')

@section('struktur','PIMCAB')
@section('title-page','Struktur PIMCAB')

@section('content')
	@section('menu','Master Data')
	@section('sub_menu','Struktur PIMCAB')
	@section('box-header','List Struktur PIMCAB')
	
	@section('filter')
		@section('filter_prov','initial')
		@section('filter_kab','initial') 
		@include('main.master.struktur.include.filter')
	@stop
	
	@section('modal_prov','initial')
	@section('modal_kab','initial') 
	
	@section('action-tambah','proses/tambah/struktur/pimcab')
	@section('action-edit','proses/edit/struktur/pimcab')

	@section('goto_kab')
		location.href="{{url()}}/master/struktur/pimcab/"+provId+"/"+kabId;
	@stop

	@section('table_head')
		<tr>
			<th>No</th>
			<th>Struktur PIMCAB</th>
			<th width="150">Aksi</th>
		</tr>
	@stop	

	@section('table_body')
		{{--*/$no =1/*--}}
		@foreach($data as $tmp)
			<tr>
				<td>{{ $no++ }}</td> 
				<td>{{ $tmp->struk_pimcab_nama }}</td>
				<td>
					<div onclick="detailStruktur('pimcab','{{ $tmp->struk_pimcab_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
					@if(session('statActHide') != 1)
						<div onclick='actionEdit("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","","","","","{{ $tmp->struk_pimcab_id }}","{{ $tmp->struk_pimcab_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
						<a href="{{ asset('proses/delete/struktur/pimcab/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id.'/'.$tmp->struk_pimcab_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
						<div onclick="printUser('{{ $tmp->struk_pimcab_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
					@endif
				</td>
			</tr>
		@endforeach
	@stop
	
	@section('edit-function')
		$('#edit_id_prov').val(prov_id);
		$('#edit_id_kab').val(kab_id);
		$('#edit_id_struk').val(struk_id);
		$('#edit_nama_struk').val(struk_nama);
		$('#modalStrukturEdit').modal('show');
	@stop
	
	@include('main.master.struktur.include.content')
@endsection