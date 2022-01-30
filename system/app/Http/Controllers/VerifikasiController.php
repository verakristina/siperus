<?php namespace App\Http\Controllers; 

use DB;
use Input;
use Redirect;
use Fpdf; 
use Illuminate\Http\Request;
use File;
/**
* 
*/
class VerifikasiController extends Controller
{
	public function actionRDVerifikasi($prov='',$delete=0){
		if($delete != 0){ // Delete Query
		
		} else { // View Query
			$dataDPD = DB::table('m_verifikasi')
				->select('*',DB::raw('CONCAT("DPD ",m_geo_prov_kpu.geo_prov_nama) as namaVerifikasi'))
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
				->leftjoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
					->where('m_verifikasi.verifikasi_tingkat',1);
			$dataDPC = DB::table('m_verifikasi')
				->select('*',DB::raw('CONCAT("DPC ",m_geo_kab_kpu.geo_kab_nama) as namaVerifikasi'))
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
				->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_verifikasi.geo_kab_id')
				->leftjoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
					->where('m_verifikasi.verifikasi_tingkat',2);
		
			if($prov){
				$dataDPD->where('m_verifikasi.geo_prov_id',$prov);
				$dataDPC->where('m_verifikasi.geo_prov_id',$prov);
			}
			if(session('idRole') == 4){
				$dataDPD->where('m_verifikasi.geo_kab_id',session('idKabupaten'));
				$dataDPC->where('m_verifikasi.geo_kab_id',session('idKabupaten'));
			}
			$dataDPD = $dataDPD->get();
			$dataDPC = $dataDPC->get();
			
			$provinsi = DB::table('m_geo_prov_kpu')->get();
			$kabupaten = DB::table('m_geo_kab_kpu')->get();
			$breadcrumb[]='Verifikasi';
			$breadcrumb[]='List';
			$dataStatusKantor = DB::table('ref_status_kantor')->get();
			
			return view('main.verifikasi.index',array(
				'dataStatusKantor' => $dataStatusKantor,
				'breadcrumb' => $breadcrumb,
				'provinsi' => $provinsi,
				'kabupaten' => $kabupaten,
				'selected' => [$prov,0,0,0,0],
				'dataDPD' => $dataDPD,
				'dataDPC' => $dataDPC
			));
		}
	}
	
	public function actionCUVerifikasi($edit){
		$allowed = array('png', 'jpg', 'jpeg', 'docx', 'pdf', 'doc', 'xlsx', 'xls');
		if($edit != ""){ // Update Query
			$data['verifikasi_status_kantor'] = @$_POST['statusKantor'];
			$data['verifikasi_alamat_kantor'] = @$_POST['alamatKantor'];
			$data['verifikasi_ibukota'] = @$_POST['ibukota'];
			$data['verifikasi_keaktifan_pengurus'] = @$_POST['keaktifanPengurus'];
			$data['verifikasi_perempuan'] = @$_POST['perempuan'];
			$data['verifikasi_jumlah_kta'] = @$_POST['jumlahKTA'];
			$data['verifikasi_ruang_kerja_k'] = @$_POST['ruangKerjak'];
			$data['verifikasi_ruang_kerja_s'] = @$_POST['ruangKerjas'];
			$data['verifikasi_ruang_kerja_b'] = @$_POST['ruangKerjab'];
			$data['verifikasi_staf_admin'] = @$_POST['stafAdmin'];
			$data['verifikasi_papan_nama'] = @$_POST['papanNama'];
			$data['verifikasi_papan_nama_img'] = @$_POST['papanNamaImg'];
			$data['verifikasi_preswapres'] = @$_POST['presWaPres'];
			$data['verifikasi_garuda'] = @$_POST['garuda'];
			$data['verifikasi_ketum_sekjen'] = @$_POST['ketumSekjen'];
			$data['verifikasi_nomer_rekening'] = @$_POST['nomerRekening'];

			if(Input::hasFile('foto')) {
				$file 	= Input::file('foto');
				$f_name = $file->getClientOriginalName();
				$exp = explode(".", $f_name);
				$ext = $exp[1];
				if(array_search($ext, $allowed) !== false){
					$ext = File::extension($file->getClientOriginalName());
					$new_name = strtotime(date('Y-m-d H:i:s'))."_".$edit.".".$ext; 
					$file->move('asset/img/verifikasi/'.$edit.'/gambar', $new_name); 
					$data['verifikasi_pic'] = $new_name;
				}
			}
			
			if(Input::hasFile('foto2')) {
				$file2 	= Input::file('foto2');
				$f_name = $file2->getClientOriginalName();
				$exp = explode(".", $f_name);
				$ext = $exp[1];
				if(array_search($ext, $allowed) !== false){
					$ext2 = File::extension($file2->getClientOriginalName());
					$new_name2 = strtotime(date('Y-m-d H:i:s'))."2_".$edit.".".$ext2; 
					$file2->move('asset/img/verifikasi/'.$edit.'/gambar', $new_name2); 
					$data['verifikasi_pic2'] = $new_name2;
				}
			}


			$prosesInsert = DB::table('m_verifikasi')
				->where('verifikasi_id',$edit)
					->update($data);
		} else { // Insert Query
			$data['verifikasi_status_kantor'] = @$_POST['statusKantor'];
			$data['verifikasi_alamat_kantor'] = @$_POST['alamatKantor'];
			$data['verifikasi_ibukota'] = @$_POST['ibukota'];
			$data['verifikasi_keaktifan_pengurus'] = @$_POST['keaktifanPengurus'];
			$data['verifikasi_perempuan'] = @$_POST['perempuan'];
			$data['verifikasi_jumlah_kta'] = @$_POST['jumlahKTA'];
			$data['verifikasi_ruang_kerja_k'] = @$_POST['ruangKerjak'];
			$data['verifikasi_ruang_kerja_s'] = @$_POST['ruangKerjas'];
			$data['verifikasi_ruang_kerja_b'] = @$_POST['ruangKerjab'];
			$data['verifikasi_staf_admin'] = @$_POST['stafAdmin'];
			$data['verifikasi_papan_nama'] = @$_POST['papanNama'];
			$data['verifikasi_papan_nama_img'] = @$_POST['papanNamaImg'];
			$data['verifikasi_preswapres'] = @$_POST['presWaPres'];
			$data['verifikasi_garuda'] = @$_POST['garuda'];
			$data['verifikasi_ketum_sekjen'] = @$_POST['ketumSekjen'];
			$data['verifikasi_nomer_rekening'] = @$_POST['nomerRekening'];
			
			$prosesInsert = DB::table('m_verifikasi')
				->insertGetId($data);
		}
		
		return redirect()->back();
	}
	
