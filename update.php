<?php
	echo "<h1>更新用户卡</h1>";
session_start(); 
$username=$_SESSION['username'];
$userid=$_SESSION['userid'];
echo "欢迎 $username 。<br />";
require_once('conn.php');
$dbhost='47.93.4.120';
$dbuser='root';
$dbpass='123456';
$dbport='3306';
$conn = new DB_mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);
$sql = "select * from `profile`,`owns` where (`owns`.`sheetID`=`profile`.`ID` and `owns`.`userID`=$userid)";
$answer = $conn->get_all($sql);
echo "你一共有".count($answer)."张人物卡。";
//$sql2 = "select column_name from `profile`";
//$answer2 = $conn->get_row($sql);
//var_dump($answer2);

$contact2 = 
	$answer;
//  "北京联系人"=>array(1,'高某','A公司','北京市','(010)987654321','gm@linux.com'),
//  "上海联系人"=>array(2,'洛某','B公司','上海市','(021)123456789','lm@apache.com'),
//  "天津联系人"=>array(3,'峰某','C公司','天津市','(022)246802468','fm@mysql.com'),
//  "重庆联系人"=>array(4,'书某','D公司','重庆市','(023)135791357','sm@php.com')

 //创建表格将数组循环输入
    echo '<table border="1" width="600" align="center">';
    echo '<tr bgcolor="#dddddd">';
    	foreach($answer[0] as $key => $value)
    	{
    		echo "<th>$key</th>";
    	}
//  echo '<th>编号</th><th>姓名</th><th>公司</th><th>地区</th><th>电话</th><th>EMALL</th>';
    echo '</tr>';
    foreach ($contact2 as $key=>$value)
    {
        echo '<tr>';
//foreach里面嵌套一个for循环也是可以的
        /*for($n=0;$n<count($value);$n++)
        {
            echo "<td>$value[$n]</td>";
        }*/
//foreach里面嵌套foreach

        foreach($value as $mn)
        {
            echo "<td>{$mn}</td>";
        }
        echo '</tr>';
    }
    echo '</table>';
//var_dump($answer);
echo '点击<a href = "update.php">此处</a>返回用户中心。'
?>