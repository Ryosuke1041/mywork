<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="board.css" >
        <title>掲示板</title>
    </head>
    <body>
        <header>
            <form action="board.php" method="post">        
                コメント: <input type="text" name="comment" value={$editcomment}/> 
                <input type="hidden" name="edit_flag" value="<?php echo {$editFlag};?>"/>
                <input type="submit" value ="送信"><br />
            </form>

            <form action="board.php" method="post">
                <input type = "text" name = "delete" placeholder="ID"/>
                <input type="password" name="passdelete" placeholder="PASSWORD" />
                <input type="submit" value = "削除"/>
            </form>

            <form action="board.php" method="post">
                <input type="text" name="edit" placeholder="ID"/>
                <input type="password" name="passedit" placeholder="PASSWORD"/>
                <input type="submit" value="編集">
            </form>
        </header>
    </body>
</html>