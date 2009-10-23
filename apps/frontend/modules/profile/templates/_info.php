<div class="info">
  <h3><?php echo __("Who, when, where, what, why...") ?></h3>
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
        <?php echo link_to(__('You may login'), '@sf_guard_signin') ?>

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

<?php /*
		<br /><?php echo sprintf(__('Your last action was at: %s'), Generic::datetime($sf_user->getProfile()->getLastActionAt('U'), $sf_context)) ?>
*/ ?>
  <?php endif; ?>
  </p>
  <?php /*
   <?php if(isset($current_user)): ?>
        <?php if ($current_user->getProfile()->getDiskSetHardBlocksQuota()>0): ?>

            <p>
                <?php if($disk_soft_quota_exceeded): ?>
                    <?php echo image_tag('error', array('alt'=>__('failed'))) ?>
                <?php else: ?>
                    <?php echo image_tag('tick', array('alt'=>__('passed'))) ?>
                <?php endif; ?>
    
                <?php //echo __("You are using %percentage%% of your assigned disk space.", array('%percentage%'=>100*$current_user->getProfile()->getDiskUsedBlocks()/$current_user->getProfile()->getDiskSetHardBlocksQuota())) ?>
                <?php //echo __("Last check was on %date%.", array('%date%'=>format_datetime($current_user->getProfile()->getDiskUpdatedAt()))) ?>
            </p>
        <?php endif; ?>
    <?php endif; ?>
*/ ?>

</div>
