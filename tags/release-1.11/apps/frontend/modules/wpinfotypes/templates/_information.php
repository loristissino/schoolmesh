<h3><?php echo $WpinfoType->getTitle() ?></h3>
<?php echo link_to(__('Edit'), url_for('wpinfotypes/edit?id=' . $WpinfoType->getId())) ?>

<ul>
<li><strong><?php echo __('Description') ?>:</strong> «<?php echo $WpinfoType->getDescription() ?>»</li>
<li><strong><?php echo __('Template') ?>:</strong> «<?php echo $WpinfoType->getTemplate() ?>»</li>
<li><strong><?php echo __('Example') ?>:</strong> «<?php echo $WpinfoType->getExample() ?>»</li>
<li><strong><?php echo __('Rank') ?>:</strong> <?php echo $WpinfoType->getRank() ?></li>
<li><strong><?php echo __('Code') ?>:</strong> <?php echo $WpinfoType->getCode() ?></li>
<li><strong><?php echo __('State Min') ?>:</strong> <?php echo $WpinfoType->getStateMin() ?></li>
<li><strong><?php echo __('State Max') ?>:</strong> <?php echo $WpinfoType->getStateMax() ?></li>
<li><strong><?php echo __('Grade Min') ?>:</strong> <?php echo $WpinfoType->getGradeMin() ?></li>
<li><strong><?php echo __('Grade Max') ?>:</strong> <?php echo $WpinfoType->getGradeMax() ?></li>
<li><strong><?php echo __('Required?') ?></strong> <?php echo get_partial('content/text_field_boolean', array('value'=>$WpinfoType->getIsRequired())) ?></li>
<li><strong><?php echo __('Confidential?') ?></strong> <?php echo get_partial('content/text_field_boolean', array('value'=>$WpinfoType->getIsConfidential())) ?></li>
</ul>

