#!/bin/bash -x
# This script was automatically generated by SchoolMesh at <?php echo date('c') ?>

<?php $oldcontent=''; ?>
<?php foreach($checks as $check): ?>
<?php if($check->getContent()!=$oldcontent && $check->getCommand()): ?>

# Commands concerning <?php echo Generic::decode($check->getContent()) ."\n" ?>
<?php $oldcontent=$check->getContent() ?>
<?php endif ?>
<?php if ($check->getCommand()): ?>
 <?php echo Generic::decode($check->getCommand()) . "\n" ?>
<?php endif ?>
<?php endforeach; ?>
