<?php
/* Smarty version 3.1.33, created on 2019-09-19 03:06:17
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\building_continue.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d82f0a97d28e8_84694427',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c10a27b7c3cfa44c898edc039005567fae642e93' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\building_continue.html',
      1 => 1568862345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d82f0a97d28e8_84694427 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
  <title id="title">新增建物查案</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/loading.css">
  <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 type="text/javascript" src="js/index.js"><?php echo '</script'; ?>
>
  <!-- <?php echo '<script'; ?>
 type="text/javascript" src="js/loading.js"><?php echo '</script'; ?>
> -->
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
        <form class="" action="continue.php" method="post" id="house_form" onkeydown="if(event.keyCode==13)return false;" onsubmit="return checkSubmit('<?php echo $_smarty_tpl->tpl_vars['script_number']->value;?>
')">
        <div class="container" align="center">
            <table border="1">
                <tr>
                    <td colspan="2"><span class="required">(*)</span>編號</td>
                    <td colspan="2">編號:<input type="text" id="floor-id-1" name="floor-id-1" required><br><input type="radio" id="house-type-1" name="house-type-1" value="獨立戶" required>獨立戶<input type="radio" id="house-type-edge-1" name="house-type-1" value="連棟式邊戶">連棟式邊戶<input type="radio" id="house-type-mid-1" name="house-type-1" value="連棟式中間戶">連棟式中間戶</td>
                    <td colspan="2">編號:<input type="text" id="floor-id-2" name="floor-id-2" oninput="changeColumnStatus(2,'focus')"><br><input type="radio" id="house-type-2" name="house-type-2" value="獨立戶">獨立戶<input type="radio" id="house-type-edge-2" name="house-type-2" value="連棟式邊戶">連棟式邊戶<input type="radio" id="house-type-mid-2" name="house-type-2" value="連棟式中間戶">連棟式中間戶</td>
                    <td colspan="2">編號:<input type="text" id="floor-id-3" name="floor-id-3" oninput="changeColumnStatus(3,'focus')"><br><input type="radio" id="house-type-3" name="house-type-3" value="獨立戶">獨立戶<input type="radio" id="house-type-edge-3" name="house-type-3" value="連棟式邊戶">連棟式邊戶<input type="radio" id="house-type-mid-3" name="house-type-3" value="連棟式中間戶">連棟式中間戶</td>
                    <td colspan="2">編號:<input type="text" id="floor-id-4" name="floor-id-4" oninput="changeColumnStatus(4,'focus')"><br><input type="radio" id="house-type-4" name="house-type-4" value="獨立戶">獨立戶<input type="radio" id="house-type-edge-4" name="house-type-4" value="連棟式邊戶">連棟式邊戶<input type="radio" id="house-type-mid-4" name="house-type-4" value="連棟式中間戶">連棟式中間戶</td>
                </tr>

                <tr>
                    <td colspan="2">是否廢棄</td>
                    <td colspan="2">
                        <input type="radio" id="discard-status-1" name="discard-status-1" value="yes" required>是
                        <input type="radio" id="discard-status-no-1" name="discard-status-1" value="no" checked>否
                    </td>
                    <td colspan="2">
                        <input type="radio" id="discard-status-2" name="discard-status-2" value="yes">是
                        <input type="radio" id="discard-status-no-2" name="discard-status-2" value="no" checked>否
                    </td>
                    <td colspan="2">
                        <input type="radio" id="discard-status-3" name="discard-status-3" value="yes">是
                        <input type="radio" id="discard-status-no-3" name="discard-status-3" value="no" checked>否
                    </td>
                    <td colspan="2">
                        <input type="radio" id="discard-status-4" name="discard-status-4" value="yes">是
                        <input type="radio" id="discard-status-no-4" name="discard-status-4" value="no" checked>否
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><span class="required">(*)</span>補償形式</td>
                    <td colspan="2" id="compensate-form-1"><input type="radio" id="pay-form-1" name="compensate-form-1" value="主建物" onclick="compensateFormClick('compensate-form-1')" checked>主建物<input type="radio" id="pay-form-fix-1" name="compensate-form-1" value="立面修復" onclick="removeSubCompensateForm('sub-compensate-form-1')">立面修復<br></td>
                    <td colspan="2" id="compensate-form-2"><input type="radio" id="pay-form-2" name="compensate-form-2" value="主建物" onclick="compensateFormClick('compensate-form-2')" checked>主建物<input type="radio" id="pay-form-fix-2" name="compensate-form-2" value="立面修復" onclick="removeSubCompensateForm('sub-compensate-form-2')">立面修復<br></td>
                    <td colspan="2" id="compensate-form-3"><input type="radio" id="pay-form-3" name="compensate-form-3" value="主建物" onclick="compensateFormClick('compensate-form-3')" checked>主建物<input type="radio" id="pay-form-fix-3" name="compensate-form-3" value="立面修復" onclick="removeSubCompensateForm('sub-compensate-form-3')">立面修復<br></td>
                    <td colspan="2" id="compensate-form-4"><input type="radio" id="pay-form-4" name="compensate-form-4" value="主建物" onclick="compensateFormClick('compensate-form-4')" checked>主建物<input type="radio" id="pay-form-fix-4" name="compensate-form-4" value="立面修復" onclick="removeSubCompensateForm('sub-compensate-form-4')">立面修復<br></td>
                </tr>

                <tr>
                    <td rowspan="" colspan="2"><span class="required">(*)</span><br>房屋構造<br>及層別</td>
                    <td>
                        <select class="median-select-menu" id="building-material-1" name="building-material-1" onchange="load_floor_type_data(1)" required>
                            <option value="">請選擇構造</option>
                            <?php echo $_smarty_tpl->tpl_vars['house_construct_option']->value;?>

                        </select><br>
                        <select class="median-select-menu" id="floor-type-1" name="floor-type-1" style="margin-top:10px;" onchange="checkFloorType(1)">
                            <option value="" style="display:none;">請選擇層別</option>
                        </select>
                    </td>
                    <td>(<input type="number" min="0" class="small-input-size" id="nth-floor-1" name="nth-floor-1" required>F/共<input type="number" min="0" class="small-input-size" id="total-floor-1" name="total-floor-1" required>F)</td>
                    <td>
                        <select class="median-select-menu" id="building-material-2" name="building-material-2" onchange="load_floor_type_data(2)">
                            <option value="">請選擇構造</option>
                            <?php echo $_smarty_tpl->tpl_vars['house_construct_option']->value;?>

                        </select><br>
                        <select class="median-select-menu" id="floor-type-2" name="floor-type-2" style="margin-top:10px;">
                            <option value="" style="display:none;">請選擇層別</option>
                        </select>
                    </td>
                    <td>(<input type="number" min="0" class="small-input-size" id="nth-floor-2" name="nth-floor-2">F/共<input type="number" min="0" class="small-input-size" id="total-floor-2" name="total-floor-2">F)</td>
                    <td>
                        <select class="median-select-menu" id="building-material-3" name="building-material-3" onchange="load_floor_type_data(3)">
                            <option value="">請選擇構造</option>
                            <?php echo $_smarty_tpl->tpl_vars['house_construct_option']->value;?>

                        </select><br>
                        <select class="median-select-menu" id="floor-type-3" name="floor-type-3" style="margin-top:10px;">
                            <option value="" style="display:none;">請選擇層別</option>
                        </select>
                    </td>
                    <td>(<input type="number" min="0" class="small-input-size" id="nth-floor-3" name="nth-floor-3">F/共<input type="number" min="0" class="small-input-size" id="total-floor-3" name="total-floor-3">F)</td>
                    <td>
                        <select class="median-select-menu" id="building-material-4" name="building-material-4" onchange="load_floor_type_data(4)">
                            <option value="">請選擇構造</option>
                            <?php echo $_smarty_tpl->tpl_vars['house_construct_option']->value;?>

                        </select><br>
                        <select class="median-select-menu" id="floor-type-4" name="floor-type-4" style="margin-top:10px;">
                            <option value="" style="display:none;">請選擇層別</option>
                        </select>
                    </td>
                    <td>(<input type="number" min="0" class="small-input-size" id="nth-floor-4" name="nth-floor-4">F/共<input type="number" min="0" class="small-input-size" id="total-floor-4" name="total-floor-4">F)</td>

                </tr>

                <!-- <tr>
                    <td colspan="2">(<input type="number" min="0" class="small-input-size" id="nth-floor-1" name="nth-floor-1">F/共<input type="number" min="0" class="small-input-size" id="total-floor-1" name="total-floor-1">F)</td>
                    <td colspan="2">(<input type="number" min="0" class="small-input-size" id="nth-floor-2" name="nth-floor-2">F/共<input type="number" min="0" class="small-input-size" id="total-floor-2" name="total-floor-2">F)</td>
                    <td colspan="2">(<input type="number" min="0" class="small-input-size" id="nth-floor-3" name="nth-floor-3">F/共<input type="number" min="0" class="small-input-size" id="total-floor-3" name="total-floor-3">F)</td>
                    <td colspan="2">(<input type="number" min="0" class="small-input-size" id="nth-floor-4" name="nth-floor-4">F/共<input type="number" min="0" class="small-input-size" id="total-floor-4" name="total-floor-4">F)</td>
                </tr> -->

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
                        <input type="radio" id="house-usage-1" name="house-usage-1" value="住宅" onclick="changeRequired(['other-house-usage-1'],false)" checked required>住宅
                        <input type="radio" id="house-usage-store-1" name="house-usage-1" value="店鋪" onclick="changeRequired(['other-house-usage-1'],false)">店鋪
                        <input type="radio" id="house-usage-fab-1" name="house-usage-1" value="工廠" onclick="changeRequired(['other-house-usage-1'],false)">工廠
                        <input type="radio" id="house-usage-warehouse-1" name="house-usage-1" value="庫房" onclick="changeRequired(['other-house-usage-1'],false)">庫房<br>
                        <input type="radio" id="house-usage-other-1" name="house-usage-1" value="none" onclick="changeRequired(['other-house-usage-1'],true)">其他
                        <input type="text" id="other-house-usage-1" name="other-house-usage-1">
                    </td>

                    <td colspan="2">
                        <input type="radio" id="house-usage-2" name="house-usage-2" value="住宅" onclick="changeRequired(['other-house-usage-2'],false)" checked>住宅
                        <input type="radio" id="house-usage-store-2" name="house-usage-2" value="店鋪" onclick="changeRequired(['other-house-usage-2'],false)">店鋪
                        <input type="radio" id="house-usage-fab-2" name="house-usage-2" value="工廠" onclick="changeRequired(['other-house-usage-2'],false)">工廠
                        <input type="radio" id="house-usage-warehouse-2" name="house-usage-2" value="庫房" onclick="changeRequired(['other-house-usage-2'],false)">庫房<br>
                        <input type="radio" id="house-usage-other-2" name="house-usage-2" value="none" onclick="changeRequired(['other-house-usage-2'],true)">其他
                        <input type="text" id="other-house-usage-2" name="other-house-usage-2">
                    </td>

                    <td colspan="2">
                        <input type="radio" id="house-usage-3" name="house-usage-3" value="住宅" onclick="changeRequired(['other-house-usage-3'],false)" checked>住宅
                        <input type="radio" id="house-usage-store-3" name="house-usage-3" value="店鋪" onclick="changeRequired(['other-house-usage-3'],false)">店鋪
                        <input type="radio" id="house-usage-fab-3" name="house-usage-3" value="工廠" onclick="changeRequired(['other-house-usage-3'],false)">工廠
                        <input type="radio" id="house-usage-warehouse-3" name="house-usage-3" value="庫房" onclick="changeRequired(['other-house-usage-3'],false)">庫房<br>
                        <input type="radio" id="house-usage-other-3" name="house-usage-3" value="none" onclick="changeRequired(['other-house-usage-3'],true)">其他
                        <input type="text" id="other-house-usage-3" name="other-house-usage-3">
                    </td>

                    <td colspan="2">
                        <input type="radio" id="house-usage-4" name="house-usage-4" value="住宅" onclick="changeRequired(['other-house-usage-4'],false)" checked>住宅
                        <input type="radio" id="house-usage-store-4" name="house-usage-4" value="店鋪" onclick="changeRequired(['other-house-usage-4'],false)">店鋪
                        <input type="radio" id="house-usage-fab-4" name="house-usage-4" value="工廠" onclick="changeRequired(['other-house-usage-4'],false)">工廠
                        <input type="radio" id="house-usage-warehouse-4" name="house-usage-4" value="庫房" onclick="changeRequired(['other-house-usage-4'],false)">庫房<br>
                        <input type="radio" id="house-usage-other-4" name="house-usage-4" value="none" onclick="changeRequired(['other-house-usage-4'],true)">其他
                        <input type="text" id="other-house-usage-4" name="other-house-usage-4">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">層高:<input type="number" name="layer-height-1" value="3.0" min="0" step="0.01" oninput="if(value.length>4)value=value.slice(0,5)" class="median-input-size">(m)</td>
                    <td colspan="2">層高:<input type="number" name="layer-height-2" value="3.0" min="0" step="0.01" oninput="if(value.length>4)value=value.slice(0,5)" class="median-input-size">(m)</td>
                    <td colspan="2">層高:<input type="number" name="layer-height-3" value="3.0" min="0" step="0.01" oninput="if(value.length>4)value=value.slice(0,5)" class="median-input-size">(m)</td>
                    <td colspan="2">層高:<input type="number" name="layer-height-4" value="3.0" min="0" step="0.01" oninput="if(value.length>4)value=value.slice(0,5)" class="median-input-size">(m)</td>
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
                                <option value="">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="minus-wall-option-1-1" name="minus-wall-option-1-1" class="select-menu" onchange="setDefaultOption('minus-wall-option','minus-wall-num','1-1')">
                                <option value="">請選擇材質</option>
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
                                <option value="">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="add-wall-option-1-1" name="add-wall-option-1-1" class="select-menu" onchange="setDefaultOption('add-wall-option','add-wall-num','1-1')">
                                <option value="">請選擇材質</option>
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
                                <option value="">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="minus-wall-option-2-1" name="minus-wall-option-2-1" class="select-menu" onchange="setDefaultOption('minus-wall-option','minus-wall-num','2-1')">
                                <option value="">請選擇材質</option>
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
                                <option value="">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="add-wall-option-2-1" name="add-wall-option-2-1" class="select-menu" onchange="setDefaultOption('add-wall-option','add-wall-num','2-1')">
                                <option value="">請選擇材質</option>
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
                                <option value="">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="minus-wall-option-3-1" name="minus-wall-option-3-1" class="select-menu" onchange="setDefaultOption('minus-wall-option','minus-wall-num','3-1')">
                                <option value="">請選擇材質</option>
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
                                <option value="">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="add-wall-option-3-1" name="add-wall-option-3-1" class="select-menu" onchange="setDefaultOption('add-wall-option','add-wall-num','3-1')">
                                <option value="">請選擇材質</option>
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
                                <option value="">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="minus-wall-option-4-1" name="minus-wall-option-4-1" class="select-menu" onchange="setDefaultOption('minus-wall-option','minus-wall-num','4-1')">
                                <option value="">請選擇材質</option>
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
                                <option value="">請選擇面數</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <select id="add-wall-option-4-1" name="add-wall-option-4-1" class="select-menu" onchange="setDefaultOption('add-wall-option','add-wall-num','4-1')">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="indoor-divide-numerator-1-1" name="indoor-divide-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-numerator-1-1')" value="1">/<input type="text" id="indoor-divide-denominator-1-1" name="indoor-divide-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-denominator-1-1')" value="1">
                            <select class="select-menu" id="indoor-divide-option-1-1" name="indoor-divide-option-1-1">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="indoor-divide-numerator-2-1" name="indoor-divide-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-numerator-2-1')" value="1">/<input type="text" id="indoor-divide-denominator-2-1" name="indoor-divide-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-denominator-2-1')" value="1">
                            <select class="select-menu" id="indoor-divide-option-2-1" name="indoor-divide-option-2-1">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="indoor-divide-numerator-3-1" name="indoor-divide-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-numerator-3-1')" value="1">/<input type="text" id="indoor-divide-denominator-3-1" name="indoor-divide-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-denominator-3-1')" value="1">
                            <select class="select-menu" id="indoor-divide-option-3-1" name="indoor-divide-option-3-1">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="indoor-divide-numerator-4-1" name="indoor-divide-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-numerator-4-1')" value="1">/<input type="text" id="indoor-divide-denominator-4-1" name="indoor-divide-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-divide-denominator-4-1')" value="1">
                            <select class="select-menu" id="indoor-divide-option-4-1" name="indoor-divide-option-4-1">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="outdoor-wall-decoration-numerator-1-1" name="outdoor-wall-decoration-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-numerator-1-1')" value="1">/<input type="text" id="outdoor-wall-decoration-denominator-1-1" name="outdoor-wall-decoration-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-denominator-1-1')" value="1">
                            <select id="outdoor-wall-decoration-option-1-1" name="outdoor-wall-decoration-option-1-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="outdoor-wall-decoration-numerator-2-1" name="outdoor-wall-decoration-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-numerator-2-1')" value="1">/<input type="text" id="outdoor-wall-decoration-denominator-2-1" name="outdoor-wall-decoration-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-denominator-2-1')" value="1">
                            <select id="outdoor-wall-decoration-option-2-1" name="outdoor-wall-decoration-option-2-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="outdoor-wall-decoration-numerator-3-1" name="outdoor-wall-decoration-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-numerator-3-1')" value="1">/<input type="text" id="outdoor-wall-decoration-denominator-3-1" name="outdoor-wall-decoration-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-denominator-3-1')" value="1">
                            <select id="outdoor-wall-decoration-option-3-1" name="outdoor-wall-decoration-option-3-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="outdoor-wall-decoration-numerator-4-1" name="outdoor-wall-decoration-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-numerator-4-1')" value="1">/<input type="text" id="outdoor-wall-decoration-denominator-4-1" name="outdoor-wall-decoration-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('outdoor-wall-decoration-denominator-4-1')" value="1">
                            <select id="outdoor-wall-decoration-option-4-1" name="outdoor-wall-decoration-option-4-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                        <div id="indoor-wall-decoration-1-1" style="padding-left:10px;">
                            <input type="text" id="indoor-wall-decoration-numerator-1-1" name="indoor-wall-decoration-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-numerator-1-1')" value="1">/<input type="text" id="indoor-wall-decoration-denominator-1-1" name="indoor-wall-decoration-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-denominator-1-1')" value="1">
                            <select id="indoor-wall-decoration-option-1-1" name="indoor-wall-decoration-option-1-1" class="tiny-select-menu" onchange="autoCompleteIndoorWallType(1,1)">
                                <option value="">請選擇材質</option>
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
                        <div id="indoor-wall-decoration-2-1" style="padding-left:10px;">
                            <input type="text" id="indoor-wall-decoration-numerator-2-1" name="indoor-wall-decoration-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-numerator-2-1')" value="1">/<input type="text" id="indoor-wall-decoration-denominator-2-1" name="indoor-wall-decoration-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-denominator-2-1')" value="1">
                            <select id="indoor-wall-decoration-option-2-1" name="indoor-wall-decoration-option-2-1" class="tiny-select-menu" onchange="autoCompleteIndoorWallType(2,1)">
                                <option value="">請選擇材質</option>
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
                        <div id="indoor-wall-decoration-3-1" style="padding-left:10px;">
                            <input type="text" id="indoor-wall-decoration-numerator-3-1" name="indoor-wall-decoration-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-numerator-3-1')" value="1">/<input type="text" id="indoor-wall-decoration-denominator-3-1" name="indoor-wall-decoration-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-denominator-3-1')" value="1">
                            <select id="indoor-wall-decoration-option-3-1" name="indoor-wall-decoration-option-3-1" class="tiny-select-menu" onchange="autoCompleteIndoorWallType(3,1)">
                                <option value="">請選擇材質</option>
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
                        <div id="indoor-wall-decoration-4-1" style="padding-left:10px;">
                            <input type="text" id="indoor-wall-decoration-numerator-4-1" name="indoor-wall-decoration-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-numerator-4-1')" value="1">/<input type="text" id="indoor-wall-decoration-denominator-4-1" name="indoor-wall-decoration-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('indoor-wall-decoration-denominator-4-1')" value="1">
                            <select id="indoor-wall-decoration-option-4-1" name="indoor-wall-decoration-option-4-1" class="tiny-select-menu" onchange="autoCompleteIndoorWallType(4,1)">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="roof-decoration-numerator-1-1" name="roof-decoration-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-numerator-1-1')" value="1">/<input type="text" id="roof-decoration-denominator-1-1" name="roof-decoration-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-denominator-1-1')" value="1">
                            <select id="roof-decoration-option-1-1" name="roof-decoration-option-1-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="roof-decoration-numerator-2-1" name="roof-decoration-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-numerator-2-1')" value="1">/<input type="text" id="roof-decoration-denominator-2-1" name="roof-decoration-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-denominator-2-1')" value="1">
                            <select id="roof-decoration-option-2-1" name="roof-decoration-option-2-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="roof-decoration-numerator-3-1" name="roof-decoration-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-numerator-3-1')" value="1">/<input type="text" id="roof-decoration-denominator-3-1" name="roof-decoration-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-denominator-3-1')" value="1">
                            <select id="roof-decoration-option-3-1" name="roof-decoration-option-3-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="roof-decoration-numerator-4-1" name="roof-decoration-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-numerator-4-1')" value="1">/<input type="text" id="roof-decoration-denominator-4-1" name="roof-decoration-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('roof-decoration-denominator-4-1')" value="1">
                            <select id="roof-decoration-option-4-1" name="roof-decoration-option-4-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="floor-decoration-numerator-1-1" name="floor-decoration-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-numerator-1-1')" value="1">/<input type="text" id="floor-decoration-denominator-1-1" name="floor-decoration-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-denominator-1-1')" value="1">
                            <select id="floor-decoration-option-1-1" name="floor-decoration-option-1-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="floor-decoration-numerator-2-1" name="floor-decoration-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-numerator-2-1')" value="1">/<input type="text" id="floor-decoration-denominator-2-1" name="floor-decoration-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-denominator-2-1')" value="1">
                            <select id="floor-decoration-option-2-1" name="floor-decoration-option-2-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="floor-decoration-numerator-3-1" name="floor-decoration-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-numerator-3-1')" value="1">/<input type="text" id="floor-decoration-denominator-3-1" name="floor-decoration-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-denominator-3-1')" value="1">
                            <select id="floor-decoration-option-3-1" name="floor-decoration-option-3-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="floor-decoration-numerator-4-1" name="floor-decoration-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-numerator-4-1')" value="1">/<input type="text" id="floor-decoration-denominator-4-1" name="floor-decoration-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('floor-decoration-denominator-4-1')" value="1">
                            <select id="floor-decoration-option-4-1" name="floor-decoration-option-4-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="ceiling-decoration-numerator-1-1" name="ceiling-decoration-numerator-1-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-numerator-1-1')" value="1">/<input type="text" id="ceiling-decoration-denominator-1-1" name="ceiling-decoration-denominator-1-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-denominator-1-1')" value="1">
                            <select id="ceiling-decoration-option-1-1" name="ceiling-decoration-option-1-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="ceiling-decoration-numerator-2-1" name="ceiling-decoration-numerator-2-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-numerator-2-1')" value="1">/<input type="text" id="ceiling-decoration-denominator-2-1" name="ceiling-decoration-denominator-2-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-denominator-2-1')" value="1">
                            <select id="ceiling-decoration-option-2-1" name="ceiling-decoration-option-2-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="ceiling-decoration-numerator-3-1" name="ceiling-decoration-numerator-3-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-numerator-3-1')" value="1">/<input type="text" id="ceiling-decoration-denominator-3-1" name="ceiling-decoration-denominator-3-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-denominator-3-1')" value="1">
                            <select id="ceiling-decoration-option-3-1" name="ceiling-decoration-option-3-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <input type="text" id="ceiling-decoration-numerator-4-1" name="ceiling-decoration-numerator-4-1" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-numerator-4-1')" value="1">/<input type="text" id="ceiling-decoration-denominator-4-1" name="ceiling-decoration-denominator-4-1" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput('ceiling-decoration-denominator-4-1')" value="1">
                            <select id="ceiling-decoration-option-4-1" name="ceiling-decoration-option-4-1" class="select-menu">
                                <option value="">請選擇材質</option>
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
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第一層窗</label>
                        <!-- <input type="text" name="first-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-window-1" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>
                    <td>
                        <label for="">第二層門</label>
                        <!-- <input type="text" name="second-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-door-1" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第二層窗</label>
                        <!-- <input type="text" name="second-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-window-1" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>

                    <td>
                        <label for="">第一層門</label>
                        <!-- <input type="text" name="first-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-door-2" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第一層窗</label>
                        <!-- <input type="text" name="first-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-window-2" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>
                    <td>
                        <label for="">第二層門</label>
                        <!-- <input type="text" name="second-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-door-2" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第二層窗</label>
                        <!-- <input type="text" name="second-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-window-2" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>

                    <td>
                        <label for="">第一層門</label>
                        <!-- <input type="text" name="first-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-door-3" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第一層窗</label>
                        <!-- <input type="text" name="first-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-window-3" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>
                    <td>
                        <label for="">第二層門</label>
                        <!-- <input type="text" name="second-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-door-3" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第二層窗</label>
                        <!-- <input type="text" name="second-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-window-3" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>

                    <td>
                        <label for="">第一層門</label>
                        <!-- <input type="text" name="first-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-door-4" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第一層窗</label>
                        <!-- <input type="text" name="first-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="first-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="first-window-4" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                    </td>
                    <td>
                        <label for="">第二層門</label>
                        <!-- <input type="text" name="second-door-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-door-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-door-4" class="median-select-menu">
                            <option value="">請選擇材質</option>
                            <?php echo $_smarty_tpl->tpl_vars['door_window_option']->value;?>

                        </select>
                        <br>
                        <label for="">第二層窗</label>
                        <!-- <input type="text" name="second-window-numerator-1" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" name="second-window-denominator-1" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)"> -->
                        <select name="second-window-4" class="median-select-menu">
                            <option value="">請選擇材質</option>
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
                                <option value="">請選擇比例</option>
                                <option value="1">1</option>
                                <option value="0.5">1/2</option>
                            </select><br>
                            型式:<select id="toilet-type-1-1" name="toilet-type-1-1" class="tiny-select-menu" onchange="load_toilet_data(1,1)">
                                <option value="">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['toilet_equipment_option']->value;?>

                            </select>

                            <select id="toilet-product-1-1" name="toilet-product-1-1">
                                <option value="" style="display:none";>請選擇種類</option>
                            </select>
                            <br>
                            <!-- 座數:<input type="radio" name="toilet-number-1-1" value="3">1~3座<input type="radio" name="toilet-number-1-1" value="6">4~6座<input type="radio" name="toilet-number-1-1" value="7">7座以上 -->
                            座數:<select id="toilet-number-1-1" name="toilet-number-1-1" class="tiny-select-menu">
                                <option value="">請選擇座數</option>
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
                                <option value="">請選擇比例</option>
                                <option value="1">1</option>
                                <option value="0.5">1/2</option>
                            </select><br>
                            型式:<select id="toilet-type-2-1" name="toilet-type-2-1" class="tiny-select-menu" onchange="load_toilet_data(2,1)">
                                <option value="">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['toilet_equipment_option']->value;?>

                            </select>

                            <select id="toilet-product-2-1" name="toilet-product-2-1">
                                <option value="" style="display:none;">請選擇種類</option>
                            </select>
                            <br>
                            <!-- 座數:<input type="radio" name="toilet-number-2-1" value="3">1~3座<input type="radio" name="toilet-number-2-1" value="6">4~6座<input type="radio" name="toilet-number-2-1" value="7">7座以上 -->
                            座數:<select id="toilet-number-2-1" name="toilet-number-2-1" class="tiny-select-menu">
                                <option value="">請選擇座數</option>
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
                                <option value="">請選擇比例</option>
                                <option value="1">1</option>
                                <option value="0.5">1/2</option>
                            </select><br>
                            型式:<select id="toilet-type-3-1" name="toilet-type-3-1" class="tiny-select-menu" onchange="load_toilet_data(3,1)">
                                <option value="">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['toilet_equipment_option']->value;?>

                            </select>

                            <select id="toilet-product-3-1" name="toilet-product-3-1">
                                <option value="" style="display:none;">請選擇種類</option>
                            </select>
                            <br>
                            <!-- 座數:<input type="radio" name="toilet-number-3-1" value="3">1~3座<input type="radio" name="toilet-number-3-1" value="6">4~6座<input type="radio" name="toilet-number-3-1" value="7">7座以上 -->
                            座數:<select id="toilet-number-3-1" name="toilet-number-3-1" class="tiny-select-menu">
                                <option value="">請選擇座數</option>
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
                                <option value="">請選擇比例</option>
                                <option value="1">1</option>
                                <option value="0.5">1/2</option>
                            </select><br>
                            型式:<select id="toilet-type-4-1" name="toilet-type-4-1" class="tiny-select-menu" onchange="load_toilet_data(4,1)">
                                <option value="">請選擇材質</option>
                                <?php echo $_smarty_tpl->tpl_vars['toilet_equipment_option']->value;?>

                            </select>

                            <select id="toilet-product-4-1" name="toilet-product-4-1">
                                <option value="" style="display:none;">請選擇種類</option>
                            </select>
                            <br>
                            <!-- 座數:<input type="radio" name="toilet-number-4-1" value="3">1~3座<input type="radio" name="toilet-number-4-1" value="6">4~6座<input type="radio" name="toilet-number-4-1" value="7">7座以上 -->
                            座數:<select id="toilet-number-4-1" name="toilet-number-4-1" class="tiny-select-menu">
                                <option value="">請選擇座數</option>
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
                            <option value="">請選擇用途</option>
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
                            <option value="">請選擇用途</option>
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
                            <option value="">請選擇用途</option>
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
                            <option value="">請選擇用途</option>
                            <?php echo $_smarty_tpl->tpl_vars['electric_usage_option']->value;?>

                        </select>

                        <select class="select-menu" id="electric-type-4" name="electric-type-4">
                            <option value="" style="display:none;">請選擇種類</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>窗或陽台設鐵柵<br>(鐵窗)</td>
                    <td colspan="2"><input type="checkbox" id="normal-window-level-1" name="window-level-1" value="普通型" onclick="setWindowLevel('normal-window-level',1)">普通型<input type="checkbox" id="art-window-level-1" name="window-level-1" value="美術型" onclick="setWindowLevel('art-window-level',1)">美術型<input type="checkbox" id="luxury-window-level-1" name="window-level-1" value="豪華型" onclick="setWindowLevel('luxury-window-level',1)">豪華型</td>
                    <td colspan="2"><input type="checkbox" id="normal-window-level-2" name="window-level-2" value="普通型" onclick="setWindowLevel('normal-window-level',2)">普通型<input type="checkbox" id="art-window-level-2" name="window-level-2" value="美術型" onclick="setWindowLevel('art-window-level',2)">美術型<input type="checkbox" id="luxury-window-level-2" name="window-level-2" value="豪華型" onclick="setWindowLevel('luxury-window-level',2)">豪華型</td>
                    <td colspan="2"><input type="checkbox" id="normal-window-level-3" name="window-level-3" value="普通型" onclick="setWindowLevel('normal-window-level',3)">普通型<input type="checkbox" id="art-window-level-3" name="window-level-3" value="美術型" onclick="setWindowLevel('art-window-level',3)">美術型<input type="checkbox" id="luxury-window-level-3" name="window-level-3" value="豪華型" onclick="setWindowLevel('luxury-window-level',3)">豪華型</td>
                    <td colspan="2"><input type="checkbox" id="normal-window-level-4" name="window-level-4" value="普通型" onclick="setWindowLevel('normal-window-level',4)">普通型<input type="checkbox" id="art-window-level-4" name="window-level-4" value="美術型" onclick="setWindowLevel('art-window-level',4)">美術型<input type="checkbox" id="luxury-window-level-4" name="window-level-4" value="豪華型" onclick="setWindowLevel('luxury-window-level',4)">豪華型</td>
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
                    <td colspan="2"><input type="checkbox" id="front-balcony-1" name="balcony-1[]" value="前">前<input type="checkbox" id="behind-balcony-1" name="balcony-1[]" value="後">後<input type="checkbox" id="left-balcony-1" name="balcony-1[]" value="左">左<input type="checkbox" id="right-balcony-1" name="balcony-1[]" value="右">右</td>
                    <td colspan="2"><input type="checkbox" id="front-balcony-2" name="balcony-2[]" value="前">前<input type="checkbox" id="behind-balcony-2" name="balcony-2[]" value="後">後<input type="checkbox" id="left-balcony-2" name="balcony-2[]" value="左">左<input type="checkbox" id="right-balcony-2" name="balcony-2[]" value="右">右</td>
                    <td colspan="2"><input type="checkbox" id="front-balcony-3" name="balcony-3[]" value="前">前<input type="checkbox" id="behind-balcony-3" name="balcony-3[]" value="後">後<input type="checkbox" id="left-balcony-3" name="balcony-3[]" value="左">左<input type="checkbox" id="right-balcony-3" name="balcony-3[]" value="右">右</td>
                    <td colspan="2"><input type="checkbox" id="front-balcony-4" name="balcony-4[]" value="前">前<input type="checkbox" id="behind-balcony-4" name="balcony-4[]" value="後">後<input type="checkbox" id="left-balcony-4" name="balcony-4[]" value="左">左<input type="checkbox" id="right-balcony-4" name="balcony-4[]" value="右">右</td>
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
            <input type="hidden" id="floor-count" name="floor-count" value="">
            <input type="hidden" id="page" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">
            <!-- <input type="submit" value="儲存" onclick="saveDialog()"> -->
            <!-- <input type="submit" value="繼續輸入下一頁" onclick="continueInput()"> -->
            <input type="submit" id="submitBtn" value="儲存" onclick="buildingContinue(false)">
            <input type="submit" id="continueBtn" value="繼續輸入下一頁" onclick="buildingContinue(true)">
        </form>
    </div>

    <div class="loading hide">
        <div class="gif" style="width:500px;height:200px;"></div>
    </div>
</body>
</html>
<?php }
}
