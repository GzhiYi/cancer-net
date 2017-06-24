<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>最新公告</title>
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
    <style type="text/css">
        #myreport{
            position: relative;
            top: 50px;
        }
        pre{
            width: 500px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <a href="help.php" class="navbar-brand">Logo</a>
        <ul class="nav navbar-nav">
            <li id="help"><a href="help.php"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
            <li><a href="knowledge.php"><span class="glyphicon glyphicon-fire"></span> 防癌知识</a></li>
<!--             <li><a href="#"><span class="glyphicon glyphicon-heart"></span> 携手抗癌</a></li> -->
            <li><a href="help_each.php" id="help_each"><span class="glyphicon glyphicon-magnet"></span> 互助交流</a></li>
            <li class="active"><a href="announcement.php"><span class="glyphicon glyphicon-comment"></span> 最新公告</a></li>
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
        <!-- <div id="reg_div">
          <span id="reg_btn">用户登录注册入口
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#login" >用户登录</button>
            <a href="help/register.html" class="btn btn-success">注册</a>
          </span>
        </div> -->
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
                                       <input type="text" class="form-control inp_wid" name="username" placeholder="用户名/邮箱" value="<?php echo @$_COOKIE['username'] ?>">
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
                                       <a href="help/register.html" role="button" class="btn btn-success btn-sm" style="width: 128px;" id="a_reg">立即注册</a>
                                   </div>
                               </div>
                           </div>
                       </form>

                       <form action="#" class="form-horizontal" id="form_forget_pwd" >
                           <div id="resForm"></div>
                       </form>

                       <form action="#" class="form-horizontal" id="form_forget_pwd" >
                           <div id="resForm"></div>
                       </form>

                    </div>
           </div>

    </div>
    </div>
    <div id="myreport">
        <div class="container">
            <div class="rows">
                <ol>
                    <li>
                      <h5>6.20验收置顶</h5>
                      <pre>
项目主要页面"互助交流区"基本完成。主要有以下功能：
所用技术：
前台页面：html css javascript jquery 
          相关框架： jquery的validate,bootstrap
后台处理：php mysql

1.全局表单validate验证。不符合要求有提示错误信息。
2.注册登录完善。对已存在的用户名或者邮箱进行注册判断。
3.登录模态框。忘记密码为ajax异步刷新。记住密码cookie完成。
4.主要页面增加导航路径，提供返回上一页或有返回主页链接。
5.搜索可用。模糊搜索，并有搜索框动画效果。搜索结果显示的
标题可以直接点击到达目标位置。
6.互助交流-刷新按钮为异步刷新加载posts.php信息。
帖子列表为media组件。包含评论数、时间等基本信息。
7.有登录逻辑，用户没有登录不可以进行发帖操作(发帖按钮disabled),
不可以进行评论。
8.帖子最新发布时间有提示。
9.用户个人中心可以修改用户个人基本信息。修改敏感信息会要求重新
登录。可以一次修改某项或修改表单所有。
用户个人中心可以对自己发布的帖子进行查看和管理。查看为点击链接进
入，删除为点击删除按钮进行操作(二次确认)。
10.用户个人中心可修改个人密码。需要验证原密码是否正确。对个人信息
修改结果均有符合逻辑的提醒。
11.有管理员页面。不与普通用户登录页面分割，按账号进行区分。实际为
users表中admin字段进行判断。
12.管理员作用：对用户发布帖子进行删除，对用户进行删除。
13.管理员可以修改个人基本信息。操作：点击左上角首页退出管理员页面
同样管理员可以进行和普通用户相同的操作(发帖等);
14.对删除的信息并不是直接从数据库抹除。只增加删除标志。
15.管理员可以在管理页面进行搜索。按帖子标题和用户名分别搜索。
16.头像随机分配。1/50概率。
------------------------------------------------------------------
存在缺陷：
1.邮箱验证没有做。[次要]
2.暂时不可修改头像以及性别(摊手)。
3.评论不可评论回复的评论。[重要]
4.评论无提醒。[重要]
5.首页信息简短。需要时可补充。
6.滚动异步刷新暂时未实现。[重要]
                      </pre>
                    </li>
                    <li>
                        <h5>让textarea永久不能拖拽</h5>
                        <pre>添加样式style      {resize:none;}</pre>
                    </li>
                    <li>
                        <h5>注意增加相对定位后网页的总体宽度会超过原本</h5>
                        <pre>将position:absolute 改为 relative要注意</pre>
                    </li>
                    <li>
                        <h5>6月8号增加用户登录</h5>
                        <pre>涉及php 会话 session和cookie</pre>
                    </li>
                    <li>
                        <h5>php echo</h5>
                        <pre>可以这样：echo '&lt;p&gt;"$var"&lt;/p&gt;' ;</pre>
                    </li>
                    <li>
                        <h5>帖子分页取消</h5>
                        <pre>取消bootstrap分页样式，直接使用刷新进行异步更新 6-8 16:40</pre>
                    </li>
                    <li>
                        <h5>用户信息管理页取消ajax操作</h5>
                        <pre>ajax异步加载的的load() 所加载的html不会执行主页的js代码，委托事件查询到效果也不好所以放弃原有代码 6-9 11:40</pre>
                    </li>
                    <li>
                        <h5>欠缺</h5>
                        <pre>对操作的响应。比如退出账号等一些提醒没有做到位</pre>
                    </li>
                    <li>
                        <h5>数据库跳转可以用到php语句</h5>
                        <pre>                            $url = "目标页面";  
                            echo "&lt;script type='text/javascript'&gt;";  
                            echo "window.location.href='$url'";  
                            echo "&lt;/script&gt;";</pre>
                    </li>
                    <li>
                        <h5>6月12号目标</h5>
                        <pre>为个人中心的表单增加所需要的验证
1.表单增加validate验证
2.删除弹窗提醒</pre>
                    </li>
                    <li>
                      <h5>input-group 和validate的问题</h5>
                      <pre>
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
                      </pre>
                    </li>
                    <li>
                      <h5>放弃个人中心关于性别的修改</h5>
                      <pre>
原因：不会。php获取的sex值就算没有勾选也有值的存在 [摊手]
                      </pre>
                    </li>
                    <li>
                      <h5>修改好用户信息那块中文显示异常(???)的问题</h5>
                      <pre>
方法，在每个数据库连接语句后增加编码设置:mysqli_set_charset($db,"utf8");
                      </pre>
                    </li>
                     <li>
                      <h5>搜索结果取消搜索内容</h5>
                      <pre>

                      </pre>
                    </li>
                    <li>
                      <h5>617增加</h5>
                      <pre>
解决刷新重复出现一个帖子问题,加入删除标识符del，删除为1，没删除为0,
                      </pre>
                    </li>
                    <li>
                      <h5>6.18</h5>
                      <pre>
管理员模块完成，增加搜素以便删除。
修复关于登陆失败警告框会影响搜索框搜索按钮显示的bug
方法：给搜索按钮增加一个高度。
                      </pre>
                    </li>
                    <li>
                      <h5>关于php中设置时间date("Y-m-d H:i:s")慢8小时的问题</h5>
                      <pre>
时区没有设置好，正确而且还很方便的做法是：
在时间生成之前加入函数：
date_default_timezone_set("Etc/GMT-8");
                      </pre>
                    </li>
                    <li>
                      <h5>测试问题</h5>
                      <pre>
花费很长时间，在登录处。把头像的路径保存到数据库。拿出来的
时候，发现一直null。原因是在第一次测试失败之后一直保持登录
的形式进行测试。所以没有测试出结果，需要退出从新登陆在能看
出测试结果。
                      </pre>
                    </li>
                     <li>
                      <h5>6.19</h5>
                      <pre>
凌晨完整解决头像问题。明天换库测试。0:50
                      </pre>
                    </li>
                    <li>
                      <h5>6.20验收版</h5>
                      <pre>
增加轮播图图片，修改防癌知识页面布局，暂时不需要添加数据。
用户头像新增至50张，为默认分配。
                      </pre>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</body>
</html>