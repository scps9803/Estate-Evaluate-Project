<?php
session_start();
require_once "smarty/libs/Smarty.class.php";
require_once 'classes/PHPExcel.php';
require_once 'classes/PHPExcel/Writer/Excel5.php';
include("library.php");
$smarty = new Smarty;

$KEYIN_ID = "DEMO1234";
date_default_timezone_set('Asia/Taipei');
$KEYIN_DATETIME = date("Y-m-d/H:i:s");
$SURVEY_DATE = $_POST['survey-date'];
if(isset($_POST['shared'])){
    $shared = $_POST['shared'];
}
else{
    $shared = "個別持分";
}

// 行政區
$district = $_POST['district'];
// echo "行政區: ".$district."<br>";

// 地段、小段、地號
$land_section_count = $_POST['land_section_count'];
for($i=0;$i<$land_section_count;$i++){
    if($_POST['land-section-'.($i+1)]=="") break;
    $land_section[$i] = $_POST['land-section-'.($i+1)];
    $subsection[$i] = $_POST['subsection-'.($i+1)];
    $temp_land = explode ("、",$_POST['land-number-'.($i+1)]);
    for($j=0;$j<count($temp_land);$j++){
        $land_number[$i][$j] = $temp_land[$j];
    }
}
// echo "---------------------<br>";
// echo "地段地號:<br>";
// for($i=0;$i<count($land_section_count);$i++){
//     echo $land_section[$i]."-"."$subsection[$i]"."-"."<br>";
//     print_r($temp_land);
//     echo "<br>";
// }

// 合法狀態、手稿編號、土地使用權屬
$legal_status = $_POST['legal-status'];
$script_number = $_POST['legal-status']."-".$_POST['script-number'];
$land_use = $_POST['land-use'];
// echo "---------------------<br>";
// echo $script_number."<br>";

// 農林漁牧作物所有人、持分、身分證字號、住址、電話等個人資料
$owner_count = $_POST['owner_count'];
for($i=0;$i<$owner_count;$i++){
    $owner[$i] = $_POST['corp-owner-'.($i+1)];
    $hold_ratio[$i] = $_POST['hold-numerator-'.($i+1)] / $_POST['hold-denominator-'.($i+1)];
    $hold_numerator[$i] = $_POST['hold-numerator-'.($i+1)];
    $hold_denominator[$i] = $_POST['hold-denominator-'.($i+1)];
    $owner_order[$i] = $i+1;
    if($_POST['pId-'.($i+1)] == ""){
        $pId[$i] = "NA".$script_number."-".($i+1);
    }
    else{
        $pId[$i] = $_POST['pId-'.($i+1)];
    }
    $address[$i] = $_POST['addressText-'.($i+1)];
    $cellphone[$i] = $_POST['cellphone-'.($i+1)];
    $telephone[$i] = $_POST['telephone-'.($i+1)];
}
// echo "---------------------<br>";
// echo "農作物所有人:"."<br>";
// for($i=0;$i<$owner_count;$i++){
//     echo $owner[$i]."<br>";
//     echo $hold_ratio[$i]."<br>";
//     echo $pId[$i]."<br>";
//     echo $address[$i]."<br>";
//     echo $cellphone[$i]."<br>";
//     echo $telephone[$i]."<br>";
//     echo "---------------------<br>";
// }

// 土地所有人、歸戶號、身分證字號、住址、電話等個人資料
// $land_owner_count = $_POST['land_owner_count'];

$land_owner[0] = $_POST['land-owner-1'];
$hold_id[0] = $_POST['hold-id-1'];
if($_POST['land-pId-1'] == ""){
    $land_pId[0] = "NA".$script_number."-1";
}
else{
    $land_pId[0] = $_POST['land-pId-1'];
}
$landAddressText[0] = $_POST['landAddressText-1'];
$land_cellphone[0] = $_POST['land-cellphone-1'];
$land_telephone[0] = $_POST['land-telephone-1'];
$land_owner_order[0] = 1;

$first_id = $_POST['hold-id-1'];
$land_owner_data = getCorpLandOwnerData2($first_id,$land_section,$subsection,$land_number);
// echo "HHHHHH<br>";
// print_r($land_owner_data)."<br>";

