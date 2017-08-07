<?php
    //尝试命令或者atom进行commit
    session_start();
    error_reporting(0);
    if(isset($_POST['username']) && isset($_POST['pwd'])){
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];
        $remenber = $_POST['remenber'];
        $db = new mysqli('localhost','gzhiyi','8023','help');
        mysqli_set_charset($db, "utf8");
        if (mysqli_connect_errno()) {
            echo "出现错误，无法连接数据库，请稍后再试";
            exit;
        }
        //设置记住用户名密码cookie
        if(!empty($remenber)){//判断是否选中记住密码选框
        setcookie("username",$username,time()+3600*24*1);//设置cookie
        setcookie("pwd",$pwd,time()+3600*24*1);//设置cookie
        }else{
            setcookie("username",null,time()-1);
            setcookie("pwd",null,time()-1);
        }
        $query = "select * from users where admin='0' and user_del='0' and user_name='".$username."' and user_pwd = '".$pwd."' limit 1";
        $result = mysqli_query($db,$query);

        if($result->num_rows){
            $_SESSION['uuname'] = $username;//如果用户登录成功就设置一个用户名会话变量
            while ($row = mysqli_fetch_assoc($result)) {
                   $_SESSION['uuid'] = $row['user_id'];/*还有加一个用户id会话变量*/
                   $_SESSION['head'] = $row['user_head'];//费力气
                   $_SESSION['admin'] = 0;
              }
        }
        else{
            $admin = "select * from users where admin='1' and user_name='".$username."' and user_pwd = '".$pwd."' limit 1";
            $admin_result = mysqli_query($db,$admin);
            if($admin_result->num_rows){
                $_SESSION['uuname'] = $username;//如果用户登录成功就设置一个用户名会话变量
                while ($row = mysqli_fetch_assoc($admin_result)) {
                       $_SESSION['uuid'] = $row['user_id'];/*还有加一个用户id会话变量*/
                       $_SESSION['head'] = $row['user_head'];//费力气
                       $_SESSION['admin'] = 1;


                  }
                $url = "admin/admin.php";
                echo "<script type='text/javascript'>";
                echo "window.location.href='$url'";
                echo "</script>";
            }
            else{
                echo  '<div class="alert alert-danger alert-dismissible">';
                  echo  '<button type="button" class="close" data-dismiss="alert">';
                      echo  '<span aria-hidden="true">&times;</span>';
                  echo  '</button>提示：登陆失败,请检查用户名或者密码是否正确;确保无误请联系管理员进行账号查询。';
                echo  '</div>';
            }

        }
        $db->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欢迎来到癌症互助交流网</title>
    <link rel="stylesheet" href="src/style/css/bootstrap.min.css" />
    <link rel="stylesheet" href="src/style/help_style.css">
    <link rel="stylesheet" href="src/style/validation.css">
    <script src="src/js/jquery-3.1.1.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/js/jquery.metadata.js"></script>
    <script src="src/js/jquery.validate.min.js"></script><!-- jquery validate 验证 -->
    <script src="src/js/messages_zh.min.js"></script>
    <script src="src/js/userHandler.js"></script><!--处理用户注册登录的validate验证-->
    <script src="src/js/find_pwd.js"></script><!--处理密码找回的交互-->
    <script src="src/js/jquery.form.min.js"></script>
    <script src="src/js/help_base.js"></script>
</head>

<body class="body-help">
    <nav class="navbar navbar-default navbar-fixed-top">
        <a href="help.php" class="navbar-brand">Logo</a>
        <ul class="nav navbar-nav">
            <li class="active" id="help"><a href="help.php"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
            <li><a href="knowledge.php"><span class="glyphicon glyphicon-fire"></span> 防癌知识</a></li>
<!--             <li><a href="#"><span class="glyphicon glyphicon-heart"></span> 携手抗癌</a></li>取消，因为此页存在争议问题 -->
            <li><a href="help_each.php" id="help_each"><span class="glyphicon glyphicon-magnet"></span> 互助交流</a></li>
            <li><a href="announcement.php"><span class="glyphicon glyphicon-comment"></span> 最新公告</a></li>
            <li ><a href="#" data-toggle="dropdown"> 更多<span class="caret"></span></a>
                <ul class="dropdown-menu">
                   <li><a href="#" class="help_contact"><span class="glyphicon glyphicon-phone-alt "></span> 联系我们</a></li>
                   <li><a href="#" class="help_about"><span class="glyphicon glyphicon-info-sign "></span> 关于</a></li>
                </ul>
            </li>
            <form action="search/searchresult.php" class="navbar-form pull-right" id="search_form" method="POST"><!-- 搜索框 -->
                <div class="form-group">
                  <div class="input-group" >
                    <input type="text" class="form-control" placeholder="搜索..." id="search-input" name="keyword">
                    <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" id="search-btn" style="height: 34px;">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                  </div>
                </div>
            </form>
        </ul>

        <?php
            if(isset($_SESSION['uuid'])){//处理登录逻辑，没登录显示登录按钮，反之显示用户头像和用户名等

              echo  '<div id="login-success">';
                echo  '<span>';
                    echo  '<img title="uuid" id="login-head" src="'.$_SESSION['head'].'" alt="用户id" class="img-circle" >';
                    echo  '<a href="setting/account.php?uname='.$_SESSION['uuname'].'">&nbsp;'.$_SESSION['uuname'].'</a>';
                    echo '<a href="logout.php?uname='.$_SESSION['uuname'].'"> 退出</a>';
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
                   <h4 class="modal-title">用户登录</h4>
               </div>

               <div class="modal-body">
                   <form action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" id="form_login" method="post">
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

                   <form action="#" class="form-horizontal" id="form_forget_pwd" ><!-- 用于通过邮箱找回密码 -->
                       <div id="resForm">
                       </div>
                   </form>

                </div>
           </div>
        </div>
    </div>

   <div class="body-content">
        <!-- 首页轮播（待添加内容） -->
        <div id="carousel-my" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="carousel-my" data-slide-to="0" class="active"></li>
                <li data-target="carousel-my" data-slide-to="1"></li>
                <li data-target="carousel-my" data-slide-to="2"></li>
                <li data-target="carousel-my" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img src="img/lunbo1.jpg" alt="">
                    <div class="carousel-caption">
                      <h2>像绿叶般新生</h2>
                      <p>寻找知己</p>
                    </div>
                </div>

                <div class="item">
                    <img src="img/lunbo2.jpg" alt="">
                    <div class="carousel-caption">
                      <h2>百花齐放</h2>
                      <p>聊一聊身边的事，总有人愿意倾听</p>
                    </div>
                </div>

                <div class="item">
                    <img src="img/lunbo3.jpg" alt="">
                    <div class="carousel-caption">
                      <h2>细水长流</h2>
                      <p>帮助需要帮助的人</p>
                    </div>
                </div>
                <div class="item">
                    <img src="img/lunbo.png" alt="">
                    <div class="carousel-caption">
                      <h2>迎接新生的太阳</h2>
                      <p>一切都是希望</p>
                    </div>
                </div>
            </div>

            <a href="#carousel-my" class="left carousel-control"  data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>

            <a href="#carousel-my" class="right carousel-control"  data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</body>
</html>
