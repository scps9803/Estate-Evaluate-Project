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
}
else{
    $compensate_type = "救濟";
    $title = "(其他建築物)";
    $building_text = "建築改良物\n拆遷救濟金";
    $sub_building_text = "雜項設施\n拆遷救濟金";
}

$land_number = "";
$total_land_area = 0;
for($i=0;$i<count($land_data);$i++){
    $land_number = $land_number.$land_data[$i]["land_number"];
    if($i!=count($land_data)-1) {$land_number = $land_number."、";}
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

require_once '/classes/PHPExcel.php';
require_once '/classes/PHPExcel/Writer/Excel5.php';
$objPHPExcel  = new PHPExcel();

// 計算主建物、雜項物筆數設定不同頁數的模板
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
            ->setCellValue( 'AH3', $script_number)
            ->setCellValue( 'R3', $title)
            ->setCellValue( 'AB11', $building_text)
            ->setCellValue( 'L21', $sub_building_text)
            ->setCellValue( 'AE21', $sub_building_text)
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
            // ->setCellValue( 'K7', $land_data[0]['land_number'])
            ->setCellValue( 'K7', $land_number)
            // ->setCellValue( 'X7', $land_data[0]['area']);
            ->setCellValue( 'X7', $total_land_area);
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

// 室內雜項物
$total_init_fee = 0;
$total_subbuilding_fee = 0;
$total_auto_remove_fee = 0;
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

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A'.($i+23), $i+1)
                ->setCellValue( 'C'.($i+23), $sub_building_data[$i]["item_name"])
                ->setCellValue( 'F'.($i+23), $sub_building_data[$i]["application"])
                ->setCellValue( 'G'.($i+23), $sub_building_data[$i]["unitprice"])
                ->setCellValue( 'I'.($i+23), number_format($sub_building_data[$i]["area"],2,".",",").$sub_building_data[$i]["unit"])
                ->setCellValue( 'J'.($i+23), $init_fee)
                ->setCellValue( 'L'.($i+23), $sub_building_fee)
                ->setCellValue( 'O'.($i+23), $auto_remove_fee);
                $total_init_fee += $init_fee;
                $total_subbuilding_fee += $sub_building_fee;
                $total_auto_remove_fee += $auto_remove_fee;
}
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'J30', $total_init_fee)
            ->setCellValue( 'L30', $total_subbuilding_fee)
            ->setCellValue( 'O30', $total_auto_remove_fee);

