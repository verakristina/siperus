<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_riwayat?'checked':''}} type="checkbox" id="daftarRiwayatHidup"/> Daftar Riwayat Hidup</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="filedaftarRiwayatHidup" id="filedaftarRiwayatHidup" class="form-control" {{$tmp->bio_doc_riwayat?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_visi?'checked':''}} type="checkbox" id="visiMisi"/> Visi - Misi</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="filevisiMisi" class="form-control" id="filevisiMisi" {{$tmp->bio_doc_visi?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_ktp?'checked':''}} type="checkbox" id="fotoCopyKtp"/> Foto Copy KTP</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="filefotoCopyKtp" class="form-control" id="filefotoCopyKtp" {{$tmp->bio_doc_ktp?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_kk?'checked':''}} type="checkbox" id="fotoCopyKk"/> Foto Copy Kartu Keluarga</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="filefotoCopyKk" class="form-control" id="filefotoCopyKk" {{$tmp->bio_doc_kk?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_npwp?'checked':''}} type="checkbox" id="fotoCopyNpwp"/> Foto Copy NPWP</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="filefotoCopyNpwp" class="form-control" id="filefotoCopyNpwp" {{$tmp->bio_doc_npwp?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_ijazah?'checked':''}} type="checkbox" id="fotoCopyIjazah"/> Foto Copy Ijazah Pendidikan SD - Pendidikan terakhir</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="filefotoCopyIjazah" class="form-control" id="filefotoCopyIjazah" {{$tmp->bio_doc_ijazah?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_skck?'checked':''}} type="checkbox" id="skcs"/> SKCK</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="fileskcs" class="form-control" id="fileskcs" {{$tmp->bio_doc_skck?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_kta?'checked':''}} type="checkbox" id="ktaPartaiHanura"/> KTA Partai Hanura</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="filektaPartaiHanura" class="form-control" id="filektaPartaiHanura" {{$tmp->bio_doc_kta?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_pendaftaran?'checked':''}} type="checkbox" id="formPendaftaranCalon"/> Formulir Pendaftaran Calon</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="fileformPendaftaranCalon" class="form-control" id="fileformPendaftaranCalon" {{$tmp->bio_doc_pendaftaran?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_komitmen?'checked':''}} type="checkbox" id="komitmen"/> Lembar Komitmen Pencalonan</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="filekomitmen" class="form-control" id="filekomitmen" {{$tmp->bio_doc_komitmen?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_pernyataan?'checked':''}} type="checkbox" id="bertaqwa"/> Surat Pernyataan Bertaqwa kepada Tuhan Yang Maha Esa</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="filebertaqwa" class="form-control" id="filebertaqwa" {{$tmp->bio_doc_pernyataan?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12"><input {{$tmp->bio_doc_nkri?'checked':''}} type="checkbox" id="tinggal"/> Surat Pernyataan Tempat Tinggal dalam wilayah NKRI</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" name="filetinggal" class="form-control" id="filetinggal" {{$tmp->bio_doc_nkri?'':'disabled'}}></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-6 col-sm-6 col-xs-12">Note</label>
				<div class="col-md-6 col-sm-6 col-xs-12"><textarea name="note" class="form-control" placeholder="Note" rows="3">{{ $tmp->bio_doc_note }}</textarea></div>
			</div>
		</div>
	</div>
</div>
