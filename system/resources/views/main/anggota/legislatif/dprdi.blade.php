@extends('main.layout.layout')

@section('title-page','Data Pengurus DPRD I ')

@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>


	@section('modal_struk_tipe','DPRD I')
	@section('struk_tipe_menu','Data Anggota')
	@section('struk_tipe_sub_menu','Anggota Legislatif')
	@section('struk_tipe_box_header','List DPRD I')
	@section('use_jabatan','none')
	@section('use_no_sk','none')
	@section('use_tgl_sk','none')
	@section('name-button','Set')

	@section('modal_struk_input_tambahan')
		@section('indo_combo_prov','initial')
		@section('indo_combo_dapil','initial')
		@include('main.input.section_indo_combo')
	@stop
	
	@section('sk_baru', $sk_baru)

	@section('content_filter_combo')
		@if(session('idRole') != '3')
			@section('indo_combo_fprov','initial')
		@endif
		@include('main.input.section_indo_filter_combo')
	@stop


	@section('content_action_tambah','tambah/dprdi')
	@section('content_action_edit','edit/dprdi/')

	@section('goto_prov')
		location.href="{{url()}}/data_anggota/dprdi/"+provId;
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
		{{--*/$bio_xxx_id='bio_dprdi_id'/*--}}
		{{--*/$type='dprdi'/*--}}
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
		if({{ session('idRole') }} == '3'){			
			changeDapilOptionKPU('{{ session('idProvinsi2') }}','#dapil','2','{{ session('idProvinsi2') }}','');
		} else if({{ $selected[0] }}){
			changeDapilOptionKPU('{{ $selected[0] }}','#dapil','2','{{ $selected[0] }}','');
		} else {
		}
	});
</script>