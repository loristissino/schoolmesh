<?php

$lightgreen = 'beebba';
$darkgreen = '1ec10f';
$lightred = 'f6b8be';
$darkred  = 'e41228';
$darkorange = 'ffb733';
$lightorange = 'ffe48d';

//$squares=$max-$min-1;
$mark=($value-1)/($max-$min);

if($mark<0.33) $c=$darkred; elseif($mark<0.5) $c=$darkorange; else $c=$darkgreen;

$width=$value*16;
?>
<?php if(is_numeric($value)): ?>

<?php echo image_tag('phpixel.php?color='.$c,
    array(
      'title'=>sprintf('%2.1f (%d:%d)', $value, $min, $max), 
      'size'=>$width.'x16')
      ) ?>
<?php else: ?>
  <?php echo $value ?>
<?php endif ?>
