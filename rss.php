<?php
//header('Content-Type: application/rss+xml; charset=utf-8"');
header("Content-Type: text/xml; charset=utf-8");
require("db.php");
function clean_feed($input) {
	$original = array("<", ">", "&", '"' ,'—');
	$replaced = array("&lt;", "&gt;", "&amp;", "&quot;", "");
	$newinput = str_replace($original, $replaced, $input);
	return $newinput;
}
$dat = date("j/n/Y",time());
$logo = "".$base_url."/images/logo.jpg";
//header("Content-Type: text/xml; charset=utf-8");
echo "<rss version=\"2.0\">\n";
?>
<channel>
<title><?php echo $site_title; ?></title>
<link><?php echo $base_url; ?></link>
<description><?php echo $des_site; ?></description>
<language>ar-dz</language>
<image>
<title><?php echo $site_title;?></title>
<url><?php echo $logo;?></url>
<link><?php echo $base_url;?></link>
<width>100</width>
<height>100</height>
</image>
<copyright>Copyright <?php echo date('Y'); ?></copyright>
<?php

  $result = "SELECT sura,aya,simple FROM quran_ayat ORDER BY rand() asc LIMIT 0,10";
$db->query($result);
$db->setFetchMode(2);
$quran_table = $db->get();
foreach ($quran_table as $row){
##########
$request_aya = "SELECT id,name from surah_names WHERE id ='".$row['sura']."' limit 0,1";
$db->query($request_aya);
$db->setFetchMode(2);
$sura_table = $db->get();
$name_aya = $sura_table[0]["name"];
$id = $sura_table[0]["id"];


?>

<item>
<title>سورة <?php echo XMLEntities($name_aya); ?></title>
<link><?php echo $base_url; ?>/aya-<?php echo clean_feed($row['aya']); ?>-sora-<?php echo clean_feed($sura_table[0]['id']); ?>.html</link>
<description>  <![CDATA[ <?php echo XMLEntities($row['simple']);?> .]]>  </description>
</item>
<?php
}

    function XMLEntities($str) {
return str_replace('>','&gt;',str_replace('<','&lt;',str_replace('"','&quot;',str_replace('\'','&apos;',str_replace('&','&amp;',iconv('utf-8','utf-8',$str))))));
}
?>

</channel>
</rss>