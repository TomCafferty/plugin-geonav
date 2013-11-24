<?php
require_once ('getWikiData.php');              
require_once ('getContinent.php');
require_once ('getErrors.php');

$countyCode=$_GET["county"];
if ($countyCode != 'undefined') {
  $countryCode=$_GET["ctry"];
  $q=$_GET["q"];
  $topic=$_GET["p"];
  //
  // get Continent
  list ($continent, $country) = getContinent($countryCode);

  $html = '<h1> '.ucwords($topic).'</h1>';
  $html .= '<h2 class="indent">' . $countyCode . '</h2>';

  $county = convToFile($countyCode);
  $region = convToFile($q);
  $countryCode = strtolower($countryCode);
  $namespace = $topic;
  $path = $topic . ':earth:' . $continent . ':' . $countryCode. ':' . $region . ':' . $county;
  
  $wikiData = pullInWikiData($path, $namespace, $topic);
  if ($wikiData != '') 
    $html .= $wikiData;
  else 
      $html .=  '<p>'. htmlentities($exploreErrors['editPg']['en'], ENT_NOQUOTES) . htmlentities($exploreErrors['ckBack']['en'], ENT_NOQUOTES) .'</p> ';
  $html  .= '<br /><p><a href="doku.php?id='.$path.'"><input type="button" class="button" value="Go to Edit" title="Go To Edit" /></a></p>';
  $html .= htmlentities($exploreErrors['update']['en'], ENT_NOQUOTES);
  
} else {
  $html = '<p>'. $exploreErrors['unDefn']['en'] .'</p>';
}
  
  echo $html;

?>