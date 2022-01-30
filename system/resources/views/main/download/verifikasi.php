<?php
ini_set('display_errors',1);
//echo ini_get('display_errors');
/* $koneksi = mysqli_connect("localhost","fatchur","Fatchur12345","tbb_live"); */
$koneksi = mysqli_connect("localhost","root","","sipol_2");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
ini_set('include_path',ini_get('include_path').';../Classes/');

/** PHPExcel */
include 'PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
/* $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes."); */

function setHeightCell($row,$height){
    global $objPHPExcel;
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight($height);
}

function setWidthCell($colom,$width){
    global $objPHPExcel;
	$objPHPExcel->getActiveSheet()->getColumnDimension($colom)->setWidth($width);
}
function mergeCell($start,$finish){	
    global $objPHPExcel;
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells($start.':'.$finish);
}
function border($colom){
    global $objPHPExcel;
	$styleArray = array(
	  'borders' => array(
		'outline' => array(
		  'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	  )
	);
	$objPHPExcel->getActiveSheet()->getStyle($colom)->applyFromArray($styleArray);
}

function cellColor($cells,$color){
    global $objPHPExcel;
	$objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}

function textColor($cells,$color,$size = 11, $bold = false, $align = 'left'){
    global $objPHPExcel;
	if($align == 'left'){
		$alinge = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
		$jenisAlign = 'horizontal';
	} else if($align == 'center') {
		$alinge = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
		$jenisAlign = 'horizontal';
	} else if($align == 'right') {
		$alinge = PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
		$jenisAlign = 'horizontal';
	} else if($align == 'top') {
		$alinge = PHPExcel_Style_Alignment::VERTICAL_TOP;
		$jenisAlign = 'vertical';
	} else if($align == 'bottom') {
		$alinge = PHPExcel_Style_Alignment::VERTICAL_BOTTOM;
		$jenisAlign = 'vertical';
	} else if($align == 'middle') {
		$alinge = PHPExcel_Style_Alignment::VERTICAL_CENTER;
		$jenisAlign = 'vertical';
	} else {
	}
	$styleArray = array(
		'font'  => array(
			'bold'  => $bold,
			'color' => array('rgb' => $color),
			'size'  => $size
        ),
        'alignment' => array(
            $jenisAlign => $alinge,
		)
	);	
	$objPHPExcel->getActiveSheet()->getStyle($cells)->applyFromArray($styleArray);
}

function setTextCell($cell,$text){
    global $objPHPExcel;
	$objPHPExcel->getActiveSheet()->SetCellValue($cell,$text);
}

$jenis = @$_GET['jenis'];
$prov = @$_GET['prov'];
if($jenis == 'all'){
	$dataVerifikasiSQL = "SELECT * FROM m_verifikasi JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = m_verifikasi.geo_prov_id";
} elseif($jenis == 'DPD'){
	$dataVerifikasiSQL = "SELECT * FROM m_verifikasi JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = m_verifikasi.geo_prov_id WHERE m_verifikasi.verifikasi_tingkat ='1' ";
} elseif($jenis == 'DPC'){
	$dataVerifikasiSQL = "SELECT * FROM m_verifikasi JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = m_verifikasi.geo_prov_id WHERE m_verifikasi.verifikasi_tingkat ='2' ";
} elseif($jenis == 'DPD2'){
	$dataVerifikasiSQL = "SELECT * FROM m_verifikasi JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = m_verifikasi.geo_prov_id WHERE m_verifikasi.verifikasi_tingkat ='1' AND m_geo_prov_kpu.geo_prov_id = '".$prov."'";
} elseif($jenis == 'DPC2'){
	$dataVerifikasiSQL = "SELECT * FROM m_verifikasi JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = m_verifikasi.geo_prov_id WHERE m_verifikasi.verifikasi_tingkat ='2' AND m_geo_prov_kpu.geo_prov_id = '".$prov."'";
} else {
	$dataVerifikasiSQL = "SELECT * FROM m_verifikasi JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = m_verifikasi.geo_prov_id WHERE m_verifikasi.geo_prov_id = '".$jenis."'";
}
$dataVerifikasi = mysqli_query($koneksi,$dataVerifikasiSQL) or die(mysqli_error($koneksi));


/* CELL SIZE */	
	setWidthCell('A',5);
	setWidthCell('B',27);
	setWidthCell('C',12);
	setWidthCell('D',12);
	setWidthCell('E',29);
	setWidthCell('F',22);
	setWidthCell('G',12);
	setWidthCell('H',12);
	setWidthCell('I',12);
	setWidthCell('J',6);
	setWidthCell('K',6);
	setWidthCell('L',6);
	setWidthCell('M',12);
	setWidthCell('N',12);
	setWidthCell('O',12);
	setWidthCell('P',12);
	setWidthCell('Q',12);
	setWidthCell('R',18);

	mergeCell('A1','A2');
	mergeCell('B1','B2');
	mergeCell('C1','D1');
	mergeCell('E1','E2');
	mergeCell('F1','F2');
	mergeCell('G1','I1');
	mergeCell('J1','L1');
	mergeCell('M1','M2');
	mergeCell('N1','N2');
	mergeCell('O1','Q1');
	mergeCell('R1','R2');
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:R1')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2:R2')->getAlignment()->setWrapText(true);
/* /.CELL SIZE */

/* CELL COLOR */
	/*cellColor('A1', '000000');
	cellColor('B1', 'FF6600');
	cellColor('C1', '000000');
	cellColor('D1:E1', 'FF6600');
	cellColor('F1', '000000');
	cellColor('G1:H1', 'FF6600');
	cellColor('I1', '000000');
	cellColor('J1:K1', 'FF6600');
	cellColor('L1', '000000');
	cellColor('M1:N1', 'FF6600');
	cellColor('O1', '000000');
	cellColor('P1:Q1', 'FF6600');

	cellColor('A2', 'FF6600');
	cellColor('B2', '000000');
	cellColor('C2', 'FF9900');
	cellColor('D2', '000000');
	cellColor('E2', 'FF0000');
	cellColor('F2', 'FF9900');
	cellColor('G2', '000000');
	cellColor('H2', 'FF0000');
	cellColor('I2', 'FF9900');
	cellColor('J2', '000000');
	cellColor('K2', 'FF0000');
	cellColor('L2', 'FF9900');
	cellColor('M2', '000000');
	cellColor('N2', 'FF0000');
	cellColor('O2', 'FF9900');
	cellColor('P2', '000000');
	cellColor('Q2', 'FF0000');*/
/* /.CELL COLOR */
	
/* TEXT COLOR */
	textColor('A1', '000000','12',false,'center');
	textColor('B1', '000000','12',false,'center');
	textColor('C1', '000000','12',false,'center');
	textColor('D1', '000000','12',false,'center');
	textColor('E1', '000000','12',false,'center');
	textColor('F1', '000000','12',false,'center');
	textColor('G1', '000000','12',false,'center');
	textColor('I1', '000000','12',false,'center');
	textColor('J1', '000000','12',false,'center');
	textColor('L1', '000000','12',false,'center');
	textColor('M1', '000000','12',false,'center');
	textColor('N1', '000000','12',false,'center');
	textColor('O1', '000000','12',false,'center');
	textColor('P1', '000000','12',false,'center');
	textColor('Q1', '000000','12',false,'center');
	textColor('R1', '000000','12',false,'center');
	textColor('A1', '000000','12',false,'middle');
	textColor('B1', '000000','12',false,'middle');
	textColor('C1', '000000','12',false,'middle');
	textColor('D1', '000000','12',false,'middle');
	textColor('E1', '000000','12',false,'middle');
	textColor('F1', '000000','12',false,'middle');
	textColor('G1', '000000','12',false,'middle');
	textColor('I1', '000000','12',false,'middle');
	textColor('J1', '000000','12',false,'middle');
	textColor('L1', '000000','12',false,'middle');
	textColor('M1', '000000','12',false,'middle');
	textColor('N1', '000000','12',false,'middle');
	textColor('O1', '000000','12',false,'middle');
	textColor('P1', '000000','12',false,'middle');
	textColor('Q1', '000000','12',false,'middle');
	textColor('R1', '000000','12',false,'middle');

	textColor('C', '000000','12',false,'center');
	textColor('D', '000000','12',false,'center');
	textColor('G', '000000','12',false,'center');
	textColor('H', '000000','12',false,'center');
	textColor('I', '000000','12',false,'center');
	textColor('J', '000000','12',false,'center');
	textColor('K', '000000','12',false,'center');
	textColor('L', '000000','12',false,'center');
	textColor('O', '000000','12',false,'center');
	textColor('P', '000000','12',false,'center');
	textColor('Q', '000000','12',false,'center');


	textColor('C2', '000000','12',false,'center');
	textColor('D2', '000000','12',false,'center');
	textColor('G2', '000000','12',false,'center');
	textColor('H2', '000000','12',false,'center');
	textColor('I2', '000000','12',false,'center');
	textColor('J2', '000000','12',false,'center');
	textColor('K2', '000000','12',false,'center');
	textColor('L2', '000000','12',false,'center');
	textColor('O2', '000000','12',false,'center');
	textColor('P2', '000000','12',false,'center');
	textColor('Q2', '000000','12',false,'center');
	textColor('C2', '000000','12',false,'middle');
	textColor('D2', '000000','12',false,'middle');
	textColor('G2', '000000','12',false,'middle');
	textColor('H2', '000000','12',false,'middle');
	textColor('I2', '000000','12',false,'middle');
	textColor('J2', '000000','12',false,'middle');
	textColor('K2', '000000','12',false,'middle');
	textColor('L2', '000000','12',false,'middle');
	textColor('O2', '000000','12',false,'middle');
	textColor('P2', '000000','12',false,'middle');
	textColor('Q2', '000000','12',false,'middle');

/* /.TEXT COLOR */
	
	
/* TEXT CELL */
	setTextCell('A1','NO');
	setTextCell('B1','NAMA DPD & NAMA DPC');
	setTextCell('C1','STATUS KANTOR');
	setTextCell('C2','MILIK SENDIRI');
	setTextCell('D2','KONTRAK / PINJAM PAKAI');
	setTextCell('E1','ALAMAT KANTOR');
	setTextCell('F1','TERLETAK DI IBUKOTA');
	setTextCell('G1','KEPENGURUSAN');
	setTextCell('G2','KEAKTIFAN PENGURUS');
	setTextCell('H2','30% PEREMPUAN');
	setTextCell('I2','JUMLAH KTA');
	setTextCell('J1','RUANG KERJA');
	setTextCell('J2','K');
	setTextCell('K2','S');
	setTextCell('L2','B');
	setTextCell('M1','STAF ADMIN');
	setTextCell('N1','PAPAN NAMA PARTAI');
	setTextCell('O1','GAMBAR');
	setTextCell('O2','PRESIDEN & WKL PRESIDEN');
	setTextCell('P2','GARUDA');
	setTextCell('Q2','KETUM & SEKJEN HANURA');
	setTextCell('R1','REKENING PARTAI');
/* /.TEXT CELL */

/* Data */
	$no = 1;
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
	while($tmp = mysqli_fetch_object($dataVerifikasi)){
		$awal = 2;
		$nextLine = $awal+$no;
	
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$nextLine, $no);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$nextLine, strtoupper($tmp->verifikasi_nama));
		if($tmp->verifikasi_status_kantor == 1){
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$nextLine, 'OK');
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$nextLine, '-');
		} elseif($tmp->verifikasi_status_kantor == 0) {
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$nextLine, '-');
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$nextLine, 'OK');
		} else{
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$nextLine, '-');
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$nextLine, '-');
		}
		if ($tmp->verifikasi_alamat_kantor != '') {
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$nextLine, $tmp->verifikasi_alamat_kantor);
		}else{
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$nextLine, '-');
		}
		if ($tmp->verifikasi_alamat_kantor != '') {
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$nextLine, strtoupper($tmp->verifikasi_ibukota));
		}else{
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$nextLine, '-');
		}
		
		if($tmp->verifikasi_keaktifan_pengurus == 1){
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$nextLine, 'OK');
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$nextLine, '-');
		}
		if($tmp->verifikasi_perempuan == 1){
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$nextLine, 'OK');
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$nextLine, '-');
		}
		if($tmp->verifikasi_jumlah_kta != ''){
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$nextLine, $tmp->verifikasi_jumlah_kta);
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$nextLine,'-');
		}
		
		$no++;	
		if($tmp->verifikasi_ruang_kerja == 'k'){
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$nextLine, 'OK');
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$nextLine, '-');
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$nextLine, '-');
		} elseif($tmp->verifikasi_ruang_kerja == 's'){
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$nextLine, '-');
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$nextLine, 'OK');
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$nextLine, '-');
		} elseif($tmp->verifikasi_ruang_kerja == 'b'){
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$nextLine, '-');
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$nextLine, '-');
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$nextLine, 'OK');
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$nextLine, '-');
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$nextLine, '-');
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$nextLine, '-');
		}
		if($tmp->verifikasi_staf_admin != ''){
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$nextLine, $tmp->verifikasi_staf_admin);
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$nextLine, '-');
		}

		if($tmp->verifikasi_papan_nama == 1){
			$objPHPExcel->getActiveSheet()->SetCellValue('N'.$nextLine, 'OK');
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue('N'.$nextLine, '-');
		}
		if($tmp->verifikasi_preswapres == 1){
			$objPHPExcel->getActiveSheet()->SetCellValue('O'.$nextLine, 'OK');
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue('O'.$nextLine, '-');
		}
		if($tmp->verifikasi_garuda == 1){
			$objPHPExcel->getActiveSheet()->SetCellValue('P'.$nextLine, 'OK');
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue('P'.$nextLine, '-');
		}
		if($tmp->verifikasi_ketum_sekjen == 1){
			$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$nextLine, 'OK');
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$nextLine, '-');
		}
		if($tmp->verifikasi_nomer_rekening != ''){
			$objPHPExcel->getActiveSheet()->SetCellValue('R'.$nextLine, $tmp->verifikasi_nomer_rekening);	
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue('R'.$nextLine, '-');	
		}
	}


	/* /.Border */
	
/* /.DATA */
$namaExcel = 'VERIFIKASI';
$namaSheet = 'REKAP';
$objPHPExcel->getActiveSheet()->setTitle(str_replace('/','_',@$namaSheet));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.str_replace('/','_',$namaExcel).'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
?>
