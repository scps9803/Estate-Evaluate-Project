<?php
session_start();
require_once "smarty/libs/Smarty.class.php";
require_once 'classes/PHPExcel.php';
require_once 'classes/PHPExcel/Writer/Excel5.php';
include("library.php");
$smarty = new Smarty;

$KEYIN_ID = "DEMO1234";
date_default_timezone_set('Asia/Taipei');
$KEYIN_DATETIME = date("Y-m-d/H:i:s");
// $house_address = $_POST['house_address'];
// $script_number = $_POST['script_number'];
$house_address = $_SESSION["house_address"];
$script_number = $_SESSION["script_number"];
$action = $_POST["action"];
$page = $_POST["page"];

if($action == "submit"){
    getSubBuildingUpdateData($house_address);
    $smarty->assign("house_address",$house_address);
    $smarty->assign("script_number",$script_number);
    $smarty->display("sub_building.html");
}
else if($action == "continue"){
    header("Location: building_continue.php?page=".$page."&recordNo=".$script_number);
}
// ------------------------------以下為建物查估部分----------------------------------
$total_floor = $_POST['floor-count'];
// 每層樓詳細資訊、粉裝評點等細項資料
    for($i=0;$i<$total_floor;$i++){
        $main_building[$i]["floor_id"] = $_POST['floor-id-'.($i+1)];
        $fId[$i] = $script_number."-".$main_building[$i]["floor_id"];
        $main_building[$i]["house_type"] = $_POST['house-type-'.($i+1)];
        $discard_status[$i] = $_POST['discard-status-'.($i+1)];
        $main_building[$i]["compensate_form"] = $_POST['compensate-form-'.($i+1)];
        $main_building[$i]["material"] = $_POST['building-material-'.($i+1)];
        $main_building[$i]["floor_type"] = $_POST['floor-type-'.($i+1)];
        $main_building[$i]["f_order"] = 4*($page-1)+($i+1);
        $main_building[$i]["nth_floor"] = $_POST['nth-floor-'.($i+1)];
        $main_building[$i]["total_floor"] = $_POST['total-floor-'.($i+1)];
        $main_building[$i]["points"] = getMainBuildingPoint($main_building[$i]["material"],$main_building[$i]["floor_type"],$main_building[$i]["house_type"]);
        $main_building[$i]["floor_area_calculate_text"] = $_POST['floor-area-'.($i+1)];

        $objPHPExcel  = new PHPExcel();
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $calAreaTool = "tools/calAreaText.xls";
        $objPHPExcel = PHPExcel_IOFactory::load($calAreaTool);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A1', "=".$main_building[$i]["floor_area_calculate_text"]);

        $objActSheet = $objPHPExcel->getActiveSheet();
        $objActSheet->setTitle('default');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('tools/calAreaText.xls');

        $objPHPExcel = PHPExcel_IOFactory::load($calAreaTool);
        $area = $objPHPExcel->getActiveSheet()->getCell('A1')->getCalculatedValue();
        $main_building[$i]["floor_area"] = $area;

        if($_POST['house-usage-'.($i+1)]=="none"){
            $main_building[$i]["usage"] = $_POST['other-house-usage-'.($i+1)];
        }else{
            $main_building[$i]["usage"] = $_POST['house-usage-'.($i+1)];
        }

        $main_building[$i]["layer-height"] = $_POST['layer-height-'.($i+1)];
    }

    // 減牆
    $minus_wall_count = getAppendSelectData('minus-wall-count-',$total_floor);
    $minus_wall_option = getAppendSelectData('minus-wall-option-',$total_floor);
    // 加牆
    $add_wall_count = getAppendSelectData('add-wall-count-',$total_floor);
    $add_wall_option = getAppendSelectData('add-wall-option-',$total_floor);
    echo "減牆<br>";
    for($i=0;$i<$total_floor;$i++){
        for($j=0;$j<count($minus_wall_count[$i]);$j++){
            echo $minus_wall_count[$i][$j]."面".$minus_wall_option[$i][$j].",";
        }
        echo "<br>";
    }

    // print_r($minus_wall_count);
    echo "<br>---------------------------<br>";
    // print_r($minus_wall_option);

    echo "加牆<br>";
    // print_r($add_wall_count);
    // print_r($add_wall_option);
    for($i=0;$i<$total_floor;$i++){
        for($j=0;$j<count($add_wall_count[$i]);$j++){
            echo $add_wall_count[$i][$j]."面".$add_wall_option[$i][$j].",";
        }
        echo "<br>";
    }
    echo "<br>---------------------------<br>";

    // 室內隔間
    $indoor_divide_numerator = getAppendSelectData('indoor-divide-numerator-',$total_floor);
    $indoor_divide_denominator = getAppendSelectData('indoor-divide-denominator-',$total_floor);
    $indoor_divide_option = getAppendSelectData('indoor-divide-option-',$total_floor);

    echo "室內隔間<br>";
    // print_r($indoor_divide_option);
    echo "<br>";

    // print_r($indoor_divide_numerator);
    // echo " ***** ";
    // print_r($indoor_divide_denominator);
    for($i=0;$i<$total_floor;$i++){
        for($j=0;$j<count($indoor_divide_numerator[$i]);$j++){
            echo $indoor_divide_numerator[$i][$j]."/".$indoor_divide_denominator[$i][$j]."--".$indoor_divide_option[$i][$j].",";
            // echo $indoor_divide_denominator[$i][$j];
        }
        echo "<br>";
    }
    echo "<br>---------------------------<br>";

    echo "屋外牆<br>";
    $outdoor_wall_decoration_numerator = getAppendSelectData('outdoor-wall-decoration-numerator-',$total_floor);
    $outdoor_wall_decoration_denominator = getAppendSelectData('outdoor-wall-decoration-denominator-',$total_floor);
    $outdoor_wall_decoration_option = getAppendSelectData('outdoor-wall-decoration-option-',$total_floor);

    for($i=0;$i<$total_floor;$i++){
        for($j=0;$j<count($outdoor_wall_decoration_numerator[$i]);$j++){
            echo $outdoor_wall_decoration_numerator[$i][$j]."/".$outdoor_wall_decoration_denominator[$i][$j]."--".$outdoor_wall_decoration_option[$i][$j].",";
        }
        echo "<br>";
    }
    echo "<br>---------------------------<br>";

    echo "屋內牆<br>";
    $indoor_wall_decoration_numerator = getAppendSelectData('indoor-wall-decoration-numerator-',$total_floor);
    $indoor_wall_decoration_denominator = getAppendSelectData('indoor-wall-decoration-denominator-',$total_floor);
    $indoor_wall_decoration_option = getAppendSelectData('indoor-wall-decoration-option-',$total_floor);
    $indoor_wall_type = getAppendSelectData('indoor-wall-type-',$total_floor);

    for($i=0;$i<$total_floor;$i++){
        for($j=0;$j<count($indoor_wall_decoration_numerator[$i]);$j++){
            echo $indoor_wall_decoration_numerator[$i][$j]."/".$indoor_wall_decoration_denominator[$i][$j]."--".$indoor_wall_decoration_option[$i][$j].",";
        }
        echo "<br>";
    }
    echo "<br>---------------------------<br>";

    echo "屋頂粉裝<br>";
    $roof_decoration_numerator = getAppendSelectData('roof-decoration-numerator-',$total_floor);
    $roof_decoration_denominator = getAppendSelectData('roof-decoration-denominator-',$total_floor);
    $roof_decoration_option = getAppendSelectData('roof-decoration-option-',$total_floor);

    for($i=0;$i<$total_floor;$i++){
        for($j=0;$j<count($roof_decoration_numerator[$i]);$j++){
            echo $roof_decoration_numerator[$i][$j]."/".$roof_decoration_denominator[$i][$j]."--".$roof_decoration_option[$i][$j].",";
        }
        echo "<br>";
    }
    echo "<br>---------------------------<br>";

    echo "樓地板粉裝<br>";
    $floor_decoration_numerator = getAppendSelectData('floor-decoration-numerator-',$total_floor);
    $floor_decoration_denominator = getAppendSelectData('floor-decoration-denominator-',$total_floor);
    $floor_decoration_option = getAppendSelectData('floor-decoration-option-',$total_floor);

    for($i=0;$i<$total_floor;$i++){
        for($j=0;$j<count($floor_decoration_numerator[$i]);$j++){
            echo $floor_decoration_numerator[$i][$j]."/".$floor_decoration_denominator[$i][$j]."--".$floor_decoration_option[$i][$j].",";
        }
        echo "<br>";
    }
    echo "<br>---------------------------<br>";

    echo "天花板粉裝<br>";
    $ceiling_decoration_numerator = getAppendSelectData('ceiling-decoration-numerator-',$total_floor);
    $ceiling_decoration_denominator = getAppendSelectData('ceiling-decoration-denominator-',$total_floor);
    $ceiling_decoration_option = getAppendSelectData('ceiling-decoration-option-',$total_floor);

    for($i=0;$i<$total_floor;$i++){
        for($j=0;$j<count($ceiling_decoration_numerator[$i]);$j++){
            echo $ceiling_decoration_numerator[$i][$j]."/".$ceiling_decoration_denominator[$i][$j]."--".$ceiling_decoration_option[$i][$j].",";
        }
        echo "<br>";
    }
    echo "<br>---------------------------<br>";

    echo "門窗裝置<br>";
    $isDoorEmpty = true;
    $resultArray = array(array(''),array(''),array(''),array(''));
    $resultRatio = array(array(''),array(''),array(''),array(''));
    $resultNumerator = [];
    $resultDenominator = [];
    for($i=0;$i<$total_floor;$i++){
        // $door_window_numerator[$i] = $_POST['door-window-numerator-'.($i+1)];
        // $door_window_denominator[$i] = $_POST['door-window-denominator-'.($i+1)];
        // $door_window[$i] = $_POST['door-window-'.($i+1)];
        // $double_door[$i] = $_POST['double-door-'.($i+1)];
        // $double_window[$i] = $_POST['double-window-'.($i+1)];
        // echo $door_window_numerator[$i]."/".$door_window_denominator[$i]."--".$door_window[$i].",".$double_door[$i].",".$double_window[$i]."<br>";
        if(isset($_POST['first-door-'.($i+1)])){
            $first_door[$i] = $_POST['first-door-'.($i+1)];
            $first_window[$i] = $_POST['first-window-'.($i+1)];
            $second_door[$i] = $_POST['second-door-'.($i+1)];
            $second_window[$i] = $_POST['second-window-'.($i+1)];
            if($first_door[$i]!="" || $first_window[$i]!="" || $second_door[$i]!="" || $second_window[$i]!=""){
                $isDoorEmpty = false;
            }

            $optionArray[0] = $first_door[$i];
            $optionArray[1] = $first_window[$i];
            $optionArray[2] = $second_door[$i];
            $optionArray[3] = $second_window[$i];
            $index = 0;
            // $resultArray = [];
            // $resultRatio = [];
            echo "第一層門: ".$first_door[$i].", 第一層窗: ".$first_window[$i]."<br>第二層門: ".$second_door[$i].", 第二層窗: ".$second_window[$i]."<br>";
            for($j=0;$j<count($optionArray);$j++){
                $key = array_search($optionArray[$j], $resultArray[$i]);
                // echo "key: ".$key."<br>";
                // echo $optionArray[$j]."<br>";

                if($key===false && $optionArray[$j]!=""){
                    $resultArray[$i][$index] = $optionArray[$j];
                    $resultRatio[$i][$index] = 0.5;
                    $resultNumerator[$i][$j] = 1;
                    $index++;
                }
                else if($key!==false && $optionArray[$j]!=""){
                    $resultRatio[$i][$key] += 0.5;
                    $resultNumerator[$i][$j] += 1;
                }
                $resultDenominator[$i][$j] = 2;
            }
            print_r($resultArray[$i]);
            print_r($resultRatio[$i]);
        }
    }
    echo "<br>---------------------------<br>";

    echo "浴廁設備<br>";
    $toilet_ratio = getAppendSelectData('toilet-ratio-',$total_floor);
    $toilet_type = getAppendSelectData('toilet-type-',$total_floor);
    $toilet_product = getAppendSelectData('toilet-product-',$total_floor);
    $toilet_number = getAppendSelectData('toilet-number-',$total_floor);

    for($i=0;$i<$total_floor;$i++){
        for($j=0;$j<count($toilet_ratio[$i]);$j++){
            echo $toilet_ratio[$i][$j]."--".$toilet_type[$i][$j]."--".$toilet_number[$i][$j].",";
        }
        echo "<br>";
    }
    echo "<br>---------------------------<br>";

    echo"電器設備<br>";
    for($i=0;$i<$total_floor;$i++){
        $electric_usage[$i] = $_POST['electric-usage-'.($i+1)];
        $electric_type[$i] = $_POST['electric-type-'.($i+1)];
        echo $electric_usage[$i]."--".$electric_type[$i].",<br>";
    }
    echo "<br>---------------------------<br>";

    echo "窗或陽台<br>";
    for($i=0;$i<$total_floor;$i++){
        if(isset($_POST['window-level-'.($i+1)])){
            $window_level[$i] = $_POST['window-level-'.($i+1)];
        }
        else{
            $window_level[$i] = NULL;
        }
        echo $window_level[$i].",<br>";
    }
    echo "<br>---------------------------<br>";

    echo"女兒牆<br>";
    for($i=0;$i<$total_floor;$i++){
        if(isset($_POST['daughter-wall-'.($i+1)])){
            $daughter_wall[$i] = $_POST['daughter-wall-'.($i+1)];
        }
        else{
            $daughter_wall[$i] = NULL;
        }
        // echo $daughter_wall[$i].",<br>";
        print_r($daughter_wall);
        echo "<br>";
    }
    echo "<br>---------------------------<br>";

    echo"陽台<br>";
    for($i=0;$i<$total_floor;$i++){
        if(isset($_POST['balcony-'.($i+1)])){
            $balcony[$i] = $_POST['balcony-'.($i+1)];
        }
        else{
            $balcony[$i] = NULL;
        }
        // echo $balcony[$i].",<br>";
        print_r($balcony);
        echo "<br>";
    }
    echo "<br>---------------------------<br>";
    // $bdId = insertIndoorDivideData($fId,$indoor_divide_numerator,$indoor_divide_denominator,$indoor_divide_option);
    echo "BDID: <br>";
    print_r($indoor_divide_option);
    // echo "<br>";
    // print_r($bdId);
    echo "<br>";
    print_r($fId);
