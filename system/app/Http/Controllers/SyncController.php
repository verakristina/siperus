<?php namespace App\Http\Controllers;

use DB;
use Input;
use File;
use Request;

class SyncController extends Controller{

	public function index($type, $lock){
		$key  = "AsGArd14";
		if($lock != $key){
			echo "WRONG KEY!";
		}else{
			$struk = array("Ketua",
					"Sekretaris",
					"Bendahara",
					"Ketua Dewan Penasehat",
					"Wakil Ketua Dewan Penasehat",
					"Sekretaris Dewan Penasehat",
					"Anggota 1 Dewan Penasehat",
					"Anggota 2 Dewan Penasehat",
					"Anggota 3 Dewan penasehat",
					"Anggota 3 Dewan penasehat",
					"Anggota 4 Dewan penasehat",
					"Anggota 5 Dewan penasehat",
					"Anggota 6 Dewan penasehat",
					"Anggota 7 Dewan penasehat",
					"Anggota 8 Dewan penasehat",
					"Anggota 9 Dewan penasehat",
					"Anggota 10 Dewan penasehat",
					"Ketua Dewan Pakar",
					"Wakil Ketua Dewan Pakar",
					"Sekretaris Dewan Pakar",
					"Anggota 1 Dewan Pakar",
					"Anggota 2 Dewan Pakar",
					"Anggota 3 Dewan Pakar",
					"Anggota 4 Dewan Pakar",
					"Anggota 5 Dewan Pakar",
					"Anggota 6 Dewan Pakar",
					"Anggota 7 Dewan Pakar",
					"Anggota 8 Dewan Pakar",
					"Anggota 9 Dewan Pakar",
					"Anggota 10 Dewan Pakar",
					"Wakil Ketua 1",
					"Wakil Ketua 2",
					"Wakil Ketua 3",
					"Wakil Ketua 4",
					"Wakil Ketua 5",
					"Wakil Ketua 6",
					"Wakil Ketua 7",
					"Wakil Ketua 8",
					"Wakil Ketua 9",
					"Wakil Ketua 7",
					"Wakil Ketua 8",
					"Wakil Ketua 9",
					"Wakil Ketua 10",
					"Wakil Ketua 11",
					"Wakil Ketua 12",
					"Wakil Ketua 13",
					"Wakil Ketua 14",
					"Wakil Ketua 15",
					"Sekretaris",
					"Wakil Sekretaris 1",
					"Wakil sekretaris 2",
					"Wakil sekretaris 3",
					"Wakil sekretaris 4",
					"Wakil sekretaris 5",
					"Wakil sekretaris 6",
					"Wakil sekretaris 7",
					"Wakil Bendahara 1",
					"Wakil Bendahara 2",
					"Wakil Bendahara 3",
					"Wakil Bendahara 4",
					"Wakil Bendahara 5",
					"Anggota Koordinator Anak Cabang",
					"Ketua Komite Pemenangan Pemilu",
					"Wakil Ketua Komite Pemenangan Pemilu",
					"Sekretaris Komite Pemenangan Pemilu",
					"Wakil Sekretaris Komite Pemenangan Pemilu",
					"Bendahara Komite Pemenangan Pemilu",
					"Wakil Bendahara Komite Pemenangan Pemilu",
					"Anggota 1 Komite Pemenangan Pemilu",
					"Anggota 2 Komite Pemenangan Pemilu",
					"Anggota 3 Komite Pemenangan Pemilu",
					"Anggota 4 Komite Pemenangan Pemilu",
					"Anggota 5 Komite Pemenangan Pemilu",
					"Anggota 6 Komite Pemenangan Pemilu",
					"Anggota 7 Komite Pemenangan Pemilu",
					"Anggota 8 Komite Pemenangan Pemilu",
					"Anggota 9 Komite Pemenangan Pemilu",
					"Anggota 10 Komite Pemenangan Pemilu",
					"Anggota 11 Komite Pemenangan Pemilu",
					"Anggota 12 Komite Pemenangan Pemilu",
					"Anggota 13 Komite Pemenangan Pemilu",
					"Anggota 14 Komite Pemenangan Pemilu",
					"Anggota 15 Komite Pemenangan Pemilu",
					"Anggota 16 Komite Pemenangan Pemilu",
					"Anggota 17 Komite Pemenangan Pemilu",
					"Anggota 18 Komite Pemenangan Pemilu",
					"Anggota 19 Komite Pemenangan Pemilu",
					"Anggota 20 Komite Pemenangan Pemilu"
				);
		if($type == "dpd"){
			$getProv = DB::table('m_geo_prov_kpu')->get();

			foreach ($getProv as $data) {
				$index = 0;
				while ($index < count($struk)) {
					DB::table('m_struk_'.$type)
						->insert([
							"geo_prov_id" => $data->geo_prov_id,
							"struk_".$type."_nama" => $struk[$index],
							"struk_".$type."_created_date" => date("Y-m-d H:i:s"),
							"struk_".$type."_created_by" => "1"
						]);
					$index++;
				}
				echo "DONE";
			}
		}else if($type == "dpc"){
			$getKab = DB::table('m_geo_kab_kpu')->get();

			foreach ($getKab as $data) {
				$index = 0;
				while ($index < count($struk)) {
					DB::table('m_struk_'.$type)
						->insert([
							"geo_prov_id" => $data->geo_prov_id,
							"geo_kab_id" => $data->geo_kab_id,
							"struk_".$type."_nama" => $struk[$index],
							"struk_".$type."_created_date" => date("Y-m-d H:i:s"),
							"struk_".$type."_created_by" => "1"
						]);
					$index++;
				}
			}
			echo "DONE";
		}else if($type == "pac"){
			$getKec = DB::table('m_geo_kec_kpu')
						->select(
							"m_geo_kec_kpu.geo_kec_id", "m_geo_kab_kpu.geo_kab_id", "m_geo_kab_kpu.geo_prov_id"
							)
						->leftJoin("m_geo_kab_kpu", "m_geo_kec_kpu.geo_kab_id", "=", "m_geo_kab_kpu.geo_kab_id")
						->get();

			foreach ($getKec as $data) {
				$index = 0;
				while ($index < count($struk)) {
					DB::table('m_struk_'.$type)
						->insert([
							"geo_prov_id" => $data->geo_prov_id,
							"geo_kab_id" => $data->geo_kab_id,
							"geo_kec_id" => $data->geo_kec_id,
							"struk_".$type."_nama" => $struk[$index],
							"struk_".$type."_created_date" => date("Y-m-d H:i:s"),
							"struk_".$type."_created_by" => "1"
						]);
					$index++;
				}
			}
			echo "DONE";
		}
		}
	}

