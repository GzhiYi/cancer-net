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
            if($_FILES["file"]["error"]){
                echo $_FILES["file"]['error'];
            }else{
                //控制上传文件大小
                if(($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]['type'] == "image/png") || ($_FILES["file"]["type"] == "image/jpeg") && $_FILES["file"]["size"] < 1024000){
                    //文件存放位置
                    date_default_timezone_set("Etc/GMT-8");
                    $filename = "img/head/".date("YmdHis").$_FILES["file"]["name"];
                    //转换格式编码
                    $filename = iconv("UTF-8","gb2312",$filename);

                    if(file_exists($filename)){
                        echo "文件已经存在啦";
                    }else{
                        $finalname = "../".$filename;
                        move_uploaded_file($_FILES["file"]["tmp_name"],$finalname);  
                    }
                }
                else{
                    echo "文件类型不正确";
                }
            }

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
            $modquery4 = 'update users set user_head ="'.$filename.'" where user_id ="'.$_SESSION['uuid'].'"';
            if($mgusername !== ""){
                mysqli_query($db,$modquery1);
            }
            if($mgemail !== ""){
                mysqli_query($db,$modquery2);
            }
            if($mgsex !== ""){
                mysqli_query($db,$modquery3);
            }
            if($filename !== ""){
                mysqli_query($db,$modquery4);
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
