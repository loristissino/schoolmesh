<em><?php echo $category ?></em>
<?php if($category->getResources()==0): ?>
  <?php echo image_tag('nomoney', array('size'=>'16x16', 'alt'=>__('This kind of project may not have resources'), 'title'=>__('This kind of project may not have resources'))) ?>
<?php endif ?>
