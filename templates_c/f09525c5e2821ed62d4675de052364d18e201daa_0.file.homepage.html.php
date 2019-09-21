<?php
/* Smarty version 3.1.33, created on 2019-09-21 10:23:24
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\homepage.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d85fa1cf29e53_27161111',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f09525c5e2821ed62d4675de052364d18e201daa' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\homepage.html',
      1 => 1569061402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d85fa1cf29e53_27161111 (Smarty_Internal_Template $_smarty_tpl) {
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
    <!-- <?php echo '<script'; ?>
 type="text/javascript" src="js/homepage.js"><?php echo '</script'; ?>
> -->

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

<body>

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
                    <li id="transBtn"><a href="#">建物紀錄查詢</a></li>
                    <li id="corpBtn"><a href="#">農作物紀錄查詢</a></li>
                    <li id="walletBtn"><a href="index.php" target="_blank">新增建物查案</a></li>
                    <li id="investBtn"><a href="corp.php" target="_blank">新增農作物、水產、禽畜查案</a></li>
                    <li id=""><a href="#">新增機械搬遷查案</a></li>
                </ul><br>

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Blog..">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-sm-9">
                <!-- <h2>編輯個人資料</h2>
                <form action="/action_page.php">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="輸入 Email" name="email" value="">
                    </div>
                    <div class="form-group">
                        <label for="name">用戶名稱:</label>
                        <input type="text" class="form-control" id="name" placeholder="輸入用戶名稱" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label for="pwd">密碼:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="輸入密碼" name="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd_verify">密碼確認:</label>
                        <input type="password" class="form-control" id="pwd_verify" placeholder="再次輸入密碼" name="pwd_verify">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="remember"> Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-default">送出修改</button>
                </form> -->

                <h2>建物歷史紀錄</h2>
                <p>以下為您過去所建立的查估清單</p>
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
                            <button class='btn btn-default' style="margin-top:5px";><a href='getFile.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
&file=2'>下載持分表</a></button>
                        </td>
                        <td><button class='btn btn-default' onclick=deleteAlert('<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
','<?php echo $_smarty_tpl->tpl_vars['row']->value['address'];?>
')>刪除</button></td>
                    </tr>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tbody>

                </table>

                <div class='align_center'>
                    <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['menu_count']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['menu_count']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                        <ul class='pagination'>
                            <?php if ($_smarty_tpl->tpl_vars['i']->value == $_smarty_tpl->tpl_vars['current_page']->value) {?>
                                <?php if ($_smarty_tpl->tpl_vars['i']->value > 1) {?>
                                    <li><a href='homepage.php?page=<?php echo ($_smarty_tpl->tpl_vars['i']->value-2)*20+1;?>
'><<</a></li>
                                <?php }?>

                                <?php
$_smarty_tpl->tpl_vars['j'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int) ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? $_smarty_tpl->tpl_vars['i']->value*20+1 - (($_smarty_tpl->tpl_vars['i']->value-1)*20+1) : ($_smarty_tpl->tpl_vars['i']->value-1)*20+1-($_smarty_tpl->tpl_vars['i']->value*20)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0) {
for ($_smarty_tpl->tpl_vars['j']->value = ($_smarty_tpl->tpl_vars['i']->value-1)*20+1, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++) {
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration === 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration === $_smarty_tpl->tpl_vars['j']->total;?>

                                    <?php if ($_smarty_tpl->tpl_vars['j']->value <= $_smarty_tpl->tpl_vars['page_count']->value) {?>
                                        <li><a href='homepage.php?page=<?php echo $_smarty_tpl->tpl_vars['j']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['j']->value;?>
</a></li>
                                    <?php }?>
                                <?php }
}
?>

                                <?php if ($_smarty_tpl->tpl_vars['j']->value < $_smarty_tpl->tpl_vars['page_count']->value) {?>
                                    <li><a href='homepage.php?page=<?php echo $_smarty_tpl->tpl_vars['i']->value*20+1;?>
'>>></a></li>
                                <?php }?>
                            <?php }?>
                        </ul>
                    <?php }
}
?>
                </div>
            </div>

        </div>
    </div>

    <footer class="container-fluid align_center">
        <p>Online-Estate-Evaluate-System Copyright by Wei-Cheng Shih 2019</p>
    </footer>

</body>

<?php echo '<script'; ?>
>
    var account_info =
        "<h2>編輯個人資料</h2>"+
        "<form action='/action_page.php'>"+
            "<div class='form-group'>"+
                "<label for='email'>Email:</label>"+
                "<input type='email' class='form-control' id='email' placeholder='輸入 Email' name='email' value=''>"+
            "</div>"+
            "<div class='form-group'>"+
                "<label for='name'>用戶名稱:</label>"+
                "<input type='text' class='form-control' id='name' placeholder='輸入用戶名稱' name='name' value=''>"+
            "</div>"+
            "<div class='form-group'>"+
                "<label for='pwd'>密碼:</label>"+
                "<input type='password' class='form-control' id='pwd' placeholder='輸入密碼' name='pwd'>"+
            "</div>"+
            "<div class='form-group'>"+
                "<label for='pwd_verify'>密碼確認:</label>"+
                "<input type='password' class='form-control' id='pwd_verify' placeholder='再次輸入密碼' name='pwd_verify'>"+
            "</div>"+
            "<div class='checkbox'>"+
                "<label><input type='checkbox' name='remember'> Remember me</label>"+
            "</div>"+
            "<button type='submit' class='btn btn-default'>送出修改</button>"+
        "</form>";
    var trans_record =
        "<h2>建物歷史紀錄</h2>" +
        "<p>以下為您過去所建立的查估清單</p>" +
        "<table class='table table-striped'>" +

        "<thead>" +
        "<tr>" +
        "<th>調查表編號</th>" +
        "<th>地段地號</th>" +
        "<th>地址</th>" +
        "<th>編輯</th>" +
        "<th>最後編輯時間</th>" +
        "<th>下載報表</th>" +
        "<th>刪除</th>" +
        "</tr>" +
        "</thead>" +

        "<tbody>" +
        "<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['record']->value, 'row', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>"+
        "<tr>" +
        "<td><?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
</td>" +
        "<td><?php echo $_smarty_tpl->tpl_vars['row']->value['land_id'];?>
</td>" +
        "<td><?php echo $_smarty_tpl->tpl_vars['row']->value['real_address'];?>
</td>" +
        // "<td><button class='btn btn-default'>查看</button>&nbsp;<button class='btn btn-default'>編輯</button></td>" +
        "<td><button class='btn btn-default'><a href='update_building.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
' target='_blank'>編輯</a></button></td>" +
        "<td><?php echo $_smarty_tpl->tpl_vars['row']->value['keyin_datetime'];?>
</td>" +
        "<td>" +
            "<button class='btn btn-default'><a href='getFile.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
&file=1'>下載調查表</a></button><br>" +
            "<button class='btn btn-default' style='margin-top:5px';><a href='getFile.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
&file=2'>下載持分表</a></button>" +
        "</td>" +
        "<td><button class='btn btn-default' onclick=deleteAlert('<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
','<?php echo $_smarty_tpl->tpl_vars['row']->value['address'];?>
')>刪除</button></td>" +
        "</tr>" +
        "<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>" +
        "</tbody>" +

        "</table>" +

        "<div class='align_center'>" +
        "<?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['menu_count']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['menu_count']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>" +
            "<ul class='pagination'>" +
                "<?php if ($_smarty_tpl->tpl_vars['i']->value == $_smarty_tpl->tpl_vars['current_page']->value) {?>" +
                    "<?php if ($_smarty_tpl->tpl_vars['i']->value > 1) {?>" +
                        "<li><a href='homepage.php?page=<?php echo ($_smarty_tpl->tpl_vars['i']->value-2)*20+1;?>
'><<</a></li>" +
                    "<?php }?>" +

                    "<?php
$_smarty_tpl->tpl_vars['j'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int) ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? $_smarty_tpl->tpl_vars['i']->value*20+1 - (($_smarty_tpl->tpl_vars['i']->value-1)*20+1) : ($_smarty_tpl->tpl_vars['i']->value-1)*20+1-($_smarty_tpl->tpl_vars['i']->value*20)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0) {
for ($_smarty_tpl->tpl_vars['j']->value = ($_smarty_tpl->tpl_vars['i']->value-1)*20+1, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++) {
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration === 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration === $_smarty_tpl->tpl_vars['j']->total;?>" +

                        "<?php if ($_smarty_tpl->tpl_vars['j']->value <= $_smarty_tpl->tpl_vars['page_count']->value) {?>" +
                            "<li><a href='homepage.php?page=<?php echo $_smarty_tpl->tpl_vars['j']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['j']->value;?>
</a></li>" +
                        "<?php }?>" +
                    "<?php }
}
?>" +

                    "<?php if ($_smarty_tpl->tpl_vars['j']->value < $_smarty_tpl->tpl_vars['page_count']->value) {?>" +
                        "<li><a href='homepage.php?page=<?php echo $_smarty_tpl->tpl_vars['i']->value*20+1;?>
'>>></a></li>" +
                    "<?php }?>" +
                "<?php }?>" +
            "</ul>" +
        "<?php }
}
?>" +
        "</div>";

    var corp_record =
        "<h2>農作物歷史紀錄</h2>"+
        "<p>以下為您過去所建立的查估清單</p>" +
        "<table class='table table-striped'>" +

        "<thead>" +
        "<tr>" +
        "<th>調查表編號</th>" +
        "<th>地段地號</th>" +
        "<th>編輯</th>" +
        "<th>最後編輯時間</th>" +
        "<th>下載報表</th>" +
        "<th>刪除</th>" +
        "</tr>" +
        "</thead>" +

        "<tbody>" +
        "<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['corp_record']->value, 'row', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>"+
        "<tr>" +
        "<td><?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
</td>" +
        "<td><?php echo $_smarty_tpl->tpl_vars['row']->value['land_id'];?>
</td>" +
        "<td><button class='btn btn-default'><a href='update_corp.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
' target='_blank'>編輯</a></button></td>" +
        // "<td></td>"+
        "<td><?php echo $_smarty_tpl->tpl_vars['row']->value['keyin_datetime'];?>
</td>" +
        "<td>" +
        "<button class='btn btn-default'><a href='getFile.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
&file=1'>下載調查表</a></button><br>" +
        "<button class='btn btn-default' style='margin-top:5px';><a href='getFile.php?recordNo=<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
&file=2'>下載持分表</a></button>" +
        "</td>" +
        "<td>" +
        "<button class='btn btn-default' onclick=deleteCorp('<?php echo $_smarty_tpl->tpl_vars['row']->value['rId'];?>
')>刪除</button>" +
        "</td>" +
        "</tr>" +
        "<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>" +
        "</tbody>" +

        "</table>" +

        "<div class='align_center'>" +
        "<ul class='pagination'>" +
        "<li><a href='#'>1</a></li>" +
        "<li><a href='#'>2</a></li>" +
        "<li><a href='#'>3</a></li>" +
        "<li><a href='#'>4</a></li>" +
        "<li><a href='#'>5</a></li>" +
        "</ul>" +
        "</div>";

    $(document).ready(function() {

        $("#accountBtn").css("background-color","skyblue");
        $("#accountBtn").css("border-radius","4px");
        $("#accountBtn").click(function() {
            $(".col-sm-9 >").remove();
            $(".col-sm-9").append(account_info);
        });

        $("#transBtn").click(function() {
            $("#accountBtn").css("background-color","");
            $(".col-sm-9 >").remove();
            $(".col-sm-9").append(trans_record);
        });

        $("#corpBtn").click(function() {
            $("#accountBtn").css("background-color","");
            $(".col-sm-9 >").remove();
            $(".col-sm-9").append(corp_record);
        });

        $("#walletBtn").click(function() {
            // $("#accountBtn").css("background-color","");
            // $(".col-sm-9 >").remove();
            // $(".col-sm-9").append(wallet);
        });

        $("#investBtn").click(function() {
            // $("#accountBtn").css("background-color","");
            // $(".col-sm-9 >").remove();
            // $(".col-sm-9").append(invest);
        });
    });

    function deleteAlert(rId,address){
        if(confirm("確定刪除此筆資料?")){
            // window.alert(rId+" : "+address);
            // window.alert(rId+" "+address);
            $.ajax({
                 url: "deleteRecord.php",
                 type: "GET",
                 data:{
                    recordNo: rId,
                    address: address
                 },
                 cache:false,
                 dataType: "json",
                 // contentType: 'application/json; charset=utf-8',
                 success: function(data){
                     window.alert(data.status);
                     location.reload();
                 },
                 error:function(err){
                     window.alert(err.statusText);
                     location.reload();
                 }
            });
        }
    }

    function deleteCorp(rId){
        if(confirm("確定刪除此筆資料?")){
            $.ajax({
                 url: "deleteCorpRecord.php",
                 type: "GET",
                 data:{
                    recordNo: rId
                 },
                 cache:false,
                 dataType: "json",
                 // contentType: 'application/json; charset=utf-8',
                 success: function(data){
                     window.alert(data.status);
                     location.reload();
                 },
                 error:function(err){
                     window.alert(err.statusText);
                     location.reload();
                 }
            });
        }
    }

<?php echo '</script'; ?>
>

</html>
<?php }
}
