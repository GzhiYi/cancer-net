<?php      
    session_start();
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
    <script src="../src/js/setting.js"></script>
</head>
<body>
    <ol class="breadcrumb">
      <li><a href="../help.php">首页</a></li>
      <li class="active">我的帖子管理</li>
    </ol>
    <div class="container">
        <div class="rows">
            <div class="page-header">
                <h3><?php echo $_SESSION['uuname'] ?> 请选择要管理的个人信息</h3>
            </div>

            <div class="col-md-3">  
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="account.php" id="base">基本信息</a></li>
                    <li class="active"><a href="posts.php" id="posts">我的帖子</a></li>
                    <li><a href="security.php" id="safety">安全信息</a></li>
                </ul>
            </div>
                <div class=" col-md-9">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="60%">帖子标题</th>
                                <th width="20%">发表时间</th>
                                <th width="20%">&nbsp;<button type="button" class="btn btn-danger btn-sm pull-right delete-posts">删除</button>
                                </th>
                            </tr>
                        </thead>
                        <?php 
                            $db = new mysqli('localhost','gzhiyi','8023','help');
                            mysqli_set_charset($db,"utf8");
                            $query = 'select * from forum where del="0" and user_id="'.$_SESSION['uuid'].'"';
                            $result = mysqli_query($db, $query);                          
                            //if ($result = mysqli_query($db, $query)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo  '<tr>';
                                        echo  "<td><a style='text-decoration: none;' href='../help_each/forum/posts/postdetail.php?post_id=".$row['post_id']."'>".$row['title']."</a></td>";
                                        echo  '<td>'.$row['time'].'</td>';
                                        echo  '<td>
                                        <div class="btn-group pull-right">
                                        <a type="button" class="btn btn-danger btn-sm hide delete-posts-yes" href="delete.php?title='.$row["title"].'">是</a>
                                        <button type="button" class="btn btn-default btn-sm hide delete-posts-cancle" >否</button>
                                        </td>';
                                    echo  '</tr>';
                                }
                            //}
                         ?>
                    </table>
                </div>
            </div>         
        </div>   
</body>
</html>
