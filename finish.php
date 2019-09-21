<?php
require_once "smarty/libs/Smarty.class.php";
$smarty = new Smarty;

$house_address = $_POST['house_address'];
$script_number = $_POST['script_number'];

echo
'<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>'.
'<script type="text/javascript" src="js/index.js"></script>'.
'<script>
    $(document).ready(function(){
        exportExcel("'.$script_number.'","'.$house_address.'");
    });
</script>';

$smarty->assign("house_address",$house_address);
$smarty->assign("script_number",$script_number);
$smarty->display("finish.html");
?>
