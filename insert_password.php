<?php
include("database.php");
$data = new database();
if(isset($_POST["email"]) && isset($_POST["url"]) && isset($_POST["userName"]) && isset($_POST["password"])){
    $email = $_POST["email"];
    $url = $_POST["url"];
    $userName = $_POST["userName"];
    $password = $_POST["password"];
    $result = $data->insert("password", ["email"=> "$email", "url"=> "$url", "user_name"=> "$userName", "password"=> "$password"]);
    if($result){
        echo "1";
    }else{
        echo "0";
    }
}
?>