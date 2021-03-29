<?php
/*if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
if(!ini_get('zlib.output_compression') && function_exists('ob_gzhandler'))ob_start('ob_gzhandler'); else ob_start();
}*/
include("db.php");
$exec_start = get_micro_time();
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 
 $ayaID = intval($_GET['aya']);
 $SuraID = intval($_GET['sura']);
 $type = intval($_GET['type']);

$alsura = sorah($SuraID);
$alaya = ayats($ayaID,$SuraID);

 $aya_next = $ayaID + 1;
if ($ayaID == $alsura[0]['ayat_count']){
$aya_next = $ayaID;
}
if ($ayaID > 1){
$aya_previous = $ayaID - 1;
}else{
$aya_previous = $ayaID;
}

switch($_GET['type']){
	 case '1':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_katheer');
		$tafseer_title = 'تفسير إبن كثير';
		$direction='rtl';
		break;
    case '2':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_muyassar');
		$tafseer_title = 'التفسير الميسر';
		$direction='rtl';
		break;
	 case '3':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_jalalayn');
	   $tafseer_title = 'تفسير الجلالين';
	   $direction='rtl';
        break;		
    case '4':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_fr_hamidullah');
		$tafseer_title = 'Francais - Hamidullah Le Coran traduction en langue francaise ';
		$direction='ltr';
        break;
	case '5':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_en_sahih');
	   $tafseer_title = 'The Saheeh International Quran Translation';
	   $direction='ltr';
        break;
    case '6':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_en_transliteration');
	   $tafseer_title = 'English Transliteration';
	   $direction='ltr';
        break;
	    case '7':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ber_mensur');
	   $tafseer_title = 'Amazigh Ramdane At Mansour';
	   $direction='ltr';
        break;
	    case '8':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_sa3dy');
	   $tafseer_title = 'تفسير السعدي';
	   $direction='rtl';
        break;	
		case '9':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_e3rab');
	   $tafseer_title = 'إعراب القرأن الكريم';
	   $direction='rtl';
        break;
		case '10':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_baghawy');
	   $tafseer_title = 'تفسير البغوي ';
	   $direction='rtl';
        break;
	default:
       $tafseer =  altafsire($ayaID,$SuraID,'ar_muyassar');
	   $tafseer_title = 'التفسير الميسر';
	   $direction='rtl';
        break;		
 }
 
   $el_tafseer = htmlspecialchars_decode($tafseer, ENT_QUOTES);
   $el_tafseer = strip_tags($el_tafseer);
$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());
   
$smarty->assign('name_suras',$alsura[0]['name']);
$smarty->assign('id_aya',$ayaID);
$smarty->assign('sura_id',$SuraID);
$smarty->assign('type',$type);

$smarty->assign('alaya',$alaya[0]['text_otmani']);

$smarty->assign('sound_check_aya',sound_check_aya($SuraID,$ayaID,'1'));

$smarty->assign('tafsser',$el_tafseer);
$smarty->assign('direction',$direction);

$smarty->assign('aya_next', $aya_next);
$smarty->assign('aya_previous', $aya_previous);

$smarty->assign('thistafsser',$tafseer_title);
$smarty->assign('site_title','سورة '.$alsura[0]['name'].' الاية '.$ayaID.'|'.string_limit_words($el_tafseer,30).'');
$smarty->assign('Description',$el_tafseer);
$smarty->assign('keywords',gen_tag($el_tafseer));
$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);
if($active_cash ==1) {
$smarty->caching = 1; //1 or 0
$news_entry_aya= (integer)($_GET['aya']);
$news_entry= (integer)($_GET['sura']);
$news_act= (integer)($_GET['type']);
$smarty->display('tafsser.html',$news_entry,$news_act.$news_entry_aya.'');
}else{
$smarty->display('tafsser.html');
}
ob_end_flush();
?>

