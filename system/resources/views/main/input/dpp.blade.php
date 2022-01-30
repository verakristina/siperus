@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus DPD ')


	@section('modal_struk_tipe','DPP')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','DPP')
	@section('struk_tipe_box_header','List DPP')

	@section('modal_struk_input_tambahan'){{--kosong--}}
	@stop

	@section('usecanvas','block')
	@include('main.input.section_chart_script')

	<script type="text/javascript">
	$(function(){
		jQuery.ajax({
			url:'{{url()}}/data_ajx/get/bio_menjabat/dpd',
			success:function(res,sts,xhr){
				var newData={	
		     		label:'Jumlah DPD',
		     		data:JSON.parse(res),
		     		backgroundColor: 'rgba(0,0,0,0.5)',
		            borderColor:'rgba(0,0,0,1)',
		            borderWidth: 1,
		            hidden:false,
		        }
				pusdatinV3chart.data.datasets.push(newData)       
				pusdatinV3chart.update();
			},

		});
	})
	</script>
	@section('content_action_tambah','tambah/dpp')
	@section('content_action_edit','edit/dpp/')
	@section('content_filter_combo')
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
		{{--*/$type='dpp'/*--}}
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