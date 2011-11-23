<?php use_stylesheet('print', 'last', array('media'=>'print')) ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' =>__("Projects monitoring")
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
      <th class="sf_admin_text" style="text-align: right"><?php echo __('M.U.') ?></th>
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
      <?php $value=$resources[0]->getAmountEstimated()-$resources[0]->getAmountFundedExternally() ?>
      <?php $external=$resources[0]->getAmountFundedExternally() ?>
      <?php $total+=$value ?>
      <?php $etotal+=$external ?>
      <?php include_partial('resourcebudget', array('resource'=>$resources[0], 'value'=>$value, 'external'=>$external)) ?>
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
    <tr>
    <th colspan="6"><?php echo __('Total for the project «%title%»', array('%title%'=>$project->getTitle())) ?></th>
    <?php $grandtotal+=$total ?>
    <?php $egrandtotal+=$etotal ?>
    <td style="text-align: right; font-weight: bold"><?php echo currencyvalue($total) ?></td>
    <td style="text-align: right; font-weight: bold"><?php echo currencyvalue($etotal) ?></td>
    <th></th>
    </tr>
    <?php endforeach; ?>
    <tr>
    <th colspan="7"><?php echo format_number_choice(__('[1]Grand total for the project selected|[1,+Inf]Grand total for the %number% projects selected'), array('%number%'=>sizeof($projects)), sizeof($projects)) ?></th>
    <td style="text-align: right; font-weight: bold; color:blue"><?php echo currencyvalue($grandtotal) ?></td>
    <td style="text-align: right; font-weight: bold; color:blue"><?php echo currencyvalue($egrandtotal) ?></td>
    <th></th>
    </tr>
  </tbody>
</table>
