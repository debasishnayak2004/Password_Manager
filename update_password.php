<?php
include("database.php");
$data = new database();
if(isset($_POST["id"])){
    $id = $_POST["id"];
    $result = $data->selectId("password", "$id");
    header("content-type: application/json");
    $info = [];
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $info[] = $row;
        }
        $response = json_encode($info);
        print_r($response);
    }
}
?>