<?php
include("export_corp_detailed_list_excel.php");
ob_clean();

exportCorpDetail();

$returnFile = $_GET["file"];
$fileName = base64_encode($returnFile);
if($returnFile == "corp_detail"){
    $bookName = "農作物清冊";
}
else{
    $bookName = "建物清冊";
}

$filepath = "file/book/".$fileName.".xls";
$fileSize = filesize($filepath);

if(!file_exists($filepath)){
    echo "no file exists.";
exit;
}
$fp=fopen($filepath,"r");
header("Content-type: application/vnd.ms-excel; charset=utf-8");
header("Accept-Ranges: bytes");
header("Accept-Length: ".$fileSize);
header("Content-Disposition: attachment; filename=".$bookName);
ob_clean();
flush();
$buffer=1024;
$buffer_count=0;
while(!feof($fp)&&$fileSize-$buffer_count>0){
$data=fread($fp,$buffer);
$buffer_count =$buffer;
echo $data;
}
fclose($fp);
?>
