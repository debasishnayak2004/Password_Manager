<?php
include("database.php");
$data = new database();
if(isset($_POST["id"])){
    $id = $_POST["id"];
   $result =  $data->delete("card", "$id");
   if($result){
    echo "1";
   }
}
?>