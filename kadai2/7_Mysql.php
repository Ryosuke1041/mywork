<?php

require '../mysql_kadai2/mysql_connect.php';

date_default_timezone_set('Japan');

if(file_exists("9.txt")){
    $number = count(file("9.txt")) + 1;
}else{
    $number = 1;
}
$date = date("Y/m/d H:i:s");

$dsn = 'mysql:host=localhost;dbname=board;charset=utf8';
$db_user = 'root';
$db_pass = '';

//編集投稿処理、通常投稿処理
//送信ボタンを押した後の処理
if(isset($_POST['edit_flag'])&&($_POST['edit_flag'] != 0)){
    $editFlag = $_POST['edit_flag'];
    $dbh = new PDO($dsn, $db_user, $db_pass);

    try {
        $stmt = $dbh->prepare('UPDATE namelist SET name = :name, comment = :comment, date = :date, password = :password WHERE id = :id');
        $stmt->execute(array(':name' => $_POST['name'], ':comment' => $_POST['comment'], ':date' => $date, ':password' => $_POST['pass'], ':id' => $editFlag));
        
    
    } catch (Exception $e) {
              echo 'エラーが発生しました。:' . $e->getMessage();
    }

    // if($stmt = $dbh->prepare("UPDATE namelist set name = :name, comment = :comment, date = :date WHERE id = :id")){
    //     $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //     $stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
    //     $stmt->bindParam(":date", $date, PDO::PARAM_STR);
    //     $execute = $stmt->execute();
    // }

    // $file = file("9.txt");
    // $Open = fopen("9.txt","w");
    // for ($i = 0; $i < count($file); $i++){
    //     $line = explode("<>", $file[$i]);
    //     $name = $_POST['name'];
    //     $comment = $_POST['comment'];
    //     $passedit = $_POST['pass'];
    //     if ($line[0] == $editFlag){
    //         fwrite($Open,$editFlag . "<>" . $name . "<>" . $comment . "<>" . $date . "<>" . $passedit . "<>" . "  (編集済)". "\n");
    //     } else {
    //         fwrite($Open,$file[$i]);
    //     }
    // }
    // fclose($Open);
}elseif(isset($_POST['name']) && isset($_POST['comment']) && isset($_POST['pass'])){
    if($_POST['name'] == ""){
        $name = "名無しさん";
        $add = 'insert into nameList (name, comment, date, password) values (:name, :comment, :date, :password)';
        $stmt = $dbh->prepare($add);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":comment", $_POST['comment'], PDO::PARAM_STR);
        $stmt->bindParam(":date", $date, PDO::PARAM_STR);
        $stmt->bindParam(":password", $_POST['pass'], PDO::PARAM_INT);
        $execute = $stmt->execute();
        if($execute){
            print('データの追加に成功しました<br>');
        }else{
            print('データの追加に失敗しました<br>');
        }

        // $dbh = new PDO($dsn, $db_user, $db_pass);
        // $stmt = $dbh->prepare("INSERT INTO nameList (name, commnent, password) VALUES(:name, :comment, :password)");
        // $stmt->bindParam("name","名無しさん");
        // $stmt->bindParam("comment",$_POST['comment']);
        // $stmt->bindParam("password",$_POST['password']);
        // $execute = $stmt->execute();
        // if($execute){
        //     echo "登録に成功しました。\n"; 
        // } else {
        //     echo "登録に失敗しました。\n"; 
        // }

        // $name = "名無しさん";
        // $comment = $_POST['comment'];
        // $password = $_POST['pass'];
        // $Write = fopen("9.txt","a");
        // fwrite($Write, $number."<>".$name."<>".$comment."<>".$date."<>".$password."<>"."\n");
        // require '../mysql_kadai2/mysql_add.php';
        // fclose($Write);
    }else{
        
        $add = 'insert into nameList (name, comment, date, password) values (:name, :comment, :date, :password)';
        $stmt = $dbh->prepare($add);
        $stmt->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
        $stmt->bindParam(":comment", $_POST['comment'], PDO::PARAM_STR);
        $stmt->bindParam(":date", $date, PDO::PARAM_STR);
        $stmt->bindParam(":password", $_POST['pass'], PDO::PARAM_INT);
        $execute = $stmt->execute();
        if($execute){
            print('データの追加に成功しました<br>');
        }else{
            print('データの追加に失敗しました<br>');
        }
        
        // $name = $_POST['name'];
        // $comment = $_POST['comment'];
        // $password = $_POST['pass'];
        // $Write = fopen("9.txt","a");
        // fwrite($Write, $number."<>".$name."<>".$comment."<>".$date."<>".$password."<>"."\n");
        // require '../mysql_kadai2/mysql_add.php';
        // fclose($Write);
    }
}


