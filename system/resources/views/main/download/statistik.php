<?php
ini_set('display_errors',1);
//echo ini_get('display_errors');
/* $koneksi = mysqli_connect("localhost","fatchur","Fatchur12345","tbb_live"); */
//$koneksi = mysqli_connect("localhost","hanura","hanura123","sipol");
$koneksi = mysqli_connect("localhost","root"," ","sipol_2");

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
if($jenis == 'all'){
	$dataStatistikSQL = "SELECT * FROM m_pengurus JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = m_pengurus.geo_prov_id";
} else {
	$dataStatistikSQL = "SELECT * FROM m_pengurus JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = m_pengurus.geo_prov_id WHERE m_pengurus.geo_prov_id = '".$jenis."'";
}
$dataStatistik = mysqli_query($koneksi,$dataStatistikSQL) or die(mysqli_error($koneksi));


/* CELL SIZE */	
	setWidthCell('A',6);
	setWidthCell('B',33);
	setWidthCell('C',12);
	setWidthCell('D',12);
	setWidthCell('E',12);
	setWidthCell('F',12);
	setWidthCell('G',12);
	setWidthCell('H',12);
	setWidthCell('I',12);
	setWidthCell('J',12);
	setWidthCell('K',12);
	setWidthCell('L',12);
	setWidthCell('M',12);
	setWidthCell('N',12);
	setWidthCell('O',12);
	setWidthCell('P',12);
	setWidthCell('Q',12);
	
	mergeCell('D1','E1');	
	mergeCell('G1','H1');	
	mergeCell('J1','K1');	
	mergeCell('M1','N1');	
	mergeCell('P1','Q1');	
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setWrapText(true);
/* /.CELL SIZE */

/* CELL COLOR */
	cellColor('A1', '000000');
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
	cellColor('Q2', 'FF0000');
/* /.CELL COLOR */
	
/* TEXT COLOR */
	textColor('A1', 'FFFFFF','12',false,'center');
	textColor('B1', '000000','12',false,'center');
	textColor('C1', 'FFFFFF','12',false,'center');
	textColor('D1', '000000','12',false,'center');
	textColor('F1', 'FFFFFF','12',false,'center');
	textColor('G1', '000000','12',false,'center');
	textColor('I1', 'FFFFFF','12',false,'center');
	textColor('J1', '000000','12',false,'center');
	textColor('L1', 'FFFFFF','12',false,'center');
	textColor('M1', '000000','12',false,'center');
	textColor('O1', 'FFFFFF','12',false,'center');
	textColor('P1', '000000','12',false,'center');
	textColor('A1', 'FFFFFF','12',false,'middle');
	textColor('B1', '000000','12',false,'middle');
	textColor('C1', 'FFFFFF','12',false,'middle');
	textColor('D1', '000000','12',false,'middle');
	textColor('F1', 'FFFFFF','12',false,'middle');
	textColor('G1', '000000','12',false,'middle');
	textColor('I1', 'FFFFFF','12',false,'middle');
	textColor('J1', '000000','12',false,'middle');
	textColor('L1', 'FFFFFF','12',false,'middle');
	textColor('M1', '000000','12',false,'middle');
	textColor('O1', 'FFFFFF','12',false,'middle');
	textColor('P1', '000000','12',false,'middle');

	textColor('D2', 'FFFFFF','12',false,'center');
	textColor('E2', '000000','12',false,'center');
	textColor('G2', 'FFFFFF','12',false,'center');
	textColor('H2', '000000','12',false,'center');
	textColor('J2', 'FFFFFF','12',false,'center');
	textColor('K2', '000000','12',false,'center');
	textColor('M2', 'FFFFFF','12',false,'center');
	textColor('N2', '000000','12',false,'center');
	textColor('P2', 'FFFFFF','12',false,'center');
	textColor('Q2', '000000','12',false,'center');
