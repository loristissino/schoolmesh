<?php echo image_tag('dubious', array('size'=>'16x16', 'alt'=>$text, 'title'=>$text)) ?>
<?php if(isset($with_text) and $with_text): ?>
  <?php echo $text ?>
<?php endif ?>
