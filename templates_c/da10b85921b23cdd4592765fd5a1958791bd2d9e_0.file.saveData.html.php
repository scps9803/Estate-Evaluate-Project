<?php
/* Smarty version 3.1.33, created on 2019-07-20 13:09:36
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\saveData.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d331290a95392_97713545',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da10b85921b23cdd4592765fd5a1958791bd2d9e' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\saveData.html',
      1 => 1563616765,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d331290a95392_97713545 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <!-- <link rel="stylesheet" href="/css/style.css"> -->
        <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="js/index.js"><?php echo '</script'; ?>
>
    </head>
    <body>
        <div align="center">
            <h1>儲存完成!<br>點擊下方按鈕完成調查表存檔!</h1>
            <button type="button" name="button" onclick="exportExcel('<?php echo $_smarty_tpl->tpl_vars['script_number']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['house_address']->value;?>
')">存檔</button>
        </div>
    </body>
</html>
<?php }
}