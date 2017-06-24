<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SearchResult</title>
    <link rel="stylesheet" href="../src/style/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/js/bootstrap.min.js" />
    <link rel="stylesheet" href="../src/style/validation.css">
    <script src="../src/js/jquery-3.1.1.min.js"></script>
    <script src="../src/js/bootstrap.min.js"></script>
    <script src="../src/js/jquery.metadata.js"></script>
    <script src="../src/js/jquery.validate.min.js"></script>
    <script src="../src/js/messages_zh.min.js"></script>
    <script src="../src/js/jquery.form.min.js"></script>
    <script src="../src/js/postHandler.js"></script><!--处理帖子发帖的validate验证-->
    <script src="../src/js/find_pwd.js"></script><!--处理密码找回的交互-->
    <script src="../src/js/userHandler.js"></script><!--处理帖子发帖的validate验证-->
    <style>
        #search_result_content{
            position: relative;
            top:20px;
        }
        #search{
            width: 600px;
            margin: 0 auto;
            padding-top: 120px;
        }
        #search-input{
            height: 48px;
            border-radius: 5px 0 0 5px;
            font-size:16px;
            border:1px solid blur;
        }
        #search-btn{
            height: 48px;
            width: 50px;
        }
        #back{
            position: absolute;
            left: 150px;
        }
        #back a{
            color: #ccc;
            font-size: 18px;
            text-decoration: none;
        }
        #back a:hover{
            color: blue;
        }
        #logo{
            position: absolute;
            width: 200px;
            height: 100px;
            left: 560px;
            top: 44px;;
        }

    </style>
    <script>
        $(function(){
            $("#search-btn").click(function(){
                var $serachIpt = $("#search-input");
                if($serachIpt.val() === ""){
                    $serachIpt.parent().addClass("has-error");
                    $("#search-btn").popover("toggle");
                    return false;
                }
            });
        });
    </script>
</head>
<body>
    <ol class="breadcrumb">
      <li><a href="../help.php">主页</a></li>
      <li><a href="javascript:" onClick="javascript :history.back(-1);">返回上一页</a></li>
      <li class="active">搜索</li>
    </ol>
    <div>
        <img id="logo" src="../img/searchlogo.png">
    </div>
    <div id="search">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" class="form" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" id="search-input">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary" id="search-btn" data-toggle="popover" data-target="click" data-content="请输入搜索关键字" data-placement="right"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </form>
    </div>
    <div class="container" id="search_result_content">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 a">
                <?php
                    error_reporting(0); 
                    $keyword = $_POST['keyword'];
                    $db = new mysqli('localhost','gzhiyi','8023','help');
                    mysqli_set_charset($db,"utf8");
                    if(mysqli_connect_errno()){//check connection
                        echo "error,database has fails in connection";
                        exit;
                    }
                    $query = "select * from forum where del='0' and title like'%".$keyword."%'";
                    $result = mysqli_query($db, $query);
                    $num_rows = mysqli_num_rows($result);
                    echo "<h3>结果：找到关键字\" $keyword \"相关内容 ".$num_rows." 个</h3>";
                    echo  "<table class='table table-striped table-hover'>";
                        echo  "<thead>";
                            echo "<tr >";
                                echo  "<th>标题</th>";
                                echo  "<th>作者</th>";
                                echo  "<th>发布时间</th>";
                            echo  "</tr>";
                        echo  "</thead>";
                    echo  "<tbody id='search_result_tbody_html'>";                        
                    if ($result = mysqli_query($db, $query)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                                 echo  "<tr>";
                                     echo  "<td><a style='text-decoration: none;' href='../help_each/forum/posts/postdetail.php?post_id=".$row['post_id']."'>".$row['title']."</a></td>";
                                     echo  "<td>".$row['user_name']."</td>";
                                     echo  "<td>".$row['time']."</td>";
                                 echo  "</tr>";
                            }
                        }
                    echo "</tbody>";
                    ?>
                    
                </table>
            </div>

            <!-- <div class="col-md-4">
                <div class="list-group">
                <button type="button" class="list-group-item">  <span class="glyphicon glyphicon-duplicate"></span> 文章</button>
                <button type="button" class="list-group-item">  <span class="glyphicon glyphicon-user"></span> 用户</button>
                <button type="button" class="list-group-item">  <span class="glyphicon glyphicon-floppy-save"></span> 帖子</button>
                <button type="button" class="list-group-item">  <span class="glyphicon glyphicon-hourglass"></span> 时间</button>
            
                </div>
            </div> -->
        </div>

    </div>
</body>
</html>