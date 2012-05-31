<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'plansandreports/list' => "Manage appointments",
    '_workplan' => $appointment,
    ),
  'current'=> __('Add event'),
  ))
?> 

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('plansandreports/addwfevent?appointment='. $appointment->getId()) ?>" method="post">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>