/* /.TEXT COLOR */
	
	
/* TEXT CELL */
	setTextCell('A1','NO');
	setTextCell('B1','PENGURUS DPD');
	setTextCell('C1','JUMLAH KAB/KOTA');
	setTextCell('D1','PENGURUS DPC');
	setTextCell('F1','JUMLAH KECAMATAN');
	setTextCell('G1','PENGURUS PAC');
	setTextCell('I1','JUMLAH DESA/KEL');
	setTextCell('J1','PENGURUS RANTING');
	setTextCell('L1','JUMLAH RW/DUSUN');
	setTextCell('M1','PENGURUS ANAK RANTING');
	setTextCell('O1','JUMLAH RT');
	setTextCell('P1','PENGURUS KPA');
	setTextCell('D2','TBK');
	setTextCell('E2','B.TBK');
	setTextCell('G2','TBK');
	setTextCell('H2','B.TBK');
	setTextCell('J2','TBK');
	setTextCell('K2','B.TBK');
	setTextCell('M2','TBK');
	setTextCell('N2','B.TBK');
	setTextCell('P2','TBK');
	setTextCell('Q2','B.TBK');
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
	while($tmp = mysqli_fetch_object($dataStatistik)){
		$awal = 2;
		$nextLine = $awal+$no;
	
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$nextLine, $no);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$nextLine, strtoupper($tmp->geo_prov_nama));
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$nextLine, number_format($tmp->pengurus_pimcab,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$nextLine, number_format($tmp->pengurus_pimcab_ada,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$nextLine, number_format($tmp->pengurus_pimcab-$tmp->pengurus_pimcab_ada,0, "," , "."));
		if($tmp->pengurus_pimcab_ada == 0){
			textColor('D'.$nextLine, 'FF0000','12',true,'center');
		}
		
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$nextLine, number_format($tmp->pengurus_pac,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$nextLine, number_format($tmp->pengurus_pac_ada,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$nextLine, number_format($tmp->pengurus_pac-$tmp->pengurus_pac_ada,0, "," , "."));
		if($tmp->pengurus_pac_ada == 0){
			textColor('G'.$nextLine, 'FF0000','12',true,'center');
		}
		
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$nextLine, number_format($tmp->pengurus_ranting,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$nextLine, number_format($tmp->pengurus_ranting_ada,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$nextLine, number_format($tmp->pengurus_ranting-$tmp->pengurus_ranting_ada,0, "," , "."));
		if($tmp->pengurus_ranting_ada == 0){
			textColor('J'.$nextLine, 'FF0000','12',true,'center');
		}
		
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$nextLine, number_format($tmp->pengurus_anak_ranting,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('M'.$nextLine, number_format($tmp->pengurus_anak_ranting_ada,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('N'.$nextLine, number_format($tmp->pengurus_anak_ranting-$tmp->pengurus_anak_ranting_ada,0, "," , "."));
		if($tmp->pengurus_anak_ranting_ada == 0){
			textColor('M'.$nextLine, 'FF0000','12',true,'center');
		}
		
		$objPHPExcel->getActiveSheet()->SetCellValue('O'.$nextLine, number_format($tmp->pengurus_kpa,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('P'.$nextLine, number_format($tmp->pengurus_kpa_ada,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$nextLine, number_format($tmp->pengurus_kpa-$tmp->pengurus_kpa_ada,0, "," , "."));
		if($tmp->pengurus_kpa_ada == 0){
			textColor('P'.$nextLine, 'FF0000','12',true,'center');
		}

		$objPHPExcel->getActiveSheet()->getStyle('B'.$nextLine)->getAlignment()->setWrapText(true);
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
		$no++;		
	}
	cellColor('A'.($awal+1).':A'.$nextLine, 'FF6600');
	cellColor('B'.($awal+1).':B'.$nextLine, '000000');
	cellColor('C'.($awal+1).':C'.$nextLine, 'FF9900');
	cellColor('F'.($awal+1).':F'.$nextLine, 'FF9900');
	cellColor('I'.($awal+1).':I'.$nextLine, 'FF9900');
	cellColor('L'.($awal+1).':L'.$nextLine, 'FF9900');
	cellColor('O'.($awal+1).':O'.$nextLine, 'FF9900');
	
	textColor('A'.($awal+1).':A'.$nextLine, 'FFFFFF','12',false,'center');
	textColor('B'.($awal+1).':B'.$nextLine, 'FFFFFF','12',false,'left');
	textColor('C'.($awal+1).':C'.$nextLine, '000000','12',false,'center');
	textColor('D'.($awal+1).':D'.$nextLine, '000000','12',false,'center');
	textColor('E'.($awal+1).':E'.$nextLine, 'FF0000','12',false,'center');
	textColor('F'.($awal+1).':F'.$nextLine, '000000','12',false,'center');
	textColor('G'.($awal+1).':G'.$nextLine, '000000','12',false,'center');
	textColor('H'.($awal+1).':H'.$nextLine, 'FF0000','12',false,'center');
	textColor('I'.($awal+1).':I'.$nextLine, '000000','12',false,'center');
	textColor('J'.($awal+1).':J'.$nextLine, '000000','12',false,'center');
	textColor('K'.($awal+1).':K'.$nextLine, 'FF0000','12',false,'center');
	textColor('L'.($awal+1).':L'.$nextLine, '000000','12',false,'center');
	textColor('M'.($awal+1).':M'.$nextLine, '000000','12',false,'center');
	textColor('N'.($awal+1).':N'.$nextLine, 'FF0000','12',false,'center');
	textColor('O'.($awal+1).':O'.$nextLine, '000000','12',false,'center');
	textColor('P'.($awal+1).':P'.$nextLine, '000000','12',false,'center');
	textColor('Q'.($awal+1).':Q'.$nextLine, 'FF0000','12',false,'center');
	
	/* Total */
		$total = $nextLine+1;
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$total, number_format($t_dpc,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$total, number_format($ta_dpc,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$total, number_format($tb_dpc,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$total, number_format($t_pac,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$total, number_format($ta_pac,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$total, number_format($tb_pac,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$total, number_format($t_ranting,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$total, number_format($ta_ranting,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$total, number_format($tb_ranting,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$total, number_format($t_anak_ranting,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('M'.$total, number_format($ta_anak_ranting,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('N'.$total, number_format($tb_anak_ranting,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('O'.$total, number_format($t_kpa,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('P'.$total, number_format($ta_kpa,0, "," , "."));
		$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$total, number_format($tb_kpa,0, "," , "."));
		
		cellColor('A'.$total.':Q'.$total, '000000');
		textColor('A'.$total.':Q'.$total, 'FFFFFF','12',false,'center');
		textColor('A'.$total.':Q'.$total, 'FFFFFF','12',false,'middle');
	/* /.Total */
	
	/* Persentase */
		$persentase = $nextLine+2;
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$persentase,'PERSENTASE');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$persentase,'DPC');
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$persentase,'PAC');
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$persentase,'RANTING');
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$persentase,'ANAK RANTING');
		$objPHPExcel->getActiveSheet()->SetCellValue('O'.$persentase,'KPA');
	
		mergeCell('D'.$persentase,'E'.$persentase);	
		mergeCell('G'.$persentase,'H'.$persentase);	
		mergeCell('J'.$persentase,'K'.$persentase);	
		mergeCell('M'.$persentase,'N'.$persentase);	
		mergeCell('P'.$persentase,'Q'.$persentase);	
		
		if($ta_dpc != 0 && $t_dpc != 0){			
			$perDPC = number_format(($ta_dpc/$t_dpc)*100,2);
		} else {
			$perDPC = 0;
		}
		if($ta_pac != 0 && $t_pac != 0){			
			$perPAC = number_format(($ta_pac/$t_pac)*100,2);
		} else {
			$perPAC = 0;
		}
		if($ta_ranting != 0 && $t_ranting != 0){			
			$perRANTING = number_format(($ta_ranting/$t_ranting)*100,2);
		} else {
			$perRANTING = 0;
		}
		if($ta_anak_ranting != 0 && $t_anak_ranting != 0){			
			$perANAKRANTING = number_format(($ta_anak_ranting/$t_anak_ranting)*100,2);
		} else {
			$perANAKRANTING = 0;
		}
		if($ta_kpa != 0 && $t_kpa != 0){			
			$perKPA = number_format(($ta_kpa/$t_kpa)*100,2);
		} else {
			$perKPA = 0;
		}
		
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$persentase,$perDPC.'%');
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$persentase,$perPAC.'%');
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$persentase,$perRANTING.'%');
		$objPHPExcel->getActiveSheet()->SetCellValue('M'.$persentase,$perANAKRANTING.'%');
		$objPHPExcel->getActiveSheet()->SetCellValue('P'.$persentase,$perKPA.'%');
		
		$objPHPExcel->getActiveSheet()->getRowDimension($total)->setRowHeight(55);
		$objPHPExcel->getActiveSheet()->getRowDimension($persentase)->setRowHeight(25);
		$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(50);
		cellColor('A'.$persentase.':Q'.$persentase, 'FFC000');
		textColor('A'.$persentase.':Q'.$persentase, '000000','12',true,'center');
		textColor('A'.$persentase.':Q'.$persentase, '000000','12',true,'middle');
	/* /.Persentase */
	/* Border */
		for($a=1;$a<=$nextLine;$a++){
			border('A'.$a);
			border('B'.$a);
			border('C'.$a);
			border('D'.$a);
			border('E'.$a);
			border('F'.$a);
			border('G'.$a);
			border('H'.$a);
			border('I'.$a);
			border('J'.$a);
			border('K'.$a);
			border('L'.$a);
			border('M'.$a);
			border('N'.$a);
			border('O'.$a);
			border('P'.$a);
			border('Q'.$a);
		}
	/* /.Border */
	
/* /.DATA */
$namaExcel = 'REKAPITULASI-ORGANISASI';
$namaSheet = 'REKAP';
$objPHPExcel->getActiveSheet()->setTitle(str_replace('/','_',@$namaSheet));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.str_replace('/','_',$namaExcel).'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
?>
