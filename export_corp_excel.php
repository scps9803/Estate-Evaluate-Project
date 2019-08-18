<?php
include "library.php";
error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br>');
date_default_timezone_set('Europe/London');

require_once 'classes/PHPExcel.php';
require_once 'classes/PHPExcel/Writer/Excel5.php';
$objPHPExcel  = new PHPExcel();

$script_number = $_REQUEST["script_number"];

$corp_owner_data = getCorpOwnerData($script_number);
$corp_land_owner_data = getCorpLandOwnerData($script_number);
$corp_land_data = getCorpLandData($script_number);
$corp_data = getCorpData($script_number);
$creator = "測試用";

// 計算農作物筆數設定不同頁數的模板
// pages為農作物頁數
$pages = (int)(count($corp_data) / 13) + 1;

// 自行建立的 Excel 版型檔名
$excelTemplate = './excel_templates/corp_template-'.$pages.'.xls';

// 判斷 Excel 檔案是否存在
if (!file_exists($excelTemplate)) {
    exit('Please run template.php first.' . EOL);
}

// 農作物所有人
if(count($corp_owner_data)>1){
    $corp_owner_text = '等'.count($corp_owner_data).'人';
}
else{
    $corp_owner_text = "";
}

$phone = $corp_owner_data[0]["cellphone"];
if($corp_owner_data[0]["cellphone"] == ""){
    $phone = $corp_owner_data[0]["telephone"];
}

// 土地所有人
$hold_id = "";
if(count($corp_land_owner_data)>1){
    $land_text = '等'.count($corp_land_owner_data).'人';
    for($i=0;$i<count($corp_land_owner_data);$i++){
        $hold_id = $hold_id . $corp_land_owner_data[$i]["hold_id"];
        if($i!=count($corp_land_owner_data)-1){
            $hold_id = $hold_id  . "、";
        }
    }
}
else{
    $land_text = "";
    $hold_id = $corp_land_owner_data[0]["hold_id"];
}

$land_phone = $corp_land_owner_data[0]["cellphone"];
if($corp_land_owner_data[0]["cellphone"] == ""){
    $land_phone = $corp_land_owner_data[0]["telephone"];
}

// 地段地號
$land_number = "";
$land_section = "";
$section_array = [];
$section_index = 0;
$total_land_area = 0;
for($i=0;$i<count($corp_land_data);$i++){
    if(!in_array($corp_land_data[$i]["land_section"],$section_array)){
        $section_array[$section_index] = $corp_land_data[$i]["land_section"];
        $land_section = $land_section.$corp_land_data[$i]["land_section"].$corp_land_data[$i]["subsection"];
        if($i!=count($corp_land_data)-1) {
            $land_section = $land_section."、";
        }
    }
    $land_number = $land_number.$corp_land_data[$i]["land_number"];
    if($i!=count($corp_land_data)-1) {
        $land_number = $land_number."、";
    }
    $total_land_area += $corp_land_data[$i]["area"];
}

// 實際使用面積
$actual_use_area = 0;
for($i=0;$i<count($corp_data);$i++){
    $actual_use_area += $corp_data[$i]["plant_area"];
}

// 載入 Excel
$objPHPExcel = PHPExcel_IOFactory::load($excelTemplate);
// 個人資料
for($i=1;$i<=$pages;$i++){
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'B'.(2+($i-1)*24), $corp_owner_data[0]["name"].$corp_owner_text)
            ->setCellValue( 'D'.(3+($i-1)*24), $corp_owner_data[0]["pId"])
            ->setCellValue( 'G'.(2+($i-1)*24), $corp_owner_data[0]["current_address"])
            ->setCellValue( 'R'.(2+($i-1)*24), $corp_owner_data[0]["telephone"])
            ->setCellValue( 'R'.(3+($i-1)*24), $corp_owner_data[0]["cellphone"])

            ->setCellValue( 'B'.(4+($i-1)*24), $corp_land_owner_data[0]["name"].$land_text)
            ->setCellValue( 'D'.(5+($i-1)*24), $corp_land_owner_data[0]["pId"])
            ->setCellValue( 'G'.(4+($i-1)*24), $corp_land_owner_data[0]["current_address"])
            ->setCellValue( 'R'.(4+($i-1)*24), $corp_land_owner_data[0]["telephone"])
            ->setCellValue( 'R'.(5+($i-1)*24), $corp_land_owner_data[0]["cellphone"])

            ->setCellValue( 'B'.(6+($i-1)*24), $land_section)
            ->setCellValue( 'F'.(6+($i-1)*24), $land_number)
            ->setCellValue( 'I'.(6+($i-1)*24), $total_land_area)
            ->setCellValue( 'K'.(6+($i-1)*24), $actual_use_area)
            ->setCellValue( 'N'.(6+($i-1)*24), $corp_owner_data[0]["land_use"])

            ->setCellValue( 'C'.(23+($i-1)*24), "歸戶編號：".$hold_id)
            ->setCellValue( 'Q'.(23+($i-1)*24), "調查表編號：".$script_number)
            ->setCellValue( 'A'.(24+($i-1)*24), "製表日期： ".date("Y")." 年 ".date("m")." 月 ".date("d")." 日")
            ->setCellValue( 'J'.(24+($i-1)*24), "製表人員：".$creator."　複核人員：".$creator);
}

// 農作物資料
$total_price = 0;
for($i=0;$i<count($corp_data);$i++){
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A'.(8+$i+(int)($i/14)*10), $corp_data[$i]["item"])
                ->setCellValue( 'B'.(8+$i+(int)($i/14)*10), $corp_data[$i]["corp_age"])
                ->setCellValue( 'E'.(8+$i+(int)($i/14)*10), $corp_data[$i]["cm_length"])
                ->setCellValue( 'G'.(8+$i+(int)($i/14)*10), $corp_data[$i]["m_length"])
                ->setCellValue( 'J'.(8+$i+(int)($i/14)*10), $corp_data[$i]["num"].$corp_data[$i]["unit"])
                ->setCellValue( 'L'.(8+$i+(int)($i/14)*10), $corp_data[$i]["plant_area"])
                ->setCellValue( 'M'.(8+$i+(int)($i/14)*10), $corp_data[$i]["unit_price"])
                ->setCellValue( 'N'.(8+$i+(int)($i/14)*10), number_format($corp_data[$i]["num"]*$corp_data[$i]["unit_price"],0))
                ->setCellValue( 'R'.(8+$i+(int)($i/14)*10), $corp_data[$i]["note"]);
    $total_price += number_format($corp_data[$i]["num"]*$corp_data[$i]["unit_price"],0,"","");
}
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'L'.(21+($pages-1)*24), $actual_use_area)
            ->setCellValue( 'N'.(21+($pages-1)*24), $total_price);

$objActSheet = $objPHPExcel->getActiveSheet();
$objActSheet->setTitle('default');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$saveType = explode("-",$script_number);
if($saveType[0] == "農合"){
    $savePath = "file/corp/legal/".substr($script_number,strlen($script_number)-3,strlen($script_number))."/";
}
else{
    $savePath = "file/corp/illegal/".substr($script_number,strlen($script_number)-3,strlen($script_number))."/";
}

if(!file_exists($savePath)){
    mkdir($savePath);
}

$fileNo = $script_number."-1";
$filename = base64_encode($fileNo);
$file_type = ".xls";
$objWriter->save($savePath.$filename.$file_type);
insertFileData($script_number,$savePath,$fileNo,$filename,$file_type,"corp_file_table");
?>
