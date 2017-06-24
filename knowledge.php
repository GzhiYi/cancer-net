<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>防癌知识普及</title>
    <link rel="stylesheet" href="src/style/css/bootstrap.min.css" />
    <link rel="stylesheet" href="src/style/help_style.css">
    <link rel="stylesheet" href="src/style/validation.css">
    <script src="src/js/jquery-3.1.1.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/js/jquery.metadata.js"></script>
    <script src="src/js/jquery.validate.min.js"></script>
    <script src="src/js/messages_zh.min.js"></script>
    <script src="src/js/userHandler.js"></script><!--处理用户注册登录的validate验证-->
    <script src="src/js/find_pwd.js"></script><!--处理密码找回的交互-->
    <script src="src/js/jquery.form.min.js"></script>
    <script src="src/js/help_base.js"></script>
</head>
<body class="body-knowledge">
    <nav class="navbar navbar-default navbar-fixed-top">
        <a href="help.php" class="navbar-brand">Logo</a>
        <ul class="nav navbar-nav">
            <li id="help"><a href="help.php"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
            <li class="active"><a href="knowledge.php"><span class="glyphicon glyphicon-fire"></span> 防癌知识</a></li>
<!--             <li><a href="#"><span class="glyphicon glyphicon-heart"></span> 携手抗癌</a></li> -->
            <li><a href="help_each.php" id="help_each"><span class="glyphicon glyphicon-magnet"></span> 互助交流</a></li>
            <li><a href="announcement.php"><span class="glyphicon glyphicon-comment"></span> 最新公告</a></li>
            <li ><a href="#" data-toggle="dropdown"> 更多<span class="caret"></span></a>
                <ul class="dropdown-menu">
                   <li><a href="#" class="help_contact"><span class="glyphicon glyphicon-phone-alt "></span> 联系我们</a></li>
                   <li><a href="#" class="help_about"><span class="glyphicon glyphicon-info-sign "></span> 关于</a></li>
                </ul>
            </li>
            <form action="search/searchresult.php" class="navbar-form pull-right" id="search_form" method="POST"><!-- 搜索框 -->
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
                       <h4 class="modal-title">用户登录</h4>
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

                   <form action="#" class="form-horizontal" id="form_forget_pwd" ><!-- 用于通过邮箱找回密码 -->
                       <div id="resForm">
                       </div>
                   </form>

                </div>
           </div>
        </div>
    </div>

  <ul class="nav nav-tabs">
    <li class="active"><a href="#">分类别展示</a></li>
    <li ><a href="#">第二类别</a></li>
    <li ><a href="#">第三类别</a></li>
  </ul>
  <div class="container">
    <div class="col-md-9">
         知识为摘抄，先不贴
    </div>
  </div>
</body>
</html>