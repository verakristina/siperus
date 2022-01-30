@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>

	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Kursi ')

	@section('modal_struk_tipe','Kursi')
	@section('tipe_menu','Data Master')
	@section('tipe_sub_menu','Kursi')
	@section('struk_tipe_box_header','List Kursi')
	@section('title_tipe','Kursi')

	@section('modal_input')
		@section('indo_combo_prov','initial')
		@section('indo_combo_kab','initial')
		@include('main.input.section_indo_combo')
		<div class="form-group col-md-12" >
			<label for="provinsi" class="col-md-3 col-sm-12 col-xs-12">Jenis Kursi</label>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<select name="jenis_kursi" id="jenis-kursi" class="form-control custom-field-litle"  >
						<option selected disabled class="text-hide">--- Pilih Kursi ---</option>
						@foreach($jenisKursi as $row)
							<option value="{{$row->jenis_kursi_id}}" >{{$row->jenis_kursi_value}}</option>
						@endforeach
				</select>
			</div>
		</div>
		<div class="form-group col-md-12" >
			<label for="provinsi" class="col-md-3 col-sm-12 col-xs-12">Jumlah Kursi</label>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<input id="jumlah-kursi" type="text" name="jumlah_kursi" class="form-control" data-bind="value:replyNumber">
			</div>
		</div>
	@stop

	@section('content_filter_combo')
		@section('indo_combo_fprov','initial')
		@section('indo_combo_fkab','initial')
		@include('main.input.section_indo_filter_combo')
	@stop

	

	@section('content_action_tambah','master/tambah_kursi')
	@section('content_action_edit','master/edit_kursi')

	@section('goto_kab')
	location.href="{{url()}}/master/kursi/"+provId+"/"+kabId;
	@stop

	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Jenis Kursi</th>
		  <th>Jumlah Kursi</th>
		  <th width="150">Aksi</th>
		</tr>
	@stop	

	@section('content_table_body')
		{{--*/$no =1/*--}}
	
		  @foreach($data as $val)

		  <tr>
		  		<td>{{ $no++ }}</td>
				<td>{{ ucwords(strtolower($val->jenisKursi ['jenis_kursi_value']))?:'-' }}</td>
				<td>{{ ucwords(strtolower(isset($val->jumlah_kursi)?$val->jumlah_kursi:'-'))?:'-' }}</td>
			<td>			

				<div onclick="actionEdit({{json_encode($val)}})" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
					<i class="fa fa-edit"></i>
				</div>
				<a href="{{url().'/master/hapus_kursi/'.$val->kursi_id}}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
					<i class="fa fa-trash">

					</i>
				</a>
			</td>
		  </tr>
		  @endforeach
	@stop
	@section('content_action_edit_func')
		jQuery("#modal-input-generik").modal('show');
		console.log(obj)

		jQuery("#jumlah-kursi").val(obj.jumlah_kursi)
		jQuery("#jenis-kursi").val(obj.jenis_kursi_id)
		jQuery('#form-input-generik').attr('action',"{{url()}}/master/edit_kursi/"+obj.kursi_id);
	@stop
	@section('content_action_add_func')
		jQuery("#modal-input-generik").modal('show');
		console.log(jQuery("#modal-input-generik"))
		jQuery('#form-input-generik').attr('action',"{{url()}}/master/tambah_kursi");
	@stop
	@include('main.input.section_content_generik')
	@include('main.input.section_modal_generik')

@stop
