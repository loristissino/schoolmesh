<?php if($breadcrumpstype=='projects/monitoring/emailtocoordinator'): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' => __("Projects management"),
    'projects/monitorview?id=' . $project->getId() => $project
    ),
  'current'=>__("Send an email"),
  'title'=>__('Send an email to the coordinator of this project'),
  ))
?>
<?php endif ?>
<?php if($breadcrumpstype=='projects/project/resource/emailtoactivityperformer'): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    'projects/edit?id=' . $project->getId() => $project,
    'projects/viewresourceactivities?id= ' . $resource->getId() => $resource
    ),
  'current'=>__("Send an email"),
  'title'=>__('Send an email to the person who performed this activity'),
  ))
?>
<?php endif ?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('projects/email?id='. $project->getId()) ?>" method="POST">

  <table>
  <tr>
    <th><label for="email_to"><?php echo __('To') ?></label></th>
    <td><?php echo sprintf('%s &lt;%s&gt;', $message->getToName(), $message->getToAddress()) ?></td>
  </tr>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Send') ?>">
      </td>
    </tr>
  </table>
</form>  
