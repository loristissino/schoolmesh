<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('Users'),
    'users/list' => __('List/Search'),
    'users/edit?id=' . $appointment->getsfGuardUser()->getId() . '#appointments' => $appointment->getFullName(),
    '_appointment' => $appointment,
    ),
  'current'=>__('Reassign appointment'),
  'title'=> __('Appointment reassignment'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<p>
<?php echo __('You are going to reassign the appointment «%appointment%», that currently %teachername% is charged with, to another teacher.', array('%appointment%'=>$appointment->__toString(), '%teachername%'=>$appointment->getFullName())) ?><br />
<?php echo __('This action will change the ownership of the workplan/report, but not the events associated with it.') ?> 
<?php echo __('Usually you need to do this when a substition begins or ends.') ?>
</p>

<form action="<?php echo url_for('users/reassignappointment?id='. $appointment->getId()) ?>" method="post">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Reassign') ?>">
      </td>
    </tr>
  </table>
  
</form>

