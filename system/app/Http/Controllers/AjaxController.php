<?php namespace App\Http\Controllers; 

use DB;
use Input;
use Redirect;

/**
* 
*/
class AjaxController extends Controller
{
	public function getBio($search)
	{
		$data = DB::table('m_bio')
			->select(
				'm_bio.bio_id as val',
				DB::raw('CONCAT_WS(" ",bio_nama_depan,bio_nama_tengah,bio_nama_belakang) as text')
			)
			->where("m_bio.bio_nama_depan","like","%$search%")
			->where("menjabat","=",null)
			->whereOr("menjabat","=",0)
			->get();
		echo json_encode($data);
	}
	public function getBioDaerah($daerah,$search)
	{
		$dataProv = DB::table('m_geo_prov_kpu')
			->where('geo_prov_id',$daerah)
				->get();
		$idProvinsi = $daerah;
		foreach($dataProv as $tmp){
			$idProvinsi = $tmp->geo_prov_nkpu_id;
		}
		$data = DB::table('m_bio')
			->select(
				'm_bio.bio_id as val',
				DB::raw('CONCAT(m_bio.bio_nama_depan," ",m_bio.bio_nama_tengah," ",m_bio.bio_nama_belakang) as text')
			)
			->join('r_bio_pimda','r_bio_pimda.bio_id','=','m_bio.bio_id')
			->where("m_bio.bio_nama_depan","like","%$search%")
			->where("geo_prov_id",$idProvinsi)
			->where("status_akses","=",null)
			->whereOr("status_akses","=",0)
			->get();
		echo json_encode($data);
	}
	public function getBioAll($search)
	{
		$data = DB::table('m_bio')
			->select(
				'm_bio.bio_id as val',
				DB::raw('CONCAT(m_bio.bio_nama_depan," ",m_bio.bio_nama_tengah," ",m_bio.bio_nama_belakang) as text')
			)
			->where("m_bio.bio_nama_depan","like","%$search%")
				->get();
		echo json_encode($data);
	}
	public function getKta($search)
	{
		$data = DB::table('m_bio_kta')
			->select(
				'm_bio_kta.bio_kta_id as val',
				DB::raw('CONCAT(m_bio_kta.bio_kta_no) as text')
			)
			->where("m_bio_kta.bio_kta_no","like","%$search%")
			->get();
		echo json_encode($data);

	}	

	public function getSk($search)
	{
		$data = DB::table('m_bio_sk')
			->select(
				'm_bio_sk.bio_sk_id as val',
				DB::raw('CONCAT(m_bio_sk.bio_sk_no) as text')
			)
			->where("m_bio_sk.bio_sk_no","like","%$search%")
			->get();
		echo json_encode($data);
	}		
	
	public function cekIdentitas()
	{
		$jenis = @$_GET['jenis'];
		$nomer = @$_GET['nomer'];
		
		$proses = DB::table('m_bio')
			->where('bio_jenis_identitas',$jenis)
			->where('bio_nomer_identitas',$nomer)
				->get();
				
		if(count($proses) != 0){
			echo 'unsuccess';
		} else {
			echo 'success';
		}
	}
	
	public function cekAlamat()
	{
		$jenis = @$_GET['jenis'];
		$data = @$_GET['data'];
		
		if($jenis == 'prov'){
			$check = DB::table('m_geo_prov')
				->where('geo_prov_nama','like','%'.$data.'%')
					->groupBy('geo_prov_id')
						->get();			
		} else if($jenis == 'kab'){
			$check = DB::table('m_geo_kab')
				->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_prov.geo_prov_id')
					->where('geo_deskel_nama','like','%'.$data.'%')
						->groupBy('geo_kab_id')
							->get();			
		} else if($jenis == 'kec'){
			$check = DB::table('m_geo_kec')
				->join('m_geo_kab','m_geo_kab.geo_kab_id','=','m_geo_kec.geo_kab_id')
				->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_prov.geo_prov_id')
					->where('geo_kec_nama','like','%'.$data.'%')
						->groupBy('geo_deskel_id')
							->get();			
		} else if($jenis == 'kel'){
			$check = DB::table('m_geo_deskel')
				->join('m_geo_kec','m_geo_kec.geo_kec_id','=','m_geo_deskel.geo_kec_id')
				->join('m_geo_kab','m_geo_kab.geo_kab_id','=','m_geo_kec.geo_kab_id')
				->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_prov.geo_prov_id')
					->where('geo_deskel_nama','like','%'.$data.'%')
						->groupBy('geo_deskel_id')
							->get();			
		}
		
		echo count($check);
	}
	
