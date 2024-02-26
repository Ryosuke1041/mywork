<?php
/* Smarty version 4.3.4, created on 2024-02-26 10:45:00
  from 'C:\xampp\htdocs\kadai\templates\board.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65dc5d9c815070_13451596',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '64bdd9a33c28333ba32bae444459a77492ad77bb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\kadai\\templates\\board.tpl',
      1 => 1708940595,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65dc5d9c815070_13451596 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
                コメント: <input type="text" name="comment" value=<?php echo $_smarty_tpl->tpl_vars['editcomment']->value;?>
/> 
                <input type="hidden" name="edit_flag" value="<?php echo '<?php'; ?>
 echo <?php echo $_smarty_tpl->tpl_vars['editFlag']->value;?>
;<?php echo '?>'; ?>
"/>
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
</html><?php }
}
