<script>
$(document).ready(function() {
	$(".del_button").click(function(e) {
       e.preventDefault();
		 var clickedID = this.id.split('-'); //Split ID string (Split works as PHP explode)
		 var DbNumberID = clickedID[1]; //and get number from array
		var myData = 'delcontact='+ DbNumberID;
           $.ajax({
			type: "GET", // HTTP method POST or GET
			url: "includes/del.php", //Where to make Ajax calls
			dataType:"HTML", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
								alert(response);

				//on success, hide  element user wants to delete.
	    $("#trmsg_"+DbNumberID).attr("bgcolor","red");
		$("#trmsg_"+DbNumberID).fadeOut("slow");
				},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});		
		
	});
});
</script> 
 <hr><br /><div align="center">
<table class="table1" width="60%">
<tr class="table_3_title"><td width="19"></td>
<td colspan="4">
رسائل البريد الإلكتروني
</td></tr>
<?php
$db->query("SELECT id,subject,sender,date,readed FROM quran_contactus ORDER BY id DESC");
$altr = '0';
$cp_cpmsgscntctus_query = $db->get();

foreach($cp_cpmsgscntctus_query as $row) {
$altr = $altr+1;
if($altr == "2") {
$color = "#FFFFFF";
$altr = '0';
} else {
$color = "#DDDDDD";
}
?>

<tr id="trmsg_<?php echo $row['id']; ?>" bgcolor="<?php echo $color; ?>">
<td>
<?php
if($row['readed'] == 'yes') {
?>
 <i class="fa fa-envelope-open"></i>

<?php
}else{
?>
<i class="fa fa-envelope"></i>

<?php
}
?>
</td>
<td width="60%">
<a href="index.php?act=contact&show=<?php echo $row['id']; ?>"><?php print $row['subject']; ?></a>
</td><td><?php print $row['sender']; ?><td><?php print $row['date']; ?></td><td width="1">
<a href="#" class="del_button" id="del-<?php echo $row['id']; ?>" style="cursor:pointer;"/>
<i class="fa fa-remove"></i>
</a>
</td></tr>
<?php } ?>
</table></div>
