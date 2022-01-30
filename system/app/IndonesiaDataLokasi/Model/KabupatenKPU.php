<?php namespace App\IndonesiaDataLokasi\Model;

use Illuminate\Database\Eloquent\Model;

class KabupatenKPU extends Model {

	//
	protected $table="m_geo_kab_kpu";
	protected $primaryKey = 'geo_kab_id';

	public function provinsi()
	{
		 return $this->belongsTo('Provinsi','geo_prov_id','geo_prov_id');
	}
}
