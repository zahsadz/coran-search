# coran-search
محرك بحث قرأني بحث وتفسير و تراجم-
التفاسير*
إبن كثير* 
التفسير الميسر* 
البغوي*
إعراب القرأن*
تفسير الجلالين*
تفسير السعدي*
التراجم------
*Francais - Hamidullah Le Coran traduction en langue francaise
*The Saheeh International Quran Translation
*English Transliteration
*Amazigh Ramdane At Mansour

إمكانية الإستماع للاية و السورة لمجموعة من القراء
قالب متوافق مع الموبيايل
لغة البرمجة
php

قاعدة بيانات
mysql

التركيب-----

التعديل علي ملف- db.php
للإتصال بقاعدة البيانات-
-$config['host'] = 'localhost';//localhost  السيرفر
-$config['user'] = 'root';//username database إسم مستحدم قاعدة البيانات
-$config['pass'] = '12345678';//password database كلمة سر قاعدة البيانات
-$config['table'] = 'quran1';//name database  إسم قاعدة البيانات


إميل ورابط الموقع

$contact_email ='admin@admin.cc';
$base_url	= "http://quran-search.me";// رابط الموقع

قاعدة البيانات موجودة في مجلد install

مضغوطة
quran1.zip

فك الضغط وازرعها مباشرة عن طريق 
phpmyadmin
او إستعمل الملف


importsql.php

بعد التعديل عليه

// Name of the file
$filename = 'quran1.sql';
// MySQL host عادة  localhost
$mysql_host = 'localhost';
// MySQL username إسم مستخدم قاعدة البيانات
$mysql_username = 'root';
// MySQL password كلمة سر قاعدة البيانات
$mysql_password = '12345678';
// Database name إسم قاعدة البيانات
$mysql_database = 'api_alquran';

مستقبلا 
المزيد من التفاسير 


