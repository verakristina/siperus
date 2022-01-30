<?php namespace App\IndonesiaDataLokasi\Model;

use Illuminate\Database\Eloquent\Model;

class DesaKelurahan extends Model {

	//
	protected $table="m_geo_deskel";
	protected $primaryKey = 'geo_deskel_id';

	public function kecamatan()
	{
		 return $this->belongsTo('Kecamatan','geo_kec_id','geo_kec_id');
	}

}
