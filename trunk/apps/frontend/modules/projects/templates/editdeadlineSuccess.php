<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_helper('Javascript') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php slot('title', __('Projects')) ?>
<?php slot('breadcrumbs',
	link_to(__('Projects'), 'projects/index') . ' » ' .
	'TO_DO' . ' » ' .
  'TO_DO'
	)
	
	?><h1><?php echo sprintf(__('Edit deadline'), $deadline->getDescription())?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('projects/editdeadline?id='. $deadline->getId()) ?>" method="POST" <?php if($form->isMultipart()) echo 'enctype="multipart/form-data"' ?>>

<h2><?php echo __('Basic information') ?></h2>

  <table>
  <?php if(!isset($form['original_deadline_date'])): ?>
  <tr>
    <th><label for="proj_deadline_original_deadline_date"><?php echo __('Original deadline date') ?></label></th>
    <td><?php echo Generic::datetime($deadline->getOriginalDeadlineDate('U')) ?></td>
  </tr>
  <?php endif ?>
  <?php if(!isset($form['description'])): ?>
  <tr>
    <th><label for="proj_deadline_description"><?php echo __('Description') ?></label></th>
    <td><?php echo $deadline->getDescription() ?></td>
  </tr>
  <?php endif ?>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
</form>

<h2><?php echo __('Attachments') ?></h2>

<?php if(sizeof($attachments)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Type') ?></th>
      <th class="sf_admin_text"><?php echo __('File name') ?></th>
      <th class="sf_admin_text"><?php echo __('Size') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($attachments as $attachment): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php include_component('filebrowser', 'mimetype', array('mimetype'=>$attachment->getInternetMediaType())) ?></td>
      <td><?php echo $attachment->getOriginalFileName() ?></td>
      <td><?php echo $attachment->getFileSize() ?></td>
      <td>
      <ul class="sf_admin_td_actions">
      <li class="sf_admin_action_download"><?php echo link_to(
				__('Download'),
				url_for('content/attachment?id='. $attachment->getId())
				)
			?>
			</li>
      </ul>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('No attachments.') ?></p>
<?php endif ?>
