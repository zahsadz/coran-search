<?php
include("../db.php");

if(isset($_POST['login'])){

$db->query("SELECT `Value` FROM `quran_general` WHERE `Name` = 'admin_password'");
$passwords_1 = $db->get('Value');
$username_ok = strip_tags($_POST['username']);
$password_ok  = strip_tags($_POST['password']);

$passwords = crypt(md5($password_ok),md5($username_ok));

if($passwords_1 == $passwords){
$_SESSION['myusername'] = $username_ok;
$_SESSION['mypassword'] = $password_ok;
header("Location: " . $base_url ."/admin/index.php");
		exit();
	} else {
      session_start();
       session_destroy();
		header("Location: " .$base_url . "/admin/login.php?error=wrongpassword");
		exit();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin login</title>
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/theme/jquery-ui-1.8.2.custom.css" />
<style>
h4 { margin-left:80px }
</style>
</head>
<body>
<div class="header">
<h1>الإدارة</h1>
</div>
<?php
/*
echo'<center><h2>Admin Login</h2>';
if($_GET['error'] == "wrongpassword") {
	echo 'Wrong password, sorry.<br><br><br><a href="' .$base_url . '/admin/login.php">back</a>';
} else {
	echo 'Please login to access the admin area.<br /><br /><form name="login" method="post" action="login.php">
Admin username:<br />
<input type="text" name="username" value=""><br />
Admin Password:<br />
<input type="password" name="password" value=""><br />
<input type="submit" name="login" value="Login" style="margin-top: 10px; margin-bottom:10px;">
</form>';
}
echo'</center>';
*/
?>



<?php
if(isset($_GET['error'])== "wrongpassword"){
	echo '<div class="error" style="margin-top: 100px; margin-bottom:10px;" align="center"><p>Wrong password, sorry.<br><br><br><a href="' .$base_url . '/admin/login.php">back</a></p></div>';
} else {
echo'';
}
 ?>


<div id="login-container">

<h4>تسجيل الدخول للوحة التحكم</h4>
<form  method="post" action="login.php">

 <fieldset>
<p>
	<label for="user">إسم المدير</label><input type="text" id="username" name="username" class="ui-corner-all"  />

</p>
<p>
<label for="password">كلمة السر</label><input type="password" id="password" name="password"   class="ui-corner-all"/>

</p>    <input type="submit" name="login" value="دخول" class="ui-state-default ui-corner-all button" />
 </fieldset>


</form>

</div>
 </body>
</html>
