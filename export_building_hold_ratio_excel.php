<?php
function exportBuildingHoldRatioExcel($script_number,$land_owner_data,$building_data,$land_data,$total_pay,$survey_date_split,$pages,$objPHPExcel){
    $saveType = explode("-",$script_number);
    $owner_data = getOwnerData($building_data[0]["address"]);
    // $holdRatioMod = $total_pay % count($owner_data);
    $remainder = $total_pay;
    echo "<br> KEEE: ".gettype($remainder);

    // 地段、地號
    $land_number = "";
    $land_section = "";
    $section_array = [];
    $section_index = 0;
    $total_land_area = 0;
    for($i=0;$i<count($land_data);$i++){
        if(!in_array($land_data[$i]["land_section"],$section_array)){
            $section_array[$section_index] = $land_data[$i]["land_section"];
            // $land_section = $land_section.$land_data[$i]["land_section"].$land_data[$i]["subsection"];
            // if($i!=count($land_data)-1) {
            //     $land_section = $land_section."、";
            // }
        }
        $land_number = $land_number.$land_data[$i]["land_number"];
        if($i!=count($land_data)-1) {
            $land_number = $land_number."、";
        }
        $total_land_area += $land_data[$i]["area"];
    }
    for($i=0;$i<count($section_array);$i++){
        $land_section = $land_section.$section_array[$i];
        if($i!=count($section_array)-1) {
            $land_section = $land_section."、";
        }
    }

    $owner_text = "";
    $land_owner_text = "";
    if(count($owner_data)>1){
        $owner_text = "等".count($owner_data)."人";
    }
    if(count($land_owner_data)>1){
        $land_owner_text = "等".count($land_owner_data)."人";
    }
    if($saveType[0] == "建合"){
        $legal_text = "有合法證明文件";
        $document_text = "詳合法房屋證明等相關文件影本";
        $title = "桃園市觀音區廣福(第五單元)自辦市地重劃地上物查估作業建築改良物持分表(合法建物)";
    }
    else{
        $legal_text = "無合法證明文件";
        $document_text = "無";
        $title = "桃園市觀音區廣福(第五單元)自辦市地重劃地上物查估作業建築改良物持分表(其他建築改良物)";
    }
    if($land_data[0]["land_use"]=="承租"){
        $rent_text = "有";
    }
    else{
        $rent_text = "無";
    }

    // 農作物身份證字號空值不顯示
    for($i=0;$i<count($owner_data);$i++){
        if(substr($owner_data[$i]["pId"],0,2) == "NA"){
            $owner_data[$i]["pId"] = "";
        }
        // 若非公同共有則不顯示
        if($owner_data[$i]["hold_status"] != "公同共有"){
            $owner_data[$i]["hold_status"] = "";
        }
    }
    // 地主身份證字號空值不顯示
    if(substr($land_owner_data[0]["pId"],0,2) == "NA"){
        $landPIdText = "";
    }
    else{
        $landPIdText = $land_owner_data[0]["pId"];
    }

    // $objPHPExcel  = new PHPExcel();
    // 自行建立的 Excel 版型檔名
    // $excelTemplate = './excel_templates/building_hold_ratio_template.xls';

    // 判斷 Excel 檔案是否存在
    // if (!file_exists($excelTemplate)) {
    //     exit('Please run template.php first.' . EOL);
    // }

    // 載入 Excel
    // $objPHPExcel = PHPExcel_IOFactory::load($excelTemplate);
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'A'.(35+($pages-1)*33), $title)
                ->setCellValue( 'AH'.(36+($pages-1)*33), str_replace("-", "", $script_number))
                ->setCellValue( 'C'.(37+($pages-1)*33), $owner_data[0]["name"].$owner_text)
                ->setCellValue( 'G'.(37+($pages-1)*33), $owner_data[0]["pId"])
                ->setCellValue( 'L'.(37+($pages-1)*33), $owner_data[0]["current_address"])
                ->setCellValue( 'X'.(37+($pages-1)*33), $owner_data[0]["telephone"]."\n".$owner_data[0]["cellphone"])
                ->setCellValue( 'AE'.(37+($pages-1)*33), $legal_text)
                ->setCellValue( 'C'.(38+($pages-1)*33), $land_owner_data[0]["name"].$land_owner_text)
                ->setCellValue( 'G'.(38+($pages-1)*33), $landPIdText)
                ->setCellValue( 'L'.(38+($pages-1)*33), $land_owner_data[0]["current_address"])
                ->setCellValue( 'X'.(38+($pages-1)*33), $land_owner_data[0]["telephone"]."\n".$land_owner_data[0]["cellphone"])
                ->setCellValue( 'AE'.(38+($pages-1)*33), $document_text)
                ->setCellValue( 'C'.(39+($pages-1)*33), $building_data[0]["real_address"])
                ->setCellValue( 'O'.(39+($pages-1)*33), $building_data[0]["tax_number"])
                ->setCellValue( 'X'.(39+($pages-1)*33), $land_data[0]["land_use"])
                ->setCellValue( 'AE'.(39+($pages-1)*33), $rent_text)
                ->setCellValue( 'C'.(40+($pages-1)*33), '桃園市')
                ->setCellValue( 'E'.(40+($pages-1)*33), $land_data[0]["dist"])
                ->setCellValue( 'G'.(40+($pages-1)*33), $land_section)
                ->setCellValue( 'K'.(40+($pages-1)*33), $land_number)
                ->setCellValue( 'X'.(40+($pages-1)*33), $total_land_area)
                ->setCellValue( 'AE'.(40+($pages-1)*33), $building_data[0]["remove_condition"]);
    for($i=0;$i<count($owner_data);$i++){
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'E'.(41+($pages-1)*33+$i*2), $owner_data[$i]["name"])
                    ->setCellValue( 'K'.(41+($pages-1)*33+$i*2), $owner_data[$i]["current_address"])
                    ->setCellValue( 'K'.(42+($pages-1)*33+$i*2), $owner_data[$i]["telephone"])
                    ->setCellValue( 'U'.(42+($pages-1)*33+$i*2), $owner_data[$i]["cellphone"])
                    ->setCellValue( 'AA'.(42+($pages-1)*33+$i*2), $owner_data[$i]["hold_numerator"]."/".$owner_data[$i]["hold_denominator"].$owner_data[$i]["hold_status"])
                    ->setCellValue( 'AG'.(41+($pages-1)*33+$i*2), $owner_data[$i]["pId"]);
        // if($holdRatioMod > 0){
        //     $objPHPExcel->setActiveSheetIndex(0)
        //             ->setCellValue( 'AG'.(69+$i*2), number_format(floor($total_pay*$owner_data[$i]["own_ratio"])+1,0,".",","));
        //     $holdRatioMod--;
        // }
        // else{
        //     $objPHPExcel->setActiveSheetIndex(0)
        //             ->setCellValue( 'AG'.(69+$i*2), number_format(floor($total_pay*$owner_data[$i]["own_ratio"]),0,".",","));
        // }
        $own_ratio = $owner_data[$i]["hold_numerator"] / $owner_data[$i]["hold_denominator"];
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( 'AG'.(42+($pages-1)*33+$i*2), number_format(floor($total_pay*$own_ratio),0,".",","));
        // $remainder = $remainder - number_format(floor($total_pay*$owner_data[$i]["own_ratio"]),0,".",",");
        $remainder = $remainder - floor($total_pay*$own_ratio);
    }
    echo "餘額: ".$remainder."<br>";
    for($i=0;$i<count($owner_data);$i++){
        if($remainder>0){
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue( 'AG'.(42+($pages-1)*33+$i*2), number_format(floor($total_pay*$own_ratio)+1,0,".",","));
            $remainder--;
        }
    }
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'C'.(71+($pages-1)*33), ($survey_date_split[0]-1911)." 年 ".$survey_date_split[1]." 月 ".$survey_date_split[2]." 日");

    // $objActSheet = $objPHPExcel->getActiveSheet();
    // $objActSheet->setTitle(str_replace("-", "", $script_number));
    // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    // if($saveType[0] == "建合"){
    //     $savePath = "file/building/legal/".$saveType[1]."/";
    // }
    // else{
    //     $savePath = "file/building/illegal/".$saveType[1]."/";
    // }

    // if(!file_exists($savePath)){
    //     mkdir($savePath);
    // }

    // $fileNo = $script_number."-2";
    // $filename = base64_encode($fileNo);
    // $file_type = ".xls";
    // echo $savePath;
    // $objWriter->save($savePath.$filename.$file_type);
    // insertFileData($script_number,$savePath,$fileNo,$filename,$file_type,"file_table");
}
?>
