<?php
session_start();
require_once "smarty/libs/Smarty.class.php";
include("library.php");
$smarty = new Smarty;

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

// 合法狀態、手稿編號
$legal_status = $_POST['legal-status'];
$script_number = $_POST['legal-status']."-".$_POST['script-number'];

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
if($captain_count>=1){
    for($i=0;$i<$captain_count;$i++){
        $captain[$i]['name'] = $_POST['captain-'.($i+1)];
        $captain[$i]['id'] = $_POST['captain-id-'.($i+1)];
        $captain[$i]['household_number'] = $_POST['household-number-'.($i+1)];
        $captain[$i]['set_household_date'] = $_POST['set-household-date-'.($i+1)];
        $captain[$i]['family_num'] = $_POST['family-num-'.($i+1)];
        $total_people += $_POST['family-num-'.($i+1)];;
        $smarty->assign("captain",$captain);
    }
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
for($i=0;$i<$total_floor;$i++){
    $main_building[$i]["floor_id"] = $_POST['floor-id-'.($i+1)];
    $main_building[$i]["house_type"] = $_POST['house-type-'.($i+1)];
    $main_building[$i]["compensate_form"] = $_POST['compensate-form-'.($i+1)];

    // if($main_building[$i]["compensate_form"]=="主建物"){
    //     $main_building[$i]["sub_compensate_form"] = $_POST['sub-compensate-form-'.($i+1)];
    // }else{
    //     $main_building[$i]["sub_compensate_form"] = "";
    // }
    // echo $main_building[$i]["compensate_form"].","."\n";
    $main_building[$i]["material"] = $_POST['building-material-'.($i+1)];
    $main_building[$i]["nth_floor"] = $_POST['nth-floor-'.($i+1)];
    $main_building[$i]["floor_area"] = $_POST['floor-area-'.($i+1)];

    if($_POST['house-usage-'.($i+1)]=="none"){
        $main_building[$i]["usage"] = $_POST['other-house-usage-'.($i+1)];
    }else{
        $main_building[$i]["usage"] = $_POST['house-usage-'.($i+1)];
    }

    $main_building[$i]["layer-height"] = $_POST['layer-height-'.($i+1)];

    // 減牆
    $minus_wall_count = getAppendSelectData('minus-wall-count-',$total_floor);
    $minus_wall_option = getAppendSelectData('minus-wall-option-',$total_floor);
    for($i=0;$i<$total_floor;$i++){
        for($j=0;$j<count($minus_wall_count[$i]);$j++){
            echo $minus_wall_count[$i][$j]."面".$minus_wall_option[$i][$j].",";
        }
        echo "<br>";
    }
}



// $test = getAppendSelectData('minus-wall-count-');
// for($i=0;$i<4;$i++){
//     for($j=0;$j<count($test[$i]);$j++){
//         echo $test[$i][$j].",";
//     }
//     echo "<br>";
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
$smarty->assign("land_use",$land_use);
$smarty->assign("main_building",$main_building);
$smarty->assign("date",$date);

$smarty->display("house_submit_preview.html");
?>
