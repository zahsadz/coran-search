<?php

/*
browserSearchBox Class
----------------------------------------------------------------------
Copyright (C) 2009 by Mohamed Elkholy.
https://sourceforge.net/projects/browser_search_box/
----------------------------------------------------------------------

* @copyright Mohamed ELkholy 2009
* @link https://sourceforge.net/projects/browser_search_box/
* @author Mohamed ELkholy <mkh117@gmail.com>
* @desc   PHP Class used to add your site to the user browser toolbar search box.
* @package browserSearchBox Class
* @version 1.0 released in 8 june 2009
* @license LGPL
*/

class browserSearchBox {

   /**
   * Contains site name
   *
   * @var string
   * @access private
   */
   private $name;

   /**
   * Contains site description
   *
   * @var string
   * @access private
   */
   private $desc;

   /**
   * Contains search url
   *
   * @var string
   * @access private
   */
   private $url;

   /**
   * Contains search page url
   *
   * @var string
   * @access private
   */
   private $formUrl;

   /**
   * Contains site favicon
   *
   * @var string
   * @access private
   */
   private $icon;

   /**
   * Contains search suggestions url , note: this url must return data in json format
   *
   * @var string
   * @access private
   */
   private $suggestionsUrl;

   /**
   * Contains additional class options
   *
   * @var array
   * @access private
   */
   private $options;

   /**
   * Contains search engine xml data
   *
   * @var string
   * @access private
   */
   private $xml_output;

   /**
   * Contains search engine xml file url
   *
   * @var string
   * @access private
   */
   private $xml_url;

   /**
   * Constructor for initializing the class with default values.
   *
   * @param sting xml file url
   * @return void
   * @access public
   */
   function __construct($xml_url = null) {
      $this->init();
      $this->xml_url = $xml_url;
   }

   /**
   * initializing the class with default values.
   *
   * @param sting xml file url
   * @return void
   * @access public
   */

   private function init() {
      $this->name = "";
      $this->desc = "";
      $this->url = array();
      $this->formUrl = "";
      $this->icon = array();
      $this->suggestionsUrl = array();
      $this->options = array('moz_UpdateUrl' => "",
                             'moz_IconUpdateUrl' => "",
                             'moz_UpdateInterval' => "",
                             'OutputEncoding' => "UTF-8",
                             'InputEncoding' => "UTF-8"
                             );
      $this->xml_output = "";
   }

   /**
   *  used to set class options
   *
   * @param string option id
   * @param string options value
   * @return void
   * @access public
   */

   public function set_opt($opt_id, $opt_value) {
      if (isset ($this->options[$opt_id])) {
         $this->options[$opt_id] = $opt_value;
      }
   }

   /**
   *  used to set site name
   *
   * @param string sitename
   * @return void
   * @access public
   */

   public function set_name($name) {
      $this->name = $name;
   }

   /**
   *  used to set site description
   *
   * @param string site description
   * @return void
   * @access public
   */

   public function set_desc($desc) {
      $this->desc = $desc;
   }

   /**
   *  used to set search url
   *
   * @param string search url
   * @param string request method (GET/POST)
   * @param string request params
   * @return void
   * @access public
   */

   public function set_url($url, $method = "GET", $params = array()) {
      $v = array();
      $v['method'] = $method;
      $v['url'] = $url;
      $v['params'] = $params;
      $this->url = $v;
   }

   /**
   *  used to set search page url
   *
   * @param string search page url
   * @return void
   * @access public
   */

   public function set_formUrl($url) {
      $this->formUrl = $url;
   }

   /**
   *  used to set favicon image
   *
   * @param string favicon image (favicon url / base64 icon data)
   * @param string icon data type default(image/x-icon)
   * @return void
   * @access public
   */

   public function set_icon($data, $type = "image/x-icon") {
      $v = array();
      $v['type'] = $type;
      $v['data'] = $data;
      $this->icon = $v;
   }

   /**
   *  used to set search suggestions url
   *
   * @param string search suggestions url
   * @param string request method (GET/POST)
   * @param string request params
   * @return void
   * @access public
   */

   public function set_suggestionsUrl($url, $method = "GET", $params = array()) {
      $v = array();
      $v['method'] = $method;
      $v['url'] = $url;
      $v['params'] = $params;
      $this->suggestionsUrl = $v;
   }

   /**
   *  set search engine xml data
   *
   * @return void
   * @access private
   */

