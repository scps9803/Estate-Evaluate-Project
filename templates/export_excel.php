<?php
include "library.php";
include "export_building_hold_ratio_excel.php";
// $script_number = $_POST['script_number'];
// $house_address = $_POST["house_address"];
//
// $data = getRecordData($house_address);
$script_number = $_REQUEST["script_number"];
$house_address = $_REQUEST["house_address"];
// $script_number = "建合-007";
// $house_address = "測試用";
// $script_number = "建合-001";
// $house_address = "建國二路100號";
$price = 12.6;
$owner_data = getOwnerData($house_address);
$land_owner_data = getLandOwnerData($house_address);
$building_data = getBuildingData($house_address);
$land_data = getLandData($house_address);
$resident_data = getResidentData($house_address);
$main_building_data = getMainBuildingData($house_address);
$sub_building_data = getSubbuildingData($house_address,'室內');
$outdoor_sub_building_data = getSubbuildingData($house_address,'室外');
// 撈出建物粉裝資料
$main_decoration_data = getDecorationData($house_address,'房屋構造體(別)');
// $indoor_divide_decoration_data = getDecorationData($house_address,'室內隔牆構造');

if(substr($script_number,0,6) == "建合"){
    $compensate_type = "補償";
    $title = "(合法建築物)";
    $building_text = "建築改良物\n拆遷補償金";
    $sub_building_text = "雜項設施\n拆遷補償金";
    $legal_text = "有合法證明文件";
}
else{
    $compensate_type = "救濟";
    $title = "(其他建築物)";
    $building_text = "建築改良物\n拆遷救濟金";
    $sub_building_text = "雜項設施\n拆遷救濟金";
    $legal_text = "無合法證明文件";
}

$land_number = "";
$land_section = "";
$section_array = [];
$section_index = 0;
$total_land_area = 0;
for($i=0;$i<count($land_data);$i++){
    if(!in_array($land_data[$i]["land_section"],$section_array)){
        $section_array[$section_index] = $land_data[$i]["land_section"];
        $land_section = $land_section.$land_data[$i]["land_section"].$land_data[$i]["subsection"];
        if($i!=count($land_data)-1) {
            $land_section = $land_section."、";
        }
    }
    $land_number = $land_number.$land_data[$i]["land_number"];
    if($i!=count($land_data)-1) {
        $land_number = $land_number."、";
    }
    $total_land_area += $land_data[$i]["area"];
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

require_once 'classes/PHPExcel.php';
require_once 'classes/PHPExcel/Writer/Excel5.php';
$objPHPExcel  = new PHPExcel();

// 計算主建物、雜項物筆數設定不同頁數的模板
// 1-x表示粉裝項目一頁，2-x表示粉裝項目兩頁，pages為主建物+雜項物頁數
$floor_count = (int)(count($main_building_data)/7)+1;
$main_count = (int)(count($main_building_data)/8)+1;
$other_count = (int)(count($sub_building_data)/8)+1;
$outdoor_other_count = (int)(count($outdoor_sub_building_data)/8)+1;
$pages = max($main_count,max($other_count,$outdoor_other_count));
// if($other_count > $main_count){
//     $pages = $other_count;
// }
// else{
//     $pages = $main_count;
// }
// 自行建立的 Excel 版型檔名
$excelTemplate = './excel_templates/template'.$floor_count.'-'.$pages.'.xls';

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

// 建物所有人
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

// 土地所有人
$hold_id = "";
if(count($land_owner_data)>1){
    $land_text = '等'.count($land_owner_data).'人';
    for($i=0;$i<count($land_owner_data);$i++){
        $hold_id = $hold_id . $land_owner_data[$i]["hold_id"];
        if($i!=count($land_owner_data)-1){
            $hold_id = $hold_id  . "、";
        }
    }
}
else{
    $land_text = "";
    $hold_id = $land_owner_data[0]["hold_id"];
}

$land_phone = $land_owner_data[0]["cellphone"];
if($land_owner_data[0]["cellphone"] == ""){
    $land_phone = $land_owner_data[0]["telephone"];
}

if($land_data[0]["land_use"]=="承租"){
    $rent_text = "有";
}
else{
    $rent_text = "無";
}

// $add_minus_wall_points = array();
// $add_minus_wall_text = array();
for($i=0;$i<count($main_decoration_data);$i++){
    $add_minus_wall_points[$i] = 0;
    $add_minus_wall_text[$i] = "";
    $add_minus_wall_data = getBuildingDecorationData($house_address,'加減牆',$i+1);

    if($add_minus_wall_data!=null){
        for($j=0;$j<count($add_minus_wall_data);$j++){
            if($add_minus_wall_data[$j]["item_type"] == "減牆"){
                $add_minus_wall_points[$i] -= $add_minus_wall_data[$j]["points"]*$add_minus_wall_data[$j]["ratio"];
                if($add_minus_wall_data[$j]["ratio"] == 2){
                    $add_minus_wall_text[$i] = $add_minus_wall_text[$i]."-1/2".$add_minus_wall_data[$j]["item_name"];
                }
                else{
                    $add_minus_wall_text[$i] = $add_minus_wall_text[$i]."-".$add_minus_wall_data[$j]["ratio"]."/4".$add_minus_wall_data[$j]["item_name"];
                }
            }
            else{
                $add_minus_wall_points[$i] += $add_minus_wall_data[$j]["points"]*$add_minus_wall_data[$j]["ratio"];
                if($add_minus_wall_data[$j]["ratio"] == 2){
                    $add_minus_wall_text[$i] = $add_minus_wall_text[$i]."+1/2".$add_minus_wall_data[$j]["item_name"];
                }
                else{
                    $add_minus_wall_text[$i] = $add_minus_wall_text[$i]."+".$add_minus_wall_data[$j]["ratio"]."/4".$add_minus_wall_data[$j]["item_name"];
                }
            }
        }
    }
}

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'AH3', $script_number)
            ->setCellValue( 'R3', $title)
            ->setCellValue( 'C3', $hold_id)
            ->setCellValue( 'AB11', $building_text)
            ->setCellValue( 'L21', $sub_building_text)
            ->setCellValue( 'AE21', $sub_building_text)
            ->setCellValue( 'C4', $owner_data[0]["name"].$text)
            ->setCellValue( 'G4', $owner_data[0]["pId"])
            ->setCellValue( 'L4', $owner_data[0]["current_address"])
            ->setCellValue( 'X4', $owner_data[0]["telephone"]."\n".$owner_data[0]["cellphone"])
            // 地主資料待更新，暫時與建物相同

            ->setCellValue( 'C5', $land_owner_data[0]["name"].$land_text)
            ->setCellValue( 'G5', $land_owner_data[0]["pId"])
            ->setCellValue( 'L5', $land_owner_data[0]["current_address"])
            ->setCellValue( 'X5', $land_phone)

            ->setCellValue( 'AE4', $legal_text)
            ->setCellValue( 'AE5', $building_data[0]["legal_certificate"])
            ->setCellValue( 'AE7', $building_data[0]["remove_condition"])
            ->setCellValue( 'C6', $building_data[0]["address"])
            ->setCellValue( 'O6', $building_data[0]["build_number"]."\n".$building_data[0]["tax_number"])
            ->setCellValue( 'X6', $land_data[0]["land_use"])
            ->setCellValue( 'AE6', $rent_text)
            ->setCellValue( 'C7', '桃園市')
            // 行政區尚未設定
            ->setCellValue( 'E7', $land_data[0]["dist"])
            ->setCellValue( 'G7', $land_section)
            // ->setCellValue( 'K7', $land_data[0]['land_number'])
            ->setCellValue( 'K7', $land_number)
            // ->setCellValue( 'X7', $land_data[0]['area']);
            ->setCellValue( 'X7', $total_land_area);
