<?php
include("database.php");
$data = new database();
if(isset($_POST["email"]) && isset($_POST["number"]) && isset($_POST["expiry"]) && isset($_POST["cvv"])){
    $email = $_POST["email"];
    $number = $_POST["number"];
    $expiry = $_POST["expiry"];
    $cvv = $_POST["cvv"];
    $result = $data->insert("card", ["email"=> "$email", "number"=> "$number", "expiry"=> "$expiry", "cvv"=> "$cvv"]);
    if($result){
        echo "1";
    }else{
        echo "0";
    }
}
?>