	public function data_transfer($type){
		if($type == "prov"){
			$getProv = DB::table('m_geo_prov_kpu')->select('geo_prov_nama', 'geo_prov_id')->get();

			foreach ($getProv as $data) {
				DB::table('m_transfer_prov')
					->insert([
						"prov_id_1" => $data->geo_prov_id,
						"prov_id_2" => "",
						"nama_prov" => $data->geo_prov_nama
					]);
			}
			echo "DONE";
		}else if($type == "kota"){
			$getKota = DB::table('m_geo_kab_kpu')
					->select('geo_kab_id', 'geo_kab_nama', 'geo_prov_id')
					->get();

			foreach ($getKota as $data) {
				DB::table('m_transfer_kab')
					->insert([
						"prov_id_1" => $data->geo_prov_id,
						"kab_id_1"  => $data->geo_kab_id,
						"nama_kab" => $data->geo_kab_nama
					]);
			}
			echo "DONE";
		}else if($type == "kec"){
			$getKec = DB::table('m_geo_kec_kpu')
						->leftJoin('m_geo_kab_kpu', 'm_geo_kec_kpu.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
						->select(
							'm_geo_kec_kpu.geo_kec_id',
							'm_geo_kec_kpu.geo_kec_nama',
							'm_geo_kab_kpu.geo_kab_id',
							'm_geo_kab_kpu.geo_prov_id'
						)
						->get();

			foreach ($getKec as $data) {
				DB::table('m_transfer_kec')
					->insert([
						"prov_id_1" => $data->geo_prov_id,
						"prov_id_2" => "",
						"kab_id_1"  => $data->geo_kab_id,
						"kab_id_2"  => "",
						"kec_id_1"  => $data->geo_kec_id,
						"kec_id_2"  => "",
						"nama_kec"  => $data->geo_kec_nama
					]);
			}
		}else if($type == "deskel"){
			$getKel = DB::table('m_geo_deskel_kpu')
						->leftJoin('m_geo_kec_kpu', 'm_geo_kec_kpu.geo_kec_id', '=', 'm_geo_deskel_kpu.geo_kec_id')
						->leftJoin('m_geo_kab_kpu', 'm_geo_kec_kpu.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
						->select(
							'm_geo_deskel_kpu.geo_deskel_nama',
							'm_geo_deskel_kpu.geo_deskel_id',
							'm_geo_kec_kpu.geo_kec_id',
							'm_geo_kab_kpu.geo_kab_id',
							'm_geo_kab_kpu.geo_prov_id'
						)
						->get();

			foreach ($getKel as $data) {
				DB::table('m_transfer_kel')
					->insert([
						"prov_id_1" => $data->geo_prov_id,
						"kab_id_1"  => $data->geo_kab_id,
						"kec_id_1"  => $data->geo_kec_id,
						"kel_id_1"  => $data->geo_deskel_id,
						"nama_kel"  => $data->geo_deskel_nama
					]);
			}
			echo "DONE";
		}
	}

}
?>