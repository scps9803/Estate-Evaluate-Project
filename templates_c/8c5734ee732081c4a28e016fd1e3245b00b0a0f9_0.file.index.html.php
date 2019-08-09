<?php
/* Smarty version 3.1.33, created on 2019-08-09 13:31:56
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d4d75cc835a26_42673305',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c5734ee732081c4a28e016fd1e3245b00b0a0f9' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\index.html',
      1 => 1565357513,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d4d75cc835a26_42673305 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
  <title>新增建物查案</title>
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
        <h1>建物調查表</h1>
        <form class="" action="house_submit_preview.php" method="post" id="house_form" onkeydown="if(event.keyCode==13)return false;">
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
                            <input type="radio" name="legal-status" value="建合" required>建合
                            <input type="radio" name="legal-status" value="建非">建非
                            <input type="text" name="script-number" value="" placeholder="輸入手稿編號" required><br>
                            <!-- 是否廢棄
                            <input type="radio" name="discard-status" value="yes" required>是
                            <input type="radio" name="discard-status" value="no">否 -->
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <!-- <input type="text" id="district" name="district" list="district-list" autocomplete="off" required>
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
                            </datalist> -->
                            <select id="district" name="district" class="median-select-menu" required>
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
                            </select>
                        </td>
                        <td>
                            <div id="land-section">
                                <div id="land-section-1">
                                    <!-- <input type="text" id="section-1" name="land-section-1" list="land-section-list-1" autocomplete="off" oninput="getLandSectionOption(1)" required><br>
                                    <datalist id="land-section-list-1"></datalist> -->
                                    <select id="section-1" name="land-section-1" class="median-select-menu" required>
                                        <option value="塔腳段">塔腳段</option>
                                        <option value="新坡段">新坡段</option>
                                        <option value="樹林子段">樹林子段</option>
                                        <option value="草漯段">草漯段</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="land_section_count" name="land_section_count">
                            <button type="button" onclick="addInfoItemOnclick('land-section')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('land-section')">-</button>
                        </td>

                        <td>
                            <div id="subsection" class="input-align">
                                <div id="subsection-1">
                                    <!-- <input type="text" name="subsection-1"><br> -->
                                    <select id="sub_section-1" name="subsection-1">
                                        <option value="">無</option>
                                        <option value="新坡小段">新坡小段</option>
                                        <option value="過溪子小段">過溪子小段</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <button type="button" onclick="addInfoItemOnclick('subsection')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('subsection')">-</button> -->
                        </td>

                        <td colspan="3">
                            <div id="land-number" class="input-align">
                                <div id="land-number-1">
                                    <input type="text" id="land-num-1" name="land-number-1" placeholder="多個地號請用'、'分隔" onchange="isLandNumExist(1)" required><br>
                                </div>
                            </div>
                            <!-- <button type="button" onclick="addInfoItemOnclick('land-number')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('land-number')">-</button> -->
                        </td>
                        <!-- <td colspan="2"><input type="text" name="land-total-area" value="" required></td> -->
                    </tr>

                    <tr>
                        <td><span class="required">(*)</span>建物所有權人<br>或權利人姓名</td>
                        <td><span class="required">(*)</span>持分比例</td>
                        <!-- <td><span class="required">(*)</span>身分證字號/歸戶號</td> -->
                        <td><span class="required">(*)</span>身分證字號</td>
                        <td><span class="required">(*)</span>房屋門牌</td>
                        <td colspan="3"><input type="text" name="houseAddress" value="" class="larger-input-size" id="houseAddress" required></td>
                        <td><span class="required">(*)</span><br>拆除情形</td>
                        <td><input type="radio" name="remove_condition" value="全拆" required>全拆
                            <input type="radio" name="remove_condition" value="半拆">半拆</td>
                    </tr>

                    <tr>
                        <td rowspan="2">
                            <div id="owner">
                                <div id="owner-1">
                                    <input type="text" name="owner-1" placeholder="所有權人-1" required><br>
                                </div>
                            </div>
                            <input type="hidden" id="owner_count" name="owner_count">
                            <button type="button" onclick="addInfoItemOnclick('owner')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('owner')">-</button>
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

                        <td>通訊住址</td>
                        <td colspan="5">
                            <div id="address">
                                <div id="address-1">
                                    <input type="checkbox" id="sameAddressBox-1" onclick="checkSameAddressBox('1')">同房屋門牌<input type="text" id="addressText-1" name="addressText-1" value="" class="large-input-size" placeholder="所有權人-1">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>聯絡電話</td>
                        <td colspan="2">
                            <div id="telephone">
                                <div id="telephone-1">
                                    <input type="tel" name="telephone-1" value="" placeholder="所有權人-1">
                                </div>
                            </div>
                        </td>
                        <td>聯絡手機</td>
                        <td colspan="2">
                            <div id="cellphone">
                                <div id="cellphone-1">
                                    <input type="tel" name="cellphone-1" value="" placeholder="所有權人-1" oninput="cellphoneListen('1')" maxlength="11">
                                </div>
                            </div>
                        </td>
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
                                <div id="land-owner-1" class="dropdown">
                                    <!-- <input type="text" name="land-owner-1" list="land-owner-list-1" autocomplete="off" placeholder="所有權人-1" oninput="getLandOwnerOption(1)" required><br> -->
                                    <input type="text" name="land-owner-1" list="land-owner-list-1" autocomplete="off" placeholder="所有權人-1" required><br>
                                    <datalist id="land-owner-list-1"></datalist>
                                </div>
                            </div>
                            <input type="hidden" id="land_owner_count" name="land_owner_count">
                            <button type="button" onclick="addInfoItemOnclick('land-owner')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('land-owner')">-</button>
                        </td>

                        <td>
                            <div id="hold-id" class="input-align">
                                <div id="hold-id-1">
                                    <input type="text" name="hold-id-1" value="" placeholder="所有權人-1" onchange="checkOwner(1)" required>
                                    <!-- <input type="text" id="hold-id-1" name="hold-id-1" value="" placeholder="歸戶號" class="small-input-size" onchange="checkOwner(1)" required> -->
                                </div>
                            </div>
                        </td>

                        <td>
                            <div id="land-pId" class="input-align">
                                <div id="land-pId-1">
                                    <input type="text" name="land-pId-1" value="" placeholder="所有權人-1" required>
                                    <!-- <input type="text" id="hold-id-1" name="hold-id-1" value="" placeholder="歸戶號" class="small-input-size" onchange="checkOwner(1)" required> -->
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

                    <tr>
                        <td><span class="required">(*)</span>合法證明文件</td>

                        <td colspan="6">
                            <input type="radio" name="legal_certificate" value="建物所有權狀" required onclick="changeRequired(['build-number'],true)">建物所有權狀(建號:<input type="text" id="build-number" name="build-number" style="width:80px">)
                            <input type="radio" name="legal_certificate" value="建物登記謄本" onclick="changeRequired(['build-number'],false)">建物登記謄本
                            <input type="radio" name="legal_certificate" value="使用執照" onclick="changeRequired(['build-number'],false)">使用執照
                            <input type="radio" name="legal_certificate" value="無" onclick="changeRequired(['build-number'],false)">無
                        </td>
                        <td><span class="required">(*)</span><br>座落土地<br>使用權屬</td>
                        <td colspan="3">
                            <!-- <input type="radio" name="household_registration" value="" onclick="changeRequired(['household_count','household_count_lack'],true)">共
                            <input type="number" id="household_count" name="household_count" min="0" class="small-input-size">戶;缺<input type="number" id="household_count_lack" name="household_count_lack" min="0" class="small-input-size">戶
                            <input type="radio" name="household_registration" value="" onclick="changeRequired(['household_count','household_count_lack'],false)">無 -->
                            <select class="select-menu" name="land-use" required>
                                <option value="" style="display:none;">請選擇項目</option>
                                <option value="自用">自用</option>
                                <option value="承租">承租</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><span class="required">(*)</span>起造證明文件</td>
                        <td colspan="8">
                            <input type="radio" name="build-certificate" value="房屋稅籍證明書" onclick="changeRequired(['tax_number'],true)" required>房屋稅籍證明書(稅籍編號:<input type="text" id="tax_number" name="tax_number">)
                            <input type="radio" name="build-certificate" value="門牌整編證明" onclick="changeRequired(['tax_number'],false)">門牌整編證明
                            <input type="radio" name="build-certificate" value="用電證明" onclick="changeRequired(['tax_number'],false)">用電證明
                            <input type="radio" name="build-certificate" value="用水證明" onclick="changeRequired(['tax_number'],false)">用水證明
                            <input type="radio" name="build-certificate" value="無" onclick="changeRequired(['tax_number'],false)">無
                        </td>
                    </tr>

                    <tr>
                        <td><span class="required">(*)</span>出口數</td>
                        <td>戶長姓名</td>
                        <td>出口編號</td>
                        <td>戶長身份證字號</td>
                        <td>戶口名簿號碼</td>
                        <td colspan="3">設籍日期</td>
                        <td>該戶人數</td>
                    </tr>

                    <tr>
                        <td>
                            <select class="select-menu" id="exit-num" name="exit-num" required>
                                <option value="" style="display:none;">請選擇項目</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <!-- <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option> -->
                            </select>
                        </td>
                        <td>
                            <div id="captain">
                                <div id="captain-1">
                                    <input type="text" name="captain-1">
                                    <!-- <input type="checkbox" id="cohabit-1" name="cohabit-1">共同生活戶
                                    <input type="hidden" id="cohabit-judge" name="cohabit-judge"> -->
                                </div>
                            </div>
                            <input type="hidden" id="captain_count" name="captain_count">
                            <button type="button" onclick="addInfoItemOnclick('captain')">+</button>
                            <button type="button" onclick="removeInfoItemOnclick('captain')">-</button>
                        </td>
                        <td>
                            <div id="exit-No" class="input-align">
                                <div id="exit-No-1">
                                    <input type="text" name="exit-No-1" pattern="[0-9]{1}" title="共同出口戶請填相同數字，例如A、B共用出口都填1，C有單獨出口請填2" placeholder="共同出口戶請填相同數字，例如A、B共用出口都填1，C有單獨出口請填2" onclick="cohabitRemind()" onchange="checkExitNoCorrect()">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div id="captain-id" class="input-align">
                                <div id="captain-id-1">
                                    <input type="text" name="captain-id-1">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div id="household-number" class="input-align">
                                <div id="household-number-1">
                                    <input type="text" name="household-number-1">
                                </div>
                            </div>
                        </td>
                        <td colspan="3">
                            <div id="set-household-date" class="input-align">
                                <div id="set-household-date-1">
                                    <input type="date" name="set-household-date-1">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div id="family-num" class="input-select-align">
                                <div id="family-num-1">
                                    <select class="select-menu" name="family-num-1">
                                        <option value="" style="display:none;">請選擇項目</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br><br>
        <div class="container" align="center">
            <table border="1">
                <tr>
                    <td colspan="2"><span class="required">(*)</span>編號</td>
                    <td colspan="2">編號:<input type="text" id="floor-id-1" name="floor-id-1" required><br><input type="radio" name="house-type-1" value="獨立戶" required>獨立戶<input type="radio" name="house-type-1" value="連棟式邊戶">連棟式邊戶<input type="radio" name="house-type-1" value="連棟式中間戶">連棟式中間戶</td>
                    <td colspan="2">編號:<input type="text" id="floor-id-2" name="floor-id-2" oninput="changeColumnStatus(2,'focus')"><br><input type="radio" id="house-type-2" name="house-type-2" value="獨立戶">獨立戶<input type="radio" name="house-type-2" value="連棟式邊戶">連棟式邊戶<input type="radio" name="house-type-2" value="連棟式中間戶">連棟式中間戶</td>
                    <td colspan="2">編號:<input type="text" id="floor-id-3" name="floor-id-3" oninput="changeColumnStatus(3,'focus')"><br><input type="radio" id="house-type-3" name="house-type-3" value="獨立戶">獨立戶<input type="radio" name="house-type-3" value="連棟式邊戶">連棟式邊戶<input type="radio" name="house-type-3" value="連棟式中間戶">連棟式中間戶</td>
                    <td colspan="2">編號:<input type="text" id="floor-id-4" name="floor-id-4" oninput="changeColumnStatus(4,'focus')"><br><input type="radio" id="house-type-4" name="house-type-4" value="獨立戶">獨立戶<input type="radio" name="house-type-4" value="連棟式邊戶">連棟式邊戶<input type="radio" name="house-type-4" value="連棟式中間戶">連棟式中間戶</td>
                </tr>

                <tr>
                    <td colspan="2">是否廢棄</td>
                    <td colspan="2">
                        <input type="radio" id="discard-status-1" name="discard-status-1" value="yes" required>是
                        <input type="radio" id="discard-status-1" name="discard-status-1" value="no">否
                    </td>
                    <td colspan="2">
                        <input type="radio" id="discard-status-2" name="discard-status-2" value="yes">是
                        <input type="radio" id="discard-status-2" name="discard-status-2" value="no">否
                    </td>
                    <td colspan="2">
                        <input type="radio" id="discard-status-3" name="discard-status-3" value="yes">是
                        <input type="radio" id="discard-status-3" name="discard-status-3" value="no">否
                    </td>
                    <td colspan="2">
                        <input type="radio" id="discard-status-4" name="discard-status-4" value="yes">是
                        <input type="radio" id="discard-status-4" name="discard-status-4" value="no">否
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><span class="required">(*)</span>補償形式</td>
                    <td colspan="2" id="compensate-form-1"><input type="radio" id="pay-form-1" name="compensate-form-1" value="主建物" onclick="compensateFormClick('compensate-form-1')" required>主建物<input type="radio" name="compensate-form-1" value="立面修復" onclick="removeSubCompensateForm('sub-compensate-form-1')">立面修復<br></td>
                    <td colspan="2" id="compensate-form-2"><input type="radio" id="pay-form-2" name="compensate-form-2" value="主建物" onclick="compensateFormClick('compensate-form-2')">主建物<input type="radio" name="compensate-form-2" value="立面修復" onclick="removeSubCompensateForm('sub-compensate-form-2')">立面修復<br></td>
                    <td colspan="2" id="compensate-form-3"><input type="radio" id="pay-form-3" name="compensate-form-3" value="主建物" onclick="compensateFormClick('compensate-form-3')">主建物<input type="radio" name="compensate-form-3" value="立面修復" onclick="removeSubCompensateForm('sub-compensate-form-3')">立面修復<br></td>
                    <td colspan="2" id="compensate-form-4"><input type="radio" id="pay-form-4" name="compensate-form-4" value="主建物" onclick="compensateFormClick('compensate-form-4')">主建物<input type="radio" name="compensate-form-4" value="立面修復" onclick="removeSubCompensateForm('sub-compensate-form-4')">立面修復<br></td>
                </tr>

                <tr>
                    <td rowspan="" colspan="2"><span class="required">(*)</span><br>房屋構造<br>及層別</td>
                    <td>
                        <select class="median-select-menu" id="building-material-1" name="building-material-1" onchange="load_floor_type_data(1)" required>
                            <option value="" style="display:none;">請選擇構造</option>
                            <?php echo $_smarty_tpl->tpl_vars['house_construct_option']->value;?>

                        </select><br>
                        <select class="median-select-menu" id="floor-type-1" name="floor-type-1" style="margin-top:10px;" onchange="checkFloorType(1)">
                            <option value="" style="display:none;">請選擇層別</option>
                        </select>
                    </td>
                    <td>(<input type="number" min="0" class="small-input-size" id="nth-floor-1" name="nth-floor-1" required>F/共<input type="number" min="0" class="small-input-size" id="total-floor-1" name="total-floor-1" required>F)</td>
                    <td>
                        <select class="median-select-menu" id="building-material-2" name="building-material-2" onchange="load_floor_type_data(2)">
                            <option value="" style="display:none;">請選擇構造</option>
                            <?php echo $_smarty_tpl->tpl_vars['house_construct_option']->value;?>

                        </select><br>
                        <select class="median-select-menu" id="floor-type-2" name="floor-type-2" style="margin-top:10px;">
                            <option value="" style="display:none;">請選擇層別</option>
                        </select>
                    </td>
                    <td>(<input type="number" min="0" class="small-input-size" id="nth-floor-2" name="nth-floor-2">F/共<input type="number" min="0" class="small-input-size" id="total-floor-2" name="total-floor-2">F)</td>
                    <td>
                        <select class="median-select-menu" id="building-material-3" name="building-material-3" onchange="load_floor_type_data(3)">
                            <option value="" style="display:none;">請選擇構造</option>
                            <?php echo $_smarty_tpl->tpl_vars['house_construct_option']->value;?>

                        </select><br>
                        <select class="median-select-menu" id="floor-type-3" name="floor-type-3" style="margin-top:10px;">
                            <option value="" style="display:none;">請選擇層別</option>
                        </select>
                    </td>
                    <td>(<input type="number" min="0" class="small-input-size" id="nth-floor-3" name="nth-floor-3">F/共<input type="number" min="0" class="small-input-size" id="total-floor-3" name="total-floor-3">F)</td>
                    <td>
                        <select class="median-select-menu" id="building-material-4" name="building-material-4" onchange="load_floor_type_data(4)">
                            <option value="" style="display:none;">請選擇構造</option>
                            <?php echo $_smarty_tpl->tpl_vars['house_construct_option']->value;?>

                        </select><br>
                        <select class="median-select-menu" id="floor-type-4" name="floor-type-4" style="margin-top:10px;">
                            <option value="" style="display:none;">請選擇層別</option>
                        </select>
                    </td>
                    <td>(<input type="number" min="0" class="small-input-size" id="nth-floor-4" name="nth-floor-4">F/共<input type="number" min="0" class="small-input-size" id="total-floor-4" name="total-floor-4">F)</td>

                </tr>

                <tr>
                    <td colspan="2"><span class="required">(*)</span><br>樓層面積<br>計算式</td>
                    <td colspan="2"><input type="text" class="larger-input-size" id="floor-area-1" name="floor-area-1" onchange="checkAreaCalText(1)" required></td>
                    <td colspan="2"><input type="text" class="larger-input-size" id="floor-area-2" name="floor-area-2" onchange="checkAreaCalText(2)"></td>
                    <td colspan="2"><input type="text" class="larger-input-size" id="floor-area-3" name="floor-area-3" onchange="checkAreaCalText(3)"></td>
                    <td colspan="2"><input type="text" class="larger-input-size" id="floor-area-4" name="floor-area-4" onchange="checkAreaCalText(4)"></td>
                </tr>

                <tr>
                    <td colspan="2">評點項目</td>
                    <td colspan="2">內容</td>
                    <td colspan="2">內容</td>
                    <td colspan="2">內容</td>
                    <td colspan="2">內容</td>
                </tr>

                <tr>
                    <td rowspan="2" colspan="2"><span class="required">(*)</span>用途</td>
                    <td colspan="2">
                        <input type="radio" id="house-usage-1" name="house-usage-1" value="住宅" onclick="changeRequired(['other-house-usage-1'],false)" required>住宅
                        <input type="radio" name="house-usage-1" value="店鋪" onclick="changeRequired(['other-house-usage-1'],false)">店鋪
                        <input type="radio" name="house-usage-1" value="工廠" onclick="changeRequired(['other-house-usage-1'],false)">工廠
                        <input type="radio" name="house-usage-1" value="庫房" onclick="changeRequired(['other-house-usage-1'],false)">庫房<br>
                        <input type="radio" name="house-usage-1" value="none" onclick="changeRequired(['other-house-usage-1'],true)">其他
                        <input type="text" id="other-house-usage-1" name="other-house-usage-1">
                    </td>

                    <td colspan="2">
                        <input type="radio" id="house-usage-2" name="house-usage-2" value="住宅" onclick="changeRequired(['other-house-usage-2'],false)">住宅
                        <input type="radio" name="house-usage-2" value="店鋪" onclick="changeRequired(['other-house-usage-2'],false)">店鋪
                        <input type="radio" name="house-usage-2" value="工廠" onclick="changeRequired(['other-house-usage-2'],false)">工廠
                        <input type="radio" name="house-usage-2" value="庫房" onclick="changeRequired(['other-house-usage-2'],false)">庫房<br>
                        <input type="radio" name="house-usage-2" value="none" onclick="changeRequired(['other-house-usage-2'],true)">其他
                        <input type="text" id="other-house-usage-2" name="other-house-usage-2">
                    </td>

                    <td colspan="2">
                        <input type="radio" id="house-usage-3" name="house-usage-3" value="住宅" onclick="changeRequired(['other-house-usage-3'],false)">住宅
                        <input type="radio" name="house-usage-3" value="店鋪" onclick="changeRequired(['other-house-usage-3'],false)">店鋪
                        <input type="radio" name="house-usage-3" value="工廠" onclick="changeRequired(['other-house-usage-3'],false)">工廠
                        <input type="radio" name="house-usage-3" value="庫房" onclick="changeRequired(['other-house-usage-3'],false)">庫房<br>
                        <input type="radio" name="house-usage-3" value="none" onclick="changeRequired(['other-house-usage-3'],true)">其他
                        <input type="text" id="other-house-usage-3" name="other-house-usage-3">
                    </td>

                    <td colspan="2">
                        <input type="radio" id="house-usage-4" name="house-usage-4" value="住宅" onclick="changeRequired(['other-house-usage-4'],false)">住宅
                        <input type="radio" name="house-usage-4" value="店鋪" onclick="changeRequired(['other-house-usage-4'],false)">店鋪
                        <input type="radio" name="house-usage-4" value="工廠" onclick="changeRequired(['other-house-usage-4'],false)">工廠
                        <input type="radio" name="house-usage-4" value="庫房" onclick="changeRequired(['other-house-usage-4'],false)">庫房<br>
                        <input type="radio" name="house-usage-4" value="none" onclick="changeRequired(['other-house-usage-4'],true)">其他
                        <input type="text" id="other-house-usage-4" name="other-house-usage-4">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">層高:<input type="number" name="layer-height-1" value="3.0" min="0" step="0.01" oninput="if(value.length>4)value=value.slice(0,4)" class="median-input-size">(m)</td>
                    <td colspan="2">層高:<input type="number" name="layer-height-2" value="3.0" min="0" step="0.01" oninput="if(value.length>4)value=value.slice(0,4)" class="median-input-size">(m)</td>
                    <td colspan="2">層高:<input type="number" name="layer-height-3" value="3.0" min="0" step="0.01" oninput="if(value.length>4)value=value.slice(0,4)" class="median-input-size">(m)</td>
                    <td colspan="2">層高:<input type="number" name="layer-height-4" value="3.0" min="0" step="0.01" oninput="if(value.length>4)value=value.slice(0,4)" class="median-input-size">(m)</td>
                </tr>

                <tr>
                    <td rowspan="3" class="vertical-td">構造</td>
                    <td>閣樓</td>
                    <td colspan="2" id="attic-1"><input type="radio" name="attic-1" disabled="true">RC造<input type="radio" name="attic-1" disabled="true">各級木造、鐵造</td>
                    <td colspan="2" id="attic-2"><input type="radio" name="attic-2" disabled="true">RC造<input type="radio" name="attic-2" disabled="true">各級木造、鐵造</td>
                    <td colspan="2" id="attic-3"><input type="radio" name="attic-3" disabled="true">RC造<input type="radio" name="attic-3" disabled="true">各級木造、鐵造</td>
                    <td colspan="2" id="attic-4"><input type="radio" name="attic-4" disabled="true">RC造<input type="radio" name="attic-4" disabled="true">各級木造、鐵造</td>
                </tr>

                <tr>
                    <td>房屋構造體<br>(增減)</td>
                    <td colspan="2">
                        <div id="minus-wall-1-1">
                            <span>減牆:</span>
                            <select id="minus-wall-num-1-1" name="minus-wall-num-1-1">
                                <option value="" style="display:none;">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="minus-wall-option-1-1" name="minus-wall-option-1-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <!-- <option value="">RC牆</option>
                                <option value="">1B</option>
                                <option value="">1/2B</option>
                                <option value="">檜木造</option>
                                <option value="">其他木造</option>
                                <option value="">竹編牆</option> -->
                                <?php echo $_smarty_tpl->tpl_vars['add_minus_wall_option']->value;?>

                            </select>
                        </div>
                        <input type="hidden" id="minus-wall-count-1" name="minus-wall-count-1">
                        <input type="hidden" id="minus-wall-option-1" name="minus-wall-option-1">
                        <button type="button" onclick="addItemOnclick('minus-wall-','1','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('minus-wall-','1')">-</button>

                        <div id="add-wall-1-1">
                            <span>加牆:</span>
                            <select id="add-wall-num-1-1" name="add-wall-num-1-1">
                                <option value="" style="display:none;">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="add-wall-option-1-1" name="add-wall-option-1-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <!-- <option value="">RC牆</option>
                                <option value="">1B</option>
                                <option value="">1/2B</option>
                                <option value="">檜木造</option>
                                <option value="">其他木造</option>
                                <option value="">竹編牆</option> -->
                                <?php echo $_smarty_tpl->tpl_vars['add_minus_wall_option']->value;?>

                            </select>
                        </div>
                        <input type="hidden" id="add-wall-count-1" name="add-wall-count-1">
                        <input type="hidden" id="add-wall-option-1" name="add-wall-option-1">
                        <button type="button" onclick="addItemOnclick('add-wall-','1','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('add-wall-','1')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="minus-wall-2-1">
                            <span>減牆:</span>
                            <select id="minus-wall-num-2-1" name="minus-wall-num-2-1">
                                <option value="" style="display:none;">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="minus-wall-option-2-1" name="minus-wall-option-2-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <!-- <option value="">RC牆</option>
                                <option value="">1B</option>
                                <option value="">1/2B</option>
                                <option value="">檜木造</option>
                                <option value="">其他木造</option>
                                <option value="">竹編牆</option> -->
                                <?php echo $_smarty_tpl->tpl_vars['add_minus_wall_option']->value;?>

                            </select>
                        </div>
                        <input type="hidden" id="minus-wall-count-2" name="minus-wall-count-2">
                        <input type="hidden" id="minus-wall-option-2" name="minus-wall-option-2">
                        <button type="button" onclick="addItemOnclick('minus-wall-','2','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('minus-wall-','2')">-</button>

                        <div id="add-wall-2-1">
                            <span>加牆:</span>
                            <select id="add-wall-num-2-1" name="add-wall-num-2-1">
                                <option value="" style="display:none;">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="add-wall-option-2-1" name="add-wall-option-2-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <!-- <option value="">RC牆</option>
                                <option value="">1B</option>
                                <option value="">1/2B</option>
                                <option value="">檜木造</option>
                                <option value="">其他木造</option>
                                <option value="">竹編牆</option> -->
                                <?php echo $_smarty_tpl->tpl_vars['add_minus_wall_option']->value;?>

                            </select>
                        </div>
                        <input type="hidden" id="add-wall-count-2" name="add-wall-count-2">
                        <input type="hidden" id="add-wall-option-2" name="add-wall-option-2">
                        <button type="button" onclick="addItemOnclick('add-wall-','2','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('add-wall-','2')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="minus-wall-3-1">
                            <span>減牆:</span>
                            <select id="minus-wall-num-3-1" name="minus-wall-num-3-1">
                                <option value="" style="display:none;">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="minus-wall-option-3-1" name="minus-wall-option-3-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <!-- <option value="">RC牆</option>
                                <option value="">1B</option>
                                <option value="">1/2B</option>
                                <option value="">檜木造</option>
                                <option value="">其他木造</option>
                                <option value="">竹編牆</option> -->
                                <?php echo $_smarty_tpl->tpl_vars['add_minus_wall_option']->value;?>

                            </select>
                        </div>
                        <input type="hidden" id="minus-wall-count-3" name="minus-wall-count-3">
                        <input type="hidden" id="minus-wall-option-3" name="minus-wall-option-3">
                        <button type="button" onclick="addItemOnclick('minus-wall-','3','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('minus-wall-','3')">-</button>

                        <div id="add-wall-3-1">
                            <span>加牆:</span>
                            <select id="add-wall-num-3-1" name="add-wall-num-3-1">
                                <option value="" style="display:none;">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="add-wall-option-3-1" name="add-wall-option-3-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <!-- <option value="">RC牆</option>
                                <option value="">1B</option>
                                <option value="">1/2B</option>
                                <option value="">檜木造</option>
                                <option value="">其他木造</option>
                                <option value="">竹編牆</option> -->
                                <?php echo $_smarty_tpl->tpl_vars['add_minus_wall_option']->value;?>

                            </select>
                        </div>
                        <input type="hidden" id="add-wall-count-3" name="add-wall-count-3">
                        <input type="hidden" id="add-wall-option-3" name="add-wall-option-3">
                        <button type="button" onclick="addItemOnclick('add-wall-','3','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('add-wall-','3')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="minus-wall-4-1">
                            <span>減牆:</span>
                            <select id="minus-wall-num-4-1" name="minus-wall-num-4-1">
                                <option value="" style="display:none;">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="minus-wall-option-4-1" name="minus-wall-option-4-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <!-- <option value="">RC牆</option>
                                <option value="">1B</option>
                                <option value="">1/2B</option>
                                <option value="">檜木造</option>
                                <option value="">其他木造</option>
                                <option value="">竹編牆</option> -->
                                <?php echo $_smarty_tpl->tpl_vars['add_minus_wall_option']->value;?>

                            </select>
                        </div>
                        <input type="hidden" id="minus-wall-count-4" name="minus-wall-count-4">
                        <input type="hidden" id="minus-wall-option-4" name="minus-wall-option-4">
                        <button type="button" onclick="addItemOnclick('minus-wall-','4','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('minus-wall-','4')">-</button>

                        <div id="add-wall-4-1">
                            <span>加牆:</span>
                            <select id="add-wall-num-4-1" name="add-wall-num-4-1">
                                <option value="" style="display:none;">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="add-wall-option-4-1" name="add-wall-option-4-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <!-- <option value="">RC牆</option>
                                <option value="">1B</option>
                                <option value="">1/2B</option>
                                <option value="">檜木造</option>
                                <option value="">其他木造</option>
                                <option value="">竹編牆</option> -->
                                <?php echo $_smarty_tpl->tpl_vars['add_minus_wall_option']->value;?>

                            </select>
                        </div>
                        <input type="hidden" id="add-wall-count-4" name="add-wall-count-4">
                        <input type="hidden" id="add-wall-option-4" name="add-wall-option-4">
                        <button type="button" onclick="addItemOnclick('add-wall-','4','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('add-wall-','4')">-</button>
                    </td>
                </tr>

                <tr>
                    <td>室內隔間<br>構造體</td>
                    <td colspan="2">
                        <!-- <input type="checkbox" name="indoor-divide-1">RC牆<input type="checkbox" name="indoor-divide-1">1B<input type="checkbox" name="indoor-divide-1">1/2B
                        <input type="checkbox" name="indoor-divide-1">檜木造<input type="checkbox" name="indoor-divide-1">其他木造<br><input type="checkbox" name="indoor-divide-1">竹編牆 -->
                        <div id="indoor-divide-1-1">
                            <input type="text" id="indoor-divide-numerator-1-1" name="indoor-divide-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-numerator-1-1')">/<input type="text" id="indoor-divide-denominator-1-1" name="indoor-divide-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-denominator-1-1')">
                            <select class="select-menu" id="indoor-divide-option-1-1" name="indoor-divide-option-1-1">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['indoor_divide_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="indoor-divide-numerator-1" name="indoor-divide-numerator-1">
                        <input type="hidden" id="indoor-divide-denominator-1" name="indoor-divide-denominator-1">
                        <input type="hidden" id="indoor-divide-option-1" name="indoor-divide-option-1">
                        <button type="button" onclick="addItemOnclick('indoor-divide-','1','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('indoor-divide-','1')">-</button>
                    </td>
                    <td colspan="2">
                        <!-- <input type="checkbox" name="indoor-divide-2">RC牆<input type="checkbox" name="indoor-divide-2">1B<input type="checkbox" name="indoor-divide-2">1/2B
                        <input type="checkbox" name="indoor-divide-2">檜木造<input type="checkbox" name="indoor-divide-2">其他木造<br><input type="checkbox" name="indoor-divide-2">竹編牆 -->
                        <div id="indoor-divide-2-1">
                            <input type="text" id="indoor-divide-numerator-2-1" name="indoor-divide-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-numerator-2-1')">/<input type="text" id="indoor-divide-denominator-2-1" name="indoor-divide-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-denominator-2-1')">
                            <select class="select-menu" id="indoor-divide-option-2-1" name="indoor-divide-option-2-1">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['indoor_divide_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="indoor-divide-numerator-2" name="indoor-divide-numerator-2">
                        <input type="hidden" id="indoor-divide-denominator-2" name="indoor-divide-denominator-2">
                        <input type="hidden" id="indoor-divide-option-2" name="indoor-divide-option-2">
                        <button type="button" onclick="addItemOnclick('indoor-divide-','2','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('indoor-divide-','2')">-</button>
                    </td>
                    <td colspan="2">
                        <!-- <input type="checkbox" name="indoor-divide-3">RC牆<input type="checkbox" name="indoor-divide-3">1B<input type="checkbox" name="indoor-divide-3">1/2B
                        <input type="checkbox" name="indoor-divide-3">檜木造<input type="checkbox" name="indoor-divide-3">其他木造<br><input type="checkbox" name="indoor-divide-3">竹編牆 -->
                        <div id="indoor-divide-3-1">
                            <input type="text" id="indoor-divide-numerator-3-1" name="indoor-divide-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-numerator-3-1')">/<input type="text" id="indoor-divide-denominator-3-1" name="indoor-divide-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-denominator-3-1')">
                            <select class="select-menu" id="indoor-divide-option-3-1" name="indoor-divide-option-3-1">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['indoor_divide_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="indoor-divide-numerator-3" name="indoor-divide-numerator-3">
                        <input type="hidden" id="indoor-divide-denominator-3" name="indoor-divide-denominator-3">
                        <input type="hidden" id="indoor-divide-option-3" name="indoor-divide-option-3">
                        <button type="button" onclick="addItemOnclick('indoor-divide-','3','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('indoor-divide-','3')">-</button>
                    </td>
                    <td colspan="2">
                        <!-- <input type="checkbox" name="indoor-divide-4">RC牆<input type="checkbox" name="indoor-divide-4">1B<input type="checkbox" name="indoor-divide-4">1/2B
                        <input type="checkbox" name="indoor-divide-4">檜木造<input type="checkbox" name="indoor-divide-4">其他木造<br><input type="checkbox" name="indoor-divide-4">竹編牆 -->
                        <div id="indoor-divide-4-1">
                            <input type="text" id="indoor-divide-numerator-4-1" name="indoor-divide-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-numerator-4-1')">/<input type="text" id="indoor-divide-denominator-4-1" name="indoor-divide-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-denominator-4-1')">
                            <select class="select-menu" id="indoor-divide-option-4-1" name="indoor-divide-option-4-1">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['indoor_divide_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="indoor-divide-numerator-4" name="indoor-divide-numerator-4">
                        <input type="hidden" id="indoor-divide-denominator-4" name="indoor-divide-denominator-4">
                        <input type="hidden" id="indoor-divide-option-4" name="indoor-divide-option-4">
                        <button type="button" onclick="addItemOnclick('indoor-divide-','4','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('indoor-divide-','4')">-</button>
                    </td>
                </tr>

                <tr>
                    <td rowspan="11" class="vertical-td">粉裝造作</td>
                    <td>屋外牆粉裝</td>
                    <td colspan="2">
                        <div id="outdoor-wall-decoration-1-1">
                            <input type="text" id="outdoor-wall-decoration-numerator-1-1" name="outdoor-wall-decoration-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-numerator-1-1')">/<input type="text" id="outdoor-wall-decoration-denominator-1-1" name="outdoor-wall-decoration-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-denominator-1-1')">
                            <select id="outdoor-wall-decoration-option-1-1" name="outdoor-wall-decoration-option-1-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['outdoor_wall_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="outdoor-wall-decoration-numerator-1" name="outdoor-wall-decoration-numerator-1">
                        <input type="hidden" id="outdoor-wall-decoration-denominator-1" name="outdoor-wall-decoration-denominator-1">
                        <input type="hidden" id="outdoor-wall-decoration-option-1" name="outdoor-wall-decoration-option-1">
                        <button type="button" onclick="addItemOnclick('outdoor-wall-decoration-','1','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('outdoor-wall-decoration-','1')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="outdoor-wall-decoration-2-1">
                            <input type="text" id="outdoor-wall-decoration-numerator-2-1" name="outdoor-wall-decoration-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-numerator-2-1')">/<input type="text" id="outdoor-wall-decoration-denominator-2-1" name="outdoor-wall-decoration-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-denominator-2-1')">
                            <select id="outdoor-wall-decoration-option-2-1" name="outdoor-wall-decoration-option-2-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['outdoor_wall_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="outdoor-wall-decoration-numerator-2" name="outdoor-wall-decoration-numerator-2">
                        <input type="hidden" id="outdoor-wall-decoration-denominator-2" name="outdoor-wall-decoration-denominator-2">
                        <input type="hidden" id="outdoor-wall-decoration-option-2" name="outdoor-wall-decoration-option-2">
                        <button type="button" onclick="addItemOnclick('outdoor-wall-decoration-','2','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('outdoor-wall-decoration-','2')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="outdoor-wall-decoration-3-1">
                            <input type="text" id="outdoor-wall-decoration-numerator-3-1" name="outdoor-wall-decoration-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-numerator-3-1')">/<input type="text" id="outdoor-wall-decoration-denominator-3-1" name="outdoor-wall-decoration-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-denominator-3-1')">
                            <select id="outdoor-wall-decoration-option-3-1" name="outdoor-wall-decoration-option-3-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['outdoor_wall_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="outdoor-wall-decoration-numerator-3" name="outdoor-wall-decoration-numerator-3">
                        <input type="hidden" id="outdoor-wall-decoration-denominator-3" name="outdoor-wall-decoration-denominator-3">
                        <input type="hidden" id="outdoor-wall-decoration-option-3" name="outdoor-wall-decoration-option-3">
                        <button type="button" onclick="addItemOnclick('outdoor-wall-decoration-','3','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('outdoor-wall-decoration-','3')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="outdoor-wall-decoration-4-1">
                            <input type="text" id="outdoor-wall-decoration-numerator-4-1" name="outdoor-wall-decoration-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-numerator-4-1')">/<input type="text" id="outdoor-wall-decoration-denominator-4-1" name="outdoor-wall-decoration-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-denominator-4-1')">
                            <select id="outdoor-wall-decoration-option-4-1" name="outdoor-wall-decoration-option-4-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['outdoor_wall_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="outdoor-wall-decoration-numerator-4" name="outdoor-wall-decoration-numerator-4">
                        <input type="hidden" id="outdoor-wall-decoration-denominator-4" name="outdoor-wall-decoration-denominator-4">
                        <input type="hidden" id="outdoor-wall-decoration-option-4" name="outdoor-wall-decoration-option-4">
                        <button type="button" onclick="addItemOnclick('outdoor-wall-decoration-','4','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('outdoor-wall-decoration-','4')">-</button>
                    </td>
                </tr>

                <tr>
                    <td>屋內牆粉裝</td>
                    <td colspan="2">
                        <div id="indoor-wall-decoration-1-1">
                            <input type="text" id="indoor-wall-decoration-numerator-1-1" name="indoor-wall-decoration-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-numerator-1-1')">/<input type="text" id="indoor-wall-decoration-denominator-1-1" name="indoor-wall-decoration-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-denominator-1-1')">
                            <select id="indoor-wall-decoration-option-1-1" name="indoor-wall-decoration-option-1-1" class="tiny-select-menu" onchange="autoCompleteIndoorWallType(1,1)">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['indoor_wall_decoration_option']->value;?>

                            </select>

                            <select id="indoor-wall-type-1-1" name="indoor-wall-type-1-1">
                                <option value="" style="display:none;">種類</option>
                                <option value="無隔">無隔</option>
                                <option value="有隔">有隔</option>
                            </select>
                        </div>

                        <input type="hidden" id="indoor-wall-decoration-numerator-1" name="indoor-wall-decoration-numerator-1">
                        <input type="hidden" id="indoor-wall-decoration-denominator-1" name="indoor-wall-decoration-denominator-1">
                        <input type="hidden" id="indoor-wall-decoration-option-1" name="indoor-wall-decoration-option-1">
                        <input type="hidden" id="indoor-wall-type-1" name="indoor-wall-type-1">
                        <button type="button" onclick="addItemOnclick('indoor-wall-decoration-','1','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('indoor-wall-decoration-','1')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="indoor-wall-decoration-2-1">
                            <input type="text" id="indoor-wall-decoration-numerator-2-1" name="indoor-wall-decoration-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-numerator-2-1')">/<input type="text" id="indoor-wall-decoration-denominator-2-1" name="indoor-wall-decoration-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-denominator-2-1')">
                            <select id="indoor-wall-decoration-option-2-1" name="indoor-wall-decoration-option-2-1" class="tiny-select-menu" onchange="autoCompleteIndoorWallType(2,1)">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['indoor_wall_decoration_option']->value;?>

                            </select>

                            <select id="indoor-wall-type-2-1" name="indoor-wall-type-2-1">
                                <option value="" style="display:none;">種類</option>
                                <option value="無隔">無隔</option>
                                <option value="有隔">有隔</option>
                            </select>
                        </div>

                        <input type="hidden" id="indoor-wall-decoration-numerator-2" name="indoor-wall-decoration-numerator-2">
                        <input type="hidden" id="indoor-wall-decoration-denominator-2" name="indoor-wall-decoration-denominator-2">
                        <input type="hidden" id="indoor-wall-decoration-option-2" name="indoor-wall-decoration-option-2">
                        <input type="hidden" id="indoor-wall-type-2" name="indoor-wall-type-2">
                        <button type="button" onclick="addItemOnclick('indoor-wall-decoration-','2','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('indoor-wall-decoration-','2')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="indoor-wall-decoration-3-1">
                            <input type="text" id="indoor-wall-decoration-numerator-3-1" name="indoor-wall-decoration-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-numerator-3-1')">/<input type="text" id="indoor-wall-decoration-denominator-3-1" name="indoor-wall-decoration-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-denominator-3-1')">
                            <select id="indoor-wall-decoration-option-3-1" name="indoor-wall-decoration-option-3-1" class="tiny-select-menu" onchange="autoCompleteIndoorWallType(3,1)">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['indoor_wall_decoration_option']->value;?>

                            </select>

                            <select id="indoor-wall-type-3-1" name="indoor-wall-type-3-1">
                                <option value="" style="display:none;">種類</option>
                                <option value="無隔">無隔</option>
                                <option value="有隔">有隔</option>
                            </select>
                        </div>

                        <input type="hidden" id="indoor-wall-decoration-numerator-3" name="indoor-wall-decoration-numerator-3">
                        <input type="hidden" id="indoor-wall-decoration-denominator-3" name="indoor-wall-decoration-denominator-3">
                        <input type="hidden" id="indoor-wall-decoration-option-3" name="indoor-wall-decoration-option-3">
                        <input type="hidden" id="indoor-wall-type-3" name="indoor-wall-type-3">
                        <button type="button" onclick="addItemOnclick('indoor-wall-decoration-','3','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('indoor-wall-decoration-','3')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="indoor-wall-decoration-4-1">
                            <input type="text" id="indoor-wall-decoration-numerator-4-1" name="indoor-wall-decoration-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-numerator-4-1')">/<input type="text" id="indoor-wall-decoration-denominator-4-1" name="indoor-wall-decoration-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-denominator-4-1')">
                            <select id="indoor-wall-decoration-option-4-1" name="indoor-wall-decoration-option-4-1" class="tiny-select-menu" onchange="autoCompleteIndoorWallType(4,1)">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['indoor_wall_decoration_option']->value;?>

                            </select>

                            <select id="indoor-wall-type-4-1" name="indoor-wall-type-4-1">
                                <option value="" style="display:none;">種類</option>
                                <option value="無隔">無隔</option>
                                <option value="有隔">有隔</option>
                            </select>
                        </div>

                        <input type="hidden" id="indoor-wall-decoration-numerator-4" name="indoor-wall-decoration-numerator-4">
                        <input type="hidden" id="indoor-wall-decoration-denominator-4" name="indoor-wall-decoration-denominator-4">
                        <input type="hidden" id="indoor-wall-decoration-option-4" name="indoor-wall-decoration-option-4">
                        <input type="hidden" id="indoor-wall-type-4" name="indoor-wall-type-4">
                        <button type="button" onclick="addItemOnclick('indoor-wall-decoration-','4','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('indoor-wall-decoration-','4')">-</button>
                    </td>
                </tr>

                <tr>
                    <td>屋頂(面)<br>粉裝</td>
                    <td colspan="2">
                        <div id="roof-decoration-1-1">
                            <input type="text" id="roof-decoration-numerator-1-1" name="roof-decoration-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-numerator-1-1')">/<input type="text" id="roof-decoration-denominator-1-1" name="roof-decoration-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-denominator-1-1')">
                            <select id="roof-decoration-option-1-1" name="roof-decoration-option-1-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['roof_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="roof-decoration-numerator-1" name="roof-decoration-numerator-1">
                        <input type="hidden" id="roof-decoration-denominator-1" name="roof-decoration-denominator-1">
                        <input type="hidden" id="roof-decoration-option-1" name="roof-decoration-option-1">
                        <button type="button" onclick="addItemOnclick('roof-decoration-','1','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('roof-decoration-','1')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="roof-decoration-2-1">
                            <input type="text" id="roof-decoration-numerator-2-1" name="roof-decoration-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-numerator-2-1')">/<input type="text" id="roof-decoration-denominator-2-1" name="roof-decoration-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-denominator-2-1')">
                            <select id="roof-decoration-option-2-1" name="roof-decoration-option-2-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['roof_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="roof-decoration-numerator-2" name="roof-decoration-numerator-2">
                        <input type="hidden" id="roof-decoration-denominator-2" name="roof-decoration-denominator-2">
                        <input type="hidden" id="roof-decoration-option-2" name="roof-decoration-option-2">
                        <button type="button" onclick="addItemOnclick('roof-decoration-','2','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('roof-decoration-','2')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="roof-decoration-3-1">
                            <input type="text" id="roof-decoration-numerator-3-1" name="roof-decoration-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-numerator-3-1')">/<input type="text" id="roof-decoration-denominator-3-1" name="roof-decoration-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-denominator-3-1')">
                            <select id="roof-decoration-option-3-1" name="roof-decoration-option-3-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['roof_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="roof-decoration-numerator-3" name="roof-decoration-numerator-3">
                        <input type="hidden" id="roof-decoration-denominator-3" name="roof-decoration-denominator-3">
                        <input type="hidden" id="roof-decoration-option-3" name="roof-decoration-option-3">
                        <button type="button" onclick="addItemOnclick('roof-decoration-','3','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('roof-decoration-','3')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="roof-decoration-4-1">
                            <input type="text" id="roof-decoration-numerator-4-1" name="roof-decoration-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-numerator-4-1')">/<input type="text" id="roof-decoration-denominator-4-1" name="roof-decoration-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-denominator-4-1')">
                            <select id="roof-decoration-option-4-1" name="roof-decoration-option-4-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['roof_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="roof-decoration-numerator-4" name="roof-decoration-numerator-4">
                        <input type="hidden" id="roof-decoration-denominator-4" name="roof-decoration-denominator-4">
                        <input type="hidden" id="roof-decoration-option-4" name="roof-decoration-option-4">
                        <button type="button" onclick="addItemOnclick('roof-decoration-','4','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('roof-decoration-','4')">-</button>
                    </td>
                </tr>

                <tr>
                    <td>樓地板粉裝</td>
                    <td colspan="2">
                        <div id="floor-decoration-1-1">
                            <input type="text" id="floor-decoration-numerator-1-1" name="floor-decoration-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-numerator-1-1')">/<input type="text" id="floor-decoration-denominator-1-1" name="floor-decoration-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-denominator-1-1')">
                            <select id="floor-decoration-option-1-1" name="floor-decoration-option-1-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['floor_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="floor-decoration-numerator-1" name="floor-decoration-numerator-1">
                        <input type="hidden" id="floor-decoration-denominator-1" name="floor-decoration-denominator-1">
                        <input type="hidden" id="floor-decoration-option-1" name="floor-decoration-option-1">
                        <button type="button" onclick="addItemOnclick('floor-decoration-','1','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('floor-decoration-','1')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="floor-decoration-2-1">
                            <input type="text" id="floor-decoration-numerator-2-1" name="floor-decoration-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-numerator-2-1')">/<input type="text" id="floor-decoration-denominator-2-1" name="floor-decoration-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-denominator-2-1')">
                            <select id="floor-decoration-option-2-1" name="floor-decoration-option-2-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['floor_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="floor-decoration-numerator-2" name="floor-decoration-numerator-2">
                        <input type="hidden" id="floor-decoration-denominator-2" name="floor-decoration-denominator-2">
                        <input type="hidden" id="floor-decoration-option-2" name="floor-decoration-option-2">
                        <button type="button" onclick="addItemOnclick('floor-decoration-','2','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('floor-decoration-','2')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="floor-decoration-3-1">
                            <input type="text" id="floor-decoration-numerator-3-1" name="floor-decoration-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-numerator-3-1')">/<input type="text" id="floor-decoration-denominator-3-1" name="floor-decoration-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-denominator-3-1')">
                            <select id="floor-decoration-option-3-1" name="floor-decoration-option-3-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['floor_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="floor-decoration-numerator-3" name="floor-decoration-numerator-3">
                        <input type="hidden" id="floor-decoration-denominator-3" name="floor-decoration-denominator-3">
                        <input type="hidden" id="floor-decoration-option-3" name="floor-decoration-option-3">
                        <button type="button" onclick="addItemOnclick('floor-decoration-','3','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('floor-decoration-','3')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="floor-decoration-4-1">
                            <input type="text" id="floor-decoration-numerator-4-1" name="floor-decoration-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-numerator-4-1')">/<input type="text" id="floor-decoration-denominator-4-1" name="floor-decoration-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-denominator-4-1')">
                            <select name="floor-decoration-4-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['floor_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="floor-decoration-numerator-4" name="floor-decoration-numerator-4">
                        <input type="hidden" id="floor-decoration-denominator-4" name="floor-decoration-denominator-4">
                        <input type="hidden" id="floor-decoration-option-4" name="floor-decoration-option-4">
                        <button type="button" onclick="addItemOnclick('floor-decoration-','4','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('floor-decoration-','4')">-</button>
                    </td>
                </tr>

                <tr>
                    <td>天花板粉裝</td>
                    <td colspan="2">
                        <div id="ceiling-decoration-1-1">
                            <input type="text" id="ceiling-decoration-numerator-1-1" name="ceiling-decoration-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-numerator-1-1')">/<input type="text" id="ceiling-decoration-denominator-1-1" name="ceiling-decoration-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-denominator-1-1')">
                            <select id="ceiling-decoration-option-1-1" name="ceiling-decoration-option-1-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['ceiling_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="ceiling-decoration-numerator-1" name="ceiling-decoration-numerator-1">
                        <input type="hidden" id="ceiling-decoration-denominator-1" name="ceiling-decoration-denominator-1">
                        <input type="hidden" id="ceiling-decoration-option-1" name="ceiling-decoration-option-1">
                        <button type="button" onclick="addItemOnclick('ceiling-decoration-','1','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('ceiling-decoration-','1')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="ceiling-decoration-2-1">
                            <input type="text" id="ceiling-decoration-numerator-2-1" name="ceiling-decoration-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-numerator-2-1')">/<input type="text" id="ceiling-decoration-denominator-2-1" name="ceiling-decoration-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-denominator-2-1')">
                            <select id="ceiling-decoration-option-2-1" name="ceiling-decoration-option-2-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['ceiling_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="ceiling-decoration-numerator-2" name="ceiling-decoration-numerator-2">
                        <input type="hidden" id="ceiling-decoration-denominator-2" name="ceiling-decoration-denominator-2">
                        <input type="hidden" id="ceiling-decoration-option-2" name="ceiling-decoration-option-2">
                        <button type="button" onclick="addItemOnclick('ceiling-decoration-','2','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('ceiling-decoration-','2')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="ceiling-decoration-3-1">
                            <input type="text" id="ceiling-decoration-numerator-3-1" name="ceiling-decoration-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-numerator-3-1')">/<input type="text" id="ceiling-decoration-denominator-3-1" name="ceiling-decoration-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-denominator-3-1')">
                            <select id="ceiling-decoration-option-1-1" name="ceiling-decoration-option-1-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['ceiling_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="ceiling-decoration-numerator-3" name="ceiling-decoration-numerator-3">
                        <input type="hidden" id="ceiling-decoration-denominator-3" name="ceiling-decoration-denominator-3">
                        <input type="hidden" id="ceiling-decoration-option-3" name="ceiling-decoration-option-3">
                        <button type="button" onclick="addItemOnclick('ceiling-decoration-','3','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('ceiling-decoration-','3')">-</button>
                    </td>

                    <td colspan="2">
                        <div id="ceiling-decoration-4-1">
                            <input type="text" id="ceiling-decoration-numerator-4-1" name="ceiling-decoration-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-numerator-4-1')">/<input type="text" id="ceiling-decoration-denominator-4-1" name="ceiling-decoration-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-denominator-4-1')">
                            <select name="ceiling-decoration-option-4-1" class="select-menu">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['ceiling_decoration_option']->value;?>

                            </select>
                        </div>

                        <input type="hidden" id="ceiling-decoration-numerator-4" name="ceiling-decoration-numerator-4">
                        <input type="hidden" id="ceiling-decoration-denominator-4" name="ceiling-decoration-denominator-4">
                        <input type="hidden" id="ceiling-decoration-option-4" name="ceiling-decoration-option-4">
                        <button type="button" onclick="addItemOnclick('ceiling-decoration-','4','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('ceiling-decoration-','4')">-</button>
                    </td>
                </tr>

                <tr>
                    <td>門窗裝置/<br>雙層門(窗)</td>
                    <td>
                        <label for="">第一層門</label>
                        <!-- <input type="text" name="first-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-door-1" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第一層窗</label>
                        <!-- <input type="text" name="first-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-window-1" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>
                    <td>
                        <label for="">第二層門</label>
                        <!-- <input type="text" name="second-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-door-1" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第二層窗</label>
                        <!-- <input type="text" name="second-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-window-1" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>

                    <td>
                        <label for="">第一層門</label>
                        <!-- <input type="text" name="first-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-door-2" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第一層窗</label>
                        <!-- <input type="text" name="first-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-window-2" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>
                    <td>
                        <label for="">第二層門</label>
                        <!-- <input type="text" name="second-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-door-2" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第二層窗</label>
                        <!-- <input type="text" name="second-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-window-2" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>

                    <td>
                        <label for="">第一層門</label>
                        <!-- <input type="text" name="first-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-door-3" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第一層窗</label>
                        <!-- <input type="text" name="first-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-window-3" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>
                    <td>
                        <label for="">第二層門</label>
                        <!-- <input type="text" name="second-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-door-3" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第二層窗</label>
                        <!-- <input type="text" name="second-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-window-3" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>

                    <td>
                        <label for="">第一層門</label>
                        <!-- <input type="text" name="first-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-door-4" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第一層窗</label>
                        <!-- <input type="text" name="first-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-window-4" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>
                    <td>
                        <label for="">第二層門</label>
                        <!-- <input type="text" name="second-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-door-4" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第二層窗</label>
                        <!-- <input type="text" name="second-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-window-4" class="median-select-menu">
                            <option value="" style="display:none;">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>浴廁設備<br>含汙水設施</td>
                    <td colspan="2">
                        <div class="table-container" id="toilet-equipment-1-1" style="margin-top:15px;">
                            <!-- 比例:<input type="radio" name="toilet-ratio-1-1" value="1">1<input type="radio" name="toilet-ratio-1-1" value="0.5">1/2<br> -->
                            比例:<select id="toilet-ratio-1-1" name="toilet-ratio-1-1" class="tiny-select-menu">
                                <option value="" style="display:none;">請選擇比例</option>
                                <option value="1">1</option>
                                <option value="0.5">1/2</option>
                            </select><br>
                            型式:<select id="toilet-type-1-1" name="toilet-type-1-1" class="tiny-select-menu" onchange="load_toilet_data(1,1)">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['toilet_equipment_option']->value;?>

                            </select>

                            <select id="toilet-product-1-1" name="toilet-product-1-1">
                                <option value="" style="display:none;">請選擇種類</option>
                            </select>
                            <br>
                            <!-- 座數:<input type="radio" name="toilet-number-1-1" value="3">1~3座<input type="radio" name="toilet-number-1-1" value="6">4~6座<input type="radio" name="toilet-number-1-1" value="7">7座以上 -->
                            座數:<select id="toilet-number-1-1" name="toilet-number-1-1" class="tiny-select-menu">
                                <option value="" style="display:none;">請選擇座數</option>
                                <option value="1">1~3座</option>
                                <option value="2">4~6座</option>
                                <option value="3">7座以上</option>
                            </select>
                        </div>
                        <input type="hidden" id="toilet-ratio-1" name="toilet-ratio-1">
                        <input type="hidden" id="toilet-type-1" name="toilet-type-1">
                        <input type="hidden" id="toilet-product-1" name="toilet-product-1">
                        <input type="hidden" id="toilet-number-1" name="toilet-number-1">
                        <button type="button" onclick="addItemOnclick('toilet-equipment-','1','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('toilet-equipment-','1')">-</button>
                    </td>
                    <td colspan="2">
                        <div class="table-container" id="toilet-equipment-2-1" style="margin-top:15px;">
                            <!-- 比例:<input type="radio" name="toilet-ratio-2-1" value="1">1<input type="radio" name="toilet-ratio-2-1" value="0.5">1/2<br> -->
                            比例:<select id="toilet-ratio-2-1" name="toilet-ratio-2-1" class="tiny-select-menu">
                                <option value="" style="display:none;">請選擇比例</option>
                                <option value="1">1</option>
                                <option value="0.5">1/2</option>
                            </select><br>
                            型式:<select id="toilet-type-2-1" name="toilet-type-2-1" class="tiny-select-menu" onchange="load_toilet_data(2,1)">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['toilet_equipment_option']->value;?>

                            </select>

                            <select id="toilet-product-2-1" name="toilet-product-2-1">
                                <option value="" style="display:none;">請選擇種類</option>
                            </select>
                            <br>
                            <!-- 座數:<input type="radio" name="toilet-number-2-1" value="3">1~3座<input type="radio" name="toilet-number-2-1" value="6">4~6座<input type="radio" name="toilet-number-2-1" value="7">7座以上 -->
                            座數:<select id="toilet-number-2-1" name="toilet-number-2-1" class="tiny-select-menu">
                                <option value="" style="display:none;">請選擇座數</option>
                                <option value="1">1~3座</option>
                                <option value="2">4~6座</option>
                                <option value="3">7座以上</option>
                            </select>
                        </div>
                        <input type="hidden" id="toilet-ratio-2" name="toilet-ratio-2">
                        <input type="hidden" id="toilet-type-2" name="toilet-type-2">
                        <input type="hidden" id="toilet-product-2" name="toilet-product-2">
                        <input type="hidden" id="toilet-number-2" name="toilet-number-2">
                        <button type="button" onclick="addItemOnclick('toilet-equipment-','2','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('toilet-equipment-','2')">-</button>
                    </td>
                    <td colspan="2">
                        <div class="table-container" id="toilet-equipment-3-1" style="margin-top:15px;">
                            <!-- 比例:<input type="radio" name="toilet-ratio-3-1" value="1">1<input type="radio" name="toilet-ratio-3-1" value="0.5">1/2<br> -->
                            比例:<select id="toilet-ratio-3-1" name="toilet-ratio-3-1" class="tiny-select-menu">
                                <option value="" style="display:none;">請選擇比例</option>
                                <option value="1">1</option>
                                <option value="0.5">1/2</option>
                            </select><br>
                            型式:<select id="toilet-type-3-1" name="toilet-type-3-1" class="tiny-select-menu" onchange="load_toilet_data(3,1)">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['toilet_equipment_option']->value;?>

                            </select>

                            <select id="toilet-product-3-1" name="toilet-product-3-1">
                                <option value="" style="display:none;">請選擇種類</option>
                            </select>
                            <br>
                            <!-- 座數:<input type="radio" name="toilet-number-3-1" value="3">1~3座<input type="radio" name="toilet-number-3-1" value="6">4~6座<input type="radio" name="toilet-number-3-1" value="7">7座以上 -->
                            座數:<select id="toilet-number-3-1" name="toilet-number-3-1" class="tiny-select-menu">
                                <option value="" style="display:none;">請選擇座數</option>
                                <option value="1">1~3座</option>
                                <option value="2">4~6座</option>
                                <option value="3">7座以上</option>
                            </select>
                        </div>
                        <input type="hidden" id="toilet-ratio-3" name="toilet-ratio-3">
                        <input type="hidden" id="toilet-type-3" name="toilet-type-3">
                        <input type="hidden" id="toilet-product-3" name="toilet-product-3">
                        <input type="hidden" id="toilet-number-3" name="toilet-number-3">
                        <button type="button" onclick="addItemOnclick('toilet-equipment-','3','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('toilet-equipment-','3')">-</button>
                    </td>
                    <td colspan="2">
                        <div class="table-container" id="toilet-equipment-4-1" style="margin-top:15px;">
                            <!-- 比例:<input type="radio" name="toilet-ratio-4-1" value="1">1<input type="radio" name="toilet-ratio-4-1" value="0.5">1/2<br> -->
                            比例:<select id="toilet-ratio-4-1" name="toilet-ratio-4-1" class="tiny-select-menu">
                                <option value="" style="display:none;">請選擇比例</option>
                                <option value="1">1</option>
                                <option value="0.5">1/2</option>
                            </select><br>
                            型式:<select id="toilet-type-4-1" name="toilet-type-4-1" class="tiny-select-menu" onchange="load_toilet_data(4,1)">
                                <option value="" style="display:none;">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['toilet_equipment_option']->value;?>

                            </select>

                            <select id="toilet-product-4-1" name="toilet-product-4-1">
                                <option value="" style="display:none;">請選擇種類</option>
                            </select>
                            <br>
                            <!-- 座數:<input type="radio" name="toilet-number-4-1" value="3">1~3座<input type="radio" name="toilet-number-4-1" value="6">4~6座<input type="radio" name="toilet-number-4-1" value="7">7座以上 -->
                            座數:<select id="toilet-number-4-1" name="toilet-number-4-1" class="tiny-select-menu">
                                <option value="" style="display:none;">請選擇座數</option>
                                <option value="1">1~3座</option>
                                <option value="2">4~6座</option>
                                <option value="3">7座以上</option>
                            </select>
                        </div>
                        <input type="hidden" id="toilet-ratio-4" name="toilet-ratio-4">
                        <input type="hidden" id="toilet-type-4" name="toilet-type-4">
                        <input type="hidden" id="toilet-product-4" name="toilet-product-4">
                        <input type="hidden" id="toilet-number-4" name="toilet-number-4">
                        <button type="button" onclick="addItemOnclick('toilet-equipment-','4','1')">+</button>
                        <button type="button" onclick="removeItemOnclick('toilet-equipment-','4')">-</button>
                    </td>
                </tr>

                <tr>
                    <td>電器設備<br>(含燈具及其<br>220V以下電源)</td>
                    <!-- <td><input type="radio" name="Electric-type-1">露<input type="radio" name="Electric-type-1">隱</td>
                    <td><input type="radio" name="Electric-level-1">日光<input type="radio" name="Electric-level-1">高級<input type="radio" name="Electric-level-1">豪華</td> -->
                    <td colspan="2">
                        <select id="electric-usage-1" name="electric-usage-1" onchange="load_electric_data(1)">
                            <option value="" style="display:none;">請選擇用途</option>
                            <?php echo $_smarty_tpl->tpl_vars['electric_usage_option']->value;?>

                        </select>

                        <select class="select-menu" id="electric-type-1" name="electric-type-1">
                            <option value="" style="display:none;">請選擇種類</option>
                        </select>
                    </td>

                    <!-- <td><input type="radio" name="Electric-type-2">露<input type="radio" name="Electric-type-2">隱</td>
                    <td><input type="radio" name="Electric-level-2">日光<input type="radio" name="Electric-level-2">高級<input type="radio" name="Electric-level-2">豪華</td> -->
                    <td colspan="2">
                        <select id="electric-usage-2" name="electric-usage-2" onchange="load_electric_data(2)">
                            <option value="" style="display:none;">請選擇用途</option>
                            <?php echo $_smarty_tpl->tpl_vars['electric_usage_option']->value;?>

                        </select>

                        <select class="select-menu" id="electric-type-2" name="electric-type-2">
                            <option value="" style="display:none;">請選擇種類</option>
                        </select>
                    </td>

                    <!-- <td><input type="radio" name="Electric-type-3">露<input type="radio" name="Electric-type-3">隱</td>
                    <td><input type="radio" name="Electric-level-3">日光<input type="radio" name="Electric-level-3">高級<input type="radio" name="Electric-level-3">豪華</td> -->
                    <td colspan="2">
                        <select id="electric-usage-3" name="electric-usage-3" onchange="load_electric_data(3)">
                            <option value="" style="display:none;">請選擇用途</option>
                            <?php echo $_smarty_tpl->tpl_vars['electric_usage_option']->value;?>

                        </select>

                        <select class="select-menu" id="electric-type-3" name="electric-type-3">
                            <option value="" style="display:none;">請選擇種類</option>
                        </select>
                    </td>

                    <!-- <td><input type="radio" name="Electric-type-4">露<input type="radio" name="Electric-type-4">隱</td>
                    <td><input type="radio" name="Electric-level-4">日光<input type="radio" name="Electric-level-4">高級<input type="radio" name="Electric-level-4">豪華</td> -->
                    <td colspan="2">
                        <select id="electric-usage-4" name="electric-usage-4" onchange="load_electric_data(4)">
                            <option value="" style="display:none;">請選擇用途</option>
                            <?php echo $_smarty_tpl->tpl_vars['electric_usage_option']->value;?>

                        </select>

                        <select class="select-menu" id="electric-type-4" name="electric-type-4">
                            <option value="" style="display:none;">請選擇種類</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>窗或陽台設鐵柵<br>(鐵窗)</td>
                    <td colspan="2"><input type="radio" name="window-level-1" value="普通型">普通型<input type="radio" name="window-level-1" value="美術型">美術型<input type="radio" name="window-level-1" value="豪華型">豪華型</td>
                    <td colspan="2"><input type="radio" name="window-level-2" value="普通型">普通型<input type="radio" name="window-level-2" value="美術型">美術型<input type="radio" name="window-level-2" value="豪華型">豪華型</td>
                    <td colspan="2"><input type="radio" name="window-level-3" value="普通型">普通型<input type="radio" name="window-level-3" value="美術型">美術型<input type="radio" name="window-level-3" value="豪華型">豪華型</td>
                    <td colspan="2"><input type="radio" name="window-level-4" value="普通型">普通型<input type="radio" name="window-level-4" value="美術型">美術型<input type="radio" name="window-level-4" value="豪華型">豪華型</td>
                </tr>

                <tr>
                    <td>女兒牆</td>
                    <td colspan="2">
                        <div class="daughter-wall-container">
                            RC:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="RC-front-1" name="daughter-wall-1[]" value="RC-front" onclick="setDaughterWall('RC-front','1','front')">前<input type="checkbox" id="RC-behind-1" name="daughter-wall-1[]" value="RC-behind" onclick="setDaughterWall('RC-behind','1','behind')">後<input type="checkbox" id="RC-left-1" name="daughter-wall-1[]" value="RC-left" onclick="setDaughterWall('RC-left','1','left')">左<input type="checkbox" id="RC-right-1" name="daughter-wall-1[]" value="RC-right" onclick="setDaughterWall('RC-right','1','right')">右<br>
                            1B:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="1B-front-1" name="daughter-wall-1[]" value="1B-front" onclick="setDaughterWall('1B-front','1','front')">前<input type="checkbox" id="1B-behind-1" name="daughter-wall-1[]" value="1B-behind" onclick="setDaughterWall('1B-behind','1','behind')">後<input type="checkbox" id="1B-left-1" name="daughter-wall-1[]" value="1B-left" onclick="setDaughterWall('1B-left','1','left')">左<input type="checkbox" id="1B-right-1" name="daughter-wall-1[]" value="1B-right" onclick="setDaughterWall('1B-right','1','right')">右<br>
                            1/2B:&nbsp;<input type="checkbox" id="half_B-front-1" name="daughter-wall-1[]" value="half_B-front" onclick="setDaughterWall('half_B-front','1','front')">前<input type="checkbox" id="half_B-behind-1" name="daughter-wall-1[]" value="half_B-behind" onclick="setDaughterWall('half_B-behind','1','behind')">後<input type="checkbox" id="half_B-left-1" name="daughter-wall-1[]" value="half_B-left" onclick="setDaughterWall('half_B-left','1','left')">左<input type="checkbox" id="half_B-right-1" name="daughter-wall-1[]" value="half_B-right" onclick="setDaughterWall('half_B-right','1','right')">右<br>
                        </div>
                    </td>

                    <td colspan="2">
                        <div class="daughter-wall-container">
                            RC:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="RC-front-2" name="daughter-wall-2[]" value="RC-front" onclick="setDaughterWall('RC-front','2','front')">前<input type="checkbox" id="RC-behind-2" name="daughter-wall-2[]" value="RC-behind" onclick="setDaughterWall('RC-behind','2','behind')">後<input type="checkbox" id="RC-left-2" name="daughter-wall-2[]" value="RC-left" onclick="setDaughterWall('RC-left','2','left')">左<input type="checkbox" id="RC-right-2" name="daughter-wall-2[]" value="RC-right" onclick="setDaughterWall('RC-right','2','right')">右<br>
                            1B:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="1B-front-2" name="daughter-wall-2[]" value="1B-front" onclick="setDaughterWall('1B-front','2','front')">前<input type="checkbox" id="1B-behind-2" name="daughter-wall-2[]" value="1B-behind" onclick="setDaughterWall('1B-behind','2','behind')">後<input type="checkbox" id="1B-left-2" name="daughter-wall-2[]" value="1B-left" onclick="setDaughterWall('1B-left','2','left')">左<input type="checkbox" id="1B-right-2" name="daughter-wall-2[]" value="1B-right" onclick="setDaughterWall('1B-right','2','right')">右<br>
                            1/2B:&nbsp;<input type="checkbox" id="half_B-front-2" name="daughter-wall-2[]" value="half_B-front" onclick="setDaughterWall('half_B-front','2','front')">前<input type="checkbox" id="half_B-behind-2" name="daughter-wall-2[]" value="half_B-behind" onclick="setDaughterWall('half_B-behind','2','behind')">後<input type="checkbox" id="half_B-left-2" name="daughter-wall-2[]" value="half_B-left" onclick="setDaughterWall('half_B-left','2','left')">左<input type="checkbox" id="half_B-right-2" name="daughter-wall-2[]" value="half_B-right" onclick="setDaughterWall('half_B-right','2','right')">右<br>
                        </div>
                    </td>

                    <td colspan="2">
                        <div class="daughter-wall-container">
                            RC:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="RC-front-3" name="daughter-wall-3[]" value="RC-front" onclick="setDaughterWall('RC-front','3','front')">前<input type="checkbox" id="RC-behind-3" name="daughter-wall-3[]" value="RC-behind" onclick="setDaughterWall('RC-behind','3','behind')">後<input type="checkbox" id="RC-left-3" name="daughter-wall-3[]" value="RC-left" onclick="setDaughterWall('RC-left','3','left')">左<input type="checkbox" id="RC-right-3" name="daughter-wall-3[]" value="RC-right" onclick="setDaughterWall('RC-right','3','right')">右<br>
                            1B:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="1B-front-3" name="daughter-wall-3[]" value="1B-front" onclick="setDaughterWall('1B-front','3','front')">前<input type="checkbox" id="1B-behind-3" name="daughter-wall-3[]" value="1B-behind" onclick="setDaughterWall('1B-behind','3','behind')">後<input type="checkbox" id="1B-left-3" name="daughter-wall-3[]" value="1B-left" onclick="setDaughterWall('1B-left','3','left')">左<input type="checkbox" id="1B-right-3" name="daughter-wall-3[]" value="1B-right" onclick="setDaughterWall('1B-right','3','right')">右<br>
                            1/2B:&nbsp;<input type="checkbox" id="half_B-front-3" name="daughter-wall-3[]" value="half_B-front" onclick="setDaughterWall('half_B-front','3','front')">前<input type="checkbox" id="half_B-behind-3" name="daughter-wall-3[]" value="half_B-behind" onclick="setDaughterWall('half_B-behind','3','behind')">後<input type="checkbox" id="half_B-left-3" name="daughter-wall-3[]" value="half_B-left" onclick="setDaughterWall('half_B-left','3','left')">左<input type="checkbox" id="half_B-right-3" name="daughter-wall-3[]" value="half_B-right" onclick="setDaughterWall('half_B-right','3','right')">右<br>
                        </div>
                    </td>

                    <td colspan="2">
                        <div class="daughter-wall-container">
                            RC:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="RC-front-4" name="daughter-wall-4[]" value="RC-front" onclick="setDaughterWall('RC-front','4','front')">前<input type="checkbox" id="RC-behind-4" name="daughter-wall-4[]" value="RC-behind" onclick="setDaughterWall('RC-behind','4','behind')">後<input type="checkbox" id="RC-left-4" name="daughter-wall-4[]" value="RC-left" onclick="setDaughterWall('RC-left','4','left')">左<input type="checkbox" id="RC-right-4" name="daughter-wall-4[]" value="RC-right" onclick="setDaughterWall('RC-right','4','right')">右<br>
                            1B:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="1B-front-4" name="daughter-wall-4[]" value="1B-front" onclick="setDaughterWall('1B-front','4','front')">前<input type="checkbox" id="1B-behind-4" name="daughter-wall-4[]" value="1B-behind" onclick="setDaughterWall('1B-behind','4','behind')">後<input type="checkbox" id="1B-left-4" name="daughter-wall-4[]" value="1B-left" onclick="setDaughterWall('1B-left','4','left')">左<input type="checkbox" id="1B-right-4" name="daughter-wall-4[]" value="1B-right" onclick="setDaughterWall('1B-right','4','right')">右<br>
                            1/2B:&nbsp;<input type="checkbox" id="half_B-front-4" name="daughter-wall-4[]" value="half_B-front" onclick="setDaughterWall('half_B-front','4','front')">前<input type="checkbox" id="half_B-behind-4" name="daughter-wall-4[]" value="half_B-behind" onclick="setDaughterWall('half_B-behind','4','behind')">後<input type="checkbox" id="half_B-left-4" name="daughter-wall-4[]" value="half_B-left" onclick="setDaughterWall('half_B-left','4','left')">左<input type="checkbox" id="half_B-right-4" name="daughter-wall-4[]" value="half_B-right" onclick="setDaughterWall('half_B-right','4','right')">右<br>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>陽台</td>
                    <td colspan="2"><input type="checkbox" name="balcony-1[]" value="前">前<input type="checkbox" name="balcony-1[]" value="後">後<input type="checkbox" name="balcony-1[]" value="左">左<input type="checkbox" name="balcony-1[]" value="右">右</td>
                    <td colspan="2"><input type="checkbox" name="balcony-2[]" value="前">前<input type="checkbox" name="balcony-2[]" value="後">後<input type="checkbox" name="balcony-2[]" value="左">左<input type="checkbox" name="balcony-2[]" value="右">右</td>
                    <td colspan="2"><input type="checkbox" name="balcony-3[]" value="前">前<input type="checkbox" name="balcony-3[]" value="後">後<input type="checkbox" name="balcony-3[]" value="左">左<input type="checkbox" name="balcony-3[]" value="右">右</td>
                    <td colspan="2"><input type="checkbox" name="balcony-4[]" value="前">前<input type="checkbox" name="balcony-4[]" value="後">後<input type="checkbox" name="balcony-4[]" value="左">左<input type="checkbox" name="balcony-4[]" value="右">右</td>
                </tr>

            </table>

            <!-- <span id="sub-building"></span>
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
            </table> -->
            <span id="sub-building"></span>

            <input type="hidden" id="action" name="action" value="">
            <input type="submit" value="儲存" onclick="saveDialog()">
            <input type="submit" value="繼續輸入下一頁" onclick="continueInput()">
        </form>
    </div>
</body>
</html>
<?php }
}
