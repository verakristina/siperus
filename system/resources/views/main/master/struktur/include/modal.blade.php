@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
	{{--*/ $statusProvinsi = 'hide' /*--}}
@elseif(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 4)
	{{--*/ $statusProvinsi = 'hide' /*--}}
	{{--*/ $statusKabupaten = 'hide' /*--}}
@else
	{{--*/ $statusKabupaten = 'show' /*--}}
	{{--*/ $statusProvinsi = 'show' /*--}}
@endif

<div class="modal primary" id="modalStruktur" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form id="formModalStruktur" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
					<div class="row" style="display:@yield('modal_prov','none')">
						<div class="form-group col-md-12 {{ (session('idRole') == 3)?$statusProvinsi:(session('idRole') == 4)?$statusProvinsi:'' }}">
							<label for="nama" class="col-md-4">Nama Provinsi</label>
							<div class="col-md-8">
								<select name="id_prov" id="id_prov" class="form-control">
									@foreach($dataProv as $tmp)
										<option value="{{$tmp->geo_prov_id}}" {{ ($tmp->geo_prov_id == session("idProvinsi2") || $tmp->geo_prov_id == @$selected[0] || $tmp->geo_prov_id == @$prov)?"selected":"non-selected" }}>{{$tmp->geo_prov_nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:@yield('modal_kab','none')">
						<div class="form-group col-md-12 {{ (session('idRole') == 4)?$statusKabupaten:'' }}">
							<label for="nama" class="col-md-4">Nama Kabupaten</label>
							<div class="col-md-8">
								<select name="id_kab" id="id_kab" class="form-control">
									<option value="">--- Kabupaten ---</option>
									@if(@$selected[0])
										@foreach($dataKab as $tmp)		
											<option value="{{ $tmp->geo_kab_id }}">{{ $tmp->geo_kab_nama }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:@yield('modal_kec','none')">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kecamatan</label>
							<div class="col-md-8">
								<select name="id_kec" id="id_kec" class="form-control">
									<option value="">--- Kecamatan ---</option>
									@if(@$selected[1])
										@foreach($dataKec as $tmp)		
											<option value="{{ $tmp->geo_kec_id }}">{{ $tmp->geo_kec_nama }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:@yield('modal_kel','none')">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kelurahan</label>
							<div class="col-md-8">
								<select name="id_kel" id="id_kel" class="form-control">
									<option value="">--- Kelurahan ---</option>
									@if(@$selected[2])
										@foreach($dataKel as $tmp)		
											<option value="{{ $tmp->geo_deskel_id }}">{{ $tmp->geo_deskel_nama }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:@yield('modal_rw','none')">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama RW</label>
							<div class="col-md-8">
								<select name="id_rw" id="id_rw" class="form-control">
									<option value="">--- RW ---</option>
									@if(@$selected[3])
										@foreach($dataRW as $tmp)		
											<option value="{{ $tmp->geo_rw_id }}">{{ $tmp->geo_rw_nama }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:@yield('modal_rt','none')">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama RT</label>
							<div class="col-md-8">
								<select name="id_rt" id="id_rt" class="form-control">
									<option value="">--- RT ---</option>
									@if(@$selected[4])
										@foreach($dataRT as $tmp)		
											<option value="{{ $tmp->geo_rt_id }}">{{ $tmp->geo_rt_nama }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:inline">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Struktur @yield('struktur')</label>
							<div class="col-md-8">
								<input type="text" name="nama_struktur" id="nama_struktur" class="form-control" placeholder="Nama Struktur @yield('struktur')">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger"  id="btnSubmit">Simpan</button>
				</div>
			</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
	</div>
</div>

<div class="modal primary" id="modalStrukturEdit" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form id="formModalStrukturEdit" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Edit Struktur KPA</h4>
				</div>
				<div class="modal-body">
					<div class="row {{ (session('idRole') == 3)?$statusProvinsi:(session('idRole') == 4)?$statusProvinsi:'' }}" style="display:@yield('modal_prov','none')">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Provinsi</label>
							<div class="col-md-8">
								<select name="edit_id_prov" id="edit_id_prov" class="form-control">
									<option value="">--- Provinsi ---</option>
									@foreach($dataProv as $tmp)
										<option value="{{$tmp->geo_prov_id}}">{{$tmp->geo_prov_nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row {{ (session('idRole') == 4)?$statusKabupaten:'' }}" style="display:@yield('modal_kab','none')">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kabupaten</label>
							<div class="col-md-8">
								<select name="edit_id_kab" id="edit_id_kab" class="form-control">
									<option value="">--- Kabupaten ---</option>
									@foreach($dataKab as $tmp)		
										<option value="{{ $tmp->geo_kab_id }}">{{ $tmp->geo_kab_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:@yield('modal_kec','none')">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kecamatan</label>
							<div class="col-md-8">
								<select name="edit_id_kec" id="edit_id_kec" class="form-control">
									<option value="">--- Kecamatan ---</option>
									@foreach($dataKec as $tmp)		
										<option value="{{ $tmp->geo_kec_id }}">{{ $tmp->geo_kec_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:@yield('modal_kel','none')">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Kelurahan</label>
							<div class="col-md-8">
								<select name="edit_id_kel" id="edit_id_kel" class="form-control">
									<option value="">--- Kelurahan ---</option>
									@foreach($dataKel as $tmp)		
										<option value="{{ $tmp->geo_deskel_id }}">{{ $tmp->geo_deskel_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:@yield('modal_rw','none')">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama RW</label>
							<div class="col-md-8">
								<select name="edit_id_rw" id="edit_id_rw" class="form-control">
									<option value="">--- RW ---</option>
									@foreach($dataRW as $tmp)		
										<option value="{{ $tmp->geo_rw_id }}">{{ $tmp->geo_rw_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:@yield('modal_rt','none')">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama RT</label>
							<div class="col-md-8">
								<select name="edit_id_rt" id="edit_id_rt" class="form-control">
									<option value="">--- RT ---</option>
									@foreach($dataRT as $tmp)		
										<option value="{{ $tmp->geo_rt_id }}">{{ $tmp->geo_rt_nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="display:inline">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Struktur @yield('struktur')</label>
							<div class="col-md-8">
								<input type="text" name="edit_id_struk" id="edit_id_struk" class="form-control hide" placeholder="Nama Struktur @yield('struktur')">
								<input type="text" name="edit_nama_struk" id="edit_nama_struk" class="form-control" placeholder="Nama Struktur @yield('struktur')">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger"  id="btnSubmit">Simpan</button>
				</div>
			</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
	</div>
</div>