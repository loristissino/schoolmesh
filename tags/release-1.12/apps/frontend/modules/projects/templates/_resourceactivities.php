  <ul>
  <?php foreach($activities as $activity): ?>
    <li>
        <em>
            <?php if($activity->getPaperLog()): ?>
                <?php echo __('Paper log') ?>
            <?php else: ?>
                <?php echo $activity->getBeginning('d/m/Y') ?>
            <?php endif ?>
        </em>
        - <?php echo $activity->getNotes() ?> <?php echo sprintf('(%s, %s)', quantityvalue($activity->getQuantity(), $mu), $activity->getPerformerProfile()->getFullName()) ?></li>
  <?php endforeach ?>
  </ul>
