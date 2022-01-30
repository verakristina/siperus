@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
	{{--*/ $statusProvinsi = 'hide' /*--}}
@elseif(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 4)
	{{--*/ $statusProvinsi = 'hide' /*--}}
	{{--*/ $statusKabupaten = 'hide' /*--}}
@else
	{{--*/ $statusKabupaten = 'show' /*--}}
	{{--*/ $statusProvinsi = 'show' /*--}}
@endif
<div class="col-md-2 {{ (session('idRole') == 3)?$statusProvinsi:(session('idRole') == 4)?$statusProvinsi:'' }}" style="display:@yield('filter_prov','none')">
	<select class="form-control custom-field-litle" id="prov" name="prov">
		<option>--- Provinsi ---</option>
		@foreach($dataProv as $tmp)									
			<option value="{{ $tmp->geo_prov_id }}"> {{ $tmp->geo_prov_nama }} </option>
		@endforeach
	</select>
</div>
<div class="col-md-2 {{ (session('idRole') == 4)?$statusKabupaten:'' }}" style="display:@yield('filter_kab','none')">
	<select class="form-control custom-field-litle" id="kab" name="kab">
		<option>--- Kabupaten ---</option>
	</select>
</div>
<div class="col-md-2" style="display:@yield('filter_kec','none')">
	<select class="form-control custom-field-litle" id="kec" name="kec">
		<option>--- Kecamatan ---</option>
	</select>
</div>
<div class="col-md-2" style="display:@yield('filter_kel','none')">
	<select class="form-control custom-field-litle" id="kel" name="kel" >
		<option>--- Kelurahan ---</option>
	</select>
</div>
<div class="col-md-2" style="display:@yield('filter_rw','none')">
	<select class="form-control custom-field-litle" id="rw" name="rw">
		<option>--- RW ---</option>
	</select>
</div>
<div class="col-md-2" style="display:@yield('filter_rt','none')">
	<select class="form-control custom-field-litle" id="rt" name="rt">
		<option>--- RT ---</option>
	</select>
</div>