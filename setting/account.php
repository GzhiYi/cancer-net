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
    <link rel="stylesheet" type="text/css" href="../src/style/css/fileinput.min.css">
    <script src="../src/js/jquery-3.1.1.min.js"></script>
    <script src="../src/js/bootstrap.min.js"></script>
    <script src="../src/js/jquery.metadata.js"></script>
    <script src="../src/js/jquery.validate.min.js"></script>
    <script src="../src/js/messages_zh.min.js"></script>
    <script src="../src/js/setting.js"></script>
    <script src="../src/js/fileinput.min.js"></script>
    
</head>
<body>
    <ol class="breadcrumb">
      <li><a href="../help.php">首页</a></li>
      <li class="active">基本用户信息设置</li>
    </ol>
    <div class="container">
        <div class="rows">
            <div class="page-header">
                <h3><?php echo $_SESSION['uuname'] ?> 请选择要管理的个人信息</h3>
            </div>

            <div class="col-md-3">  
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="account.php" id="base">基本信息</a></li>
                    <li><a href="posts.php" id="posts">我的帖子</a></li>
                    <li><a href="security.php" id="safety">安全信息</a></li>
                </ul>
            </div>
            <div class="col-md-6" ><!-- 基本信息 -->
            <form method="post" class="form-horizontal" action="accountsuccess.php" id="form-basic" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-md-offset-4 col-md-8">
                <?php 
                    echo  '<img src="../'.$_SESSION['head'].'" class="img-circle" style="width: 200px;height: 200px; border: 2px solid #ccc;">';
                 ?>
                    
                 </div>
            </div>
                 
                <?php 
                $db = new mysqli('localhost','gzhiyi','8023','help');
                mysqli_set_charset($db,"utf8");
                $query = 'select * from users where user_id="'.$_SESSION['uuid'].'"';
                $result = mysqli_query($db, $query);
                
                while ($row = mysqli_fetch_assoc($result)){
                    echo  '<div class="form-group">';
                        echo  '<label for="a_head" class="control-label col-md-2">修改头像</label>';
                        echo  '<div class="col-md-10">';
                            echo  '<input type="file" name="file" class="file" id="a_head">';
                        echo  '</div>';
                    echo  '</div>';
                    echo  '<div class="alert alert-danger col-md-offset-2 col-md-10">';
                            echo  '<p>注意添加头像后点击 <strong>Upload</strong> 上传头像<strong>  仅支持jpg,png,jpeg且图片大小不超过1m</strong></p>';
                    echo  '</div>';
                    echo  '<div class="form-group">';
                    echo  '<label for="" class="control-label col-md-2">用户名</label>';
                    echo  '<div class="col-md-10">';
                    echo "<input type='text' id='a_username' name='mgusername' class='form-control' placeholder='".$row['user_name']."'>";

                echo  '</div>';
            echo  '</div>';
            echo  '<div class="form-group">';
                echo  '<label for="" class="control-label col-md-2">邮箱</label>';
                echo  '<div class="col-md-10">';                              
                    echo  '<div class="input-group">';

                            echo '<input type="email" id="a_email" name="mgemail" placeholder="'.$row['email'].'" class="form-control">';

                         }
                        ?>  
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default">发送</button>
                                </span> 
                            </div>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="" class="col-sm-2 control-label">性别</label>
                    <div class="col-sm-10">
                       <div class="radio">
                           <label for="">
                               <input type="radio" name="sex" value="male">男
                           </label>&nbsp;&nbsp;&nbsp;&nbsp;
                           <label for="">
                               <input type="radio" name="sex" value="female">女
                           </label>
                       </div>
                   </div>
                </div> -->

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="button" class="btn btn-primary" id="modify_submit">提交修改</button>
                    </div>
                </div>
            </form>
        </div>
        </div>        
</body>
</html>
