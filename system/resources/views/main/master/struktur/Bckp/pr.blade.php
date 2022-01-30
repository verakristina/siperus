@extends('main.layout.layout')

@section('struktur','PR')
@section('title-page','Struktur PR')

@section('content')
	@section('menu','Master Data')
	@section('sub_menu','Struktur PR')
	@section('box-header','List Struktur PR')
	
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
	
	@section('action-tambah','proses/tambah/struktur/pr')
	@section('action-edit','proses/edit/struktur/pr')

	@section('goto_kel')
		location.href="{{url()}}/master/struktur/pr/"+provId+"/"+kabId+"/"+kecId+"/"+kelId;
	@stop

	@section('table_head')
		<tr>
			<th>No</th>
			<th>Struktur PR</th>
			<th width="150">Aksi</th>
		</tr>
	@stop	

	@section('table_body')
		{{--*/$no =1/*--}}
		@foreach($data as $tmp)
			<tr>
				<td>{{ $no++ }}</td> 
				<td>{{ $tmp->struk_pr_nama }}</td>
				<td>
					<div onclick="detailStruktur('pr','{{ $tmp->struk_pr_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
					<div onclick='actionEdit("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","{{ $tmp->geo_kec_id }}","{{ $tmp->geo_deskel_id }}","","","{{ $tmp->struk_pr_id }}","{{ $tmp->struk_pr_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
					<a href="{{ asset('proses/delete/struktur/pr/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id.'/'.$tmp->geo_kec_id.'/'.$tmp->geo_deskel_id.'/'.$tmp->struk_pr_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
					<div onclick="printUser('{{ $tmp->struk_pr_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
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