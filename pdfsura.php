<?php
if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
if(!ini_get('zlib.output_compression') && function_exists('ob_gzhandler'))ob_start('ob_gzhandler'); else ob_start();
}
	set_time_limit(0);
	@ini_set("max_execution_time", 1000);
	@ini_set("default_socket_timeout", 240);

include("db.php");
 if (empty($_GET['sura'])) {
 $act = intval(1);
  }else if(isset($_GET['sura'])) {
 $SuraID = intval($_GET['sura']);
 }
 
$quran_sorah=quran_sorah($SuraID);
$quran_table_Sura=quran_table_Sura($SuraID);
$site_title='سورة'.sura_name($SuraID).'';
//define ('K_PATH_MAIN', '');
define ('K_PATH_CACHE',dirname(__FILE__).'/cache/');
define ('K_PATH_IMAGES', dirname(__FILE__).'/images/');
define ('PDF_HEADER_LOGO', 'icon.png');
define ('PDF_HEADER_LOGO_WIDTH', 25);
define ('K_BLANK_IMAGE', '_blank.png');
define ('PDF_PAGE_FORMAT', 'A4');
/**
 * Page orientation (P=portrait, L=landscape).
 */
define ('PDF_PAGE_ORIENTATION', 'P');
define ('PDF_HEADER_TITLE', ''.$site_title.'');
define ('PDF_HEADER_STRING', "by Nicola Asuni - Tecnick.com\www.tcpdf.org");
/**
 * Document unit of measure [pt=point, mm=millimeter, cm=centimeter, in=inch].
 */
define ('PDF_UNIT', 'mm');

require_once('includes/tcpdf/tcpdf.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 018');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
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
		font-family: xbniloofar;
		font-size: 22px;
		line-height: 65px;
		word-wrap: break-word;
	}  
    </style>
<h1 class="title">'.$site_title.' <i style="color:#990000"></i></h1>
<div class="first">';
 foreach ($quran_table_Sura as $row){
	$htmlpsura .=$row['text'].' ('.$row['aya'].') '; 
       }
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
$pdf->Output(''.sura_versesura($SuraID).'.pdf', 'I');
//$pdf->Output(''.sura_versesura($SuraID).'.pdf', 'D');
//$pdf->Output('example_052333.pdf', 'F');
//$pdf->Output('example_052333.pdf', 'S');
?>

