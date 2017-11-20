<?php  
//登录  
if(!isset($_POST['submit'])){  
    exit('非法访问!点击此处 <a href="login.html">返回</a>');  
}  
$username = htmlspecialchars($_POST['username']);  
$password = MD5($_POST['password']);  
  
//包含数据库连接文件  
require_once('conn.php');
$dbhost='47.93.4.120';
$dbuser='root';
$dbpass='123456';
$dbport='3306';
$conn = new DB_mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);
//检测用户名及密码是否正确  
$sql2 = "select userid from `user` where userName='$username' and password='$password'";
$answer = $conn->get_one($sql2);
if($answer){  
    //登录成功  
    session_start();  
    $_SESSION['username'] = $username;  
    $_SESSION['userid'] = $answer['userid'];  
    echo $username,' 欢迎你！进入 <a href="userdata.php">用户中心</a><br />';  
    echo '点击此处 <a href="logout.php?action=logout">注销</a> 登录！<br />';  
    exit;  
} else {  
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');  
}  
?> 