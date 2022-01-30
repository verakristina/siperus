<?php namespace App\Pusdatin\V3\Model;

use Illuminate\Database\Eloquent\Model;

class Kursi extends Model {

	//
	//$article = \App\Models\Article::with(['user','category'])->first();
	protected $table="m_kursi";
	protected $primaryKey = 'kursi_id';
	protected $guarded = ['kursi_id'];


	const CREATED_AT = 'create_date';
	const UPDATED_AT = 'update_date';


	public function provinsi()
	{
		 return $this->belongsTo('App\IndonesiaDataLokasi\Model\Provinsi','geo_prov_id','geo_prov_id');
	}
	public function kabupaten()
	{
		 return $this->belongsTo('App\IndonesiaDataLokasi\Model\Kabupaten','geo_kab_id','geo_kab_id');
	}
	public function jenisKursi()
	{
		 return $this->belongsTo('App\Pusdatin\V3\Model\RefJenisKursi','jenis_kursi_id','jenis_kursi_id');
	}
	public function dapil()
	{
		 return $this->belongsTo('App\Pusdatin\V3\Model\Dapil','dapil_id','dapil_id');
	}

	public function wilayahKpu()
	{
		 return $this->belongsTo('App\Pusdatin\V3\Model\WilKpu','wilayah_id','wilayah_id');
	}

}
