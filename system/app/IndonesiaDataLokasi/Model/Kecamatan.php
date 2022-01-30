<?php namespace App\IndonesiaDataLokasi\Model;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model {

	//
	protected $table="m_geo_kec";
	protected $primaryKey = 'geo_kec_id';

	public function kabupaten()
	{
		 return $this->belongsTo('Kabupaten','geo_kab_id','geo_kab_id');
	}
}
