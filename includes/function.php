<?php  if (!defined('collo')) {
header("Location:index.php");
die("Error: 404 Not Found");
}
// Select recit.
$recitations = '1';
if (!empty($_GET["recit"])) { 
$_SESSION['recit'] = $_GET["recit"];
    }
if (empty($_SESSION["recit"])) {
    $_SESSION["recit"] = '1';
}
$recitations = $_SESSION["recit"];
function get_micro_time()
{
list($microsec, $sec) = explode(" ", microtime());
return ((float)$microsec + (float)$sec);
}
function get_exec_time($end, $start)
{
return round($end - $start, 5);
}
$exec_start = get_micro_time();
function soranames_en(){
global $db;
$db->query("SELECT id,descent FROM quran_surah_names");
$db->setFetchMode(2);
$result = $db->get();
$list ='';
foreach($result as $row)
{
$id=$row['id'];
$data=$row['descent'];
$list .='<option value="'.$id.'">'.$data.'</option>';
}
return $list;
}
function soranames(){
global $db;
$db->query("SELECT id,name FROM quran_surah_names");
$db->setFetchMode(2);
$result = $db->get();
$list ='';
foreach($result as $row)
{
$id=$row['id'];
$data=$row['name'];
$list .='<option value="'.$id.'">'.$data.'</option>';
}
return $list;
}
function NOW()
	{
		return date('Y-m-d H:i:s', time());
	}
