
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" >
    <title>ユーザー登録フォーム</title>
</head>
<body>
    <form action="confirm.php" method="post">
        <h1>ユーザー登録フォーム</h1>
        名前を入力してください:
        <input type="text" name="name" value="<?php if (!empty($_POST['name'])) echo(htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8')); ?>"><br />
        パスワードを入力してください:
        <input type="password" name="pass" value="<?php if (!empty($_POST['pass'])) echo(htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8')); ?>"><br />
        <input type="submit" value ="確認"><br />
    </form>
</body>
</html>

