<?php
include("database.php");
$data = new database();
if(isset($_POST["email"]) && isset($_POST["password"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "select * from register where email = '$email' && password = '$password'";
    $result = mysqli_query($data->conn, $sql);
    session_start();
    if(mysqli_num_rows($result) > 0){
        echo "1";
        $_SESSION["login"] = "login";
        $_SESSION["emailLogin"] = $email;
    }else{
        echo "0";
    }
}

?>