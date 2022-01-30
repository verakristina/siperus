<?php namespace App\Http\Controllers;

use Input;
use DB;
use Request;
use Session;
use File;

class RekapController extends Controller{
	public function index_rekap($tingkat){
		$provinsi = DB::table('m_geo_prov_kpu')->get();
		/*$kabupaten = DB::table('m_geo_kab_kpu')->get();
		$kecamatan = DB::table('m_geo_kec_kpu')->get();
		$kelurahan = DB::table('m_geo_deskel_kpu')->get();*/

		if($tingkat == "dpd"){
			$selected = ['', 'none', 'none', 'none'];
		}

		if($tingkat == "dpc"){
			$selected = ['', '', 'none', 'none'];
		}

		if($tingkat == "pac"){
			$selected = ['', '', '', 'none'];
		}
		$prov = 0;
		$kab = 0;
		$getData = DB::table('tb_rekap_main')
						->join('m_geo_prov_kpu', 'tb_rekap_main.t_prov', '=', 'm_geo_prov_kpu.geo_prov_id')
						->leftJoin('m_geo_kab_kpu', 'tb_rekap_main.t_kab', '=', 'm_geo_kab_kpu.geo_kab_id')
						->leftJoin('m_geo_kec_kpu', 'tb_rekap_main.t_kec', '=', 'm_geo_kec_kpu.geo_kec_id')
						->join('tb_dskk', 'tb_rekap_main.id', '=', 'tb_dskk.id_rekap')
						->join('tb_dsks', 'tb_rekap_main.id', '=', 'tb_dsks.id_rekap')
						->join('tb_ddks', 'tb_rekap_main.id', '=', 'tb_ddks.id_rekap')
						->where('tb_rekap_main.tingkat', $tingkat)
						->select('tb_rekap_main.id as IDR',
								'tb_rekap_main.created_date',
								'tb_rekap_main.link_folder_verifikasi',
								'tb_dskk.*',
								'tb_dsks.*',
								'tb_ddks.*',
								'm_geo_prov_kpu.geo_prov_nama',
								'm_geo_kab_kpu.geo_kab_nama',
								'm_geo_kec_kpu.geo_kec_nama')
						->orderBy('tb_rekap_main.created_date', 'DESC');
						if($tingkat == "dpd"){
							$getData->groupBy('tb_rekap_main.t_prov')->get();
						}elseif($tingkat == "dpc"){
							if (Input::has('prov'))
							{
								$getData->where("tb_rekap_main.t_prov","=",Input::get('prov'))->groupBy('tb_rekap_main.t_kab')->get();
							}else{
								$getData->groupBy('tb_rekap_main.t_kab')->get();
							}
						}else{
							if(Input::has("kab")){
								$getData->where("tb_rekap_main.t_kab","=",Input::get('kab'))->groupBy('tb_rekap_main.t_kec')->get();
							}else if(Input::has('prov')){
								$getData->where("tb_rekap_main.t_prov","=",Input::get('prov'))->groupBy('tb_rekap_main.t_kec')->get();
							}else{
								$getData->groupBy('tb_rekap_main.t_kec')->get();
							}
						}
			/*dd($getData);*/
		$data = DB::table('m_geo_prov_kpu')->paginate(10);
		$breadcrumb[]='Verifikasi';
		$breadcrumb[]='List';
		return view('main.rekap.index_view', array(
			"dataRekap" => $getData,
			"provinsi" => $provinsi,
			"selected" => $selected,
			"breadcrumb" => $breadcrumb,
			"sk_baru"  => "-",
			"data" => $data,
			"tingkat" => $tingkat
		));
	}

