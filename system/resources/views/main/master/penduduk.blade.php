@extends('main.layout.layout')
@section('content')
<script src="{{asset('asset/js/jquery-3.1.1.js')}}"></script>
<script src="{{asset('asset/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{asset('asset/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/wNumb.js ')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/lodash.js ')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/cleave.js ')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/numeral.js ')}}"></script>
	@section('title-page','Data Penduduk ')

	@section('modal_struk_tipe','Penduduk')
	@section('tipe_menu','Data Master')
	@section('tipe_sub_menu','Penduduk')
	@section('struk_tipe_box_header','List Penduduk')
	@section('title_tipe','Penduduk')
	@section('modal_name','Tambah Penduduk')

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
	@section('content_action_edit','master/edit_penduduk/')
	
	<script type="text/javascript">
	@section('goto_prov')
		if(provId)
		location.href="{{url()}}/master/penduduk/"+provId;
		else
		location.href="{{url()}}/master/penduduk";
	@stop
	@section('goto_kab')
		if(kabId)
		location.href="{{url()}}/master/penduduk/"+provId+"/"+kabId;
		else
		location.href="{{url()}}/master/penduduk/"+provId;
	@stop
	</script>
	@if(session('idRole') == 3)
			{{--*/ $statusProvinsi = 'hide' /*--}}
			{{--*/ $statusAdd = 'show' /*--}}
	@elseif(session('idRole') == 4)
			{{--*/ $statusProvinsi = 'hide' /*--}}
			{{--*/ $statusAdd = 'hide' /*--}}
	@else
			{{--*/ $statusProvinsi = 'show' /*--}}
			{{--*/ $statusAdd = 'show' /*--}}
	@endif	
	
	@section('content_table_header')
		<tr>
		  <th>No</th>
		  @if($selected[1])
		  @else
			<th>Provinsi</th>
		  @endif
		  @if($selected[1])
		  	<th>Kabupaten</th>
		  @endif
		  <th>Jumlah Penduduk</th>
		  <th width="150">Aksi</th>
		</tr>
	@stop	

	@section('content_table_body')
		{{--*/$no =1;$len=count($data) - 1/*--}}
		{{--*/$jml_tot_penduduk=0/*--}}	
		
	
		  @foreach($data as $index => $val)



		  	<tr>
		  		<td>{{ $no++ }}</td>
		  		@if($selected[1])
				@else
					<td>{{ $val->prov_nama }}</td>
				@endif
		  		@if($selected[1])
				  <td>{{ $val->kab_nama }}</td>
				@endif
				{{--*/$jml_tot_penduduk+=@$val->penduduk_jumlah/*--}}
				<td>{{ @$val->penduduk_jumlah?number_format($val->penduduk_jumlah,0, "," , "."):'-' }}</td>
			<td>
			
			
				<div onclick="detailPenduduk('{{ $status }}','{{ $val->geo_prov_id }}','{{ $val->geo_kab_id }}','{{ $val->penduduk_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>																
		  		@if($selected[1])
					<div onclick="actionEdit({{json_encode($val)}})" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
						<i class="fa fa-edit"></i>
					</div>
					<a href="{{url().'/master/hapus_penduduk/'.$val->penduduk_id}}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
						<i class="fa fa-trash"></i>
					</a>
				@endif  
				 <div onclick="printUser('{{ $val->penduduk_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
			</td>
		  </tr>
		  @if ($index == $len)
		        <tr>
		  		<td>total :</td>
		  		<td></td>
		  		@if($selected[1])
				  <td></td>
				@endif
				<td>{{ number_format($jml_tot_penduduk,0, "," , ".")}}</td>
				<td></td>
				</tr>
		    @elseif ($index == 0) 
		       
		    @endif
		  @endforeach
	@stop
	@section('content_action_edit_func')
		jQuery("#modal-input-generik").modal('show');
		console.log(obj)

		jQuery("#jumlah-penduduk").val(obj.penduduk_jumlah)
		jQuery("#kab2").val(obj.geo_kab_id)
		jQuery('#form-input-generik').attr('action',"{{url()}}/master/edit_penduduk/"+obj.penduduk_id+"/"+$('#kab2').val()+"/"+$('#jumlah-penduduk').val());
		changeFormatNumber('#jumlah-penduduk');
	@stop
	@section('content_action_add_func')
		jQuery("#modal-input-generik").modal('show');
		console.log(jQuery("#modal-input-generik"))
		jQuery('#form-input-generik').attr('action',"{{url()}}/master/tambah_penduduk");
	@stop
	@include('main.input.section_content_generik')
	@include('main.input.section_modal_generik')
	@include('main.master.include.modal-detail')
	<script type="text/javascript">
	$(function(){
		$( "#form-input-generik" ).submit(function( event ) {
				var data;
			  console.log(data= $( this ).serializeArray() );
			  event.preventDefault();
			  $.ajax({
			  	method:'GET',
			  	url:$(this).attr('action'),
			  	data:data,
			  	success:function(res){
					location.reload();
			  	}
			  })
			});
	});
	</script>
@stop
