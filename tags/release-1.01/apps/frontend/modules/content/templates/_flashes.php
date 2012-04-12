<?php foreach(array('error', 'notice') as $flashname): ?>
<?php if ($sf_user->hasFlash($flashname)): ?>
  <div class="<?php echo $flashname ?>"><?php echo $sf_user->getFlash($flashname)?></div>
<?php endif; ?>
<?php endforeach ?>