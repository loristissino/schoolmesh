<?php foreach($syllabus_contributions->getRawValue() as $ref=>$contribution): ?>
<?php $symbol=$contribution==1?'◪' : '▣' ?><?php echo 	$symbol ?>&nbsp;<?php echo $ref ?>&nbsp;&nbsp;
<?php endforeach ?>
