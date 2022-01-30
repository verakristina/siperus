@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	<script type="text/javascript" src="{{ asset('asset/plugins/chartjs/chart.js')}}"></script>
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
	


	@section('usecanvas','block')
	<script type="text/javascript">
		
	@section('chart-data')
		/*{
     		label:"Jumlah DPC",
     		data:[ @foreach($test as $row)
     				
     					{{$row->jml?:1}},
     			
		       		 	@endforeach
					12],
     			
     		backgroundColor: 'rgba(255,0,0,0.5)',
            borderColor:'rgba(255,0,0,1)',
            borderWidth: 1,
            hidden:false,
     	}*/
	@stop
	</script>
	@include('main.input.section_chart_script')
	
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

		  	$obj='provId:'.$val->geo_prov_id.
		  	',noSk:"'.$val->no_sk2.
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


	@section('content_action_edit_func')
		$('#prov2').val(obj.provId)
		$("#no_sk").val(obj.noSk)
		$("#date").val(moment(obj.turunSK).format('DD-MM-YYYY'))
	@stop

	@section('content_action_add_func')
		
	@stop
	@include('main.input.section_content_struktur')
	@include('main.input.section_modal_struktur')

	
@stop
