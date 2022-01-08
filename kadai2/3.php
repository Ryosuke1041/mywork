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

?>

<form action="3.php" method="get">
名前: <input type="text" name="name" />
コメント: <input type="text" name="comment" />
<input type="submit" value ="送信">
</form>
<?php
$Y = file("9.txt");
print_r($Y);
//$X = explode("<>", $Y);
foreach($Y as $value){
	$D = explode("<>", $value."<br>");
	echo "ID:";
	print_r($D[0]);
	echo "name:";
	print_r($D[1]);
	echo "comment:";
	print_r($D[2]);
	echo "date:";
	print_r($D[3]."<br>");
   	}

?>
