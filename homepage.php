<?php
session_start();
include "library.php";
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

//顯示建物歷史紀錄
$conn = connect_db();
// $sql = "SELECT * FROM record NATURAL JOIN building NATURAL JOIN building_locate ORDER BY keyin_datetime";
// $res = $conn->query($sql);

if($_SERVER['QUERY_STRING'] == ""){
    $current_page = 1;
    $page = 0;
}
else{
    $current_page = $_GET["page"];
    $page = ($_GET["page"]-1)*10;
}
$sql = "SELECT * FROM record LIMIT {$page},10";
$res = $conn->query($sql);

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
$sql = "SELECT count(*) AS record_count FROM record";
$res = $conn->query($sql);
$record_count = $res->fetch_assoc();

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
// $index=0;
// $rId = [];
// $record = [];
// while($row=$res->fetch_assoc()){
//     if(!in_array($row["rId"],$rId)){
//         $rId[$index] = $row["rId"];
//         $record[$index] = $row;
//         $index++;
//     }
//     else{
//         for($i=0;$i<count($rId);$i++){
//             if($rId[$i] == $row["rId"]){
//                 $record[$i]["land_id"] = $record[$i]["land_id"] . "<br>" . $row["land_id"];
//             }
//         }
//     }
// }

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
$smarty->assign("page_count",58);
$smarty->assign("menu_count",ceil(58/20));
$smarty->assign("current_page",ceil($current_page/20));
// $smarty->assign("page_count",ceil($record_count["record_count"]/10));
$smarty->assign("corp_record",$corp_record);
$smarty->display("homepage.html");
?>