############
require(''.ABSPATH.'/includes/libs/SmartyBC.class.php');
$smarty = new SmartyBC;
$smarty->template_dir =ABSPATH.'/templates/'.$theme;
$smarty->compile_dir =ABSPATH.'/templates_c';
$smarty->cache_dir = ABSPATH.'/cache';
include("".ABSPATH."/includes/readers.php");
require_once("".ABSPATH."/includes/class.browserSearchBox.php");
$xml_url =  _get_root_url().'alquran-opensearch.php';
$search_engine_xml = new browserSearchBox($xml_url);
$output_js = $search_engine_xml->output_js();
$search_engine_xml=$search_engine_xml->output_link($site_title);
##################################
$smarty->assign('search_engine_xml',$search_engine_xml);
$smarty->assign('output_js',$output_js);
$smarty->assign('base_url',$base_url);
$smarty->assign('template',$theme);
$smarty->assign('Default_Search_Term',$Default_Search_Term);
$smarty->assign('soranames_en',soranames_en());
##########
function string_limit_words($string, $word_limit) {
$words = explode(' ', $string);
return implode(' ', array_slice($words, 0, $word_limit));
}
function SeoTitleEncode($s) {
  $c = array (' ','-','/','\\',',','.','#',':',';','\'','"','[',']','{',
      '}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

//$s = str_replace($c, '-', $s);
 $s = str_replace($c, '+', $s);
  $s = preg_replace(
        array('/-+/',
              '/-$/',
              '/-ytmsinternsignature/'),
        array('-',
              '',
              'ytmsinternsignature') ,
        $s);
  return $s;
}
function sound_check_sora_rd($sora){
global $readers_sora;
$sora_number = strlen($sora);
$s_number = count($readers_sora);
if($sora_number==1){
$number = '00'.$sora.'';
}elseif($sora_number==2){
$number = '0'.$sora.'';
}elseif($sora_number==3){
$number = $sora;
}
$s = '';
$s .='<form class="form" role="form">';
$s .= '<select class="form-control" id="reciter_ayates" style="width:60%;" onchange="updateplayer()">';
for($i=1; $i<$s_number+1; $i++){
$pathfile = ''.$readers_sora[$i][2].'/'.$number.'.mp3';
$s .= '<option value="'.$pathfile.'">'.$readers_sora[$i][0].'-'.$readers_sora[$i][3].'</option>';
}
$s .="</select></form>";
return $s;
}
function sound_check_aya_rd($sora,$aya){
global $readers_ayat;
$s_number = count($readers_ayat);
$sora_number = strlen($sora);
$aya_number = strlen($aya);
$s = '';
if($sora_number==1){
$s1 = '00'.$sora.'';
}elseif($sora_number==2){
$s1 = '0'.$sora.'';
}elseif($sora_number==3){
$s1 = $sora;
}
if($aya_number==1){
$s2 = '00'.$aya.'';
}elseif($aya_number==2){
$s2 = '0'.$aya.'';
}elseif($aya_number==3){
$s2 = $aya;
}
$s .='<form class="form" role="form">';
$s .= '<select class="form-control" id="reciter_ayates" style="width:60%;" onchange="updateplayer()">';
for($i=1; $i<$s_number+1; $i++){
$pathfile = ''.$readers_ayat[$i][2].'/'.$s1.''.$s2.'.mp3';
$s .= '<option value="'.$pathfile.'">'.$readers_ayat[$i][0].'-'.$readers_ayat[$i][3].'</option>';
}
$s .="</select></form>";
return $s;
}
function mp3player($url){

$script = '<audio id="player" controls="controls">
  <source id="mp3ppl" src="'.$url.'" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
';
return $script;
}

function sound_check_aya($sora,$aya){
global $readers_ayat,$recitations;

$sora_number = strlen($sora);
$aya_number = strlen($aya);
$s = '';
if($sora_number==1){
$s1 = '00'.$sora.'';
}elseif($sora_number==2){
$s1 = '0'.$sora.'';
}elseif($sora_number==3){
$s1 = $sora;
}

if($aya_number==1){
$s2 = '00'.$aya.'';
}elseif($aya_number==2){
$s2 = '0'.$aya.'';
}elseif($aya_number==3){
$s2 = $aya;
}

$pathfile = ''.$readers_ayat[$recitations][2].'/'.$s1.''.$s2.'.mp3';
$s .= mp3player($pathfile);

return $s;
}
function sound_check_sora($sora,$reciter_sorah){
global $readers_sora;

$sora_number = strlen($sora);

if($sora_number==1){
$number = '00'.$sora.'';
}elseif($sora_number==2){
$number = '0'.$sora.'';
}elseif($sora_number==3){
$number = $sora;
}

$pathfile = ''.$readers_sora[$reciter_sorah][2].'/'.$number.'.mp3';
$sora = '';
$sora .= mp3player($pathfile);
return $sora;
}

function writehistory ($search)
  { global $db;
  	//Update Tags
	if($search != ""):

      if(!is_numeric($search)):
           $result_total = "SELECT count(*) AS total FROM quran_history WHERE Query='".$search."'";
		   $db->query($result_total);
           $db->setFetchMode(2);
           $check = $db->get('total');
           if($check == 0):
             $db->query("INSERT INTO quran_history VALUES (NULL, '".$search."', '1','1')");
           else:
           if(!isset($_GET["page"])):
         $db->query("UPDATE quran_history SET tcount=tcount+1 WHERE Query='".$search."'");
            endif;
           endif;
         endif;
	endif;

  }
function redirect($location, $type="header")
{
if ($type == "header"):
header("Location: ".$location);
else:
echo "<script type='text/javascript'>document.location.href='".$location."'</script>\n";
endif;
}
function gen_tag($tags) {
if($tags != ""):
	$tag_links = '';
	$x = explode(' ', $tags);
	if (count($x) > 0) {
		foreach ($x as $k => $v) {
$tag_links .= "".$v.",";
		}
	} else {
		$tag_links = "";
	}
	return trim($tag_links, ",");
	endif;	
}
 function showhistory($num){
       global $db;	//Update Tags
// $sql4="SELECT * FROM `quran_history` WHERE active ='1' ORDER BY ".$db->random." DESC LIMIT ".$num."";
 $sql4="SELECT * FROM `quran_history` WHERE active ='1' ORDER BY rand() DESC LIMIT ".$num."";
 $db->query($sql4);
 $rs4 = $db->get();
    $i= 0;
    $return_amount = $num;
     $mtags = '';
  foreach ($rs4 as $row) {
     //print_r($row );
    $search =$row['Query'];
   	$color_array = array('danger', 'secondary','success', 'info', 'warning','primary');
 	shuffle($color_array);
	$font_color = $color_array[0];
   $mtags .='<span><a class="badge badge-'.$font_color.'" href="'.ABSURL.'/search.php?search_word=' .SeoTitleEncode($search). '&method=2" title="'. $search .'">' .$search. '</a></span>';
 if ($i + 1 < $return_amount){
  $mtags .= ',';
    }
    ++$i;
    }
   return rtrim($mtags, ",");
   }
$smarty->assign ("listen_form",listen_form($recitations,'ar'));
function listen_form($recitations,$Lang){
global $readers_ayat,$recitations;
$Lang = 'ar';
$s_number = count($readers_ayat);

$s = '';
$s .= '<select size="1" name="recit" id="recit" style="width:100%;">';
for($i=1; $i<$s_number+1; $i++){

if($Lang == 'ar'){
$names = $readers_ayat[$i][0];
$title = ''.$readers_ayat[$i][0].' '.$readers_ayat[$i][4].'';
}else{
$names = $readers_ayat[$i][1];
$title = ''.$readers_ayat[$i][1].' '.$readers_ayat[$i][4].'';
}

if($recitations==$i){
$s .= '<option value="'.$i.'" title="'.$title.'" selected>'.$names.'-'.$title.'</option>';
}else{
$s .= '<option value="'.$i.'" title="'.$title.'">'.$names.'-'.$title.'</option>';
}
}
$s .= '</select>';
return $s;
}
?>
