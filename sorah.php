<?php
include_once 'db.php';
$exec_start = get_micro_time();
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 

$SuraID = intval($_GET['id']);

$sorah_next = $SuraID + 1;
if ($SuraID == 114){
$sorah_next = $SuraID;
}
if ($SuraID > 1){
$sorah_previous = $SuraID - 1;
}else{
$sorah_previous = $SuraID;
}
$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());
$smarty->assign('sound_check_sora_rd', sound_check_sora_rd($SuraID));
$smarty->assign('sound_check_sora', sound_check_sora($SuraID,1));
$smarty->assign('sorah_next', $sorah_next);
$smarty->assign('sorah_previous', $sorah_previous);
$smarty->assign('site_title',sorahname($SuraID));
$smarty->assign('Description',sorahname($SuraID));
$smarty->assign('keywords',sorahname($SuraID));
$smarty->assign('row_suras',sorah($SuraID));
$smarty->assign('row_all',ayats_sura($SuraID));
$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);
if($active_cash ==1) {
$smarty->caching = 1; //1 or 0
$nid = (integer)($_GET['id']);
$smarty->display('sorah_view.html',$nid);
}else{
$smarty->display('sorah_view.html');
}
ob_end_flush();
 ?>
