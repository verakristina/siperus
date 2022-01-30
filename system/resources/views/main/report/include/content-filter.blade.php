
@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
		{{--*/ $statusProvinsi = 'hide' /*--}}
	@else
		{{--*/ $statusProvinsi = 'show' /*--}}
@endif
<div class="col-md-2 col-sm-4 col-xs-6 {{ (session('idRole') == 3)?$statusProvinsi:'' }}" style="display:@yield('indo_combo_fprov','none')">
		<select class="form-control custom-field-litle" id="prov" name="prov" >
			<option value="" selected >--- Provinsi ---</option>

				@foreach($provinsi as $tmp)
					<option value="{{$tmp->geo_prov_id}}" @if($statusProvinsi == 'show') @if(session('idProvinsi') == $tmp->geo_prov_id) selected @endif @endif @if($tmp->geo_prov_id==$selected[0]) selected @endif>{{$tmp->geo_prov_nama}}</option>
				@endforeach
			
		</select>
</div>
<div class="col-md-2 col-sm-4 col-xs-6" style="display:@yield('indo_combo_fkab','none')">
	<select class="form-control custom-field-litle" id="kab" name="kab" >
		<option value=""  disabled selected >--- Kabupaten ---</option>
			@if($selected[1])
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