	public function actionRDOrsap($prov='',$delete=0){
		if($delete != 0){ // Delete Query
		
		} else { // View Query		
			if($prov == ''){
				$dataOrsap = DB::table('m_orsap')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_orsap.geo_prov_id')
						->orderBy('orsap_id')
						->orderBy('orsap_deskripsi_id')
							->get();
				$dataSOrsap = DB::table('m_struktur_orsap')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_struktur_orsap.geo_prov_id')
						->orderBy('struktur_orsap_id')
						->orderBy('struktur_orsap_deskripsi_id')
							->get();
			} else {
				$dataOrsap = DB::table('m_orsap')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_orsap.geo_prov_id')
						->where('m_orsap.geo_prov_id',$prov)
							->orderBy('orsap_id')
							->orderBy('orsap_deskripsi_id')
							->get();
				$dataSOrsap = DB::table('m_struktur_orsap')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_struktur_orsap.geo_prov_id')
						->where('m_struktur_orsap.geo_prov_id',$prov)
							->orderBy('struktur_orsap_id')
							->orderBy('struktur_orsap_deskripsi_id')
							->get();
			}
			
			$provinsi = DB::table('m_geo_prov_kpu')->get();
			$breadcrumb[]='Verifikasi';
			$breadcrumb[]='ORSAP/ORTOM';
			$breadcrumb[]='List';
			
			return view('main.orsap.index',array(
				'breadcrumb' => $breadcrumb,
				'provinsi' => $provinsi,
				'selected' => [$prov,0,0,0,0],
				'dataOrsap' => $dataOrsap,
				'dataSOrsap' => $dataSOrsap
			));
		}
	}

	public function actionCUOrsap($edit,$jenis){
		
		if($edit != 0){ // Update Query
			if ($jenis != 'struktur') {
				$data['orsap_aktif'] = @$_POST['aktif'];
				$data['orsap_kantor'] = @$_POST['kantor'];
				$data['orsap_pengurus'] = @$_POST['pengurus'];
				$data['orsap_keterangan'] = @$_POST['keterangan'];

				$prosesInsert = DB::table('m_orsap')
					->where('orsap_id',$edit)
						->update($data);
			} else {
				$data['struktur_orsap_dpd'] = @$_POST['dpd'];
				$data['struktur_orsap_dpc'] = @$_POST['dpc'];
				$data['struktur_orsap_pac'] = @$_POST['pac'];
				$data['struktur_orsap_par'] = @$_POST['par'];

				$prosesInsert = DB::table('m_struktur_orsap')
					->where('struktur_orsap_id',$edit)
						->update($data);
			}
		} else { // Insert Query
			
		}
		
		return redirect()->back();
	}

}