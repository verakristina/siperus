
@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
		{{--*/ $statusProvinsi = 'hide' /*--}}
	@else
		{{--*/ $statusProvinsi = 'show' /*--}}
@endif
<div class="col-md-2 col-sm-4 col-xs-6 {{ (session('idRole') == 3)?$statusProvinsi:'' }}" style="display:@yield('indo_combo_fprov','none')">
		<select class="form-control custom-field-litle" id="prov" name="prov" >
			<option disabled selected >--- Provinsi ---</option>

				@foreach($provinsi as $tmp)
					<option value="{{$tmp->geo_prov_id}}" @if($tmp->geo_prov_id==$selected[0]) selected @endif>{{$tmp->geo_prov_nama}}</option>
				@endforeach
			
		</select>
</div>
<div class="col-md-2 col-sm-4 col-xs-6" style="display:@yield('indo_combo_fkab','none')">
	<select class="form-control custom-field-litle" id="kab" name="kab" >
		<option disabled selected >--- Kabupaten ---</option>
			@if($selected[0])
				@foreach($kabupaten as $tmp)
					<option value="{{$tmp->geo_kab_id}}" @if($tmp->geo_kab_id==$selected[1]) selected @endif>{{$tmp->geo_kab_nama}}</option>
				@endforeach
			@endif
	</select>
</div>
<div class="col-md-2 col-sm-4 col-xs-6" style="display:@yield('indo_combo_fkec','none')">
	<select class="form-control custom-field-litle" id="kec" name="kec" >
		<option value="" selected >--- Kecamatan ---</option>
			@if($selected[2])
				@foreach($kecamatan as $tmp)
					<option value="{{$tmp->geo_kec_id}}" @if($tmp->geo_kec_id==$selected[2]) selected @endif>{{$tmp->geo_kec_nama}}</option>
				@endforeach
			@endif
	</select>
</div>
<div class="col-md-2 col-sm-4 col-xs-6" style="display:@yield('indo_combo_fkel','none')">
	<select class="form-control custom-field-litle" id="kel" name="kel" >
		<option value="" selected >--- desa/kelurahan ---</option>
			@if($selected[3])
				@foreach($kelurahan as $tmp)
					<option value="{{$tmp->geo_deskel_id}}" @if($tmp->geo_deskel_id==$selected[3]) selected @endif>{{$tmp->geo_deskel_nama}}</option>
				@endforeach
			@endif
	</select>
</div>
<div class="col-md-2 col-sm-4 col-xs-6" style="display:@yield('indo_combo_frw','none')">
	<select class="form-control custom-field-litle" id="rw" name="rw" >
		<option value=""  selected >--- rw ---</option>
			@if($selected[4])
				@foreach($rukunwarga as $tmp)
					<option value="{{$tmp->geo_rw_id}}" @if($tmp->geo_rw_id==$selected[4]) selected @endif>{{$tmp->geo_rw_nama}}</option>
				@endforeach
			@endif
	</select>
</div>
<div class="col-md-2 col-sm-4 col-xs-6" style="display:@yield('indo_combo_frt','none')">
	<select class="form-control custom-field-litle" id="rw" name="rw" >
		<option value=""  selected >--- rt ---</option>
			@if(@$selected[5])
				@foreach($rukuntetangga as $tmp)
					<option value="{{$tmp->geo_rt_id}}" @if($tmp->geo_rt_id==@$selected[5]) selected @endif>{{$tmp->geo_rt_nama}}</option>
				@endforeach
			@endif
	</select>
</div>

<div class="col-md-2 col-sm-4 col-xs-6" style="display:@yield('indo_combo_fdpp','none')">
	<selct class="form-group">
		<label>Cari Berdasarkan</label>
		<select name="search_by" id="search-by" class="form-control">
			<option value="">--SELECT--</option>
			<option value="nama">Nama</option>
			<option value="jabatan">Jabatan</option>
			<option value="no_kta">Nomor KTA</option>
			<option value="no_ktp">Nomor KTP</option>
			<option value="no_sk">Nomor SK</option>
		</select>
	</selct>
</div>
<div class="col-md-4 col-sm-4 col-xs-6" style="display:@yield('indo_combo_fdpp','none')">
	<selct class="form-group">
		<label>Kata Kunci</label>
		<input type="text" class="form-control" name="keyword">
	</selct>
</div>
<div class="col-md-1" style="display:@yield('indo_combo_fdpp','none')">
	<button class="btn btn-danger" id="btn-search-dpp" style="margin-top: 25px">
		<i class="fa fa-search"></i>
	</button>
</div>