<?php
include"db.php";

$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());
$smarty->assign('site_title','محرك بحث الاحاديث النبوية');
$smarty->assign('Description','محرك بحث الاحاديث النبوية');
$smarty->assign('keywords','محرك بحث,الحديث النبوي,احاديث الرسول صلي الله عليه مسلم');
$smarty->display('hadeeth.html');
ob_end_flush();
?>
