<?php
/* Smarty version 3.1.33, created on 2019-07-25 17:30:14
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\sub_building.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d39e726662632_55896743',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b05ba50e74ffc12085b95e292d15feee33505b3e' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\sub_building.html',
      1 => 1564075811,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d39e726662632_55896743 (Smarty_Internal_Template $_smarty_tpl) {
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
            <form class="" action="saveData.php" method="post">
                <h1>雜項設施</h1>
                <!-- <h3>(若無雜項可直接儲存略過)</h3> -->
                <table border="1">
                    <tr>
                        <td>項目</td>
                        <td>面積/數量</td>
                        <td>是否自拆</td>
                    </tr>

                    <tr>
                        <td>
                            <div id="other-item" class="input-align-top">
                                <div id="other-item-1">
                                    <select class="small-select-menu" id="other-item-category-1" name="other-item-category-1" onclick="getSubbuildingCategory(1);this.onclick=null;" onchange="getSubbuildingOption(1)" required>
                                        <option value="" style="display:none;">請選擇種類</option>
                                    </select>

                                    <select class="select-menu" id="other-item-option-1" name="other-item-1" required>
                                        <option value="" style="display:none;">請選擇項目</option>
                                    </select>

                                    <select class="small-select-menu" name="other-item-type-1" required>
                                        <option value="" style="display:none;">請選擇室內外</option>
                                        <option value="室內">室內</option>
                                        <option value="室外">室外</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="other-item-count" name="other-item-count">
                            <button type="button" onclick="addInfoItemOnclick('other-item')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('other-item')">-</button>
                        </td>
                        <td>
                            <div id="calArea">
                                <div id="calArea-1">
                                    <input type="text" name="calArea-1" class="larger-input-size" placeholder="請輸入面積計算式或數量" title="請輸入面積計算式或數量">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div id="auto-remove">
                                <div id="auto-remove-1">
                                    <input type="radio" name="auto-remove-1" value="是">是<input type="radio" name="auto-remove-1" value="否">否
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- <input type="button" value="回前一頁" onclick="window.history.back();"> -->
                <input type="hidden" name="house_address" value="<?php echo $_smarty_tpl->tpl_vars['house_address']->value;?>
">
                <input type="hidden" name="script_number" value="<?php echo $_smarty_tpl->tpl_vars['script_number']->value;?>
">
                <input type="submit" value="儲存">
            </form>
        </div>
    </body>
</html>
<?php }
}
