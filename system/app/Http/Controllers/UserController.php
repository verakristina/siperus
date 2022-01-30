<?php namespace App\Http\Controllers; 

use DB;
use Input;
use Redirect;
use Illuminate\Http\Request;

/**
* 
*/
date_default_timezone_set('Asia/Jakarta');
class UserController extends Controller
{
	public function viewProfile()
	{
		$bioId = session('idLogin');
		$dataLogin = DB::table('m_users')
			->where('id',session('idLogin'))
				->get();
		
		foreach($dataLogin as $tmp){
				$bioId = $tmp->bio_id;
		}
			
		$dataProvinsi = array();
		$dataKabupatenLahir = array();
		$dataKabupaten = array();
		$dataKecamatan = array();
		$dataKelurahan = array();
		$dataRW = array();
		$dataBio = DB::table('m_bio')
			->select('m_bio.*','m_bio_doc.*','m_bio.bio_id as id_bio','m_geo_prov_kpu.geo_prov_id as prov_lahir','ref_status.status_value')
				->leftjoin('ref_status','ref_status.status_id','=','m_bio.bio_status_kawin')
				->leftjoin('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_bio.bio_tempat_lahir')
				->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
				->leftjoin('m_bio_doc','m_bio_doc.bio_id','=','m_bio.bio_id')
					->where('m_bio.bio_id',$bioId)
						->get();
						
		$dataProvinsi = DB::table('m_geo_prov_kpu')
			->get();
		foreach($dataBio as $tmp){
			$dataKabupatenLahir = DB::table('m_geo_kab_kpu')
				->where('geo_prov_id',$tmp->prov_lahir)
					->get();
			$dataKabupaten = DB::table('m_geo_kab_kpu')
				->where('geo_prov_id',$tmp->bio_provinsi)
					->get();
			$dataKecamatan = DB::table('m_geo_kec_kpu')
				->where('geo_kab_id',$tmp->bio_kabupaten)
					->get();
			$dataKelurahan = DB::table('m_geo_deskel_kpu')
				->where('geo_kec_id',$tmp->bio_kecamatan)
					->get();
			$dataRW = DB::table('m_geo_rw')
				->where('geo_deskel_id',$tmp->bio_kelurahan)
					->get();
		}
		$dataIdentitas = DB::table('ref_identitas')
			->get();
		$dataPekerjaan = DB::table('ref_pekerjaan')
			->get();
		$dataAgama = DB::table('ref_agama')
			->get();
		$dataJk = DB::table('ref_jk')
			->get();
		$dataStatus = DB::table('ref_status')
			->get();
			
		$dataPendidikan = DB::table('m_bio_pendidikan')
			->where('bio_id',$bioId)
				->get();
		$dataOrganisasi = DB::table('m_bio_organisasi')	
			->where('bio_id',$bioId)
				->get();
		$dataPekerjaan = DB::table('m_bio_pekerjaan')	
			->where('bio_id',$bioId)
				->get();
		$dataDiklat = DB::table('m_bio_diklat')
			->where('bio_id',$bioId)
				->get();
		$dataPerjuangan = DB::table('m_bio_perjuangan')
			->where('bio_id',$bioId)
				->get();
		$dataPenghargaan = DB::table('m_bio_penghargaan')
			->where('bio_id',$bioId)
				->get();
		//var_dump($dataDokumen[0])	;
		//print_r(json_encode($dataDokumen));
		return view('main.user.profile.index',array(
			'dataBio' => $dataBio,
			'dataPendidikan' => $dataPendidikan,
			'dataOrganisasi' => $dataOrganisasi,
			'dataPekerjaan' => $dataPekerjaan,
			'dataDiklat' => $dataDiklat,
			'dataPerjuangan' => $dataPerjuangan,
			'dataPenghargaan' => $dataPenghargaan,
			'dataProvinsi' => $dataProvinsi,
			'dataKabupatenLahir' => $dataKabupatenLahir,
			'dataKabupaten' => $dataKabupaten,
			'dataKecamatan' => $dataKecamatan,
			'dataKelurahan' => $dataKelurahan,
			'dataRW' => $dataRW,
			'dataIdentitas' => $dataIdentitas,
			'dataPekerjaan' => $dataPekerjaan,
			'dataAgama' => $dataAgama,
			'dataJk' => $dataJk,
			'dataStatus' => $dataStatus
		));	

		// return json_encode($dataBio);
	}
	
