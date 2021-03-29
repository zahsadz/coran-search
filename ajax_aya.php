<?php
include('db.php');
if($_POST['id'])
{
$id=$_POST['id'];
$sql="select ayat_count from quran_surah_names where id='$id'";
$db->query($sql);
$db->setFetchMode(2);
$result = $db->get();
foreach($result as $row)
{
$data = $row['ayat_count']+1;
for ($i = 1; $i < $data ; $i++) {
echo '<option value="'.$i.'" >'.$i.'</option>';
}
}
}
?>
