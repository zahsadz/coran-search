<?php
//
require("db.php");
//
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$page = ($page == 0 ? 1 : $page);
$xmlperpage=100;
$startpoint=($page * $xmlperpage) - $xmlperpage;

if(isset($_GET['page'])){
header('Content-type: text/xml');

echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/09/sitemap.xsd\">\n";
$mresult = "SELECT sura,aya FROM quran_ayat limit $startpoint,$xmlperpage";
$db->query($mresult);
$db->setFetchMode(2);
$quran_table = $db->get();
foreach($quran_table as $mrow){
     $links="".$base_url."/aya-".$mrow['aya']."-sora-".$mrow['sura'].".html";
print "<url>\n";
print "<loc>".XMLEntities($links)."</loc>\n";
print "</url>\n";
}
echo "</urlset>";
exit();
}
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
$mresult = "SELECT COUNT(*) as total FROM quran_ayat";
$db->query($mresult);
$db->setFetchMode(2);
$quran_table = $db->get('total');
$pagesnum =ceil($quran_table/ $xmlperpage);
##########################################
for ($i=1; $i<=$pagesnum; $i++) {
if ($i != $page) {
	echo '<sitemap>'."\n";
		echo '<loc>'.$base_url.'/sitemap-'.($i).'.xml</loc>'."\n";
		echo '</sitemap>'."\n";
}else{
		echo '<sitemap>'."\n";
		echo '<loc>'.$base_url.'/sitemap-'.($i).'.xml</loc>'."\n";
		echo '</sitemap>'."\n";
	}
   }
	echo '</sitemapindex>'."\n";
//}

function XMLEntities($str) {
return str_replace('>','&gt;',str_replace('<','&lt;',str_replace('"','&quot;',str_replace('\'','&apos;',str_replace('&','&amp;',iconv('utf-8','utf-8',$str))))));
}
?>
