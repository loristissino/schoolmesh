<p>
<?php if(sizeof($syllabus_contributions->getRawValue())>0): ?>
<?php foreach($syllabus_contributions->getRawValue() as $ref=>$contrib): ?>
<?php include_partial('syllabi/contribution', array('contribution'=>array('contribution'=>$contrib['contribution'], 'title'=>$ref . ' ' . $contrib['content']))) ?>&nbsp;<?php echo $ref ?><?php if($contrib['evaluation']): ?>&nbsp;<strong>(<?php echo $contrib['evaluation'] ?>)</strong><?php endif ?> 
<?php endforeach ?>
<?php else: ?>
<?php echo __('No syllabus link defined.') ?>
<?php endif ?>
</p>
