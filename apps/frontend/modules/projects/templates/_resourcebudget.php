<td style="<?php if(!$resource->getIsMonetary()) echo "color:gray" ?>"><?php echo $resource->getDescription() ?></td>
<td><?php echo $resource->getChargedUserProfile() ?></td>
<td style="text-align: right<?php if(!$resource->getIsMonetary()) echo "; color:gray" ?>" class='amount'><?php echo quantityvalue($resource->getQuantityEstimated(), $resource->getProjResourceType()->getMeasurementUnit()) ?></td>
<td style="text-align: right<?php if(!$resource->getIsMonetary()) echo "; color:gray" ?>" class='amount'><?php echo quantityvalue($resource->getQuantityApproved(), $resource->getProjResourceType()->getMeasurementUnit()) ?></td>
<td style="text-align: right" class='amount'><?php echo quantityvalue($resource->getStandardCost(), sfConfig::get('app_config_currency_symbol') .'/' . $resource->getProjResourceType()->getMeasurementUnit()) ?></td>
<td style="text-align: right; font-style: italic" class='amount'><?php echo currencyvalue($value) ?></td>
<td style="text-align: right; font-style: italic" class='amount'><span title="<?php echo $resource->getFinancingNotes() ?>"><?php echo currencyvalue($external) ?></span><?php if(($resource->getFinancingNotes()=='') && ($external)):?><?php echo image_tag('dubious', array('title'=>__('External financing undefined'), 'size'=>'16x16')) ?><?php endif ?></td>
<td class='actionscolumn'>
<ul class="sf_admin_td_actions">
	<li class="sf_admin_action_edit">
		<?php echo link_to(__('Edit'),
			url_for('projects/editresource?id=' . $resource->getId() . '&back=budget'),
			array('title'=>__('Edit this resource'))
		)?>
		</li>
</ul>
</td>

