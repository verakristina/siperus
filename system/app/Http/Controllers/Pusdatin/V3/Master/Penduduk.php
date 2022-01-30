<?php namespace App\Http\Controllers\Pusdatin\V3\Master;

use Illuminate\http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
use Input;
use Redirect;
use App\Pusdatin\V3\Model\Penduduk as PendudukModel;

use App\IndonesiaDataLokasi\Model\ProvinsiKPU;
use App\IndonesiaDataLokasi\Model\KabupatenKPU;
use App\IndonesiaDataLokasi\Model\KecamatanKPU;

class Penduduk extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $model;
	protected $provinsi;
	protected $kabupaten;
	protected $kecamatan;
	public function __construct(PendudukModel $penduduk,ProvinsiKPU $prov,KabupatenKPU $kab,KecamatanKPU $kec)
	{
		$this->model = $penduduk;
		$this->provinsi = $prov;
		$this->kabupaten = $kab;
		$this->kecamatan = $kec;

	}
	public function index()
	{
		$all = $this->model->all();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$check=$this->check($request);
		$data=$this->getInput($request);
		if($check == 0){			
			$this->model->save();
		} else {
			$this->update($request,$data['kabupaten']);
		}
		if(isset($data['kabupaten'])) {
			return redirect('master/penduduk/'.$data['provinsi'].'/'.$data['kabupaten']);
		} else {			
			return redirect('master/penduduk/'.$data['provinsi']);
		}
	}

	public function check(Request $request)
	{	
		$kab = $request->input('kabupaten');
		$prov = $request->input('provinsi');
		
		$check = DB::table('m_penduduk')
			->where('geo_prov_id',$prov)
			->where('geo_kab_id',$kab)
				->get();
				
		return count($check);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request,$prov=null,$kab=null,$kec=null)
	{
		//
		$data=[];
		if(isset($kab)) {			
			$data['data']=$this->model->with(['provinsi','kabupaten','kecamatan'])
				->select('*','m_geo_prov_kpu.geo_prov_nama as prov_nama','m_geo_kab_kpu.geo_kab_nama as kab_nama')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_penduduk.geo_prov_id')
				->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_penduduk.geo_kab_id')
				->where('m_penduduk.geo_prov_id',$prov)
				->where('m_penduduk.geo_kab_id',$kab)
				->get();
				$data['kecamatan'] = $this->kecamatan->where('geo_kab_id',$kab)->get();
				$data['kabupaten'] = $this->kabupaten->where('geo_prov_id',$prov)->get();
				$kec=-1;
		}
		else if(isset($prov)) {
			$data['data']=$this->model->with(['provinsi','kabupaten'])
				->select('*','m_geo_prov_kpu.geo_prov_nama as prov_nama','m_geo_kab_kpu.geo_kab_nama as kab_nama')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_penduduk.geo_prov_id')
				->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_penduduk.geo_kab_id')
				->where('m_penduduk.geo_prov_id',$prov)
				->get();
				$data['kabupaten'] = $this->kabupaten->where('geo_prov_id',$prov)->get();
				$kab=-1;
		}else{
			$data['data']=$this->model->with(['provinsi','kabupaten'])
			->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_penduduk.geo_prov_id')
			->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_penduduk.geo_kab_id')
			->select(DB::raw('*,sum(penduduk_jumlah) as penduduk_jumlah, count("geo_kab_id") as jumlah_kab'),'m_geo_prov_kpu.geo_prov_nama as prov_nama','m_geo_kab_kpu.geo_kab_nama as kab_nama')
				->whereNotNull('m_penduduk.geo_prov_id')
			//->sum('penduduk_jumlah')
			->groupBy('m_penduduk.geo_prov_id')
			->get();

		}

		//echo '<pre>' . var_export($data['data'], true) . '</pre>'; 
		$data['dataUsers'] = $this->getData('cl_admin');
		$data['provinsi'] = $this->provinsi->get();
		$data['breadcrumb']=['Master','Penduduk'];
		$data['selected'] = [$prov,$kab,$kec,null,null];
		
		if($prov){
			$data['status'] = 'no-group';
		} else {
			$data['status'] = 'group';
		}
		
		return view('main.master.penduduk',$data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request,$id)
	{
		
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id,$kab,$jumlah)	
	{
		$kabupaten = @$_GET['kabupaten'];
		$penduduk_jumlah = @$_GET['penduduk_jumlah'];
		/* get data */
		try{
			$this->model=PendudukModel::where('geo_kab_id', $id)->firstOrFail();
		} catch (ModelNotFoundException $ex) {
  			redirect('master/penduduk/12');
		} 
		
		/* get input and save */
		$data=$this->getInput($request);
		
		if(@$data['provinsi']) {
			$provinsi = $data['provinsi'];
		} else {
			$provinsi = session('idProvinsi2');
		}
		
		$cek = DB::table('m_penduduk')
			->where('geo_kab_id',$kabupaten)
				->count();
		if($cek > 0){
			$prosesEdit = DB::table('m_penduduk')
				->where('penduduk_id',$id)
					->update([
						'geo_kab_id' => $kabupaten,
						'penduduk_jumlah' => str_replace('.','',$penduduk_jumlah)
					]);
					echo 's';
		} else {
			$this->model->save();
		}
		
		/* response */
		if(isset($data['kabupaten'])) {
			return redirect('master/penduduk/'.$provinsi.'/'.$data['kabupaten']);
		} else {			
			return redirect('master/penduduk/'.$provinsi);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request,$id)
	{
		$this->model=PendudukModel::findOrFail($id) or redirect()->back();
		$data=$this->getInput($request);
		$this->model->delete();
		return redirect()->back();
	}
	public function getInput(Request $request)
	{	
		$data=$request->all();

		$this->model->geo_kab_id = $request->input('kabupaten');

		$this->model->geo_prov_id = $request->input('provinsi');
		$jumlah = $request->input('penduduk_jumlah');
	
		$this->model->penduduk_jumlah = str_replace('.','',$jumlah);
	
		return $data;
	}
}


/* 	protected $model;
	protected $provinsi;
	protected $kabupaten;
	public function __construct(PendudukModel $penduduk,Provinsi $prov,kabupaten $kab)
	{
		$this->model=$penduduk;
		$this->provinsi=$prov;
		$this->kabupaten = $kab;

	}
	public function index()
	{
		$all = $this->model->all();
	}


	public function create()
	{
		
	}


	public function store(Request $request)
	{
		$data=$this->getInput($request);
		$this->model->save();
		return redirect('master/penduduk/'.$data['provinsi'].'/'.$data['kabupaten']);
	}


	public function show(Request $request,$prov=null,$kab=null)
	{
		$data=[];
		$data['data']=$this->model->with(['provinsi','kabupaten'])
			->where('geo_prov_id',$prov)
			->where('geo_kab_id',$kab)
			->get();

		$data['dataUsers'] = $this->getData('cl_admin');
		$data['provinsi'] = $this->provinsi->get();
		$data['kabupaten'] = $this->kabupaten->where('geo_prov_id',$prov)->get();
		$data['breadcrumb']=['master','PENDUDUK'];
		$data['selected'] = [$prov,$kab,null,null,null];
		return view('main.master.penduduk',$data);
	}


	public function edit(Request $request,$id)
	{
		
		
	}

	public function update(Request $request,$id)
	{
		$this->model=PendudukModel::findOrFail($id) or redirect('master/penduduk/'.$data['provinsi'].'/'.$data['kabupaten']);
		$data=$this->getInput($request);
		$this->model->save();
		return redirect('master/penduduk/'.$data['provinsi'].'/'.$data['kabupaten']);
	}


	public function destroy(Request $request,$id)
	{
		$this->model=PendudukModel::findOrFail($id) or redirect()->back();
		$data=$this->getInput($request);
		$this->model->delete();
		return redirect()->back();
	}
	public function getInput(Request $request)
	{	$data=$request->all();

		$this->model->geo_kab_id = $request->input('kabupaten');

		$this->model->geo_prov_id = $request->input('provinsi');
		$this->model->penduduk_jumlah = $request->input('penduduk_jumlah');
	
		return $data;
	}
}
 */