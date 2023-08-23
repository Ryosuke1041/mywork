<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
</head>
<body>
    <form action="board.php" method="post">
        IDを入力してください: 
        <input type="text" name="id" value="<?php if (!empty($_POST['id'])) echo(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8')); ?>"><br />
        パスワードを入力してください:
        <input type="password" name="pass" value="<?php if (!empty($_POST['pass'])) echo(htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8')); ?>"><br />
        <input type="submit" value ="送信"><br />
    </form>
</body>
</html>