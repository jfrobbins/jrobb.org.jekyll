<?php
header('Content-Type: image/png'); 
require_once("includer.php");
mtrand_seed();

$usecolor=get_param("color");
$xlen=get_param("xlen");
$ylen=get_param("ylen");

if (!($xlen)) $xlen=512;
if (!($ylen)) $ylen=512;

//this code is from: http://www.boallen.com/random-numbers.html
// Requires the GD Library
$im = imagecreatetruecolor($xlen, $ylen)
    or die("Cannot Initialize new GD image stream");

if (!($usecolor)) {    
  $color = imagecolorallocate($im, 255, 255, 255);
}
for ($y=0; $y<$ylen; $y++) {
    for ($x=0; $x<$xlen; $x++) {
      if ($usecolor) { 
        $color = imagecolorallocate($im, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
        imagesetpixel($im, $x, $y, $color);
      } else {
        if (mt_rand(0,1) === 1) {
            imagesetpixel($im, $x, $y, $color);
        }
      }
    }
}		
imagepng($im);
imagedestroy($im);
?>
