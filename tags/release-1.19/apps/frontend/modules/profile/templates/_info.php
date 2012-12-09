<div class="info">
  <h3><?php echo __('Noticeboard') ?></h3>
  <?php if(sfConfig::get('app_authentication_soft_authentication_enabled', false)): ?>
    <?php include_partial('profile/soft_authentication', array('softuser'=>$softuser)) ?>
  <?php else: ?>
    <?php include_partial('profile/normal_authentication', array()) ?>
  <?php endif ?>
  <?php if($sf_user->getProfile()): ?>
    <?php include_partial('profile/noticeboardchecks') ?>
  <?php endif ?>
		
    
</div>
