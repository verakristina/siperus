<?php  

use Illuminate\Support\Str;


/**
* 
*/
class HelperData
{
	public static function getDataUser($session = 'belum')
	{
		$d_admin = DB::table('m_users')
			->leftjoin('m_bio','m_bio.bio_id','=','m_users.bio_id')
			->join('ref_akses','ref_akses.akses_id','=','m_users.role')
				->where('id',session($session))
					->get();

		return $d_admin;
	}
	public static function getMenu()
	{
		$session = session('idLogin');
		$d_menu  = DB::table('ref_role_menu')
			->join('m_users', 'm_users.role','=','ref_role_menu.status')
			->join('ref_menu', 'ref_menu.id','=','ref_role_menu.menu_id')
			->where('m_users.id', $session)
			->where('ref_menu.menu_parent','=','0')
			->where('ref_menu.order_menu','!=','0')
			->orderBy('ref_menu.order_menu')
			->get();
		return $d_menu;
	}
	
	public static function getWakilData($idKetua)
	{
		$dataPilkada = DB::table('caleg_drh')
			->leftjoin('kabupaten','caleg_drh.kabupaten','=','kabupaten.id_kabupaten')
			->leftjoin('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
			->leftjoin('surat_keputusan','surat_keputusan.no_sk','=','caleg_drh.no_sk')
			->where('caleg_drh.jenis_calon','!=','')
			->where('caleg_drh.id_ketua',$idKetua)
			->where('caleg_drh.parent',1)
			->groupBy('caleg_drh.nama')
			->get();

		foreach ($dataPilkada as $key) {
			if($key->nama != ''){ $nama = $key->nama; } else { $nama = '-'; }
			if($key->pekerjaan != ''){ $pekerjaan = $key->pekerjaan; } else { $pekerjaan = '-'; }
			if($key->jenis_kelamin != ''){ $jk = $key->jenis_kelamin; } else { $jk = '-'; }

			$data = '
			<td>'.$nama.'</td>
			<td>'.$pekerjaan.'</td>
			<td>'.$jk.'</td>';
			return $data;
		}
		
	}
	public static function getNamaWakil($idKetua)
	{
		$dataPilkada = DB::table('caleg_drh')
			->leftjoin('kabupaten','caleg_drh.kabupaten','=','kabupaten.id_kabupaten')
			->leftjoin('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
			->leftjoin('surat_keputusan','surat_keputusan.no_sk','=','caleg_drh.no_sk')
			//->where('caleg_drh.jenis_calon','!=','')
			//->where('caleg_drh.id_ketua',$idKetua)
			->where('caleg_drh.parent',1)
			->groupBy('caleg_drh.nama')
			->get();

		foreach ($dataPilkada as $key) {
			return $key->nama;
		}
	}
	public static function getPekerjaanWakil($idKetua)
	{
		$dataPilkada = DB::table('caleg_drh')
			->leftjoin('kabupaten','caleg_drh.kabupaten','=','kabupaten.id_kabupaten')
			->leftjoin('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
			->leftjoin('surat_keputusan','surat_keputusan.no_sk','=','caleg_drh.no_sk')
			->where('caleg_drh.jenis_calon','!=','')
			->where('caleg_drh.id_ketua',$idKetua)
			->where('caleg_drh.parent',1)
			->groupBy('caleg_drh.nama')
			->get();

		foreach ($dataPilkada as $key) {
			return $key->pekerjaan;
		}
	}
	public static function getJenkelWakil($idKetua)
	{
		$dataPilkada = DB::table('caleg_drh')
			->leftjoin('kabupaten','caleg_drh.kabupaten','=','kabupaten.id_kabupaten')
			->leftjoin('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
			->leftjoin('surat_keputusan','surat_keputusan.no_sk','=','caleg_drh.no_sk')
			->where('caleg_drh.jenis_calon','!=','')
			->where('caleg_drh.id_ketua',$idKetua)
			->where('caleg_drh.parent',1)
			->groupBy('caleg_drh.nama')
			->get();

		foreach ($dataPilkada as $key) {
			return $key->jenis_kelamin;
		}
	}
	public static function getJenisIdentitas($idKetua)
	{
		$dataPilkada = DB::table('caleg_drh')
			->leftjoin('kabupaten','caleg_drh.kabupaten','=','kabupaten.id_kabupaten')
			->leftjoin('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
			->leftjoin('surat_keputusan','surat_keputusan.no_sk','=','caleg_drh.no_sk')
			->where('caleg_drh.jenis_calon','!=','')
			->where('caleg_drh.id_ketua',$idKetua)
			->where('caleg_drh.parent',1)
			->groupBy('caleg_drh.nama')
			->get();

		foreach ($dataPilkada as $key) {
			return $key->jenis_identitas;
		}
	}
	public static function getTempatLahir($idKetua)
	{
		$dataPilkada = DB::table('caleg_drh')
			->leftjoin('kabupaten','caleg_drh.kabupaten','=','kabupaten.id_kabupaten')
			->leftjoin('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
			->leftjoin('surat_keputusan','surat_keputusan.no_sk','=','caleg_drh.no_sk')
			->where('caleg_drh.jenis_calon','!=','')
			->where('caleg_drh.id_ketua',$idKetua)
			->where('caleg_drh.parent',1)
			->groupBy('caleg_drh.nama')
			->get();

		foreach ($dataPilkada as $key) {
			return $key->tempat_lahir;
		}
	}
	public static function getAgama($idKetua)
	{
		$dataPilkada = DB::table('caleg_drh')
			->leftjoin('kabupaten','caleg_drh.kabupaten','=','kabupaten.id_kabupaten')
			->leftjoin('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
			->leftjoin('surat_keputusan','surat_keputusan.no_sk','=','caleg_drh.no_sk')
			->where('caleg_drh.jenis_calon','!=','')
			->where('caleg_drh.id_ketua',$idKetua)
			->where('caleg_drh.parent',1)
			->groupBy('caleg_drh.nama')
			->get();

		foreach ($dataPilkada as $key) {
			return $key->agama;
		}
	}
	public static function getNoTelp($idKetua)
	{
		$dataPilkada = DB::table('caleg_drh')
			->leftjoin('kabupaten','caleg_drh.kabupaten','=','kabupaten.id_kabupaten')
			->leftjoin('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
			->leftjoin('surat_keputusan','surat_keputusan.no_sk','=','caleg_drh.no_sk')
			->where('caleg_drh.jenis_calon','!=','')
			->where('caleg_drh.id_ketua',$idKetua)
			->where('caleg_drh.parent',1)
			->groupBy('caleg_drh.nama')
			->get();

		foreach ($dataPilkada as $key) {
			return $key->telephone;
		}
	}
	public static function getTanggalLahir($idKetua)
	{
		$dataPilkada = DB::table('caleg_drh')
			->leftjoin('kabupaten','caleg_drh.kabupaten','=','kabupaten.id_kabupaten')
			->leftjoin('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
			->leftjoin('surat_keputusan','surat_keputusan.no_sk','=','caleg_drh.no_sk')
			->where('caleg_drh.jenis_calon','!=','')
			->where('caleg_drh.id_ketua',$idKetua)
			->where('caleg_drh.parent',1)
			->groupBy('caleg_drh.nama')
			->get();

		foreach ($dataPilkada as $key) {
			return $key->tanggal_lahir;
		}
	}
	public static function getParpolPendukung($idCaleg,$type)
	{
		$dataPartai = DB::table('caleg_drh')
			->join('caleg_terpilih','caleg_terpilih.caleg_id','=','caleg_drh.id')
			->leftjoin('partai','partai.ID','=','caleg_terpilih.partai_id')
			->where('caleg_drh.id',$idCaleg)
			->get();
		$nama_partai ='';
		$i=1;
		foreach ($dataPartai as $key) {
			if($type == 'parpol')
			{
				$nama_partai .= $i++.'. '.$key->NAMA_PARTAI.'<br>';
			} else {
				$nama_partai = '';
			}
		}

		return $nama_partai;
	}
	public static function getAllParpol($caleg_id)
	{
		$dataPartai = DB::table('caleg_drh')
			->join('caleg_terpilih','caleg_terpilih.caleg_id','=','caleg_drh.id')
			->leftjoin('partai','partai.ID','=','caleg_terpilih.partai_id')
			->where('caleg_drh.id',$caleg_id)
			->get();
		return $dataPartai;
	}
	public static function getNamaProvinsi($id)
	{
		$data = DB::table('provinsi')
			->where('id_provinsi',$id)
			->get();
		foreach ($data as $key) {
			return $key->Nama_provinsi;
		}
	}
	public static function getNamaKabupaten($id)
	{
		$data = DB::table('kabupaten')
			->where('id_kabupaten',$id)
			->get();
		foreach ($data as $key) {
			return $key->Nama_kabupaten;
		}
	}
	public static function getData($provinsi,$kabupaten,$type)
	{
		if($type == '')
		{
			$dataKetua = DB::table('caleg_drh')
			->where('provinsi',$provinsi)
			->where('kabupaten',$kabupaten)
			->get();
			return $dataAll;
		} else if($type == 'Ketua') {
			$dataKetua = DB::table('caleg_drh')
			->where('provinsi',$provinsi)
			->where('kabupaten',$kabupaten)
			->where('id_ketua','')
			->get();
			return $dataKetua;
		} else if($type == 'Wakil') {
			$dataWakil = DB::table('caleg_drh')
			->where('provinsi',$provinsi)
			->where('kabupaten',$kabupaten)
			->where('id_ketua','!=','')
			->get();
			return $dataWakil;
		} else {
			echo "Cannot read this type";
		}
	}
	public static function getLastId($table) 
	{
		$last = DB::table($table)->orderBy('tgl','desc')->first();
		if(count($last) == 0){
			$nomer = '';
		}else{
			$nomer = $last->id+1;		
		}
		return $nomer;
	}
	public static function getNama($table,$fieldWhere,$where,$fieldNama)
	{
		$data = DB::table($table)
			->where($fieldWhere,$where)
			->get();
		foreach ($data as $key) {
			return $key->$fieldNama;
		}
	}

	public static function getLatLng($latlng){
		
		$API = array(
			'AIzaSyAOiVUskIMhtW0F-iuUdIZB5BlCcCv15L0',
			'AIzaSyARRoRCq1MhYM75binMUr1yrHL6dCMP1M4',
			'AIzaSyBxxg7GU970GNltY8nKbDBfHBwupPCxilw',
			'AIzaSyBOl44-_pE5C_iJqkG92-ZgvLG1qR-2s_8',
			'AIzaSyBoI_HtUeYAAD54BztKOcNCzBxMrjVuesI',
			'AIzaSyBVnrDPRsyvdQ5EDLGgxAHsoOKYKPWzxwQ',
			'AIzaSyACTKWr3kPIOnE0NvroZt4apoI-UC_jxYw',
			'AIzaSyD9tMCzv7Dwan8ALr_3fXLkEds1QR8zaOc',
			'AIzaSyDeaJmIyw2gnwRXTiFdVRIDXrpSp7x7WBY',
			'AIzaSyDtx1Uyl4wIx7NHywHiAcaD0_R853PAnPQ',
			'AIzaSyCHqPlwwWPm9u0imL0mx_np6ynPGKarNsE',
			'AIzaSyDjqTndhIJrDg_1jgkSiQsiEmy41cmiceQ',
			'AIzaSyBpoSqpnaO1_oyLVG-tNnom7PECYSRDXD4',
			'AIzaSyDN8hm14-acSTYEtX2qGAGgzGiA838ts9o',
			'AIzaSyCBd_YW5npyGGR_vnkmLuKqHih3dOk3wAw',
			'AIzaSyBO880JJbz6Kqag9DVVa0rHacGAYYHVuhQ',
			'AIzaSyB3xFGOmJvIkdlkd4-1Yb1mjfX3Wlhxgdc',
			'AIzaSyCpnG5fCkbeFw2GuvMxZY6S7lPthfgb0UQ',
			'AIzaSyB2lAxhdBncPhaFROgXr2C13YewfDHesnQ',
			'AIzaSyDH9ofN8YNJXlM8vUAAE7wwq3pW_L7QlQQ',
			'AIzaSyDABTScFEh6XWv43KRiFL_G-tGWLLYKwE0',
			'AIzaSyAmoG4IBp0vp6NkilEbh93xHj2YTYgFz60'
		);

		do {
			$latlng = urlencode($latlng);
		    // google map geocode api url
			
			$url = "https://maps.googleapis.com/maps/api/geocode/json?key=".$API[rand(0,count($API)-1)]."&address=".$latlng."&sensor=true";
		    // get the json response
			
		    $resp_json = file_get_contents($url);
		     
		    // decode the json
		    $resp = json_decode($resp_json, true);
		 
		    // response status will be 'OK', if able to geocode given address 
		    if($resp['status']=='OK'){
		 
		        // get the important data
		        $geo['lat'] = $resp['results'][0]['geometry']['location']['lat'];
		        $geo['lng'] = $resp['results'][0]['geometry']['location']['lng'];
		        $geo['api'] = $API[rand(0,count($API)-1)];
		         
		        // verify if data is complete
		  
		        return $geo;
		    }else{
		        return false;
		    }
		} while ($resp['status'] != 'OK');
	}
	
}