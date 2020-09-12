<?php
function connect_db()
{
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "estate_evaluate_project";
    // $servername = "localhost";
    // $username = "dayicom_jimmy7920";
    // $password = "ji7151618";
    // $dbname = "dayicom_test_db";
    // $dbname = "dayicom_estate_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    mysqli_set_charset($conn,'utf8');
    return $conn;
}

function load_building_decoration_Data($category){
    $conn = connect_db();
    $sql = "SELECT distinct item_name FROM building_decoration WHERE category='{$category}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $house_construct[$i] = $row;
        $i++;
    }

    $conn->close();
    return $house_construct;
}

function load_electric_Data(){
    $conn = connect_db();
    $sql = "SELECT distinct item_type FROM building_decoration WHERE category='電氣設備(包括燈具)'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $house_construct[$i] = $row;
        $i++;
    }

    $conn->close();
    return $house_construct;
}

function load_corp_item_Data(){
    $conn = connect_db();
    $sql = "SELECT DISTINCT category FROM corp";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_category[$i] = $row;
        $i++;
    }

    $conn->close();
    return $corp_category;
}

function get_corp_category_option(){
    $corp_category = load_corp_item_Data();
    $corp_category_option = "<option value='' style='display:none;'>請選擇種類</option>";

    for($i=0;$i<count($corp_category);$i++){
        $corp_category_option = $corp_category_option
        ."<option value='".$corp_category[$i]["category"]."'>".$corp_category[$i]["category"]."</option>";
    }
    return $corp_category_option;
}

function getCorpUnitOption($corp_item,$corp_type){
    $conn = connect_db();

    if($corp_type=="none"){
        $sql = "SELECT unit FROM corp WHERE item='{$corp_item}'";
    }
    else{
        $sql = "SELECT unit FROM corp WHERE item='{$corp_item}' AND (corp_age='{$corp_type}' OR cm_length='{$corp_type}' OR m_length='{$corp_type}')";
    }

    $res = $conn->query($sql);
    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_unit[$i] = $row;
        $i++;
    }

    if($res->num_rows==1){
        $corp_unit_option = "<option value='".$corp_unit[0]["unit"]."'>".$corp_unit[0]["unit"]."</option>";
        return $corp_unit_option;
    }
    else{
        return "<option>".$res->num_rows."</option>";
    }
    // return $corp_unit_option;
}

function get_electric_type_option($category,$item_type){
    require_once "smarty/libs/Smarty.class.php";
    $smarty = new Smarty;

    $conn = connect_db();
    $sql = "SELECT distinct item_name FROM building_decoration WHERE category='{$category}' AND item_type='{$item_type}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $electric_type[$i] = $row;
        $i++;
    }

    $conn->close();

    $electric_type_option = "";

    for($i=0;$i<count($electric_type);$i++){
        $electric_type_option = $electric_type_option
        ."<option value='".$electric_type[$i]["item_name"]."'>".$electric_type[$i]["item_name"]."</option>";
    }

    return $electric_type_option;
}

function get_building_decoration_option($category){
    require_once "smarty/libs/Smarty.class.php";
    $smarty = new Smarty;

    $conn = connect_db();
    $sql = "SELECT distinct item_name FROM building_decoration WHERE category='{$category}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $electric_type[$i] = $row;
        $i++;
    }

    $conn->close();

    $electric_type_option = "";

    for($i=0;$i<count($electric_type);$i++){
        $electric_type_option = $electric_type_option
        ."<option value='".$electric_type[$i]["item_name"]."'>".$electric_type[$i]["item_name"]."</option>";
    }

    return $electric_type_option;
}

function getAppendSelectData($id,$total_floor){
    $value_array = array();
    for($i=0;$i<$total_floor;$i++){
        $count = $_POST[$id.($i+1)];

        $value_array[$i] = explode (",",$count);
    }
    return $value_array;
}

function getMainBuildingPoint($material,$floor_type,$house_type){
    $conn = connect_db();
    $sql = "SELECT bdId,item_type,points FROM building_decoration WHERE category='房屋構造體(別)' AND item_name='{$material}' AND item_type='{$floor_type}' AND building_type='{$house_type}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        // $main_building_points[$i] = $row;
        // $points = number_format((float)$row["points"],2);
        $points = number_format($row["points"],2);
        // $main_building_points = $row["points"];
        $main_building_points = $points;
        // print_r($row)."<br>";
        $i++;
    }

    $conn->close();
    return $main_building_points;
}

function get_floor_type_option($material,$building_type){
    require_once "smarty/libs/Smarty.class.php";
    $smarty = new Smarty;

    $conn = connect_db();
    $sql = "SELECT item_type FROM building_decoration WHERE category='房屋構造體(別)' AND item_name='$material' AND building_type='{$building_type}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $floor_type[$i] = $row;
        $i++;
    }

    $conn->close();

    $floor_type_option = "";

    for($i=0;$i<count($floor_type);$i++){
        $floor_type_option = $floor_type_option
        ."<option value='".$floor_type[$i]["item_type"]."'>".$floor_type[$i]["item_type"]."</option>";
    }

    return $floor_type_option;
}

function get_toilet_type_option($item_name){
    $conn = connect_db();
    $sql = "SELECT item_type FROM building_decoration WHERE category='給水、浴、廁設備' AND item_name='{$item_name}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $toilet_product[$i] = $row;
        $i++;
    }

    $conn->close();

    $toilet_product_option = "";

    for($i=0;$i<count($toilet_product);$i++){
        $toilet_product_option = $toilet_product_option
        ."<option value='".$toilet_product[$i]["item_type"]."'>".$toilet_product[$i]["item_type"]."</option>";
    }

    return $toilet_product_option;
}

function get_land_section_option($str){
    $conn = connect_db();
    $sql = "SELECT DISTINCT land_section FROM land WHERE land_section LIKE '%{$str}%'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $land_section[$i] = $row;
        $i++;
    }

    $conn->close();

    $land_section_option = "";

    for($i=0;$i<count($land_section);$i++){
        $land_section_option = $land_section_option
        ."<option value='".$land_section[$i]["land_section"]."'>".$land_section[$i]["land_section"]."</option>";
    }

    return $land_section_option;
}

function insertLandData($district,$land_section,$subsection,$land_number,$house_address,$land_use){
    $conn = connect_db();

    for($i=0;$i<count($land_section);$i++){
        for($j=0;$j<count($land_number[$i]);$j++){
            $land_id = $land_section[$i].$subsection[$i].$land_number[$i][$j];
            $sql = "INSERT INTO building_locate VALUES('{$land_id}','{$district}','{$house_address}','{$land_use}')";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // $land_id = $land_section[$i].$subsection[$i].$land_number[$i];
        // $sql = "INSERT INTO building_locate VALUES('{$land_id}','{$house_address}','{$land_use}')";
        //
        // if ($conn->query($sql) === TRUE){
        //     // echo "New record created successfully";
        // }else{
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }
    }
    $conn->close();
}

