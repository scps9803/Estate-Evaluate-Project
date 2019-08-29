<?php
function exportCorpHoldRatioExcel($script_number,$corp_owner_data,$corp_land_owner_data,$corp_land_data,
$corp_data,$creator,$land_section,$land_number,$total_land_area,$actual_use_area,$total_pay){
    $saveType = explode("-",$script_number);
    $holdRatioMod = $total_pay % count($corp_owner_data);

    // 農作物所有人
    if(count($corp_owner_data)>1){
        $corp_owner_text = '等'.count($corp_owner_data).'人';
    }
    else{
        $corp_owner_text = "";
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

    $objPHPExcel  = new PHPExcel();
    // 自行建立的 Excel 版型檔名
    $excelTemplate = './excel_templates/corp_hold_ratio_template.xls';

    // 判斷 Excel 檔案是否存在
    if (!file_exists($excelTemplate)) {
        exit('Please run template.php first.' . EOL);
    }

    // 載入 Excel
    $objPHPExcel = PHPExcel_IOFactory::load($excelTemplate);
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'B52', $corp_owner_data[0]["name"].$corp_owner_text)
                ->setCellValue( 'D53', $corp_owner_data[0]["pId"])
                ->setCellValue( 'G52', $corp_owner_data[0]["current_address"])
                ->setCellValue( 'R52', $corp_owner_data[0]["telephone"])
                ->setCellValue( 'R53', $corp_owner_data[0]["cellphone"])

                ->setCellValue( 'B54', $corp_land_owner_data[0]["name"].$land_text)
                ->setCellValue( 'D55', $corp_land_owner_data[0]["pId"])
                ->setCellValue( 'G54', $corp_land_owner_data[0]["current_address"])
                ->setCellValue( 'R54', $corp_land_owner_data[0]["telephone"])
                ->setCellValue( 'R55', $corp_land_owner_data[0]["cellphone"])

                ->setCellValue( 'B56', $land_section)
                ->setCellValue( 'F56', $land_number)
                ->setCellValue( 'I56', $total_land_area)
                ->setCellValue( 'K56', $actual_use_area)
                ->setCellValue( 'N56', $corp_owner_data[0]["land_use"]);
    for($i=0;$i<count($corp_owner_data);$i++){
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'A'.(57+$i*2), '農林漁牧作物所有人')
                    ->setCellValue( 'B'.(57+$i*2), $corp_owner_data[$i]["name"])
                    ->setCellValue( 'D'.(57+$i*2), '歸戶號')
                    ->setCellValue( 'F'.(57+$i*2), '住所')
                    ->setCellValue( 'F'.(58+$i*2), '聯絡電話')
                    ->setCellValue( 'G'.(57+$i*2), $corp_owner_data[$i]["current_address"])
                    ->setCellValue( 'G'.(58+$i*2), $corp_owner_data[$i]["telephone"])
                    ->setCellValue( 'J'.(58+$i*2), '連絡手機')
                    ->setCellValue( 'K'.(58+$i*2), $corp_owner_data[$i]["cellphone"])
                    ->setCellValue( 'M'.(57+$i*2), '持分比例')
                    ->setCellValue( 'M'.(58+$i*2), $corp_owner_data[$i]["hold_ratio"])
                    ->setCellValue( 'O'.(57+$i*2), '身分證字號')
                    ->setCellValue( 'O'.(58+$i*2), '持分補償金額')
                    ->setCellValue( 'R'.(57+$i*2), $corp_owner_data[$i]["pId"]);

        if($holdRatioMod > 0){
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'R'.(58+$i*2), number_format(floor($total_pay*$corp_owner_data[$i]["hold_ratio"])+1,0,".",","));
            $holdRatioMod--;
        }
        else{
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'R'.(58+$i*2), number_format(floor($total_pay*$corp_owner_data[$i]["hold_ratio"]),0,".",","));
        }
    }
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A85', "調查日期： ".date("Y")." 年 ".date("m")." 月 ".date("d")." 日")
                ->setCellValue( 'A86', "製表日期： ".date("Y")." 年 ".date("m")." 月 ".date("d")." 日")
                ->setCellValue( 'Q85', "調查表編號：".$script_number)
                ->setCellValue( 'J86', "製表人員：".$creator."　複核人員：".$creator);

    $objActSheet = $objPHPExcel->getActiveSheet();
    $objActSheet->setTitle($script_number);
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    if($saveType[0] == "農合"){
        $savePath = "file/corp/legal/".substr($script_number,strlen($script_number)-3,strlen($script_number))."/";
    }
    else{
        $savePath = "file/corp/illegal/".substr($script_number,strlen($script_number)-3,strlen($script_number))."/";
    }

    if(!file_exists($savePath)){
        mkdir($savePath);
    }

    $fileNo = $script_number."-2";
    $filename = base64_encode($fileNo);
    $file_type = ".xls";
    echo $savePath;
    $objWriter->save($savePath.$filename.$file_type);
    insertFileData($script_number,$savePath,$fileNo,$filename,$file_type,"corp_file_table");
}
?>
