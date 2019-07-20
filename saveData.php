<?php
session_start();
require_once "smarty/libs/Smarty.class.php";
include("library.php");
$smarty = new Smarty;

$house_address = $_POST['house_address'];
$other_item_count = $_POST['other-item-count'];
// 儲存雜項物資料
for($i=0;$i<$other_item_count;$i++){
    $sub_building[$i]["category"] = $_POST['other-item-category-'.($i+1)];
    $sub_building[$i]["item"] = $_POST['other-item-'.($i+1)];
    $sub_building[$i]["item_type"] = $_POST['other-item-type-'.($i+1)];
    $sub_building[$i]["area_calculate_text"] = $_POST['calArea-'.($i+1)];
    $sub_building[$i]["area"] = $_POST['calArea-'.($i+1)];
    $sub_building[$i]["auto_remove"] = $_POST['auto-remove-'.($i+1)];
}

insertSubbuildingData($house_address,$sub_building);
?>
