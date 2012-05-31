<?php if (sizeof($upshots)>0): ?>

<h3><?php echo __('Expected upshots') ?></h3>

<ol>
<?php foreach($upshots as $upshot): ?>

	<li><?php echo $upshot->getDescription() ?>
  <em>(<?php echo $upshot->getIndicator() ?>)</em>
  
  <?php if($upshot->getUpshot()): ?>
    <ul>
      <li><?php echo __('Upshot') ?>: <strong><?php echo $upshot->getUpshot() ?></strong></li>
      <li><?php echo __('Evaluation') ?>: <strong><?php echo $upshot->getEvaluation() ?></strong> <?php echo sprintf('(%d-%d)', $project->getEvaluationMin(), $project->getEvaluationMax()) ?></li>
    </ul>
  <?php endif ?>
  </li>

<?php endforeach ?>
</ol>
<?php else: ?>
<p><?php echo __('No upshot defined.') ?></p>
<?php endif ?>

