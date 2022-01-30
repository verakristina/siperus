<?php namespace App\Pusdatin\V3\Model;

use Illuminate\Database\Eloquent\Model;

class WilKpu extends Model {

	//
	protected $table="m_wil_kpu";
	protected $primaryKey = 'wilayah_id';

	public function provinsi()
	{
		 return $this->belongsTo('App\IndonesiaDataLokasi\Model\Provinsi','kode_pro','geo_prov_id');
	}
	public function kabupaten()
	{
		 return $this->belongsTo('App\IndonesiaDataLokasi\Model\Kabupaten','kode_kab','geo_kab_id');
	}
}