	public function action_rekap($tingkat){
		$link = Input::get('link');
		$catatan = Input::get('catatan');
		if($tingkat == "dpd"){
			$prov = Input::get('prov');
			$id_rekap = DB::table('tb_rekap_main')
						->insertGetId([
							"tingkat" => $tingkat,
							"t_prov" => $prov,
							"link_folder_verifikasi" => $link,
							"catatan" => $catatan,
							"created_date" => date('Y-m-d H:i:s')
						]);
		}else if($tingkat == "dpc"){
			$prov = Input::get('prov');
			$kab = Input::get('kab');
			$id_rekap = DB::table('tb_rekap_main')
						->insertGetId([
							"tingkat" => $tingkat,
							"t_prov" => $prov,
							"t_kab"  => $kab,
							"link_folder_verifikasi" => $link,
							"catatan" => $catatan,
							"created_date" => date('Y-m-d H:i:s')
						]);
		}else{
			$prov = Input::get('prov');
			$kab = Input::get('kab');
			$kec = Input::get('kec');
			$id_rekap = DB::table('tb_rekap_main')
						->insertGetId([
							"tingkat" => $tingkat,
							"t_prov" => $prov,
							"t_kab"  => $kab,
							"t_kec"  => $kec,
							"link_folder_verifikasi" => $link,
							"catatan" => $catatan,
							"created_date" => date('Y-m-d H:i:s')
						]);
		}

		/* DSKK */
		$dskk_sk = Input::get('dskk_sk')?:0;

		DB::table('tb_dskk')
			->insert([
				"id_rekap" => $id_rekap,
				"sk" => $dskk_sk
			]);

		/* DDIK */
		$ddik = 0;
		$ddik_jabatan = Input::get('ddik_jabatan');
		/*$ddik_ktp = Input::get('ddik_ktp');
		$ddik_kta = Input::get('ddik_kta');*/
		while ($ddik < count($ddik_jabatan)) {
			if(!empty($ddik_jabatan[$ddik])){
				if(!empty(Input::get("ddik_ktp_".$ddik_jabatan[$ddik]))){
					$ddik_ktp_n = Input::get("ddik_ktp_".$ddik_jabatan[$ddik]);
				}else{
					$ddik_ktp_n = 0;
				}

				if(!empty(Input::get("ddik_kta_".$ddik_jabatan[$ddik]))){
					$ddik_kta_n = Input::get("ddik_kta_".$ddik_jabatan[$ddik]);
				}else{
					$ddik_kta_n = 0;
				}

				DB::table('tb_ddik')
				->insert([
					"id_rekap" => $id_rekap,
					"jabatan"  => $ddik_jabatan[$ddik],
					"ktp"      => $ddik_ktp_n,
					"kta"      => $ddik_kta_n
				]);
			}
			$ddik++;
		}
		$ddik_o_ktp = Input::get('ddik_o_ktp')?:0;
		$ddik_o_kta = Input::get('ddik_o_kta')?:0;
		DB::table('tb_ddik')
				->insert([
					"id_rekap" => $id_rekap,
					"jabatan"  => "other",
					"ktp"      => $ddik_o_ktp,
					"kta"      => $ddik_o_kta
				]);

		/* DCVP */
		$dcvp = 0;
		$dcvp_jabatan = Input::get('dcvp_jabatan');

		while($dcvp < count($dcvp_jabatan)){
			DB::table('tb_dcvp')
				->insert([
					"id_rekap" => $id_rekap,
					"jenis"	   => $dcvp_jabatan[$dcvp],
					"drh"	   => "1"
				]);
			$dcvp++;
		}
		$dcvp_o = Input::get('dcvp_o_drh')?:0;
		DB::table('tb_dcvp')
				->insert([
					"id_rekap" => $id_rekap,
					"jenis"	   => "other",
					"drh"	   => $dcvp_o
				]);

		/* DSKS */
		$f_presiden = Input::get('dsks_presiden')?:0;
		$f_garuda = Input::get('dsks_garuda')?:0;
		$f_bendera = Input::get('dsks_bendera')?:0;
		$f_ketum = Input::get('dsks_ketum')?:0;
		$f_papan_nama = Input::get('dsks_papan_nama')?:0;
		$f_kantor = Input::get('dsks_kantor')?:0;
		$f_bank = Input::get('dsks_bank')?:0;
		$f_sewa = Input::get('dsks_sewa')?:0;
		$f_kesbangpol = Input::get('dsks_kesbangpol')?:0;
		$f_keterangan = Input::get('dsks_keterangan')?:0;

		DB::table('tb_dsks')
			->insert([
				"id_rekap" => $id_rekap,
				"f_presiden" => $f_presiden,
				"f_garuda" => $f_garuda,
				"f_bendera" => $f_bendera,
				"f_ketum" => $f_ketum,
				"f_papan" => $f_papan_nama,
				"f_kantor" => $f_kantor,
				"f_bank" => $f_bank,
				"f_sewa" => $f_sewa,
				"f_kesbangpol" => $f_kesbangpol,
				"f_keterangan" => $f_keterangan
			]);

		/* DDKS */
		$ddks_domisili = Input::get('ddks_domisili')?:0;
		DB::table('tb_ddks')
			->insert([
				"id_rekap" => $id_rekap,
				"domisili" => $ddks_domisili
			]);
		return redirect('rekap/scan/'.$tingkat);
	}

