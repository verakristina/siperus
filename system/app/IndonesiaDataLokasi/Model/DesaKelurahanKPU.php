<?php namespace App\IndonesiaDataLokasi\Model;

use Illuminate\Database\Eloquent\Model;

class DesaKelurahanKPU extends Model {

	//
	protected $table="m_geo_deskel_kpu";
	protected $primaryKey = 'geo_deskel_id';

	public function kecamatan()
	{
		 return $this->belongsTo('Kecamatan','geo_kec_id','geo_kec_id');
	}

}
