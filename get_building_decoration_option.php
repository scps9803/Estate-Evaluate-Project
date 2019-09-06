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

    case 'floor_type':
        $material = $_POST['material'];
        $building_type = $_POST['building_type'];
        $result_option = get_floor_type_option($material,$building_type);
        break;

    case 'add_minus_wall':
        $result_option = get_building_decoration_option('加減牆');
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

    case 'toilet_type':
        $item_name = $_POST['item_name'];
        $result_option = get_toilet_type_option($item_name);
        break;

    case 'land_section':
        $str = $_POST['str'];
        $result_option = get_land_section_option($str);
        break;

    case 'land_number':
        $section = $_POST['section'];
        $subsection = $_POST['subsection'];
        $land_number = $_POST['land_number'];
        // $temp = checkLandNumisExist($section,$subsection,$land_number);
        $result_option = checkLandNumisExist($section,$subsection,$land_number);
        // $result_option = $temp["land_number"];
        break;

    case 'sub_building_category':
        $result_option = getSubbuildingCategory();
        break;

    case 'sub_building_item':
        $application = $_POST['application'];
        $result_option = getSubbuildingOption($application);
        break;
        // echo json_encode(array('item_name' => $result_option["item_name"], 'unit' => $result_option["unit"]));
        // return;
    case 'sub_building_unit':
        $application = $_POST['application'];
        $item_name = $_POST['item_name'];
        $result_option = getSubbuildingUnit($application,$item_name);
        break;

    case 'land_lord':
        $name = $_POST['name'];
        $hold_id = $_POST['hold_id'];
        $result_option = checkLandLordisExist($name,$hold_id);
        break;
    case 'corp_category':
        $result_option = get_corp_item_option();
        break;

    case 'corp_item':
        $classfication = $_POST['classfication'];
        $result_option = getCorpOption($classfication);
        break;

    case 'corp_type':
        $corp_item = $_POST['corp_item'];
        $result_option = getCorpTypeOption($corp_item);
        break;

    case 'corp_unit':
        $corp_item = $_POST['corp_item'];
        $corp_type = $_POST['corp_type'];
        $result_option = getCorpUnitOption($corp_item,$corp_type);
        break;

    case 'land_owner':
        $str = $_POST['str'];
        $result_option = getLandOwnerOption($str);
        break;

    case 'auto_complete_owner':
        $section = $_POST['section'];
        $subsection = $_POST['subsection'];
        $land_number = $_POST['land_number'];
        $result_option = getAutoCompleteOwnerData($section,$subsection,$land_number);
        echo json_encode(array('hold_id' => $result_option["hold_id"],
        'name' => $result_option["name"],'address' => $result_option["address"],
        'numerator' => $result_option["numerator"],'denominator' => $result_option["denominator"]));
        return;

    case 'auto_calculate_area':
        $corp_category = $_POST['corp_category'];
        $corp_item = $_POST['corp_item'];
        $corp_type = $_POST['corp_type'];
        $corp_num = $_POST['corp_num'];
        $result_option = getAutoCalculateArea($corp_category,$corp_item,$corp_type,$corp_num);
        break;

    case 'check_script_No':
        $script_number = $_POST['script_number'];
        $table = $_POST['table'];
        $result_option = checkScriptNo($script_number,$table);
        break;

    case 'check_address':
        $address = $_POST['address'];
        $result_option = checkAddress($address);
        break;
}
// $item_type = $_POST['item_type'];
//
// $electric_type_option = set_electric_type($item_type);

// echo json_encode(array('item_name' => $electric_type_option));
echo json_encode(array('item_name' => $result_option));
?>
