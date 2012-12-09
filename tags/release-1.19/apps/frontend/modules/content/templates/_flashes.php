<?php foreach(array('error', 'notice') as $flashname): ?>
<?php if ($sf_user->hasFlash($flashname)): ?>
  <div class="<?php echo $flashname ?>"><?php echo __($sf_user->getFlash($flashname))?></div>
<?php endif; ?>
<?php endforeach ?>
<?php if($sf_user->hasFlash('passwordcheck')): ?>
<div class="passwordcheck"><?php echo $sf_user->getFlash('passwordcheck') ?> - <?php echo link_to(__('You may proceed here'), url_for('@changepassword')) ?>.</div>
<?php endif ?>
