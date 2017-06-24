<?php 
    error_reporting(0);
    session_start();
    $user_id = $_GET['user_id'];
    $db = new mysqli('localhost','gzhiyi','8023','help');
    mysqli_set_charset($db,"utf8");
    $query = "update users set user_del='1' where user_id=$user_id";
    $result = mysqli_query($db, $query);
    $url = "admin_user.php";  
    echo "<script type='text/javascript'>";  
    echo "window.location.href='$url'";  
    echo "</script>";                     
?>