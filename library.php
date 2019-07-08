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
?>
