<?php
date_default_timezone_set('Japan');

if(file_exists("9.txt")){
    $number = count(file("9.txt")) + 1;
}else{
    $number = 1;
}
$date = date("Y/m/d H:i:s");
//通常投稿処理
if(isset($_GET['name']) && isset($_GET['comment'])){
    $name = $_GET['name'];
    $comment = $_GET['comment'];
    $Z = fopen("9.txt","a");
    fwrite($Z, $number."<>".$name."<>".$comment."<>".$date."\n");
    fclose($Z);
}
//削除処理
if(isset($_POST['delete'])){
    $T = $_POST['delete'];
    $V = file("9.txt");
    $X = fopen("9.txt", "w");
    for ($i = 0; $i < count($V); $i++){
        $W = explode("<>", $V[$i]);
        $U = $W[0];
        if ($U != $T){ 
           if($T < $U){
               $number = $U - 1;
           } else{
               $number = $U;
           }
            $name = $W[1];
            $comment = $W[2];
            $date = $W[3];
            fwrite($X, $number."<>".$name."<>".$comment."<>".$date);
        }
    }
    fclose($X);
}

//編集処理
if(!empty($_POST["edit"])){
    $editNumber = $_POST["edit"];
    $file = file("9.txt",FILE_IGNORE_NEW_LINES);
    foreach($file as $value){
        $line = explode("<>",$value);
        $number = $line[0];
        if($number == $editNumber){
            $edit_Number = $line[0];
            $edit_Name = $line[1];
            $edit_Comment = $line[2];
            $edit_Date = $line[3];
        }
    }
}

?>

<form action="5.php" method="get">
名前: <input type="text" name="name" value="<?php echo $edit_Name;?>" />
コメント: <input type="text" name="comment" value="<?php echo $edit_Comment;?>"/>
<input type="submit" value ="送信">
</form>

<form action="5.php" method="get">
    <input type = "text" name = "delete"/>
    <input type = "submit" value = "削除"/>
</form>

<form action="5.php" method="get">
    <input type="text" name="number" value="">
    <input type="submit" name="edit" value="編集">
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