	public function addMaps()
	{
		$maps_section = @$_GET['maps_section'];
		if($maps_section == 'maps') {
			return response()->view('main.user.google-map');
		}
	}
	public function getDataOptionDapil() {
		$tingkat = @$_GET['tingkat'];
		$prov = @$_GET['prov'];
		$kab = @$_GET['kab'];

		$data = DB::table('m_dapil')
			->where('tingkat_dapil',$tingkat);
		
		if($tingkat == '2'){
			$data->where('pro_id',$prov);
		}
		
		if($tingkat == '3'){
			$data->where('kab_id',$kab);
		}
		$dataas = $data->get();
		echo '<option value="0" selected="selected">--- Dapil ---</option>';
		foreach ($dataas as $tmp) {
				echo '<option value="'.$tmp->dapil_id.'">'.$tmp->nama_dapil.'</option>';
		}
	}
	public function getDataOption($jenis) {
		$prov = @$_GET['prov'];
		$kab = @$_GET['kab'];
		$kec = @$_GET['kec'];
		$kel = @$_GET['kel'];
		if($jenis == 'kab') {
			$data = DB::table('m_geo_kab')
				->where('geo_prov_id',$prov)
					->get();
			echo '<option value="0" disabled selected="selected">--- Kabupaten ---</option>';
			foreach ($data as $tmp) {
				echo '<option value="'.$tmp->geo_kab_id.'">'.$tmp->geo_kab_nama.'</option>';
			}
		} else if($jenis == 'kec') {
			$data = DB::table('m_geo_kec')
				->where('geo_kab_id',$kab)
					->get();
			echo '<option value="">--- Kecamatan ---</option>';
			foreach ($data as $tmp) {
				echo '<option value="'.$tmp->geo_kec_id.'">'.$tmp->geo_kec_nama.'</option>';
			}
		} else if($jenis == 'kel') {
			$data = DB::table('m_geo_deskel')
				->where('geo_kec_id',$kec)
					->get();
			echo '<option value="">--- Kelurahan ---</option>';
			foreach ($data as $tmp) {
				echo '<option value="'.$tmp->geo_deskel_id.'">'.$tmp->geo_deskel_nama.'</option>';
			}
		} else if($jenis == 'rw') {
			$data = DB::table('m_geo_rw')
				->where('geo_deskel_id',$kel)
					->get();
			echo '<option value="">--- RW ---</option>';
			foreach ($data as $tmp) {
				echo '<option value="'.$tmp->geo_rw_id.'">'.$tmp->geo_rw_nama.'</option>';
			}
		}
		
	}
	public function getDataOptionKPU($jenis) {
		$prov = @$_GET['prov'];
		$kab = @$_GET['kab'];
		$kec = @$_GET['kec'];
		$kel = @$_GET['kel'];
		$rw = @$_GET['rw'];
		if($jenis == 'kab') {
			$data = DB::table('m_geo_kab_kpu')
				->where('geo_prov_id',$prov)
					->get();
			echo '<option value="">--- Kabupaten ---</option>';
			foreach ($data as $tmp) {
				echo '<option value="'.$tmp->geo_kab_id.'">'.$tmp->geo_kab_nama.'</option>';
			}
		} else if($jenis == 'kec') {
			$data = DB::table('m_geo_kec_kpu')
				->where('geo_kab_id',$kab)
					->get();
			echo '<option value="">--- Kecamatan ---</option>';
			foreach ($data as $tmp) {
				echo '<option value="'.$tmp->geo_kec_id.'">'.$tmp->geo_kec_nama.'</option>';
			}
		} else if($jenis == 'kel') {
			$data = DB::table('m_geo_deskel_kpu')
				->where('geo_kec_id',$kec)
					->get();
			echo '<option value="">--- Kelurahan ---</option>';
			foreach ($data as $tmp) {
				echo '<option value="'.$tmp->geo_deskel_id.'">'.$tmp->geo_deskel_nama.'</option>';
			}
		} else if($jenis == 'rw') {
			$data = DB::table('m_geo_rw')
				->where('geo_deskel_id',$kel)
					->get();
			echo '<option value="">--- RW ---</option>';
			foreach ($data as $tmp) {
				echo '<option value="'.$tmp->geo_rw_id.'">'.$tmp->geo_rw_nama.'</option>';
			}
		} else if($jenis == 'rt') {
			$data = DB::table('m_geo_rt')
				->where('geo_rw_id',$rw)
					->get();
			echo '<option value="">--- RT ---</option>';
			foreach ($data as $tmp) {
				echo '<option value="'.$tmp->geo_rt_id.'">'.$tmp->geo_rt_nama.'</option>';
			}
		}
		
	}
	
