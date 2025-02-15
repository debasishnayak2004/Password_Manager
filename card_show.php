<?php
$conn = mysqli_connect("localhost", "root", "", "password_maneger");
session_start();
$email = $_SESSION["emailLogin"];
$sql = "select * from `card` where email = '$email'";
$result = mysqli_query($conn, $sql);
$info = [];
header("content-type: application/json");
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $info[] = $row;
    }
    $response = json_encode($info);
    echo $response;
}
?>