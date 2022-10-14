<?php

$dsn = 'mysql:host=localhost;dbname=board;charset=utf8';
$db_user = 'root';
$db_pass = '';

require './mysql_connect.php';

date_default_timezone_set('Japan');
$id = 2;
$comment = "hell";
$name = '山田健太';
$date = date('Y/m/d');


$dbh = new PDO($dsn, $db_user, $db_pass);
if($stmt = $dbh->prepare("UPDATE namelist set name = :name, comment = :comment, date = :date WHERE id = :id")){
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
    $stmt->bindParam(":date", $date, PDO::PARAM_STR);
    $execute = $stmt->execute();
    if ($execute) {
        echo '更新に成功しました。<br>'; 
    } else {
        echo '更新に失敗しました。<br>'; 
    }
}


?>