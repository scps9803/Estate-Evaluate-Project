<?php
session_start();
require_once "smarty/libs/Smarty.class.php";
require_once 'classes/PHPExcel.php';
require_once 'classes/PHPExcel/Writer/Excel5.php';
include("library.php");
$smarty = new Smarty;

$house_address = $_POST['house_address'];
$script_number = $_POST['script_number'];
$other_item_count = $_POST['other-item-count'];
$isFence = false;
// 儲存雜項物資料
for($i=0;$i<$other_item_count;$i++){
    $sub_building[$i]["category"] = $_POST['other-item-category-'.($i+1)];
    $sub_building[$i]["item"] = $_POST['other-item-'.($i+1)];
    if(isset($_POST['fence-paint-'.($i+1)])){
        $sub_building[$i]["fence_paint"] = $_POST['fence-paint-'.($i+1)];
        $sub_building[$i]["fence_pillar"] = $_POST['fence-pillar-'.($i+1)];
        $sub_building[$i]["keyin_order"] = $i+1;
        $isFence = true;
    }
    if(isset($_POST['fence-double-paint-'.($i+1)])){
        $sub_building[$i]["fence_paint"] = $_POST['fence-paint-'.($i+1)];
        $sub_building[$i]["fence_double_paint"] = $_POST['fence-double-paint-'.($i+1)];
        $sub_building[$i]["fence_pillar"] = $_POST['fence-pillar-'.($i+1)];
        $sub_building[$i]["keyin_order"] = $i+1;
        $isFence = true;
    }
    $sub_building[$i]["item_type"] = $_POST['other-item-type-'.($i+1)];
    $sub_building[$i]["area_calculate_text"] = $_POST['calArea-'.($i+1)];
    $sub_building[$i]["keyin_order"] = $i+1;

    $objPHPExcel  = new PHPExcel();
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    $calAreaTool = "tools/calAreaText.xls";
    $objPHPExcel = PHPExcel_IOFactory::load($calAreaTool);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A1', "=".$sub_building[$i]["area_calculate_text"]);

    $objActSheet = $objPHPExcel->getActiveSheet();
    $objActSheet->setTitle('default');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('tools/calAreaText.xls');

    $objPHPExcel = PHPExcel_IOFactory::load($calAreaTool);
    $area = $objPHPExcel->getActiveSheet()->getCell('A1')->getCalculatedValue();
    $sub_building[$i]["area"] = $area;

    $sub_building[$i]["auto_remove"] = $_POST['auto-remove-'.($i+1)];
}
deleteOldFenceData($house_address);
insertSubbuildingData($house_address,$sub_building);
if($isFence){
    insertFenceData($house_address,$sub_building);
}

echo
'<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>'.
'<script type="text/javascript" src="js/index.js"></script>'.
'<script>
    $(document).ready(function(){
        exportExcel("'.$script_number.'","'.$house_address.'");
    });
</script>';

$smarty->assign("script_number",$script_number);
$smarty->assign("house_address",$house_address);
$smarty->display("saveData.html");
?>
