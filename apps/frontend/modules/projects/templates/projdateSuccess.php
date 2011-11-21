<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' => __("Projects monitoring"),
    ),
  'current'=>__("Set date"),
  'title'=>__("Date setting")
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<p>
<?php if($action=='setapprovaldate'): ?>
<?php echo __('You are setting the approval date for the following projects:') ?>
<?php elseif($action=='setfinancingdate'): ?>
<?php echo __('You are setting the financing date for the following projects:') ?>
<?php elseif($action=='setconfirmationdate'): ?>
<?php echo __('You are setting the confirmation date for the following projects:') ?>
<?php endif ?>
</p>
<ul>
<?php foreach($projects as $project): ?>
  <li><?php echo $project ?></li>
<?php endforeach ?>
</ul>

<form action="<?php echo url_for('projects/'. $action) ?>" method="post">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>
