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
					/* } else {
						$dataReport = DB::table('m_pengurus')
							->join('m_geo_prov_kpu','m_geo_prov_kpu.geo_prov_id','=','m_pengurus.geo_prov_id')
								->where('m_pengurus.geo_prov_id',$jenis)
									->get();
					} */
					 $sheet->loadView('main.download.verifikasi_xls', array(
					'jenis' => $jenis,
					'dataReport' => $dataReport
					));
				 });
			})->export('xlsx');
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
			$pdf::AliasNbPages();
			$pdf::AddPage('L','A3','');
			$pdf::SetFont('Arial','',10);

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
					($tmp->verifikasi_ibukota != '')?$tmp->verifikasi_ibukota:'-',
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
			})->export('xlsx');
		} else if($file == 'pdf') {
			$jenis = @$_GET['jenis'];
			
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
			}
			
			$pdf::Output();
			exit();
		}		
	}
	
}