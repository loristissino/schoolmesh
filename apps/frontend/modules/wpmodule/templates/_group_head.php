<td width="<?php echo (100/$size) ?>%">
<?php // for the icon associated to the style I should use the CSS, I know... ?>
<?php echo image_tag($item_group->getWpitemType()->getStyle()) ?>
<h3 class="itemgroup_<?php echo $item_group->getWpitemType()->getStyle() ?>"><?php /*<a href="#<?php echo $item_group->getId() ?>">*/ ?><?php echo $item_group->getWpitemType()->getTitle() ?><?php /*</a> */ ?></h3>
<p><em><?php echo $item_group->getWpitemType()->getDescription() ?></em></p>
<div id="sf_admin_container">
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo jq_link_to_function(
  __('Toggle'),
  jq_visual_effect('slideToggle', '#group'.$item_group->getId())
) ?>
</li>
</ul>
</div>
</td>
