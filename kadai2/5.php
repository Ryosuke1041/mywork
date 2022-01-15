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

<form action="5.php" method="get">
名前: <input type="text" name="name" />
コメント: <input type="text" name="comment" />
<input type="submit" value ="送信">
</form>

<?php
$Y = file("9.txt");
foreach($Y as $value){
	$D = explode("<>", $value);
    echo "ID: ". $D[0]. " name: ". $D[1]. " comment: ". $D[2]. " date:". $D[3]. "<br>"; 

   	}
?>

<form action = "5.php" method = "post">
    <input type = "text" name = "delete"/>
    <input type = "submit" value = "削除"/>
</form>

<?php
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

?>

<!-- <form action = "5.php" method = "post">
    <input type = "text" name = "edit"/>
    <input type = "submit" value = "編集"/>
</form> -->

<?php
// if(isset($_POST['edit'])){
//     $S = $_POST['edit'];
//     $ = file("9.txt");
//     $ = fopen("9.txt", "w");
//     for ($i = 0; $i < count($V); $i++){
//         $W = explode("<>", $V[$i]);
//         $U = $W[0];
//         if ($U != $T){ 
//             fwrite($X, $V[$i].PHP_EOL);
//         }
//     }
//     fclose($X);
// }

?>

<?php
$S = "9.txt";
$Q = file($S, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$P = '';
$O = '';
$N = '';
if(isset($_POST["edit"])) {
	foreach($Q as $M) {
		$R = explode("<>", $M);
		if($R[0] == $_POST["number"]) {
			$P = $R[0];
			$O = $R[1];
			$N = $R[2];
			break;
		}
	}
}
// elseif(isset($_POST["normal"])) {
// 	$K = ($_POST['edit_post'] ?: count($Q) + 1) . "<>" . $_POST['name'] . "<>" . $_POST['comment'];
// 	if($_POST["edit_post"]) {
// 		foreach($Q as &$M) {
// 			$R = explode("<>", $M);
// 			if($R[0] == $_POST["edit_post"]) {
// 				$M = $K;
// 			}
// 		}
// 	}
// else {
// 	$Q[] = $K;
// }
	file_put_contents($S, implode("\n", $Q));

?>

<form action="5.php" method="POST">
<input type="text" name="number" value="">
<input type="submit" name="edit" value="編集">
</form>
