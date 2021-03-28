<?php
include_once 'db.php';
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 


$request_title = "SELECT sura,aya FROM `quran` ORDER BY rand() LIMIT 0 , 1";
$db->setFetchMode(2);
$db->query($request_title);
$result = $db->get();
//print_r($result);

$sql12 = "select c.sura,
	t.name,
	c.aya,
	c.text,
	s.text AS altafsir,
    e.text AS entxt
	from quran c
	join quran_surah_names t on t.id = c.sura
	join tfs_ar_muyassar s on s.aya = c.aya AND s.sura = c.sura
	join tfs_en_sahih e on e.aya = c.aya AND e.sura = c.sura
	where c.aya = ".$result[0]['aya']." AND c.sura = ".$result[0]['sura']."";


$db->setFetchMode(2);
$db->query($sql12);
$result = $db->get();
//print_r($result);
$search_word = isset($_GET['search_word']) ? $_GET['search_word'] : 'منذر';	
$smarty->assign('search_word',$search_word);
$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('showhistory',showhistory(10));
$smarty->assign('soranames',soranames());
$smarty->assign ("Default_Search_Term",$Default_Search_Term);
$smarty->assign('home_title',$site_title);
$smarty->assign ("result",$result);
$smarty->assign('Description','Browse, Search, and Listen to the Holy Quran. With accurate quran text and quran translations in various languages,محرك بحث قراني');
$smarty->assign('keywords','Quran, Quran Text, Translation, Recitation, Authentic, Precise, Accurate, Verified, Quran, Al-Quran, Kuran, Koran, Search Quran, Roots, Recite, Tartil, Tarteel, Translations, Audio, Listen, Search, Code, API, Download, الكريم, القرآن ,العالمي');
$smarty->assign('site_title','محرك بحث قراني');
$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);
$smarty->display('home.html');
 ?>