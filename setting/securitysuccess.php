<?php 
    error_reporting(0);
    session_start();
    if($_SESSION['admin'] === null){
        $url = '../admin/admin_errorPage.php';
        echo  '<script>';
             echo "window.location.href = '$url';";
        echo  '</script>';
    }
    $mgoldpwd = $_POST['mgoldpwd'];
    $mgnewpwd = $_POST['mgnewpwd'];
    $mgnewpwd_again = $_POST['mgnewpwd_again'];
    $db = new mysqli('localhost','gzhiyi','8023','help');
    mysqli_set_charset($db, "utf8");
    if(mysqli_connect_errno()){
        echo "数据库连接失败";
        eixt;
    }
    $query = 'select user_pwd from users where user_id="'.$_SESSION['uuid'].'"';
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($result)){
        if($row['user_pwd'] === $mgoldpwd){
            $access = 'update users set user_pwd ="'.$mgnewpwd.'"where user_id ="'.$_SESSION['uuid'].'"';
            $modify_result = mysqli_query($db,$access);
            $old_user = $_SESSION['uuid'];
            unset($_SESSION['uuid']);
            session_destroy();
            echo "密码修改成功！正在跳转到主页";
            $url = "../help.php";  
            echo "<script type='text/javascript'>"; 
            echo  'setTimeout(function(){';
            echo "window.location.href='$url'"; 
            echo  '},1000);';
             
            echo "</script>";
        }
        else{
            echo"<script>alert('原密码输入错误!');history.go(-1);</script>";  
        }
    }
    
 ?>