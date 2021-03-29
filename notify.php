<?php
if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
if(!ini_get('zlib.output_compression') && function_exists('ob_gzhandler'))ob_start('ob_gzhandler'); else ob_start();
}
include_once 'db.php';
$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());
$smarty->assign('site_title',$titleaya);
$smarty->assign('Description',$title_aya);
$smarty->assign('keywords',gen_tag($title_aya));
$smarty->assign('home_title',$home_title);
$smarty->display('notify.html');
ob_end_flush();
?>
