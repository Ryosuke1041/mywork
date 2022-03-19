<?php
date_default_timezone_set('Japan');

if(file_exists("9.txt")){
    $number = count(file("9.txt")) + 1;
}else{
    $number = 1;
}
$date = date("Y/m/d H:i:s");

//編集投稿処理、通常投稿処理

    if(isset($_POST['edit_flag'])&&($_POST['edit_flag'] != 0) && isset($_POST['passedit'])){
        $editFlag = $_POST['edit_flag'];
        $passwordedit = $_POST['passedit'];
        $file = file("9.txt");
        $Open = fopen("9.txt","w");
        for ($i = 0; $i < count($file); $i++){
            $line = explode("<>", $file[$i]);
            $name = $_POST['name'];
            $comment = $_POST['comment'];
            if ($line[0] == $editFlag){
                fwrite($Open,$editFlag . "<>" . $name . "<>" . $comment . "<>" . $date . "<>" . $passwordedit . "  (編集済)". "\n");
            } else {
                fwrite($Open,$file[$i]);
            }
        }
        fclose($Open);
    }elseif(isset($_POST['name']) && isset($_POST['comment']) && isset($_POST['pass'])){
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $password = $_POST['pass'];
        $Write = fopen("9.txt","a");
        fwrite($Write, $number."<>".$name."<>".$comment."<>".$date."<>".$password."\n");
        fclose($Write);
    }


//削除処理
if(isset($_POST['passdelete'])){
    if(!empty($_POST['delete'])){
        $delete = $_POST['delete'];
        $file = file("9.txt");
        $fo = fopen("9.txt", "w");       
        for ($i = 0; $i < count($file); $i++){
            $line = explode("<>", $file[$i]);
            if($_POST['passdelete'] == $line[4]){
                $lineNumber = $line[0];
                if ($lineNumber != $delete){ 
                    if($delete < $lineNumber){
                        $number = $lineNumber - 1;
                    } else{
                        $number = $lineNumber;
                    }
                
                $name = $line[1];
                $comment = $line[2];
                $date = $line[3];
                fwrite($fo, $number."<>".$name."<>".$comment."<>".$date);
                }
            }
        }
        fclose($fo);
    }
}
//編集処理
$editFlag = 0;
$editName = "";
$editComment = "";
if(!empty($_POST["edit"])){

    $editNumber = $_POST["edit"];
    $file = file("9.txt",FILE_IGNORE_NEW_LINES);
    foreach($file as $value){
        $line = explode("<>",$value);
        if($_POST['passedit'] != $line[4]){
            continue;
        }
        $number = $line[0];
        if($number == $editNumber){
            $editName = $line[1];
            $editComment = $line[2];
            $editDate = $line[3];
        }
    }
    $editFlag = $editNumber;
}

?>

<form action="6.php" method="post">
    名前: <input type="text" name="name" value="<?php echo $editName;?>" /><br />
    コメント: <input type="text" name="comment" value="<?php echo $editComment;?>"/><br />
    <input type="hidden" name="edit_flag" value="<?php echo $editFlag;?>"/>
    パスワードを入力してください:
    <input type="password" name="pass"><br />
    <input type="submit" value ="送信"><br />
</form>

<form action="6.php" method="post">
    <input type = "text" name = "delete" placeholder="ID"/>
    <input type="password" name="passdelete" />
    <input type = "submit" value = "削除"/>
</form>

<form action="6.php" method="post">
    <input type="text" name="edit" placeholder="ID"/>
    <input type="password" name="passedit"/>
    <input type="submit" value="編集">
</form>

<?php
if(file_exists("9.txt")){
    $fileName = file("9.txt");
    foreach($fileName as $value){
	    $D = explode("<>", $value);
        echo "ID: ". $D[0]. " name: ". $D[1]. " comment: ". $D[2]. " date:". $D[3]. "<br>"; 

   	} 
}
?>