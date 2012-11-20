<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php use_javascript('jquery.ui.datepicker-' . $sf_user->getCulture() . '.js') ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    'projects/edit?id=' . $resource->getSchoolproject()->getId() => __('Project «%project%»', array('%project%'=>$resource->getSchoolproject()->__toString())),
    ),
  'current'=>__('Resource #%id%', array('%id%'=>$resource->getId()))
    )
  )
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('projects/editresource?id='. $resource->getId()) ?>" method="POST">

<h2><?php echo __('Basic information') ?></h2>

  <table>
  <?php if(!isset($form['description'])): ?>
  <tr>
    <th><label for="resource_description"><?php echo __('Description') ?></label></th>
    <td><?php echo $resource->getDescription() ?></td>
  </tr>
  <?php endif ?>
  <?php if(!isset($form['proj_resource_type_id'])): ?>
  <tr>
    <th><label for="resource_type"><?php echo __('Resource type') ?></label></th>
    <td><?php echo $resource->getProjResourceType()->getDescription() ?></td>
  </tr>
  <?php endif ?>
  <?php if(false): // FIXME !isset($form['proj_resource_quantity_estimated'])): ?>
  <tr>
    <th><label for="resource_quantity"><?php echo __('Qty estimated ('. $resource->getProjResourceType()->getMeasurementUnit() .')') ?></label></th>
    <td><?php echo $resource->getQuantityEstimated() ?></td>
  </tr>
  <?php endif ?>
  <?php if($resource->getSchoolproject()->getState() >= Workflow::PROJ_SUBMITTED):?>
  <tr>
    <th><label for="resource_amount_estimated"><?php echo __('Amount est. ('. sfConfig::get('app_config_currency_symbol') .')') ?></label></th>
    <td><?php echo $resource->getAmountEstimated() ?></td>
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

<?php if(!$sf_user->getAttribute('back')=='budget'): ?>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_new">
	<?php echo link_to(
				__('Back to the project'),
				url_for('projects/details?id='. $resource->getSchoolprojectId()) . '#resources',
				array('title'=>__('Get back to the project')) 
				)?>
</li>
</ul>

<?php endif ?>

