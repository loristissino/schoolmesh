<?php if ($workplan->getWpmodules()): ?>
<h2><?php echo __("Modules"); ?></h2>
<ol>
<?php foreach($workplan->getWpmodules() as $wpmodule): ?>
<li><?php echo $wpmodule; ?>&nbsp;<a href="<?php echo url_for('wpmodule/show?id='.$wpmodule->getId()) ?>">View</a></li>
<?php endforeach; ?>
</ol>
<?php endif; ?>