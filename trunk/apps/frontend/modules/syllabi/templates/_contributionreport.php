<li><?php echo $subject ?>: 
<?php if($contribution==WpmoduleSyllabusItemPeer::FOCUSSED_CONTRIBUTION): ?>
<strong>
<?php else: ?>
<em>
<?php endif ?>
<?php echo $title ?>
<?php if($contribution==WpmoduleSyllabusItemPeer::FOCUSSED_CONTRIBUTION): ?>
</strong>
<?php else: ?>
</em>
<?php endif ?>
</li>