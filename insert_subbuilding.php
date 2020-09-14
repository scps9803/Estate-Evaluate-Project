<?php
    require("library.php");
    $application = $_POST['application'];
    $item_name = $_POST['item_name'];
    $unitprice = $_POST['unitprice'];
    $unit = $_POST['unit'];
    $auto_remove = $_POST['auto_remove'];
    $note = $_POST['note'];
    $conn = connect_db();

    if($unit == "m^2" || $unit == "M^2"){
        $unit = "㎡";
    }
    else if($unit == "m^3" || $unit == "M^3"){
        $unit = "m³";
    }

    $sql = "SELECT * FROM sub_building WHERE application='{$application}' AND item_name='{$item_name}'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    if($res->num_rows > 0){
        echo "此品項已存在!";
        return;
    }

    $sql = "SELECT sId FROM sub_building ORDER BY sId DESC LIMIT 1";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $sId = sprintf("%04s", $row['sId']+1);
    $sql = "INSERT INTO sub_building VALUES ('{$sId}', '{$application}', '{$item_name}', '{$unitprice}', '{$unit}', '{$auto_remove}', '{$note}')";
    $status = $conn->query($sql);

    if($status){
        echo "OK";
    }
    else{
        echo $conn->error;
    }

    $conn->close();
?>