$total_people = 0;
$total_migration_fee = 0;
$migration_fee = [];
$mf_index = 0;
for($i=0;$i<count($resident_data);$i++){
    $total_people += $resident_data[$i]["family_num"];
    if($resident_data[$i]["move_status"] == "個別領取"){
        $total_migration_fee += $resident_data[$i]["fee"];
    }
    else{
        if(!in_array($resident_data[$i]["fee"], $migration_fee)){
            $migration_fee[$mf_index] = $resident_data[$i]["fee"];
            $total_migration_fee += $resident_data[$i]["fee"];
            $mf_index++;
        }
    }
    if($i%2==0){
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'C'.(floor($i/2+9)), $resident_data[$i]["captain_name"])
                    ->setCellValue( 'E'.(floor($i/2+9)), $resident_data[$i]["family_num"])
                    ->setCellValue( 'G'.(floor($i/2+9)), $resident_data[$i]["household_number"])
                    ->setCellValue( 'J'.(floor($i/2+9)), $resident_data[$i]["set_household_date"])
                    ->setCellValue( 'N'.(floor($i/2+9)), $resident_data[$i]["move_status"].number_format($resident_data[$i]["fee"],0,".",","));
    }
    else{
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'S'.(floor($i/2+9)), $resident_data[$i]["captain_name"])
                    ->setCellValue( 'U'.(floor($i/2+9)), $resident_data[$i]["family_num"])
                    ->setCellValue( 'X'.(floor($i/2+9)), $resident_data[$i]["household_number"])
                    ->setCellValue( 'AB'.(floor($i/2+9)), $resident_data[$i]["set_household_date"])
                    ->setCellValue( 'AE'.(floor($i/2+9)), $resident_data[$i]["move_status"].number_format($resident_data[$i]["fee"],0,".",","));
    }
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'X10', $total_people)
                ->setCellValue( 'AE10', $total_migration_fee);
}

$total_area = 0;
$total_price = 0;
$total_fee = 0;
$total_auto = 0;
for($i=0;$i<count($main_building_data);$i++){
    $fee = number_format(($main_building_data[$i]["points"]+$add_minus_wall_points[$i])*$main_building_data[$i]["floor_area"]*$price,0,"","");
    if($i<7){
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'A'.($i+13), $i+1)
                    ->setCellValue( 'C'.($i+13), $main_building_data[$i]["structure"].$main_building_data[$i]["floor_type"].$add_minus_wall_text[$i])
                    ->setCellValue( 'I'.($i+13), $main_building_data[$i]["nth_floor"]."/".count($main_building_data))
                    ->setCellValue( 'J'.($i+13), $main_building_data[$i]["use_type"])
                    ->setCellValue( 'L'.($i+13), $main_building_data[$i]["points"]+$add_minus_wall_points[$i])
                    ->setCellValue( 'O'.($i+13), $main_building_data[$i]["points"]+$add_minus_wall_points[$i])
                    ->setCellValue( 'Q'.($i+13), $price)
                    ->setCellValue( 'S'.($i+13), $main_building_data[$i]["floor_area"])
                    ->setCellValue( 'U'.($i+13), $fee)
                    ->setCellValue( 'Z'.($i+13), $compensate_type);
    }
    else{
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'A'.($i+40), $i+1)
                    ->setCellValue( 'C'.($i+40), $main_building_data[$i]["structure"].$main_building_data[$i]["floor_type"])
                    ->setCellValue( 'I'.($i+40), $main_building_data[$i]["nth_floor"]."/".count($main_building_data))
                    ->setCellValue( 'J'.($i+40), $main_building_data[$i]["use_type"])
                    ->setCellValue( 'L'.($i+40), $main_building_data[$i]["points"])
                    ->setCellValue( 'O'.($i+40), $main_building_data[$i]["points"])
                    ->setCellValue( 'Q'.($i+40), $price)
                    ->setCellValue( 'S'.($i+40), $main_building_data[$i]["floor_area"])
                    ->setCellValue( 'U'.($i+40), $fee)
                    ->setCellValue( 'Z'.($i+40), $compensate_type);
    }
    // $objPHPExcel->setActiveSheetIndex(0)
    //             ->setCellValue( 'A'.($i+13), $i+1)
    //             ->setCellValue( 'C'.($i+13), $main_building_data[$i]["structure"].$main_building_data[$i]["floor_type"])
    //             ->setCellValue( 'I'.($i+13), $main_building_data[$i]["nth_floor"]."/".count($main_building_data))
    //             ->setCellValue( 'J'.($i+13), $main_building_data[$i]["use_type"])
    //             ->setCellValue( 'L'.($i+13), $main_building_data[$i]["points"])
    //             ->setCellValue( 'O'.($i+13), $main_building_data[$i]["points"])
    //             ->setCellValue( 'Q'.($i+13), $price)
    //             ->setCellValue( 'S'.($i+13), $main_building_data[$i]["floor_area"])
    //             ->setCellValue( 'U'.($i+13), $fee)
    //             ->setCellValue( 'Z'.($i+13), $compensate_type);
                $total_area += $main_building_data[$i]["floor_area"];
                $total_price += $fee;
}

for($i=0;$i<count($main_building_data);$i++){
    $fee = number_format(($main_building_data[$i]["points"]+$add_minus_wall_points[$i])*$main_building_data[$i]["floor_area"]*$price,0,"","");
    if($main_building_data[$i]["discard_status"]=="yes"){
        $discard_ratio = 0.25;
        $hint = "廢棄";
    }
    else{
        $discard_ratio = 1;
        $hint = "";
    }

    if($compensate_type == "補償"){
        if($i<7){
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue( 'AB'.($i+13), $fee*$discard_ratio)
                        ->setCellValue( 'AE'.($i+13), number_format($fee*$discard_ratio*0.5,0,"",""))
                        ->setCellValue( 'AH'.($i+13), $hint);
                        $total_fee += $fee*$discard_ratio;
                        $total_auto += number_format($fee*$discard_ratio*0.5,0,"","");
        }
        else{
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue( 'AB'.($i+40), $fee*$discard_ratio)
                        ->setCellValue( 'AE'.($i+40), number_format($fee*$discard_ratio*0.5,0,"",""))
                        ->setCellValue( 'AH'.($i+40), $hint);
                        $total_fee += $fee*$discard_ratio;
                        $total_auto += number_format($fee*$discard_ratio*0.5,0,"","");
        }
    }
    else{
        if($i<7){
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue( 'AB'.($i+13), number_format($fee*$discard_ratio*0.6,0,"",""))
                        ->setCellValue( 'AE'.($i+13), number_format($fee*$discard_ratio*0.6*0.5,0,"",""))
                        ->setCellValue( 'AH'.($i+13), $hint);
                        $total_fee += number_format($fee*$discard_ratio*0.6,0,"","");
                        $total_auto += number_format($fee*$discard_ratio*0.6*0.5,0,"","");
        }
        else{
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue( 'AB'.($i+40), number_format($fee*$discard_ratio*0.6,0,"",""))
                        ->setCellValue( 'AE'.($i+40), number_format($fee*$discard_ratio*0.6*0.5,0,"",""))
                        ->setCellValue( 'AH'.($i+40), $hint);
                        $total_fee += number_format($fee*$discard_ratio*0.6,0,"","");
                        $total_auto += number_format($fee*$discard_ratio*0.6*0.5,0,"","");
        }
    }
}

