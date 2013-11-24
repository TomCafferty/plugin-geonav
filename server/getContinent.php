<?php
function getContinent($countryCode2) {
   require_once ('default.php');              

   $continents = array(
  'AF' =>  "africa",
  'AS' =>  "asia",
  'EU' =>  "europe",
  'NA' =>  "north-america",
  'SA' =>  "south-america",
  'OC' =>  "oceania",
  'AN' =>  "antarctica");
  
   //
   // Connect to the database
   //
   $db = sqlite_open('../db/test.sqlite', 0666, $error);
   if (!$db) {
      $renderer->doc .= '<div class="error"> The database error is '. $error .'</div>';
	  return FALSE;
   }
   // Get continent
   $query = "SELECT * FROM continents WHERE code_2 = '".$countryCode2."'";
   $result = sqlite_query($db, $query);
   if (!$result) {
       $renderer->doc .= '<div class="error"> Cannot execute query. </div>';
       return FALSE;
   }
   $row = sqlite_fetch_array($result, SQLITE_ASSOC);
   sqlite_close($db);
   $str = $continents[$row['continent']];
   $contName = str_replace(array("&lt;", "&gt;"), array("<", ">"), htmlentities($str, ENT_NOQUOTES));
   $ctryName = $row['short_name'];
   return array ($contName, $ctryName);
}

function convToFile($string) {
  $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
  $search  = array('_', ' ', '^');
  $replace = array('-', '-', '');
  $string = str_replace($search, $replace, $string);
  $string = ereg_replace("[^A-Za-z0-9-]", "", $string);
  $string = strtolower($string);
  return $string;
}
?>