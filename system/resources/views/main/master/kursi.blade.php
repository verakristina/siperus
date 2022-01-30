@extends('main.layout.layout')
@section('content')

<script src="{{asset('asset/js/jquery-3.1.1.js')}}"></script>
<script src="{{asset('asset/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{asset('asset/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/wNumb.js ')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/lodash.js ')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/cleave.js ')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/numeral.js ')}}"></script>
	
	@if(session('idProvinsi') != '' OR session('idProvinsi') == NULL && session('idRole') == 3)
		{{--*/ $statusProvinsi = 'hide' /*--}}
	@else
		{{--*/ $statusProvinsi = 'show' /*--}}
	@endif
	
	@section('title-page','Data Kursi ')

	@section('modal_struk_tipe','Kursi')
	@section('tipe_menu','Data Master')
	@section('tipe_sub_menu','Kursi')
	@section('struk_tipe_box_header','List Kursi')
	@section('title_tipe','Kursi')

	@section('modal_name','Tambah Kursi')
	@section('modal_input')
		<div id="json-input"></div>
		<div class="form-group col-md-12" >
			<label for="provinsi" class="col-md-3 col-sm-12 col-xs-12">Jenis Kursi</label>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<select autocomplete="off" name="jenis_kursi" id="jenis-kursi" onchange="checkJenisKursi('tambah',this.value)" class="form-control custom-field-litle"  >
						<option selected>--- Pilih Kursi ---</option>
						@foreach($jenisKursi as $row)
							<option value="{{$row->jenis_kursi_id}}" >{{$row->jenis_kursi_value}}</option>
						@endforeach
				</select>
			</div>
		</div>
	 
		@include('main.input.section_indo_combo')
		<div class="form-group col-md-12" style="display:none">
			<label for="dapil" class="col-md-3 col-sm-12 col-xs-12" >Dapil</label>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<select name="dapil" id="dapil2" class="form-control custom-field-litle"  >
						<option value="" selected>--- Pilih Dapil ---</option>
						
				</select>
			</div>
		</div> 
		<div class="form-group col-md-12" >
			<label for="provinsi" class="col-md-3 col-sm-12 col-xs-12">Jumlah Kursi</label>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<input id="jumlah-kursi" type="text" name="jumlah_kursi" class="form-control" data-bind="value:replyNumber">
			</div>
		</div>
	@stop

	@section('content_filter_combo')
		<div class="col-md-2" >
			<select autocomplete="off" class="form-control custom-field-litle" id="kursi"  onchange="checkJenisKursi('cari',this.value)">
				<option value="" selected >--- Kursi ---</option>

					
				@foreach($jenisKursi as $row)
					<option value="{{$row->jenis_kursi_id}}" >{{$row->jenis_kursi_value}}
					</option>
				@endforeach
				
			</select>
		</div>
		@include('main.input.section_indo_filter_combo')
		<div class="col-md-2" style="display:none">
			<select class="form-control custom-field-litle" id="dapil"  >
				<option value="" selected disabled class="text-hide">--- Dapil ---</option>

					@foreach($dapil as $tmp)
						<option value="{{$tmp->dapil_id}}">{{$tmp->dapil_nama}}
						</option>
					@endforeach
				
			</select>
		</div>
	
	@stop

	

	
	@section('content_table_header')
	
	@stop	

	@section('content_table_body')
		{{--*/$no =1/*--}}
	
		 
	@stop
	<script type="text/javascript">
	@section('content_script')
		@section('goto_prov2')
			if(objKursi.value==2){
				
				$.ajax({
					type:'GET',
					contentType: "application/json",
					url:'{{url()}}/data_ajx/get/dapil/2/pro_id/'+$(this).val(),
					success:function(res,sts,xhr){
						var data = JSON.parse(res);
						$('#dapil2').html('<option selected>--- Pilih Dapil ---</option>')
						for(obj of data){
							//$('#json-input').append('<input type="hidden" value="'++'">')
							$('#dapil2').append('<option data-val="'+JSON.stringify(obj)+'" value="'+obj.dapil_id+'">'+obj.nama_dapil+'</option>')
						}
					}
				})
			}
			else {
				
				$.ajax({
					type:'GET',
					contentType: "application/json",
					url:'{{url()}}/data_ajx/get/kpu_kab/'+$(this).val(),
					success:function(res,sts,xhr){
						var data = JSON.parse(res);
						$('#kab2').html('<option selected >--- Pilih Kabupaten ---</option>')
						for(obj of data){
							
							$('#kab2').append('<option  value="'+obj.wilayah_id+'">'+obj.nama+'</option>')
						}
					}
				})
			}

		@stop
		@section('goto_prov')
			if(objKursi.value==2){
				
				$.ajax({
					type:'GET',
					contentType: "application/json",
					url:'{{url()}}/data_ajx/get/dapil/2/pro_id/'+$(this).val(),
					success:function(res,sts,xhr){
						var data = JSON.parse(res);
						$('#dapil').html('<option value="" selected>--- Pilih Dapil ---</option>')
						for(obj of data){
							
							$('#dapil').append('<option value="'+obj.dapil_id+'">'+obj.nama_dapil+'</option>')
						}
					}
				})
			}
			else {
				
				$.ajax({
					type:'GET',
					contentType: "application/json",
					url:'{{url()}}/data_ajx/get/kpu_kab/'+$(this).val(),
					success:function(res,sts,xhr){
						
						var data = JSON.parse(res);
						$('#kab').html('<option selected>--- Pilih Kabupaten ---</option>')
						for(obj of data){
							
							$('#kab').append('<option value="'+obj.wilayah_id+'">'+obj.nama+'</option>')
						}
					}
				})
			}
			
		@stop
		@section('goto_kab2')
			if(objKursi.value==3){
				$.ajax({
					type:'GET',
					contentType: "application/json",
					url:'{{url()}}/data_ajx/get/dapil/3/kab_id/'+$(this).val(),
					success:function(res,sts,xhr){
					
						var data = JSON.parse(res);
						$('#dapil2').html('<option selected >--- Pilih Dapil ---</option>')
						for(obj of data){
							
							$('#dapil2').append('<option data-val="'+JSON.stringify(obj)+'" value="'+obj.dapil_id+'">'+obj.nama_dapil+'</option>')
						}
					}
				})
			}
			
		@stop
		@section('goto_kab')
			if(objKursi.value==3){
				$.ajax({
					type:'GET',
					contentType: "application/json",
					url:'{{url()}}/data_ajx/get/dapil/3/kab_id/'+$(this).val(),
					success:function(res,sts,xhr){
						
						var data = JSON.parse(res);
						$('#dapil').html('<option value="" selected >--- Pilih Dapil ---</option>')
						for(obj of data){
							
							$('#dapil').append('<option value="'+obj.dapil_id+'">'+obj.nama_dapil+'</option>')
						}
					}
				})
			}
			
		@stop
		@include('main.input.section_script_wilayah_kosong')
	@stop
	
	@section('content_action_edit_func')
		jQuery("#modal-input-generik").modal('show');
		console.log(obj)
		jQuery("#jumlah-kursi").val(obj.jumlah_kursi)
		jQuery("#jenis-kursi").val(obj.jenis_kursi.jenis_kursi_id)
		$('#dapil2').html("<option selected value="+obj.dapil.dapil_id+">"+obj.dapil.nama_dapil+"</option>");
		switch(obj.jenis_kursi_id){
			case "3":
				combo.provTambah.show();
				combo.kabTambah.show();
				$('#kab2').html("<option selected value="+obj.wilayah_kpu.kabupaten.geo_kab_id+">"+obj.wilayah_kpu.kabupaten.geo_kab_nama+"</option>");
				$('#prov2').html("<option selected value="+obj.wilayah_kpu.provinsi.geo_prov_id+">"+obj.wilayah_kpu.provinsi.geo_prov_nama+"</option>");
				break;
			case "2":
				combo.provTambah.show();
				combo.kabTambah.hide();
				$('#prov2').html("<option selected value="+obj.wilayah_kpu.provinsi.geo_prov_id+">"+obj.wilayah_kpu.provinsi.geo_prov_nama+"</option>");
				break;
			case "1":
				combo.provTambah.hide();
				combo.kabTambah.hide();
		}

		combo.dapilTambah.show();
		jQuery('#form-input-generik').attr('action',"{{url()}}/master/edit_kursi/"+obj.kursi_id);
	@stop
	@section('content_action_add_func')
		jQuery("#modal-input-generik").modal('show');
		console.log(jQuery("#modal-input-generik"))
		jQuery('#form-input-generik').attr('action',"{{url()}}/master/tambah_kursi");
	@stop
	</script>

	@include('main.input.section_content_generik2')
	@include('main.input.section_modal_generik')
	<script type="text/template" id="table-action">
		<div onclick="detailUser('****unimplement***')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
		<% if(row.dapil.pro_id == {{ session("idProvinsi") }}) { %>	
			<div onclick='actionEdit(<%= JSON.stringify(row) %>)' class="{{ @$btnStatus }} btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
				<i class="fa fa-edit"></i>
			</div>
			<a href="{{url().'/master/hapus_kursi/'}}<%= row.kursi_id %>'" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="{{ @$btnStatus }} btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
				<i class="fa fa-trash">

				</i>
			</a>
		<% } else { %>
		<% } %>
		
		
		<div onclick="printUser('')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
	</script>
<script type="text/template">
	/* 	<tr>
			<th>No</th>
			<!--th>Provinsi</th-->
			<th>Jenis Kursi</th>
			<th>Jumlah Kursi</th>
	
		  <th width="150">Aksi</th>
		</tr>
		 @foreach($data as $val)

		  
		  		<td>{{ $no++ }}</td>
		  		<!--td>{{ $val->geo_prov_nama}}</td-->
				<td>{{ strtoupper($val->jenisKursi ['jenis_kursi_value'])?:'-' }}</td>
				<td>{{ @number_format($val->jumlah_kursi,null,null,'.')?:'-' }}</td>
			<td >			

			<div onclick="detailUser('{{ @$tmp->struk_pac_id }}')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>
								
								
				<div onclick="actionEdit({{json_encode($val)}})" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
					<i class="fa fa-edit"></i>
				</div>
				<a href="{{url().'/master/hapus_kursi/'.$val->kursi_id}}" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
					<i class="fa fa-trash">

					</i>
				</a>
			  <div onclick="printUser('{{ @$tmp->struk_pac_id }}')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
			</td>
		  </tr>
		  @endforeach*/
</script>
	<script type="text/javascript">
		var janganBuatDataTableLagiPlease =true;
//$('meta[name="csrf-token"]').attr('content'); 
		var combo;
		$(function(){
			$( "#form-input-generik" ).submit(function( event ) {
				var data;
			  console.log(data= $( this ).serializeArray() );
			  event.preventDefault();
			  /*  $.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
			        var token =  $('[name="_token"]').val(); // or _token, whichever you are using

			        if (token) {
			            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
			        }
			    });*/
			/*$.ajaxSetup({
        		headers: {
            		'X-CSRF-TOKEN':  $('[name="_token"]').val(),
        		}
    		});*/
			  $.ajax({
			  	method:'POST',
			  	url:$(this).attr('action'),
			  	data:data,
			  	success:function(res){
			  		$('.alert-success').fadeIn();
			  		$("#jumlah-kursi").val('')
			  		setTimeout(function(){$('.alert-success').fadeOut()},3000)
			  	},
			  	error:function(){
			  		$('.alert-danger').fadeIn();
			  		setTimeout(function(){$('.alert-danger').fadeOut()},3000)

			  	}
			  })
			});
			combo = {
				kabFilter:$("#kab").parent('div'),
				provFilter:$('#prov').parent('div'),
				dapilFilter:$('#dapil').parent('div'),
				provTambah:$($("#prov2").parent('div')).parent('div'),
				kabTambah :$($("#kab2").parent('div')).parent('div'),
				dapilTambah :$($("#dapil2").parent('div')).parent('div')}
			
		})
		/*new Cleave('#jumlah-kursi', {
			numeral: true,
    		numeralThousandsGroupStyle: 'thousand'
		});
		var numFormat = wNumb({
			mark: '.',
			thousand: ',',
		});*/
		var modeTable={dapil:false,jenisKursi1:false,jenisKursi2:false,jenisKursi3:false,index:true}

		$('#dapil').on('change',function(){

			loadTable('/data_ajx/get/data_kursi/'+$(this).val(),'dapil',
				['No','i:Jumlah Kursi','Action'],
				[{data:'kursi_id'},{data:"jumlah_kursi"},{data:'kursi_id'}])
			
		})
		$('#dapil2').on('change',function(){
			var selected=$(this).find('option:selected');

			console.log(selected.data('val'))
			var h=$('<input name="dapil_object" type="hidden" value="">');
			h.val(JSON.stringify(selected.data('val')))
			$('#json-input').html(h)
		});
		var objKursi={};

		function checkJenisKursi(jenis,value){

			var th=['No','Nama','i:Jumlah Kursi','Action']
			var column=[{data:'kursi_id'},{data:"jenis_kursi.jenis_kursi_value"},{data:"jumlah_kursi"},{data:'kursi_id'}]
			var jenisKursi='jenisKursi';
			objKursi.value=value;
			if(jenis == 'tambah'){
				var dapil = '#dapil2';
				var prov = '#prov2';
				var kab = '#kab2';
				var parProv = combo.provTambah;
				var parKab = combo.kabTambah;
				var parDpl = combo.dapilTambah;

			} else if(jenis == 'cari'){
				var dapil = '#dapil';
				var prov = '#prov';
				var kab = '#kab';
				var parProv = combo.provFilter;
				var parKab = combo.kabFilter;
				var parDpl = combo.dapilFilter;
			}
			console.log(value)
			if(value===""){
				$(parProv).hide();
				$(parKab).hide();
				$(parDpl).hide();

				loadTable('/data_ajx/get/data_kursi',"index",
					['No','Jenis Kursi','null:Provinsi','null:Kabupaten','Nama Dapil','i:Jumlah Kursi','Action'],
					[{data:'kursi_id'},{data:"jenis_kursi.jenis_kursi_value"},{data:"wilayah_kpu.provinsi.geo_prov_nama"},
					{data:"wilayah_kpu.kabupaten.geo_kab_nama"},{data:"dapil.nama_dapil"},{data:"jumlah_kursi"},{data:'kursi_id'}])
				return ; //karena jenis kursi tidak ada maka kembali
			}
			if(value == 1){
				$(dapil).empty();
				/*$.getJSON('http://dapil.kpu.go.id/api.php?cmd=browse&tingkat_dapil=1&jsoncallback=jsonCallback',
					
					function(res){
						console.log(res)
						var data = JSON.parse(res);
						$(dapil).append('<option selected disabled class="text-hide">--- Pilih Dapil ---</option>')
						for(obj of data){
							console.log(obj.dapil_id)
							$(dapil).append('<option value="'+obj.dapil_id+'">"'+obj.nama_dapil+'"</option>')
						}
				});*/
				
				$.ajax({
					type:'GET',
					contentType: "application/json",
					url:'{{url()}}/data_ajx/get/dapil/1',
					success:function(res,sts,xhr){
						console.log(res)
						var data = JSON.parse(res);
						$(dapil).append('<option selected disabled class="text-hide">--- Pilih Dapil ---</option>')
						for(obj of data){
							var jso;
							jso=JSON.stringify(obj)
							$(dapil).append("<option data-val='"+jso+"' value='"+obj.dapil_id+"'>"+obj.nama_dapil+"</option>")
							$(parDpl).show();
							$(parProv).hide();
							$(parKab).hide();
							
						}
					}
				})
				th=['No','Nama Dapil','i:Jumlah Kursi','Action']
				column=[{data:'kursi_id'},{data:"dapil.nama_dapil"},{data:"jumlah_kursi"},{data:'kursi_id'}]
				jenisKursi = "jenisKursi1"
				//$($(dapil).parent('div')).parent('div').show();
			} else if(value == 2){
				$(dapil).empty();
				$(prov).empty();
				$.ajax({
					type:'GET',
					contentType: "application/json",
					url:'{{url()}}/data_ajx/get/kpu_prov',
					success:function(res,sts,xhr){
						console.log(res)
						var data = JSON.parse(res);
						$(prov).append('<option selected >--- Pilih Provinsi ---</option>')
						for(obj of data){
							console.log(obj.dapil_id)
							$(prov).append('<option value="'+obj.wilayah_id+'">'+obj.nama+'</option>')
						}
						$(parProv).show();
						$(parKab).hide();
						$(parDpl).show();
						
					}
				})
				th=['No','Provinsi','Nama Dapil','i:Jumlah Kursi','Action']
				column=[{data:'kursi_id'},{data:"wilayah_kpu.provinsi.geo_prov_nama"},{data:"dapil.nama_dapil"},{data:"jumlah_kursi"},{data:"dapil.kursi_id"}]
				jenisKursi = "jenisKursi2"
				//$($(dapil).parent('div')).parent('div').hide();
			} else if(value == 3){
				$(dapil).empty();
				$(prov).empty();
				$.ajax({
					type:'GET',
					contentType: "application/json",
					url:'{{url()}}/data_ajx/get/kpu_prov',
					success:function(res,sts,xhr){
						console.log(res)
						var data = JSON.parse(res);
						$(prov).append('<option selected disabled class="text-hide">--- Pilih Provinsi ---</option>')
						for(obj of data){
							console.log(obj.dapil_id)
							$(prov).append('<option value="'+obj.wilayah_id+'">'+obj.nama+'</option>')
						}
						$(parProv).show();
						$(parKab).show();
						$(parDpl).show();
					}
				})
				th=['No','Provinsi','Kabupaten','Nama Dapil','i:Jumlah Kursi','Action']
				column=[{data:'kursi_id'},{data:"wilayah_kpu.provinsi.geo_prov_nama"},{data:"wilayah_kpu.kabupaten.geo_kab_nama"},{data:"dapil.nama_dapil"},{data:"jumlah_kursi"},{data:'kursi_id'}]
				jenisKursi = "jenisKursi3"
				//$($(dapil).parent('div')).parent('div').hide();
			}
			if(jenis==='cari')
			loadTable('/data_ajx/get/data_kursi/by_tingkat/'+value,jenisKursi,th,column)
		 
		}

		function loadTable(url,model,th,column){

			allTable.clear()
			
			if(!modeTable[model]){
				$.ajax({
				type:'GET',
				contentType: "application/json",
				url:'{{url()}}'+url,
				success:function(res,sts,xhr){
					console.log(res)
					var data = JSON.parse(res);
					allTable.clear()
					allTable.destroy();
					generateTable(th,column,data.data)
					//allTable.rows.add( data[0]).draw();
				
				}
			})
			_.forOwn(modeTable,function(k,v){modeTable[v]=false})
			modeTable[model] =true;
			}
			else{
				try{
					allTable.ajax.url('{{url()}}'+url).load()
				}catch(err){
					console.log(err.message)
				}
			}
		}
		function generateTable(th,column,data){
			$('#test-header').empty()
			var tr=$('<tr>')
			if(th){
				for(var o of th){
					console.log(o)
					var str = "";
				
					if(o.includes('i:'))
						str+="col-jml "
					if(o.includes('null:'))
						str+="col-null "

					
					tr.append('<th class="'+str+'">'+o.substring(o.lastIndexOf(':')+1)+'</th>')
				}
			}
			$('#test-header').append(tr)
			allTable=$('table').DataTable({
				destroy:true,
				dom:'<"pull-left top"l><"pull-right top form-group"f><"clear">t<"bottom"ip><"clear">',
				responsive:true,
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": false,
				columns:column,
				data:data,
				columnDefs: [{

			        targets: 0,
			        data: null,
			        defaultContent: "",
			        width:'30px',
			        render: function ( data, type, row, meta ) {
			                return meta.row + meta.settings._iDisplayStart + 1;
			        }
			      	},{
			        targets: 'col-jml',
			        data: null,
			        defaultContent: "-",
			        render: function ( data, type, row, meta ) {
			            //return numFormat.to(data);
			           	return  numeral(data).format('0,');
			        }
			        },{
			        targets: 'col-null',
			        data: null,
			        defaultContent: "-",
			        render: function ( data, type, row, meta ) {
			            //return numFormat.to(data);
			            if(!data)
			           		return  '-'
			           	else return data
			        }
			      	},{
			        targets:[-1],
			        data: null,
			        width:"170px",
			        defaultContent: "",
			        render: function ( data, type, row, meta ) {
			            var tpl=_.template($("#table-action").html());
			            var compiled=tpl({'data':data,'row':row,'meta':meta,'type':type})
			            return compiled;
			        }
			    }]
			})
		}

	
	//$("table").dataTable().fnDestroy();

	generateTable(['No','Jenis Kursi','null:Provinsi','null:Kabupaten','Nama Dapil','i:Jumlah Kursi','Action'],
		[{data:'kursi_id'},{data:"jenis_kursi.jenis_kursi_value"},{data:"wilayah_kpu.provinsi.geo_prov_nama"},{data:"wilayah_kpu.kabupaten.geo_kab_nama"},{data:"dapil.nama_dapil"},{data:"jumlah_kursi"},{data:'kursi_id'}],{!!$data!!})
	console.log({!!$data!!})
	
	</script>
@stop

