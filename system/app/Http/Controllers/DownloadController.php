<?php namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use DB;
use Input;
use Redirect;
use Fpdf; 
use Excel;

/**
* 
*/
class DownloadController extends Controller
{
	public function downloadVerifikasi($file,$jenis='',$prov = ''){
		if($file == 'excel') {
			Excel::create('Verifikasi', function($excel) {
				$excel->sheet('Sheet 1', function($sheet) {
					/* Excel Style */
					$sheet->setAllBorders('thin');
					$sheet->setFreeze('A3');
					$sheet->getStyle('A1:R2')->getAlignment()->setWrapText(true);
					$sheet->setWidth(array(
							'A' => 5,
							'B' => 27,
							'C' => 12,
							'D' => 12,
							'E' => 29,
							'F' => 22,
							'G' => 12,
							'H' => 12,
							'I' => 12,
							'J' => 6,
							'K' => 6,
							'L' => 6,
							'M' => 12,
							'N' => 12,
							'O' => 12,
							'P' => 12,
							'Q' => 12,
							'R' => 18
						));
					/* /.Excel Style */
					
					$jenis = @$_GET['jenis'];
					$prov = @$_GET['prov'];
					$jeniss = '';
					/* if($jenis == 'all') { */
					if ($jenis == 'all') {
						$jeniss = 'DPD & NAMA DPC';
						$dataReport = DB::table('m_verifikasi')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
						->leftJoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
							->get();
					} elseif($jenis == 'DPD'){
						$jeniss = 'DPD';
						$dataReport = DB::table('m_verifikasi')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
						->leftJoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
						->where('m_verifikasi.verifikasi_tingkat','=','1')
						->get();
					} elseif($jenis == 'DPC'){
						$jeniss = 'DPC';
						$dataReport = DB::table('m_verifikasi')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
						->leftJoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
						->where('m_verifikasi.verifikasi_tingkat','=','2')
						->get();
					} elseif($jenis == 'DPD2'){
						$jeniss = 'DPD';
						$dataReport = DB::table('m_verifikasi')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
						->leftJoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
						->where('m_verifikasi.verifikasi_tingkat','=','1')
						->where('m_geo_prov_kpu.geo_prov_id','=',$prov)
						->get();
					} elseif($jenis == 'DPC2'){
						$jeniss = 'DPC';
						$dataReport = DB::table('m_verifikasi')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
						->leftJoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
						->where('m_verifikasi.verifikasi_tingkat','=','2')
						->where('m_geo_prov_kpu.geo_prov_id','=',$prov)
						->get();
					}
					/* } else {
						$dataReport = DB::table('m_pengurus')
							->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_pengurus.geo_prov_id')
								->where('m_pengurus.geo_prov_id',$jenis)
									->get();
					} */
					 $sheet->loadView('main.download.verifikasi_xls', array(
					'jeniss' => $jeniss,
					'jenis' => $jenis,
					'dataReport' => $dataReport
					));
				 });
			})->export('xls');
		} else if($file == 'pdf') {
			$jenis = @$_GET['jenis'];
			$prov = @$_GET['prov'];
			/* if($jenis == 'all') { */
			if ($jenis == 'all') {
				$dataReport = DB::table('m_verifikasi')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
					->leftJoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
						->get();
			} elseif($jenis == 'DPD'){
				$dataReport = DB::table('m_verifikasi')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
					->leftJoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
						->where('m_verifikasi.verifikasi_tingkat','=','1')
							->get();
			} elseif($jenis == 'DPC'){
				$dataReport = DB::table('m_verifikasi')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
					->leftJoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
						->where('m_verifikasi.verifikasi_tingkat','=','2')
							->get();
			} elseif($jenis == 'DPD2'){
				$dataReport = DB::table('m_verifikasi')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
					->leftJoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
						->where('m_verifikasi.verifikasi_tingkat','=','1')
						->where('m_geo_prov_kpu.geo_prov_id','=',$prov)
							->get();
			} elseif($jenis == 'DPC2'){
				$dataReport = DB::table('m_verifikasi')
					->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_verifikasi.geo_prov_id')
					->leftJoin('m_bio','m_bio.bio_id','=','m_verifikasi.verifikasi_staf_admin')
						->where('m_verifikasi.verifikasi_tingkat','=','2')
						->where('m_geo_prov_kpu.geo_prov_id','=',$prov)
							->get();
			}
							
			$pdf = new FPDF();
			/*$pdf::AliasNbPages();*/
			$pdf::AddPage();
			$pdf::SetFont('Arial', '', 10);
			$pdf::SetFont('Arial', '', 8);
			
			$pdf::SetWidths(array(10,50,40,50,36,52,30,30,20,54,30));
			$pdf::SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C'));
			$pdf::RowWithHeight(array(['NO',24],['NAMA DPD & NAMA DPC',24],['STATUS KANTOR',6],['ALAMAT KANTOR',24],['TERLETAK DI IBUKOTA',24],['KEPENGURUSAN',6],['RUANG KERJA',6],['STAF ADMIN',24],['PAPAN NAMA PARTAI',8],['GAMBAR',6],['REKENING PARTAI',24]));
			
			
			$pdf::SetY(16);
			$pdf::SetX(70);
			$pdf::MultiCell(20, 9, 'MILIK SENDIRI', 1,'C');
			
			$pdf::SetY(16);
			$pdf::SetX(90);
			$pdf::SetAligns('C');
			$pdf::MultiCell(20, 6, 'KONTRAK / PINJAM PAKAI', 1,'C');
			
			$pdf::SetY(16);
			$pdf::SetX(196);
			$pdf::SetAligns('C');
			$pdf::MultiCell(17, 6, 'KEAKTIFAN PNGURUS', 1,'C');
			
			$pdf::SetY(16);
			$pdf::SetX(213);
			$pdf::SetAligns('C');
			$pdf::MultiCell(18, 6, '30% PEREMPUAN', 1,'C');
				
			$pdf::SetY(16);
			$pdf::SetX(231);
			$pdf::SetAligns('C');
			$pdf::MultiCell(17, 9, 'JUMLAH KTA', 1,'C');
				
			$pdf::SetY(16);
			$pdf::SetX(248);
			$pdf::SetAligns('C');
			$pdf::MultiCell(10, 18, 'K', 1,'C');
				
			$pdf::SetY(16);
			$pdf::SetX(258);
			$pdf::SetAligns('C');
			$pdf::MultiCell(10, 18, 'S', 1,'C');
				
			$pdf::SetY(16);
			$pdf::SetX(268);
			$pdf::SetAligns('C');
			$pdf::MultiCell(10, 18, 'B', 1,'C');
				
			$pdf::SetY(16);
			$pdf::SetX(328);
			$pdf::SetAligns('C');
			$pdf::MultiCell(18, 6, 'PRESIDEN & WKL PRESIDEN', 1,'C');
				
			$pdf::SetY(16);
			$pdf::SetX(346);
			$pdf::SetAligns('C');
			$pdf::MultiCell(18, 18, 'GARUDA', 1,'C');
				
			$pdf::SetY(16);
			$pdf::SetX(364);
			$pdf::SetAligns('C');
			$pdf::MultiCell(18, 6, 'KETUM & SEKJEN HANURA', 1,'C');
			
			/* $pdf::SetWidths(array(7,40,15,15,30,36,10,10,10,8,8,8,15,15,10,10,10,18));
			$pdf::SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C'));
			$pdf::Row(array('','','MILIK SENDIRI','KONTRAK / PINJAM PAKAI','','','KEAKRIFAN PNGURUS','30% PEREMPUAN','JUMLAH KTA','K','S','B','','','PRESIDEN & WKL PRESIDEN','GARUDA','KETUM & SEKJEN HANURA',''));*/					
  
			$no = 1;
			$pdf::SetWidths(array(10,50,20,20,50,36,17,18,17,10,10,10,30,20,18,18,18,30));
			$pdf::SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C'));
			srand(microtime()*1000000);
			$getY = $pdf::GetY();
			
			foreach($dataReport as $tmp){
				if($tmp->verifikasi_status_kantor == '1') { 
					$statusKantor1 = 'Ya'; 
					$statusKantor0 = 'Tidak'; 
				} else if($tmp->verifikasi_status_kantor == '2') { 
					$statusKantor1 = 'Tidak';
					$statusKantor0 = 'Ya'; 
				} else {
					$statusKantor1 = '-';
					$statusKantor0 = '-'; 
				}
				$pdf::Row([
					$no++,
					$tmp->verifikasi_nama,
					$statusKantor1,
					$statusKantor0,
					($tmp->verifikasi_alamat_kantor != '')?$tmp->verifikasi_alamat_kantor:'-',
					($tmp->verifikasi_ibukota == '1')?'Ya':'Tidak',
					($tmp->verifikasi_keaktifan_pengurus == '1')?'Aktif':'T.Aktif',
					($tmp->verifikasi_perempuan == '1')?'Terpenuhi':'T.Terpenuhi',
					($tmp->verifikasi_jumlah_kta != '')?$tmp->verifikasi_jumlah_kta:'-',
					($tmp->verifikasi_ruang_kerja_k == '1')?'Ada':'T.Ada',
					($tmp->verifikasi_ruang_kerja_s == '1')?'Ada':'T.Ada',
					($tmp->verifikasi_ruang_kerja_b == '1')?'Ada':'T.Ada',
					($tmp->verifikasi_staf_admin != '')?'Ada':'T.Ada',
					($tmp->verifikasi_papan_nama == '1')?'Ada':'T.Ada',
					($tmp->verifikasi_preswapres == '1')?'Ada':'T.Ada',
					($tmp->verifikasi_garuda == '1')?'Ada':'T.Ada',
					($tmp->verifikasi_ketum_sekjen == '1')?'Ada':'T.Ada',
					($tmp->verifikasi_nomer_rekening != '')?$tmp->verifikasi_nomer_rekening:'-'
				]);
			}
			
			$pdf::Output();
			exit();
		}
	}
	
