<?php
ob_clean();
// $action = $_GET['action'];
// $filename = base64_decode($action);//傳的引數encode了
$filename = "myexchel.xls";
$filepath = "file\\".$filename;
if(!file_exists($filepath)){
    echo "no file exists.";
exit;
}
$fp=fopen($filepath,"r");
$filesize=filesize($filepath);
header("Content-type: application/vnd.ms-excel");
header("Accept-Ranges: bytes");
header("Accept-Length: ".$filesize);
header("Content-Disposition: attachment; filename="."建合001.xls");
$buffer=1024;
$buffer_count=0;
while(!feof($fp)&&$filesize-$buffer_count>0){
$data=fread($fp,$buffer);
$buffer_count =$buffer;
echo $data;
}
fclose($fp);

// header('Content-Description: File Transfer');
// header('Content-Type: application/octet-stream');
// header('Content-Disposition: attachment; filename='.basename($filepath));
// header('Content-Transfer-Encoding: binary');
// header('Expires: 0');
// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
// header('Pragma: public');
// header('Content-Length: ' . filesize($filepath));
// readfile($file_path);
?>
