<div class="modal primary" id="modal-input-struk" role="dialog" aria-labelledby="barangbuktiModalLabel" >
  <div class="modal-dialog modal-md" role="document">
  <form action="" id="form-input-struk" name="barangbuktiform" enctype="multipart/form-data" method="post">
  <div class="modal-content">
	<div class="modal-header modal-primary">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title modal-primary" id="my-modal-label"></h4>
	</div>
	<div class="modal-body">
	<div class="row">
		 @yield('modal_struk_input_tambahan')
		<div class="form-group col-md-12">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Nama Bio</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="search-bio">
			</div>		
		</div>
		<div class="form-group col-md-12">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Username</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="">
				<input type="text" class="form-control" name="username" id="username">
			</div>
		</div>
		<div class="form-group col-md-12">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Password</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="">
				<input type="password" class="form-control" name="password" id="password">
			</div>
		</div>
		<div class="form-group col-md-12">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Akses</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="">
				<select name="aksesLogin" id="aksesLogin" class="form-control" onchange="cekAkses(this.value)">
					<option value="">--- Pilih Akses ---</option>
					@foreach($dataAkses as $tmp)
						<option value="{{ $tmp->akses_id }}">{{ $tmp->akses_nama }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group col-md-12 none" id="formProv">
			<label for="bio" class="col-md-3 col-sm-12 col-xs-12">Provinsi</label>
			<div class="col-md-9 col-sm-12 col-xs-12" id="">
				<select name="aksesProvinsi" id="aksesProvinsi" class="form-control">
					<option value="">--- Pilih Provinsi ---</option>
					@foreach($dataProv as $tmp)
						<option value="{{ $tmp->geo_prov_id }}">{{ $tmp->geo_prov_nama }}</option>
					@endforeach
				</select>
			</div>
		</div>

	 
  </div>
	</div>
	<div class="modal-footer">
	<button type="submit" class="btn btn-danger"  id="submiter">Simpan</button>
	</div>
  </div>
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  </form>
  </div>
</div>


<script type="text/javascript">	
	function cekAkses(val){
		if(val != 1){
			$('#formProv').removeClass('none');
		}else {
			$('#formProv').addClass('none');
		}
	}
	var searchBio=jQuery("#search-bio").AhmTextAsyncData({
		ajaxUrl:"{{url().'/data_ajx/get/bio'}}",
		selToInput:true,
		placeholder:"cari bio...",
		inputName:"bio",
		onSelectedItem:function(item){
			
		}
	})
	var searchStruk=jQuery("#search-struk").AhmTextAsyncData({
		ajaxUrl:"{{url().'/data_ajx/get/struk/'}}@yield('modal_struk_tipe')/"+ind.getUrl(),
		selToInput:true,
		inputName:"jabatan",
		placeholder:'cari struk @yield('modal_struk_tipe')...',
		onSelectedItem:function(item){
			//jQuery("#jabatan").val(item.val);
		}
	})
</script>
