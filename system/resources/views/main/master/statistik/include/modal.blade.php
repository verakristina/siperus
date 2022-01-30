<div class="modal primary moda-fade" id="modal-input-struk" role="dialog" aria-labelledby="tambahProvinsiLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="" id="form-input-struk" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
							{{--*/ $statusProvinsi = 'hide' /*--}}
						@else
							{{--*/ $statusProvinsi = 'show' /*--}}
						@endif
						<div class="form-group col-md-12 {{ $statusProvinsi }}">
							<label for="nama" class="col-md-4">Provinsi</label>
							<div class="col-md-8">
								<select name="provinsi" id="provinsi" class="{{ $statusProvinsi }} form-control custom-field-litle" onchange="cekData(this.value)">
									<option selected disabled class="text-hide">--- Pilih Provinsi ---</option>
									@foreach($dataProvinsi as $tmp)
										<option value="{{$tmp->geo_prov_id}}" {{ ($tmp->geo_prov_id == session('idProvinsi') && session('idRole') == 3)?'selected':'' }}>{{$tmp->geo_prov_nama}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">PIMCAB (Kabupaten/Ada)</label>
							<div class="col-md-4">
								<input type="text" name="pengurus_pimcab" id="pengurus_pimcab" class="form-control" placeholder="Pengurus DPC">
							</div>
							<div class="col-md-4">
								<input type="text" name="pengurus_pimcab_ada" id="pengurus_pimcab_ada" class="form-control" placeholder="Pengurus DPC Ada">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">PIMCAM (Kecamatan/Ada)</label>
							<div class="col-md-4">
								<input type="text" name="pengurus_pimcam" id="pengurus_pimcam" class="form-control" placeholder="Pengurus pimcam">
							</div>
							<div class="col-md-4">
								<input type="text" name="pengurus_pimcam_ada" id="pengurus_pimcam_ada" class="form-control" placeholder="Pengurus pimcam Ada">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Ranting (Kelurahan/Ada)</label>
							<div class="col-md-4">
								<input type="text" name="pengurus_ranting" id="pengurus_ranting" class="form-control" placeholder="Pengurus Ranting">
							</div>
							<div class="col-md-4">
								<input type="text" name="pengurus_ranting_ada" id="pengurus_ranting_ada" class="form-control" placeholder="Pengurus Ranting Ada">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Anak Ranting (RW/Ada)</label>
							<div class="col-md-4">
								<input type="text" name="pengurus_anak_ranting" id="pengurus_anak_ranting" class="form-control" placeholder="Pengurus Anak Ranting">
							</div>
							<div class="col-md-4">
								<input type="text" name="pengurus_anak_ranting_ada" id="pengurus_anak_ranting_ada" class="form-control" placeholder="Pengurus Anak Ranting Ada">
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">KPA (RT/Ada)</label>
							<div class="col-md-4">
								<input type="text" name="pengurus_kpa" id="pengurus_kpa" class="form-control" placeholder="Pengurus KPA">
							</div>
							<div class="col-md-4">
								<input type="text" name="pengurus_kpa_ada" id="pengurus_kpa_ada" class="form-control" placeholder="Pengurus KPA Ada">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger"  id="barangbuktibtn">Simpan</button>
				</div>
			</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
	</div>
</div>