<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<form action="{{ asset('proses/tambah/caleg') }}" name="barangbuktiform" enctype="multipart/form-data" method="post">
	<div class="modal primary fade" id="tambahDPD" role="dialog" aria-labelledby="barangbuktiModalLabel" >
  		<div class="modal-dialog modal-lg" role="document">
 			<input type="hidden" name="_token" value="{{csrf_token()}}">
  		<div class="modal-content">
			<div class="modal-header modal-primary" style="background-color:#3c8dbc;">
	  			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  			<h4 class="modal-title modal-primary" style="background-color:#3c8dbc;color:#fff;font-size: 14px;" id="myModalLabel">Tambah Calon Kepala Daerah</h4>
			</div>
			<div class="modal-body">
			  	<div class="row">
					<div class="form-group col-md-12">
				  		<label for="nama" class="col-md-3">Nama</label>
				  		<div class="col-md-3">
							<input type="text" name="nama" class="form-control" placeholder="Nama Depan">
				  		</div>
				  		<div class="col-md-3">
							<input type="text" name="nama" class="form-control" placeholder="Nama Tengah">
				  		</div>
				  		<div class="col-md-3">
							<input type="text" name="nama" class="form-control" placeholder="Nama Belakang">
				  		</div>
					</div>
					<div class="form-group col-md-12 col-sm-12 col-xs-12">
					  	<label for="nama" class="col-md-3 col-sm-12 col-xs-12">Tempat / Tgl Lahir</label>
					  	<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" name="tempat_lahir" id="nama" class="form-control" placeholder="Tempat Lahir">
					  	</div>
					  	<div class="col-md-3 col-sm-4 col-xs-12">
							<input type="date" id="tanggal" name="tgl_lahir" id="nama" class="form-control" placeholder="Tanggal Lahir">
					  	</div>
					</div>
					<div class="form-group col-md-12">
					  	<label for="nama" class="col-md-3">Jenis Kelamin</label>
					  	<div class="col-md-9">
							<input type="radio" name="jenkel" value="Laki-laki"> Laki- Laki
							<input type="radio" name="jenkel" value="Perempuan"> Perempuan
					  	</div>
					</div>
					<div class="form-group col-md-12">
					  	<label for="nama" class="col-md-3">Agama</label>
					  	<div class="col-md-3">
							<select name="agama" class="form-control">
							  	<option value="">--- Pilih ---</option>
							  	<option value="Islam">Islam</option>
							  	<option value="Kristen">Kristen</option>
							  	<option value="Hindu">Hindu</option>
							  	<option value="Buddha">Buddha</option>
							  	<option value="Khatolik">Khatolik</option>
							</select>
					  	</div>
					  	<label for="nama" class="col-md-2">No Telp</label>
					  	<div class="col-md-4">
							<input type="text" name="no_telp" placeholder="No Telp" class="form-control">
					  	</div>
					</div>
					<div class="form-group col-md-12">
					  	<label for="nama" class="col-md-3">No SK</label>
					  	<div class="col-md-4">
							<input type="text" name="no_sk" id="nama" class="form-control" placeholder="Nomor SK">
					  	</div>
					</div>
					<div class="form-group col-md-12">
					  	<label for="nama" class="col-md-3">Flag</label>
					  	<div class="col-md-3">
							<select name="flag" class="form-control">
							  	<option value="">--- Pilih ---</option>
							  	<option value="balon">Balon</option>
							  	<option value="calon">Calon</option>
							</select>
					  	</div>
					  	<label for="nama" class="col-md-2">Kader</label>
					  	<div class="col-md-4">
							<select name="kader" class="form-control">
							  	<option value="">--- Pilih ---</option>
							  	<option value="balon">Kader</option>
							  	<option value="calon">Nonkader</option>
							</select>
					  	</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger"  id="barangbuktibtn">Tambah</button>
			</div>
  		</div>
  	</div>
</div>
</form>
<script src="{{asset('asset/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{asset('asset/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<script>
  $(document).ready(function(){
    $('#date').datepicker({
      autoclose : true,
      dateformat : 'dd-mm-yyyy'
    });
    $('#tanggal').datepicker({
        autoclose: true,
        dateFormat: 'dd-mm-yy'
    });
  });
</script>