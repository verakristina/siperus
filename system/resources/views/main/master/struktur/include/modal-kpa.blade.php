<div class="modal primary" id="modalStrukturEdit" role="dialog" aria-labelledby="tambahKelurahanLabel" >
	<div class="modal-dialog modal-md" role="document">
		<form action="{{ asset('proses/edit/struktur/kpa') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<div class="modal-header modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title modal-primary" id="myModalLabel">Edit Struktur KPA</h4>
				</div>
				<div class="modal-body">
					<div class="row">
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
					<div class="row">
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
					<div class="row">
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
					<div class="row">
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
					<div class="row">
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
					<div class="row">
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
					<div class="row">
						<div class="form-group col-md-12">
							<label for="nama" class="col-md-4">Nama Struktur KPA</label>
							<div class="col-md-8">
								<input type="text" name="edit_id_kpa" id="edit_id_kpa" class="form-control hide" placeholder="Nama Struktur KPA">
								<input type="text" name="edit_nama_kpa" id="edit_nama_kpa" class="form-control" placeholder="Nama Struktur KPA">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning"  id="btnSubmit">Simpan</button>
				</div>
			</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
	</div>
</div>