	public function provinsi()
	{
		$kodeProv = @$_GET['provinsi'];
		$kab_kota = DB::table('kabupaten')
			->where('id_provinsi',$kodeProv)
			->groupBy('id_kabupaten')
			->get();
		echo '<option value="">--- Kabupaten / Kota ---</option>';
		foreach ($kab_kota as $key) {
			echo '<option value="'.$key->id_kabupaten.'">'.$key->Nama_kabupaten.'</option>';
		}
	}
	public function kabKota()
	{
		$kodeProv = @$_GET['provinsi'];
		$kodeKab  = @$_GET['kab_kota'];
		$kecamatan = DB::table('inf_lokasi')
			->where('provinsi',$kodeProv)
			->where('kabupaten_kota',$kodeKab)
			->where('kecamatan','!=',00)
			->where('kelurahan',00)
			->get();
		echo '<option value="">--- Pilih Kecamatan ---</option>';
		foreach ($kecamatan as $key) {
			echo '<option value="'.$key->kecamatan.'">'.$key->lokasi.'</option>';
		}

	}
	public function kecamatan()
	{
		$kodeProv = @$_GET['provinsi'];
		$kodeKab = @$_GET['kab_kota'];
		$kodeKec = @$_GET['kecamatan'];
		$kelurahan = DB::table('inf_lokasi')
			->where('provinsi',$kodeProv)
			->where('kabupaten_kota',$kodeKab)
			->where('kecamatan',$kodeKec)
			->where('kelurahan','!=',00)
			->get();
		echo '<option value="">--- Pilih Kelurahan ---</option>';
		foreach ($kelurahan as $key) {
			echo '<option value="'.$key->kelurahan.'">'.$key->lokasi.'</option>';
		}
	}
	public function kelurahan()
	{
		$kodeProv = @$_GET['provinsi'];
		$kodeKab = @$_GET['kab_kota'];
		$kodeKec = @$_GET['kecamatan'];
		$kodeKel = @$_GET['kelurahan'];
		$dataAgama = DB::table('inf_agama')->get();
		$dataSukuBangsa = DB::table('inf_suku_bangsa')->get();
		$dataPekerjaan = DB::table('inf_pekerjaan')->get();
		$dataUmur = DB::table('inf_umur')->get();
		$dataPendidikan = DB::table('inf_pendidikan')->get();
		return view('main.dashboard.response.index', array(
			'kodeProv'  => $kodeProv,
			'kodeKab'   => $kodeKab,
			'dataAgama' => $dataAgama,
			'dataSukuBangsa' => $dataSukuBangsa,
			'dataPekerjaan' => $dataPekerjaan,
			'dataUmur' => $dataUmur,
			'dataPendidikan' => $dataPendidikan,
			'kodeProv' => $kodeProv,
			'kodeKab' => $kodeKab,
			'kodeKec' => $kodeKec,
			'kodeKel' => $kodeKel
		));
	}

