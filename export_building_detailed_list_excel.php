<?php
// include "library.php";

function exportBuildingDetail(){
    error_reporting(E_ALL);
    // ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br>');
    date_default_timezone_set('Europe/London');
    
    require_once 'classes/PHPExcel.php';
    require_once 'classes/PHPExcel/Writer/Excel5.php';
    $objPHPExcel  = new PHPExcel();
    
    // 自行建立的 Excel 版型檔名
    $excelTemplate = './excel_templates/building_detailed_list_template.xls';
    
    // 判斷 Excel 檔案是否存在
    if (!file_exists($excelTemplate)) {
        exit('Please run template.php first.' . EOL);
    }
    
    // 載入 Excel
    $objPHPExcel = PHPExcel_IOFactory::load($excelTemplate);
    // 輸出建合補償費
    $all_legal_record = getAllBuildingRecord("建合");
    $row_index = 5;
    $counter = 1;
    $total_all = 0;
    $activeSheetIndex = 0;
    $objPHPExcel->setActiveSheetIndex($activeSheetIndex);
    // $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, 2);

    for($i=0;$i<count($all_legal_record);$i++){
        $owner_data = getOwnerData($all_legal_record[$i]["rId"]);
        $land_owner_data = getLandOwnerData($all_legal_record[$i]["rId"]);
        $land_data = getLandData($all_legal_record[$i]["rId"]);
        $main_building_data = getMainBuildingData($all_legal_record[$i]["rId"]);
        $building_data = getBuildingData($all_legal_record[$i]["rId"]);
        $sub_building_data = getAllSubbuildingData($all_legal_record[$i]["rId"]);
        if(empty($main_building_data) && empty($sub_building_data)){
            // echo $all_legal_record[$i]["rId"]." : ".gettype($main_building_data)."<br>";
            continue;
        }

        if(empty($main_building_data)){
            $main_building_count = 0;
        }
        else{
            $main_building_count = count($main_building_data);
        }

        if(empty($sub_building_data)){
            $sub_building_count = 0;
        }
        else{
            $sub_building_count = count($sub_building_data);
        }
        $row_count = max($main_building_count+$sub_building_count,count($owner_data));
            
        $pay_index = [];
    
        // 地段地號
        $land_number = [];
        $section_array = [];
        $subsection_array = [];
        $section_index = 0;
        $total_land_area = 0;
        $section_text = "";
        $subsection_text = "";
        $land_number_text = "";

        for($j=0;$j<count($land_data);$j++){
            $land_data[$j]["land_section"] = str_replace("段","",$land_data[$j]["land_section"]);
            if(!in_array($land_data[$j]["land_section"],$section_array)){
                $section_array[$section_index] = $land_data[$j]["land_section"];
                $subsection_array[$section_index] = $land_data[$j]["subsection"];
                $land_number[$section_index] = $land_data[$j]["land_number"];
                $key = $section_index;
                $section_index++;
            }
            else{
                $key = array_search($land_data[$j]["land_section"], $section_array);
                $land_number[$key] = $land_number[$key]."、";
                $land_number[$key] = $land_number[$key].$land_data[$j]["land_number"];
            }
        }

        for($j=0;$j<count($section_array);$j++){
            $section_text = $section_text.$section_array[$j];
            if($j != count($section_array)-1){
                $section_text = $section_text."、";
            }
        }

        for($j=0;$j<count($subsection_array);$j++){
            $subsection_text = $subsection_text.$subsection_array[$j];
            if($j != count($subsection_array)-1){
                $subsection_text = $subsection_text."、";
            }
        }

        for($j=0;$j<count($land_data);$j++){
            $land_number_text = $land_number_text.$land_data[$j]["land_number"];
            if($j != count($land_data)-1){
                $land_number_text = $land_number_text."、";
            }
        }

        for($j=0;$j<count($owner_data);$j++){
            // 身份證字號空值不顯示
            if(substr($owner_data[$j]["pId"],0,2) == "NA"){
                $owner_data[$j]["pId"] = "";
            }
            if($owner_data[$j]["hold_status"] != "公同共有"){
                $owner_data[$j]["hold_status"] = "";
            }
        }
        
        $owner_index = $row_index;
        $start_index = $row_index;
        $record_total_price = 0;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, $row_count);

        if(!empty($main_building_data)){
            for($j=0;$j<count($main_building_data);$j++){
                $decoration_data = getAllBuildingDecorationData($main_building_data[$j]["address"],$main_building_data[$j]["f_order"]);
                $total_points = getTotalPoints($main_building_data[$j]["layer_height"],$decoration_data);
                $price = round($total_points*$main_building_data[$j]["floor_area"]*12);
                $record_total_price += $price;
                $add_minus_wall_text = "";

                for($k=0;$k<count($decoration_data);$k++){
                    if($decoration_data[$k]["category"]=="加減牆" && $decoration_data[$k]["item_type"] == "減牆"){
                        if($decoration_data[$k]["ratio"] == 2){
                            $add_minus_wall_text = $add_minus_wall_text."-1/2".$decoration_data[$k]["item_name"];
                        }
                        else{
                            $add_minus_wall_text = $add_minus_wall_text."-".$decoration_data[$k]["ratio"]."/4".$decoration_data[$k]["item_name"];
                        }
                    }
                    else if($decoration_data[$k]["category"]=="加減牆" && $decoration_data[$k]["item_type"] == "加牆"){
                        if($decoration_data[$k]["ratio"] == 2){
                            $add_minus_wall_text = $add_minus_wall_text."+1/2".$decoration_data[$k]["item_name"];
                        }
                        else{
                            $add_minus_wall_text = $add_minus_wall_text."+".$decoration_data[$k]["ratio"]."/4".$decoration_data[$k]["item_name"];
                        }
                    }
                }

                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'G'.$row_index, $main_building_data[$j]["structure"].$main_building_data[$j]["floor_type"].$add_minus_wall_text)
                    ->setCellValue( 'H'.$row_index, $main_building_data[$j]["nth_floor"]."/".$main_building_data[$j]["total_floor"])
                    ->setCellValue( 'I'.$row_index, $main_building_data[$j]["use_type"])
                    ->setCellValue( 'J'.$row_index, $main_building_data[$j]["floor_area"])
                    ->setCellValue( 'K'.$row_index, "㎡")
                    ->setCellValue( 'L'.$row_index, number_format($price,0,".",","));
                $row_index++;
            }
        }

        if(!empty($sub_building_data)){
            for($j=0;$j<count($sub_building_data);$j++){
                if($sub_building_data[$j]["application"] == "遷移費部份"){
                    $sub_building_data[$j]["application"] = "";
                }

                if($sub_building_data[$j]["application"] == "圍牆"){
                    $sub_building_data[$j]["application"] = "";
                    $sub_building_data[$j]["item_name"] = getFenceItemName($sub_building_data[$j]);
                    $sub_building_data[$j]["unitprice"] = getFencePrice($sub_building_data[$j]);
                }

                if($sub_building_data[$j]["note"] != "合法" && $sub_building_data[$j]["note"] != "非法"){
                    $sub_building_data[$j]["note"] = "合法";
                }

                $price = round($sub_building_data[$j]["unitprice"]*round($sub_building_data[$j]["area"],2));
                if($sub_building_data[$j]["note"] == "非法"){
                    $price = round($price*0.6);
                }

                $record_total_price += $price;

                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'G'.$row_index, $sub_building_data[$j]["item_name"])
                    ->setCellValue( 'I'.$row_index, $sub_building_data[$j]["application"])
                    ->setCellValue( 'J'.$row_index, $sub_building_data[$j]["area"])
                    ->setCellValue( 'K'.$row_index, $sub_building_data[$j]["unit"])
                    ->setCellValue( 'L'.$row_index, number_format($price,0,".",","));
                $row_index++;
            }
        }
        $total_all += $record_total_price;

        for($j=0;$j<count($owner_data);$j++){
            $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                ->setCellValue( 'M'.$owner_index, $owner_data[$j]["hold_id"])
                ->setCellValue( 'N'.$owner_index, $owner_data[$j]["name"])
                ->setCellValue( 'O'.$owner_index, $owner_data[$j]["pId"])
                ->setCellValue( 'P'.$owner_index, $owner_data[$j]["hold_status"].$owner_data[$j]["hold_numerator"]."/".$owner_data[$j]["hold_denominator"])
                ->setCellValue( 'R'.$owner_index, $owner_data[$j]["current_address"])
                ->setCellValue( 'S'.$owner_index, $all_legal_record[$i]["rId"]);
            $owner_index++;
        }
        if(count($owner_data)>$main_building_count+$sub_building_count){
            $row_index += (count($owner_data) - $main_building_count - $sub_building_count);
        }
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, 1);
        $objPHPExcel->getActiveSheet()->mergeCells('G'.$row_index.':'.'K'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
            ->setCellValue( 'G'.$row_index, "合計(元)")
            ->setCellValue( 'L'.$row_index, number_format($record_total_price,0,".",","));
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$start_index.':'.'A'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'A'.$start_index, $counter);
        $objPHPExcel->getActiveSheet()->mergeCells('B'.$start_index.':'.'B'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'B'.$start_index, $land_data[0]["dist"]);
        $objPHPExcel->getActiveSheet()->mergeCells('C'.$start_index.':'.'C'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'C'.$start_index, $section_text);
        $objPHPExcel->getActiveSheet()->mergeCells('D'.$start_index.':'.'D'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'D'.$start_index, $subsection_text);
        $objPHPExcel->getActiveSheet()->mergeCells('E'.$start_index.':'.'E'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'E'.$start_index, $land_number_text);
        $objPHPExcel->getActiveSheet()->mergeCells('F'.$start_index.':'.'F'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'F'.$start_index, $building_data[0]["real_address"]);
        $row_index++;
        $counter++;
        
        // 持分金額計算
        $remainder = $record_total_price;
        $temp_index = $start_index;
    
        for($j=0;$j<count($owner_data);$j++){
            $hold_ratio = $owner_data[$j]["hold_numerator"] / $owner_data[$j]["hold_denominator"];
            $remainder -= floor($record_total_price*$hold_ratio);

            $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'Q'.$start_index, number_format(floor($record_total_price*$hold_ratio),0,".",","));

            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
            $start_index++;
        }

        $start_index = $temp_index;
        // 紀錄補償費剩餘金額分配給誰，自拆費剩餘金額須分給沒拿過的人
        $remainder_index = 0;
        for($j=0;$j<count($owner_data);$j++){
            $hold_ratio = $owner_data[$j]["hold_numerator"] / $owner_data[$j]["hold_denominator"];

            if($remainder>0){
                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'Q'.$start_index, number_format(floor($record_total_price*$hold_ratio)+1,0,".",","));
                $remainder--;
                $remainder_index++;
            }

            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
            $start_index++;
        }
    }

    // 輸出建合自拆獎勵金
    $row_index = 5;
    $counter = 1;
    $total_all = 0;
    $activeSheetIndex = 1;
    $objPHPExcel->setActiveSheetIndex($activeSheetIndex);

    for($i=0;$i<count($all_legal_record);$i++){
        $owner_data = getOwnerData($all_legal_record[$i]["rId"]);
        $land_owner_data = getLandOwnerData($all_legal_record[$i]["rId"]);
        $land_data = getLandData($all_legal_record[$i]["rId"]);
        $main_building_data = getMainBuildingData($all_legal_record[$i]["rId"]);
        $building_data = getBuildingData($all_legal_record[$i]["rId"]);
        $sub_building_data = getAllSubbuildingData($all_legal_record[$i]["rId"]);
        if(empty($main_building_data) && empty($sub_building_data)){
            // echo $all_legal_record[$i]["rId"]." : ".gettype($main_building_data)."<br>";
            continue;
        }

        if(empty($main_building_data)){
            $main_building_count = 0;
        }
        else{
            $main_building_count = count($main_building_data);
        }

        if(empty($sub_building_data)){
            $sub_building_count = 0;
        }
        else{
            $sub_building_count = count($sub_building_data);
        }
        $row_count = max($main_building_count+$sub_building_count,count($owner_data));
            
        $pay_index = [];
    
        // 地段地號
        $land_number = [];
        $section_array = [];
        $subsection_array = [];
        $section_index = 0;
        $total_land_area = 0;
        $section_text = "";
        $subsection_text = "";
        $land_number_text = "";

        for($j=0;$j<count($land_data);$j++){
            $land_data[$j]["land_section"] = str_replace("段","",$land_data[$j]["land_section"]);
            if(!in_array($land_data[$j]["land_section"],$section_array)){
                $section_array[$section_index] = $land_data[$j]["land_section"];
                $subsection_array[$section_index] = $land_data[$j]["subsection"];
                $land_number[$section_index] = $land_data[$j]["land_number"];
                $key = $section_index;
                $section_index++;
            }
            else{
                $key = array_search($land_data[$j]["land_section"], $section_array);
                $land_number[$key] = $land_number[$key]."、";
                $land_number[$key] = $land_number[$key].$land_data[$j]["land_number"];
            }
        }

        for($j=0;$j<count($section_array);$j++){
            $section_text = $section_text.$section_array[$j];
            if($j != count($section_array)-1){
                $section_text = $section_text."、";
            }
        }

        for($j=0;$j<count($subsection_array);$j++){
            $subsection_text = $subsection_text.$subsection_array[$j];
            if($j != count($subsection_array)-1){
                $subsection_text = $subsection_text."、";
            }
        }

        for($j=0;$j<count($land_data);$j++){
            $land_number_text = $land_number_text.$land_data[$j]["land_number"];
            if($j != count($land_data)-1){
                $land_number_text = $land_number_text."、";
            }
        }

        for($j=0;$j<count($owner_data);$j++){
            // 身份證字號空值不顯示
            if(substr($owner_data[$j]["pId"],0,2) == "NA"){
                $owner_data[$j]["pId"] = "";
            }
            if($owner_data[$j]["hold_status"] != "公同共有"){
                $owner_data[$j]["hold_status"] = "";
            }
        }
        
        $owner_index = $row_index;
        $start_index = $row_index;
        $record_total_price = 0;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, $row_count);

        if(!empty($main_building_data)){
            for($j=0;$j<count($main_building_data);$j++){
                $decoration_data = getAllBuildingDecorationData($main_building_data[$j]["address"],$main_building_data[$j]["f_order"]);
                $total_points = getTotalPoints($main_building_data[$j]["layer_height"],$decoration_data);
                $price = round($total_points*$main_building_data[$j]["floor_area"]*12);
                $price = round($price*0.5);
                $record_total_price += $price;
                $add_minus_wall_text = "";

                for($k=0;$k<count($decoration_data);$k++){
                    if($decoration_data[$k]["category"]=="加減牆" && $decoration_data[$k]["item_type"] == "減牆"){
                        if($decoration_data[$k]["ratio"] == 2){
                            $add_minus_wall_text = $add_minus_wall_text."-1/2".$decoration_data[$k]["item_name"];
                        }
                        else{
                            $add_minus_wall_text = $add_minus_wall_text."-".$decoration_data[$k]["ratio"]."/4".$decoration_data[$k]["item_name"];
                        }
                    }
                    else if($decoration_data[$k]["category"]=="加減牆" && $decoration_data[$k]["item_type"] == "加牆"){
                        if($decoration_data[$k]["ratio"] == 2){
                            $add_minus_wall_text = $add_minus_wall_text."+1/2".$decoration_data[$k]["item_name"];
                        }
                        else{
                            $add_minus_wall_text = $add_minus_wall_text."+".$decoration_data[$k]["ratio"]."/4".$decoration_data[$k]["item_name"];
                        }
                    }
                }

                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'G'.$row_index, $main_building_data[$j]["structure"].$main_building_data[$j]["floor_type"].$add_minus_wall_text)
                    ->setCellValue( 'H'.$row_index, $main_building_data[$j]["nth_floor"]."/".$main_building_data[$j]["total_floor"])
                    ->setCellValue( 'I'.$row_index, $main_building_data[$j]["use_type"])
                    ->setCellValue( 'J'.$row_index, $main_building_data[$j]["floor_area"])
                    ->setCellValue( 'K'.$row_index, "㎡")
                    ->setCellValue( 'L'.$row_index, number_format($price,0,".",","));
                $row_index++;
            }
        }

        if(!empty($sub_building_data)){
            for($j=0;$j<count($sub_building_data);$j++){
                if($sub_building_data[$j]["application"] == "遷移費部份"){
                    $sub_building_data[$j]["application"] = "";
                }

                if($sub_building_data[$j]["application"] == "圍牆"){
                    $sub_building_data[$j]["application"] = "";
                    $sub_building_data[$j]["item_name"] = getFenceItemName($sub_building_data[$j]);
                    $sub_building_data[$j]["unitprice"] = getFencePrice($sub_building_data[$j]);
                }

                if($sub_building_data[$j]["note"] != "合法" && $sub_building_data[$j]["note"] != "非法"){
                    $sub_building_data[$j]["note"] = "合法";
                }

                if($sub_building_data[$j]["auto_remove"]=="是"){
                    $price = round($sub_building_data[$j]["unitprice"]*round($sub_building_data[$j]["area"],2));
                    if($sub_building_data[$j]["note"] == "合法"){
                        $price = round($price*0.5);
                    }
                    else{
                        $price = round(round($price*0.6)*0.5);
                    }
                }
                else{
                    $price = 0;
                }
                $record_total_price += $price;

                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'G'.$row_index, $sub_building_data[$j]["item_name"])
                    ->setCellValue( 'I'.$row_index, $sub_building_data[$j]["application"])
                    ->setCellValue( 'J'.$row_index, $sub_building_data[$j]["area"])
                    ->setCellValue( 'K'.$row_index, $sub_building_data[$j]["unit"])
                    ->setCellValue( 'L'.$row_index, number_format($price,0,".",","));
                $row_index++;
            }
        }
        $total_all += $record_total_price;

        for($j=0;$j<count($owner_data);$j++){
            $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                ->setCellValue( 'M'.$owner_index, $owner_data[$j]["hold_id"])
                ->setCellValue( 'N'.$owner_index, $owner_data[$j]["name"])
                ->setCellValue( 'O'.$owner_index, $owner_data[$j]["pId"])
                ->setCellValue( 'P'.$owner_index, $owner_data[$j]["hold_status"].$owner_data[$j]["hold_numerator"]."/".$owner_data[$j]["hold_denominator"])
                ->setCellValue( 'R'.$owner_index, $owner_data[$j]["current_address"])
                ->setCellValue( 'S'.$owner_index, $all_legal_record[$i]["rId"]);
            $owner_index++;
        }
        if(count($owner_data)>$main_building_count+$sub_building_count){
            $row_index += (count($owner_data) - $main_building_count - $sub_building_count);
        }
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, 1);
        $objPHPExcel->getActiveSheet()->mergeCells('G'.$row_index.':'.'K'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
            ->setCellValue( 'G'.$row_index, "合計(元)")
            ->setCellValue( 'L'.$row_index, number_format($record_total_price,0,".",","));
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$start_index.':'.'A'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'A'.$start_index, $counter);
        $objPHPExcel->getActiveSheet()->mergeCells('B'.$start_index.':'.'B'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'B'.$start_index, $land_data[0]["dist"]);
        $objPHPExcel->getActiveSheet()->mergeCells('C'.$start_index.':'.'C'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'C'.$start_index, $section_text);
        $objPHPExcel->getActiveSheet()->mergeCells('D'.$start_index.':'.'D'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'D'.$start_index, $subsection_text);
        $objPHPExcel->getActiveSheet()->mergeCells('E'.$start_index.':'.'E'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'E'.$start_index, $land_number_text);
        $objPHPExcel->getActiveSheet()->mergeCells('F'.$start_index.':'.'F'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'F'.$start_index, $building_data[0]["real_address"]);
        $row_index++;
        $counter++;
        
        // 持分金額計算
        $remainder = $record_total_price;
        $temp_index = $start_index;
    
        for($j=0;$j<count($owner_data);$j++){
            $hold_ratio = $owner_data[$j]["hold_numerator"] / $owner_data[$j]["hold_denominator"];
            $remainder -= floor($record_total_price*$hold_ratio);

            $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'Q'.$start_index, number_format(floor($record_total_price*$hold_ratio),0,".",","));

            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
            $start_index++;
        }

        $start_index = $temp_index;
        
        // 從沒拿過補償費剩餘金額的人開始分自拆費剩餘金額
        for($j=$remainder_index;$j<count($owner_data);$j++){
            $hold_ratio = $owner_data[$j]["hold_numerator"] / $owner_data[$j]["hold_denominator"];

            if($remainder>0){
                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'Q'.($start_index+$j), number_format(floor($record_total_price*$hold_ratio)+1,0,".",","));
                $remainder--;
            }

            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
        }

        for($j=0;$j<$remainder_index;$j++){
            $hold_ratio = $owner_data[$j]["hold_numerator"] / $owner_data[$j]["hold_denominator"];

            if($remainder>0){
                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'Q'.($start_index+$j), number_format(floor($record_total_price*$hold_ratio)+1,0,".",","));
                $remainder--;
            }

            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
        }
    }

    // 輸出建非補償費
    $all_legal_record = getAllBuildingRecord("建非");
    $row_index = 5;
    $counter = 1;
    $total_all = 0;
    $activeSheetIndex = 2;
    $objPHPExcel->setActiveSheetIndex($activeSheetIndex);
    // $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, 2);

    for($i=0;$i<count($all_legal_record);$i++){
        $owner_data = getOwnerData($all_legal_record[$i]["rId"]);
        $land_owner_data = getLandOwnerData($all_legal_record[$i]["rId"]);
        $land_data = getLandData($all_legal_record[$i]["rId"]);
        $main_building_data = getMainBuildingData($all_legal_record[$i]["rId"]);
        $building_data = getBuildingData($all_legal_record[$i]["rId"]);
        $sub_building_data = getAllSubbuildingData($all_legal_record[$i]["rId"]);
        if(empty($main_building_data) && empty($sub_building_data)){
            // echo $all_legal_record[$i]["rId"]." : ".gettype($main_building_data)."<br>";
            continue;
        }

        if(empty($main_building_data)){
            $main_building_count = 0;
        }
        else{
            $main_building_count = count($main_building_data);
        }

        if(empty($sub_building_data)){
            $sub_building_count = 0;
        }
        else{
            $sub_building_count = count($sub_building_data);
        }
        $row_count = max($main_building_count+$sub_building_count,count($owner_data));
            
        $pay_index = [];
    
        // 地段地號
        $land_number = [];
        $section_array = [];
        $subsection_array = [];
        $section_index = 0;
        $total_land_area = 0;
        $section_text = "";
        $subsection_text = "";
        $land_number_text = "";

        for($j=0;$j<count($land_data);$j++){
            $land_data[$j]["land_section"] = str_replace("段","",$land_data[$j]["land_section"]);
            if(!in_array($land_data[$j]["land_section"],$section_array)){
                $section_array[$section_index] = $land_data[$j]["land_section"];
                $subsection_array[$section_index] = $land_data[$j]["subsection"];
                $land_number[$section_index] = $land_data[$j]["land_number"];
                $key = $section_index;
                $section_index++;
            }
            else{
                $key = array_search($land_data[$j]["land_section"], $section_array);
                $land_number[$key] = $land_number[$key]."、";
                $land_number[$key] = $land_number[$key].$land_data[$j]["land_number"];
            }
        }

        for($j=0;$j<count($section_array);$j++){
            $section_text = $section_text.$section_array[$j];
            if($j != count($section_array)-1){
                $section_text = $section_text."、";
            }
        }

        for($j=0;$j<count($subsection_array);$j++){
            $subsection_text = $subsection_text.$subsection_array[$j];
            if($j != count($subsection_array)-1){
                $subsection_text = $subsection_text."、";
            }
        }

        for($j=0;$j<count($land_data);$j++){
            $land_number_text = $land_number_text.$land_data[$j]["land_number"];
            if($j != count($land_data)-1){
                $land_number_text = $land_number_text."、";
            }
        }

        for($j=0;$j<count($owner_data);$j++){
            // 身份證字號空值不顯示
            if(substr($owner_data[$j]["pId"],0,2) == "NA"){
                $owner_data[$j]["pId"] = "";
            }
            if($owner_data[$j]["hold_status"] != "公同共有"){
                $owner_data[$j]["hold_status"] = "";
            }
        }
        
        $owner_index = $row_index;
        $start_index = $row_index;
        $record_total_price = 0;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, $row_count);

        if(!empty($main_building_data)){
            for($j=0;$j<count($main_building_data);$j++){
                $decoration_data = getAllBuildingDecorationData($main_building_data[$j]["address"],$main_building_data[$j]["f_order"]);
                $total_points = getTotalPoints($main_building_data[$j]["layer_height"],$decoration_data);
                $price = round($total_points*$main_building_data[$j]["floor_area"]*12);
                $price = round($price*0.6);
                $record_total_price += $price;
                $add_minus_wall_text = "";

                for($k=0;$k<count($decoration_data);$k++){
                    if($decoration_data[$k]["category"]=="加減牆" && $decoration_data[$k]["item_type"] == "減牆"){
                        if($decoration_data[$k]["ratio"] == 2){
                            $add_minus_wall_text = $add_minus_wall_text."-1/2".$decoration_data[$k]["item_name"];
                        }
                        else{
                            $add_minus_wall_text = $add_minus_wall_text."-".$decoration_data[$k]["ratio"]."/4".$decoration_data[$k]["item_name"];
                        }
                    }
                    else if($decoration_data[$k]["category"]=="加減牆" && $decoration_data[$k]["item_type"] == "加牆"){
                        if($decoration_data[$k]["ratio"] == 2){
                            $add_minus_wall_text = $add_minus_wall_text."+1/2".$decoration_data[$k]["item_name"];
                        }
                        else{
                            $add_minus_wall_text = $add_minus_wall_text."+".$decoration_data[$k]["ratio"]."/4".$decoration_data[$k]["item_name"];
                        }
                    }
                }

                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'G'.$row_index, $main_building_data[$j]["structure"].$main_building_data[$j]["floor_type"].$add_minus_wall_text)
                    ->setCellValue( 'H'.$row_index, $main_building_data[$j]["nth_floor"]."/".$main_building_data[$j]["total_floor"])
                    ->setCellValue( 'I'.$row_index, $main_building_data[$j]["use_type"])
                    ->setCellValue( 'J'.$row_index, $main_building_data[$j]["floor_area"])
                    ->setCellValue( 'K'.$row_index, "㎡")
                    ->setCellValue( 'L'.$row_index, number_format($price,0,".",","));
                $row_index++;
            }
        }

        if(!empty($sub_building_data)){
            for($j=0;$j<count($sub_building_data);$j++){
                if($sub_building_data[$j]["application"] == "遷移費部份"){
                    $sub_building_data[$j]["application"] = "";
                }

                if($sub_building_data[$j]["application"] == "圍牆"){
                    $sub_building_data[$j]["application"] = "";
                    $sub_building_data[$j]["item_name"] = getFenceItemName($sub_building_data[$j]);
                    $sub_building_data[$j]["unitprice"] = getFencePrice($sub_building_data[$j]);
                }

                if($sub_building_data[$j]["note"] != "合法" && $sub_building_data[$j]["note"] != "非法"){
                    $sub_building_data[$j]["note"] = "非法";
                }

                $price = round($sub_building_data[$j]["unitprice"]*round($sub_building_data[$j]["area"],2));
                if($sub_building_data[$j]["note"] == "非法"){
                    $price = round($price*0.6);
                }

                $record_total_price += $price;

                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'G'.$row_index, $sub_building_data[$j]["item_name"])
                    ->setCellValue( 'I'.$row_index, $sub_building_data[$j]["application"])
                    ->setCellValue( 'J'.$row_index, $sub_building_data[$j]["area"])
                    ->setCellValue( 'K'.$row_index, $sub_building_data[$j]["unit"])
                    ->setCellValue( 'L'.$row_index, number_format($price,0,".",","));
                $row_index++;
            }
        }
        $total_all += $record_total_price;

        for($j=0;$j<count($owner_data);$j++){
            $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                ->setCellValue( 'M'.$owner_index, $owner_data[$j]["hold_id"])
                ->setCellValue( 'N'.$owner_index, $owner_data[$j]["name"])
                ->setCellValue( 'O'.$owner_index, $owner_data[$j]["pId"])
                ->setCellValue( 'P'.$owner_index, $owner_data[$j]["hold_status"].$owner_data[$j]["hold_numerator"]."/".$owner_data[$j]["hold_denominator"])
                ->setCellValue( 'R'.$owner_index, $owner_data[$j]["current_address"])
                ->setCellValue( 'S'.$owner_index, $all_legal_record[$i]["rId"]);
            $owner_index++;
        }
        if(count($owner_data)>$main_building_count+$sub_building_count){
            $row_index += (count($owner_data) - $main_building_count - $sub_building_count);
        }
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, 1);
        $objPHPExcel->getActiveSheet()->mergeCells('G'.$row_index.':'.'K'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
            ->setCellValue( 'G'.$row_index, "合計(元)")
            ->setCellValue( 'L'.$row_index, number_format($record_total_price,0,".",","));
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$start_index.':'.'A'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'A'.$start_index, $counter);
        $objPHPExcel->getActiveSheet()->mergeCells('B'.$start_index.':'.'B'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'B'.$start_index, $land_data[0]["dist"]);
        $objPHPExcel->getActiveSheet()->mergeCells('C'.$start_index.':'.'C'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'C'.$start_index, $section_text);
        $objPHPExcel->getActiveSheet()->mergeCells('D'.$start_index.':'.'D'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'D'.$start_index, $subsection_text);
        $objPHPExcel->getActiveSheet()->mergeCells('E'.$start_index.':'.'E'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'E'.$start_index, $land_number_text);
        $objPHPExcel->getActiveSheet()->mergeCells('F'.$start_index.':'.'F'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'F'.$start_index, $building_data[0]["real_address"]);
        $row_index++;
        $counter++;
        
        // 持分金額計算
        $remainder = $record_total_price;
        $temp_index = $start_index;
    
        for($j=0;$j<count($owner_data);$j++){
            $hold_ratio = $owner_data[$j]["hold_numerator"] / $owner_data[$j]["hold_denominator"];
            $remainder -= floor($record_total_price*$hold_ratio);

            $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'Q'.$start_index, number_format(floor($record_total_price*$hold_ratio),0,".",","));

            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
            $start_index++;
        }

        $start_index = $temp_index;
        // 紀錄補償費剩餘金額分配給誰，自拆費剩餘金額須分給沒拿過的人
        $remainder_index = 0;
        for($j=0;$j<count($owner_data);$j++){
            $hold_ratio = $owner_data[$j]["hold_numerator"] / $owner_data[$j]["hold_denominator"];

            if($remainder>0){
                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'Q'.$start_index, number_format(floor($record_total_price*$hold_ratio)+1,0,".",","));
                $remainder--;
                $remainder_index++;
            }

            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
            $start_index++;
        }
    }

    // 輸出建非自拆獎勵金
    $row_index = 5;
    $counter = 1;
    $total_all = 0;
    $activeSheetIndex = 3;
    $objPHPExcel->setActiveSheetIndex($activeSheetIndex);

    for($i=0;$i<count($all_legal_record);$i++){
        $owner_data = getOwnerData($all_legal_record[$i]["rId"]);
        $land_owner_data = getLandOwnerData($all_legal_record[$i]["rId"]);
        $land_data = getLandData($all_legal_record[$i]["rId"]);
        $main_building_data = getMainBuildingData($all_legal_record[$i]["rId"]);
        $building_data = getBuildingData($all_legal_record[$i]["rId"]);
        $sub_building_data = getAllSubbuildingData($all_legal_record[$i]["rId"]);
        if(empty($main_building_data) && empty($sub_building_data)){
            // echo $all_legal_record[$i]["rId"]." : ".gettype($main_building_data)."<br>";
            continue;
        }

        if(empty($main_building_data)){
            $main_building_count = 0;
        }
        else{
            $main_building_count = count($main_building_data);
        }

        if(empty($sub_building_data)){
            $sub_building_count = 0;
        }
        else{
            $sub_building_count = count($sub_building_data);
        }
        $row_count = max($main_building_count+$sub_building_count,count($owner_data));
            
        $pay_index = [];
    
        // 地段地號
        $land_number = [];
        $section_array = [];
        $subsection_array = [];
        $section_index = 0;
        $total_land_area = 0;
        $section_text = "";
        $subsection_text = "";
        $land_number_text = "";

        for($j=0;$j<count($land_data);$j++){
            $land_data[$j]["land_section"] = str_replace("段","",$land_data[$j]["land_section"]);
            if(!in_array($land_data[$j]["land_section"],$section_array)){
                $section_array[$section_index] = $land_data[$j]["land_section"];
                $subsection_array[$section_index] = $land_data[$j]["subsection"];
                $land_number[$section_index] = $land_data[$j]["land_number"];
                $key = $section_index;
                $section_index++;
            }
            else{
                $key = array_search($land_data[$j]["land_section"], $section_array);
                $land_number[$key] = $land_number[$key]."、";
                $land_number[$key] = $land_number[$key].$land_data[$j]["land_number"];
            }
        }

        for($j=0;$j<count($section_array);$j++){
            $section_text = $section_text.$section_array[$j];
            if($j != count($section_array)-1){
                $section_text = $section_text."、";
            }
        }

        for($j=0;$j<count($subsection_array);$j++){
            $subsection_text = $subsection_text.$subsection_array[$j];
            if($j != count($subsection_array)-1){
                $subsection_text = $subsection_text."、";
            }
        }

        for($j=0;$j<count($land_data);$j++){
            $land_number_text = $land_number_text.$land_data[$j]["land_number"];
            if($j != count($land_data)-1){
                $land_number_text = $land_number_text."、";
            }
        }

        for($j=0;$j<count($owner_data);$j++){
            // 身份證字號空值不顯示
            if(substr($owner_data[$j]["pId"],0,2) == "NA"){
                $owner_data[$j]["pId"] = "";
            }
            if($owner_data[$j]["hold_status"] != "公同共有"){
                $owner_data[$j]["hold_status"] = "";
            }
        }
        
        $owner_index = $row_index;
        $start_index = $row_index;
        $record_total_price = 0;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, $row_count);

        if(!empty($main_building_data)){
            for($j=0;$j<count($main_building_data);$j++){
                $decoration_data = getAllBuildingDecorationData($main_building_data[$j]["address"],$main_building_data[$j]["f_order"]);
                $total_points = getTotalPoints($main_building_data[$j]["layer_height"],$decoration_data);
                $price = round($total_points*$main_building_data[$j]["floor_area"]*12);
                $price = round(round($price*0.6)*0.5);
                $record_total_price += $price;
                $add_minus_wall_text = "";

                for($k=0;$k<count($decoration_data);$k++){
                    if($decoration_data[$k]["category"]=="加減牆" && $decoration_data[$k]["item_type"] == "減牆"){
                        if($decoration_data[$k]["ratio"] == 2){
                            $add_minus_wall_text = $add_minus_wall_text."-1/2".$decoration_data[$k]["item_name"];
                        }
                        else{
                            $add_minus_wall_text = $add_minus_wall_text."-".$decoration_data[$k]["ratio"]."/4".$decoration_data[$k]["item_name"];
                        }
                    }
                    else if($decoration_data[$k]["category"]=="加減牆" && $decoration_data[$k]["item_type"] == "加牆"){
                        if($decoration_data[$k]["ratio"] == 2){
                            $add_minus_wall_text = $add_minus_wall_text."+1/2".$decoration_data[$k]["item_name"];
                        }
                        else{
                            $add_minus_wall_text = $add_minus_wall_text."+".$decoration_data[$k]["ratio"]."/4".$decoration_data[$k]["item_name"];
                        }
                    }
                }

                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'G'.$row_index, $main_building_data[$j]["structure"].$main_building_data[$j]["floor_type"].$add_minus_wall_text)
                    ->setCellValue( 'H'.$row_index, $main_building_data[$j]["nth_floor"]."/".$main_building_data[$j]["total_floor"])
                    ->setCellValue( 'I'.$row_index, $main_building_data[$j]["use_type"])
                    ->setCellValue( 'J'.$row_index, $main_building_data[$j]["floor_area"])
                    ->setCellValue( 'K'.$row_index, "㎡")
                    ->setCellValue( 'L'.$row_index, number_format($price,0,".",","));
                $row_index++;
            }
        }

        if(!empty($sub_building_data)){
            for($j=0;$j<count($sub_building_data);$j++){
                if($sub_building_data[$j]["application"] == "遷移費部份"){
                    $sub_building_data[$j]["application"] = "";
                }

                if($sub_building_data[$j]["application"] == "圍牆"){
                    $sub_building_data[$j]["application"] = "";
                    $sub_building_data[$j]["item_name"] = getFenceItemName($sub_building_data[$j]);
                    $sub_building_data[$j]["unitprice"] = getFencePrice($sub_building_data[$j]);
                }

                if($sub_building_data[$j]["note"] != "合法" && $sub_building_data[$j]["note"] != "非法"){
                    $sub_building_data[$j]["note"] = "非法";
                }

                if($sub_building_data[$j]["auto_remove"]=="是"){
                    $price = round($sub_building_data[$j]["unitprice"]*round($sub_building_data[$j]["area"],2));
                    if($sub_building_data[$j]["note"] == "合法"){
                        $price = round($price*0.5);
                    }
                    else{
                        $price = round(round($price*0.6)*0.5);
                    }
                }
                else{
                    $price = 0;
                }

                $record_total_price += $price;

                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'G'.$row_index, $sub_building_data[$j]["item_name"])
                    ->setCellValue( 'I'.$row_index, $sub_building_data[$j]["application"])
                    ->setCellValue( 'J'.$row_index, $sub_building_data[$j]["area"])
                    ->setCellValue( 'K'.$row_index, $sub_building_data[$j]["unit"])
                    ->setCellValue( 'L'.$row_index, number_format($price,0,".",","));
                $row_index++;
            }
        }
        $total_all += $record_total_price;

        for($j=0;$j<count($owner_data);$j++){
            $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                ->setCellValue( 'M'.$owner_index, $owner_data[$j]["hold_id"])
                ->setCellValue( 'N'.$owner_index, $owner_data[$j]["name"])
                ->setCellValue( 'O'.$owner_index, $owner_data[$j]["pId"])
                ->setCellValue( 'P'.$owner_index, $owner_data[$j]["hold_status"].$owner_data[$j]["hold_numerator"]."/".$owner_data[$j]["hold_denominator"])
                ->setCellValue( 'R'.$owner_index, $owner_data[$j]["current_address"])
                ->setCellValue( 'S'.$owner_index, $all_legal_record[$i]["rId"]);
            $owner_index++;
        }
        if(count($owner_data)>$main_building_count+$sub_building_count){
            $row_index += (count($owner_data) - $main_building_count - $sub_building_count);
        }
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_index, 1);
        $objPHPExcel->getActiveSheet()->mergeCells('G'.$row_index.':'.'K'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
            ->setCellValue( 'G'.$row_index, "合計(元)")
            ->setCellValue( 'L'.$row_index, number_format($record_total_price,0,".",","));
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$start_index.':'.'A'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'A'.$start_index, $counter);
        $objPHPExcel->getActiveSheet()->mergeCells('B'.$start_index.':'.'B'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'B'.$start_index, $land_data[0]["dist"]);
        $objPHPExcel->getActiveSheet()->mergeCells('C'.$start_index.':'.'C'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'C'.$start_index, $section_text);
        $objPHPExcel->getActiveSheet()->mergeCells('D'.$start_index.':'.'D'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'D'.$start_index, $subsection_text);
        $objPHPExcel->getActiveSheet()->mergeCells('E'.$start_index.':'.'E'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'E'.$start_index, $land_number_text);
        $objPHPExcel->getActiveSheet()->mergeCells('F'.$start_index.':'.'F'.$row_index);
        $objPHPExcel->setActiveSheetIndex($activeSheetIndex)->setCellValue( 'F'.$start_index, $building_data[0]["real_address"]);
        $row_index++;
        $counter++;
        
        // 持分金額計算
        $remainder = $record_total_price;
        $temp_index = $start_index;
    
        for($j=0;$j<count($owner_data);$j++){
            $hold_ratio = $owner_data[$j]["hold_numerator"] / $owner_data[$j]["hold_denominator"];
            $remainder -= floor($record_total_price*$hold_ratio);

            $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'Q'.$start_index, number_format(floor($record_total_price*$hold_ratio),0,".",","));

            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
            $start_index++;
        }

        $start_index = $temp_index;
        // 從沒拿過補償費剩餘金額的人開始分自拆費剩餘金額
        for($j=$remainder_index;$j<count($owner_data);$j++){
            $hold_ratio = $owner_data[$j]["hold_numerator"] / $owner_data[$j]["hold_denominator"];

            if($remainder>0){
                $objPHPExcel->setActiveSheetIndex($activeSheetIndex)
                    ->setCellValue( 'Q'.($start_index+$j), number_format(floor($record_total_price*$hold_ratio)+1,0,".",","));
                $remainder--;
            }

            echo "餘額 ".$j." : ".$remainder."<br>----------------------<br>";
            // $start_index++;
        }
    }

    // $total_all_text = number_format($total_all,0);
    // $objPHPExcel->getActiveSheet()->mergeCells('A'.$row_index.':'.'Q'.$row_index);
    // $objPHPExcel->setActiveSheetIndex(0)
    //             ->setCellValue( 'A'.$row_index, "總持分金額：".$total_all_text);
    
    // $objActSheet = $objPHPExcel->getActiveSheet();
    // $objActSheet->setTitle("農作物清冊");
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    
    $savePath = "file/book/";
    
    if(!file_exists($savePath)){
        mkdir($savePath);
    }
    
    $fileNo = "building_detail";
    // $filename = base64_encode($fileNo);
    $filename = "建物清冊";
    $file_type = ".xls";
    $objWriter->save($savePath.$filename.$file_type);
}

function getTotalPoints($layer_height,$decoration_data){
    $total_points = 0;

    for($i=0;$i<count($decoration_data);$i++){
        if($decoration_data[$i]["item_type"] == "減牆"){
            $total_points -= $decoration_data[$i]["ratio"]*$decoration_data[$i]["points"];
        }
        else{
            $total_points += $decoration_data[$i]["ratio"]*$decoration_data[$i]["points"];
        }   
    }

    if($layer_height<2.7){
        $extra_percent = -(2.7-round($layer_height,1))*10;
    }
    else if($layer_height>3.6){
        $extra_percent = (round($layer_height,1)-3.6)*10;
    }
    else{
        $extra_percent = 0;
    }

    return round($total_points/100*(100+$extra_percent),2);
}
?>