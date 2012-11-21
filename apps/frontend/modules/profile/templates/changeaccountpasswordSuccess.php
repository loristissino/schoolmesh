<?php if(!isset($account)): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'profile' => __('My profile'),
    'profile/editprofile' => __('SchoolMesh main account'),
    ),
  'current'=>__('Password change'),
  ))
?>  
<?php else: ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'profile' => __('Profile'),
    'profile/viewaccount?type='. $account->getAccountType()->getName() => $account
    ),
  'current'=>__('Password change'),
  ))
?>  
<?php endif ?>

<form action="<?php echo url_for('profile/changeaccountpassword') ?>" method="post">
  <?php echo $form['type']->render() ?>
  <table>
    <tr>
      <th>
        <?php echo $form['current_password']->renderLabel() ?>
      </th>
      <td>
        <?php echo $form['current_password']->renderError() ?>
        <?php echo $form['current_password']->render(array('class'=>'input capLocksCheck')) ?>
        <br />
        <span id="capsLockNotice" style="display: none">
          <?php include_partial('content/dubious', array('text'=>__('Caps lock is on'), 'with_text'=>true)) ?>
        </span>
      </td>
    </tr>
    <?php echo $form['password']->renderRow() ?>
    <?php echo $form['password_again']->renderRow() ?>
    
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Change password') ?>">
      </td>
    </tr>
  </table>

<?php use_javascript('capslockdetector.js') ?>
<?php use_javascript('jquery.pstrength-min.1.2-'  . sfConfig::get('sf_default_culture') . '.js') ?>
<?php use_javascript('password_strength.js') ?>

