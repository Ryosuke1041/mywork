<?php
if(isset($_GET['name'])){
    echo $_GET['name'];
}

?>
<form action="4.php" method="get">
名前: <input type="text" name="name" />
年齢: <input type="text" name="age" />
<input type="submit" value ="おくるよーん">
</form>