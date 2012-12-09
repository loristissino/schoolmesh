<p>
<?php if(!$sf_user->isAuthenticated()): ?>
      <?php echo __("Soft authentication: ") ?>
      <?php if (isset($softuser)): ?>
          <?php if($softuser->getProfile()->getIsMale()): ?>
              <?php echo __("you were recognized as user <b>%username%</b>  (%fullname%) by means of network logs. <!--male-->", 
              array('%username%'=>$softuser->getUsername(), '%fullname%'=>$softuser->getProfile()->getFullname())) ?>
          <?php else: ?>
              <?php echo __("you were recognized as user <b>%username%</b>  (%fullname%) by means of network logs. <!--female-->", 
              array('%username%'=>$softuser->getUsername(), '%fullname%'=>$softuser->getProfile()->getFullname())) ?>
          <?php endif; ?>
      <?php else: ?>
          <?php echo __('you were not recognized.') ?>
      <?php endif; ?>
      <?php echo link_to(__('You may login'), isset($softuser)? ('profile/index?loginas=' . $softuser->getUsername()) : 'profile/index') ?>

<?php else: ?>
  <?php echo __("Normal authentication: ") ?>
      <?php echo __("you logged in as user <b>%username%</b>  (%fullname%).", 
      array('%username%'=>$sf_user->getUsername(), '%fullname%'=>$sf_user->getProfile()->getFullname())) ?>
      <?php if ((is_object($softuser)&&($sf_user->getUsername()!=$softuser))): ?>
          <?php if($sf_user->getProfile()->getIsMale()): ?>
              <?php echo __("It seems you are a guest of %fullname%. <!--male-->", array('%fullname%'=>$softuser->getProfile()->getFullname())) ?>
          <?php else: ?>
              <?php echo __("It seems you are a guest of %fullname%. <!--female-->", array('%fullname%'=>$softuser->getProfile()->getFullname())) ?>
          <?php endif ?>
      <?php endif; ?>
<?php echo link_to(__('You may logout'), '@sf_guard_signout') ?>
<?php endif ?>
</p>
