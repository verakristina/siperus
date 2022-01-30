<?php namespace App\Http\Controllers;

use DB;
use Input;
use Redirect;
use Fpdf;
use Illuminate\Http\Request;
use Validator;
use Session;
use File;

date_default_timezone_set('Asia/Jakarta');
class SettingController extends Controller {
	public function __construct(){ $this->middleware('guest'); }

	/* Function View */
	public function viewSetting(){
		if(session('idProvinsi') == ''){
			$dataAkses = DB::table('ref_akses')
				->select('*','akses_id as id','akses_nama as value')
					->where('akses_id','>',0)
						->get();
			$dataAgama = DB::table('ref_agama')
				->select('*','agama_id as id','agama_value as value')
					->where('agama_id','>',0)
						->get();
			$dataIdentitas = DB::table('ref_identitas')
				->select('*','identitas_id as id','identitas_value as value')
					->where('identitas_id','>',0)
						->get();
			$dataJk = DB::table('ref_jk')
				->select('*','jk_id as id','jk_value as value')
					->where('jk_id','>',0)
						->get();
			$dataPekerjaan = DB::table('ref_pekerjaan')
				->select('*','pekerjaan_id as id','pekerjaan_value as value')
					->where('pekerjaan_id','>',0)
						->get();
			$dataStatus = DB::table('ref_status')
				->select('*','status_id as id','status_value as value')
					->where('status_id','>',0)
						->get();
			return view('main.setting.setting',array(
				'dataAgama' => $dataAgama,
				'dataAkses' => $dataAkses,
				'dataIdentitas' => $dataIdentitas,
				'dataJk' => $dataJk,
				'dataPekerjaan' => $dataPekerjaan,
				'dataStatus' => $dataStatus


			));
		} else {
			return redirect('logout');
		}
	}
	/* /. Function View */

	/* Function Proses */
	public function prosesSetting($menu){
		$data		= Input::get('data');
		$deskripsi	= Input::get('deskripsi');
		$date		= date('Y-m-d H:i:s');
		if($menu == 'area') {
			$plant = Input::get('plant');
			$prosesTambah = DB::table('ref_'.$menu)
				->insertGetId([
					'plant_id' => $plant,
					$menu.'_nama' => $data,
					$menu.'_deskripsi' => $deskripsi,
					'created_date' => $date,
					'created_by' => session('login')
				]);					
		} else if($menu == 'mesin') { 
			$area = Input::get('area');
			$prosesTambah = DB::table('ref_'.$menu)
				->insertGetId([
					'area' => $area,
					$menu.'_nama' => $data,
					$menu.'_deskripsi' => $deskripsi,
					'created_date' => $date,
					'created_by' => session('login')
				]);	
		} else if($menu == 'waste') {
			$area = Input::get('area');
			$mesin = Input::get('mesin');
			$jenisWaste = Input::get('kategori_waste');
			$satuan = Input::get('satuan');
			$prosesTambah = DB::table('ref_'.$menu)
				->insertGetId([
					'mesin_id' => $mesin,
					'jenis_waste_id' => $jenisWaste,
					'satuan_id' => $satuan,
					$menu.'_nama' => $data,
					$menu.'_deskripsi' => $deskripsi,
					'created_date' => $date,
					'created_by' => session('login')
				]);	
		} else { 
			$prosesTambah = DB::table('ref_'.$menu)
				->insertGetId([
					$menu.'_nama' => $data,
					$menu.'_deskripsi' => $deskripsi,
					'created_date' => $date,
					'created_by' => session('login')
				]);
		}
		return redirect('setting')->with('tabActive',$menu);
	}
	public function prosesEditSetting($menu,$id){
		$data		= Input::get('data');
		$deskripsi	= Input::get('deskripsi');
		$date		= date('Y-m-d H:i:s');
		if($menu == 'area') {
			$plant = Input::get('plant');
			$prosesUpdate = DB::table('ref_'.$menu)
				->where('area_id',$id)
				->update([
					'plant_id' => $plant,
					$menu.'_nama' => $data,
					$menu.'_deskripsi' => $deskripsi,
					'created_date' => $date,
					'created_by' => session('login')
				]);					
		} else if($menu == 'mesin') { 
			$area = Input::get('area');
			$prosesUpdate = DB::table('ref_'.$menu)
				->where('mesin_id',$id)
				->update([
					'area' => $area,
					$menu.'_nama' => $data,
					$menu.'_deskripsi' => $deskripsi,
					'created_date' => $date,
					'created_by' => session('login')
				]);		
		} else if($menu == 'waste') {
			$area = Input::get('area');
			$mesin = Input::get('mesin');
			$jenisWaste = Input::get('kategori_waste');
			$satuan = Input::get('satuan');
			$prosesUpdate = DB::table('ref_'.$menu)
				->where('waste_id',$id)
				->update([
					'mesin_id' => $mesin,
					'jenis_waste_id' => $jenisWaste,
					'satuan_id' => $satuan,
					$menu.'_nama' => $data,
					$menu.'_deskripsi' => $deskripsi,
					'created_date' => $date,
					'created_by' => session('login')
				]);		
		} else { 
			$prosesUpdate = DB::table('ref_'.$menu)
				->where($menu.'_id',$id)		
				->update([
					$menu.'_nama' => $data,
					$menu.'_deskripsi' => $deskripsi,
					'created_date' => $date,
					'created_by' => session('login')
				]);
		}
		return redirect('setting')->with('tabActive',$menu);
	}
	public function prosesDeleteMenu($menu, $id){
		$prosesDelete = DB::table('ref_'.$menu)
			->where($menu.'_id',$id)
				->delete();
		return redirect('setting')->with('tabActive',$menu);
	}
	/* /. Function Proses */
	
}
