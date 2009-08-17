<?php /* This content is nearly identical to the one in _command.txt.php 
FIXME: I wonder if it is possible to call a template .txt.php from a .php...
*/ ?>
<?php foreach($checkList->getGroupNames() as $groupname): ?>
<?php if($checkList->getResultsByGroupName($groupname, Check::FAILED)+$checkList->getResultsByGroupName($groupname, Check::WARNING)>0): ?>

# <?php echo $groupname ?>

<?php foreach($checkList->getChecksByGroupName($groupname) as $check): ?>
<?php if ($check->getCommand()!=''): ?>
<?php echo $check->getCommand() ?>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
<?php endforeach ?>
