<?php
   require_once ('getErrors.php');
   require_once ('getWikiData.php');              
   require_once ('getContinent.php');
   
   // get country and page 
   $q=$_GET["q"];
   $topic=$_GET["p"];

   // get Continent
   list ($continent, $country) = getContinent($q);
   $html = '<h1> '.ucwords($topic).'</h1>';
   $html .= '<h2>' . ucwords($continent) . "</h2>";
   $namespace = $topic;
   $path = $topic . ':earth:' . $continent;
   $wikiData = pullInWikiData($path, $namespace, $topic);
   if ($wikiData != '') 
       $html .= $wikiData;
   else 
       $html .=  '<p>'. htmlentities($exploreErrors['editPg']['en'], ENT_NOQUOTES) . htmlentities($exploreErrors['ckBack']['en'], ENT_NOQUOTES) .'</p> ';
   $html  .= '<br /><p><a href="doku.php?id='.$path.'"><input type="button" class="button" value="Go to Edit" title="Go To Edit" /></a></p>';
   $html .= htmlentities($exploreErrors['update']['en'], ENT_NOQUOTES);
   echo $html;

?>