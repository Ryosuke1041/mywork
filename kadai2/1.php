<?php
isset($_GET['name']);
isset($_GET['comment']);

?>
<form action="8.php" method="get">
名前: <input type="text" name="name" />
コメント: <input type="text" name="comment" />
<input type="submit" value ="送信">
</form>