<h3><?php echo $WptoolItemType->getDescription() ?></h3>
<?php echo link_to(__('Edit'), url_for('wptooltypes/edit?id=' . $WptoolItemType->getId())) ?>

<ul>
<li><strong><?php echo __('Description') ?>:</strong> «<?php echo $WptoolItemType->getDescription() ?>»</li>
<li><strong><?php echo __('Rank') ?>:</strong> <?php echo $WptoolItemType->getRank() ?></li>
<li><strong><?php echo __('State Min') ?>:</strong> <?php echo $WptoolItemType->getStateMin() ?></li>
<li><strong><?php echo __('State Max') ?>:</strong> <?php echo $WptoolItemType->getStateMax() ?></li>
<li><strong><?php echo __('Grade Min') ?>:</strong> <?php echo $WptoolItemType->getGradeMin() ?></li>
<li><strong><?php echo __('Grade Max') ?>:</strong> <?php echo $WptoolItemType->getGradeMax() ?></li>
<li><strong><?php echo __('Min selected') ?>:</strong> <?php echo $WptoolItemType->getMinSelected() ?></li>
<li><strong><?php echo __('Max selected') ?>:</strong> <?php echo $WptoolItemType->getMaxSelected() ?></li>
<li><strong><?php echo __('Items') ?></strong> (<?php echo link_to(__('edit'), url_for('wptoolitems/list?type='.$WptoolItemType->getId())) ?>)<strong>:</strong>
  <ul>
    <?php foreach($WptoolItemType->getWptoolItems() as $WptoolItem): ?>
      <li>
        <?php echo $WptoolItem->getDescription() ?>
        <?php if($WptoolItem->getCode()):?>
          (<em><?php echo $WptoolItem->getCode() ?></em>)
        <?php endif ?>
      </li>
    <?php endforeach ?>
  </ul>
</li>
</ul>

