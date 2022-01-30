<?php namespace App\Http\Controllers;
use DB;
class MonitoringController extends Controller{
	public function index($lock){
		$key = "aSG4Rd1A";
		$dpd = 0;
		$dpc = 0;
		$pac = 0;
		$pr  = 0;
		$par = 0;
		$kpa = 0;

		if($key == $lock){
			$getDPD = DB::select("SELECT
									COUNT(*) as DPD
								FROM
									(
								    SELECT
										COUNT(*)
									FROM
										m_struk_pimda
									WHERE
										m_struk_pimda.dijabat = 1
									GROUP BY 
										m_struk_pimda.geo_prov_id
								    ) as FR");
			foreach ($getDPD as $key) {
				$dpd = $key->DPD;
			}
			echo $dpd;

			$getDPC = DB::select("SELECT
									COUNT(*) as DPC
								FROM
									(
								    SELECT
										COUNT(*)
									FROM
										m_struk_pimcab
									WHERE
										m_struk_pimcab.dijabat = 1
									GROUP BY 
										m_struk_pimcab.geo_kab_id
								    ) as FR");
			foreach ($getDPC as $key) {
				$dpc = $key->DPC;
			}
			echo " ".$dpc;

			$getPAC = DB::select("SELECT
									COUNT(*) as PAC
								FROM
									(
								    SELECT
										COUNT(*)
									FROM
										m_struk_pac
									WHERE
										m_struk_pac.dijabat = 1
									GROUP BY 
										m_struk_pac.geo_kec_id
								    ) as FR");
			foreach ($getPAC as $key) {
				$pac = $key->PAC;
			}
			echo " ".$pac;

			$getPR = DB::select("SELECT
									COUNT(*) as PR
								FROM
									(
								    SELECT
										COUNT(*)
									FROM
										m_struk_pimran
									WHERE
										m_struk_pimran.dijabat = 1
									GROUP BY 
										m_struk_pimran.geo_deskel_id
								    ) as FR");
			foreach ($getPR as $key) {
				$pr = $key->PR;
			}
			echo " ".$pr;

			$getPAR = DB::select("SELECT
									COUNT(*) as PAR
								FROM
									(
								    SELECT
										COUNT(*)
									FROM
										m_struk_par
									WHERE
										m_struk_par.dijabat = 1
									GROUP BY 
										m_struk_par.geo_rw_id
								    ) as FR");
			foreach ($getPAR as $key) {
				$par = $key->PAR;
			}
			echo " ".$par;

			$getKPA = DB::select("SELECT
									COUNT(*) as KPA
								FROM
									(
								    SELECT
										COUNT(*)
									FROM
										m_struk_kpa
									WHERE
										m_struk_kpa.dijabat = 1
									GROUP BY 
										m_struk_kpa.geo_rt_id
								    ) as FR");
			foreach ($getKPA as $key) {
				$kpa = $key->KPA;
			}
			echo " ".$kpa;
		}else{
			echo "WRONG KEY!";
		}
	}
}
?>