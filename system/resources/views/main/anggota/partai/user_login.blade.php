@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Data Pengurus DPD ')

	@section('modal_struk_tipe','DPD')
	@section('struk_tipe_menu','Data Pengurus')
	@section('struk_tipe_sub_menu','DPD')
	@section('struk_tipe_box_header','List DPD')

	@section('content_action_tambah','user_management/user')
	@section('content_action_edit','user_management/user')

	@section('goto_prov')
		location.href="{{url()}}/data_pengurus/dpd/"+provId;
	@stop
	 
	@section('content_table_header')
		<tr>
		  <th>No</th>
		  <th>Daerah</th>
		  <th>Username</th>
		  <th>Password</th>
		  <th>Nama</th>
		  <th>Akses</th>
		  <th>Aksi</th>
		</tr>
	@stop	

	@section('content_table_body')
		{{--*/$no =1/*--}}
		{{--*/$bio_xxx_id='bio_dpd_id'/*--}}
		{{--*/$type='dpd'/*--}}
		  @foreach($dataUser as $val)
		   {{--*/

		  	$obj='username:"'.$val->username.
		  	'",password:"'.$val->password.
			'",role:"'.$val->role.
			'",geo_prov_id:"'.$val->geo_prov_id.'"'

		  	/*--}}
		  @include('main.user.include.section_generik_content')
		  <tr>
		  <td>{{ $no++ }}</td>
			@yield('table_data')		
			@yield('table_action')
		  </tr>
		  @endforeach
		  
	@stop
	<script src="{{asset('asset/js/moment.js')}}"></script>
	@section('content_action_edit_func')
		if(obj.role != 1) {
			$('#formProv').removeClass('none');
		} else {
			$('#formProv').addClass('none');
		}
		
		$("#username").val(obj.username)
		$("#password").val(obj.password)
		$("#aksesLogin").val(obj.role)
		$("#aksesProvinsi").val(obj.geo_prov_id)
	@stop
	@include('main.user.include.section_content_struktur')
	@include('main.user.include.section_modal_struktur')
	
@stop
