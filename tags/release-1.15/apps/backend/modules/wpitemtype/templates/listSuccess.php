<div id="sf_admin_container">

<h1>Ordered list of Workplan Module Items (by rank)</h1>


<ul>
<?php foreach($wpitems as $wpitem): ?>
  <li>
    <strong><?php echo $wpitem->getTitle() ?></strong>  (<?php echo $wpitem->getDescription() ?>)
	<?php
      if($wpitem->getRank() > 1): 
        echo link_to('Move up ', 'wpitemtype/up?id='.$wpitem->getId()); 
      endif;
      if($wpitem->getRank() != $max_rank):
        echo link_to('Move down', 'wpitemtype/down?id='.$wpitem->getId());
      endif;
    ?>
  </li>
<?php endforeach ?>
</ul>


