<?php namespace App\Http\Controllers;

use DB;
use Input;
use Redirect;
use Illuminate\Http\Request;
use App\IndonesiaDataLokasi\Model\Provinsi;
use App\IndonesiaDataLokasi\Model\Kabupaten;
use App\Pusdatin\V3\Model\Biopimcab ;

use Maatwebsite\Excel\Facades\Excel;
/**
*
*/
class InputController extends Controller
{
	private $prov;
	public function __construct(Provinsi $prov,Kabupaten $kab)
	{
		$this->prov=$prov;
		$this->kab=$kab;
	}

	/*............Generik.............*/
	public function viewInput($type,$prov=null,$kab=null,$kec=null,$deskel=null,$rw=null)
	{
		$showIndex=False;
		if($type != 'dprri' && $type != 'dprdi' && $type != 'dprdii'){
			$join_r_bio = DB::table('m_bio')
				->select(
					'*',
					'm_bio.bio_id as bio_id',
					'm_bio.bio_nama_depan as nama',
					'm_bio.bio_telephone as no_telp',
					'm_bio.bio_jenis_kelamin as gender',
					'm_bio.bio_email as email',
					'm_bio_sk.bio_sk_no as no_sk',
					'm_bio_kta.bio_kta_no as no_kta',
					'r_bio_'.$type.'.bio_'.$type.'_id as r_bio_id',
					'r_bio_'.$type.'.bio_'.$type.'_tgl as turun_sk'
				);
		} else {
			$join_r_bio = DB::table('m_bio')
				->select(
					'*',
					'm_bio.bio_id as bio_id',
					'm_bio.bio_nama_depan as nama',
					'm_bio.bio_telephone as no_telp',
					'm_bio.bio_jenis_kelamin as gender',
					'm_bio.bio_email as email',
					'm_bio_sk.bio_sk_no as no_sk',
					'm_bio_sk.bio_sk_tgl as tgl_sk',
					'm_bio_kta.bio_kta_no as no_kta',
					'r_bio_'.$type.'.bio_'.$type.'_id as r_bio_id',
					'r_bio_'.$type.'.bio_id as idBio'
				);

				$dataDapil = DB::table('m_dapil')
						->where('pro_id','=',session('idProvinsi2'));
				if ($type == 'dprri') {
					$dataDapil->where('tingkat_dapil','=','1');
				} elseif ($type == 'dprdi'){
					$dataDapil->where('tingkat_dapil','=','2');
				} elseif ($type == 'dprdii') {
					$dataDapil->where('tingkat_dapil','=','3');
				}
				$dataDapil = $dataDapil->get();

		}
		switch($type){
			case 'kpa':
			case 'par':
			case 'pimcam':
			case 'pimcab':
			case 'pimda':
			case 'pimnas':
			   $join_r_bio->addselect(
			   	'r_bio_'.$type.'.bio_'.$type.'_sk as no_sk2',
			   	'r_bio_'.$type.'.bio_'.$type.'_tgl as turun_sk',
			   	'm_struk_'.$type.'.struk_'.$type.'_nama as nama_jabatan',
				'm_struk_'.$type.'.struk_'.$type.'_id as jabatan_id');
			 /* Fatchur */
			break;
			case 'dpri':
			break;
			case 'dprdi':
				$join_r_bio->addselect(
					'r_bio_'.$type.'.geo_prov_id as prov',
					'm_geo_prov_kpu.geo_prov_nama as prov_nama'
				);
			break;
			case 'dprdii':
				$join_r_bio->addselect(
					'r_bio_'.$type.'.geo_prov_id as prov',
					'm_geo_prov_kpu.geo_prov_nama as prov_nama',
					'r_bio_'.$type.'.geo_kab_id as kab',
					'geo_kab_nama as kab_nama'
				);
			break;
			 /* Fatchur */
		}
		$join_r_bio->join('r_bio_'.$type,'r_bio_'.$type.'.bio_id','=','m_bio.bio_id');
		$join_r_bio->leftJoin('m_bio_sk','m_bio_sk.bio_id','=','m_bio.bio_id');
		$join_r_bio->leftJoin('m_bio_kta','m_bio_kta.bio_id','=','m_bio.bio_id');

		switch($type){
			case 'kpa':
			case 'par':
			case 'pimcam':
			case 'pimcab':
			case 'pimda':
			case 'pimnas':
				$join_r_bio ->leftjoin('m_struk_'.$type,'m_struk_'.$type.'.struk_'.$type.'_id','=','r_bio_'.$type.'.struk_'.$type.'_id');
		}

		switch($type){

			case 'kpa':
				$join_r_bio->leftjoin('m_geo_rw','m_geo_rw.geo_rw_id','=','r_bio_'.$type.'.geo_rw_id');
			case 'par':
				$join_r_bio->leftjoin('m_geo_deskel','m_geo_deskel.geo_deskel_id','=','r_bio_'.$type.'.geo_deskel_id');
			case 'pimcam':
				$join_r_bio->leftjoin('m_geo_kec','m_geo_kec.geo_kec_id','=','r_bio_'.$type.'.geo_kec_id');
			case 'pimcab':
			case 'dprdii':
				/* $join_r_bio->leftjoin('m_geo_kab','m_geo_kab.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id'); */
				$join_r_bio->leftjoin('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
			case 'pimda':
			case 'dprdi':
				/* $join_r_bio->leftjoin('m_geo_prov','m_geo_prov.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id'); */
				$join_r_bio->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
			break;
			case 'dprri':
				$join_r_bio->leftjoin('m_dapil as dpl','dpl.dapil_id','=','r_bio_'.$type.'.dapil_id');
			case 'pimnas':// what?
		}

		switch ($type) {
			case 'dprri':
			case 'dprdi':
			case 'dprdii':
				$join_r_bio->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_'.$type.'.dapil_id');
			break;
		}

		switch($type){

			case 'kpa':
				if($rw)
					$join_r_bio->where('r_bio_'.$type.'.geo_rw_id','=',$rw);
				else {
					$join_r_bio->where('m_struk_'.$type.'.struk_'.$type.'_nama','=',"Ketua");
					$showIndex=true;
				}
			case 'par':
				if($deskel)
					$join_r_bio->where('r_bio_'.$type.'.geo_deskel_id','=',$deskel);
				else{
					$join_r_bio->where('m_struk_'.$type.'.struk_'.$type.'_nama','=',"Ketua");
					$showIndex=true;
				}
			case 'pimcam':
				if($kec)
					$join_r_bio->where('r_bio_'.$type.'.geo_kec_id','=',$kec);
				else{
					$join_r_bio->addselect(
						   	'm_geo_kec.geo_kec_nama','m_geo_kec.geo_kec_id');
					$join_r_bio->where('m_struk_'.$type.'.struk_'.$type.'_nama','=',"Ketua");
					$showIndex=true;
				}
			case 'pimcab':
				if(!$kab)
					{
						$join_r_bio->addselect(
						   	'm_geo_kab.geo_kab_nama','m_geo_kab.geo_kab_id');
						$join_r_bio->where('m_struk_'.$type.'.struk_'.$type.'_nama','=',"Ketua");
						$showIndex=true;
					}
			case 'pimda':
				if(!$prov)
					{	$join_r_bio->addselect(
						   	'm_geo_prov_kpu.geo_prov_nama','m_geo_prov_kpu.geo_prov_id');
						$join_r_bio->where('m_struk_'.$type.'.struk_'.$type.'_nama','=',"Ketua");
						$showIndex=true;
					}
			case 'dprdi':
			 	if($prov)
					$join_r_bio->where('r_bio_'.$type.'.geo_prov_id','=',$prov);
				if(session('idRole') == 3){
					$join_r_bio->where('r_bio_'.$type.'.geo_prov_id','=',session('idProvinsi2'));
				}
			break;
			case 'dprdii':
				if($kab)
					$join_r_bio->where('r_bio_'.$type.'.geo_kab_id','=',$kab);
				if(session('idRole') == 3){
					$join_r_bio->where('r_bio_'.$type.'.geo_prov_id','=',session('idProvinsi2'));
				}
			break;

			case 'pimnas':
				if(!$prov)
					$showIndex=true;

			break;
			case 'dprri':
				if(session('idRole') == 3){
					$join_r_bio->where('m_dapil.pro_id','=',session('idProvinsi2'));
				}
			break;
		}
		$data=$join_r_bio->paginate(10);
		//echo '<pre>' . var_export($data, true) . '</pre>';
		if($type == 'dprri' || $type == 'dprdi' || $type == 'dprdii'){
			$provinsi = DB::table('m_geo_prov_kpu')
				->select('geo_prov_nama','geo_prov_id')
					->get();
			$tbDaerah = '_kpu';
		} else {
			$provinsi = DB::table('m_geo_prov')
				->select('geo_prov_nama','geo_prov_id')
					->get();
			$tbDaerah = '';
		}

		/*arif*/
		$provnya = session()->get('idProvinsi');
		$provsession = DB::table('m_geo_prov')
			->where('geo_prov_id', $provnya)
			->get();
		/*arif*/

		$breadcrumb=[];
		switch($type){
			case 'kpa':
			case 'par':
			case 'pimran':
			case 'pimcam':
			case 'pimcab':
			case 'pimda':
			case 'pimnas':
				$breadcrumb[]='Data Pengurus';
				$breadcrumb[]=strtoupper($type);
			break;
			case 'dprri':
			case 'dprdi':
			case 'dprdii':
				$breadcrumb[]='Data Anggota';
				$breadcrumb[]='Anggota Legislatif';
				$breadcrumb[]=strtoupper($type);
				$kabupaten = DB::table('m_geo_kab_kpu')->get();
		}

		$masterData= [
			'dataUsers' => $this->getData('cl_admin'),
			'data' => $data,
			'type' => $type,
			'provinsi' => $provinsi,
			'provsession' => $provsession,
			'selected' =>[$prov,$kab,$kec,$deskel,$rw],
			'breadcrumb' => $breadcrumb,
			'dataDapil' => @$dataDapil,
			'kabupaten' => $kabupaten,
			"sk_baru" => "."
		];

		if($kab)
			$masterData['kabupaten'] = DB::table('m_geo_kab'.$tbDaerah)
				->select('geo_kab_nama','geo_kab_id')
					->where('geo_prov_id','=',$prov)
						->get();
		if($kec)
			$masterData['kecamatan'] = DB::table('m_geo_kec'.$tbDaerah)
				->select('geo_kec_nama','geo_kec_id')
					->where('geo_kab_id','=',$kab)
						->get();
		if($deskel)
			$masterData['kelurahan'] = DB::table('m_geo_deskel'.$tbDaerah)
				->select('geo_deskel_nama','geo_deskel_id')
					->where('geo_kec_id','=',$kec)
						->get();
		if($rw)
			$masterData['rukunwarga'] = DB::table('m_geo_rw')
				->select('geo_rw_nama','geo_rw_id')
					->where('geo_deskel_id','=',$deskel)
						->get();

		//echo '<pre>' . var_export($masterData, true) . '</pre>';
		if($showIndex){
			$masterData['test']=[];
			foreach($provinsi as $row){
				$masterData['kabn'][]=DB::table('r_bio_pimcab')
					->select(DB::raw('geo_kab_nama,count(bio_pimcab_id) as jml_pimcab'))
						->leftJoin('m_geo_kab','m_geo_kab.geo_kab_id','=','r_bio_pimcab.geo_kab_id')
							->groupBy('r_bio_pimcab.geo_kab_id')
								->where('r_bio_pimcab.geo_prov_id','=',$row->geo_prov_id)
									->get();

			}
			$masterData['test']=DB::table('r_bio_pimcab')
				->select(DB::raw('COALESCE(count(*),0) as jml'))
					->rightJoin('m_geo_prov','m_geo_prov.geo_prov_id','=','r_bio_pimcab.geo_prov_id')
						->groupBy('m_geo_prov.geo_prov_id')
							//->where('m_geo_prov.geo_prov_id','=',$row->geo_prov_id)
							->get();
				$masterData['countstruktot']=DB::table('m_struk_pimcab')
					->select(DB::raw('count(*) as jml'))
						->groupBy('geo_prov_id')
							//->where('geo_prov_id','=',$row->geo_prov_id)
							->get();

				$masterData['countkab']=DB::table('m_geo_kab')
					->select(DB::raw('count(*) as jml'))
						->groupBy('geo_prov_id')
							//->where('geo_prov_id','=',$row->geo_prov_id)
							->get();
				$masterData['countstrukav']=DB::table('m_struk_pimcab')
					->select(DB::raw('count(m_struk_pimcab.struk_pimcab_id) as jml'))
						->rightJoin('m_geo_prov',function($join){
							$join->on('m_geo_prov.geo_prov_id','=','m_struk_pimcab.geo_prov_id');
							$join->whereNull('dijabat');
						})->groupBy('m_geo_prov.geo_prov_id')
							->get();
			//echo '<pre>' . var_export($data, true) . '</pre>';

			if($type == 'pimnas' || $typ="par" || $typ="kpa")
				return view('main.input.'.$type,$masterData);
			else if($type == 'dprdi' || $type == 'dprdii')
				return view('main.anggota.legislatif.'.$type,$masterData);
			else
				return view('main.input.index_'.$type,$masterData);
		}
		else //echo '<pre>' . var_export($data, true) . '</pre>';
			if($type == 'dprri' || $type == 'dprdi' || $type == 'dprdii')
				return view('main.anggota.legislatif.'.$type,$masterData);
			else
				return view('main.input.'.$type,$masterData);
	}

	public function getBioGender($type='l')
	{
		$query=DB::table('m_bio')
				->select(DB::raw('count(m_bio.bio_jenis_kelamin) as jml'))
				->join('r_bio_pimcab',function($join){
					$join->on('r_bio_pimcab.bio_id','=','m_bio.bio_id');
				});
		switch($type){
			case 'l':
				$query->rightJoin('m_geo_prov',function($join){
					$join->on('m_geo_prov.geo_prov_id','=','r_bio_pimcab.geo_prov_id');
					$join->where('m_bio.bio_jenis_kelamin','=','1');
				});
				break;
			case 'p':
				$query->rightJoin('m_geo_prov',function($join){
					$join->on('m_geo_prov.geo_prov_id','=','r_bio_pimcab.geo_prov_id');
					$join->where('m_bio.bio_jenis_kelamin','=','0');
				});
				break;
			case 'a':
				$query->rightJoin('m_geo_prov',function($join){
					$join->on('m_geo_prov.geo_prov_id','=','r_bio_pimcab.geo_prov_id');
					$join->whereNull('m_bio.bio_jenis_kelamin');
				});
				break;
		}
		$data=$query->groupBy('m_geo_prov.geo_prov_id')
			->get();
		$data=array_map(
			function($val){
				return $val->jml;
		},$data);
		echo json_encode($data);
	}

	public function getBioMenjabatByProv($type='')
	{
		$data=DB::table('r_bio_'.$type)
				->select(DB::raw('count(r_bio_'.$type.'.bio_'.$type.'_id) as jml'))
				->rightJoin('m_geo_prov','m_geo_prov.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id')
				->groupBy('m_geo_prov.geo_prov_id')
				->get();
		$data=array_map(
			function($val){
				return $val->jml;
		},$data);
		echo json_encode($data);
	}

	public function getBioMenjabatBySK($type='')
	{
		$data=DB::select('select count(bio_'.$type.'_sk) as jml from (
			select bio_'.$type.'_sk,'.$type.'.geo_prov_id from r_bio_'.$type.' '.$type.'
			group by '.$type.'.bio_'.$type.'_sk ) as tb
			right join m_geo_prov prov on prov.geo_prov_id = tb.geo_prov_id
			group by  prov.geo_prov_id ');
		$data=array_map(
			function($val){
				return $val->jml;
		},$data);
		echo json_encode($data);
	}

	public function getBioMenjabatByKta($type='')
	{
		$data=DB::select('select count(bio_'.$type.'_kta) as jml from (
			select bio_'.$type.'_kta,'.$type.'.geo_prov_id from r_bio_'.$type.' '.$type.'
			group by '.$type.'.bio_'.$type.'_kta ) as tb
			right join m_geo_prov prov on prov.geo_prov_id = tb.geo_prov_id
			group by  prov.geo_prov_id ');
		$data=array_map(
			function($val){
				return $val->jml;
		},$data);
		echo json_encode($data);
	}

	public function testExcel($id,$type,$prov=null,$kab=null,$kec=null,$deskel=null,$rw=null)
	{
		$data = DB::table('r_bio_'.$type)
			->join('m_bio','m_bio.bio_id','=','r_bio_'.$type.'')
			->get();

		Excel::load('asset/doc-tpl/penguruskec.xls', function($reader) {
			$reader->sheet('KODE_KecamatanContoh1',function($sheet)
		    {	$sheet->setCellValue('B1', 'some value');
		    	$sheet->setCellValue('B2', 'some value');
		    	$sheet->setCellValue('B3', 'some value');
		        $sheet->appendRow([
		             'akllloaha', 'asdadadsdadsada',
		         ]);
		    });

		})->export('xls');
	}

	public function tambah(Request $request,$type,$value='')
	{
		$data=$this->getInput($request,$type);
		$url=join(array_reverse($data),"/");

		if(null !== $request->input('with_ktp')){
			$with_ktp = $request->input('with_ktp');
			$data['bio_id'] = $request->input('bio');
		}else{
			$with_ktp = 0;
			$data['bio_nama'] = $request->input('nama_anggota');
			//$data['dapil'] = $request->input('dapil');
			$data['bio_id'] = 0;
		}

		$noSK = $request->input('no_sk')?:null;
		$noKTA = $request->input('no_kta')?:null;

		$noHP = $request->input('no_hp')?:null;
		$email = $request->input('email')?:null;

		$tglSK = date('Y-m-d',strtotime($request->input('date')))?:null;

		switch($type){
			case 'kpa':
			case 'par':
			case 'pimran':
			case 'pimcam':
			case 'pimcab':
			case 'pimda':
			case 'pimnas':
				$data['struk_'.$type.'_id'] = $request->input('jabatan')?:null;
				$data['bio_'.$type.'_sk'] = $noSK;
				$data['bio_'.$type.'_tgl'] = $tglSK;
				$data['bio_'.$type.'_kta'] = $noKTA;
				$redirect = 'data_pengurus';
			break;
			case 'dprri':
			case 'dprdi':
			case 'dprdii':
				$redirect = 'data_anggota';
			break;
		}

		$target_id = DB::table('r_bio_'.$type)->insertGetId($data);

		switch($type){
			case 'kpa':
			case 'par':
			case 'pimran':
			case 'pimcam':
			case 'pimcab':
			case 'pimda':
			case 'pimnas':
				DB::table('m_struk_'.$type)
					->where('struk_'.$type.'_id',$data['struk_'.$type.'_id'])
						->update(['dijabat' => 1, 'struk_'.$type.'_created_date' => date("Y-m-d H:i:s"), "struk_".$type."_created_by" => session('idLogin')]);


				break;
			case 'dprri':
			case 'dprdi':
			case 'dprdii':
				DB::table('m_bio')
					->where('bio_id',$data['bio_id'])
						->update(['menjabat'=>1]);
				$cek = DB::table('m_bio_sk')
					->where('bio_id',$data['bio_id'])
						->count();
				$cek2 = DB::table('m_bio_kta')
					->where('bio_id',$data['bio_id'])
						->count();

				if($cek != 0){
					DB::table('m_bio_sk')
						->where('bio_id',$data['bio_id'])
							->update([
								'bio_sk_no'=>$noSK,
								'bio_sk_tgl' => $tglSK
							]);
				} else {
					DB::table('m_bio_sk')
						->insertGetId([
							'bio_id' => $data['bio_id'],
							'bio_sk_no' => $noSK,
							'bio_sk_tgl' => $tglSK,
							'bio_sk_created_date' => date('Y-m-d H:i:s'),
							'bio_sk_created_by' => session('idLogin')
						]);
				}

				if ($cek2 !=0) {
					DB::table('m_bio_kta')
						->where('bio_id',$data['bio_id'])
							->update([
								'bio_kta_no'=>$noKTA
							]);
				} else {
					DB::table('m_bio_kta')
						->insertGetId([
							'bio_id' => $data['bio_id'],
							'bio_kta_no' => $noKTA,
							'bio_kta_created_date' => date('Y-m-d H:i:s'),
							'bio_kta_created_by' => session('idLogin')
						]);
				}

		}

		return redirect($redirect.'/'.$type.'/'.$url);
		//return redirect()->back();
	}
	public function edit(Request $request,$type,$target_id='')
	{
		$data=$this->getInput($request,$type);
		$url=join(array_reverse($data),"/");
		if(null !== $request->input('with_ktp')){
			$with_ktp = $request->input('with_ktp');
			$data['bio_id'] = $request->input('bio');
		}else{
			$with_ktp = 0;
			$data['bio_nama'] = $request->input('nama_anggota');
			$data['bio_id'] = 0;
		}

		$noSK = $request->input('no_sk')?:null;
		$noKTA = $request->input('no_kta')?:null;


		$noHP = $request->input('no_hp')?:null;
		$email = $request->input('email')?:null;

		DB::table('m_bio')
				->where('bio_id', $data['bio_id'])
				->update([
					'bio_handphone' => $noHP,
					'bio_email' => $email
				]);
		$dapil = $request->input('dapil')?:null;
		$prov = $request->input('prov')?:null;
		$data['bio_'.$type.'_kta'] = $noKTA;
		$tglSK = date('Y-m-d',strtotime($request->input('date')))?:null;
		switch($type){
			case 'kpa':
			case 'par':
			case 'pimran':
			case 'pimcam':
			case 'pimcab':
			case 'pimda':
			case 'pimnas':
				$data['struk_'.$type.'_id'] = $request->input('jabatan')?:null;
				$data['bio_'.$type.'_sk'] = $noSK;
				$data['bio_'.$type.'_tgl'] = $tglSK;
				$data['bio_'.$type.'_kta'] = $noKTA;
				$redirect = 'data_pengurus';
			break;
			case 'dprri':
			case 'dprdi':
			case 'dprdii':
				$redirect = 'data_anggota';
			break;
		}

		$q=DB::table('r_bio_'.$type);

		switch($type){
			case 'kpa':
			case 'par':
			case 'pimran':
			case 'pimcam':
			case 'pimcab':
			case 'pimda':
			case 'pimnas':
				$q->select('struk_'.$type.'_id as struk_id','bio_id');
				$row=$q->where('bio_'.$type.'_id',$target_id)->first();
				$struk_id=$row->struk_id;
				$bio_id=$row->bio_id;
				DB::table('m_bio')
						->where('bio_id', $bio_id)
						->update([
							'bio_handphone' => $noHP,
							'bio_email' => $email
						]);
				DB::table('m_struk_'.$type)
					->where('struk_'.$type.'_id',$struk_id)
						->update(['dijabat'=>null]);
				DB::table('m_struk_'.$type)
					->where('struk_'.$type.'_id',$data['struk_'.$type.'_id'])
						->update(['dijabat'=>1, 'struk_'.$type.'_created_date' => date("Y-m-d H:i:s"), "struk_".$type."_created_by" => session('idLogin')]);
			break;
			case 'dprri':
			case 'dprdi':
				DB::table('r_bio_'.$type)
					->where('bio_'.$type.'_id',$target_id)
						->update(['dapil_id'=>$dapil],
								 ['geo_prov_id'=>$prov]);
			case 'dprdii':
				$row=$q->where('bio_'.$type.'_id',$target_id)->first();
				$bio_id=$row->bio_id;
				DB::table('m_bio')
					->where('bio_id',$bio_id)
						->update(['menjabat'=>null]);
				DB::table('m_bio')
					->where('bio_id',$data['bio_id'])
						->update(['menjabat'=>1]);
				DB::table('m_bio_sk')
					->where('bio_id',$data['bio_id'])
						->update([
							'bio_sk_no'=>$noSK,
							'bio_sk_tgl' => $tglSK
						]);
				DB::table('m_bio_kta')
					->where('bio_id',$data['bio_id'])
						->update([
							'bio_kta_no'=>$noKTA
						]);
				DB::table('r_bio_'.$type)
					->where('bio_'.$type.'_id',$target_id)
						->update(['dapil_id'=>$dapil]);
			break;
		}
		$q->update($data);
		//echo '<pre>' . var_export($data, true) . '</pre>';

		//return redirect()->back();
		return redirect($redirect.'/'.$type.'/'.$url);
	}
	public function hapus(Request $request,$type,$target_id='')
	{
		if ($type == 'verifikasi') {
			DB::table('m_verifikasi')
						->where('verifikasi_id',$target_id)
						->delete();
		} else if ($type == 'user_management'){
			DB::table('m_bio')
				->where('bio_id', $target_id)
				->delete();
		} else {
		$data=$this->getInput($request,$type);
		$url=join(array_reverse($data),"/");
		$q=DB::table('r_bio_'.$type);
			echo $type;

		

		switch($type){
			case 'kpa':
			case 'par':
			case 'pimran':
			case 'pimcam':
			case 'pimcab':
			case 'pimda':
			case 'pimnas':
				$q->select('struk_'.$type.'_id as struk_id','bio_id');
				$row=$q->where('bio_'.$type.'_id',$target_id)->first();
				$struk_id=$row->struk_id;
				$bio_id=$row->bio_id;

				DB::table('m_struk_'.$type)
				->where('struk_'.$type.'_id',$struk_id)
				->update(['dijabat'=>null]);
			break;
			case 'dprri':
			case 'dprdi':
			case 'dprdii':
				$row=$q->where('bio_'.$type.'_id',$target_id)->first();
				$bio_id=$row->bio_id;

				DB::table('m_bio')
					->where('bio_id',$bio_id)
							->update(['menjabat'=>null]);
		}

		$q->delete();
		}
		if ($type == 'user_management'){
			return redirect('anggota/partai/list');
		} else {
			return redirect('data_pengurus/'.$type.'/'.$url);
		}
			/*return redirect()->back();*/
	}
	public function getInput(Request $request,$type)
	{
		$data=[];
		switch($type){
			case 'kpa':
				$data['geo_rw_id'] = $request->input('rukunwarga');
				break;
			case 'par':
			case 'pimran':
				$data['geo_deskel_id'] = $request->input('desakelurahan');
				$data['geo_kec_id'] = $request->input('kecamatan');
				$data['geo_kab_id'] = $request->input('kabupaten');
				$data['geo_prov_id'] = $request->input('provinsi');
				break;
			case 'pimcam':
				$data['geo_kec_id'] = $request->input('kecamatan');
				$data['geo_kab_id'] = $request->input('kabupaten');
				$data['geo_prov_id'] = $request->input('provinsi');
				break;
			case 'pimcab':
			case 'dprdii':
				$data['geo_kab_id'] = $request->input('kabupaten');
				$data['geo_prov_id'] = $request->input('provinsi');
				break;
			case 'pimda':
			case 'dprdi':
				$data['geo_prov_id'] = $request->input('provinsi');
				break;
			case 'pimnas':
			case 'dprri':
				break;
		}
		return $data;
	}


	/**............ajax request.................**/


	public function getStruk($type,$prov=null,$kab=null,$kec=null,$deskel=null,$rw=null,$search)
	{
		$type=strtolower($type);
		$query = DB::table("m_struk_".$type)
			->select(
				"struk_".$type."_id as val",
				"struk_".$type."_nama as text"
			)->where("struk_".$type."_nama","like","%$search%");
		switch($type){
			case 'kpa':
				$query->where("geo_rt_id","=",$rw);
				break;
			case 'par':
				$query->where("geo_rw_id","=",$deskel);
				break;
			case 'pimran':
				$query->where("geo_deskel_id","=",$deskel);
				break;
			case 'pimcam':
				$query->where("geo_kec_id","=",$kec);
				break;
			case 'pimcab':
				$query->where("geo_kab_id","=",$kab);
				break;
			case 'pimda':
				$query->where("geo_prov_id","=",$prov);
				break;
			case 'pimnas':
			break;
		}
		$query->where("dijabat","=",null);
		$query->orWhere("dijabat","=",0);
		$data =	$query->get();
		echo json_encode($data);
	}

}
