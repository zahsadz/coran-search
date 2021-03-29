<?php
 if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
if(!ini_get('zlib.output_compression') && function_exists('ob_gzhandler'))ob_start('ob_gzhandler'); else ob_start();
}
include_once 'db.php';
$exec_start = get_micro_time();
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 

$sura_id = intval($_GET['sora']);
$aya_id= intval($_GET['aya']);

$alsura = sorah($sura_id);
$alaya = ayats($aya_id,$sura_id);


$aya_next = $aya_id + 1;
if ($aya_id == $alsura[0]['ayat_count']){
$aya_next = $aya_id;
}
if ($aya_id > 1){
$aya_previous = $aya_id - 1;
}else{
$aya_previous = $aya_id;
}
##################################
$smarty->assign('showhistory',showhistory(10));
$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());
$smarty->assign('sound_check_aya_rd', sound_check_aya_rd($sura_id,$aya_id));
$smarty->assign('site_title',string_limit_words($alaya[0]['simple'],6));
$smarty->assign('Description',$alaya[0]['simple']);
$smarty->assign('keywords',gen_tag($alaya[0]['simple']));
$smarty->assign('aya_next', $aya_next);
$smarty->assign('aya_previous', $aya_previous);
$smarty->assign('sura_id',$sura_id);
$smarty->assign('aya_id',$aya_id);
$smarty->assign('name_suras', $alsura[0]['name']);
$smarty->assign('alaya',$alaya);
$smarty->assign('alsura',$alsura);
$smarty->assign('hafs_ayat',al_aya($aya_id,$sura_id));
$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);
if($active_cash==1) {
$smarty->caching = 1; //1 or 0
$news_sora= (integer)($_GET['sora']);
$news_aya= (integer)($_GET['aya']);
$smarty->display('aya_view.html',$news_sora,'aya_'.$news_aya.'');
}else{
$smarty->display('aya_view.html');
}
ob_end_flush();
 ?>
