<?php
/* Smarty version 3.1.33, created on 2019-09-19 04:06:33
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\corp_submit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d828e497962b7_64112929',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c84c207a577810cefbb8ed04cc3e3022fb041f2a' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\corp_submit.html',
      1 => 1568837063,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d828e497962b7_64112929 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="css/loading.css">
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
            <button type="button" id="exportBtn" name="button" onclick="exportCorpExcel('<?php echo $_smarty_tpl->tpl_vars['script_number']->value;?>
')">存檔</button>
        </div>

        <div class="loading hide">
            <div class="gif" style="width:500px;height:200px;"></div>
        </div>
    </body>

    <?php echo '<script'; ?>
 type="text/javascript">
        // $("#msg").val("Excel報表正在匯出中...<br>請勿關閉視窗...");
        $(document).ready(function(){
            $('div.loading').show();
        });
    <?php echo '</script'; ?>
>
</html>
<?php }
}
