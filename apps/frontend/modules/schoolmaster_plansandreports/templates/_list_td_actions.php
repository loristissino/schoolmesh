<td>
  <ul class="sf_admin_td_actions">
	<?php if($appointment->getState()!=0): ?>
    <li class="sf_admin_action_view">
      <?php echo link_to(__('View'), 'schoolmaster_plansandreports/ListView?id='.$appointment->getId(), array(), 'messages') ?>
    </li>
	<?php endif ?>
<?php if ($appointment->getState()==10 or $appointment->getState()==20): ?>
	<li class="sf_admin_action_approve">
      <?php echo link_to(__('Approve&nbsp;Workplan'), 'schoolmaster_plansandreports/ListApprove?id='.$appointment->getId(), array(), 'messages') ?>
    </li>
    <li class="sf_admin_action_reject">
      <?php echo link_to(__('Reject&nbsp;Workplan'), 'schoolmaster_plansandreports/ListReject?id='.$appointment->getId(), array(), 'messages') ?>
    </li>
<?php endif ?>
<?php if ($appointment->getState()==50 or $appointment->getState()==60): ?>
	<li class="sf_admin_action_approve">
      <?php echo link_to(__('Approve&nbsp;Report'), 'schoolmaster_plansandreports/ListApprove?id='.$appointment->getId(), array(), 'messages') ?>
    </li>
    <li class="sf_admin_action_reject">
      <?php echo link_to(__('Reject&nbsp;Report'), 'schoolmaster_plansandreports/ListReject?id='.$appointment->getId(), array(), 'messages') ?>
    </li>
<?php endif ?>

</ul>
</td>
