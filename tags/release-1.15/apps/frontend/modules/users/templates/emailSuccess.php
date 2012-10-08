<?php slot('title', __('Email to users')) ?>
<?php slot('breadcrumbs',
	link_to(__('Users'), 'projects/index') . ' » ' .
	'TO_DO'
	)
	
?><h1><?php echo sprintf(__('Send an email to the selected users'))?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('users/email') ?>" method="POST">

  <table>
  <tr>
    <th><label for="email_to"><?php echo __('To') ?></label></th>
    <td>
    
      <?php foreach($userlist as $user): ?>
          <?php echo $user->getFullname() ?>
          <?php if (!$user->getHasValidatedEmail()): ?>
            <span style='color: red'>
            <?php echo __(' (does not have a validated email address)') ?>
            </span>
          <?php else: ?>
            <span style='color: green'>
            <?php echo __('&lt;%email%&gt;', array('%email%'=>$user->getValidatedEmail())) ?>
            </span>
          <?php endif ?>
          <br />
      <?php endforeach ?>
    </td>
  </tr>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
      
          <?php foreach($ids as $id):?>
          <input type="hidden" name="ids[]" value="<?php echo $id ?>" />
          <?php endforeach ?>

         <input type="submit" name="save" value="<?php echo __('Send') ?>">
      </td>
    </tr>
  </table>
</form>  

