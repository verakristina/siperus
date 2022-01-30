<?php namespace App\Http\Controllers; 

use DB;
use Input;
use Redirect;

/**
* 
*/
class DashboardController extends Controller
{
	public function getDataJson($jenis) {
		if($jenis == 'provinsi') {
			$data = DB::table('m_geo_prov_kpu')
				->get();
		} else if($jenis == 'kabupaten') { 
			$data = DB::table('m_geo_kab_kpu')
				->get();
		} else if($jenis == 'kecamatan') { 
			$data = DB::table('m_geo_kec_kpu')
				->get();
		} else if($jenis == 'kelurahan') { 
			$data = DB::table('m_geo_deskel_kpu')
				->get();
		}
		
		return json_encode($data);
	}
	
	public function getAllStruktur($jenis) {
		if($jenis == 'pimda') {
			$dataKabupaten = DB::table('m_geo_prov_kpu')
				->get();
				
			foreach($dataKabupaten as $tmp){				
				$savePendaftaran1 = DB::table('m_struk_pimda')
					->insertGetId([
						'geo_prov_id' => $tmp->geo_prov_id,
						'struk_pimda_nama' => 'Ketua',
						'struk_pimda_created_date' => date('Y-m-d H:i:s'),
						'struk_pimda_created_by' => 1,
						'struk_pimda_status' => 1
					]);
				$savePendaftaran2 = DB::table('m_struk_pimda')
					->insertGetId([
						'geo_prov_id' => $tmp->geo_prov_id,
						'struk_pimda_nama' => 'Sekretaris',
						'struk_pimda_created_date' => date('Y-m-d H:i:s'),
						'struk_pimda_created_by' => 1,
						'struk_pimda_status' => 1
					]);
				$savePendaftaran3 = DB::table('m_struk_pimda')
					->insertGetId([
						'geo_prov_id' => $tmp->geo_prov_id,
						'struk_pimda_nama' => 'Bendahara',
						'struk_pimda_created_date' => date('Y-m-d H:i:s'),
						'struk_pimda_created_by' => 1,
						'struk_pimda_status' => 1
					]);
			}	
		} else if($jenis == 'pimcab'){
			$dataKabupaten = DB::table('m_geo_kab_kpu')
				->get();
				
			foreach($dataKabupaten as $tmp){				
				$savePendaftaran1 = DB::table('m_struk_pimcab')
					->insertGetId([
						'geo_prov_id' => $tmp->geo_prov_id,
						'geo_kab_id' => $tmp->geo_kab_id,
						'struk_pimcab_nama' => 'Ketua',
						'struk_pimcab_created_date' => date('Y-m-d H:i:s'),
						'struk_pimcab_created_by' => 1,
						'struk_pimcab_status' => 1
					]);
				$savePendaftaran2 = DB::table('m_struk_pimcab')
					->insertGetId([
						'geo_prov_id' => $tmp->geo_prov_id,
						'geo_kab_id' => $tmp->geo_kab_id,
						'struk_pimcab_nama' => 'Sekretaris',
						'struk_pimcab_created_date' => date('Y-m-d H:i:s'),
						'struk_pimcab_created_by' => 1,
						'struk_pimcab_status' => 1
					]);
				$savePendaftaran3 = DB::table('m_struk_pimcab')
					->insertGetId([
						'geo_prov_id' => $tmp->geo_prov_id,
						'geo_kab_id' => $tmp->geo_kab_id,
						'struk_pimcab_nama' => 'Bendahara',
						'struk_pimcab_created_date' => date('Y-m-d H:i:s'),
						'struk_pimcab_created_by' => 1,
						'struk_pimcab_status' => 1
					]);
			}	
		}
	}
	public function changeToKPU($jenis){
		if($jenis == 'penduduk'){
			$dataPendudukKPU = DB::table('m_penduduk')
				->join('m_geo_kab','m_geo_kab.geo_kab_id','=','m_penduduk.geo_kab_id')
					->whereNull('geo_kab_kpu')
						->get();
			foreach($dataPendudukKPU as $tmp){
				echo $tmp->geo_kab_nama;
				echo '   -   ';
				$cek = DB::table('m_geo_kab_kpu')
					->select('*',DB::raw('REPLACE(geo_kab_nama,"Kab. ","") as kab_name'))
					->where('kab_name','like','"'.$tmp->geo_kab_nama.'"')
						->get();
				echo '   -   ';
				echo count($cek);
				echo '<br />';
			}
		} else if($jenis == 'dprdii') {
			$dataDPRDII = DB::table('r_bio_dprdii')
				->get();
				
			foreach($dataDPRDII as $tmp){
				echo str_replace("KABUPATEN ","",$tmp->kab_nama);
				echo '   -   ';
				$cek = DB::table('m_geo_kab_kpu')
					->where('geo_kab_nama','LIKE','%'.str_replace("KABUPATEN ","",$tmp->kab_nama).'%')
						->get();
				echo '   -   ';
				echo count($cek);
				if(count($cek) == 1){
					foreach($cek as $tmpas){
						echo $tmpas->geo_prov_id;
						echo '   &   ';
						echo $tmpas->geo_kab_id;
						
						$prosesUpdate = DB::table('r_bio_dprdii')
							->where('bio_dprdii_id',$tmp->bio_dprdii_id)
								->update([
									'geo_prov_id' => $tmpas->geo_prov_id,
									'geo_kab_id' => $tmpas->geo_kab_id
								]);
					}
				}
				echo '<br />';
			}
			
			echo count($dataDPRDII);
		}
	}
	
	public function cekSK($nomer = 0){
		if($nomer == ''){ // view
			return view('cek_sk');
		} else { // Proses Cek
			$count = 0;
			$dataSKAll = [];
			$arrayJenis = ['pimnas','pimda','pimcab','pimcam','par','kpa'];
			for($z=0; $z<count($arrayJenis); $z++){
				$jenis = $arrayJenis[$z];
				
				$prosesCek = DB::table('r_bio_'.$jenis)
					->join('m_bio','m_bio.bio_id','=','r_bio_'.$jenis.'.bio_id')
					->join('ref_jk','m_bio.bio_jenis_kelamin','=','ref_jk.jk_id')
					->join('m_struk_'.$jenis,'m_struk_'.$jenis.'.struk_'.$jenis.'_id','=','r_bio_'.$jenis.'.struk_'.$jenis.'_id')
						->where('bio_'.$jenis.'_sk',base64_decode($nomer))
						->where('struk_'.$jenis.'_nama','like','Ketua%')
							->get();
							
				$count = $count+count($prosesCek);
				
				foreach($prosesCek as $tmp){
					$arrayNama = [$tmp->bio_nama_depan,$tmp->bio_nama_tengah,$tmp->bio_nama_belakang];
					$alamat = (isset($tmp->bio_alamat))?"-":$tmp->bio_alamat;
					$dataSK = 
					'<tr>
						<td>Nama</td>
						<td>:</td>
						<td>'.ucwords(strtolower(join($arrayNama,''))).'</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td>'.$tmp->jk_value.'</td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td>'.$alamat.'</td>
					</tr>
					<tr>';
					array_push($dataSKAll,$dataSK);
				}
				
			}			
			
			if($count == 0){
				echo 'kosong';
			} else {
				echo '<table class="table">';
					for($x=0; $x<count($dataSKAll); $x++){
						echo $dataSKAll[$x];
						if($x+1 != count($dataSKAll)){							
							echo '<tr><td colspan="3"><div style="border: 1px solid #b0bec5; max-height: 1px !important;"></div></td></tr>';
						}
					}				
				echo '</table>';
			}
		}
	}
	
