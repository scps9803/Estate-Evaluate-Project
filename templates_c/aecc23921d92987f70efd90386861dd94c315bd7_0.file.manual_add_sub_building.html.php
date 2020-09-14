<?php
/* Smarty version 3.1.33, created on 2020-09-13 20:44:56
  from 'C:\xampp\htdocs\Estate-Evaluate-Project\templates\manual_add_sub_building.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f5e68a8a77091_44205549',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aecc23921d92987f70efd90386861dd94c315bd7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Estate-Evaluate-Project\\templates\\manual_add_sub_building.html',
      1 => 1600022677,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f5e68a8a77091_44205549 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <title>手動新增雜項物</title>
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
            .form{
                padding: 5px;
            }
            .required{
                color: red;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container" align="center">
            <h2>手動新增雜項物</h2>
            <h4 style="color: red; font-weight: bold;">(平方請輸入m^2 ; 立方請輸入m^3)</h3>
            <form action="">
                <table>
                    <thead>
                        <th class="form">分類 <span class="required">(*)</span></th>
                        <th class="form">品項名稱 <span class="required">(*)</th>
                        <th class="form">單價 <span class="required">(*)</th>
                        <th class="form">單位 <span class="required">(*)</th>
                        <th class="form">可否自拆 <span class="required">(*)</th>
                        <th class="form">備註</th>
                    </thead>
                    <tbody>
                        <td class="form"><input type="text" id="application" name="application" placeholder="ex.屋外門、畜產" required></td>
                        <td class="form"><input type="text" id="item_name" name="item_name" required></td>
                        <td class="form"><input type="number" id="unitprice" name="unitprice" required></td>
                        <td class="form"><input type="text" id="unit" name="unit" placeholder="平方=m^2 ; 立方=m^3" required></td>
                        <td class="form">
                            <input type="radio" id="auto_remove_true" name="auto_remove" value="是" required> 是
                            <input type="radio" id="auto_remove_false" name="auto_remove" value="否" required> 否
                        </td>
                        <td class="form"><input type="text" id="note" name="note"></td>
                    </tbody>
                </table>
                <!-- <input type="submit" value="儲存"> -->
                <!-- <button onclick="insertSubbuilding()">儲存</button> -->
            </form>
            <button onclick="insertSubbuilding()">儲存</button>
        </div>
    </body>
    <?php echo '<script'; ?>
>
        function insertSubbuilding(){
            let required_fields = ["application", "item_name", "unitprice", "unit", "auto_remove"];
            let auto_remove;
            for(let i=0;i<required_fields.length;i++){
                if(required_fields[i] == "auto_remove"){
                    if(document.getElementById("auto_remove_true").checked == false && document.getElementById("auto_remove_false").checked == false){
                        window.alert("請輸入必填欄位!");
                        return;
                    }
                    else{
                        if(document.getElementById("auto_remove_true").checked == true){
                            auto_remove = "是";
                        }
                        else{
                            auto_remove = "否";
                        }
                    }
                }
                else{
                    if($("input[name='"+required_fields[i]+"']").val() == ""){
                        window.alert("請輸入必填欄位!");
                        return;
                    }
                }
            }
            $.ajax({
                url: "insert_subbuilding.php",
                type: "POST",
                data:{
                    application: $("#application").val(),
                    item_name: $("#item_name").val(),
                    unitprice: $("#unitprice").val(),
                    unit: $("#unit").val(),
                    auto_remove: auto_remove,
                    note: $("#note").val()
                },
                cache:false,
                async:false,
                success: function(data){
                    if(data != "OK"){
                        window.alert("新增失敗!\n"+data);
                    }
                    else{
                        window.alert("新增成功!");
                        window.close();
                    }
                },
                error:function(err){
                    window.alert(err.statusText);
                }
            });
        }
    <?php echo '</script'; ?>
>
</html><?php }
}
