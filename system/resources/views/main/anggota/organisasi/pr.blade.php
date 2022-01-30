@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus PR ')
	@section('modal_struk_tipe','PR')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','PR')
	@section('struk_tipe_box_header','List PR')

	@section('use_filter_kta','none')
	@section('use_filter_sk','none')

	@section('modal_struk_input_tambahan')
		@section('indo_combo_prov','initial')
		@section('indo_combo_kab','initial')
		@section('indo_combo_kec','initial')
		@section('indo_combo_kel','initial')
		@include('main.input.section_indo_combo')
	@stop

	@section('content_filter_combo')
		@section('indo_combo_fprov','initial')
		@section('indo_combo_fkab','initial')
		@section('indo_combo_fkec','initial')
		@section('indo_combo_fkel','initial')
		@include('main.input.section_indo_filter_combo')
	@stop

	@section('content_action_tambah','tambah/pr')
	@section('content_action_edit','edit/pr/')

	@section('goto_kel')
		location.href="{{url()}}/data_pengurus/pr/"+provId+"/"+kabId+"/"+kecId+"/"+kelId;
	@stop

	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Nama</th>
		  <th>Jabatan</th>
		  <th>No. Telp</th>
		  <th>Email</th>
		  <th width="150">Aksi</th>
		</tr>
	@stop	

	@section('content_table_body')
		{{--*/$no =1/*--}}
		{{--*/$bio_xxx_id='bio_par_id'/*--}}
		{{--*/$type='par'/*--}}
		  @foreach($data as $val)
		  @include('main.input.section_generik_content')
		  <tr>
		  <td>{{ $no++ }}</td>
			@yield('table_data')		
			@yield('table_action')
		  </tr>
		  @endforeach
	@stop
	
	
	@include('main.input.section_content_struktur')
	@include('main.input.section_modal_struktur')
	@include('main.anggota.partai.include.modal_detail')
	@section('content_action_edit_func')

	@stop
@stop
