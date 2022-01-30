<?php namespace App\Http\Controllers\Pusdatin\V3;

use Illuminate\http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Redirect;
use App\Pusdatin\V3\Model\Kursi as KursiModel;
use App\Pusdatin\V3\Model\RefJenisKursi ;
use App\IndonesiaDataLokasi\Model\Provinsi;
use App\IndonesiaDataLokasi\Model\Kabupaten;

class Kursi extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $model;
	protected $provinsi;
	protected $kabupaten;
	protected $jkursi;
	public function __construct(KursiModel $kursi,Provinsi $prov,kabupaten $kab,RefJenisKursi $jkursi)
	{
		$this->model=$kursi;
		$this->provinsi=$prov;
		$this->kabupaten = $kab;
		$this->jkursi = $jkursi;
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
		$data=$this->getInput($request);
		$this->model->save();
		return redirect('master/kursi/'.$data['provinsi'].'/'.$data['kabupaten']);
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
		$data['data']=$this->model->with(['provinsi','kabupaten','jenisKursi'])
			->where('geo_prov_id',$prov)
			->where('geo_kab_id',$kab)
			->get();

		//echo '<pre>' . var_export($data->toArray()[0], true) . '</pre>'; 
		$data['dataUsers'] = $this->getData('cl_admin');
		$data['provinsi'] = $this->provinsi->get();
		$data['jenisKursi'] = $this->jkursi->get();
		$data['kabupaten'] = $this->kabupaten->where('geo_prov_id',$prov)->get();
		$data['breadcrumb']=['master','KURSI'];
		$data['selected'] = [$prov,$kab,null,null,null];
		return view('main.input.kursi',$data);
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

		$this->model->geo_kab_id = $request->input('kabupaten');

		$this->model->geo_prov_id = $request->input('provinsi');
		$this->model->jenis_kursi_id = $request->input('jenis_kursi');
		$this->model->jumlah_kursi = $request->input('jumlah_kursi');
	
		return $data;
	}
}
