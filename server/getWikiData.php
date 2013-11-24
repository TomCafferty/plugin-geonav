<?php
function pullInWikiData ($dokuPageId, $namespace, $topic) {
    global $conf;
    if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../../../').'/');
    require (DOKU_INC . 'inc/init.php');
    require_once (DOKU_INC . 'inc/parserutils.php');
    p_set_metadata('issue:sidebar_right', array('plugin_geonav_page'=>$dokuPageId));
    $file = wikiFN($dokuPageId);
    $data = io_readWikiPage($file, $dokuPageId, $rev=false);
    $html = p_render('xhtml',p_get_instructions($data),$info);
    return $html;
}
?>