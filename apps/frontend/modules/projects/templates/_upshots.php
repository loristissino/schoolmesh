<?php if (sizeof($upshots)>0): ?>

<h3><?php echo __('Expected upshots') ?></h3>

<ol>
<?php foreach($upshots as $upshot): ?>

	<li><?php echo $upshot->getDescription() ?>
  <em>(<?php echo $upshot->getIndicator() ?>)</em>
  </li>

<?php endforeach ?>
</ol>
<?php else: ?>
<p><?php echo __('No upshot defined.') ?></p>
<?php endif ?>

