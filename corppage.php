<?php
session_start();
include "library.php";
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$conn = connect_db();

// 顯示農作物歷史紀錄
if($_SERVER['QUERY_STRING'] == ""){
    $current_page = 1;
    $page = 0;
}
else{
    $current_page = $_GET["page"];
    $page = ($_GET["page"]-1)*10;
}
$sql = "SELECT * FROM corp_record ORDER BY rId LIMIT {$page},10";
$res = $conn->query($sql);

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
$sql = "SELECT count(*) AS record_count FROM corp_record";
$res = $conn->query($sql);
$record_count = $res->fetch_assoc();
$conn->close();

$page_count = ceil($record_count["record_count"]/10);
$smarty->assign("page_count",$page_count);
$smarty->assign("menu_count",ceil($page_count/20));
$smarty->assign("current_page",ceil($current_page/20));
$smarty->assign("pageIndex",$current_page);
$smarty->assign("corp_record",$corp_record);
$smarty->display("corppage.html");
?>
