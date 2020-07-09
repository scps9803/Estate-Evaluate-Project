<?php
include "library.php";
include "export_corp_hold_ratio_excel.php";
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
$survey_date = getSurveyDate("corp_record",$script_number);
$survey_date_split = explode("-",$survey_date);
$district = getCorpDistrict($script_number);
echo "district : ".$district."<br>";
// $creator = "測試用";
$creator = "";

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
$hold_id = "";
if(count($corp_owner_data)>1){
    $corp_owner_text = '等'.count($corp_owner_data).'人';
    for($i=0;$i<count($corp_owner_data);$i++){
        if($corp_owner_data[$i]["hold_id"] != ""){
            $hold_id = $hold_id . $corp_owner_data[$i]["hold_id"];
            if($i!=count($corp_owner_data)-1){
                $hold_id = $hold_id  . "、";
            }
        }
    }
}
else{
    $corp_owner_text = "";
    $hold_id = $corp_land_owner_data[0]["hold_id"];
}

$phone = $corp_owner_data[0]["cellphone"];
if($corp_owner_data[0]["cellphone"] == ""){
    $phone = $corp_owner_data[0]["telephone"];
}

// 土地所有人
// $hold_id = "";
if(count($corp_land_owner_data)>1){
    $land_text = '等'.count($corp_land_owner_data).'人';
    // for($i=0;$i<count($corp_land_owner_data);$i++){
    //     $hold_id = $hold_id . $corp_land_owner_data[$i]["hold_id"];
    //     if($i!=count($corp_land_owner_data)-1){
    //         $hold_id = $hold_id  . "、";
    //     }
    // }
}
else{
    $land_text = "";
    // $hold_id = $corp_land_owner_data[0]["hold_id"];
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
        // $land_section = $land_section.$corp_land_data[$i]["land_section"].$corp_land_data[$i]["subsection"];
        // if($i!=count($corp_land_data)-1) {
        //     $land_section = $land_section."、";
        // }
    }
    $land_number = $land_number.$corp_land_data[$i]["land_number"];
    if($i!=count($corp_land_data)-1) {
        $land_number = $land_number."、";
    }
    $total_land_area += $corp_land_data[$i]["area"];
}

for($i=0;$i<count($section_array);$i++){
    $land_section = $land_section.$section_array[$i];
    if($i!=count($section_array)-1) {
        $land_section = $land_section."、";
    }
}

// 實際使用面積
$actual_use_area = 0;
for($i=0;$i<count($corp_data);$i++){
    $actual_use_area += $corp_data[$i]["plant_area"];
}
// 超植提示訊息
$overPlantMsg = "";
if($actual_use_area>$total_land_area){
    $overPlantMsg = "本案有超植部分!";
}

// 農作物身份證字號空值不顯示
if(substr($corp_owner_data[0]["pId"],0,2) == "NA"){
    $corpPIdText = "";
}
else{
    $corpPIdText = $corp_owner_data[0]["pId"];
}
// 地主身份證字號空值不顯示
if(substr($corp_land_owner_data[0]["pId"],0,2) == "NA"){
    $landPIdText = "";
}
else{
    $landPIdText = $corp_land_owner_data[0]["pId"];
}
// 若有比照則顯示比照項目
for($i=0;$i<count($corp_data);$i++){
    if($corp_data[$i]["equal"] == "比照"){
        // $str = explode("比照",$corp_data[$i]["note"]);
        // if(count($str)>1){
        //     $corp_data[$i]["item"] = $str[1];
        // }
        // else{
        //     $corp_data[$i]["item"] = $corp_data[$i]["note"];
        // }
        $equal_item = $corp_data[$i]["item"];
        $corp_data[$i]["item"] = $corp_data[$i]["note"];
        $corp_data[$i]["note"] = "比照".$equal_item;
    }
}

