<?php
// 讀取PHPExcel函式庫
require_once("classes/PHPExcel/IOFactory.php");

$recordNo = $_GET["recordNo"];
// 載入Excel檔案(檔名:temp.xlsx)
$obj = PHPExcel_IOFactory::load("file/myexchel.xls");
// 設定現用工作表
$obj->setActiveSheetIndex(0);
$sheet = $obj->getActiveSheet();
echo '<table>';
//列舉所有excel列資料
foreach ($sheet->getRowIterator() as $row) {
        echo '<tr>';
    //列舉所有excel欄資料
        foreach ($row->getCellIterator() as $cell) {
        //將儲存格資料轉成UTF-8格式後顯示
                // echo '<td>' . toUTF($cell->getValue()) . '</td>';
                echo '<td>' . toUTF($cell->getValue()) . '</td>';
        }
        echo '</tr>';
}
echo '</table>';
//資料BIG5轉UTF-8副程式

function toUTF($a){
        return mb_convert_encoding($a,"UTF-8","BIG-5");
}
?>
