<?php
require_once 'Book.php';

$book = new Book('1', 'Ball of Confusion: Puzzles, Problems & Perplexing Posers', 'Johnny Ball', 'http://www.syndetics.com/index.aspx?isbn=1848313489/mc.gif&client=natlibsingapore&upc=&oclc=751745070', 'http://catalogue.nlb.gov.sg/cgi-bin/spydus.exe/ENQ/EXPNOS/BIBENQ?BRN=14285559', 'review', 'https://nlbbot-webhook.herokuapp.com/rsc/BallOfConfusion.mp3');

var_dump($book);
print_r($book);
var_export($book);
echo "\n";

?>