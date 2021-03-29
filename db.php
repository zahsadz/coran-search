<?php
session_start();

$config = array();

$config['host'] = 'localhost';//localhost  السيرفر
$config['user'] = 'root';//username database إسم مستحدم قاعدة البيانات
$config['pass'] = '12345678';//password database كلمة سر قاعدة البيانات
$config['table'] = 'quran1';//name database  إسم قاعدة البيانات


$prefix = "";//اتركه كما هو
//$base_url	= "https://surahquran.com/quran-search";// رابط الموقع
$contact_email ='admin@admin.cc';
$base_url	= "http://quran-search.me";// رابط الموقع

$Default_Search_Term='كلمة البحث هنا';//اتركه كما هو
$site_title='الباحث القرآني';//إسم الموقع
$theme='lite1';// إسم القالب
$active_cash=0;// الكاش

##################       لا تمس شيء هنا    #####################
define('collo','allow');
define('ABSPATH',dirname(__FILE__).'');
define('ABSURL',$base_url);
//include("".ABSPATH."/includes/mysql_pdo.php");
include("".ABSPATH."/includes/mysqlidb.php");
//include("".ABSPATH."/includes/adodb.php");
$db = new DB($config);
include("".ABSPATH."/includes/function.php");
 ?>