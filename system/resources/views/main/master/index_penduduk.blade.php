@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>

	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Penduduk ')

	@section('modal_struk_tipe','Penduduk')
	@section('tipe_menu','Data Master')
	@section('tipe_sub_menu','Penduduk')
	@section('struk_tipe_box_header','List Penduduk')
	@section('title_tipe','Penduduk')

	@section('modal_input')
		@section('indo_combo_prov','initial')
		@section('indo_combo_kab','initial')
		@include('main.input.section_indo_combo')
		
		<div class="form-group col-md-12" >
			<label for="provinsi" class="col-md-3 col-sm-12 col-xs-12">Jumlah Penduduk</label>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<input id="jumlah-penduduk" type="text" name="penduduk_jumlah" class="form-control" data-bind="value:replyNumber">
			</div>
		</div>
	@stop

	@section('content_filter_combo')
		@section('indo_combo_fprov','initial')
		@section('indo_combo_fkab','initial')
		@include('main.input.section_indo_filter_combo')
	@stop

	@section('content_script')

		@include('main.input.section_script_wilayah_generik')
	@stop
	@section('content_action_tambah','master/tambah_penduduk')
	@section('content_action_edit','master/edit_penduduk')

	@section('goto_kab')
	location.href="{{url()}}/master/penduduk/"+provId+"/"+kabId;
	@stop

	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Jumlah Penduduk</th>
		  <th width="150">Aksi</th>
		</tr>
	@stop	

	@section('content_table_body')
		{{--*/$no =1/*--}}
	
		  @foreach($data as $val)

		  <tr>
		  		<td>{{ $no++ }}</td>
				<td>{{ ucwords(strtolower(isset($val->penduduk_jumlah)?$val->penduduk_jumlah:'-'))?:'-' }}</td>
			<td>			

				<div onclick="actionEdit({{json_encode($val)}})" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
					<i class="fa fa-edit"></i>
				</div>
				<a href="{{url().'/master/hapus_penduduk/'.$val->penduduk_id}}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
					<i class="fa fa-trash">

					</i>
				</a>
			</td>
		  </tr>
		  @endforeach
	@stop
	<script type="text/javascript">
	@section('content_action_edit_func')
		jQuery("#modal-input-generik").modal('show');
		console.log(obj)

		jQuery("#jumlah-penduduk").val(obj.penduduk_jumlah)
		jQuery('#form-input-generik').attr('action',"{{url()}}/master/edit_penduduk/"+obj.penduduk_id);
	@stop
	@section('content_action_add_func')
		jQuery("#modal-input-generik").modal('show');
		console.log(jQuery("#modal-input-generik"))
		jQuery('#form-input-generik').attr('action',"{{url()}}/master/tambah_penduduk");
	@stop
	</script>
	@include('main.input.section_content_generik')
	@include('main.input.section_modal_generik')


@stop