// }

// $date = date("Y/m/d");
//
// $smarty->assign("script_number",$script_number);
// if($owner_count<=1){
//     $smarty->assign("owner",$owner[0]);
// }else{
//     $smarty->assign("owner",$owner[0]."等".$owner_count."人");
// }
//
// $smarty->assign("pId",$pId[0]);
// $smarty->assign("address",$address[0]);
// $smarty->assign("phone",$phone);
//
// $smarty->assign("legal_status",$legal_status);
// $smarty->assign("legal_certificate",$legal_certificate);
// $smarty->assign("house_address",$house_address);
// $smarty->assign("legal_number",$legal_number);
// $smarty->assign("location",$location);
// $smarty->assign("remove_condition",$remove_condition);
// $smarty->assign("captain",$captain);
// $smarty->assign("captain_count",$captain_count);
// $smarty->assign("total_people",$total_people);
// $smarty->assign("rent_relation",$rent_relation);
// $smarty->assign("land_use",$land_use);
// $smarty->assign("main_building",$main_building);
// $smarty->assign("date",$date);

// $smarty->display("house_submit_preview.html");

deleteHasBuildingDecorationData($script_number,$page);
deleteFloorInfoData($house_address,$page);

// 儲存樓層資料
insertFloorData($script_number,$main_building,$house_address,$discard_status);

