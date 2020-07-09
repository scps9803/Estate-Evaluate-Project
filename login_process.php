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
            $_SESSION["pId"] = $row["pId"];
            $_SESSION["name"] = $row["name"];
            header("Location: homepage.php");
            return;
        }
    }
}
?>
