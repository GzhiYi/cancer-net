<?php 
    error_reporting(0);
    session_start();
    if($_SESSION['admin'] !== 1){
        $url = 'admin_errorPage.php';
        echo  '<script>';
             echo "window.location.href = '$url';";
        echo  '</script>';
    }
    $post_id = $_GET['post_id'];
    $db = new mysqli('localhost','gzhiyi','8023','help');
    mysqli_set_charset($db,"utf8");
    /*$query = 'delete from forum where title ="'.$title.'" and user_id ="'.$_SESSION['uuid'].'" limit 1';*/
    $query = "update forum set del='1' where post_id=$post_id";
    $result = mysqli_query($db, $query);
    $url = "admin.php";  
    echo "<script type='text/javascript'>";  
    echo "window.location.href='$url'";  
    echo "</script>";                     
?>