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

    case 'get_corp_owner_data':
        $script_number = $_POST['script_number'];
        $result_option = getCorpOwnerData2($script_number);

        echo json_encode(array('pId' => $result_option["pId"],
        'hold_numerator' => $result_option["hold_numerator"],
        'hold_denominator' => $result_option["hold_denominator"],
        'name' => $result_option["name"],
        'current_address' => $result_option["current_address"],
        'telephone' => $result_option["telephone"],
        'cellphone' => $result_option["cellphone"],
        'hold_status' => $result_option["hold_status"],));
        return;

    case 'get_corp_land_owner_data':
        $script_number = $_POST['script_number'];
        $result_option = getCorpLandOwnerData3($script_number);

        echo json_encode(array('pId' => $result_option["pId"],
        'name' => $result_option["name"],
        'hold_id' => $result_option["hold_id"],
        'name' => $result_option["name"],
        'current_address' => $result_option["current_address"],
        'telephone' => $result_option["telephone"],
        'cellphone' => $result_option["cellphone"],));
        return;

    case 'get_corp_land_data':
        $script_number = $_POST['script_number'];
        $result_option = getCorpLandData2($script_number);

        echo json_encode(array('land_section' => $result_option["land_section"],
        'subsection' => $result_option["subsection"],
        'land_number' => $result_option["land_number"],
        'district' => $result_option["district"],
        'land_use' => $result_option["land_use"],
        'survey_date' => $result_option["survey_date"],
        ));
        return;

    case 'get_corp_data':
        $script_number = $_POST['script_number'];
        $result_option = getCorpData2($script_number);

        echo json_encode(array('category' => $result_option["category"],
        'item' => $result_option["item"],
        'num' => $result_option["num"],
        'plant_area_text' => $result_option["plant_area_text"],
        'equal' => $result_option["equal"],
        'note' => $result_option["note"],
        'corp_type' => $result_option["corp_type"]));
        return;

    case 'get_corp_item':
        $classfication = $_POST['classfication'];
        $result_option = getCorpOption2($classfication);

        echo json_encode(array('item' => $result_option["item"]));
        return;

    case 'get_corp_type':
        $item = $_POST['item'];
        $result_option = getCorpTypeOption2($item);
        echo json_encode(array('corp_type' => $result_option["corp_type"]));
        return;

    case 'get_survey_date':
        $table = $_POST['table'];
        $script_number = $_POST['script_number'];
        $result_option = getSurveyDate($table,$script_number);
        break;

    case 'get_land_data':
        $script_number = $_POST['script_number'];
        $result_option = getLandData2($script_number);

        echo json_encode(array('land_section' => $result_option["land_section"],
        'subsection' => $result_option["subsection"],
        'land_number' => $result_option["land_number"],
        'district' => $result_option["district"],
        'land_use' => $result_option["land_use"],
        ));
        return;

    case 'get_owner_data':
        $script_number = $_POST['script_number'];
        $result_option = getOwnerData3($script_number);

        echo json_encode(array('pId' => $result_option["pId"],
        'hold_numerator' => $result_option["hold_numerator"],
        'hold_denominator' => $result_option["hold_denominator"],
        'name' => $result_option["name"],
        'current_address' => $result_option["current_address"],
        'telephone' => $result_option["telephone"],
        'cellphone' => $result_option["cellphone"],
        'hold_status' => $result_option["hold_status"]));
        return;

    case 'get_land_owner_data':
        $script_number = $_POST['script_number'];
        $result_option = getLandOwnerData2($script_number);

        echo json_encode(array('pId' => $result_option["pId"],
        'name' => $result_option["name"],
        'hold_id' => $result_option["hold_id"],
        'name' => $result_option["name"],
        'current_address' => $result_option["current_address"],
        'telephone' => $result_option["telephone"],
        'cellphone' => $result_option["cellphone"],));
        return;

    case 'get_building_data':
        $script_number = $_POST['script_number'];
        $result_option = getBuildingData2($script_number);

        echo json_encode(array('real_address' => $result_option["real_address"],
        'build_number' => $result_option["build_number"],
        'tax_number' => $result_option["tax_number"],
        'legal_certificate' => $result_option["legal_certificate"],
        'start_build_certificate' => $result_option["start_build_certificate"],
        'exit_number' => $result_option["exit_number"],
        'remove_condition' => $result_option["remove_condition"],));
        return;

    case 'get_resident_data':
        $script_number = $_POST['script_number'];
        $result_option = getResidentData2($script_number);

        echo json_encode(array('captain_id' => $result_option["captain_id"],
        'captain_name' => $result_option["captain_name"],
        'household_number' => $result_option["household_number"],
        'set_household_date' => $result_option["set_household_date"],
        'family_num' => $result_option["family_num"]));
        return;

    case 'get_main_building_data':
        $script_number = $_POST['script_number'];
        $page = $_POST["page"];
        $result_option = getMainBuildingData2($script_number,$page);

        echo json_encode(array('building_type' => $result_option["building_type"],
        'fId' => $result_option["fId"],
        'discard_status' => $result_option["discard_status"],
        'compensate_form' => $result_option["compensate_form"],
        'structure' => $result_option["structure"],
        'floor_type' => $result_option["floor_type"],
        'nth_floor' => $result_option["nth_floor"],
        'total_floor' => $result_option["total_floor"],
        'floor_area_calculate_text' => $result_option["floor_area_calculate_text"],
        'use_type' => $result_option["use_type"],
        'layer_height' => $result_option["layer_height"]));
        return;

    case 'get_building_decoration_data':
        $script_number = $_POST['script_number'];
        $decoration_type = $_POST['decoration_type'];
        $f_order = $_POST['f_order'];
        $result_option = getBuildingDecorationData2($script_number,$decoration_type,$f_order);

        echo json_encode(array('numerator' => $result_option["numerator"],
        'denominator' => $result_option["denominator"],
        'ratio' => $result_option["ratio"],
        'item_name' => $result_option["item_name"],
        'item_type' => $result_option["item_type"],
        'area' => $result_option["area"]));
        return;

    case 'check_next_page':
        $script_number = $_POST['script_number'];
        $page = $_POST['page'];
        $result_option = checkNextPage($script_number,$page);
        break;

    case 'delete_page_data':
        $script_number = $_POST['script_number'];
        $page = $_POST['page'];
        $result_option = deletePageData($script_number,$page);
        break;

    case 'get_subbuilding_data':
        $address = $_POST['address'];
        $result_option = getOldSubbuildingData($address);

        echo json_encode(array('application' => $result_option["application"],
        'item_name' => $result_option["item_name"],
        'item_type' => $result_option["item_type"],
        'area_calculate_text' => $result_option["area_calculate_text"],
        'unit' => $result_option["unit"],
        'auto_remove' => $result_option["auto_remove"],
        'sId' => $result_option["sId"]));
        return;

    case 'check_subbuilding':
        $script_number = $_POST['script_number'];
        $result_option = checkSubbuilding($script_number);
        break;

    case 'delete_subbuilding':
        $script_number = $_POST['script_number'];
        $result_option = deleteSubbuildingData($script_number);
        break;
    
    case 'get_fence_option':
        $type = $_POST['type'];
        $result_option = getFenceOption($type);
        break;
    
    case 'get_fence_data':
        $address = $_POST['address'];
        $sId = $_POST['sId'];
        $result_option = getFenceData($address,$sId);

        echo json_encode(array('fence_application' => $result_option["fence_application"],
        'fence_item' => $result_option["fence_item"]));
        return;
    
    case 'get_auto_remove':
        $application = $_POST['application'];
        $item_name = $_POST['item_name'];
        $result_option = getAutoRemove($application,$item_name);
        break;
}
// $item_type = $_POST['item_type'];
//
// $electric_type_option = set_electric_type($item_type);

// echo json_encode(array('item_name' => $electric_type_option));
echo json_encode(array('item_name' => $result_option));
?>