	public function downloadStatistik($file=''){
		if($file == 'excel') {
			Excel::create('REKAPITULASI-ORGANISASI', function($excel) {
				$excel->sheet('REKAP', function($sheet) {
					/* Data */
						$jenis = @$_GET['jenis'];
					/* /.Data */
					
					/* Excel Style */
						$sheet->getStyle('A1:Q1')->getAlignment()->setWrapText(true);
						$sheet->setAllBorders('thin');
						$sheet->setFreeze('A3');
						$sheet->setWidth(array(
							'A' => 6,
							'B' => 33,
							'C' => 12,
							'D' => 12,
							'E' => 12,
							'F' => 12,
							'G' => 12,
							'H' => 12,
							'I' => 12,
							'J' => 12,
							'K' => 12,
							'L' => 12,
							'M' => 12,
							'N' => 12,
							'O' => 12,
							'P' => 12,
							'Q' => 12
						));
						
						$sheet->setHeight(array(
							1     =>  50,
							37     =>  55,
							38     =>  25
						));
					/* /.Excel Style */
					
					$dataReport = DB::table('m_pengurus')
						->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_pengurus.geo_prov_id')
							->get();

					$sheet->loadView('main.download.statistik_xls', array(
						'jenis' => $jenis,	
						'dataReport' => $dataReport
					));
				 });
			})->export('xls');
		} else if($file == 'pdf') {
			$jenis = @$_GET['jenis'];
			
			$t_dpc = 0;
			$ta_dpc = 0;
			$tb_dpc = 0;
			$t_pac = 0;
			$ta_pac = 0;
			$tb_pac = 0;
			$t_ranting = 0;
			$ta_ranting = 0;
			$tb_ranting = 0;
			$t_anak_ranting = 0;
			$ta_anak_ranting = 0;
			$tb_anak_ranting = 0;
			$t_kpa = 0;
			$ta_kpa = 0;
			$tb_kpa = 0;
			
			$dataReport = DB::table('m_pengurus')
				->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_pengurus.geo_prov_id')
					->get();
							
			$pdf = new FPDF();
			$pdf::AliasNbPages();
			$pdf::AddPage('L','A4','');
			$pdf::SetFont('Arial','',20);
			$pdf::Cell(275,10,'DAFTAR STATISTIK PARTAI HANURA',0,1,'C');
			
			$pdf::ln();
			
			$pdf::SetFont('Arial', '', 8);
			$pdf::SetWidths(array(10,40,20,25,20,25,20,25,20,25,20,25));
			$pdf::SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C'));
			$pdf::RowWithHeight(array(['NO',10],['PENGURUS DPD',10],['JUMLAH KAB/KOTA',5],['PENGURUS DPC',10],['JUMLAH KECAMATAN',5],['PENGURUS PAC',10],['JUMLAH DESA/KEL',5],['PENGURUS PR',10],['JUMLAH RW/DUSUN',5],['PENGURUS PAR',10],['JUMLAH RT',10],['PENGURUS KPA',10]));
			$pdf::SetWidths(array(10,40,20,12.5,12.5,20,12.5,12.5,20,12.5,12.5,20,12.5,12.5,20,12.5,12.5));
			$pdf::SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C'));
			$pdf::Row(array('','','','TBK','B.TBK','','TBK','B.TBK','','TBK','B.TBK','','TBK','B.TBK','','TBK','B.TBK'));
					
			$no = 1;
			$pdf::SetWidths(array(10,40,20,12.5,12.5,20,12.5,12.5,20,12.5,12.5,20,12.5,12.5,20,12.5,12.5));
			$pdf::SetAligns(array('C','L','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C'));
			srand(microtime()*1000000);
			$getY = $pdf::GetY();
			foreach($dataReport as $tmp){
				$pdf::Row([
					$no++,
					strtoupper($tmp->geo_prov_nama),
					number_format($tmp->pengurus_pimcab,0, "," , "."),
					number_format($tmp->pengurus_pimcab_ada,0, "," , "."),
					number_format($tmp->pengurus_pimcab-$tmp->pengurus_pimcab_ada,0, "," , "."),
					number_format($tmp->pengurus_pac,0, "," , "."),
					number_format($tmp->pengurus_pac_ada,0, "," , "."),
					number_format($tmp->pengurus_pac-$tmp->pengurus_pac_ada,0, "," , "."),
					number_format($tmp->pengurus_ranting,0, "," , "."),
					number_format($tmp->pengurus_ranting_ada,0, "," , "."),
					number_format($tmp->pengurus_ranting-$tmp->pengurus_ranting_ada,0, "," , "."),
					number_format($tmp->pengurus_anak_ranting,0, "," , "."),
					number_format($tmp->pengurus_anak_ranting_ada,0, "," , "."),
					number_format($tmp->pengurus_anak_ranting-$tmp->pengurus_anak_ranting_ada,0, "," , "."),
					number_format($tmp->pengurus_kpa,0, "," , "."),
					number_format($tmp->pengurus_kpa-$tmp->pengurus_kpa_ada,0, "," , "."),
					number_format($tmp->pengurus_kpa_ada,0, "," , ".")
				]);
				
				$t_dpc = $t_dpc+$tmp->pengurus_pimcab;
				$ta_dpc = $ta_dpc+$tmp->pengurus_pimcab_ada;
				$tb_dpc = $tb_dpc+$tmp->pengurus_pimcab-$tmp->pengurus_pimcab_ada;
				
				$t_pac = $t_pac+$tmp->pengurus_pac;
				$ta_pac = $ta_pac+$tmp->pengurus_pac_ada;
				$tb_pac = $tb_pac+$tmp->pengurus_pac-$tmp->pengurus_pac_ada;
				
				$t_ranting = $t_ranting+$tmp->pengurus_ranting;
				$ta_ranting = $ta_ranting+$tmp->pengurus_ranting_ada;
				$tb_ranting = $tb_ranting+$tmp->pengurus_ranting-$tmp->pengurus_ranting_ada;
				
				$t_anak_ranting = $t_anak_ranting+$tmp->pengurus_anak_ranting;
				$ta_anak_ranting = $ta_anak_ranting+$tmp->pengurus_anak_ranting_ada;
				$tb_anak_ranting = $tb_anak_ranting+$tmp->pengurus_anak_ranting-$tmp->pengurus_anak_ranting_ada;
				
				$t_kpa = $t_kpa+$tmp->pengurus_kpa;
				$ta_kpa = $ta_kpa+$tmp->pengurus_kpa_ada;
				$tb_kpa = $tb_kpa+$tmp->pengurus_kpa-$tmp->pengurus_kpa_ada;
			}
			
			$pdf::SetWidths(array(10,40,20,12.5,12.5,20,12.5,12.5,20,12.5,12.5,20,12.5,12.5,20,12.5,12.5));
			$pdf::SetAligns(array('C','L','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C'));
			srand(microtime()*1000000);
			$pdf::Row([
				'',
				'',
				number_format($t_dpc,0, "," , "."),
				number_format($ta_dpc,0, "," , "."),
				number_format($tb_dpc,0, "," , "."),
				number_format($t_pac,0, "," , "."),
				number_format($ta_pac,0, "," , "."),
				number_format($tb_pac,0, "," , "."),
				number_format($t_ranting,0, "," , "."),
				number_format($ta_ranting,0, "," , "."),
				number_format($tb_ranting,0, "," , "."),
				number_format($t_anak_ranting,0, "," , "."),
				number_format($ta_anak_ranting,0, "," , "."),
				number_format($tb_anak_ranting,0, "," , "."),
				number_format($t_kpa,0, "," , "."),
				number_format($ta_kpa,0, "," , "."),
				number_format($tb_kpa,0, "," , ".")
			]);
			
			if($ta_dpc != 0 && $t_dpc != 0)	{		
				$perDPC = number_format(($ta_dpc/$t_dpc)*100,2);
			} else {
				$perDPC = 0;
			}
			if($ta_pac != 0 && $t_pac != 0)	{	
				$perPAC = number_format(($ta_pac/$t_pac)*100,2);
			} else {
				$perPAC = 0;
			}
			if($ta_ranting != 0 && $t_ranting != 0)	{		
				$perRANTING = number_format(($ta_ranting/$t_ranting)*100,2);
			} else {
				$perRANTING = 0;
			}
			if($ta_anak_ranting != 0 && $t_anak_ranting != 0) {			
				$perANAKRANTING = number_format(($ta_anak_ranting/$t_anak_ranting)*100,2);
			} else {
				$perANAKRANTING = 0;
			}
			if($ta_kpa != 0 && $t_kpa != 0)	{
				$perKPA = number_format(($ta_kpa/$t_kpa)*100,2);
			} else {
				$perKPA = 0;
			}
			
			$pdf::SetWidths(array(10,40,20,25,20,25,20,25,20,25,20,25));
			$pdf::SetAligns(array('C','L','C','C','C','C','C','C','C','C','C','C'));
			srand(microtime()*1000000);
			$pdf::Row([
				'',
				'PERSENTASE',
				'DPC',
				$perDPC.' %',
				'PAC',
				$perPAC.' %',
				'PR',
				$perRANTING.' %',
				'PAR',
				$perANAKRANTING.' %',
				'KPA',
				$perKPA.' %'
			]);
			
			$pdf::Output();
			exit();
		}		
	}

