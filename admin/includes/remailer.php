<?php
 if (!defined('collo')) {
 header("Location:".$base_url."");
    die("Error: 404 Not Found");
}
?>
 <div align="center">

<p><span class="title">
 <i class="fa fa-mail-reply-all"></i>
رد علي المراسلة</span></p>

   <?php
$mailto = $_POST['mailto'];
$subject = $_POST['subject'];
$body = $_POST['body'];
$from = $_POST['from'];

mail("$mailto","$subject","$body\n","From: $from\n");


echo "<p>تم إرسال الرسالة بنجاح &nbsp;<br>
<b>$from to $mailto</b><br>subject: $subject<br>
message: $body<p>";

?>
</div>

