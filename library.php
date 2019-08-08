<?php
function connect_db()
{
    $servername = "127.0.0.1";
    $username = "root";
    $password = "860430";
    $dbname = "estate_evaluate_project";
    // $servername = "localhost";
    // $username = "dayicom_jimmy7920";
    // $password = "ji7151618";
    // $dbname = "dayicom_estate_db";
    // $dbname = "dayicom_test_db";

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

function get_corp_item_option(){
    $corp_category = load_corp_item_Data();
    $corp_category_option = "";

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
    }
    return $corp_unit_option;
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

function insertRecordData($script_number,$house_address,$KEYIN_ID,$KEYIN_DATETIME){
    $conn = connect_db();
    $sql = "INSERT INTO record VALUES('{$script_number}','{$house_address}','{$KEYIN_ID}','{$KEYIN_DATETIME}')";

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
        $sql = "INSERT INTO owner VALUES('{$pId[$i]}','{$owner[$i]}','{$pId[$i]}','{$house_address}','{$address[$i]}','{$telephone[$i]}','{$cellphone[$i]}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

function insertBuildingData($house_address,$legal_status,$build_number,$tax_number,
    $legal_certificate,$build_certificate,$captain_count,$exit_num,
    $total_floor,$remove_condition){

        $conn = connect_db();
        $sql = "INSERT INTO building VALUES('{$house_address}','{$legal_status}','{$build_number}',
            '{$tax_number}','{$legal_certificate}','{$build_certificate}','{$captain_count}',
            '{$exit_num}','{$total_floor}','{$remove_condition}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

function insertOwnBuildingData($pId,$house_address,$hold_ratio){
    $conn = connect_db();

    for($i=0;$i<count($pId);$i++){
        $sql = "INSERT INTO own_building VALUES('{$pId[$i]}','{$house_address}','{$hold_ratio[$i]}')";

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
            $sql = "SELECT mId FROM migration_fee WHERE family_num='{$total_family_num}' AND item_type='{$remove_condition}'";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc()) {
                $mId = $row["mId"];
            }

            $sql = "INSERT INTO resident VALUES('{$captain[$shareFeeIndex[$i]]["id"]}',
                '{$captain[$shareFeeIndex[$i]]["name"]}','{$captain[$shareFeeIndex[$i]]["household_number"]}',
                '{$captain[$shareFeeIndex[$i]]["set_household_date"]}','{$captain[$shareFeeIndex[$i]]["family_num"]}',
                '{$house_address}','{$mId}','{$captain[$shareFeeIndex[$i]]["move_status"]}')";
            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
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
        $sql = "INSERT INTO floor_info VALUES('{$fId}','{$main_building[$i]["house_type"]}',
            '{$discard_status[$i]}','{$main_building[$i]["compensate_form"]}',
            '{$main_building[$i]["material"]}','{$main_building[$i]["floor_type"]}',
            '{$main_building[$i]["nth_floor"]}','{$main_building[$i]["floor_area_calculate_text"]}',
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

        $sql = "INSERT INTO has_building_decoration VALUES('{$fId}','{$bdId[$i]}',NULL,1)";

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

            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$minus_wall_count[$i][$j]}')";

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

            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$add_wall_count[$i][$j]}')";

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
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}')";

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
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}')";

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
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}')";

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
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}')";

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
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}')";

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
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,'{$ratio}')";

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
                return;
            }

            while($row = $res->fetch_assoc()) {
                $bdId[$i][$j] = $row["bdId"];
            }
            // 將area欄位作為數量使用
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}','{$toilet_number[$i][$j]}','{$toilet_ratio[$i][$j]}')";

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
            return;
        }

        while($row = $res->fetch_assoc()) {
            $bdId[$i] = $row["bdId"];
        }

        $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i]}',NULL,1)";

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
            return;
        }

        while($row = $res->fetch_assoc()) {
            $bdId[$i] = $row["bdId"];
        }

        $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i]}',NULL,1)";

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
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,1)";

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
            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId[$i][$j]}',NULL,1)";

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

    $sql = "SELECT * FROM owner WHERE address='{$house_address}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
}

