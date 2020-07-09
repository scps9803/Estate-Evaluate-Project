<?php
/* Smarty version 3.1.33, created on 2019-11-07 08:11:01
  from 'C:\xampp\htdocs\Estate-Evaluate-Project\templates\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5dc3c385a2c7d5_79763768',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45d829a61d1d513d02ae9958238df4c8c8431a24' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Estate-Evaluate-Project\\templates\\login.html',
      1 => 1573110605,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5dc3c385a2c7d5_79763768 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/homepage.css">
	<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
	<title>登入</title>

	<style>
		@media (min-width:500px) {
			.form{
				width: 500px;
				margin: 0 auto;
			}
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
					<!-- <li><a href="login.html"><span class="glyphicon glyphicon-user"></span>登入/註冊</a></li> -->
					<!-- <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span>購物車</a></li> -->
				</ul>
			</div>
		</div>
	</nav>

	<div class="container form">
		<h2>會員登入</h2>
		<form action="login_process.php" method="post">
			<div class="form-group">
				<label for="email">帳號:</label>
				<input type="text" class="form-control" id="pId" placeholder="請輸入身分證字號" name="pId" required>
			</div>
			<div class="form-group">
				<label for="pwd">密碼:</label>
				<input type="password" class="form-control" id="pwd" placeholder="請輸入密碼" name="pwd" required>
			</div>
			<div class="checkbox">
				<label><input type="checkbox" name="remember">保持登入狀態</label>
			</div>

			<div class="align_center">
				<button type="submit" class="btn btn-default">登入</button>
				<button type="button" class="btn btn-default" id="sign_up_btn">註冊</button>
			</div>
		</form>
	</div>
</body>
<?php echo '<script'; ?>
>
	var sign_up =
		"<h2>會員註冊</h2>" +
		"<form action='sign_up.php' method='post'>" +
		"<div class='form-group'>" +
		"<label for='email'>Email:</label>" +
		"<input type='email' class='form-control' id='email' placeholder='請輸入email' name='email' required>" +
		"</div>" +

		"<div class='form-group'>" +
		"<label for='userName'>姓名:</label>" +
		"<input type='text' class='form-control' id='userName' placeholder='請輸入姓名' name='userName' required>" +
		"</div>" +

		"<div class='form-group'>" +
		"<label for='pwd'>密碼:</label>" +
		"<input type='password' class='form-control' id='pwd' placeholder='請輸入密碼' name='pwd' required>" +
		"</div>" +

		"<div class='checkbox'>" +
		"<label><input type='checkbox' name='remember'>保持登入狀態</label>" +
		"</div>" +
		"<button type='submit' class='btn btn-default' id='sign_up_btn'>註冊</button>" +
		"</form>"

		$(document).ready(function() {
			$("#sign_up_btn").click(function() {
				$(".container >").remove();
				$(".container").append(sign_up);
			});
		});

<?php echo '</script'; ?>
>

</html>
<?php }
}
