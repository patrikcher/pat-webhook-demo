<?php  // MyCircleTest.php
require_once 'Book.php';
 
// Allocate an instance of class MyCircle
$c1 = new Book('1', 'Ball of Confusion: Puzzles, Problems & Perplexing Posers', 'Johnny Ball', 'http://www.syndetics.com/index.aspx?isbn=1848313489/mc.gif&client=natlibsingapore&upc=&oclc=751745070', 'http://catalogue.nlb.gov.sg/cgi-bin/spydus.exe/ENQ/EXPNOS/BIBENQ?BRN=14285559', 'review', 'https://nlbbot-webhook.herokuapp.com/rsc/BallOfConfusion.mp3');  // Test constructor
 
// Try different ways of printing an object
var_dump($c1);
print_r($c1);
var_export($c1);
echo "\n";
 
echo "title is: {$c1->getTitle()}\n";
$c1->setTitle('hello there');
echo "$c1\n";
 
$c2 = new Book();
echo "$c2\n";
 
echo "Done.\n";
?>