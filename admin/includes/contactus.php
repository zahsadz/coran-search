<?php
 if (!defined('collo')) {
 header("Location:".$base_url."");
    die("Error: 404 Not Found");
}
?>
<hr><br>
<?php
$gshow = $_GET['show'];
$cp_cntctus_pg_query = $db->query("SELECT * FROM quran_contactus  WHERE id = '$gshow'");
$cp_row = $db->get();
$db->query("UPDATE quran_contactus SET readed = 'yes' WHERE id = '$gshow'");
foreach($cp_row	as $cp_cntctus_pg_row){

?>
 <div align="center"><b><a href="index.php">views all contact</a></b></div>
<br>
<div align="center"><table border="0" class="table_3" width="60%">
<tr class="next"><td width="19">
 <i class="fa fa-mail-reply-all"></i>
</td>
<td align="center"><?php print $cp_cntctus_pg_row['subject']; ?></td>
</tr>
<tr class="nextx">
<td class="cadretop" colspan="2">
 المرسل :<?php print $cp_cntctus_pg_row['sender']; ?> |
 البريد الإلكتروني :<?php print $cp_cntctus_pg_row['email']; ?> |
التاريخ :  <?php print $cp_cntctus_pg_row['date']; ?></td></tr>
<tr><td colspan="2"></td></tr>
<tr><td class="cadrec" colspan="2"><?php print nl2br($cp_cntctus_pg_row['message']); ?></td></tr>
</table></div>
  <div align="center">
  <br><br><br>
 <i class="fa fa-mail-reply-all"></i>
<br><b>رد علي المراسلة </b>
<form id="form" action="index.php?act=remailer" method="post">
<input name="mailto" class='input_login' type="hidden" value="<?php print $cp_cntctus_pg_row['email']; ?>"/><br>
<?php
$adminemail = $contact_email;
?>
<input  name="from" class='input_login' type="hidden" value="<?=$adminemail?>"/> <br>
الموضوع: <input name="subject" class='input_login' type="text" /><br>
نص الرد علي المراسلة: <br><textarea name='body' class='input_body' rows='5' cols='55'></textarea><br>
<br><input type="submit" class='input_login' value="ارسل الرد"/>
</form>
</div>
<?php
}
?>