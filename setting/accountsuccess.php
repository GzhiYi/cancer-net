<?php 
    error_reporting(0);
    session_start();
    if($_SESSION['admin'] !== 0){
        $url = '../admin/admin_errorPage.php';
        echo  '<script>';
             echo "window.location.href = '$url';";
        echo  '</script>';
    }
    if(isset($_SESSION['uuid'])){
       // if(isset($_POST['mgusername']) && isset($_POST['mgemail']) &&isset($_POST['mgsex'])){
            $mgusername = $_POST['mgusername'];
            $mgemail = $_POST['mgemail'];
            @$mgsex = $_POST['sex'];
            @mysqli_set_charset($db,"utf8");
            $db = new mysqli('localhost','gzhiyi','8023','help');
            if(mysqli_connect_errno()){
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit;
            }
            $modquery1 = 'update users set user_name ="'.$mgusername.'" where user_id ="'.$_SESSION['uuid'].'"';
            $modquery2 = 'update users set email ="'.$mgemail.'" where user_id ="'.$_SESSION['uuid'].'"';
            $modquery3 = 'update users set sex="'.$mgsex.'" where user_id ="'.$_SESSION['uuid'].'"';
            if(@$mgusername !== ""){
                @mysqli_query($db,$modquery1);
            }
            if(@$mgemail !== ""){
                @mysqli_query($db,$modquery2);
            }
            if(@$mgsex !== ""){
                @mysqli_query($db,$modquery3);
            }

            $old_user = $_SESSION['uuid'];
            unset($_SESSION['uuid']);
            session_destroy();
            $url = "../help.php";  
            /*echo "<script type='text/javascript'>"; 
            echo  'setTimeout(function(){';
            echo "window.location.href='$url'"; 
            echo  '},1000);';*/
            echo"<script>alert('设置成功，需要重新登录！');window.location.href='$url';</script>";  

                
}

 ?>
