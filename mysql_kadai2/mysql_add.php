<?php

$dsn = 'mysql:host=localhost;dbname=board;charset=utf8';
$db_user = 'root';
$db_pass = '';

require './mysql_connect.php';

date_default_timezone_set('Japan');
$name = "山田太郎";
$comment = "helle";
$date = date('Y/m/d');
$password = "111";

$dbh = new PDO($dsn, $db_user, $db_pass);
$add = 'insert into nameList (name, comment, date, password) values (:name, :comment, :date, :password)';
$stmt = $dbh->prepare($add);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
$stmt->bindParam(":date", $date, PDO::PARAM_STR);
$stmt->bindParam(":password", $password, PDO::PARAM_INT);
$flag = $stmt->execute();
if($flag){
    print('データの追加に成功しました<br>');
}else{
    print('データの追加に失敗しました<br>');
}




?>