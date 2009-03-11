<div class="info">
  <h3><?php echo __("Who, when, where, what, why...") ?></h3>
  
  <?php if(!$sf_user->isAuthenticated()): ?>
    <p>
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

   </p>
  <?php else: ?>
   <p>
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

  <?php endif; ?>
  </p>
  
   <?php if(isset($current_user)): ?>
        <?php if ($current_user->getProfile()->getDiskSetHardBlocksQuota()>0): ?>

            <p>
                <?php if($disk_soft_quota_exceeded): ?>
                    <?php echo image_tag("../sfPropelPlugin/images/error") ?>
                <?php else: ?>
                    <?php echo image_tag("../sfPropelPlugin/images/tick") ?>
                <?php endif; ?>
    
                <?php echo __("You are using %percentage%% of your assigned disk space.", array('%percentage%'=>100*$current_user->getProfile()->getDiskUsedBlocks()/$current_user->getProfile()->getDiskSetHardBlocksQuota())) ?>
                <?php echo __("Last check was on %date%.", array('%date%'=>format_datetime($current_user->getProfile()->getDiskUpdatedAt()))) ?>
            </p>
        <?php endif; ?>
    <?php endif; ?>


</div>
