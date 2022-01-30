@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus PAC ')


	@section('modal_struk_tipe','PAC')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','PAC')
	@section('struk_tipe_box_header','List PAC')

	@section('modal_struk_input_tambahan')
		@section('indo_combo_prov','initial')
		@section('indo_combo_kab','initial')
		@section('indo_combo_kec','initial')
		@include('main.input.section_indo_combo')
	@stop
	@section('content_filter_combo')
		@section('indo_combo_fprov','initial')
		@section('indo_combo_fkab','initial')
		@section('indo_combo_fkec','initial')
		@include('main.input.section_indo_filter_combo')
	@stop
	@section('content_title_header_small','List PAC')
	@section('content_title_header_small','Data PAC')

	@section('content_action_tambah','tambah/pac')
	@section('content_action_edit','edit/pac/')

	
	@section('goto_kec')
	location.href="{{url()}}/data_pengurus/pac/"+provId+"/"+kabId+"/"+kecId;
	@stop
	 
	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Nama</th>
		  <th>Wilayah</th>
		  <th>Jabatan</th>
		  <th>No. Telp</th>
		  <th>Email</th>
		  <th width="1%">Aksi</th>
		</tr>
	@stop	
	
	@section('content_table_body')
		{{--*/$no =1/*--}}
		{{--*/$bio_xxx_id='bio_pimcam_id'/*--}}
		{{--*/$type='pac'/*--}}
		  @foreach($data as $val)
		  @include('main.input.section_generik_content')
		  	<tr><div id="btnEditData" data-target="#modal-input-struk" data-toggle="modal" class="btn-block fa fa-edit hide"></i>	
			  	<td>{{ $no++ }}</td>
				<td>{{ ucwords(strtolower($val->nama))?:'-' }}</td>
				<td>{{ ucwords(strtolower(($val->geo_prov_nama.', '.$val->geo_kab_nama.', '.$val->geo_kec_nama)?:'-')) }}</td>
				<td>{{ ucwords(strtolower(isset($val->nama_jabatan)?$val->nama_jabatan:'-'))?:'-' }}</td>
				<td>{{ $val->no_telp?:'-' }}</td>
				<td>{{ $val->email?:'-' }}</td>
			
				<td>
					@yield('table_action')
				</td>
		  </tr>
		  @endforeach
		  
	@stop


	@include('main.input.section_content_struktur')
	@include('main.input.section_modal_struktur')

	@section('content_action_edit_func')

	@stop
@stop
