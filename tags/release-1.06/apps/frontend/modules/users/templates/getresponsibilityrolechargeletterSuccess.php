<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('Users'),
    'users/list' => __('List/Search'),
    'users/list?query='. $sf_user->getAttribute('currently_selected')=>__('Selected users'),
    ),
  'current'=>__('Responsibility role charge letters')
  ))
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('You are going to get the responsibility roles for the following users:') ?></p>

<?php include_partial('userlist', array('userlist'=>$userlist)) ?>

<p><?php echo __('Please select the roles for which you want the letters to be generated:') ?></p>

<form action="<?php echo url_for('users/confirmgetresponsibilityrolechargeletter?ids=' . $sf_request->getParameter('ids')) ?>" method="post">

<table>
<thead>
	<tr>
    <th id="sf_admin_list_batch_actions"></th>
		<th class="sf_admin_text"><?php echo __('Quality code') ?></th>
		<th class="sf_admin_text"><?php echo __('Description') ?></th>
	</tr>
</thead>
<tbody>
	<?php $i=0 ?>
  <?php foreach($roles as $role): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
    <td>
      <input type="checkbox" name="roleids[]" value="<?php echo $role->getId() ?>" class="sf_admin_batch_checkbox" />
    </td>
    <td>
    <?php echo $role->getQualityCode() ?>
    </td>
    <td>
    <?php echo link_to_if($sf_user->hasCredential('teams'), $role->getMaleDescription(), url_for('organization/role?id='.$role->getId())) ?>
    </td>
  </th>
  <?php endforeach ?>
</tbody>
</table>
 
<input type="submit" name="save" value="<?php echo __('Get the letters') ?>">
  
</form>

