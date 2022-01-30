<?php namespace App\Http\Controllers\Pusdatin\V3;

use Illuminate\http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Redirect;
use App\Pusdatin\V3\Model\Penduduk as PendudukModel;

use App\IndonesiaDataLokasi\Model\Provinsi;
use App\IndonesiaDataLokasi\Model\Kabupaten;

class Penduduk extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $model;
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
		return redirect('master/penduduk/'.$data['provinsi'].'/'.$data['kabupaten']);
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
		$data['data']=$this->model->with(['provinsi','kabupaten'])
			//->where('geo_prov_id',$prov)
			//->where('geo_kab_id',$kab)
			//->groupBy('geo_prov_id')
			->get();

		//echo '<pre>' . var_export($data->toArray()[0], true) . '</pre>'; 
		$data['dataUsers'] = $this->getData('cl_admin');
		$data['provinsi'] = $this->provinsi->get();
		$data['kabupaten'] = $this->kabupaten->where('geo_prov_id',$prov)->get();
		$data['breadcrumb']=['master','PENDUDUK'];
		$data['selected'] = [$prov,$kab,null,null,null];
		return view('main.input.penduduk',$data);
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
		$this->model=PendudukModel::findOrFail($id) or redirect('master/penduduk/'.$data['provinsi'].'/'.$data['kabupaten']);
		$data=$this->getInput($request);
		$this->model->save();
		return redirect('master/penduduk/'.$data['provinsi'].'/'.$data['kabupaten']);
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
	{	$data=$request->all();

		$this->model->geo_kab_id = $request->input('kabupaten');

		$this->model->geo_prov_id = $request->input('provinsi');
		$this->model->penduduk_jumlah = $request->input('penduduk_jumlah');
	
		return $data;
	}
}
