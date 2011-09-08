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
      <th class="sf_admin_text"><?php echo __('M.U.') ?></th>
      <th class="sf_admin_text"><?php echo __('Estimation') ?></th>
      <th class="sf_admin_text"><?php echo __('Approval') ?></th>
      <th class="sf_admin_text"><?php echo __('Cost') ?></th>
      <th class="sf_admin_text"><?php echo __('Amount') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0; $grandtotal=0 ?>
    <?php foreach ($projects as $project): $resources=$project->getProjResources(); $total=0 ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td rowspan="<?php echo sizeof($resources)+1 ?>">
        <strong><?php echo link_to(
          $project->getTitle(),
          'projects/monitorview?id=' . $project->getId()
          )?></strong><br />
        (<?php echo $project->getProjCategory() ?>)<br />
        <em><?php echo $project->getsfGuardUser()->getProfile()->getFullName() ?></em>
      </td>
      <?php $value=$resources[0]->getQuantityMultipliedByCost() ?>
      <?php $total+=$value ?>
      <?php include_partial('resourcebudget', array('resource'=>$resources[0], 'value'=>$value)) ?>
    </tr>
    <?php for($i=1; $i<sizeof($resources); $i++): ?>
    <tr>
      <?php $value=$resources[$i]->getQuantityMultipliedByCost() ?>
      <?php $total+=$value ?>
      <?php include_partial('resourcebudget', array('resource'=>$resources[$i], 'value'=>$value)) ?>
    </tr>
    <?php endfor ?>
    <tr>
    <th colspan="6"><?php echo __('Total for the project «%title%»', array('%title%'=>$project->getTitle())) ?></th>
    <?php $grandtotal+=$total ?>
    <td style="text-align: right; font-weight: bold"><?php echo currencyvalue($total) ?></td>
    <th></th>
    </tr>
    <?php endforeach; ?>
    <tr>
    <th colspan="7"><?php echo format_number_choice(__('[1]Grand total for the project selected|[1,+Inf]Grand total for the %number% projects selected'), array('%number%'=>sizeof($projects)), sizeof($projects)) ?></th>
    <td style="text-align: right; font-weight: bold; color:blue"><?php echo currencyvalue($grandtotal) ?></td>
    <th></th>
    </tr>
  </tbody>
</table>
