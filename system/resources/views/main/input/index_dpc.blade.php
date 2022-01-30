@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus DPC ')


	@section('modal_struk_tipe','DPC')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','DPC')
	@section('struk_tipe_box_header','List DPC')

	@section('modal_struk_input_tambahan')
		@section('indo_combo_prov','initial')
		@section('indo_combo_kab','initial')
		@include('main.input.section_indo_combo')
	@stop

	@section('content_filter_combo')
		@section('indo_combo_fprov','initial')
		@section('indo_combo_fkab','initial')
		@include('main.input.section_indo_filter_combo')
	@stop

	@section('content_action_tambah','tambah/dpc')
	@section('content_action_edit','edit/dpc/')

	@section('usecanvas','block')
	@section('goto_kab')
	location.href="{{url()}}/data_pengurus/dpc/"+provId+"/"+kabId;
	@stop
	@include('main.input.section_chart_script')

	<script type="text/javascript">
	$(function(){
		jQuery.ajax({
			url:'{{url()}}/data_ajx/get/bio_menjabat/pac',
			success:function(res,sts,xhr){
				var newData={	
		     		label:'Jumlah PAC',
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
	
	 
	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Jabatan</th>
		  <th>Provinsi</th>
		  <th>Kabupaten</th>
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
		{{--*/$bio_xxx_id='bio_pimcab_id'/*--}}
		{{--*/$type='dpc'/*--}}
		  @foreach($data as $val)
		  {{--*/

		  	$obj='provId:'.$val->geo_prov_id.
		  	',kabNm:"'.$val->geo_kab_nama.
		  	'",kabId:'.$val->geo_kab_id.
		  	',noSk:"'.$val->no_sk2.
		  	'",turunSK:"'.$val->turun_sk.'"'

		  	/*--}}
		  @include('main.input.section_generik_content')
		  	<tr>
			  	<td>{{ $no++ }}</td>
				<td>{{ $val->nama_jabatan?:'-'}}</td>
				<td>{{ $val->geo_prov_nama?:'-' }}</td>
				<td>{{ $val->geo_kab_nama?:'-' }}</td>
				<td>{{ $val->nama?:'-' }}</td>
				<td>{{ ($val->gender==1?'Laki-Laki':($val->gender==2?'Perempuan':'-')) }}</td>
				<td>{{ $val->no_sk2?:'-' }}</td>
				<td>{{ $val->no_kta?:'-' }}</td>
				<td>{{ $val->no_telp?:'-' }}</td>
				<td>{{ $val->email?:'-' }}</td>
				@yield('table_action')
		  </tr>
		  @endforeach
		  
	@stop
	<script src="{{asset('asset/js/moment.js')}}"></script>
	@section('content_action_edit_func')
		$('#prov2').val(obj.provId)
		$("#kab2").html('<option value="'+obj.kabId+'" selected>'+obj.kabNm+'</option>');
		$("#no_sk").val(obj.noSk)
		$("#date").val(moment(obj.turunSK).format('DD-MM-YYYY'))

	@stop
	@include('main.input.section_content_struktur')
	@include('main.input.section_modal_struktur')

	
@stop
