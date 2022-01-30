<?php
date_default_timezone_set('Asia/Jakarta');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* Erwin */
	/* Rekapitulasi */
		Route::get('rekap/scan/{tingkat}', 'RekapController@index_rekap');
		Route::post('rekap/scan/{tingkat}/action', 'RekapController@action_rekap');
		Route::get('rekap/scan/{tingkat}/edit/{id_rekap}', 'RekapController@get_data_edit');
		Route::get('rekap/scan/{tingkat}/delete/{id_rekap}', 'RekapController@delete_rekap');
		Route::post('rekap/scan/{tingkat}/action/edit/{id_rekap}', 'RekapController@edit_action_rekap');
	/* End Rekapitulasi */
/* End Erwin */
/* Fatchur */
	/* Services */
		Route::get('get/json/{jenis?}', 'DashboardController@getDataJson');
		
		Route::get('get/data/verifikasi/{jenis?}', 'DashboardController@getDataverifikasi');
		
		Route::get('log/akses', 'UserController@viewLog');
		Route::get('change/struktur/wilayah/{jenis}/{ke?}', 'DashboardController@getStrukturId');
		Route::get('change/tokpu/{jenis}', 'DashboardController@changeToKPU');
		Route::get('get/allStrukttur/{jenis}', 'DashboardController@getAllStruktur');
	/* /. Services */

	/* SK */
		Route::get('cek/sk/{nomer?}', 'DashboardController@cekSK');
	/* /.SK */
	
	/* Peta */
		Route::get('get/data/{jenis}/{jenis2?}','DashboardController@getDataMap');
		Route::get('/', 'DashboardController@viewIndex');
		
		Route::get('add/maps','AjaxController@addMaps');
	/* /. Peta */
	
	/* Login */
		Route::get('login','AuthController@viewLogin');
		Route::get('proses/login','AuthController@prosesLogin');
		Route::get('logout','AuthController@logout');
	/* /. Login */
	
	/* Register */
		Route::get('register','AuthController@viewRegister');
		Route::get('register/form','AuthController@viewRegisterForm');
		Route::get('register/{sosial}/login','AuthController@prosesSosialLogin');
		Route::get('register/{sosial}/callback','AuthController@prosesSosialCallback');
	/* /. Register */

	/* GET LAT LNG */
		Route::get('get/latlng/{jenis}', 'DashboardController@getCoordinate');
	/* /. GET LAT LNG */
	
	/* Dashboard */
		Route::get('dashboard/get/data/grafik/{id?}/{pengurus?}','DashboardController@viewDashboardGrafik');
		Route::get('dashboard/get/data/{id?}','DashboardController@viewDashboardData');
	/* /. Dashboard */
	/*Setting*/
		Route::get('setting', 'SettingController@viewSetting');
		Route::post('setting/tambah/{menu}', 'SettingController@prosesSetting');
		Route::get('setting/edit/{menu}/{id}', 'SettingController@prosessEditSetting');
		Route::get('proses/hapusset/{menu}/{id}', 'SettingController@prosesDeleteMenu');
	/*Setting*/
	/* Proses */
		Route::get('proses/cek/identitas','AjaxController@cekIdentitas');
		Route::get('proses/cek/alamat','AjaxController@cekAlamat');
	/* /. Proses */

	/* Ajax */
		Route::get('ajax/option/{jenis}','AjaxController@getDataOption');
		Route::get('ajax/optionKPU/{jenis}','AjaxController@getDataOptionKPU');
		Route::get('ajax/optionDapil','AjaxController@getDataOptionDapil');
		Route::get('ajax/wilayah/{jenis}','AjaxController@getDataDetailWilayah');
		Route::get('ajax/struktur/{jenis}','AjaxController@getDataDetailStruktur');
		Route::get('ajax/penduduk','AjaxController@detailPenduduk');
		Route::get('ajax/statistik','AjaxController@detailStatistik');
		
		Route::get('data_ajx/get/bio/{daerah}/{search}','AjaxController@getBioDaerah');

		Route::get('data_ajx/get/ktp/{search}', 'AjaxController@getKtpBio');

		Route::get('data_ajx/get/bio/{search}','AjaxController@getBio');
		Route::get('data_ajx/get/bioAll/{search}','AjaxController@getBioAll');
		Route::get('data_ajx/get/kta/{search}','AjaxController@getKta');
		Route::get('data_ajx/get/sk/{search}','AjaxController@getSk');		
	/* /. Ajax */
	
	/* Grafik */
		Route::get('grafik/{jenis}/{type}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}/{dprdi?}/{dprdii?}','ReportController@viewGrafikReportPefoma');
	/* /. Grafik */
/* /. Fatchur */

