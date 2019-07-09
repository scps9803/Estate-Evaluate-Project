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

    // $smarty->assign("electric_type_option",$electric_type_option);
    // $smarty->display("index.html");
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

    // $smarty->assign("electric_type_option",$electric_type_option);
    // $smarty->display("index.html");
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

function insertLandData($land_section,$land_number,$house_address,$land_use){
    $conn = connect_db();

    for($i=0;$i<count($land_section);$i++){
        $land_id = $land_section[$i].$land_number[$i];
        $sql = "INSERT INTO building_locate VALUES('{$land_id}','{$house_address}','{$land_use}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
            // return true;
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
            // return false;
        }
    }
    $conn->close();
}

function insertRecordData($script_number,$house_address,$KEYIN_ID,$KEYIN_DATETIME){
    $conn = connect_db();
    $sql = "INSERT INTO record VALUES('{$script_number}','{$house_address}','{$KEYIN_ID}','{$KEYIN_DATETIME}')";

    if ($conn->query($sql) === TRUE){
        // echo "New record created successfully";
        // return true;
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
        // return false;
    }
    $conn->close();
}

function insertOwnerData($owner,$hold_ratio,$pId,$house_address,$address,$telephone,$cellphone){
    $conn = connect_db();

    for($i=0;$i<count($owner);$i++){
        // $land_id = $land_section[$i].$land_number[$i];
        $sql = "INSERT INTO owner VALUES('{$pId[$i]}','{$owner[$i]}','{$pId[$i]}','{$house_address}','{$address[$i]}','{$telephone[$i]}','{$cellphone[$i]}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
            // return true;
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
            // return false;
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
            // return true;
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
            // return false;
        }
        $conn->close();
    }

function insertResidentData($captain,$total_people,$house_address){
    $conn = connect_db();

    for($i=0;$i<count($captain);$i++){
        // $land_id = $land_section[$i].$land_number[$i];
        $sql = "INSERT INTO resident VALUES('{$captain[$i]["id"]}','{$captain[$i]["name"]}',
            '{$captain[$i]["household_number"]}','{$captain[$i]["set_household_date"]}',
            '{$captain[$i]["family_num"]}','{$house_address}')";

        if ($conn->query($sql) === TRUE){
            // echo "New record created successfully";
            // return true;
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
            // return false;
        }
    }
    $conn->close();
}
?>
