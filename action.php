<?php
/**
 * GeoNav Action Plugin
 *
 *   
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Tom Cafferty <tcafferty@glocalfocal.com>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) define('DOKU_INC',(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once DOKU_PLUGIN.'action.php';
require_once (DOKU_INC.'inc/parserutils.php');

class action_plugin_geonav extends DokuWiki_Action_Plugin {

    /**
     * Register its handlers with the DokuWiki's event controller
     */
    function register(Doku_Event_Handler $controller) {
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'geonav_hookjs');
    }

    /**
     * Hook js script into page headers.
     *
     * @author Tom Cafferty <tcafferty@glocalfocal.com>
     */
    function geonav_hookjs(&$event, $param) {
        global $INFO;
        global $ID;
        global $conf;
        $basePath = DOKU_BASE;
        $basePath = str_replace("dokuwiki/", "", $basePath);
        $sidebar_ID = "sidebar";
       if (p_get_metadata($sidebar_ID, 'plugin geonav')) { 
            $event->data['script'][] = array(
                            'type'    => 'text/javascript',
                            'charset' => 'utf-8',
                            '_data'   => '',
                            'src'     => "http://www.google.com/jsapi");
            $event->data['script'][] = array(
                            'type'    => 'text/javascript',
                            'charset' => 'utf-8',
                            '_data'   => '',
                            'src'     => $basePath ."lib/plugins/geonav/js/earth_a.js");
            $event->data['script'][] = array(
                            'type'    => 'text/javascript',
                            'charset' => 'utf-8',
                            '_data'   => '',
                            'src'     => $basePath ."lib/plugins/geonav/js/getLocation.js");
       }
    }
}