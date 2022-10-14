<?php

$dsn = 'mysql:host=localhost;dbname=board;charset=utf8';
$db_user = 'root';
$db_pass = '';

require './mysql_connect.php';

$id = 2;


$dbh = new PDO($dsn, $db_user, $db_pass);
if($stmt = "DELETE FROM namelist WHERE id = :id"){
    $sql = $dbh->prepare($stmt);
    $sql->bindValue(':id', $id);
    $execute = $sql->execute();
    if ($execute) {
        echo "削除に成功しました。\n"; 
    } else {
        echo "削除に失敗しました。\n"; 
    }
}


?>