	public function getStrukturId($jenis,$ke=0){
		$mulai = ($ke-1)*10000;
		$sampai = $ke*10000;
		
		if($jenis == 'prov') {
			$data = DB::table('m_geo_'.$jenis.'_kpu')
							->whereNull('geo_'.$jenis.'_id2')
					->get();			
		} else if($jenis == 'kab') {
			$data = DB::table('m_geo_'.$jenis.'_kpu')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
							->whereNull('geo_'.$jenis.'_id2')
						->get();
		} else if($jenis == 'kec') {
			$data = DB::table('m_geo_'.$jenis.'_kpu')
				->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
					->whereNull('geo_'.$jenis.'_id2')
						->get();
		} else if($jenis == 'deskel') {
			$data = DB::table('m_geo_'.$jenis.'_kpu')
				->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
				->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
					->whereNull('geo_'.$jenis.'_id2')
					->skip($mulai)
					->take($sampai)
						->get();
		} else if($jenis == 'rw') {
			$data = DB::table('m_geos_'.$jenis.'_kpu')
				->whereNull('geo_'.$jenis.'_id2')
								->get();
		} else if($jenis == 'tps') {
			$data = DB::table('ref_tps')
				->whereNull('desaId2')
				->groupBy('desaId')
					->skip($mulai)
					->take($sampai)
					->get();
		}
		echo count($data);
		foreach($data as $tmp) {
			$dataUpdate = 0;
			
			$cek = DB::table('m_geo_'.$jenis);
			
			if($jenis == 'prov') {
				$id = $tmp->geo_prov_id;
				$nama = $tmp->geo_prov_nama;
				
			} else if($jenis == 'kab') {
				$provId = $tmp->geo_prov_id2;
				$id = $tmp->geo_kab_id;
				$nama = $tmp->geo_kab_nama;
				
				/* $cek->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id'); */
					/* ->where('m_geo_prov.geo_prov_id',$provId); */
				
			} else if($jenis == 'kec') {
				$provId = $tmp->geo_prov_id2;
				$kabId = $tmp->geo_kab_id2;
				$id = $tmp->geo_kec_id;
				$nama = $tmp->geo_kec_nama;
				
				$cek->join('m_geo_kab','m_geo_kab.geo_kab_id','=','m_geo_kec.geo_kab_id')
					->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
					->where('m_geo_prov.geo_prov_id',$provId)
					->where('m_geo_kab.geo_kab_id',$kabId);
				
			} else if($jenis == 'deskel') {
				$provId = $tmp->geo_prov_id2;
				$kabId = $tmp->geo_kab_id2;
				$kecId = $tmp->geo_kec_id2;
				$id = $tmp->geo_deskel_id;
				$nama = $tmp->geo_deskel_nama;
				
				$cek->join('m_geo_kec','m_geo_kec.geo_kec_id','=','m_geo_deskel.geo_kec_id')
					->join('m_geo_kab','m_geo_kab.geo_kab_id','=','m_geo_kec.geo_kab_id')
					->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
					->where('m_geo_prov.geo_prov_id',$provId)
					->where('m_geo_kab.geo_kab_id',$kabId)
					->where('m_geo_kec.geo_kec_id',$kecId);
				
			} else if($jenis == 'rw') {
				$id = $tmp->geo_rw_id2;
				$nama = $tmp->geo_rw_nama;
			} else if($jenis == 'tps') {
				$id = $tmp->tpsId;
				$nama = $tmp->desaId;
				
				$dataCek = DB::table('m_geo_deskel_kpu')
					->where('geo_deskel_id',$nama)
						->get();
			}
				
			/* $dataCek = $cek->where('geo_'.$jenis.'_nama','like','%'.$nama.'%')
				->get();
			 */
			foreach($dataCek as $tmp){
				if($jenis == 'prov')
					$dataUpdate = $tmp->geo_prov_id; 
				else if($jenis == 'kab')
					$dataUpdate = $tmp->geo_kab_id; 
				else if($jenis == 'kec')
					$dataUpdate = $tmp->geo_kec_id; 
				else if($jenis == 'deskel')
					$dataUpdate = $tmp->geo_deskel_id; 
				else if($jenis == 'tps')
					$dataUpdate = $tmp->geo_deskel_id2; 
			}
			echo $id.' - '.$nama.' - '.$dataUpdate.'<br>';
				$proses = DB::table('ref_tps')
					->where('desaId',$nama)
						->update(['desaId2' => $dataUpdate]);
				/* $proses = DB::table('m_geo_'.$jenis.'_kpu')
					->where('geo_'.$jenis.'_id',$id)
						->update(['geo_'.$jenis.'_id2' => $dataUpdate]); */
			
			
		}
	}
	
	public function getCoordinate($jenis){
		if($jenis == 'prov') {
			$data = DB::table('m_geo_'.$jenis.'_kpu')
				->whereNull('geo_'.$jenis.'_lat')
				->orWhereNull('geo_'.$jenis.'_lng')
					->get();			
		} else if($jenis == 'kab') {
			$data = DB::table('m_geo_'.$jenis.'_kpu')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
					->whereNull('geo_'.$jenis.'_lat')
					->orWhereNull('geo_'.$jenis.'_lng')
						->get();
		} else if($jenis == 'kec') {
			$data = DB::table('m_geo_'.$jenis.'_kpu')
				->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
					->whereNull('geo_'.$jenis.'_lat')
					->orWhereNull('geo_'.$jenis.'_lng')
						->get();
		} else if($jenis == 'deskel') {
			$data = DB::table('m_geo_'.$jenis.'_kpu')
				->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
				->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
					->whereNull('geo_'.$jenis.'_lat')
					->orWhereNull('geo_'.$jenis.'_lng')
						->get();
		} else if($jenis == 'rw') {
			$data = DB::table('m_geo_'.$jenis)
				->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','m_geo_rw.geo_deskel_id')
				->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','m_geo_deskel_kpu.geo_kec_id')
				->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_kec_kpu.geo_kab_id')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_kab_kpu.geo_prov_id')
					->whereNull('geo_'.$jenis.'_lat')
					->orWhereNull('geo_'.$jenis.'_lng')
						->get();
		}
		