	public function getDataDetail(){
		$key = Input::get('key');
		$arr = array();
		$getData = DB::table('m_bio')
			->select('*','tmpLahir.geo_kab_nama as daerahTempatLahir')
			->leftjoin('m_geo_kab_kpu as tmpLahir','tmpLahir.geo_kab_id','=','m_bio.bio_tempat_lahir')
			->leftjoin('m_geo_prov_kpu as tmpTinggalProv','tmpTinggalProv.geo_prov_id','=','m_bio.bio_provinsi')
			->leftjoin('m_geo_kab_kpu as tmpTinggalKab','tmpTinggalKab.geo_kab_id','=','m_bio.bio_kabupaten')
			->leftjoin('m_geo_kec_kpu as tmpTinggalKec','tmpTinggalKec.geo_kec_id','=','m_bio.bio_kecamatan')
			->leftjoin('m_geo_deskel_kpu as tmpTinggalDeskel','tmpTinggalDeskel.geo_deskel_id','=','m_bio.bio_kelurahan')
			->leftjoin('ref_identitas','ref_identitas.identitas_id','=','m_bio.bio_jenis_identitas')
			->leftjoin('ref_jk','ref_jk.jk_id','=','m_bio.bio_jenis_kelamin')
			->leftjoin('ref_agama','ref_agama.agama_id','=','m_bio.bio_agama')
			->leftjoin('ref_status','ref_status.status_id','=','m_bio.bio_status_kawin')
					->where('m_bio.bio_id',$key)
						->get();
		foreach ($getData as $get) {
			$arr = array(
				"nama_lengkap"  => $get->bio_nama_depan,
				"jenis_identitas" => $get->identitas_value,
				"no_id"    		=> $get->bio_nomer_identitas,
				"tempat_lahir" 	=> $get->bio_tempat_lahir,
				"tgl_lahir"		=> $get->bio_tanggal_lahir,
				"jenkel"   		=> $get->bio_jenis_kelamin,
				"status_nikah" 	=> $get->bio_status_kawin,
				"nama_pasangan"	=> $get->bio_nama_pasangan,
				"alamat"   		=> $get->bio_alamat,
				"kecamatan"		=> $get->geo_kec_nama,
				"kabupaten"		=> $get->geo_kab_nama,
				"provinsis" 	=> $get->geo_prov_nama,
				"agama"    		=> $get->agama_value,
			);
		}
		
		$hasil = "";
		
		foreach($getData as $tmp){
			$hasil = $tmp?:'-';
		}
		
		return json_encode($hasil);
	}

