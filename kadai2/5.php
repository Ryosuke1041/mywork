<?php
date_default_timezone_set('Japan');

if(file_exists("9.txt")){
    $number = count(file("9.txt")) + 1;
}else{
    $number = 1;
}
$date = date("Y/m/d H:i:s");
if(isset($_GET['name']) && isset($_GET['comment'])){
    $name = $_GET['name'];
    $comment = $_GET['comment'];
    $Z = fopen("9.txt","a");
    fwrite($Z, $number."<>".$name."<>".$comment."<>".$date."\n");
    fclose($Z);
}
if(isset($_POST['delete'])){
    $T = $_POST['delete'];
    $V = file("9.txt");
    $X = fopen("9.txt", "w");
    for ($i = 0; $i < count($V); $i++){
        $W = explode("<>", $V[$i]);
        $U = $W[0];
        if ($U != $T){ 
            fwrite($X, $V[$i].PHP_EOL);
        }
    }
    fclose($X);
}

if(!empty($_POST["edit"])){
    $file = file("9.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($file as $value){
        $line = explode("<>",$value);
        $number = $line[0];
        if($numbe r == $_POST["edit"]){
            $A = $line[0];
            $B = $line[1];
            $C = $line[2];
        }
    }
}
if(!empty($B) && !empty($C)){
    $file = file("9.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $fp = fopen($file,"w");
    foreach($file as $value){
        $line = explode("<>",$value);
        $number = $line[0];
        if($number! = $A){
            fwrite($fp,$value);
        }else{
            fwrite($fp,$_POST["edit"]."<>".$name."<>".$comment."<>".$data);
        }
    }
    fclose($fp);
}

?>

<form action="5.php" method="get">
名前: <input type="text" name="name" />
コメント: <input type="text" name="comment" />

<input type="submit" value ="送信">
    <input type = "text" name = "delete"/>
    <input type = "submit" value = "削除"/>

<input type="text" name="number" value="">
<input type="submit" name="edit" value="編集">
</form>

<?php
$Y = file("9.txt");
foreach($Y as $value){
	$D = explode("<>", $value);
    echo "ID: ". $D[0]. " name: ". $D[1]. " comment: ". $D[2]. " date:". $D[3]. "<br>"; 

   	}
?>