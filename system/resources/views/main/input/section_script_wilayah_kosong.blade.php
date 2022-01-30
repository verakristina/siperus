$(function(){
		$('#prov').change(function(){
			@yield('goto_prov')
		});

		$('#kab').change(function(){
			@yield('goto_kab')
		});
		$('#kec').change(function(){
			@yield('goto_kec')
		});
		$('#kel').change(function(){
			@yield('goto_kel')
		});
		$('#rw').change(function(){
			@yield('goto_rw')
		});

		$('#prov2').change(function(){
			@yield('goto_prov2')
		});

		$('#kab2').change(function(){
			@yield('goto_kab2')
		});
		$('#kec2').change(function(){
			@yield('goto_kec2')
		
		});
		$('#kel2').change(function(){
			@yield('goto_kel2')
		});
		$('#rw2').change(function(){		
			@yield('goto_rw2')
		});
	});