	public function getDataDetailVerif(){
		$key = Input::get('key');
		$arr = array();
		$getData = DB::table('m_verifikasi')
						->where('m_verifikasi.verifikasi_id',$key)
							->get();
		foreach ($getData as $get) {
			$arr = array(
				"verifikasi_id"  				=> $get->verifikasi_id,
				"verifikasi_tingkat" 			=> $get->verifikasi_tingkat,
				"verifikasi_nama"				=> $get->verifikasi_nama,
				"verifikasi_status_kantor" 		=> $get->verifikasi_status_kantor,
				"verifikasi_alamat_kantor"		=> $get->verifikasi_alamat_kantor,
				"verifikasi_ibukota"   			=> $get->verifikasi_ibukota,
				"verifikasi_keaktifan_pengurus" => $get->verifikasi_keaktifan_pengurus,
				"verifikasi_perempuan"			=> $get->verifikasi_perempuan,
				"verifikasi_jumlah_kta"   		=> $get->verifikasi_jumlah_kta,
				"verifikasi_ruang_kerja_k"		=> $get->verifikasi_ruang_kerja_k,
				"verifikasi_ruang_kerja_s"		=> $get->verifikasi_ruang_kerja_s,
				"verifikasi_ruang_kerja_b"		=> $get->verifikasi_ruang_kerja_b,
				"verifikasi_staf_admin"			=> $get->verifikasi_staf_admin,
				"verifikasi_papan_nama" 		=> $get->verifikasi_papan_nama,
				"verifikasi_papan_nama_img"    	=> $get->verifikasi_papan_nama_img,
				"verifikasi_preswapres"    		=> $get->verifikasi_preswapres,
				"verifikasi_garuda"    			=> $get->verifikasi_garuda,
				"verifikasi_ketum_sekjen"    	=> $get->verifikasi_ketum_sekjen,	
				"verifikasi_nomer_rekening"    	=> $get->verifikasi_nomer_rekening,	
				"key"							=> $key				
 				);
		}
		
		$hasil = "";
		
		foreach($getData as $tmp){
			$hasil = $tmp?:'-';
		}
		
		return json_encode($hasil);
	}

	public function getDataDetailWilayah($jenis){
		$prov = @$_GET['prov'];
		$kab = @$_GET['kab'];
		$kec = @$_GET['kec'];
		$kel = @$_GET['kel'];
		$rw = @$_GET['rw'];
		$tps = @$_GET['tps'];
		$rt = @$_GET['rt'];
		$arr = array();
		if ($jenis == 'prov') {
			$getData = DB::table('m_geo_prov_kpu')
						->where('m_geo_prov_kpu.geo_prov_id',$prov)
							->get();
			foreach ($getData as $get) {
			$arr = array(
				"geo_prov_id"  	=> $get->geo_prov_id,
				"geo_prov_nama" => $get->geo_prov_nama,
 				);
			}
		} elseif ($jenis == 'kab') {
			$getData = DB::table('m_geo_kab_kpu')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_kab_kpu.geo_kab_id',$kab)
							->get();
			foreach ($getData as $get) {
			$arr = array(
				"geo_kab_nama"  => $get->geo_kab_nama,
				"geo_prov_nama" => $get->geo_prov_nama,
 				);
			}
		} elseif ($jenis == 'kec') {
			$getData = DB::table('m_geo_kec_kpu')
						->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_kec_kpu.geo_kec_id',$kec)
							->get();
			foreach ($getData as $get) {
			$arr = array(
				"geo_kec_nama"  => $get->geo_kec_nama,
				"geo_kab_nama"  => $get->geo_kab_nama,
				"geo_prov_nama" => $get->geo_prov_nama,
 				);
			}
		} elseif ($jenis == 'kel') {
			$getData = DB::table('m_geo_deskel_kpu')
						->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
						->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_deskel_kpu.geo_deskel_id',$kel)
							->get();

			foreach ($getData as $get) {
			$arr = array(
				"geo_deskel_nama"  => $get->geo_deskel_nama,
				"geo_kec_nama"  => $get->geo_kec_nama,
				"geo_kab_nama"  => $get->geo_kab_nama,
				"geo_prov_nama" => $get->geo_prov_nama,
 				);
			}
		} elseif ($jenis == 'rw') {
			$getData = DB::table('m_geo_rw')
						->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
						->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
						->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_rw.geo_rw_id',$rw)
							->get();

			foreach ($getData as $get) {
			$arr = array(
				"geo_rw_nama"	=> $get->geo_rw_nama,
				"geo_deskel_nama"  => $get->geo_deskel_nama,
				"geo_kec_nama"  => $get->geo_kec_nama,
				"geo_kab_nama"  => $get->geo_kab_nama,
				"geo_prov_nama" => $get->geo_prov_nama,
 				);
			}
		} elseif ($jenis == 'rt') {
			$getData = DB::table('m_geo_rt')
						->join('m_geo_rw','m_geo_rw.geo_rw_id','=','m_geo_rt.geo_rw_id')
						->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
						->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
						->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_rt.geo_rt_id',$rt)
							->get();

			foreach ($getData as $get) {
			$arr = array(
				"geo_rt_nama"	=> $get->geo_rt_nama,
				"geo_rw_nama"	=> $get->geo_rw_nama,
				"geo_deskel_nama"  => $get->geo_deskel_nama,
				"geo_kec_nama"  => $get->geo_kec_nama,
				"geo_kab_nama"  => $get->geo_kab_nama,
				"geo_prov_nama" => $get->geo_prov_nama,
 				);
			}
		} elseif ($jenis == 'tps') {
			$getData = DB::table('m_geo_tps')
						->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_tps.geo_deskel_id')
						->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
						->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_tps.geo_tps_id',$tps)
							->get();

			foreach ($getData as $get) {
			$arr = array(
				"geo_tps_nama"	=> $get->geo_tps_nama,
				"geo_deskel_nama"  => $get->geo_deskel_nama,
				"geo_kec_nama"  => $get->geo_kec_nama,
				"geo_kab_nama"  => $get->geo_kab_nama,
				"geo_prov_nama" => $get->geo_prov_nama,
 				);
			}
		}
		
		
		$hasil = "";
		
		foreach($getData as $tmp){
			$hasil = $tmp?:'-';
		}
		
		return json_encode($hasil);
	}
	
