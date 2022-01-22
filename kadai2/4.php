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
            fwrite($X, $V[$i]);
        }
    }
    fclose($X);
}
?>

<form action="4.php" method="get">
名前: <input type="text" name="name" />
コメント: <input type="text" name="comment" />
<input type="submit" value ="送信">
</form>

<?php
$fileName = file("9.txt");
foreach($Y as $value){
	$D = explode("<>", $value);
    echo "ID: ". $D[0]. " name: ". $D[1]. " comment: ". $D[2]. " date:". $D[3]. "<br>"; 

   	}
?>

<form action = "4.php" method = "post">
    <input type = "text" name = "delete"/>
    <input type = "submit" value = "削除"/>
</form>
