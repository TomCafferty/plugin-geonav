<?php
/**
 * GeoNav Plugin
 *
 *  Provides a google earth map
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  Tom Cafferty <tcafferty@glocalfocal.com>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) define('DOKU_INC',(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_geonav extends DokuWiki_Syntax_Plugin {

    function getInfo() {
        return array(
            'author' => 'Tom Cafferty',
            'email'  => 'tcafferty@glocalfocal.com',
            'date'   => '2011-12-29',
            'name'   => 'geonav',
            'desc'   => 'Integrate google map with dokuwiki for navigation',
            'url'    => 'http://www.dokuwiki.org/plugin:geonav'
        );
    }
    /**
     * What kind of syntax are we?
     */
  function getType(){
      return 'substition';
  }

  function getPType(){
      return 'block';
  }
  
    /**
     * Where to sort in?
     */
  function getSort(){
      return 160;
  }
  
  /**
   * Connect pattern to lexer
   */
  function connectTo($mode) {
      $this->Lexer->addSpecialPattern('<geonav>.*?</geonav>',$mode,'plugin_geonav');
  }

  /**
   * Handle the match
   */
  function handle($match, $state, $pos, Doku_Handler $handler){
      parse_str($match, $return);   
      return $return;
  }
 
  /**
   *  Render output
   */
  function render($mode, Doku_Renderer $R, $data) {
      global $INFO;
      global $conf;
      require_once(DOKU_PLUGIN.'geonav/lang/en/lang.php');


      // store meta info for this page
      if($mode == 'metadata'){
        $R->meta['plugin']['geonav'] = true;
        return true;
      }

      if($mode != 'xhtml') return false;
      $path  = $INFO['id'];
      $topic = str_replace ( ':earth', '', $path);

      $R->info['cache'] = false; // no cache please
      $R->doc .= '<div id="home"><div id="map3d" class="mymap" ></div>';
          $R->doc .= '<input id="location" type="text" value=" " class="ui-input-field">';
          $R->doc .= '<button id="focus-btn" type="button" class="focusBtn">'.$lang['focus_btn'].'</button>';
          $R->doc .= '<div id="userInput">'.$lang['focus'].'</div>';
      $R->doc .= '</div>';
      $R->doc .= $this->_script($topic);
        
	  return true;
  }
    
  function _script($category){
        $str = '<script type="text/javascript" language="javascript">';
        $str .= 'var plugin_geonav_category = "'.$category.'";';
        $str .= '</script>';
        return $str;
  }
  
}
