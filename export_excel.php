<?php
include "library.php";
include "export_building_hold_ratio_excel.php";
// $script_number = $_POST['script_number'];
// $house_address = $_POST["house_address"];
//
// $data = getRecordData($house_address);
$script_number = $_REQUEST["script_number"];
$house_address = $_REQUEST["house_address"];
$survey_date = getSurveyDate("record",$script_number);
$survey_date_split = explode("-",$survey_date);
// $script_number = "建合-007";
// $house_address = "測試用";
// $script_number = "建合-001";
// $house_address = "建國二路100號";
$price = 12;
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
        $section_array[$section_index] = $land_data[$i]["land_section"].$land_data[$i]["subsection"];
        // $land_section = $land_section.$land_data[$i]["land_section"].$land_data[$i]["subsection"];
        // if($i!=count($land_data)-1) {
        //     $land_section = $land_section."、";
        // }
    }
    $land_number = $land_number.$land_data[$i]["land_number"];
    if($i!=count($land_data)-1) {
        $land_number = $land_number."、";
    }
    $total_land_area += $land_data[$i]["area"];
}

for($i=0;$i<count($section_array);$i++){
    $land_section = $land_section.$section_array[$i];
    if($i!=count($section_array)-1) {
        $land_section = $land_section."、";
    }
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
$hold_id = "";
if(count($owner_data)>1){
    $text = '等'.count($owner_data).'人';
    for($i=0;$i<count($owner_data);$i++){
        $hold_id = $hold_id . $owner_data[$i]["hold_id"];
        if($i!=count($owner_data)-1){
            $hold_id = $hold_id  . "、";
        }
    }
}
else{
    $text = "";
    $hold_id = $owner_data[0]["hold_id"];
}

$phone = $owner_data[0]["cellphone"];
if($owner_data[0]["cellphone"] == ""){
    $phone = $owner_data[0]["telephone"];
}

// 土地所有人
// $hold_id = "";
if(count($land_owner_data)>1){
    $land_text = '等'.count($land_owner_data).'人';
    // for($i=0;$i<count($land_owner_data);$i++){
    //     $hold_id = $hold_id . $land_owner_data[$i]["hold_id"];
    //     if($i!=count($land_owner_data)-1){
    //         $hold_id = $hold_id  . "、";
    //     }
    // }
}
else{
    $land_text = "";
    // $hold_id = $land_owner_data[0]["hold_id"];
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

// 建物所有人身份證字號空值不顯示
if(substr($owner_data[0]["pId"],0,2) == "NA"){
    $pIdText = "";
}
else{
    $pIdText = $owner_data[0]["pId"];
}
// 地主身份證字號空值不顯示
if(substr($land_owner_data[0]["pId"],0,2) == "NA"){
    $landPIdText = "";
}
else{
    $landPIdText = $land_owner_data[0]["pId"];
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
// 輸出基本個資
date_default_timezone_set('Asia/Taipei');
echo "日期<br>";
echo date("Y-m-d H:i:s");
for($i=0;$i<$pages;$i++){
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'AJ'.(3+$i*33), str_replace("-", "", $script_number))
                ->setCellValue( 'S'.(3+$i*33), $title)
                ->setCellValue( 'C'.(3+$i*33), $hold_id)
                ->setCellValue( 'AC'.(11+$i*33), $building_text)
                ->setCellValue( 'M'.(21+$i*33), $sub_building_text)
                ->setCellValue( 'AG'.(21+$i*33), $sub_building_text)
                ->setCellValue( 'C'.(4+$i*33), $owner_data[0]["name"].$text)
                ->setCellValue( 'G'.(4+$i*33), $pIdText)
                ->setCellValue( 'M'.(4+$i*33), $owner_data[0]["current_address"])
                ->setCellValue( 'Y'.(4+$i*33), $owner_data[0]["telephone"]."\n".$owner_data[0]["cellphone"])
                // 地主資料待更新，暫時與建物相同

                ->setCellValue( 'C'.(5+$i*33), $land_owner_data[0]["name"].$land_text)
                ->setCellValue( 'G'.(5+$i*33), $landPIdText)
                ->setCellValue( 'M'.(5+$i*33), $land_owner_data[0]["current_address"])
                ->setCellValue( 'Y'.(5+$i*33), $land_owner_data[0]["telephone"]."\n".$land_owner_data[0]["cellphone"])

                ->setCellValue( 'AG'.(4+$i*33), $legal_text)
                ->setCellValue( 'AG'.(5+$i*33), $building_data[0]["legal_certificate"])
                ->setCellValue( 'AG'.(7+$i*33), $building_data[0]["remove_condition"])
                ->setCellValue( 'C'.(6+$i*33), $building_data[0]["real_address"])
                ->setCellValue( 'P'.(6+$i*33), $building_data[0]["build_number"]."\n".$building_data[0]["tax_number"])
                ->setCellValue( 'Y'.(6+$i*33), $land_data[0]["land_use"])
                ->setCellValue( 'AG'.(6+$i*33), $rent_text)
                ->setCellValue( 'C'.(7+$i*33), '桃園市')
                // 行政區尚未設定
                ->setCellValue( 'E'.(7+$i*33), $land_data[0]["dist"])
                ->setCellValue( 'G'.(7+$i*33), $land_section)
                // ->setCellValue( 'K7', $land_data[0]['land_number'])
                ->setCellValue( 'L'.(7+$i*33), $land_number)
                // ->setCellValue( 'X7', $land_data[0]['area']);
                ->setCellValue( 'Y'.(7+$i*33), $total_land_area)
                ->setCellValue( 'C'.(33+$i*33), ($survey_date_split[0]-1911)."年".$survey_date_split[1]."月".$survey_date_split[2]."日");
}

$total_people = 0;
$total_migration_fee = 0;
$migration_fee = [];
$mf_index = 0;
$exit_num = getExitNum($script_number);
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

    if($exit_num == 1){
        $resident_data[$i]["move_status"] = "";
    }

    if($i%2==0){
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'C'.(floor($i/2+9)), $resident_data[$i]["captain_name"])
                    ->setCellValue( 'E'.(floor($i/2+9)), $resident_data[$i]["family_num"])
                    ->setCellValue( 'G'.(floor($i/2+9)), $resident_data[$i]["household_number"])
                    ->setCellValue( 'K'.(floor($i/2+9)), $resident_data[$i]["set_household_date"])
                    ->setCellValue( 'O'.(floor($i/2+9)), $resident_data[$i]["move_status"].number_format($resident_data[$i]["fee"],0,".",","));
    }
    else{
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'T'.(floor($i/2+9)), $resident_data[$i]["captain_name"])
                    ->setCellValue( 'V'.(floor($i/2+9)), $resident_data[$i]["family_num"])
                    ->setCellValue( 'Y'.(floor($i/2+9)), $resident_data[$i]["household_number"])
                    ->setCellValue( 'AC'.(floor($i/2+9)), $resident_data[$i]["set_household_date"])
                    ->setCellValue( 'AG'.(floor($i/2+9)), $resident_data[$i]["move_status"].number_format($resident_data[$i]["fee"],0,".",","));
    }
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'Y10', $total_people)
                ->setCellValue( 'AG10', $total_migration_fee);
}
// 輸出主建物資料
$total_area = 0;
$total_price = 0;
$total_fee = 0;
$total_auto = 0;
for($i=0;$i<count($main_building_data);$i++){
    $fId = "";
    $fee = number_format(($main_building_data[$i]["points"]+$add_minus_wall_points[$i])*$main_building_data[$i]["floor_area"]*$price,0,"","");
    $fId_split = explode('-', $main_building_data[$i]["fId"]);
    for($j=2;$j<count($fId_split);$j++){
        $fId = $fId.$fId_split[$j];
        if($j != count($fId_split)-1){
            $fId = $fId."-";
        }
    }
    if($i<7){
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'A'.($i+13), $fId)
                    ->setCellValue( 'C'.($i+13), $main_building_data[$i]["structure"].$main_building_data[$i]["floor_type"].$add_minus_wall_text[$i])
                    ->setCellValue( 'I'.($i+13), $main_building_data[$i]["nth_floor"]."/".$main_building_data[$i]["total_floor"])
                    ->setCellValue( 'K'.($i+13), $main_building_data[$i]["use_type"])
                    ->setCellValue( 'M'.($i+13), $main_building_data[$i]["points"]+$add_minus_wall_points[$i])
                    ->setCellValue( 'P'.($i+13), $main_building_data[$i]["points"]+$add_minus_wall_points[$i])
                    ->setCellValue( 'R'.($i+13), $price)
                    ->setCellValue( 'T'.($i+13), $main_building_data[$i]["floor_area"])
                    ->setCellValue( 'V'.($i+13), $fee)
                    ->setCellValue( 'AA'.($i+13), $compensate_type);
    }
    else{
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'A'.($i+40), $fId)
                    ->setCellValue( 'C'.($i+40), $main_building_data[$i]["structure"].$main_building_data[$i]["floor_type"].$add_minus_wall_text[$i])
                    ->setCellValue( 'I'.($i+40), $main_building_data[$i]["nth_floor"]."/".$main_building_data[$i]["total_floor"])
                    ->setCellValue( 'K'.($i+40), $main_building_data[$i]["use_type"])
                    ->setCellValue( 'M'.($i+40), $main_building_data[$i]["points"]+$add_minus_wall_points[$i])
                    ->setCellValue( 'P'.($i+40), $main_building_data[$i]["points"]+$add_minus_wall_points[$i])
                    ->setCellValue( 'R'.($i+40), $price)
                    ->setCellValue( 'T'.($i+40), $main_building_data[$i]["floor_area"])
                    ->setCellValue( 'V'.($i+40), $fee)
                    ->setCellValue( 'AA'.($i+40), $compensate_type);
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
                // $total_price += $fee;
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
                        ->setCellValue( 'AC'.($i+13), $fee*$discard_ratio)
                        ->setCellValue( 'AG'.($i+13), number_format($fee*$discard_ratio*0.5,0,"",""))
                        ->setCellValue( 'AJ'.($i+13), $hint);
                        // $total_fee += $fee*$discard_ratio;
                        // $total_auto += number_format($fee*$discard_ratio*0.5,0,"","");
        }
        else{
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue( 'AC'.($i+40), $fee*$discard_ratio)
                        ->setCellValue( 'AG'.($i+40), number_format($fee*$discard_ratio*0.5,0,"",""))
                        ->setCellValue( 'AJ'.($i+40), $hint);
                        // $total_fee += $fee*$discard_ratio;
                        // $total_auto += number_format($fee*$discard_ratio*0.5,0,"","");
        }
    }
    else{
        if($i<7){
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue( 'AC'.($i+13), number_format($fee*$discard_ratio*0.6,0,"",""))
                        ->setCellValue( 'AG'.($i+13), number_format($fee*$discard_ratio*0.6*0.5,0,"",""))
                        ->setCellValue( 'AJ'.($i+13), $hint);
                        // $total_fee += number_format($fee*$discard_ratio*0.6,0,"","");
                        // $total_auto += number_format($fee*$discard_ratio*0.6*0.5,0,"","");
        }
        else{
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue( 'AC'.($i+40), number_format($fee*$discard_ratio*0.6,0,"",""))
                        ->setCellValue( 'AG'.($i+40), number_format($fee*$discard_ratio*0.6*0.5,0,"",""))
                        ->setCellValue( 'AJ'.($i+40), $hint);
                        // $total_fee += number_format($fee*$discard_ratio*0.6,0,"","");
                        // $total_auto += number_format($fee*$discard_ratio*0.6*0.5,0,"","");
        }
    }
}

