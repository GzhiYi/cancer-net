<?php 
    error_reporting(0);
    session_start();
    $post_id = $_GET['post_id'];
    $db = new mysqli('localhost','gzhiyi','8023','help');
    mysqli_set_charset($db,"utf8");
    if(mysqli_connect_errno()){//check connection
        echo "error,databse has fails in connection";
        exit;
    }
    $post = "select * from forum where post_id ='".$post_id."'";
    
    if ($result = mysqli_query($db, $post)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $post_title = $row['title'];
                $post_user_id = $row['user_id'];
        }
    }
    $post_user_count = "select * from forum where del='0' and user_id ='".$post_user_id."'";
    if($count_result = mysqli_query($db,$post_user_count)){
        $post_count = mysqli_num_rows($count_result);
     }
        
    
    $user = "select * from users where user_id ='".$post_user_id."'";
    if ($result = mysqli_query($db, $post)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $post_title = $row['title'];
                $post_user_id = $row['user_id'];
                $post_type = $row['type'];
                $post_user_name = $row['user_name'];
                $post_time = $row['time'];
                $post_content = $row['content'];
                $post_user_head = $row['user_head'];
        }
    }
    $comment_global = "select * from postcomment where post_id='".$post_id."'";
    if($comment_global_result = mysqli_query($db,$comment_global)){
        $comment_count = mysqli_num_rows($comment_global_result);
     }    
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $post_title ?></title>
    <link rel="stylesheet" href="../../../src/style/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../src/style/help_style.css">
    <link rel="stylesheet" href="../../../src/style/validation.css">
    <link rel="stylesheet" href="../../../src//style/postdetail.css">
    <script src="../../../src/js/jquery-3.1.1.min.js"></script>
    <script src="../../../src/js/bootstrap.min.js"></script>
    <script src="../../../src/js/jquery.metadata.js"></script>
    <script src="../../../src/js/jquery.validate.min.js"></script>
    <script src="../../../src/js/messages_zh.min.js"></script>
    <script src="../../../src/js/jquery.form.min.js"></script>
    <script src="../../../src/js/help_base.js"></script><!-- 页面主要js样式位置 -->
    <script src="../../../src/js/postHandler.js"></script><!--处理帖子发帖的validate验证-->
    <script src="../../../src/js/find_pwd.js"></script><!--处理密码找回的交互-->
    <script src="../../../src/js/userHandler.js"></script><!--处理帖子发帖的validate验证-->
    <script src="../../../src/js/postdetail.js"></script>

</head>
<body class="body-help_each">
    <nav class="navbar navbar-default navbar-fixed-top">
        <a href="../../../help.php" class="navbar-brand">Logo</a>
        <ul class="nav navbar-nav">
            <li id="help"><a href="../../../help.php"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
            <li><a href="../../../knowledge.php"><span class="glyphicon glyphicon-fire"></span> 防癌知识</a></li>
