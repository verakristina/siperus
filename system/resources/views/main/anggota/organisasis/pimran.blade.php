@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus PIMRAN ')
	@section('modal_struk_tipe','PIMRAN')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','PIMRAN')
	@section('struk_tipe_box_header','List PIMRAN')

	@section('sk_baru', $sk_baru)

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

	@section('content_action_tambah','tambah/pimran')
	@section('content_action_edit','edit/pimran/')

	@section('goto_kel')
		location.href="{{url()}}/data_pengurus/pimran/"+provId+"/"+kabId+"/"+kecId+"/"+kelId;
	@stop

	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Jabatan</th>
		  <th>Nama</th>
		  <th>No. SK</th>
		  <th>No. KTA</th>
		  <th>No. KTP</th>
		  <th>No.Telp</th>
		  <th width="150">Aksi</th>
		</tr>
	@stop	

	@section('content_table_body')
		{{--*/$no =1/*--}}
		{{--*/$bio_xxx_id='bio_par_id'/*--}}
		{{--*/$type='par'/*--}}
		  @foreach($data as $val)
		  {{--*/

			$obj='noSk:`'.$val->no_sk2.
			'`,geo_kab_id:`'.$val->geo_kab_id.
			'`,geo_kec_id:`'.$val->geo_kec_id.
			'`,geo_deskel_id:`'.$val->geo_deskel_id.
			'`,turunSK:`'.$val->turun_sk.'`'

			/*--}}
		  @include('main.input.section_generik_contents')
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
	
	<script src="{{asset('asset/js/moment.js')}}"></script>
	@section('content_action_edit_func')
		$("#kab2").val(obj.geo_kab_id)
		$("#kec2").val(obj.geo_kec_id)
		$("#kel2").val(obj.geo_deskel_id) 
		$("#no_sk").val(obj.noSk)
		$("#date").val(moment(obj.turunSK).format('DD-MM-YYYY'))
	@stop
@stop