	public function print_excel_pengurus($type,$prov=null,$kab=null,$kec=null,$deskel=null,$rw=null){
		$type = $type;
		$judul = "";
		$judul .= $type;
		if($prov != ""){
			$judul .= '-'.$prov;
		}

		if($kab != ""){
			$judul .= '-'.$kab;
		}

		if($kec != ""){
			$judul .= '-'.$kec;
		}

		if($deskel != ""){
			$judul .= '-'.$deskel;
		}

		Excel::create('Data-Pengurus-'.$judul, function($excel) {
		$excel->sheet('Sheet 1', function($sheet) {	
			$sheet->setAllBorders('thin');
			$sheet->setFreeze('A2');
			$sheet->getStyle('A1:R2')->getAlignment()->setWrapText(true);
			$sheet->setWidth(array(
				'A' => 25,
				'B' => 27,
				'C' => 40,
				'D' => 34,
				'E' => 23,
				'F' => 23
			));
			$sheet->setSize('A1', 25, 20);

			$type = @$_GET['type'];
			$prov = @$_GET['prov'];
			$kab  = @$_GET['kab'];
			$kec  = @$_GET['kec'];
			$deskel = @$_GET['deskel'];
			$rw   = @$_GET['rw'];

			$join_r_bio = DB::table('m_bio')
				->select(
					'*',
					'm_bio.bio_id as bio_id',
					'm_bio.bio_nama_depan as nama',
					'm_bio.bio_telephone as no_telp',
					'm_bio.bio_jenis_kelamin as gender',
					'm_bio.bio_email as email',
					'm_bio.bio_nomer_identitas',
					'm_bio_sk.bio_sk_no as no_sk',
					'm_bio_sk.bio_sk_tgl as tgl_sk',
					'm_bio_kta.bio_kta_no as no_kta',
					'r_bio_'.$type.'.bio_'.$type.'_id as r_bio_id',
					'r_bio_'.$type.'.bio_id as idBio'
				);
				
			$join_r_bio->addselect(
				'r_bio_'.$type.'.bio_'.$type.'_sk as no_sk2',
				'r_bio_'.$type.'.bio_'.$type.'_kta as no_kta2',
				'r_bio_'.$type.'.bio_'.$type.'_tgl as turun_sk',
				'm_struk_'.$type.'.struk_'.$type.'_nama as nama_jabatan',
				'm_struk_'.$type.'.struk_'.$type.'_id as jabatan_id');
				
			$join_r_bio->join('r_bio_'.$type,'r_bio_'.$type.'.bio_id','=','m_bio.bio_id');
			$join_r_bio->leftJoin('m_bio_sk','m_bio_sk.bio_id','=','m_bio.bio_id');
			$join_r_bio->leftJoin('m_bio_kta','m_bio_kta.bio_id','=','m_bio.bio_id');
			$join_r_bio ->leftjoin('m_struk_'.$type,'m_struk_'.$type.'.struk_'.$type.'_id','=','r_bio_'.$type.'.struk_'.$type.'_id');

			
			if($type == 'dpp') {
			} else if($type == 'dpd') {
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
			} else if($type == 'dpc') {
				$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
			} else if($type == 'pac') {
				$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_'.$type.'.geo_kec_id');
				$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
			} else if($type == 'pr') {
				$join_r_bio->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','r_bio_'.$type.'.geo_deskel_id');
				$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_'.$type.'.geo_kec_id');
				$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
			} else if($type == 'par') {
				$join_r_bio->join('m_geo_rw','m_geo_rw.geo_rw_id','=','r_bio_'.$type.'.geo_rw_id');
				$join_r_bio->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','r_bio_'.$type.'.geo_deskel_id');
				$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_'.$type.'.geo_kec_id');
				$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
			} else if($type == 'kpa') {
				$join_r_bio->join('m_geo_rt','m_geo_rt.geo_rt_id','=','r_bio_'.$type.'.geo_rt_id');
				$join_r_bio->join('m_geo_rw','m_geo_rw.geo_rw_id','=','r_bio_'.$type.'.geo_rw_id');
				$join_r_bio->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','r_bio_'.$type.'.geo_deskel_id');
				$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_'.$type.'.geo_kec_id');
				$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
				$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');			
			}
			
			
			if($rw != "") {
				$join_r_bio->where('r_bio_'.$type.'.geo_rw_id','=',$rw);
			}
			
			if($deskel != "") {
				$join_r_bio->where('r_bio_'.$type.'.geo_deskel_id','=',$deskel);
			} 

			if($kec != "") {
				$join_r_bio->where('r_bio_'.$type.'.geo_kec_id','=',$kec);
				$join_r_bio->addselect('m_geo_kec_kpu.geo_kec_nama','m_geo_kec_kpu.geo_kec_id');
			} 
			
			if($kab != "") {	
				$join_r_bio->where('r_bio_'.$type.'.geo_kab_id','=',$kab);
				$join_r_bio->addselect('m_geo_kab_kpu.geo_kab_nama','m_geo_kab_kpu.geo_kab_id');
			}
			
			if($prov) {
				$join_r_bio->where('r_bio_'.$type.'.geo_prov_id','=',$prov);
				$join_r_bio->addselect('m_geo_prov_kpu.geo_prov_nama','m_geo_prov_kpu.geo_prov_id');
			}

			$dta = $join_r_bio->get();
			$masterData = [
					'dataReport' => $dta,
					'type' => $type
				];
			if($prov != ""){
				$gprov= DB::table('m_geo_prov_kpu')
					->select('geo_prov_nama','geo_prov_id')
						->where('geo_prov_id','=',$prov)
							->first();
				$masterData['g_prov'] = $gprov->geo_prov_nama;
			}else{
				$masterData['g_prov'] = "";
			}
			
			if($kab != ""){
				$gkab = DB::table('m_geo_kab_kpu')
					->select('geo_kab_nama','geo_kab_id')
						->where('geo_kab_id','=',$kab)
							->first();
				$masterData['g_kab'] = $gkab->geo_kab_nama;
			}else{
				$masterData['g_kab'] = "";
			}

			if($kec != ""){				
				$gkec = DB::table('m_geo_kec_kpu')
					->select('geo_kec_nama','geo_kec_id')
						->where('geo_kec_id','=',$kec)
							->first();
				$masterData['g_kec'] = $gkec->geo_kec_nama;
			}else{
				$masterData['g_kec'] = "";
			}
				
			if($deskel){
				$gdes = DB::table('m_geo_deskel_kpu')
					->select('geo_deskel_nama','geo_deskel_id')
						->where('geo_deskel_id','=',$deskel)
							->first();
				$masterData['g_deskel'] = $gdes->geo_deskel_nama;
			}else{
				$masterData['g_deskel'] = "";
			}
				
			if($rw){
				$grw = DB::table('m_geo_rw_kpu')
					->select('geo_rw_nama','geo_rw_id')
						->where('geo_rw_id','=',$rw)
							->first();
				$masterData['g_rw'] = $grw->geo_rw_nama;
			}else{
				$masterData['g_rw'] = "";
			}
			
				$sheet->loadView('main.download.excel.struktur_xls', $masterData);
			});
		})->export('xls');
	}

