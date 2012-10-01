<p>
<?php echo __('Authentication: ') ?>
<?php if(!$sf_user->isAuthenticated()): ?>
      <?php echo __('you were not recognized.') ?>
      <?php echo link_to(__('You may login'), 'profile/index') ?>.
<?php else: ?>
      <?php echo __("you logged in as user <b>%username%</b>  (%fullname%).", 
      array('%username%'=>$sf_user->getUsername(), '%fullname%'=>$sf_user->getProfile()->getFullname())) ?>
      <?php echo link_to(__('You may logout'), '@sf_guard_signout') ?>.
<?php endif ?>
</p>
