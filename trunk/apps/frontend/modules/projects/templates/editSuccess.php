<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('Projects')) ?>
<?php slot('breadcrumbs',
	link_to(__('Projects'), 'projects/index') . ' » ' .
	'TO_DO'
	)
	
	?><h1><?php echo sprintf(__('Edit project'), $project->getTitle())?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('projects/edit?id='. $project->getId()) ?>" method="POST">

<h2><?php echo __('Basic information') ?></h2>

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
         <input type="submit" name="add_deadline" value="<?php echo __('Add deadline') ?>">
      </td>
    </tr>
  </table>
</form>  
