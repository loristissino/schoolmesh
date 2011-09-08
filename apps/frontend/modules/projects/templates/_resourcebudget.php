<td><?php echo $resource->getDescription() ?></td>
<td><?php echo $resource->getChargedUserProfile() ?></td>
<td style="text-align: right"><?php echo $resource->getProjResourceType()->getMeasurementUnit() ?></td>
<td style="text-align: right"><?php echo quantityvalue($resource->getQuantityEstimated()) ?></td>
<td style="text-align: right"><?php echo quantityvalue($resource->getQuantityApproved()) ?></td>
<td style="text-align: right"><?php echo quantityvalue($resource->getStandardCost(), sfConfig::get('app_config_currency_symbol') .'/' . $resource->getProjResourceType()->getMeasurementUnit()) ?></td>
<td style="text-align: right; font-style: italic"><?php echo currencyvalue($value) ?></td>
<td>
<ul class="sf_admin_td_actions">
	<li class="sf_admin_action_edit">
		<?php echo link_to(__('Edit'),
			url_for('projects/editresource?id=' . $resource->getId() . '&back=budget'),
			array('title'=>__('Edit this resource'))
		)?>
		</li>
</ul>
</td>

