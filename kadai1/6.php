<?php
if(isset($_GET['name'])){
    echo $_GET['name'];
    $Z = fopen("6.txt","a");
    fwrite($Z,$_GET['name']."\n");
    fclose($Z);
}

?>
<form action="6.php" method="get">
名前: <input type="text" name="name" />
年齢: <input type="text" name="age" />
<input type="submit" value ="おくるよーん">
</form>