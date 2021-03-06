<div class="row">
	@yield('modal_struk_input_tambahan')
	<div class="col-md-12">
		<div class="form-group" style="display:@yield('use_jabatan','initial')">
			<div class="row" style="margin-left: 150px;" >
				<div class="col-md-9 col-sm-9 col-xs-12">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="with_ktp" value="1" id="with-ktp" />
							Input Manual
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group el el-no-ktp">
			<div class="row">
				<label for="bio" class="col-md-2 col-sm-6 col-xs-12">Data Anggota</label>
				<div class="col-md-8 col-sm-8 col-xs-9" id="search-bio">
				</div>
			</div>
		</div>
		<div class="form-group el el-ktp">
			<div class="row">
				<label for="bio" class="col-md-2 col-sm-6 col-xs-12">Nama Anggota</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<input type="text" class="form-control" id="nama_anggota" name="nama_anggota">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-2 col-xs-12">Alamat Domisili</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat Domisili" >
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-2 col-xs-12">Provinsi</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<select class="form-control" id="abProv" name="abProv" required>
						<option value="">--- Pilih Provinsi ---</option>
						<?php foreach($dataProvinsi as $tmpprop){?>
							<option value="{{ $tmpprop->geo_prov_id }}">{{ $tmpprop->geo_prov_nama }}</option>
						<?php }?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-2 col-xs-12">Kabupaten/Kota</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<select class="form-control" id="abKab" name="abKab" required>
						<option value="">--- Pilih Kabupaten/Kota ---</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-2 col-xs-12">Kecamatan</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<select class="form-control" id="abKec" name="abKec" required>
						<option value="">--- Pilih Kecamatan ---</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-2 col-xs-12">Kelurahan/Desa</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<select class="form-control" id="abKel" name="abKel" required>
						<option value="">--- Pilih Kelurahan/Desa ---</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-6 col-xs-12">Email</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<input type="text" name="email" class="form-control" id="emailBalon" placeholder="Email" required>
				</div>
			</div>
		</div>	
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-6 col-xs-12">No. Telp</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<input type="text" name="telp" id="telp" class="form-control" placeholder="No. Telp">				
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-6 col-xs-12">Jabatan</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan">				
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-6 col-xs-12">No SK Mandat</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<input type="number" name="no_sk_mandat" id="no_sk_mandat" class="form-control" placeholder="No SK Mandat">				
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-6 col-xs-12">Date SK Mandat</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<input type="date" name="date_sk_mandat" id="date_sk_mandat" class="form-control" placeholder="Date SK Mandat">				
				</div>
			</div>
		</div>	
		<div class="form-group">
			<div class="row">
				<label for="inputPassword3" class="col-md-2 col-sm-6 col-xs-12">File SK Mandat</label>
				<div class="col-md-8 col-sm-8 col-xs-9">
					<input type="file" name="file_sk_mandat" id="file_sk_mandat" class="form-control" placeholder="File SK Mandat">				
					<h6>(Max 10MB, /pdf)</h6>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-9">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="with_ktp" value="1" id="with-ktp" />
							Dengan ini saya menyatakan bahwa data yang saya isi adalah benar
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">	
	
	$(".el").hide();
	$(".el-no-ktp").show();

	$("#with-ktp").on('change', function(){
		if(this.checked){
			$(".el").hide();
			$(".el-ktp").show();
		}else{
			$(".el").hide();
			$(".el-no-ktp").show();
		}
	});

	var searchSk=jQuery("#search-sk").AhmTextAsyncData({
		ajaxUrl:"{{url().'/data_ajx/get/sk'}}",
		selToInput:true,
		placeholder:"cari sk...",
		inputName:"sk",
		onSelectedItem:function(item){
			
		}
	})

	var searchKta=jQuery("#search-kta").AhmTextAsyncData({
		ajaxUrl:"{{url().'/data_ajx/get/kta'}}",
		selToInput:true,
		placeholder:"cari kta...",
		inputName:"kta",
		onSelectedItem:function(item){
			
		}
	})

	var searchBio=jQuery("#search-bio").AhmTextAsyncData({
		ajaxUrl:"{{url().'/data_ajx/get/ktp'}}",
		selToInput:true,
		placeholder:"Cari berdasarkan Nama / No. KTP",
		inputName:"bio",
		onSelectedItem:function(item){
			
		}
	})
	
	// var searchStruk=jQuery("#search-struk").AhmTextAsyncData({
	// 	ajaxUrl:"{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl(),
	// 	selToInput:true,
	// 	inputName:"jabatan",
	// 	placeholder:'cari struktur @yield('modal_struk_tipe')...',
	// 	onSelectedItem:function(item){
	// 		//jQuery("#jabatan").val(item.val);
	// 	}
	// })
</script>