<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>互助交流</title>
    <link rel="stylesheet" href="src/style/css/bootstrap.min.css" />
    <link rel="stylesheet" href="src/style/help_style.css">
    <link rel="stylesheet" href="src/style/validation.css">
    <script src="src/js/jquery-3.1.1.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/js/jquery.metadata.js"></script>
    <script src="src/js/jquery.validate.min.js"></script>
    <script src="src/js/messages_zh.min.js"></script>
    <script src="src/js/jquery.form.min.js"></script>
    <script src="src/js/help_base.js"></script><!-- 页面主要js样式位置 -->
    <script src="src/js/postHandler.js"></script><!--处理帖子发帖的validate验证-->
    <script src="src/js/find_pwd.js"></script><!--处理密码找回的交互-->
    <script src="src/js/userHandler.js"></script><!--处理帖子发帖的validate验证-->
</head>
<body class="body-help_each">
     <nav class="navbar navbar-default navbar-fixed-top">
        <a href="help.php" class="navbar-brand">Logo</a>
        <ul class="nav navbar-nav">
            <li id="help"><a href="help.php"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
            <li><a href="knowledge.php"><span class="glyphicon glyphicon-fire"></span> 防癌知识</a></li>
<!--             <li><a href="#"><span class="glyphicon glyphicon-heart"></span> 携手抗癌</a></li> -->
            <li class="active"><a href="help_each.php" id="help_each"><span class="glyphicon glyphicon-magnet"></span> 互助交流</a></li>
            <li><a href="announcement.php"><span class="glyphicon glyphicon-comment"></span> 最新公告</a></li>
            <li ><a href="#" data-toggle="dropdown"> 更多<span class="caret"></span></a>
                <ul class="dropdown-menu">
                   <li><a href="#" class="help_contact"><span class="glyphicon glyphicon-phone-alt "></span> 联系我们</a></li>
                   <li><a href="#" class="help_about"><span class="glyphicon glyphicon-info-sign "></span> 关于</a></li>
                </ul>
            </li>
            
            <form action="search/searchresult.php" class="navbar-form pull-right" id="search_form" method="post"><!-- 搜索框 -->
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
            session_start();
            if(isset($_SESSION['uuid'])){
              echo  '<div id="login-success">';
                echo  '<span>';
                    echo  '<img title="uuid" id="login-head" src="'.$_SESSION['head'].'" alt="用户id" class="img-circle" >';
                    echo  '<a href="setting/account.php">&nbsp;'.$_SESSION['uuname'].'</a>';
                    echo '<a href="logout.php">   退出</a>';
                echo  '</span>';
              echo  '</div>';
            }
            else{
               echo '<div id="reg_div">';
                  echo  '<span id="reg_btn">';
                    echo  '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#login" >用户登录</button>';
                    echo '<a href="help/register.php" class="btn btn-success">注册</a>';
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
                       <form action="help.php" class="form-horizontal" id="form_login" method="post">
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
                                           <a type="button"  id="forget_pwd">忘记密码</a>
                                       </div>

                                   </div>
                               </div>

                               <img src="img/smile.png" alt="smile" id="smile"><!--登陆右侧的图片-->


                               <div class="form-group">
                                   <div class="col-sm-offset-2 col-sm-10">
                                       <button type="submit" class="btn btn-info btn-sm" style="width: 168px;" id="login_btn">登录</button>
                                       <a href="help/register.php" role="button" class="btn btn-success btn-sm" style="width: 128px;" id="a_reg">立即注册</a>
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

    <div class="page-header" style="background-color: ">
        <h1>互助交流区&nbsp;&nbsp;&nbsp;&nbsp;<small>寻找心声</small></h1>
         <button type="button" class="btn btn-default btn-sm" id="refresh" title="刷新"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>    
    </div>

    <h4>板块主题</h4><hr>
    <!-- 发布内容modal -->
    <div class="modal fade" id="send_modal" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                   <h4 class="modal-title">发布新帖子</h4>
                </div>

                <div class="modal-body">
                    <form action="help_each/forum/forum.php" id="form_posts" class="form-horizontal" method="post">
                       <!--  标题 -->
                        <div class="form-group">
                            <label for="posts_title" class="control-label col-md-2">*标题</label>
                            <div class="col-md-10 ">
                                <input type="text" name="posts_title" id="posts_title" class="form-control " style="width: 500px;" placeholder="帖子标题">
                                <input type="text" style="display: none;">
                            </div>
                        </div>
                        <!-- 类别选择栏 -->
                        <div id="Post_selec">
                            <div class="selector">
                                <select class="form-control" name="posts_type" id="">
                                    <option value="分享">分享</option>
                                    <option value="知识">知识</option>
                                    <option value="求助">求助</option>
                                    <option value="交友">交友</option>
                                </select>
                            </div>
                        </div>
                        
                        
                       <!--  插入栏 -->
                       <div class="col-md-offset-2 col-md-10">
                           <div class="btn-group btn-group-xs">
                               <button type="button" class="btn btn-default glyphicon glyphicon-picture" title="插入图片"></button>
                               <button type="button" class="btn btn-default glyphicon glyphicon-facetime-video" title="插入视频"> </button>
                               <button type="button" class="btn btn-default glyphicon glyphicon-paperclip" title="附件"></button>
                           </div>
                       </div>
                       <hr>
                        <!-- 帖子正文代码 -->
                        <div class="form-group">
                            <label for="posts_content" class="control-label col-md-2">*正文</label>
                            <div class="col-md-9">
                                <textarea name="posts_content" id="posts_content" cols="30" rows="10" class="form-control" placeholder="帖子正文" style="resize: none;"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-9">
                              <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>发布框在点击发布帖子按钮 <strong>1</strong> 秒后关闭
                              </div>
                                <button type="button" class="btn btn-success pull-right" id="send_post_btn">发布帖子</button>
                            </div>
                        </div>
                    </form>  
                </div>

            </div>
        </div>
    </div>
    
     <ul id="post_ul" class="col-md-8">
        <?php 
        error_reporting(0);
        $db = new mysqli('localhost','gzhiyi','8023','help');
        mysqli_set_charset($db,"utf8");
        if(mysqli_connect_errno()){//check connection
            echo "error,databse has fails in connection";
            exit;
        }
        /*一个页面只加载20条帖子*/
        $query = "select * from forum where del='0' order by last_comment_time desc limit 30"; 

        $checktime = 'select time from forum order by time desc limit 1';
        if ($time = mysqli_query($db, $checktime)) {
           while ($row = mysqli_fetch_assoc($time)){ 
              $lasttime = $row['time'];
           }
         }
        date_default_timezone_set("Etc/GMT-8");
        $timestamp = date("Y-m-d H:i:s");
        $righttime = strtotime($timestamp)-strtotime($lasttime);    
        echo  '<div class="alert alert-success">';
            if($righttime > 3600){
              echo  '最新帖子更新大概为：'.(int)($righttime/3600).'小时前';
            }
            else if($righttime< 3600 && $righttime>60){
              echo  '最新帖子更新为：'.(int)($righttime/60).'分钟前';
            }
            else{
              echo  '最新帖子更新为：'.(int)$righttime.'秒前';
            }
        echo  '</div>';
        



        if ($result = mysqli_query($db, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
            $comment_global = "select * from postcomment where post_id='".$row['post_id']."'";//评论数
            if($comment_global_result = mysqli_query($db,$comment_global)){
                $comment_count = mysqli_num_rows($comment_global_result);
             }                
            echo "<div class='posts_content'>";
            echo "<li class='list-inline'>";
            echo "<div class='media media_magin'>";
                 echo "<div class='media-left media-top'>";
                     echo "<a href='#'>";
                         echo "<img src='".$row['user_head']."' alt='用户头像'>";
                     echo "</a>";
                 echo "</div>";
                 echo "<div class='media-body'>";
                 echo "<h4 style='font-size: 16px;' class='media-heading'> <span class='label label-info'>".$row['type']."</span>&nbsp;<a style='text-decoration: none;color: black;' href='help_each/forum/posts/postdetail.php?post_id=".$row['post_id']."'>".$row['title']."</a>";
                 echo "</h4>";
                 echo  '<div id="footnote" style="position: relative;top: 6px; ">';
                 echo  '<p style="color: #d0d4d8">'.$row['user_name'].'&nbsp;&nbsp;&nbsp;回复：'.$comment_count.'&nbsp;&nbsp;&nbsp;'.$row["time"].'&nbsp;&nbsp;&nbsp;<span class="pull-right">最新:'.$row['last_comment_time'].'</span></p>';
                 echo  '</div>'; 
                 echo "</div>";

                 echo "</div>";
                 echo "<hr>";
             echo "</li>";
           echo "</div>";
      }
}

?>
    </ul>

    <!-- echo  "<div id='text'>";在213行添加这三行代码可以实现标题下面的内容dddd不需要不需要
         echo "<p>".$row['content']."</p>";内容取消。原因：内容太多。
         echo "</div>";-->
    <div class="col-md-offset-1 col-md-2">
      <?php 
            if(isset($_SESSION['uuid'])){
              echo  '<button type="button" id="sendnewpost" class="btn btn-info" data-toggle="modal" data-target="#send_modal"><span class="glyphicon glyphicon-edit"></span>  发布新内容</button>&nbsp;&nbsp;';
            }else{
              echo  '<div id="login_note" class="alert alert-info" style="width: 230px;">提示：需要登录才能发帖</div>';
              echo  '<button type="button" id="sendnewpost" disabled="disabled" class="btn btn-info"><span class="glyphicon glyphicon-edit" ></span>  发布新内容</button>';
            }
         ?>
         
    </div>




   <!--  底部分页  已经取消，逐步加入通过滑动到底部ajax更新的形式更新内容 -->
<!--    <nav>
    <ul class="pagination">
        <li><a href="#"><span>&laquo;</span></a>

        </li>
        <li class="active"><a href="#" >1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#"><span>&raquo;</span></a>
        </li>
    </ul>
</nav> -->
</body>
</html>