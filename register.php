<?php  
//登录  
if(!isset($_POST['submit'])){  
    exit('非法访问!点击此处 <a href="register.html">返回</a>');  
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
$data=array("userName"=>$username,"password"=>$password);
$table = 'user';

$sql = "select userID from `user` where userName='$username'";
$if_name_duplicate  = $conn->get_one($sql);
//var_dump($if_name_duplicate);
if (!$if_name_duplicate){
	//没有重名 开始注册
	$sql1 = $conn->get_insert_db_sql($table,$data);
	$conn->query($sql1);
}
else{
	exit('用户名已存在！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');  
}
//开始登录

//检测用户名及密码是否正确  
$sql2 = "select userID from `user` where userName='$username' and password='$password'";
$answer = $conn->get_one($sql2);
if($answer){  
    //登录成功  
    session_start();  
    $_SESSION['username'] = $username;  
    $_SESSION['userid'] = $answer['userid']; 
    echo '注册成功'; 
    echo $username,' 欢迎你！进入 <a href="userdata.php">用户中心</a><br />';  
    echo '点击此处 <a href="logout.php?action=logout">注销</a> 登录！<br />';  
    exit;  
} else {  
    exit('注册失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');  
}   
?> 