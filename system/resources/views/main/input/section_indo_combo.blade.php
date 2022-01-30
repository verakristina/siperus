 @if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
		{{--*/ $statusProvinsi = 'hide' /*--}}
	@elses
		{{--*/ $statusProvinsi = 'show' /*--}}
@endif
<div class="form-group col-md-12 {{ (session('idRole') == 3)?$statusProvinsi:'' }}" style="display:@yield('indo_combo_prov','none')">
	<label for="provinsi" class="col-md-3 col-sm-12 col-xs-12">Provinsi</label>
	<div class="col-md-9 col-sm-12 col-xs-12">
		<select name="provinsi" id="prov2" class="form-control custom-field-litle"  >
				<option selected disabled value="" class="text-hide">--- Pilih Provinsi ---</option>
				@foreach($provinsi as $tmp)
					<option value="{{$tmp->geo_prov_id}}" @if($tmp->geo_prov_id==$selected[0]) selected @endif>{{$tmp->geo_prov_nama}}</option>
				@endforeach
		</select>
	</div>
</div>
<div class="form-group col-md-12" style="display:@yield('indo_combo_kab','none')">
	<label for="kabupaten" class="col-md-3 col-sm-12 col-xs-12">Kabupaten</label>
	<div class="col-md-9 col-sm-12 col-xs-12">
		<select name="kabupaten" id="kab2" class="form-control custom-field-litle" >
				<option selected  disabled class="text-hide">--- Kabupaten ---</option>
				@if($selected[1])
					@foreach($kabupaten as $tmp)
						<option value="{{$tmp->geo_kab_id}}" @if($tmp->geo_kab_id==$selected[1]) selected @endif>{{$tmp->geo_kab_nama}}</option>
					@endforeach
				@endif
				
		</select>
	</div>
</div>
<div class="form-group col-md-12" style="display:@yield('indo_combo_kec','none')">
	<label for="kecamatan" class="col-md-3 col-sm-12 col-xs-12">Kecamatan</label>
	<div class="col-md-9 col-sm-12 col-xs-12">
		<select name="kecamatan" id="kec2" class="form-control custom-field-litle" >
				<option selected disabled class="text-hide">--- Kecamatan ---</option>
				@if($selected[2])
					@foreach($kecamatan as $tmp)
						<option value="{{$tmp->geo_kec_id}}" @if($tmp->geo_kec_id==$selected[2]) selected @endif>{{$tmp->geo_kec_nama}}</option>
					@endforeach
				@endif
		</select>
	</div>
</div>
<div class="form-group col-md-12" style="display:@yield('indo_combo_kel','none')">
	<label for="desakelurahan" class="col-md-3 col-sm-12 col-xs-12">Desa/Kelurahan</label>
	<div class="col-md-9 col-sm-12 col-xs-12">
		<select name="desakelurahan" id="kel2" class="form-control custom-field-litle" >
				<option selected disabled class="text-hide">--- desa/kelurahan ---</option>
				@if($selected[3])
					@foreach($kelurahan as $tmp)
						<option value="{{$tmp->geo_deskel_id}}" @if($tmp->geo_deskel_id==$selected[3]) selected @endif>{{$tmp->geo_deskel_nama}}</option>
					@endforeach
				@endif
		</select>
	</div>
</div>
<div class="form-group col-md-12" style="display:@yield('indo_combo_rw','none')">
	<label for="rukunwarga" class="col-md-3 col-sm-12 col-xs-12 col-sm-12 col-xs-12">Rukun Warga</label>
	<div class="col-md-9 col-sm-12 col-xs-12">
		<select name="rukunwarga" id="kel2" class="form-control custom-field-litle" >
				<option selected disabled class="text-hide">--- rw ---</option>
				@if($selected[4])
					@foreach($rukunwarga as $tmp)
						<option value="{{$tmp->geo_rw_id}}" @if($tmp->geo_rw_id==$selected[4]) selected @endif>{{$tmp->geo_rw_nama}}</option>
					@endforeach
				@endif
		</select>
	</div>
</div>
<div class="form-group col-md-12" style="display:@yield('indo_combo_rt','none')">
	<label for="rukunwarga" class="col-md-3 col-sm-12 col-xs-12 col-sm-12 col-xs-12">Rukun Tetangga</label>
	<div class="col-md-9 col-sm-12 col-xs-12">
		<select name="rukunwarga" id="kel2" class="form-control custom-field-litle" >
				<option selected disabled class="text-hide">--- rt ---</option>
				@if(@$selected[5])
					@foreach($rukuntetangga as $tmp)
						<option value="{{$tmp->geo_rt_id}}" @if($tmp->geo_rt_id==@$selected[5]) selected @endif>{{$tmp->geo_rt_nama}}</option>
					@endforeach
				@endif
		</select>
	</div>
</div>
<div class="form-group col-md-12" style="display:@yield('indo_combo_dapil','none')">
	<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Nama Dapil</label>
	<div class="col-md-9 col-sm-12 col-xs-12">
		<select name="dapil" id="dapil" class="form-control">
			<option value="">--- Dapil ---</option>
		</select>
	</div>
</div>
