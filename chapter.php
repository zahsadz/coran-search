<?php
include_once 'db.php';
$exec_start = get_micro_time();
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 
$method = isset($_GET['method']) ? $_GET['method'] : 1;	

if (isset($_GET['id'])){

$id = (int) $_GET['id'];

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
$fileName = "".ABSURL."/juz/".$_GET['id']."/page/";

$result_total=("SELECT *  FROM quran_chapters WHERE ID = '".$id."'");	
$db->query($result_total);
$db->setFetchMode(2);
$home_title = $db->get();
//echo count($totalItems);
//print_r($home_title);

$result_total=("SELECT count(*) AS total FROM quran_ayat WHERE juz = '".$id."'");	
$db->query($result_total);
$db->setFetchMode(2);
$totalItems = $db->get('total');
//echo count($totalItems);
//print_r($totalItems);


include_once'includes/pagination.php';
$pager = Pages($totalItems,$pageLimit,$fileName);

$sql="SELECT w.sura,w.aya,w.juz,w.hezb,w.page,w.text_otmani , m.name
FROM quran_ayat w, quran_surah_names m WHERE w.juz  = '".$id."' AND w.sura = m.id LIMIT $start ,$pageLimit ";

$db->query($sql);
$db->setFetchMode(2);
$result = $db->get();
//echo count($result);
//print_r($result);
    $juz = $_GET['id'];
    $prev = $juz - 1; 
    $next = $juz + 1; 
    $lastpagejuz = 30; 
    $lpm1 = $lastpagejuz - 1;

    $paginationjuz = "";
    if($lastpagejuz > 1)
    {   
        $paginationjuz .= "<div class=\"pagination  justify-content-center\">";
        //previous button
        if ($juz > 1) 
            $paginationjuz.= "<a class='page-link' href=\"".ABSURL."/juz-".$prev.".html\">« الجزء السابق</a>";
        else
            $paginationjuz.= "<span class=\"page-item disabled\"><a class='page-link' href='#'>« الجزء السابق</a></span>"; 

        //next button
        if ($juz < $lastpagejuz) 
            $paginationjuz.= "<a class='page-link' href=\"".ABSURL."/juz-".$next.".html\">الجزء التالي »</a>";
        else
            $paginationjuz.= "<span class=\"page-item disabled\"><a class='page-link' href='#'>الجزء التالي »</a></span>";
        $paginationjuz.= "</div>\n";       
    }
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());	
$smarty->assign('site_title',$home_title[0]['Chapter']);	
$smarty->assign('home_title',$home_title[0]['Chapter']);
$smarty->assign('Description',$home_title[0]['Chapter']);
$smarty->assign('keywords',gen_tag($home_title[0]['Chapter']));
$smarty->assign('totalItems',$totalItems);
$smarty->assign('view_chapterNO',$result);
$smarty->assign('pagination',$pager);
$smarty->assign('pagi',$paginationjuz);
$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);

$smarty->display('chapter_ayat.html');
exit();
}

$result_total=("SELECT *  FROM quran_chapters");	
$db->query($result_total);
$db->setFetchMode(2);
$Chapter_table = $db->get();
//echo count($totalItems);
//print_r($Chapter_table);
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());
$smarty->assign('site_title','فهرس اجزاء القران الكريم');
$smarty->assign('Description','فهر اجزاء القران الكريم');
$smarty->assign('keywords','فهرس,اجزاء,القرأن,30 جزء');
$smarty->assign('Chapter_table',$Chapter_table);
$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);

$smarty->display('chapter.html');
ob_end_flush();
 ?>
