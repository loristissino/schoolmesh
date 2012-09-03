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

  <table>
    <?php echo $form['current_password']->renderRow() ?>
    <?php echo $form['password']->renderRow() ?>
    <?php echo $form['password_again']->renderRow() ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Change password') ?>">
      </td>
    </tr>
  </table>


<?php use_javascript('jquery.pstrength-min.1.2-'  . sfConfig::get('sf_default_culture') . '.js') ?>
<?php use_javascript('password_strength.js') ?>

