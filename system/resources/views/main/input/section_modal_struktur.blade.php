<div class="modal primary" id="modal-input-struk" role="dialog" aria-labelledby="barangbuktiModalLabel" >
  <div class="modal-dialog modal-md" role="document">
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
	 
	 
		<div class="form-group col-md-12" style="display:@yield('use_jabatan','initial')">
			<label for="jabatan" class="col-md-3 col-sm-12 col-xs-12">Nama Jabatan</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="search-struk">
			 
			</div>
		</div>

		<div class="form-group col-md-12" style="display:@yield('use_jabatan','initial')">
			<label for="jabatan" class="col-md-3 col-sm-12 col-xs-12">Dengan No. KTP</label>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="with_ktp" value="1" id="with-ktp" />
						YA
					</label>
				</div>
			</div>
		</div>

		<div class="form-group col-md-12 el el-ktp">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Cari Biodata</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="search-bio">
			</div>
		</div>
		<div class="form-group col-md-12 el el-no-ktp">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Nama Anggota</label>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<input type="text" class="form-control" id="nama_anggota" name="nama_anggota">
			</div>
		</div>
		<!-- <div class="form-group col-md-12" style="display:@yield('use_filter_kta','initial')">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">No. KTA</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="search-kta"></div>
							<div class="col-md-9 col-sm-12 col-xs-12" id="">
								<input type="text" class="form-control" name="no_kta" id="no_kta">
							</div>
						</div>		
						<div class="form-group col-md-12" style="display:@yield('use_filter_sk','initial')">
							<label for="bio" class="col-md-3 col-sm-12 col-xs-12">No. SK</label>
							<div class="col-md-9 col-sm-12 col-xs-12" id="search-sk"></div>
						</div> -->				
		<div class="form-group col-md-12" style="display:@yield('use_no_sk','initial')">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">No. SK</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="">
				<input type="text" class="form-control" name="no_sk" id="no_sk">
			</div>
		</div>
		<div class="form-group col-md-12" style="display:@yield('use_no_kta','initial')">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">No. KTA</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="">
				<input type="text" class="form-control" name="no_kta" id="no_kta">
			</div>
		</div>
		<div class="form-group col-md-12" style="display:@yield('use_tgl_sk','initial')">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Tanggal</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="">
				<input type="text" class="form-control" name="date" id="date">
			</div>
		</div>
		<div class="form-group col-md-12" style="display:@yield('use_tgl_sk','initial')">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">No. Handphone</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="">
				<input type="text" class="form-control" name="no_hp" id="no_hp">
			</div>
		</div>
		<div class="form-group col-md-12" style="display:@yield('use_tgl_sk','initial')">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Email</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="">
				<input type="email" class="form-control" name="email" id="email">
			</div>
		</div>
	 
  </div>
	</div>
	<div class="modal-footer">
	<button type="submit" class="btn btn-danger"  id="submiter">Simpan</button>
	</div>
  </div>
  </form>
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
	
	var searchStruk=jQuery("#search-struk").AhmTextAsyncData({
		ajaxUrl:"{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl(),
		selToInput:true,
		inputName:"jabatan",
		placeholder:'cari struktur @yield('modal_struk_tipe')...',
		onSelectedItem:function(item){
			//jQuery("#jabatan").val(item.val);
		}
	})
</script>
