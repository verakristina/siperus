<?php namespace App\Http\Controllers; 

use DB;
use Input;
use Redirect;
use Fpdf; 
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


/**
* 
*/
class ReportController extends Controller
{
	public function viewReportPefoma($type,$prov=null,$kab=null,$kec=null,$deskel=null,$rw=null){
		$namaKetuaDPD = '';
		$namaSekDPD = '';
		$SkepKet = '';
		$SkepSek = '';
		$breadcrumb[] = 'Report';
		
		$provinsi = DB::table('m_geo_prov_kpu')->get();
		$dataProv = DB::table('m_geo_prov_kpu')
			->where('geo_prov_id',$prov)
				->first();
		
		if($type == 'dashboard') {
			$breadcrumb[]='Dashboard Report';
		} else if($type == 'pimda') {
			$breadcrumb[]='Perfoma PIMDA';
		} else if($type == 'pimcab') {
			$breadcrumb[]='Perfoma PIMDA Terhadap Pembentukan PIMCAB';
		} else if($type == 'pimcam') {
			$breadcrumb[]='Perfoma PIMDA Terhadap Pembentukan PIMCAM';
			
		} else if($type == 'pimran') {
			$breadcrumb[]='Perfoma PIMDA Terhadap Pembentukan PIMRAN';
			
		} else if($type == 'par') {
			$breadcrumb[]='Perfoma PIMDA Terhadap Pembentukan PAR';
			
		} else if($type == 'kpa') {
			$breadcrumb[]='Perfoma DPD Terhadap Pembentukan KPA';
			
		}
		
		$masterData = [
			'type' => $type,
			'provinsi' => $provinsi,
			'dataAnggota' => @$dataAnggota,
			'dataLingkar' => @$dataLingkar,
			'selected' =>[$prov,$kab,$kec,$deskel,$rw],
			'breadcrumb' => $breadcrumb
		];
		if($kab)
			$masterData['kabupaten'] = DB::table('m_geo_kab_kpu')
				->select('geo_kab_nama','geo_kab_id')
					->where('geo_prov_id','=',$prov)
						->get();
		if($kec)
			$masterData['kecamatan'] = DB::table('m_geo_kec_kpu')
				->select('geo_kec_nama','geo_kec_id')
					->where('geo_kab_id','=',$kab)
						->get();
		if($deskel)
			$masterData['kelurahan'] = DB::table('m_geo_deskel_kpu')
				->select('geo_deskel_nama','geo_deskel_id')
					->where('geo_kec_id','=',$kec)
						->get();
		if($rw)
			$masterData['rukunwarga'] = DB::table('m_geo_rw_kpu')
				->select('geo_rw_nama','geo_rw_id')
					->where('geo_deskel_id','=',$deskel)
						->get();
		if($prov != null){
			$getNullDPC = DB::table('m_geo_kab_kpu')
							->select('m_geo_kab_kpu.geo_kab_nama')
							->leftJoin('r_bio_pimcab', 'r_bio_pimcab.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
							->join('m_geo_prov_kpu', 'm_geo_prov_kpu.geo_prov_id', '=', 'm_geo_kab_kpu.geo_prov_id')
							->where('m_geo_prov_kpu.geo_prov_id', $prov)
							->whereNull('r_bio_pimcab.geo_kab_id')
							->groupBy('m_geo_kab_kpu.geo_kab_id')
							->orderBy('m_geo_kab_kpu.geo_kab_id');
			$getNullPAC = DB::table('m_geo_kec_kpu')
							->select('m_geo_kec_kpu.geo_kec_nama', 'm_geo_kab_kpu.geo_kab_nama')
							->leftJoin('r_bio_pimcam', 'r_bio_pimcam.geo_kec_id', '=', 'm_geo_kec_kpu.geo_kec_id')
							->join('m_geo_kab_kpu', 'm_geo_kec_kpu.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
							->where('m_geo_kab_kpu.geo_prov_id', $prov)
							->whereNull('r_bio_pimcam.geo_kec_id')
							->groupBy('m_geo_kec_kpu.geo_kec_id')
							->orderBy('m_geo_kab_kpu.geo_kab_nama')
							->orderBy('m_geo_kec_kpu.geo_kec_nama');

			$getNullPR	= DB::table('m_geo_deskel_kpu')
							->select('m_geo_deskel_kpu.geo_deskel_nama', 'm_geo_kec_kpu.geo_kec_nama')
							->leftJoin('r_bio_pimran', 'r_bio_pimran.geo_deskel_id', '=', 'm_geo_deskel_kpu.geo_deskel_id')
							->join('m_geo_kec_kpu', 'm_geo_deskel_kpu.geo_kec_id', '=', 'm_geo_kec_kpu.geo_kec_id')
							->join('m_geo_kab_kpu', 'm_geo_kec_kpu.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
							->where('m_geo_kab_kpu.geo_prov_id', $prov)
							->whereNull('r_bio_pimran.geo_deskel_id')
							->groupBy('m_geo_deskel_kpu.geo_deskel_id')
							->orderBy('m_geo_kec_kpu.geo_kec_nama')
							->orderBy('m_geo_deskel_kpu.geo_deskel_nama');
			/*$getNullPAC = DB::select('SELECT
							m_geo_kab_kpu.geo_pimranov_id,
							m_geo_kab_kpu.geo_kab_nama,
							m_geo_kec_kpu.geo_kec_nama,
							m_geo_kec_kpu.geo_kec_id,
							r_bio_pimcam.geo_kec_id AS G_KEC
						FROM
							m_geo_kec_kpu
						LEFT JOIN r_bio_pimcam ON r_bio_pimcam.geo_kec_id = m_geo_kec_kpu.geo_kec_id
						INNER JOIN m_geo_kab_kpu ON m_geo_kec_kpu.geo_kab_id = m_geo_kab_kpu.geo_kab_id
						WHERE
							m_geo_kab_kpu.geo_prov_id = '.$prov.'
							AND r_bio_pimcam.geo_kec_id IS NULL
						GROUP BY
							m_geo_kec_kpu.geo_kec_id
						ORDER BY
							r_bio_pimcam.geo_kec_id');*/
			$masterData['pimcab_all'] = $getNullDPC;
			$masterData['pimcab_null']  = $getNullDPC->get();
			$masterData['pimcam_all'] = $getNullPAC;
			$masterData['pimcam_null']  = $getNullPAC->get();
			$masterData['pimran_all'] = $getNullPR;
			$masterData['pimran_null'] = $getNullPR->get();
		}
						
		$dataDPD = DB::table('m_bio')
			->join('r_bio_pimda','r_bio_pimda.bio_id','=','m_bio.bio_id')
			->leftjoin('m_struk_pimda','m_struk_pimda.struk_pimda_id','=','r_bio_pimda.struk_pimda_id')
				->where('m_struk_pimda.struk_pimda_nama','=',"Ketua")
				->where('r_bio_pimda.geo_prov_id',$prov)
					->get();

		$dataDPDS = DB::table('m_bio')
			->join('r_bio_pimda','r_bio_pimda.bio_id','=','m_bio.bio_id')
			->leftjoin('m_struk_pimda','m_struk_pimda.struk_pimda_id','=','r_bio_pimda.struk_pimda_id')
				->where('m_struk_pimda.struk_pimda_nama','=',"Sekretaris")
				->where('r_bio_pimda.geo_prov_id',$prov)
					->get();
			
		foreach($dataDPD as $tmp){
			$namaKetuaDPD = $tmp->bio_nama_depan.' '.$tmp->bio_nama_tengah.' '.$tmp->bio_nama_belakang;
			$SkepKet = $tmp->bio_pimda_sk;
		}
				
		foreach($dataDPDS as $tmp){
			$namaSekDPD = $tmp->bio_nama_depan.' '.$tmp->bio_nama_tengah.' '.$tmp->bio_nama_belakang;
			$SkepSek = $tmp->bio_pimda_sk;
		}

		$masterData['namaKetuaDPD'] = $namaKetuaDPD;
		$masterData['namaSekDPD'] = $namaSekDPD;
		$masterData['SkepKet'] = $SkepKet;
		$masterData['SkepSek'] = $SkepSek;
		$masterData['namaDaerah'] = @$dataProv->geo_prov_nama;
		$masterData['prov'] = $prov;
		
		return view('main.report.index',$masterData);
	}
	
	public function viewGrafikReportPefoma($jenis,$type,$prov=null,$kab=null,$kec=null,$deskel=null,$rw=null,$dprdi=null){
		$data = [];
		$dataProv = DB::table('m_geo_prov_kpu')
			->where('geo_prov_id',$prov)
				->first();
		
		if($prov) {			
			$pengurus = DB::table('m_pengurus')
				->where('geo_prov_id',$prov)
					->first();
			$cKokab = DB::table('m_geo_kab_kpu')
					->where('geo_prov_id', $prov)
					->count();
			$cKecam = DB::table('m_geo_kec_kpu')
					->join('m_geo_kab_kpu', 'm_geo_kec_kpu.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
					->where('m_geo_kab_kpu.geo_prov_id', $prov)
					->count();
			$cDeskel = DB::table('m_geo_deskel_kpu')
					->join('m_geo_kec_kpu', 'm_geo_kec_kpu.geo_kec_id', '=', 'm_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu', 'm_geo_kec_kpu.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
					->where('m_geo_kab_kpu.geo_prov_id', $prov)
					->count();

			$pDPC = DB::table('r_bio_pimcab')
					->where('geo_prov_id', $prov)
					->groupBy('geo_kab_id')
					->get();

			$pPAC = DB::table('r_bio_pimcam')
					->where('geo_prov_id', $prov)
					->groupBy('geo_kec_id')
					->get();
			$pPR  = DB::table('r_bio_pimran')
					->where('geo_prov_id', $prov)
					->groupBy('geo_deskel_id')
					->get();

			$pimcab_tbk = count($pDPC);
			$pimcam_tbk = count($pPAC);
			$pr_tbk = count($pPR);

			/*echo $cKokab." ".$pimcab_tbk." ".$cKecam." ".$pimcam_tbk." ".$cDeskel." ".$pr_tbk; die();*/
			/*echo $cKokab." ".$cKecam." ".$cDeskel; die();*/

			$performa = DB::select('select 
			statistik_dapil_t1 as dapil_t1, statistik_dapil_t2 as dapil_t2, statistik_dapil_t3 as dapil_t3, 
			statistik_kursi_t1 as kursi_t1, statistik_kursi_t2 as kursi_t2, statistik_kursi_t3 as kursi_t3, 
			(select count(*) from r_bio_dprri join m_bio on m_bio.bio_id = r_bio_dprri.bio_id where r_bio_dprri.geo_prov_id = m_statistik_kursi.geo_prov_id) as kursi_t1_ada,
			(select count(*) from r_bio_dprdi join m_bio on m_bio.bio_id = r_bio_dprdi.bio_id where r_bio_dprdi.geo_prov_id = m_statistik_kursi.geo_prov_id) as kursi_t2_ada,
			(select count(*) from r_bio_dprdii join m_bio on m_bio.bio_id = r_bio_dprdii.bio_id where r_bio_dprdii.geo_prov_id = m_statistik_kursi.geo_prov_id) as kursi_t3_ada
			FROM m_statistik_kursi 
			JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = m_statistik_kursi.geo_prov_id
			WHERE m_geo_prov_kpu.geo_prov_id="'.$prov.'"
			GROUP BY m_statistik_kursi.geo_prov_id');
			/*->join('m_geo_prov_kpu',' m_geo_prov_kpu.geo_prov_id','=','m_statistik_kursi.geo_prov_id')*/
			/*->where('m_geo_prov_kpu.geo_prov_id',$prov) */  
			/*->groupBy('m_statistik_kursi.geo_prov_id');*/
		} else {
			$cProv = DB::table('m_geo_prov_kpu')->count();
			$cKokab = DB::table('m_geo_kab_kpu')->count();
			$cKecam = DB::table('m_geo_kec_kpu')->count();
			$cDeskel = DB::table('m_geo_deskel_kpu')->count();

			/*$pDPD = DB::table('r_bio_pimda')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_pimda.geo_prov_id')
					->groupBy('r_bio_pimda.geo_prov_id')
					->get();
			$pDPC = DB::table('m_geo_kab_kpu')
					->join('r_bio_pimcab','m_geo_kab_kpu.geo_kab_id','=','r_bio_pimcab.geo_kab_id')
					->groupBy('r_bio_pimcab.geo_kab_id')
					->get();
			$pPAC = DB::table('r_bio_pimcam')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_pimcam.geo_kec_id')
					->groupBy('r_bio_pimcam.geo_kec_id')
					->get();
			$pPR  = DB::table('r_bio_pimran')
					->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','r_bio_pimran.geo_deskel_id')
					->groupBy('r_bio_pimran.geo_deskel_id')
					->get();*/

			$pDPD = DB::table('r_bio_pimda')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_pimda.geo_prov_id')
					->groupBy('r_bio_pimda.geo_prov_id')
					->whereNotNull('r_bio_pimda.geo_prov_id')
					->get();
			$pDPC = DB::table('r_bio_pimcab')
					->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_pimcab.geo_kab_id')
					->groupBy('r_bio_pimcab.geo_kab_id')
					->whereNotNull('r_bio_pimcab.geo_kab_id')
					->get();
			$pPAC = DB::table('r_bio_pimcam')
					->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_pimcam.geo_kec_id')
					->groupBy('r_bio_pimcam.geo_kec_id')
					->whereNotNull('r_bio_pimcam.geo_kec_id')
					->get();
			$pPR  = DB::table('r_bio_pimran')
					->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','r_bio_pimran.geo_deskel_id')
					->groupBy('r_bio_pimran.geo_deskel_id')
					->whereNotNull('r_bio_pimran.geo_deskel_id')
					->get();
					
			$pimda_tbk = count($pDPD);
			$pimcab_tbk = count($pDPC);
			$pimcam_tbk = count($pPAC);
			$pr_tbk = count($pPR);

			$pengurus = DB::table('m_pengurus')
				->select(DB::raw('sum(pengurus_pimcab) as pengurus_pimcab'),DB::raw('sum(pengurus_pimcab_ada) as pengurus_pimcab_ada')
				,DB::raw('sum(pengurus_pimcam) as pengurus_pimcam'),DB::raw('sum(pengurus_pimcam_ada) as pengurus_pimcam_ada')
				,DB::raw('sum(pengurus_ranting) as pengurus_ranting'),DB::raw('sum(pengurus_ranting_ada) as pengurus_ranting_ada')
				,DB::raw('sum(pengurus_anak_ranting) as pengurus_anak_ranting'),DB::raw('sum(pengurus_anak_ranting_ada) as pengurus_anak_ranting_ada')
				,DB::raw('sum(pengurus_kpa) as pengurus_kpa'),DB::raw('sum(pengurus_kpa_ada) as pengurus_kpa_ada'))
					->first();

			$performa = DB::select('select 
			sum(statistik_dapil_t1) as dapil_t1, sum(statistik_dapil_t2) as dapil_t2, sum(statistik_dapil_t3) as dapil_t3, 
			sum(statistik_kursi_t1) as kursi_t1, sum(statistik_kursi_t2) as kursi_t2, sum(statistik_kursi_t3) as kursi_t3, 
			(select count(*) from r_bio_dprri join m_bio on m_bio.bio_id = r_bio_dprri.bio_id) as kursi_t1_ada,
			(select count(*) from r_bio_dprdi join m_bio on m_bio.bio_id = r_bio_dprdi.bio_id) as kursi_t2_ada,
			(select count(*) from r_bio_dprdii join m_bio on m_bio.bio_id = r_bio_dprdii.bio_id) as kursi_t3_ada
			FROM m_statistik_kursi');

			/*->join('m_geo_prov_kpu',' m_geo_prov_kpu.geo_prov_id','=','m_statistik_kursi.geo_prov_id')*/
			/*->where('m_geo_prov_kpu.geo_prov_id',$prov) */  
			/*->groupBy('m_statistik_kursi.geo_prov_id');*/
		}

		foreach ($performa as $t) {
			$dataKursit1 = $t->kursi_t1;
			$dataKursit1ada = $t->kursi_t1_ada;
			$dataKursit2 = $t->kursi_t2;
			$dataKursit2ada = $t->kursi_t2_ada;
			$dataKursit3 = $t->kursi_t3;
			$dataKursit3ada = $t->kursi_t3_ada;

			if($dataKursit1ada != 0 || $dataKursit1 != 0){
				$dataDprriPer = number_format($dataKursit1ada/$dataKursit1*100,2) ;
			}
			if($dataKursit2ada != 0 || $dataKursit2 != 0){
				$dataDprdiPer = number_format($dataKursit2ada/$dataKursit2*100,2);
			}
			if($dataKursit3ada != 0 || $dataKursit3 != 0){
				$dataDprdiiPer = number_format($dataKursit3ada/$dataKursit3*100,2);
			}		
		}
		
		

		if($type == 'pie'){
			if($jenis == 'pimda'){
				$dataGrafik = [['Sudah Ada',1],['Belum Ada',0]];
			} else if($jenis == 'pimcab'){
				$dataGrafik = [['Sudah Ada',@$pimcab_tbk],['Belum Ada',@$cKokab-@$pimcab_tbk]];
			} else if($jenis == 'pimcam'){
				$dataGrafik = [['Sudah Ada',@$pimcam_tbk],['Belum Ada',@$pimcam_tbk-@$cKecam]];
			} else if($jenis == 'pimran'){
				$dataGrafik = [['Sudah Ada',@$pengurus->pengurus_ranting_ada],['Belum Ada',@$pengurus->pengurus_ranting-@$pengurus->pengurus_ranting_ada]];
			} else if($jenis == 'par'){
				$dataGrafik = [['Sudah Ada',@$pengurus->pengurus_anak_ranting_ada],['Belum Ada',@$pengurus->pengurus_ranting-@$pengurus->pengurus_ranting_ada]];
			} else if($jenis == 'kpa'){
				$dataGrafik = [['Sudah Ada',@$pengurus->pengurus_kpa_ada],['Belum Ada',@$pengurus->pengurus_kpa-@$pengurus->pengurus_kpa_ada]];
			}
			
			
			$return = 'main.report.pie';
			
		} else if($type == 'ketua'){
			
		} else if($type == 'provinsi'){
			$return = 'main.report.line';
			$dataProv = DB::table('m_geo_prov_kpu')
				->count();
			$dataDPD = DB::table('m_bio')
				->join('r_bio_pimda','r_bio_pimda.bio_id','=','m_bio.bio_id')
				->leftjoin('m_struk_pimda','m_struk_pimda.struk_pimda_id','=','r_bio_pimda.struk_pimda_id')
					->where('m_struk_pimda.struk_pimda_nama','Ketua')
						->count();

			if($pimda_tbk == 0){
				$dataProvPer = 0;
			}else{
				$dataProvPer = number_format(@$pimda_tbk/@$cProv*100,2);
			}
			$data['dataProvPer'] = $dataProvPer;
			/* $dataGrafik = [['Provinsi',count($dataProv)],['DPC B.TBK',@$dataProv@$pengurus->pengurus_pimcab-@$pengurus->pengurus_pimcab_ada],['DPC TBK',@$pengurus->pengurus_pimcab_ada]]; */
			$dataGrafik = [['Provinsi',@$cProv],['DPD B.TBK',@$cProv-@$pimda_tbk],['PIMDA TBK', @$pimda_tbk]];
		} else if($type == 'kabupaten'){
			$return = 'main.report.line';
			$dataKab = DB::table('m_geo_kab')
				->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
					->where('m_geo_prov.geo_prov_id',$prov);

			if($cKokab == 0){
				$dataKabPer = 0;
			}else{
				$dataKabPer = number_format($pimcab_tbk/@$cKokab*100,2);
			}
			$data['dataKabPer'] = $dataKabPer;
			/* $dataGrafik = [['Kabupaten',@$pengurus->pengurus_pimcab],['DPC B.TBK',@$pengurus->pengurus_pimcab-@$pengurus->pengurus_pimcab_ada],['DPC TBK',@$pengurus->pengurus_pimcab_ada]]; */
			$dataGrafik = [['Kabupaten',@$cKokab],['DPC B.TBK',@$cKokab-@$pimcab_tbk],['PIMCAB TBK',@$pimcab_tbk]];
		} else if($type == 'kecamatan'){
			$return = 'main.report.line';
			$dataKec = DB::table('m_geo_kec_kpu')
				->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
					->where('m_geo_prov.geo_prov_id',$prov);
					if($kab){
						$dataKec->where('m_geo_kab.geo_kab_id',$kab);
					}
			if($pimcam_tbk == 0){
				$dataKecPer = 0;
			}else{
				$dataKecPer = number_format(@$pimcam_tbk/@$cKecam*100,2);
			}
			$data['dataKecPer'] = $dataKecPer;		
			/* $dataGrafik = [['Kecamatan',@$pengurus->pengurus_pimcam],['PAC B.TBK',@$pengurus->pengurus_pimcam-@$pengurus->pengurus_pimcam_ada],['PAC TBK',@$pengurus->pengurus_pimcam_ada]]; */
			$dataGrafik = [['Kecamatan',@$cKecam],['PAC B.TBK',@$cKecam-@$pimcam_tbk],['PIMCAM TBK',@$pimcam_tbk]];
		} else if($type == 'kelurahan'){
			$return = 'main.report.line';
			$dataKel = DB::table('m_geo_deskel')
				->join('m_geo_kec','m_geo_kec.geo_kec_id','=','m_geo_deskel.geo_kec_id')
				->join('m_geo_kab','m_geo_kab.geo_kab_id','=','m_geo_kec.geo_kab_id')
				->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
					->where('m_geo_prov.geo_prov_id',$prov);
					if($kab){
						$dataKel->where('m_geo_kab.geo_kab_id',$kab);
					}
					if($kec){
						$dataKel->where('m_geo_kec.geo_kec_id',$kec);
					}
			if($pr_tbk == 0){
				$dataKelPer = 0;
			}else{
				$dataKelPer = number_format(@$pr_tbk/@$cDeskel*100,2);
			}
			$data['dataKelPer'] = $dataKelPer;			
			/* $dataGrafik = [['Kelurahan',@$pengurus->pengurus_ranting],['PR B.TBK',@$pengurus->pengurus_ranting-@$pengurus->pengurus_ranting_ada],['PR TBK',@$pengurus->pengurus_ranting_ada]]; */
			$dataGrafik = [['Kelurahan',@$cDeskel],['PR B.TBK',@$cDeskel-@$pr_tbk],['PIMRAN TBK',@$pr_tbk]];
		} else if($type == 'rw'){
			$return = 'main.report.line';
			$dataRW = DB::table('m_geo_rw')
				->join('m_geo_deskel','m_geo_deskel.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
				->join('m_geo_kec','m_geo_kec.geo_kec_id','=','m_geo_deskel.geo_kec_id')
				->join('m_geo_kab','m_geo_kab.geo_kab_id','=','m_geo_kec.geo_kab_id')
				->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
					->where('m_geo_prov.geo_prov_id',$prov);
					if($kab){
						$dataRW->where('m_geo_kab.geo_kab_id',$kab);
					}
					if($kec){
						$dataRW->where('m_geo_kec.geo_kec_id',$kec);
					}
					if($deskel){
						$dataRW->where('m_geo_deskel.geo_deskel_id',$deskel);
					}
			$dataRwPer = number_format(@$pengurus->pengurus_anak_ranting_ada/@$pengurus->pengurus_anak_ranting*100,2);
			$data['dataRwPer'] = $dataRwPer;			
			/* $dataGrafik = [['RW',@$pengurus->pengurus_anak_ranting],['PAR B.TBK',@$pengurus->pengurus_anak_ranting-@$pengurus->pengurus_anak_ranting_ada],['PAR TBK',@$pengurus->pengurus_anak_ranting_ada]]; */
			$dataGrafik = [['RW',@$pengurus->pengurus_anak_ranting],['PAR B.TBK',@$pengurus->pengurus_anak_ranting-@$pengurus->pengurus_anak_ranting_ada],['PAR TBK',@$pengurus->pengurus_anak_ranting_ada]];
		} else if($type == 'rt'){
			$return = 'main.report.line';
			$dataRT = DB::table('m_geo_rt')
				->join('m_geo_rw','m_geo_rw.geo_rw_id','=','m_geo_rt.geo_rw_id')
				->join('m_geo_deskel','m_geo_deskel.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
				->join('m_geo_kec','m_geo_kec.geo_kec_id','=','m_geo_deskel.geo_kec_id')
				->join('m_geo_kab','m_geo_kab.geo_kab_id','=','m_geo_kec.geo_kab_id')
				->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
					->where('m_geo_prov.geo_prov_id',$prov);
					if($kab){
						$dataRT->where('m_geo_kab.geo_kab_id',$kab);
					}
					if($kec){
						$dataRT->where('m_geo_kec.geo_kec_id',$kec);
					}
					if($deskel){
						$dataRT->where('m_geo_deskel.geo_deskel_id',$deskel);
					}
					if($rw){
						$dataRT->where('m_geo_rw.geo_rw_id',$rw);
					}
			$dataRtPer = number_format(@$pengurus->pengurus_kpa_ada/@$pengurus->pengurus_kpa*100,2);
			$data['dataRtPer'] = $dataRtPer;				
			/* $dataGrafik = [['RT',@$pengurus->pengurus_kpa],['KPA B.TBK',@$pengurus->pengurus_kpa-@$pengurus->pengurus_kpa_ada],['KPA TBK',@$pengurus->pengurus_kpa_ada]]; */
			$dataGrafik = [['RT',@$pengurus->pengurus_kpa],['KPA B.TBK',@$pengurus->pengurus_kpa-@$pengurus->pengurus_kpa_ada],['KPA TBK',@$pengurus->pengurus_kpa_ada]];
		} else if($type == 'dprri'){
			$return = 'main.report.line';
			$dataDprdi = DB::table('r_bio_dprri')
				->join('m_geo_prov','m_geo_prov.geo_prov_id','=','r_bio_dprri.geo_prov_id')
				->join('m_bio','m_bio.bio_id','=','r_bio_dprri.bio_id')
					->where('m_geo_prov.geo_prov_id',$prov);

			/* $dataGrafik = [['Kabupaten',@$pengurus->pengurus_pimcab],['DPC B.TBK',@$pengurus->pengurus_pimcab-@$pengurus->pengurus_pimcab_ada],['DPC TBK',@$pengurus->pengurus_pimcab_ada]]; */
			foreach ($performa as $d) {
				$dataGrafik = [['Jumlah Kursi',$d->kursi_t1],['DPR-RI',$d->kursi_t1-$d->kursi_t1_ada],['DPR-RI',$d->kursi_t1_ada]];
			}
			
		} else if($type == 'dprdi'){
			$return = 'main.report.line';
			$dataDprdi = DB::table('r_bio_dprdi')
				->join('m_geo_prov','m_geo_prov.geo_prov_id','=','r_bio_dprdi.geo_prov_id')
				->join('m_bio','m_bio.bio_id','=','r_bio_dprdi.bio_id')
					->where('m_geo_prov.geo_prov_id',$prov);

			/* $dataGrafik = [['Kabupaten',@$pengurus->pengurus_pimcab],['DPC B.TBK',@$pengurus->pengurus_pimcab-@$pengurus->pengurus_pimcab_ada],['DPC TBK',@$pengurus->pengurus_pimcab_ada]]; */
			foreach ($performa as $d) {
				$dataGrafik = [['Jumlah Kursi',$d->kursi_t2],['DPRD I',$d->kursi_t2-$d->kursi_t2_ada],['DPRD I',$d->kursi_t2_ada]];
			}
			
		} else if($type == 'dprdii'){
			$return = 'main.report.line';
			$dataDprdii = DB::table('r_bio_dprdii')
				->join('m_geo_prov','m_geo_prov.geo_prov_id','=','r_bio_dprdii.geo_prov_id')
				->join('m_bio','m_bio.bio_id','=','r_bio_dprdii.bio_id')
					->where('m_geo_prov.geo_prov_id',$prov);
					
			/* $dataGrafik = [['Kabupaten',@$pengurus->pengurus_pimcab],['DPC B',@$pengurus->pengurus_pimcab-@$pengurus->pengurus_pimcab_ada],['DPC',@$pengurus->pengurus_pimcab_ada]]; */
			foreach ($performa as $d) {
				$dataGrafik = [['Jumlah Kursi',$d->kursi_t3],['DPRD II',$d->kursi_t3-$d->kursi_t3_ada],['DPRD II',$d->kursi_t3_ada]];
			}
		}
		
		
		if($type == 'pie'){			
			$dataSeries = ",series: [{
				name: 'Brands',
				colorByPoint: true,
				data: [{
					name: '".@$dataGrafik[0][0]."',
					color: '#dd4b39',
					y: ".@$dataGrafik[0][1]."
				},{
					name: '".@$dataGrafik[1][0]."',
					color: '#ff0000',
					y: ".@$dataGrafik[1][1]."
				}]
			}]";
		} else {			
			$dataSeries = ",series: [{
					name: '".@$dataGrafik[0][0]."',
					color: '#000000',
					data: [".@$dataGrafik[0][1]."]
				}, {
					name: '".@$dataGrafik[2][0]."',
					color: '#dd4b39',
					data: [".@$dataGrafik[2][1]."]
				}]";
		}
						
		$data['dataSeries'] = $dataSeries;
		$data['dataDprriPer'] = $dataDprriPer;
		$data['dataDprdiPer'] = $dataDprdiPer;
		$data['dataDprdiiPer'] = $dataDprdiiPer;
		$data['namaDaerah'] = @$dataProv->geo_prov_nama;
		
		$data['type'] = $type;
		$data['jenis'] = $jenis;
		return view($return,$data);
	}

	public function getGrafikTabel($table, $prov, $kab = null, $kec = null, $kel = null, $rw = null, $rt = null) {
		$types = @$_GET['type'];
		$search = @$_GET['s'];
		
		$masterData['filterKab'] = false;
		$masterData['filterKec'] = false;
		$masterData['filterKel'] = false;
		$masterData['filterRW'] = false;
		$masterData['filterRT'] = false;
		$type = false;
		$groupBy = false;
		
		if($table == 'dprri' || $table == 'dprdi' || $table == 'dprdii') {
			$type = $table;
			$join_r_bio = DB::table('m_bio')
				->join('r_bio_'.$type,'r_bio_'.$type.'.bio_id','=','m_bio.bio_id')
				->leftJoin('m_bio_sk','m_bio_sk.bio_id','=','m_bio.bio_id')
				->leftJoin('m_bio_kta','m_bio_kta.bio_id','=','m_bio.bio_id')
				->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_'.$type.'.dapil_id');
				
			if($prov) {				
				$join_r_bio->where('m_dapil.pro_id','=',session('idProvinsi2'));
			}
			
		} else {
			if($table == 'provinsi') {
				$type = 'pimda';
				$groupBy = 'prov';
			} else if($table == 'kabupaten') {
				$type = 'pimcab';
				$groupBy = 'kab';
			} else if($table == 'kecamatan') {
				$type = 'pimcam';
				$groupBy = 'kec';
			} else if($table == 'kelurahan') {
				$type = 'pimran';
				$groupBy = 'deskel';
			} else if($table == 'rw') {
				$type = 'par';
				$groupBy = 'rw';
			} else if($table == 'rt') {
				$type = 'kpa';
				$groupBy = 'rt';
			} else if($table == 'dprri') {
			} else if($table == 'dprdi') {
			} else if($table == 'dprdii') {
			} else {
			}
			
			$join_r_bio = DB::table('r_bio_'.$type);

			switch($type) {
				case 'kpa':
					$join_r_bio->addselect('m_geo_rt.geo_rt_id','m_geo_rt.geo_rt_nama');
					$masterData['filterRW'] = true;
				case 'par':
					$join_r_bio->addselect('m_geo_rw.geo_rw_id','m_geo_rw.geo_rw_nama');
					$masterData['filterKel'] = true;
				case 'pimran':
					$join_r_bio->addselect('m_geo_deskel_kpu.geo_deskel_id','m_geo_deskel_kpu.geo_deskel_nama');
					$masterData['filterKec'] = true;
				case 'pimcam':
					$join_r_bio->addselect('m_geo_kec_kpu.geo_kec_id','m_geo_kec_kpu.geo_kec_nama');
					$masterData['filterKab'] = true;
				case 'pimcab':
					$join_r_bio->addselect('m_geo_kab_kpu.geo_kab_id','m_geo_kab_kpu.geo_kab_nama');
				case 'pimda':
					$join_r_bio->addselect('m_geo_prov_kpu.geo_prov_id','m_geo_prov_kpu.geo_prov_nama');
				case 'pimnas':
				break;
			}
			
			if($type == 'pimda') {
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');	
			} else if($type == 'pimcab') {
				$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');	
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id');
			} else if($type == 'pimcam') {
				$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_'.$type.'.geo_kec_id');
				$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id');	
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id');
			} else if($type == 'pimran') {
				$join_r_bio->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','r_bio_'.$type.'.geo_deskel_id');
				$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id');
				$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id');
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id');
			} else if($type == 'par') {
				$join_r_bio->join('m_geo_rw','m_geo_rw.geo_rw_id','=','r_bio_'.$type.'.geo_rw_id');
				$join_r_bio->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id');
				$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id');
				$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id');
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id');
			} else if($type == 'kpa') {
				$join_r_bio->join('m_geo_rt','m_geo_rt.geo_rt_id','=','r_bio_'.$type.'.geo_rt_id');
				$join_r_bio->join('m_geo_rw','m_geo_rw.geo_rw_id','=','m_geo_rt.geo_rw_id');
				$join_r_bio->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id');
				$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id');
				$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id');
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id');
			}

			if($prov) {
				$join_r_bio->where('r_bio_'.$type.'.geo_prov_id',$prov);
			}
			if($kab) {
				$join_r_bio->where('r_bio_'.$type.'.geo_kab_id',$kab);
			}
			if($kec) {
				$join_r_bio->where('r_bio_'.$type.'.geo_kec_id',$kec);
			}
			if($kel) {
				$join_r_bio->where('r_bio_'.$type.'.geo_deskel_id',$kel);
			}
			if($rw) {
				$join_r_bio->where('r_bio_'.$type.'.geo_rw_id',$rw);
			}
			if($rt) {
				$join_r_bio->where('r_bio_'.$type.'.geo_rt_id',$rt);
			}
			
			if($search) {
				if($type == 'kpa') {
					$join_r_bio->where('m_geo_rt.geo_rt_nama','like',"%".$search."%");
					$join_r_bio->orwhere('m_geo_rw.geo_rw_nama','like',"%".$search."%");
					$join_r_bio->orwhere('m_geo_deskel_kpu.geo_deskel_nama','like',"%".$search."%");
					$join_r_bio->orwhere('m_geo_kec_kpu.geo_kec_nama','like',"%".$search."%");
					$join_r_bio->orwhere('m_geo_kab_kpu.geo_kab_nama','like',"%".$search."%");
					if(!$prov) {
						$join_r_bio->orwhere('m_geo_prov_kpu.geo_prov_nama','like',"%".$search."%");
					}
				} else if($type == 'par'){
					$join_r_bio->where('m_geo_rw.geo_rw_nama','like',"%".$search."%");
					$join_r_bio->orwhere('m_geo_deskel_kpu.geo_deskel_nama','like',"%".$search."%");
					$join_r_bio->orwhere('m_geo_kec_kpu.geo_kec_nama','like',"%".$search."%");
					$join_r_bio->orwhere('m_geo_kab_kpu.geo_kab_nama','like',"%".$search."%");
					if(!$prov) {
						$join_r_bio->orwhere('m_geo_prov_kpu.geo_prov_nama','like',"%".$search."%");
					}
				} else if($type == 'pimran'){
					$join_r_bio->where('m_geo_deskel_kpu.geo_deskel_nama','like',"%".$search."%");
					$join_r_bio->orwhere('m_geo_kec_kpu.geo_kec_nama','like',"%".$search."%");
					$join_r_bio->orwhere('m_geo_kab_kpu.geo_kab_nama','like',"%".$search."%");
					if(!$prov) {
						$join_r_bio->orwhere('m_geo_prov_kpu.geo_prov_nama','like',"%".$search."%");
					}
				} else if($type == 'pimcam'){
					$join_r_bio->where('m_geo_kec_kpu.geo_kec_nama','like',"%".$search."%");
					$join_r_bio->orwhere('m_geo_kab_kpu.geo_kab_nama','like',"%".$search."%");
					if(!$prov) {
						$join_r_bio->orwhere('m_geo_prov_kpu.geo_prov_nama','like',"%".$search."%");
					}
				} else if($type == 'pimcab'){
					$join_r_bio->where('m_geo_kab_kpu.geo_kab_nama','like',"%".$search."%");
					if(!$prov) {
						$join_r_bio->orwhere('m_geo_prov_kpu.geo_prov_nama','like',"%".$search."%");
					}
				} else if($type == 'pimda'){
					$join_r_bio->where('m_geo_prov_kpu.geo_prov_nama','like',"%".$search."%");
				}
			}
			
			if($type == 'kpa' || $type == 'par') {
				$join_r_bio->groupBy('m_geo_'.$groupBy.'.geo_'.$groupBy.'_id');
				$join_r_bio->whereNotNull('m_geo_'.$groupBy.'.geo_'.$groupBy.'_id');
			} else {
				$join_r_bio->groupBy('m_geo_'.$groupBy.'_kpu.geo_'.$groupBy.'_id');
				$join_r_bio->whereNotNull('m_geo_'.$groupBy.'_kpu.geo_'.$groupBy.'_id');
			}
		}
		
		if($table == 'dprri' || $table == 'dprdi' || $table == 'dprdii') {
			$data=$join_r_bio->paginate(10); 
		} else {			
			$data=$join_r_bio->simplePaginate(10); 
		}

		$data->setPath(route('getGrafikTabel',[$table,$prov]));			
		

		$datas = DB::table('r_bio_pimda')
				->groupBy('geo_prov_id')
				->paginate(10);

		$masterProvinsi = DB::table('m_geo_prov_kpu')
			->select('geo_prov_nama','geo_prov_id');
		$masterKabupaten = DB::table('m_geo_kab_kpu')
			->select('geo_kab_nama','geo_kab_id');
		if($prov) {
//			$masterProvinsi->where('geo_prov_id',$prov);
			$masterKabupaten->where('geo_prov_id',$prov);
		}
		$masterProvinsi = $masterProvinsi->get();
		$masterKabupaten = $masterKabupaten->get();
		
		if($kab) {
			$masterData['masterKecamatan'] = DB::table('m_geo_kec_kpu')
				->select('geo_kec_nama','geo_kec_id')
					->where('geo_kab_id','=',$kab)
						->get();
		}
		if($kec) {
			$masterData['masterKelurahan'] = DB::table('m_geo_deskel_kpu')
				->select('geo_deskel_nama','geo_deskel_id')
					->where('geo_kec_id','=',$kec)
						->get();
		}
		if($kel) {
			$masterData['masterRW'] = DB::table('m_geo_rw')
				->select('geo_rw_nama','geo_rw_id')
					->where('geo_deskel_id','=',$kel)
						->get();				
		}
		if($rw) {
			$masterData['masterRW'] = DB::table('m_geo_rt')
				->select('geo_rt_nama','geo_rt_id')
					->where('geo_rw_id','=',$rw)
						->get();
		}
						
		(@$_GET['page'])?$page=$_GET['page']:$page=1;

		$masterData['data'] = $data;
		$masterData['type'] = $type;
		$masterData['page'] = (($page-1)*10)+1;
		$masterData['prov'] = $prov;
		$masterData['selected'] = [$prov,$kab,$kec,$kel,$rw,$rt];
		$masterData['table'] = $table;
		$masterData['masterProvinsi'] = $masterProvinsi;
		$masterData['masterKabupaten'] = $masterKabupaten;
		
		if($types != 'data') {			
			return view('main.dashboard.grafik-table',$masterData)->withPosts($data);
		} else {
			return view('main.dashboard.include.data-table',$masterData)->withPosts($data);
		}
	}
}