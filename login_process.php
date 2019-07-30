<?php
session_start();
include "library.php";

$pId = $_POST['pId'];
$pwd = $_POST['pwd'];

$conn = connect_db();
$sql = "SELECT * from employee WHERE pId='{$pId}'";
// $res = $db->prepare($sql);
// $res->execute();
$res = $conn->query($sql);

while($row = $res->fetch_assoc()){
    if(strcmp($pId,$row['pId'])==0){
        if(strcmp($pwd,$row['pwd'])==0){
        echo "successful";
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["user_name"] = $row["user_name"];
        // $_SESSION["email"] = $row["email"];
        header("Location: homepage.php");
        return;
        }
    }
}
echo "fail";
?>
