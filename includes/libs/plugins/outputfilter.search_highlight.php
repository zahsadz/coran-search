<?php
/*
 * Smarty plugin
 *
 * File:     outputfilter.search_highlight.php
 * Type:     output filter
 * Name:     search_highlight
 * Purpose:  Automatically highlights search keywords when a user is redirect
 *            by Google to your web pages.
 * Install:  Drop into plugin directory, then use load_filter() to manually
 *            load plugin into Smarty, or setting the $autoload_filters
 *            variable.
 */
require_once $smarty->_get_plugin_filepath('modifier', 'google_highlight');

function smarty_outputfilter_search_highlight($tpl_output, &$smarty)

{
    // check if we have anything on HTTP_REFERER
    $referrer = getenv('HTTP_REFERER');
    if (!empty($referrer)) {
        $pieces = parse_url($referrer);
        // only highlight search keywords if the user
        // is coming from google.com
        if (stristr($pieces['host'], 'google.com')) {
            $params = explode('&', $pieces['query']);
            $query = array();
            foreach ($params as $param) {
                list($key, $value) = explode('=', $param);
                $query[$key] = urldecode($value);
            }
            // only do something if we have actual
            // search keywords to play with
            if (!empty($query['q'])) {
                $tpl_output = smarty_modifier_google_highlight($tpl_output,
                                                               $query['q']);
            }
         }
    }
    return $tpl_output;
}
?>