	public function detailPenduduk(){
		$jenis = @$_GET['jenis'];
		$prov = @$_GET['prov'];
		$kab = @$_GET['kab'];
		$id = @$_GET['id'];
		$arr = array();
		if ($jenis == 'group') {
			$getData = DB::table('m_penduduk')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_penduduk.geo_prov_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_penduduk.geo_kab_id')
					->select(DB::raw('*,sum(penduduk_jumlah) as penduduk_jumlah, count("geo_kab_id") as jumlah_kab'),'m_geo_prov_kpu.geo_prov_nama as prov_nama','m_geo_kab_kpu.geo_kab_nama as kab_nama')
					->whereNotNull('m_penduduk.geo_prov_id')
					->where('m_penduduk.geo_prov_id',$prov)
					->groupBy('m_penduduk.geo_prov_id')
					->get();
			foreach ($getData as $get) {
			$arr = array(
				"geo_prov_nama" => $get->geo_prov_nama,
				"penduduk_jumlah" => $get->penduduk_jumlah,
				"jumlah_kab" => $get->jumlah_kab,
					);
			}
		} else {
			$getData = DB::table('m_penduduk')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_penduduk.geo_prov_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_penduduk.geo_kab_id')
					->where('m_penduduk.penduduk_id',$id)
					->get();
			foreach ($getData as $get) {
			$arr = array(
				"geo_prov_nama" => $get->geo_prov_nama,
				"geo_kab_nama" => $get->geo_kab_nama,
				"penduduk_jumlah" => $get->penduduk_jumlah,
					);
			}
		}

		foreach($getData as $tmp){
			$hasil = $tmp?:'-';
		}
		
		return json_encode($hasil);
		
	}
	public function detailStatistik(){
		$id = @$_GET['id'];
		$arr = array();
		$getData = DB::table('m_pengurus')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_pengurus.geo_prov_id')
					->where('m_pengurus.pengurus_id',$id)
					->get();
		foreach ($getData as $get) {
		$arr = array(
			"geo_prov_nama" => $get->geo_prov_nama,
			"pengurus_pimcab_ada" => $get->pengurus_pimcab_ada,
			"pengurus_pimcab" => $get->pengurus_pimcab,
			"pengurus_pimcam_ada" => $get->pengurus_pimcam_ada,
			"pengurus_ranting_ada" => $get->pengurus_ranting_ada,
			"pengurus_ranting" => $get->pengurus_ranting,
			"pengurus_anak_ranting_ada" => $get->pengurus_anak_ranting_ada,
			"pengurus_anak_ranting" => $get->pengurus_anak_ranting,
			"pengurus_kpa_ada" => $get->pengurus_kpa_ada,
			"pengurus_kpa" => $get->pengurus_kpa,
			"pengurus_pimcam" => $get->pengurus_pimcam,
				);
		}
		$hasil = "";
		
		foreach($getData as $tmp){
			$hasil = $tmp?:'-';
		}
		
		return json_encode($hasil);
	}

