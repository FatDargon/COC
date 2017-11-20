<?php
include_once('header.php');
include_once('print_table.php');
echo "<h1>卡片细节</h1>";
$id = $_GET["id"]|0;
session_start(); 
$userdata=$_SESSION['userdata'];
pretty_table_detail($userdata,0,8,$id);
pretty_table_detail($userdata,8,10,$id);
pretty_table_detail($userdata,18,10,$id);
pretty_table_detail($userdata,28,10,$id);
pretty_table_detail($userdata,38,10,$id);
?>