function insertRecordData($script_number,$house_address,$KEYIN_ID,$KEYIN_DATETIME,$survey_date){
    $conn = connect_db();
    $sql = "INSERT INTO record VALUES('{$script_number}','{$house_address}','{$KEYIN_ID}','{$KEYIN_DATETIME}','{$survey_date}')";

    if ($conn->query($sql) === TRUE){
        // echo "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function insertOwnerData($owner,$hold_ratio,$pId,$house_address,$address,$telephone,$cellphone){
    $conn = connect_db();

    for($i=0;$i<count($owner);$i++){
        echo $owner[$i]. " : ".$telephone[$i]."<br>";
        $sql = "INSERT INTO owner VALUES('{$pId[$i]}','{$owner[$i]}','{$pId[$i]}','{$house_address}','{$address[$i]}','{$telephone[$i]}','{$cellphone[$i]}') ON DUPLICATE KEY UPDATE pId='{$pId[$i]}',name='{$owner[$i]}',household_number='{$pId[$i]}',address='{$house_address}',current_address='{$address[$i]}',telephone='{$telephone[$i]}',cellphone='{$cellphone[$i]}'";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

function insertBuildingData($house_address,$real_address,$legal_status,$build_number,$tax_number,
    $legal_certificate,$build_certificate,$captain_count,$exit_num,
    $total_floor,$remove_condition,$rent_relation){

        $conn = connect_db();
        $sql = "INSERT INTO building VALUES('{$house_address}','{$real_address}','{$legal_status}','{$build_number}',
            '{$tax_number}','{$legal_certificate}','{$build_certificate}','{$captain_count}',
            '{$exit_num}','{$total_floor}','{$remove_condition}','{$rent_relation}') ON DUPLICATE KEY UPDATE address='{$house_address}',
            real_address='{$real_address}',legal_status='{$legal_status}',build_number='{$build_number}',
            tax_number='{$tax_number}',legal_certificate='{$legal_certificate}',start_build_certificate='{$build_certificate}',
            household_count='{$captain_count}',exit_number='{$exit_num}',layer_number='{$total_floor}',
            remove_condition='{$remove_condition}',rent_relation='{$rent_relation}'";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

function insertOwnBuildingData($pId,$house_address,$hold_ratio,$hold_numerator,$hold_denominator,$shared,$owner_order){
    $conn = connect_db();

    for($i=0;$i<count($pId);$i++){
        $sql = "INSERT INTO own_building VALUES('{$pId[$i]}','{$house_address}','{$hold_ratio[$i]}','{$hold_numerator[$i]}','{$hold_denominator[$i]}','{$shared}','{$owner_order[$i]}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

// function insertResidentData($captain,$total_people,$house_address,$exit_num,$remove_condition){
//     $conn = connect_db();
//     $total_family_num = 0;
//     $index = 0;
//     $shareFeeIndex = array();
//
//     $no_count = 0;
//     for($i=0;$i<count($captain);$i++){
//         if($captain[$i]["cohabit"]=="no"){
//             $no_count += 1;
//         }
//     }
//     if($no_count<2){
//         for($i=0;$i<count($captain);$i++){
//             if($captain[$i]["cohabit"]=="yes"){
//                 $shareFeeIndex[$index] = $i;
//                 $total_family_num += $captain[$i]["family_num"];
//                 $move_status[$i] = "共同領取";
//                 $index++;
//             }
//             else{
//                 if($captain[$i]["family_num"]<6){
//                     $sql = "SELECT mId FROM migration_fee WHERE family_num='{$captain[$i]["family_num"]}' AND item_type='{$remove_condition}'";
//                 }
//                 else{
//                     $sql = "SELECT mId FROM migration_fee WHERE family_num='6' AND item_type='{$remove_condition}'";
//                 }
//
//                 $res = $conn->query($sql);
//                 while($row = $res->fetch_assoc()) {
//                     $mId[$i] = $row["mId"];
//                 }
//                 $move_status[$i] = "個別領取";
//             }
//         }
//
//         for($i=0;$i<count($shareFeeIndex);$i++){
//             if($total_family_num<6){
//                 $sql = "SELECT mId FROM migration_fee WHERE family_num='{$total_family_num}' AND item_type='{$remove_condition}'";
//             }
//             else{
//                 $sql = "SELECT mId FROM migration_fee WHERE family_num='6' AND item_type='{$remove_condition}'";
//             }
//
//             $res = $conn->query($sql);
//             while($row = $res->fetch_assoc()) {
//                 $mId[$shareFeeIndex[$i]] = $row["mId"];
//             }
//         }
//
//         for($i=0;$i<count($captain);$i++){
//             $sql = "INSERT INTO resident VALUES('{$captain[$i]["id"]}','{$captain[$i]["name"]}',
//                 '{$captain[$i]["household_number"]}','{$captain[$i]["set_household_date"]}',
//                 '{$captain[$i]["family_num"]}','{$house_address}','{$mId[$i]}','{$move_status[$i]}')";
//
//             if ($conn->query($sql) === TRUE){
//                 // echo "New record created successfully";
//             }else{
//                 echo "Error: " . $sql . "<br>" . $conn->error;
//             }
//         }
//     }
//     else{
//         $index_yes = 0;
//         $index_no = 0;
//         $total_yes = 0;
//         $total_no = 0;
//         for($i=0;$i<count($captain);$i++){
//             if($captain[$i]["cohabit"]=="yes"){
//                 $captain_yes[$index_yes] = $captain[$i];
//                 $move_status_yes[$index_yes] = "共同領取";
//                 $total_yes += $captain[$i]["family_num"];
//                 $index_yes++;
//             }
//             else{
//                 $captain_no[$index_no] = $captain[$i];
//                 $move_status_no[$index_no] = "共同領取";
//                 $total_no += $captain[$i]["family_num"];
//                 $index_no++;
//             }
//         }
//         // 分別插入兩組資料
//         for($i=0;$i<count($captain_yes);$i++){
//             if($total_yes<6){
//                 $sql = "SELECT mId FROM migration_fee WHERE family_num='{$total_yes}' AND item_type='{$remove_condition}'";
//             }
//             else{
//                 $sql = "SELECT mId FROM migration_fee WHERE family_num='6' AND item_type='{$remove_condition}'";
//             }
//
//             $res = $conn->query($sql);
//             while($row = $res->fetch_assoc()) {
//                 $mId[$i] = $row["mId"];
//             }
//         }
//
//         for($i=0;$i<count($captain_yes);$i++){
//             $sql = "INSERT INTO resident VALUES('{$captain_yes[$i]["id"]}','{$captain_yes[$i]["name"]}',
//                 '{$captain_yes[$i]["household_number"]}','{$captain_yes[$i]["set_household_date"]}',
//                 '{$captain_yes[$i]["family_num"]}','{$house_address}','{$mId[$i]}','{$move_status_yes[$i]}')";
//
//             if ($conn->query($sql) === TRUE){
//                 // echo "New record created successfully";
//             }else{
//                 echo "Error: " . $sql . "<br>" . $conn->error;
//             }
//         }
//
//         for($i=0;$i<count($captain_no);$i++){
//             if($total_no<6){
//                 $sql = "SELECT mId FROM migration_fee WHERE family_num='{$total_no}' AND item_type='{$remove_condition}'";
//             }
//             else{
//                 $sql = "SELECT mId FROM migration_fee WHERE family_num='6' AND item_type='{$remove_condition}'";
//             }
//
//             $res = $conn->query($sql);
//             while($row = $res->fetch_assoc()) {
//                 $mId[$i] = $row["mId"];
//             }
//         }
//
//         for($i=0;$i<count($captain_no);$i++){
//             $sql = "INSERT INTO resident VALUES('{$captain_no[$i]["id"]}','{$captain_no[$i]["name"]}',
//                 '{$captain_no[$i]["household_number"]}','{$captain_no[$i]["set_household_date"]}',
//                 '{$captain_no[$i]["family_num"]}','{$house_address}','{$mId[$i]}','{$move_status_no[$i]}')";
//
//             if ($conn->query($sql) === TRUE){
//                 // echo "New record created successfully";
//             }else{
//                 echo "Error: " . $sql . "<br>" . $conn->error;
//             }
//         }
//     }
//     $conn->close();
// }

function insertResidentData($captain,$total_people,$house_address,$exit_num,$remove_condition){
    $conn = connect_db();
    // $total_family_num = 0;
    // $index = 0;
    // $shareFeeIndex = array();

    // for($i=0;$i<count($captain);$i++){
    //     $total_family_num = 0;
    //     $index = 0;
    //     $shareFeeIndex = array();
    //
    //     $total_family_num += $captain[$i]["family_num"];
    //     $shareFeeIndex[$index] = $i;
    //     $index++;
    //     for($j=$i+1;$j<count($captain);$j++){
    //         if($captain[$i]["exitNo"]==$captain[$j]["exitNo"]){
    //             $shareFeeIndex[$index] = $j;
    //             $total_family_num += $captain[$j]["family_num"];
    //             $index++;
    //         }
    //         else{
    //
    //         }
    //     }
    //     // INSERT
    // }
    getGroupIndex($captain,$remove_condition,$house_address);
    $conn->close();
}

function getGroupIndex($captain,$remove_condition,$house_address){
    // for($i=0;$i<count($captain);$i++){
        $conn = connect_db();
        $total_family_num = 0;
        $index = 0;
        $shareFeeIndex = array();

        $other_index = 0;
        $other_shareFeeIndex = array();

        $total_family_num += $captain[0]["family_num"];
        $shareFeeIndex[$index] = 0;
        $index++;

        $captain[0]["move_status"] = "個別領取";

        if(count($captain)>1){
            for($i=1;$i<count($captain);$i++){
                if($captain[0]["exitNo"]==$captain[$i]["exitNo"]){
                    $shareFeeIndex[$index] = $i;
                    $total_family_num += $captain[$i]["family_num"];
                    $captain[0]["move_status"] = "共同領取";
                    $captain[$i]["move_status"] = "共同領取";
                    $index++;
                }
                else{
                    $other_captain[$other_index] = $captain[$i];
                    $other_index++;
                }
            }
        }
        // INSERT
        if($total_family_num>=6){
            $total_family_num = 6;
        }
        for($i=0;$i<count($shareFeeIndex);$i++){
            if($remove_condition == "無"){
                $sql = "SELECT mId FROM migration_fee WHERE item_type='{$remove_condition}'";
            }
            else{
                $sql = "SELECT mId FROM migration_fee WHERE family_num='{$total_family_num}' AND item_type='{$remove_condition}'";
            }
            
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc()) {
                $mId = $row["mId"];
            }

            $sql = "INSERT INTO resident VALUES('{$captain[$shareFeeIndex[$i]]["id"]}',
            '{$captain[$shareFeeIndex[$i]]["name"]}','{$captain[$shareFeeIndex[$i]]["household_number"]}',
            '{$captain[$shareFeeIndex[$i]]["set_household_date"]}','{$captain[$shareFeeIndex[$i]]["family_num"]}',
            '{$house_address}','{$mId}','{$captain[$shareFeeIndex[$i]]["move_status"]}')";
            if($conn->query($sql) == False){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        // recursive call
        if($other_index>0){
            getGroupIndex($other_captain,$remove_condition,$house_address);
        }
        $conn->close();
    // }
}

function insertFloorData($script_number,$main_building,$house_address,$discard_status){
    $conn = connect_db();

    for($i=0;$i<count($main_building);$i++){
        $fId = $script_number."-".$main_building[$i]["floor_id"];
        $sql = "INSERT INTO floor_info VALUES('{$fId}','{$main_building[$i]["f_order"]}',
            '{$main_building[$i]["house_type"]}',
            '{$discard_status[$i]}','{$main_building[$i]["compensate_form"]}',
            '{$main_building[$i]["material"]}','{$main_building[$i]["floor_type"]}',
            '{$main_building[$i]["nth_floor"]}','{$main_building[$i]["total_floor"]}','{$main_building[$i]["floor_area_calculate_text"]}',
            '{$main_building[$i]["floor_area"]}','{$main_building[$i]["usage"]}',
            '{$main_building[$i]["layer-height"]}','{$house_address}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "SELECT bdId FROM building_decoration WHERE category='房屋構造體(別)' AND
            item_name='{$main_building[$i]["material"]}' AND item_type='{$main_building[$i]["floor_type"]}'
            AND building_type='{$main_building[$i]["house_type"]}'";

        $res = $conn->query($sql);
        while($row = $res->fetch_assoc()) {
            $bdId[$i] = $row["bdId"];
        }

        $sql = "INSERT INTO has_building_decoration VALUES('{$fId}','{$bdId[$i]}',NULL,1,1,1)";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

function insertMinusWallData($fId,$minus_wall_count,$minus_wall_option){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){

        for($j=0;$j<count($minus_wall_count[$i]);$j++){

            $sql = "SELECT bdId FROM building_decoration WHERE category='加減牆' AND item_name='{$minus_wall_option[$i][$j]}' AND item_type='減牆'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                break;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }

            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$minus_wall_count[$i][$j]}','{$minus_wall_count[$i][$j]}',1)";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

function insertAddWallData($fId,$add_wall_count,$add_wall_option){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){

        for($j=0;$j<count($add_wall_count[$i]);$j++){

            $sql = "SELECT bdId FROM building_decoration WHERE category='加減牆' AND item_name='{$add_wall_option[$i][$j]}' AND item_type='加牆'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                break;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }

            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$add_wall_count[$i][$j]}','{$add_wall_count[$i][$j]}',1)";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

function insertIndoorDivideData($fId,$indoor_divide_numerator,$indoor_divide_denominator,$indoor_divide_option){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){

        for($j=0;$j<count($indoor_divide_numerator[$i]);$j++){

            $sql = "SELECT bdId FROM building_decoration WHERE category='室內隔牆構造' AND item_name='{$indoor_divide_option[$i][$j]}'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                break;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }

            $ratio = (float)$indoor_divide_numerator[$i][$j]/$indoor_divide_denominator[$i][$j];
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}','{$indoor_divide_numerator[$i][$j]}','{$indoor_divide_denominator[$i][$j]}')";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

function insertOutdoorWallData($fId,$main_building,$outdoor_wall_decoration_numerator,$outdoor_wall_decoration_denominator,$outdoor_wall_decoration_option){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){

        for($j=0;$j<count($outdoor_wall_decoration_numerator[$i]);$j++){

            $sql = "SELECT bdId FROM building_decoration WHERE category='屋外牆粉裝' AND item_name='{$outdoor_wall_decoration_option[$i][$j]}' AND building_type='{$main_building[$i]["house_type"]}'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                break;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }

            $ratio = (float)$outdoor_wall_decoration_numerator[$i][$j]/$outdoor_wall_decoration_denominator[$i][$j];
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}','{$outdoor_wall_decoration_numerator[$i][$j]}','{$outdoor_wall_decoration_denominator[$i][$j]}')";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

function insertIndoorWallData($fId,$indoor_wall_type,$indoor_wall_decoration_numerator,$indoor_wall_decoration_denominator,$indoor_wall_decoration_option){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){

        for($j=0;$j<count($indoor_wall_decoration_numerator[$i]);$j++){

            $sql = "SELECT bdId FROM building_decoration WHERE category='室內牆粉裝' AND item_name='{$indoor_wall_decoration_option[$i][$j]}' AND item_type='{$indoor_wall_type[$i][$j]}'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                break;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }

            $ratio = (float)$indoor_wall_decoration_numerator[$i][$j]/$indoor_wall_decoration_denominator[$i][$j];
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}','{$indoor_wall_decoration_numerator[$i][$j]}','{$indoor_wall_decoration_denominator[$i][$j]}')";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

function insertRoofData($fId,$roof_decoration_numerator,$roof_decoration_denominator,$roof_decoration_option){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){

        for($j=0;$j<count($roof_decoration_numerator[$i]);$j++){

            $sql = "SELECT bdId FROM building_decoration WHERE category='屋頂(面)粉裝' AND item_name='{$roof_decoration_option[$i][$j]}'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                break;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }

            $ratio = (float)$roof_decoration_numerator[$i][$j]/$roof_decoration_denominator[$i][$j];
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}','{$roof_decoration_numerator[$i][$j]}','{$roof_decoration_denominator[$i][$j]}')";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

function insertFloorDecorData($fId,$floor_decoration_numerator,$floor_decoration_denominator,$floor_decoration_option){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){

        for($j=0;$j<count($floor_decoration_numerator[$i]);$j++){

            $sql = "SELECT bdId FROM building_decoration WHERE category='樓地板粉裝' AND item_name='{$floor_decoration_option[$i][$j]}'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                break;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }

            $ratio = (float)$floor_decoration_numerator[$i][$j]/$floor_decoration_denominator[$i][$j];
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}','{$floor_decoration_numerator[$i][$j]}','{$floor_decoration_denominator[$i][$j]}')";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

function insertCeilingData($fId,$ceiling_decoration_numerator,$ceiling_decoration_denominator,$ceiling_decoration_option){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){

        for($j=0;$j<count($ceiling_decoration_numerator[$i]);$j++){

            $sql = "SELECT bdId FROM building_decoration WHERE category='天花板粉裝' AND item_name='{$ceiling_decoration_option[$i][$j]}'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                break;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }

            $ratio = (float)$ceiling_decoration_numerator[$i][$j]/$ceiling_decoration_denominator[$i][$j];
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}','{$ceiling_decoration_numerator[$i][$j]}','{$ceiling_decoration_denominator[$i][$j]}')";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

// function insertDoorWindowData($fId,$door_window_numerator,$door_window_denominator,$door_window,$double_door,$double_window,$main_building){
//     $conn = connect_db();
//
//     for($i=0;$i<count($fId);$i++){
//
//         // if(($door_window[$i] != $double_door[$i]) && ($double_door[$i] != "")){
//         // 第二層僅有門或窗
//         if(($double_door[$i] == "") || ($double_window[$i] == "")){
//             // $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_door[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
//             $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_door[$i]}' OR item_name='{$double_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
//             $res = $conn->query($sql);
//
//             while($row = $res->fetch_assoc()) {
//                 $bdId[$i]["double"] = $row["bdId"];
//             }
//
//             $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i]["double"]}',NULL,0.5)";
//
//             if ($conn->query($sql) === TRUE){
//                 // echo "New record created successfully";
//             }else{
//                 echo "Error: " . $sql . "<br>" . $conn->error;
//             }
//         }
//         // else if(($door_window[$i] != $double_window[$i]) && ($double_window[$i] != "")){
//         //     $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
//         //     $res = $conn->query($sql);
//         //
//         //     while($row = $res->fetch_assoc()) {
//         //         $bdId[$i]["double"] = $row["bdId"];
//         //     }
//         //
//         //     $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i]["double"]}',NULL,0.5)";
//         //
//         //     if ($conn->query($sql) === TRUE){
//         //         // echo "New record created successfully";
//         //     }else{
//         //         echo "Error: " . $sql . "<br>" . $conn->error;
//         //     }
//         // }
//
//         // 第二層門窗皆有
//         else{
//             $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
//             $res = $conn->query($sql);
//
//             while($row = $res->fetch_assoc()) {
//                 $bdId[$i]["normal"] = $row["bdId"];
//             }
//
//             // $ratio = (float)$door_window_numerator[$i]/$door_window_denominator[$i];
//             $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i]["normal"]}',NULL,2)";
//
//             if ($conn->query($sql) === TRUE){
//                 // echo "New record created successfully";
//             }else{
//                 echo "Error: " . $sql . "<br>" . $conn->error;
//             }
//         }
//         $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
//         $res = $conn->query($sql);
//
//         while($row = $res->fetch_assoc()) {
//             $bdId[$i]["normal"] = $row["bdId"];
//         }
//
//         $ratio = (float)$door_window_numerator[$i]/$door_window_denominator[$i];
//         $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i]["normal"]}',NULL,'{$ratio}')";
//
//         if ($conn->query($sql) === TRUE){
//             // echo "New record created successfully";
//         }else{
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     }
//     $conn->close();
//     return $bdId;
// }

function insertDoorWindowData($fId,$door_window_numerator,$door_window_denominator,$door_window,$double_door,$double_window,$main_building){
    $conn = connect_db();
    for($i=0;$i<count($fId);$i++){
        if($double_door[$i] != "" && $double_window[$i] != ""){
            if($double_door[$i] == $double_window[$i]){
                if($double_door[$i] == $door_window[$i]){
                    // (1+ratio)*first
                    $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()) {
                        $bdId = $row["bdId"];
                    }
                    $ratio = 1+($door_window_numerator[$i]/$door_window_denominator[$i]);

                    $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$ratio}')";
                    if ($conn->query($sql) === TRUE){
                        // echo "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                else{
                    // 1 2nd door + ratio*first
                    $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_door[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()) {
                        $bdId = $row["bdId"];
                    }

                    $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,1)";
                    if ($conn->query($sql) === TRUE){
                        // echo "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    // ratio*first
                    $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()) {
                        $bdId = $row["bdId"];
                    }
                    $ratio = $door_window_numerator[$i]/$door_window_denominator[$i];

                    $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$ratio}')";
                    if ($conn->query($sql) === TRUE){
                        // echo "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
            else{
                if($double_door[$i] == $door_window[$i]){
                    // 0.5 2nd door + ratio*first
                    $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_door[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()) {
                        $bdId = $row["bdId"];
                    }

                    $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,0.5)";
                    if ($conn->query($sql) === TRUE){
                        // echo "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    // ratio*first
                    $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()) {
                        $bdId = $row["bdId"];
                    }
                    $ratio = $door_window_numerator[$i]/$door_window_denominator[$i];

                    $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$ratio}')";
                    if ($conn->query($sql) === TRUE){
                        // echo "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                else if($double_window[$i] == $door_window[$i]){
                    // 0.5 2nd window + ratio*first
                    $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()) {
                        $bdId = $row["bdId"];
                    }

                    $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,0.5)";
                    if ($conn->query($sql) === TRUE){
                        // echo "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    // ratio*first
                    $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()) {
                        $bdId = $row["bdId"];
                    }
                    $ratio = $door_window_numerator[$i]/$door_window_denominator[$i];

                    $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$ratio}')";
                    if ($conn->query($sql) === TRUE){
                        // echo "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                else{
                    // 0.5 2nd door + 0.5 2nd window + ratio*first
                    $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_door[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()) {
                        $bdId = $row["bdId"];
                    }

                    $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,0.5)";
                    if ($conn->query($sql) === TRUE){
                        // echo "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    // 0.5 2nd window
                    $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()) {
                        $bdId = $row["bdId"];
                    }

                    $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,0.5)";
                    if ($conn->query($sql) === TRUE){
                        // echo "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    // ratio*first
                    $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()) {
                        $bdId = $row["bdId"];
                    }
                    $ratio = $door_window_numerator[$i]/$door_window_denominator[$i];

                    $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$ratio}')";
                    if ($conn->query($sql) === TRUE){
                        // echo "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
        }
        else if($double_door[$i] != "" && $double_window[$i] == ""){
            if($double_door[$i] == $door_window[$i]){
                // 0.5 2nd door + ratio*first
                $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_door[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()) {
                    $bdId = $row["bdId"];
                }

                $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,0.5)";
                if ($conn->query($sql) === TRUE){
                    // echo "New record created successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                // ratio*first
                $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()) {
                    $bdId = $row["bdId"];
                }
                $ratio = $door_window_numerator[$i]/$door_window_denominator[$i];

                $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$ratio}')";
                if ($conn->query($sql) === TRUE){
                    // echo "New record created successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            else{
                // 0.5 2nd window + ratio*first
                $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()) {
                    $bdId = $row["bdId"];
                }

                $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,0.5)";
                if ($conn->query($sql) === TRUE){
                    // echo "New record created successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                // ratio*first
                $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()) {
                    $bdId = $row["bdId"];
                }
                $ratio = $door_window_numerator[$i]/$door_window_denominator[$i];

                $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$ratio}')";
                if ($conn->query($sql) === TRUE){
                    // echo "New record created successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        else if($double_door[$i] == "" && $double_window[$i] != ""){
            if($double_window[$i] == $door_window[$i]){
                // 0.5 2nd window + ratio*first
                $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()) {
                    $bdId = $row["bdId"];
                }

                $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,0.5)";
                if ($conn->query($sql) === TRUE){
                    // echo "New record created successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                // ratio*first
                $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()) {
                    $bdId = $row["bdId"];
                }
                $ratio = $door_window_numerator[$i]/$door_window_denominator[$i];

                $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$ratio}')";
                if ($conn->query($sql) === TRUE){
                    // echo "New record created successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            else{
                // 0.5 2nd door + ratio*first
                $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$double_door[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()) {
                    $bdId = $row["bdId"];
                }

                $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,0.5)";
                if ($conn->query($sql) === TRUE){
                    // echo "New record created successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                // ratio*first
                $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()) {
                    $bdId = $row["bdId"];
                }
                $ratio = $door_window_numerator[$i]/$door_window_denominator[$i];

                $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$ratio}')";
                if ($conn->query($sql) === TRUE){
                    // echo "New record created successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        else{
            // ratio*first
            $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$door_window[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc()) {
                $bdId = $row["bdId"];
            }
            $ratio = $door_window_numerator[$i]/$door_window_denominator[$i];

            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$ratio}')";
            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

function insertToiletData($fId,$toilet_ratio,$toilet_type,$toilet_product,$toilet_number){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){

        for($j=0;$j<count($toilet_type[$i]);$j++){

            $sql = "SELECT bdId FROM building_decoration WHERE category='給水、浴、廁設備' AND item_name='{$toilet_type[$i][$j]}' AND item_type='{$toilet_product[$i][$j]}'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                break;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }
            if($toilet_ratio[$i][$j] == 1){
                $numerator = 1;
                $denominator = 1;
            }
            else if($toilet_ratio[$i][$j] == 0.5){
                $numerator = 1;
                $denominator = 2;
            }
            // 將area欄位作為數量使用
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}','{$toilet_number[$i][$j]}','{$toilet_ratio[$i][$j]}','{$numerator}','{$denominator}')";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

function insertElectricData($fId,$electric_usage,$electric_type){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){
        $sql = "SELECT bdId FROM building_decoration WHERE category='電氣設備(包括燈具)' AND item_type='{$electric_usage[$i]}' AND item_name='{$electric_type[$i]}'";
        // $sql = "SELECT bdId FROM building_decoration WHERE category='電氣設備(包括燈具)' AND item_type='工廠庫房' AND item_name='電泡、普通日光燈露出配線簡單設備'";
        $res = $conn->query($sql);
        if($res->num_rows==0){
            continue;
        }

        while($row = $res->fetch_assoc()) {
            $bdId[$i] = $row["bdId"];
        }

        $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i]}',NULL,1,1,1)";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    return $bdId;
}

function insertWindowLevelData($fId,$window_level,$main_building){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){
        $sql = "SELECT bdId FROM building_decoration WHERE category='其他項目門窗裝置加柵' AND item_name='{$window_level[$i]}' AND building_type='{$main_building[$i]["house_type"]}'";
        $res = $conn->query($sql);
        if($res->num_rows==0){
            continue;
        }

        while($row = $res->fetch_assoc()) {
            $bdId[$i] = $row["bdId"];
        }

        $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i]}',NULL,1,1,1)";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    return $bdId;
}

function insertDaughterWallData($fId,$daughter_wall){
    $conn = connect_db();

    $sql = "SELECT DISTINCT item_name FROM building_decoration WHERE category='女兒牆'";
    $res = $conn->query($sql);
    $i = 0;
    while($row = $res->fetch_assoc()) {
        $item_name[$i] = $row["item_name"];
        $i++;
    }


    for($i=0;$i<count($fId);$i++){
        // $count = Array(""=>0, ""=>0, ""=>0);
        // 初始化陣列
        for($j=0;$j<count($item_name);$j++){
            $count["{$item_name[$j]}"] = 0;
        }

        for($j=0;$j<count($daughter_wall[$i]);$j++){
            $str = explode ("-",$daughter_wall[$i][$j]);
            if($str[0] == "half_B"){
                $value[$i][$j] = "1/2B";
            }
            else{
                $value[$i][$j] = $str[0];
            }
            $item[$j] = $value[$i][$j];
            $count["{$item[$j]}"] += 1;

            if($str[1]=="front"){
                $direction[$i][$j] = "前";
            }
            else if($str[1]=="behind"){
                $direction[$i][$j] = "後";
            }
            else if($str[1]=="left"){
                $direction[$i][$j] = "左";
            }
            else if($str[1]=="right"){
                $direction[$i][$j] = "右";
            }

            $sql = "SELECT bdId FROM building_decoration WHERE category='女兒牆' AND item_name='{$value[$i][$j]}' AND item_type='{$direction[$i][$j]}'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                return;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }

            // $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,1)";
            //
            // if ($conn->query($sql) === TRUE){
            //     // echo "New record created successfully";
            // }else{
            //     echo "Error: " . $sql . "<br>" . $conn->error;
            // }
        }

        for($j=0;$j<count($daughter_wall[$i]);$j++){
            // $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$count[$item[$j]]}')";
            // 改變儲存方式
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,1,1,1)";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

function insertBalconyData($fId,$balcony){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){
        // $sql = "SELECT bdId FROM building_decoration WHERE category='陽台' AND item_name='陽台'";
        // $res = $conn->query($sql);
        //
        // while($row = $res->fetch_assoc()) {
        //     $bdId[$i] = $row["bdId"];
        // }
        //
        // $count = count($balcony[$i]);
        // $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i]}',NULL,'{$count}')";
        //
        // if ($conn->query($sql) === TRUE){
        //     // echo "New record created successfully";
        // }else{
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }

        // 變更儲存方式
        for($j=0;$j<count($balcony[$i]);$j++){
            $sql = "SELECT bdId FROM building_decoration WHERE category='陽台' AND item_name='陽台' AND item_type='{$balcony[$i][$j]}'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                return;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }

            // $count = count($balcony[$i]);
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,1,1,1)";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    return $bdId;
}

function getOwnerData($house_address){
    $conn = connect_db();

    // $sql = "SELECT * FROM owner WHERE address='{$house_address}'";
    // $sql = "SELECT * FROM owner AS a JOIN landlord AS b ON a.name=b.name WHERE a.address='{$house_address}'";
    $sql = "SELECT pId,a.address,own_ratio,hold_numerator,hold_denominator,hold_status,keyin_order,b.name,current_address,telephone,cellphone,hold_id FROM own_building AS a NATURAL JOIN owner AS b LEFT JOIN landlord AS c ON b.name=c.name WHERE a.address='{$house_address}' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getOwnerData2($house_address){
    $conn = connect_db();

    $sql = "SELECT * FROM owner NATURAL JOIN own_building WHERE address='{$house_address}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getOwnerData3($house_address){
    $conn = connect_db();

    $sql = "SELECT pId,a.address,own_ratio,hold_numerator,hold_denominator,hold_status,keyin_order,b.name,current_address,telephone,cellphone,hold_id FROM own_building AS a NATURAL JOIN owner AS b LEFT JOIN landlord AS c ON b.name=c.name WHERE a.address='{$house_address}' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $owner["pId"][$i] = $row["pId"];
        $owner["hold_numerator"][$i] = $row["hold_numerator"];
        $owner["hold_denominator"][$i] = $row["hold_denominator"];
        $owner["name"][$i] = $row["name"];
        $owner["current_address"][$i] = $row["current_address"];
        $owner["telephone"][$i] = $row["telephone"];
        $owner["cellphone"][$i] = $row["cellphone"];
        $owner["hold_status"][$i] = $row["hold_status"];
        $i++;
    }
    $conn->close();

    return $owner;
}

function getLandOwnerData($house_address){
    $conn = connect_db();

    $sql = "SELECT * FROM land_owner NATURAL JOIN own_land WHERE address='{$house_address}' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getLandOwnerData2($house_address){
    $conn = connect_db();

    $sql = "SELECT * FROM land_owner NATURAL JOIN own_land WHERE address='{$house_address}' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $land_owner["pId"][$i] = $row["pId"];
        $land_owner["name"][$i] = $row["name"];
        $land_owner["hold_id"][$i] = $row["hold_id"];
        $land_owner["current_address"][$i] = $row["current_address"];
        $land_owner["telephone"][$i] = $row["telephone"];
        $land_owner["cellphone"][$i] = $row["cellphone"];
        $i++;
    }
    $conn->close();

    return $land_owner;
}

function getBuildingData($house_address){
    $conn = connect_db();

    $sql = "SELECT * FROM building WHERE address='{$house_address}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getBuildingData2($house_address){
    $conn = connect_db();

    $sql = "SELECT * FROM building WHERE address='{$house_address}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result["real_address"][$i] = $row["real_address"];
        $result["build_number"][$i] = $row["build_number"];
        $result["tax_number"][$i] = $row["tax_number"];
        $result["legal_certificate"][$i] = $row["legal_certificate"];
        $result["start_build_certificate"][$i] = $row["start_build_certificate"];
        $result["exit_number"][$i] = $row["exit_number"];
        $result["remove_condition"][$i] = $row["remove_condition"];
        $i++;
    }

    $conn->close();
    return $result;
}

function getLandData($house_address){
    $conn = connect_db();

    // $sql = "SELECT * FROM building_locate NATURAL JOIN land WHERE address='{$house_address}'";
    $sql = "SELECT * FROM building_locate AS a LEFT JOIN land AS b ON a.land_id=b.land_id WHERE address='{$house_address}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getLandData2($house_address){
    // $conn = connect_db();

    // // $sql = "SELECT * FROM building_locate NATURAL JOIN land WHERE address='{$house_address}'";
    // $sql = "SELECT * FROM building_locate AS a LEFT JOIN land AS b ON a.land_id=b.land_id WHERE address='{$house_address}'";
    // $res = $conn->query($sql);

    // $i = 0;
    // while($row = $res->fetch_assoc()) {
    //     $result[$i] = $row;
    //     $i++;
    // }

    // $conn->close();
    // // return $result;

    $conn = connect_db();
    $section_array = [];
    $subsection_array = [];
    $land_number_array = [];
    $index = 0;

    $sql = "SELECT * FROM building_locate AS a LEFT JOIN land AS b ON a.land_id=b.land_id WHERE address='{$house_address}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $land_data["district"][$i] = $row["dist"];
        $land_data["land_use"][$i] = $row["land_use"];

        if(!in_array($row["land_section"],$section_array)){
            $section_array[$index] = $row["land_section"];
            if($row["subsection"] == ""){
                $subsection_array[$index] = "";
            }
            else{
                $subsection_array[$index] = $row["subsection"];
            }
            $land_number_array[$index][0] = $row["land_number"];
            $index++;
        }
        else{
            $key = array_search($row["land_section"],$section_array);
            $land_number_array[$key][count($land_number_array[$key])] = $row["land_number"];
        }
        $i++;
    }
    for($i=0;$i<count($section_array);$i++){
        $land_data["land_section"][$i] = $section_array[$i];
        $land_data["subsection"][$i] = $subsection_array[$i];
        $land_data["land_number"][$i] = $land_number_array[$i];
    }
    $conn->close();

    return $land_data;
}

function getResidentData($house_address){
    $conn = connect_db();

    // $sql = "SELECT * FROM resident NATURAL JOIN migration_fee WHERE address='{$house_address}'";
    $sql = "SELECT captain_id,captain_name,household_number,set_household_date,r.family_num,move_status,fee FROM resident AS r LEFT JOIN migration_fee AS m ON r.mId=m.mId WHERE address='{$house_address}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return;
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getResidentData2($house_address){
    $conn = connect_db();

    $sql = "SELECT * FROM resident WHERE address='{$house_address}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return;
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result["captain_id"][$i] = $row["captain_id"];
        $result["captain_name"][$i] = $row["captain_name"];
        $result["household_number"][$i] = $row["household_number"];
        $result["set_household_date"][$i] = $row["set_household_date"];
        $result["family_num"][$i] = $row["family_num"];
        $i++;
    }

    $conn->close();
    return $result;
}

function getMainBuildingData($house_address){
    $conn = connect_db();

    // $sql = "SELECT * FROM (floor_info NATURAL JOIN has_building_decoration) NATURAL JOIN building_decoration WHERE address='{$house_address}' AND category='房屋構造體(別)' ORDER BY SUBSTRING_INDEX('fId', '-', 2)";
    $sql = "SELECT * FROM (floor_info NATURAL JOIN has_building_decoration) NATURAL JOIN building_decoration WHERE address='{$house_address}' AND category='房屋構造體(別)' ORDER BY CAST(f_order AS UNSIGNED)";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return;
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $row["points"] = number_format($row["points"],2,".","");
        $row["floor_area"] = number_format($row["floor_area"],2,".","");
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getMainBuildingData2($house_address,$page){
    $conn = connect_db();
    $max = $page*4;
    $min = ($page-1)*4+1;

    // $sql = "SELECT * FROM (floor_info NATURAL JOIN has_building_decoration) NATURAL JOIN building_decoration WHERE address='{$house_address}' AND category='房屋構造體(別)' ORDER BY SUBSTRING_INDEX('fId', '-', 2)";
    $sql = "SELECT * FROM (floor_info NATURAL JOIN has_building_decoration) NATURAL JOIN building_decoration WHERE address='{$house_address}' AND category='房屋構造體(別)' AND f_order<='{$max}' AND f_order>='{$min}' ORDER BY CAST(f_order AS UNSIGNED)";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return;
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result["building_type"][$i] = $row["building_type"];
        $result["fId"][$i] = $row["fId"];
        $result["discard_status"][$i] = $row["discard_status"];
        $result["compensate_form"][$i] = $row["compensate_form"];
        $result["structure"][$i] = $row["structure"];
        $result["floor_type"][$i] = $row["floor_type"];
        $result["nth_floor"][$i] = $row["nth_floor"];
        $result["total_floor"][$i] = $row["total_floor"];
        $result["floor_area_calculate_text"][$i] = $row["floor_area_calculate_text"];
        $result["use_type"][$i] = $row["use_type"];
        $result["layer_height"][$i] = $row["layer_height"];
        $i++;
    }

    $conn->close();
    return $result;
}

function checkLandNumisExist($section,$subsection,$land_number){
    $conn = connect_db();

    if($subsection==""){
        $sql = "SELECT * FROM land WHERE land_section='{$section}' AND subsection IS NULL AND land_number='{$land_number}'";
    }
    else{
        $sql = "SELECT * FROM land WHERE land_section='{$section}' AND subsection='{$subsection}'  AND land_number='{$land_number}'";
    }
    $res = $conn->query($sql);
    $conn->close();

    if($res->num_rows==0){
        return false;
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row["land_number"];
        $i++;
    }
    return $result;
}

function getSubbuildingCategory(){
    $conn = connect_db();

    $sql = "SELECT DISTINCT application FROM sub_building WHERE application!='圍牆' AND application!='粉刷' AND application!='加強柱' AND application!='其他'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $category[$i] = $row;
        $i++;
    }

    $conn->close();

    $category_option = "<option value=''>請選擇種類</option>";

    for($i=0;$i<count($category);$i++){
        $category_option = $category_option
        ."<option value='".$category[$i]["application"]."'>".$category[$i]["application"]."</option>";
    }

    return $category_option;
}

function getSubbuildingOption($application){
    $conn = connect_db();

    $sql = "SELECT * FROM sub_building WHERE application='{$application}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $sub_building[$i] = $row;
        $i++;
    }
    // while($row = $res->fetch_assoc()) {
    //     $sub_building["item_name"][$i] = $row["item_name"];
    //     $sub_building["unit"][$i] = $row["unit"];
    //     $i++;
    // }

    $conn->close();

    $sub_building_option = "";

    for($i=0;$i<count($sub_building);$i++){
        $sub_building_option = $sub_building_option
        ."<option value='".$sub_building[$i]["item_name"]."'>".$sub_building[$i]["item_name"]."</option>";
    }

    return $sub_building_option;
    // return $sub_building;
}

function getSubbuildingUnit($application,$item_name){
    $conn = connect_db();

    $sql = "SELECT * FROM sub_building WHERE application='{$application}' AND item_name='{$item_name}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $sub_building[$i] = $row;
        $i++;
    }

    $conn->close();

    $sub_building_unit = "";

    for($i=0;$i<count($sub_building);$i++){
        $sub_building_unit = $sub_building_unit
        ."<option value='".$sub_building[$i]["unit"]."'>".$sub_building[$i]["unit"]."</option>";
    }

    return $sub_building_unit;
}