	public function search_anggota_partai(){
		$nik = Input::get('nik');
		$data = DB::table('m_bio')->leftJoin('ref_jk', 'm_bio.bio_jenis_kelamin', '=', 'ref_jk.jk_id')->where('bio_nomer_identitas', 'LIKE', '%'.$nik.'%')->get();
		$no = 1;
		foreach($data as $tmp){
			$namaLengkap = array();
			array_push($namaLengkap,ucwords(strtolower($tmp->bio_nama_depan)),ucwords(strtolower($tmp->bio_nama_tengah)),ucwords(strtolower($tmp->bio_nama_belakang)));
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo join(' ',$namaLengkap); ?></td>
				<td><?php echo ($tmp->jk_alias != '')?$tmp->jk_alias:'-'; ?></td>
				<td><?php echo ($tmp->bio_tanggal_lahir != '')?date('d-m-Y',strtotime($tmp->bio_tanggal_lahir)):'-' ?></td>
				<td><?php echo ($tmp->bio_telephone != '')?$tmp->bio_telephone:'-'; ?></td>
				<td><?php echo ($tmp->bio_email != '')?$tmp->bio_email:'-'; ?></td>
				<td><?php echo ($tmp->bio_alamat != '')?$tmp->bio_alamat:'-'; ?></td>
				<td>
				  <div onclick="detailUser('<?php echo $tmp->bio_id ?>')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail"><i class="fa fa-search"></i></div>								
				  <div onclick="editUser('<?php echo $tmp->bio_id ?>')" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit"></i></div>
				  <a href="<?php echo asset('input/hapus/user_management/'.$tmp->bio_id)?>" onclick="return confirm('Apakah anda yakin ingin menhapus data ini?');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
				  <div onclick="printUser('<?php echo $tmp->bio_id ?>')" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print"><i class="fa fa-print"></i></div>
				</td>
			</tr>
			<?php
		}
	}

	public function getKtpBio($search){
		if(ctype_digit($search) !== false){
			$data = DB::table('m_bio')
			->select(
				'm_bio.bio_id as val',
				DB::raw('CONCAT_WS(" ",bio_nama_depan,bio_nama_tengah,bio_nama_belakang) as text')
			)
			->where("m_bio.bio_nomer_identitas","like","%$search%")
			->where("menjabat","=",null)
			->orWhere("menjabat","=",0)
			->get();
		}else{
			$data = DB::table('m_bio')
			->select(
				'm_bio.bio_id as val',
				DB::raw('CONCAT_WS(" ",bio_nama_depan,bio_nama_tengah,bio_nama_belakang) as text')
			)
			->where(DB::raw('CONCAT_WS(" ",bio_nama_depan,bio_nama_tengah,bio_nama_belakang)'),"like","%$search%")
			->where("menjabat","=",null)
			->orWhere("menjabat","=",0)
			->get();
		}
		echo json_encode($data);
	}

	public function getNamaBio($search){
		$data = DB::table('m_bio')
			->select(
				'm_bio.bio_id as val',
				DB::raw('CONCAT_WS(" ",bio_nama_depan,bio_nama_tengah,bio_nama_belakang) as text')
			)
			->where(DB::raw('CONCAT_WS(" ",bio_nama_depan,bio_nama_tengah,bio_nama_belakang)'),"like","%$search%")
			->where("menjabat","=",null)
			->whereOr("menjabat","=",0)
			->get();
		echo json_encode($data);
	}
}