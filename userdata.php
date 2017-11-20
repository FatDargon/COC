<?php
	echo "<h1>用户中心</h1>";
session_start(); 
$username=$_SESSION['username'];
$userid=$_SESSION['userid'];
echo "<p>欢迎&emsp; $username&emsp;:</p>";
require_once('conn.php');
$dbhost='47.93.4.120';
$dbuser='root';
$dbpass='123456';
$dbport='3306';
$conn = new DB_mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);
//$sql1 = "select * from COLUMNS where TABLE_NAME=`profile`";
//$answer1 = $conn->get_all($sql1);
//var_dump($answer1);
$sql = "select * from `profile`,`owns` where (`owns`.`sheetID`=`profile`.`ID` and `owns`.`userID`=$userid)";
$answer = $conn->get_all($sql);
$_SESSION['userdata'] = $answer;
echo "<p>你一共有".count($answer)."张人物卡</p>";
//$sql2 = "select column_name from `profile`";
//$answer2 = $conn->get_row($sql);
//var_dump($answer2);
include_once('print_table.php');
pretty_table_userdata($answer,0,8);
//var_dump($answer);
echo '<h3>点击<a href = "addone.php">添加</a>人物属性表。</h3>'
?>