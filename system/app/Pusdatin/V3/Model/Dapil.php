<?php namespace App\Pusdatin\V3\Model;

use Illuminate\Database\Eloquent\Model;

class Dapil extends Model {

	//
	const CREATED_AT = 'create_date';
	const UPDATED_AT = 'update_date';
	protected $table="m_dapil";
	protected $primaryKey = 'dapil_id';
	protected $fillable = ['dapil_id','dapil_kode','dapil_nama','tingkat_dapil','pro_id','kab_id','kode_dapil','nama_dapil','ppk','pps','tps','jumlah_laki','jumlah_perempuan','jumlah_pemilih'];

}
