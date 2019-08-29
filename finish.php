<?php
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$house_address = $_POST['house_address'];
$script_number = $_POST['script_number'];
$smarty->assign("house_address",$house_address);
$smarty->assign("script_number",$script_number);
$smarty->display("finish.html");
?>
