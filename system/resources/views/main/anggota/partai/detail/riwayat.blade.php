<div class="box box-primary">
	<div class="box-header with-border-bottom">
		Pendidikan
		<button type="button" class="btn btn-primary pull-right" id="edit_add_pendidikan">+</button>
	</div>
	<div class="box-body" id="edit_pendidikan">
		<?php $x = 1; ?>
		@foreach($dataPendidikan as $tmp)
			<div class="form-inline closer_pendidikan{{$x}}" role="form" style="width: 100%;padding: 5px;" id="form_pendidikan">
				<div class="row">
					<div class="form-group col-md-2 col-sm-4 col-xs-12">
						<input type="text" class="form-control" id="pendidikan_tahun{{$x}}" name="pendidikan_tahun{{$x}}" placeholder="Tahun" value="{{$tmp->bio_pendidikan_tahun }}">
					</div>
					<div class="form-group col-md-10 col-sm-8 col-xs-12">
						<div class="row">
							<div class="col-xs-10"> 
								<input type="text" class="form-control" id="pendidikan_keterangan{{$x}}" name="pendidikan_keterangan{{$x}}" placeholder="Keterangan" value="{{$tmp->bio_pendidikan_keterangan }}">
							</div>
							<div class="col-xs-2" id="{{$x}}">
								<button type="button" class="btn btn-danger pull-right" id="remove_pendidikan">x</button>
							</div>
						</div>
					</div>
				</div>	
			</div>	
		<?php $x++ ?>
		@endforeach
	</div>
	<input type="hidden" id="jml_pendidikan" name="jml_pendidikan" value="{{$x-1}}">
</div>
<div class="box box-primary">
	<div class="box-header with-border-bottom">
		Organisasi
		<button type="button" class="btn btn-primary pull-right" id="edit_add_organisasi">+</button>
	</div>
	<div class="box-body" id="edit_organisasi">
		<?php $y = 1; ?>
		@foreach($dataOrganisasi as $tmp)
			<div class="form-inline closer_organisasi{{$y}}" role="form" style="width: 100%;padding: 5px;" id="form_organisasi">
				<div class="row">
					<div class="form-group col-md-2 col-sm-4 col-xs-12">
						<input type="text" class="form-control" id="organisasi_tahun{{$y}}" name="organisasi_tahun{{$y}}" placeholder="Tahun" value="{{$tmp->bio_organisasi_tahun }}">
					</div>
					<div class="form-group col-md-10 col-sm-8 col-xs-12">
						<div class="row">
							<div class="col-xs-10"> 
								<input type="text" class="form-control" id="organisasi_keterangan{{$y}}" name="organisasi_keterangan{{$y}}" placeholder="Keterangan" value="{{$tmp->bio_organisasi_keterangan }}">
							</div>
							<div class="col-xs-2" id="{{$y}}">
								<button type="button" class="btn btn-danger pull-right" id="remove_organisasi">x</button>
							</div>
						</div>
					</div>
				</div>	
			</div>	
		<?php $y++ ?>
		@endforeach
	</div>
	<input type="hidden" id="jml_organisasi" name="jml_organisasi" value="{{$y-1}}">
</div>
<div class="box box-primary">
	<div class="box-header with-border-bottom">
		Pekerjaan
		<button type="button" class="btn btn-primary pull-right" id="edit_add_pekerjaan">+</button>
	</div>
	<div class="box-body" id="edit_pekerjaan">
		<?php $z = 1; ?>
		@foreach($dataPekerjaan as $tmp)
			<div class="form-inline closer_pekerjaan{{$z}}" role="form" style="width: 100%;padding: 5px;" id="form_pekerjaan">
				<div class="row">
					<div class="form-group col-md-2 col-sm-4 col-xs-12">
						<input type="text" class="form-control" id="pekerjaan_tahun{{$z}}" name="pekerjaan_tahun{{$z}}" placeholder="Tahun" value="{{$tmp->bio_pekerjaan_tahun }}">
					</div>
					<div class="form-group col-md-10 col-sm-8 col-xs-12">
						<div class="row">
							<div class="col-xs-10"> 
								<input type="text" class="form-control" id="pekerjaan_keterangan{{$z}}" name="pekerjaan_keterangan{{$z}}" placeholder="Keterangan" value="{{$tmp->bio_pekerjaan_keterangan }}">
							</div>
							<div class="col-xs-2" id="{{$z}}">
								<button type="button" class="btn btn-danger pull-right" id="remove_pekerjaan">x</button>
							</div>
						</div>
					</div>
				</div>	
			</div>	
		<?php $z++ ?>
		@endforeach
	</div>
	<input type="hidden" id="jml_pekerjaan" name="jml_pekerjaan" value="{{ $z-1 }}">
