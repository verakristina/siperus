<?php namespace App\IndonesiaDataLokasi\Model;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model {

	//
	protected $table="m_geo_kab";
	protected $primaryKey = 'geo_kab_id';

	public function provinsi()
	{
		 return $this->belongsTo('Provinsi','geo_prov_id','geo_prov_id');
	}
}
