<?php
require_once ('getWikiData.php');              
require_once ('getContinent.php');
require_once ('getErrors.php');

// get county and page
$countryCode=$_GET["q"];
$topic=$_GET["p"];

// get Continent
list ($continent, $country) = getContinent($countryCode);

$html = '<h1> '.ucwords($topic).'</h1>';
$html .= '<h2 class="indent">' . $country . '</h2>';
$countryCode = strtolower($countryCode);
$namespace = $topic;
$path = $topic . ':earth:' . $continent . ':' . $countryCode;
$wikiData = pullInWikiData($path, $namespace, $topic);
if ($wikiData != '') 
  $html .= $wikiData;
else 
  $html .=  '<p>'. htmlentities($exploreErrors['editPg']['en'], ENT_NOQUOTES) . htmlentities($exploreErrors['ckBack']['en'], ENT_NOQUOTES) .'</p> ';
$html  .= '<br /><p><a href="doku.php?id='.$path.'"><input type="button" class="button" value="Go to Edit" title="Go To Edit" /></a></p>';
$html .= htmlentities($exploreErrors['update']['en'], ENT_NOQUOTES);

echo $html;

?>