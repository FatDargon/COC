<?php
	require_once('conn.php');
	$dbhost='47.93.4.120';
	$dbuser='root';
	$dbpass='123456';
	$dbport='3306';
	$conn = new DB_mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);
	$data=array("userName"=>"123","password"=>"123");
	$table = 'user';
	$sql1 = $conn->get_insert_db_sql($table,$data);
	echo $sql1;
	$answer = $conn->query($sql1);
	var_dump($answer);
	$sql = 'SELECT * FROM `user`';
	$answer = $conn->get_all($sql);
	var_dump($answer);
?>