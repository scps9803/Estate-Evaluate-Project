<?php
// require_once 'classes/PHPExcel.php';
// require_once 'classes/PHPExcel/Writer/Excel5.php';
// $objPHPExcel  = new PHPExcel();
// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//
// $text = "=(100+200*3*0.5)+(5*28*0.853+17*56.89)";
// $calAreaTool = "tools/calAreaText.xls";
// $objPHPExcel = PHPExcel_IOFactory::load($calAreaTool);
// $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A1', $text);
//
// $objActSheet = $objPHPExcel->getActiveSheet();
// $objActSheet->setTitle('default');
// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// $objWriter->save('tools/calAreaText.xls');
//
// $objPHPExcel = PHPExcel_IOFactory::load($calAreaTool);
// $area = $objPHPExcel->getActiveSheet()->getCell('A1')->getCalculatedValue();
//
// echo number_format($area,2,".",",");
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$smarty->display("sub_building.html");
?>