</div>
<div class="box box-primary">
	<div class="box-header with-border-bottom">
		Diklat
		<button type="button" class="btn btn-primary pull-right" id="edit_add_diklat">+</button>
	</div>
	<div class="box-body" id="edit_diklat">
		<?php $a = 1; ?>
		@foreach($dataDiklat as $tmp)
			<div class="form-inline closer_diklat{{$a}}" role="form" style="width: 100%;padding: 5px;" id="form_diklat">
				<div class="row">
					<div class="form-group col-md-2 col-sm-4 col-xs-12">
						<input type="text" class="form-control" id="diklat_tahun{{$a}}" name="diklat_tahun{{$a}}" placeholder="Tahun" value="{{$tmp->bio_diklat_tahun }}">
					</div>
					<div class="form-group col-md-10 col-sm-8 col-xs-12">
						<div class="row">
							<div class="col-xs-10"> 
								<input type="text" class="form-control" id="diklat_keterangan{{$a}}" name="diklat_keterangan{{$a}}" placeholder="Keterangan" value="{{$tmp->bio_diklat_keterangan }}">
							</div>
							<div class="col-xs-2" id="{{$z}}">
								<button type="button" class="btn btn-danger pull-right" id="remove_diklat">x</button>
							</div>
						</div>
					</div>
				</div>	
			</div>	
		<?php $a++ ?>
		@endforeach
	</div>
	<input type="hidden" id="jml_diklat" name="jml_diklat" value="{{ $a-1 }}">
</div>
<div class="box box-primary">
	<div class="box-header with-border-bottom">
		Perjuangan
		<button type="button" class="btn btn-primary pull-right" id="edit_add_perjuangan">+</button>
	</div>
	<div class="box-body" id="edit_perjuangan">
		<?php $b = 1; ?>
		@foreach($dataPerjuangan as $tmp)
			<div class="form-inline closer_perjuangan{{$b}}" role="form" style="width: 100%;padding: 5px;" id="form_perjuangan">
				<div class="row">
					<div class="form-group col-md-2 col-sm-4 col-xs-12">
						<input type="text" class="form-control" id="perjuangan_tahun{{$b}}" name="perjuangan_tahun{{$b}}" placeholder="Tahun" value="{{$tmp->bio_perjuangan_tahun }}">
					</div>
					<div class="form-group col-md-10 col-sm-8 col-xs-12">
						<div class="row">
							<div class="col-xs-10"> 
								<input type="text" class="form-control" id="perjuangan_keterangan{{$b}}" name="perjuangan_keterangan{{$b}}" placeholder="Keterangan" value="{{$tmp->bio_perjuangan_keterangan }}">
							</div>
							<div class="col-xs-2" id="{{$z}}">
								<button type="button" class="btn btn-danger pull-right" id="remove_perjuangan">x</button>
							</div>
						</div>
					</div>
				</div>	
			</div>	
		<?php $b++ ?>
		@endforeach
	</div>
	<input type="hidden" id="jml_perjuangan" name="jml_perjuangan" value="{{ $b-1 }}">
</div>
<div class="box box-primary">
	<div class="box-header with-border-bottom">
		Penghargaan
		<button type="button" class="btn btn-primary pull-right" id="edit_add_penghargaan">+</button>
	</div>
	<div class="box-body" id="edit_penghargaan">
		<?php $c = 1; ?>
		@foreach($dataPenghargaan as $tmp)
			<div class="form-inline closer_penghargaan{{$c}}" role="form" style="width: 100%;padding: 5px;" id="form_penghargaan">
				<div class="row">
					<div class="form-group col-md-2 col-sm-4 col-xs-12">
						<input type="text" class="form-control" id="penghargaan_tahun{{$c}}" name="penghargaan_tahun{{$c}}" placeholder="Tahun" value="{{$tmp->bio_penghargaan_tahun }}">
					</div>
					<div class="form-group col-md-10 col-sm-8 col-xs-12">
						<div class="row">
							<div class="col-xs-10"> 
								<input type="text" class="form-control" id="penghargaan_keterangan{{$c}}" name="penghargaan_keterangan{{$c}}" placeholder="Keterangan" value="{{$tmp->bio_penghargaan_keterangan }}">
							</div>
							<div class="col-xs-2" id="{{$z}}">
								<button type="button" class="btn btn-danger pull-right" id="remove_penghargaan">x</button>
							</div>
						</div>
					</div>
				</div>	
			</div>	
		<?php $c++ ?>
		@endforeach
	</div>
	<input type="hidden" id="jml_penghargaan" name="jml_penghargaan" value="{{ $c-1 }}">
