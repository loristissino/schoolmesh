<h3>Legenda</h3>
<p><?php echo __("For each item type, evaluation is expressed with a minimum and a maximum as follows:") ?></p>
<ul>
<?php foreach ($wpitemTypes as $wpitemType): ?>
	<?php if ($wpitemType->getEvaluationMax()>0): ?>
	<li><strong><?php echo $wpitemType->getTitle() ?></strong> 
			<?php echo __('min') .': '. $wpitemType->getEvaluationMin() ?> = <em><?php echo $wpitemType->getEvaluationMinDescription() ?>; </em>
			<?php echo __('max') .': '. $wpitemType->getEvaluationMax() ?> = <em><?php echo $wpitemType->getEvaluationMaxDescription() ?></em>
	</li>
	<?php endif; ?>
<?php endforeach; ?>
</ul>