<?php
include_once 'db.php';
$exec_start = get_micro_time();
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 

if (isset($_GET['id'])){

$id = (int) $_GET['id'];
}
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
$fileName = "".ABSURL."/page/".$_GET['id']."";


$result_total=("SELECT count(*) AS total FROM quran_ayat WHERE page = '".$id."'");	
$db->query($result_total);
$db->setFetchMode(2);
$totalItems = $db->get('total');
//echo count($totalItems);

//print_r($totalItems);


include_once'includes/pagination.php';
$pager = Pages($totalItems,$pageLimit,$fileName);

$sql="SELECT w.sura,w.aya,w.juz,w.hezb,w.page,w.text_otmani , m.name
FROM quran_ayat w, quran_surah_names m WHERE w.page  = '".$id."' and m.id = w.sura ";

//echo $sql;
$db->query($sql);
$db->setFetchMode(2);
$result = $db->get();
//echo count($result);
//print_r($result);
    $safha = $_GET['id'];
    $prev = $safha - 1; 
    $next = $safha + 1; 
    $lastpagesafha = 604; 
    $lpm1 = $lastpagesafha - 1;

    $paginationsafha = "";
    if($lastpagesafha > 1)
    {   
        $paginationsafha .= "<div class=\"pagination  justify-content-center\">";
        //previous button
        if ($safha > 1) 
            $paginationsafha.= "<a class='page-link' href=\"".ABSURL."/safha/".$prev."\">« الصفحة السابقة</a>";
        else
            $paginationsafha.= "<span class=\"page-item disabled\"><a class='page-link' href='#'>« الصفحة السابقة</a></span>"; 

        //next button
        if ($safha < $lastpagesafha) 
            $paginationsafha.= "<a class='page-link' href=\"".ABSURL."/safha/".$next."\">الصفحة التالية »</a>";
        else
            $paginationsafha.= "<span class=\"page-item disabled\"><a class='page-link' href='#'>الصفحة التالية »</a></span>";
        $paginationsafha.= "</div>\n";       
    }
$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());	
$smarty->assign('page_id',$id);
$smarty->assign('Description','من المصحف الريف'.$id.'الصفحة');
$smarty->assign('keywords','من المصحف الشريف'.$id.'الصفحة');
$smarty->assign('totalItems',$totalItems);
$smarty->assign('row_all',$result);
$smarty->assign('pagination',$pager);
$smarty->assign('pagi',$paginationsafha);
$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);
$smarty->display('page_quran.html');
ob_end_flush();
 ?>
