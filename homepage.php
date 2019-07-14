<?php
session_start();
include "library.php";
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

//顯示歷史紀錄
$conn = connect_db();
$sql = "SELECT * FROM record NATURAL JOIN building NATURAL JOIN building_locate";
$res = $conn->query($sql);

$i=0;
$record = NULL;
while($row=$res->fetch_assoc()){
    $record[$i] = $row;
    $i++;
}
$conn->close();

$smarty->assign("record",$record);
$smarty->display("homepage.html");
?>
