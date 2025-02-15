<?php
include("database.php");
$data = new database();
if(isset($_POST["id"]) && isset($_POST["url"]) && isset($_POST["user_name"]) && isset($_POST["password"])){
   $id = $_POST["id"];
   $url = $_POST["url"];
   $user_name = $_POST["user_name"];
   $password = $_POST["password"];
   $result = $data->update("password", ["url" => "$url", "user_name" => "$user_name", "password" => "$password"], $id);
   if($result){
      echo "1";
   }else{
      echo "0";
   }
}
?>