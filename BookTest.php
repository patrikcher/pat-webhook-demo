<?php
require_once 'Book.php';

$book = new Book('1', 'Ball of Confusion: Puzzles, Problems & Perplexing Posers', 'Johnny Ball', 'http://www.syndetics.com/index.aspx?isbn=1848313489/mc.gif&client=natlibsingapore&upc=&oclc=751745070', 'http://catalogue.nlb.gov.sg/cgi-bin/spydus.exe/ENQ/EXPNOS/BIBENQ?BRN=14285559', 'review', 'https://nlbbot-webhook.herokuapp.com/rsc/BallOfConfusion.mp3');

$book2 = new Book('1','2','3','4','5','6','7');

var_dump($book);
print_r($book);
var_export($book);
echo "\n";

var_dump($book2);
print_r($book2);
var_export($book2);
echo "\n";

?>