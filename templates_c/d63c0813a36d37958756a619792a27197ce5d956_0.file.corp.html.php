<?php
/* Smarty version 3.1.33, created on 2019-08-04 13:46:26
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\corp.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d46e1b212bdd4_84504722',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd63c0813a36d37958756a619792a27197ce5d956' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\corp.html',
      1 => 1564926384,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d46e1b212bdd4_84504722 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
  <title>新增農作物查案</title>
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
  <!-- <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
> -->
  <!-- <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"><?php echo '</script'; ?>
> -->
</head>
<body>
    <div class="container" align="center">
        <h1>農作物調查表</h1>
        <form class="" action="" method="post" id="" onkeydown="if(event.keyCode==13)return false;">
            <table border="1">
                <tbody>
                    <tr>
                        <td rowspan="2">基地標示</td>
                        <td><span class="required">(*)</span>鄉鎮市</td>
                        <td><span class="required">(*)</span>段</td>
                        <td>小段</td>
                        <td colspan="3"><span class="required">(*)</span>地號</td>
                        <!-- <td colspan="2"><span class="required">(*)</span>面積(m<sup>2</sup>)</td> -->
                        <td rowspan="2"><span class="required">(*)</span><br>查估手稿編號</td>
                        <td rowspan="2">
                            <input type="radio" name="legal-status" value="農合" required>農合
                            <input type="radio" name="legal-status" value="農非">農非
                            <input type="text" name="script-number" value="" placeholder="輸入手稿編號" required><br>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" id="district" name="district" list="district-list" autocomplete="off" required>
                            <datalist id="district-list">
                                <option value="觀音區">觀音區</option>
                                <option value="蘆竹區">蘆竹區</option>
                                <option value="楊梅區">楊梅區</option>
                                <option value="大園區">大園區</option>
                                <option value="中壢區">中壢區</option>
                                <option value="平鎮區">平鎮區</option>
                                <option value="復興區">復興區</option>
                                <option value="新屋區">新屋區</option>
                                <option value="龜山區">龜山區</option>
                                <option value="八德區">八德區</option>
                                <option value="桃園區">桃園區</option>
                                <option value="大溪區">大溪區</option>
                                <option value="龍潭區">龍潭區</option>
                            </datalist>
                        </td>
                        <td>
                            <div id="land-section">
                                <div id="land-section-1">
                                    <input type="text" id="section-1" name="land-section-1" list="land-section-list-1" autocomplete="off" oninput="getLandSectionOption(1)" required><br>
                                    <datalist id="land-section-list-1"></datalist>
                                </div>
                            </div>
                            <input type="hidden" id="land_section_count" name="land_section_count">
                            <button type="button" onclick="addInfoItemOnclick('land-section')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('land-section')">-</button>
                        </td>

                        <td>
                            <div id="subsection" class="input-align">
                                <div id="subsection-1">
                                    <select id="sub_section-1" name="subsection-1">
                                        <option value="">無</option>
                                        <option value="新坡小段">新坡小段</option>
                                        <option value="過溪子小段">過溪子小段</option>
                                    </select>
                                </div>
                            </div>
                        </td>

                        <td colspan="3">
                            <div id="land-number" class="input-align">
                                <div id="land-number-1">
                                    <input type="text" id="land-num-1" name="land-number-1" placeholder="多個地號請用'、'分隔" onchange="isLandNumExist(1)" required><br>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><span class="required">(*)</span>農林漁牧作物所有人</td>
                        <td><span class="required">(*)</span>持分比例</td>
                        <td><span class="required">(*)</span>身分證字號</td>
                        <td>通訊住址</td>
                        <td colspan="5">
                            <div id="corp-address">
                                <div id="corp-address-1">
                                    <input type="text" id="addressText-1" name="addressText-1" value="" class="large-input-size" placeholder="所有權人-1">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr rowspan="2">
                        <td rowspan="2">
                            <div id="corp-owner">
                                <div id="corp-owner-1">
                                    <input type="text" name="corp-owner-1" placeholder="所有權人-1" required><br>
                                </div>
                            </div>
                            <input type="hidden" id="owner_count" name="owner_count">
                            <button type="button" onclick="addInfoItemOnclick('corp-owner')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('corp-owner')">-</button>
                        </td>

                        <td rowspan="2">
                            <div id="hold-ratio" class="input-align">
                                <div id="hold-ratio-1">
                                    <input type="text" name="hold-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)" required>
                                    /&nbsp;<input type="text" name="hold-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)" required>
                                </div>
                            </div>
                        </td>

                        <td rowspan="2">
                            <div id="pId" class="input-align">
                                <div id="pId-1">
                                    <input type="text" name="pId-1" value="" placeholder="所有權人-1" required>
                                    <!-- <input type="text" id="hold-id-1" name="hold-id-1" value="" placeholder="歸戶號" class="small-input-size" onchange="checkOwner(1)" required> -->
                                </div>
                            </div>
                        </td>

                        <td rowspan="2">聯絡電話</td>
                        <td colspan="2" rowspan="2">
                            <div id="telephone">
                                <div id="telephone-1">
                                    <input type="tel" name="telephone-1" value="" placeholder="所有權人-1">
                                </div>
                            </div>
                        </td>
                        <td rowspan="2">聯絡手機</td>
                        <td colspan="2" rowspan="2">
                            <div id="cellphone">
                                <div id="cellphone-1">
                                    <input type="tel" name="cellphone-1" value="" placeholder="所有權人-1" oninput="cellphoneListen('1')" maxlength="11">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>

                    </tr>

                    <tr>
                        <td><span class="required">(*)</span>土地所有權人</td>
                        <td><span class="required">(*)</span>歸戶號</td>
                        <td><span class="required">(*)</span>身分證字號</td>
                        <td>通訊住址</td>
                        <td colspan="5">
                            <div id="land-address">
                                <div id="land-address-1">
                                    <input type="text" id="landAddressText-1" name="landAddressText-1" value="" class="large-input-size" placeholder="所有權人-1">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div id="land-owner">
                                <div id="land-owner-1">
                                    <input type="text" name="land-owner-1" placeholder="所有權人-1" required><br>
                                </div>
                            </div>
                            <input type="hidden" id="land_owner_count" name="land_owner_count">
                            <button type="button" onclick="addInfoItemOnclick('land-owner')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('land-owner')">-</button>
                        </td>

                        <td>
                            <div id="hold-id" class="input-align">
                                <div id="hold-id-1">
                                    <input type="text" name="hold-id-1" value="" placeholder="所有權人-1" required>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div id="land-pId" class="input-align">
                                <div id="land-pId-1">
                                    <input type="text" name="land-pId-1" value="" placeholder="所有權人-1" required>
                                </div>
                            </div>
                        </td>

                        <td>聯絡電話</td>
                        <td colspan="2">
                            <div id="land-telephone">
                                <div id="land-telephone-1">
                                    <input type="tel" name="land-telephone-1" value="" placeholder="所有權人-1">
                                </div>
                            </div>
                        </td>
                        <td>聯絡手機</td>
                        <td colspan="2">
                            <div id="land-cellphone">
                                <div id="land-cellphone-1">
                                    <input type="tel" name="land-cellphone-1" value="" placeholder="所有權人-1" maxlength="11">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- <td><span class="required">(*)</span>權屬</td> -->
                    <!-- <td colspan="5">
                        <select class="select-menu" name="corp_belong" id="corp_belong" required="">
                            <option value="" style="display:none;">請選擇權屬</option>
                            <option value="所有權人">所有權人</option>
                            <option value="實際使用人">實際使用人</option>
                        </select>
                    </td> -->
                    <tr>
                        <td><span class="required">(*)</span>作物種類</td>
                        <td><span class="required">(*)</span>作物名稱</td>
                        <td><span class="required">(*)</span>作物規格</td>
                        <td><span class="required">(*)</span>數量</td>
                        <td><span class="required">(*)</span>單位</td>
                        <td colspan="3"><span class="required">(*)</span>種植面積</td>
                        <td>備註</td>
                    </tr>

                    <tr>
                        <td>
                            <div id="corp-category" style="margin-top:4px;">
                                <div id="corp-category-1">
                                    <select name="corp-category-1" onchange="load_corp_item_Data(1)" required>
                                        <option value="" style="display:none;">請選擇種類</option>
                                        <?php echo $_smarty_tpl->tpl_vars['corp_category_option']->value;?>

                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="corp-count" name="corp-count">
                            <button type="button" name="" onclick="addInfoItemOnclick('corp-category')">+</button>
                            <button type="button" name="" onclick="removeInfoItemOnclick('corp-category')">-</button>
                        </td>

                        <td>
                            <div id="corp-item" style="margin-bottom:18px">
                                <div id="corp-item-1">
                                    <select name="corp-item-1" onchange="load_corp_type_Data(1)" required>
                                        <option value="">請選擇項目</option>
                                    </select>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div id="corp-type" style="margin-bottom:18px">
                                <div id="corp-type-1">
                                    <select name="corp-type-1" required>
                                        <option value="">請選擇規格</option>
                                    </select>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div id="corp-num" style="margin-bottom:18px">
                                <div id="corp-num-1">
                                    <input type="text" name="corp-num-1" pattern="[0-9]{1,5}" title="只能輸入5位以下數字" placeholder="請輸入數量" required>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div id="corp-unit" style="margin-bottom:18px">
                                <div id="corp-unit-1">
                                    <select class="" name="corp-unit-1" required>
                                        <option value="">請選擇單位</option>
                                    </select>
                                </div>
                            </div>
                        </td>

                        <td colspan="3">
                            <div id="corp-area" style="margin-bottom:18px">
                                <div id="corp-area-1">
                                    <input type="text" name="corp-area-1" class="large-input-size" placeholder="請輸入種植面積" required>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div id="corp-note" style="margin-bottom:18px">
                                <div id="corp-note-1">
                                    <input type="text" name="corp-note-1" class="large-input-size">
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br><br>
        <div class="container" align="center">

            <!-- <input type="hidden" id="action" name="action" value="">
            <input type="submit" value="儲存" onclick="saveDialog()">
            <input type="submit" value="繼續輸入下一頁" onclick="continueInput()"> -->
            <input type="submit" value="儲存" onclick="window.alert('測試用介面，資料不儲存')">
        </form>
    </div>
</body>
</html>
<?php }
}
