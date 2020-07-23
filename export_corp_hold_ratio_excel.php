<?php
function exportCorpHoldRatioExcel($script_number,$corp_owner_data,$corp_land_owner_data,$corp_land_data,
$corp_data,$creator,$land_section,$land_number,$total_land_area,$actual_use_area,$total_pay,$survey_date_split,$district,$pages,$objPHPExcel){
    $saveType = explode("-",$script_number);
    // $holdRatioMod = $total_pay % count($corp_owner_data);
    $bonus_list = [];
    $pay_to_owner = [];
    $surplus = $total_pay;

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

    // 農作物身份證字號空值不顯示
    for($i=0;$i<count($corp_owner_data);$i++){
        if(substr($corp_owner_data[$i]["pId"],0,2) == "NA"){
            $corp_owner_data[$i]["pId"] = "";
        }
        // 若非公同共有則不顯示
        if($corp_owner_data[$i]["hold_status"] != "公同共有"){
            $corp_owner_data[$i]["hold_status"] = "";
        }
    }
    // 地主身份證字號空值不顯示
    if(substr($corp_land_owner_data[0]["pId"],0,2) == "NA"){
        $landPIdText = "";
    }
    else{
        $landPIdText = $corp_land_owner_data[0]["pId"];
    }

    // $objPHPExcel  = new PHPExcel();
    // // 自行建立的 Excel 版型檔名
    // $excelTemplate = './excel_templates/corp_hold_ratio_template.xls';

    // // 判斷 Excel 檔案是否存在
    // if (!file_exists($excelTemplate)) {
    //     exit('Please run template.php first.' . EOL);
    // }

    // // 載入 Excel
    // $objPHPExcel = PHPExcel_IOFactory::load($excelTemplate);
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'B'.(26+($pages-1)*24), $corp_owner_data[0]["owner_name"].$corp_owner_text)
                ->setCellValue( 'D'.(27+($pages-1)*24), $corp_owner_data[0]["pId"])
                ->setCellValue( 'G'.(26+($pages-1)*24), $corp_owner_data[0]["current_address"])
                ->setCellValue( 'R'.(26+($pages-1)*24), $corp_owner_data[0]["telephone"])
                ->setCellValue( 'R'.(27+($pages-1)*24), $corp_owner_data[0]["cellphone"])

                ->setCellValue( 'B'.(28+($pages-1)*24), $corp_land_owner_data[0]["name"].$land_text)
                ->setCellValue( 'D'.(29+($pages-1)*24), $landPIdText)
                ->setCellValue( 'G'.(28+($pages-1)*24), $corp_land_owner_data[0]["current_address"])
                ->setCellValue( 'R'.(28+($pages-1)*24), $corp_land_owner_data[0]["telephone"])
                ->setCellValue( 'R'.(29+($pages-1)*24), $corp_land_owner_data[0]["cellphone"])

                ->setCellValue( 'B'.(30+($pages-1)*24), $district.$land_section)
                ->setCellValue( 'F'.(30+($pages-1)*24), $land_number)
                ->setCellValue( 'I'.(30+($pages-1)*24), $total_land_area)
                ->setCellValue( 'K'.(30+($pages-1)*24), $actual_use_area)
                ->setCellValue( 'N'.(30+($pages-1)*24), $corp_owner_data[0]["land_use"]);
    for($i=0;$i<count($corp_owner_data);$i++){
        $hold_ratio = $corp_owner_data[$i]["hold_numerator"] / $corp_owner_data[$i]["hold_denominator"];
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'A'.(31+($pages-1)*24+$i*2), '農林漁牧作物所有人')
                    ->setCellValue( 'B'.(31+($pages-1)*24+$i*2), $corp_owner_data[$i]["owner_name"])
                    ->setCellValue( 'D'.(31+($pages-1)*24+$i*2), '歸戶號')
                    ->setCellValue( 'D'.(32+($pages-1)*24+$i*2), $corp_owner_data[$i]["hold_id"])
                    ->setCellValue( 'F'.(31+($pages-1)*24+$i*2), '住所')
                    ->setCellValue( 'F'.(32+($pages-1)*24+$i*2), '聯絡電話')
                    ->setCellValue( 'G'.(31+($pages-1)*24+$i*2), $corp_owner_data[$i]["current_address"])
                    ->setCellValue( 'G'.(32+($pages-1)*24+$i*2), $corp_owner_data[$i]["telephone"])
                    ->setCellValue( 'J'.(32+($pages-1)*24+$i*2), '連絡手機')
                    ->setCellValue( 'K'.(32+($pages-1)*24+$i*2), $corp_owner_data[$i]["cellphone"])
                    ->setCellValue( 'M'.(31+($pages-1)*24+$i*2), '持分比例')
                    ->setCellValue( 'M'.(32+($pages-1)*24+$i*2), $corp_owner_data[$i]["hold_status"].$corp_owner_data[$i]["hold_numerator"]."/".$corp_owner_data[$i]["hold_denominator"])
                    ->setCellValue( 'O'.(31+($pages-1)*24+$i*2), '身分證字號')
                    ->setCellValue( 'O'.(32+($pages-1)*24+$i*2), '持分補償金額')
                    ->setCellValue( 'R'.(31+($pages-1)*24+$i*2), $corp_owner_data[$i]["pId"]);

        // if($holdRatioMod > 0){
        //     $objPHPExcel->setActiveSheetIndex(0)
        //             ->setCellValue( 'R'.(32+($pages-1)*24+$i*2), number_format(floor($total_pay*$hold_ratio)+1,0,".",","));
        //     $holdRatioMod--;
        // }
        // else{
        //     $objPHPExcel->setActiveSheetIndex(0)
        //             ->setCellValue( 'R'.(32+($pages-1)*24+$i*2), number_format(floor($total_pay*$hold_ratio),0,".",","));
        // }
        
        $original_pay = $total_pay*$hold_ratio;
        $round_pay = round($total_pay*$hold_ratio);
        $pay_to_owner[$i] = $round_pay;
        $surplus -= $round_pay;
        if($round_pay <= $original_pay){
            $bonus_list[$i] = true;
        }
        else{
            $bonus_list[$i] = false;
        }
    }
    for($i=0;$i<count($corp_owner_data);$i++){
        if($surplus > 0 && $bonus_list[$i] == true){
            $pay_to_owner[$i] += 1;
            $surplus -= 1;
        }
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'R'.(32+($pages-1)*24+$i*2), number_format($pay_to_owner[$i],0,".",","));
    }
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A'.(59+($pages-1)*24), "調查日期： ".($survey_date_split[0]-1911)." 年 ".$survey_date_split[1]." 月 ".$survey_date_split[2]." 日")
                ->setCellValue( 'A'.(60+($pages-1)*24), "製表日期： ".(date("Y")-1911)." 年 ".date("m")." 月 ".date("d")." 日")
                ->setCellValue( 'Q'.(59+($pages-1)*24), "調查表編號：".str_replace("-", "", $script_number));
                // ->setCellValue( 'J86', "製表人員：".$creator."　複核人員：".$creator);

    // $objActSheet = $objPHPExcel->getActiveSheet();
    // $objActSheet->setTitle(str_replace("-", "", $script_number));
    // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    // if($saveType[0] == "農"){
    //     $savePath = "file/corp/legal/".$saveType[1]."/";
    // }
    // // else{
    // //     $savePath = "file/corp/illegal/".substr($script_number,strlen($script_number)-3,strlen($script_number))."/";
    // // }

    // if(!file_exists($savePath)){
    //     mkdir($savePath);
    // }

    // $fileNo = $script_number."-2";
    // $filename = base64_encode($fileNo);
    // $file_type = ".xls";
    // echo $savePath;
    // $objWriter->save($savePath.$filename.$file_type);
    // insertFileData($script_number,$savePath,$fileNo,$filename,$file_type,"corp_file_table");
}
?>
