<?php
session_start();
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$script_number = $_POST['legal-status']."-".$_POST['script-number'];
$owner = $_POST['owner-1'];
$pId = $_POST['pId-1'];
$address = $_POST['addressText-1'];
$phone = $_POST['cellphone-1'];
$legal_status = $_POST['legal-status'];
$legal_certificate = $_POST['legal_certificate'];
$house_address = $_POST['houseAddress'];
$legal_number = $_POST['build-number']."<br>".$_POST['tax_number'];
$location = "桃園市、".$_POST['district']."、".$_POST['land-section-1']."，".$_POST['land-number-1']."，"
."標示面積 ".$_POST['total-area']." m<sup>2</sup>";

$remove_condition = $_POST['remove_condition'];
$captain = $_POST['captain-1'];
$family_num = $_POST['family-num-1'];
$household_number = $_POST['household-number-1'];
$set_household_date = $_POST['set-household-date-1'];
$land_use = $_POST['land-use'];
// $daughter_wall_front = $_POST['daughter-wall-front-1'];
// echo $daughter_wall_front;
// for($i=0;$i<count($daughter_wall);$i++){
//     echo $daughter_wall[$i]."、";
// }

if($phone==""){
    $phone = $_POST['telephone-1'];
}

$smarty->assign("script_number",$script_number);
$smarty->assign("owner",$owner);
$smarty->assign("pId",$pId);
$smarty->assign("address",$address);
$smarty->assign("phone",$phone);

$smarty->assign("legal_status",$legal_status);
$smarty->assign("legal_certificate",$legal_certificate);
$smarty->assign("house_address",$house_address);
$smarty->assign("legal_number",$legal_number);
$smarty->assign("location",$location);
$smarty->assign("remove_condition",$remove_condition);
$smarty->assign("captain",$captain);
$smarty->assign("family_num",$family_num);
$smarty->assign("household_number",$household_number);
$smarty->assign("set_household_date",$set_household_date);
$smarty->assign("land_use",$land_use);
// $smarty->assign("daughter_wall",$daughter_wall);

$smarty->display("house_submit_preview.html");
?>
