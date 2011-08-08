<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php //use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    ),
  'current'=>__('New project')
  ))
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('projects/new') ?>" method="POST">

<h2><?php echo __('Basic information') ?></h2>

  <table>
  <?php if(!isset($form['title'])): ?>
  <tr>
    <th><label for="schoolproject_title"><?php echo __('Title') ?></label></th>
    <td><?php echo $project->getTitle() ?></td>
  </tr>
  <?php endif ?>
  <?php if(!isset($form['description'])): ?>
  <tr>
    <th><label for="schoolproject_description"><?php echo __('Description') ?></label></th>
    <td><?php echo $project->getDescription() ?></td>
  </tr>
  <?php endif ?>
  <?php if(!isset($form['hours_approved'])): ?>
  <tr>
    <th><label for="schoolproject_hours_approved"><?php echo __('Hours approved') ?></label></th>
    <td><?php echo $project->getHoursApproved() ?></td>
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

