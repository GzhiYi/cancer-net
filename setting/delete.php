<?php 
    error_reporting(0);
    session_start();
    if($_SESSION['admin'] !== 0){
        $url = '../admin/admin_errorPage.php';
        echo  '<script>';
             echo "window.location.href = '$url';";
        echo  '</script>';
    }
    $title = $_GET['title'];
    $db = new mysqli('localhost','gzhiyi','8023','help');
    mysqli_set_charset($db,"utf8");
    /*$query = 'delete from forum where title ="'.$title.'" and user_id ="'.$_SESSION['uuid'].'" limit 1';*/
    $query = "update forum set del='1' where title ='".$title."' and user_id ='".$_SESSION['uuid']."'";
    $result = mysqli_query($db, $query);
    $url = "posts.php";  
    echo "<script type='text/javascript'>";  
    echo "window.location.href='$url'";  
    echo "</script>";                          
?>