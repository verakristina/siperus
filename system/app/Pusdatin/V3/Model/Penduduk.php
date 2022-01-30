<?php namespace App\Pusdatin\V3\Model;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model {

	//
	protected $table="m_penduduk";
	protected $primaryKey = 'penduduk_id';
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
	public function kecamatan()
	{
		 return $this->belongsTo('App\IndonesiaDataLokasi\Model\Kecamatan','geo_kec_id','geo_kec_id');
	}
	
	public function provinsiKPU()
	{
		 return $this->belongsTo('App\IndonesiaDataLokasi\Model\ProvinsiKPU','geo_prov_id','geo_prov_id');
	}
	public function kabupatenKPU()
	{
		 return $this->belongsTo('App\IndonesiaDataLokasi\Model\KabupatenKPU','geo_kab_id','geo_kab_id');
	}
	public function kecamatanKPU()
	{
		 return $this->belongsTo('App\IndonesiaDataLokasi\Model\KecamatanKPU','geo_kec_id','geo_kec_id');
	}

}
