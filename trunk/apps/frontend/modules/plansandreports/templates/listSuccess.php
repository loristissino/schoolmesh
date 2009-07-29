<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>


<?php slot('title', __("Workplans and reports' monitoring")) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	__("Monitoring")
	)
	
	?>

<h1><?php echo __("Workplans and reports' monitoring") ?></h1>


<div id="sf_admin_bar">
<div class="sf_admin_filter">
  
<form action="<?php echo url_for('plansandreports/setfilterlistpreference?filter=set' ) ?>" method="get">
    <table cellspacing="0">
      <tfoot>
        <tr>
          <td colspan="2">
               <a onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;f.submit();return false;" href="<?php echo url_for('plansandreports/setfilterlistpreference?filter=reset') ?>"><?php echo __('Reset') ?></a>            <input type="submit" value="<?php echo __('Filter') ?>" />
          </td>
        </tr>
      </tfoot>
      <tbody>
<tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_user_id">
    <td>
      <label for="appointment_filters_teacher_id"><?php echo __('Teacher') ?></label>    </td>
    <td>
<?php echo object_select_tag($filtered_user_id, 'getFilteredUserId',
array('related_class'=>'sfGuardUserProfile',
  'include_custom'=>__('Choose a teacher'),
  'peer_method'=>'retrieveTeachersWithAppointments'
  ))?>
          </td>
  </tr>
              </tbody>
    </table>
  </form>
</div>
</div>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('plansandreports/batch') ?>" method="post">

<table cellspacing="0">
  <thead>
    <tr>
	  <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>

      <th class="sf_admin_text"><?php echo link_to(__('Class'), url_for( 'plansandreports/setsortlistpreference?sortby=class')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Subject'), url_for('plansandreports/setsortlistpreference?sortby=subject')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Teacher'), url_for( 'plansandreports/setsortlistpreference?sortby=teacher')) ?></th>
      <th class="sf_admin_text"><?php echo __('Modules') ?></th>
	  <?php /*<th class="sf_admin_text"><?php echo __('Last action') ?></th> */ ?>
	  <th class="sf_admin_text"><?php echo link_to(__('State'), url_for( 'plansandreports/setsortlistpreference?sortby=state')) ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($workplans as $workplan): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
	<td>
  <input type="checkbox" name="ids[]" value="<?php echo $workplan->id ?>" class="sf_admin_batch_checkbox" />
</td>

      <td><?php echo $workplan->schoolclass_id ?></td>
      <td><?php echo $workplan->subject ?></td>
      <td><?php echo sprintf('%s %s', $workplan->first_name, $workplan->last_name) ?></td>
	  <td><?php echo $workplan->wpmodules ?></td>
	  <?php /*<?php $lastlog=$workplan->getLastLog() ?>  
	  <td><?php echo $lastlog?$lastlog->getCreatedAt():'' ?></td>*/ ?>
	  <td><?php include_partial('state', array('state' => $workplan->state, 'steps' => $steps, 'size'=>'r')) ?></td>
	  <td><?php  include_partial('action_monitor', array('workplan' => $workplan, 'steps' => $steps))  ?></td>
 	
	</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include_partial('checkalljs') ?>
    <ul class="sf_admin_actions">
      <li class="sf_admin_batch_actions_choice">
  <select name="batch_action">

<?php echo options_for_select(array(
  '' => __('Choose an action'),
  'Approve' => __('Approve selected documents'),
  'Reject' => __('Reject selected documents'),
), 0) ?>
  </select>

<?php echo submit_tag(_('Ok')) ?>

</li>
</ul>

</form>