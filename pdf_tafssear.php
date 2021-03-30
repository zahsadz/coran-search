<?php
if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
if(!ini_get('zlib.output_compression') && function_exists('ob_gzhandler'))ob_start('ob_gzhandler'); else ob_start();
}
include("db.php");
include_once 'includes/globales.php';

// if (empty($_GET['type'])) {
//$act = intval(1);
 // }else if(isset($_GET['type'])) {
//$act = intval($_GET['act']);
//$act = intval($_GET['type']);
//$ayaID = intval($_GET['aya']);
//$SuraID = intval($_GET['sura']);
 //}
 $ayaID = intval($_GET['aya']);
 $SuraID = intval($_GET['sura']);
 $type = intval($_GET['type']);

$alsura = sorah($SuraID);
$alaya = al_aya($ayaID,$SuraID);


switch($_GET['type']){
	 case '1':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_katheer');
		$tafseer_title = 'تفسير إبن كثير';
		$direction='rtl';
		break;
    case '2':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_muyassar');
		$tafseer_title = 'التفسير الميسر';
		$direction='rtl';
		break;
	 case '3':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_jalalayn');
	   $tafseer_title = 'تفسير الجلالين';
	   $direction='rtl';
        break;		
    case '4':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_fr_hamidullah');
		$tafseer_title = 'Francais - Hamidullah Le Coran traduction en langue francaise ';
		$direction='ltr';
        break;
	case '5':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_en_sahih');
	   $tafseer_title = 'The Saheeh International Quran Translation';
	   $direction='ltr';
        break;
    case '6':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_en_transliteration');
	   $tafseer_title = 'English Transliteration';
	   $direction='ltr';
        break;
	    case '7':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ber_mensur');
	   $tafseer_title = 'Amazigh Ramdane At Mansour';
	   $direction='ltr';
        break;
	    case '8':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_sa3dy');
	   $tafseer_title = 'تفسير السعدي';
	   $direction='rtl';
        break;	
		case '9':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_e3rab');
	   $tafseer_title = 'إعراب القرأن الكريم';
	   $direction='rtl';
        break;
		case '10':
       $tafseer =  altafsire($ayaID,$SuraID,'tfs_ar_baghawy');
	   $tafseer_title = 'تفسير البغوي ';
	   $direction='rtl';
        break;
	default:
       $tafseer =  altafsire($ayaID,$SuraID,'ar_muyassar');
	   $tafseer_title = 'التفسير الميسر';
	   $direction='rtl';
        break;		
 }
 
   $el_tafseer = htmlspecialchars_decode($tafseer, ENT_QUOTES);
   $el_tafseer = strip_tags($el_tafseer);
    
define ('K_PATH_CACHE',dirname(__FILE__).'/cache/');
define ('K_PATH_IMAGES', dirname(__FILE__).'/images/');
define ('PDF_HEADER_LOGO', 'quran.png');
define ('PDF_HEADER_LOGO_WIDTH', 25);
define ('K_BLANK_IMAGE', '_blank.png');
define ('PDF_PAGE_FORMAT', 'A4');
/**
 * Page orientation (P=portrait, L=landscape).
 */
define ('PDF_PAGE_ORIENTATION', 'P');
define ('PDF_HEADER_STRING', "by Nicola Asuni - Tecnick.com\www.tcpdf.org");
/**
 * Document unit of measure [pt=point, mm=millimeter, cm=centimeter, in=inch].
 */
define ('PDF_UNIT', 'mm');

require_once('tcpdf/tcpdf.php');
	set_time_limit(0);
	@ini_set("max_execution_time", 1000);
	@ini_set("default_socket_timeout", 240);
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 018');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');



define ('PDF_HEADER_TITLE', ''.$tafseer_title.'');
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$l['a_meta_language'] = 'ar';
// TRANSLATIONS --------------------------------------
$l['w_page'] = 'صفحة';
// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
// set LTR direction for english translation
$pdf->setRTL(true);
// set font
//$pdf->SetFont('bahijjannab', '', 18);
//$pdf->SetFontSize(10);
$pdf->Ln();
// add a page
$pdf->AddPage();

$htmlpsura = '
<style>
   h1 {
		color: navy;
		font-family: amiri;
		font-size: 24pt;
	}
	.first {
		color: navy;
		font-family: amiri;
		font-size: 22px;
		line-height: 65px;
		word-wrap: break-word;
	}  
    </style>
<h1 class="title">'.$tafseer_title.' <i style="color:#990000"></i></h1>

<div class="first">';
$htmlpsura .= $alaya[0]['text'].'<br>';       
$htmlpsura .= $el_tafseer;       
 $htmlpsura .='</div>';
$pdf->WriteHTML($htmlpsura, true, 0, true, 0);
// reset pointer to the last page
//$pdf->lastPage(); 
//Close and output PDF document

	// save PDF to a local file
	/*$f = fopen($name, 'wb');
		if (!$f) {
			echo'Unable to create output file: '.$name;
		}
		fwrite($f, $this->getBuffer(), $this->bufferlen);
	  fclose($f);*/
$pdf->Output(''.$SuraID.'.pdf', 'I');
//$pdf->Output(''.sura_versesura($SuraID).'.pdf', 'D');
//$pdf->Output('example_052333.pdf', 'F');
//$pdf->Output('example_052333.pdf', 'S');
?>

