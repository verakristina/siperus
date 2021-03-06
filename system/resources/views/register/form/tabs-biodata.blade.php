<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-6 col-xs-12">Identitas</label>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<select class="form-control" id="identitas" name="identitas" required>
						<option value="">--- Pilih Identitas ---</option>
						<?php foreach($dataIdentitas as $dataidentitas){?>
							<option value="{{ $dataidentitas->identitas_id }}">{{ $dataidentitas->identitas_value }}</option>
						<?php }?>
					</select>
				</div>	
				<div class="col-md-3 col-sm-6 col-xs-12 multi-row">
					<input type="text" class="form-control" id="noIdentitas" name="noIdentitas" placeholder="Nomer Identitas" disabled />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputEmail3" class="col-md-2 col-sm-2 col-xs-12">Namasss</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<input type="text" name="namaDepan" class="form-control" id="namaDepan" placeholder="Nama Depan" required value="{{ session('name') }}">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<input type="text" name="namaTengah" class="form-control multi-row" id="namaTengah" placeholder="Nama Tengah">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<input type="text" name="namaBelakang" class="form-control multi-row" id="namaBelakang" placeholder="Nama Belakang">
				</div>
			</div>
		</div> 
		<div class="form-group">
			<div class="row">
				<div class="col-md-2 col-sm-2 col-xs-12"><label for="inputPassword3">Tempat/Tanggal Lahir</label></div>
				<div class="col-md-3 col-sm-3 col-xs-12 multi-row">
					<select class="form-control" id="tlProv" name="tlProv" required>
						<option value="0">--- Pilih Provinsi ---</option>
						<?php foreach($dataProvinsi as $tmpprop){?>
							<option value="{{ $tmpprop->geo_prov_id }}">{{ $tmpprop->geo_prov_nama }}</option>
						<?php }?>
					</select>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 multi-row">
					<select class="form-control" id="tlKab" name="tempatLahir" required>
						<option value="0" >--- Pilih Kota/Kabupaten ---</option>
					</select>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 multi-row">
					<input type="input" name="tanggalLahir" class="form-control" id="datepicker" placeholder="dd-mm-yyyy" required>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-4 col-xs-12">Agama</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<select class="form-control" id="agama" name="agama" required>
						<option value="">--- Pilih ---</option>
						<?php foreach($dataAgama as $dataAgama){?>
							<option value="{{ $dataAgama->agama_id }}">{{ $dataAgama->agama_value }}</option>
						<?php }?>
					</select>
				</div>
				<label for="inputPassword3" class="col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<?php foreach($dataJk as $tmp){?>
						<input type="radio" name="jenisKelamin" value="{{ $tmp->jk_id }}">{{ $tmp->jk_value }}</input>
					<?php }?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-2 col-xs-12">Alamat</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Pilih Lokasi Pada Maps" >
				</div>
				<div class="col-md-1 col-sm-1 col-xs-1 multi-row">
					<div class="btn btn-default btn-custom" id="google_maps_balon" data-toggle="modal" data-target="#modal_maps_balon"><span class="glyphicon glyphicon-search" style="padding:3px;" aria-hidden="true"></span></div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12 multi-row col-md-offset-2 col-sm-offset-2 col-xs-offset-12">
					<select class="form-control" id="abProv" name="abProv" required>
						<option value="">--- Pilih Provinsi ---</option>
						<?php foreach($dataProvinsi as $tmpprop){?>
							<option value="{{ $tmpprop->geo_prov_id }}">{{ $tmpprop->geo_prov_nama }}</option>
						<?php }?>
					</select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 multi-row">
					<select class="form-control" id="abKab" name="abKab" required>
						<option value="" >--- Pilih Kota/Kabupaten ---</option>
					</select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 multi-row">
					<select class="form-control" id="abKec" name="abKec" required>
						<option value="">--- Pilih Kecamatan ---</option>
					</select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 multi-row">
					<select class="form-control" id="abKel" name="abKel" required>
						<option value="">--- Pilih Kelurahan ---</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
					<label for="inputEmail3" class="col-md-2 col-sm-6 col-xs-12">Status Pernikahan</label>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<select name="statusPernikahan" id="statusPernikahan" class="form-control" required>
							<option value="">--- Pilih ---</option>
							<?php foreach($dataStatus as $tmp){?>
								<option value="{{ $tmp->status_id }}">{{ $tmp->status_value }}</option>
							<?php }?>
						</select>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="namaPasangan" id="namaPasangan" placeholder="Nama Pasangan" disabled />
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="jumlahAnak" id="jumlahAnak" placeholder="Jumlah Anak" disabled />
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-2 col-sm-2 col-xs-12"><label for="inputPassword3">Kontak</label></div>
				<div class="col-md-3 col-sm-3 col-xs-12"><input type="text" name="telp" id="telp" class="form-control" placeholder="No. Telp"></div>
				<div class="col-md-3 col-sm-3 col-xs-12"><input type="text" name="hp" id="hp" class="form-control" placeholder="Handphone"></div>
				<div class="col-md-3 col-sm-3 col-xs-12"><input type="email" name="emailBalon" id="emailBalon" class="form-control" placeholder="Email" value="{{ session('email') }}"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-2 col-sm-2"></div>
				<div class="col-md-3 col-sm-3 col-xs-12"><input type="text" name="twitter" id="twitter" class="form-control" placeholder="Twitter"></div>
				<div class="col-md-3 col-sm-3 col-xs-12"><input type="text" name="facebook" id="facebook" class="form-control" placeholder="Facebook" value="{{ session('name') }}"></div>
				<div class="col-md-3 col-sm-3 col-xs-12"><input type="file" name="foto" id="foto" class="form-control"></div>
			</div>
		</div>
	</div>
</div>