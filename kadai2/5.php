<?php
date_default_timezone_set('Japan');

if(file_exists("9.txt")){
    $number = count(file("9.txt")) + 1;
}else{
    $number = 1;
}
$date = date("Y/m/d H:i:s");

//編集投稿処理、通常投稿処理
if(isset($_GET['edit_flag'])&&($_GET['edit_flag'] != 0)){
    $editFlag = $_GET['edit_flag'];
    $file = file("9.txt");
    $Open = fopen("9.txt","w");
    for ($i = 0; $i < count($file); $i++){
        $line = explode("<>", $file[$i]);
        $name = $_GET['name'];
        $comment = $_GET['comment'];
        if ($line[0] == $editFlag){
            fwrite($Open,$editFlag . "<>" . $name . "<>" . $comment . "<>" . $date . "  (編集済)". "\n");
        } else {
            fwrite($Open,$file[$i]);
        }
    }
    fclose($Open);
}elseif(isset($_GET['name']) && isset($_GET['comment'])){
    $name = $_GET['name'];
    $comment = $_GET['comment'];
    $Write = fopen("9.txt","a");
    fwrite($Write, $number."<>".$name."<>".$comment."<>".$date."\n");
    fclose($Write);
}

//削除処理
if(!empty($_GET['delete'])){
    $delete = $_GET['delete'];
    $file = file("9.txt");
    $fo = fopen("9.txt", "w");
    for ($i = 0; $i < count($file); $i++){
        $line = explode("<>", $file[$i]);
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
    fclose($fo);
}

//編集処理
$editFlag = 0;
$editName = "";
$editComment = "";
if(!empty($_GET["edit"])){
    $editNumber = $_GET["edit"];
    $file = file("9.txt",FILE_IGNORE_NEW_LINES);
    foreach($file as $value){
        $line = explode("<>",$value);
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

<form action="5.php" method="get">
    名前: <input type="text" name="name" value="<?php echo $editName;?>" />
    コメント: <input type="text" name="comment" value="<?php echo $editComment;?>"/>
    <input type="hidden" name="edit_flag" value="<?php echo $editFlag;?>"/>
    <input type="submit" value ="送信">
</form>

<form action="5.php" method="get">
    <input type = "text" name = "delete"/>
    <input type = "submit" value = "削除"/>
</form>

<form action="5.php" method="get">
    <input type="text" name="edit"/>
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