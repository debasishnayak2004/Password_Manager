<?php
include("database.php");
$data = new database();
if(isset($_POST["id"])){
    $id = $_POST["id"];
   $result =  $data->delete("password", "$id");
   if($result){
    echo "1";
   }
}
?>