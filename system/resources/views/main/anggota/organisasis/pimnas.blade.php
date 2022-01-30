@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus PIMNAS ')


	@section('modal_struk_tipe','PIMNAS')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','PIMNAS')
	@section('struk_tipe_box_header','List PIMNAS')

	@section('sk_baru', $sk_baru)

	@section('modal_struk_input_tambahan'){{--kosong--}}@stop

	@section('content_action_tambah','tambah/pimnas')
	@section('content_action_edit','edit/pimnas/')
	@section('content_filter_combo')
		@section('indo_combo_fpimnas','initial')
		@include('main.input.section_indo_filter_combo')
	@stop

	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Jabatan</th>
		  <th>Nama</th>
		  <!-- <th>L/P</th> -->
		  <th>No.SK</th>
		  <th>No.KTA</th>
		  <th>No.KTP</th>
		  <th>No.Telp</th>
		  <!-- <th>Email</th> -->
		  <th>Aksi</th>
		</tr>
	@stop
	@section('content_table_body')
		{{--*/$no =1/*--}}
		{{--*/$type='pimnas'/*--}}
		  @foreach($data as $val)
		  {{--*/

			$obj='noSk:`'.$val->no_sk2.'`,
			turunSK:`'.$val->turun_sk.'`, 
			noHP : `'.$val->no_hp.'`,
			email : `'.$val->email.'`,
			nama_anggota : `'.$val->nama_anggota.'`'
			/*--}}
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
		$("#date").val(moment(obj.turunSK).format('DD-MM-YYYY'))
		$("#no_hp").val(obj.noHP)
		$("#email").val(obj.email)
		$("#nama_anggota").val(obj.nama_anggota)
	@stop
	@include('main.input.section_content_struktur')
	@include('main.input.section_modal_struktur')
	@include('main.anggota.partai.include.modal_detail')

@stop

@section('function')
<script>
	$('#btn-search-pimnas').on('click', function(){
		var based_on = $('#search-by').val();
		var keyword = $("[name='keyword']").val();

		/*alert(based_on+" "+keyword);*/

		window.location=("{{ asset('data_pengurus/pimnas') }}?based_on="+based_on+"&keyword="+keyword);

		/*$.ajax({
			type : "GET",
			url : "{{ asset('data_pengurus/pimnas') }}",
			data : {
				'based_on' : based_on,
				'keyword' : keyword
			},
			success:function(resp){
				$("#ahm-table").html(resp)
			},
			error:function(e){
				alert('Something Wrong!');
				console.log(e);
			}

		})*/
	})
</script>
@endsection
