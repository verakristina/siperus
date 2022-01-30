<?php namespace App\Http\Controllers; 

use DB;
use Input;
use Redirect;

/**
* 
*/
date_default_timezone_set('Asia/Jakarta');
class MasterController extends Controller
{
	public function viewMasterWilayah($jenis,$prov=0,$kab=0,$kec=0,$kel=0,$rw=0,$tps=0)
	{		
		switch(session('idRole')) {
			case 6:	
				$kel = session('idKelurahan');
			case 5:	
				$kec = session('idKecamatan');
			case 4:	
				$kab = session('idKabupaten');
			case 3:	
				$prov = session('idProvinsi2');
			break;
		}
		$dataProv = DB::table('m_geo_prov_kpu');
		$dataKab = DB::table('m_geo_kab_kpu');
		$dataKec = DB::table('m_geo_kec_kpu');
		$dataKel = DB::table('m_geo_deskel_kpu');
		$dataRW = DB::table('m_geo_rw');
		$dataRT = DB::table('m_geo_rt');
		$dataTPS = DB::table('m_geo_tps');
		
		if(session('idRole') == 3 && session('idProvinsi') != '') {
			$dataProv->where('geo_prov_id',session('idProvinsi'));
		} else {
			$dataKab->where('geo_prov_id',$prov);
			$dataKec->where('geo_kab_id',$kab);
			$dataKel->where('geo_kec_id',$kec);
			$dataRW->where('geo_deskel_id',$kel);
			$dataRT->where('geo_rw_id',$rw);
			$dataTPS->where('geo_deskel_id',$kel);
		}

		$dataProv = $dataProv->get();	
		$dataKab = $dataKab->get();
		$dataKec = $dataKec->get();
		$dataKel = $dataKel->get();
		$dataRW = $dataRW->get();
		$dataTPS = $dataTPS->get();

		$data = array();
		if($jenis == 'provinsi') {
			$data = DB::table('m_geo_prov_kpu');
			if(session('idRole') == 3 && session('idProvinsi') != '') {
				$data->where('geo_prov_id',session('idProvinsi2'));
			}	
			$data = $data->get();
		} else if($jenis == 'kabupaten') {
			if($prov != ''){
				$data = DB::table('m_geo_kab_kpu')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_prov_kpu.geo_prov_id',$prov);
						if ($kab != '') {
							$data ->where('m_geo_kab_kpu.geo_kab_id',$kab);
						}
						$data = $data ->get();
			} else {
				/* $data = DB::table('m_geo_kab_kpu')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->get(); */
			}
		} else if($jenis == 'kecamatan') {
			if($prov != ''){
				$data = DB::table('m_geo_kec_kpu')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_kab_kpu.geo_prov_id',$prov);
						if ($kab != '') {
							$data ->where('m_geo_kab_kpu.geo_kab_id',$kab);
						}
							$data = $data ->get();
			} else {
				/* $data = DB::table('m_geo_kec_kpu')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->get(); */
			}
			$selected = [$prov,$kab,'','','',''];
		} else if($jenis == 'kelurahan') {
			if($prov != '' && $kab != '' && $kec != ''){
				$data = DB::table('m_geo_deskel_kpu')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_kec_kpu.geo_kec_id',$kec)
							->get();
				
			} else {
				/* $data = DB::table('m_geo_deskel_kpu')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->get(); */
			}
		} else if($jenis == 'rw') {
			if($prov != '' && $kab != '' && $kec != '' && $kel != ''){
				$data = DB::table('m_geo_rw')
					->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_deskel_kpu.geo_deskel_id',$kel)
							->get();
			} else {
				/* $data = DB::table('m_geo_rw')
					->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->get(); */
			}
		} else if($jenis == 'rt') {
			if($prov != '' && $kab != '' && $kec != '' && $kel != ''){
				$data = DB::table('m_geo_rt')
					->join('m_geo_rw','m_geo_rw.geo_rw_id','=','m_geo_rt.geo_rw_id')
					->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_deskel_kpu.geo_deskel_id',$kel)
							->get();
			} else {
				/* $data = DB::table('m_geo_rw')
					->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->get(); */
			}
		} else if($jenis == 'tps') {
			if($prov != '' && $kab != '' && $kec != '' && $kel != ''){
				$data = DB::table('m_geo_tps')
					->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_tps.geo_deskel_id')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_deskel_kpu.geo_deskel_id',$kel)
							->get();
			} else {
				/* $data = DB::table('m_geo_rw')
					->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->get(); */
			}
		}
		
