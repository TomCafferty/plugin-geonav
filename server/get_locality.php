<?php
require_once ('getWikiData.php');              
require_once ('getContinent.php');
require_once ('getErrors.php');

$locality = $_GET["locality"];

if ($locality != 'undefined') {
  $countyCode=$_GET["county"];
  $q=$_GET["q"];
  if (($countyCode != 'undefined' || $locality != $q) && 
      ($countyCode != $locality )) {  
      $countryCode=$_GET["ctry"];
      $topic=$_GET["p"];
      //
      // get Continent
      list ($continent, $country) = getContinent($countryCode);

      $html = '<h1> '.ucwords($topic).'</h1>';
      $html .=  '<h2 class="indent">' . $locality . '</h2>';

      $locality = convToFile($locality);
      $county   = convToFile($countyCode);
      $region   = convToFile($q);
      $countryCode = strtolower($countryCode);
      
      $namespace = $topic;
      $path = $topic . ':earth:' . $continent . ':' . $countryCode . ':' . $region . ':' . $county . ':' . $locality;
  
      $wikiData = pullInWikiData($path, $namespace, $topic);
      if ($wikiData != '') 
        $html .= $wikiData;
      else 
        $html .=  '<p>'. htmlentities($exploreErrors['editPg']['en'], ENT_NOQUOTES) . htmlentities($exploreErrors['ckBack']['en'], ENT_NOQUOTES) .'</p> ';
      $html  .= '<br /><p><a href="doku.php?id='.$path.'"><input type="button" class="button" value="Go to Edit" title="Go To Edit" /></a></p>';
      $html .= htmlentities($exploreErrors['update']['en'], ENT_NOQUOTES);
  } else
    $html = '<p>'. $exploreErrors['noMore']['en'] .'</p>'; 
} else 
  $html = '<p>'. $exploreErrors['mtBotm']['en'] .'</p>';
 
echo $html;
?>