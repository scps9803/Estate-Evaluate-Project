<?php
include("library.php");
ob_clean();
$recordNo = $_GET["recordNo"];
$recordType = explode("-",$recordNo);
if($recordType[0] == "建合" || $recordType[0] == "建非"){
    $fileTable = "file_table";
    $recordTable = "record";
}
else{
    $fileTable = "corp_file_table";
    $recordTable = "corp_record";
}
$file_info = getFileInfo($recordNo,$fileTable,$recordTable);
for($i=0;$i<count($file_info);$i++){
    $filepath = $file_info[$i]["filepath"].$file_info[$i]["filename"];
    if(!file_exists($filepath)){
        echo "no file exists.";
    exit;
    }
    $fp=fopen($filepath,"r");
    header("Content-type: ".$file_info[$i]["content_type"]."; charset=utf-8");
    header("Accept-Ranges: bytes");
    header("Accept-Length: ".$file_info[$i]["size"]);
    header("Content-Disposition: attachment; filename=".$file_info[$i]["rId"]);
    ob_clean();
    flush();
    $buffer=1024;
    $buffer_count=0;
    while(!feof($fp)&&$file_info[$i]["size"]-$buffer_count>0){
    $data=fread($fp,$buffer);
    $buffer_count =$buffer;
    echo $data;
    }
    fclose($fp);
}
// $filename = $file_info[0]["filepath"]."/download.zip";
// for($i=0;$i<count($file_info);$i++){
//     $datalist[$i] = $file_info[$i]["filepath"].$file_info[$i]["rId"];
// }
// if(!file_exists($filename)){
// $zip = new ZipArchive();
// if ($zip->open($filename, ZipArchive::CREATE)==TRUE) {
// foreach( $datalist as $val){
// if(file_exists($val)){
// $zip->addFile( $val, basename($val));
// }
// }
// $zip->close();
// }
// }
// if(!file_exists($filename)){
// exit("無法找到檔案");
// }
// // header("Cache-Control: public");
// // header("Content-Description: File Transfer");
// // header('Content-disposition: attachment; filename='.basename($filename)); //檔名
// // header("Content-Type: application/zip"); //zip格式的
// // header("Content-Transfer-Encoding: binary"); //告訴瀏覽器，這是二進位制檔案
// // header('Content-Length: '. filesize($filename)); //告訴瀏覽器，檔案大小
//     $fp=fopen($filename,"r");
//     header("Content-type: application/zip");
//     header("Accept-Ranges: bytes");
//     header("Accept-Length: ".filesize($filename));
//     header("Content-Disposition: attachment; filename=".$file_info[0]["rId"].".zip");
//     $buffer=1024;
//     $buffer_count=0;
//     while(!feof($fp)&&filesize($filename)-$buffer_count>0){
//     $data=fread($fp,$buffer);
//     $buffer_count =$buffer;
//     echo $data;
//     }
//     fclose($fp);
?>