function getAutoRemove($application,$item_name){
    $conn = connect_db();

    $sql = "SELECT * FROM sub_building WHERE application='{$application}' AND item_name='{$item_name}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $auto_remove[$i] = $row["auto_remove"];
        $i++;
    }

    $conn->close();

    return $auto_remove;
}

function insertSubbuildingData($house_address,$sub_building){
    deleteOldSubbuildingData($house_address);
    $conn = connect_db();

    for($i=0;$i<count($sub_building);$i++){
        $sql = "SELECT sId FROM sub_building WHERE application='{$sub_building[$i]["category"]}' AND item_name='{$sub_building[$i]["item"]}'";
        $res = $conn->query($sql);

        while($row = $res->fetch_assoc()) {
            $sId[$i] = $row["sId"];
        }

        $sql = "INSERT INTO has_subbuilding VALUES('{$house_address}','{$sId[$i]}',
            '{$sub_building[$i]["item_type"]}','{$sub_building[$i]["area_calculate_text"]}'
            ,'{$sub_building[$i]["area"]}','{$sub_building[$i]["auto_remove"]}','{$sub_building[$i]["keyin_order"]}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

function deleteOldSubbuildingData($house_address){
    $conn = connect_db();
    $sql = "DELETE FROM has_subbuilding WHERE address='{$house_address}'";
    $conn->query($sql);
    $conn->close();
}

function insertFenceData($house_address,$sub_building){
    deleteOldFenceData($house_address);
    $conn = connect_db();

    $index = -1;
    for($i=0;$i<count($sub_building);$i++){
        $j = -1;
        $sql = "SELECT sId FROM sub_building WHERE application='圍牆' AND item_name='{$sub_building[$i]["item"]}'";
        $res = $conn->query($sql);
        if($res->num_rows==0){
            continue;
        }
        if($sub_building[$i]["fence_paint"] != "" || $sub_building[$i]["fence_pillar"] != ""){
            $index++;
            $row = $res->fetch_assoc();
            $fenceId[$index] = $row["sId"];
            $keyin_order[$index] = $sub_building[$i]["keyin_order"];
        }

        $sql = "SELECT sId FROM sub_building WHERE application='粉刷' AND item_name='{$sub_building[$i]["fence_paint"]}'";
        $res = $conn->query($sql);
        if($res->num_rows!=0){
            $j++;
            $row = $res->fetch_assoc();
            $sId[$index][$j] = $row["sId"];
            $side[$index][$j] = "single";
        } 

        $sql = "SELECT sId FROM sub_building WHERE application='粉刷' AND item_name='{$sub_building[$i]["fence_double_paint"]}'";
        $res = $conn->query($sql);
        if($res->num_rows!=0){
            $j++;
            $row = $res->fetch_assoc();
            $sId[$index][$j] = $row["sId"];
            $side[$index][$j] = "double";
        } 

        $sql = "SELECT sId FROM sub_building WHERE application='加強柱' AND item_name='{$sub_building[$i]["fence_pillar"]}'";
        $res = $conn->query($sql);
        if($res->num_rows!=0){
            $j++;
            $row = $res->fetch_assoc();
            $sId[$index][$j] = $row["sId"];
        }
    }

    for($i=0;$i<count($sId);$i++){
        for($j=0;$j<count($sId[$i]);$j++){
            $sql = "INSERT INTO fence VALUES('{$house_address}','{$fenceId[$i]}','{$sId[$i][$j]}','{$side[$i][$j]}','{$keyin_order[$i]}')";
            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
}

function deleteOldFenceData($house_address){
    $conn = connect_db();
    $sql = "DELETE FROM fence WHERE address='{$house_address}'";
    $conn->query($sql);
    $conn->close();
}

function getSubbuildingData($house_address,$item_type){
    $conn = connect_db();

    // $sql = "SELECT * FROM has_subbuilding as a LEFT JOIN sub_building as b on a.sId=b.sId WHERE address='{$house_address}' AND item_type='{$item_type}'";
    $sql = "SELECT address,a.sId,application,item_name,unitprice,unit,item_type,area_calculate_text,area,a.auto_remove,note,keyin_order
        FROM has_subbuilding as a LEFT JOIN sub_building as b on a.sId=b.sId WHERE address='{$house_address}' AND item_type='{$item_type}' ORDER BY keyin_order";
    $res = $conn->query($sql);
    if($res->num_rows==0) return null;

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getAllSubbuildingData($house_address){
    $conn = connect_db();

    // $sql = "SELECT * FROM has_subbuilding as a LEFT JOIN sub_building as b on a.sId=b.sId WHERE address='{$house_address}' AND item_type='{$item_type}'";
    $sql = "SELECT address,a.sId,application,item_name,unitprice,unit,item_type,area_calculate_text,area,a.auto_remove,note,keyin_order
        FROM has_subbuilding as a LEFT JOIN sub_building as b on a.sId=b.sId WHERE address='{$house_address}' ORDER BY keyin_order";
    $res = $conn->query($sql);
    if($res->num_rows==0) return null;

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getDecorationData($house_address,$category){
    $conn = connect_db();

    // $sql = "SELECT * FROM has_building_decoration AS a LEFT JOIN floor_info AS b ON a.fId=b.fId LEFT JOIN building_decoration AS c ON a.bdId=c.bdId WHERE address='{$house_address}' AND category='{$category}' ORDER BY SUBSTRING_INDEX('fId', '-', 2)";
    $sql = "SELECT * FROM has_building_decoration AS a LEFT JOIN floor_info AS b ON a.fId=b.fId LEFT JOIN building_decoration AS c ON a.bdId=c.bdId WHERE address='{$house_address}' AND category='{$category}' ORDER BY CAST(f_order AS UNSIGNED)";
    $res = $conn->query($sql);
    if($res->num_rows==0) return null;

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getBuildingDecorationData($house_address,$category,$f_order){
    $conn = connect_db();

    // $sql = "SELECT * FROM has_building_decoration AS a LEFT JOIN floor_info AS b ON a.fId=b.fId LEFT JOIN building_decoration AS c ON a.bdId=c.bdId WHERE address='{$house_address}' AND category='{$category}' AND nth_floor='{$nth_floor}' ORDER BY nth_floor";
    $sql = "SELECT * FROM has_building_decoration AS a LEFT JOIN floor_info AS b ON a.fId=b.fId LEFT JOIN building_decoration AS c ON a.bdId=c.bdId WHERE address='{$house_address}' AND category='{$category}' AND f_order='{$f_order}' ORDER BY f_order";
    $res = $conn->query($sql);
    if($res->num_rows==0) return null;

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getAllBuildingDecorationData($house_address,$f_order){
    $conn = connect_db();

    // $sql = "SELECT * FROM has_building_decoration AS a LEFT JOIN floor_info AS b ON a.fId=b.fId LEFT JOIN building_decoration AS c ON a.bdId=c.bdId WHERE address='{$house_address}' AND category='{$category}' AND nth_floor='{$nth_floor}' ORDER BY nth_floor";
    $sql = "SELECT * FROM has_building_decoration AS a LEFT JOIN floor_info AS b ON a.fId=b.fId LEFT JOIN building_decoration AS c ON a.bdId=c.bdId WHERE address='{$house_address}' AND f_order='{$f_order}' ORDER BY f_order";
    $res = $conn->query($sql);
    if($res->num_rows==0) return null;

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getBuildingDecorationData2($house_address,$category,$f_order){
    $conn = connect_db();

    // $sql = "SELECT * FROM has_building_decoration AS a LEFT JOIN floor_info AS b ON a.fId=b.fId LEFT JOIN building_decoration AS c ON a.bdId=c.bdId WHERE address='{$house_address}' AND category='{$category}' AND nth_floor='{$nth_floor}' ORDER BY nth_floor";
    $sql = "SELECT * FROM has_building_decoration AS a LEFT JOIN floor_info AS b ON a.fId=b.fId LEFT JOIN building_decoration AS c ON a.bdId=c.bdId WHERE address='{$house_address}' AND category='{$category}' AND f_order='{$f_order}' ORDER BY f_order";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        $result["numerator"] = "";
        $result["denominator"] = "";
        $result["ratio"] = "";
        $result["item_name"] = "";
        $result["item_type"] = "";
        $result["area"] = "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result["numerator"][$i] = $row["numerator"];
        $result["denominator"][$i] = $row["denominator"];
        $result["ratio"][$i] = $row["ratio"];
        $result["item_name"][$i] = $row["item_name"];
        $result["item_type"][$i] = $row["item_type"];
        $result["area"][$i] = $row["area"];
        $i++;
    }

    $conn->close();
    return $result;
}

function insertFileData($script_number,$savePath,$fileNo,$filename,$file_type,$table){
    $conn = connect_db();
    $size = filesize($savePath.$filename.$file_type);
    $all_filename = $filename.$file_type;

    if($file_type == ".xls"){
        $content_type = "application/vnd.ms-excel";
    }
    else if($file_type == ".txt"){
        $content_type = "text/plain";
    }

    $sql = "INSERT INTO {$table} VALUES('{$fileNo}','{$savePath}','{$all_filename}','{$size}','{$content_type}','{$script_number}')";

    if ($conn->query($sql) === TRUE){
        // echo "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function getFileInfo($recordNo,$returnFile,$fileTable,$recordTable){
    $conn = connect_db();
    $filename = base64_encode($recordNo."-".$returnFile).".xls";

    $sql = "SELECT * FROM {$fileTable} NATURAL JOIN {$recordTable} WHERE rId='{$recordNo}' AND filename='{$filename}'";
    $res = $conn->query($sql);
    if($res->num_rows==0) return null;

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function checkLandLordisExist($name,$hold_id){
    $conn = connect_db();

    $sql = "SELECT * FROM landlord WHERE hold_id='{$hold_id}' AND name='{$name}'";
    $res = $conn->query($sql);
    $conn->close();

    if($res->num_rows==0){
        return false;
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row["address"];
        $i++;
    }
    return $result;
}

function insertLandOwnerData($land_owner,$hold_id,$land_pId,$landAddressText,$land_telephone,$land_cellphone,$house_address,$land_owner_order){
    $conn = connect_db();

    for($i=0;$i<count($land_owner);$i++){
        echo $hold_id[$i]." : ".$land_telephone[$i]."<br>";

        $sql = "INSERT INTO land_owner VALUES('{$hold_id[$i]}','{$land_pId[$i]}','{$land_owner[$i]}','{$land_telephone[$i]}','{$land_cellphone[$i]}','{$landAddressText[$i]}') ON DUPLICATE KEY UPDATE hold_id='{$hold_id[$i]}', pId='{$land_pId[$i]}', name='{$land_owner[$i]}', telephone='{$land_telephone[$i]}', cellphone='{$land_cellphone[$i]}', current_address='{$landAddressText[$i]}'";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO own_land VALUES('{$hold_id[$i]}','{$house_address}','{$land_owner_order[$i]}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

function getCorpOption($classfication){
    $conn = connect_db();

    $sql = "SELECT DISTINCT item FROM corp WHERE category='{$classfication}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_item[$i] = $row;
        $i++;
    }

    $conn->close();

    $corp_item_option = "";

    for($i=0;$i<count($corp_item);$i++){
        $corp_item_option = $corp_item_option
        ."<option value='".$corp_item[$i]["item"]."'>".$corp_item[$i]["item"]."</option>";
    }

    return $corp_item_option;
}

function getCorpOption2($classfication){
    $conn = connect_db();

    $sql = "SELECT DISTINCT item FROM corp WHERE category='{$classfication}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_item["item"][$i] = $row["item"];
        $i++;
    }

    return $corp_item;
}

function getCorpTypeOption($corp_item){
    $conn = connect_db();

    $sql = "SELECT * FROM corp WHERE item='{$corp_item}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_type[$i] = $row;
        $i++;
    }

    $conn->close();

    $corp_type_option = "";

    for($i=0;$i<count($corp_type);$i++){
        if($corp_type[$i]["corp_age"]!=NULL){
            $corp_type_option = $corp_type_option
            ."<option value='".$corp_type[$i]["corp_age"]."'>".$corp_type[$i]["corp_age"]."</option>";
        }
        else if($corp_type[$i]["cm_length"]!=NULL){
            $corp_type_option = $corp_type_option
            ."<option value='".$corp_type[$i]["cm_length"]."'>".$corp_type[$i]["cm_length"]."</option>";
        }
        else if($corp_type[$i]["m_length"]!=NULL){
            $corp_type_option = $corp_type_option
            ."<option value='".$corp_type[$i]["m_length"]."'>".$corp_type[$i]["m_length"]."</option>";
        }
        else{
            $corp_type_option = $corp_type_option
            ."<option value='none'>無特別規格</option>";
        }
    }

    return $corp_type_option;
}

function getCorpTypeOption2($corp_item){
    $conn = connect_db();

    $sql = "SELECT * FROM corp WHERE item='{$corp_item}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_type[$i] = $row;
        $i++;
    }

    $conn->close();

    // $corp_type_option = "";

    for($i=0;$i<count($corp_type);$i++){
        if($corp_type[$i]["corp_age"]!=NULL){
            // $corp_type_option = $corp_type_option
            // ."<option value='".$corp_type[$i]["corp_age"]."'>".$corp_type[$i]["corp_age"]."</option>";
            $corp_type_option["corp_type"][$i] = $corp_type[$i]["corp_age"];
        }
        else if($corp_type[$i]["cm_length"]!=NULL){
            // $corp_type_option = $corp_type_option
            // ."<option value='".$corp_type[$i]["cm_length"]."'>".$corp_type[$i]["cm_length"]."</option>";
            $corp_type_option["corp_type"][$i] = $corp_type[$i]["cm_length"];
        }
        else if($corp_type[$i]["m_length"]!=NULL){
            // $corp_type_option = $corp_type_option
            // ."<option value='".$corp_type[$i]["m_length"]."'>".$corp_type[$i]["m_length"]."</option>";
            $corp_type_option["corp_type"][$i] = $corp_type[$i]["m_length"];
        }
        else{
            // $corp_type_option = $corp_type_option
            // ."<option value='none'>無特別規格</option>";
            $corp_type_option["corp_type"][$i] = "無特別規格";
        }
    }

    return $corp_type_option;
}

function insertNewDoorWindowData($fId,$resultArray,$resultRatio,$resultNumerator,$resultDenominator,$main_building){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){
        $index = 0;
        for($j=0;$j<count($resultArray[$i]);$j++){
            if($resultArray[$i][$j] != ""){
                $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$resultArray[$i][$j]}' AND building_type='{$main_building[$i]["house_type"]}'";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()) {
                    $bdId = $row["bdId"];
                    $result[$i][$index] = $row["bdId"];;
                    $index++;
                }

                $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$resultRatio[$i][$j]}','{$resultNumerator[$i][$j]}','{$resultDenominator[$i][$j]}')";

                if ($conn->query($sql) === TRUE){
                    // echo "New record created successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
    $conn->close();
    return $result;
}

function getLandOwnerOption($str){
    $conn = connect_db();
    $sql = "SELECT * FROM landlord WHERE name LIKE '%{$str}%'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $land_owner[$i] = $row;
        $i++;
    }

    $conn->close();

    $land_owner_option = "";

    for($i=0;$i<count($land_owner);$i++){
        $land_owner_option = $land_owner_option
        ."<option value='".$land_owner[$i]["name"]."'>".$land_owner[$i]["name"]."</option>";
    }

    return $land_owner_option;
}

function getAutoCompleteOwnerData($section,$subsection,$land_number){
    $conn = connect_db();
    $index = 0;

    for($i=0;$i<count($land_number);$i++){
        $land_id = $section.$subsection.$land_number[$i];
        $sql = "SELECT * FROM own_land_list NATURAL JOIN landlord WHERE land_id='{$land_id}'";
        $res = $conn->query($sql);
        if($res->num_rows==0){
            return "";
        }
        // SELECT * FROM own_land_list NATURAL JOIN landlord WHERE land_id='草漯段0423-0008'

        while($row = $res->fetch_assoc()) {
            $land_owner["hold_id"][$index] = $row["hold_id"];
            $land_owner["name"][$index] = $row["name"];
            $land_owner["address"][$index] = $row["address"];
            $land_owner["numerator"][$index] = $row["numerator"];
            $land_owner["denominator"][$index] = $row["denominator"];
            $index++;
        }
    }
    $conn->close();

    return $land_owner;
}

function getAutoCalculateArea($corp_category,$corp_item,$corp_type,$corp_num){
    $conn = connect_db();

    if($corp_type == "無特別規格"){
        $sql = "SELECT unit_area FROM corp WHERE category='{$corp_category}' AND item='{$corp_item}'";
    }
    else{
        $sql = "SELECT unit_area FROM corp WHERE category='{$corp_category}' AND item='{$corp_item}' AND (corp_age='{$corp_type}' OR cm_length='{$corp_type}' OR m_length='{$corp_type}')";
    }

    $res = $conn->query($sql);
    if($res->num_rows==0){
        return "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $unit_area[$i] = $row;
        $i++;
    }

    $conn->close();

    if($res->num_rows==1){
        $corp_plant_area = number_format($corp_num*$unit_area[0]["unit_area"],2,".","");
    }
    return $corp_plant_area;
}

function insertIntoCorpRecordTable($script_number,$district,$land_use,$KEYIN_ID,$KEYIN_DATETIME,$SURVEY_DATE){
    // deleteOldCorpRecordData($script_number);
    $conn = connect_db();

    $sql = "INSERT INTO corp_record VALUES ('{$script_number}','{$district}','{$land_use}','{$KEYIN_ID}','{$KEYIN_DATETIME}','{$SURVEY_DATE}') ON DUPLICATE KEY UPDATE rId='{$script_number}',district='{$district}',land_use='{$land_use}',keyinId='{$KEYIN_ID}',keyin_datetime='{$KEYIN_DATETIME}',survey_date='{$SURVEY_DATE}'";
    if ($conn->query($sql) === TRUE){
        // echo "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function deleteOldCorpRecordData($script_number){
    $conn = connect_db();
    $sql = "DELETE FROM corp_record WHERE rId='{$script_number}'";
    $conn->query($sql);
    $conn->close();
}

function insertIntoLandBelongToCorpRecordTable($land_section,$subsection,$land_number,$script_number){
    deleteOldCorpLandBelongData($script_number);
    $conn = connect_db();

    for($i=0;$i<count($land_section);$i++){
        for($j=0;$j<count($land_number[$i]);$j++){
            $land_id = $land_section[$i].$subsection[$i].$land_number[$i][$j];
            $sql = "INSERT INTO land_belong_to_corp_record VALUES ('{$land_id}','{$script_number}')";
            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}

function deleteOldCorpLandBelongData($script_number){
    $conn = connect_db();
    $sql = "DELETE FROM land_belong_to_corp_record WHERE rId='{$script_number}'";
    $conn->query($sql);
    $conn->close();
}

function insertIntoCorpOwnerTable($pId,$owner,$address,$telephone,$cellphone,$script_number){
    deleteOldCorpOwnerData($script_number);
    $conn = connect_db();

    for($i=0;$i<count($pId);$i++){
        $sql = "INSERT INTO corp_owner VALUES ('{$pId[$i]}','{$owner[$i]}','{$address[$i]}','{$telephone[$i]}','{$cellphone[$i]}','{$script_number}') ON DUPLICATE KEY UPDATE pId='{$pId[$i]}', name='{$owner[$i]}', current_address='{$address[$i]}', telephone='{$telephone[$i]}', cellphone='{$cellphone[$i]}', checkId='{$script_number}'";
        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}

function deleteOldCorpOwnerData($script_number){
    $conn = connect_db();
    $sql = "DELETE FROM corp_owner_belong_to_corp_record WHERE rId='{$script_number}'";
    $conn->query($sql);
    $sql = "DELETE FROM corp_owner WHERE checkId='{$script_number}'";
    $conn->query($sql);
    $conn->close();
}

function insertIntoCorpOwnerBelongToCorpRecordTable($pId,$script_number,$hold_ratio,$hold_numerator,$hold_denominator,$shared,$owner_order){
    $conn = connect_db();

    for($i=0;$i<count($pId);$i++){
        $sql = "INSERT INTO corp_owner_belong_to_corp_record VALUES('$pId[$i]','{$script_number}','{$hold_ratio[$i]}','{$hold_numerator[$i]}','{$hold_denominator[$i]}','{$shared}','{$owner_order[$i]}')";
        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}

function insertIntoLandOwnerTable($hold_id,$land_pId,$land_owner,$land_telephone,$land_cellphone,$landAddressText){
    $conn = connect_db();

    for($i=0;$i<count($hold_id);$i++){
        $sql = "INSERT INTO land_owner VALUES('{$hold_id[$i]}','{$land_pId[$i]}','{$land_owner[$i]}','{$land_telephone[$i]}','{$land_cellphone[$i]}','{$landAddressText[$i]}') ON DUPLICATE KEY UPDATE hold_id='{$hold_id[$i]}', pId='{$land_pId[$i]}', name='{$land_owner[$i]}', telephone='{$land_telephone[$i]}', cellphone='{$land_cellphone[$i]}', current_address='{$landAddressText[$i]}'";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

function insertIntoLandOwnerBelongToCorpRecordTable($hold_id,$script_number,$land_owner_order){
    cleanOldCorpLandOwnerBelongData($script_number);
    $conn = connect_db();

    for($i=0;$i<count($hold_id);$i++){
        $sql = "INSERT INTO land_owner_belong_to_corp_record VALUES('{$hold_id[$i]}','{$script_number}','{$land_owner_order[$i]}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

function cleanOldCorpLandOwnerBelongData($script_number){
    $conn = connect_db();
    $sql = "DELETE FROM land_owner_belong_to_corp_record WHERE rId='{$script_number}'";
    $res = $conn->query($sql);
    $conn->close();
}

function insertIntoPlantingTable($land_section,$subsection,$land_number,$corp,$script_number){
    cleanOldPlantingData($script_number);
    $conn = connect_db();

    $land_id = $land_section[0].$subsection[0].$land_number[0][0];
    for($i=0;$i<count($corp);$i++){
        if($corp[$i]["type"]=="無特別規格"){
            $sql = "SELECT cId FROM corp WHERE category='{$corp[$i]["category"]}' AND item='{$corp[$i]["item"]}'";
        }
        else{
            $sql = "SELECT cId FROM corp WHERE category='{$corp[$i]["category"]}' AND item='{$corp[$i]["item"]}' AND (corp_age='{$corp[$i]["type"]}' OR cm_length='{$corp[$i]["type"]}' OR m_length='{$corp[$i]["type"]}')";
        }
        $res = $conn->query($sql);
        if($res->num_rows==0){
            return "";
        }
        $row = $res->fetch_assoc();
        $cId = $row["cId"];

        $sql = "INSERT INTO planting VALUES ('{$land_id}','{$cId}','{$corp[$i]["num"]}','{$corp[$i]["area"]}','{$corp[$i]["area"]}','{$corp[$i]["note"]}','{$script_number}','{$corp[$i]["keyin_order"]}','{$corp[$i]["equal"]}') ON DUPLICATE KEY UPDATE land_id='{$land_id}',cId='{$cId}',num='{$corp[$i]["num"]}',plant_area_text='{$corp[$i]["area"]}',plant_area='{$corp[$i]["area"]}',note='{$corp[$i]["note"]}',checkId='{$script_number}',keyin_order='{$corp[$i]["keyin_order"]}',equal='{$corp[$i]["equal"]}'";
        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

function cleanOldPlantingData($script_number){
    $conn = connect_db();
    $sql = "DELETE FROM planting WHERE checkId='{$script_number}'";
    $res = $conn->query($sql);
    $conn->close();
}

function getCorpOwnerData($script_number){
    $conn = connect_db();

    // $sql = "SELECT * FROM corp_owner_belong_to_corp_record NATURAL JOIN corp_record NATURAL JOIN corp_owner WHERE rid='{$script_number}'";
    $sql = "SELECT *,a.name AS owner_name FROM corp_owner_belong_to_corp_record NATURAL JOIN corp_record NATURAL JOIN corp_owner AS a LEFT JOIN landlord AS b ON a.name=b.name WHERE rid='$script_number' AND checkId='{$script_number}' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_owner[$i] = $row;
        $i++;
    }
    $conn->close();

    return $corp_owner;
}

function getCorpOwnerData2($script_number){
    $conn = connect_db();

    // $sql = "SELECT * FROM corp_owner_belong_to_corp_record NATURAL JOIN corp_record NATURAL JOIN corp_owner WHERE rid='{$script_number}'";
    $sql = "SELECT *,a.name AS owner_name FROM corp_owner_belong_to_corp_record NATURAL JOIN corp_record NATURAL JOIN corp_owner AS a LEFT JOIN landlord AS b ON a.name=b.name WHERE rid='$script_number' AND checkId='{$script_number}' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_owner["pId"][$i] = $row["pId"];
        $corp_owner["hold_numerator"][$i] = $row["hold_numerator"];
        $corp_owner["hold_denominator"][$i] = $row["hold_denominator"];
        $corp_owner["name"][$i] = $row["owner_name"];
        $corp_owner["current_address"][$i] = $row["current_address"];
        $corp_owner["telephone"][$i] = $row["telephone"];
        $corp_owner["cellphone"][$i] = $row["cellphone"];
        $corp_owner["hold_status"][$i] = $row["hold_status"];
        $i++;
    }
    $conn->close();

    return $corp_owner;
}

function getCorpLandOwnerData($script_number){
    $conn = connect_db();

    $sql = "SELECT * FROM land_owner_belong_to_corp_record NATURAL JOIN corp_record NATURAL JOIN land_owner WHERE rid='{$script_number}' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_land_owner[$i] = $row;
        $i++;
    }
    $conn->close();

    return $corp_land_owner;
}

function getCorpLandOwnerData3($script_number){
    $conn = connect_db();

    $sql = "SELECT * FROM land_owner_belong_to_corp_record NATURAL JOIN corp_record NATURAL JOIN land_owner WHERE rid='{$script_number}' AND keyin_order='1' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_land_owner["pId"][$i] = $row["pId"];
        $corp_land_owner["name"][$i] = $row["name"];
        $corp_land_owner["hold_id"][$i] = $row["hold_id"];
        $corp_land_owner["current_address"][$i] = $row["current_address"];
        $corp_land_owner["telephone"][$i] = $row["telephone"];
        $corp_land_owner["cellphone"][$i] = $row["cellphone"];
        $i++;
    }
    $conn->close();

    return $corp_land_owner;
}

function getCorpLandOwnerData2($first_id,$land_section,$subsection,$land_number){
    $conn = connect_db();
    $temp_array;
    $land_owner = [];
    $index = 0;
    $temp_array[0] = $first_id;
    $result = [];

    for($i=0;$i<count($land_section);$i++){
        for($j=0;$j<count($land_number[$i]);$j++){
            $land_id = $land_section[$i].$subsection[$i].$land_number[$i][$j];
            $sql = "SELECT * FROM own_land_list NATURAL JOIN landlord WHERE land_id='{$land_id}'";
            $res = $conn->query($sql);
            if($res->num_rows==0){
                return "";
            }
            // SELECT * FROM own_land_list NATURAL JOIN landlord WHERE land_id='草漯段0423-0008'

            while($row = $res->fetch_assoc()) {
                // if(!in_array($row["hold_id"],$temp_array)){
                if($row["hold_id"] != $first_id && !in_array($row["hold_id"], $result)){
                    $temp_array[$index] = $row["hold_id"];
                    $land_owner["hold_id"][$index] = $row["hold_id"];
                    $land_owner["name"][$index] = $row["name"];
                    $land_owner["address"][$index] = $row["address"];
                    $land_owner["numerator"][$index] = $row["numerator"];
                    $land_owner["denominator"][$index] = $row["denominator"];
                    $result[$index] = $row["hold_id"];
                    $index++;
                }
            }
        }
    }
    $conn->close();

    return $land_owner;
}

function getCorpLandData($script_number){
    $conn = connect_db();

    $sql = "SELECT * FROM land_belong_to_corp_record AS a NATURAL JOIN land JOIN corp_record AS b ON a.rId=b.rId AND a.rId='{$script_number}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp_land[$i] = $row;
        $i++;
    }
    $conn->close();

    return $corp_land;
}

function getCorpLandData2($script_number){
    $conn = connect_db();
    $section_array = [];
    $subsection_array = [];
    $land_number_array = [];
    $index = 0;

    $sql = "SELECT * FROM land_belong_to_corp_record AS a NATURAL JOIN land JOIN corp_record AS b ON a.rId=b.rId AND a.rId='{$script_number}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        // $corp_land["land_section"][$i] = $row["land_section"];
        // $corp_land["subsection"][$i] = $row["subsection"];
        // $corp_land["land_number"][$i] = $row["land_number"];
        $corp_land["district"][$i] = $row["district"];
        $corp_land["land_use"][$i] = $row["land_use"];
        $corp_land["survey_date"][$i] = $row["survey_date"];
        // $i++;

        if(!in_array($row["land_section"],$section_array)){
            $section_array[$index] = $row["land_section"];
            if($row["subsection"] == ""){
                $subsection_array[$index] = "";
            }
            else{
                $subsection_array[$index] = $row["subsection"];
            }
            $land_number_array[$index][0] = $row["land_number"];
            $index++;

            // $corp_land["land_section"][$i] = $row["land_section"];
        }
        else{
            $key = array_search($row["land_section"],$section_array);
            $land_number_array[$key][count($land_number_array)] = $row["land_number"];
        }
        $i++;
    }
    // echo count($section_array)."<br>";
    // print_r($section_array);
    // echo "<br>";
    // print_r($land_number_array);
    // echo "<br>";
    for($i=0;$i<count($section_array);$i++){
        $corp_land["land_section"][$i] = $section_array[$i];
        $corp_land["subsection"][$i] = $subsection_array[$i];
        $corp_land["land_number"][$i] = $land_number_array[$i];
    }
    // print_r($corp_land);
    $conn->close();

    return $corp_land;
}

function getCorpData($script_number){
    $conn = connect_db();

    $sql = "SELECT * from corp_record NATURAL JOIN land_belong_to_corp_record NATURAL JOIN planting NATURAL JOIN corp WHERE rId='{$script_number}' AND checkId='{$script_number}' AND category!='畜產' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp[$i] = $row;
        $i++;
    }
    $conn->close();

    return $corp;
}

function getLivestockData($script_number){
    $conn = connect_db();

    $sql = "SELECT * from corp_record NATURAL JOIN land_belong_to_corp_record NATURAL JOIN planting NATURAL JOIN corp WHERE rId='{$script_number}' AND checkId='{$script_number}' AND category='畜產' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp[$i] = $row;
        $i++;
    }
    $conn->close();

    return $corp;
}

function getCorpData2($script_number){
    $conn = connect_db();

    $sql = "SELECT * from corp_record NATURAL JOIN land_belong_to_corp_record NATURAL JOIN planting NATURAL JOIN corp WHERE rId='{$script_number}' AND checkId='{$script_number}' ORDER BY keyin_order";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $corp["category"][$i] = $row["category"];
        $corp["item"][$i] = $row["item"];
        $corp["num"][$i] = $row["num"];
        $corp["plant_area_text"][$i] = $row["plant_area_text"];
        $corp["equal"][$i] = $row["equal"];
        $corp["note"][$i] = $row["note"];
        $corp["unit_price"][$i] = $row["unit_price"];

        if($row["corp_age"]!=NULL){
            $corp["corp_type"][$i] = $row["corp_age"];
        }
        else if($row["cm_length"]!=NULL){
            $corp["corp_type"][$i] = $row["cm_length"];
        }
        else if($row["m_length"]!=NULL){
            $corp["corp_type"][$i] = $row["m_length"];
        }
        else{
            $corp["corp_type"][$i] = "無特別規格";
        }
        $i++;
    }
    $conn->close();

    return $corp;
}

function checkScriptNo($script_number,$table){
    $conn = connect_db();

    $sql = "SELECT * FROM {$table} WHERE rId='{$script_number}'";
    $res = $conn->query($sql);
    $conn->close();

    if($res->num_rows == 0){
        return true;
    }
    else{
        return false;
    }
}

function checkAddress($address){
    $conn = connect_db();

    $sql = "SELECT * FROM record WHERE address='{$address}'";
    $res = $conn->query($sql);
    $conn->close();

    if($res->num_rows == 0){
        return true;
    }
    else{
        return false;
    }
}

function getSurveyDate($table,$script_number){
    $conn = connect_db();
    $sql = "SELECT * FROM {$table} WHERE rId='{$script_number}'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $conn->close();

    return $row["survey_date"];
}

function getExitNum($script_number){
    $conn = connect_db();
    $sql = "SELECT * FROM building WHERE address='{$script_number}'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $conn->close();

    return $row["exit_number"];
}

function deleteResidentData($house_address){
    $conn = connect_db();
    $sql = "DELETE FROM resident WHERE address='{$house_address}'";
    $conn->query($sql);
    $conn->close();
}

function deleteOwnBuildingData($house_address){
    $conn = connect_db();
    $sql = "DELETE FROM own_building WHERE address='{$house_address}'";
    $conn->query($sql);
    $conn->close();
}

function deleteOwnLandData($house_address){
    $conn = connect_db();
    $sql = "DELETE FROM own_land WHERE address='{$house_address}'";
    $conn->query($sql);
    $conn->close();
}

function deleteOwnerData($house_address){
    $conn = connect_db();
    $sql = "DELETE FROM owner WHERE address='{$house_address}'";
    $conn->query($sql);
    $conn->close();
}

function deleteHasBuildingDecorationData($script_number,$page){
    $max = $page*4;
    $min = ($page-1)*4+1;

    $conn = connect_db();
    $sql = "SELECT * FROM floor_info WHERE fId LIKE '%{$script_number}%' AND f_order>='{$min}' AND f_order<='{$max}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $fId[$i] = $row["fId"];
        $i++;
    }

    for($i=0;$i<count($fId);$i++){
        $sql = "DELETE FROM has_building_decoration WHERE fId='{$fId[$i]}'";
        $conn->query($sql);
    }
    $conn->close();
}

function deleteFloorInfoData($house_address,$page){
    $max = $page*4;
    $min = ($page-1)*4+1;

    $conn = connect_db();
    $sql = "DELETE FROM floor_info WHERE f_order>='{$min}' AND f_order<='{$max}' AND address='{$house_address}'";
    $res = $conn->query($sql);
    $conn->close();
}

function deleteBuildingLocateData($house_address){
    $conn = connect_db();
    $sql = "DELETE FROM building_locate WHERE address='{$house_address}'";
    $res = $conn->query($sql);
    $conn->close();
}

function deleteFileData($house_address){
    $conn = connect_db();
    $sql = "DELETE FROM file_table WHERE rId='{$house_address}'";
    $res = $conn->query($sql);
    $conn->close();
}

function deleteRecordData($house_address){
    $conn = connect_db();
    $sql = "DELETE FROM record WHERE address='{$house_address}'";
    $res = $conn->query($sql);
    $conn->close();
}

function deleteBuildingData($house_address){
    $conn = connect_db();
    $sql = "DELETE FROM building WHERE address='{$house_address}'";
    // $res = $conn->query($sql);
    if ($conn->query($sql) === TRUE){
        // echo "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
        // $sql = "SELECT * FROM building WHERE address='{$house_address}'";
        // $res = $conn->query($sql);
        // echo "<br>筆數 : ".$res->num_rows."<br>";
    }
    $conn->close();
}

function checkNextPage($script_number,$page){
    $max = ($page+1)*4;
    $min = ($page)*4+1;

    $conn = connect_db();
    $sql = "SELECT * FROM floor_info WHERE fId LIKE '%{$script_number}%' AND f_order>='{$min}' AND f_order<='{$max}'";
    $res = $conn->query($sql);
    if($res->num_rows>0){
        return true;
    }
    else{
        return false;
    }
    $conn->close();
}

function deletePageData($script_number,$page){
    $min = ($page)*4+1;
    $conn = connect_db();
    $sql = "SELECT * FROM floor_info WHERE fId LIKE '%{$script_number}%' AND f_order>='{$min}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $fId[$i] = $row["fId"];
        $i++;
    }

    for($i=0;$i<count($fId);$i++){
        $sql = "DELETE FROM has_building_decoration WHERE fId='{$fId[$i]}'";
        $conn->query($sql);

        $sql = "DELETE FROM floor_info WHERE fId='{$fId[$i]}'";
        $conn->query($sql);
    }
    $conn->close();
    return "";
}

function getSubBuildingUpdateData($house_address){
    echo
    '<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>'.
    '<script type="text/javascript" src="js/index.js"></script>'.
    '<script>
        $(document).ready(function(){
            getSubBuildingUpdateData("'.$house_address.'");
        });
    </script>';
}

function getOldSubbuildingData($address){
    $conn = connect_db();

    $sql = "SELECT b.sId,application,b.item_name,item_type,area_calculate_text,b.unit,a.auto_remove FROM has_subbuilding AS a JOIN sub_building AS b ON a.sId=b.sId WHERE address='{$address}' ORDER BY keyin_order";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        $result["application"][0] = "";
        $result["item_name"][0] = "";
        $result["item_type"][0] = "";
        $result["area_calculate_text"][0] = "";
        $result["unit"][0] = "";
        $result["auto_remove"][0] = "";
        $result["sId"][0] = "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result["application"][$i] = $row["application"];
        $result["item_name"][$i] = $row["item_name"];
        $result["item_type"][$i] = $row["item_type"];
        $result["area_calculate_text"][$i] = $row["area_calculate_text"];
        $result["unit"][$i] = $row["unit"];
        $result["auto_remove"][$i] = $row["auto_remove"];
        $result["sId"][$i] = $row["sId"];
        $i++;
    }
    $conn->close();

    return $result;
}

function checkSubbuilding($script_number){
    $conn = connect_db();

    $sql = "SELECT * FROM has_subbuilding WHERE address='{$script_number}'";
    $res = $conn->query($sql);
    $conn->close();

    if($res->num_rows>0){
        return true;
    }
    else{
        return false;
    }
}

function deleteSubbuildingData($script_number){
    $conn = connect_db();
    $sql = "DELETE FROM has_subbuilding WHERE address='{$script_number}'";
    $res = $conn->query($sql);
    $conn->close();
    return "";
}

function getFenceOption($type){
    $conn = connect_db();

    $option_type = $type;
    if($type == "單面粉刷" || $type == "雙面粉刷"){
        $type = "粉刷";
    }
    $sql = "SELECT * from sub_building WHERE application='{$type}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $fence_option[$i] = $row["item_name"];
        $i++;
    }

    $fence_option_text = "<option value=''>請選擇".$option_type."</option>";
    for($i=0;$i<count($fence_option);$i++){
        $fence_option_text = $fence_option_text."<option value='".$fence_option[$i]."'>".$fence_option[$i]."</option>";
    }
    $conn->close();

    return $fence_option_text;
}

function getFenceItemName($data){
    $fence = $data["item_name"];
    $paint = "";
    $pillar = "";
    $paints = [];
    $conn = connect_db();
    $item_name = "圍牆：(".$data["item_name"].")";

    $sql = "SELECT * from fence WHERE address='{$data["address"]}' AND sId='{$data["sId"]}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return $item_name;
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $ssId[$i] = $row["ssId"];
        $i++;
    }

    for($i=0;$i<count($ssId);$i++){
        $sql = "SELECT * FROM sub_building WHERE sId='{$ssId[$i]}'";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();

        if($row["application"] == "粉刷"){
            $length = count($paints);
            $paints[$length] = $row["item_name"];
            $length++;
        }
        else if($row["application"] == "加強柱"){
            $pillar = $row["item_name"];
        }
    }
    if(count($paints) > 1){
        if($paints[0] == $paints[1]){
            $paint = $paints[0]."雙面";
        }
        else{
            $paint = $paints[0]."+".$paints[1];
        }
    }
    else{
        $paint = $paints[0];
    }
    $item_name = "圍牆：(".$fence.")+(".$paint.")+(".$pillar.")";
    $conn->close();
    return $item_name;
}

function getFencePrice($data){
    $conn = connect_db();
    $unitprice = $data["unitprice"];

    $sql = "SELECT * from fence WHERE address='{$data["address"]}' AND sId='{$data["sId"]}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return $unitprice;
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $ssId[$i] = $row["ssId"];
        $i++;
    }

    for($i=0;$i<count($ssId);$i++){
        $sql = "SELECT * FROM sub_building WHERE sId='{$ssId[$i]}'";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();
        $unitprice += $row["unitprice"];
    }
    $conn->close();
    return $unitprice;
}

function getFencePriceCalculateText($data){
    $conn = connect_db();
    $paints = [];
    $paints_price = [];
    $fence_price = "(".$data["unitprice"].")";
    $total = $data["unitprice"];

    $sql = "SELECT * from fence WHERE address='{$data["address"]}' AND sId='{$data["sId"]}'";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        return $item_name;
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $ssId[$i] = $row["ssId"];
        $i++;
    }

    for($i=0;$i<count($ssId);$i++){
        $sql = "SELECT * FROM sub_building WHERE sId='{$ssId[$i]}'";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();

        if($row["application"] == "粉刷"){
            $length = count($paints);
            $paints[$length] = $row["item_name"];
            $paints_price[$length] = $row["unitprice"];
            $length++;
        }
        else if($row["application"] == "加強柱"){
            $pillar_price = "(".$row["unitprice"].")";
        }
        $total += $row["unitprice"];
    }
    if(count($paints) > 1){
        if($paints[0] == $paints[1]){
            $paint_price = "(".$paints_price[0]."*2)";
        }
        else{
            $paint_price = "(".$paints_price[0]."+".$paints_price[1].")";
        }
    }
    else{
        $paint_price = "(".$paints_price[0].")";
    }
    $conn->close();
    return $fence_price."+".$paint_price."+".$pillar_price."=".number_format($total, 0, ".", ",")."元\n   ";
}

function getFenceData($address,$sId){
    $conn = connect_db();

    $sql = "SELECT * FROM fence WHERE address='{$address}' AND sId='{$sId}' ORDER BY keyin_order";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        $result["fence_application"][0] = "";
        $result["fence_item"][0] = "";
    }

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $sql = "SELECT * FROM sub_building WHERE sId='{$row["ssId"]}'";
        $res2 = $conn->query($sql);
        $j = 0;
        while($row2 = $res2->fetch_assoc()){
            $result["fence_application"][$i][$j] = $row2["application"];
            $result["fence_item"][$i][$j] = $row2["item_name"];
            $result["side"][$i][$j] = $row["side"];
            $j++;
        }
        $i++;
    }
    $conn->close();

    return $result;
}

function getAllCorpRecord(){
    $conn = connect_db();

    $sql = "SELECT * FROM corp_record ORDER BY rId";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }
    $conn->close();

    return $result;
}

