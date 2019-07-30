<?php
/* Smarty version 3.1.33, created on 2019-07-26 07:24:15
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\finish.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3a3a1fc35794_89762478',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ac7b9da3a25ffc3da85355f228d9c24845cc2c8' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\finish.html',
      1 => 1564097020,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3a3a1fc35794_89762478 (Smarty_Internal_Template $_smarty_tpl) {
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
            <h1 id="msg"></h1>
            <button type="button" name="button" onclick="exportExcel('<?php echo $_smarty_tpl->tpl_vars['script_number']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['house_address']->value;?>
')">存檔</button>
        </div>
    </body>
    <!-- <?php echo '<script'; ?>
 type="text/javascript">
        $("#msg").html("<h1>Excel報表正在匯出中...<br>請勿關閉視窗...</h1>");
    <?php echo '</script'; ?>
> -->
</html>
<?php }
}
