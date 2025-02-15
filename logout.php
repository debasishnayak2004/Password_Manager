<?php
session_start();
if($_SESSION["emailLogin"]){
    session_destroy();
    session_unset();
    echo "1";
}else{
    echo "0";
}
?>