//削除処理
$NoT = 0;
if(isset($_POST['passdelete'])){
    if(!empty($_POST['delete'])){
        try{
            
        $delete = $_POST['delete'];

        $dbh = new PDO($dsn, $db_user, $db_pass);
        $sql = "DELETE FROM namelist WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $delete);
        $execute = $stmt->execute();
        $cnt = $stmt->rowCount();
        if($cnt >= 1){
            echo '<p><span class="error">No.'.$delete.'を削除しました。</span></p>'."\n";
            // ALTER table テーブル名 drop column id;
        }else{
            echo '<p><span class="error">No.'.$delete.'は存在しません。番号を確認してください。</span></p>'."\n";
        }
        
    //     if ($execute) {
    //         echo "削除に成功しました。\n"; 
    //     } else {
    //         echo "削除に失敗しました。\n"; 
    //     }
        }catch(Exeption $e){
            echo $e->getMessage();
        }

        // $file = file("9.txt");
        // $fo = fopen("9.txt", "w");       
        // for ($i = 0; $i < count($file); $i++){
        //     $line = explode("<>", $file[$i]);     
        //     $lineNumber = $line[0];
        //     if ($lineNumber != $delete){ 
        //         if($delete < $lineNumber){
        //             $number = $lineNumber - 1;
        //         } else{
        //             $number = $lineNumber;
        //         }
        //         $name = $line[1];
        //         $comment = $line[2];
        //         $date = $line[3];
        //         $pass = $line[4];
        //         fwrite($fo, $number."<>".$name."<>".$comment."<>".$date."<>".$pass."<>"."\n");
        //     }else{
        //         if($_POST['passdelete'] != $line[4]){
        //             $PassDelete = $_POST['passdelete'];
        //             $fp = fopen("9.txt","w");
        //             for($j = 0; $j < count($file); $j++){
        //                 $lines = explode("<>",$file[$j]);
        //                 $deleteNumber = $lines[0];
        //                 $name = $lines[1];
        //                 $comment = $lines[2];
        //                 $date = $lines[3];
        //                 $pass = $lines[4];
        //                 fwrite($fp, $deleteNumber."<>".$name."<>".$comment."<>".$date."<>".$pass."<>"."\n");
        //             }
        //             echo "パスワードが違います";
        //             fclose($fp);
        //             break;
        //         }
        //     }    
        // }
        // fclose($fo);
    }
}
//編集処理(編集ボタンを押した後の処理)
$passwordedit = "";
$editFlag = 0;
$editName = "";
$editComment = "";
if(!empty($_POST["edit"])){
    $passwordedit = $_POST["passedit"];
    $editNumber = $_POST["edit"];
    try {

        $dbh = new PDO($dsn, $db_user, $db_pass);
        $stmt = $dbh->prepare('SELECT * FROM namelist WHERE id = :id');
        $stmt->execute(array(':id' => $editNumber));
        $result = 0;
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $editFlag = $editNumber;
        $editName = $result['name'];
        $editComment = $result['comment'];

        // $dbh = new PDO($dsn, $db_user, $db_pass);
        // // $dbh = new PDO("mysql:host=localhost; dbname=test_db6; charset=utf8", "$user", "$password");

        // $stmt = $dbh->prepare('SELECT * FROM users WHERE id = $passwordedit');

        // $stmt->execute(array($passwordedit => $_GET["id"]));

        // $result = 0;

        // $result = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
    }
}
// if(!empty($_POST["edit"])){
//     $passwordedit = $_POST["passedit"];
//     $editNumber = $_POST["edit"];
//     $file = file("9.txt",FILE_IGNORE_NEW_LINES);
//     foreach($file as $value){
//         $line = explode("<>",$value);
//         if($_POST['passedit'] != $line[4]){
//             continue;
//         }
//         $number = $line[0];
//         if($number == $editNumber){
//             $editName = $line[1];
//             $editComment = $line[2];
//             $editDate = $line[3];
//         }
//     }
//     $editFlag = $editNumber;
// }

?>


<form action="7_Mysql.php" method="post">
    名前: <input type="text" name="name" value="<?php if (!empty($result['name'])) echo(htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8'));?>" /><br />
    コメント: <input type="text" name="comment" value="<?php if (!empty($result['comment'])) echo(htmlspecialchars($result['comment'], ENT_QUOTES, 'UTF-8'));?>"/><br />
    <input type="hidden" name="edit_flag" value="<?php echo $editFlag;?>"/>
    パスワードを入力してください:
    <input type="password" name="pass" value="<?php echo $passwordedit; ?>"><br />
    <input type="submit" value ="送信"><br />
</form>

<form action="7_Mysql.php" method="post">
    <input type = "text" name = "delete" placeholder="ID"/>
    <input type="password" name="passdelete" />
    <input type="submit" value = "削除"/>
</form>

<form action="7_Mysql.php" method="post">
    <input type="text" name="edit" placeholder="ID"/>
    <input type="password" name="passedit"/>
    <input type="submit" value="編集">
</form>

<?php

$id = 1;
$dbh = new PDO($dsn, $db_user, $db_pass);
$stmt = $dbh->prepare("SELECT * FROM namelist ");
// $sql = $stmt->bindValue( 'id', $id, PDO::PARAM_INT);
$execute = $stmt->execute();
if($execute) {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // print_r($result);
    echo "<br>";
    foreach($result as $output){
        echo "ID ".$output['id']." NAME ".$output['name']." COMMENT ".$output['comment']." DATE ".$output['date']."<br>";
    }
    echo "selectしました。";
}else{
    echo "selectできません。";
}

// if(file_exists("9.txt")){
//     $fileName = file("9.txt");
//     foreach($fileName as $value){
// 	    $D = explode("<>", $value);
//         // echo "ID: ". $D[0]. " name: ". $D[1]. " comment: ". $D[2]. " date:". $D[3]. $D[5]. "<br>"; 
        
//     } 
// }
?>