</div>
<script src="{{ asset('asset/js/jquery-3.0.0.min.js') }}"> </script>
<script type="text/javascript">
var x 	= '{{ @$x-1 }}';
var y 	= '{{ @$y-1 }}';
var z 	= '{{ @$z-1 }}';
var a 	= '{{ @$a-1 }}';
var b 	= '{{ @$b-1 }}';
var c 	= '{{ @$c-1 }}';
/*End Deklarasi*/

/*Script Add Riwayat Pendidikan*/
var wrapper_pendidikan = $('#edit_pendidikan');
var btn_pendidikan = $('#edit_add_pendidikan');

$(btn_pendidikan).click(function() {
	x++;
	var append_pendidikan = 
	'<content>'+
		'<div class="form-inline closer_pendidikan'+x+' xs-border-bottom" role="form" style="width: 100%;padding: 5px;" id="form_pendidikan">'+
	        '<div class="row">'+
	        	'<div class="form-group col-md-2 col-sm-4">'+
					'<input type="text" class="form-control" id="pendidikan_tahun'+x+'" name="pendidikan_tahun'+x+'" placeholder="Tahun">'+
		        '</div>'+
				'<div class="form-group col-md-10 col-sm-8">'+
					'<div class="row">'+
						'<div class="col-xs-10">'+
							'<input type="text" class="form-control" id="pendidikan_keterangan'+x+'" name="pendidikan_keterangan'+x+'" placeholder="Keterangan">'+
						'</div>'+
						'<div class="col-xs-2" id='+x+'>'+
							'<button type="button" class="btn btn-danger pull-right" id="remove_pendidikan">x</button>'+
						'</div>'+
					'</div>'+
				'</div>'+
	        '</div>'+
		'</div>'+
	'</content>';
	$(wrapper_pendidikan).append(append_pendidikan);
	$('#jml_pendidikan').val(x);
});
$(wrapper_pendidikan).on("click","#remove_pendidikan", function(e){ //user click on remove text
	if(closer)
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_pendidikan'+closer).remove();
});
/*End Script*/

/*Script Add Riwayat Organisasi*/
var wrapper_organisasi = $('#edit_organisasi');
var btn_organisasi = $('#edit_add_organisasi');

$(btn_organisasi).click(function(){
	y++;
	var append_organisasi = 
	'<div class="form-inline closer_organisasi'+y+'" role="form" style="width: 100%;padding: 5px;" id="form_organisasi">'+
		'<div class="row">'+
			'<div class="form-group col-md-2 col-sm-4">'+
            	'<input type="text" class="form-control" id="organisasi_tahun'+y+'" name="organisasi_tahun'+y+'" placeholder="Tahun">'+
            '</div>'+
			'<div class="form-group col-md-10 col-sm-8">'+
				'<div class="row">'+
					'<div class="col-xs-10">'+
						'<input type="text" class="form-control" id="organisasi_keterangan'+y+'" name="organisasi_keterangan'+y+'" placeholder="Keterangan">'+
					'</div>'+
					'<div class="col-xs-2" id="'+y+'">'+
						'<button type="button" class="btn btn-danger pull-right" id="remove_organisasi">x</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	$(wrapper_organisasi).append(append_organisasi); 
	$('#jml_organisasi').val(y);
});
$(wrapper_organisasi).on("click","#remove_organisasi", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_organisasi'+closer).remove();
});
/*End Script*/

/*Script Add Riwayat Pekerjaan*/
var wrapper_pekerjaan = $('#edit_pekerjaan');
var btn_pekerjaan = $('#edit_add_pekerjaan');

$(btn_pekerjaan).click(function() {
	z++;
	var append_pekerjaan = 
	'<div class="form-inline closer_pekerjaan'+z+'" role="form" style="width: 100%;padding: 5px;" id="form_pekerjaan">'+
		'<div class="row">'+
			'<div class="form-group col-md-2 col-sm-4">'+
				'<input type="text" class="form-control" id="pekerjaan_tahun'+z+'" name="pekerjaan_tahun'+z+'" placeholder="Tahun">'+
			'</div>'+
			'<div class="form-group col-md-10 col-sm-8">'+
				'<div class="row">'+
					'<div class="col-xs-10">'+
						'<input type="text" class="form-control" id="pekerjaan_keterangan'+z+'" name="pekerjaan_keterangan'+z+'" placeholder="Keterangan">'+
					'</div>'+
					'<div class="col-xs-2" id="'+z+'">'+
						'<button type="button" class="btn btn-danger pull-right" id="remove_pekerjaan">x</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	$(wrapper_pekerjaan).append(append_pekerjaan);
	$('#jml_pekerjaan').val(z);
});
$(wrapper_pekerjaan).on("click","#remove_pekerjaan", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_pekerjaan'+closer).remove();
});
/*End Script*/

