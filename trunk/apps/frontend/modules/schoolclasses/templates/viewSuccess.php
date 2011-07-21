<?php use_helper('Schoolmesh') ?>
<?php slot('title', $schoolclass_id) ?>
<?php slot('breadcrumbs',
	link_to(__('Classes'), 'schoolclasses/index') . ' » ' . 
	$schoolclass_id
	)
	
	?>
	<h1><?php echo sprintf(__('Class %s'), $schoolclass_id) ?></h1>

<?php if(sizeof($enrolments)>0): ?>

<?php if(isset($appointment)): ?>
	<p><?php echo $appointment->getSubject()->getDescription() ?>
	<form action="<?php echo url_for('schoolclasses/batch?id=' . $schoolclass_id . '&appointment=' . $appointment->getId()) ?>" method="get">
<?php endif ?>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

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
  <input type="checkbox" name="ids[]" value="<?php echo $enrolment->getsfGuardUser()->getId() ?>" class="sf_admin_batch_checkbox" <?php echo in_array($enrolment->getsfGuardUser()->getId(), $ids->getRawValue()) ? "checked='checked'": '' ?>"/>
</td>
<?php endif ?>

      <td><?php echo $i ?></td>
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
  '' => __('Choose an action'),
  'fill_recuperation_grid' => __('Fill recuperation grid'),
  'get_recuperation_letters' => __('Get recuperation letters'),
), 0) ?>
  </select>

<?php echo submittag(_('Ok')) ?>

</li>

</ul>


</ul>


</form>

<?php endif ?>



<?php endif ?>


