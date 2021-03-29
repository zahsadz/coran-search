<?php
require_once("../../db.php");
if(isset($_GET['delcontact'])) {
$db->query("DELETE FROM quran_contactus WHERE id = '$_GET[delcontact]'");
exit('successful');
}