<?php
session_start();
// $headers = @get_headers($url);
 switch ($_GET['code']){
	case '500':
    $head = 'Internal Server Error | خطا داخل المعذرة اعد المحاولة';
    $text = 'An unexpected condition encountered by the server';
	break;

	case '404':
    $head = '404 Not Found | الصفحة غير موجودة او تم حذفه';
    $text = 'The requested URL was not found on this server';
	break;

	case '403':
    $head = 'Forbidden | السيرفر رفض  وصولك اعد المحاولة';
    $text = 'Server refuses to fulfill the request';
	break;

	case '401':
    $head = 'Not Authorized | غير مسموح لك الدخول إلي هنا';
    $text = 'Request requires user authentication';
	break;

	case '400':
    $head = 'Bad Request | إستعلام خاطيء';
    $text = 'Syntax of the request not understood by the server';
	break;

	default :
    $head = 'Hello There | مرحبا  نعتذر عن الخطا إرجع للموقع وتمتع';
    $text = 'How are you,this page is for HTTP error pages';

}
if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
if(!ini_get('zlib.output_compression') && function_exists('ob_gzhandler'))ob_start('ob_gzhandler'); else ob_start();
}
include"db.php";
$smarty->assign('head',$head);
$smarty->assign('text',$text);
$smarty->display('error.html');
mysqli_close($db);
ob_end_flush();
?>