Route::group(["middleware" => 'login'],function(){ // If you need session login input into here
	/* Fatchur */
		/* Dashboard */
			Route::get('dashboard/{id?}','DashboardController@viewDashboard');
			Route::get('view/profile','UserController@viewProfile');
			Route::post('view/profile','UserController@saveProfile');
			Route::post('edit/profile','UserController@editProfile');
			Route::post('save/image/{id}','UserController@saveProfileImage');
		/* /. Dashboard */

		/* Wilayah */	
			Route::get('master/wilayah/{jenis}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}','MasterController@viewMasterWilayah');
			Route::post('proses/tambah/wilayah/{jenis}','MasterController@addWilayah');
			Route::post('proses/edit/wilayah/{jenis}','MasterController@editWilayah');
			Route::get('proses/delete/wilayah/{jenis}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}/{rt?}','MasterController@deleteWilayah');
		/* /. Wilayah */

		/* Struktur */
			Route::get('master/struktur/{jenis}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}/{rt?}','MasterController@viewMasterStruktur');
			Route::post('proses/tambah/struktur/{jenis}','MasterController@addStruktur');
			Route::post('proses/edit/struktur/{jenis}','MasterController@editStruktur');
			Route::get('proses/delete/struktur/{jenis}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}/{rt?}/{id?}','MasterController@deleteStruktur');
			
			
			Route::get('detail/struktur/{jenis?}/{id?}','MasterController@detailStruktur');
		/* /. Struktur */
		
		/* Statistik */
			Route::get('master/statistik','MasterController@viewMasterStatistik');
			Route::post('proses/statistik/{id?}','MasterController@actionStatistik');
			Route::get('proses/statistik/delete/{delete?}','MasterController@actionStatistikDelete');
			Route::get('download/statistik/{file?}','DownloadController@downloadStatistik');
		/* /. Statistik */
		
		/* Perolahan Kursi */
			Route::get('master/perolehankursi/{prov?}','MasterController@viewMasterPerolehanKursi');
			Route::post('proses/perolehankursi','MasterController@actionPerolehanKursi');
			Route::get('proses/perolehankursi/{delete?}','MasterController@actionPerolehanKursi');
		/* /. Statistik */

		/* User */
			Route::get('user_management/pendaftar','UserController@viewPendaftar');
			Route::get('user_management/pendaftar/action/{id}/{flag}','UserController@prosesConfirm');
			Route::get('user_management/pendaftar/table','UserController@viewPendaftarTable');

			Route::get('user_management/list','UserController@viewUser');
			Route::get('user_management/list/{id}','UserController@getDataUser');
			Route::get('user_management/list/detail/{id}','UserController@viewDetailUser');

			Route::get('user_management/add','UserController@viewAddUser');
			Route::post('user_management/add','UserController@saveUser');
			
			Route::get('user_management/user/{id?}','UserController@actionRDUserLogin');
			Route::post('user_management/user/{id?}','UserController@actionCUUserLogin');

			Route::get('ajax/anggota/partai', 'AjaxController@getDataDetail');
		/* /. User */
		
		/* Daftar Anggota Partai */
			Route::get('anggota/partai/list','PengurusController@viewUser');
			Route::get('anggota/partai/list/{id}','PengurusController@getDataUser');
			Route::post('anggota/partai/list/{id}','PengurusController@saveEditUser');
			Route::get('anggota/partai/list/detail/{id}','PengurusController@viewDetailUser');

			Route::get('anggota/partai/add','PengurusController@viewAddUser');
			Route::post('anggota/partai/add','PengurusController@saveUser');
			Route::get('anggota/partai/delete/{id}','PengurusController@deleteUser');
		/* /.Daftar Anggota Partai */
		
		/* Daftar Pengurus Organisasi */
			Route::get('data_pengurus/{type}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}','PengurusController@viewPengurus');
			Route::get('search_data/{type}', 'PengurusController@loadSearch');
		/* /.Daftar Pengurus Organisasi */
		
		/* Daftar Anggota Eksekutif */
			Route::get('anggota/eksekutif','PengurusController@viewEksekutif');
			Route::post('input/eksekutif/action/{id?}','PengurusController@actionCUEksekutif');
		/* /.Daftar Anggota Eksekutif */
		
		/* Report */
			Route::get('report/{type}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}','ReportController@viewReportPefoma');
			/* Route::get('report/{type}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}','Report\DownloadReport@viewReportPefoma'); */
		/* /. Report */
		
		/* Verifikasi */
			Route::get('verifikasi/{prov?}/{id?}','VerifikasiController@actionRDVerifikasi');			
			Route::post('actions/verifikasi/{id?}','VerifikasiController@actionCUVerifikasi');
			Route::get('verifikasi/detail/{id}','VerifikasiController@getDataVerifikasi');
			Route::get('download/verifikasi/{id?}','DownloadController@downloadVerifikasi');
			Route::get('ajax/verifikasi/detail', 'AjaxController@getDataDetailVerif');
		/* /. Verifikasi */
		
		/* ORSAP/ORTOM */
			Route::get('orsap/{prov?}/{id?}','VerifikasiController@actionRDOrsap');			
			Route::post('actions/orsap/{id?}/{jenis?}','VerifikasiController@actionCUOrsap');
			Route::post('action/orsap/{id?}','VerifikasiController@actionCUOrsap');	
			Route::get('download/orsap/{id?}','DownloadController@downloadOrsap');
			Route::get('ajax/orsap/detail', 'AjaxController@getDataDetailOrsap');
			Route::get('ajax/sorsap/detail', 'AjaxController@getDataDetailSOrsap');
		/* /. ORSAP/ORTOM */

	/* /.Fatchur */

			Route::get('print/excel/{type}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}','DownloadController@print_excel_pengurus');
			Route::get('print/pdf/{type}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}','DownloadController@print_pdf_pengurus');

	
	
	/*ahmad*/
		//generik
		/* Route::get('data_pengurus/{type}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}','InputController@viewInput'); */
		Route::get('data_anggota/{type}/{prov?}/{kab?}/{kec?}/{kel?}/{rw?}','InputController@viewInput');
		
		Route::post('input/tambah/{type}','InputController@tambah');
		Route::post('input/edit/{type}/{id}','InputController@edit');
		Route::get('input/hapus/{type}/{id}','InputController@hapus');

		Route::get('master/kursi/{prov?}/{kab?}','Pusdatin\V3\Master\Kursi@show');
		Route::post('master/tambah_kursi','Pusdatin\V3\Master\Kursi@store');
		Route::post('master/edit_kursi/{id?}','Pusdatin\V3\Master\Kursi@update');
		Route::get('master/hapus_kursi/{id?}','Pusdatin\V3\Master\Kursi@destroy');

		Route::get('master/penduduk/{prov?}/{kab?}','Pusdatin\V3\Master\Penduduk@show');
		Route::post('master/tambah_penduduk','Pusdatin\V3\Master\Penduduk@store');
		Route::get('master/edit_penduduk/{id?}/{kab?}/{jumlah?}','Pusdatin\V3\Master\Penduduk@update');
		Route::get('master/hapus_penduduk/{id?}','Pusdatin\V3\Master\Penduduk@destroy');
		//http://dapil.kpu.go.id/api.php?cmd=browse&kel_id=10
		//ajax
		Route::get('data_ajx/get/struk/{type}/{prov}/{kab}/{kec}/{deskel}/{rw}/{search}','InputController@getStruk');

		Route::get('data_ajx/get/bio_gender/{type?}','InputController@getBioGender');
		Route::get('data_ajx/get/bio_menjabat_by_sk/{type?}','InputController@getBioMenjabatBySK');
		Route::get('data_ajx/get/bio_menjabat/{type?}','InputController@getBioMenjabatByProv');

		Route::get('data_ajx/get/dapil/{tingkat?}/{wil_type?}/{wil_id?}','Pusdatin\V3\Master\Kursi@getDapil');
		Route::get('data_ajx/get/kpu_prov','Pusdatin\V3\Master\Kursi@getKpuProv');
		Route::get('data_ajx/get/kpu_kab/{pro_id?}','Pusdatin\V3\Master\Kursi@getKpuKab');
		Route::get('data_ajx/get/data_kursi/{dapil_id?}','Pusdatin\V3\Master\Kursi@getDataKursi');
		Route::get('data_ajx/get/data_kursi/by_tingkat/{tingkat?}','Pusdatin\V3\Master\Kursi@getDataKursiByJenisKursi');
	/*ahmad*/

	/* ERWIN */
		Route::get('data_sync/struktur/{type}/{lock}', 'SyncController@index');
		Route::get('ajax-cari-anggota', 'AjaxController@search_anggota_partai');

		/* MONITORING INPUT DATA */
		Route::get('monitoring-data-input/{lock}', 'MonitoringController@index');

		/* TRANSFERING DATA */
		Route::get('data/write/{type}', 'SyncController@data_transfer');
	/* END ERWIN */

	/* FATCHUR */
		Route::get('dashboard/table/{tingkat}/{prov}/{kab?}/{kec?}/{kel?}/{rw?}/{rt?}','ReportController@getGrafikTabel');
		Route::get('dashboard/table/{tingkat}/{prov}',[
				'uses' => 'ReportController@getGrafikTabel',
				'as' => 'getGrafikTabel'
		]);
	/* END FATCHUR */

	
});