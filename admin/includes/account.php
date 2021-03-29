<?php
 if (!defined('collo')) {
 header("Location:".$base_url."");
    die("Error: 404 Not Found");
}
?>


<hr width="50%"><br />

<?php

$db->query("SELECT `Value` FROM `quran_general` WHERE `Name` = 'admin_username'");
$guser = $db->get('Value');

$db->query("SELECT `Value` FROM `quran_general` WHERE `Name` = 'admin_password'");
$gpass = $db->get('Value');

if (isset($_POST['do'])) {

if ($guser != $_POST['old_username'])

 $error = "الغسم الحالي غير متطابق";

$old_password =crypt(md5($_POST['old_password']),md5($guser));
 
if ($gpass != $old_password)

$error = "كلمة السر الحالية غير متطابقة";

   if(!$_POST['old_username'])
   if(!$_POST['old_password'])
   
 if(!$_POST['username'])
 if(!$_POST['password'])
 
 if(!$_POST['confirm_password'])

 $error = "من فضلك املأ جميع النمودج";
 
if ($_POST['password'] != $_POST['confirm_password'])
$error = "كلمة السر غير متطابقة";

if ($error == "") {
$password = $_POST['password'];
$username = $_POST['username'];

$username = strip_tags(substr($_POST['username'],0,32));
$password  = strip_tags(substr($_POST['password'],0,32));

$cleanpw = crypt(md5($password),md5($username));

$db->query("UPDATE `quran_general` SET `Value`='".$cleanpw."' WHERE `Name`='admin_password'");
$db->query("UPDATE `quran_general` SET `Value`='".$username."' WHERE `Name`='admin_username'");
echo'<font color="red"><b>تم تغيير معلومات الدخول بنجاح</b></font><br /><br />';
exit();
}else{
echo'<font color="red"><b>'.$error.'</b></font><br /><br />';
}
}
?>

<div id="main" align="center"><form action="index.php?act=account" method="post" class="jNice">
<input type="hidden" value="1" name="do">
<Table width="100%" cellpadding="10"><tr><td valign="top"><b>المعلومات الحالية : </b>
<br />
<tr><td>إسم المدير:</td><td><input type="text" name="old_username" class="text-long"></td></tr>
<tr><td>كلمة السر:</td><td><input type="password" name="old_password" class="text-long"></td></tr>

</td></td></tr><tr><td valign="top">
<b>تغيير إلي : </b><br />

<tr><td>إسم مدير جديد:</td><td><input type="text" name="username" class="text-long"></td></tr>
<tr><td>كلمة السر الجديدة:</td><td><input type="password" name="password" class="text-long"></td></tr>
<tr><td>تاكيد كلمة السر:</td><td><input type="password" name="confirm_password" class="text-long"></td></tr>

</td></tr><tr><td colspan="2" align="center">
<input type="submit" class="button" value="حفظ الإعدادات"></td></tr></table></form>

<br /></div>
