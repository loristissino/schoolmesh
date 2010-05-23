<?php slot('title', __('Projects')) ?>
<?php slot('breadcrumbs',
	link_to(__('Projects'), 'projects/index') . ' » ' .
	'TO_DO'
	)
	
?><h1><?php echo sprintf(__('Send an email to the coordinator of this project'), $project->getTitle())?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('projects/email?id='. $project->getId()) ?>" method="POST">

  <table>
  <tr>
    <th><label for="email_to"><?php echo __('To') ?></label></th>
    <td><?php echo sprintf('%s &lt;%s&gt;', $message->getToName(), $message->getToAddress()) ?></td>
  </tr>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Send') ?>">
      </td>
    </tr>
  </table>
</form>  
