<?php
include "library.php";
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$category = $_POST['category'];
switch ($category) {
    case 'electric_type':
        $item_type = $_POST['item_type'];
        $result_option = get_electric_type_option('電氣設備(包括燈具)',$item_type);
        break;

    case 'indoor_divide':
        $result_option = get_building_decoration_option('室內隔牆構造');
        break;

    case 'outdoor_wall_decoration':
        $result_option = get_building_decoration_option('屋外牆粉裝');
        break;

    case 'indoor_wall_decoration':
        $result_option = get_building_decoration_option('室內牆粉裝');
        break;

    case 'roof_decoration':
        $result_option = get_building_decoration_option('屋頂(面)粉裝');
        break;

    case 'floor_decoration':
        $result_option = get_building_decoration_option('樓地板粉裝');
        break;

    case 'ceiling_decoration':
        $result_option = get_building_decoration_option('天花板粉裝');
        break;

    case 'toilet_equipment':
        $result_option = get_building_decoration_option('給水、浴、廁設備');
        break;
}
// $item_type = $_POST['item_type'];
//
// $electric_type_option = set_electric_type($item_type);

// echo json_encode(array('item_name' => $electric_type_option));
echo json_encode(array('item_name' => $result_option));
?>