if(count($main_building_data)<=7){
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'S20', $total_area)
                ->setCellValue( 'U20', $total_price)
                ->setCellValue( 'AB20', $total_fee)
                ->setCellValue( 'AE20', $total_auto);
}
else{
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'S54', $total_area)
                ->setCellValue( 'U54', $total_price)
                ->setCellValue( 'AB54', $total_fee)
                ->setCellValue( 'AE54', $total_auto);
}

// 室內雜項物
$total_init_fee = 0;
$total_subbuilding_fee = 0;
$total_auto_remove_fee = 0;
$page_item_index = 23;
$page_fee_index = 30;
$total_index = 31;
for($i=0;$i<count($sub_building_data);$i++){

    $init_fee = number_format($sub_building_data[$i]["unitprice"]*number_format($sub_building_data[$i]["area"],2,".",","),0,"","");
    if($compensate_type == "補償"){
        $sub_building_fee = $init_fee;
    }
    else{
        $sub_building_fee = number_format($sub_building_data[$i]["unitprice"]*number_format($sub_building_data[$i]["area"],2,".",",")*0.6,0,"","");
    }

    if($sub_building_data[$i]["auto_remove"]=="是"){
        $auto_remove_fee = number_format($sub_building_fee*0.5,0,"","");
    }
    else{
        $auto_remove_fee = 0;
    }

    if(($i+1)%7==0){
        $page_item_index = $page_item_index+40-6;
        $page_fee_index = $page_fee_index+40-6;
    }
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A'.($i+$page_item_index), $i+1)
                ->setCellValue( 'C'.($i+$page_item_index), $sub_building_data[$i]["item_name"])
                ->setCellValue( 'F'.($i+$page_item_index), $sub_building_data[$i]["application"])
                ->setCellValue( 'G'.($i+$page_item_index), $sub_building_data[$i]["unitprice"])
                ->setCellValue( 'I'.($i+$page_item_index), number_format($sub_building_data[$i]["area"],2,".",",").$sub_building_data[$i]["unit"])
                ->setCellValue( 'J'.($i+$page_item_index), $init_fee)
                ->setCellValue( 'L'.($i+$page_item_index), $sub_building_fee)
                ->setCellValue( 'O'.($i+$page_item_index), $auto_remove_fee);
                $total_init_fee += $init_fee;
                $total_subbuilding_fee += $sub_building_fee;
                $total_auto_remove_fee += $auto_remove_fee;
}
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'J'.$page_fee_index, $total_init_fee)
            ->setCellValue( 'L'.$page_fee_index, $total_subbuilding_fee)
            ->setCellValue( 'O'.$page_fee_index, $total_auto_remove_fee);

// 室外雜項物
$out_total_init_fee = 0;
$out_total_subbuilding_fee = 0;
$out_total_auto_remove_fee = 0;
$out_page_item_index = 23;
$out_page_fee_index = 30;
for($i=0;$i<count($outdoor_sub_building_data);$i++){

    $init_fee = number_format($outdoor_sub_building_data[$i]["unitprice"]*number_format($outdoor_sub_building_data[$i]["area"],2,".",","),0,"","");
    if($compensate_type == "補償"){
        $sub_building_fee = $init_fee;
    }
    else{
        $sub_building_fee = number_format($outdoor_sub_building_data[$i]["unitprice"]*number_format($outdoor_sub_building_data[$i]["area"],2,".",",")*0.6,0,"","");
    }

    if($outdoor_sub_building_data[$i]["auto_remove"]=="是"){
        $auto_remove_fee = number_format($sub_building_fee*0.5,0,"","");
    }
    else{
        $auto_remove_fee = 0;
    }

    if(($i+1)%7==0){
        $out_page_item_index = $out_page_item_index+40-6;
        $out_page_fee_index = $out_page_fee_index+40-6;
    }
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'S'.($i+$out_page_item_index), $i+1)
                ->setCellValue( 'U'.($i+$out_page_item_index), $outdoor_sub_building_data[$i]["item_name"])
                ->setCellValue( 'Y'.($i+$out_page_item_index), $outdoor_sub_building_data[$i]["application"])
                ->setCellValue( 'Z'.($i+$out_page_item_index), $outdoor_sub_building_data[$i]["unitprice"])
                ->setCellValue( 'AB'.($i+$out_page_item_index), number_format($outdoor_sub_building_data[$i]["area"],2,".",",").$outdoor_sub_building_data[$i]["unit"])
                ->setCellValue( 'AD'.($i+$out_page_item_index), $init_fee)
                ->setCellValue( 'AE'.($i+$out_page_item_index), $sub_building_fee)
                ->setCellValue( 'AH'.($i+$out_page_item_index), $auto_remove_fee);
                $out_total_init_fee += $init_fee;
                $out_total_subbuilding_fee += $sub_building_fee;
                $out_total_auto_remove_fee += $auto_remove_fee;
}
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'AD'.$out_page_fee_index, $out_total_init_fee)
            ->setCellValue( 'AE'.$out_page_fee_index, $out_total_subbuilding_fee)
            ->setCellValue( 'AH'.$out_page_fee_index, $out_total_auto_remove_fee);
// 合計欄位
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'S'.(31+($pages-1)*(40-6)), '合計')
            ->setCellValue( 'AD'.(31+($pages-1)*(40-6)), $total_price+$total_init_fee+$out_total_init_fee)
            ->setCellValue( 'AE'.(31+($pages-1)*(40-6)), $total_fee+$total_subbuilding_fee+$out_total_subbuilding_fee)
            ->setCellValue( 'AH'.(31+($pages-1)*(40-6)), $total_auto+$total_auto_remove_fee+$out_total_auto_remove_fee);

