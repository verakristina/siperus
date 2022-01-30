<html>
	<head>
		<link rel="stylesheet" href="{{ asset('asset/bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('asset/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<style>
			body {
				background-image: url({{ asset('asset/img/bg.png') }}) !important;
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-family: Roboto,Arial,sans-serif;
			}
			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}
			.content {
				text-align: center;
				display: inline-block;
				min-width:800px;
			}
			.title {
				font-size: 4em;
				margin-bottom: 40px;
			}
			.btn-custom{
				margin-right:4%;
				padding:10 15;
			}
			.none{
				display:none;
			}
			.block{
				display:block;
			}
			.overflow{
				overflow:auto;
			}
			.overflow-x{
				overflow-x:auto;
			}
			.overflow-y{
				overflow-y:auto;
			}
			.required {
				border: 1px solid red;
			}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
				border-top: 0px solid white !important;
			}
		</style>
		<title>Pengecekan Nomer SK</title>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="title col-md-12 col-sm-12 col-xs-12">
						<h1>Pengecekan Nomer SK</h1>
					</div>
				</div>
				<div class="row">
					<div id="cekSK" class="col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<label class="col-md-4 col-sm-4 col-xs-12"style="vertical-align:middle;">Masukan Nomer SK : </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="row">
									<div class="input-group col-md-12">
										<input type="text" class="form-control" id="nomerSK" style="width:100%;"/>
										<span class="glyphicon glyphicon-remove form-control-feedback none" style="color:red;"></span>
									</div>
								</div>
								<span id="notif" class="none" style="color:red;">Nomer SK Kosong</span>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<button class="btn btn-xs btn-warning btn-block" style="padding: 7px 8px;" onclick="cekSK()">Cek</button>
							</div>
						</div>
					</div>
					<div id="response" class="col-md-12 col-sm-12 col-xs-12 none" style="margin-top:10px;">
						<div class="row">
							<div class="canvas col-md-12">
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<script src="{{ asset('asset/js/jquery-3.0.0.min.js') }}"></script>
	<script type="text/javascript">
		$('#nomerSK').keyup(function(){
			$(this).removeClass('required');
			$('#notif').addClass('none');
			$('.glyphicon-remove').addClass('none');
		});
		function cekSK(){
			var nomerSK = $('#nomerSK').val();		
			$('#response .canvas').html('');
			if(nomerSK == ''){
				$('#nomerSK').addClass('required');	
				$('#notif').removeClass('none');
				$('.glyphicon-remove').removeClass('none');
			} else {	
				$('#response').removeClass('none');
				$('#response .canvas').html('<i class="fa fa-refresh fa-spin fa-3x"></i>');
				$.ajax({
					url     : '{{ asset('cek/sk') }}/'+btoa(nomerSK),
					type    : 'GET',
					data    : { nomerSK :nomerSK },
					dataType: 'html',
					success : function(data){
						if(data != 'kosong'){							
							$('#response .canvas').html(data);
						} else {
							$('#response .canvas').html('<h3><span style="color:red;">Nomer SK Tidak Terdaftar</span></h3>');
						}
					}
				});
			}
		}
	</script>
	</body>
</html>
