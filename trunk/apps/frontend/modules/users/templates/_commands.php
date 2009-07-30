<?php /* This content is nearly identical to the one in _command.txt.php 
FIXME: I wonder if it is possible to call a template .txt.php from a .php...
*/ ?>
<?php $oldcontent=''; ?>
<?php foreach($checks as $check): ?>
<?php if($check->getContent()!=$oldcontent): ?>

# Commands concerning <?php echo $check->getContent() ."\n" ?>
<?php $oldcontent=$check->getContent() ?>
<?php endif ?>
<?php if ($check->getCommand()): ?>
 <?php echo $check->getCommand() . "\n" ?>
<?php endif ?>
<?php endforeach; ?>
