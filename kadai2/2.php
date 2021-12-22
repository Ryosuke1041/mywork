<?php
if(isset($_GET['name'])){
    $name = $_GET['name'];
}
if(isset($_GET['comment'])){
    $comment = $_GET['comment'];
}
if(file_exists("9.txt")){
    $number = count(file("9.txt")) + 1;
}else{
    $number = 1;
}
$date = date("Y/n/j G:I:s");
$Z = fopen("9.txt","a");
    fwrite($Z, $number."<>".$name."<>".$comment."<>".$date."\n");
    fclose($Z);

?>

<form action="9.php" method="get">
名前: <input type="text" name="name" />
コメント: <input type="text" name="comment" />
<input type="submit" value ="送信">
</form>
