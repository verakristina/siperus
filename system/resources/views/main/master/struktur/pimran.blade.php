@extends('main.layout.layout')

@section('struktur','PIMRAN')
@section('title-page','Struktur PIMRAN')

@section('content')
	@section('menu','Master Data')
	@section('sub_menu','Struktur PIMRAN')
	@section('box-header','List Struktur PIMRAN')
	
	@section('filter')
		@section('filter_prov','initial')
		@section('filter_kab','initial')
		@section('filter_kec','initial')
		@section('filter_kel','initial') 
		@include('main.master.struktur.include.filter')
	@stop
	
	@section('modal_prov','initial')
	@section('modal_kab','initial')
	@section('modal_kec','initial')
	@section('modal_kel','initial') 
	
	@section('action-tambah','proses/tambah/struktur/pimran')
	@section('action-edit','proses/edit/struktur/pimran')

	@section('goto_kel')
		location.href="{{url()}}/master/struktur/pimran/"+provId+"/"+kabId+"/"+kecId+"/"+kelId;
	@stop

	@section('table_head')
		<tr>
			<th>No</th>
			<th>Struktur PIMRAN</th>
			<th width="150">Aksi</th>
		</tr>
	@stop	

	@section('table_body')
		{{--*/$no =1/*--}}
		@foreach($data as $tmp)
			<tr>
				<td>{{ $no++ }}</td> 
				<td>{{ $tmp->struk_pimran_nama }}</td>
				<td>
					<div onclick="detailStruktur('pimran','{{ $tmp->struk_pimran_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
					@if(session('statActHide') != 1)
						<div onclick='actionEdit("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","{{ $tmp->geo_kec_id }}","{{ $tmp->geo_deskel_id }}","","","{{ $tmp->struk_pimran_id }}","{{ $tmp->struk_pimran_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
						<a href="{{ asset('proses/delete/struktur/pimran/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id.'/'.$tmp->geo_kec_id.'/'.$tmp->geo_deskel_id.'/'.$tmp->struk_pimran_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
						<div onclick="printUser('{{ $tmp->struk_pimran_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
					@endif
				</td>
			</tr>
		@endforeach
	@stop
	
	@section('edit-function')
		$('#edit_id_prov').val(prov_id);
		$('#edit_id_kab').val(kab_id);
		$('#edit_id_kec').val(kec_id);
		$('#edit_id_kel').val(kel_id);
		$('#edit_id_struk').val(struk_id);
		$('#edit_nama_struk').val(struk_nama);
		$('#modalStrukturEdit').modal('show');
	@stop
	
	@include('main.master.struktur.include.content')
@endsection