<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    'projects/edit?id=' . $resource->getSchoolproject()->getId() => $resource->getSchoolproject(),
    ),
  'current'=>__('Resource #%id%', array('%id%'=>$resource->getId()))
    )
  )
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('projects/editresource?id='. $resource->getId()) ?>" method="POST">

<h2><?php echo __('Basic information') ?></h2>

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
</form>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_new">
	<?php echo link_to(
				__('Back to the project'),
				'projects/edit?id='. $resource->getSchoolprojectId(),
				array('title'=>__('Get back to the project')) 
				)?>
</li>
</ul>

