<?php if($upshot->getEvaluation()>0): ?>
  <?php echo $upshot->getEvaluation() ?>
  <?php if($upshot->getEvaluation()):?>
    (<?php echo __('scale: %min%-%max%', array('%min%'=>$project->getEvaluationMin(), '%max%'=>$project->getEvaluationMax())) ?>)
  <?php endif ?>
<?php elseif($upshot->getEvaluation()==-1): ?>
  <?php echo __('N/A') ?>
<?php endif ?>
