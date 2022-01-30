@extends('main.layout.layout')
@section('content')
	<script type="text/javascript" src="{{asset('asset/js/jquery-3.1.1.js ')}}"></script>
	<script type="text/javascript" src="{{asset('asset/js/AhmadApp.js ')}}"></script>
	@section('title-page','Verifikasi')


	@section('menu','Verifikasi<small>List</small>')
	@section('box-header-dpd','List Verifikasi PIMDA')
	@section('box-header-dpc','List Verifikasi PIMCAB')
	
	@section('action-tambah','actions/verifikasi')
	@section('action-edit','actions/verifikasi/')
	
	@section('content-filter')
		@section('indo_combo_fprov','initial')
		@include('main.input.section_indo_filter_combo')
	@stop
	@section('goto_prov')
		location.href="{{ asset('verifikasi') }}/"+provId;
	@stop
	
	@section('table-header-dpd')
		<style type="text/css">
			th {
				text-align: left !important;
			}
		</style>
		<tr>
			<th>No</th>
			<th>DPD</th>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>6</th>
			<th>7</th>
			<th>8</th>
			<th>9</th>
			<th>10</th>
			<th>11</th>
			<th>12</th>
			<th>13</th>
			<th>14</th>
			<th>15</th>
			<th>Action</th>
		</tr>
	@stop	

	@section('table-body-dpd')
		{{--*/$no =1/*--}}
		{{--*/$bio_xxx_id='bio_dpd_id'/*--}}
		{{--*/$type='dpd'/*--}}
		  @foreach($dataDPD as $val)
		   <?php
		  	$obj='ver_id:"'.$val->verifikasi_id.
		  	'",ver_nama:"'.$val->verifikasi_nama.
		  	'",ver_status_kantor:"'.$val->verifikasi_status_kantor.
		  	'",ver_alamat:"'.$val->verifikasi_alamat_kantor.
		  	'",ver_ibukota:"'.$val->verifikasi_ibukota.
		  	'",ver_keaktifan:"'.$val->verifikasi_keaktifan_pengurus.
		  	'",ver_perempuan:"'.$val->verifikasi_perempuan.
		  	'",ver_jumlah:"'.$val->verifikasi_jumlah_kta.
		  	'",ver_ruang_kerja_k:"'.$val->verifikasi_ruang_kerja_k.
		  	'",ver_ruang_kerja_s:"'.$val->verifikasi_ruang_kerja_s.
		  	'",ver_ruang_kerja_b:"'.$val->verifikasi_ruang_kerja_b.
		  	'",ver_staf:"'.$val->verifikasi_staf_admin.
		  	'",ver_papan:"'.$val->verifikasi_papan_nama.
		  	'",ver_pres:"'.$val->verifikasi_preswapres.
		  	'",ver_garuda:"'.$val->verifikasi_garuda.
			'",ver_ketum:"'.$val->verifikasi_ketum_sekjen.
		  	'",ver_nomer:"'.$val->verifikasi_nomer_rekening.'"';

		  	?>
		  @include('main.verifikasi.include.content-table')
		  <tr>
		  <td>{{ $no++ }}</td>
			@yield('table_data')		
			@yield('table_action')
		  </tr>
		  @endforeach
	@stop
	
	@section('content_action_edit_func')
		$("#namaDPC").val(obj.ver_nama)
		$("#alamatKantor").val(obj.ver_alamat)
		$("#jumlahKTA").val(obj.ver_jumlah)
		$("#nomerRekening").val(obj.ver_nomer)

		if(obj.ver_status_kantor == '1') {
			$("#statusKantor1").attr('checked',true);
		} else if(obj.ver_status_kantor == '2') {
			$("#statusKantor0").attr('checked',true);
		} else {
			/* $("#statusKantor1").attr('checked',false);
			$("#statusKantor0").attr('checked',false); */
		}

		$("input[id=statusKantor"+obj.ver_status_kantor+"]").attr('checked',true);
		
		if(obj.ver_staf == '1')
			$("#stafAdmin1").attr('checked',true);
		if(obj.ver_staf == '0')
			$("#stafAdmin0").attr('checked',true);
		
		if(obj.ver_ibukota == '1')
				$("#ibukota1").attr('checked',true);
		if(obj.ver_ibukota == '0')
				$("#ibukota0").attr('checked',true);

		if(obj.ver_keaktifan == '1')
			$("#keaktifanPengurus1").attr('checked',true);
		if(obj.ver_keaktifan == '0')
			$("#keaktifanPengurus0").attr('checked',true);

		if(obj.ver_perempuan == '1')
			$("#perempuan1").attr('checked',true);
		if(obj.ver_perempuan == '0')
			$("#perempuan0").attr('checked',true);

		if(obj.ver_ruang_kerja_k == '1')
			$("#ruangKerjak").attr('checked',true);
		if(obj.ver_ruang_kerja_s == '1')
			$("#ruangKerjas").attr('checked',true);
		if(obj.ver_ruang_kerja_b == '1')
			$("#ruangKerjab").attr('checked',true);

		if(obj.ver_ruang_kerja_k == '0')
			$("#ruangKerjak").attr('checked',false);
		if(obj.ver_ruang_kerja_s == '0')
			$("#ruangKerjas").attr('checked',false);
		if(obj.ver_ruang_kerja_b == '0')
			$("#ruangKerjab").attr('checked',false);

		if(obj.ver_papan == '1')
			$("#papanNama1").attr('checked',true);
		if(obj.ver_papan == '0')
			$("#papanNama0").attr('checked',true);

		if(obj.ver_pres == '1')
			$("#presWaPres").attr('checked',true);
		if(obj.ver_garuda == '1')
			$("#garuda").attr('checked',true);
		if(obj.ver_ketum == '1')
			$("#ketumSekjen").attr('checked',true);

		if(obj.ver_pres == '0')
			$("#presWaPres").attr('checked',false);
		if(obj.ver_garuda == '0')
			$("#garuda").attr('checked',false);
		if(obj.ver_ketum == '0')
			$("#ketumSekjen").attr('checked',false);
	@stop
	
	@section('table-header-dpc')
		<style type="text/css">
			tr>th {
				text-align: center;
			}
		</style>
		<tr>
			<th>No</th>
			<th>DPC</th>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>6</th>
			<th>7</th>
			<th>8</th>
			<th>9</th>
			<th>10</th>
			<th>11</th>
			<th>12</th>
			<th>13</th>
			<th>14</th>
			<th>15</th>
			<th>Action</th>
		</tr>
	@stop	

	@section('table-body-dpc')
		{{--*/$no =1/*--}}
		{{--*/$bio_xxx_id='bio_dpd_id'/*--}}
		{{--*/$type='dpd'/*--}}
		  @foreach($dataDPC as $val)
		   <?php
		  	$obj='ver_id:"'.$val->verifikasi_id.
		  	'",ver_nama:"'.$val->verifikasi_nama.
		  	'",ver_status_kantor:"'.$val->verifikasi_status_kantor.
		  	'",ver_alamat:"'.$val->verifikasi_alamat_kantor.
		  	'",ver_ibukota:"'.$val->verifikasi_ibukota.
		  	'",ver_keaktifan:"'.$val->verifikasi_keaktifan_pengurus.
		  	'",ver_perempuan:"'.$val->verifikasi_perempuan.
		  	'",ver_jumlah:"'.$val->verifikasi_jumlah_kta.
		  	'",ver_ruang_kerja_k:"'.$val->verifikasi_ruang_kerja_k.
		  	'",ver_ruang_kerja_s:"'.$val->verifikasi_ruang_kerja_s.
		  	'",ver_ruang_kerja_b:"'.$val->verifikasi_ruang_kerja_b.
		  	'",ver_staf:"'.$val->verifikasi_staf_admin.
		  	'",ver_papan:"'.$val->verifikasi_papan_nama.
		  	'",ver_pres:"'.$val->verifikasi_preswapres.
		  	'",ver_garuda:"'.$val->verifikasi_garuda.
			'",ver_ketum:"'.$val->verifikasi_ketum_sekjen.
		  	'",ver_nomer:"'.$val->verifikasi_nomer_rekening.'"';

		  	?>
		  @include('main.verifikasi.include.content-table')
		  <tr>
		  <td>{{ $no++ }}</td>
			@yield('table_data')		
			@yield('table_action')
		  </tr>
		  @endforeach
	@stop
	
	<script src="{{asset('asset/js/moment.js')}}"></script>
	@section('content_action_edit_func')
		$("#namaDPC").val(obj.ver_nama)
		$("#alamatKantor").val(obj.ver_alamat)
		$("#jumlahKTA").val(obj.ver_jumlah)
		$("#nomerRekening").val(obj.ver_nomer)

		if(obj.ver_status_kantor == '1')
			$("#statusKantor1").attr('checked',true);
		if(obj.ver_status_kantor == '0')
			$("#statusKantor0").attr('checked',true);
		
		if(obj.ver_staf == '1')
			$("#stafAdmin1").attr('checked',true);
		if(obj.ver_staf == '0')
			$("#stafAdmin0").attr('checked',true);
		
		if(obj.ver_ibukota == '1')
				$("#ibukota1").attr('checked',true);
		if(obj.ver_ibukota == '0')
				$("#ibukota0").attr('checked',true);
		if(obj.ver_keaktifan == '1')
			$("#keaktifanPengurus1").attr('checked',true);
		if(obj.ver_keaktifan == '0')
			$("#keaktifanPengurus0").attr('checked',true);

		if(obj.ver_perempuan == '1')
			$("#perempuan1").attr('checked',true);
		if(obj.ver_perempuan == '0')
			$("#perempuan0").attr('checked',true);

		if(obj.ver_ruang_kerja_k == '1')
			$("#ruangKerjak").attr('checked',true);
		if(obj.ver_ruang_kerja_s == '1')
			$("#ruangKerjas").attr('checked',true);
		if(obj.ver_ruang_kerja_b == '1')
			$("#ruangKerjab").attr('checked',true);

		if(obj.ver_ruang_kerja_k == '0')
			$("#ruangKerjak").attr('checked',false);
		if(obj.ver_ruang_kerja_s == '0')
			$("#ruangKerjas").attr('checked',false);
		if(obj.ver_ruang_kerja_b == '0')
			$("#ruangKerjab").attr('checked',false);

		if(obj.ver_papan == '1')
			$("#papanNama1").attr('checked',true);
		if(obj.ver_papan == '0')
			$("#papanNama0").attr('checked',true);

		if(obj.ver_pres == '1')
			$("#presWaPres").attr('checked',true);
		if(obj.ver_garuda == '1')
			$("#garuda").attr('checked',true);
		if(obj.ver_ketum == '1')
			$("#ketumSekjen").attr('checked',true);

		if(obj.ver_pres == '0')
			$("#presWaPres").attr('checked',false);
		if(obj.ver_garuda == '0')
			$("#garuda").attr('checked',false);
		if(obj.ver_ketum == '0')
			$("#ketumSekjen").attr('checked',false);
	@stop
	
	@include('main.verifikasi.include.content-body')
	@include('main.verifikasi.include.modal')
	@include('main.verifikasi.include.modal-detail')
@stop
