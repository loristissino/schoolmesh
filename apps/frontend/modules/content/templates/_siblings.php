<?php if(sizeof($siblings)>1): ?>
  <p><?php include_partial('content/dubious', array('text'=>__('Alternate server'), 'with_text'=>false)) ?><?php echo __($plural) ?></p>
  <ul>
  <?php foreach($siblings as $name=>$url): ?>
    <li><?php echo link_to($name, $url) ?></li>
  <?php endforeach ?>
  </ul>
<?php elseif(sizeof($siblings)==1): ?>
  <p><?php include_partial('content/dubious', array('text'=>__('Alternate server'), 'with_text'=>false)) ?><?php echo __($singular) ?> <?php foreach($siblings as $name=>$url): ?><?php echo link_to($name, $url) ?><?php endforeach ?>.</p>
<?php endif ?>
