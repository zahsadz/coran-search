<?php
include"db.php";

$search_engine_xml = new browserSearchBox();

$search_engine_xml->set_name(''.$site_title.'');

$search_engine_xml->set_desc(''.$site_desc.'');

$search_engine_xml->set_url(''.$base_url.'/search.php?search_word={searchTerms}');

//$search_engine_xml->set_suggestionsUrl(''.$base_url.'/search_suggestions.php?search={searchTerms}&output=json');

$search_engine_xml->set_formUrl(''.$base_url.'/index.php');

$search_engine_xml->set_icon(''.$base_url.'/images/favicon.ico');

$search_engine_xml->set_xml_header();

print $search_engine_xml->xml_output();
?>
