<?php
include "library.php";
// $script_number = $_POST['script_number'];
// $house_address = $_POST["house_address"];

// $data = getRecordData($house_address);
$script_number = "建合001";
$house_address = '建國二路100號';
$price = 12.6;
$owner_data = getOwnerData($house_address);
$building_data = getBuildingData($house_address);
$land_data = getLandData($house_address);
$resident_data = getResidentData($house_address);
$main_building_data = getMainBuildingData($house_address);

if(substr($script_number,0,6) == "建合"){
    $compensate_type = "補償";
}
else{
    $compensate_type = "救濟";
}

// $points = getStructurePoints($house_address);

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

// 計算主建物、雜項物筆數設定不同頁數的模板
$main_count = (int)(count($main_building_data)/7)+1;
$other_count = 1;
if($other_count > $main_count){
    $pages = $other_count;
}
else{
    $pages = $main_count;
}
// 自行建立的 Excel 版型檔名
$excelTemplate = './excel_templates/template'.$pages.'.xls';

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

$total_area = 0;
$total_price = 0;
$total_fee = 0;
$total_auto = 0;
for($i=0;$i<count($main_building_data);$i++){
    $fee = number_format($main_building_data[$i]["points"]*$main_building_data[$i]["floor_area"]*$price,0,"","");
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A'.($i+13), $i+1)
                ->setCellValue( 'C'.($i+13), $main_building_data[$i]["structure"].$main_building_data[$i]["floor_type"])
                ->setCellValue( 'I'.($i+13), $main_building_data[$i]["nth_floor"]."/".count($main_building_data))
                ->setCellValue( 'J'.($i+13), $main_building_data[$i]["use_type"])
                ->setCellValue( 'L'.($i+13), $main_building_data[$i]["points"])
                ->setCellValue( 'O'.($i+13), $main_building_data[$i]["points"])
                ->setCellValue( 'Q'.($i+13), $price)
                ->setCellValue( 'S'.($i+13), $main_building_data[$i]["floor_area"])
                ->setCellValue( 'U'.($i+13), $fee)
                ->setCellValue( 'Z'.($i+13), $compensate_type);
                $total_area += $main_building_data[$i]["floor_area"];
                $total_price += $fee;
}

for($i=0;$i<count($main_building_data);$i++){
    $fee = number_format($main_building_data[$i]["points"]*$main_building_data[$i]["floor_area"]*$price,0,"","");
    if($compensate_type == "補償"){
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'AB'.($i+13), $fee)
                    ->setCellValue( 'AE'.($i+13), number_format($fee*0.5,0,"",""));
                    $total_fee += $fee;
                    $total_auto += number_format($fee*0.5,0,"","");
    }
    else{
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'AB'.($i+13), number_format($fee*0.6,0,"",""))
                    ->setCellValue( 'AE'.($i+13), number_format($fee*0.6*0.5,0,"",""));
                    $total_fee += number_format($fee*0.6,0,"","");
                    $total_auto += number_format($fee*0.6*0.5,0,"","");
    }
}

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'S20', $total_area)
            ->setCellValue( 'U20', $total_price)
            ->setCellValue( 'AB20', $total_fee)
            ->setCellValue( 'AE20', $total_auto);


$objActSheet = $objPHPExcel->getActiveSheet();
$objActSheet->setTitle('default');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('file/myexchel.xls');
date_default_timezone_set('Asia/Taipei');
// $objWriter->save('file/'.date("YmdHis").'.xls');

echo json_encode(array('status' => 'completed','tt' => $main_building_data[0]["points"],'type' => $main_building_data[0]["floor_area"]));
?>