// 粉裝調查表
for($i=0;$i<count($main_decoration_data);$i++){
    $indoor_divide_text = "";
    $indoor_divide_points = 0;

    $outdoor_wall_text = "";
    $outdoor_wall_points = 0;

    $indoor_wall_text = "";
    $indoor_wall_points = 0;

    $roof_text = "";
    $roof_points = 0;

    $floor_text = "";
    $floor_points = 0;

    $ceiling_text = "";
    $ceiling_points = 0;

    $door_text = "";
    $door_points = 0;

    $toilet_text = "";
    $toilet_points = 0;

    $electric_text = "";
    $electric_points = 0;

    $window_level_text = "";
    $window_level_points = 0;

    $balcony_text = "";
    $balcony_points = 0;

    $daughter_text = "";
    $daughter_points = 0;

    $extra_percent = 0;

    $indoor_divide_decoration_data = getBuildingDecorationData($house_address,'室內隔牆構造',$i+1);
    $outdoor_wall_decoration_data = getBuildingDecorationData($house_address,'屋外牆粉裝',$i+1);
    $indoor_wall_decoration_data = getBuildingDecorationData($house_address,'室內牆粉裝',$i+1);
    $roof_decoration_data = getBuildingDecorationData($house_address,'屋頂(面)粉裝',$i+1);
    $floor_decoration_data = getBuildingDecorationData($house_address,'樓地板粉裝',$i+1);
    $ceiling_decoration_data = getBuildingDecorationData($house_address,'天花板粉裝',$i+1);
    $door_decoration_data = getBuildingDecorationData($house_address,'門窗裝置',$i+1);
    $toilet_decoration_data = getBuildingDecorationData($house_address,'給水、浴、廁設備',$i+1);
    $electric_decoration_data = getBuildingDecorationData($house_address,'電氣設備(包括燈具)',$i+1);
    $window_level_decoration_data = getBuildingDecorationData($house_address,'其他項目門窗裝置加柵',$i+1);
    $balcony_decoration_data = getBuildingDecorationData($house_address,'陽台',$i+1);
    $daughter_decoration_data = getBuildingDecorationData($house_address,'女兒牆',$i+1);

    if($indoor_divide_decoration_data!=null){
        for($j=0;$j<count($indoor_divide_decoration_data);$j++){
            $indoor_divide_text = $indoor_divide_text.$indoor_divide_decoration_data[$j]["ratio"]." ".$indoor_divide_decoration_data[$j]["item_name"]."\n";
            $indoor_divide_points += $indoor_divide_decoration_data[$j]["ratio"]*$indoor_divide_decoration_data[$j]["points"];
        }
        if(count($indoor_divide_decoration_data)==1 && $indoor_divide_decoration_data[0]["ratio"]==1){
            $indoor_divide_text = substr($indoor_divide_text,1,strlen($indoor_divide_text));
        }
    }

    if($outdoor_wall_decoration_data!=null){
        for($j=0;$j<count($outdoor_wall_decoration_data);$j++){
            $outdoor_wall_text = $outdoor_wall_text.$outdoor_wall_decoration_data[$j]["ratio"]." ".$outdoor_wall_decoration_data[$j]["item_name"]."\n";
            $outdoor_wall_points += $outdoor_wall_decoration_data[$j]["ratio"]*$outdoor_wall_decoration_data[$j]["points"];
        }
        if(count($outdoor_wall_decoration_data)==1 && $outdoor_wall_decoration_data[0]["ratio"]==1){
            $outdoor_wall_text = substr($outdoor_wall_text,1,strlen($outdoor_wall_text));
        }
    }

    if($indoor_wall_decoration_data!=null){
        for($j=0;$j<count($indoor_wall_decoration_data);$j++){
            $indoor_wall_text = $indoor_wall_text.$indoor_wall_decoration_data[$j]["ratio"]." ".$indoor_wall_decoration_data[$j]["item_name"]."\n";
            $indoor_wall_points += $indoor_wall_decoration_data[$j]["ratio"]*$indoor_wall_decoration_data[$j]["points"];
        }
        if(count($indoor_wall_decoration_data)==1 && $indoor_wall_decoration_data[0]["ratio"]==1){
            $indoor_wall_text = substr($indoor_wall_text,1,strlen($indoor_wall_text));
        }
    }

    if($roof_decoration_data!=null){
        for($j=0;$j<count($roof_decoration_data);$j++){
            $roof_text = $roof_text.$roof_decoration_data[$j]["ratio"]." ".$roof_decoration_data[$j]["item_name"]."\n";
            $roof_points += $roof_decoration_data[$j]["ratio"]*$roof_decoration_data[$j]["points"];
        }
        if(count($roof_decoration_data)==1 && $roof_decoration_data[0]["ratio"]==1){
            $roof_text = substr($roof_text,1,strlen($roof_text));
        }
    }

    if($floor_decoration_data!=null){
        for($j=0;$j<count($floor_decoration_data);$j++){
            $floor_text = $floor_text.$floor_decoration_data[$j]["ratio"]." ".$floor_decoration_data[$j]["item_name"]."\n";
            $floor_points += $floor_decoration_data[$j]["ratio"]*$floor_decoration_data[$j]["points"];
        }
        if(count($floor_decoration_data)==1 && $floor_decoration_data[0]["ratio"]==1){
            $floor_text = substr($floor_text,1,strlen($floor_text));
        }
    }

    if($ceiling_decoration_data!=null){
        for($j=0;$j<count($ceiling_decoration_data);$j++){
            $ceiling_text = $ceiling_text.$ceiling_decoration_data[$j]["ratio"]." ".$ceiling_decoration_data[$j]["item_name"]."\n";
            $ceiling_points += $ceiling_decoration_data[$j]["ratio"]*$ceiling_decoration_data[$j]["points"];
        }
        if(count($ceiling_decoration_data)==1 && $ceiling_decoration_data[0]["ratio"]==1){
            $ceiling_text = substr($ceiling_text,1,strlen($ceiling_text));
        }
    }

    if($door_decoration_data!=null){
        for($j=0;$j<count($door_decoration_data);$j++){
            $door_text = $door_text.$door_decoration_data[$j]["ratio"]." ".$door_decoration_data[$j]["item_name"]."\n";
            $door_points += $door_decoration_data[$j]["ratio"]*$door_decoration_data[$j]["points"];
        }
        if(count($door_decoration_data)==1 && $door_decoration_data[0]["ratio"]==1){
            $door_text = substr($door_text,1,strlen($door_text));
        }
    }

    if($toilet_decoration_data!=null){
        for($j=0;$j<count($toilet_decoration_data);$j++){
            if($toilet_text.$toilet_decoration_data[$j]["area"]==1){
                $note = "(一至三處)";
            }
            else if($toilet_text.$toilet_decoration_data[$j]["area"]==2){
                $note = "(四至六處)";
            }
            else if($toilet_text.$toilet_decoration_data[$j]["area"]==3){
                $note = "(七處以上)";
            }
            $toilet_text = $toilet_text.$toilet_decoration_data[$j]["ratio"]." ".$toilet_decoration_data[$j]["item_name"].$note."\n";
            $toilet_points += $toilet_decoration_data[$j]["ratio"]*$toilet_decoration_data[$j]["points"];
        }
        if(count($toilet_decoration_data)==1 && $toilet_decoration_data[0]["ratio"]==1){
            $toilet_text = substr($toilet_text,1,strlen($toilet_text));
        }
    }

    $electric_type = "";
    if($electric_decoration_data!=null){
        for($j=0;$j<count($electric_decoration_data);$j++){
            $electric_text = $electric_text.$electric_decoration_data[$j]["ratio"]." ".$electric_decoration_data[$j]["item_name"]."\n";
            $electric_points += $electric_decoration_data[$j]["ratio"]*$electric_decoration_data[$j]["points"];
            $electric_type = $electric_decoration_data[$j]["item_type"];
        }
        if(count($electric_decoration_data)==1 && $electric_decoration_data[0]["ratio"]==1){
            $electric_text = substr($electric_text,1,strlen($electric_text));
        }
    }

    if($window_level_decoration_data!=null){
        for($j=0;$j<count($window_level_decoration_data);$j++){
            $window_level_text = $window_level_text.$window_level_decoration_data[$j]["ratio"]." ".$window_level_decoration_data[$j]["item_name"]."\n";
            $window_level_points += $window_level_decoration_data[$j]["ratio"]*$window_level_decoration_data[$j]["points"];
        }
        if(count($window_level_decoration_data)==1 && $window_level_decoration_data[0]["ratio"]==1){
            $window_level_text = substr($window_level_text,1,strlen($window_level_text));
        }
    }

    if($balcony_decoration_data!=null){
        $balcony_text = "陽台(";
        for($j=0;$j<count($balcony_decoration_data);$j++){
            $balcony_text = $balcony_text.$balcony_decoration_data[$j]["item_type"];
            if($j!=count($balcony_decoration_data)-1){
                $balcony_text = $balcony_text."、";
            }
            $balcony_points += $balcony_decoration_data[$j]["ratio"]*$balcony_decoration_data[$j]["points"];
        }
        $balcony_text = $balcony_text.")";
        if(count($balcony_decoration_data)==1 && $balcony_decoration_data[0]["ratio"]==1){
            $balcony_text = substr($balcony_text,0,strlen($balcony_text));
        }
    }

    if($daughter_decoration_data!=null){
        for($j=0;$j<count($daughter_decoration_data);$j++){
            $daughter_text = $daughter_text.$daughter_decoration_data[$j]["item_name"]."牆(".$daughter_decoration_data[$j]["item_type"].")"."\n";
            $daughter_points += $daughter_decoration_data[$j]["ratio"]*$daughter_decoration_data[$j]["points"];
        }
        if(count($daughter_decoration_data)==1 && $daughter_decoration_data[0]["ratio"]==1){
            $daughter_text = substr($daughter_text,0,strlen($daughter_text));
        }
    }

    if($main_decoration_data[$i]["layer_height"]<2.7){
        // $extra_percent = -(2.7-$main_decoration_data[$i]["layer_height"])*10;
        $extra_percent = -(2.7-number_format($main_decoration_data[$i]["layer_height"],1,".",","))*10;
        $height_text = number_format($main_decoration_data[$i]["layer_height"],2,".",",")." m減少".abs($extra_percent)."%評點";
    }
    else if($main_decoration_data[$i]["layer_height"]>3.6){
        // $extra_percent = ($main_decoration_data[$i]["layer_height"]-3.6)*10;
        $extra_percent = (number_format($main_decoration_data[$i]["layer_height"],1,".",",")-3.6)*10;
        $height_text = number_format($main_decoration_data[$i]["layer_height"],2,".",",")." m增加".$extra_percent."%評點";
    }
    else{
        $height_text = number_format($main_decoration_data[$i]["layer_height"],2,".",",")." m為標準房屋高度";
    }

    // $total_points = number_format((number_format($main_decoration_data[$i]["points"],2,".",",")+
    // number_format($indoor_divide_points,2,".",",")+number_format($outdoor_wall_points,2,".",",")+
    // number_format($indoor_wall_points,2,".",",")+number_format($roof_points,2,".",",")+
    // number_format($floor_points,2,".",",")+number_format($ceiling_points,2,".",",")+
    // number_format($door_points,2,".",",")+number_format($toilet_points,2,".",",")+
    // number_format($electric_points,2,".",",")+number_format($window_level_points,2,".",",")+
    // number_format($balcony_points,2,".",",")+number_format($daughter_points,2,".",","))/100*(100+$extra_percent),2,".",",");
    $total_points = number_format(($main_decoration_data[$i]["points"]+
    $add_minus_wall_points[$i] +
    $indoor_divide_points+$outdoor_wall_points+
    $indoor_wall_points+$roof_points+
    $floor_points+$ceiling_points+
    $door_points+$toilet_points+
    $electric_points+$window_level_points+
    $balcony_points+$daughter_points)/100*(100+$extra_percent),2,".",",");
    switch ($i % 6) {
        case 0:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'AH'.(35+($pages-1)*(40-6)), $script_number)
                    ->setCellValue( 'D'.(37+($pages-1)*(40-6)+(int)($i/6)*17), $i+1)
                    ->setCellValue( 'D'.(38+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'D'.(39+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'D'.(40+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'D'.(41+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'D'.(42+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'D'.(43+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'D'.(45+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_divide_text)
                    ->setCellValue( 'D'.(46+($pages-1)*(40-6)+(int)($i/6)*17), $outdoor_wall_text)
                    ->setCellValue( 'D'.(47+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_wall_text)
                    ->setCellValue( 'D'.(48+($pages-1)*(40-6)+(int)($i/6)*17), $roof_text)
                    ->setCellValue( 'D'.(49+($pages-1)*(40-6)+(int)($i/6)*17), $floor_text)
                    ->setCellValue( 'D'.(50+($pages-1)*(40-6)+(int)($i/6)*17), $ceiling_text)
                    ->setCellValue( 'D'.(51+($pages-1)*(40-6)+(int)($i/6)*17), $door_text)
                    ->setCellValue( 'D'.(52+($pages-1)*(40-6)+(int)($i/6)*17), $toilet_text)
                    ->setCellValue( 'D'.(53+($pages-1)*(40-6)+(int)($i/6)*17), $electric_text)
                    ->setCellValue( 'D'.(54+($pages-1)*(40-6)+(int)($i/6)*17), $electric_type)
                    ->setCellValue( 'D'.(55+($pages-1)*(40-6)+(int)($i/6)*17), $window_level_text)
                    ->setCellValue( 'D'.(56+($pages-1)*(40-6)+(int)($i/6)*17), $balcony_text)
                    ->setCellValue( 'D'.(57+($pages-1)*(40-6)+(int)($i/6)*17), $daughter_text)
                    ->setCellValue( 'D'.(58+($pages-1)*(40-6)+(int)($i/6)*17), $height_text)
                    ->setCellValue( 'D'.(59+($pages-1)*(40-6)+(int)($i/6)*17), $total_points)

                    // 塞入評點
                    ->setCellValue( 'G'.(41+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["points"]+$add_minus_wall_points[$i],2,".",","))
                    ->setCellValue( 'G'.(45+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'G'.(46+($pages-1)*(40-6)+(int)($i/6)*17), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'G'.(47+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'G'.(48+($pages-1)*(40-6)+(int)($i/6)*17), number_format($roof_points,2,".",","))
                    ->setCellValue( 'G'.(49+($pages-1)*(40-6)+(int)($i/6)*17), number_format($floor_points,2,".",","))
                    ->setCellValue( 'G'.(50+($pages-1)*(40-6)+(int)($i/6)*17), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'G'.(51+($pages-1)*(40-6)+(int)($i/6)*17), number_format($door_points,2,".",","))
                    ->setCellValue( 'G'.(52+($pages-1)*(40-6)+(int)($i/6)*17), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'G'.(53+($pages-1)*(40-6)+(int)($i/6)*17), number_format($electric_points,2,".",","))
                    ->setCellValue( 'G'.(55+($pages-1)*(40-6)+(int)($i/6)*17), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'G'.(56+($pages-1)*(40-6)+(int)($i/6)*17), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'G'.(57+($pages-1)*(40-6)+(int)($i/6)*17), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'G'.(58+($pages-1)*(40-6)+(int)($i/6)*17), (100+$extra_percent)."%");
                    break;
        case 1:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'H'.(37+($pages-1)*(40-6)+(int)($i/6)*17), $i+1)
                    ->setCellValue( 'H'.(38+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'H'.(39+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'H'.(40+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'H'.(41+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'H'.(42+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'H'.(43+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'H'.(45+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_divide_text)
                    ->setCellValue( 'H'.(46+($pages-1)*(40-6)+(int)($i/6)*17), $outdoor_wall_text)
                    ->setCellValue( 'H'.(47+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_wall_text)
                    ->setCellValue( 'H'.(48+($pages-1)*(40-6)+(int)($i/6)*17), $roof_text)
                    ->setCellValue( 'H'.(49+($pages-1)*(40-6)+(int)($i/6)*17), $floor_text)
                    ->setCellValue( 'H'.(50+($pages-1)*(40-6)+(int)($i/6)*17), $ceiling_text)
                    ->setCellValue( 'H'.(51+($pages-1)*(40-6)+(int)($i/6)*17), $door_text)
                    ->setCellValue( 'H'.(52+($pages-1)*(40-6)+(int)($i/6)*17), $toilet_text)
                    ->setCellValue( 'H'.(53+($pages-1)*(40-6)+(int)($i/6)*17), $electric_text)
                    ->setCellValue( 'H'.(54+($pages-1)*(40-6)+(int)($i/6)*17), $electric_type)
                    ->setCellValue( 'H'.(55+($pages-1)*(40-6)+(int)($i/6)*17), $window_level_text)
                    ->setCellValue( 'H'.(56+($pages-1)*(40-6)+(int)($i/6)*17), $balcony_text)
                    ->setCellValue( 'H'.(57+($pages-1)*(40-6)+(int)($i/6)*17), $daughter_text)
                    ->setCellValue( 'H'.(58+($pages-1)*(40-6)+(int)($i/6)*17), $height_text)
                    ->setCellValue( 'H'.(59+($pages-1)*(40-6)+(int)($i/6)*17), $total_points)

                    // 塞入評點
                    ->setCellValue( 'K'.(41+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'K'.(45+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'K'.(46+($pages-1)*(40-6)+(int)($i/6)*17), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'K'.(47+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'K'.(48+($pages-1)*(40-6)+(int)($i/6)*17), number_format($roof_points,2,".",","))
                    ->setCellValue( 'K'.(49+($pages-1)*(40-6)+(int)($i/6)*17), number_format($floor_points,2,".",","))
                    ->setCellValue( 'K'.(50+($pages-1)*(40-6)+(int)($i/6)*17), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'K'.(51+($pages-1)*(40-6)+(int)($i/6)*17), number_format($door_points,2,".",","))
                    ->setCellValue( 'K'.(52+($pages-1)*(40-6)+(int)($i/6)*17), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'K'.(53+($pages-1)*(40-6)+(int)($i/6)*17), number_format($electric_points,2,".",","))
                    ->setCellValue( 'K'.(55+($pages-1)*(40-6)+(int)($i/6)*17), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'K'.(56+($pages-1)*(40-6)+(int)($i/6)*17), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'K'.(57+($pages-1)*(40-6)+(int)($i/6)*17), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'K'.(58+($pages-1)*(40-6)+(int)($i/6)*17), (100+$extra_percent)."%");
                    break;
        case 2:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'M'.(37+($pages-1)*(40-6)+(int)($i/6)*17), $i+1)
                    ->setCellValue( 'M'.(38+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'M'.(39+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'M'.(40+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'M'.(41+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'M'.(42+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'M'.(43+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'M'.(45+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_divide_text)
                    ->setCellValue( 'M'.(46+($pages-1)*(40-6)+(int)($i/6)*17), $outdoor_wall_text)
                    ->setCellValue( 'M'.(47+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_wall_text)
                    ->setCellValue( 'M'.(48+($pages-1)*(40-6)+(int)($i/6)*17), $roof_text)
                    ->setCellValue( 'M'.(49+($pages-1)*(40-6)+(int)($i/6)*17), $floor_text)
                    ->setCellValue( 'M'.(50+($pages-1)*(40-6)+(int)($i/6)*17), $ceiling_text)
                    ->setCellValue( 'M'.(51+($pages-1)*(40-6)+(int)($i/6)*17), $door_text)
                    ->setCellValue( 'M'.(52+($pages-1)*(40-6)+(int)($i/6)*17), $toilet_text)
                    ->setCellValue( 'M'.(53+($pages-1)*(40-6)+(int)($i/6)*17), $electric_text)
                    ->setCellValue( 'M'.(54+($pages-1)*(40-6)+(int)($i/6)*17), $electric_type)
                    ->setCellValue( 'M'.(55+($pages-1)*(40-6)+(int)($i/6)*17), $window_level_text)
                    ->setCellValue( 'M'.(56+($pages-1)*(40-6)+(int)($i/6)*17), $balcony_text)
                    ->setCellValue( 'M'.(57+($pages-1)*(40-6)+(int)($i/6)*17), $daughter_text)
                    ->setCellValue( 'M'.(58+($pages-1)*(40-6)+(int)($i/6)*17), $height_text)
                    ->setCellValue( 'M'.(59+($pages-1)*(40-6)+(int)($i/6)*17), $total_points)

                    // 塞入評點
                    ->setCellValue( 'P'.(41+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'P'.(45+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'P'.(46+($pages-1)*(40-6)+(int)($i/6)*17), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'P'.(47+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'P'.(48+($pages-1)*(40-6)+(int)($i/6)*17), number_format($roof_points,2,".",","))
                    ->setCellValue( 'P'.(49+($pages-1)*(40-6)+(int)($i/6)*17), number_format($floor_points,2,".",","))
                    ->setCellValue( 'P'.(50+($pages-1)*(40-6)+(int)($i/6)*17), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'P'.(51+($pages-1)*(40-6)+(int)($i/6)*17), number_format($door_points,2,".",","))
                    ->setCellValue( 'P'.(52+($pages-1)*(40-6)+(int)($i/6)*17), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'P'.(53+($pages-1)*(40-6)+(int)($i/6)*17), number_format($electric_points,2,".",","))
                    ->setCellValue( 'P'.(55+($pages-1)*(40-6)+(int)($i/6)*17), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'P'.(56+($pages-1)*(40-6)+(int)($i/6)*17), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'P'.(57+($pages-1)*(40-6)+(int)($i/6)*17), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'P'.(58+($pages-1)*(40-6)+(int)($i/6)*17), (100+$extra_percent)."%");
                    break;
        case 3:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'R'.(37+($pages-1)*(40-6)+(int)($i/6)*17), $i+1)
                    ->setCellValue( 'R'.(38+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'R'.(39+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'R'.(40+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'R'.(41+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'R'.(42+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'R'.(43+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'R'.(45+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_divide_text)
                    ->setCellValue( 'R'.(46+($pages-1)*(40-6)+(int)($i/6)*17), $outdoor_wall_text)
                    ->setCellValue( 'R'.(47+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_wall_text)
                    ->setCellValue( 'R'.(48+($pages-1)*(40-6)+(int)($i/6)*17), $roof_text)
                    ->setCellValue( 'R'.(49+($pages-1)*(40-6)+(int)($i/6)*17), $floor_text)
                    ->setCellValue( 'R'.(50+($pages-1)*(40-6)+(int)($i/6)*17), $ceiling_text)
                    ->setCellValue( 'R'.(51+($pages-1)*(40-6)+(int)($i/6)*17), $door_text)
                    ->setCellValue( 'R'.(52+($pages-1)*(40-6)+(int)($i/6)*17), $toilet_text)
                    ->setCellValue( 'R'.(53+($pages-1)*(40-6)+(int)($i/6)*17), $electric_text)
                    ->setCellValue( 'R'.(54+($pages-1)*(40-6)+(int)($i/6)*17), $electric_type)
                    ->setCellValue( 'R'.(55+($pages-1)*(40-6)+(int)($i/6)*17), $window_level_text)
                    ->setCellValue( 'R'.(56+($pages-1)*(40-6)+(int)($i/6)*17), $balcony_text)
                    ->setCellValue( 'R'.(57+($pages-1)*(40-6)+(int)($i/6)*17), $daughter_text)
                    ->setCellValue( 'R'.(58+($pages-1)*(40-6)+(int)($i/6)*17), $height_text)
                    ->setCellValue( 'R'.(59+($pages-1)*(40-6)+(int)($i/6)*17), $total_points)

                    // 塞入評點
                    ->setCellValue( 'V'.(41+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'V'.(45+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'V'.(46+($pages-1)*(40-6)+(int)($i/6)*17), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'V'.(47+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'V'.(48+($pages-1)*(40-6)+(int)($i/6)*17), number_format($roof_points,2,".",","))
                    ->setCellValue( 'V'.(49+($pages-1)*(40-6)+(int)($i/6)*17), number_format($floor_points,2,".",","))
                    ->setCellValue( 'V'.(50+($pages-1)*(40-6)+(int)($i/6)*17), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'V'.(51+($pages-1)*(40-6)+(int)($i/6)*17), number_format($door_points,2,".",","))
                    ->setCellValue( 'V'.(52+($pages-1)*(40-6)+(int)($i/6)*17), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'V'.(53+($pages-1)*(40-6)+(int)($i/6)*17), number_format($electric_points,2,".",","))
                    ->setCellValue( 'V'.(55+($pages-1)*(40-6)+(int)($i/6)*17), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'V'.(56+($pages-1)*(40-6)+(int)($i/6)*17), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'V'.(57+($pages-1)*(40-6)+(int)($i/6)*17), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'V'.(58+($pages-1)*(40-6)+(int)($i/6)*17), (100+$extra_percent)."%");
                    break;
        case 4:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'W'.(37+($pages-1)*(40-6)+(int)($i/6)*17), $i+1)
                    ->setCellValue( 'W'.(38+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'W'.(39+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'W'.(40+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'W'.(41+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'W'.(42+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'W'.(43+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'W'.(45+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_divide_text)
                    ->setCellValue( 'W'.(46+($pages-1)*(40-6)+(int)($i/6)*17), $outdoor_wall_text)
                    ->setCellValue( 'W'.(47+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_wall_text)
                    ->setCellValue( 'W'.(48+($pages-1)*(40-6)+(int)($i/6)*17), $roof_text)
                    ->setCellValue( 'W'.(49+($pages-1)*(40-6)+(int)($i/6)*17), $floor_text)
                    ->setCellValue( 'W'.(50+($pages-1)*(40-6)+(int)($i/6)*17), $ceiling_text)
                    ->setCellValue( 'W'.(51+($pages-1)*(40-6)+(int)($i/6)*17), $door_text)
                    ->setCellValue( 'W'.(52+($pages-1)*(40-6)+(int)($i/6)*17), $toilet_text)
                    ->setCellValue( 'W'.(53+($pages-1)*(40-6)+(int)($i/6)*17), $electric_text)
                    ->setCellValue( 'W'.(54+($pages-1)*(40-6)+(int)($i/6)*17), $electric_type)
                    ->setCellValue( 'W'.(55+($pages-1)*(40-6)+(int)($i/6)*17), $window_level_text)
                    ->setCellValue( 'W'.(56+($pages-1)*(40-6)+(int)($i/6)*17), $balcony_text)
                    ->setCellValue( 'W'.(57+($pages-1)*(40-6)+(int)($i/6)*17), $daughter_text)
                    ->setCellValue( 'W'.(58+($pages-1)*(40-6)+(int)($i/6)*17), $height_text)
                    ->setCellValue( 'W'.(59+($pages-1)*(40-6)+(int)($i/6)*17), $total_points)

                    // 塞入評點
                    ->setCellValue( 'AA'.(41+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'AA'.(45+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'AA'.(46+($pages-1)*(40-6)+(int)($i/6)*17), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'AA'.(47+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'AA'.(48+($pages-1)*(40-6)+(int)($i/6)*17), number_format($roof_points,2,".",","))
                    ->setCellValue( 'AA'.(49+($pages-1)*(40-6)+(int)($i/6)*17), number_format($floor_points,2,".",","))
                    ->setCellValue( 'AA'.(50+($pages-1)*(40-6)+(int)($i/6)*17), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'AA'.(51+($pages-1)*(40-6)+(int)($i/6)*17), number_format($door_points,2,".",","))
                    ->setCellValue( 'AA'.(52+($pages-1)*(40-6)+(int)($i/6)*17), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'AA'.(53+($pages-1)*(40-6)+(int)($i/6)*17), number_format($electric_points,2,".",","))
                    ->setCellValue( 'AA'.(55+($pages-1)*(40-6)+(int)($i/6)*17), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'AA'.(56+($pages-1)*(40-6)+(int)($i/6)*17), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'AA'.(57+($pages-1)*(40-6)+(int)($i/6)*17), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'AA'.(58+($pages-1)*(40-6)+(int)($i/6)*17), (100+$extra_percent)."%");
                    break;
        case 5:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'AC'.(37+($pages-1)*(40-6)+(int)($i/6)*17), $i+1)
                    ->setCellValue( 'AC'.(38+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'AC'.(39+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'AC'.(40+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'AC'.(41+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'AC'.(42+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'AC'.(43+($pages-1)*(40-6)+(int)($i/6)*17), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'AC'.(45+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_divide_text)
                    ->setCellValue( 'AC'.(46+($pages-1)*(40-6)+(int)($i/6)*17), $outdoor_wall_text)
                    ->setCellValue( 'AC'.(47+($pages-1)*(40-6)+(int)($i/6)*17), $indoor_wall_text)
                    ->setCellValue( 'AC'.(48+($pages-1)*(40-6)+(int)($i/6)*17), $roof_text)
                    ->setCellValue( 'AC'.(49+($pages-1)*(40-6)+(int)($i/6)*17), $floor_text)
                    ->setCellValue( 'AC'.(50+($pages-1)*(40-6)+(int)($i/6)*17), $ceiling_text)
                    ->setCellValue( 'AC'.(51+($pages-1)*(40-6)+(int)($i/6)*17), $door_text)
                    ->setCellValue( 'AC'.(52+($pages-1)*(40-6)+(int)($i/6)*17), $toilet_text)
                    ->setCellValue( 'AC'.(53+($pages-1)*(40-6)+(int)($i/6)*17), $electric_text)
                    ->setCellValue( 'AC'.(54+($pages-1)*(40-6)+(int)($i/6)*17), $electric_type)
                    ->setCellValue( 'AC'.(55+($pages-1)*(40-6)+(int)($i/6)*17), $window_level_text)
                    ->setCellValue( 'AC'.(56+($pages-1)*(40-6)+(int)($i/6)*17), $balcony_text)
                    ->setCellValue( 'AC'.(57+($pages-1)*(40-6)+(int)($i/6)*17), $daughter_text)
                    ->setCellValue( 'AC'.(58+($pages-1)*(40-6)+(int)($i/6)*17), $height_text)
                    ->setCellValue( 'AC'.(59+($pages-1)*(40-6)+(int)($i/6)*17), $total_points)

                    // 塞入評點
                    ->setCellValue( 'AF'.(41+($pages-1)*(40-6)+(int)($i/6)*17), number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'AF'.(45+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'AF'.(46+($pages-1)*(40-6)+(int)($i/6)*17), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'AF'.(47+($pages-1)*(40-6)+(int)($i/6)*17), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'AF'.(48+($pages-1)*(40-6)+(int)($i/6)*17), number_format($roof_points,2,".",","))
                    ->setCellValue( 'AF'.(49+($pages-1)*(40-6)+(int)($i/6)*17), number_format($floor_points,2,".",","))
                    ->setCellValue( 'AF'.(50+($pages-1)*(40-6)+(int)($i/6)*17), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'AF'.(51+($pages-1)*(40-6)+(int)($i/6)*17), number_format($door_points,2,".",","))
                    ->setCellValue( 'AF'.(52+($pages-1)*(40-6)+(int)($i/6)*17), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'AF'.(53+($pages-1)*(40-6)+(int)($i/6)*17), number_format($electric_points,2,".",","))
                    ->setCellValue( 'AF'.(55+($pages-1)*(40-6)+(int)($i/6)*17), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'AF'.(56+($pages-1)*(40-6)+(int)($i/6)*17), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'AF'.(57+($pages-1)*(40-6)+(int)($i/6)*17), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'AF'.(58+($pages-1)*(40-6)+(int)($i/6)*17), (100+$extra_percent)."%");
                    break;
    }
}
// 雜項物計算式
$subText = array('','','','');
$lineCount = 1;

$subText[(int)($lineCount/37)]  = $subText[(int)($lineCount/37)]."◆主要結構部份\n";
$lineCount++;
for($i=0;$i<count($main_building_data);$i++){
    $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].($i+1).". ".$main_building_data[$i]["structure"]." ".$main_building_data[$i]["nth_floor"]."/".count($main_building_data)."樓\n   面積 : ".$main_building_data[$i]["floor_area"]."=".$main_building_data[$i]["floor_area"]."㎡\n";
    $lineCount += 2;
}
$subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)]."◆雜項工作物部份(室內)\n";
$lineCount++;
for($i=0;$i<count($sub_building_data);$i++){
    $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].($i+1).". ".$sub_building_data[$i]["item_name"]." : ".number_format($sub_building_data[$i]["unitprice"],0,".",",")."元/".$sub_building_data[$i]["unit"]."\n   ";
    $lineCount++;
    if($sub_building_data[$i]["unit"]!="㎡" && $sub_building_data[$i]["unit"]!="m³"){
        $text = "數量 : ";
    }
    else{
        $text = "面積 : ";
    }
    $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].$text.$sub_building_data[$i]["area_calculate_text"]."=".$sub_building_data[$i]["area"].$sub_building_data[$i]["unit"]."\n   ".$sub_building_data[$i]["area"]."*".number_format($sub_building_data[$i]["unitprice"],0,".",",")."=".number_format($sub_building_data[$i]["area"]*$sub_building_data[$i]["unitprice"],0,".",",")."元\n";
    $lineCount += 2;
}
$subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)]."◆雜項工作物部份(室外)\n";
$lineCount++;
for($i=0;$i<count($outdoor_sub_building_data);$i++){
    $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].($i+1).". ".$outdoor_sub_building_data[$i]["item_name"]." : ".number_format($outdoor_sub_building_data[$i]["unitprice"],0,".",",")."元/".$outdoor_sub_building_data[$i]["unit"]."\n   ";
    $lineCount++;
    if($outdoor_sub_building_data[$i]["unit"]!="㎡" && $outdoor_sub_building_data[$i]["unit"]!="m³"){
        $text = "數量 : ";
    }
    else{
        $text = "面積 : ";
    }
    $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].$text.$outdoor_sub_building_data[$i]["area_calculate_text"]."=".$outdoor_sub_building_data[$i]["area"].$outdoor_sub_building_data[$i]["unit"]."\n   ".$outdoor_sub_building_data[$i]["area"]."*".number_format($outdoor_sub_building_data[$i]["unitprice"],0,".",",")."=".number_format($outdoor_sub_building_data[$i]["area"]*$outdoor_sub_building_data[$i]["unitprice"],0,".",",")."元\n";
    $lineCount += 2;
}
for($i=0;$i<count($subText);$i++){
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'AC'.(64+($pages-1)*34+($i*42)), $subText[$i]);
}


$objActSheet = $objPHPExcel->getActiveSheet();
$objActSheet->setTitle($script_number);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
if($compensate_type == "補償"){
    $savePath = "file/building/legal/".substr($script_number,strlen($script_number)-3,strlen($script_number))."/";
}
else{
    $savePath = "file/building/illegal/".substr($script_number,strlen($script_number)-3,strlen($script_number))."/";
}

if(!file_exists($savePath)){
    mkdir($savePath);
}

$fileNo = $script_number."-1";
$filename = base64_encode($fileNo);
$file_type = ".xls";
echo $savePath;
$objWriter->save($savePath.$filename.$file_type);
insertFileData($script_number,$savePath,$fileNo,$filename,$file_type,"file_table");
$total_pay = $total_fee+$total_subbuilding_fee+$out_total_subbuilding_fee+$total_auto+$total_auto_remove_fee+$out_total_auto_remove_fee;
exportBuildingHoldRatioExcel($script_number,$land_owner_data,$building_data,$land_data,$total_pay);

// 輸出文字檔
// $fileNo = $script_number."-2";
// $filename = base64_encode($fileNo);
// $file_type = ".txt";
// if(file_exists($savePath.$filename.$file_type)){
//     unlink($savePath.$filename.$file_type);
// }
// $file = fopen($savePath.$filename.$file_type,"a+"); //開啟檔案
//
// fwrite($file,"◆主要結構部份\r\n");
// for($i=0;$i<count($main_building_data);$i++){
//     fwrite($file,($i+1).". ".$main_building_data[$i]["structure"]." ".$main_building_data[$i]["nth_floor"]."/".count($main_building_data)."樓\r\n   面積 : ".$main_building_data[$i]["floor_area"]."=".$main_building_data[$i]["floor_area"]."㎡\r\n");
// }
// fwrite($file,"◆雜項工作物部份(室內)\r\n");
// for($i=0;$i<count($sub_building_data);$i++){
//     fwrite($file,($i+1).". ".$sub_building_data[$i]["item_name"]." : ".number_format($sub_building_data[$i]["unitprice"],0,".",",")."元/".$sub_building_data[$i]["unit"]."\r\n   ");
//     if($sub_building_data[$i]["unit"]!="㎡" && $sub_building_data[$i]["unit"]!="m³"){
//         $text = "數量 : ";
//     }
//     else{
//         $text = "面積 : ";
//     }
//     fwrite($file,$text.$sub_building_data[$i]["area_calculate_text"]."=".$sub_building_data[$i]["area"].$sub_building_data[$i]["unit"]."\r\n   ".$sub_building_data[$i]["area"]."*".number_format($sub_building_data[$i]["unitprice"],0,".",",")."=".number_format($sub_building_data[$i]["area"]*$sub_building_data[$i]["unitprice"],0,".",",")."元\r\n");
// }
// fwrite($file,"◆雜項工作物部份(室外)\r\n");
// for($i=0;$i<count($outdoor_sub_building_data);$i++){
//     fwrite($file,($i+1).". ".$outdoor_sub_building_data[$i]["item_name"]." : ".number_format($outdoor_sub_building_data[$i]["unitprice"],0,".",",")."元/".$outdoor_sub_building_data[$i]["unit"]."\r\n   ");
//     if($outdoor_sub_building_data[$i]["unit"]!="㎡" && $outdoor_sub_building_data[$i]["unit"]!="m³"){
//         $text = "數量 : ";
//     }
//     else{
//         $text = "面積 : ";
//     }
//     fwrite($file,$text.$outdoor_sub_building_data[$i]["area_calculate_text"]."=".$outdoor_sub_building_data[$i]["area"].$outdoor_sub_building_data[$i]["unit"]."\r\n   ".$outdoor_sub_building_data[$i]["area"]."*".number_format($outdoor_sub_building_data[$i]["unitprice"],0,".",",")."=".number_format($outdoor_sub_building_data[$i]["area"]*$outdoor_sub_building_data[$i]["unitprice"],0,".",",")."元\r\n");
// }
//
// fclose($file);
// insertFileData($script_number,$savePath,$fileNo,$filename,$file_type);
// $objWriter->save('file/myexchel.xls');
date_default_timezone_set('Asia/Taipei');
// $objWriter->save('file/'.date("YmdHis").'.xls');

echo json_encode(array('status' => 'completed','tt' => $balcony_text));
echo "<br>";
echo "hi: ".$daughter_text;

// function processDecorationText($data){
//     $text = "";
//
//     if($data!=null){
//         for($j=0;$j<count($data);$j++){
//             $text = $text.$data[$j]["ratio"]." ".$data[$j]["item_name"]."\n";
//         }
//         return $text;
//     }
//     return null;
// }
//
// function processDecorationPoints($data){
//     $points = 0;
//
//     if($data!=null){
//         for($j=0;$j<count($data);$j++){
//             $points += $data[$j]["ratio"]*$data[$j]["points"];
//         }
//         return $points;
//     }
//     return null;
// }
?>