   private function set_xml() {
      $sep = "\n";
      $xml = array();

      $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';

      $xml[] = '<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/" xmlns:moz="http://www.mozilla.org/2006/browser/search/">';

      $xml[] = '<ShortName>' . $this->html_entities($this->name) . '</ShortName>';

      $xml[] = '<Description>' . $this->html_entities($this->desc) . '</Description>';

      $xml[] = '<Url type="text/html" template="' . $this->html_entities($this->url['url']) . '"  method="' . (($this->url['method'] != "") ? $this->url['method'] : "GET") . '" ' . (sizeof($this->url['params']) > 0 ? '' : '/') . '>';
      if (sizeof($this->url['params']) > 0) {
         foreach ($this->url['params'] as $k => $v) {
            $xml[] = '<Param name="' . $k . '" value="' . $v . '"/>';
         }
         $xml[] = '</Url>';
      }

      $xml[] = '<Url type="application/x-suggestions+json" template="' . $this->html_entities($this->suggestionsUrl['url']) . '"  method="' . (($this->suggestionsUrl['method'] != "") ? $this->suggestionsUrl['method'] : "GET") . '" ' . (sizeof($this->suggestionsUrl['params']) > 0 ? '' : '/') . '>';
      if (sizeof($this->suggestionsUrl['params']) > 0) {
         foreach ($this->suggestionsUrl['params'] as $k => $v) {
            $xml[] = '<Param name="' . $k . '" value="' . $v . '"/>';
         }
         $xml[] = '</Url>';
      }

      $xml[] = '<Image height="16" width="16" type="' . (($this->icon['type'] == "") ? 'image/x-icon' : $this->icon['type']) . '">' . $this->html_entities($this->icon['data']) . '</Image>';

      $xml[] = '<InputEncoding>' . (($this->options['InputEncoding'] != "") ? $this->options['InputEncoding'] : "UTF-8") . '</InputEncoding>';

      $xml[] = '<OutputEncoding>' . (($this->options['OutputEncoding'] != "") ? $this->options['OutputEncoding'] : "UTF-8") . '</OutputEncoding>';

      if ($this->options['moz_UpdateUrl'] != "") {
         $xml[] = '<moz:UpdateUrl>' . $this->html_entities($this->options['moz_UpdateUrl']) . '</moz:UpdateUrl>';
      }

      if ($this->options['moz_IconUpdateUrl'] != "") {
         $xml[] = '<moz:IconUpdateUrl>' . $this->html_entities($this->options['moz_IconUpdateUrl']) . '</moz:IconUpdateUrl>';
      }

      if ($this->options['moz_UpdateInterval'] != "") {
         $xml[] = '<moz:UpdateInterval>' . $this->html_entities($this->options['moz_UpdateInterval']) . '</moz:UpdateInterval>';
      }

      $xml[] = '</OpenSearchDescription>';

      $this->xml_output = implode($sep, $xml);
   }

   /**
   *  encode all applicable characters to HTML entities
   *
   * @param string to be encoded
   * @return void
   * @access private
   */

   private function html_entities($str) {
      //return htmlentities($str, ENT_QUOTES);
     return htmlspecialchars($str, ENT_QUOTES);
   }

   /**
   *  set xml headers
   *
   * @return void
   * @access public
   */

   public function set_xml_header() {
      header('content-type: text/xml;');
   }

   /**
   *  get search engine xml data
   *
   * @return string xml data
   * @access public
   */

   public function xml_output() {
      $this->set_xml();
      return $this->xml_output;
   }

   /**
   * get javascript to add anew search provider to user browser
   *
   * @return string javascript data
   * @access public
   */

   public function output_js() {
      if ($this->xml_url == "") {
         return false;
      }
      $js = "window.external.AddSearchProvider('$this->xml_url');";
      return $js;
   }

   /**
   * get link tag
   *
   * @return string link tag data
   * @access public
   */

   public function output_link($title) {
      if ($this->xml_url == "") {
         return false;
      }
      $link_tag = "\n<link rel=\"search\" type=\"application/opensearchdescription+xml\" href=\"$this->xml_url\" title=\"$title\" />\n";
      return $link_tag;
   }

}

/**
* get root script directory url
*
* @return string url
* @access public
*/
function _get_root_url() {
   $urlparts = explode("/", $_SERVER["PHP_SELF"]);
   $last = sizeof($urlparts) - 1;
   if (!is_dir($_SERVER["PHP_SELF"])) {
      unset ($urlparts[$last]);
      return "http://" . $_SERVER["HTTP_HOST"] . implode("/", $urlparts) . "/";
   }
   return "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"] . "/";
}

?>
