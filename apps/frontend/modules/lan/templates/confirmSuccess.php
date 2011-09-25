<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'lan/index' => __("LAN"),
    '_subnet' => $currentsubnet,
    ),
  'current'=>__('Confirm action')
    )
  )
?>

<p>
<?php if($action=='enable_ia_currenttimeslot'): ?>
  <?php echo __('You are going to enable Internet access for the current timeslot for the following workstations:') ?>
<?php endif ?>
<?php if($action=='disable_ia_currenttimeslot'): ?>
  <?php echo __('You are going to disable Internet access for the current timeslot for the following workstations:') ?>
<?php endif ?>
<?php if($action=='enable_ia_until11thhour'): ?>
  <?php echo __('You are going to enable Internet access for the following workstations until the end of the day:') ?>
<?php endif ?>
</p>

<?php include_partial('workstations', array('Workstations'=>$Workstations)) ?>


<form action="<?php echo url_for('lan/'. $action) ?>" method="POST">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Confirm') ?>">
      </td>
    </tr>
  </table>
</form>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_back">
	<?php echo link_to(
				__('Back to LAN administration'),
				url_for('lan/index'),
				array('title'=>__('Get back to LAN administration page'))
				)?>
</li>
</ul>

