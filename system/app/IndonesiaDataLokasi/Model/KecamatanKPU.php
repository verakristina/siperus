<?php namespace App\IndonesiaDataLokasi\Model;

use Illuminate\Database\Eloquent\Model;

class KecamatanKPU extends Model {

	//
	protected $table="m_geo_kec_kpu";
	protected $primaryKey = 'geo_kec_id';

	public function kabupaten()
	{
		 return $this->belongsTo('Kabupaten','geo_kab_id','geo_kab_id');
	}
}
