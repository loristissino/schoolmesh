<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'lan/index' => __("LAN"),
    '_subnet' => $currentsubnet,
    ),
  'current'=>__('View events'),
  'title'=>__('Events view'),
  )
  )
?>

<?php foreach($Workstations as $Workstation): ?>
  <h2><?php echo $Workstation->getName() ?></h2>
  <h3><?php echo __("Workflow") ?></h3>
  <?php include_partial('content/workflow', array('wfevents' => $Workstation->getWorkflowLogs())) ?>
<?php endforeach ?>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_back">
	<?php echo link_to(
				__('Back to LAN administration'),
				url_for('lan/index'),
				array('title'=>__('Get back to LAN administration page'))
				)?>
</li>
</ul>

