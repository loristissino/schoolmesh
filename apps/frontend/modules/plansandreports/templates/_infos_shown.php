<?php foreach ($wpinfos as $wpinfo): ?>
	<?php if($wpinfo->isViewableBy($sf_user)): ?>
      <h3><?php echo $wpinfo->getWpinfoType()->getTitle() ?></h3>
      <em><?php echo $wpinfo->getWpinfoType()->getDescription() ?></em>
      <blockquote><?php echo  html_entity_decode(nl2br($wpinfo->getContent())) ?></blockquote>
	  <em>(<?php echo sprintf(__('filled on %s'), $wpinfo->getUpdatedAt('d/m/Y')) ?>)</em>  
    <?php endif ?>
   <?php endforeach; ?>
