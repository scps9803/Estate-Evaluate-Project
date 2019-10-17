<?php
session_start();
include "library.php";
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$searchText = $_GET["searchText"];
$conn = connect_db();
$sql = "SELECT * FROM record WHERE rId LIKE '%{$searchText}%' ORDER BY rId";
$res = $conn->query($sql);
if($res->num_rows==0){
    $sql = "SELECT * FROM corp_record WHERE rId LIKE '%{$searchText}%' ORDER BY rId";
    $res = $conn->query($sql);
    if($res->num_rows==0){
        $isFind = "NA";
    }
    else{
        $index=0;
        $rId = [];
        $corp_record = [];
        while($row=$res->fetch_assoc()){
            $sql = "SELECT * FROM corp_record NATURAL JOIN land_belong_to_corp_record WHERE rId='{$row["rId"]}' ORDER BY keyin_datetime";
            $res2 = $conn->query($sql);
            while($row2=$res2->fetch_assoc()){
                if(!in_array($row2["rId"],$rId)){
                    $rId[$index] = $row2["rId"];
                    $corp_record[$index] = $row2;
                    $index++;
                }
                else{
                    for($i=0;$i<count($rId);$i++){
                        if($rId[$i] == $row2["rId"]){
                            $corp_record[$i]["land_id"] = $corp_record[$i]["land_id"] . "<br>" . $row2["land_id"];
                        }
                    }
                }
            }
        }
        $smarty->assign("corp_record",$corp_record);
        $isFind = "corp";
    }
}
else{
    $index=0;
    $rId = [];
    $record = [];

    while($row=$res->fetch_assoc()){
        $sql = "SELECT * FROM record NATURAL JOIN building NATURAL JOIN building_locate WHERE rId='{$row["rId"]}' ORDER BY keyin_datetime";
        $res2 = $conn->query($sql);
        // 撈出10筆資料後再進行地段查詢
        while($row2=$res2->fetch_assoc()){
            if(!in_array($row2["rId"],$rId)){
                $rId[$index] = $row2["rId"];
                $record[$index] = $row2;
                $index++;
            }
            else{
                for($i=0;$i<count($rId);$i++){
                    if($rId[$i] == $row2["rId"]){
                        $record[$i]["land_id"] = $record[$i]["land_id"] . "<br>" . $row2["land_id"];
                    }
                }
            }
        }
    }
    $smarty->assign("record",$record);
    $isFind = "build";
}

$conn->close();

$smarty->assign("isFind",$isFind);
$smarty->display("search.html");
?>