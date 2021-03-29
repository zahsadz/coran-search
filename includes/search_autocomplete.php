<?php
header('Content-Type: text/html; charset=utf-8' );
//header("Content-type: text/javascript\n\n");
$q = strtolower(urlencode($_GET["q"]));
//$infotag = iconv('utf-8','utf-8',$q);
$q = urldecode($q);
//echo $q;
if (!$q) return;
include"../db.php";
$result_text = mysql_query("SELECT count,text FROM quran_root WHERE text like '%".$q."%'");
while ($info = mysql_fetch_array($result_text)){
$term = $info['count'];
$counter = $info['text'];
 // echo  $counter;
$items = array($term => $counter);
 foreach ($items as $key=>$value) {
	//if (strpos(strtolower($key), $q) !== false) {
		echo "".$value."|".$key."\r\n";
	//}
}
// print_r($items);

}
//echo"<hr>";
?>
