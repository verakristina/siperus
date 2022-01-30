@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus PIMCAM ')


	@section('modal_struk_tipe','PIMCAM')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','PIMCAM')
	@section('struk_tipe_box_header','List PIMCAM')

	@section('sk_baru', $sk_baru)

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
	@section('content_title_header_small','List PIMCAM')
	@section('content_title_header_small','Data PIMCAM')

	@section('content_action_tambah','tambah/pimcam')
	@section('content_action_edit','edit/pimcam/')

	
	@section('goto_kec')
	location.href="{{url()}}/data_pengurus/pimcam/"+provId+"/"+kabId+"/"+kecId;
	@stop
	 
	@if(count($data) != 0)
		@section('content_table_header')
			<tr>
			  <th>No</th>
			  <th>Jabatan</th>
			  <th>Nama</th>
			  <!-- <th>Wilayah</th> -->
			  <th>No. SK</th>
			  <th>No. KTA</th>
			  <th>No. KTP</th>
			  <th>No. Telp</th>
			  <th width="1%">Aksi</th>
			</tr>
		@stop	
		
		@section('content_table_body')
			{{--*/$no =1/*--}}
			{{--*/$bio_xxx_id='bio_pimcam_id'/*--}}
			{{--*/$type='pimcam'/*--}}
			  @foreach($data as $val)
			  {{--*/

				$obj='noSk:`'.$val->no_sk2.
				'`,turunSK:`'.$val->turun_sk.
				'`,noKTA:`'.$val->no_kta2.'`'.
				', noHP : `'.$val->no_hp.'`'.
				', email : `'.$val->email.'`'

				/*--}}
			  @include('main.input.section_generik_content')
				<tr><div id="btnEditData" data-target="#modal-input-struk" data-toggle="modal" class="btn-block fa fa-edit hide"></i>
					<td>{{ $no++ }}</td>
					<td>{{ ucwords(strtolower(isset($val->nama_jabatan)?$val->nama_jabatan:'-'))?:'-' }}</td>
					<td>{{ ucwords(strtolower($val->nama))?:'-' }}</td>
					<!-- <td>{ { ucwords(strtolower(($val->geo_prov_nama.', '.$val->geo_kab_nama.', '.$val->geo_kec_nama)?:'-')) } }</td> -->
					<td>{{ $val->no_sk2?:'-' }}</td>
					<td>{{ $val->no_kta2?str_replace('.', '', $val->no_kta2):'-' }}</td>
					<td>{{ $val->bio_nomer_identitas }}</td>
					<td>{{ $val->no_hp?:'-' }}</td>
					<td>
						@yield('table_action')
					</td>
			  </tr>
			  @endforeach
			  
		@stop
	@else
		@section('content_table_body')
			<tr>
				<td>Data Tidak Ada</td>
			</tr>
		@stop
		@section('content_table_header')
			<tr>
				<th>Data Tidak Ada</th>
			</tr>
		@stop	
	@endif
	
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
	@section('content_action_edit_func')
		$("#no_sk").val(obj.noSk)
		$("#no_kta").val(obj.noKTA)
		$("#no_ktp").val(obj.noKTP)
		$("#date").val(moment(obj.turunSK).format('DD-MM-YYYY'))
	@stop

	@include('main.input.section_content_struktur')
	@include('main.input.section_modal_struktur')
	@include('main.anggota.partai.include.modal_detail')

@stop