// if(count($main_building_data)<=7){
//     $objPHPExcel->setActiveSheetIndex(0)
//                 ->setCellValue( 'T20', $total_area)
//                 ->setCellValue( 'V20', $total_price)
//                 ->setCellValue( 'AC20', $total_fee)
//                 ->setCellValue( 'AG20', $total_auto);
// }
// else{
//     $objPHPExcel->setActiveSheetIndex(0)
//                 ->setCellValue( 'T54', $total_area)
//                 ->setCellValue( 'V54', $total_price)
//                 ->setCellValue( 'AC54', $total_fee)
//                 ->setCellValue( 'AG54', $total_auto);
// }

// 室內雜項物
$total_init_fee = 0;
$total_subbuilding_fee = 0;
$total_auto_remove_fee = 0;
$page_item_index = 23;
$page_fee_index = 30;
$total_index = 31;
for($i=0;$i<count($sub_building_data);$i++){
    if($sub_building_data[$i]["application"] == "圍牆"){
        $sub_building_data[$i]["application"] = "";
        $sub_building_data[$i]["item_name"] = getFenceItemName($sub_building_data[$i]);
        $sub_building_data[$i]["unitprice"] = getFencePrice($sub_building_data[$i]);
    }

    if($sub_building_data[$i]["note"] != "合法" && $sub_building_data[$i]["note"] != "非法"){
        if($compensate_type == "補償"){
            $sub_building_data[$i]["note"] = "合法";
        }
        else{
            $sub_building_data[$i]["note"] = "非法";
        }
    }

    $init_fee = number_format($sub_building_data[$i]["unitprice"]*number_format($sub_building_data[$i]["area"],2,".",","),0,"","");
    if($sub_building_data[$i]["note"] == "合法"){
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

    if($sub_building_data[$i]["application"] == "遷移費部份"){
        $sub_building_data[$i]["application"] = "";
    }

    if(($i+1)%8==0){
        $page_item_index = $page_item_index+33;
        $page_fee_index = $page_fee_index+33;

        // if(($i+1)!=count($sub_building_data)){
            $nth_row = $i/7;

            $objPHPExcel->getActiveSheet()->unmergeCells('A'.(30+($nth_row-1)*33).':'.'B'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('C'.(30+($nth_row-1)*33).':'.'E'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('G'.(30+($nth_row-1)*33).':'.'H'.(30+($nth_row-1)*34));
            // $objPHPExcel->getActiveSheet()->unmergeCells('J'.(30+($nth_row-1)*34).':'.'K'.(30+($nth_row-1)*34));
            // $objPHPExcel->getActiveSheet()->unmergeCells('L'.(30+($nth_row-1)*34).':'.'N'.(30+($nth_row-1)*34));
            // $objPHPExcel->getActiveSheet()->unmergeCells('O'.(30+($nth_row-1)*34).':'.'P'.(30+($nth_row-1)*34));
            // $objPHPExcel->getActiveSheet()->unmergeCells('Q'.(30+($nth_row-1)*34).':'.'R'.(30+($nth_row-1)*34));
            // $objPHPExcel->getActiveSheet()->mergeCells('A'.(30+($nth_row-1)*34).':'.'R'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('K'.(30+($nth_row-1)*33).':'.'L'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('M'.(30+($nth_row-1)*33).':'.'O'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('P'.(30+($nth_row-1)*33).':'.'Q'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('R'.(30+($nth_row-1)*33).':'.'S'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->mergeCells('A'.(30+($nth_row-1)*33).':'.'S'.(30+($nth_row-1)*34));
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue( 'A'.(30+($nth_row-1)*33), '下頁接續');
        // }
    }
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A'.($i%7+$page_item_index), $i+1)
                ->setCellValue( 'C'.($i%7+$page_item_index), $sub_building_data[$i]["item_name"])
                ->setCellValue( 'F'.($i%7+$page_item_index), $sub_building_data[$i]["application"])
                ->setCellValue( 'G'.($i%7+$page_item_index), $sub_building_data[$i]["unitprice"])
                ->setCellValue( 'I'.($i%7+$page_item_index), number_format($sub_building_data[$i]["area"],2,".",","))
                ->setCellValue( 'J'.($i%7+$page_item_index), $sub_building_data[$i]["unit"])
                ->setCellValue( 'K'.($i%7+$page_item_index), $init_fee)
                ->setCellValue( 'M'.($i%7+$page_item_index), $sub_building_fee)
                ->setCellValue( 'P'.($i%7+$page_item_index), $auto_remove_fee);
                $total_init_fee += $init_fee;
                $total_subbuilding_fee += $sub_building_fee;
                $total_auto_remove_fee += $auto_remove_fee;
}
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'A'.$page_fee_index, '小計')
            ->setCellValue( 'K'.$page_fee_index, $total_init_fee)
            ->setCellValue( 'M'.$page_fee_index, $total_subbuilding_fee)
            ->setCellValue( 'P'.$page_fee_index, $total_auto_remove_fee);

// 室外雜項物
$out_total_init_fee = 0;
$out_total_subbuilding_fee = 0;
$out_total_auto_remove_fee = 0;
$out_page_item_index = 23;
$out_page_fee_index = 30;
for($i=0;$i<count($outdoor_sub_building_data);$i++){
    if($outdoor_sub_building_data[$i]["application"] == "圍牆"){
        $outdoor_sub_building_data[$i]["application"] = "";
        $outdoor_sub_building_data[$i]["item_name"] = getFenceItemName($outdoor_sub_building_data[$i]);
        $outdoor_sub_building_data[$i]["unitprice"] = getFencePrice($outdoor_sub_building_data[$i]);
    }

    if($outdoor_sub_building_data[$i]["note"] != "合法" && $outdoor_sub_building_data[$i]["note"] != "非法"){
        if($compensate_type == "補償"){
            $outdoor_sub_building_data[$i]["note"] = "合法";
        }
        else{
            $outdoor_sub_building_data[$i]["note"] = "非法";
        }
    }

    $init_fee = number_format($outdoor_sub_building_data[$i]["unitprice"]*number_format($outdoor_sub_building_data[$i]["area"],2,".",","),0,"","");
    if($outdoor_sub_building_data[$i]["note"] == "合法"){
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

    if($outdoor_sub_building_data[$i]["application"] == "遷移費部份"){
        $outdoor_sub_building_data[$i]["application"] = "";
    }

    if(($i+1)%8==0){
        $out_page_item_index = $out_page_item_index+33;
        $out_page_fee_index = $out_page_fee_index+33;
        // if(($i+1)!=count($outdoor_sub_building_data)){
            $nth_row = $i/7;

            // $objPHPExcel->getActiveSheet()->unmergeCells('S'.(30+($nth_row-1)*34).':'.'T'.(30+($nth_row-1)*34));
            // $objPHPExcel->getActiveSheet()->unmergeCells('U'.(30+($nth_row-1)*34).':'.'X'.(30+($nth_row-1)*34));
            // $objPHPExcel->getActiveSheet()->unmergeCells('Z'.(30+($nth_row-1)*34).':'.'AA'.(30+($nth_row-1)*34));
            // $objPHPExcel->getActiveSheet()->unmergeCells('AB'.(30+($nth_row-1)*34).':'.'AC'.(30+($nth_row-1)*34));
            // $objPHPExcel->getActiveSheet()->unmergeCells('AE'.(30+($nth_row-1)*34).':'.'AG'.(30+($nth_row-1)*34));
            // $objPHPExcel->getActiveSheet()->mergeCells('S'.(30+($nth_row-1)*34).':'.'AI'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('T'.(30+($nth_row-1)*33).':'.'U'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('V'.(30+($nth_row-1)*33).':'.'Y'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('AA'.(30+($nth_row-1)*33).':'.'AB'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('AC'.(30+($nth_row-1)*33).':'.'AD'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->unmergeCells('AG'.(30+($nth_row-1)*33).':'.'AI'.(30+($nth_row-1)*34));
            $objPHPExcel->getActiveSheet()->mergeCells('T'.(30+($nth_row-1)*33).':'.'AK'.(30+($nth_row-1)*34));
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue( 'T'.(30+($nth_row-1)*33), '下頁接續');
        // }
    }
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'T'.($i%7+$out_page_item_index), $i+1)
                ->setCellValue( 'V'.($i%7+$out_page_item_index), $outdoor_sub_building_data[$i]["item_name"])
                ->setCellValue( 'Z'.($i%7+$out_page_item_index), $outdoor_sub_building_data[$i]["application"])
                ->setCellValue( 'AA'.($i%7+$out_page_item_index), $outdoor_sub_building_data[$i]["unitprice"])
                ->setCellValue( 'AC'.($i%7+$out_page_item_index), number_format($outdoor_sub_building_data[$i]["area"],2,".",","))
                ->setCellValue( 'AE'.($i%7+$out_page_item_index), $outdoor_sub_building_data[$i]["unit"])
                ->setCellValue( 'AF'.($i%7+$out_page_item_index), $init_fee)
                ->setCellValue( 'AG'.($i%7+$out_page_item_index), $sub_building_fee)
                ->setCellValue( 'AJ'.($i%7+$out_page_item_index), $auto_remove_fee);
                $out_total_init_fee += $init_fee;
                $out_total_subbuilding_fee += $sub_building_fee;
                $out_total_auto_remove_fee += $auto_remove_fee;
}
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'T'.$out_page_fee_index, '小計')
            ->setCellValue( 'AF'.$out_page_fee_index, $out_total_init_fee)
            ->setCellValue( 'AG'.$out_page_fee_index, $out_total_subbuilding_fee)
            ->setCellValue( 'AJ'.$out_page_fee_index, $out_total_auto_remove_fee);
// // 合計欄位
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue( 'T'.(31+($pages-1)*33), '合計')
//             ->setCellValue( 'AF'.(31+($pages-1)*33), $total_price+$total_init_fee+$out_total_init_fee)
//             ->setCellValue( 'AG'.(31+($pages-1)*33), $total_fee+$total_subbuilding_fee+$out_total_subbuilding_fee)
//             ->setCellValue( 'AJ'.(31+($pages-1)*33), $total_auto+$total_auto_remove_fee+$out_total_auto_remove_fee);

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
            $indoor_divide_text = $indoor_divide_text.$indoor_divide_decoration_data[$j]["numerator"]."/".$indoor_divide_decoration_data[$j]["denominator"]." ".$indoor_divide_decoration_data[$j]["item_name"]."\n";
            $indoor_divide_points += $indoor_divide_decoration_data[$j]["ratio"]*$indoor_divide_decoration_data[$j]["points"];
        }
        if(count($indoor_divide_decoration_data)==1 && $indoor_divide_decoration_data[0]["ratio"]==1){
            $indoor_divide_text = substr($indoor_divide_text,4,strlen($indoor_divide_text));
        }
    }

    if($outdoor_wall_decoration_data!=null){
        for($j=0;$j<count($outdoor_wall_decoration_data);$j++){
            $outdoor_wall_text = $outdoor_wall_text.$outdoor_wall_decoration_data[$j]["numerator"]."/".$outdoor_wall_decoration_data[$j]["denominator"]." ".$outdoor_wall_decoration_data[$j]["item_name"]."\n";
            $outdoor_wall_points += $outdoor_wall_decoration_data[$j]["ratio"]*$outdoor_wall_decoration_data[$j]["points"];
        }
        if(count($outdoor_wall_decoration_data)==1 && $outdoor_wall_decoration_data[0]["ratio"]==1){
            $outdoor_wall_text = substr($outdoor_wall_text,4,strlen($outdoor_wall_text));
        }
    }

    if($indoor_wall_decoration_data!=null){
        for($j=0;$j<count($indoor_wall_decoration_data);$j++){
            $indoor_wall_text = $indoor_wall_text.$indoor_wall_decoration_data[$j]["numerator"]."/".$indoor_wall_decoration_data[$j]["denominator"]." ".$indoor_wall_decoration_data[$j]["item_name"]."\n";
            $indoor_wall_points += $indoor_wall_decoration_data[$j]["ratio"]*$indoor_wall_decoration_data[$j]["points"];
        }
        if(count($indoor_wall_decoration_data)==1 && $indoor_wall_decoration_data[0]["ratio"]==1){
            $indoor_wall_text = substr($indoor_wall_text,4,strlen($indoor_wall_text));
        }
    }

    if($roof_decoration_data!=null){
        for($j=0;$j<count($roof_decoration_data);$j++){
            $roof_text = $roof_text.$roof_decoration_data[$j]["numerator"]."/".$roof_decoration_data[$j]["denominator"]." ".$roof_decoration_data[$j]["item_name"]."\n";
            $roof_points += $roof_decoration_data[$j]["ratio"]*$roof_decoration_data[$j]["points"];
        }
        if(count($roof_decoration_data)==1 && $roof_decoration_data[0]["ratio"]==1){
            $roof_text = substr($roof_text,4,strlen($roof_text));
        }
    }

    if($floor_decoration_data!=null){
        for($j=0;$j<count($floor_decoration_data);$j++){
            $floor_text = $floor_text.$floor_decoration_data[$j]["numerator"]."/".$floor_decoration_data[$j]["denominator"]." ".$floor_decoration_data[$j]["item_name"]."\n";
            $floor_points += $floor_decoration_data[$j]["ratio"]*$floor_decoration_data[$j]["points"];
        }
        if(count($floor_decoration_data)==1 && $floor_decoration_data[0]["ratio"]==1){
            $floor_text = substr($floor_text,4,strlen($floor_text));
        }
    }

    if($ceiling_decoration_data!=null){
        for($j=0;$j<count($ceiling_decoration_data);$j++){
            $ceiling_text = $ceiling_text.$ceiling_decoration_data[$j]["numerator"]."/".$ceiling_decoration_data[$j]["denominator"]." ".$ceiling_decoration_data[$j]["item_name"]."\n";
            $ceiling_points += $ceiling_decoration_data[$j]["ratio"]*$ceiling_decoration_data[$j]["points"];
        }
        if(count($ceiling_decoration_data)==1 && $ceiling_decoration_data[0]["ratio"]==1){
            $ceiling_text = substr($ceiling_text,4,strlen($ceiling_text));
        }
    }

    if($door_decoration_data!=null){
        for($j=0;$j<count($door_decoration_data);$j++){
            if($door_decoration_data[$j]["ratio"]==1){
                $door_text = $door_text.$door_decoration_data[$j]["item_name"]."\n";
            }
            else{
                $door_text = $door_text.$door_decoration_data[$j]["numerator"]."/".$door_decoration_data[$j]["denominator"]." ".$door_decoration_data[$j]["item_name"]."\n";
            }
            $door_points += $door_decoration_data[$j]["ratio"]*$door_decoration_data[$j]["points"];
        }
        // if(count($door_decoration_data)==1 && $door_decoration_data[0]["ratio"]==1){
        //     $door_text = substr($door_text,1,strlen($door_text));
        // }
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
            $toilet_text = $toilet_text.$toilet_decoration_data[$j]["numerator"]."/".$toilet_decoration_data[$j]["denominator"]." ".$toilet_decoration_data[$j]["item_name"].$note."\n";
            $toilet_points += $toilet_decoration_data[$j]["ratio"]*$toilet_decoration_data[$j]["points"];
        }
        if(count($toilet_decoration_data)==1 && $toilet_decoration_data[0]["ratio"]==1){
            $toilet_text = substr($toilet_text,4,strlen($toilet_text));
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

    $fId = "";
    $fId_split = explode('-', $main_decoration_data[$i]["fId"]);
    for($j=2;$j<count($fId_split);$j++){
        $fId = $fId.$fId_split[$j];
        if($j != count($fId_split)-1){
            $fId = $fId."-";
        }
    }

    switch ($i % 6) {
        case 0:
        $objPHPExcel->setActiveSheetIndex(0)
                    // ->setCellValue( 'AH'.(35+($pages-1)*(40-6)+(int)($i/6)*27), str_replace("-", "", $script_number))
                    ->setCellValue( 'D'.(75+($pages-1)*33+(int)($i/6)*28), $fId)
                    ->setCellValue( 'D'.(76+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'D'.(77+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["nth_floor"]."/".$main_decoration_data[$i]["total_floor"])
                    ->setCellValue( 'D'.(78+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'D'.(79+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'D'.(80+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'D'.(81+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'D'.(83+($pages-1)*33+(int)($i/6)*28), $indoor_divide_text)
                    ->setCellValue( 'D'.(84+($pages-1)*33+(int)($i/6)*28), $outdoor_wall_text)
                    ->setCellValue( 'D'.(85+($pages-1)*33+(int)($i/6)*28), $indoor_wall_text)
                    ->setCellValue( 'D'.(86+($pages-1)*33+(int)($i/6)*28), $roof_text)
                    ->setCellValue( 'D'.(87+($pages-1)*33+(int)($i/6)*28), $floor_text)
                    ->setCellValue( 'D'.(88+($pages-1)*33+(int)($i/6)*28), $ceiling_text)
                    ->setCellValue( 'D'.(89+($pages-1)*33+(int)($i/6)*28), $door_text)
                    ->setCellValue( 'D'.(90+($pages-1)*33+(int)($i/6)*28), $toilet_text)
                    ->setCellValue( 'D'.(91+($pages-1)*33+(int)($i/6)*28), $electric_text)
                    ->setCellValue( 'D'.(92+($pages-1)*33+(int)($i/6)*28), $electric_type)
                    ->setCellValue( 'D'.(93+($pages-1)*33+(int)($i/6)*28), $window_level_text)
                    ->setCellValue( 'D'.(94+($pages-1)*33+(int)($i/6)*28), $balcony_text)
                    ->setCellValue( 'D'.(95+($pages-1)*33+(int)($i/6)*28), $daughter_text)
                    ->setCellValue( 'D'.(96+($pages-1)*33+(int)($i/6)*28), $height_text)
                    ->setCellValue( 'D'.(97+($pages-1)*33+(int)($i/6)*28), $total_points)

                    // 塞入評點
                    ->setCellValue( 'G'.(79+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["points"]+$add_minus_wall_points[$i],2,".",","))
                    ->setCellValue( 'G'.(83+($pages-1)*33+(int)($i/6)*28), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'G'.(84+($pages-1)*33+(int)($i/6)*28), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'G'.(85+($pages-1)*33+(int)($i/6)*28), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'G'.(86+($pages-1)*33+(int)($i/6)*28), number_format($roof_points,2,".",","))
                    ->setCellValue( 'G'.(87+($pages-1)*33+(int)($i/6)*28), number_format($floor_points,2,".",","))
                    ->setCellValue( 'G'.(88+($pages-1)*33+(int)($i/6)*28), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'G'.(89+($pages-1)*33+(int)($i/6)*28), number_format($door_points,2,".",","))
                    ->setCellValue( 'G'.(90+($pages-1)*33+(int)($i/6)*28), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'G'.(91+($pages-1)*33+(int)($i/6)*28), number_format($electric_points,2,".",","))
                    ->setCellValue( 'G'.(93+($pages-1)*33+(int)($i/6)*28), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'G'.(94+($pages-1)*33+(int)($i/6)*28), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'G'.(95+($pages-1)*33+(int)($i/6)*28), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'G'.(96+($pages-1)*33+(int)($i/6)*28), (100+$extra_percent)."%");
                    break;
        case 1:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'H'.(75+($pages-1)*33+(int)($i/6)*28), $fId)
                    ->setCellValue( 'H'.(76+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'H'.(77+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["nth_floor"]."/".$main_decoration_data[$i]["total_floor"])
                    ->setCellValue( 'H'.(78+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'H'.(79+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'H'.(80+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'H'.(81+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'H'.(83+($pages-1)*33+(int)($i/6)*28), $indoor_divide_text)
                    ->setCellValue( 'H'.(84+($pages-1)*33+(int)($i/6)*28), $outdoor_wall_text)
                    ->setCellValue( 'H'.(85+($pages-1)*33+(int)($i/6)*28), $indoor_wall_text)
                    ->setCellValue( 'H'.(86+($pages-1)*33+(int)($i/6)*28), $roof_text)
                    ->setCellValue( 'H'.(87+($pages-1)*33+(int)($i/6)*28), $floor_text)
                    ->setCellValue( 'H'.(88+($pages-1)*33+(int)($i/6)*28), $ceiling_text)
                    ->setCellValue( 'H'.(89+($pages-1)*33+(int)($i/6)*28), $door_text)
                    ->setCellValue( 'H'.(90+($pages-1)*33+(int)($i/6)*28), $toilet_text)
                    ->setCellValue( 'H'.(91+($pages-1)*33+(int)($i/6)*28), $electric_text)
                    ->setCellValue( 'H'.(92+($pages-1)*33+(int)($i/6)*28), $electric_type)
                    ->setCellValue( 'H'.(93+($pages-1)*33+(int)($i/6)*28), $window_level_text)
                    ->setCellValue( 'H'.(94+($pages-1)*33+(int)($i/6)*28), $balcony_text)
                    ->setCellValue( 'H'.(95+($pages-1)*33+(int)($i/6)*28), $daughter_text)
                    ->setCellValue( 'H'.(96+($pages-1)*33+(int)($i/6)*28), $height_text)
                    ->setCellValue( 'H'.(97+($pages-1)*33+(int)($i/6)*28), $total_points)

                    // 塞入評點
                    ->setCellValue( 'L'.(79+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'L'.(83+($pages-1)*33+(int)($i/6)*28), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'L'.(84+($pages-1)*33+(int)($i/6)*28), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'L'.(85+($pages-1)*33+(int)($i/6)*28), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'L'.(86+($pages-1)*33+(int)($i/6)*28), number_format($roof_points,2,".",","))
                    ->setCellValue( 'L'.(87+($pages-1)*33+(int)($i/6)*28), number_format($floor_points,2,".",","))
                    ->setCellValue( 'L'.(88+($pages-1)*33+(int)($i/6)*28), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'L'.(89+($pages-1)*33+(int)($i/6)*28), number_format($door_points,2,".",","))
                    ->setCellValue( 'L'.(90+($pages-1)*33+(int)($i/6)*28), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'L'.(91+($pages-1)*33+(int)($i/6)*28), number_format($electric_points,2,".",","))
                    ->setCellValue( 'L'.(93+($pages-1)*33+(int)($i/6)*28), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'L'.(94+($pages-1)*33+(int)($i/6)*28), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'L'.(95+($pages-1)*33+(int)($i/6)*28), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'L'.(96+($pages-1)*33+(int)($i/6)*28), (100+$extra_percent)."%");
                    break;
        case 2:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'N'.(75+($pages-1)*33+(int)($i/6)*28), $fId)
                    ->setCellValue( 'N'.(76+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'N'.(77+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["nth_floor"]."/".$main_decoration_data[$i]["total_floor"])
                    ->setCellValue( 'N'.(78+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'N'.(79+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'N'.(80+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'N'.(81+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'N'.(83+($pages-1)*33+(int)($i/6)*28), $indoor_divide_text)
                    ->setCellValue( 'N'.(84+($pages-1)*33+(int)($i/6)*28), $outdoor_wall_text)
                    ->setCellValue( 'N'.(85+($pages-1)*33+(int)($i/6)*28), $indoor_wall_text)
                    ->setCellValue( 'N'.(86+($pages-1)*33+(int)($i/6)*28), $roof_text)
                    ->setCellValue( 'N'.(87+($pages-1)*33+(int)($i/6)*28), $floor_text)
                    ->setCellValue( 'N'.(88+($pages-1)*33+(int)($i/6)*28), $ceiling_text)
                    ->setCellValue( 'N'.(89+($pages-1)*33+(int)($i/6)*28), $door_text)
                    ->setCellValue( 'N'.(90+($pages-1)*33+(int)($i/6)*28), $toilet_text)
                    ->setCellValue( 'N'.(91+($pages-1)*33+(int)($i/6)*28), $electric_text)
                    ->setCellValue( 'N'.(92+($pages-1)*33+(int)($i/6)*28), $electric_type)
                    ->setCellValue( 'N'.(93+($pages-1)*33+(int)($i/6)*28), $window_level_text)
                    ->setCellValue( 'N'.(94+($pages-1)*33+(int)($i/6)*28), $balcony_text)
                    ->setCellValue( 'N'.(95+($pages-1)*33+(int)($i/6)*28), $daughter_text)
                    ->setCellValue( 'N'.(96+($pages-1)*33+(int)($i/6)*28), $height_text)
                    ->setCellValue( 'N'.(97+($pages-1)*33+(int)($i/6)*28), $total_points)

                    // 塞入評點
                    ->setCellValue( 'Q'.(79+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'Q'.(83+($pages-1)*33+(int)($i/6)*28), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'Q'.(84+($pages-1)*33+(int)($i/6)*28), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'Q'.(85+($pages-1)*33+(int)($i/6)*28), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'Q'.(86+($pages-1)*33+(int)($i/6)*28), number_format($roof_points,2,".",","))
                    ->setCellValue( 'Q'.(87+($pages-1)*33+(int)($i/6)*28), number_format($floor_points,2,".",","))
                    ->setCellValue( 'Q'.(88+($pages-1)*33+(int)($i/6)*28), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'Q'.(89+($pages-1)*33+(int)($i/6)*28), number_format($door_points,2,".",","))
                    ->setCellValue( 'Q'.(90+($pages-1)*33+(int)($i/6)*28), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'Q'.(91+($pages-1)*33+(int)($i/6)*28), number_format($electric_points,2,".",","))
                    ->setCellValue( 'Q'.(93+($pages-1)*33+(int)($i/6)*28), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'Q'.(94+($pages-1)*33+(int)($i/6)*28), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'Q'.(95+($pages-1)*33+(int)($i/6)*28), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'Q'.(96+($pages-1)*33+(int)($i/6)*28), (100+$extra_percent)."%");
                    break;
        case 3:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'S'.(75+($pages-1)*33+(int)($i/6)*28), $fId)
                    ->setCellValue( 'S'.(76+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'S'.(77+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["nth_floor"]."/".$main_decoration_data[$i]["total_floor"])
                    ->setCellValue( 'S'.(78+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'S'.(79+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'S'.(80+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'S'.(81+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'S'.(83+($pages-1)*33+(int)($i/6)*28), $indoor_divide_text)
                    ->setCellValue( 'S'.(84+($pages-1)*33+(int)($i/6)*28), $outdoor_wall_text)
                    ->setCellValue( 'S'.(85+($pages-1)*33+(int)($i/6)*28), $indoor_wall_text)
                    ->setCellValue( 'S'.(86+($pages-1)*33+(int)($i/6)*28), $roof_text)
                    ->setCellValue( 'S'.(87+($pages-1)*33+(int)($i/6)*28), $floor_text)
                    ->setCellValue( 'S'.(88+($pages-1)*33+(int)($i/6)*28), $ceiling_text)
                    ->setCellValue( 'S'.(89+($pages-1)*33+(int)($i/6)*28), $door_text)
                    ->setCellValue( 'S'.(90+($pages-1)*33+(int)($i/6)*28), $toilet_text)
                    ->setCellValue( 'S'.(91+($pages-1)*33+(int)($i/6)*28), $electric_text)
                    ->setCellValue( 'S'.(92+($pages-1)*33+(int)($i/6)*28), $electric_type)
                    ->setCellValue( 'S'.(93+($pages-1)*33+(int)($i/6)*28), $window_level_text)
                    ->setCellValue( 'S'.(94+($pages-1)*33+(int)($i/6)*28), $balcony_text)
                    ->setCellValue( 'S'.(95+($pages-1)*33+(int)($i/6)*28), $daughter_text)
                    ->setCellValue( 'S'.(96+($pages-1)*33+(int)($i/6)*28), $height_text)
                    ->setCellValue( 'S'.(97+($pages-1)*33+(int)($i/6)*28), $total_points)

                    // 塞入評點
                    ->setCellValue( 'W'.(79+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'W'.(83+($pages-1)*33+(int)($i/6)*28), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'W'.(84+($pages-1)*33+(int)($i/6)*28), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'W'.(85+($pages-1)*33+(int)($i/6)*28), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'W'.(86+($pages-1)*33+(int)($i/6)*28), number_format($roof_points,2,".",","))
                    ->setCellValue( 'W'.(87+($pages-1)*33+(int)($i/6)*28), number_format($floor_points,2,".",","))
                    ->setCellValue( 'W'.(88+($pages-1)*33+(int)($i/6)*28), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'W'.(89+($pages-1)*33+(int)($i/6)*28), number_format($door_points,2,".",","))
                    ->setCellValue( 'W'.(90+($pages-1)*33+(int)($i/6)*28), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'W'.(91+($pages-1)*33+(int)($i/6)*28), number_format($electric_points,2,".",","))
                    ->setCellValue( 'W'.(93+($pages-1)*33+(int)($i/6)*28), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'W'.(94+($pages-1)*33+(int)($i/6)*28), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'W'.(95+($pages-1)*33+(int)($i/6)*28), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'W'.(96+($pages-1)*33+(int)($i/6)*28), (100+$extra_percent)."%");
                    break;
        case 4:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'X'.(75+($pages-1)*33+(int)($i/6)*28), $fId)
                    ->setCellValue( 'X'.(76+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'X'.(77+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["nth_floor"]."/".$main_decoration_data[$i]["total_floor"])
                    ->setCellValue( 'X'.(78+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'X'.(79+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'X'.(80+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'X'.(81+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'X'.(83+($pages-1)*33+(int)($i/6)*28), $indoor_divide_text)
                    ->setCellValue( 'X'.(84+($pages-1)*33+(int)($i/6)*28), $outdoor_wall_text)
                    ->setCellValue( 'X'.(85+($pages-1)*33+(int)($i/6)*28), $indoor_wall_text)
                    ->setCellValue( 'X'.(86+($pages-1)*33+(int)($i/6)*28), $roof_text)
                    ->setCellValue( 'X'.(87+($pages-1)*33+(int)($i/6)*28), $floor_text)
                    ->setCellValue( 'X'.(88+($pages-1)*33+(int)($i/6)*28), $ceiling_text)
                    ->setCellValue( 'X'.(89+($pages-1)*33+(int)($i/6)*28), $door_text)
                    ->setCellValue( 'X'.(90+($pages-1)*33+(int)($i/6)*28), $toilet_text)
                    ->setCellValue( 'X'.(91+($pages-1)*33+(int)($i/6)*28), $electric_text)
                    ->setCellValue( 'X'.(92+($pages-1)*33+(int)($i/6)*28), $electric_type)
                    ->setCellValue( 'X'.(93+($pages-1)*33+(int)($i/6)*28), $window_level_text)
                    ->setCellValue( 'X'.(94+($pages-1)*33+(int)($i/6)*28), $balcony_text)
                    ->setCellValue( 'X'.(95+($pages-1)*33+(int)($i/6)*28), $daughter_text)
                    ->setCellValue( 'X'.(96+($pages-1)*33+(int)($i/6)*28), $height_text)
                    ->setCellValue( 'X'.(97+($pages-1)*33+(int)($i/6)*28), $total_points)

                    // 塞入評點
                    ->setCellValue( 'AB'.(79+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'AB'.(83+($pages-1)*33+(int)($i/6)*28), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'AB'.(84+($pages-1)*33+(int)($i/6)*28), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'AB'.(85+($pages-1)*33+(int)($i/6)*28), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'AB'.(86+($pages-1)*33+(int)($i/6)*28), number_format($roof_points,2,".",","))
                    ->setCellValue( 'AB'.(87+($pages-1)*33+(int)($i/6)*28), number_format($floor_points,2,".",","))
                    ->setCellValue( 'AB'.(88+($pages-1)*33+(int)($i/6)*28), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'AB'.(89+($pages-1)*33+(int)($i/6)*28), number_format($door_points,2,".",","))
                    ->setCellValue( 'AB'.(90+($pages-1)*33+(int)($i/6)*28), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'AB'.(91+($pages-1)*33+(int)($i/6)*28), number_format($electric_points,2,".",","))
                    ->setCellValue( 'AB'.(93+($pages-1)*33+(int)($i/6)*28), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'AB'.(94+($pages-1)*33+(int)($i/6)*28), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'AB'.(95+($pages-1)*33+(int)($i/6)*28), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'AB'.(96+($pages-1)*33+(int)($i/6)*28), (100+$extra_percent)."%");
                    break;
        case 5:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'AD'.(75+($pages-1)*33+(int)($i/6)*28), $fId)
                    ->setCellValue( 'AD'.(76+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'AD'.(77+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["nth_floor"]."/".$main_decoration_data[$i]["total_floor"])
                    ->setCellValue( 'AD'.(78+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'AD'.(79+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'AD'.(80+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'AD'.(81+($pages-1)*33+(int)($i/6)*28), $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'AD'.(83+($pages-1)*33+(int)($i/6)*28), $indoor_divide_text)
                    ->setCellValue( 'AD'.(84+($pages-1)*33+(int)($i/6)*28), $outdoor_wall_text)
                    ->setCellValue( 'AD'.(85+($pages-1)*33+(int)($i/6)*28), $indoor_wall_text)
                    ->setCellValue( 'AD'.(86+($pages-1)*33+(int)($i/6)*28), $roof_text)
                    ->setCellValue( 'AD'.(87+($pages-1)*33+(int)($i/6)*28), $floor_text)
                    ->setCellValue( 'AD'.(88+($pages-1)*33+(int)($i/6)*28), $ceiling_text)
                    ->setCellValue( 'AD'.(89+($pages-1)*33+(int)($i/6)*28), $door_text)
                    ->setCellValue( 'AD'.(90+($pages-1)*33+(int)($i/6)*28), $toilet_text)
                    ->setCellValue( 'AD'.(91+($pages-1)*33+(int)($i/6)*28), $electric_text)
                    ->setCellValue( 'AD'.(92+($pages-1)*33+(int)($i/6)*28), $electric_type)
                    ->setCellValue( 'AD'.(93+($pages-1)*33+(int)($i/6)*28), $window_level_text)
                    ->setCellValue( 'AD'.(94+($pages-1)*33+(int)($i/6)*28), $balcony_text)
                    ->setCellValue( 'AD'.(95+($pages-1)*33+(int)($i/6)*28), $daughter_text)
                    ->setCellValue( 'AD'.(96+($pages-1)*33+(int)($i/6)*28), $height_text)
                    ->setCellValue( 'AD'.(97+($pages-1)*33+(int)($i/6)*28), $total_points)

                    // 塞入評點
                    ->setCellValue( 'AH'.(79+($pages-1)*33+(int)($i/6)*28), number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'AH'.(83+($pages-1)*33+(int)($i/6)*28), number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'AH'.(84+($pages-1)*33+(int)($i/6)*28), number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'AH'.(85+($pages-1)*33+(int)($i/6)*28), number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'AH'.(86+($pages-1)*33+(int)($i/6)*28), number_format($roof_points,2,".",","))
                    ->setCellValue( 'AH'.(87+($pages-1)*33+(int)($i/6)*28), number_format($floor_points,2,".",","))
                    ->setCellValue( 'AH'.(88+($pages-1)*33+(int)($i/6)*28), number_format($ceiling_points,2,".",","))
                    ->setCellValue( 'AH'.(89+($pages-1)*33+(int)($i/6)*28), number_format($door_points,2,".",","))
                    ->setCellValue( 'AH'.(90+($pages-1)*33+(int)($i/6)*28), number_format($toilet_points,2,".",","))
                    ->setCellValue( 'AH'.(91+($pages-1)*33+(int)($i/6)*28), number_format($electric_points,2,".",","))
                    ->setCellValue( 'AH'.(93+($pages-1)*33+(int)($i/6)*28), number_format($window_level_points,2,".",","))
                    ->setCellValue( 'AH'.(94+($pages-1)*33+(int)($i/6)*28), number_format($balcony_points,2,".",","))
                    ->setCellValue( 'AH'.(95+($pages-1)*33+(int)($i/6)*28), number_format($daughter_points,2,".",","))
                    ->setCellValue( 'AH'.(96+($pages-1)*33+(int)($i/6)*28), (100+$extra_percent)."%");
                    break;
    }
    // $objPHPExcel->setActiveSheetIndex(0)
    //     ->setCellValue( 'L'.(13+($pages-1)*(40-6)+($i%7)), $total_points)
    //     ->setCellValue( 'O'.(13+($pages-1)*(40-6)+($i%7)), $total_points);
    $total_points = str_replace(",","",$total_points);
    $fee = number_format($total_points*$main_building_data[$i]["floor_area"]*$price,0,"","");
    
    if(substr($script_number,0,6) == "建合"){
        $compensate_ratio = 1;
    }
    else{
        $compensate_ratio = 0.6;
    }

    if($i<7){
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'M'.($i+13), $total_points)
                    ->setCellValue( 'P'.($i+13), $total_points)
                    ->setCellValue( 'V'.($i+13), $fee)
                    ->setCellValue( 'AC'.($i+13), number_format($fee*$discard_ratio*$compensate_ratio,0,"",""))
                    ->setCellValue( 'AG'.($i+13), number_format(round($fee*$discard_ratio*$compensate_ratio)*0.5,0,"",""));
    }
    else{
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'M'.($i+40), $total_points)
                    ->setCellValue( 'P'.($i+40), $total_points)
                    ->setCellValue( 'V'.($i+40), $fee)
                    ->setCellValue( 'AC'.($i+40), number_format($fee*$discard_ratio*$compensate_ratio,0,"",""))
                    ->setCellValue( 'AG'.($i+40), number_format(round($fee*$discard_ratio*$compensate_ratio)*0.5,0,"",""));
    }
    $total_price += $fee;
    $total_fee += number_format($fee*$discard_ratio*$compensate_ratio,0,"","");
    $total_auto += number_format(round($fee*$discard_ratio*$compensate_ratio)*0.5,0,"","");
}
if(count($main_building_data)<=7){
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'T20', $total_area)
                ->setCellValue( 'V20', $total_price)
                ->setCellValue( 'AC20', $total_fee)
                ->setCellValue( 'AG20', $total_auto);
}
else{
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'T54', $total_area)
                ->setCellValue( 'V54', $total_price)
                ->setCellValue( 'AC54', $total_fee)
                ->setCellValue( 'AG54', $total_auto);
}

// 合計欄位
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'T'.(31+($pages-1)*33), '合計')
            ->setCellValue( 'AF'.(31+($pages-1)*33), $total_price+$total_init_fee+$out_total_init_fee)
            ->setCellValue( 'AG'.(31+($pages-1)*33), $total_fee+$total_subbuilding_fee+$out_total_subbuilding_fee)
            ->setCellValue( 'AJ'.(31+($pages-1)*33), $total_auto+$total_auto_remove_fee+$out_total_auto_remove_fee);
// for($i=0;$i<count($main_building_data);$i++){
//     if($i<7){
//         $objPHPExcel->setActiveSheetIndex(0)
//                     ->setCellValue( 'L'.($i+13), $total_points)
//                     ->setCellValue( 'O'.($i+13), $total_points);
//     }
//     else{
//         $objPHPExcel->setActiveSheetIndex(0)
//                     ->setCellValue( 'L'.($i+40), $total_points)
//                     ->setCellValue( 'O'.($i+40), $total_points);
//     }
// }
for($i=0;$i<$floor_count;$i++){
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue( 'AJ'.(73+($pages-1)*33+$i*28), str_replace("-", "", $script_number))
    ->setCellValue( 'C'.(98+($pages-1)*33+$i*28), str_replace("-", "", ($survey_date_split[0]-1911)."年".$survey_date_split[1]."月".$survey_date_split[2]."日"));
}

// 雜項物計算式
$subText = array('','','','');
$lineCount = 1;

$subText[(int)($lineCount/37)]  = $subText[(int)($lineCount/37)]."◆主要結構部份\n";
$lineCount++;
for($i=0;$i<count($main_building_data);$i++){
    $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].($i+1).". ".$main_building_data[$i]["structure"]." ".$main_building_data[$i]["nth_floor"]."/".$main_building_data[$i]["total_floor"]."樓\n   面積 : ".$main_building_data[$i]["floor_area_calculate_text"]."=".number_format($main_building_data[$i]["floor_area"],2,".",",")."㎡\n";
    $lineCount += 2;
}
$subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)]."◆雜項工作物部份(室內)\n";
$lineCount++;
for($i=0;$i<count($sub_building_data);$i++){
    $supplement = "";
    if($sub_building_data[$i]["application"] == "畜舍"){
        $supplement = "畜舍";
    }
    $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].($i+1).". ".$sub_building_data[$i]["item_name"].$supplement." : ".number_format($sub_building_data[$i]["unitprice"],0,".",",")."元/".$sub_building_data[$i]["unit"]."\n   ";
    $lineCount++;
    if($sub_building_data[$i]["unit"]!="㎡" && $sub_building_data[$i]["unit"]!="m³"){
        $text = "數量 : ";
    }
    else{
        $text = "面積 : ";
    }

    if($sub_building_data[$i]["note"] == "合法"){
        $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].$text.$sub_building_data[$i]["area_calculate_text"]."=".number_format($sub_building_data[$i]["area"],2,".",",").$sub_building_data[$i]["unit"]."\n   ".number_format($sub_building_data[$i]["area"],2,".",",")."*".number_format($sub_building_data[$i]["unitprice"],0,".",",")."=".number_format($sub_building_data[$i]["area"]*$sub_building_data[$i]["unitprice"],0,".",",")."元\n";
    }
    else{
        $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].$text.$sub_building_data[$i]["area_calculate_text"]."=".number_format($sub_building_data[$i]["area"],2,".",",").$sub_building_data[$i]["unit"]."\n   ".number_format($sub_building_data[$i]["area"],2,".",",")."*".number_format($sub_building_data[$i]["unitprice"],0,".",",")."*60%=".number_format($sub_building_data[$i]["area"]*$sub_building_data[$i]["unitprice"]*0.6,0,".",",")."元\n";
    }
    $lineCount += 2;
}
$subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)]."◆雜項工作物部份(室外)\n";
$lineCount++;
for($i=0;$i<count($outdoor_sub_building_data);$i++){
    $supplement = "";
    if($outdoor_sub_building_data[$i]["application"] == "畜舍"){
        $supplement = "畜舍";
    }
    $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].($i+1).". ".$outdoor_sub_building_data[$i]["item_name"].$supplement." : ".number_format($outdoor_sub_building_data[$i]["unitprice"],0,".",",")."元/".$outdoor_sub_building_data[$i]["unit"]."\n   ";
    $lineCount++;
    if($outdoor_sub_building_data[$i]["unit"]!="㎡" && $outdoor_sub_building_data[$i]["unit"]!="m³"){
        $text = "數量 : ";
    }
    else{
        $text = "面積 : ";
    }

    if($outdoor_sub_building_data[$i]["note"] == "合法"){
        $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].$text.$outdoor_sub_building_data[$i]["area_calculate_text"]."=".number_format($outdoor_sub_building_data[$i]["area"],2,".",",").$outdoor_sub_building_data[$i]["unit"]."\n   ".number_format($outdoor_sub_building_data[$i]["area"],2,".",",")."*".number_format($outdoor_sub_building_data[$i]["unitprice"],0,".",",")."=".number_format($outdoor_sub_building_data[$i]["area"]*$outdoor_sub_building_data[$i]["unitprice"],0,".",",")."元\n";
    }
    else{
        $subText[(int)($lineCount/37)] = $subText[(int)($lineCount/37)].$text.$outdoor_sub_building_data[$i]["area_calculate_text"]."=".number_format($outdoor_sub_building_data[$i]["area"],2,".",",").$outdoor_sub_building_data[$i]["unit"]."\n   ".number_format($outdoor_sub_building_data[$i]["area"],2,".",",")."*".number_format($outdoor_sub_building_data[$i]["unitprice"],0,".",",")."*60%=".number_format($outdoor_sub_building_data[$i]["area"]*$outdoor_sub_building_data[$i]["unitprice"]*0.6,0,".",",")."元\n";
    }
    $lineCount += 2;
}
for($i=0;$i<count($subText);$i++){
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'AD'.(102+($floor_count-1)*27+($pages-1)*33+($i*42)), $subText[$i]);
}
$total_pay = $total_fee+$total_subbuilding_fee+$out_total_subbuilding_fee+$total_auto+$total_auto_remove_fee+$out_total_auto_remove_fee;
exportBuildingHoldRatioExcel($script_number,$land_owner_data,$building_data,$land_data,$total_pay,$survey_date_split,$pages,$objPHPExcel);

$objActSheet = $objPHPExcel->getActiveSheet();
$objActSheet->setTitle(str_replace("-", "", $script_number));
$saveType = explode("-",$script_number);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
if($compensate_type == "補償"){
    $savePath = "file/building/legal/".$saveType[1]."/";
}
else{
    $savePath = "file/building/illegal/".$saveType[1]."/";
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
// $total_pay = $total_fee+$total_subbuilding_fee+$out_total_subbuilding_fee+$total_auto+$total_auto_remove_fee+$out_total_auto_remove_fee;
// exportBuildingHoldRatioExcel($script_number,$land_owner_data,$building_data,$land_data,$total_pay,$survey_date_split,$pages);

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
// date_default_timezone_set('Asia/Taipei');
// $objWriter->save('file/'.date("YmdHis").'.xls');

echo json_encode(array('$add' => $building_data[0],'tt' => ''));
echo "<br>";

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
