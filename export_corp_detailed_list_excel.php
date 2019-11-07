<?php
include "library.php";

function exportCorpDetail(){
    error_reporting(E_ALL);
    // ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br>');
    date_default_timezone_set('Europe/London');
    
    require_once 'classes/PHPExcel.php';
    require_once 'classes/PHPExcel/Writer/Excel5.php';
    $objPHPExcel  = new PHPExcel();
    
    $all_record = getAllCorpRecord();
    
    // 自行建立的 Excel 版型檔名
    $excelTemplate = './excel_templates/corp_detailed_list_template.xls';
    
    // 判斷 Excel 檔案是否存在
    if (!file_exists($excelTemplate)) {
        exit('Please run template.php first.' . EOL);
    }
    
    // 載入 Excel
    $objPHPExcel = PHPExcel_IOFactory::load($excelTemplate);
    $row_index = 6;
    $counter = 1;
    $total_all = 0;
    
    for($i=0;$i<count($all_record);$i++){
        $corp_owner_data = getCorpOwnerData($all_record[$i]["rId"]);
        $corp_land_data = getCorpLandData($all_record[$i]["rId"]);
        $corp_data = getCorpData2($all_record[$i]["rId"]);
        $pay_index = [];
    
        // 地段地號
        $land_number = [];
        $section_array = [];
        $subsection_array = [];
        $section_index = 0;
        $total_land_area = 0;
        for($j=0;$j<count($corp_land_data);$j++){
            if(!in_array($corp_land_data[$j]["land_section"],$section_array)){
                $section_array[$section_index] = $corp_land_data[$j]["land_section"];
                $subsection_array[$section_index] = $corp_land_data[$j]["subsection"];
                $land_number[$section_index] = $corp_land_data[$j]["land_number"];
                $key = $section_index;
                $section_index++;
            }
            else{
                $key = array_search($corp_land_data[$j]["land_section"], $section_array);
                $land_number[$key] = $land_number[$key]."、";
                $land_number[$key] = $land_number[$key].$corp_land_data[$j]["land_number"];
            }
        }
    
        for($j=0;$j<count($corp_owner_data);$j++){
            $total = 0;
            $land_index = $row_index;
            $pay_index[$j] = $row_index;
            $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, 1);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A'.$row_index, $counter)
                ->setCellValue( 'B'.$row_index, $all_record[$i]["district"])
                ->setCellValue( 'P'.$row_index, str_replace("-","",$all_record[$i]["rId"]));
    
            // 農作物身份證字號空值不顯示
            if(substr($corp_owner_data[$j]["pId"],0,2) == "NA"){
                $corp_owner_data[$j]["pId"] = "";
            }
            if($corp_owner_data[$j]["hold_status"] != "公同共有"){
                $corp_owner_data[$j]["hold_status"] = "";
            }
    
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'E'.$row_index, $corp_owner_data[$j]["hold_id"])
                ->setCellValue( 'F'.$row_index, $corp_owner_data[$j]["name"])
                ->setCellValue( 'G'.$row_index, $corp_owner_data[$j]["pId"])
                ->setCellValue( 'H'.$row_index, $corp_owner_data[$j]["current_address"])
                ->setCellValue( 'N'.$row_index, $corp_owner_data[$j]["hold_status"].$corp_owner_data[$j]["hold_numerator"]."/".$corp_owner_data[$j]["hold_denominator"]);
            $row_index++;
    
            for($k=0;$k<count($corp_data["item"]);$k++){
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, 1);
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'I'.$row_index, $corp_data["item"][$k])
                    ->setCellValue( 'J'.$row_index, $corp_data["corp_type"][$k])
                    ->setCellValue( 'K'.$row_index, number_format($corp_data["num"][$k]*$corp_data["unit_price"][$k],0));
                
                $total += round($corp_data["num"][$k]*$corp_data["unit_price"][$k]);
                $total_text = number_format($total,0);
                $row_index++;
            }
        
            $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, 1);
            $row_index++;
            $counter++;
    
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'M'.$land_index, $total_text);
    
            for($k=0;$k<count($section_array);$k++){
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'C'.$land_index, $section_array[$k].$subsection_array[$k])
                    ->setCellValue( 'D'.$land_index, $land_number[$k]);
                $land_index++;
            }
        }
        $total_all += $total;
        
        // 持分金額計算
        $remainder = $total;
    
        for($j=0;$j<count($corp_owner_data);$j++){
            $hold_ratio = $corp_owner_data[$j]["hold_numerator"] / $corp_owner_data[$j]["hold_denominator"];
            // $remainder = $remainder - floor($total*$corp_owner_data[$j]["hold_ratio"]);
            $remainder = $remainder - floor($total*$hold_ratio);
            echo "補償費 ".$j." : ".$total."<br>";
            echo "分數 ".$j." : ".$hold_ratio."<br>";
            echo "持分 ".$j." : ".$corp_owner_data[$j]["hold_numerator"]."/".$corp_owner_data[$j]["hold_denominator"]."<br>";
            echo "金額 ".$j." : ".floor($total*$hold_ratio)."<br>";
            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
        }
        for($j=0;$j<count($corp_owner_data);$j++){
            $hold_ratio = $corp_owner_data[$j]["hold_numerator"] / $corp_owner_data[$j]["hold_denominator"];
            if($remainder>0){
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'O'.$pay_index[$j], number_format(floor($total*$hold_ratio)+1,0,".",","));
                $remainder--;
            }
            else{
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'O'.$pay_index[$j], number_format(floor($total*$hold_ratio),0,".",","));
            }
            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
        }
    }
    $total_all_text = number_format($total_all,0);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$row_index.':'.'Q'.$row_index);
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A'.$row_index, "總持分金額：".$total_all_text);
    
    $objActSheet = $objPHPExcel->getActiveSheet();
    $objActSheet->setTitle("農作物清冊");
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    
    $savePath = "file/book/";
    
    if(!file_exists($savePath)){
        mkdir($savePath);
    }
    
    $fileNo = "corp_detail";
    // $filename = base64_encode($fileNo);
    $filename = "農作物清冊";
    $file_type = ".xls";
    $objWriter->save($savePath.$filename.$file_type);
    
    echo "插入完成<br>";
}
?>