<?php

require_once("./libs/Smarty.class.php");
$smarty = new Smarty();
$smarty -> template_dir = "templates";
$smarty -> compile_dir = "templates_c";
$smarty -> display("board.tpl");

require './mysql_connect.php';

$preurl = $_SERVER['HTTP_REFERER'];

date_default_timezone_set('Japan');
$date = date("Y/m/d H:i:s");

if($preurl == "http://localhost/kadai/confirm.php"){
    if(isset($_POST["name"]) && isset($_POST["pass"])){
        $add = 'insert into userlist (name, pass) values (:name, :pass)';
        $stmt = $dbh->prepare($add);
        $stmt->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
        $stmt->bindParam(":pass", $_POST['pass'], PDO::PARAM_INT);
        $execute = $stmt->execute();
        if($execute){
            print("登録が完了しました。<br>");
            $select = 'select * from userlist ORDER BY id DESC LIMIT 1';
            $execute = $dbh->query($select);
            $result = $execute->fetch();
            $id = $result["id"];
            $name = $result["name"];
            setcookie('id',$id,time()+60*60*24);
            setcookie('name',$name,time()+60*60*24);
        }else{
            header('Location: ./confirm.php');
            exit();
        }
    }
}elseif($preurl == "http://localhost/kadai/sign_in.php"){
    if(isset($_POST["id"]) && isset($_POST["pass"])){
        $select = "select * FROM userlist WHERE id = :id";
        $stmt = $dbh->prepare($select);
        $stmt->bindParam(":id", $_POST['id'], PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            print("ログイン成功<br>");
            setcookie('name',$result["name"],time()+60*60*24);
            setcookie('id',$_POST["id"],time()+60*60*24);
            setcookie('pass',$result["pass"],time()+60*60*24);
        }else{
            echo $preurl;
            header('Location: ./sign_in.php');
            exit();
        }
    }
}

if(isset($_COOKIE['id']) && isset($_COOKIE['name'])){
    $cookieid = $_COOKIE['id'];
    $cookiename = $_COOKIE['name'];
}

if(isset($cookieid)){
    echo "あなたのIDは".$_COOKIE['id'];
    echo "あなたの名前は".$_COOKIE['name']."<br>";
}else{
    echo "あなたのIDは".$result['id'];
    echo "あなたの名前は".$result['name']."<br>";
}


if(isset($_POST['edit_flag'])&&($_POST['edit_flag'] != 0)){
    $editFlag = $_POST['edit_flag'];
    try {
        $stmt = $dbh->prepare('UPDATE boardlist SET name = :name, comment = :comment, date = :date WHERE postid = :id');
        $stmt->execute(array(':name' => $cookiename, ':comment' => $_POST['comment'], ':date' => $date, ':id' => $editFlag));
    
    } catch (Exception $e) {
              echo 'エラーが発生しました。:' . $e->getMessage();
    }
}elseif(isset($_POST['comment'])){
    if($_POST['comment'] != ""){
        $add = 'insert into boardlist (userid, name, comment, date) values (:id, :name, :comment, :date)';
        $stmt = $dbh->prepare($add);
        $stmt->bindParam(":id", $cookieid, PDO::PARAM_INT);
        $stmt->bindParam(":name", $cookiename, PDO::PARAM_STR);
        $stmt->bindParam(":comment", $_POST['comment'], PDO::PARAM_STR);
        $stmt->bindParam(":date", $date, PDO::PARAM_STR);
        $execute = $stmt->execute();
        if($execute){
            print('データの追加に成功しました<br>');
        }else{
            print('データの追加に失敗しました<br>');
        }
    }else{
        echo '<p><span class="error">コメントがありません。</span></p>'."\n";
    }
}


//削除処理
if(isset($_POST['passdelete'])){
    if(!empty($_POST['delete'])){
        try{
            
            $delete = $_POST['delete'];

            $sql = "DELETE FROM boardlist WHERE postid = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':id', $delete);
            $execute = $stmt->execute();
            $cnt = $stmt->rowCount();
            if($cnt >= 1){
                echo '<p><span class="error">No.'.$delete.'を削除しました。</span></p>'."\n";
            }else{
                echo '<p><span class="error">No.'.$delete.'は存在しません。番号を確認してください。</span></p>'."\n";
            }

        }catch(Exeption $e){
            echo $e->getMessage();
        }
    }
}


//編集処理(編集ボタンを押した後の処理)
$resultcomment = "[]";
$passwordedit = "";
$editFlag = 0;
if(!empty($_POST["edit"])){
    $passwordedit = $_POST["passedit"];
    $editNumber = $_POST["edit"];
    try {

        $stmt = $dbh->prepare('SELECT * FROM boardlist WHERE postid = :id');
        $stmt->execute(array(':id' => $editNumber));
        $cnt = $stmt->rowCount();
        if($cnt >= 1){
            $result = 0;
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $smarty -> assign("$editFlag", "$editNumber");
            $smarty -> assign("$resultcomment", "$result["comment"]");
        }else{
            echo '<p><span class="error">No.'.$editNumber.'は存在しません。番号を確認してください。</span></p>'."\n";
        }
        

    } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
    }
}






$dbh = new PDO($dsn, $db_user, $db_pass);
$stmt = $dbh->prepare("SELECT * FROM boardlist");
$execute = $stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($result) {
    echo "<br>";
    foreach($result as $output){
        echo $output['postid']." ID ".$output['userid']."\tNAME ".$output['name']."\tCOMMENT ".$output['comment']."\tDATE ".$output['date']."<br>";
    }
}else{
    echo "コメントはありません。";
}



?>
