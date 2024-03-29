<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' =>__("Projects management")
    ),
  'current'=>__('Compute data synthesis'),
  'title'=>__('Projects data synthesis computation'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Project') ?></th>
    <?php foreach($types as $type): if($type->getIsMonetary()):?>
      <th width="10" style="text-align: right" class="verticalheader"><?php echo image_tag('vertical.php?text='. urlencode($type->getDescription()) .
      '&backcolor=255-255-255&textcolor=0-0-0&ywidth=250',
          array(
            'alt' => $type->getDescription(),
            'title' => $type->getDescription(),
            'size' => '20x250')
            )
          ?></th>
    <?php endif; endforeach ?>
	<th width="10" style="text-align: right" class="verticalheader"><?php echo image_tag('vertical.php?text='. urlencode(__('Total amount')) .
	'&backcolor=0-0-0&textcolor=255-255-63&ywidth=250',
			array(
				'alt' => __('Total'),
				'title' => __('Total'),
        'size' => '20x250')
				)
			?></th>
    </tr>
    
  </thead>
  <tbody>
	<?php $i=0; $grandtotal=0; $totals_by_type=array() ?>
    <?php foreach ($projects as $project): $total=0?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td>
        <?php echo link_to(
          $project['title'],
          url_for('projects/batch?id='. $project['id'] . '&batch_action=computebudget')
          )
        ?>
      </td>
      <?php foreach($types as $type): if($type->getIsMonetary()):?>
          <td style="text-align: right"  class='amount'>
          <?php if(array_key_exists($type->getId(), $project['resources']->getRawValue())): ?>
            <?php echo currencyvalue($project['resources'][$type->getId()]) ?>
            <?php $total+=$project['resources'][$type->getId()] ?>
            <?php @$totals_by_type[$type->getId()]+=$project['resources'][$type->getId()] ?>
          <?php endif ?>
          </td>
      <?php endif; endforeach ?>
        <th style="text-align: right; font-weight: bold"  class='amount'>
          <?php echo currencyvalue($total) ?>
          <?php $grandtotal+=$total ?>
        </th>
      </tr>
    <?php endforeach ?>
    <tr>
    <th><?php echo __('Grand totals') ?></th>
    <?php foreach($types as $type): if ($type->getIsMonetary()): ?>
    <th style="text-align: right" class='amount'><?php echo currencyvalue($totals_by_type[$type->getId()]) ?></th>
    <?php endif; endforeach ?>
    <td style="text-align: right; font-weight: bold; color:blue" class='amount'><?php echo currencyvalue($grandtotal) ?></td>
    </tr>
  </tbody>
</table>