		foreach($data as $tmp){			
			if($jenis == 'prov') {
				$id = $tmp->geo_prov_id;
				$nama = $tmp->geo_prov_nama;
				$namaLokasi = $tmp->geo_prov_nama.', Indonesia';
			} else if($jenis == 'kab') {
				$id = $tmp->geo_kab_id;
				$nama = $tmp->geo_kab_nama;
				$namaLokasi = $tmp->geo_kab_nama.', '.$tmp->geo_prov_nama.', Indonesia';
			} else if($jenis == 'kec') {
				$id = $tmp->geo_kec_id;
				$nama = $tmp->geo_kec_nama;
				$namaLokasi = $tmp->geo_kec_nama.', '.$tmp->geo_kab_nama.', '.$tmp->geo_prov_nama.', Indonesia';
			} else if($jenis == 'deskel') {
				$id = $tmp->geo_deskel_id;
				$nama = $tmp->geo_deskel_nama;
				$namaLokasi = $tmp->geo_deskel_nama.', '.$tmp->geo_kec_nama.', '.$tmp->geo_kab_nama.', '.$tmp->geo_prov_nama.', Indonesia';
			} else if($jenis == 'rw') {
				$id = $tmp->geo_rw_id;
				$nama = $tmp->geo_rw_nama;
				$namaLokasi = $tmp->geo_rw_nama.', '.$tmp->geo_deskel_nama.', '.$tmp->geo_kec_nama.', '.$tmp->geo_kab_nama.', '.$tmp->geo_prov_nama.', Indonesia';
			}
			
			$latlng['api'] = '';
			
			$latlng = $this::getLatLng($namaLokasi);
			
			$update = DB::table('m_geo_'.$jenis.'_kpu')
				->where('geo_'.$jenis.'_id',$id)
					->update([
						'geo_'.$jenis.'_lat' => $latlng['lat'],
						'geo_'.$jenis.'_lng' => $latlng['lng']
					]);
					
		} 
	}
	
	public function viewPage()
	{
		return view('index_page');
	}
	
	public function viewIndex()
	{
		$kontak_pimda = @$_GET['kontak_pimda'];
		$kontak_pimcab = @$_GET['kontak_pimcab'];
		$suara_tahun = @$_GET['suara_tahun'];
		$agenda_tahun = @$_GET['agenda_tahun'];
		
		$datapimda = array(); 
		$dataDPC = array(); 
		$datapimcabAll = array(); 
		$datapimdaAll = array(); 
		$dataPengurusAll = array(); 
		
		$jumlahProv = DB::table('m_geo_prov_kpu')->count();
		
		$dataStatistikOrganisasi = DB::table('m_pengurus')
			->select(
				'pengurus_pimcab as pimcab',
				'pengurus_pimcam as pimcam',
				'pengurus_ranting as ranting',
				'pengurus_anak_ranting as anak_ranting',
				'pengurus_kpa as kpa',
				'pengurus_pimcab_ada as pimcab_ada',
				'pengurus_pimcam_ada as pimcam_ada',
				'pengurus_ranting_ada as ranting_ada',
				'pengurus_anak_ranting_ada as anak_ranting_ada',
				'pengurus_kpa_ada as kpa_ada',
				'geo_prov_nama as prov_nama',
				'geo_prov_lat as lat',
				'geo_prov_lng as lng'
			)
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_pengurus.geo_prov_id')
					->groupBy('m_pengurus.geo_prov_id')
						->get(); 
						
		$dataStatistikKursi = DB::select('select 
			statistik_dapil_t1 as dapil_t1, statistik_dapil_t2 as dapil_t2, statistik_dapil_t3 as dapil_t3, 
			statistik_kursi_t1 as kursi_t1, statistik_kursi_t2 as kursi_t2, statistik_kursi_t3 as kursi_t3, 
			geo_prov_nama as prov_nama, geo_prov_lat as lat, geo_prov_lng as lng ,
			(select count(*) from r_bio_dprri join m_bio on m_bio.bio_id = r_bio_dprri.bio_id where r_bio_dprri.geo_prov_id = m_statistik_kursi.geo_prov_id) as kursi_t1_ada,
			(select count(*) from r_bio_dprdi join m_bio on m_bio.bio_id = r_bio_dprdi.bio_id where r_bio_dprdi.geo_prov_id = m_statistik_kursi.geo_prov_id) as kursi_t2_ada,
			(select count(*) from r_bio_dprdii join m_bio on m_bio.bio_id = r_bio_dprdii.bio_id where r_bio_dprdii.geo_prov_id = m_statistik_kursi.geo_prov_id) as kursi_t3_ada
			from m_statistik_kursi 
			inner join m_geo_prov_kpu on m_geo_prov_kpu.geo_prov_id = m_statistik_kursi.geo_prov_id 
			group by m_statistik_kursi.geo_prov_id');

		$datapimdaAll = DB::table('m_struk_pimda')
			->select(
				'm_bio.bio_id as id_bio',
				'm_bio.bio_nama_depan as nama',
				'm_bio.bio_handphone as no_telp',
				'm_bio.bio_email as email',
				'm_geo_prov_kpu.geo_prov_nama as prov_nama',
				'm_geo_prov_kpu.geo_prov_lat as lat',
				'm_geo_prov_kpu.geo_prov_lng as lng',
				'm_struk_pimda.struk_pimda_nama as struk_nama',
				'r_bio_pimda.bio_pimda_sk as sk'
			)
				->join('r_bio_pimda','r_bio_pimda.struk_pimda_id','=','m_struk_pimda.struk_pimda_id')
				->join('m_bio','m_bio.bio_id','=','r_bio_pimda.bio_id')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_pimda.geo_prov_id')
					->where('m_struk_pimda.struk_pimda_nama','like','ketua%')
						->groupBy('r_bio_pimda.geo_prov_id')
							->get(); 
						
		$datapimcabAll = DB::table('r_bio_pimcab')
			->select(
				'm_bio.bio_id as id_bio',
				'm_bio.bio_nama_depan as nama',
				'm_bio.bio_handphone as no_telp',
				'm_bio.bio_email as email',
				'm_geo_prov_kpu.geo_prov_nama as prov_nama',
				'm_geo_kab_kpu.geo_kab_nama as kab_nama',
				'm_geo_kab_kpu.geo_kab_lat as lat',
				'm_geo_kab_kpu.geo_kab_lng as lng',
				'r_bio_pimcab.geo_kab_id as pimcab_kab_id',
				'm_struk_pimcab.struk_pimcab_nama as struk_nama',
				'r_bio_pimcab.bio_pimcab_sk as sk'
			)
				->join('m_struk_pimcab','r_bio_pimcab.struk_pimcab_id','=','m_struk_pimcab.struk_pimcab_id')
				->join('m_bio','m_bio.bio_id','=','r_bio_pimcab.bio_id')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_pimcab.geo_prov_id')
				->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_pimcab.geo_kab_id')
					->where('m_struk_pimcab.dijabat', '1')
						->groupBy('r_bio_pimcab.geo_kab_id')
							->get();  

		$type = 'all';
		return view('index', array(
			'jumlahProv' => $jumlahProv,
			'datapimda' => $datapimda,
			'dataDPC' => $dataDPC,
			'datapimdaAll' => $datapimdaAll,
			'datapimcabAll' => $datapimcabAll,
			'dataStatistikOrganisasi' => $dataStatistikOrganisasi,
			'dataStatistikKursi' => $dataStatistikKursi,
			'type' => $type
		));
	}

	public function getDataMap($jenis,$jenisPenduduk=0)
	{
		$data = array();
		if($jenis == 'penduduk'){
			if($jenisPenduduk == 'provinsi'){
				$dataPendudukProvinsi = DB::table('m_penduduk')
					->select(DB::raw('*,sum(penduduk_jumlah) as penduduk_jumlah'))
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_penduduk.geo_prov_id')
							->groupBy('m_penduduk.geo_prov_id')
								->get();	
				/* $data2 = array(); */
				foreach($dataPendudukProvinsi as $tmp)
				{
					$data1 = array();
					array_push($data1,$tmp->geo_prov_nama,(float)$tmp->geo_prov_lat,(float)$tmp->geo_prov_lng,number_format($tmp->penduduk_jumlah,0, "," , "."));
					array_push($data,$data1);
				}								
			} else if($jenisPenduduk == 'kabupaten'){				
				$dataPendudukKabupaten = DB::table('m_penduduk')
					->select(DB::raw('*,sum(penduduk_jumlah) as penduduk_jumlah'))	
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_penduduk.geo_prov_id')
						->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_penduduk.geo_kab_id')
							->groupBy('m_penduduk.geo_kab_id')
								->get();
				/* $data2 = array(); */
				foreach($dataPendudukKabupaten as $tmp)
				{
					$data1 = array();
					array_push($data1,$tmp->geo_kab_nama,$tmp->geo_prov_nama,(float)$tmp->geo_kab_lat,(float)$tmp->geo_kab_lng,number_format($tmp->penduduk_jumlah,0, "," , "."));
					array_push($data,$data1);
				}
			}
			
			/* foreach($dataPendudukKabupaten as $data)
			{
				$data1 = array();
				$latlng = $this::getLatLng($data->geo_kab_nama.','.$data->geo_prov_nama.', Indonesia');
				array_push($data1,$data->geo_kab_nama,$data->geo_prov_nama,$latlng['lat'],$latlng['lng']);
				array_push($data3,$data1);
			} */
			/* 
			$data = array(
				'provinsi' => $data2,
				'kabupaten' => $data3
			); */
		} else if($jenis == 'kursi'){
			$anggotaArray = [];
			$jeniKursi = $jenisPenduduk;
			
			if($jeniKursi == 'dprri') {
				$dataKursi = DB::table('r_bio_dprri')
					->select('m_geo_prov_kpu.geo_prov_id','m_geo_prov_kpu.geo_prov_nama as geo_nama','m_geo_prov_kpu.geo_prov_lat as geo_lat','m_geo_prov_kpu.geo_prov_lng as geo_lng')
						->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_dprri.dapil_id')
						->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_dapil.pro_id')
							->groupBy('r_bio_dprri.geo_prov_id')
								->get(); 
			} else if($jeniKursi == 'dprdi') {
				$dataKursi = DB::table('r_bio_dprdi')
					->select('m_geo_prov_kpu.geo_prov_id','m_geo_prov_kpu.geo_prov_nama as geo_nama','m_geo_prov_kpu.geo_prov_lat as geo_lat','m_geo_prov_kpu.geo_prov_lng as geo_lng')
						->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_dprdi.dapil_id')
						->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_dprdi.geo_prov_id')
							->groupBy('r_bio_dprdi.geo_prov_id')
								->get(); 
			} else if($jeniKursi == 'dprdii') {
				$dataKursi = DB::table('r_bio_dprdii')
					->select('m_geo_kab_kpu.geo_kab_id','m_geo_kab_kpu.geo_kab_nama as geo_nama','m_geo_kab_kpu.geo_kab_lat as geo_lat','m_geo_kab_kpu.geo_kab_lng as geo_lng')
						->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_dprdii.dapil_id')
						->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_dprdii.geo_prov_id')
						->leftjoin('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_dprdii.geo_kab_id')
							->groupBy('r_bio_dprdii.geo_kab_id')
								->get(); 
			}
			
			foreach($dataKursi as $tmp)
			{
				$dataKursiAnggota = [];
				if($jeniKursi == 'dprri') { 
					$dataKursiAnggota = DB::table('r_bio_dprri')
						->select('bio_nama_depan as nama')
							->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_dprri.dapil_id')
							->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_dapil.pro_id')
							->join('m_bio','m_bio.bio_id','=','r_bio_dprri.bio_id')
								->where('r_bio_dprri.geo_prov_id',$tmp->geo_prov_id)
									->get();
				} else if($jeniKursi == 'dprdi') { 
					$dataKursiAnggota = DB::table('r_bio_dprdi')
					->distinct()
						->select('bio_nama_depan as nama')
							->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_dprdi.dapil_id')
							->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_dprdi.geo_prov_id')
							->join('m_bio','m_bio.bio_id','=','r_bio_dprdi.bio_id')
								->where('r_bio_dprdi.geo_prov_id',$tmp->geo_prov_id)
									->get();
				} else if($jeniKursi == 'dprdii') { 
					$dataKursiAnggota = DB::table('r_bio_dprdii')
						->select('bio_nama_depan as nama')
							->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_dprdii.dapil_id')
							->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_dprdii.geo_prov_id')
							->leftjoin('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_dprdii.geo_kab_id')
							->join('m_bio','m_bio.bio_id','=','r_bio_dprdii.bio_id')
								->where('r_bio_dprdii.geo_kab_id',$tmp->geo_kab_id)
									->get();
				}
				$anggotaArray['anggota'] = $dataKursiAnggota;
				$data1 = array();
				array_push($data1,$tmp->geo_nama,(float)$tmp->geo_lat,(float)$tmp->geo_lng,$dataKursiAnggota);
				array_push($data,$data1);
			}
		} else if($jenis == 'dapil'){
			$dataDapil = DB::table('m_dapil')
				->where('tingkat_dapil',3)
					->get();
					
			foreach($dataDapil as $tmp){
				$like = SUBSTR($tmp->nama_dapil,0,-2);
				$dataKab = DB::table('m_geo_kab')
					->where('geo_kab_nama','like','%'.$like.'%')
						->first();
				if(count($dataKab) != 0){
					$prosesUpdate = DB::table('m_dapil')
						->where('dapil_id',$tmp->dapil_id)
							->update(['kab_id'=>$dataKab->geo_kab_id]);
				} else {
					echo 'tidak';
				}
				echo '<br>';
			}
			
		} else if($jenis == 'pilkada'){
			$wilayahArray = [];
			$anggotaArray = [];
			$jenisPilkada = $jenisPenduduk;
			if($jenisPilkada == 'gubernur'){
				$dataPilkada = DB::table('m_geo_pelaksana')
					->select('geo_prov_nama as nama',
						'm_geo_prov_kpu.geo_prov_id',
						'm_geo_prov_kpu.geo_prov_lat as lat',
						'm_geo_prov_kpu.geo_prov_lng as lng')
						->join('ref_jenis_calon','ref_jenis_calon.jenis_calon_id','=','m_geo_pelaksana.jenis_calon_id')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_pelaksana.geo_prov_id')
								->where('ref_jenis_calon.jenis_calon_id','5')
									->get();  		
			} elseif ($jenisPilkada == 'bupati') {
				$dataPilkada = DB::table('m_geo_pelaksana')
					->select('geo_kab_nama as nama',
						'm_geo_kab_kpu.geo_kab_id',
						'm_geo_kab_kpu.geo_kab_lat as lat',
						'm_geo_kab_kpu.geo_kab_lng as lng')
						->join('ref_jenis_calon','ref_jenis_calon.jenis_calon_id','=','m_geo_pelaksana.jenis_calon_id')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_pelaksana.geo_prov_id')
						->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_pelaksana.geo_kab_id')
								->where('ref_jenis_calon.jenis_calon_id','6')
									->get();  
			} elseif ($jenisPilkada == 'walikota') {
				$dataPilkada = DB::table('m_geo_pelaksana')
					->select('geo_kab_nama as nama',
						'm_geo_kab_kpu.geo_kab_id',
						'm_geo_kab_kpu.geo_kab_lat as lat',
						'm_geo_kab_kpu.geo_kab_lng as lng')
						->join('ref_jenis_calon','ref_jenis_calon.jenis_calon_id','=','m_geo_pelaksana.jenis_calon_id')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_geo_pelaksana.geo_prov_id')
						->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','m_geo_pelaksana.geo_kab_id')
								->where('ref_jenis_calon.jenis_calon_id','7')
									->get();  
			}

			foreach ($dataPilkada as $tmp) {
				$dataKursiAnggota = [];
				if($jenisPilkada == 'gubernur') { 
					$dataKursiAnggota = DB::table('r_bio_dprdi')
					->distinct()
						->select('bio_nama_depan as nama')
							->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_dprdi.dapil_id')
							->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_dprdi.geo_prov_id')
							->join('m_bio','m_bio.bio_id','=','r_bio_dprdi.bio_id')
								->where('r_bio_dprdi.geo_prov_id',$tmp->geo_prov_id)
									->get();
				} else if($jenisPilkada == 'bupati') { 
					$dataKursiAnggota = DB::table('r_bio_dprdii')
						->select('bio_nama_depan as nama')
							->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_dprdii.dapil_id')
							->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_dprdii.geo_prov_id')
							->leftjoin('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_dprdii.geo_kab_id')
							->join('m_bio','m_bio.bio_id','=','r_bio_dprdii.bio_id')
								->where('r_bio_dprdii.geo_kab_id',$tmp->geo_kab_id)
									->get();
				} else if($jenisPilkada == 'walikota') { 
					$dataKursiAnggota = DB::table('r_bio_dprdii')
						->select('bio_nama_depan as nama')
							->leftjoin('m_dapil','m_dapil.dapil_id','=','r_bio_dprdii.dapil_id')
							->leftjoin('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_dprdii.geo_prov_id')
							->leftjoin('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_dprdii.geo_kab_id')
							->join('m_bio','m_bio.bio_id','=','r_bio_dprdii.bio_id')
								->where('r_bio_dprdii.geo_kab_id',$tmp->geo_kab_id)
									->get();
				}
				$anggotaArray['anggota'] = $dataKursiAnggota;

				$data1 = array();
				array_push($data1,$tmp->nama,(float)$tmp->lat,(float)$tmp->lng,$dataKursiAnggota);
				array_push($data,$data1);	
			}						

		} else {
			
		}
		
		return $data;
	}
	
	public function dataAktif()
	{
		$change = @$_GET['change'];
		$provinsi = DB::table('provinsi')->get();
		echo '<script src="../asset/js/jquery-3.0.0.min.js"></script>';
		echo '<script src="../asset/js/ajaxLokasi.js"></script>';
		if($change == 'kontak_pimda')
		{
			echo '<div class="form-group col-md-12">
				<label for="pimda" class="col-md-2">pimda</label>
				<div class="col-md-4">
					<select name="" id="provinsi" class="form-control">
					<option value="">--- Provinsi ---</option>';
					foreach($provinsi as $prov){
						echo '<option value="'.$prov->id_provinsi.'">'.ucwords(strtolower($prov->Nama_provinsi)).'</option>';
					}
					echo '</select>
				</div> 
				<div class="result col-md-5"></div></div>';
		} else if($change == 'kontak_pimcab') {
			echo '<div class="form-group col-md-12">
				<label for="pimda" class="col-md-2">DPC</label>
				<div class="col-md-4">
					<select name="" id="provinsi" class="form-control">
					<option value="">--- Provinsi ---</option>';
					foreach($provinsi as $prov){
						echo '<option value="'.$prov->id_provinsi.'">'.ucwords(strtolower($prov->Nama_provinsi)).'</option>';
					}
					echo '</select>
				</div> 
				<div class="col-md-5">
					<select name="" id="kabupaten" class="form-control">
						<option value="0">--- Kabupaten / Kota ---</option>
					</select>
				</div>
			</div>';
		} else if($change == 'caleg') {
			echo '<div class="form-group col-md-12">
				<label for="pimda" class="col-md-2">Caleg</label>
				<div class="col-md-4">
					<select name="" id="provinsi" class="form-control">
					<option value="">--- Provinsi ---</option>';
					foreach($provinsi as $prov){
						echo '<option value="'.$prov->id_provinsi.'">'.ucwords(strtolower($prov->Nama_provinsi)).'</option>';
					}
					echo '</select>
				</div> 
				<div class="col-md-5">
					<select name="0" id="kabupaten" class="form-control">
						<option value="">--- Kabupaten / Kota ---</option>
					</select>
				</div>
			</div>';
		}
	}
	public function caseMenu()
	{
		$case = @$_GET['case'];
		if($case == 'Caleg') 
		{
			$dataCalon = DB::table('caleg_drh')
				->leftjoin('provinsi','provinsi.id_provinsi','=','caleg_drh.tingkat_provinsi')
				->leftjoin('kabupaten','kabupaten.id_kabupaten','=','caleg_drh.tingkat_kabupaten')
				->leftjoin('surat_keputusan','surat_keputusan.no_sk','=','caleg_drh.no_sk')
 				->leftjoin('caleg_terpilih','caleg_terpilih.caleg_id','=','caleg_drh.id')
				->leftjoin('partai','partai.ID','=','caleg_terpilih.partai_id')
				->where('partai.NAMA_PARTAI','Hanura')
				->where('caleg_drh.id_ketua','')
				->where('caleg_drh.tingkat_provinsi','!=','')
				->groupBy('caleg_drh.nama')
				->select(
					'caleg_drh.nama as nama',
					'caleg_drh.tingkat_provinsi',
					'caleg_drh.tingkat_kabupaten',
					'caleg_drh.jenis_calon',
					'caleg_drh.pekerjaan',
					'caleg_drh.jenis_kelamin',
					'caleg_drh.create_date',
					'caleg_drh.id as caleg_id',
					'caleg_drh.telephone as no_telp',
					'caleg_drh.email as email',
					'caleg_drh.type as type',
					'provinsi.Nama_provinsi',
					'kabupaten.Nama_kabupaten',
					'caleg_drh.no_sk as no_sk',
					'caleg_drh.*'
				)
				->orderBy('kabupaten.Nama_kabupaten','asc')
				->get();
			return response()->view('master_maps', array(
				'dataCalon' => $dataCalon,
				'type' => 'Caleg'
			));
		} else if($case == "pimda") {
			$dataCalon = DB::table('call_center_pimda')
				->leftjoin('provinsi','provinsi.id_provinsi','=','call_center_pimda.provinsi')
				->join('kabupaten','kabupaten.id_provinsi','=','provinsi.id_provinsi')
				->select(
					'call_center_pimda.email as email',
					'call_center_pimda.no_telp as no_telp',
					'call_center_pimda.nama_pimda as nama',
					'call_center_pimda.kabupaten',
					'provinsi.Nama_provinsi',
					'kabupaten.Nama_kabupaten'
				)
				->groupBy('call_center_pimda.nama_pimda')
				->get();
			return response()->view('pimda_maps', array(
				'dataCalon' => $dataCalon,
				'type' => 'pimda'
			));
		} else if($case == "DPC") {
			$dataCalon = DB::table('call_center_pimcab')
				->leftjoin('kabupaten','call_center_pimcab.kabupaten_kota','=','kabupaten.id_kabupaten')
				->leftjoin('provinsi','kabupaten.id_provinsi','=','provinsi.id_provinsi')
				->groupBy('kabupaten.Nama_kabupaten')
				->groupBy('call_center_pimcab.nama_ketua_pimcab')
					->select(
					'call_center_pimcab.email as email',
					'call_center_pimcab.no_telp as no_telp',
					'call_center_pimcab.nama_ketua_pimcab as nama',
					'call_center_pimcab.presentase',
					'provinsi.Nama_provinsi',
					'kabupaten.Nama_kabupaten',
					'call_center_pimcab.*'
				)
				->get();
			return response()->view('pimcab_maps', array(
				'dataCalon' => $dataCalon,
				'type' => 'DPC'
			));
		} else if($case == 'Survey')  {
			$dataCalon = DB::table('call_center_pimcab')
				->join('kabupaten','kabupaten.id_kabupaten','=','call_center_pimcab.kabupaten_kota')
				->join('provinsi','provinsi.id_provinsi','=','call_center_pimcab.provinsi')
				->where('call_center_pimcab.presentase','!=','0')
				->where('call_center_pimcab.responden','!=','')
				->select(
					'call_center_pimcab.email as email',
					'call_center_pimcab.no_telp as no_telp',
					'call_center_pimcab.nama_ketua_pimcab as nama',
					'call_center_pimcab.presentase',
					'provinsi.Nama_provinsi',
					'kabupaten.Nama_kabupaten'
				)->groupBy('kode_pimcab')
				->get();
			$dataProvinsi = DB::table('call_center_pimcab')
				->join('kabupaten','kabupaten.id_kabupaten','=','call_center_pimcab.kabupaten_kota')
				->join('provinsi','provinsi.id_provinsi','=','call_center_pimcab.provinsi')
				->where('call_center_pimcab.presentase','!=','0')
				->where('call_center_pimcab.responden','!=','')
				->groupBy('provinsi.Nama_provinsi')
				->orderBy('provinsi.Nama_provinsi','asc')
				->get();
			return response()->view('survey', array(
				'dataCalon' => $dataCalon,
				'dataProvinsi' => $dataProvinsi,
				'type' => 'survey'
			));
		} else if($case == '0') {
			echo 'kosong';
		}
	}
	public function cariData() 
	{
		$cari = @$_GET['cari'];
		$case = @$_GET['case'];
		if($case == 'Caleg') 
		{
			$dataCalon = DB::table('caleg_drh')
				->join('kabupaten','kabupaten.id_kabupaten','=','caleg_drh.tingkat_kabupaten')
				->join('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
				->leftjoin('caleg_terpilih','caleg_terpilih.caleg_id','=','caleg_drh.id')
				->join('partai','partai.ID','=','caleg_terpilih.partai_id')
				->where('partai.NAMA_PARTAI','Hanura')
				->where('caleg.nama','like',$cari.'%')
				->select(
					'caleg_drh.email as email',
					'caleg_drh.telephone as no_telp',
					'caleg_drh.nama as nama',
					'provinsi.Nama_provinsi',
					'kabupaten.Nama_kabupaten',
					'caleg_drh.*'
				)->get();
		} else if($case == "pimda") {
			$dataCalon = DB::table('call_center_pimda')
				->leftjoin('provinsi','provinsi.id_provinsi','=','call_center_pimda.provinsi')
				->leftjoin('kabupaten','kabupaten.id_kabupaten','=','call_center_pimda.kabupaten')
				->where('caleg.nama_pimda','like',$cari.'%')
				->select(
					'call_center_pimda.email as email',
					'call_center_pimda.no_telp as no_telp',
					'call_center_pimda.nama_pimda as nama',
					'provinsi.Nama_provinsi',
					'kabupaten.Nama_kabupaten',
					'call_center_pimda.*'
				)->get();
		} else if($case == "DPC") {
			$dataCalon = DB::table('call_center_pimcab')
				->join('kabupaten','kabupaten.id_kabupaten','=','call_center_pimcab.kabupaten_kota')
				->join('provinsi','provinsi.id_provinsi','=','kabupaten.id_provinsi')
				->where('caleg.nama_ketua_pimcab','like',$cari.'%')
				->select(
					'call_center_pimcab.email as email',
					'call_center_pimcab.no_telp as no_telp',
					'call_center_pimcab.nama_ketua_pimcab as nama',
					'provinsi.Nama_provinsi',
					'kabupaten.Nama_kabupaten',
					'call_center_pimcab.*'
				)->get();
		}
		foreach ($dataCalon as $key) {
			
		}
	}
	public function viewDashboard($prov = 0)
	{
		$dashboardName 	= '';
		$jumlahPenduduk = 0;
		$kab = 0;
			
		$daerahRole 	= array();
		
		$dataProvAll 	= 0;
		$dataKabAll 	= 0;
		$dataKecAll 	= 0;
		$dataKelAll 	= 0;
		$dataRWAll 		= 0;
		$dataRTAll	 	= 0;
		
		$dataProvAda 	= 0;
		$dataKabAda 	= 0;
		$dataKecAda 	= 0;
		$dataKelAda 	= 0;
		$dataRWAda 		= 0;
		$dataRTAda 		= 0;
		
		$dataProvPer 	= 0;
		$dataKabPer 	= 0;
		$dataKecPer 	= 0;
		$dataKelPer 	= 0;
		$dataRWPer 		= 0;
		$dataRTPer 		= 0;
		
		
		if(session('idProvinsi2')) {
			$prov = session('idProvinsi2');
		}
		
		if(session('idKabupaten')) {
			$kab = session('idKabupaten');
		}
		
		$dataProv = DB::table('m_geo_prov_kpu')->get();
		
		if(session('idRole') == 3) {
			$daerahRole = DB::table('m_geo_prov_kpu')
				->select('geo_prov_nama as daerahName')
					->where('geo_prov_id', session('idProvinsi2'))
						->first();
		} else if(session('idRole') == 4) {
			$daerahRole = DB::table('m_geo_kab_kpu')
				->select('geo_kab_nama as daerahName')
					->where('geo_kab_id', session('idKabupaten'))
						->first();
		} else if(session('idRole') == 5) {	
			$daerahRole = DB::table('m_geo_kec_kpu')
				->select('geo_kec_nama as daerahName')
					->where('geo_kec_id', session('idKecamatan'))
						->first();	
		} else if(session('idRole') == 6) {	
			$daerahRole = DB::table('m_geo_deskel_kpu')
				->select('geo_deskel_nama as daerahName')
					->where('geo_deskel_id', session('idKelurahan'))
						->first();		
			}
		
		if(count($daerahRole) != 0) {
			$dashboardName = $daerahRole->daerahName;
			}
			
		if(session('idRole') == 1 || session('idRole') == 3) {
			$dataKabAllQuery = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_pimcab) as pimcab'));
			$dataKabAdaQuery = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_pimcab_ada) as pimcab_ada'));			
			
			$dataKecAllQuery = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_pimcam) as pimcam'));
			$dataKecAdaQuery = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_pimcam_ada) as pimcam_ada'));
				
			$dataKelAllQuery = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_ranting) as ranting'));
			$dataKelAdaQuery = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_ranting_ada) as ranting_ada'));
				
			$dataRWAllQuery = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_anak_ranting) as a_ranting'));
			$dataRWAdaQuery = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_anak_ranting_ada) as anak_ranting'));
				
			$dataRTAllQuery = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_kpa) as kpa'));
			$dataRTAdaQuery = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_kpa_ada) as kpa_ada'));
				
			switch(session('idRole')){
				case 6:
					/* $dataKabAllQuery->where('geo_deskel_id',session('idKelurahan'));			
					$dataKabAdaQuery->where('geo_deskel_id',session('idKelurahan'));	
					$dataKecAllQuery->where('geo_deskel_id',session('idKelurahan'));	
					$dataKecAdaQuery->where('geo_deskel_id',session('idKelurahan'));	
					$dataKelAllQuery->where('geo_deskel_id',session('idKelurahan'));	
					$dataKelAdaQuery->where('geo_deskel_id',session('idKelurahan'));	
					$dataRWAllQuery->where('geo_deskel_id',session('idKelurahan'));	
					$dataRWAdaQuery->where('geo_deskel_id',session('idKelurahan'));
					$dataRTAllQuery->where('geo_deskel_id',session('idKelurahan'));	
					$dataRTAdaQuery->where('geo_deskel_id',session('idKelurahan')); */
				case 5:
					/* $dataKabAllQuery->where('geo_kec_id',session('idKecamatan'));
					$dataKabAdaQuery->where('geo_kec_id',session('idKecamatan'));
					$dataKecAllQuery->where('geo_kec_id',session('idKecamatan'));
					$dataKecAdaQuery->where('geo_kec_id',session('idKecamatan'));
					$dataKelAllQuery->where('geo_kec_id',session('idKecamatan'));
					$dataKelAdaQuery->where('geo_kec_id',session('idKecamatan'));
					$dataRWAllQuery->where('geo_kec_id',session('idKecamatan'));
					$dataRWAdaQuery->where('geo_kec_id',session('idKecamatan'));
					$dataRTAllQuery->where('geo_kec_id',session('idKecamatan'));
					$dataRTAdaQuery->where('geo_kec_id',session('idKecamatan')); */
				case 4:
					/* $dataKabAllQuery->where('geo_kab_id',session('idKabupaten'));			
					$dataKabAdaQuery->where('geo_kab_id',session('idKabupaten'));	
					$dataKecAllQuery->where('geo_kab_id',session('idKabupaten'));	
					$dataKecAdaQuery->where('geo_kab_id',session('idKabupaten'));	
					$dataKelAllQuery->where('geo_kab_id',session('idKabupaten'));	
					$dataKelAdaQuery->where('geo_kab_id',session('idKabupaten'));	
					$dataRWAllQuery->where('geo_kab_id',session('idKabupaten'));	
					$dataRWAdaQuery->where('geo_kab_id',session('idKabupaten')); 
					$dataRTAllQuery->where('geo_kab_id',session('idKabupaten'));	
					$dataRTAdaQuery->where('geo_kab_id',session('idKabupaten'))*/
				case 3:
					if($prov) {					
						$dataKabAllQuery->where('geo_prov_id',$prov);			
						$dataKabAdaQuery->where('geo_prov_id',$prov);	
						$dataKecAllQuery->where('geo_prov_id',$prov);	
						$dataKecAdaQuery->where('geo_prov_id',$prov);	
						$dataKelAllQuery->where('geo_prov_id',$prov);	
						$dataKelAdaQuery->where('geo_prov_id',$prov);	
						$dataRWAllQuery->where('geo_prov_id',$prov);	
						$dataRWAdaQuery->where('geo_prov_id',$prov);	
						$dataRTAllQuery->where('geo_prov_id',$prov);	
						$dataRTAdaQuery->where('geo_prov_id',$prov);	
					}
				break;
			}			
				
			$dataKabAllQuery = $dataKabAllQuery->get();			
			$dataKabAdaQuery = $dataKabAdaQuery->get();	
			$dataKecAllQuery = $dataKecAllQuery->get();			
			$dataKecAdaQuery = $dataKecAdaQuery->get();	
			$dataKelAllQuery = $dataKelAllQuery->get();			
			$dataKelAdaQuery = $dataKelAdaQuery->get();	
			$dataRWAllQuery = $dataRWAllQuery->get();			
			$dataRWAdaQuery = $dataRWAdaQuery->get();	
			$dataRTAllQuery = $dataRTAllQuery->get();	
			$dataRTAdaQuery = $dataRTAdaQuery->get();	
			
			foreach($dataKabAllQuery as $tmp){
				$dataKabAll = $tmp->pimcab;
			}
			foreach($dataKabAdaQuery as $tmp){
				$dataKabAda = $tmp->pimcab_ada;
			}
			
			foreach($dataKecAllQuery as $tmp){
				$dataKecAll = $tmp->pimcam;
			}
			foreach($dataKecAdaQuery as $tmp){
				$dataKecAda = $tmp->pimcam_ada;
			}
			
			foreach($dataKelAllQuery as $tmp){
				$dataKelAll = $tmp->ranting;
			}
			foreach($dataKelAdaQuery as $tmp){
				$dataKelAda = $tmp->ranting_ada;
			}
			
			foreach($dataRWAllQuery as $tmp){
				$dataRWAll = $tmp->a_ranting;
			}
			foreach($dataRWAdaQuery as $tmp){
				$dataRWAda = $tmp->anak_ranting;
			}
			
			foreach($dataRTAllQuery as $tmp){
				$dataRTAll = $tmp->kpa;
			}
			foreach($dataRTAdaQuery as $tmp){
				$dataRTAda = $tmp->kpa_ada;
		}
			
			$dataProvAll = DB::table('m_geo_prov_kpu')
				->count();
			$dataProvAda = DB::table('m_bio')
				->join('r_bio_pimda','r_bio_pimda.bio_id','=','m_bio.bio_id')
				->leftjoin('m_struk_pimda','m_struk_pimda.struk_pimda_id','=','r_bio_pimda.struk_pimda_id')
					->where('m_struk_pimda.struk_pimda_nama','=',"Ketua")
						->count();
						
			if($dataProvAda != 0 || $dataProvAll != 0){
				$dataProvPer = number_format($dataProvAda/$dataProvAll*100,2, "," , ".");
		}	
			if($dataKabAda != 0 || $dataKabAll != 0){
				$dataKabPer = number_format($dataKabAda/$dataKabAll*100,2, "," , ".");
		}	
			if($dataKecAda != 0 || $dataKecAll != 0){
				$dataKecPer = number_format($dataKecAda/$dataKecAll*100,2, "," , ".");
		}	
			if($dataKelAda != 0 || $dataKelAll != 0){
				$dataKelPer = number_format($dataKelAda/$dataKelAll*100,2, "," , ".");
			}	
			if($dataRWAda != 0 || $dataRWAll != 0){
				$dataRWPer = number_format($dataRWAda/$dataRWAll*100,2, "," , ".");
		}								
			if($dataRTAda != 0 || $dataRTAll != 0){
				$dataRTPer = number_format($dataRTAda/$dataRTAll*100,2, "," , ".");
			}	
		} else {
			$dataKec = DB::table('m_geo_kec_kpu');
			$dataKel = DB::table('m_geo_deskel_kpu');
			$dataRW = DB::table('m_geo_rw');
			$dataRT = DB::table('m_geo_rt');
			
				
			switch(session('idRole')){
				case 6:			
					$dataKec->where('geo_deskel_id',session('idKelurahan'));	
					$dataKel->where('geo_deskel_id',session('idKelurahan'));	
					$dataRW->where('geo_deskel_id',session('idKelurahan'));	
					$dataRT->where('geo_deskel_id',session('idKelurahan'));	
				case 5:
					$dataKec->where('geo_kec_id',session('idKecamatan'));	
					$dataKel->where('geo_kec_id',session('idKecamatan'));	
					$dataRW->where('geo_kec_id',session('idKecamatan'));	
					$dataRT->where('geo_kec_id',session('idKecamatan'));	
				case 4:
					$dataKec->where('geo_kab_id',session('idKabupaten'));	
					$dataKel->where('geo_kab_id',session('idKabupaten'));	
					$dataRW->where('geo_kab_id',session('idKabupaten'));	
					$dataRT->where('geo_kab_id',session('idKabupaten'));	
				break;
			}	
			$dataKecAll = $dataKec->count();
			$dataKelAll = $dataKel->count();
			$dataRWAll = $dataRW->count();
			$dataRTAll = $dataRT->count();
		}
		
		
		
		if(session('idRole') == 1 || session('idRole') == 3) { 
			if($prov){
				$dataPendudukQuery = DB::table('m_penduduk')
					->select(DB::raw('SUM(penduduk_jumlah) as penduduk'))
						->where('geo_prov_id', $prov)
							->get();
			}else{
				$dataPendudukQuery = DB::table('m_penduduk')
					->select(DB::raw('SUM(penduduk_jumlah) as penduduk'))
						->get();
			}
		} else {
			$dataPendudukQuery = DB::table('m_penduduk')
				->select(DB::raw('SUM(penduduk_jumlah) as penduduk'))
					->where('geo_prov_id', $prov)
					->where('geo_kab_id', $kab)
						->get();
		}
		
		foreach ($dataPendudukQuery as $tmp) {
			$jumlahPenduduk = $tmp->penduduk;
		}
		
		return view('main.dashboard.index', array(
			'prov' => $prov,
			'dashboardName' => $dashboardName,
			
			'dataProv' => $dataProv,
			'dataProvAll' => $dataProvAll,
			'dataKabAll' => $dataKabAll,
			'dataKecAll' => $dataKecAll,
			'dataKelAll' => $dataKelAll,
			'dataRWAll' => $dataRWAll,
			'dataRTAll' => $dataRTAll,
			'dataProvAda' => $dataProvAda,
			'dataKabAda' => $dataKabAda,
			'dataKecAda' => $dataKecAda,
			'dataKelAda' => $dataKelAda,
			'dataRWAda' => $dataRWAda,
			'dataRTAda' => $dataRTAda,
			'dataProvPer' => $dataProvPer,
			'dataKabPer' => $dataKabPer,
			'dataKecPer' => $dataKecPer,
			'dataKelPer' => $dataKelPer,
			'dataRWPer' => $dataRWPer,
			'dataRTPer' => $dataRTPer,
			
			'jumlahPenduduk' => $jumlahPenduduk
			
		));
		
		/* return view('main.dashboard.index', array(
			'type' => $type,
			'dashboardName' => $dashboardName,
			'prov' => $prov,
			'dataProvAll' => $dataProvAll,
			'dataKabAll' => $dataKabAlls,
			'dataKecAll' => $dataKecAlls,
			'dataKelAll' => $dataKelAlls,
			'dataRWAll' => $dataRWAlls,
			'dataRTAll' => $dataRTAlls,
			'dataKabV' => $dataKabAda,
			'dataKecV' => $dataKecAda,
			'dataKelV' => $dataKelAda,
			'dataRWV' => $dataRWAda,
			'dataRTV' => $dataRTAda,
			'kabupatenV' => $kabupatenV,
			'kecamatanV' => $kecamatanV,
			'kelurahanV' => $kelurahanV,
			'rwV' => $rwV,
			'rtV' => $rtV,
			'dataTotalPendudukAll' => $dataTotalPendudukAll,
			'dataTotalPendudukKab' => $dataTotalPendudukKab,
			'provsession' => $provsession,
			'jumlahPenduduk' => $jumlahPenduduk,
			'pengurus' => $pengurus
		)); */
	}
	
	public function viewDashboardGrafik($prov = 0,$pengurus = ''){
		$dates = "''";
		$datakursiall = "";
		$datakursialls = "";
		$datakursiallbelum = "";
		$totalall = "";
		$data_area = "";
		$data_series = ", series: [";
		$label = ",
		dataLabels: {
			enabled: true,
			rotation: -90,
			color: '#000000',
			align: 'right',
			format: '{point.y:f}', // one decimal
			y: -20, // 10 pixels down from the top
			style: {
				fontSize: '10px'
			}
		}";
		
		if($pengurus == '') {
			if (session('idProvinsi')) {
					$prov = session()->get('idProvinsi');
					$dataKabReal = DB::table('m_geo_kab')
						->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
							->where('m_geo_prov.geo_prov_id',$prov)
								->get();

					$jenis = [['KECAMATAN', '#000000'],['KELURAHAN','#FF0000']];
					
					foreach($dataKabReal as $tmp){
						$dates = $dates.",'".$tmp->geo_kab_nama."'";				
					}
					$dates = substr($dates, 3);
					
					$pengurus = DB::table('m_pengurus')
						->where('geo_prov_id', $prov)
						->get();

					for($a=0; $a < count($jenis); $a++){
						$data_series = $data_series."{
							name: '".$jenis[$a][0]."',
							color: '".$jenis[$a][1]."',
							data: [";
						
						if($jenis[$a][0] == 'KECAMATAN'){
								$jumlah_kursi = 0;
							foreach($dataKabReal as $tmp){
								$dataKursi =  DB::table('m_geo_kec')
									->where('geo_kab_id', $tmp->geo_kab_id)
									->count();
								$jumlah_kursi = $dataKursi;
								$datakursiall = $datakursiall.",".number_format($jumlah_kursi,1,'.','');
							}			
							$data_series = $data_series.substr($datakursiall, 1)."]".$label."},";
						} else if($jenis[$a][0] == 'KELURAHAN'){
							foreach($dataKabReal as $tmp){
								$jumlah_kursi = 0;
								$dataKursi = DB::table('m_geo_deskel')
									->join('m_geo_kec','m_geo_deskel.geo_kec_id','=','m_geo_kec.geo_kec_id')
									->join('m_geo_kab','m_geo_kec.geo_kab_id','=','m_geo_kab.geo_kab_id')
									->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
									->where('m_geo_kab.geo_kab_id',$tmp->geo_kab_id)
									->where('m_geo_prov.geo_prov_id',$prov)
										->count();
								$jumlah_kursi = $dataKursi;
								$datakursialls = $datakursialls.",".number_format($jumlah_kursi,1,'.','');
							}
							$data_series = $data_series.substr($datakursialls, 1)."]".$label."},";
						}
					} 				
			} else {
				if($prov == 0){
					$dataProvAll = DB::table('m_geo_prov')
						->get();
					foreach($dataProvAll as $tmp){
						$dates = $dates.",'".$tmp->geo_prov_nama."'";
					}

					$dates = substr($dates, 3);
					
					$jenis = [['KAB/KOTA', '#000000'],['KECAMATAN','#F39C12'],['KELURAHAN','#FF0000']];
					for($a=0; $a < count($jenis); $a++){
						$data_series = $data_series."{
							name: '".$jenis[$a][0]."',
							color: '".$jenis[$a][1]."',
							data: [";
						
						if($jenis[$a][0] == 'KAB/KOTA'){
							foreach($dataProvAll as $tmp){
								$jumlah_kursi = 0;
								$dataKab = DB::table('m_geo_kab')
									->where('geo_prov_id',$tmp->geo_prov_id)
										->count();
								$jumlah_kursi = $dataKab;
								$datakursiall = $datakursiall.",".number_format($jumlah_kursi,1,'.','');
							}
							$data_series = $data_series.substr($datakursiall, 1)."]".$label."},";				
						} else if($jenis[$a][0] == 'KELURAHAN'){
							foreach($dataProvAll as $tmp){
								$jumlah_kursi = 0;
								$dataKursi = DB::table('m_geo_deskel')
									->join('m_geo_kec','m_geo_deskel.geo_kec_id','=','m_geo_kec.geo_kec_id')
									->join('m_geo_kab','m_geo_kec.geo_kab_id','=','m_geo_kab.geo_kab_id')
									->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
									->where('m_geo_kab.geo_prov_id', $tmp->geo_prov_id)
										->count();
								$jumlah_kursi = $dataKursi;
								$datakursiallbelum = $datakursiallbelum.",".number_format($jumlah_kursi,1,'.','');
							}
							$data_series = $data_series.substr($datakursiallbelum, 1)."]".$label."},";
						} else if($jenis[$a][0] == 'KECAMATAN'){
							foreach($dataProvAll as $tmp){
								$jumlah_kursi = 0;
								
								$dataKursi = DB::table('m_geo_kec')
									->join('m_geo_kab','m_geo_kec.geo_kab_id','=','m_geo_kab.geo_kab_id')
									->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
									->where('m_geo_kab.geo_prov_id', $tmp->geo_prov_id)
										->count();
								$jumlah_kursi = $dataKursi;
								$datakursialls = $datakursialls.",".number_format($jumlah_kursi,1,'.','');
							}
							$data_series = $data_series.substr($datakursialls, 1)."]".$label."},";	
						}
					}
				} else {
					$dataKabReal = DB::table('m_geo_kab')
						->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
							->where('m_geo_prov.geo_prov_id',$prov)
								->get();

					$jenis = [['KECAMATAN', '#000000'],['KELURAHAN','#FF0000']];
					
					foreach($dataKabReal as $tmp){
						$dates = $dates.",'".$tmp->geo_kab_nama."'";				
					}
					$dates = substr($dates, 3);
					
					$pengurus = DB::table('m_pengurus')
						->where('geo_prov_id', '11')
						->get();

					for($a=0; $a < count($jenis); $a++){
						$data_series = $data_series."{
							name: '".$jenis[$a][0]."',
							color: '".$jenis[$a][1]."',
							data: [";
						
						if($jenis[$a][0] == 'KECAMATAN'){
								$jumlah_kursi = 0;
							foreach($dataKabReal as $tmp){
								$dataKursi =  DB::table('m_geo_kec')
									->where('geo_kab_id', $tmp->geo_kab_id)
										->count();
								$jumlah_kursi = $dataKursi;
								$datakursiall = $datakursiall.",".number_format($jumlah_kursi,1,'.','');
							}			
							$data_series = $data_series.substr($datakursiall, 1)."]".$label."},";
						} else if($jenis[$a][0] == 'KELURAHAN'){
							foreach($dataKabReal as $tmp){
								$jumlah_kursi = 0;
								$dataKursi = DB::table('m_geo_deskel')
									->join('m_geo_kec','m_geo_deskel.geo_kec_id','=','m_geo_kec.geo_kec_id')
									->join('m_geo_kab','m_geo_kec.geo_kab_id','=','m_geo_kab.geo_kab_id')
									->join('m_geo_prov','m_geo_prov.geo_prov_id','=','m_geo_kab.geo_prov_id')
									->where('m_geo_kab.geo_kab_id',$tmp->geo_kab_id)
									->where('m_geo_prov.geo_prov_id',$prov)
										->count();
								$jumlah_kursi = $dataKursi;
								$datakursialls = $datakursialls.",".number_format($jumlah_kursi,1,'.','');
							}
							$data_series = $data_series.substr($datakursialls, 1)."]".$label."},";
						}
					} 
				}
			}
		} else {
			if (session('idProvinsi')) {
				$prov = session('idProvinsi');
			}
			$jenis = [['Terbentuk', '#000000'],['Total','#FF0000']];
			$dataPengurus = DB::table('m_pengurus')
				->where('geo_prov_id',$prov)
					->get();
					
			for($a=0; $a < count($jenis); $a++){
				$dates = $dates.",'Data ".strtoupper($pengurus)."'";
				
				if(count($dataPengurus) == 0) {
					$data_series = $data_series."{
						name: '".$jenis[$a][0]."',
						color: '".$jenis[$a][1]."',
						data: [";
					$data_series = $data_series."0]".$label."},";
				} else {			
					$data_series = $data_series."{
						name: '".$jenis[$a][0]."',
						color: '".$jenis[$a][1]."',
						data: [";
				
					foreach($dataPengurus as $tmp){
						if($pengurus == 'par'){					
							$nameColAda = 'pengurus_ranting';
							$nameCol = 'pengurus_ranting_ada';	
						} else {						
							$nameColAda = 'pengurus_'.$pengurus;
							$nameCol = 'pengurus_'.$pengurus.'_ada';
						}
						if($jenis[$a][0] == 'Terbentuk'){
							$jumlah_kursi = $tmp->$nameCol;
							$datakursiall = $datakursiall.",".number_format($jumlah_kursi,1,'.','');
							$data_series = $data_series.substr($datakursiall, 1)."]".$label."},";
						} else if($jenis[$a][0] == 'Total'){		
							$jumlah_kursi = $tmp->$nameColAda;
							$datakursialls = $datakursialls.",".number_format($jumlah_kursi,1,'.','');
							$data_series = $data_series.substr($datakursialls, 1)."]".$label."},";
						}
					}
				}
			} 
			$dates = substr($dates, 3);
		}
		return view('main.dashboard.grafik', array(
			'dates' => $dates,			
			'data_series' => $data_series."]"
		));
	}
	
	public function viewDashboardData($prov=0){
		if($prov == 0){
			$dataProv = DB::table('m_geo_prov_kpu')
				->count();	
			$dataKab =  DB::table('m_geo_kab_kpu')
					->where('geo_prov_id', $prov)
					->count();
			$dataKec = DB::table('m_geo_kec_kpu')
					->join('m_geo_kab_kpu', 'm_geo_kec_kpu.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
					->where('m_geo_kab_kpu.geo_prov_id', $prov)
					->count();
			$dataKel = DB::table('m_geo_deskel_kpu')
					->join('m_geo_kec_kpu', 'm_geo_kec_kpu.geo_kec_id', '=', 'm_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu', 'm_geo_kec_kpu.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
					->where('m_geo_kab_kpu.geo_prov_id', $prov)
					->count();
			$dataRW = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_anak_ranting) as a_ranting'))
				->get();
			$dataRT = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_kpa) as kpa'))
				->get();
				
			$dataPendudukKab = DB::table('m_penduduk')
				->select(DB::raw('SUM(penduduk_jumlah) as jumlah_penduduk'))
					->get();
			$dataKabV = DB::table('r_bio_pimcab')
					->where('geo_prov_id', $prov)
					->groupBy('geo_kab_id')
					->get();
			$dataKecV = DB::table('r_bio_pimcam')
					->where('geo_prov_id', $prov)
					->groupBy('geo_kec_id')
					->get();	
			$dataKelV = DB::table('r_bio_pimran')
					->where('geo_prov_id', $prov)
					->groupBy('geo_deskel_id')
					->get();
			$dataRWV = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_anak_ranting_ada) as anak_ranting'))
				->get();				
			$dataRTV = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_kpa_ada) as kpa_ada'))
				->get();		

		} else {
			$dataProv = 1;
			$dataProv = DB::table('m_geo_prov_kpu')
				->count();	
			$dataKab =  DB::table('m_geo_kab_kpu')
					->where('geo_prov_id', $prov)
					->count();
			$dataKec = DB::table('m_geo_kec_kpu')
					->join('m_geo_kab_kpu', 'm_geo_kec_kpu.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
					->where('m_geo_kab_kpu.geo_prov_id', $prov)
					->count();
			$dataKel = DB::table('m_geo_deskel_kpu')
					->join('m_geo_kec_kpu', 'm_geo_kec_kpu.geo_kec_id', '=', 'm_geo_deskel_kpu.geo_kec_id')
					->join('m_geo_kab_kpu', 'm_geo_kec_kpu.geo_kab_id', '=', 'm_geo_kab_kpu.geo_kab_id')
					->where('m_geo_kab_kpu.geo_prov_id', $prov)
					->count();
			$dataRW = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_anak_ranting) as a_ranting'))
				->get();
			$dataRT = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_kpa) as kpa'))
				->get();
				
			$dataPendudukKab = DB::table('m_penduduk')
				->select(DB::raw('SUM(penduduk_jumlah) as jumlah_penduduk'))
					->get();
			$dataKabV = DB::table('r_bio_pimcab')
					->where('geo_prov_id', $prov)
					->groupBy('geo_kab_id')
					->get();
			$dataKecV = DB::table('r_bio_pimcam')
					->where('geo_prov_id', $prov)
					->groupBy('geo_kec_id')
					->get();	
			$dataKelV = DB::table('r_bio_pimran')
					->where('geo_prov_id', $prov)
					->groupBy('geo_deskel_id')
					->get();
			$dataRWV = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_anak_ranting_ada) as anak_ranting'))
				->where('geo_prov_id',$prov)
				->get();								
			$dataRTV = DB::table('m_pengurus')
				->select(DB::raw('SUM(pengurus_kpa_ada) as kpa_ada'))
				->where('geo_prov_id',$prov)
				->get();								
		}
		
		$jmlPenduduk = 0;
		foreach($dataPendudukKab as $tmp){
			$jmlPenduduk = $tmp->jumlah_penduduk;
		}
		$dataKabV = count($dataKabV);
		$dataKecV = count($dataKecV);
		$dataKelV = count($dataKelV);
		foreach($dataRWV as $tmp){
			$dataRWV = $tmp->anak_ranting;
		}		
		foreach($dataRTV as $tmp){
			$dataRTV = $tmp->kpa_ada;
		}		

		/*$dataKab = $tmp->pimcab;
		foreach($dataKec as $tmp){
			$dataKec = $tmp->pimcam;
		}		
		foreach($dataKel as $tmp){
			$dataKel = $tmp->ranting;
		}						*/
		foreach($dataRW as $tmp){
			$dataRW = $tmp->a_ranting;
		}	
		foreach($dataRT as $tmp){
			$dataRT = $tmp->kpa;
		}	

		
		$data['prov'] = number_format($dataProv,0, "," , ".");
		$data['kab'] = number_format($dataKab,0, "," , ".");
		$data['kec'] = number_format($dataKec,0, "," , ".");
		$data['kel'] = number_format($dataKel,0, "," , ".");
		$data['rw'] = number_format($dataRW,0, "," , ".");
		$data['rt'] = number_format($dataRT,0, "," , ".");
		
		$data['penduduk'] = number_format($jmlPenduduk,0, "," , ".");
		$data['kabv'] = number_format($dataKabV,0, "," , ".");
		$data['kecv'] = number_format($dataKecV,0, "," , ".");
		$data['kelv'] = number_format($dataKelV,0, "," , ".");
		$data['rwv'] = number_format($dataRWV,0, "," , ".");
		$data['rtv'] = number_format($dataRTV,0, "," , ".");

		if($dataKabV==0||$dataKab==0){
			$data['Hkabv'] = "0.00";
		}else{
			$data['Hkabv'] = number_format($dataKabV/$dataKab*100,2, "," , ".");
		}
		if($dataKecV==0||$dataKec==0){
			$data['Hkecv'] = "0.00";
		}else{
			$data['Hkecv'] = number_format($dataKecV/$dataKec*100,2, "," , ".");
		}
		if($dataKelV==0||$dataKel==0){
			$data['Hkelv'] = "0.00";
		}else{
			$data['Hkelv'] = number_format($dataKelV/$dataKel*100,2, "," , ".");
		}
		if($dataRWV==0||$dataRW==0){
			$data['Hrwv'] = "0.00";
		}else{
			$data['Hrwv'] = number_format($dataRWV/$dataRW*100,2, "," , ".");
		}
		if($dataRTV==0||$dataRT==0){
			$data['Hrtv'] = "0.00";
		}else{
			$data['Hrtv'] = number_format($dataRTV/$dataRT*100,2, "," , ".");
		}
		
		return json_encode($data);
	}
	
	
	public function filterSurvei(){
		$survei = @$_GET['survei'];
		if($survei != 'semua'){
			$dataSurvei = DB::table('call_center_pimcab')
				->join('kabupaten','kabupaten.id_kabupaten','=','call_center_pimcab.kabupaten_kota')
				->join('provinsi','provinsi.id_provinsi','=','call_center_pimcab.provinsi')
				->leftjoin('call_center_pimda','call_center_pimda.provinsi','=','call_center_pimcab.provinsi')
					->where('call_center_pimcab.presentase','!=','0')
					->where('call_center_pimcab.responden','!=','')
					->where('provinsi.Nama_provinsi',$survei)
						->select(
							'call_center_pimcab.email as email',
							'call_center_pimcab.no_telp as no_telp',
							'call_center_pimcab.nama_ketua_pimcab',
							'call_center_pimda.nama_pimda',
							'call_center_pimda.kabupaten',
							'call_center_pimda.provinsi',
							'call_center_pimcab.presentase',
							'provinsi.Nama_provinsi',
							'kabupaten.Nama_kabupaten'
						)->groupBy('kode_pimcab')
							->get();
			$type = $survei;
		}else{
			$dataSurvei = DB::table('call_center_pimcab')
				->join('kabupaten','kabupaten.id_kabupaten','=','call_center_pimcab.kabupaten_kota')
				->join('provinsi','provinsi.id_provinsi','=','call_center_pimcab.provinsi')
				->leftjoin('call_center_pimda','call_center_pimda.provinsi','=','call_center_pimcab.provinsi')
					->where('call_center_pimcab.presentase','!=','0')
					->where('call_center_pimcab.responden','!=','')
						->select(
							'call_center_pimcab.email as email',
							'call_center_pimcab.no_telp as no_telp',
							'call_center_pimcab.nama_ketua_pimcab',
							'call_center_pimda.nama_pimda',
							'call_center_pimda.kabupaten',
							'call_center_pimda.provinsi',
							'call_center_pimcab.presentase',
							'provinsi.Nama_provinsi',
							'kabupaten.Nama_kabupaten'
						)->groupBy('kode_pimcab')
							->get();
			$type = 'semua';
		}
			return response()->view('data_survei', array(
				'dataSurvei' => $dataSurvei,
				'type' => $type
			));			
	}
}