		return view('main.master.wilayah.'.$jenis,array(
			'data' => $data,
			'dataProv' => $dataProv,
			'dataKab' => $dataKab,
			'dataKec' => $dataKec,
			'dataKel' => $dataKel,
			'dataRW' => $dataRW,
			'prov' => $prov,
			'kab' => $kab,
			'kec' => $kec,
			'kel' => $kel,
			'rw' => $rw,
			'tps' => $tps
		));
	}
	
	public function addWilayah($jenis)
	{
		if($jenis == 'provinsi'){
			$provNama = @$_POST['nama_provinsi'];
			
			$prosesInsert = DB::table('m_geo_prov_kpu')
				->insertGetId([
					'geo_prov_nama' => $provNama,
					'geo_prov_created_date' => date('Y-m-d H:i:s'),
					'geo_prov_created_by' => session('idLogin'),
					'geo_prov_status' => 1
				]);
			return redirect('master/wilayah/provinsi');
		} else if($jenis == 'kabupaten'){
			$provId = @$_POST['id_provinsi'];
			$kabNama = @$_POST['nama_kabupaten'];
			
			$prosesInsert = DB::table('m_geo_kab_kpu')
				->insertGetId([
					'geo_prov_id' => $provId,
					'geo_kab_nama' => $kabNama,
					'geo_kab_created_date' => date('Y-m-d H:i:s'),
					'geo_kab_created_by' => session('idLogin'),
					'geo_kab_status' => 1
				]);
			return redirect('master/wilayah/kabupaten/'.$provId);	
		} else if($jenis == 'kecamatan'){
			$provId = @$_POST['id_provinsi'];
			$kabId = @$_POST['id_kabupaten'];
			$kecNama = @$_POST['nama_kecamatan'];
			
			$prosesInsert = DB::table('m_geo_kec_kpu')
				->insertGetId([
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_nama' => $kecNama,
					'geo_kec_created_date' => date('Y-m-d H:i:s'),
					'geo_kec_created_by' => session('idLogin'),
					'geo_kec_status' => 1
				]);
			return redirect('master/wilayah/kecamatan/'.$provId.'/'.$kabId);	
		} else if($jenis == 'kelurahan'){
			$provId = @$_POST['id_provinsi'];
			$kabId = @$_POST['id_kabupaten'];
			$kecId = @$_POST['id_kecamatan'];
			$kelNama = @$_POST['nama_kelurahan'];
			
			$prosesInsert = DB::table('m_geo_deskel_kpu')
				->insertGetId([
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_nama' => $kelNama,
					'geo_deskel_created_date' => date('Y-m-d H:i:s'),
					'geo_deskel_created_by' => session('idLogin'),
					'geo_deskel_status' => 1
				]);
			return redirect('master/wilayah/kelurahan/'.$provId.'/'.$kabId.'/'.$kecId);	
		} else if($jenis == 'rw'){
			$provId = @$_POST['id_provinsi'];
			$kabId = @$_POST['id_kabupaten'];
			$kecId = @$_POST['id_kecamatan'];
			$kelId = @$_POST['id_kelurahan'];
			$rwNama = @$_POST['nama_rw'];
			
			$prosesInsert = DB::table('m_geo_rw')
				->insertGetId([
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'geo_rw_nama' => $rwNama,
					'geo_rw_created_date' => date('Y-m-d H:i:s'),
					'geo_rw_created_by' => session('idLogin'),
					'geo_rw_status' => 1
				]);
			return redirect('master/wilayah/rw/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId);		
		} else if($jenis == 'rt'){
			$provId = @$_POST['id_provinsi'];
			$kabId = @$_POST['id_kabupaten'];
			$kecId = @$_POST['id_kecamatan'];
			$kelId = @$_POST['id_kelurahan'];
			$rwId = @$_POST['id_rw'];
			$rtNama = @$_POST['nama_rt'];
			
			$prosesInsert = DB::table('m_geo_rt')
				->insertGetId([
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'geo_rw_id' => $rwId,
					'geo_rt_nama' => $rtNama,
					'geo_rt_created_date' => date('Y-m-d H:i:s'),
					'geo_rt_created_by' => session('idLogin'),
					'geo_rt_status' => 1
				]);
			return redirect('master/wilayah/rt/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId.'/'.$rwId);		
		} else if($jenis == 'tps'){
			$provId = @$_POST['id_provinsi'];
			$kabId = @$_POST['id_kabupaten'];
			$kecId = @$_POST['id_kecamatan'];
			$kelId = @$_POST['id_kelurahan'];
			$tpsNama = @$_POST['nama_tps'];
			
			$prosesInsert = DB::table('m_geo_tps')
				->insertGetId([
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'geo_tps_nama' => $tpsNama,
					'geo_tps_created_date' => date('Y-m-d H:i:s'),
					'geo_tps_created_by' => session('idLogin'),
					'geo_tps_status' => 1
				]);
			return redirect('master/wilayah/tps/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId);		
		}
	}
	
	public function editWilayah($jenis)
	{
		if($jenis == 'provinsi'){
			$provId = @$_POST['edit_id_provinsi'];
			$provNama = @$_POST['edit_nama_provinsi'];
			
			$prosesUpdate = DB::table('m_geo_prov_kpu')
				->where('geo_prov_id',$provId)
				->update([
					'geo_prov_nama' => $provNama
				]);
			return redirect('master/wilayah/provinsi');
		} else if($jenis == 'kabupaten'){
			$provId = @$_POST['edit_id_provinsi'];
			$kabId = @$_POST['edit_id_kabupaten'];
			$kabNama = @$_POST['edit_nama_kabupaten'];
			
			$prosesUpdate = DB::table('m_geo_kab_kpu')
				->where('geo_kab_id',$kabId)
				->update([
					'geo_prov_id' => $provId,
					'geo_kab_nama' => $kabNama
				]);
			return redirect('master/wilayah/kabupaten/'.$provId);	
		} else if($jenis == 'kecamatan'){
			$provId = @$_POST['edit_id_provinsi'];
			$kabId = @$_POST['edit_id_kabupaten'];
			$kecId = @$_POST['edit_id_kecamatan'];
			$kecNama = @$_POST['edit_nama_kecamatan'];
			
			$prosesUpdate = DB::table('m_geo_kec_kpu')
				->where('geo_kec_id',$kecId)
				->update([
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_nama' => $kecNama
				]);
			return redirect('master/wilayah/kecamatan/'.$provId.'/'.$kabId);	
		} else if($jenis == 'kelurahan'){
			$provId = @$_POST['edit_id_provinsi'];
			$kabId = @$_POST['edit_id_kabupaten'];
			$kecId = @$_POST['edit_id_kecamatan'];
			$kelId = @$_POST['edit_id_kelurahan'];
			$kelNama = @$_POST['edit_nama_kelurahan'];
			
			$prosesUpdate = DB::table('m_geo_deskel_kpu')
				->where('geo_deskel_id',$kelId)
				->update([
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_nama' => $kelNama
				]);
			return redirect('master/wilayah/kelurahan/'.$provId.'/'.$kabId.'/'.$kecId);	
		} else if($jenis == 'rw'){
			$provId = @$_POST['edit_id_prov'];
			$kabId = @$_POST['edit_id_kab'];
			$kecId = @$_POST['edit_id_kec'];
			$kelId = @$_POST['edit_id_kel'];
			$rwId = @$_POST['edit_id_rw'];
			$rwNama = @$_POST['edit_nama_rw'];
			
			$prosesUpdate = DB::table('m_geo_rw')
				->where('geo_rw_id',$rwId)
				->update([
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'geo_rw_nama' => $rwNama 
				]);
			return redirect('master/wilayah/rw/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId);		
		} else if($jenis == 'rt'){
			$provId = @$_POST['edit_id_prov'];
			$kabId = @$_POST['edit_id_kab'];
			$kecId = @$_POST['edit_id_kec'];
			$kelId = @$_POST['edit_id_kel'];
			$rwId = @$_POST['edit_id_rw'];
			$rtId = @$_POST['edit_id_rt'];
			$rtNama = @$_POST['edit_nama_rt'];
			
			$prosesUpdate = DB::table('m_geo_rt')
				->where('geo_rt_id',$rtId)
				->update([
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'geo_rw_id' => $rwId,
					'geo_rt_nama' => $rtNama 
				]);
			return redirect('master/wilayah/rt/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId.'/'.$rwId);			
		} else if($jenis == 'tps'){
			$provId = @$_POST['edit_id_prov'];
			$kabId = @$_POST['edit_id_kab'];
			$kecId = @$_POST['edit_id_kec'];
			$kelId = @$_POST['edit_id_kel'];
			$tpsId = @$_POST['edit_id_tps'];
			$tpsNama = @$_POST['edit_nama_tps'];
			
			$prosesUpdate = DB::table('m_geo_tps')
				->where('geo_tps_id',$tpsId)
				->update([
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'geo_tps_nama' => $tpsNama 
				]);
			return redirect('master/wilayah/tps/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId);			
		}
	}
	public function deleteWilayah($jenis,$prov=0,$kab=0,$kec=0,$kel=0,$rw=0,$tps=0)
	{
		if($jenis == 'provinsi'){
			$provId = @$_POST['edit_id_provinsi'];
			
			$prosesUpdate = DB::table('m_geo_prov_kpu')
				->where('geo_prov_id',$prov)
				->delete();
			return redirect('master/wilayah/provinsi');
		} else if($jenis == 'kabupaten'){
			$kabId = @$_POST['edit_id_kabupaten'];
			
			$prosesUpdate = DB::table('m_geo_kab_kpu')
				->where('geo_kab_id',$kab)
				->delete();
			return redirect('master/wilayah/kabupaten/'.$prov);	
		} else if($jenis == 'kecamatan'){
			$kecId = @$_POST['edit_id_kecamatan'];
			
			$prosesUpdate = DB::table('m_geo_kec_kpu')
				->where('geo_kec_id',$kec)
				->delete();
			return redirect('master/wilayah/kecamatan/'.$prov.'/'.$kab);	
		} else if($jenis == 'kelurahan'){
			$kelId = @$_POST['edit_id_kelurahan'];
			
			$prosesUpdate = DB::table('m_geo_deskel_kpu')
				->where('geo_deskel_id',$kel)
				->delete();
			return redirect('master/wilayah/kelurahan/'.$prov.'/'.$kab.'/'.$kec);	
		} else if($jenis == 'rw'){
			$rwId = @$_POST['edit_id_rw'];
			
			$prosesUpdate = DB::table('m_geo_rw')
				->where('geo_rw_id',$rw)
				->delete();
			return redirect('master/wilayah/rw/'.$prov.'/'.$kab.'/'.$kec.'/'.$kel);	
		} else if($jenis == 'rt'){
			$rwId = @$_POST['edit_id_rt'];
			
			$prosesUpdate = DB::table('m_geo_rt')
				->where('geo_rt_id',$tps)
				->delete();
			return redirect('master/wilayah/rt/'.$prov.'/'.$kab.'/'.$kec.'/'.$kel.'/'.$rw);			
		} else if($jenis == 'tps'){
			$tpsId = @$_POST['edit_id_tps'];
			
			$prosesUpdate = DB::table('m_geo_tps')
				->where('geo_tps_id',$tps)
				->delete();
			return redirect('master/wilayah/tps/'.$prov.'/'.$kab.'/'.$kec.'/'.$kel);			
		}
	}
	
	public function viewMasterStruktur($jenis,$prov='',$kab='',$kec='',$kel='',$rw='',$rt='',$tps=0)
	{
		switch(session('idRole')) {
			case 6:	
				$kel = session('idKelurahan');
			case 5:	
				$kec = session('idKecamatan');
			case 4:	
				$kab = session('idKabupaten');
			case 3:	
				$prov = session('idProvinsi2');
			break;
		}
		$selected = [];
		if(session('idLogin')){
			$data = array();
			$dataProv = DB::table('m_geo_prov_kpu');
			if(session('idRole') >= 3 && session('idProvinsi') != '') {
				$dataProv->where('geo_prov_id',$prov);
			}	
			$dataProv = $dataProv->get();
			
			$dataKab = DB::table('m_geo_kab_kpu')
				->where('geo_prov_id',$prov);
/* 				if ($kab != '') {
					$dataKab->where('geo_kab_id',$kab);
				}
 */				$dataKab = $dataKab->get();
			$dataKec = DB::table('m_geo_kec_kpu')
				->where('geo_kab_id',$kab)
				->get();
			$dataKel = DB::table('m_geo_deskel_kpu')
				->where('geo_kec_id',$kec)
				->get();
			$dataRW = DB::table('m_geo_rw')
				->where('geo_deskel_id',$kel)
				->get();
			$dataRT = DB::table('m_geo_rt')
				->where('geo_rw_id',$rw)
				->get();
			$dataTPS = DB::table('m_geo_tps')
				->where('geo_deskel_id',$kel)
				->get();	
			if($jenis == 'pimnas') {				
				$data = DB::table('m_struk_pimnas')
					->get();
			} else if($jenis == 'pimda') {						
				if($prov != 0){					
					$data = DB::table('m_struk_pimda')
						->where('geo_prov_id',$prov)
							->get();
				} else {
					$data = DB::table('m_struk_pimda')
						->get();
				}
			} else if($jenis == 'pimcab') {
				if($kab != 0){
					$data = DB::table('m_struk_pimcab')
						->where('geo_kab_id',$kab)
							->get();
				}
			} else if($jenis == 'pimcam') {
				if($kec != 0){
					$data = DB::table('m_struk_pimcam')
						->where('geo_kec_id',$kec)
							->get();
				}
			} else if($jenis == 'pimran') {
				if($kel != 0){
					$data = DB::table('m_struk_pimran')
						->where('geo_deskel_id',$kel)
							->get();
				}
			} else if($jenis == 'par') {
				if($kel != 0){
					$data = DB::table('m_struk_par')
						->where('geo_rw_id',$rw)
							->get();
				}
			} else if($jenis == 'kpa') {
				if($rw != 0){
					$data = DB::table('m_struk_kpa')
						->where('geo_rt_id',$rt)
							->get();
				}
			}
			$breadcrumb = ['Master Data','Struktur',strtoupper($jenis)];

			$selected = [$prov,$kab,$kec,$kel,$rw,$rt];
								
			return view('main.master.struktur.'.$jenis,array(
				'data' => $data,
				'breadcrumb' => $breadcrumb,
				'dataProv' => $dataProv,
				'dataKab' => $dataKab,
				'dataKec' => $dataKec,
				'dataKel' => $dataKel,
				'dataRW' => $dataRW,
				'dataRT' => $dataRT,
				'prov' => $prov,
				'kab' => $kab,
				'kec' => $kec,
				'kel' => $kel,
				'rw' => $rw,
				'rt' => $rt,
				'tps' => $tps,
				'selected' => $selected
			));
		} else {
			return redirect('logout');
		}
	}
	public function addStruktur($jenis)
	{
		$namaStruktur = @$_POST['nama_struktur'];
		if($jenis == 'pimnas') {		
			$data = DB::table('m_struk_pimnas')
				->insertGetId([
					'struk_pimnas_nama' => $namaStruktur,
					'struk_pimnas_created_date' => date('Y-m-d H:i:s'),
					'struk_pimnas_created_by' => session('idLogin'),
					'struk_pimnas_status' => 1
				]);
			return redirect('master/struktur/pimnas');
		} else if($jenis == 'pimda') {
			$pimnasId = @$_POST['id_pimnas'];
			$provId = @$_POST['id_prov'];
			$pimdaNama = @$_POST['nama_pimda'];
			
			$data = DB::table('m_struk_pimda')
				->insertGetId([
					'struk_pimnas_id' => $pimnasId,
					'geo_prov_id' => $provId,
					'struk_pimda_nama' => $namaStruktur,
					'struk_pimda_created_date' => date('Y-m-d H:i:s'),
					'struk_pimda_created_by' => session('idLogin'),
					'struk_pimda_status' => 1
				]);
			return redirect('master/struktur/pimda/'.$provId);
		} else if($jenis == 'pimcab') {
			$pimdaId = @$_POST['id_pimda'];
			$provId = @$_POST['id_prov'];
			$kabId = @$_POST['id_kab'];
			$pimcabNama = @$_POST['nama_pimcab'];
			$data = DB::table('m_struk_pimcab')
				->insertGetId([
					'struk_pimda_id' => $pimdaId,
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'struk_pimcab_nama' => $namaStruktur,
					'struk_pimcab_created_date' => date('Y-m-d H:i:s'),
					'struk_pimcab_created_by' => session('idLogin'),
					'struk_pimcab_status' => 1
				]);
			return redirect('master/struktur/pimcab/'.$provId.'/'.$kabId);
		} else if($jenis == 'pimcam') {
			$pimcabId = @$_POST['id_pimcab'];
			$provId = @$_POST['id_prov'];
			$kabId = @$_POST['id_kab'];
			$kecId = @$_POST['id_kec'];
			$pimcamNama = @$_POST['nama_pimcam'];
			
			$data = DB::table('m_struk_pimcam')
				->insertGetId([
					'struk_pimcab_id' => $pimcabId,
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'struk_pimcam_nama' => $namaStruktur,
					'struk_pimcam_created_date' => date('Y-m-d H:i:s'),
					'struk_pimcam_created_by' => session('idLogin'),
					'struk_pimcam_status' => 1
				]);
			return redirect('master/struktur/pimcam/'.$provId.'/'.$kabId.'/'.$kecId);
		} else if($jenis == 'pimran') {
			$pimcamId = @$_POST['id_pimcam'];
			$provId = @$_POST['id_prov'];
			$kabId = @$_POST['id_kab'];
			$kecId = @$_POST['id_kec'];
			$kelId = @$_POST['id_kel'];
			$parNama = @$_POST['nama_pimran'];
			
			$data = DB::table('m_struk_pimran')
				->insertGetId([
					'struk_pimcam_id' => $pimcamId,
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'struk_pimran_nama' => $namaStruktur,
					'struk_pimran_created_date' => date('Y-m-d H:i:s'),
					'struk_pimran_created_by' => session('idLogin'),
					'struk_pimran_status' => 1
				]);
			return redirect('master/struktur/pimran/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId);
		} else if($jenis == 'par') {
			$parId = @$_POST['id_par'];
			$provId = @$_POST['id_prov'];
			$kabId = @$_POST['id_kab'];
			$kecId = @$_POST['id_kec'];
			$kelId = @$_POST['id_kel'];
			$rwId = @$_POST['id_rw'];
			$parNama = @$_POST['nama_par'];
			
			$data = DB::table('m_struk_par')
				->insertGetId([
					'struk_pimran_id' => $parId,
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'geo_rw_id' => $rwId,
					'struk_par_nama' => $namaStruktur,
					'struk_par_created_date' => date('Y-m-d H:i:s'),
					'struk_par_created_by' => session('idLogin'),
					'struk_par_status' => 1
				]);
			return redirect('master/struktur/par/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId.'/'.$rwId);
		} else if($jenis == 'kpa') {
			$parId = @$_POST['id_par'];
			$provId = @$_POST['id_prov'];
			$kabId = @$_POST['id_kab'];
			$kecId = @$_POST['id_kec'];
			$kelId = @$_POST['id_kel'];
			$rwId = @$_POST['id_rw'];
			$rtId = @$_POST['id_rt'];
			$kpaNama = @$_POST['nama_kpa'];
			
			$data = DB::table('m_struk_kpa')
				->insertGetId([
					'struk_par_id' => $parId,
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'geo_rw_id' => $rwId,
					'geo_rt_id' => $rtId,
					'struk_kpa_nama' => $namaStruktur,
					'struk_kpa_created_date' => date('Y-m-d H:i:s'),
					'struk_kpa_created_by' => session('idLogin'),
					'struk_kpa_status' => 1
				]);
			return redirect('master/struktur/kpa/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId.'/'.$rwId.'/'.$rtId);
		}
	}
	public function editStruktur($jenis,$prov=0,$kab=0,$kec=0,$kel=0,$rw=0,$rt=0)
	{
		$idStruktur = @$_POST['edit_id_struk'];
		$namaStruktur = @$_POST['edit_nama_struk'];
		if($jenis == 'pimnas') {		
			
			$data = DB::table('m_struk_pimnas')
				->where('struk_pimnas_id',$idStruktur)
				->update([
					'struk_pimnas_nama' => $namaStruktur
				]);
			return redirect('master/struktur/pimnas');
		} else if($jenis == 'pimda') {
			$pimnasId = @$_POST['edit_id_pimnas'];
			$provId = @$_POST['edit_id_prov'];
			$pimdaId = @$_POST['edit_id_pimda'];
			$pimdaNama = @$_POST['edit_nama_pimda'];
			
			$data = DB::table('m_struk_pimda')
				->where('struk_pimda_id',$idStruktur)
				->update([
					'struk_pimnas_id' => $pimnasId,
					'geo_prov_id' => $provId,
					'struk_pimda_nama' => $namaStruktur
				]);
			return redirect('master/struktur/pimda/'.$provId);
		} else if($jenis == 'pimcab') {
			$pimdaId = @$_POST['edit_id_pimda'];
			$provId = @$_POST['edit_id_prov'];
			$kabId = @$_POST['edit_id_kab'];
			$pimcabId = @$_POST['edit_id_pimcab'];
			$pimcabNama = @$_POST['edit_nama_pimcab'];
			
			$data = DB::table('m_struk_pimcab')
				->where('struk_pimcab_id',$idStruktur)
				->update([
					'struk_pimda_id' => $pimdaId,
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'struk_pimcab_nama' => $namaStruktur
				]);
			return redirect('master/struktur/pimcab/'.$provId.'/'.$kabId);
		} else if($jenis == 'pimcam') {
			$pimcabId = @$_POST['edit_id_pimcab'];
			$provId = @$_POST['edit_id_prov'];
			$kabId = @$_POST['edit_id_kab'];
			$kecId = @$_POST['edit_id_kec'];
			$pimcamId = @$_POST['edit_id_pimcam'];
			$pimcamNama = @$_POST['edit_nama_pimcam'];
			
			$data = DB::table('m_struk_pimcam')
				->where('struk_pimcam_id',$idStruktur)
				->update([
					'struk_pimcab_id' => $pimcabId,
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'struk_pimcam_nama' => $namaStruktur
				]);
			return redirect('master/struktur/pimcam/'.$provId.'/'.$kabId.'/'.$kecId);
		} else if($jenis == 'pimran') {
			$pimcamId = @$_POST['edit_id_pimcam'];
			$provId = @$_POST['edit_id_prov'];
			$kabId = @$_POST['edit_id_kab'];
			$kecId = @$_POST['edit_id_kec'];
			$kelId = @$_POST['edit_id_kel'];
			$pimranId = @$_POST['edit_id_pimran'];
			$pimranNama = @$_POST['edit_nama_pimran'];
			
			$data = DB::table('m_struk_pimran')
				->where('struk_pimran_id',$idStruktur)
				->update([
					'struk_pimcam_id' => $pimcamId,
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'struk_pimran_nama' => $namaStruktur
				]);
			return redirect('master/struktur/pimram/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId);
		} else if($jenis == 'par') {
			$pimranId = @$_POST['edit_id_pimran'];
			$provId = @$_POST['edit_id_prov'];
			$kabId = @$_POST['edit_id_kab'];
			$kecId = @$_POST['edit_id_kec'];
			$kelId = @$_POST['edit_id_kel'];
			$rwId = @$_POST['edit_id_rw'];
			$parId = @$_POST['edit_id_par'];
			$parNama = @$_POST['edit_nama_par'];
			
			$data = DB::table('m_struk_par')
				->where('struk_par_id',$idStruktur)
				->update([
					'struk_pimran_id' => $parId,
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'geo_rw_id' => $rwId,
					'struk_par_nama' => $namaStruktur
				]);
			return redirect('master/struktur/par/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId.'/'.$rwId);
		} else if($jenis == 'kpa') {
			$parId = @$_POST['edit_id_par'];
			$provId = @$_POST['edit_id_prov'];
			$kabId = @$_POST['edit_id_kab'];
			$kecId = @$_POST['edit_id_kec'];
			$kelId = @$_POST['edit_id_kel'];
			$rwId = @$_POST['edit_id_rw'];
			$rtId = @$_POST['edit_id_rt'];
			$kpaId = @$_POST['edit_id_kpa'];
			$kpaNama = @$_POST['edit_nama_kpa'];
			
			$data = DB::table('m_struk_kpa')
				->where('struk_kpa_id',$idStruktur)
				->update([
					'struk_par_id' => $parId,
					'geo_prov_id' => $provId,
					'geo_kab_id' => $kabId,
					'geo_kec_id' => $kecId,
					'geo_deskel_id' => $kelId,
					'geo_rw_id' => $rwId,
					'geo_rt_id' => $rtId,
					'struk_kpa_nama' => $namaStruktur
				]);
			return redirect('master/struktur/kpa/'.$provId.'/'.$kabId.'/'.$kecId.'/'.$kelId.'/'.$rwId.'/'.$rtId);
		}
	}
	public function deleteStruktur($jenis,$prov=0,$kab=0,$kec=0,$kel=0,$rw=0,$rt=0,$id=0)
	{
		if($jenis == 'pimnas'){
			$prosesUpdate = DB::table('m_struk_pimnas')
				->where('struk_pimnas_id',$prov)
				->delete();
			$redirect = 'master/struktur/pimnas';
		} else if($jenis == 'pimda'){
			$prosesUpdate = DB::table('m_struk_pimda')
				->where('struk_pimda_id',$kab)
				->delete();
			$redirect = 'master/struktur/pimda/'.$prov;	
		} else if($jenis == 'pimcab'){
			$prosesUpdate = DB::table('m_struk_pimcab')
				->where('struk_pimcab_id',$kec)
				->delete();
			$redirect = 'master/struktur/pimcab/'.$prov.'/'.$kab;	
		} else if($jenis == 'pimcam'){
			$prosesUpdate = DB::table('m_struk_pimcam')
				->where('struk_pimcam_id',$kel)
					->delete();
			$redirect = 'master/struktur/pimcam/'.$prov.'/'.$kab.'/'.$kec;	
		} else if($jenis == 'pimran'){
			$prosesUpdate = DB::table('m_struk_pimran')
				->where('struk_pimran_id',$rw)
				->delete();
			$redirect = 'master/struktur/pimran/'.$prov.'/'.$kab.'/'.$kec.'/'.$kel;			
		} else if($jenis == 'par'){
			$prosesUpdate = DB::table('m_struk_par')
				->where('struk_par_id',$rt)
					->delete();
			$redirect = 'master/struktur/par/'.$prov.'/'.$kab.'/'.$kec.'/'.$kel.'/'.$rw;
		} else if($jenis == 'kpa'){
			$prosesUpdate = DB::table('m_struk_kpa')
				->where('struk_kpa_id',$id)
				->delete();
			$redirect = 'master/struktur/kpa/'.$prov.'/'.$kab.'/'.$kec.'/'.$kel.'/'.$rw.'/'.$rt;			
		}
		return redirect($redirect);
	}

	public function detailStruktur($jenis, $id) {
		$data = [];
		if($jenis == 'pimnas' || $jenis == 'pimda' || $jenis == 'pimcab' || $jenis == 'pimcam' || $jenis == 'pimran' || $jenis == 'par' || $jenis == 'kpa') {				
			$strukturJoin = DB::table('m_struk_'.$jenis)
				->select(
					'*',
					DB::raw('CONCAT_WS(" ",bio_nama_depan,bio_nama_tengah,bio_nama_belakang) as fullName')
				);
				switch($jenis){
					case 'kpa':
						$strukturJoin->join('m_geo_rt','m_geo_rt.geo_rt_id','=','m_struk_'.$jenis.'.geo_rt_id');
					case 'par':
						$strukturJoin->join('m_geo_rw','m_geo_rw.geo_rw_id','=','m_struk_'.$jenis.'.geo_rw_id');
					case 'pimran':
						$strukturJoin->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_struk_'.$jenis.'.geo_deskel_id');
					case 'pimcam':
						$strukturJoin->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_struk_'.$jenis.'.geo_kec_id');
					case 'pimcab':
						$strukturJoin->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_struk_'.$jenis.'.geo_kab_id');
					case 'pimda':
						$strukturJoin->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_struk_'.$jenis.'.geo_prov_id');
					case 'pimnas':
					break;
				}
				$strukturJoin->leftJoin('r_bio_'.$jenis,'r_bio_'.$jenis.'.struk_'.$jenis.'_id','=','m_struk_'.$jenis.'.struk_'.$jenis.'_id');
				$strukturJoin->leftJoin('m_bio','m_bio'.'.bio_id','=','r_bio_'.$jenis.'.bio_id');
				$data = $strukturJoin->where('m_struk_'.$jenis.'.struk_'.$jenis.'_id',$id)
					->get();
		}
		
		$hasil = "";
		
		foreach($data as $tmp){
			$hasil = $tmp?:'-';
		}
		
		return json_encode($hasil);
	}
	
	public function viewMasterStatistik()
	{
		$data = DB::table('m_pengurus')
			->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_pengurus.geo_prov_id')
				->orderBy('m_geo_prov_kpu.geo_prov_id')
					->get();
		$dataProvinsi = DB::table('m_geo_prov_kpu')->get();
	
		$breadcrumb[] = 'Master Data';
		$breadcrumb[] = 'Statistik';
	
		return view('main.master.statistik.index',array(
			'breadcrumb' => $breadcrumb,
			'data' => $data,
			'dataProvinsi' => $dataProvinsi
		));
	}
	
	public function actionStatistik($idPengurus=0)
	{
		$dataPengurus = array();
			
		$idProvinsi = @$_POST['provinsi'];
		
		$jumlahKab = $_POST['pengurus_pimcab'];
		$jumlahKec = $_POST['pengurus_pimcam'];
		$jumlahDeskel = $_POST['pengurus_ranting'];
		$jumlahRW = $_POST['pengurus_anak_ranting'];
		$jumlahRT = $_POST['pengurus_kpa'];
		
		$dataPengurus['pengurus_pimcab'] = @$jumlahKab;
		$dataPengurus['pengurus_pimcam'] = @$jumlahKec;
		$dataPengurus['pengurus_ranting'] = @$jumlahDeskel;
		$dataPengurus['pengurus_anak_ranting'] = @$jumlahRW;
		$dataPengurus['pengurus_kpa'] = @$jumlahRT;
		$dataPengurus['pengurus_pimcab_ada'] = @$_POST['pengurus_pimcab_ada'];
		$dataPengurus['pengurus_pimcam_ada'] = @$_POST['pengurus_pimcam_ada'];
		$dataPengurus['pengurus_ranting_ada'] = @$_POST['pengurus_ranting_ada'];
		$dataPengurus['pengurus_anak_ranting_ada'] = @$_POST['pengurus_anak_ranting_ada'];
		$dataPengurus['pengurus_kpa_ada'] = @$_POST['pengurus_kpa_ada'];
		$date = date('Y-m-d H:i:s');
		
		/* Check Daerah */
			/* Kabupaten */
				$proses = DB::table('m_geo_kab_kpu')
					->where('geo_prov_id',$idProvinsi)
						->count();
				if($jumlahKab > $proses){
					$selisih = $jumlahKab-$proses;
					for($a=1; $a<=$selisih; $a++){
						DB::table('m_geo_kab_kpu')
							->insertGetId([
								'geo_prov_id' => $idProvinsi,
								'geo_kab_nama' => 'Belum Dinamakan',
								'geo_kab_status' => '1',
								'geo_kab_status_baru' => 'new',
								'geo_kab_created_date' => $date,
								'geo_kab_created_by' => 0
							]);
					}
				}
				
			/* /.Kupaten */
			
			/* Kecamatan */
				$proses = DB::table('m_geo_kec_kpu')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_prov_kpu.geo_prov_id',$idProvinsi)
							->count();
				if($jumlahKab > $proses){
					$selisih = $jumlahKab-$proses;
					for($a=1; $a<=$selisih; $a++){
						DB::table('m_geo_kec_kpu')
							->insertGetId([
								'geo_prov_id' => $idProvinsi,
								'geo_kec_nama' => 'Belum Dinamakan',
								'geo_kec_status' => '1',
								'geo_kec_status_baru' => 'new',
								'geo_kec_created_date' => $date,
								'geo_kec_created_by' => 0
							]);
					}
				}				
			/* /.Kecamatan */
			
			/* Deskel */
				$proses = DB::table('m_geo_deskel_kpu')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_prov_kpu.geo_prov_id',$idProvinsi)
							->count();
				if($jumlahKab > $proses){
					$selisih = $jumlahKab-$proses;
					for($a=1; $a<=$selisih; $a++){
						DB::table('m_geo_deskel_kpu')
							->insertGetId([
								'geo_prov_id' => $idProvinsi,
								'geo_deskel_nama' => 'Belum Dinamakan',
								'geo_deskel_status' => '1',
								'geo_deskel_status_baru' => 'new',
								'geo_deskel_created_date' => $date,
								'geo_deskel_created_by' => 0
							]);
					}				
				}
				
			/* /.Deskel */
			
			/* RW */
				$proses = DB::table('m_geo_rw')
					->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_prov_kpu.geo_prov_id',$idProvinsi)
							->count();
				if($jumlahKab > $proses){
					$selisih = $jumlahKab-$proses;
					for($a=1; $a<=$selisih; $a++){
						DB::table('m_geo_rw')
							->insertGetId([
								'geo_prov_id' => $idProvinsi,
								'geo_rw_nama' => 'Belum Dinamakan',
								'geo_rw_status' => '1',
								'geo_rw_status_baru' => 'new',
								'geo_rw_created_date' => $date,
								'geo_rw_created_by' => 0
							]);
					}
				}
			/* /.RW */
			
			/* RT */
				$proses = DB::table('m_geo_rt')
					->join('m_geo_rw','m_geo_rw.geo_rw_id','=','m_geo_rt.geo_rw_id')
					->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
						->where('m_geo_prov_kpu.geo_prov_id',$idProvinsi)
							->count();
				if($jumlahKab > $proses){
					$selisih = $jumlahKab-$proses;
					for($a=1; $a<=$selisih; $a++){
						DB::table('m_geo_rt')
							->insertGetId([
								'geo_prov_id' => $idProvinsi,
								'geo_rt_nama' => 'Belum Dinamakan',
								'geo_rt_status' => '1',
								'geo_rt_status_baru' => 'new',
								'geo_rt_created_date' => $date,
								'geo_rt_created_by' => 0
							]);
					}
				}
			/* /.RT */
		/* /.Check Daerah */
		
		if($idPengurus == 0){
			/* Tambah */
			$dataPengurus['geo_prov_id'] = @$_POST['provinsi'];
			$check = DB::table('m_pengurus')
				->where('geo_prov_id',@$_POST['provinsi'])
					->get();
			if(count($check) != 0){
				$proses = DB::table('m_pengurus')
					->where('geo_prov_id',@$_POST['provinsi'])
						->update($dataPengurus);					
			} else {
				$proses = DB::table('m_pengurus')
					->insertGetId($dataPengurus);					
			}
		} else {
			/* Edit */
			$proses = DB::table('m_pengurus')
				->where('pengurus_id',$idPengurus)
					->update($dataPengurus);
		}
		
		return redirect('master/statistik');
	}
	public function actionStatistikDelete($delete=0)
	{
		/* Delete */
			$proses = DB::table('m_pengurus')
				->where('pengurus_id',$delete)
					->delete();
		
		return redirect('master/statistik');
	}
	
	public function viewMasterPerolehanKursi($prov=0)
	{
		$data = DB::table('m_statistik_kursi')
			->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_statistik_kursi.geo_prov_id')
				->orderBy('m_geo_prov_kpu.geo_prov_id')
					->get();
		$dataProvinsi = DB::table('m_geo_prov_kpu')->get();
	
		return view('main.master.perolehan_kursi',array(
			'data' => $data,
			'dataProvinsi' => $dataProvinsi
		));
	}
	
	public function actionPerolehanKursi($delete=0)
	{
		$dataPengurus = array();
		$idPengurus = 0;
		if($delete == 0){			
			$idPengurus = @$_POST['edit_statistik'];
			
			$edit = '';
			if($idPengurus != 0){
				$edit = 'edit_';
			}
			
			$dataPerolehanKursi['statistik_dapil_t1'] = $_POST[$edit.'dapil_t1'];
			$dataPerolehanKursi['statistik_dapil_t2'] = $_POST[$edit.'dapil_t2'];
			$dataPerolehanKursi['statistik_dapil_t3'] = $_POST[$edit.'dapil_t3'];
			$dataPerolehanKursi['statistik_kursi_t1'] = $_POST[$edit.'kursi_t1'];
			$dataPerolehanKursi['statistik_kursi_t2'] = $_POST[$edit.'kursi_t2'];
			$dataPerolehanKursi['statistik_kursi_t3'] = $_POST[$edit.'kursi_t3'];
			$dataPerolehanKursi['statistik_kursi_t1_ada'] = $_POST[$edit.'kursi_t1_ada'];
			$dataPerolehanKursi['statistik_kursi_t2_ada'] = $_POST[$edit.'kursi_t2_ada'];
			$dataPerolehanKursi['statistik_kursi_t3_ada'] = $_POST[$edit.'kursi_t3_ada'];
			
			if($idPengurus == 0){
				/* Tambah */
				$dataPerolehanKursi['geo_prov_id'] = @$_POST['provinsi'];
				$check = DB::table('m_statistik_kursi')
					->where('geo_prov_id',@$_POST['provinsi'])
						->get();
				if(count($check) != 0){
					$proses = DB::table('m_statistik_kursi')
						->where('geo_prov_id',@$_POST['provinsi'])
							->update($dataPerolehanKursi);					
				} else {
					$proses = DB::table('m_statistik_kursi')
						->insertGetId($dataPerolehanKursi);					
				}
			} else {
				/* Edit */
				$proses = DB::table('m_statistik_kursi')
					->where('statistik_kursi_id',$idPengurus)
						->update($dataPerolehanKursi);
			}
		} else {
			/* Delete */
			$proses = DB::table('m_statistik_kursi')
				->where('statistik_kursi_id',$delete)
					->delete();
		}
		return redirect('master/perolehankursi');
	}
}