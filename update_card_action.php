<?php
include("database.php");
$data = new database();
if(isset($_POST["id"]) && isset($_POST["number"]) && isset($_POST["expiry"]) && isset($_POST["cvv"])){
   $id = $_POST["id"];
   $number = $_POST["number"];
   $expiry = $_POST["expiry"];
   $cvv = $_POST["cvv"];
   $result = $data->update("card", ["number" => "$number", "expiry" => "$expiry", "cvv" => "$cvv"], $id);
   if($result){
      echo "1";
   }else{
      echo "0";
   }
}
?>