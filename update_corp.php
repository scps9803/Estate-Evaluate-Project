<?php
session_start();
include "library.php";
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$recordNo = $_GET["recordNo"];
// $rId = explode("-",$recordNo);
$rId = substr($recordNo,4,strlen($recordNo)-4);

$corp_category = load_corp_item_Data();
$corp_category_option = "";

for($i=0;$i<count($corp_category);$i++){
    $corp_category_option = $corp_category_option
    ."<option value='".$corp_category[$i]["category"]."'>".$corp_category[$i]["category"]."</option>";
}

// echo
// '<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>'.
// '<script type="text/javascript" src="js/index.js"></script>'.
// '<script>
// $(document).ready(function(){
//     $("#script-number").val("'.$rId[1].'");
//     var corp_length = '.count($corp_data).'
//     var corp_data = [];
//
//     for(var i=0;i<corp_length;i++){
//         if(i>0){
//             addInfoItemOnclick("corp-category");
//         }
//         $("input[name=\'corp-num-"+(i+1)+"\']").val("1234");
//     }
//
//     window.alert('.count($corp_category).');
// });
// </script>';
echo
'<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>'.
'<script type="text/javascript" src="js/index.js"></script>'.
'<script>
    $(document).ready(function(){
        $("#title").html("編輯農作物查案");
        getCorpUpdateData("'.$recordNo.'","'.$rId.'");
    });
</script>';

$smarty->assign("corp_category_option",$corp_category_option);
$smarty->display("corp.html");
?>