	public function get_data_edit($tingkat, $id_rekap){
		if($tingkat == "dpd"){
			$selected = ['initial', 'none', 'none', 'none'];
		}

		if($tingkat == "dpc"){
			$selected = ['initial', 'initial', 'none', 'none'];
		}

		if($tingkat == "pac"){
			$selected = ['initial', 'initial', 'initial', 'none'];
		}
		$getData = DB::table('tb_rekap_main')
						->join('m_geo_prov_kpu', 'tb_rekap_main.t_prov', '=', 'm_geo_prov_kpu.geo_prov_id')
						->leftJoin('m_geo_kab_kpu', 'tb_rekap_main.t_kab', '=', 'm_geo_kab_kpu.geo_kab_id')
						->leftJoin('m_geo_kec_kpu', 'tb_rekap_main.t_kec', '=', 'm_geo_kec_kpu.geo_kec_id')
						->join('tb_dskk', 'tb_rekap_main.id', '=', 'tb_dskk.id_rekap')
						/*->join('tb_ddik', 'tb_rekap_main.id', '=', 'tb_ddik.id_rekap')
						->join('tb_dcvp', 'tb_rekap_main.id', '=', 'tb_dcvp.id_rekap')*/
						->join('tb_dsks', 'tb_rekap_main.id', '=', 'tb_dsks.id_rekap')
						->join('tb_ddks', 'tb_rekap_main.id', '=', 'tb_ddks.id_rekap')
						->where('tb_rekap_main.tingkat', $tingkat)
						->where('tb_rekap_main.id', $id_rekap)
						->select('tb_rekap_main.id as IDR',
								'tb_rekap_main.created_date',
								'tb_rekap_main.link_folder_verifikasi',
								'tb_rekap_main.catatan',
								'tb_dskk.*',
								'tb_dsks.*',
								'tb_ddks.*',
								'm_geo_prov_kpu.geo_prov_nama',
								'm_geo_kab_kpu.geo_kab_nama',
								'm_geo_kec_kpu.geo_kec_nama')
						->orderBy('tb_rekap_main.created_date', 'DESC');
						if($tingkat == "dpd"){
							$getData->groupBy('tb_rekap_main.t_prov')->get();
						}elseif($tingkat == "dpc"){
							$getData->groupBy('tb_rekap_main.t_kab')->get();
						}else{
							$getData->groupBy('tb_rekap_main.t_kec')->get();
						}
		return view('main.rekap.ajax_edit', array(
			"dataRekap" => $getData,
			"tingkat"   => $tingkat,
			"id_rekap"  => $id_rekap,
			"selected"  => $selected
		));
	}

