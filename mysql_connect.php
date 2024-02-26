<?php
$dsn = 'mysql:host=localhost;dbname=board;charset=utf8';
$db_user = 'root';
$db_pass = '';

try{
    $dbh = new PDO($dsn, $db_user, $db_pass);
    echo '<br>';
} catch(PDOException $e){
    echo('データベース接続失敗。' . $e->getMessage());
}

?>