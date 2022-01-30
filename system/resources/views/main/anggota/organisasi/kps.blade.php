@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data pengurus KPA ')
	@section('modal_struk_tipe','KPA')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','KPA')
	@section('struk_tipe_box_header','List KPA')

	@section('use_filter_kta','none')
	@section('use_filter_sk','none')

	@section('modal_struk_input_tambahan')
		@section('indo_combo_prov','initial')
		@section('indo_combo_kab','initial')
		@section('indo_combo_kec','initial')
		@section('indo_combo_kel','initial')
		@section('indo_combo_rw','initial')
		@section('indo_combo_rt','initial')
		@include('main.input.section_indo_combo')
	@stop
	@section('content_filter_combo')
		@section('indo_combo_fprov','initial')
		@section('indo_combo_fkab','initial')
		@section('indo_combo_fkec','initial')
		@section('indo_combo_fkel','initial')
		@section('indo_combo_frw','initial')
		@section('indo_combo_frt','initial')
		@include('main.input.section_indo_filter_combo')
	@stop

	@section('content_action_tambah','tambah/kpa')
	@section('content_action_edit','edit/kpa/')

	@section('goto_rt')
		location.href="{{url()}}/data_pengurus/kpa/"+provId+"/"+kabId+"/"+kecId+"/"+kelId+"/"+rwId+"/"+rtId;
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
		{{--*/$bio_xxx_id='bio_kpa_id'/*--}}
		{{--*/$type='kpa'/*--}}
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
