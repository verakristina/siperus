<div class="modal primary modal-reset" id="modal-input-struk" role="dialog" aria-labelledby="barangbuktiModalLabel" >
	<div class="modal-dialog modal-lg" role="document">
		<form action="" id="form-input-struk" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="my-modal-label"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						@yield('modal_struk_input_tambahan')	
						<div class="form-group col-md-12 hide">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Nama DPC</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									<input type="text" name="namaDPC" id="namaDPC" class="form-control" readonly />
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Status Kantor</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									@foreach($dataStatusKantor as $tmp)
										<div class="radio-inline col-md-4 no-margin">
											<label><input type="radio" name="statusKantor" id="statusKantor{{ $tmp->status_kantor_id }}" value="{{ $tmp->status_kantor_id }}">{{ $tmp->status_kantor_value }}</label>
										</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Alamat Kantor</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									<input type="text" name="alamatKantor" id="alamatKantor" class="form-control" />
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Terletak di ibukota</label>
							<div class="col-md-3 col-sm-12 col-xs-12" id="">
								<div class="row">
									<div class="radio-inline col-md-4 no-margin">
										<label><input type="radio" name="ibukota" id="ibukota1" value="1">Ya</label>
									</div>
									<div class="radio-inline col-md-4 no-margin">
										<label><input type="radio" name="ibukota" id="ibukota0" value="0">Tidak</label>
									</div>
								</div>
							</div>
						</div>	 
						<div class="form-group col-md-12">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Jumlah KTA</label>
							<div class="col-md-3 col-sm-12 col-xs-12" id="">
								<div class="row">
									<input type="text" name="jumlahKTA" id="jumlahKTA" class="form-control"  />
								</div>
							</div>
						</div>	
						<div class="form-group col-md-12">	
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Keaktifan pengurus</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									<div class="radio-inline col-md-4 no-margin">
										<label><input type="radio" name="keaktifanPengurus" id="keaktifanPengurus1" value="1">Ya</label>
									</div>
									<div class="radio-inline col-md-4 no-margin">
										<label><input type="radio" name="keaktifanPengurus" id="keaktifanPengurus0" value="0">Tidak</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">30% Perempuan</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									<div class="radio-inline col-md-4 no-margin">
										<label><input type="radio" name="perempuan" id="perempuan1" value="1">Ya</label>
									</div>
									<div class="radio-inline col-md-4 no-margin">
										<label><input type="radio" name="perempuan" id="perempuan0" value="0">Tidak</label>
									</div>
								</div>
							</div> 
						</div>
						<div class="form-group col-md-12">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Ruang Kerja</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									<div class="checkbox-inline col-md-4 no-margin">
										<label><input type="checkbox" name="ruangKerjak" id="ruangKerjak" value="1">K</label>
									</div>
									<div class="checkbox-inline col-md-4 no-margin">
										<label><input type="checkbox" name="ruangKerjas" id="ruangKerjas" value="1">S</label>
									</div>
									<div class="checkbox-inline col-md-4 no-margin">
										<label><input type="checkbox" name="ruangKerjab" id="ruangKerjab" value="1">B</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">	
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Staff Admin</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									<div class="radio-inline col-md-4 no-margin">
										<label><input type="radio" name="stafAdmin" id="stafAdmin1" value="1">Ada</label>
									</div>
									<div class="radio-inline col-md-4 no-margin">
										<label><input type="radio" name="stafAdmin" id="stafAdmin0" value="0">Tidak Ada</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Papan Nama Partai</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									<div class="radio-inline col-md-4 no-margin">
										<label><input type="radio" name="papanNama" id="papanNama1" value="1">Ada</label>
									</div>
									<div class="radio-inline col-md-4 no-margin">
										<label><input type="radio" name="papanNama" id="papanNama0" value="0">Tidak Ada</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Gambar</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									<div class="checkbox-inline col-md-4 no-margin">
										<label><input type="checkbox" name="presWaPres" id="presWaPres" value="1">Presiden & Wakil Presiden</label>
									</div>
									<div class="checkbox-inline col-md-4 no-margin">
										<label><input type="checkbox" name="garuda" id="garuda" value="1">Garuda</label>
									</div>
									<div class="checkbox-inline col-md-4 no-margin">
										<label><input type="checkbox" name="ketumSekjen" id="ketumSekjen" value="1">Ketum & Sekjen Hanura</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Nomer Rekening</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									<input type="text" name="nomerRekening" id="nomerRekening" class="form-control" 	 />
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Gambar</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<div class="row">
									<div class="col-md-4 no-margin">
										<input type="file" name="foto" id="foto" class="form-control"/>
									</div>
									<div class="col-md-4 no-margin">
										<input type="file" name="foto2" id="foto2" class="form-control"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger" id="submiter">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">	

	var searchBio=jQuery("#search-bio").AhmTextAsyncData({
		ajaxUrl:"{{url().'/data_ajx/get/bio'}}",
		selToInput:true,
		placeholder:"Cari Staff",
		inputName:"bio",
		onSelectedItem:function(item){
			
		}
	})
</script>