function getCorpDistrict($script_number){
    $conn = connect_db();

    $sql = "SELECT * FROM corp_record WHERE rId='{$script_number}'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $district = $row["district"];
    $conn->close();

    return $district;
}

function getAllBuildingRecord($legal){
    $conn = connect_db();

    $sql = "SELECT * FROM record WHERE rId LIKE '%{$legal}%' ORDER BY rId";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }
    $conn->close();

    return $result;
}

function preLoadCorpItemData(){
    $conn = connect_db();
    $result = [];
    $sql = "SELECT DISTINCT category FROM corp";
    $res = $conn->query($sql);
    $category = $res -> fetch_all(MYSQLI_ASSOC);

    for($i=0;$i<count($category);$i++){
        $sql = "SELECT DISTINCT item FROM corp WHERE category='{$category[$i]['category']}'";
        $res = $conn->query($sql);
        $item = $res -> fetch_all(MYSQLI_ASSOC);
        // 將Query產生的二維陣列降至一維
        $item = array_map('current', $item);
        $result[$i] = $category[$i];
        $result[$i]['item'] = $item;
    }
    $conn->close();

    return $result;
}

function preLoadCorpTypeData(){
    $conn = connect_db();
    $sql = "SELECT DISTINCT item FROM corp";
    $res = $conn->query($sql);
    $item = $res -> fetch_all(MYSQLI_ASSOC);
    $result = [];

    for($i=0;$i<count($item);$i++){
        $sql = "SELECT corp_age, cm_length, m_length, unit FROM corp WHERE item='{$item[$i]['item']}'";
        $res = $conn->query($sql);
        $corp_type = $res -> fetch_all(MYSQLI_ASSOC);

        $unit = [];
        for($j=0;$j<count($corp_type);$j++){
            $unit[$j] = $corp_type[$j]['unit'];
            if($corp_type[$j]["corp_age"]!=NULL){
                $corp_type[$j] = $corp_type[$j]['corp_age'];
            }
            else if($corp_type[$j]["cm_length"]!=NULL){
                $corp_type[$j] = $corp_type[$j]['cm_length'];
            }
            else if($corp_type[$j]["m_length"]!=NULL){
                $corp_type[$j] = $corp_type[$j]['m_length'];
            }
            else{
                $corp_type[$j] = "無特別規格";
            }
        }
        $result[$i] = $item[$i];
        $result[$i]['corp_type'] = $corp_type;
        $result[$i]['unit'] = $unit;
    }
    $conn->close();

    return $result;
}
?>
