<?php
define('ADMIN_FILE', true);
require_once("../db.php");
			

if(!$_SESSION['myusername']){
header("location:login.php");
} else{
$db->query("SELECT `Value` FROM `quran_general` WHERE `Name` = 'admin_username'");
$hllowuser = $db->get('Value');
$siteurl=  $base_url;
######################################
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $site_title;?></title>
<link rel="stylesheet" href="../js/bootstraprtl/css/bootstrap-rtl.min.css" type="text/css" />
<link rel="stylesheet" href="../js/font-awesome/css/font-awesome.min.css">
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>

</head>
<body>
  <!-- Begin Wrapper -->
<div class="container">
           <!-- Begin Header -->
         <div id="header">
 <h1><a href="<?php echo $base_url?>/admin/index.php"><?php echo $site_title;?></a></h1>
 
     &nbsp;&nbsp; <?php echo $hllowuser;?>
	 </div>
		 <!-- End Header -->
       		 <!-- Begin Navigation -->
         <div id="navigation">

<div class="topmenu"> <a target=_blank href="<?php echo $base_url?>">رئيسية الموقع</a>&nbsp;|&nbsp;
<a href="index.php">قراءة البريد</a>&nbsp;|&nbsp;
<!-- <a href="index.php?act=settings">الإعدادات</a>&nbsp;|&nbsp; -->
<a href="index.php?act=account">تغير كلمة سر الإدارة</a>&nbsp;|&nbsp;
<a href="index.php?act=error_log" class="toprightlink"> قراة سجل الاخطاء</a>&nbsp;|&nbsp;
<a href="index.php?act=Logout">تسجيل الخروج</a>
</div>
		 </div>
		 <!-- End Navigation -->
	
	 <!-- Begin Right Column -->
		 <div id="rightcolumn">
	<?php
	
$act = isset($_GET['act']) ? $_GET['act'] : 1;
	
 switch($act){
    case '1':
 include ("includes/contact.php");
        break;
		case 'contact':
		 include ("includes/contactus.php");
		break;
		case 'del':
		 include ("includes/del.php");
		break;
    case 'remailer':
		 include ("includes/remailer.php");
		break;
		case 'account':
		 include ("includes/account.php");
		break;
		case 'Logout':
		 include ("includes/Logout.php");
		break;
	default:
  include ("includes/contact.php");
   break;		
 }	
	
	/*
	
           if(!isset($_GET["act"])){
              include ("includes/contact.php");
          }
          
     if (isset($_GET["act"]) == "contact"){
		 include ("includes/contactus.php");
	 }
     elseif (isset($_GET["act"]) == "remailer"){
		 include ("includes/remailer.php");
	 }
     elseif (isset($_GET["act"]) == "account") {
		 include ("includes/account.php");
	 }
      elseif (isset($_GET["act"]) == "Logout") {
		  include ("includes/Logout.php");
	  }
        elseif (isset($_GET["act"]) == "settings"){
			include ("includes/settings.php");
		}
       elseif (isset($_GET["act"]) == "error_log"){
		   include ("includes/error_log.php");
	   }
*/
   ?>


 </div>
		 <!-- End Right Column -->


	 <!-- Begin Footer -->
		 <div id="footer">

<p style="text-align: center">
&nbsp;&nbsp;Powered by <a href="<?php echo $base_url?>" title=""><?php echo $site_title;?></a> &copy; <?php echo date('Y', time()); ?> All rights reserved.

</p>

	     </div>
		 <!-- End Footer -->

   </div>
   <!-- End Wrapper -->
</body>
</html>
<?php } ?>