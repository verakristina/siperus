@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus DPD ')


	@section('modal_struk_tipe','DPD')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','DPD')
	@section('struk_tipe_box_header','List DPD')

	@section('modal_struk_input_tambahan')
		@section('indo_combo_prov','initial')
		@include('main.input.section_indo_combo')
	@stop

	@section('content_filter_combo')
		@section('indo_combo_fprov','initial')
		@include('main.input.section_indo_filter_combo')
	@stop
	

	@section('content_action_tambah','tambah/dpd')
	@section('content_action_edit','edit/dpd/')

	@section('goto_prov')
		location.href="{{url()}}/data_pengurus/dpd/"+provId;
	@stop
	 
	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Jabatan</th>
		  <th>Nama</th>
		  <th>L/P</th>
		  <th>No. SK</th>
		  <th>No. KTA</th>
		  <th>No. Telp</th>
		  <th>Email</th>
		  <th>Aksi</th>
		</tr>
	@stop	

	@section('content_table_body')
		{{--*/$no =1/*--}}
		{{--*/$bio_xxx_id='bio_dpd_id'/*--}}
		{{--*/$type='dpd'/*--}}
		  @foreach($data as $val)
		   {{--*/

		  	$obj='noSk:"'.$val->no_sk2.
		  	'",turunSK:"'.$val->turun_sk.'"'

		  	/*--}}
		  @include('main.input.section_generik_content')
		  <tr>
		  <td>{{ $no++ }}</td>
			@yield('table_data')		
			@yield('table_action')
		  </tr>
		  @endforeach
		  
	@stop
	<script src="{{asset('asset/js/moment.js')}}"></script>
	@section('content_action_edit_func')
		$("#no_sk").val(obj.noSk)
		$("#date").val(moment(obj.turunSK).format('DD-MM-YYYY'))
	@stop
	@include('main.input.section_content_struktur')
	@include('main.input.section_modal_struktur')

@stop
