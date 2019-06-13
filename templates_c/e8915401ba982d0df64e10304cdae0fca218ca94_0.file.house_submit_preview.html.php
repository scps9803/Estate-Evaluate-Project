<?php
/* Smarty version 3.1.33, created on 2019-06-12 01:46:58
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\house_submit_preview.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cffe912ead522_70673568',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8915401ba982d0df64e10304cdae0fca218ca94' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\house_submit_preview.html',
      1 => 1560275193,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cffe912ead522_70673568 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <td></td>
                    <td>租賃關係</td>
                    <td colspan="2"></td>
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
                    <td rowspan="2">現住戶</td>
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

                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['captain']->value;?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['family_num']->value;?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['household_number']->value;?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['set_household_date']->value;?>
</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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

                <tr>
                    <td>1</td>
                    <td>輕重量鋼骨造平房</td>
                    <td>1/1</td>
                    <td>住宅</td>
                    <td>1,279.00</td>
                    <td></td>
                    <td>1279.00</td>
                    <td>10.6</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

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

            <h4>調查日期: 民國108年03月06日</h4>
            <h4>調查單位: 鼎盛不動產估價師事務所</h4>
            <button type="button" name="">返回修改</button>
            <button type="button" name="">確定儲存</button>
        </div>
    </body>
</html>
<?php }
}
