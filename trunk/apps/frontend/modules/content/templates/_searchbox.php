<div class="searchbox">
<form action="<?php echo url_for('users_search') ?>" method="get">
  <input type="text" name="query" size="60" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
  <input type="submit" value="<?php echo __('Search') ?>" />
  <?php echo image_tag('loader.gif', array('id'=>'loader', 'style'=>'vertical-align: middle; display: none')) ?>
  <div class="searchhelp">

<ul class="sf_admin_td_actions">
  <li class="sf_admin_action_help">
  <?php $popup_options="left=100,top=10,width=650,height=375,location=no,scrollbars =yes,resizable=yes,directories=no,status=no,toolbar=no,menubar=no" ?>
  <?php echo link_to(
    __('On line help'),
    sfConfig::get('app_help_search_guide', 'http://code.google.com/p/schoolmesh/wiki/SearchGuide'),
    array(
      'popup'=>array('help', $popup_options),
      'title'=>__('Show help page about search queries') . ' (' . __('opens in a popup window') . ')',
    )) ?>
  </li>
</ul>
  </div>
</form>
</div>
