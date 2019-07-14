<?php
session_start();
include "library.php";
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$house_construct = load_building_decoration_Data('房屋構造體(別)');
$house_construct_option = "";

for($i=0;$i<count($house_construct);$i++){
    $house_construct_option = $house_construct_option
    ."<option value='".$house_construct[$i]["item_name"]."'>".$house_construct[$i]["item_name"]."</option>";
}

$add_minus_wall = load_building_decoration_Data('加減牆');
$add_minus_wall_option = "";

for($i=0;$i<count($add_minus_wall);$i++){
    $add_minus_wall_option = $add_minus_wall_option
    ."<option value='".$add_minus_wall[$i]["item_name"]."'>".$add_minus_wall[$i]["item_name"]."</option>";
}

$indoor_divide = load_building_decoration_Data('室內隔牆構造');
$indoor_divide_option = "";

for($i=0;$i<count($indoor_divide);$i++){
    $indoor_divide_option = $indoor_divide_option
    ."<option value='".$indoor_divide[$i]["item_name"]."'>".$indoor_divide[$i]["item_name"]."</option>";
}

$outdoor_wall_decoration = load_building_decoration_Data('屋外牆粉裝');
$outdoor_wall_decoration_option = "";

for($i=0;$i<count($outdoor_wall_decoration);$i++){
    $outdoor_wall_decoration_option = $outdoor_wall_decoration_option
    ."<option value='".$outdoor_wall_decoration[$i]["item_name"]."'>".$outdoor_wall_decoration[$i]["item_name"]."</option>";
}

$indoor_wall_decoration = load_building_decoration_Data('室內牆粉裝');
$indoor_wall_decoration_option = "";

for($i=0;$i<count($indoor_wall_decoration);$i++){
    $indoor_wall_decoration_option = $indoor_wall_decoration_option
    ."<option value='".$indoor_wall_decoration[$i]["item_name"]."'>".$indoor_wall_decoration[$i]["item_name"]."</option>";
}

$roof_decoration = load_building_decoration_Data('屋頂(面)粉裝');
$roof_decoration_option = "";

for($i=0;$i<count($roof_decoration);$i++){
    $roof_decoration_option = $roof_decoration_option
    ."<option value='".$roof_decoration[$i]["item_name"]."'>".$roof_decoration[$i]["item_name"]."</option>";
}

$floor_decoration = load_building_decoration_Data('樓地板粉裝');
$floor_decoration_option = "";

for($i=0;$i<count($floor_decoration);$i++){
    $floor_decoration_option = $floor_decoration_option
    ."<option value='".$floor_decoration[$i]["item_name"]."'>".$floor_decoration[$i]["item_name"]."</option>";
}

$ceiling_decoration = load_building_decoration_Data('天花板粉裝');
$ceiling_decoration_option = "";

for($i=0;$i<count($ceiling_decoration);$i++){
    $ceiling_decoration_option = $ceiling_decoration_option
    ."<option value='".$ceiling_decoration[$i]["item_name"]."'>".$ceiling_decoration[$i]["item_name"]."</option>";
}

$door_window = load_building_decoration_Data('門窗裝置');
$door_window_option = "";

for($i=0;$i<count($door_window);$i++){
    $door_window_option = $door_window_option
    ."<option value='".$door_window[$i]["item_name"]."'>".$door_window[$i]["item_name"]."</option>";
}

$toilet_equipment = load_building_decoration_Data('給水、浴、廁設備');
$toilet_equipment_option = "";

for($i=0;$i<count($toilet_equipment);$i++){
    $toilet_equipment_option = $toilet_equipment_option
    ."<option value='".$toilet_equipment[$i]["item_name"]."'>".$toilet_equipment[$i]["item_name"]."</option>";
}

$electric_usage = load_electric_Data();
$electric_usage_option = "";

for($i=0;$i<count($electric_usage);$i++){
    $electric_usage_option = $electric_usage_option
    ."<option value='".$electric_usage[$i]["item_type"]."'>".$electric_usage[$i]["item_type"]."</option>";
}


$smarty->assign("house_construct_option",$house_construct_option);
$smarty->assign("add_minus_wall_option",$add_minus_wall_option);
$smarty->assign("indoor_divide_option",$indoor_divide_option);
$smarty->assign("outdoor_wall_decoration_option",$outdoor_wall_decoration_option);
$smarty->assign("indoor_wall_decoration_option",$indoor_wall_decoration_option);
$smarty->assign("roof_decoration_option",$roof_decoration_option);
$smarty->assign("floor_decoration_option",$floor_decoration_option);
$smarty->assign("ceiling_decoration_option",$ceiling_decoration_option);
$smarty->assign("door_window_option",$door_window_option);
$smarty->assign("toilet_equipment_option",$toilet_equipment_option);
$smarty->assign("electric_usage_option",$electric_usage_option);
$smarty->display("index.html");
?>
