<?php
/* Smarty version 3.1.33, created on 2019-07-07 14:24:51
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\house_submit_preview.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d2200b3c8bc56_65511497',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8915401ba982d0df64e10304cdae0fca218ca94' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\house_submit_preview.html',
      1 => 1562509489,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d2200b3c8bc56_65511497 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <style media="screen">
            body{
                font-family: "標楷體";
            }
            .table-container{
                width: 1300px;
                /* border-radius: 8px; */
                /* border-style: solid; */
                text-align: center;
                margin: auto;
                padding: 5px;
            }
            /* .content-text{
                color: #CC0000;
            } */
        </style>
    </head>
    <body>
        <div class="table-container">
            <h1>桃園市XXX徵收案土地改良物價值查估<br>建築改良物調查表</h1>
            <h3>調查表編號: <?php echo $_smarty_tpl->tpl_vars['script_number']->value;?>
</h3>

            <table border="3" style="border-collapse:collapse" class="table-container">
                <tr>
                    <td>地上物<br>所有人姓名</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['owner']->value;?>
</td>
                    <td>身分證字號<br>統一編號</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['pId']->value;?>
</td>
                    <td>住址</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['address']->value;?>
</td>
                    <td>聯絡<br>電話</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
</td>
                    <td>建築物<br>合法性</td>
                    <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['legal_status']->value;?>
</td>
                </tr>

                <tr>
                    <td>土地<br>所有人姓名</td>
                    <td></td>
                    <td>身分證字號<br>統一編號</td>
                    <td></td>
                    <td>住址</td>
                    <td></td>
                    <td>聯絡<br>電話</td>
                    <td></td>
                    <td>合法文件</td>
                    <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['legal_certificate']->value;?>
</td>
                </tr>

                <tr>
                    <td>房屋座落</td>
                    <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['house_address']->value;?>
</td>
                    <td>建號<br>稅籍編號</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['legal_number']->value;?>
</td>
                    <td>座落土地<br>使用權屬</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['land_use']->value;?>
</td>
                    <td>租賃關係</td>
                    <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['rent_relation']->value;?>
</td>
                </tr>

                <tr>
                    <td>基地標示</td>
                    <!-- <td colspan="7">桃園市、中壢區、後興段，874，標示面積 2733 m<sup>2</sup></td> -->
                    <td colspan="7"><?php echo $_smarty_tpl->tpl_vars['location']->value;?>
</td>
                    <td>房屋拆除情形</td>
                    <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['remove_condition']->value;?>
</td>
                </tr>

                <tr>
                    <td rowspan="<?php echo $_smarty_tpl->tpl_vars['captain_count']->value;?>
">現住戶</td>
                    <td>戶長姓名</td>
                    <td>家屬人數</td>
                    <td>戶口名簿號碼</td>
                    <td>設籍日期</td>
                    <td>人口遷移費總計(元)</td>

                    <td>戶長姓名</td>
                    <td>家屬人數</td>
                    <td>戶口名簿號碼</td>
                    <td>設籍日期</td>
                    <td>人口遷移費總計(元)</td>
                </tr>

                <!-- <?php ob_start();
echo count($_smarty_tpl->tpl_vars['captain']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_prefixVariable1/2-1+1 - (0) : 0-($_prefixVariable1/2-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                <tr>
                    <?php
$_smarty_tpl->tpl_vars['j'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int) ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? $_smarty_tpl->tpl_vars['i']->value+1+1 - ($_smarty_tpl->tpl_vars['i']->value) : $_smarty_tpl->tpl_vars['i']->value-($_smarty_tpl->tpl_vars['i']->value+1)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0) {
for ($_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['i']->value, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++) {
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration === 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration === $_smarty_tpl->tpl_vars['j']->total;?>
                        <?php if ($_smarty_tpl->tpl_vars['j']->value%2 == 0) {?>
                            <td><?php echo $_smarty_tpl->tpl_vars['captain']->value[$_smarty_tpl->tpl_vars['j']->value]['name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['captain']->value[$_smarty_tpl->tpl_vars['j']->value]['family_num'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['captain']->value[$_smarty_tpl->tpl_vars['j']->value]['household_number'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['captain']->value[$_smarty_tpl->tpl_vars['j']->value]['set_household_date'];?>
</td>
                            <td></td>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['j']->value%2 == 1) {?>
                            <td><?php echo $_smarty_tpl->tpl_vars['captain']->value[$_smarty_tpl->tpl_vars['j']->value]['name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['captain']->value[$_smarty_tpl->tpl_vars['j']->value]['family_num'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['captain']->value[$_smarty_tpl->tpl_vars['j']->value]['household_number'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['captain']->value[$_smarty_tpl->tpl_vars['j']->value]['set_household_date'];?>
</td>
                            <td></td>
                        <?php }?>
                    <?php }
}
?>
                </tr>
                <?php }
}
?> -->

                <tr>
                    <td>總人口數</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['total_people']->value;?>
</td>
                    <td>人口遷移費總計(元)</td>
                    <td></td>
                </tr>
            </table>
            <br>
            <table border="3" style="border-collapse:collapse" class="table-container">
                <tr>
                    <td rowspan="2">編號/項目</td>
                    <td colspan="3">房屋構造</td>
                    <td colspan="4">單位面積評點數</td>
                    <td rowspan="2">評點房屋<br>面積/長度</td>
                    <td rowspan="2">房屋補償價格<br>(元)</td>
                    <td rowspan="2">補償類型</td>
                    <td rowspan="2">建築改良物<br>拆遷救濟金</td>
                    <td rowspan="2">自動拆遷<br>獎勵金</td>
                    <td rowspan="2">備註</td>
                </tr>

                <tr>
                    <td>建築物主要構造及類別</td>
                    <td>層別/<br>總樓層</td>
                    <td>用途</td>
                    <td>點/m<sup>2</sup></td>
                    <td>門面整修<br>評點</td>
                    <td>合計點數</td>
                    <td>元/點</td>
                </tr>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['main_building']->value, 'result', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['result']->value) {
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['result']->value['material'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
/<?php echo count($_smarty_tpl->tpl_vars['main_building']->value);?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['result']->value['usage'];?>
</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                <tr>
                    <td>小計</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <h4>調查日期: <?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</h4>
            <h4>調查單位: 鼎盛不動產估價師事務所</h4>
            <!-- <h4>女兒牆: <?php echo $_smarty_tpl->tpl_vars['daughter_wall']->value;?>
</h4> -->
            <button type="button" name="">返回修改</button>
            <button type="button" name="">確定儲存</button>
        </div>
    </body>
</html>
<?php }
}
