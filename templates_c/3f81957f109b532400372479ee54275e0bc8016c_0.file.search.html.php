<?php
/* Smarty version 3.1.33, created on 2019-10-17 08:32:00
  from 'C:\xampp\htdocs\Estate-Evaluate-Project\templates\search.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5da80ae03a4ef2_15706416',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f81957f109b532400372479ee54275e0bc8016c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Estate-Evaluate-Project\\templates\\search.html',
      1 => 1571293919,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5da80ae03a4ef2_15706416 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>線上查估系統</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/homepage.css">
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/homepage.js"><?php echo '</script'; ?>
>

    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */

        .row.content {
            height: 1500px
        }
        /* Set gray background color and 100% height */

        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }
        /* Set black background color, white text and some padding */

        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }
        /* On small screens, set height to 'auto' for sidenav and grid */

        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {
                height: auto;
            }
        }

        #return_trend{
            text-align: center;
            vertical-align: middle;
        }
        @media screen and (max-width: 600px) {
            .return_plot {
                width: 100%;
            }
        }

        .invest_info > h4{
            margin-top: 30px;
        }
    </style>
</head>

<body onload="setPageIndex('<?php echo $_smarty_tpl->tpl_vars['pageIndex']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['page_count']->value;?>
')">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Logo</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="login.php">首頁</a></li>
                    <li><a href="#">關於本站</a></li>
                    <li><a href="#">問題反映</a></li>
                    <li><a href="#">聯繫我們</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- <?php echo $_smarty_tpl->tpl_vars['welcome']->value;?>
 -->
                    <!-- <li><a href="cart.php?add_to_cart=no"><span class="glyphicon glyphicon-shopping-cart"></span>購物車</a></li> -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav">
                <h4>功能選單</h4>

                <ul class="nav nav-pills nav-stacked">
                    <!-- <li id="accountBtn"><a href="#">個人資料</a></li> -->
                    <li id="transBtn"><a href="homepage.php">建物紀錄查詢</a></li>
                    <li id="corpBtn"><a href="corppage.php">農作物紀錄查詢</a></li>
                    <li id="walletBtn"><a href="index.php" target="_blank">新增建物查案</a></li>
                    <li id="investBtn"><a href="corp.php" target="_blank">新增農作物、水產、禽畜查案</a></li>
                    <!-- <li id=""><a href="#">新增機械搬遷查案</a></li> -->
                </ul><br>

                <div class="input-group">
                    <input type="text" class="form-control" id="searchText" placeholder="搜尋調查表...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="searchRecord()">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-sm-9">
                <h2>搜尋結果</h2>
                <!-- <p>以下為您過去所建立的查估清單</p> -->
                <table class='table table-striped'>

                <thead>
                    <tr>
                        <th>調查表編號</th>
                        <th>地段地號</th>
                        <th>地址</th>
                        <th>編輯</th>
                        <th>最後編輯時間</th>
                        <th>下載報表</th>
                        <th>刪除</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($_smarty_tpl->tpl_vars['isFind']->value == "build") {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['record']->value, 'row', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['land_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['real_address'];?>
</td>
                            <!-- <td><button class='btn btn-default'>查看</button>&nbsp;<button class='btn btn-default'><a href="update_building.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
" target="_blank">編輯</a></button></td> -->
                            <td><button class='btn btn-default'><a href="update_building.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
" target="_blank">編輯</a></button></td>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['keyin_datetime'];?>
</td>
                            <td>
                                <button class='btn btn-default'><a href='getFile.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
&file=1'>下載調查表</a></button><br>
                                <!-- <button class='btn btn-default' style="margin-top:5px";><a href='getFile.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
&file=2'>下載持分表</a></button> -->
                            </td>
                            <td><button class='btn btn-default' onclick="deleteAlert('<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
','<?php echo $_smarty_tpl->tpl_vars['row']->value['address'];?>
')">刪除</button></td>
                        </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['isFind']->value == "corp") {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['corp_record']->value, 'row', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['land_id'];?>
</td>
                                <td></td>
                                <td><button class='btn btn-default'><a href='update_corp.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
' target='_blank'>編輯</a></button></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['keyin_datetime'];?>
</td>
                                <td>
                                    <button class='btn btn-default'><a href='getFile.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
&file=1'>下載調查表</a></button><br>
                                    <!-- <button class='btn btn-default' style='margin-top:5px';><a href='getFile.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
&file=2'>下載持分表</a></button> -->
                                </td>
                                <td>
                                    <button class='btn btn-default' onclick="deleteCorp('<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
')">刪除</button>
                                </td>
                            </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['isFind']->value == "NA") {?>
                        <h2>查無對應搜尋結果!</h2>
                    <?php }?>
                </tbody>

                </table>

        </div>
    </div>

    <footer class="container-fluid align_center">
        <p>Online-Estate-Evaluate-System Copyright by Wei-Cheng Shih 2019</p>
    </footer>

</body>

</html>
<?php }
}
