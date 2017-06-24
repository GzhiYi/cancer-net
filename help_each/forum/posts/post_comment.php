<?php
    $comment_text = $_POST['post_comment'];
    $db = new mysqli('localhost','gzhiyi','8023','help');
    mysqli_set_charset($db,"utf8");
    if(mysqli_connect_errno()){//check connection
        echo "error,database has fails in connection";
        exit;
    }
    var_dump($comment_text);
    $insert_comment = "insert into postcomment (post_id,comment_author,comment_contents) values ('".$post_id."','".$_SESSION['uuname']."','".$comment_text."')";
    $insert_comment_result = mysqli_query($db,$insert_comment);
    
 ?>