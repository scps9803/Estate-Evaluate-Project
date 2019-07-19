<?php
session_start();
require_once "smarty/libs/Smarty.class.php";
include("library.php");
$smarty = new Smarty;

$KEYIN_ID = "DEMO1234";
date_default_timezone_set('Asia/Taipei');
$KEYIN_DATETIME = date("Y-m-d/H:i:s");

// 程式動作設定
$action = $_POST['action'];
switch ($action) {
    case 'continue':
        // code...
        break;

    case 'sub_building':
        $smarty->display("sub_building.html");
        break;

    case 'submit':
        break;
}

// 行政區
$district = $_POST['district'];

// 地段、小段、地號
$land_section_count = $_POST['land_section_count'];
for($i=0;$i<$land_section_count;$i++){
    if($_POST['land-section-'.($i+1)]=="") break;
    $land_section[$i] = $_POST['land-section-'.($i+1)];
    $subsection[$i] = $_POST['subsection-'.($i+1)];
    $land_number[$i] = $_POST['land-number-'.($i+1)];
}
// 土地總面積
$land_total_area = $_POST['land-total-area'];

// 合法狀態、手稿編號、廢棄狀態
$legal_status = $_POST['legal-status'];
$script_number = $_POST['legal-status']."-".$_POST['script-number'];
// $discard_status = $_POST['discard-status'];
// echo "廢棄: ".$discard_status;

// 建物所有人、持分、身分證字號、住址、電話等個人資料
$owner_count = $_POST['owner_count'];
for($i=0;$i<$owner_count;$i++){
    $owner[$i] = $_POST['owner-'.($i+1)];
    $hold_ratio[$i] = $_POST['hold-numerator-'.($i+1)] / $_POST['hold-denominator-'.($i+1)];
    $pId[$i] = $_POST['pId-'.($i+1)];
    $address[$i] = $_POST['addressText-'.($i+1)];
    $cellphone[$i] = $_POST['cellphone-'.($i+1)];
    $telephone[$i] = $_POST['telephone-'.($i+1)];
}

// 房屋門牌
$house_address = $_POST['houseAddress'];
// 拆除情形
$remove_condition = $_POST['remove_condition'];
// 合法證明文件
$legal_certificate = $_POST['legal_certificate'];
// 建號
$build_number = $_POST['build-number'];
// 座落土地使用權屬
$land_use = $_POST['land-use'];
// 起造證明文件
$build_certificate = $_POST['build-certificate'];
// 稅籍編號
$tax_number = $_POST['tax_number'];
// 出口數
$exit_num = $_POST['exit-num'];

// 現住人資料
$captain_count = $_POST['captain_count'];
$total_people = 0;
if(isset($_POST['independent-judge'])){
    $independent = explode (",",$_POST['independent-judge']);
}

if($captain_count>=1){
    for($i=0;$i<$captain_count;$i++){
        $captain[$i]['name'] = $_POST['captain-'.($i+1)];
        $captain[$i]['independent'] = $independent[$i];
        $captain[$i]['id'] = $_POST['captain-id-'.($i+1)];
        $captain[$i]['household_number'] = $_POST['household-number-'.($i+1)];
        $captain[$i]['set_household_date'] = $_POST['set-household-date-'.($i+1)];
        $captain[$i]['family_num'] = $_POST['family-num-'.($i+1)];
        $total_people += $_POST['family-num-'.($i+1)];;
        $smarty->assign("captain",$captain);
    }
}

// 租賃關係
if($land_use=="承租"){
    $rent_relation = "有";
}
else{
    $rent_relation = "無";
}
// ------------------------------以上為調查表個資部分----------------------------------
// ------------------------------以下為建物查估部分----------------------------------
$legal_number = $_POST['build-number']."<br>".$_POST['tax_number'];
$location = "桃園市、".$_POST['district']."、".$_POST['land-section-1']."，".$_POST['land-number-1']."，"
."標示面積 ".$_POST['land-total-area']." m<sup>2</sup>";



