<?php 
    error_reporting(0);
    session_start();
    if($_SESSION['admin'] === null){
        $url = '../admin/admin_errorPage.php';
        echo  '<script>';
             echo "window.location.href = '$url';";
        echo  '</script>';
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户管理</title>
    <link rel="stylesheet" href="../src/style/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../src/style/help_style.css">
    <link rel="stylesheet" href="../src/style/validation.css">
    <script src="../src/js/jquery-3.1.1.min.js"></script>
    <script src="../src/js/bootstrap.min.js"></script>
    <script src="../src/js/jquery.metadata.js"></script>
    <script src="../src/js/jquery.validate.min.js"></script>
    <script src="../src/js/messages_zh.min.js"></script>
    <script src="../src/js/manager.js"></script>
    <script src="../src/js/setting.js"></script>
</head>
<body>
    <ol class="breadcrumb">
      <li><a href="../help.php">首页</a></li>
      <li class="active">用户安全信息设置</li>
    </ol>
    <div class="container">
        <div class="rows">
            <div class="page-header">
                <h3><?php echo $_SESSION['uuname'] ?> 请选择要管理的个人信息</h3>
            </div>
            <div class="col-md-3">
                
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="account.php" id="base">基本信息</a></li>
                    <li><a href="posts.php" id="posts">我的帖子</a></li>
                    <li class="active"><a href="security.php" id="safety">安全信息</a></li>
                </ul>
            </div>
<!--  安全信息设置 -->
            <div class="col-md-6">
                <form method="post" class="form-horizontal" action="securitysuccess.php" id="form-security">
                    <div id="baseinfo">
                        <div class="form-group">
                        <label for="" class="control-label col-md-2">旧密码*</label>
                        <div class="col-md-10">
                            <input type="password" id="mgoldpwd" name="mgoldpwd" placeholder="输入原密码" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label col-md-2">新密码*</label>
                        <div class="col-md-10">
                            <input type="password" id="mgnewpwd" name="mgnewpwd" placeholder="输入新密码" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label col-md-2">再次输入*</label>
                        <div class="col-md-10">
                            <input type="password" name="mgnewpwd_again" placeholder="确认新密码" class="form-control">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="button" class="btn btn-primary" id="security_submit">提交修改</button>
                        </div>
                    </div>

                </form>
                <form action="" class="form-horizontal">
                    <div class="form-group">
                        <label for="" class="control-label col-md-2">通过邮箱找回</label>
                        <div class="col-md-10">
                            <?php 
                                $db = new mysqli('localhost','gzhiyi','8023','help');
                                $query = 'select * from users where user_id="'.$_SESSION['uuid'].'"';
                                $result = mysqli_query($db, $query);                          
                                if ($result = mysqli_query($db, $query)) {
                                 while ($row = mysqli_fetch_assoc($result)){
                                    echo  '<input type="email" title="不可修改" disabled="disabled" name="mgemail" value="'.$row['email'].'" class="form-control">';
                                 }
                             }
                             ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                        <button type="button" class="btn btn-default" value="" id="modify_submit">发送邮件</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
</body>
</html>