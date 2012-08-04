<?php include_partial('content/breadcrumps', array(
  'current'=>__('Logout'),
  ))
?>
<?php $sf_user->setFlash('helpmodule', 'authentication') ?>

<p><?php echo __('You successfully logged out from SchoolMesh.') ?></p>

<?php if($sso_logout): ?>
<p><?php echo __('Please note that if you logged in other applications using SchoolMesh\'s single sign-on, you will need to logout separately, by following the links below (or just by closing your browser).') ?></p>

<ul class="sf_admin_actions">
  <?php foreach($apps as $app): ?>
<?php echo li_link_to_if(
    'action_' . $app['css'],
    true,
    $app['name'],
    $app['logout_url'],
    array(
      'title'=>__('Logout from %application%', array('%application%'=>$app['name'])) . ' ' . __('(opens in a new window)'),
      'popup'=>true,
      ) 
    ) ?>
  <?php endforeach ?>
</ul>

<?php endif ?>
