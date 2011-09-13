<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/activities' =>__("Activities"),
    '_project' => $project,
    ),
  'current'=>__('New activity'),
  'title'=>__('New activity within the project «%project%»', array('%project%'=>$project->__toString()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('projects/' . $action . '?id=' . $resource->getId()) ?>" method="post">

  <table>
  <tr>
    <th><label for="schoolproject_resource"><?php echo __('Resource') ?></label></th>
    <td><?php echo $resource->getDescription() ?></td>
  </tr>
  <tr>
    <th><label for="schoolproject_charged_user"><?php echo __('Charged user') ?></label></th>
    <td><?php echo $resource->getChargedUserProfile() ?>
    <?php if($action!='addacknowledgedactivity' and $resource->getChargedUserId()!=$sf_user->getProfile()->getId()): ?>
    <?php echo image_tag(
      'dubious',
      array(
        'title'=>__('You are not in charge for this task')
        )
      ) ?>
    <?php endif ?>
    </td>
  </tr>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>