<!--             <li><a href="#"><span class="glyphicon glyphicon-heart"></span> 携手抗癌</a></li> -->
            <li class="active"><a href="../../../help_each.php" id="help_each"><span class="glyphicon glyphicon-magnet"></span> 互助交流</a></li>
            <li><a href="../../../announcement.php"><span class="glyphicon glyphicon-comment"></span> 最新公告</a></li>
            <li ><a href="#" data-toggle="dropdown"> 更多<span class="caret"></span></a>
                <ul class="dropdown-menu">
                   <li><a href="#" class="help_contact"><span class="glyphicon glyphicon-phone-alt "></span> 联系我们</a></li>
                   <li><a href="#" class="help_about"><span class="glyphicon glyphicon-info-sign "></span> 关于</a></li>
                </ul>
            </li>
            
            <form action="../../../search/searchresult.php" class="navbar-form pull-right" id="search_form" method="post"><!-- 搜索框 -->
                <div class="input-group" >
                    <input type="text" class="form-control" placeholder="搜索..." id="search-input" name="keyword">
                    <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" id="search-btn">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </ul>
        <?php 
            //session_start();
            if(isset($_SESSION['uuid'])){
              echo  '<div id="login-success">';
                echo  '<span>';
                    echo  '<img title="uuid" id="login-head" src="../../../'.$_SESSION['head'].'" alt="用户id" class="img-circle" >';
                    echo  '<a href="../../../setting/account.php">&nbsp;'.$_SESSION['uuname'].'</a>';
                    echo '<a href="../../../logout.php">   退出</a>';
                echo  '</span>';
              echo  '</div>';
            }
            else{
               echo '<div id="reg_div">';
                  echo  '<span id="reg_btn">';
                    echo  '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#login" >用户登录</button>';
                    echo '<a href="../../../help/register.php" class="btn btn-success">注册</a>';
                  echo  '</span>';
              echo  '</div>';
            }

         ?>
    </nav>
    <!-- 登陆模态框 -->
    <div class="modal fade" id="login" tabindex="-1" data-backdrop="static">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <button class="close"  data-dismiss="modal"><span>&times;</span></button>
                       <h4 class="modal-title" id="login_title">用户登录</h4>
                   </div>

                   <div class="modal-body">
                       <form action="../../../help.php" class="form-horizontal" id="form_login" method="post">
                           <div id="form-outer"><!--这个outer用于给ajax插入表格定位。就是插在这个id后面-->
                               <div class="form-group">
                                   <label class="col-md-2 control-label" id="userName" >账户</label>
                                   <div class="col-md-10">
                                       <input type="text" class="form-control inp_wid" name="username" placeholder="用户名" value="<?php echo @$_COOKIE['username'] ?>">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 control-label" id="passWord">密码</label>
                                   <div class="col-md-10">
                                       <input type="password" class="form-control inp_wid" name="pwd" placeholder="密码" value="<?php echo @$_COOKIE['pwd'] ?>">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="col-sm-offset-2 col-sm-10">
                                       <div class="checkbox">
                                           <label>
                                               <input type="checkbox" title="请勿在公共场合的电脑勾选此选项，比如网吧" name="remenber">记住密码&nbsp;&nbsp;&nbsp;
                                           </label>
                                           <!--路径问题不可用 <a type="button"  id="forget_pwd">忘记密码</a> -->
                                       </div>

                                   </div>
                               </div>

                               <img src="../../../img/smile.png" alt="smile" id="smile"><!--登陆右侧的图片-->


                               <div class="form-group">
                                   <div class="col-sm-offset-2 col-sm-10">
                                       <button type="submit" class="btn btn-info btn-sm" style="width: 168px;" id="login_btn">登录</button>
                                       <a href="../../../help/register.php" role="button" class="btn btn-success btn-sm" style="width: 128px;" id="a_reg">立即注册</a>
                                   </div>
                               </div>
                           </div>
                       </form>

                       <form action="#" class="form-horizontal" id="form_forget_pwd" >
                           <div id="resForm"></div>
                       </form>

                    </div>
           </div>

    </div>
    </div>
    <ol class="breadcrumb">
      <li><a href="javascript:" onClick="javascript :history.back(-1);">返回</a></li>
      <li class="active"><?php echo $post_title ?></li>
    </ol>

    <table class="table table-bordered" style="background-color: white;">
        <tbody>
            <tr>
                <td style="width: 186px;">
                    <div id="post_author" >
                        <p id="user_basic"><?php echo $post_user_name ?></p>
                        <img src="../../../<?php echo $post_user_head; ?>">
                        <p style="padding-top: 6px;">主题:<?php echo $post_count ?></p>
                    </div>
                </td>

                <td>
                    <div id="post_title">
                        <blockquote>
                            <p><a title="<?php echo $post_title ?>"><span>[<?php echo $post_type ?>]</span>&nbsp;<?php echo $post_title ?></a></p>
                            <footer>回复：<?php echo $comment_count ?>&nbsp;&nbsp;&nbsp;<?php echo $post_time ?><p class="pull-right">楼主</p></footer>

                        </blockquote>
                    </div>
                    <div id="post_content">
                        <h4><?php echo $post_content ?></h4>
                    </div>
                </td>
            </tr>

            
            <?php
                $db = new mysqli('localhost','gzhiyi','8023','help');
                mysqli_set_charset($db,'utf8');
                $comment_detail = "select * from postcomment where post_id='".$post_id."'";
                if ($comment_detail_result = mysqli_query($db, $comment_detail)) {
                    $floor_count = 2;
                    while ($row = mysqli_fetch_assoc($comment_detail_result)){ 
                        echo  '<tr>';
                            echo  '<td>';
                                echo  '<div id="post_author" >';
                                    echo  '<p id="user_basic">'.$row['comment_author'].'</p>';
                                    echo  '<img src="../../../'.$row['comment_author_head'].'">';
                                    /*echo  '<p style="padding-top: 6px;">主题:'.$post_count.'</p>';*/
                                echo  '</div>';
                            echo  '</td>';
                            echo  '<td  style="padding: 0 20px 20px 20px;">';
                                echo  '<div id="comment_head">';
                                    echo  '<p class="pull-right" style="padding-right: 18px;">'.$floor_count.'楼</p>';
                                    echo  '<p class="text-left">&nbsp;&nbsp;'.$row['comment_time'].'</p>';
                                echo  '</div>';
                                echo  '<div id="comment_content">';
                                    echo  '<h4>'.$row['comment_contents'].'</h4>';
                                echo  '</div>';
                            echo  '</td>';
                        echo  '</tr>';
                        $floor_count++;
                    }
                }
             ?>
            

            <?php
                error_reporting(0);
                if(isset($_POST['comment_submit'])){
                    $comment_text = $_POST['post_comment'];
                    $db = new mysqli('localhost','gzhiyi','8023','help');
                    mysqli_set_charset($db,"utf8");
                    if(mysqli_connect_errno()){//check connection
                        echo "error,database has fails in connection";
                        exit;
                    }
                    $insert_comment = "insert into postcomment (post_id,comment_author,comment_contents,comment_author_head) values ('".$post_id."','".$_SESSION['uuname']."','".$comment_text."','".$_SESSION['head']."')";
                    $insert_comment_result = mysqli_query($db,$insert_comment); 


                    date_default_timezone_set("Etc/GMT-8");
                    $nowTime = date("Y-m-d H:i:s");
                    $update_latest_time="update forum set last_comment_time='".$nowTime."' where post_id='".$post_id."'";
                    $update_latest_time_result = mysqli_query($db,$update_latest_time);        
                }
                     
             ?>

            <?php 
                if($_SESSION['uuid']){
                    echo  '<tr>';
                        echo  '<td></td>';
                        echo  '<td>';
                          echo  '<div class="alert alert-warning">';
                            echo  '<p>评论请注意措辞,共同营造和谐的氛围。</p>';
                          echo  '</div>';
                            echo  '<form action="" class="form" method="post" id="form_comment">';
                                echo  '<div class="form-group">';
                                    echo  '<textarea class="form-control" name="post_comment" id="post_comment" style="resize: none;height: 200px;"></textarea>';
                                echo  '</div>';
                                echo  '<div class="form-group">';
                                    echo  '<button name="comment_submit" type="button" id="comment_btn" class="btn btn-info pull-right">发表回复</button>'; 
                                echo  '</div>';
                            echo  '</form>';
                        echo  '</td>';
                    echo  '</tr>';
                }
                else{
                    echo  '<tr>';
                        echo  '<td></td>';
                        echo  '<td>';
                        echo '<fieldset disabled>';
                            echo  '<form action="" class="form" method="post">';
                                echo  '<div class="form-group">';
                                    echo  '<textarea class="form-control" name="post_comment" id="post_comment" style="resize: none;height: 200px;" placeholder="登录了才能发帖！"></textarea>';
                                echo  '</div>';
                                echo  '<div class="form-group">';
                                    echo  '<button type="button" class="btn btn-info pull-right ">发表回复</button>'; 
                                echo  '</div>';
                            echo  '</form>';
                            echo  '<fieldset>';
                        echo  '</td>';
                    echo  '</tr>';
                }

             ?>
        </tbody>
    </table>
</body>
</html>