// 室外雜項物
$out_total_init_fee = 0;
$out_total_subbuilding_fee = 0;
$out_total_auto_remove_fee = 0;
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

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'S'.($i+23), $i+1)
                ->setCellValue( 'U'.($i+23), $outdoor_sub_building_data[$i]["item_name"])
                ->setCellValue( 'Y'.($i+23), $outdoor_sub_building_data[$i]["application"])
                ->setCellValue( 'Z'.($i+23), $outdoor_sub_building_data[$i]["unitprice"])
                ->setCellValue( 'AB'.($i+23), number_format($outdoor_sub_building_data[$i]["area"],2,".",",").$outdoor_sub_building_data[$i]["unit"])
                ->setCellValue( 'AD'.($i+23), $init_fee)
                ->setCellValue( 'AE'.($i+23), $sub_building_fee)
                ->setCellValue( 'AH'.($i+23), $auto_remove_fee);
                $out_total_init_fee += $init_fee;
                $out_total_subbuilding_fee += $sub_building_fee;
                $out_total_auto_remove_fee += $auto_remove_fee;
}
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'AD30', $out_total_init_fee)
            ->setCellValue( 'AE30', $out_total_subbuilding_fee)
            ->setCellValue( 'AH30', $out_total_auto_remove_fee);

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

    $indoor_divide_decoration_data = getBuildingDecorationData($house_address,'室內隔牆構造',$i+1);
    $outdoor_wall_decoration_data = getBuildingDecorationData($house_address,'屋外牆粉裝',$i+1);
    $indoor_wall_decoration_data = getBuildingDecorationData($house_address,'室內牆粉裝',$i+1);
    $roof_decoration_data = getBuildingDecorationData($house_address,'屋頂(面)粉裝',$i+1);
    $floor_decoration_data = getBuildingDecorationData($house_address,'樓地板粉裝',$i+1);
    $ceiling_decoration_data = getBuildingDecorationData($house_address,'天花板粉裝',$i+1);

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

    switch ($i) {
        case 0:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'D37', $i+1)
                    ->setCellValue( 'D38', $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'D39', $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'D40', number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'D41', $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'D42', $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'D43', $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'D45', $indoor_divide_text)
                    ->setCellValue( 'D46', $outdoor_wall_text)
                    ->setCellValue( 'D47', $indoor_wall_text)
                    ->setCellValue( 'D48', $roof_text)
                    ->setCellValue( 'D49', $floor_text)
                    ->setCellValue( 'D50', $ceiling_text)

                    // 塞入評點
                    ->setCellValue( 'G41', number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'G45', number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'G46', number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'G47', number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'G48', number_format($roof_points,2,".",","))
                    ->setCellValue( 'G49', number_format($floor_points,2,".",","))
                    ->setCellValue( 'G50', number_format($ceiling_points,2,".",","));
                    break;
        case 1:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'H37', $i+1)
                    ->setCellValue( 'H38', $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'H39', $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'H40', number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'H41', $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'H42', $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'H43', $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'H45', $indoor_divide_text)
                    ->setCellValue( 'H46', $outdoor_wall_text)
                    ->setCellValue( 'H47', $indoor_wall_text)
                    ->setCellValue( 'H48', $roof_text)
                    ->setCellValue( 'H49', $floor_text)
                    ->setCellValue( 'H50', $ceiling_text)

                    // 塞入評點
                    ->setCellValue( 'K41', number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'K45', number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'K46', number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'K47', number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'K48', number_format($roof_points,2,".",","))
                    ->setCellValue( 'K49', number_format($floor_points,2,".",","))
                    ->setCellValue( 'K50', number_format($ceiling_points,2,".",","));
                    break;
        case 2:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'M37', $i+1)
                    ->setCellValue( 'M38', $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'M39', $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'M40', number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'M41', $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'M42', $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'M43', $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'M45', $indoor_divide_text)
                    ->setCellValue( 'M46', $outdoor_wall_text)
                    ->setCellValue( 'M47', $indoor_wall_text)
                    ->setCellValue( 'M48', $roof_text)
                    ->setCellValue( 'M49', $floor_text)
                    ->setCellValue( 'M50', $ceiling_text)

                    // 塞入評點
                    ->setCellValue( 'P41', number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'P45', number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'P46', number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'P47', number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'P48', number_format($roof_points,2,".",","))
                    ->setCellValue( 'P49', number_format($floor_points,2,".",","))
                    ->setCellValue( 'P50', number_format($ceiling_points,2,".",","));
                    break;
        case 3:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'R37', $i+1)
                    ->setCellValue( 'R38', $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'R39', $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'R40', number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'R41', $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'R42', $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'R43', $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'R45', $indoor_divide_text)
                    ->setCellValue( 'R46', $outdoor_wall_text)
                    ->setCellValue( 'R47', $indoor_wall_text)
                    ->setCellValue( 'R48', $roof_text)
                    ->setCellValue( 'R49', $floor_text)
                    ->setCellValue( 'R50', $ceiling_text)

                    // 塞入評點
                    ->setCellValue( 'V41', number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'V45', number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'V46', number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'V47', number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'V48', number_format($roof_points,2,".",","))
                    ->setCellValue( 'V49', number_format($floor_points,2,".",","))
                    ->setCellValue( 'V50', number_format($ceiling_points,2,".",","));
                    break;
        case 4:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'W37', $i+1)
                    ->setCellValue( 'W38', $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'W39', $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'W40', number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'W41', $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'W42', $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'W43', $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'W45', $indoor_divide_text)
                    ->setCellValue( 'W46', $outdoor_wall_text)
                    ->setCellValue( 'W47', $indoor_wall_text)
                    ->setCellValue( 'W48', $roof_text)
                    ->setCellValue( 'W49', $floor_text)
                    ->setCellValue( 'W50', $ceiling_text)

                    // 塞入評點
                    ->setCellValue( 'AA41', number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'AA45', number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'AA46', number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'AA47', number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'AA48', number_format($roof_points,2,".",","))
                    ->setCellValue( 'AA49', number_format($floor_points,2,".",","))
                    ->setCellValue( 'AA50', number_format($ceiling_points,2,".",","));
                    break;
        case 5:
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'AC37', $i+1)
                    ->setCellValue( 'AC38', $main_decoration_data[$i]["use_type"])
                    ->setCellValue( 'AC39', $main_decoration_data[$i]["nth_floor"]."/".count($main_decoration_data))
                    ->setCellValue( 'AC40', number_format($main_decoration_data[$i]["floor_area"],2,".",","))
                    ->setCellValue( 'AC41', $main_decoration_data[$i]["structure"])
                    ->setCellValue( 'AC42', $main_decoration_data[$i]["floor_type"])
                    ->setCellValue( 'AC43', $main_decoration_data[$i]["building_type"])
                    ->setCellValue( 'AC45', $indoor_divide_text)
                    ->setCellValue( 'AC46', $outdoor_wall_text)
                    ->setCellValue( 'AC47', $indoor_wall_text)
                    ->setCellValue( 'AC48', $roof_text)
                    ->setCellValue( 'AC49', $floor_text)
                    ->setCellValue( 'AC50', $ceiling_text)

                    // 塞入評點
                    ->setCellValue( 'AF41', number_format($main_decoration_data[$i]["points"],2,".",","))
                    ->setCellValue( 'AF45', number_format($indoor_divide_points,2,".",","))
                    ->setCellValue( 'AF46', number_format($outdoor_wall_points,2,".",","))
                    ->setCellValue( 'AF47', number_format($indoor_wall_points,2,".",","))
                    ->setCellValue( 'AF48', number_format($roof_points,2,".",","))
                    ->setCellValue( 'AF49', number_format($floor_points,2,".",","))
                    ->setCellValue( 'AF50', number_format($ceiling_points,2,".",","));
                    break;
    }
}


$objActSheet = $objPHPExcel->getActiveSheet();
$objActSheet->setTitle('default');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('file/myexchel.xls');
date_default_timezone_set('Asia/Taipei');
// $objWriter->save('file/'.date("YmdHis").'.xls');

echo json_encode(array('status' => 'completed','tt' => $main_building_data[0]["points"],'type' => ''));

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
