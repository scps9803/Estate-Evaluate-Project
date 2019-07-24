<?php
include("library.php");
ob_clean();
$recordNo = $_GET["recordNo"];
$file_info = getFileInfo($recordNo);

if(count($file_info)<=1){
    $filepath = $file_info[0]["filepath"].$file_info[0]["filename"];
    if(!file_exists($filepath)){
        echo "no file exists.";
    exit;
    }
    $fp=fopen($filepath,"r");
    header("Content-type: ".$file_info[0]["content_type"]."; charset=utf-8");
    header("Accept-Ranges: bytes");
    header("Accept-Length: ".$file_info[0]["size"]);
    header("Content-Disposition: attachment; filename=".$file_info[0]["fId"]);
    $buffer=1024;
    $buffer_count=0;
    while(!feof($fp)&&$file_info[0]["size"]-$buffer_count>0){
    $data=fread($fp,$buffer);
    $buffer_count =$buffer;
    echo $data;
    }
    fclose($fp);
}
else{
    // $zipname = 'file/zip/test.zip';
    // //這是要打包的檔案地址陣列
    // // $files = array("mypath/test1.txt","mypath/test2.pdf");
    // for($i=0;$i<count($file_info);$i++){
    //     $files = $file_info[$i]["filepath"].$file_info[$i]["filename"];
    // }
    //
    // $zip = new ZipArchive();
    // $res = $zip->open($zipname, ZipArchive::CREATE);
    // if ($res === TRUE) {
    //     foreach ($files as $file) {
    //     //這裡直接用原檔案的名字進行打包，也可以直接命名，需要注意如果檔名字一樣會導致後面檔案覆蓋前面的檔案，所以建議重新命名
    //         $new_filename = substr($file, strrpos($file, '/') + 1);
    //         $zip->addFile($file, $new_filename);
    //     }
    //     $zip->close();
    //
    //     header("Content-Type: application/zip");
    //     header("Content-Transfer-Encoding: Binary");
    //     header("Content-Length: " . filesize($zipname));
    //     header("Content-Disposition: attachment; filename=\"" . basename($zipname) . "\"");
    //     readfile($zipname);
    //     exit;
    // }
}
?>
