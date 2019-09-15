<?php
session_start();
include "library.php";
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

//顯示建物歷史紀錄
$conn = connect_db();
$sql = "SELECT * FROM record NATURAL JOIN building NATURAL JOIN building_locate ORDER BY keyin_datetime";
$res = $conn->query($sql);

// $i=0;
// $record = NULL;
// while($row=$res->fetch_assoc()){
//     if($record[$i-1]["rId"]==$row["rId"]){
//         $record[$i-1]["land_id"] = $record[$i-1]["land_id"] . "<br>" . $row["land_id"];
//         continue;
//     }
//     $record[$i] = $row;
//     $i++;
// }
$index=0;
$rId = [];
$record = [];
while($row=$res->fetch_assoc()){
    if(!in_array($row["rId"],$rId)){
        $rId[$index] = $row["rId"];
        $record[$index] = $row;
        $index++;
    }
    else{
        for($i=0;$i<count($rId);$i++){
            if($rId[$i] == $row["rId"]){
                $record[$i]["land_id"] = $record[$i]["land_id"] . "<br>" . $row["land_id"];
            }
        }
    }
}

// 顯示農作物歷史紀錄
$sql = "SELECT * FROM corp_record NATURAL JOIN land_belong_to_corp_record ORDER BY keyin_datetime";
$res = $conn->query($sql);

$index=0;
$rId = [];
$corp_record = [];
while($row=$res->fetch_assoc()){
    if(!in_array($row["rId"],$rId)){
        $rId[$index] = $row["rId"];
        $corp_record[$index] = $row;
        $index++;
    }
    else{
        for($i=0;$i<count($rId);$i++){
            if($rId[$i] == $row["rId"]){
                $corp_record[$i]["land_id"] = $corp_record[$i]["land_id"] . "<br>" . $row["land_id"];
            }
        }
    }
}
$conn->close();

$smarty->assign("record",$record);
$smarty->assign("corp_record",$corp_record);
$smarty->display("homepage.html");
?>
