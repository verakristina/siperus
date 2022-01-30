@extends('main.layout.layout')

@section('struktur','PAR')
@section('title-page','Struktur PAR')

@section('content')
	@section('menu','Master Data')
	@section('sub_menu','Struktur PAR')
	@section('box-header','List Struktur PAR')
	
	@section('filter')
		@section('filter_prov','initial')
		@section('filter_kab','initial')
		@section('filter_kec','initial')
		@section('filter_kel','initial')
		@section('filter_rw','initial')
		@include('main.master.struktur.include.filter')
	@stop
	
	@section('modal_prov','initial')
	@section('modal_kab','initial')
	@section('modal_kec','initial')
	@section('modal_kel','initial')
	@section('modal_rw','initial')
	
	@section('action-tambah','proses/tambah/struktur/par')
	@section('action-edit','proses/edit/struktur/par')

	@section('goto_rw')
		location.href="{{url()}}/master/struktur/par/"+provId+"/"+kabId+"/"+kecId+"/"+kelId+"/"+rwId;
	@stop

	@section('table_head')
		<tr>
			<th>No</th>
			<th>Struktur PAR</th>
			<th width="150">Aksi</th>
		</tr>
	@stop	

	@section('table_body')
		{{--*/$no =1/*--}}
		@foreach($data as $tmp)
			<tr>
				<td>{{ $no++ }}</td> 
				<td>{{ $tmp->struk_par_nama }}</td>
				<td>
					<div onclick="detailStruktur('par','{{ $tmp->struk_par_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
					@if(session('statActHide') != 1)
						<div onclick='actionEdit("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","{{ $tmp->geo_kec_id }}","{{ $tmp->geo_deskel_id }}","{{ $tmp->geo_rw_id }}","","{{ $tmp->struk_par_id }}","{{ $tmp->struk_par_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
						<a href="{{ asset('proses/delete/struktur/par/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id.'/'.$tmp->geo_kec_id.'/'.$tmp->geo_deskel_id.'/'.$tmp->geo_rw_id.'/'.$tmp->struk_par_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
						<div onclick="printUser('{{ $tmp->struk_par_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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
		$('#edit_id_rw').val(rw_id);
		$('#edit_id_struk').val(struk_id);
		$('#edit_nama_struk').val(struk_nama);
		$('#modalStrukturEdit').modal('show');
	@stop
	
	@include('main.master.struktur.include.content')
@endsection