@extends('main.layout.layout')

@section('struktur','PAC')
@section('title-page','Struktur PAC')

@section('content')
	@section('menu','Master Data')
	@section('sub_menu','Struktur PAC')
	@section('box-header','List Struktur PAC')
	
	@section('filter')
		@section('filter_prov','initial')
		@section('filter_kab','initial')
		@section('filter_kec','initial') 
		@include('main.master.struktur.include.filter')
	@stop
	
	@section('modal_prov','initial')
	@section('modal_kab','initial')
	@section('modal_kec','initial') 
	
	@section('action-tambah','proses/tambah/struktur/pac')
	@section('action-edit','proses/edit/struktur/pac')

	@section('goto_kec')
		location.href="{{url()}}/master/struktur/pac/"+provId+"/"+kabId+"/"+kecId;
	@stop

	@section('table_head')
		<tr>
			<th>No</th>
			<th>Struktur PAC</th>
			<th width="150">Aksi</th>
		</tr>
	@stop	

	@section('table_body')
		{{--*/$no =1/*--}}
		@foreach($data as $tmp)
			<tr>
				<td>{{ $no++ }}</td> 
				<td>{{ $tmp->struk_pac_nama }}</td>
				<td>
					<div onclick="detailStruktur('pac','{{ $tmp->struk_pac_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
					<div onclick='actionEdit("{{ $tmp->geo_prov_id }}","{{ $tmp->geo_kab_id }}","{{ $tmp->geo_kec_id }}","","","","{{ $tmp->struk_pac_id }}","{{ $tmp->struk_pac_nama }}")' class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
					<a href="{{ asset('proses/delete/struktur/pac/'.$tmp->geo_prov_id.'/'.$tmp->geo_kab_id.'/'.$tmp->geo_kec_id.'/'.$tmp->struk_pac_id) }}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
					<div onclick="printUser('{{ $tmp->struk_pac_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
				</td>
			</tr>
		@endforeach
	@stop
	
	@section('edit-function')
		$('#edit_id_prov').val(prov_id);
		$('#edit_id_kab').val(kab_id);
		$('#edit_id_kec').val(kec_id);
		$('#edit_id_struk').val(struk_id);
		$('#edit_nama_struk').val(struk_nama);
		$('#modalStrukturEdit').modal('show');
	@stop
	
	@include('main.master.struktur.include.content')
@endsection