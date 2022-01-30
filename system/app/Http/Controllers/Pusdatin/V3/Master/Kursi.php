<?php namespace App\Http\Controllers\Pusdatin\V3\Master;

use Illuminate\http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Redirect;
use App\Pusdatin\V3\Model\Kursi as KursiModel;
use App\Pusdatin\V3\Model\RefJenisKursi ;
use App\Pusdatin\V3\Model\Dapil;
use App\Pusdatin\V3\Model\WilKpu;
use App\IndonesiaDataLokasi\Model\Provinsi;
use App\IndonesiaDataLokasi\Model\Kabupaten;
use App\Lib\DataTableMaker;

use Illuminate\Database\loquent\MassAssignmentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Kursi extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $model;
	protected $provinsi;
	protected $kabupaten;
	protected $dapil;
	protected $jkursi;
	protected $wilKpu;
	protected $ahm;

	public function __construct(KursiModel $kursi,Provinsi $prov,kabupaten $kab,RefJenisKursi $jkursi,Dapil $dapil,Dapil $wilKpu,DataTableMaker $ahm)
	{
		$this->model=$kursi;
		$this->provinsi=$prov;
		$this->kabupaten = $kab;
		$this->dapil = $dapil;
		$this->jkursi = $jkursi;
		$this->wilKpu = $wilKpu;
		$this->ahm = $ahm;
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
		//$this->dapil->dapil$data

	
		$data=$this->getInput($request);
		var_dump($data);
		/*try{ //check dapil adakah? jika tidak insert data baru //data diambil dari input berupa json
			
			$this->dapil = Dapil::findOrFail($data['dapil'])->first();
			$this->dapil->fill(json_decode($data['dapil_object'],true))
			->save();
		}catch(ModelNotFoundException $ex) {
			echo '<br>model not found';
			$this->dapil->fill(json_decode($data['dapil_object'],true))
			->save();
		}*/
		if($this->model->dapil_id==null)
			 abort(404,'Page not found');
	
		
		$this->model->save();
	//	}
		
		
		if(!$request->ajax()){
            return redirect('master/kursi');
        }else echo 'success';
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request,$prov=null,$kab=null)
	{
		//
		$data=[];
		$data['data'] = $this->model->with(['jenisKursi','dapil','wilayahKpu','wilayahKpu.provinsi','wilayahKpu.kabupaten'])->get();

		//echo '<pre>' . var_export($data->toArray()[0], true) . '</pre>'; 
		$data['dataUsers'] = $this->getData('cl_admin');
		$data['provinsi'] = $this->provinsi->get();
		$data['jenisKursi'] = $this->jkursi->get();
		$data['dapil'] = $this->dapil->get();
		$data['kabupaten'] = $this->kabupaten->where('geo_prov_id',$prov)->get();
		$data['breadcrumb']=['master','KURSI'];
		$data['selected'] = [$prov,$kab,null,null,null];
		return view('main.master.kursi',$data);
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
	public function update(Request $request,$id)
	{
		$this->model=KursiModel::findOrFail($id) or redirect('master/kursi/'.$data['provinsi'].'/'.$data['kabupaten']);
		$data=$this->getInput($request);
		if($this->dapil_id==null)
			 abort(404,'Page not found');
		$this->model->save();
		return redirect('master/kursi/'.$data['provinsi'].'/'.$data['kabupaten']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request,$id)
	{
		$this->model=KursiModel::findOrFail($id) or redirect()->back();
		$data=$this->getInput($request);
		$this->model->delete();
		return redirect()->back();
	}
	public function getInput(Request $request)
	{	$data=$request->all();

		$this->model->dapil_id = $request->input('dapil');
		$this->model->geo_kab_id = $request->input('kabupaten');

		$this->model->geo_prov_id = $request->input('provinsi');
		$this->model->jenis_kursi_id = $request->input('jenis_kursi');
		$this->model->tingkat = $request->input('jenis_kursi');
		$this->model->jumlah_kursi = $request->input('jumlah_kursi');
		$this->model->wilayah_id = @$request->input('kabupaten')?:$geo_prov_id = $request->input('provinsi');
	
		return $data;
	}
	public function getDapil($tingkat=1,$wilayah_type=null,$wil_id=null)
	{
    
		/*$data=$this->curl('http://dapil.kpu.go.id/api.php?cmd=browse&tingkat_dapil='.$tingkat
				.($wilayah_type?"&$wilayah_type=".$wil_id:""));*/
		$q = Dapil::select('*')->where('tingkat_dapil','=',$tingkat);

		if($wilayah_type)
			$q->where($wilayah_type,'=',$wil_id);
		$data = $q->get();
		echo json_encode($data);
		//echo $tingkat;

    /*ini_set("allow_url_fopen", 1);
	$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
		$json = file_get_contents('http://dapil.kpu.go.id/api.php?cmd=browse&tingkat_dapil='.$tingkat
			.($wilayah_type?"&$wilayah_type=".$wil_id:""),false,$context);
		var_dump($json);
		echo $json;*/
	}

	public function getKpuProv()
	{
		$data = WilKpu::select('*')->where('tingkat','=','1')->get();
		echo json_encode($data);
		//echo $this->curl('http://dapil.kpu.go.id/api.php?cmd=browse_wilayah');
	}
	public function getKpuKab($pro_id=1)
	{
		$data = WilKpu::select('*')->where('parent','=',$pro_id)->where('tingkat','=','2')->get();
		echo json_encode($data);
		//echo $this->curl('http://dapil.kpu.go.id/api.php?cmd=browse_wilayah&pro_id='.$pro_id);
	}
	public function getDataKursi($dapil_id=null)
	{
		
		$q= $this->model->with(['jenisKursi','dapil','wilayahKpu','wilayahKpu.provinsi','wilayahKpu.kabupaten']);
			if($dapil_id)
			$q->where('dapil_id','=',$dapil_id);
		$data =	$q->get();

		echo json_encode(["data"=>$data]);
	}
	public function getDataKursiByJenisKursi($tingkat=1)
	{
		
		$data= $this->model->with(['jenisKursi','dapil','wilayahKpu','wilayahKpu.provinsi','wilayahKpu.kabupaten'])
			/*->whereHas('dapil', function ($q) use( $tingkat)
                {
                   $q->where('jenis_kursi_id', $tingkat);
                })*/
			->where('jenis_kursi_id', $tingkat)
			->get();

		echo json_encode(["data"=>$data]);
	}
	public function curl($url)
	{

		//$ch = curl_init();
		/*
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		curl_close($ch);*/
		$result=file_get_contents($url);
		return $result;
	}
}
