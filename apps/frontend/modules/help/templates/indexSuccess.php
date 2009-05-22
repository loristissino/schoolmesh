<h1><?php echo __('Help') ?></h1>

<h2><?php echo __('Workplans and Reports') ?></h2>

<p><?php echo __('The possible states of workplans/reports are as follows:') ?>
<?php foreach ($states as $state): ?>
<p><?php echo image_tag('wpfr_workflow_'.$state, 'title=' . __($steps[$state]['stateDescription'])) ?><br />
<?php echo __($steps[$state]['stateDescription']) ?><br /><br />

</p>

<?php endforeach ?>