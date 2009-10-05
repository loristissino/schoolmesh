<?php slot('title', $schoolclass_id) ?>
<?php slot('breadcrumbs',
	link_to(__('Classes'), 'schoolclasses/index') . ' » ' . 
	$schoolclass_id
	)
	
	?>
	<h1><?php echo sprintf(__('Class %s'), $schoolclass_id) ?></h1>


<?php if(sizeof($enrolments)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
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
      <td><?php echo $i ?></td>
      <td><?php include_partial('users/gender', array('gender'=>$enrolment->getsfGuardUser()->getProfile()->getGender())) ?></td>
      <td><?php echo $enrolment->getsfGuardUser()->getProfile()->getFirstName() ?></td>
      <td><?php echo $enrolment->getsfGuardUser()->getProfile()->getLastName() ?></td>
      <td><?php echo $enrolment->getsfGuardUser()->getProfile()->getPronunciation() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>  
</table>  

<?php endif ?>