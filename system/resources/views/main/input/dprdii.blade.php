@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>

	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus DPRD II ')

	@section('modal_struk_tipe','DPRD II')
	@section('struk_tipe_menu','Data Anggota')
	@section('struk_tipe_sub_menu','Anggota Legislatif')
	@section('struk_tipe_box_header','List DPRD II')
	@section('use_jabatan','none')

	@section('modal_struk_input_tambahan')
		@section('indo_combo_prov','initial')
		@section('indo_combo_kab','initial')
		@include('main.input.section_indo_combo')
	@stop

	@section('content_filter_combo')
		@section('indo_combo_fprov','initial')
		@section('indo_combo_fkab','initial')
		@include('main.input.section_indo_filter_combo')
	@stop

	

	@section('content_action_tambah','tambah/dprdii')
	@section('content_action_edit','edit/dprdii/')

	@section('goto_kab')
	location.href="{{url()}}/data_anggota/dprdii/"+provId+"/"+kabId;
	@stop

	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Nama</th>
		  <th>No. Telp</th>
		  <th>Email</th>
		  <th width="150">Aksi</th>
		</tr>
	@stop	

	@section('content_table_body')
		{{--*/$no =1/*--}}
		{{--*/$bio_xxx_id='bio_dprdii_id'/*--}}
		{{--*/$type='dprdii'/*--}}
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
	@section('content_action_edit_func')

	@stop
@stop
