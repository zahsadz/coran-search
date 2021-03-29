<?php
include_once 'db.php';
$exec_start = get_micro_time();
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 

function arabic_count_char($str){
//$countext = preg_match_all('/[أ-ي]/ui',$str,$match);
$countext = preg_match_all('/\p{Arabic}/u',$str,$match);
return $countext;
}

if (!isset($_GET['search_word']) || empty($_GET['search_word'])) {
   $smarty->assign('error', 'أ كتب كلمة بحث');
   $smarty->assign('search_word','');
   $method = isset($_GET['method']) ? $_GET['method'] : 1;
   $smarty->assign('method',$method);
   $exec_end = get_micro_time();
   $timer = '<br />الزمن المستغرق<strong>' . get_exec_time($exec_end, $exec_start) . '</strong> ثانية.';
   $smarty->assign('timer',$timer);
   $smarty->assign('query_time',$timer);
   $smarty->display('error.html');
     exit();
      } else {
        $search_word = $_GET['search_word'];
        //$search_word = str_replace('[[:space:]]+', ' ', trim($search_word));
$search_word = strip_tags(urldecode(trim($search_word)));
$search_word = htmlspecialchars($search_word, ENT_QUOTES);

$method = isset($_GET['method']) ? $_GET['method'] : 1;	

//$fileName ="".ABSURL."/search/".$_GET['search_word']."/page/";
$fileName ="".ABSURL."/search.php?search_word=".$_GET['search_word']."&method=".$method."&page=";

$page = 1;
$pageLimit = 10;
$start = 0;
if(isset($_GET['page']) && $_GET['page'] !=""){
$page = $_GET['page'];
if(!is_numeric($page)){
$page = 1;
  }
 }
$start = ($page - 1)*$pageLimit;
$total = getrecordCount($method,$search_word);
if($total > 0){
writehistory($search_word);
}
include_once'includes/pagination.php';
$pager = Pages($total,$pageLimit,$fileName);
$result =  getData($start,$pageLimit,$method,$search_word);
	  }
//echo lex($search_word);
$exec_end = get_micro_time();
$timer = '<br />الزمن المستغرق<strong>' . get_exec_time($exec_end, $exec_start) . '</strong> ثانية.';
$smarty->assign('soranames',soranames());
$smarty->assign('sorahname',sorahname($sura_id=''));
$smarty->assign('arabic_count_char',arabic_count_char($str=''));
$smarty->assign('search_word',$search_word);
$smarty->assign('search_word_h',$Arabic->arQueryAllForms($_GET['search_word']));
$smarty->assign('method',$method);
$smarty->assign('timer',$timer);
$smarty->assign('totalItems',$total);
$smarty->assign('pagination', $pager);
$smarty->assign('row_all', $result);
$smarty->assign('site_title',$search_word);
$smarty->assign('Description',$search_word);
$smarty->assign('keywords',$search_word);
$smarty->assign('home_title','بحث');
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);
$smarty->display('search.html');
ob_end_flush();
?>

