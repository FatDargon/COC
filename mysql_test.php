<?php
require_once("conn.php");
//  DB_PDO CRUD
$pdo = DB_PDO::getInstance();
echo '<br>--PDO getRow--<br>';
$sql = 'select * from test where id > 2';
var_dump( $pdo->getRow($sql));
echo $pdo->getRow($sql)['name'];
echo $pdo->getRow($sql, PDO::FETCH_NUM)[1];

echo '<br>--PDO getAll--<br>';
$sql = 'select * from test';
echo $pdo->getAll($sql)[1]['name'];
var_dump($pdo->getAll($sql));
echo $pdo->getAll($sql)[1]['name'];

echo '<br>--PDO insert--<br>';
echo $pdo->insert('test', array('name'=>'aa11', 'age'=>'25'));

echo '<br>--PDO delete--<br>';
echo $pdo->delete('test', "name = 'aa'");

echo '<br>--PDO update--<br>';
echo $pdo->update('test', array("name"=>'一哥111', "age"=>'24'), "id=481");

// 事务
try {
    $pdo->beginTransaction();
    $pdo->insert("test", array("name"=>"王六", "age"=>26));
    $pdo->insert("test", array("name"=>"王七", "age"=>27));
    $pdo->commit();
    echo '提交ok';
}catch(PDOException $e){
    $pdo->rollBack();
    echo "Failed！ " . $e->getMessage();
}

// 预编译
echo "<br>--fetch--<br>";
$sql = "select * from test where id >:id and age =:age";
$param = array(":id"=>2, ":age"=>26);
$test = $pdo->fetch($sql, $param);
var_dump($test);




echo "<br>--fetchAll--<br>";
$sql = "select * from test where id >:id";
$param = array(":id"=>2);
var_dump($pdo->fetchAll($sql, $param));


echo "<br>--exec--<br>";
$sql = "insert into test(name, age) values(:name, :age)";
$param = array(":name"=>"小二", ":age"=>28);

$sql = "update test set name=:name where id=:id";
$param = array(":name"=>"李四光2", ":id"=>"440");

$sql = "delete from test  where id > :id";
$param = array(":id"=>"2");
echo $pdo->exec($sql,$param);



// DB_MySQLi CRUD
$mysqli = DB_MySQLi::getInstance();
echo '<br>--getLastInsID--<br>';
echo $mysqli->getLastInsID();

echo '<br>--MySQLi getRow--<br>';
$sql = 'select * from test where id = 2';
var_dump( $mysqli->getRow($sql));
echo $mysqli->getRow($sql)['name'];

echo '<br>--MySQLi getAll--<br>';
$sql = 'select * from test where 1 = 1';
var_dump( $mysqli->getAll($sql));
echo $mysqli->getAll($sql)[0]['name'];

echo '<br>--MySQLi insert--<br>';
echo $mysqli->insert('test', array('name'=>'bb', 'age'=>'25'));

echo "<br>--MySQLi delete--<br>";
echo $mysqli->delete("test", "name = 'aa'");

echo "<br>--MySQLi update--<br>";
echo $mysqli->update('test', array('name'=>"小五111"), 'id=370');

// 事务
echo "<br>--insert--<br>";
$mysqli->beginTransaction();
$res1 = $mysqli->insert('test', array('name'=>'rose', 'age'=>'2222'));
$res2 = $mysqli->insert('test', array('name'=>'bbbb', 'age'=>'1111'));

if(!$res1 || !$res2) {
    echo "回滚。。。";
    $mysqli->rollBack();
}else{
    echo '提交。。。';
    $mysqli->commit();
}

// 预编译
echo "<br>--fetch--<br>";
$sql = "select * from test where 1 = ?";
$param = array('i', '1');
var_dump($mysqli->fetch($sql, $param));

echo "<br>--fetchALL--<br>";
$sql = "select * from test where 1 = ?";
$param = array('i', '1');
var_dump($mysqli->fetchALL($sql, $param));


// 其它操作
function inject_check($sql_str) { //防止注入
    $check = eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);
    if ($check) {
        echo "输入非法注入内容！";
        exit ();
    } else {
        return $sql_str;
    }
}
echo inject_check("delete");
?>