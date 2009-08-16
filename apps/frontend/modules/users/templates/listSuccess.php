<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('User management')) ?>
	
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	__("User list")
	)

?><h1><?php echo __("User management")?></h1>

<?php include_partial('filter', array('filtered_role_id'=>$filtered_role_id, 'filtered_schoolclass_id'=>$filtered_schoolclass_id)) ?>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('users/batch') ?>" method="post">

<table cellspacing="0">
  <thead>
    <tr>
	  <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>

      <th class="sf_admin_text"><?php echo link_to(__('G'), url_for( 'users/setsortlistpreference?sortby=gender')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Username'), url_for( 'users/setsortlistpreference?sortby=username')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Role'), url_for( 'users/setsortlistpreference?sortby=role')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('First name'), url_for('users/setsortlistpreference?sortby=firstname')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Last name'), url_for( 'users/setsortlistpreference?sortby=lastname')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Alerts'), url_for('users/setsortlistpreference?sortby=alerts')) ?></th>
      <th class="sf_admin_text"><?php echo __('Accounts') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
	<?php $ga_states=Workflow::getGoogleappsAccountStatusses(); ?>
    <?php foreach ($userlist as $user): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
	<td>
  <input type="checkbox" name="ids[]" value="<?php echo $user->getId() ?>" class="sf_admin_batch_checkbox" />
</td>

      <td><?php include_partial('gender', array('gender'=>$user->getGender())) ?></td>
      <td><?php echo $user->getUsername() ?></td>
      <td><?php echo $user->getRole() ?></td>
      <td><?php echo $user->getFirstName() ?></td>
      <td><?php echo $user->getLastName() ?></td>
	  <td>
		<?php if($user->getSystemAlerts()!=''): ?>
			<?php echo image_tag('error', 'title=' . $user->getSystemAlerts()) ?>
		<?php endif ?>
	  </td>
	  <td>
		<?php foreach ($user->getAccounts() as $account): ?>
			<?php echo image_tag($account->getAccountType(), 'title=' .$account->getAccountType()) ?>
		<?php endforeach ?>
	 </td>
	<td><?php include_partial('actions', array('user'=>$user)) ?></td>
 	

    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include_partial('plansandreports/checkalljs') ?>
    <ul class="sf_admin_actions">
      <li class="sf_admin_batch_actions_choice">
  <select name="batch_action">

<?php echo options_for_select(array(
  '' => __('Choose an action'),
  'Delete' => __('Delete selected users'),
), 0) ?>
  </select>

<?php echo submit_tag(_('Ok')) ?>

</li>
<li class="sf_admin_action_new">
<?php
echo link_to(
__('New user'),
url_for('users/new')
) ?>
</li>

</ul>


</ul>

</form>