<?php
/* Smarty version 3.1.33, created on 2019-09-23 17:29:27
  from 'C:\xampp\htdocs\Estate-Evaluate-Project\templates\corp_submit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d889077ab7d33_98370244',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16935467669558e1ed06816c034a6f982f516066' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Estate-Evaluate-Project\\templates\\corp_submit.html',
      1 => 1569145728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d889077ab7d33_98370244 (Smarty_Internal_Template $_smarty_tpl) {
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
