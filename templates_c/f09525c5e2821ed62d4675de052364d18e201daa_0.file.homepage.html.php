<?php
/* Smarty version 3.1.33, created on 2019-07-14 08:32:05
  from 'C:\wamp64\www\Estate-Evaluate-Project\templates\homepage.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d2ae885cd51f3_51409184',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f09525c5e2821ed62d4675de052364d18e201daa' => 
    array (
      0 => 'C:\\wamp64\\www\\Estate-Evaluate-Project\\templates\\homepage.html',
      1 => 1563093106,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d2ae885cd51f3_51409184 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <li class="active"><a href="index.php">首頁</a></li>
                    <li><a href="#">關於本站</a></li>
                    <li><a href="#">Deals</a></li>
                    <li><a href="store.php?category=0">線上商店</a></li>
                    <li><a href="#">聯繫我們</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- <?php echo $_smarty_tpl->tpl_vars['welcome']->value;?>
 -->
                    <li><a href="cart.php?add_to_cart=no"><span class="glyphicon glyphicon-shopping-cart"></span>購物車</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav">
                <h4>我的帳戶</h4>

                <ul class="nav nav-pills nav-stacked">
                    <li id="accountBtn"><a href="#">個人資料</a></li>
                    <li id="transBtn"><a href="#">紀錄查詢</a></li>
                    <li id="walletBtn"><a href="index.php">新增查案</a></li>
                    <li id="investBtn"><a href="#">XX</a></li>
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
                <h2>編輯個人資料</h2>
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
                </form>
            </div>

        </div>
    </div>

    <footer class="container-fluid align_center">
        <p>Game-Online-Store Copyright by Wei-Cheng Shih 2018</p>
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
        "<h2>歷史紀錄</h2>" +
        "<p>以下為您過去所建立的查估清單</p>" +
        "<table class='table table-striped'>" +

        "<thead>" +
        "<tr>" +
        "<th>調查表編號</th>" +
        "<th>地段地號</th>" +
        "<th>地址</th>" +
        "<th>查看/編輯</th>" +
        "<th>建立時間</th>" +
        "<th>下載報表</th>" +
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
        "<td><?php echo $_smarty_tpl->tpl_vars['row']->value['address'];?>
</td>" +
        "<td><button class='btn btn-default'>查看</button>&nbsp;<button class='btn btn-default'>編輯</button></td>" +
        "<td><?php echo $_smarty_tpl->tpl_vars['row']->value['keyin_datetime'];?>
</td>" +
        "<td><button class='btn btn-default'>一鍵下載</button></td>" +
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

        $("#walletBtn").click(function() {
            $("#accountBtn").css("background-color","");
            $(".col-sm-9 >").remove();
            $(".col-sm-9").append(wallet);
        });

        $("#investBtn").click(function() {
            $("#accountBtn").css("background-color","");
            $(".col-sm-9 >").remove();
            $(".col-sm-9").append(invest);
        });
    });

<?php echo '</script'; ?>
>

</html>
<?php }
}