	public function edit_action_rekap($tingkat, $id_rekap){
		$link = Input::get('link');
		$catatan = Input::get('catatan');
		if($tingkat == "dpd"){
			$prov = Input::get('prov');
			DB::table('tb_rekap_main')
						->where('id', $id_rekap)
						->update([
							"link_folder_verifikasi" => $link,
							"catatan" => $catatan
						]);
		}else if($tingkat == "dpc"){
			$prov = Input::get('prov');
			$kab = Input::get('kab');
			DB::table('tb_rekap_main')
						->where('id', $id_rekap)
						->update([
							"link_folder_verifikasi" => $link,
							"catatan" => $catatan,
						]);
		}else{
			$prov = Input::get('prov');
			$kab = Input::get('kab');
			$kec = Input::get('kec');
			DB::table('tb_rekap_main')
						->where('id', $id_rekap)
						->update([
							"link_folder_verifikasi" => $link,
							"catatan" => $catatan
						]);
		}

		/* DSKK */
		$dskk_sk = Input::get('dskk_sk')?:0;

		DB::table('tb_dskk')
			->where('id_rekap', $id_rekap)
			->update([
				"sk" => $dskk_sk
			]);

		/* DDIK */
		$ddik = 0;
		$ddik_jabatan = Input::get('ddik_jabatan');
		/*$ddik_ktp = Input::get('ddik_ktp');
		$ddik_kta = Input::get('ddik_kta');*/
		while ($ddik < count($ddik_jabatan)) {
			if(!empty($ddik_jabatan[$ddik])){
				if(!empty(Input::get("ddik_ktp_".$ddik_jabatan[$ddik]))){
					$ddik_ktp_n = Input::get("ddik_ktp_".$ddik_jabatan[$ddik]);
				}else{
					$ddik_ktp_n = 0;
				}

				if(!empty(Input::get("ddik_kta_".$ddik_jabatan[$ddik]))){
					$ddik_kta_n = Input::get("ddik_kta_".$ddik_jabatan[$ddik]);
				}else{
					$ddik_kta_n = 0;
				}

				DB::table('tb_ddik')
				->where('id_rekap', $id_rekap)
				->where('jabatan', $ddik_jabatan[$ddik])
				->update([
					"jabatan"  => $ddik_jabatan[$ddik],
					"ktp"      => $ddik_ktp_n,
					"kta"      => $ddik_kta_n
				]);
			}
			$ddik++;
		}
		$ddik_o_ktp = Input::get('ddik_o_ktp')?:0;
		$ddik_o_kta = Input::get('ddik_o_kta')?:0;
		DB::table('tb_ddik')
				->where('id_rekap', $id_rekap)
				->where('jabatan', 'other')
				->update([
					"ktp"      => $ddik_o_ktp,
					"kta"      => $ddik_o_kta
				]);

		/* DCVP */
		$dcvp = 0;
		$dcvp_jabatan = Input::get('dcvp_jabatan');

		while($dcvp < count($dcvp_jabatan)){
			DB::table('tb_dcvp')
				->where('id_rekap', $id_rekap)
				->update([
					"jenis"	   => $dcvp_jabatan[$dcvp],
					"drh"	   => "1"
				]);
			$dcvp++;
		}
		$dcvp_o = Input::get('dcvp_o_drh')?:0;
		DB::table('tb_dcvp')
				->where('id_rekap', $id_rekap)
				->where('jenis', 'other')
				->update([
					"jenis"	   => "other",
					"drh"	   => $dcvp_o
				]);

		/* DSKS */
		$f_presiden = Input::get('dsks_presiden')?:0;
		$f_garuda = Input::get('dsks_garuda')?:0;
		$f_bendera = Input::get('dsks_bendera')?:0;
		$f_ketum = Input::get('dsks_ketum')?:0;
		$f_papan_nama = Input::get('dsks_papan_nama')?:0;
		$f_kantor = Input::get('dsks_kantor')?:0;
		$f_bank = Input::get('dsks_bank')?:0;
		$f_sewa = Input::get('dsks_sewa')?:0;
		$f_kesbangpol = Input::get('dsks_kesbangpol')?:0;
		$f_keterangan = Input::get('dsks_keterangan')?:0;

		DB::table('tb_dsks')
			->where('id_rekap', $id_rekap)
			->update([
				"id_rekap" => $id_rekap,
				"f_presiden" => $f_presiden,
				"f_garuda" => $f_garuda,
				"f_bendera" => $f_bendera,
				"f_ketum" => $f_ketum,
				"f_papan" => $f_papan_nama,
				"f_kantor" => $f_kantor,
				"f_bank" => $f_bank,
				"f_sewa" => $f_sewa,
				"f_kesbangpol" => $f_kesbangpol,
				"f_keterangan" => $f_keterangan
			]);

		/* DDKS */
		$ddks_domisili = Input::get('ddks_domisili')?:0;
		DB::table('tb_ddks')
			->where('id_rekap', $id_rekap)
			->update([
				"domisili" => $ddks_domisili
			]);
		return redirect('rekap/scan/'.$tingkat);
	}
	public function delete_rekap($tingkat, $id_rekap){
		DB::table('tb_rekap_main')->where('id', $id_rekap)->delete();
		DB::table('tb_dskk')->where('id_rekap', $id_rekap)->delete();
		DB::table('tb_ddik')->where('id_rekap', $id_rekap)->delete();
		DB::table('tb_dcvp')->where('id_rekap', $id_rekap)->delete();
		DB::table('tb_dsks')->where('id_rekap', $id_rekap)->delete();
		DB::table('tb_ddks')->where('id_rekap', $id_rekap)->delete();

		return redirect('rekap/scan/'.$tingkat);
	}
}

?>
