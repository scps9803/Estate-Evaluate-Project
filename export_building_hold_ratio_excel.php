<?php
function exportBuildingHoldRatioExcel($script_number,$owner_data,$land_owner_data,$building_data,$land_data){
    $objPHPExcel  = new PHPExcel();
    // 自行建立的 Excel 版型檔名
    $excelTemplate = './excel_templates/legal_building_hold_ratio_template.xls';

    // 判斷 Excel 檔案是否存在
    if (!file_exists($excelTemplate)) {
        exit('Please run template.php first.' . EOL);
    }

    // 載入 Excel
    $objPHPExcel = PHPExcel_IOFactory::load($excelTemplate);
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue( 'AH63', $script_number);

    $objActSheet = $objPHPExcel->getActiveSheet();
    $objActSheet->setTitle('default');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $saveType = explode("-",$script_number);
    if($saveType[0] == "建合"){
        $savePath = "file/building/legal/".substr($script_number,strlen($script_number)-3,strlen($script_number))."/";
    }
    else{
        $savePath = "file/building/illegal/".substr($script_number,strlen($script_number)-3,strlen($script_number))."/";
    }

    if(!file_exists($savePath)){
        mkdir($savePath);
    }

    $fileNo = $script_number."-2";
    $filename = base64_encode($fileNo);
    $file_type = ".xls";
    echo $savePath;
    $objWriter->save($savePath.$filename.$file_type);
    insertFileData($script_number,$savePath,$fileNo,$filename,$file_type,"file_table");
}
?>
