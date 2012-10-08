<h1><?php echo __('Help') ?></h1>

<h2><?php echo __('Workplans and Reports') ?></h2>

<p><?php echo __('The possible states of workplans/reports are as follows:') ?>
<?php foreach ($states as $code=>$state): ?>
<p><?php echo image_tag('wpfr_workflow_'.$code, 'title=' . __($steps[$code]['stateDescription'])) ?><br />
<?php echo __($steps[$code]['stateDescription']) ?><br /><br />

</p>

<?php endforeach ?>