<?php
include_once 'db.php';
$exec_start = get_micro_time();
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 


$result_total = "SELECT count(*) AS total FROM `quran_topics_name` Order By id ASC";
$db->query($result_total);
$db->setFetchMode(2);
$totalItems = $db->get('total');

$fileName = "Topic-page-";
$page = 1;
$pageLimit = 50;
$start = 0;
if(isset($_GET['page']) && $_GET['page'] !=""){
$page = $_GET['page'];
if(!is_numeric($page)){
$page = 1;
  }
 }
$start = ($page - 1)*$pageLimit;


include_once'includes/pagination.php';
$pager = Pages($totalItems,$pageLimit,$fileName);

$limit = 'LIMIT '.$start.', '.$pageLimit.'';
$query_Topic = "select Topic_No,Mother_Topic,Topic_Name FROM `quran_topics_name` Order By id ASC $limit";
$db->query($query_Topic);
$db->setFetchMode(2);
$view_Topic = $db->get();
//echo count($result);
//print_r($result);
$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());
$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);
$smarty->assign('site_title','مواضيع القران الكريم');
$smarty->assign('Topic_title','مواضيع القران الكريم');
$smarty->assign('Description','مواضيع القران الكريم');
$smarty->assign('keywords','مواضيع,القرأن,فهرس المواضيع');
$smarty->assign('totalItems',$totalItems);
$smarty->assign('pagination',$pager);
$smarty->assign('view_Topic', $view_Topic);
$smarty->display('topic.html');
ob_end_flush();
 ?>
