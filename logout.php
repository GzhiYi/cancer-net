<?php 
error_reporting(0);
    session_start();
    if($_SESSION['uuid']){
        $old_user = $_SESSION['uuid'];
        unset($_SESSION['uuid']);
        session_destroy();
        $url = "help.php";  
        echo "<script type='text/javascript'>";
           echo  ' setTimeout(function(){';
                    echo "window.location.href='$url'";  
               echo  ' },2000)';
        echo "</script>";
    }
    else{
        $url = 'admin/admin_errorPage.php';
        echo  '<script>';
             echo "window.location.href = '$url';";
        echo  '</script>';
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>退出账户</title>
    <script src="src/js/jquery-3.1.1.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="src/style/css/bootstrap.min.css">
</head>
<body>
    <div class="modal show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">即将退出登录</h4>
                </div>
                <div class="modal-body">
                    <h5>欢迎您再次回来。</h5>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>