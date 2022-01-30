<?php namespace App\Pusdatin\V3\Model;

use Illuminate\Database\Eloquent\Model;

class RefJenisKursi extends Model {

	//
	protected $table = 'ref_jenis_kursi';
	protected $primaryKey = 'jenis_kursi_id';
	const CREATED_AT = 'create_date';
	const UPDATED_AT = 'update_date';


}
