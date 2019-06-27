<?php
session_start();
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$script_number = $_POST['legal-status']."-".$_POST['script-number'];
$owner_count = $_POST['owner_count'];
for($i=0;$i<$owner_count;$i++){
    $owner[$i] = $_POST['owner-'.($i+1)];
    $pId[$i] = $_POST['pId-'.($i+1)];
    $address[$i] = $_POST['addressText-'.($i+1)];
    $cellphone[$i] = $_POST['cellphone-'.($i+1)];
    $telephone[$i] = $_POST['telephone-'.($i+1)];
}

$legal_status = $_POST['legal-status'];
$legal_certificate = $_POST['legal_certificate'];
$house_address = $_POST['houseAddress'];
$legal_number = $_POST['build-number']."<br>".$_POST['tax_number'];
$location = "桃園市、".$_POST['district']."、".$_POST['land-section-1']."，".$_POST['land-number-1']."，"
."標示面積 ".$_POST['total-area']." m<sup>2</sup>";

$remove_condition = $_POST['remove_condition'];
$land_use = $_POST['land-use'];

if($telephone[0]==""){
    $phone = $cellphone[0];
}
else if($cellphone[0]==""){
    $phone = $telephone[0];
}
else{
    $phone = $cellphone[0]."，".$telephone[0];
}

$exit_num = $_POST['exit-num'];
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

$total_floor = $_POST['total-floor-1'];
for($i=0;$i<$total_floor;$i++){
    $main_building[$i]["material"] = $_POST['building-material-'.($i+1)];
    if($_POST['house-usage-'.($i+1)]=="none"){
        $main_building[$i]["usage"] = $_POST['other-house-usage-'.($i+1)];
    }else{
        $main_building[$i]["usage"] = $_POST['house-usage-'.($i+1)];
    }
}
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
