<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欢迎新用户注册</title>
    <link rel="stylesheet" href="../src/style/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../src/style/help_style.css">
    <link rel="stylesheet" href="../src/style/validation.css">
    <script src="../src/js/jquery-3.1.1.min.js"></script>
    <script src="../src/js/bootstrap.min.js"></script>
    <script src="../src/js/jquery.metadata.js"></script>
    <script src="../src/js/jquery.validate.min.js"></script>
    <script src="../src/js/messages_zh.min.js"></script>
    <script src="../src/js/userHandler.js"></script><!--处理用户注册登录的validate验证-->
    <script src="../src/js/jquery.form.min.js"></script>
    <script src="../src/js/help_base.js"></script>
    <script src="../src/js/find_pwd.js"></script>
</head>
<body>
    <!-- 登陆模态框 -->
    <div class="modal fade" id="login" tabindex="-1" data-backdrop="static">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <button class="close"  data-dismiss="modal"><span>&times;</span></button>
                       <h4 class="modal-title">用户登录</h4>
                   </div>

                   <div class="modal-body">
                       <form action="../help.php" class="form-horizontal" id="form_login" method="post">
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
                                       </div>

                                   </div>
                               </div>

                               <img src="../img/smile.png" alt="smile" id="smile"><!--登陆右侧的图片-->

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
    <ol class="breadcrumb">
      <li><a href="../help.php">主页</a></li>
      <li><a href="javascript:" onClick="javascript :history.back(-1);">返回上一页</a></li>
      <li class="active">用户注册</li>
    </ol>
    <div class="container">
        <div class="jumbotron">
            <h1 id="reg-tip">欢迎新用户注册</h1>
            <h3>在这你将获得有关癌症的充分知识以及预防措施</h3>
            <p>新用户注册请在下面填写注册信息</p>
            <!-- <p><a href="../help.php" class="btn btn-info">了解更多，可进入主页</a></p> -->
        </div>
         <?php 
            error_reporting(0);
            if(isset($_POST['submit'])){
                $reg_name = $_POST['reg_name'];
                $reg_pwd = $_POST['reg_pwd'];
                $reg_email = $_POST['reg_email'];
                $reg_sex = $_POST['sex'];
                $db = new mysqli('localhost','gzhiyi','8023','help');
                mysqli_set_charset($db, "utf8");

                if(mysqli_connect_errno()){
                    echo "连接数据库失败，请稍后再试或者联系维护人员。";
                    exit;
                }
                $query_username = "select user_name from users where user_name ='".$reg_name."'";
                $query_email = "select email from users where email ='".$reg_email."'";
                $check_username = mysqli_query($db,$query_username);
                $check_email = mysqli_query($db,$query_email);
                /*$result = mysqli_fetch_array($check_query);
                $result_username = mysqli_fetch_array($check_query);
                $result_email = mysqli_fetch_array($check_query);*/

                if(mysqli_num_rows($check_username) !== 0){
                    echo  '<div class="alert alert-danger alert-dismissible">';
                      echo  '<button type="button" class="close" data-dismiss="alert">';
                          echo  '<span aria-hidden="true">&times;</span>';
                      echo  '</button>提示：用户名"'.$reg_name.'" 已经被注册，请更换用户名';
                    echo  '</div>';

                }else{
                    if(mysqli_num_rows($check_email) !== 0){
                    echo  '<div class="alert alert-danger alert-dismissible">';
                      echo  '<button type="button" class="close" data-dismiss="alert">';
                          echo  '<span aria-hidden="true">&times;</span>';
                      echo  '</button>提示：邮箱 '.$reg_email.'已被注册，请更换邮箱进行注册';
                    echo  '</div>';
                    mysqli_free_result($check_email);
         
                    }else{
                        $check_query = mysqli_query($db,"insert into users(user_name,user_pwd,email,sex,user_head) values ('".$reg_name."','".$reg_pwd."','".$reg_email."','".$reg_sex."','img/head/head".rand(1,50).".jpg')");
                          echo  '<div class="alert alert-success alert-dismissible">';
                            echo  '<button type="button" class="close" data-dismiss="alert">';
                                echo  '<span aria-hidden="true">&times;</span>';
                            echo  '</button>提示：恭喜,注册成功！<a type="button"  data-toggle="modal" data-target="#login" >马上登录?</a>';
                          echo  '</div>';
                    }
                }
                    
            }
         ?>

        <div class="row">
            <div class="col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" method="post" id="form_reg">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">*用户名</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="reg_name" id="reg_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">*密码</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="reg_pwd" id="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">*确认密码</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="reg_repwd">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">*邮箱</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="reg_email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">性别</label>
                        <div class="col-sm-7">
                           <div class="radio">
                               <label for="">
                                   <input type="radio" name="sex" value="male">男
                               </label>&nbsp;&nbsp;&nbsp;&nbsp;
                               <label for="">
                                   <input type="radio" name="sex" value="female">女
                               </label>
                           </div>
                       </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="submit" class="btn btn-success" style="width: 270px;">点击注册</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>