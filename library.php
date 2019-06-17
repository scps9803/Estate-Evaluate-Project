<?php
function connect_db()
{
    $servername = "127.0.0.1";
    $username = "root";
    $password = "860430";
    $dbname = "estate_evaluate_project";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

function load_data(){
    connect_db();
    $sql = "SELECT * FROM building_decoration WHERE category='房屋構造體(別)'";
    // $res = $db->prepare($sql);
    // $res->execute();
    $res = $conn->query($sql);
    $house_construct = $res->fetch_assoc();


    $smarty->assign("house_construct",$house_construct);
    $smarty->display("item_detail.php");
}

function test(){
    return "test";
}
?>
