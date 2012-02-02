<div class="searchbox">
<form action="<?php echo url_for('users_search') ?>" method="get">
  <input type="text" name="query" size="60" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
  <input type="submit" value="<?php echo __('Search') ?>" />
  <?php echo link_to(__('Common queries'), url_for('content/commonqueries?type=users')) ?>
  <?php echo image_tag('loader.gif', array('id'=>'loader', 'style'=>'vertical-align: middle; display: none')) ?>
</form>
</div>
