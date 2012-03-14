<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'appointmenttypes/index' => __('Appointment types'),
    ),
  'current'=>__('Appointment type «%description%»', array('%description%'=>$AppointmentType))
  ))
?>

<table>
  <tbody>
    <tr>
      <th><?php echo __('Id') ?>:</th>
      <td><?php echo $AppointmentType->getId() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Description') ?>:</th>
      <td><?php echo $AppointmentType->getDescription() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Shortcut') ?>:</th>
      <td><?php echo $AppointmentType->getShortcut() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Rank') ?>:</th>
      <td><?php echo $AppointmentType->getRank() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Is active') ?></th>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getIsActive())) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Info?') ?></th>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasInfo())) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Modules?') ?></th>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasModules())) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Tools?') ?></th>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasTools())) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Attachments?') ?></th>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasAttachments())) ?></td>
    </tr>
  </tbody>
</table>

<hr />

<h2><?php echo __('General information') ?></h2>

<?php if(sizeof($WpinfoTypes) and !$AppointmentType->getHasInfo()): ?>
  <div class="warning">
  <?php echo image_tag('dubious') ?>
  <?php echo __('This appointment type has some info, but should not.') ?>
  </div>
<?php endif ?>

<?php if(!sizeof($WpinfoTypes) and $AppointmentType->getHasInfo()): ?>
  <div class="warning">
  <?php echo image_tag('dubious') ?>
  <?php echo __('This appointment type does not have info, but should.') ?>
  </div>
<?php endif ?>



<?php foreach($WpinfoTypes as $WpinfoType): ?>
  <?php include_partial('wpinfotypes/information', array('WpinfoType'=>$WpinfoType)) ?>
<?php endforeach ?>

<hr />

<ul class="sf_admin_actions">
  <?php echo li_link_to_if(
    'action_edit',
    true,
    __('Edit'),
    url_for('appointmenttypes/edit?id=' . $AppointmentType->getId()),
    array('title'=>__('Edit this appointment type'))
  )?>
</ul>

