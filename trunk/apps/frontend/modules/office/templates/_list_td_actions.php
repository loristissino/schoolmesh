<td>
  <ul class="sf_admin_td_actions">
	<?php if($appointment->getState()!=0): ?>
    <li class="sf_admin_action_view">
      <?php echo link_to(__('View'), 'plansandreports/view?id='.$appointment->getId()) ?>
    </li>
	<?php endif ?>
	<?php foreach($steps[$appointment->getState()]['actions'] as $actionkey=>$actionvalue): ?>
	<li class="sf_admin_action_<?php echo $actionkey ?>">
      <?php echo link_to(__($steps[$appointment->getState()]['actions'][$actionkey]['submitDisplayedAction']), 'office/'. $actionkey .'?id='.$appointment->getId(), array('method'=>'put')) ?>
    </li>
	<?php endforeach ?>
</ul>
</td>