/*Script Add Riwayat Diklat*/
var wrapper_diklat = $('#edit_diklat');
var btn_diklat = $('#edit_add_diklat');

$(btn_diklat).click(function() {
	a++;
	var append_diklat = 
	'<div class="form-inline closer_diklat'+a+'" role="form" style="width: 100%;padding: 5px;" id="form_diklat">'+
		'<div class="row">'+
			'<div class="form-group col-md-2 col-sm-4">'+
				'<input type="text" class="form-control" id="diklat_tahun'+a+'" name="diklat_tahun'+a+'" placeholder="Tahun">'+
			'</div>'+
			'<div class="form-group col-md-10 col-sm-8">'+
				'<div class="row">'+
					'<div class="col-xs-10">'+
						'<input type="text" class="form-control" id="diklat_keterangan'+a+'" name="diklat_keterangan'+a+'" placeholder="Keterangan">'+
					'</div>'+
					'<div class="col-xs-2" id="'+a+'">'+
						'<button type="button" class="btn btn-danger pull-right" id="remove_diklat">x</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	$(wrapper_diklat).append(append_diklat);
	$('#jml_diklat').val(a);
});
$(wrapper_diklat).on("click","#remove_diklat", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_diklat'+closer).remove();
});
/*End Script*/

/*Script Add Riwayat Perjuangan*/
var wrapper_perjuangan = $('#edit_perjuangan');
var btn_perjuangan = $('#edit_add_perjuangan');

$(btn_perjuangan).click(function(){
	b++;
	var append_perjuangan = 
	'<div class="form-inline closer_perjuangan'+b+'" role="form" style="width: 100%;padding: 5px;" id="form_pendidikan">'+
		'<div class="row">'+
			'<div class="form-group col-md-2 col-sm-4">'+
				'<input type="text" class="form-control" id="perjuangan_tahun'+b+'" name="perjuangan_tahun'+b+'" placeholder="Tahun">'+
			'</div>'+
			'<div class="form-group col-md-10 col-sm-8">'+
				'<div class="row">'+
					'<div class="col-xs-10">'+
						'<input type="text" class="form-control" id="perjuangan_keterangan'+b+'" name="perjuangan_keterangan'+b+'" placeholder="Keterangan">'+
					'</div>'+
					'<div class="col-xs-2" id="'+b+'">'+
						'<button type="button" class="btn btn-danger pull-right" id="remove_perjuangan">x</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	$(wrapper_perjuangan).append(append_perjuangan);
	$('#jml_perjuangan').val(b);
});
$(wrapper_perjuangan).on("click","#remove_perjuangan", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_perjuangan'+closer).remove();
});
/*End Script*/

/*Script Add Riwayat Penghargaan*/
var wrapper_penghargaan = $('#edit_penghargaan');
var btn_penghargaan = $('#edit_add_penghargaan');

$(btn_penghargaan).click(function() {
	c++;
	var append_penghargaan = 
	'<div class="form-inline closer_penghargaan'+c+'" role="form" style="width: 100%;padding: 5px;" id="form_penghargaan">'+
		'<div class="row">'+
			'<div class="form-group col-md-2 col-sm-4">'+
				'<input type="text" class="form-control" id="penghargaan_tahun'+c+'" name="penghargaan_tahun'+c+'" placeholder="Tahun">'+
			'</div>'+
			'<div class="form-group col-md-10 col-sm-8">'+	
				'<div class="row">'+
					'<div class="col-xs-10">'+
						'<input type="text" class="form-control" id="penghargaan_keterangan'+c+'" name="penghargaan_keterangan'+c+'" placeholder="Keterangan">'+
					'</div>'+
					'<div class="col-xs-2" id="'+c+'">'+
						'<button type="button" class="btn btn-danger pull-right" id="remove_penghargaan">x</button'+
					'</div>'
				'</div>'+
			'</div>'+
		'</div>'
	'</div>';
	$(wrapper_penghargaan).append(append_penghargaan);
	$('#jml_penghargaan').val(c);
});
$(wrapper_penghargaan).on("click","#remove_penghargaan", function(e){ //user click on remove text
    e.preventDefault(); var closer = $(this).parent('div').attr('id'); $('.closer_penghargaan'+closer).remove();
});
/*End Script*/

</script>