	public function print_pdf_pengurus($type,$prov=null,$kab=null,$kec=null,$deskel=null,$rw=null){
		$type = $type;
		$judul = "";
		$judul .= $type;
		if($prov != ""){
			$judul .= '-'.$prov;
		}

		if($kab != ""){
			$judul .= '-'.$kab;
		}

		if($kec != ""){
			$judul .= '-'.$kec;
		}

		if($deskel != ""){
			$judul .= '-'.$deskel;
		}

		$join_r_bio = DB::table('m_bio')
			->select(
				'*',
				'm_bio.bio_id as bio_id',
				'm_bio.bio_nama_depan as nama',
				'm_bio.bio_telephone as no_telp',
				'm_bio.bio_jenis_kelamin as gender',
				'm_bio.bio_email as email',
				'm_bio.bio_nomer_identitas',
				'm_bio_sk.bio_sk_no as no_sk',
				'm_bio_sk.bio_sk_tgl as tgl_sk',
				'm_bio_kta.bio_kta_no as no_kta',
				'r_bio_'.$type.'.bio_'.$type.'_id as r_bio_id',
				'r_bio_'.$type.'.bio_id as idBio'
			);
			
		$join_r_bio->addselect(
			'r_bio_'.$type.'.bio_'.$type.'_sk as no_sk2',
			'r_bio_'.$type.'.bio_'.$type.'_kta as no_kta2',
			'r_bio_'.$type.'.bio_'.$type.'_tgl as turun_sk',
			'm_struk_'.$type.'.struk_'.$type.'_nama as nama_jabatan',
			'm_struk_'.$type.'.struk_'.$type.'_id as jabatan_id');
			
		$join_r_bio->join('r_bio_'.$type,'r_bio_'.$type.'.bio_id','=','m_bio.bio_id');
		$join_r_bio->leftJoin('m_bio_sk','m_bio_sk.bio_id','=','m_bio.bio_id');
		$join_r_bio->leftJoin('m_bio_kta','m_bio_kta.bio_id','=','m_bio.bio_id');
		$join_r_bio ->leftjoin('m_struk_'.$type,'m_struk_'.$type.'.struk_'.$type.'_id','=','r_bio_'.$type.'.struk_'.$type.'_id');

		
		if($type == 'dpp') {
		} else if($type == 'dpd') {
			$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
		} else if($type == 'dpc') {
			$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
			$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
		} else if($type == 'pac') {
			$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_'.$type.'.geo_kec_id');
			$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
			$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
		} else if($type == 'pr') {
			$join_r_bio->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','r_bio_'.$type.'.geo_deskel_id');
			$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_'.$type.'.geo_kec_id');
			$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
			$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
		} else if($type == 'par') {
			$join_r_bio->join('m_geo_rw','m_geo_rw.geo_rw_id','=','r_bio_'.$type.'.geo_rw_id');
			$join_r_bio->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','r_bio_'.$type.'.geo_deskel_id');
			$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_'.$type.'.geo_kec_id');
			$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
			$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');
		} else if($type == 'kpa') {
			$join_r_bio->join('m_geo_rt','m_geo_rt.geo_rt_id','=','r_bio_'.$type.'.geo_rt_id');
			$join_r_bio->join('m_geo_rw','m_geo_rw.geo_rw_id','=','r_bio_'.$type.'.geo_rw_id');
			$join_r_bio->join('m_geo_deskel_kpu','m_geo_deskel_kpu.geo_deskel_id','=','r_bio_'.$type.'.geo_deskel_id');
			$join_r_bio->join('m_geo_kec_kpu','m_geo_kec_kpu.geo_kec_id','=','r_bio_'.$type.'.geo_kec_id');
			$join_r_bio->join('m_geo_kab_kpu','m_geo_kab_kpu.geo_kab_id','=','r_bio_'.$type.'.geo_kab_id');
			$join_r_bio->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','r_bio_'.$type.'.geo_prov_id');			
		}
		
		
		if($rw != "") {
			$join_r_bio->where('r_bio_'.$type.'.geo_rw_id','=',$rw);
		}
		
		if($deskel != "") {
			$join_r_bio->where('r_bio_'.$type.'.geo_deskel_id','=',$deskel);
		} 

		if($kec != "") {
			$join_r_bio->where('r_bio_'.$type.'.geo_kec_id','=',$kec);
			$join_r_bio->addselect('m_geo_kec_kpu.geo_kec_nama','m_geo_kec_kpu.geo_kec_id');
		} 
		
		if($kab != "") {	
			$join_r_bio->where('r_bio_'.$type.'.geo_kab_id','=',$kab);
			$join_r_bio->addselect('m_geo_kab_kpu.geo_kab_nama','m_geo_kab_kpu.geo_kab_id');
		}
		
		if($prov) {
			$join_r_bio->where('r_bio_'.$type.'.geo_prov_id','=',$prov);
			$join_r_bio->addselect('m_geo_prov_kpu.geo_prov_nama','m_geo_prov_kpu.geo_prov_id');
		}
		$data = $join_r_bio->get();

		/* Begin FPDF */
		$pdf = new FPDF();

		$pdf::AddPage();

		$pdf::SetFont('Arial', 'B', 20);
		$pdf::Cell(0, 0, "DATA PENGURUS ".strtoupper($type)." PARTAI HANURA", 0, "C");
		$pdf::Ln(10);

		$pdf::SetFont('Arial', 'B', 18);

		if($prov != ""){
			$gprov= DB::table('m_geo_prov_kpu')
				->select('geo_prov_nama','geo_prov_id')
					->where('geo_prov_id','=',$prov)
						->first();
			$pdf::Cell(52, 0, "Provinsi");
			$pdf::Cell(10, 0, " : ");
			$pdf::Cell(45, 0, $gprov->geo_prov_nama);
			$pdf::Ln(7);
		}
		
		if($kab != ""){
			$gkab = DB::table('m_geo_kab_kpu')
				->select('geo_kab_nama','geo_kab_id')
					->where('geo_kab_id','=',$kab)
						->first();
			$pdf::Cell(52, 0, "Kota/Kabupaten");
			$pdf::Cell(10, 0, " : ");
			$pdf::Cell(45, 0, $gkab->geo_kab_nama);
			$pdf::Ln(7);
		}

		if($kec != ""){				
			$gkec = DB::table('m_geo_kec_kpu')
				->select('geo_kec_nama','geo_kec_id')
					->where('geo_kec_id','=',$kec)
						->first();
			$pdf::Cell(52, 0, "Kecamatan");
			$pdf::Cell(10, 0, " : ");
			$pdf::Cell(45, 0, $gkec->geo_kec_nama);
			$pdf::Ln(7);
		}
			
		if($deskel != ""){
			$gdes = DB::table('m_geo_deskel_kpu')
				->select('geo_deskel_nama','geo_deskel_id')
					->where('geo_deskel_id','=',$deskel)
						->first();
			$pdf::Cell(52, 0, "Desa/Kelurahan");
			$pdf::Cell(10, 0, " : ");
			$pdf::Cell(45, 0, $gdes->geo_deskel_nama);
			$pdf::Ln(7);
		}
		$pdf::SetFont('Arial', 'B', 16);
		$pdf::Ln(8);
		$pdf::Cell(18, 8, "No", 1, 0, "C");
		$pdf::Cell(90, 8, "Nama", 1, 0, "C");
		$pdf::Cell(45, 8, "Jabatan", 1, 0, "C");
		$pdf::Cell(100, 8, "No. SK", 1, 0, "C");
		$pdf::Cell(73, 8, "No. KTA", 1, 0, "C");
		$pdf::Cell(73, 8, "No. KTP", 1, 0, "C");
		$pdf::Ln();

		$pdf::SetFont('Arial', '', 16);
		$no = 1;
		foreach ($data as $get) {
			$pdf::Cell(18, 8, $no++, 1, 0, "C");
			$pdf::Cell(90, 8, $get->nama?:'-', 1, 0, "L");
			$pdf::Cell(45, 8, ucwords(strtolower(isset($get->nama_jabatan)?$get->nama_jabatan:'-'))?:'-', 1, 0, "L");
			$pdf::Cell(100, 8, $get->no_sk2?:'-', 1, 0, "C");
			$pdf::Cell(73, 8, $get->no_kta2?str_replace('.', '', $get->no_kta2):'-', 1, 0, "C");
			$pdf::Cell(73, 8, $get->bio_nomer_identitas?"'".$get->bio_nomer_identitas:'-', 1, 0, "C");
			$pdf::Ln();
		}

		$pdf::Output();
		exit();
	}
	
}