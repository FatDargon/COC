<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
//注销登录  
if($_GET['action'] == "logout"){  
    unset($_SESSION['userid']);  
    unset($_SESSION['username']);  
    echo '注销登录成功！点击此处 <a href="login.html">登录</a>';  
    exit;  
}  
?>