// 載入 Excel
$objPHPExcel = PHPExcel_IOFactory::load($excelTemplate);
// 個人資料
for($i=1;$i<=$pages;$i++){
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'B'.(2+($i-1)*24), $corp_owner_data[0]["name"].$corp_owner_text)
            ->setCellValue( 'D'.(3+($i-1)*24), $corpPIdText)
            ->setCellValue( 'G'.(2+($i-1)*24), $corp_owner_data[0]["current_address"])
            ->setCellValue( 'R'.(2+($i-1)*24), $corp_owner_data[0]["telephone"])
            ->setCellValue( 'R'.(3+($i-1)*24), $corp_owner_data[0]["cellphone"])

            ->setCellValue( 'B'.(4+($i-1)*24), $corp_land_owner_data[0]["name"].$land_text)
            ->setCellValue( 'D'.(5+($i-1)*24), $landPIdText)
            ->setCellValue( 'G'.(4+($i-1)*24), $corp_land_owner_data[0]["current_address"])
            ->setCellValue( 'R'.(4+($i-1)*24), $corp_land_owner_data[0]["telephone"])
            ->setCellValue( 'R'.(5+($i-1)*24), $corp_land_owner_data[0]["cellphone"])

            ->setCellValue( 'B'.(6+($i-1)*24), $district.$land_section)
            ->setCellValue( 'F'.(6+($i-1)*24), $land_number)
            ->setCellValue( 'I'.(6+($i-1)*24), $total_land_area)
            ->setCellValue( 'K'.(6+($i-1)*24), $actual_use_area)
            ->setCellValue( 'N'.(6+($i-1)*24), $corp_owner_data[0]["land_use"])

            ->setCellValue( 'C'.(23+($i-1)*24), "歸戶編號：".$hold_id)
            ->setCellValue( 'Q'.(23+($i-1)*24), "調查表編號：".str_replace("-", "", $script_number))
            ->setCellValue( 'A'.(23+($i-1)*24), "調查日期： ".($survey_date_split[0]-1911)." 年 ".$survey_date_split[1]." 月 ".$survey_date_split[2]." 日")
            ->setCellValue( 'A'.(24+($i-1)*24), "製表日期： ".(date("Y")-1911)." 年 ".date("m")." 月 ".date("d")." 日")
            // ->setCellValue( 'J'.(24+($i-1)*24), "製表人員：".$creator."　複核人員：".$creator)
            ->setCellValue( 'B'.(22+($i-1)*24), $overPlantMsg);

            if($overPlantMsg != ""){
                // $objPHPExcel->getActiveSheet()->getStyle('B'.(22+($i-1)*24).':'.'T'.(22+($i-1)*24))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                // $objPHPExcel->getActiveSheet()->getStyle('B'.(22+($i-1)*24).':'.'T'.(22+($i-1)*24))->getFill()->getStartColor()->setARGB('FFFFFF00');
                $objPHPExcel->getActiveSheet()->getStyle('B'.(22+($i-1)*24).':'.'T'.(22+($i-1)*24))->getFont()->setSize(20)->setBold(true);
            }
}

// 農作物資料
$total_price = 0;
for($i=0;$i<count($corp_data);$i++){
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A'.(8+$i+(int)($i/14)*10), $corp_data[$i]["item"])
                ->setCellValue( 'B'.(8+$i+(int)($i/14)*10), $corp_data[$i]["corp_age"])
                ->setCellValue( 'E'.(8+$i+(int)($i/14)*10), $corp_data[$i]["cm_length"])
                ->setCellValue( 'G'.(8+$i+(int)($i/14)*10), $corp_data[$i]["m_length"])
                // ->setCellValue( 'J'.(8+$i+(int)($i/14)*10), $corp_data[$i]["num"].$corp_data[$i]["unit"])
                ->setCellValue( 'J'.(8+$i+(int)($i/14)*10), $corp_data[$i]["plant_area"])
                ->setCellValue( 'K'.(8+$i+(int)($i/14)*10), $corp_data[$i]["num"])
                ->setCellValue( 'L'.(8+$i+(int)($i/14)*10), $corp_data[$i]["unit"])
                // ->setCellValue( 'L'.(8+$i+(int)($i/14)*10), $corp_data[$i]["plant_area"])
                ->setCellValue( 'M'.(8+$i+(int)($i/14)*10), $corp_data[$i]["unit_price"])
                ->setCellValue( 'N'.(8+$i+(int)($i/14)*10), number_format($corp_data[$i]["num"]*$corp_data[$i]["unit_price"],0))
                ->setCellValue( 'R'.(8+$i+(int)($i/14)*10), $corp_data[$i]["note"]);
    $total_price += number_format($corp_data[$i]["num"]*$corp_data[$i]["unit_price"],0,"","");
}
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'J'.(21+($pages-1)*24), $actual_use_area)
            ->setCellValue( 'N'.(21+($pages-1)*24), $total_price);

exportCorpHoldRatioExcel($script_number,$corp_owner_data,$corp_land_owner_data,$corp_land_data,
$corp_data,$creator,$land_section,$land_number,$total_land_area,$actual_use_area,$total_price,$survey_date_split,$district,$pages,$objPHPExcel);

$objActSheet = $objPHPExcel->getActiveSheet();
$objActSheet->setTitle(str_replace("-", "", $script_number));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$saveType = explode("-",$script_number);
if($saveType[0] == "農"){
    $savePath = "file/corp/".$saveType[1]."/";
}

if(!file_exists($savePath)){
    mkdir($savePath);
}

$fileNo = $script_number."-1";
$filename = base64_encode($fileNo);
$cn_filename = base64_decode($filename);
$file_type = ".xls";
$objWriter->save($savePath.$filename.$file_type);
rename($savePath.$filename.$file_type, $savePath.$cn_filename.$file_type);
insertFileData($script_number,$savePath,$fileNo,$cn_filename,$file_type,"corp_file_table");
// exportCorpHoldRatioExcel($script_number,$corp_owner_data,$corp_land_owner_data,$corp_land_data,
// $corp_data,$creator,$land_section,$land_number,$total_land_area,$actual_use_area,$total_price,$survey_date_split,$pages,$objPHPExcel);
?>
