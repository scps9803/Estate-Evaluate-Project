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
$captain = $_POST['captain'];
$family_num = $_POST['family-num'];
$household_number = $_POST['household-number'];
$set_household_date = $_POST['set-household-date'];

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

$smarty->display("house_submit_preview.html");
?>
