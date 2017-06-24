<?php      
    session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员：用户信息管理</title>
    <link rel="stylesheet" href="../src/style/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../src/style/help_style.css">
    <link rel="stylesheet" href="../src/style/validation.css">
    <script src="../src/js/jquery-3.1.1.min.js"></script>
    <script src="../src/js/bootstrap.min.js"></script>
    <script src="../src/js/jquery.metadata.js"></script>
    <script src="../src/js/jquery.validate.min.js"></script>
    <script src="../src/js/messages_zh.min.js"></script>
    <script src="../src/js/setting.js"></script>
</head>
<body>
    <ol class="breadcrumb">
      <li><a href="../help.php">首页</a></li>
      <li class="active">用户管理</li>
    </ol>
    <div class="container">
        <div class="rows">
            <div class="page-header">
                <h3>管理员 <?php echo $_SESSION['uuname'] ?> 您好,请选择要管理的用户</h3>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>请注意！</strong>  删除操作会影响用户数据，请谨慎操作并且操作前应及时通知有关用户
                  &nbsp;&nbsp;&nbsp;<strong>管理员留意！</strong> 返回首页会取消管理权，请留意
                </div>
            </div>

            <div class="col-md-3">  
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="admin.php">论坛帖子管理</a></li>
                    <li class="active"><a href="admin_user.php">用户管理</a></li>
                </ul>
            </div>
                <div class=" col-md-9">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="col-md-offset-3 col-md-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="admin_search" class="form-control" placeholder="仅搜索用户名">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">用户名</button>
                                </span>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="20%">用户名</th>
                                <th width="20%">用户ID</th>
                                <th width="30%">邮件地址</th>
                                <th width="10%">删除状态</th>
                                <th width="20%">&nbsp;<button type="button" class="btn btn-danger btn-sm pull-right delete-posts">删除</button>
                                </th>
                            </tr>
                        </thead>
                        <?php
                            error_reporting(0); 
                            $keyword = $_POST['admin_search'];
                            $db = new mysqli('localhost','gzhiyi','8023','help');
                            mysqli_set_charset($db,"utf8");
                            $query = "select * from users where user_name like '%".$keyword."%' limit 30";
                            $result = mysqli_query($db, $query);                          
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo  '<tr>';
                                    echo  "<td>".$row['user_name']."</td>";
                                    echo  '<td>'.$row['user_id'].'</td>';
                                    echo  '<td>'.$row['email'].'</td>';
                                    if($row['user_del'] === '0'){
                                        echo  '<td>N</td>';
                                        echo  '<td>
                                        <div class="btn-group pull-right">
                                        <a type="button" class="btn btn-danger btn-sm hide delete-posts-yes" href="admin_del_user.php?user_id='.$row['user_id'].'">是</a>
                                        <button type="button" class="btn btn-default btn-sm hide delete-posts-cancle" >否</button>
                                        </td>';
                                    }
                                    else{
                                        echo  '<td class="danger">Y</td>';
                                        echo '<td><td>';
                                    }
                                    //由于不影响删除样式所以沿用删除帖子的那一份按钮操作
                                echo  '</tr>';
                            }
                         ?>
                    </table>
                </div>
            </div>         
        </div>   
</body>
</html>
