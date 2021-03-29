<?php
  if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
if(!ini_get('zlib.output_compression') && function_exists('ob_gzhandler'))ob_start('ob_gzhandler'); else ob_start();
}
include_once 'db.php';
$exec_start = get_micro_time();
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 

    $TopicID= trim($_GET['id']);
    $TopicID= strip_tags($TopicID);

	  
//$result = preg_split('/([\s\-_,:;?!\/\(\)\[\]{}<>\r\n"]|(?<!\d)\.(?!\d))/',$Ayat_No, null, PREG_SPLIT_NO_EMPTY);
function sp_ayat($Ayat_No){
$result = preg_split('/([\s\-_,:;?!\/\(\)\[\]{}<>\r\n"]|(?<!\d)\.(?!\d))/',$Ayat_No, null, PREG_SPLIT_NO_EMPTY);
return $result;
}
$request_aya = "SELECT s.id,s.name,t.Topic_Name,ta.Ayat_No FROM quran_surah_names s, quran_topics_name t ,quran_topic_ayat ta WHERE s.id =ta.Sura_No AND t.Topic_No =ta.Topic_No AND ta.Topic_No = $TopicID";
$db->query($request_aya);
$db->setFetchMode(2);
$row_Ayat = $db->get();
//print_r($row_Ayat);
$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());
$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);

$smarty->assign('Topic_Name', $row_Ayat[0]['Topic_Name']);
$smarty->assign('ayat_Topic', $row_Ayat);
$smarty->display('topic_ayat.html');
ob_end_flush();
 ?>
