<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Filter Berdasarkan</label>
			<input type="text" name="nik" id="nik" class="form-control">
		</div>
		<!-- <div class="form-group">
			<label>Filter Berdasarkan</label><br>
			<label class="checkbox-inline">
				<input type="checkbox" value="1" name="with_" id="with_">NIK
			</label>
			<label class="checkbox-inline">
				<input type="checkbox" value="1" name="with_ktp" id="with_ktp">KTA
			</label>
		</div> -->
	</div>
	<div class="col-md-1 col-sm-1 col-xs-1">
		<button class="btn btn-danger" onclick="search_anggota()" style="margin-top: 26px;">Cari</button>
	</div>
</div>
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>
	function search_anggota(){
		var nik = $("#nik").val();

		$.ajax({
			type : "GET",
			url : "{{ asset('ajax-cari-anggota') }}",
			data : {
				'nik' : nik
			},
			success:function(resp){
				$("#area-data").html(resp);
			}
		})
	}
</script>


<!-- <div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Cari Berdasarkan</label>
			<div class="form-check form-check-inline">
				<label>
					<input type="checkbox" name="with_ktp" value="1" id="with-ktp" />
					KTP
				</label>
				<label>
					<input type="checkbox" name="with_kta" value="1" id="with-kta" style="margin-left: 40px;"/>
					KTA
				</label>
			</div>
		</div>
	</div>
	<div class="col-md-1 col-sm-1 col-xs-1">
		<button class="btn btn-warning" onclick="search_anggota()" style="margin-top: 26px;"><i class="fa fa-search"></i></button>
	</div>
</div>
<script src="{{ asset('asset/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>
	function search_anggota(){
		var nik = $("#nik").val();

		$.ajax({
			type : "GET",
			url : "{{ asset('ajax-cari-anggota') }}",
			data : {
				'nik' : nik
			},
			success:function(resp){
				$("#area-data").html(resp);
			}
		})
	}
</script> -->