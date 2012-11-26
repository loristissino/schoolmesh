<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id=' . $workplan->getId() => $workplan
    ),
  'current'=>__('Workplan import'),
  'title' =>__('Workplan import')  . ' - ' . $workplan
  ))
?>

<p><?php echo __('You cannot import a workplan when you have some modules in the target one.') ?></p>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
  <?php echo li_link_to_if(
    'action_edit',
    true,
    __('Edit target workplan'),
    url_for('plansandreports/fill?id='.$workplan->getId()) . '#modules',
    array('title'=>__('Edit the modules in the target workplan'))
    )
  ?>
</ul>
