<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    'projects/edit?id=' . $project->getId() => $project->getTitle(),
    ),
  'current'=>__('Budget compatibility check'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<table>
  <tr>
    <th><?php echo __('Item') ?></th>
    <th><?php echo __('Amount') ?></th>
  </tr>
  <tr>
    <td><?php echo __('Budget') ?></td>
    <td style="text-align: right"><?php echo currencyvalue($be['budget']) ?></td>
  </tr>
  <tr>
    <td><?php echo __('Expenses') ?></td>
    <td style="text-align: right"><?php echo currencyvalue($be['expenses']) ?></td>
  </tr>
  <tr>
    <td><?php echo __('Difference') ?></td>
    <td style="text-align: right"><span style="color: <?php echo budgetcolor($be['expenses'], $be['budget']) ?>"><?php echo currencyvalue($be['budget']-$be['expenses']) ?></span></td>
  </tr>
</table>


<table>
<tr>
  <th><?php echo __('Description') ?></th>
  <th><?php echo __('Budget') ?></th>
  <th><?php echo __('Activities') ?></th>
  <th><?php echo __('Difference') ?></th>
  <th><?php echo __('Amount ext') ?></th>
</tr>
<?php $d=0; $btotal=0; $ftotal=0 ?>
<?php foreach($be['list'] as $rid=>$rvalue): $atotal=0 ?>
  <tr>
    <td><?php echo link_to($rvalue['description'], url_for('projects/viewresourceactivities?id=' . $rid))?></td>
    <td style="text-align: right"><?php echo currencyvalue($rvalue['budget']); $btotal+=$rvalue['budget'] ?></td>
    <td style="text-align: right">
      <?php if(isset($rvalue['activities'])): ?>
        <?php foreach($rvalue['activities'] as $aid=>$avalue): ?>
          <?php $atotal+=$avalue; echo currencyvalue($avalue) ?><br />
        <?php endforeach ?>
        <hr />
        <span style="color: <?php echo budgetcolor($atotal,$rvalue['budget']) ?>"><?php echo currencyvalue($atotal) ?></span>
      <?php endif ?>
    </td>
    <td style="text-align: right">
      <?php if($atotal!=$rvalue['budget']): $amount=$atotal- $rvalue['budget']; $d+=$amount ?>
        <span style="color: <?php echo budgetcolor($amount, 0) ?>"><?php echo currencyvalue($amount) ?></span>
      <?php endif ?>
    </td>
    <td style="text-align: right">
      <span title="<?php echo $rvalue['financing_notes'] ?>"><?php echo currencyvalue($rvalue['amount_funded_externally']); $ftotal+=$rvalue['amount_funded_externally'] ?></span>
    </td>
  </tr>
<?php endforeach ?>
  <tr>
    <th><?php echo __('Total amount') ?></th>
    <td style="text-align: right"><?php echo currencyvalue($btotal) ?></td>
    <td></td>
    <td style="text-align: right"><span style="color: <?php echo budgetcolor($d, 0) ?>"><?php echo currencyvalue($d) ?></span></td>
    <td style="text-align: right"><?php echo currencyvalue($ftotal) ?></td>
  </tr>
</table>



