<?php
include("library.php");

$recordNo = $_GET["recordNo"];
$address = $_GET["address"];
$conn = connect_db();

$sql = "DELETE FROM resident WHERE address='{$address}'";
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
} else {
    echo json_encode(array('status' => "刪除失敗!"));
}

$sql = "DELETE FROM own_building WHERE address='{$address}'";
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
} else {
    echo json_encode(array('status' => "刪除失敗!"));
}

$sql = "DELETE FROM owner WHERE address='{$address}'";
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
} else {
    echo json_encode(array('status' => "刪除失敗!"));
}

$sql = "DELETE FROM has_subbuilding WHERE address='{$address}'";
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
} else {
    echo json_encode(array('status' => "刪除失敗!"));
}

$sql = "DELETE FROM has_building_decoration WHERE fId LIKE '%{$recordNo}%'";
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
} else {
    echo json_encode(array('status' => "刪除失敗!"));
}

$sql = "DELETE FROM floor_info WHERE address='{$address}'";
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
} else {
    echo json_encode(array('status' => "刪除失敗!"));
}

$sql = "DELETE FROM file_table WHERE rId='{$recordNo}'";
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
} else {
    echo json_encode(array('status' => "刪除失敗!"));
}

$sql = "DELETE FROM building_locate WHERE address='{$address}'";
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
} else {
    echo json_encode(array('status' => "刪除失敗!"));
}

$sql = "DELETE FROM record WHERE address='{$address}'";
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
} else {
    echo json_encode(array('status' => "刪除失敗!"));
}

$sql = "DELETE FROM building WHERE address='{$address}'";
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
} else {
    echo json_encode(array('status' => "刪除失敗!"));
}


$sql = "SELECT * FROM file_table WHERE rId='{$recordNo}'";
$res = $conn->query($sql);
$i = 0;
while($row = $res->fetch_assoc()) {
    $result[$i] = $row;
    $i++;
}
$path = $result[0]["filepath"];
// $path = "file/building/legal/001/";

if(is_dir($path)){
//掃描一個資料夾內的所有資料夾和檔案並返回陣列
    $p = scandir($path);
    foreach($p as $val){
        //排除目錄中的.和..
        if($val !="." && $val !=".."){
            echo $path.$val."<br>";
            //如果是目錄則遞迴子目錄，繼續操作
            if(is_dir($path.$val)){
                //子目錄中操作刪除資料夾和檔案
                // deldir($path.$val.'/');
                //目錄清空後刪除空資料夾
                @rmdir($path.$val.'/');
            }
            else{
                //如果是檔案直接刪除
                unlink($path.$val);
            }
        }
    }
    @rmdir($path.'/');
}
$conn->close();
echo json_encode(array('status' => "刪除成功!"));
?>