for($i=1;$i<=count($land_owner_data["hold_id"]);$i++){
    // if($i==0){
    //     $land_owner[$i] = $_POST['land-owner-'.($i+1)];
    //     $hold_id[$i] = $_POST['hold-id-'.($i+1)];
    //     if($_POST['land-pId-'.($i+1)] == ""){
    //         $land_pId[$i] = "NA".$script_number."-".($i+1);
    //     }
    //     else{
    //         $land_pId[$i] = $_POST['land-pId-'.($i+1)];
    //     }
    //     $landAddressText[$i] = $_POST['landAddressText-'.($i+1)];
    //     $land_cellphone[$i] = $_POST['land-cellphone-'.($i+1)];
    //     $land_telephone[$i] = $_POST['land-telephone-'.($i+1)];
    // }
    // else{
        $land_owner[$i] = $land_owner_data["name"][$i-1];
        $hold_id[$i] = $land_owner_data["hold_id"][$i-1];
        $land_pId[$i] = "NA".$script_number."-".($i+1);
        $landAddressText[$i] = $land_owner_data["address"][$i-1];
        $land_cellphone[$i] = '';
        $land_telephone[$i] = '';
        $land_owner_order[$i] = $i+1;
    // }
}
// for($i=0;$i<count($land_owner_data["hold_id"]);$i++) echo $hold_id[$i]."<br>";
// echo "---------------------<br>";
// echo "土地所有人:"."<br>";
// // echo count($land_owner_data["hold_id"]);
// for($i=0;$i<count($land_owner_data["hold_id"])+1;$i++){
//     echo $land_owner[$i]."<br>";
//     echo $hold_id[$i]."<br>";
//     echo $land_pId[$i]."<br>";
//     echo $landAddressText[$i]."<br>";
//     echo $land_cellphone[$i]."<br>";
//     echo $land_telephone[$i]."<br>";
// }

// 農作物項目
$corp_count = $_POST['corp-count'];
for($i=0;$i<$corp_count;$i++){
    $corp[$i]["category"] = $_POST['corp-category-'.($i+1)];
    $corp[$i]["item"] = $_POST['corp-item-'.($i+1)];
    $corp[$i]["type"] = $_POST['corp-type-'.($i+1)];
    $corp[$i]["num"] = $_POST['corp-num-'.($i+1)];
    $corp[$i]["unit"] = $_POST['corp-unit-'.($i+1)];
    $corp[$i]["area"] = $_POST['corp-area-'.($i+1)];
    $corp[$i]["note"] = $_POST['corp-note-'.($i+1)];
    $corp[$i]["keyin_order"] = $i+1;
    if(isset($_POST['corp-equal-'.($i+1)])){
        $corp[$i]["equal"] = $_POST['corp-equal-'.($i+1)];
    }
    else{
        $corp[$i]["equal"] = "";
    }
}
// echo "---------------------<br>";
// echo "農作物:"."<br>";
// for($i=0;$i<$corp_count;$i++){
//     print_r($corp[$i]);
//     echo "<br>";
// }

insertIntoCorpRecordTable($script_number,$district,$land_use,$KEYIN_ID,$KEYIN_DATETIME,$SURVEY_DATE);
insertIntoLandBelongToCorpRecordTable($land_section,$subsection,$land_number,$script_number);
insertIntoCorpOwnerTable($pId,$owner,$address,$telephone,$cellphone,$script_number);
insertIntoCorpOwnerBelongToCorpRecordTable($pId,$script_number,$hold_ratio,$hold_numerator,$hold_denominator,$shared,$owner_order);
insertIntoLandOwnerTable($hold_id,$land_pId,$land_owner,$land_telephone,$land_cellphone,$landAddressText);
insertIntoLandOwnerBelongToCorpRecordTable($hold_id,$script_number,$land_owner_order);
insertIntoPlantingTable($land_section,$subsection,$land_number,$corp,$script_number);

echo
'<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>'.
'<script type="text/javascript" src="js/index.js"></script>'.
'<script>
    $(document).ready(function(){
        exportCorpExcel("'.$script_number.'");
    });
</script>';

$smarty->assign("script_number",$script_number);
$smarty->display("corp_submit.html");
?>