if($telephone[0]==""){
    $phone = $cellphone[0];
}
else if($cellphone[0]==""){
    $phone = $telephone[0];
}
else{
    $phone = $cellphone[0]."，".$telephone[0];
}


// 每層樓詳細資訊、粉裝評點等細項資料
$total_floor = $_POST['total-floor-1'];
// for($i=0;$i<$total_floor;$i++){
    for($i=0;$i<$total_floor;$i++){
        // echo "hi<br>";
        $main_building[$i]["floor_id"] = $_POST['floor-id-'.($i+1)];
        $fId[$i] = $script_number."-".$main_building[$i]["floor_id"];
        $main_building[$i]["house_type"] = $_POST['house-type-'.($i+1)];
        $discard_status[$i] = $_POST['discard-status-'.($i+1)];
        $main_building[$i]["compensate_form"] = $_POST['compensate-form-'.($i+1)];

        // if($main_building[$i]["compensate_form"]=="主建物"){
        //     $main_building[$i]["sub_compensate_form"] = $_POST['sub-compensate-form-'.($i+1)];
        // }else{
        //     $main_building[$i]["sub_compensate_form"] = "";
        // }
        // echo $main_building[$i]["compensate_form"].","."\n";
        $main_building[$i]["material"] = $_POST['building-material-'.($i+1)];
        $main_building[$i]["floor_type"] = $_POST['floor-type-'.($i+1)];
        $main_building[$i]["nth_floor"] = $_POST['nth-floor-'.($i+1)];
        $main_building[$i]["points"] = getMainBuildingPoint($main_building[$i]["material"],$main_building[$i]["floor_type"],$main_building[$i]["house_type"]);
        $main_building[$i]["floor_area"] = $_POST['floor-area-'.($i+1)];
        // print_r($main_building[$i]["points"]);
        // echo "<br>";
        // print_r($main_building[$i]["floor_area"]);
        // echo "<br>";

        if($_POST['house-usage-'.($i+1)]=="none"){
            $main_building[$i]["usage"] = $_POST['other-house-usage-'.($i+1)];
        }else{
            $main_building[$i]["usage"] = $_POST['house-usage-'.($i+1)];
        }

        $main_building[$i]["layer-height"] = $_POST['layer-height-'.($i+1)];
        // print_r($main_building)."<br>";
        // $points = getMainBuildingPoint($main_building[$i]["material"],$main_building[$i]["nth_floor"],$main_building[$i]["house_type"]);
        // for($j=0;$j<count($points);$j++){
        //     print_r($points)."<br>";
        // }
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
    for($i=0;$i<$total_floor;$i++){
        $door_window_numerator[$i] = $_POST['door-window-numerator-'.($i+1)];
        $door_window_denominator[$i] = $_POST['door-window-denominator-'.($i+1)];
        $door_window[$i] = $_POST['door-window-'.($i+1)];
        $double_door[$i] = $_POST['double-door-'.($i+1)];
        $double_window[$i] = $_POST['double-window-'.($i+1)];
        echo $door_window_numerator[$i]."/".$door_window_denominator[$i]."--".$door_window[$i].",".$double_door[$i].",".$double_window[$i]."<br>";

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

$date = date("Y/m/d");

$smarty->assign("script_number",$script_number);
if($owner_count<=1){
    $smarty->assign("owner",$owner[0]);
}else{
    $smarty->assign("owner",$owner[0]."等".$owner_count."人");
}

$smarty->assign("pId",$pId[0]);
$smarty->assign("address",$address[0]);
$smarty->assign("phone",$phone);

$smarty->assign("legal_status",$legal_status);
$smarty->assign("legal_certificate",$legal_certificate);
$smarty->assign("house_address",$house_address);
$smarty->assign("legal_number",$legal_number);
$smarty->assign("location",$location);
$smarty->assign("remove_condition",$remove_condition);
// $smarty->assign("captain",$captain);
$smarty->assign("captain_count",$captain_count);
$smarty->assign("total_people",$total_people);
$smarty->assign("rent_relation",$rent_relation);
$smarty->assign("land_use",$land_use);
$smarty->assign("main_building",$main_building);
$smarty->assign("date",$date);

$smarty->display("house_submit_preview.html");

// 儲存基本資料
insertLandData($land_section,$subsection,$land_number,$house_address,$land_use);
insertRecordData($script_number,$house_address,$KEYIN_ID,$KEYIN_DATETIME);
insertOwnerData($owner,$hold_ratio,$pId,$house_address,$address,$telephone,$cellphone);
insertBuildingData($house_address,$legal_status,$build_number,$tax_number,
    $legal_certificate,$build_certificate,$captain_count,$exit_num,
    $total_floor,$remove_condition);
insertOwnBuildingData($pId,$house_address,$hold_ratio);
insertResidentData($captain,$total_people,$house_address,$exit_num,$remove_condition);
insertFloorData($script_number,$main_building,$house_address,$discard_status);

// 儲存粉裝資料
if($minus_wall_count[0][0] != ""){
    $bdId = insertMinusWallData($fId,$minus_wall_count,$minus_wall_option);
    echo "減牆 BDID: <br>";
    print_r($minus_wall_count);
    print_r($minus_wall_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($add_wall_count[0][0] != ""){
    $bdId = insertAddWallData($fId,$add_wall_count,$add_wall_option);
    echo "加牆 BDID: <br>";
    print_r($add_wall_count);
    print_r($add_wall_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($indoor_divide_numerator[0][0] != ""){
    $bdId = insertIndoorDivideData($fId,$indoor_divide_numerator,$indoor_divide_denominator,$indoor_divide_option);
    echo "BDID: <br>";
    print_r($indoor_divide_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($outdoor_wall_decoration_numerator[0][0] != ""){
    $bdId = insertOutdoorWallData($fId,$main_building,$outdoor_wall_decoration_numerator,$outdoor_wall_decoration_denominator,$outdoor_wall_decoration_option);
    echo "BDID: <br>";
    print_r($outdoor_wall_decoration_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($indoor_wall_decoration_numerator[0][0] != ""){
    $bdId = insertIndoorWallData($fId,$indoor_wall_type,$indoor_wall_decoration_numerator,$indoor_wall_decoration_denominator,$indoor_wall_decoration_option);
    echo "BDID: <br>";
    print_r($indoor_wall_decoration_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($roof_decoration_numerator[0][0] != ""){
    $bdId = insertRoofData($fId,$roof_decoration_numerator,$roof_decoration_denominator,$roof_decoration_option);
    echo "BDID: <br>";
    print_r($roof_decoration_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($floor_decoration_numerator[0][0] != ""){
    $bdId = insertFloorDecorData($fId,$floor_decoration_numerator,$floor_decoration_denominator,$floor_decoration_option);
    echo "BDID: <br>";
    print_r($floor_decoration_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($ceiling_decoration_numerator[0][0] != ""){
    $bdId = insertCeilingData($fId,$ceiling_decoration_numerator,$ceiling_decoration_denominator,$ceiling_decoration_option);
    echo "BDID: <br>";
    print_r($ceiling_decoration_option);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($door_window_numerator[0] != ""){
    $bdId = insertDoorWindowData($fId,$door_window_numerator,$door_window_denominator,$door_window,$double_door,$double_window,$main_building);
    echo "門窗 BDID: <br>";
    print_r($door_window);
    print_r($double_door);
    print_r($double_window);
    echo "<br>";
    echo "回傳值<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($toilet_ratio[0][0] != ""){
    $bdId = insertToiletData($fId,$toilet_ratio,$toilet_type,$toilet_product);
    echo "浴廁 BDID: <br>";
    print_r($toilet_ratio);
    print_r($toilet_type);
    print_r($toilet_product);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($electric_usage[0] != ""){
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

if($window_level[0] != ""){
    $bdId = insertWindowLevelData($fId,$window_level,$main_building);
    echo "<br>";
    echo "窗型 BDID: <br>";
    print_r($window_level);
    echo "<br>";
    print_r($bdId);
    echo "<br>";
    print_r($fId);
}

if($daughter_wall[0] != ""){
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

if($balcony[0] != ""){
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
