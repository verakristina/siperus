@extends('main.layout.layout')

@section('title-page','Data Pengurus DPR-RI ')

@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>


	@section('modal_struk_tipe','DPR-RI')
	@section('struk_tipe_menu','Data Anggota')
	@section('struk_tipe_sub_menu','Anggota Legislatif')
	@section('struk_tipe_box_header','List DPR-RI')
	@section('use_jabatan','none')
	@section('use_no_kta','none')
	@section('use_no_sk','none')
	@section('use_tgl_sk','none')
	@section('name-button','Set')

	@section('modal_struk_input_tambahan')
		@section('indo_combo_dapil','initial')
		@include('main.input.section_indo_combo')
	@stop
	
	@section('sk_baru', $sk_baru)

	@section('content_action_tambah','tambah/dprri')
	@section('content_action_edit','edit/dprri/')
	@section('content_filter_combo')
	@stop
	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Dapil</th>
		  <th>Nama</th>
		  <th>JK</th>
		  <th>No.SK</th>
		  <th>No.KTA</th>
		  <th>Telp</th>
		  <th>Email</th>
		  <th width="150">Aksi</th>
		</tr>
	@stop	

	@section('content_table_body')
		{{--*/$no =1/*--}}
		{{--*/$bio_xxx_id='bio_dprri_id'/*--}}
		{{--*/$type='dprri'/*--}}
		  @foreach($data as $val)
		  
		  @include('main.anggota.legislatif.include.table_content')
		  <tr>
		  <td>{{ $no++ }}</td>
		  <td>{{ $val->nama_dapil }}</td>
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
<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
<script type="text/javascript">
	$('document').ready(function(){
		changeDapilOptionKPU('{{ session('idProvinsi2') }}','#dapil','1','{{ session('idProvinsi2') }}','');
	});
</script>