	public function saveProfile()
	{
		$idUser = @$_POST['idUser'];
		if($_POST['nameUser'] != ''){			
			$update['name'] = @$_POST['nameUser'];
		}
		if($_POST['passwordBaru'] != ''){			
			$update['password'] = @$_POST['passwordBaru'];
		}
		
		if(Input::hasFile('image')) {
			$file1 	= Input::file('image');
			if($file1->getSize() <= 2097152) {
				$file1->move('asset/img/dokumen/'.session('idLogin').'/foto', $file1->getClientOriginalName());
				$gambar = $file1->getClientOriginalName();
				$update['pic'] = $gambar;
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		
		}else{
		}		
		
		$prosesSave = DB::table('m_users')
			->where('id',$idUser)
				->update($update);
			
		
		return redirect('view/profile');
	}

	public function editProfile()
	{
		$bio_id = @$_POST['bio_id'];
		$namaDepan = @$_POST['namaDepan'];
		$namaTengah = @$_POST['namaTengah'];
		$namaBelakang = @$_POST['namaBelakang'];
		$identitas = @$_POST['identitas'];
		$noIdentitas = @$_POST['noIdentitas'];
		$tempatLahir = @$_POST['tempatLahir'];
		$tanggalLahir = @$_POST['tanggalLahir'];
		$alamat = @$_POST['alamat'];
		$abProv = @$_POST['abProv'];
		$abKab = @$_POST['abKab'];
		$abKec = @$_POST['abKec'];
		$abKel = @$_POST['abKel'];
		$jenisKelamin = @$_POST['jenisKelamin'];
		$statusPernikahan = @$_POST['statusPernikahan'];
		$namaPasangan = @$_POST['namaPasangan'];
		$jumlahAnak = @$_POST['jumlahAnak'];
		$foto = @$_POST['foto'];
		$agama = @$_POST['agama'];
		$telp = @$_POST['telp'];
		$hp = @$_POST['hp'];
		$emailBalon = @$_POST['emailBalon'];
		$twitter = @$_POST['twitter'];
		$facebook = @$_POST['facebook'];
		$note = @$_POST['note'];
		$createDate = date('Y-m-d H:i:s');

		/* Insert Table Biodata */ 
		$savePendaftaran = DB::table('m_bio')
			->where('bio_id',$bio_id)
			->update([
				'bio_nama_depan' => $namaDepan,
				'bio_nama_tengah' => $namaTengah,
				'bio_nama_belakang' => $namaBelakang,
				'bio_jenis_identitas' => $identitas,
				'bio_nomer_identitas' => $noIdentitas,
				'bio_tempat_lahir' => $tempatLahir,
				'bio_tanggal_lahir' => date('Y-m-d', strtotime($tanggalLahir)),
				'bio_jenis_kelamin' => $jenisKelamin,
				'bio_agama' => $agama,
				'bio_alamat' => $alamat,
				'bio_provinsi' => $abProv,
				'bio_kabupaten' => $abKab,
				'bio_kecamatan' => $abKec,
				'bio_kelurahan' => $abKel,
				'bio_telephone' => $telp,
				'bio_handphone' => $hp,
				'bio_email' => $emailBalon,
				'bio_twitter' => $twitter,
				'bio_facebook' => $facebook,
				'bio_status_kawin' => $statusPernikahan,
				'bio_nama_pasangan' => $namaPasangan,
				'bio_anak' => $jumlahAnak
			]);

			return redirect('view/profile');
	}
	
	public function saveProfileImage($idUser)
	{
		if(Input::hasFile('foto')) {
			$file1 	= Input::file('foto');
			if($file1->getSize() <= 2097152) {
				$file1->move('asset/img/dokumen/'.session('idLogin').'/foto', $file1->getClientOriginalName());
				$gambar = $file1->getClientOriginalName();
				$update['pic'] = $gambar;
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		
		$prosesSave = DB::table('m_users')
			->where('id',$idUser)
				->update($update);
			
		
		return redirect('view/profile');
	}
	
	public function viewUser()
	{
		$dataBio = DB::table('m_bio')
			->leftjoin('ref_jk','jk_id','=','m_bio.bio_jenis_kelamin')
				->paginate(30);
		return view('main.user.index',array(
			'dataBio' => $dataBio
		));			
	}	
	
	public function viewPendaftar()
	{
		$dataBio = DB::table('m_bio')
			->leftjoin('ref_jk','jk_id','=','m_bio.bio_jenis_kelamin')
				->where('bio_flag',0)
				->where(function($query){
					$query->where('bio_status','facebook')
						->orwhere('bio_status','google')
						->orwhere('bio_status','guest');
				})->get();
		return view('main.user.pendaftar',array(
			'dataBio' => $dataBio
		));	
	}	
	public function prosesConfirm($id,$flag)
	{
		$saveConfirm = DB::table('m_bio')
			->where('bio_id',$id)
				->update([
					'bio_flag' => $flag
				]);
				
		echo 'success';
	}	
	public function viewPendaftarTable()
	{
		$dataBio = DB::table('m_bio')
			->leftjoin('ref_jk','jk_id','=','m_bio.bio_jenis_kelamin')
				->where('bio_flag',0)
				->where(function($query){
					$query->where('bio_status','facebook')
						->orwhere('bio_status','google')
						->orwhere('bio_status','guest');
				})->get();
				
		$result = '{"aaData":[';
		$resultdata = "";
		$no = 1;
		$null = '-';
		foreach($dataBio as $tmp){
			$namaLengkap = array();
			array_push($namaLengkap,ucwords(strtolower($tmp->bio_nama_depan)),ucwords(strtolower($tmp->bio_nama_tengah)),ucwords(strtolower($tmp->bio_nama_belakang)));
							
			$resultdata = $resultdata.',[
				"'.$no++.'",
				"'.join(' ',$namaLengkap).'",
				"'.$tmp->jk_value.'",
				"'.date('d-m-Y',strtotime($tmp->bio_tanggal_lahir)).'",
				"'.$tmp->bio_telephone.'",
				"'.$tmp->bio_email.'",
				"'.$tmp->bio_alamat.'",
				"'.$tmp->bio_status.'",
				"<div  class=\'btn btn-success\' data-toggle=\'tooltip\' data-placement=\'bottom\' data-original-title=\'Terima\'  onclick=\"actionUser('.$tmp->bio_id.',1,\'#tablePendaftar\')\"><i class=\'fa fa-check\'></i></div><div class=\'btn btn-danger\' data-toggle=\'tooltip\' data-placement=\'bottom\' data-original-title=\'Tolak\' onclick=\"actionUser('.$tmp->bio_id.',2,\'#tablePendaftar\')\" ><i class=\'fa fa-times\'></i></div>"
			]';
		}
		$result = $result.substr($resultdata, 1).']}';

		echo $result;
	}	
	
	public function viewAddUser()
	{
		if(session('idLogin')){
			$dataProvinsi = DB::table('m_geo_prov')
				->get();
			$dataIdentitas = DB::table('ref_identitas')
				->get();
			$dataPekerjaan = DB::table('ref_pekerjaan')
				->get();
			$dataAgama = DB::table('ref_agama')
				->get();
			$dataJk = DB::table('ref_jk')
				->get();
			$dataStatus = DB::table('ref_status')
				->get();
			$dataBio = DB::table('m_bio')
				->get();
			return view('main.user.add-index',array(
				'dataBio' => $dataBio,
				'dataProvinsi' => $dataProvinsi,
				'dataIdentitas' => $dataIdentitas,
				'dataPekerjaan' => $dataPekerjaan,
				'dataAgama' => $dataAgama,
				'dataJk' => $dataJk,
				'dataStatus' => $dataStatus
			));			
		} else {
			return redirect('logout');
		}
	}
	
	public function saveUser()
	{
		$statusKader = @$_POST['statusKader'];
		$nomerAnggota = @$_POST['nomerAnggota'];
		$kategoriCalon = @$_POST['kategoriCalon'];
		$namaFoto='';
		$riwayatHidup='';
		$visiMisi='';
		$fotoCopyKtp='';
		$fotoCopyKk='';
		$fotoCopyNpwp='';
		$fotoCopyIjazah='';
		$skcs='';
		$ktaPartaiHanura='';
		$formPendaftaranCalon='';
		$komitmen='';
		$bertaqwa='';
		$tinggal='';
		
		$namaDepan = @$_POST['namaDepan'];
		$namaTengah = @$_POST['namaTengah'];
		$namaBelakang = @$_POST['namaBelakang'];
		$identitas = @$_POST['identitas'];
		$noIdentitas = @$_POST['noIdentitas'];
		$tempatLahir = @$_POST['tempatLahir'];
		$tanggalLahir = @$_POST['tanggalLahir'];
		$alamat = @$_POST['alamat'];
		$abProv = @$_POST['abProv'];
		$abKab = @$_POST['abKab'];
		$abKec = @$_POST['abKec'];
		$abKel = @$_POST['abKel'];
		$jenisKelamin = @$_POST['jenisKelamin'];
		$statusPernikahan = @$_POST['statusPernikahan'];
		$namaPasangan = @$_POST['namaPasangan'];
		$jumlahAnak = @$_POST['jumlahAnak'];
		$foto = @$_POST['foto'];
		$agama = @$_POST['agama'];
		$telp = @$_POST['telp'];
		$hp = @$_POST['hp'];
		$emailBalon = @$_POST['emailBalon'];
		$twitter = @$_POST['twitter'];
		$facebook = @$_POST['facebook'];
		$note = @$_POST['note'];
		$createDate = date('Y-m-d H:i:s');

		/* Insert Table Biodata */ 
		$savePendaftaran = DB::table('m_bio')
			->insertGetId([
				'bio_nama_depan' => $namaDepan,
				'bio_nama_tengah' => $namaTengah,
				'bio_nama_belakang' => $namaBelakang,
				'bio_jenis_identitas' => $identitas,
				'bio_nomer_identitas' => $noIdentitas,
				'bio_tempat_lahir' => $tempatLahir,
				'bio_tanggal_lahir' => date('Y-m-d', strtotime($tanggalLahir)),
				'bio_jenis_kelamin' => $jenisKelamin,
				'bio_agama' => $agama,
				'bio_alamat' => $alamat,
				'bio_provinsi' => $abProv,
				'bio_kabupaten' => $abKab,
				'bio_kecamatan' => $abKec,
				'bio_kelurahan' => $abKel,
				'bio_telephone' => $telp,
				'bio_handphone' => $hp,
				'bio_email' => $emailBalon,
				'bio_twitter' => $twitter,
				'bio_facebook' => $facebook,
				'bio_status_kawin' => $statusPernikahan,
				'bio_nama_pasangan' => $namaPasangan,
				'bio_anak' => $jumlahAnak,
				'bio_created_date' => $createDate,
				'bio_created_by' => session('idLogin')
			]);
		
		if(Input::hasFile('foto')) {
			$file 	= Input::file('foto');
			if($file->getSize() <= 2097152) {
				$file->move('asset/img/dokumen/'.$savePendaftaran.'/foto/', $file->getClientOriginalName()); 
				$namaFoto = $file->getClientOriginalName();
				$savePendaftaran = DB::table('m_bio')
					->where('bio_id',$savePendaftaran)
					->update([
						'bio_foto' => $namaFoto
					]);
			} else {
				?><script>
					alert("File Anda Terlalu Besar");
				</script><?php
			}
		}

		if(session('status') == 'facebook' || session('status') == 'google' || session('status') == 'quest'){
			if(session('status') == 'quest'){
				$savePendaftaran = DB::table('m_bio')
					->where('bio_id',$savePendaftaran)
						->update([
							'bio_status' => session('status'),
							'bio_flag' => 0
						]);
			} else {				
				$savePendaftaran = DB::table('m_bio')
					->where('bio_id',$savePendaftaran)
						->update([
							'bio_'.session('status').'_id' => session('id'),
							'bio_status' => session('status'),
							'bio_flag' => 0
						]);
			}
		}
			
		/*Script Save Data Pendidikan*/
		$jml_pendidikan = Input::get('jml_pendidikan');
		for ($i=1; $i <= $jml_pendidikan; $i++) { 
			$tahun_pendidikan[$i] = Input::get('pendidikan_tahun'.$i);
			$keterangan_pendidikan[$i] = Input::get('pendidikan_keterangan'.$i);
			
			if($tahun_pendidikan[$i] != '') {
				$savePendidikan = DB::table('m_bio_pendidikan')
					->insertGetId([
						'bio_id' => $savePendaftaran,
						'bio_pendidikan_tahun' => $tahun_pendidikan[$i],
						'bio_pendidikan_keterangan' => $keterangan_pendidikan[$i],
						'bio_pendidikan_created_date' => date('Y-m-d H:i:s'),
						'bio_pendidikan_created_by' => session('idLogin')
					]);
			}
		}
		/*End Script*/

		/*Script Save Data Organisasi*/
		$jml_organisasi = Input::get('jml_organisasi');
		for ($j=0; $j <= $jml_organisasi; $j++) { 
			$tahun_organisasi[$j] = Input::get('organisasi_tahun'.$j);
			$keterangan_organisasi[$j] = Input::get('organisasi_keterangan'.$j);

			if($tahun_organisasi[$j] != "") {
				$saveOrganisasi = DB::table('m_bio_organisasi')
					->insertGetId([
						'bio_id' => $savePendaftaran,
						'bio_organisasi_tahun' => $tahun_organisasi[$j],
						'bio_organisasi_keterangan' => $keterangan_organisasi[$j],
						'bio_organisasi_created_date' => date('Y-m-d H:i:s'),
						'bio_organisasi_created_by' => session('idLogin')
					]);
			}
		}
		/*End Script*/

		/*Script Save Data Pekerjaan*/
		$jml_pekerjaan = Input::get('jml_pekerjaan');
		for ($k=0; $k <= $jml_pekerjaan; $k++) { 
			$tahun_pekerjaan[$k] = Input::get('pekerjaan_tahun'.$k);
			$keterangan_pekerjaan[$k] = Input::get('pekerjaan_keterangan'.$k);

			if($tahun_pekerjaan[$k] != '') {
				$savePekerjaan = DB::table('m_bio_pekerjaan')
					->insertGetId([
						'bio_id' => $savePendaftaran,
						'bio_pekerjaan_tahun' => $tahun_pekerjaan[$k],
						'bio_pekerjaan_keterangan' => $keterangan_pekerjaan[$k],
						'bio_pekerjaan_created_date' => date('Y-m-d H:i:s'),
						'bio_pekerjaan_created_by' => session('idLogin')
					]);
			}
		}
		/*End Script*/

		/*Script Save Data Diklat*/
		$jml_diklat = Input::get('jml_diklat');
		for ($l=0; $l <= $jml_diklat ; $l++) { 
			$tahun_diklat[$l] = Input::get('diklat_tahun'.$l);
			$keterangan_diklat[$l] = Input::get('diklat_keterangan'.$l);

			if($tahun_diklat[$l] != "") {
				$saveDiklat = DB::table('m_bio_diklat')
					->insertGetId([
						'bio_id' => $savePendaftaran,
						'bio_diklat_tahun' => $tahun_diklat[$l],
						'bio_diklat_keterangan' => $keterangan_diklat[$l],
						'bio_diklat_created_date' => date('Y-m-d H:i:s'),
						'bio_diklat_created_by' => session('idLogin')
					]);
			}
		}
		/*End Script*/

		/*Script Save Data Perjuangan*/
		$jml_perjuangan = Input::get('jml_perjuangan');
		for ($x=0; $x <= $jml_perjuangan ; $x++) { 
			$tahun_perjuangan[$x] = Input::get('perjuangan_tahun'.$x);
			$keterangan_perjuangan[$x] = Input::get('perjuangan_keterangan'.$x);

			if($tahun_perjuangan[$x] != "") {
				$savePerjuangan = DB::table('m_bio_perjuangan')
					->insertGetId([
						'bio_id' => $savePendaftaran,
						'bio_perjuangan_tahun' => $tahun_perjuangan[$x],
						'bio_perjuangan_keterangan' => $keterangan_perjuangan[$x],
						'bio_perjuangan_created_date' => date('Y-m-d H:i:s'),
						'bio_perjuangan_created_by' => session('idLogin')
					]);
			}
		}
		/*End Script*/

		/*Script Save Penghargaan*/
		$jml_penghargaan = Input::get('jml_penghargaan');
		for ($y=0; $y <= $jml_penghargaan ; $y++) { 
			$tahun_penghargaan[$y] = Input::get('penghargaan_tahun'.$y);
			$keterangan_penghargaan[$y] = Input::get('penghargaan_keterangan'.$y);

			if($tahun_penghargaan[$y] != "") {
				$savePenghargaan = DB::table('m_bio_penghargaan')
					->insertGetId([
						'bio_id' => $savePendaftaran,
						'bio_penghargaan_tahun' => $tahun_penghargaan[$y],
						'bio_penghargaan_keterangan' => $keterangan_penghargaan[$y],
						'bio_penghargaan_created_date' => date('Y-m-d H:i:s'),
						'bio_penghargaan_created_by' => session('idLogin')
					]);
			}
		}
		/*End Script*/
			
		
		/* Insert Dokumen Pendukung */
		if(Input::hasFile('filedaftarRiwayatHidup')) {
			$file1 	= Input::file('filedaftarRiwayatHidup');
			if($file1->getSize() <= 2097152) {
				$file1->move('asset/img/dokumen/'.$savePendaftaran.'/riwayat/', $file1->getClientOriginalName()); 
				$riwayatHidup = $file1->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('filevisiMisi')) {
			$file2 	= Input::file('filevisiMisi');
			if($file2->getSize() <= 2097152) {
				$file2->move('asset/img/dokumen/'.$savePendaftaran.'/vm/', $file2->getClientOriginalName()); 
				$visiMisi = $file2->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('filefotoCopyKtp')) {
			$file3 	= Input::file('filefotoCopyKtp');
			if($file3->getSize() <= 2097152) {
				$file3->move('asset/img/dokumen/'.$savePendaftaran.'/ktp/', $file3->getClientOriginalName()); 
				$fotoCopyKtp = $file3->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('filefotoCopyKk')) {
			$file4 	= Input::file('filefotoCopyKk');
			if($file4->getSize() <= 2097152) {
				$file4->move('asset/img/dokumen/'.$savePendaftaran.'/kk/', $file4->getClientOriginalName()); 
				$fotoCopyKk = $file4->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('filefotoCopyNpwp')) {
			$file5 	= Input::file('filefotoCopyNpwp');
			if($file5->getSize() <= 2097152) {
				$file5->move('asset/img/dokumen/'.$savePendaftaran.'/npwp/', $file5->getClientOriginalName()); 
				$fotoCopyNpwp = $file5->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('filefotoCopyIjazah')) {
			$file6 	= Input::file('filefotoCopyIjazah');
			if($file6->getSize() <= 2097152) {
				$file6->move('asset/img/dokumen/'.$savePendaftaran.'/ijazah/', $file6->getClientOriginalName()); 
				$fotoCopyIjazah = $file6->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('fileskcs')) {
			$file7 	= Input::file('fileskcs');
			if($file7->getSize() <= 2097152) {
				$file7->move('asset/img/dokumen/'.$savePendaftaran.'/skcs/', $file7->getClientOriginalName()); 
				$skcs = $file7->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('filektaPartaiHanura')) {
			$file8 	= Input::file('filektaPartaiHanura');
			if($file8->getSize() <= 2097152) {
				$file8->move('asset/img/dokumen/'.$savePendaftaran.'/kta/', $file8->getClientOriginalName()); 
				$ktaPartaiHanura = $file8->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('fileformPendaftaranCalon')) {
			$file9 	= Input::file('fileformPendaftaranCalon');
			if($file9->getSize() <= 2097152) {
				$file9->move('asset/img/dokumen/'.$savePendaftaran.'/form/', $file9->getClientOriginalName()); 
				$formPendaftaranCalon = $file9->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('filekomitmen')) {
			$file10 	= Input::file('filekomitmen');
			if($file10->getSize() <= 2097152) {
				$file10->move('asset/img/dokumen/'.$savePendaftaran.'/komitmen/', $file10->getClientOriginalName()); 
				$komitmen = $file10->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('filebertaqwa')) {
			$file11 	= Input::file('filebertaqwa');
			if($file11->getSize() <= 2097152) {
				$file11->move('asset/img/dokumen/'.$savePendaftaran.'/bertaqwa/', $file11->getClientOriginalName()); 
				$bertaqwa = $file11->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		if(Input::hasFile('filetinggal')) {
			$file12 	= Input::file('filetinggal');
			if($file12->getSize() <= 2097152) {
				$file12->move('asset/img/dokumen/'.$savePendaftaran.'/tinggal/', $file12->getClientOriginalName()); 
				$tinggal = $file12->getClientOriginalName();
			} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
		}
		
 		$saveDokumen = DB::table('m_bio_doc')
			->insertGetId([
				'bio_id' => $savePendaftaran,
				'bio_doc_riwayat' => $riwayatHidup,
				'bio_doc_visi' => $visiMisi,
				'bio_doc_ktp' => $fotoCopyKtp,
				'bio_doc_kk' => $fotoCopyKk,
				'bio_doc_npwp' => $fotoCopyNpwp,
				'bio_doc_ijazah' => $fotoCopyIjazah,
				'bio_doc_skck' => $skcs,
				'bio_doc_kta' => $ktaPartaiHanura,
				'bio_doc_pendaftaran' => $formPendaftaranCalon,
				'bio_doc_komitmen' => $komitmen,
				'bio_doc_pernyataan' => $bertaqwa,
				'bio_doc_nkri' => $tinggal,
				'bio_doc_note' => $note,
				'bio_doc_created_date' => $createDate,
				'bio_doc_created_date' => session('idLogin')
			]);

		return redirect('user_management/list');
	}
	
	public function getDataUser($bioId)
	{
		$dataProvinsi = array();
		$dataKabupatenLahir = array();
		$dataKabupaten = array();
		$dataKecamatan = array();
		$dataKelurahan = array();
		$dataRW = array();
		$dataBio = DB::table('m_bio')
			->select('m_bio.*','m_bio_doc.*','m_bio.bio_id as id_bio','m_geo_prov.geo_prov_id as prov_lahir','ref_status.status_value')
				->leftjoin('ref_status','ref_status.status_id','=','m_bio.bio_status_kawin')
				->leftjoin('m_geo_kab','m_geo_kab.geo_kab_id','=','m_bio.bio_tempat_lahir')
				->leftjoin('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
				->leftjoin('m_bio_doc','m_bio_doc.bio_id','=','m_bio.bio_id')
					->where('m_bio.bio_id',$bioId)
						->get();
		foreach($dataBio as $tmp){
			$dataProvinsi = DB::table('m_geo_prov')
				->get();
			$dataKabupatenLahir = DB::table('m_geo_kab')
				->where('geo_prov_id',$tmp->prov_lahir)
					->get();
			$dataKabupaten = DB::table('m_geo_kab')
				->where('geo_prov_id',$tmp->bio_provinsi)
					->get();
			$dataKecamatan = DB::table('m_geo_kec')
				->where('geo_kab_id',$tmp->bio_kabupaten)
					->get();
			$dataKelurahan = DB::table('m_geo_deskel')
				->where('geo_kec_id',$tmp->bio_kecamatan)
					->get();
			$dataRW = DB::table('m_geo_rw')
				->where('geo_deskel_id',$tmp->bio_kelurahan)
					->get();
		}
		$dataIdentitas = DB::table('ref_identitas')
			->get();
		$dataPekerjaan = DB::table('ref_pekerjaan')
			->get();
		$dataAgama = DB::table('ref_agama')
			->get();
		$dataJk = DB::table('ref_jk')
			->get();
		$dataStatus = DB::table('ref_status')
			->get();
			
		$dataPendidikan = DB::table('m_bio_pendidikan')
			->where('bio_id',$bioId)
				->get();
		$dataOrganisasi = DB::table('m_bio_organisasi')	
			->where('bio_id',$bioId)
				->get();
		$dataPekerjaan = DB::table('m_bio_pekerjaan')	
			->where('bio_id',$bioId)
				->get();
		$dataDiklat = DB::table('m_bio_diklat')
			->where('bio_id',$bioId)
				->get();
		$dataPerjuangan = DB::table('m_bio_perjuangan')
			->where('bio_id',$bioId)
				->get();
		$dataPenghargaan = DB::table('m_bio_penghargaan')
			->where('bio_id',$bioId)
				->get();
		//var_dump($dataDokumen[0])	;
		//print_r(json_encode($dataDokumen));
		return view('main.user.edit_index',array(
			'dataBio' => $dataBio,
			'dataPendidikan' => $dataPendidikan,
			'dataOrganisasi' => $dataOrganisasi,
			'dataPekerjaan' => $dataPekerjaan,
			'dataDiklat' => $dataDiklat,
			'dataPerjuangan' => $dataPerjuangan,
			'dataPenghargaan' => $dataPenghargaan,
			'dataProvinsi' => $dataProvinsi,
			'dataKabupatenLahir' => $dataKabupatenLahir,
			'dataKabupaten' => $dataKabupaten,
			'dataKecamatan' => $dataKecamatan,
			'dataKelurahan' => $dataKelurahan,
			'dataRW' => $dataRW,
			'dataIdentitas' => $dataIdentitas,
			'dataPekerjaan' => $dataPekerjaan,
			'dataAgama' => $dataAgama,
			'dataJk' => $dataJk,
			'dataStatus' => $dataStatus
		));	
		// return json_encode($dataBio);
	}
	public function saveEditUser()
	{
		$bio_id = @$_POST['bio_id'];
		$statusKader = @$_POST['statusKader'];
		$nomerAnggota = @$_POST['nomerAnggota'];
		$kategoriCalon = @$_POST['kategoriCalon'];
		$namaFoto='';
		$riwayatHidup='';
		$visiMisi='';
		$fotoCopyKtp='';
		$fotoCopyKk='';
		$fotoCopyNpwp='';
		$fotoCopyIjazah='';
		$skcs='';
		$ktaPartaiHanura='';
		$formPendaftaranCalon='';
		$komitmen='';
		$bertaqwa='';
		$tinggal='';
		
		$namaDepan = @$_POST['namaDepan'];
		$namaTengah = @$_POST['namaTengah'];
		$namaBelakang = @$_POST['namaBelakang'];
		$identitas = @$_POST['identitas'];
		$noIdentitas = @$_POST['noIdentitas'];
		$tempatLahir = @$_POST['tempatLahir'];
		$tanggalLahir = @$_POST['tanggalLahir'];
		$alamat = @$_POST['alamat'];
		$abProv = @$_POST['abProv'];
		$abKab = @$_POST['abKab'];
		$abKec = @$_POST['abKec'];
		$abKel = @$_POST['abKel'];
		$jenisKelamin = @$_POST['jenisKelamin'];
		$statusPernikahan = @$_POST['statusPernikahan'];
		$namaPasangan = @$_POST['namaPasangan'];
		$jumlahAnak = @$_POST['jumlahAnak'];
		$foto = @$_POST['foto'];
		$agama = @$_POST['agama'];
		$telp = @$_POST['telp'];
		$hp = @$_POST['hp'];
		$emailBalon = @$_POST['emailBalon'];
		$twitter = @$_POST['twitter'];
		$facebook = @$_POST['facebook'];
		$note = @$_POST['note'];
		$createDate = date('Y-m-d H:i:s');

		if(Input::hasFile('foto')) {
			$file 	= Input::file('foto');
			if($file->getSize() <= 2097152) {
				$file->move('asset/img/dokumen/'.$bio_id.'/foto/', $file->getClientOriginalName()); 
				$namaFoto = $file->getClientOriginalName();
				$savePendaftaran = DB::table('m_bio')
					->where('bio_id',$bio_id)
					->update([
						'bio_foto' => $namaFoto
					]);
			} else {
				?><script>
					alert("File Anda Terlalu Besar");
				</script><?php
			}
		}

		/* Insert Table Biodata */ 
		$savePendaftaran = DB::table('m_bio')
			->where('bio_id',$bio_id)
			->update([
				'bio_nama_depan' => $namaDepan,
				'bio_nama_tengah' => $namaTengah,
				'bio_nama_belakang' => $namaBelakang,
				'bio_jenis_identitas' => $identitas,
				'bio_nomer_identitas' => $noIdentitas,
				'bio_tempat_lahir' => $tempatLahir,
				'bio_tanggal_lahir' => date('Y-m-d', strtotime($tanggalLahir)),
				'bio_jenis_kelamin' => $jenisKelamin,
				'bio_agama' => $agama,
				'bio_alamat' => $alamat,
				'bio_provinsi' => $abProv,
				'bio_kabupaten' => $abKab,
				'bio_kecamatan' => $abKec,
				'bio_kelurahan' => $abKel,
				'bio_telephone' => $telp,
				'bio_handphone' => $hp,
				'bio_email' => $emailBalon,
				'bio_twitter' => $twitter,
				'bio_facebook' => $facebook,
				'bio_status_kawin' => $statusPernikahan,
				'bio_nama_pasangan' => $namaPasangan,
				'bio_anak' => $jumlahAnak
			]);
		 
			
		/*Script Save Data Pendidikan*/
		$jenisRiwayat = ['pendidikan','organisasi','pekerjaan','diklat','perjuangan','penghargaan'];
		for($a=0;$a < count($jenisRiwayat); $a++){
			$prosesDelete = DB::table('m_bio_'.$jenisRiwayat[$a])
				->where('bio_id',$bio_id)
					->delete();
			
			$jmlRiwayat = Input::get('jml_'.$jenisRiwayat[$a]);
			for ($i=1; $i <= $jmlRiwayat; $i++) { 
				$tahunRiwayat[$i] = Input::get($jenisRiwayat[$a].'_tahun'.$i);
				$keteranganRiwayat[$i] = Input::get($jenisRiwayat[$a].'_keterangan'.$i);
				
				if($tahunRiwayat[$i] != '') {
					$prosesSave = DB::table('m_bio_'.$jenisRiwayat[$a])
						->insertGetId([
							'bio_id' => $bio_id,
							'bio_'.$jenisRiwayat[$a].'_tahun' => $tahunRiwayat[$i],
							'bio_'.$jenisRiwayat[$a].'_keterangan' => $keteranganRiwayat[$i],
							'bio_'.$jenisRiwayat[$a].'_created_date' => date('Y-m-d H:i:s'),
							'bio_'.$jenisRiwayat[$a].'_created_by' => session('idLogin')
						]);
				}
			}
		}
		/*End Script*/
			
		
		/* Insert Dokumen Pendukung */
		$jenisDokumenFile = ['filedaftarRiwayatHidup','filevisiMisi','filefotoCopyKtp','filefotoCopyKk','filefotoCopyNpwp','filefotoCopyIjazah','fileskcs','filektaPartaiHanura','fileformPendaftaranCalon','filekomitmen','filebertaqwa','filetinggal'];
		$jenisDokumenLocation = ['riwayat','visi','ktp','kk','npwp','ijazah','skck','kta','pendaftaran','komitmen','pernyataan','nkri'];
		for($a=0;$a < count($jenisDokumenFile); $a++){
			if(Input::hasFile($jenisDokumenFile[$a])) {
				$file 	= Input::file($jenisDokumenFile[$a]);
				if($file->getSize() <= 2097152) {
					$file->move('asset/img/dokumen/'.$bio_id.'/'.$jenisDokumenLocation[$a].'/', $file->getClientOriginalName()); 
					$namaFile = $file->getClientOriginalName();
					
					$dataDokumenUpdate['bio_doc_'.$jenisDokumenLocation[$a]] = $namaFile;
				} else { ?><script> alert("File Anda Terlalu Besar"); </script><?php }
			}
		}
	
		$dataDokumenUpdate['bio_doc_note'] = $note;
		$dataDokumenUpdate['bio_id'] = $bio_id;
		$dataDokumenUpdate['bio_created_by'] = session('idLogin');
		$dataDokumenUpdate['bio_created_date'] = date('Y-m-d H:i:s');
		
 		$saveDokumen = DB::table('m_bio_doc')
			->where('bio_id',$bio_id)
				->delete();

 		$saveDokumen = DB::table('m_bio_doc')
			->insertGetId($dataDokumenUpdate);
				
		return redirect('user_management/list');
	}
	
	public function actionRDUserLogin($delete=0){
		if($delete != 0){
			$proses = DB::table('m_users')
				->where('id',$delete)
					->delete();
			return redirect()->back();
		} else {			
			$breadcrumb[]='User Management';
			$breadcrumb[]='User Login';
			
			$dataProv = DB::table('m_geo_prov_kpu')->get();
			$dataAkses = DB::table('ref_akses')->get();
			$dataUser = DB::table('m_users')
				->select(
					'*',
					'm_users.id as user_id',
					DB::raw('CONCAT(bio_nama_depan," ",bio_nama_tengah," ",bio_nama_belakang) as nama_lengkap')
				)
				->leftjoin('m_bio','m_bio.bio_id','=','m_users.bio_id')
				->leftjoin('m_geo_prov','m_geo_prov.geo_prov_id','=','m_users.geo_prov_id')
				->join('ref_akses','ref_akses.akses_id','=','m_users.role')
					->get();
			return view('main.user.user_login',array(
				'breadcrumb' => $breadcrumb,
				'dataUser' => $dataUser,
				'dataAkses' => $dataAkses,
				'dataProv' => $dataProv
			));	
		}
	}
	public function actionCUUserLogin(Request $request, $edit = 0){
		$data['username'] = $request->input('username');
		$data['password'] = $request->input('password');
		$data['bio_id'] = $request->input('bio');
		$data['role'] = $request->input('aksesLogin');
		$data['geo_prov_id2'] = $request->input('aksesProvinsi')?:0;
		
		$dataProv = DB::table('m_geo_prov_kpu')
			->where('geo_prov_id',$data['geo_prov_id2'])
				->get();
		$idProvinsi = $data['geo_prov_id2'];
		foreach($dataProv as $tmp){
			$idProvinsi = $tmp->geo_prov_id;
		}
		
		$data['geo_prov_id'] = $idProvinsi;
		
		if($edit != 0){
			$proses = DB::table('m_users')
				->where('id',$edit)
					->update($data);			
		} else {
			$data['created_date'] = date('Y-m-d');
			$data['created_by'] = session('idLogin');
			
			$proses = DB::table('m_users')
				->insertGetId($data);
		}
		
		return redirect()->back();
	}
	
	public function viewLog()
	{
		$data = DB::table('ref_log')
			->join('m_users','m_users.id','=','ref_log.bio_id')
                ->whereDay('log_time','=',date('d'))
				->whereMonth('log_time','=',date('m'))
                ->whereYear('log_time','=',date('Y'))
					->groupBy('ref_log.bio_id')
						->orderBy('log_time','desc')
							->get();
		return view('main.log',array(
			'data' => $data
		));
	}
}