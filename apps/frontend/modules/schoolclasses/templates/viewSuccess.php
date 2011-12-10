<?php if($breadcrumpstype=='/plansandreports/appointment/class'): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => __('Plans and Reports'),
    'plansandreports/fill?id=' . $appointment->getId() => $appointment
    ),
  'current'=>__('Class composition'),
  'title'=>$schoolclass_id . ' (' . $appointment->getSubject() . ') - ' . __('class composition')
  ))
?>
<?php endif ?>
<?php if($breadcrumpstype=='/schoolclasses'): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '_schoolclasses' => __('Classes'),
    ),
  'current'=>$schoolclass_id
  ))
?>
<?php endif ?>

<?php if(sizeof($enrolments)>0): ?>

<?php if(isset($appointment)): ?>
	<form action="<?php echo url_for('schoolclasses/batch?id=' . $schoolclass_id . '&appointment=' . $appointment->getId()) ?>" method="get">
<?php endif ?>

<?php include_partial('content/flashes'); ?>

<table cellspacing="0">
  <thead>
    <tr>

<?php if(isset($appointment)): ?>
	  <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
<?php endif ?>

      <th class="sf_admin_text"><?php echo __('Number') ?></th>
      <th class="sf_admin_text"><?php echo __('Gender') ?></th>
      <th class="sf_admin_text"><?php echo __('First name') ?></th>
      <th class="sf_admin_text"><?php echo __('Last name') ?></th>
      <th class="sf_admin_text"><?php echo __('Pronunciation') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($enrolments as $enrolment): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
	
<?php if(isset($appointment)): ?>
		<td>
    <?php if($enrolment->getsfGuardUser()->getIsActive() && !$appointment->getTeamId() or ($appointment->getTeamId() and in_array($enrolment->getsfGuardUser()->getId(), $teamcomponents->getRawValue()))): ?>
  <input type="checkbox" name="ids[]" value="<?php echo $enrolment->getsfGuardUser()->getId() ?>" class="sf_admin_batch_checkbox" <?php echo in_array($enrolment->getsfGuardUser()->getId(), $ids->getRawValue()) ? "checked='checked'": '' ?>"/>
    <?php endif ?>
</td>
<?php endif ?>

      <td<?php if(!$enrolment->getsfGuardUser()->getIsActive()) echo ' class="notcurrent"' ?>><?php echo $i ?></td>
      <td><?php include_partial('users/gender', array('gender'=>$enrolment->getsfGuardUser()->getProfile()->getGender())) ?></td>
      <td><?php echo $enrolment->getsfGuardUser()->getProfile()->getFirstName() ?></td>
      <td><?php echo $enrolment->getsfGuardUser()->getProfile()->getLastName() ?></td>
      <td><?php echo $enrolment->getsfGuardUser()->getProfile()->getPronunciation() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>  
</table>  

<?php if(isset($appointment)): ?>

<?php include_partial('plansandreports/checkalljs') ?>
 <ul class="sf_admin_actions">
      <li class="sf_admin_batch_actions_choice">
  <select name="batch_action">

<?php echo optionsforselect(array(
  '0' => __('Choose an action'),
  'fillrecuperationgrid' => __('Fill recuperation grid'),
  'getrecuperationletters' => __('Get recuperation letters'),
  'getschoolregisterheading' => __('Get teacher\'s school register headings'),
), 0) ?>
  </select>

<?php echo submittag(_('Ok')) ?>

</li>

</ul>


</ul>


</form>

<?php endif ?>



<?php endif ?>


