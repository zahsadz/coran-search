<?php
include ("db.php");
$exec_start = get_micro_time();
include_once 'includes/globales.php';
$queryTimer = new MicroTimer(); 

//contact us
$smarty->assign('DERCTION', 'rtl');
$smarty->assign('TEXTALIGN', 'right');
$smarty->assign('LAN_1', 'بلغ عن خطا او إتصل بإدارة الموقع');
$smarty->assign('LAN_2', 'إسمك');
$smarty->assign('LAN_3', 'بريدك الإلكتروني');
$smarty->assign('LAN_4', 'الموضوع');
$smarty->assign('LAN_5', 'الرسالة');
$smarty->assign('LAN_6', 'ادخل كود الامان');
$smarty->assign('LAN_9', '');
define("_EMTYCONTACT","تركت نمودج او اكثر فارغ");
define("_CORRECTEMAIL","اكتب بريدا إلكترونيا صحيحا");
define("_SECURITYCODE","كود الحماية غير متطابق");
define("_SUCCESSSEND","تم إرسال الرسالة لإدارة الموقع بنجاح نشكرك علي المراسلة");
define("_FAILED","فشل في الإرسال ");

$send = 1;
$success='';
$error ='';

if(isset($_POST['submit'])) {
$pfrom = $_POST['from'];
$pemail = $_POST['email'];
$psubject = $_POST['subject'];
$pmessage = $_POST['message'];
$pcaptcha = $_POST['captcha'];
$date =  date("Y-m-d");

if(empty($_POST['from'])||empty($_POST['email'])|| empty($_POST['subject'])|| empty($_POST['message'])) {
 $error = ""._EMTYCONTACT."";
 $doop = 'no';
}

 if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
 {
	 $error = ""._CORRECTEMAIL."";
     $doop = 'no';
}

if ($pcaptcha !== $_SESSION['captcha']) {
	$error = ""._SECURITYCODE."";
 	$doop = 'no';
}

if(empty($doop)) {
	
$sql = "INSERT INTO quran_contactus (sender, email, subject, message, date , readed) VALUES('$pfrom', '$pemail', '$psubject', '$pmessage', '$date','no')";
$op = $db->query($sql);
//echo $db->id();

if($op) {
	$success = ""._SUCCESSSEND."";
   $send = 0;
} else {
	$error = ""._FAILED."";
}
}
}
$method = isset($_GET['method']) ? $_GET['method'] : 1;	
$smarty->assign('method',$method);
$smarty->assign('soranames',soranames());
$exec_end = get_micro_time();
$timer = get_exec_time($exec_end, $exec_start);
$smarty->assign ("timer",$timer);
$queryTimer->stop();
$smarty->assign('query_time',$queryTimer);
$smarty->assign('send', $send);
$smarty->assign('success', $success);
$smarty->assign('error', $error);
$smarty->display('contact_us.html');
?>
