<?php 

// output of 1 pixel transparent/colored gif   

// some Headers to prevent caching   

Header( "Content-type:  image/gif");   
Header( "Expires: Wed, 01 Jan 1995 11:11:11 GMT");   
Header( "Cache-Control: no-cache");   
Header( "Cache-Control: must-revalidate");   

// if # is in front of the hex-string 
$rgb = str_replace("#", "", $_GET['color']);   

$r = hexdec(substr ($rgb, 0,2)); 
$g = hexdec(substr ($rgb, 2,2)); 
$b = hexdec(substr ($rgb, 4,2)); 

if($_GET['color']){ 
printf ("%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c% 
c%c%c%c%c%c%c", 
71,73,70,56,57,97,1,0,1,0,128,0,0,$r,$g,$b,0,0,0,44,0,0,0,0,1,0,1,0,0,2,2,68,1,0,59);   
} 
else{ 
printf ("%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c% 
c%c%c%c%c%c%c%c%c%c%c%c%c%c%", 
71,73,70,56,57,97,1,0,1,0,128,255,0,192,192,192,0,0,0,33,249,4,1,0,0,0,0,44,0,0,0,0,1,0,1,0,0 
,2,2,68,1,0,59);   
} 
