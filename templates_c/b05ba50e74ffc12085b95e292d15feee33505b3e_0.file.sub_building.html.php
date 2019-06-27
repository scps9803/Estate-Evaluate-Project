<?php
/* Smarty version 3.1.33, created on 2019-06-26 22:39:54
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\sub_building.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d1383ba5c9af8_03411692',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b05ba50e74ffc12085b95e292d15feee33505b3e' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\sub_building.html',
      1 => 1561559936,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d1383ba5c9af8_03411692 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>線上查估系統</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="css/style.css">
        <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="js/index.js"><?php echo '</script'; ?>
>
    </head>
    <body>
        <div class="container" align="center">
            <form class="" action="" method="post">
                <h1>雜項設施</h1>
                <table border="1">
                    <tr>
                        <td>項目</td>
                        <td>面積</td>
                        <td>是否自拆</td>
                    </tr>

                    <tr>
                        <td>
                            <div id="other-item" class="input-align-top">
                                <div id="other-item-1">
                                    <select class="select-menu" name="other-item-1">
                                        <option value="" style="display:none;">請選擇項目</option>
                                        <option value="">電柱(RC造)遷移費</option>
                                        <option value="">窗型冷氣遷移費</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" onclick="addInfoItemOnclick('other-item')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('other-item')">-</button>
                        </td>
                        <td>
                            <div id="calArea">
                                <div id="calArea-1">
                                    <input type="text" name="calArea-1" class="larger-input-size" placeholder="請輸入面積計算式" title="請輸入面積計算式">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div id="auto-remove">
                                <div id="auto-remove-1">
                                    <input type="radio" name="auto-remove-1">是<input type="radio" name="auto-remove-1">否
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <input type="button" value="回前一頁" onclick="window.history.back();">
                <input type="submit" value="儲存">
            </form>
        </div>
    </body>
</html>
<?php }
}
