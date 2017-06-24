<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php 
        header("Content-Type:text/html;charset=utf-8");
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
            $comment_global = "select * from postcomment where post_id='".$row['post_id']."'";
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
                 echo  '<p style="color: #d0d4d8">'.$row['user_name'].'&nbsp;&nbsp;&nbsp;回复：'.$comment_count.'&nbsp;&nbsp;&nbsp;'.$row["time"].'<span class="pull-right">最新:'.$row['last_comment_time'].'</span></p>';
                 echo  '</div>'; 
                 echo "</div>";

                 echo "</div>";
                 echo "<hr>";
             echo "</li>";
           echo "</div>";
      }
}
?>
</body>
</html>