// 儲存粉裝資料
if(!empty($minus_wall_option)){
    $bdId = insertMinusWallData($fId,$minus_wall_count,$minus_wall_option);
    echo "減牆 BDID: <br>";
    echo "數量: ".count($minus_wall_count)."<br>";
    print_r($minus_wall_count);
    print_r($minus_wall_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($add_wall_option)){
    $bdId = insertAddWallData($fId,$add_wall_count,$add_wall_option);
    echo "加牆 BDID: <br>";
    print_r($add_wall_count);
    print_r($add_wall_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($indoor_divide_numerator)){
    $bdId = insertIndoorDivideData($fId,$indoor_divide_numerator,$indoor_divide_denominator,$indoor_divide_option);
    echo "BDID: <br>";
    print_r($indoor_divide_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($outdoor_wall_decoration_numerator)){
    $bdId = insertOutdoorWallData($fId,$main_building,$outdoor_wall_decoration_numerator,$outdoor_wall_decoration_denominator,$outdoor_wall_decoration_option);
    echo "BDID: <br>";
    print_r($outdoor_wall_decoration_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($indoor_wall_decoration_numerator)){
    $bdId = insertIndoorWallData($fId,$indoor_wall_type,$indoor_wall_decoration_numerator,$indoor_wall_decoration_denominator,$indoor_wall_decoration_option);
    echo "BDID: <br>";
    print_r($indoor_wall_decoration_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($roof_decoration_numerator)){
    $bdId = insertRoofData($fId,$roof_decoration_numerator,$roof_decoration_denominator,$roof_decoration_option);
    echo "BDID: <br>";
    print_r($roof_decoration_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($floor_decoration_numerator)){
    $bdId = insertFloorDecorData($fId,$floor_decoration_numerator,$floor_decoration_denominator,$floor_decoration_option);
    echo "BDID: <br>";
    print_r($floor_decoration_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($ceiling_decoration_numerator)){
    $bdId = insertCeilingData($fId,$ceiling_decoration_numerator,$ceiling_decoration_denominator,$ceiling_decoration_option);
    echo "BDID: <br>";
    print_r($ceiling_decoration_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

// if($door_window_numerator[0] != ""){
//     $bdId = insertDoorWindowData($fId,$door_window_numerator,$door_window_denominator,$door_window,$double_door,$double_window,$main_building);
//     echo "門窗 BDID: <br>";
//     print_r($door_window);
//     print_r($double_door);
//     print_r($double_window);
//     echo "<br>";
//     echo "回傳值<br>";
//     print_r($bdId);
//     echo "<br>";
//     print_r($fId);
// }
if(!$isDoorEmpty){
    insertNewDoorWindowData($fId,$resultArray,$resultRatio,$resultNumerator,$resultDenominator,$main_building);
}

if(!empty($toilet_ratio)){
    $bdId = insertToiletData($fId,$toilet_ratio,$toilet_type,$toilet_product,$toilet_number);
    echo "浴廁 BDID: <br>";
    print_r($toilet_ratio);
    print_r($toilet_type);
    print_r($toilet_product);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($electric_usage)){
    $bdId = insertElectricData($fId,$electric_usage,$electric_type);
    echo "<br>";
    echo "電器 BDID: <br>";
    print_r($electric_usage);
    print_r($electric_type);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($window_level)){
    $bdId = insertWindowLevelData($fId,$window_level,$main_building);
    echo "<br>";
    echo "窗型 BDID: <br>";
    print_r($window_level);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($daughter_wall)){
    $bdId = insertDaughterWallData($fId,$daughter_wall);
    echo "<br>";
    echo "女兒牆 BDID: <br>";
    print_r($daughter_wall);
    echo "<br>";
    echo "回傳值<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if(!empty($balcony)){
    $bdId = insertBalconyData($fId,$balcony);
    echo "<br>";
    echo "陽台 BDID: <br>";
    print_r($balcony);
    echo "<br>";
    echo "回傳值<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}
?>
