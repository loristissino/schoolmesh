<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs', 'TODO'
	)
	
	?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'plansandreports/list' => "Manage appointments",
    '_workplan' => $event->getAppointment(),
    '_event' => __('Event %event_id%', array('%event_id%'=>$event->getId()))
    ),
  'current'=> __('Edit event'),
  ))
?>    
<h1><?php echo __('Edit event')?></h1>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('plansandreports/editwpevent?id='. $event->getId()) ?>" method="post">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>

