<?php
$content = "".ABSPATH. "/error_log";
if (!file_exists($content)) {
echo'لا توجد اخطاء بعد';
  }else{
if(is_file(''.ABSPATH.'/error_log')){
    $error_log=array_reverse(file(''.ABSPATH.'/error_log'));
    foreach($error_log as $log){
        preg_match("/\[(\d\d?\-[a-z]{3}\-[\d]{4}\s[\d]{2}:[\d]{2}:[\d]{2})\]/im",$log,$date);
        $error=str_replace($date,'',$log);
        $logs[$error]['dates'][]=$date[1];
    }
    foreach($logs as $error=>$data){
        $dates=$data['dates'];
        $error_count=count($dates);
        $logs[$error]['count']=$error_count;
        if($error_count>2){
            $logs[$error]['dates']=array();
            $logs[$error]['dates'][0]=array_shift($dates);
            $logs[$error]['dates'][1]=array_shift(array_reverse($dates));
        }
    }
}
?>

<table width="100%" border="1" cellpadding="2" cellspacing="2" dir="rtl" class="table" align="center">
  <tr>
    <th width="10%">التاريخ</th>
    <th width="80%">الخطأ</th>
    <th width="10%">العدد</th>
  </tr>
  <?php foreach($logs as $log_details=>$log){  ?>
  <tr>
    <td><?=$log['dates'][0]?><br /><?=$log['dates'][0]?></td>
    <td><?=$log_details?></td>
    <td><?=$log['count']?></tr>
  </tr>
  <? } ?>
</table>
<?php } ?>
