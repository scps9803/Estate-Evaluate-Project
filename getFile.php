<?php
include("library.php");
ob_clean();
$recordNo = $_GET["recordNo"];
$returnFile = $_GET["file"];
$recordType = explode("-",$recordNo);
if($recordType[0] == "建合"){
    $fileTable = "file_table";
    $recordTable = "record";
    $filepath = "file/building/legal/".$recordType[1]."/".$recordNo."-".$returnFile.".xls";
}
else if($recordType[0] == "建非"){
    $filepath = "file/building/illegal/".$recordType[1]."/".$recordNo."-".$returnFile.".xls";
}
else{
    $filepath = "file/corp/".$recordType[1]."/".$recordNo."-".$returnFile.".xls";
}

if($returnFile == "1"){
    $fileType = "調查表";
}
else{
    $fileType = "持分表";
}
$file_info = getFileInfo($recordNo,$returnFile,$fileTable,$recordTable);
header("Location:".$filepath);
?>
