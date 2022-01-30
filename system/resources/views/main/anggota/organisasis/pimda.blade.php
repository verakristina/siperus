@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus PIMDA ')
	@section('modal_struk_tipe','PIMDA')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','PIMDA')
	@section('struk_tipe_box_header','List PIMDA')
	
	@section('sk_baru', $sk_baru)

	@section('use_filter_kta','none')
	@section('use_filter_sk','none')
	@section('modal_struk_input_tambahan')
		@section('indo_combo_prov','initial')
		@include('main.input.section_indo_combo')
	@stop

	@section('content_filter_combo')
		@section('indo_combo_fprov','initial')
		@include('main.input.section_indo_filter_combo')
	@stop
	
	@section('content_action_tambah','tambah/pimda')
	@section('content_action_edit','edit/pimda/')

	@section('goto_prov')
		location.href="{{url()}}/data_pengurus/pimda/"+provId;
	@stop
	 
	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Jabatan</th>
		  <th>Nama</th>
		  <!-- <th>L/P</th> -->
		  <th>No. SK</th>
		  <th>No. KTA</th>
		  <th>No. KTP</th>
		  <th>No.Telp</th>
		  <!-- <th>Email</th> -->
		  <th>Aksi</th>
		</tr>
	@stop	

	@section('content_table_body')
		{{--*/$no =1/*--}}
		{{--*/$bio_xxx_id='bio_pimda_id'/*--}}
		{{--*/$type='pimda'/*--}}
		  @foreach($data as $val)
		   {{--*/

			$obj='noSk:`'.$val->no_sk2.
			'`,turunSK:`'.$val->turun_sk.
			'`,noKTA:`'.$val->no_kta2.'`'.
			',noHP : `'.$val->no_hp.'`'.
			',email : `'.$val->email.'`
			,nama_anggota : `'.$val->nama_anggota.'`'

			/*--}}
		  @if($a_type != "")
		  	@section('a_type', $a_type)
		  @endif

		  @if($a_prov != "")
		  	@section('a_prov', $a_prov)
		  @endif

		  @if($a_kab != "")
		  	@section('a_kab', $a_kab)
		  @endif

		  @if($a_kec != "")
		  	@section('a_kec', $a_kec)
		  @endif

		  @if($a_deskel != "")
		  	@section('a_deskel', $a_deskel)
		  @endif

		  @if($a_rw != "")
		  	@section('a_rw', $a_rw)
		  @endif
		  
		  @include('main.input.section_generik_contents')
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
		$("#no_kta").val(obj.noKTA)
		$("#no_ktp").val(obj.noKTP)
		$("#no_hp").val(obj.noHP)
		$("#email").val(obj.email)
		$("#nama_anggota").val(obj.nama_anggota)
		$("#date").val(moment(obj.turunSK).format('DD-MM-YYYY'))
	@stop
	@include('main.input.section_content_struktur')
	@include('main.input.section_modal_struktur')

@stop
