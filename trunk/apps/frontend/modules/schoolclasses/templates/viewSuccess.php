<?php if($breadcrumpstype=='/plansandreports/appointment/class'): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => __('Plans and Reports'),
    'plansandreports/fill?id=' . $appointment->getId() => $appointment
    ),
  'current'=>__('Class composition'),
  'title'=>sprintf('%s (%s) - %s', $schoolclass_id, $appointment->getTitle(), __('class composition'))
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

<?php include_partial('content/flashes'); ?>


<?php if(isset($appointment)): ?>
	<form action="<?php echo url_for('schoolclasses/batch?id=' . $schoolclass_id . '&appointment=' . $appointment->getId()) ?>" method="get">
<?php endif ?>


<table cellspacing="0">
  <thead>
    <tr>

<?php if(isset($appointment)): ?>
	  <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
<?php endif ?>
      <th class="sf_admin_text"><?php echo __('Number') ?></th>
<?php if(isset($appointment)): ?>
    <th class="sf_admin_text"></th>
<?php endif ?>
<?php if(sfConfig::get('app_gravatar_use')): ?>
    <th class="sf_admin_text"><?php echo __('Avatar') ?></th>
<?php endif ?>
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
    <input type="checkbox" name="ids[]" value="<?php echo $enrolment->getsfGuardUser()->getId() ?>" class="sf_admin_batch_checkbox" <?php echo in_array($enrolment->getsfGuardUser()->getId(), $ids->getRawValue()) ? "checked='checked'": '' ?>"/>
    </td>
<?php endif ?>

    <?php if(!$enrolment->getsfGuardUser()->getIsActive()): ?>
      <td class="notcurrent" style="text-align:right"><abbr title="<?php echo format_number_choice(__('[0]Looks like %studentname% is not enrolled anymore|[1]Looks like %studentname% is not enrolled anymore', array('%studentname%'=>$enrolment->getsfGuardUser()->getProfile()->getFullName())), null, $enrolment->getsfGuardUser()->getProfile()->getIsMale()) ?>"><?php echo $i ?></abbr></td>
    <?php else: ?>
      <td style="text-align:right"><?php echo $i ?></td>
    <?php endif ?>

<?php if(isset($appointment)): ?>
		<td>
    <?php if($appointment->getTeamId() and in_array($enrolment->getsfGuardUser()->getId(), $teamcomponents->getRawValue())): ?>
    <?php echo image_tag('selectable', array(
      'title'=>__('%name% belongs to the team your appointment is set for', array('%name%'=>$enrolment->getsfGuardUser()->getProfile()->getFullName())),
      'size'=>'16x16'
      ))
    ?>
    <?php endif ?>
    </td>
<?php endif ?>
      <?php if(sfConfig::get('app_gravatar_use')): ?>
          <td><?php include_component('profile', 'gravatar', array('profile'=>$enrolment->getsfGuardUser()->getProfile(), 'size'=>16)) ?></td>
      <?php endif ?>
      <td><?php include_partial('users/gender', array('gender'=>$enrolment->getsfGuardUser()->getProfile()->getGender())) ?></td>
      <td><?php echo $enrolment->getsfGuardUser()->getProfile()->getFirstName() ?></td>
      <td><span class="lastname"><?php echo $enrolment->getsfGuardUser()->getProfile()->getLastName() ?></span></td>
      <td><?php echo $enrolment->getsfGuardUser()->getProfile()->getPronunciation() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>  
</table>  

<?php if(isset($appointment) && $appointment->getAppointmentType()->getHasModules()): ?>

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


<hr />
<h2><?php echo __('Other actions concerning this class') ?></h2>
<ul class="sf_admin_actions">
<?php echo li_link_to_if('action_view', true, __('List appointments'), url_for('schoolclasses/appointments?id='.$schoolclass_id)) ?>
<?php echo li_link_to_if('action_users', $sf_user->hasCredential('users'), __('Find these people in users management module'), url_for('users/list?query=roster:'.$schoolclass_id)) ?> 
</ul>
