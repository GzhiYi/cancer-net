<?php 
    session_start();
    header("Content-Type:text/html;charset=utf-8");
    $posts_title = $_POST['posts_title'];
    $posts_content = $_POST['posts_content'];
    $posts_type = $_POST['posts_type'];

    $db = new mysqli('localhost','gzhiyi','8023','help');
    mysqli_set_charset($db, "utf8");

    if (mysqli_connect_errno()) {
        echo "出现错误，无法连接数据库，请稍后再试";
        exit;
    }

    $check_query = mysqli_query($db,"insert into forum(title,content,user_name,user_id,type,user_head) values ('".$posts_title."','".$posts_content."','".$_SESSION['uuname']."','".$_SESSION['uuid']."','".$posts_type."','".$_SESSION['head']."')");


    if (!$check_query) {
        printf("Error: %s\n", mysqli_error($db));
    exit();
    }
    if(!@$result = mysqli_fetch_array($check_query)){
        echo "插入成功...你可以刷新看看你的帖子";
    }
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Document</title>
 </head>
 <body>
     
 </body>
 </html>