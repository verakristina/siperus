@extends('main.layout.layout')

@section('title-page','Data Anggota Eksekutif')

@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>


	@section('struk_tipe_menu','Pendaftaran Anggota')
	@section('struk_tipe_sub_menu','Daftar Anggota Eksekutif')

	@section('struk_tipe_box_header','List Anggota Eksekutif')
	@section('use_jabatan','none')
	@section('use_no_kta','none')
	@section('use_no_sk','none')
	@section('use_tgl_sk','none')
	@section('modal_struk_tipe','Anggota Eksekutif')

	@section('modal_struk_input_tambahan')
		<div class="form-group col-md-12">
			<label for="kabupaten" class="col-md-3 col-sm-12 col-xs-12">Jenis Anggota Legislatif</label>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<select name="eksekutif" id="eksekutif" class="form-control custom-field-litle" >
					<option selected  disabled class="text-hide">--- Jenis Anggota Legislatif ---</option>
					@foreach($eksekutif as $tmp)
						<option value="{{ $tmp->eksekutif_id }}">{{ $tmp->eksekutif_nama }}</option>
					@endforeach
				</select>
			</div>
		</div>
	@stop

	@section('content_action_tambah','eksekutif/action')
	@section('content_action_edit','eksekutif/action/')
	@section('content_filter_combo')
	@stop
	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Jabatan</th>
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
		{{--*/ $no = 1 /*--}}
		{{--*/ $type = '' /*--}}
		@foreach($data as $val)
			@include('main.anggota.eksekutif.include.table_content')
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
<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
<script type="text/javascript">
	$('document').ready(function(){
		changeDapilOptionKPU('{{ session('idProvinsi2') }}','#dapil','1','{{ session('idProvinsi2') }}','');
	});
</script>