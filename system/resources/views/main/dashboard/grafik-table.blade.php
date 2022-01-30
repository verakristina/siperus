@extends('main.layout.layout')

@section('title-page','Dashboard')

@section('main-sidebar')
@endsection

@section('content')

<div class="modal primary fade" id="modal-grafik" role="dialog" aria-labelledby="barangbuktiModalLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="" id="form-input-struk" name="barangbuktiform" enctype="multipart/form-data" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="my-modal-label">DATA GRAFIK</h4>
				</div>
				<div class="modal-body" id="tabel-grafik">
				</div>
			</div>
		</form>
	</div>
</div>

<div class="content-wrapper min-height" style="min-height:1px;">
	<section class="content-header">
	  <h1>
		Dashboard
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	  </ol>
	</section>

	<section class="content">
	  <div class="page-ajax"> 
	  <div class="row">
		<div class="col-md-12">
		  <div class="panel">
			<div class="box-header with-border">
				<span class="title-header">Data Grafik {{ strtoupper($type) }}</span>
			</div>
				   <div class="response-cari">
					  {{--*/ $no=1 /*--}}
						<div class="box-body"> 
							<div class="row">
								@if($type != 'dpd' && $type != 'dprri' && $type != 'dprdi' && $type != 'dprdii')
									<div class="col-md-2 col-sm-4 col-xs-6" style="display:{{ ($prov)?'initial':'initial' }}">
										<select class="form-control custom-field-litle" id="prov" name="prov" onchange="changeProv(this.value)">
											<option value="" selected >--- Provinsi ---</option>
											@foreach($masterProvinsi as $tmp)
												<option value="{{$tmp->geo_prov_id}}" @if($tmp->geo_prov_id==$prov) selected @endif>{{$tmp->geo_prov_nama}}</option>
											@endforeach
										</select>
									</div>
								@endif
								@if($filterKab)
									<div class="col-md-2 col-sm-4 col-xs-6">
										<select class="form-control custom-field-litle" id="kab" name="kab" onchange="changeKab(this.value)">
											<option value=""  selected >--- Kabupaten ---</option>
											@if($selected[1])
												@foreach($masterKabupaten as $tmp)
													<option value="{{$tmp->geo_kab_id}}" {{ ($selected[1] == $tmp->geo_kab_id)?'selected':'non-selected' }}>{{$tmp->geo_kab_nama}}</option>
												@endforeach
											@endif
										</select>
									</div>
								@endif
								@if($filterKec)
									<div class="col-md-2 col-sm-4 col-xs-6">
										<select class="form-control custom-field-litle" id="kec" name="kec" onchange="changeKec(this.value)">
											<option value="" selected >--- Kecamatan ---</option>		
											@if($selected[2])
												@foreach($masterKecamatan as $tmp)
													<option value="{{$tmp->geo_kec_id}}" {{ ($selected[2] == $tmp->geo_kec_id)?'selected':'non-selected' }}>{{$tmp->geo_kec_nama}}</option>
												@endforeach
											@endif
										</select>
									</div>
								@endif
								@if($filterKel)
									<div class="col-md-2 col-sm-4 col-xs-6">
										<select class="form-control custom-field-litle" id="kel" name="kel" onchange="changeKel(this.value)">
											<option value="" selected >--- Desa / Kelurahan ---</option>
											@if($selected[3])
												@foreach($masterKelurahan as $tmp)
													<option value="{{$tmp->geo_deskel_id}}" {{ ($selected[3] == $tmp->geo_deskel_id)?'selected':'non-selected' }}>{{$tmp->geo_deskel_nama}}</option>
												@endforeach
											@endif
										</select>
									</div>
								@endif
								@if($filterRW)
									<div class="col-md-2 col-sm-4 col-xs-6">
										<select class="form-control custom-field-litle" id="rw" name="rw" onchange="changeRW(this.value)">
											<option value=""  selected >--- RW ---</option>
											@if($selected[4])
												@foreach($masterRW as $tmp)
													<option value="{{$tmp->geo_rw_id}}" {{ ($selected[4] == $tmp->geo_rw_id)?'selected':'non-selected' }}>{{$tmp->geo_rw_nama}}</option>
												@endforeach
											@endif
										</select>
									</div>
								@endif
								@if($filterRT)
									<div class="col-md-2 col-sm-4 col-xs-6">
										<select class="form-control custom-field-litle" id="rt" name="rt" onchange="changeRT(this.value)">
											<option value=""  selected >--- RT ---</option>
											@if($selected[5])
												@foreach($masterRT as $tmp)
													<option value="{{$tmp->geo_rt_id}}" {{ ($selected[5] == $tmp->geo_rt_id)?'selected':'non-selected' }}>{{$tmp->geo_rt_nama}}</option>
												@endforeach
											@endif
										</select>
									</div>
								@endif
								
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-striped table-hover">
										<thead>
											<th>No</th>
											@if($type == 'dpd')
												<th>Provinsi</th>
											@elseif($type == 'dpc')
												<th>Provinsi</th>
												<th>Kabupaten</th>
											@elseif($type == 'pac')
												<th>Provinsi</th>
												<th>Kabupaten</th>
												<th>Kecamatan</th>
											@elseif($type == 'pr')
												<th>Provinsi</th>
												<th>Kabupaten</th>
												<th>Kecamatan</th>
												<th>Kelurahan</th>
											@elseif($type == 'par')
												<th>Provinsi</th>
												<th>Kabupaten</th>
												<th>Kecamatan</th>
												<th>Kelurahan</th>
												<th>RW</th>
											@elseif($type == 'kpa')
												<th>Provinsi</th>
												<th>Kabupaten</th>
												<th>Kecamatan</th>
												<th>Kelurahan</th>
												<th>RW</th>
												<th>RT</th>
											@elseif($type == 'dprri' || $type == 'dprdi' || $type == 'dprdii')
												<th>Nama Dapil</th>
											@endif
											<th>Aksi</th>
										</thead>
										<tbody  id="responseCari">
											{{--*/ $no = 1 /*--}}
											@foreach($data as $tmp)
												<tr>
													<td>{{ $page++ }}</td>
													@if($type == 'dpd')
														<td>{{ (@$provName)?@$provName:$tmp->geo_prov_nama }}</td>
														{{--*/ $link = "data_pengurus/dpd/".$tmp->geo_prov_id /*--}}
													@elseif($type == 'dpc')
														<td>{{ (@$provName)?@$provName:$tmp->geo_prov_nama }}</td>
														<td>{{ $tmp->geo_kab_nama }}</td>
														{{--*/ $link = "data_pengurus/dpc/".$tmp->geo_prov_id."/".$tmp->geo_kab_id /*--}}
													@elseif($type == 'pac')
														<td>{{ (@$provName)?@$provName:$tmp->geo_prov_nama }}</td>
														<td>{{ $tmp->geo_kab_nama }}</td>
														<td>{{ $tmp->geo_kec_nama }}</td>
														{{--*/ $link = "data_pengurus/pac/".$tmp->geo_prov_id."/".$tmp->geo_kab_id."/".$tmp->geo_kec_id /*--}}
													@elseif($type == 'pr')
														<td>{{ (@$provName)?@$provName:$tmp->geo_prov_nama }}</td>
														<td>{{ $tmp->geo_kab_nama }}</td>
														<td>{{ $tmp->geo_kec_nama }}</td>
														<td>{{ $tmp->geo_deskel_nama }}</td>
														{{--*/ $link = "data_pengurus/pr/".$tmp->geo_prov_id."/".$tmp->geo_kab_id."/".$tmp->geo_kec_id."/".$tmp->geo_deskel_id /*--}}
													@elseif($type == 'par')
														<td>{{ (@$provName)?@$provName:$tmp->geo_prov_nama }}</td>
														<td>{{ $tmp->geo_kab_nama }}</td>
														<td>{{ $tmp->geo_kec_nama }}</td>
														<td>{{ $tmp->geo_deskel_nama }}</td>
														<td>{{ $tmp->geo_rw_nama }}</td>
														{{--*/ $link = "data_pengurus/par/".$tmp->geo_prov_id."/".$tmp->geo_kab_id."/".$tmp->geo_kec_id."/".$tmp->geo_deskel_id."/".$tmp->geo_rw_id /*--}}
													@elseif($type == 'kpa')
														<td>{{ (@$provName)?@$provName:$tmp->geo_prov_nama }}</td>
														<td>{{ $tmp->geo_kab_nama }}</td>
														<td>{{ $tmp->geo_kec_nama }}</td>
														<td>{{ $tmp->geo_deskel_nama }}</td>
														<td>{{ $tmp->geo_rw_nama }}</td>
														<td>{{ $tmp->geo_rt_nama }}</td>
														{{--*/ $link = "data_pengurus/par/".$tmp->geo_prov_id."/".$tmp->geo_kab_id."/".$tmp->geo_kec_id."/".$tmp->geo_deskel_id."/".$tmp->geo_rw_id."/".$tmp->geo_rt_id /*--}}
													@elseif($type == 'dprri')
														<td>{{ $tmp->nama_dapil }}</td>
														{{--*/ $link = "data_anggota/dprri" /*--}}
													@elseif($type == 'dprdi')
														<td>{{ $tmp->nama_dapil }}</td>
														{{--*/ $link = "data_anggota/dprdi" /*--}}
													@elseif($type == 'dprdii')
														<td>{{ $tmp->nama_dapil }}</td>
														{{--*/ $link = "data_anggota/dprdii" /*--}}
													@endif
													<td><div onclick="goDetail('{{ asset(@$link) }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div></td>
												</tr>
											@endforeach
										</tbody>
									</table>
									<div class="text-center">
										{!!  str_replace('??page','&page',$data->render()) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				  </div>
			</div>
		  </div>
		</div>
	  </div>
	</section>
</div>
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script type="text/javascript">
	function changeProv(val) {
		if('{{ $type }}' == 'dpc') {
			window.location.href = '{{ asset("dashboard/table") }}/{{ $table }}/'+val;
		} else {
			changeKabupatenOptionKPU(null,'#kab',val);
		}
	}
	function changeKab(val) {
		var prov = $('#prov').val();
		if('{{ $type }}' == 'pac') {
			window.location.href = '{{ asset("dashboard/table") }}/{{ $table }}/'+prov+'/'+val;
		} else {
			changeKecamatanOptionKPU(null,'#kec',prov,val);
		}
	}
	function changeKec(val) {
		var prov = $('#prov').val();
		var kab = $('#kab').val();
		if('{{ $type }}' == 'pr') {
			window.location.href = '{{ asset("dashboard/table") }}/{{ $table }}/'+prov+'/'+kab+'/'+val;
		} else {
			changeKelurahanOptionKPU(null,'#kel',prov,kab,val);
		}
	}
	function changeKel(val) {
		var prov = $('#prov').val();
		var kab = $('#kab').val();
		var kec = $('#kec').val();
		if('{{ $type }}' == 'par') {
			window.location.href = '{{ asset("dashboard/table") }}/{{ $table }}/'+prov+'/'+kab+'/'+kec+'/'+val;
		} else {
			changeRWOptionKPU(null,'#rw',prov,kab,kec,val);
		}
	}
	function changeRW(val) {
		var prov = $('#prov').val();
		var kab = $('#kab').val();
		var kec = $('#kec').val();
		var kel = $('#kel').val();
		if('{{ $type }}' == 'kpa') {
			window.location.href = '{{ asset("dashboard/table") }}/{{ $table }}/'+prov+'/'+kab+'/'+kec+'/'+kel+'/'+val;
		} else {
			changeRTOptionKPU(null,'#rt',prov,kab,kec,kel,val);
		}
	}
	function changeRW(val) {
		var prov = $('#prov').val();
		var kab = $('#kab').val();
		var kec = $('#kec').val();
		var kel = $('#kel').val();
		var rw = $('#rw').val();
			window.location.href = '{{ asset("dashboard/table") }}/{{ $table }}/'+prov+'/'+kab+'/'+kec+'/'+kel+'/'+rw+'/'+val;
	}



	function goDetail(link) {
		window.location.href = link;
	}
	
	function cekInput(data){
		$("#search").removeClass('required');
	}
	function searchDaerah(){
		var search = $("#search").val();
		if(search) {
			window.location = "{{ route('getGrafikTabel',[$prov,$table]) }}?s="+search;
/* 			$.ajax({
				url		: "{{ route('getGrafikTabel',[$prov,$table,'data']) }}",
				type 	: "GET",
				data	: {
					'type':'data',
					's':search
				},
				success	: function(response){
					$("#responseCari").html(response);
				}
			}); */
		} else {
			$("#search").addClass('required');
		}
	}
</script>
@endsection