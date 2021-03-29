<?php
include_once 'db.php';
$exec_start = get_micro_time();
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 

$result_total=("SELECT * FROM quran_surah_names");	
$db->query($result_total);
$db->setFetchMode(2);
$quran_table = $db->get();
//echo count($totalItems);
//print_r($quran_table);


$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());

$smarty->assign('site_title','فهرس السور');
$smarty->assign('Description','فهرس سور القران الكريم');
$smarty->assign('keywords','فهرس,سور,قران,قرأن');
$smarty->assign('quran_table',$quran_table);

$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);

$smarty->display('all_sura.html');
ob_end_flush();
 ?>
