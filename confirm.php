<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="user_comfirm" content="width=device-width, initial-scale=1.0">
    <title>確認フォーム</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>名前</th>
            <td><?php echo $_POST["name"] ?></td>
        </tr>
        <tr>
            <th>パスワード</th>
            <td><?php echo $_POST["pass"] ?></td>
        </tr>
    </table>
    <form action="board.php" method="post">
        <input type="hidden" name="name" value="<?php echo $_POST["name"]; ?>"><br>
        <input type="hidden" name="pass" value="<?php echo $_POST["pass"]; ?>"><br>
        <input type="submit" value ="登録"><br />
    </form>
    <form action="sign_up.php" method="post">
        <input type="hidden" name="name" value="<?php echo $_POST["name"]; ?>"><br>
        <input type="hidden" name="pass" value="<?php echo $_POST["pass"]; ?>"><br>
        <input type="submit" value ="修正"><br />
    </form>
</body>
</html>

<?php


?>
