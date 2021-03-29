<?php


/*
$sql1="
SELECT ayat.*,sorah.* ,tafsser.* from ayat , sorah ,tafsser
 WHERE  tafsser.aya_id = ayat.ayaano AND tafsser.sura_id = ayat.soraano AND tafsser.type ='2' AND ayat.soraano = sorah.soraano LIMIT 0 , 1";
*/


$sql="SELECT w.soraano,w.ayaano,w.ayaa AS ayat , m.aya_id,m.sura_id , m.text AS tafsser ,s.soraano,s.soraaname AS sorah
FROM ayat w , tafsser m , sorah s WHERE m.aya_id = w.ayaano AND m.sura_id = w.soraano AND m.type ='2' AND s.soraano = w.soraano LIMIT 0 , 1";



	/*	$sql_k = mysqli_query($db,"
SELECT * FROM ayat 
LEFT JOIN sorah ON ayat.soraano = sorah.soraano WHERE ayat.AyaaIndex LIKE '%".$search_word."%'
UNION
SELECT * FROM ayat
RIGHT JOIN sorah ON ayat.soraano = sorah.soraano WHERE ayat.AyaaIndex LIKE '%".$search_word."%'
 limit 0,10
");*/
/*
$sql_k = mysqli_query($db,"
SELECT * FROM ayat 
LEFT JOIN sorah ON ayat.soraano = sorah.soraano WHERE ayat.chapterNO = '3'
UNION
SELECT * FROM ayat
RIGHT JOIN sorah ON ayat.soraano = sorah.soraano WHERE ayat.chapterNO = '3'
 limit 0,10
");
*/
/*
$sql_k = mysqli_query($db,"SELECT ayat.*,sorah.* from ayat , sorah
 WHERE ayat.AyaaIndex  LIKE '%".$search_word."%'
AND ayat.soraano = sorah.soraano");
*/


$sql1 =	"select c.sura_no,
	t.name,
	c.aya_no,
	c.aya_text,
	s.text AS altafsir
	from hafs_ayat c
	join surah_names t on t.id = ".$result[0]['sura']."
	join ar_muyassar s on s.aya = ".$result[0]['aya']." AND s.sura = ".$result[0]['sura']."
	where c.aya_no = ".$result[0]['aya']." AND c.sura_no = ".$result[0]['sura']."";




$sql="SELECT w.sura_no,w.aya_no,w.aya_text , m.name , s.text AS altafsir
FROM hafs_ayat w , surah_names m , ar_muyassar s WHERE w.aya_no = ".$result[0]['aya']." AND w.sura_no=".$result[0]['sura']." AND m.id = ".$result[0]['sura']." AND s.aya = ".$result[0]['aya']." AND s.sura = ".$result[0]['sura']."";




/*
require 'includes/adodb5/adodb.inc.php';
$db             = ADONewConnection('pdo');
$db->debug      = false;

if(!$db->Connect('mysql:host=localhost','root','12345678','quran1'))
	{
	  exit($db->ErrorMsg());
   }
$db->Execute('SET NAMES utf8');
$db->Execute('SET CHARACTER SET utf8');
$db->Execute('SET COLLATION_CONNECTION="utf8_unicode_ci"');

//$ADODB_FETCH_MODE = ADODB_FETCH_NUM;  
//$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;  

$SQL = 'select count(*) AS total  from quran';  

$maxTickets = $db->GetOne($SQL);
echo $maxTickets.'---';
print_r($maxTickets); 
		   $ADODB_CACHE_DIR = 'cache/';

//$rs2 = $db->CacheExecute(3000,'select * from quran ORDER BY rand() LIMIT 0 , 1');  
//print_r($rs2->fields); 

$rs2 = $db->getAll('select * from quran ORDER BY rand() LIMIT 0 , 1');  
 
print_r($rs2);*/ 
function is_rtl( $string ) {
	$rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
	return preg_match($rtl_chars_pattern, $string);
}

// Arabic Or Persian
var_dump(is_rtl('نص عربي أو فارسي'));

// Hebrew
var_dump(is_rtl('חופש למען פלסטין'));

// Latin
var_dump(is_rtl('Hello, World!'));




























