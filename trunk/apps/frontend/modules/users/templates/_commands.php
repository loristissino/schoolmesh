<?php /* This content is nearly identical to the one in _command.txt.php 
FIXME: I wonder if it is possible to call a template .txt.php from a .php...
*/ ?>
<?php foreach($userlist as $current_user): ?>
<?php if($current_user->getCountFailedChecks()>0): ?>

# Commands concerning <?php echo $current_user ."\n" ?>
<?php foreach($current_user->getChecks() as $check): ?>
<?php if ($check->getCommand()): ?>
<?php echo $check->getCommand() . "\n" ?>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
<?php endforeach ?>