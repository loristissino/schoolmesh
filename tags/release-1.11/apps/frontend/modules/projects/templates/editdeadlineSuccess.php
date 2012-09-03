<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    'projects/edit?id=' . $deadline->getSchoolproject()->getId() => $deadline->getSchoolproject(),
    ),
  'current'=>__('Deadline of %date%', array('%date%'=>$deadline->getCurrentDeadlineDate('d/m/Y')))
    )
  )
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('projects/editdeadline?id='. $deadline->getId()) ?>" method="POST" <?php if($form->isMultipart()) echo 'enctype="multipart/form-data"' ?>>

<h2><?php echo __('Basic information') ?></h2>

  <table>
  <?php if(!isset($form['user_id'])): ?>
  <tr>
    <th><label for="proj_deadline_original_user"><?php echo format_number_choice(__('[0]Filler|[1]Filler'), null, $deadline->getsfGuardUser()->getProfile()->getIsMale()) ?></label></th>
    <td><?php echo $deadline->getsfGuardUser()->getProfile() ?></td>
  </tr>
  <?php endif ?>
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

<?php if ($deadline->getSchoolproject()->getState()>Workflow::PROJ_DRAFT): ?>
  <?php include_partial('content/attachments', array('attachments'=>$attachments, 'description'=>'Documents concerning this deadline.')) ?>
<?php endif ?>
