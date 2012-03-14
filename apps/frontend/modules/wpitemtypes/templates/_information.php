<h3><?php echo $WpitemType->getTitle() ?></h3>
<?php echo link_to(__('Edit'), url_for('wpitemtypes/edit?id=' . $WpitemType->getId())) ?>

<ul>
<li><strong><?php echo __('Description') ?>:</strong> «<?php echo $WpitemType->getDescription() ?>»</li>
<li><strong><?php echo __('Singular') ?>:</strong> «<?php echo $WpitemType->getSingular() ?>»</li>
<li><strong><?php echo __('Style') ?>:</strong> «<?php echo $WpitemType->getStyle() ?>»</li>
<li><strong><?php echo __('Rank') ?>:</strong> <?php echo $WpitemType->getRank() ?></li>
<li><strong><?php echo __('Code') ?>:</strong> <?php echo $WpitemType->getCode() ?></li>
<li><strong><?php echo __('State Min') ?>:</strong> <?php echo $WpitemType->getStateMin() ?></li>
<li><strong><?php echo __('State Max') ?>:</strong> <?php echo $WpitemType->getStateMax() ?></li>
<li><strong><?php echo __('Grade Min') ?>:</strong> <?php echo $WpitemType->getGradeMin() ?></li>
<li><strong><?php echo __('Grade Max') ?>:</strong> <?php echo $WpitemType->getGradeMax() ?></li>
<li><strong><?php echo __('Required?') ?>:</strong> <?php echo get_partial('content/text_field_boolean', array('value'=>$WpitemType->getIsRequired())) ?></li>
</ul>

