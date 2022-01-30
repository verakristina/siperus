$(function(){
		$('#prov').change(function(){
			var provId = $(this).val();
			@yield('goto_prov')
			changeKabupatenOption(null,'#kab',provId);

		});

		$('#kab').change(function(){
			var provId = $('#prov').val();
			var kabId = $(this).val();
			@yield('goto_kab')
			changeKecamatanOption(null,'#kec',provId,kabId);

		});
		$('#kec').change(function(){
			var provId = $('#prov').val();
			var kabId = $('#kab').val();
			var kecId = $(this).val();
			@yield('goto_kec')
			changeKelurahanOption(null,'#kel',provId,kabId,kecId);

		});
		$('#kel').change(function(){
			var provId = $('#prov').val();
			var kabId = $('#kab').val();
			var kecId = $('#kec').val();
			var kelId = $(this).val();
			@yield('goto_kel')
			changeRWOption(null,'#rw',provId,kabId,kecId,kelId);

		});
		$('#rw').change(function(){
			var provId = $('#prov').val();
			var kabId = $('#kab').val();
			var kecId = $('#kec').val();
			var kelId = $('#kel').val();
			var rwId = $('#rw').val();
			@yield('goto_rw')

			//changeRWOption('#rw',provId,kabId,kecId,kelId,rwId);
		});

		$('#prov2').change(function(){
			var provId = $(this).val();	
			changeKabupatenOption(null,'#kab2',provId);
			ind.set({prov:provId,kab:null,kec:null,kel:null,rw:null});
			@yield('goto_prov2')
		});

		$('#kab2').change(function(){
			var provId = $('#prov2').val();
			var kabId = $(this).val();
			changeKecamatanOption(null,'#kec2',provId,kabId);
			ind.set({prov:provId,kab:kabId,kec:null,kel:null,rw:null});
			@yield('goto_kab2')
	
		});
		$('#kec2').change(function(){
			var provId = $('#prov2').val();
			var kabId = $('#kab2').val();
			var kecId = $(this).val();
			changeKelurahanOption(null,'#kel2',provId,kabId,kecId);
			ind.set({prov:provId,kab:kabId,kec:kecId,kel:null,rw:null});
			@yield('goto_kec2')
		
		});
		$('#kel2').change(function(){
			var provId = $('#prov2').val();
			var kabId = $('#kab2').val();
			var kecId = $('#kec2').val();
			var kelId = $(this).val();
			changeRWOption(null,'#rw2',provId,kabId,kecId,kelId);
			ind.set({prov:provId,kab:kabId,kec:kecId,kel:kelId,rw:null});
			@yield('goto_kel2')
			
		});
		$('#rw2').change(function(){
			var provId = $('#prov2').val();
			var kabId = $('#kab2').val();
			var kecId = $('#kec2').val();
			var kelId = $('#kel2').val();
			var rwId = $('#rw2').val();
			ind.set({prov:provId,kab:kabId,kec:kecId,kel:kelId,rw:rwId});	
		
			@yield('goto_rw2')
			//changeRWOption('#rw',provId,kabId,kecId,kelId,rwId);
		});
	});