function getLandOwnerData($house_address){
    $conn = connect_db();

    $sql = "SELECT * FROM land_owner NATURAL JOIN own_land WHERE address='{$house_address}'";
    $res = $conn->query($sql);

    $i = 0;
    while($row = $res->fetch_assoc()) {
        $result[$i] = $row;
        $i++;
    }

    $conn->close();
    return $result;
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

function getResidentData($house_address){
    $conn = connect_db();

    // $sql = "SELECT * FROM resident NATURAL JOIN migration_fee WHERE address='{$house_address}'";
    $sql = "SELECT * FROM resident AS r LEFT JOIN migration_fee AS m ON r.mId=m.mId WHERE address='{$house_address}'";
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

function getMainBuildingData($house_address){
    $conn = connect_db();

    $sql = "SELECT * FROM (floor_info NATURAL JOIN has_building_decoration) NATURAL JOIN building_decoration WHERE address='{$house_address}' AND category='房屋構造體(別)'";
    $res = $conn->query($sql);

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

    $sql = "SELECT DISTINCT application FROM sub_building";
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

    $category_option = "";

    for($i=0;$i<count($category);$i++){
        $category_option = $category_option
        ."<option value='".$category[$i]["application"]."'>".$category[$i]["application"]."</option>";
    }

    return $category_option;
}

function getSubbuildingOption($application){
    $conn = connect_db();

    $sql = "SELECT item_name FROM sub_building WHERE application='{$application}'";
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

    $sub_building_option = "";

    for($i=0;$i<count($sub_building);$i++){
        $sub_building_option = $sub_building_option
        ."<option value='".$sub_building[$i]["item_name"]."'>".$sub_building[$i]["item_name"]."</option>";
    }

    return $sub_building_option;
}

function insertSubbuildingData($house_address,$sub_building){
    $conn = connect_db();

    for($i=0;$i<count($sub_building);$i++){
        $sql = "SELECT sId FROM sub_building WHERE application='{$sub_building[$i]["category"]}' AND item_name='{$sub_building[$i]["item"]}'";
        $res = $conn->query($sql);

        while($row = $res->fetch_assoc()) {
            $sId[$i] = $row["sId"];
        }

        $sql = "INSERT INTO has_subbuilding VALUES('{$house_address}','{$sId[$i]}',
            '{$sub_building[$i]["item_type"]}','{$sub_building[$i]["area_calculate_text"]}'
            ,'{$sub_building[$i]["area"]}','{$sub_building[$i]["auto_remove"]}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

function getSubbuildingData($house_address,$item_type){
    $conn = connect_db();

    // $sql = "SELECT * FROM has_subbuilding as a LEFT JOIN sub_building as b on a.sId=b.sId WHERE address='{$house_address}' AND item_type='{$item_type}'";
    $sql = "SELECT address,a.sId,application,item_name,unitprice,unit,item_type,area_calculate_text,area,a.auto_remove
        FROM has_subbuilding as a LEFT JOIN sub_building as b on a.sId=b.sId WHERE address='{$house_address}' AND item_type='{$item_type}'";
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

    $sql = "SELECT * FROM has_building_decoration AS a LEFT JOIN floor_info AS b ON a.fId=b.fId LEFT JOIN building_decoration AS c ON a.bdId=c.bdId WHERE address='{$house_address}' AND category='{$category}' ORDER BY nth_floor";
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

function getBuildingDecorationData($house_address,$category,$nth_floor){
    $conn = connect_db();

    $sql = "SELECT * FROM has_building_decoration AS a LEFT JOIN floor_info AS b ON a.fId=b.fId LEFT JOIN building_decoration AS c ON a.bdId=c.bdId WHERE address='{$house_address}' AND category='{$category}' AND nth_floor='{$nth_floor}' ORDER BY nth_floor";
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

function insertFileData($script_number,$savePath,$fileNo,$filename,$file_type){
    $conn = connect_db();
    $size = filesize($savePath.$filename.$file_type);
    $all_filename = $filename.$file_type;

    if($file_type == ".xls"){
        $content_type = "application/vnd.ms-excel";
    }
    else if($file_type == ".txt"){
        $content_type = "text/plain";
    }

    $sql = "INSERT INTO file_table VALUES('{$fileNo}','{$savePath}','{$all_filename}','{$size}','{$content_type}','{$script_number}')";

    if ($conn->query($sql) === TRUE){
        // echo "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function getFileInfo($recordNo){
    $conn = connect_db();

    $sql = "SELECT * FROM file_table NATURAL JOIN record WHERE rId='{$recordNo}'";
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

function insertLandOwnerData($land_owner,$hold_id,$land_pId,$landAddressText,$land_telephone,$land_cellphone,$house_address){
    $conn = connect_db();

    for($i=0;$i<count($land_owner);$i++){
        $sql = "INSERT INTO land_owner VALUES('{$hold_id[$i]}','{$land_pId[$i]}','{$land_owner[$i]}','{$land_telephone[$i]}','{$land_cellphone[$i]}','{$landAddressText[$i]}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO own_land VALUES('{$hold_id[$i]}','{$house_address}')";

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

function insertNewDoorWindowData($fId,$resultArray,$resultRatio,$main_building){
    $conn = connect_db();

    for($i=0;$i<count($fId);$i++){
        for($j=0;$j<count($resultArray);$j++){
            $sql = "SELECT bdId FROM building_decoration WHERE category='門窗裝置' AND item_name='{$resultArray[$j]}' AND building_type='{$main_building[$i]["house_type"]}'";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc()) {
                $bdId = $row["bdId"];
            }

            $sql = "INSERT INTO has_building_decoration VALUES('{$fId[$i]}','{$bdId}',NULL,'{$resultRatio[$j]}')";

            if ($conn->query($sql) === TRUE){
                // echo "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
}

// function getStructurePoints($house_address){
//     $conn = connect_db();
//
//     $sql = "SELECT * FROM floor_info NATURAL JOIN building WHERE address='{$house_address}'";
//     $res = $conn->query($sql);
//
//     $i = 0;
//     while($row = $res->fetch_assoc()) {
//         $result[$i] = $row;
//         $i++;
//     }
//
//     $conn->close();
//     return $result;
// }
?>
