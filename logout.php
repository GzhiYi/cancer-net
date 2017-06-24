<?php 
    session_start();
    $old_user = $_SESSION['uuid'];
    unset($_SESSION['uuid']);
    session_destroy();
    $url = "help.php";  
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";  
    echo "</script>";
 ?>
