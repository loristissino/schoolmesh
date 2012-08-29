<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'profile/index' =>__('My profile')
    ),
  'current'=>__('Edit security information'),
  ))
?>

<?php include_partial('content/flashes'); ?>

  <table>
	<?php if(sfConfig::get('app_authentication_2fa_enabled', false)): ?>
	<tr>
		<th><label><?php echo __('2fa') ?></label></th>
		<td>
			<?php if($sec && $sec->getInitializationKey()): ?>
        <?php echo __('Two-factor authentication currently enabled.') ?><br />
        <?php echo link_to(__('Get your smartphone configured'), url_for('profile/authenticator')) ?>
      <?php else: ?>
        <?php echo __('Two-factor authentication currently disabled.') ?>
      <?php endif ?>
		</td>
	</tr>
  <?php else: ?>
	<tr>
		<th><label><?php echo __('2fa') ?></label></th>
		<td>
      <?php echo __('Two-factor authentication is not enabled for this site') ?>
		</td>
	</tr>
	<?php endif ?>
  </table>
  
  <hr />
  
  <h2><?php echo __('Actions') ?></h2>
  <ul class="sf_admin_actions">
    <?php echo li_link_to_if(
    'action_enable2fa',
    sfConfig::get('app_authentication_2fa_enabled', false) && (!isset($sec) || !$sec->getInitializationKey()),
		__('Enable two-factor authentication'),
		'profile/enable2fa',
		array('method' => 'post', 'title'=>__('Enable two-factor authentication for your SchoolMesh account'))
		)?>
    <?php echo li_link_to_if(
    'action_disable2fa',
    sfConfig::get('app_authentication_2fa_enabled', false) && isset($sec) && $sec->getInitializationKey(),
		__('Disable two-factor authentication'),
		'profile/disable2fa',
		array(
      'title'=>__('Disable two-factor authentication for your SchoolMesh account'),
      'method' => 'post',  
      'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()) . ' ' . __('You will need to reconfigure all your mobile devices if you disable and then re-enable two-factor authentication.'),
      )
		)?>
  </ul>

