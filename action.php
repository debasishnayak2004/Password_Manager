<?php
include("database.php");
$data = new database();
if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "select * from register where email = '$email'";
    $res = mysqli_query($data->conn, $sql);
    session_start();
    if(mysqli_num_rows($res) > 0){
        echo "emailError";
     }else{
        $result =  $data->insert("register", ["name" => $name, "email" => $email, "password" => $password]);
        if($result){
            echo "1";
            $_SESSION["register"] = "register";
        }else {
         echo "0";
        }
     }
    
}


?>