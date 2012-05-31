  <ul>
  <?php foreach($activities as $activity): ?>
    <li><em><?php echo $activity->getBeginning('d/m/Y') ?></em> - <?php echo $activity->getNotes() ?> <?php echo sprintf('(%s, %s)', $activity->getQuantity(), $activity->getPerformerProfile()->getFullName()) ?></li>
  <?php endforeach ?>
  </ul>
