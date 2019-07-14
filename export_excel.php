<?php
include "library.php";
// $script_number = $_POST['script_number'];
// $house_address = $_POST["house_address"];
// $data = getRecordData($house_address);
$script_number = "建合001";
$owner_data = getOwnerData("建國二路100號");
$building_data = getBuildingData('建國二路100號');
$land_data = getLandData('建國二路100號');
$resident_data = getResidentData('建國二路100號');

// echo count($owner_data);
// echo $owner_data[0]["name"];
// echo $owner_data[1]["name"];

error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br>');
date_default_timezone_set('Europe/London');

require_once '/classes/PHPExcel.php';
require_once '/classes/PHPExcel/Writer/Excel5.php';
$objPHPExcel  = new PHPExcel();

// 自行建立的 Excel 版型檔名
$excelTemplate = './excel_templates/template1.xls';

// 判斷 Excel 檔案是否存在
if (!file_exists($excelTemplate)) {
exit('Please run template.php first.' . EOL);
}

// 載入 Excel
$objPHPExcel = PHPExcel_IOFactory::load($excelTemplate);

// $objPHPExcel->setActiveSheetIndex(0)             //設定第一個內建表（一個xls檔案裡可以有多個表）為活動的
//             ->setCellValue( 'A1', 'Hello' )         //給表的單元格設定資料
//             ->setCellValue( 'B2', 'world!' )      //資料格式可以為字串
//             ->setCellValue( 'C1', 12)            //數字型
//             ->setCellValue( 'D2', 12)            //
//             ->setCellValue( 'D3', true )           //布林型
//             ->setCellValue( 'D4', '=SUM(C1:D2)' );//公式

if(count($owner_data)>1){
    $text = '等'.count($owner_data).'人';
}
else{
    $text = "";
}

$phone = $owner_data[0]["cellphone"];
if($owner_data[0]["cellphone"] == ""){
    $phone = $owner_data[0]["telephone"];
}
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'AH3', $script_number )
            ->setCellValue( 'C4', $owner_data[0]["name"].$text)
            ->setCellValue( 'G4', $owner_data[0]["pId"])
            ->setCellValue( 'L4', $owner_data[0]["current_address"])
            ->setCellValue( 'X4', $phone)
            ->setCellValue( 'AE4', $building_data[0]["legal_status"])
            ->setCellValue( 'AE5', $building_data[0]["legal_certificate"])
            ->setCellValue( 'AE7', $building_data[0]["remove_condition"])
            ->setCellValue( 'C6', $building_data[0]["address"])
            ->setCellValue( 'O6', $building_data[0]["build_number"]."\n".$building_data[0]["tax_number"])
            ->setCellValue( 'C7', '桃園市')
            // 行政區尚未設定
            ->setCellValue( 'E7', '')
            ->setCellValue( 'G7', $land_data[0]['land_section'])
            ->setCellValue( 'K7', $land_data[0]['land_number'])
            ->setCellValue( 'X7', $land_data[0]['area']);
$total_people = 0;
for($i=0;$i<count($resident_data);$i++){
    $total_people += $resident_data[$i]["family_num"];
    if($i%2==0){
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'C'.(floor($i/2+9)), $resident_data[$i]["captain_name"])
                    ->setCellValue( 'E'.(floor($i/2+9)), $resident_data[$i]["family_num"])
                    ->setCellValue( 'G'.(floor($i/2+9)), $resident_data[$i]["household_number"])
                    ->setCellValue( 'J'.(floor($i/2+9)), $resident_data[$i]["set_household_date"]);
    }
    else{
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'S'.(floor($i/2+9)), $resident_data[$i]["captain_name"])
                    ->setCellValue( 'U'.(floor($i/2+9)), $resident_data[$i]["family_num"])
                    ->setCellValue( 'X'.(floor($i/2+9)), $resident_data[$i]["household_number"])
                    ->setCellValue( 'AB'.(floor($i/2+9)), $resident_data[$i]["set_household_date"]);
    }
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'X10', $total_people);
}



$objActSheet = $objPHPExcel->getActiveSheet();
$objActSheet->setTitle('Simple2222');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('file/myexchel.xls');

echo json_encode(array('status' => 'completed'));
?>
