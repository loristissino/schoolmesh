# <?php echo $syllabus->getName() . "\n" ?>

<?php foreach($syllabus->getSyllabusItems() as $syllabus_item): ?>
<?php if($syllabus_item->getLevel()<=$maxlevel): ?>
<?php echo str_repeat(' ', ($syllabus_item->getLevel()-1)*4) ?>
- <?php if($syllabus_item->getRef()): ?>*<?php echo $syllabus_item->getRef() ?>* - <?php endif ?><?php if(!$syllabus_item->getIsSelectable()): ?>**<?php endif ?><?php echo str_replace('&quot;', "'", Generic::correctString($syllabus_item->getContent())) ?><?php if(!$syllabus_item->getIsSelectable()): ?>**<?php endif ?><?php echo "\n\n" ?>
<?php endif ?>
<?php endforeach ?>
