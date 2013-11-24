<?php
require_once ('getWikiData.php');              
require_once ('getContinent.php');
require_once ('getErrors.php');
require_once ('default.php');              

   $countryCode=$_GET["ctry"];
   $q=$_GET["q"];
   $topic=$_GET["p"];
   //
   // get Continent
   list ($continent, $country) = getContinent($countryCode);

   $html = '<h1> '.ucwords($topic).'</h1>';
   $html .= '<h2 class="indent">' . $q . "</h2>";

   $region = convToFile($q);
   $countryCode = strtolower($countryCode);

   //
   // First try to connect to the temporary database
   //
   $db = sqlite_open('../db/'.$tempdb.'.sqlite', 0666, $error);
   if (!$db) {
      $renderer->doc .= '<div class="error"> The database error is '. $error .'</div>';
	  return FALSE;
   } 
   $query = "SELECT * FROM states WHERE state_abbr = '".$q."'";
   $result = sqlite_query($db, $query);
   if (!$result) {
       $renderer->doc .= '<div class="error"> Cannot execute query. </div>';
       return FALSE;
   } 
   $row = sqlite_fetch_array($result, SQLITE_ASSOC); 
   sqlite_close($db);
   $state = $row['state'];
   $id = $row['state_id']; 
      
   $countryCode = strtolower($countryCode);
   $namespace = $topic;
   $path = $topic . ':earth:' . $continent . ':' . $countryCode . ':' . $region;
   $wikiData = pullInWikiData($path, $namespace, $topic);
   if ($wikiData != '') 
       $html .= $wikiData;
   else
       $html .=  '<p>'. htmlentities($exploreErrors['editPg']['en'], ENT_NOQUOTES) . htmlentities($exploreErrors['ckBack']['en'], ENT_NOQUOTES) .'</p> ';
   $html  .= '<br /><p><a href="doku.php?id='.$path.'"><input type="button" class="button" value="Go to Edit" title="Go To Edit" /></a></p>';
   $html .= htmlentities($exploreErrors['update']['en'], ENT_NOQUOTES);
      
   echo $html;
?>