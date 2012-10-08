<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' =>__("Projects management")
    ),
  'current'=>__('Compute budget'),
  'title'=>__('Budget computation'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Project') ?></th>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Charged user') ?></th>
      <th class="sf_admin_text"><?php echo __('Estimation') ?></th>
      <th class="sf_admin_text"><?php echo __('Approval') ?></th>
      <th class="sf_admin_text"><?php echo __('Cost') ?></th>
      <th class="sf_admin_text" style="text-align: right"><?php echo __('Amount int') ?></th>
      <th class="sf_admin_text" style="text-align: right"><?php echo __('Amount ext') ?></th>
      <th class="sf_admin_text" id='actionshead'><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0; $grandtotal=0; $egrandtotal=0 ?>
    <?php foreach ($projects as $project): $resources=$project->getProjResources(); $total=0; $etotal=0 ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td rowspan="<?php echo sizeof($resources)+1 ?>" class='projecttitle'>
        <strong><?php echo link_to(
          $project->getTitle(),
          'projects/monitorview?id=' . $project->getId()
          )?></strong><br />
        (<?php echo $project->getProjCategory() ?>)<br />
        <em><?php echo $project->getsfGuardUser()->getProfile()->getFullName() ?></em>
      </td>
      <?php if(sizeof($resources)): ?>
        <?php $value=sizeof($resources)?$resources[0]->getAmountEstimated()-$resources[0]->getAmountFundedExternally():0 ?>
        <?php $external=sizeof($resources)?$resources[0]->getAmountFundedExternally():0 ?>
        <?php $total+=$value ?>
        <?php $etotal+=$external ?>
        <?php include_partial('resourcebudget', array('resource'=>$resources[0], 'value'=>$value, 'external'=>$external)) ?>
      <?php else: ?>
        <td colspan="9"></td>
      <?php endif ?>
    </tr>
    <?php for($i=1; $i<sizeof($resources); $i++): ?>
    <tr>
      <?php $value=$resources[$i]->getAmountEstimated()-$resources[$i]->getAmountFundedExternally() ?>
      <?php $external=$resources[$i]->getAmountFundedExternally() ?>
      <?php $total+=$value ?>
      <?php $etotal+=$external ?>
      <?php include_partial('resourcebudget', array('resource'=>$resources[$i], 'value'=>$value, 'external'=>$external)) ?>
    </tr>
    <?php endfor ?>
    <?php if(sizeof($resources)): ?>
      <tr>
      <th colspan="5"><?php echo __('Total for the project «%title%»', array('%title%'=>$project->getTitle())) ?></th>
      <?php $grandtotal+=$total ?>
      <?php $egrandtotal+=$etotal ?>
      <td style="text-align: right; font-weight: bold" class="amount"><?php echo currencyvalue($total) ?></td>
      <td style="text-align: right; font-weight: bold" class="amount"><?php echo currencyvalue($etotal) ?></td>
      <th></th>
      </tr>
    <?php endif ?>
    
    <?php endforeach; ?>
    <tr>
    <th colspan="6"><?php echo format_number_choice(__('[1]Grand total for the project selected|[1,+Inf]Grand total for the %number% projects selected'), array('%number%'=>sizeof($projects)), sizeof($projects)) ?></th>
    <td style="text-align: right; font-weight: bold; color:blue" class="amount"><?php echo currencyvalue($grandtotal) ?></td>
    <td style="text-align: right; font-weight: bold; color:blue" class="amount"><?php echo currencyvalue($egrandtotal) ?></td>
    <th></th>
    </tr>
  </tbody>
</table>

</div>
