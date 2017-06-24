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
    <script src="../src/js/jquery.form.min.js"></script>
    <script src="../src/js/setting.js"></script>
</head>
<body>
    <ol class="breadcrumb">
      <li><a href="../help.php">首页</a></li>
      <li class="active">论坛帖子管理</li>
    </ol>
    <div class="container">
        <div class="rows">
            <div class="page-header">
                <h3>管理员 <?php echo $_SESSION['uuname'] ?> 您好,请选择要管理删除的帖子</h3>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>请注意！</strong>  删除操作会影响用户数据，请谨慎操作并且操作前应及时通知有关用户
                  &nbsp;&nbsp;&nbsp;<strong>管理员留意！</strong> 返回首页会取消管理权，请留意
                </div>
            </div>

            <div class="col-md-3">  
                <ul class="nav nav-pills nav-stacked">
                    <!-- <li><a href="#" id="base">基本信息</a></li> -->
                    <li class="active"><a href="admin.php" id="posts">论坛帖子管理</a></li>
                    <li><a href="admin_user.php">用户管理</a></li>
                </ul>
            </div>
                <div class=" col-md-9">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="col-md-offset-3 col-md-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="admin_search" class="form-control" placeholder="仅搜索标题">
                                <span class="input-group-btn">
                                    <button type="submit" name="search_title" class="btn btn-default">标题</button>
                                </span>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="40%">帖子标题</th>
                                <th width="10%">作者</th>
                                <th width="20%">发表时间</th>
                                <th width="10%">删除状态</th>
                                <th width="20%">&nbsp;<button type="button" class="btn btn-danger btn-sm pull-right delete-posts">删除</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="admin_post_content">
                            <?php 
                            error_reporting(0);
                            $keyword = $_POST['admin_search'];
                            $db = new mysqli('localhost','gzhiyi','8023','help');
                            mysqli_set_charset($db,"utf8");

                            $query = "select * from forum where title like '%".$keyword."%' order by time desc limit 30";
                            $result = mysqli_query($db, $query);                          
                            //if ($result = mysqli_query($db, $query)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo  '<tr>';
                                        echo  "<td><a style='text-decoration: none;' href='../help_each/forum/posts/postdetail.php?post_id=".$row['post_id']."'>".$row['title']."</a></td>";
                                        echo  '<td>'.$row['user_name'].'</td>';
                                        echo  '<td>'.$row['time'].'</td>';
                                        if($row['del'] === '0'){
                                            echo  '<td>N</td>';
                                            echo  '<td>
                                            <div class="btn-group pull-right">
                                            <a type="button" class="btn btn-danger btn-sm hide delete-posts-yes" href="admin_del_post.php?post_id='.$row['post_id'].'">是</a>
                                            <button type="button" class="btn btn-default btn-sm hide delete-posts-cancle" >否</button>
                                            </td>';
                                        }
                                        else{
                                            echo  '<td class="danger">Y</td>';
                                            echo  '<td></td>';
                                        }
                                    echo  '</tr>';
                                }
                            //}
                         ?>
                        </tbody>
                    </table>
                </div>
            </div>         
        </div>   
</body>
</html>
