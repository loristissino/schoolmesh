<?php

$font_path="./Arial.ttf";

header ("Content-type: image/png"); 

// imagecreate (x width, y width)
$img_handle = @imagecreatetruecolor (20, 130) or die ("Cannot create image"); 

// ImageColorAllocate (image, red, green, blue)

$color=$_GET['backcolor'];
if($color=='')
	$color='127-127-127'; //default is gray

list($red, $green,$blue)=explode('-', $color);
$back_color = ImageColorAllocate ($img_handle, $red, $green, $blue); 

$color=$_GET['textcolor'];
if($color=='')
	$color='255-255-255'; //default is white

list($red, $green,$blue)=explode('-', $color);
$txt_color = ImageColorAllocate ($img_handle, $red, $green, $blue); 

imagefill($img_handle, 0, 0, $back_color);

$text=$_GET['text'];

imagettftext($img_handle, 10, 90, 15, 127, $txt_color, $font_path, $text);

ImagePng ($img_handle); 
ImageDestroy($img_handle);
