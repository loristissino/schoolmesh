<li class="sf_admin_action_export">
  <?php echo link_to(
__('Export'),
'plansandreports/export?id='.$workplan->getId(),
array('title'=>__(__($steps[$workplan->getState()]['owner']['exportActionTip'])))

)?><br />
</li>
