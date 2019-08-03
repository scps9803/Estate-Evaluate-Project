<?php
session_start();
include "library.php";
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$corp_category = load_corp_item_Data();
$corp_category_option = "";

for($i=0;$i<count($corp_category);$i++){
    $corp_category_option = $corp_category_option
    ."<option value='".$corp_category[$i]["category"]."'>".$corp_category[$i]["category"]."</option>";
}

$smarty->assign("corp_category_option",$corp_category_option);
$smarty->display("corp.html");
?>
